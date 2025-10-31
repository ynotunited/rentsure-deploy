<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\TenantReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:agent');
    }

    /**
     * Show the agent dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $agent = Auth::user();
        
        // Get verified landlords
        $verifiedLandlords = $agent->landlords()
            ->wherePivot('verified', true)
            ->get();
            
        // Get count of pending landlord verification requests
        $pendingLandlordsCount = $agent->landlords()
            ->wherePivot('verified', false)
            ->count();
            
        // Get count of all reviews by this agent
        $totalReviewsCount = TenantReview::where('reviewer_id', $agent->id)->count();
        
        // Since status column doesn't exist, we'll use total reviews
        $pendingReviewsCount = 0; // Will be implemented when status column is added
        $rejectedReviewsCount = 0; // Will be implemented when status column is added
            
        return view('agent.dashboard', compact(
            'agent', 
            'verifiedLandlords', 
            'pendingLandlordsCount', 
            'totalReviewsCount',
            'pendingReviewsCount',
            'rejectedReviewsCount'
        ));
    }

    /**
     * Show the agent's landlords.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function landlords()
    {
        $agent = Auth::user();
        $verifiedLandlords = $agent->landlords()
            ->wherePivot('verified', true)
            ->get();
            
        $pendingLandlords = $agent->landlords()
            ->wherePivot('verified', false)
            ->get();
            
        return view('agent.landlords', compact('agent', 'verifiedLandlords', 'pendingLandlords'));
    }

    /**
     * Request to be linked to a landlord.
     *
     * @param \App\Models\User $landlord
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestLandlord(User $landlord)
    {
        $agent = Auth::user();
        
        // Verify that the user is a landlord
        if (!$landlord->isLandlord()) {
            return redirect()->route('agent.landlords')
                ->with('error', 'The selected user is not a landlord.');
        }
        
        // Check if agent is already linked to the landlord
        $existingLink = DB::table('agent_landlords')
            ->where('agent_id', $agent->id)
            ->where('landlord_id', $landlord->id)
            ->first();
            
        if ($existingLink) {
            return redirect()->route('agent.landlords')
                ->with('error', 'You are already linked to this landlord.');
        }
        
        // Create a link between agent and landlord (unverified)
        $agent->landlords()->attach($landlord->id, [
            'verified' => false,
        ]);
        
        return redirect()->route('agent.landlords')
            ->with('success', 'Landlord request sent successfully.');
    }

    /**
     * Show properties for landlords the agent is verified with.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function properties()
    {
        $agent = Auth::user();
        
        // Get verified landlords
        $verifiedLandlords = $agent->landlords()
            ->wherePivot('verified', true)
            ->pluck('id');
            
        // Get properties for verified landlords
        $properties = Property::whereIn('landlord_id', $verifiedLandlords)->paginate(10);
        
        return view('agent.properties', compact('agent', 'properties'));
    }

    /**
     * Show tenants for a specific property.
     *
     * @param \App\Models\Property $property
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function propertyTenants(Property $property)
    {
        $agent = Auth::user();
        
        // Verify that the agent is verified with the landlord
        $verifiedWithLandlord = $agent->landlords()
            ->wherePivot('verified', true)
            ->where('id', $property->landlord_id)
            ->exists();
            
        if (!$verifiedWithLandlord) {
            return redirect()->route('agent.properties')
                ->with('error', 'You are not authorized to view tenants for this property.');
        }
        
        // Get active tenants for the property
        $tenants = $property->activeTenants()->get();
        
        return view('agent.property-tenants', compact('agent', 'property', 'tenants'));
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
            return redirect()->route('agent.properties');
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
            
        return view('agent.tenant-search', compact('tenants', 'search'));
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
        $agent = Auth::user();
        
        // Verify that the agent is verified with the landlord
        $verifiedWithLandlord = $agent->landlords()
            ->wherePivot('verified', true)
            ->where('id', $property->landlord_id)
            ->exists();
            
        if (!$verifiedWithLandlord) {
            return redirect()->route('agent.properties')
                ->with('error', 'You are not authorized to add tenants to this property.');
        }
        
        // Verify that the user is a tenant
        if (!$tenant->isTenant()) {
            return redirect()->route('agent.properties')
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
            return redirect()->route('agent.property.tenants', $property)
                ->with('error', 'This tenant is already active in this property.');
        }
        
        // Add tenant to the property
        $property->tenants()->attach($tenant->id, [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'active' => true,
            'added_by' => $agent->id,
        ]);
        
        return redirect()->route('agent.property.tenants', $property)
            ->with('success', 'Tenant added to property successfully.');
    }

    /**
     * Show the agent's reviews.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews()
    {
        $agent = Auth::user();
        $reviews = $agent->writtenReviews()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('agent.reviews', compact('agent', 'reviews'));
    }

    /**
     * Show the agent's pending reviews.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pendingReviews()
    {
        $agent = Auth::user();
        $pendingReviews = $agent->writtenReviews()
            ->where('status', 'pending_approval')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('agent.pending-reviews', compact('agent', 'pendingReviews'));
    }

    /**
     * Show the agent's rejected reviews.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function rejectedReviews()
    {
        $agent = Auth::user();
        $rejectedReviews = $agent->writtenReviews()
            ->where('status', 'rejected')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('agent.rejected-reviews', compact('agent', 'rejectedReviews'));
    }
}
