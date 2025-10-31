<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\TenantReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LandlordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:landlord');
    }

    /**
     * Show the landlord dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(Request $request)
    {
        $landlord = Auth::user();
        $properties = $landlord->properties;
        $propertyCount = $properties->count();
        
        // Handle tenant search
        $searchResults = null;
        if ($request->hasAny(['name', 'phone', 'nin'])) {
            $searchResults = $this->searchTenantsForDashboard($request);
        }
        
        // Get total number of tenants across all properties
        $tenantCount = DB::table('property_tenants')
            ->join('properties', 'property_tenants.property_id', '=', 'properties.id')
            ->where('properties.landlord_id', $landlord->id)
            ->where('property_tenants.active', true)
            ->count();
            
        // Get reviews for properties owned by this landlord
        $pendingAgentReviews = TenantReview::whereHas('property', function($query) use ($landlord) {
                $query->where('landlord_id', $landlord->id);
            })
            ->count();
            
        // Get verified agents
        $verifiedAgentCount = DB::table('agent_landlords')
            ->where('landlord_id', $landlord->id)
            ->where('verified', true)
            ->count();
            
        return view('landlord.dashboard', compact(
            'landlord', 
            'propertyCount', 
            'tenantCount', 
            'pendingAgentReviews',
            'verifiedAgentCount',
            'searchResults'
        ));
    }

    /**
     * Show the landlord's properties.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function properties()
    {
        $landlord = Auth::user();
        $properties = $landlord->properties;
        
        return view('landlord.properties', compact('landlord', 'properties'));
    }

    /**
     * Show all tenants across all properties.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tenants()
    {
        $landlord = Auth::user();
        $properties = $landlord->properties;
        
        // Get all tenants from properties with active status
        $tenants = [];
        foreach ($properties as $property) {
            $propertyTenants = $property->activeTenants()->get();
            foreach ($propertyTenants as $tenant) {
                // Add property information to the tenant
                $tenant->property_name = $property->name;
                $tenant->property_id = $property->id;
                $tenants[] = $tenant;
            }
        }
        
        return view('landlord.tenants', compact('landlord', 'tenants'));
    }

    /**
     * Search for tenants by name, phone, or NIN.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchTenants(Request $request)
    {
        $search = $request->input('search');
        
        if (empty($search)) {
            return redirect()->route('landlord.tenants');
        }
        
        // Search for tenants by name, phone, or NIN
        $tenants = User::where('role', 'tenant')
            ->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('phone_number', 'like', '%' . $search . '%')
                    ->orWhere('nin', 'like', '%' . $search . '%');
            })
            ->where('verified', true) // Only verified tenants
            ->paginate(10);
            
        return view('landlord.tenant-search', compact('tenants', 'search'));
    }

    /**
     * Add a tenant to a property.
     *
     * @param \App\Models\User $tenant
     * @param \App\Models\Property $property
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addTenantToProperty(User $tenant, Property $property, Request $request)
    {
        $landlord = Auth::user();
        
        // Verify that the property belongs to the landlord
        if ($property->landlord_id !== $landlord->id) {
            return redirect()->route('landlord.properties')
                ->with('error', 'You are not authorized to add tenants to this property.');
        }
        
        // Verify that the user is a tenant
        if (!$tenant->isTenant()) {
            return redirect()->route('landlord.properties')
                ->with('error', 'The selected user is not a tenant.');
        }
        
        // Validate the request data
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);
        
        // Check if tenant is already active in the property
        $existingTenant = $property->tenants()
            ->wherePivot('tenant_id', $tenant->id)
            ->wherePivot('active', true)
            ->first();
            
        if ($existingTenant) {
            return redirect()->route('landlord.property.show', $property)
                ->with('error', 'This tenant is already active in this property.');
        }
        
        // Add tenant to the property
        $property->tenants()->attach($tenant->id, [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'active' => true,
            'added_by' => $landlord->id,
        ]);
        
        return redirect()->route('landlord.property.show', $property)
            ->with('success', 'Tenant added to property successfully.');
    }

    /**
     * Remove a tenant from a property.
     *
     * @param \App\Models\User $tenant
     * @param \App\Models\Property $property
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeTenantFromProperty(User $tenant, Property $property)
    {
        $landlord = Auth::user();
        
        // Verify that the property belongs to the landlord
        if ($property->landlord_id !== $landlord->id) {
            return redirect()->route('landlord.properties')
                ->with('error', 'You are not authorized to remove tenants from this property.');
        }
        
        // Update the tenant's status to inactive
        $property->tenants()->updateExistingPivot($tenant->id, [
            'active' => false,
        ]);
        
        return redirect()->route('landlord.property.show', $property)
            ->with('success', 'Tenant removed from property successfully.');
    }

    /**
     * Show the landlord's reviews.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews()
    {
        $landlord = Auth::user();
        $reviews = $landlord->writtenReviews()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('landlord.reviews', compact('landlord', 'reviews'));
    }

    /**
     * Show the agent reviews pending landlord approval.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function agentReviews()
    {
        $landlord = Auth::user();
        $pendingReviews = TenantReview::where('landlord_id', $landlord->id)
            ->where('status', 'pending_approval')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('landlord.agent-reviews', compact('landlord', 'pendingReviews'));
    }

    /**
     * Show the landlord's agents.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function agents()
    {
        $landlord = Auth::user();
        $agents = $landlord->agents()->paginate(10);
        
        // Get pending agent requests (not verified)
        $pendingAgents = $landlord->agents()
            ->wherePivot('verified', false)
            ->get();
            
        return view('landlord.agents', compact('landlord', 'agents', 'pendingAgents'));
    }

    /**
     * Verify an agent.
     *
     * @param \App\Models\User $agent
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyAgent(User $agent)
    {
        $landlord = Auth::user();
        
        // Check if the agent is already linked to the landlord
        $linkedAgent = $landlord->agents()
            ->where('agent_id', $agent->id)
            ->first();
            
        if (!$linkedAgent) {
            return redirect()->route('landlord.agents')
                ->with('error', 'This agent is not linked to you.');
        }
        
        // Update the agent's verification status
        $landlord->agents()->updateExistingPivot($agent->id, [
            'verified' => true,
        ]);
        
        return redirect()->route('landlord.agents')
            ->with('success', 'Agent verified successfully.');
    }

    /**
     * Unverify an agent.
     *
     * @param \App\Models\User $agent
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unverifyAgent(User $agent)
    {
        $landlord = Auth::user();
        
        // Check if the agent is already linked to the landlord
        $linkedAgent = $landlord->agents()
            ->where('agent_id', $agent->id)
            ->first();
            
        if (!$linkedAgent) {
            return redirect()->route('landlord.agents')
                ->with('error', 'This agent is not linked to you.');
        }
        
        // Update the agent's verification status
        $landlord->agents()->updateExistingPivot($agent->id, [
            'verified' => false,
        ]);
        
        return redirect()->route('landlord.agents')
            ->with('success', 'Agent verification revoked successfully.');
    }

    /**
     * Search for tenants by name, phone, or NIN for dashboard
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function searchTenantsForDashboard(Request $request)
    {
        $query = User::where('role', 'tenant');

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone_number', 'LIKE', '%' . $request->phone . '%');
        }

        if ($request->filled('nin')) {
            $query->where('nin', 'LIKE', '%' . $request->nin . '%');
        }

        return $query->with(['documents', 'verificationRequests'])
                    ->orderBy('verification_badge', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->limit(20)
                    ->get();
    }

    /**
     * Show tenant profile for landlords
     *
     * @param \App\Models\User $tenant
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showTenantProfile(User $tenant)
    {
        // Ensure the user is a tenant
        if ($tenant->role !== 'tenant') {
            abort(404);
        }

        // Get tenant's reviews
        $reviews = TenantReview::where('tenant_id', $tenant->id)
                              ->where('status', 'approved')
                              ->with(['landlord', 'property'])
                              ->latest()
                              ->get();

        // Get tenant's documents (limited info for privacy)
        $documentsCount = $tenant->documents()->count();
        $approvedDocumentsCount = $tenant->documents()->where('status', 'approved')->count();

        return view('landlord.tenant-profile', compact(
            'tenant', 
            'reviews', 
            'documentsCount', 
            'approvedDocumentsCount'
        ));
    }
}
