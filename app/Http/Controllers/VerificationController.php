<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
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
     * Request verification (for tenants).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestVerification(Request $request)
    {
        $user = Auth::user();
        
        // Only tenants can request verification badges
        if ($user->role !== 'tenant') {
            return redirect()->back()->with('error', 'Only tenants can request verification badges.');
        }
        
        // Check if user already has verification badge
        if ($user->verification_badge) {
            return redirect()->back()->with('info', 'You already have a verification badge.');
        }
        
        // Check if user has pending request
        if ($user->hasPendingVerificationRequest()) {
            return redirect()->back()->with('info', 'You already have a pending verification request.');
        }
        
        // Validate optional notes
        $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);
        
        // Check if user has required documents
        $hasLivePhoto = $user->documents()->where('type', 'live_photo')->where('status', 'approved')->exists();
        $hasIdDocument = $user->documents()->where('type', 'id_document')->where('status', 'approved')->exists();
        
        if (!$hasLivePhoto || !$hasIdDocument) {
            return redirect()->back()->with('error', 'You must upload and have approved live photo and ID documents before requesting verification.');
        }
        
        // Create verification request
        $verificationRequest = VerificationRequest::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'notes' => $request->notes,
            'submitted_at' => now(),
        ]);
        
        return redirect()->back()
            ->with('success', 'Verification badge request submitted successfully. An admin will review your documents and NIN verification.');
    }

    /**
     * Approve a verification request (for admins).
     *
     * @param \App\Models\VerificationRequest $verification
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(VerificationRequest $verification, Request $request)
    {
        $admin = Auth::user();
        
        // Verify that the user is an admin
        if (!$admin->isAdmin()) {
            return redirect()->back()
                ->with('error', 'Only admins can approve verification requests.');
        }
        
        $request->validate([
            'admin_notes' => 'nullable|string',
        ]);
        
        // Approve the verification request
        $verification->approve($request->admin_notes);
        
        return redirect()->back()
            ->with('success', 'Verification request approved successfully.');
    }

    /**
     * Reject a verification request (for admins).
     *
     * @param \App\Models\VerificationRequest $verification
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(VerificationRequest $verification, Request $request)
    {
        $admin = Auth::user();
        
        // Verify that the user is an admin
        if (!$admin->isAdmin()) {
            return redirect()->back()
                ->with('error', 'Only admins can reject verification requests.');
        }
        
        $request->validate([
            'admin_notes' => 'nullable|string',
        ]);
        
        // Reject the verification request
        $verification->reject($request->admin_notes);
        
        return redirect()->back()
            ->with('success', 'Verification request rejected successfully.');
    }

    /**
     * Mock NIN verification API (for development purposes).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function mockNinVerification(Request $request)
    {
        $request->validate([
            'nin' => 'required|string|min:11|max:11',
        ]);
        
        $nin = $request->nin;
        
        // For demo purposes, verify all NINs that start with '123'
        $isValid = substr($nin, 0, 3) === '123';
        
        // Mock response data
        $responseData = [
            'success' => $isValid,
            'message' => $isValid ? 'NIN verified successfully.' : 'Invalid NIN.',
            'data' => $isValid ? [
                'nin' => $nin,
                'full_name' => 'Mock User',
                'gender' => 'Male',
                'date_of_birth' => '1990-01-01',
            ] : null,
        ];
        
        return response()->json($responseData);
    }

    /**
     * Mock phone number verification API (for development purposes).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function mockPhoneVerification(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:15',
        ]);
        
        $phoneNumber = $request->phone_number;
        
        // For demo purposes, verify all phone numbers that start with '+234'
        $isValid = substr($phoneNumber, 0, 4) === '+234';
        
        // Mock response data
        $responseData = [
            'success' => $isValid,
            'message' => $isValid ? 'Phone number verified successfully.' : 'Invalid phone number.',
            'data' => $isValid ? [
                'phone_number' => $phoneNumber,
                'is_mobile' => true,
                'carrier' => 'Mock Carrier',
            ] : null,
        ];
        
        return response()->json($responseData);
    }
}
