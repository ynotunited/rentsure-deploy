<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\TenantReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new landlord review for a tenant.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $tenant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $tenant)
    {
        $landlord = Auth::user();
        
        // Verify that the user is a landlord
        if (!$landlord->isLandlord()) {
            return redirect()->back()
                ->with('error', 'Only landlords can create reviews.');
        }
        
        // Verify that the user is a tenant
        if (!$tenant->isTenant()) {
            return redirect()->back()
                ->with('error', 'Reviews can only be created for tenants.');
        }
        
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);
        
        // Verify that the property belongs to the landlord
        $property = Property::find($request->property_id);
        if ($property->landlord_id !== $landlord->id) {
            return redirect()->back()
                ->with('error', 'You can only review tenants for your own properties.');
        }
        
        // Check if tenant is or was in the property
        $isPropertyTenant = $property->tenants()
            ->where('tenant_id', $tenant->id)
            ->exists();
            
        if (!$isPropertyTenant) {
            return redirect()->back()
                ->with('error', 'This tenant is not associated with the selected property.');
        }
        
        // Create the review
        $review = TenantReview::create([
            'tenant_id' => $tenant->id,
            'reviewer_id' => $landlord->id,
            'property_id' => $property->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'approved',
            'public' => true,
        ]);
        
        return redirect()->back()
            ->with('success', 'Review created successfully.');
    }

    /**
     * Store a new agent review for a tenant (requires landlord approval).
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $tenant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAgentReview(Request $request, User $tenant)
    {
        $agent = Auth::user();
        
        // Verify that the user is an agent
        if (!$agent->isAgent()) {
            return redirect()->back()
                ->with('error', 'Only agents can create these reviews.');
        }
        
        // Verify that the user is a tenant
        if (!$tenant->isTenant()) {
            return redirect()->back()
                ->with('error', 'Reviews can only be created for tenants.');
        }
        
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);
        
        // Get the property
        $property = Property::find($request->property_id);
        
        // Verify that the agent is associated with the landlord
        $verifiedWithLandlord = $agent->landlords()
            ->wherePivot('verified', true)
            ->where('id', $property->landlord_id)
            ->exists();
            
        if (!$verifiedWithLandlord) {
            return redirect()->back()
                ->with('error', 'You are not verified with the landlord of this property.');
        }
        
        // Check if tenant is or was in the property
        $isPropertyTenant = $property->tenants()
            ->where('tenant_id', $tenant->id)
            ->exists();
            
        if (!$isPropertyTenant) {
            return redirect()->back()
                ->with('error', 'This tenant is not associated with the selected property.');
        }
        
        // Create the review pending landlord approval
        $review = TenantReview::create([
            'tenant_id' => $tenant->id,
            'reviewer_id' => $agent->id,
            'property_id' => $property->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending_approval',
            'public' => false,
            'landlord_id' => $property->landlord_id,
        ]);
        
        return redirect()->back()
            ->with('success', 'Review submitted for landlord approval.');
    }

    /**
     * Update a review.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TenantReview $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TenantReview $review)
    {
        $user = Auth::user();
        
        // Verify that the user is the review owner
        if ($review->reviewer_id !== $user->id) {
            return redirect()->back()
                ->with('error', 'You are not authorized to update this review.');
        }
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);
        
        // Update the review
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        return redirect()->back()
            ->with('success', 'Review updated successfully.');
    }

    /**
     * Delete a review.
     *
     * @param \App\Models\TenantReview $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TenantReview $review)
    {
        $user = Auth::user();
        
        // Verify that the user is the review owner
        if ($review->reviewer_id !== $user->id) {
            return redirect()->back()
                ->with('error', 'You are not authorized to delete this review.');
        }
        
        // Delete the review
        $review->delete();
        
        return redirect()->back()
            ->with('success', 'Review deleted successfully.');
    }

    /**
     * Approve an agent review (for landlords).
     *
     * @param \App\Models\TenantReview $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(TenantReview $review)
    {
        $landlord = Auth::user();
        
        // Verify that the user is the landlord who needs to approve
        if ($review->landlord_id !== $landlord->id) {
            return redirect()->back()
                ->with('error', 'You are not authorized to approve this review.');
        }
        
        // Approve the review
        $review->approve();
        
        return redirect()->back()
            ->with('success', 'Review approved successfully.');
    }

    /**
     * Reject an agent review (for landlords).
     *
     * @param \App\Models\TenantReview $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(TenantReview $review)
    {
        $landlord = Auth::user();
        
        // Verify that the user is the landlord who needs to approve
        if ($review->landlord_id !== $landlord->id) {
            return redirect()->back()
                ->with('error', 'You are not authorized to reject this review.');
        }
        
        // Reject the review
        $review->reject();
        
        return redirect()->back()
            ->with('success', 'Review rejected successfully.');
    }

    /**
     * Dispute a review (for tenants).
     *
     * @param \App\Models\TenantReview $review
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dispute(TenantReview $review, Request $request)
    {
        $tenant = Auth::user();
        
        // Verify that the user is the tenant being reviewed
        if ($review->tenant_id !== $tenant->id) {
            return redirect()->back()
                ->with('error', 'You can only dispute reviews about yourself.');
        }
        
        // Verify that the review is public
        if (!$review->public) {
            return redirect()->back()
                ->with('error', 'You can only dispute public reviews.');
        }
        
        $request->validate([
            'dispute_reason' => 'required|string',
        ]);
        
        // Dispute the review
        $review->dispute();
        
        // Store dispute reason as a note in the review
        $review->update([
            'admin_notes' => 'Dispute reason: ' . $request->dispute_reason,
        ]);
        
        return redirect()->back()
            ->with('success', 'Review disputed successfully. An admin will review your case.');
    }

    /**
     * Resolve a disputed review (for admins).
     *
     * @param \App\Models\TenantReview $review
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resolveDispute(TenantReview $review, Request $request)
    {
        $admin = Auth::user();
        
        // Verify that the user is an admin
        if (!$admin->isAdmin()) {
            return redirect()->back()
                ->with('error', 'Only admins can resolve disputes.');
        }
        
        // Verify that the review is disputed
        if (!$review->isDisputed()) {
            return redirect()->back()
                ->with('error', 'This review is not disputed.');
        }
        
        $request->validate([
            'resolution' => 'required|in:approve,remove',
            'admin_notes' => 'nullable|string',
        ]);
        
        if ($request->resolution === 'approve') {
            // Keep the review public
            $review->status = 'approved';
            $review->public = true;
            $review->admin_notes = $request->admin_notes;
            $review->save();
        } else {
            // Remove the review
            $review->delete();
        }
        
        return redirect()->route('admin.reviews.disputes')
            ->with('success', 'Dispute resolved successfully.');
    }
}
