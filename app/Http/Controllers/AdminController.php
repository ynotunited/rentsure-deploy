<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Property;
use App\Models\TenantReview;
use App\Models\User;
use App\Models\VerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        // Count users by role
        $userCounts = [
            'tenants' => User::where('role', 'tenant')->count(),
            'landlords' => User::where('role', 'landlord')->count(),
            'agents' => User::where('role', 'agent')->count(),
            'admins' => User::where('role', 'admin')->count(),
        ];
        
        // Count properties
        $propertyCount = Property::count();
        
        // Count pending verification requests
        $pendingVerifications = VerificationRequest::where('status', 'pending')->count();
        
        // Count pending document verifications
        $pendingDocuments = Document::where('verified', false)->count();
        
        // Count total reviews (disputed reviews not available without status column)
        $totalReviews = TenantReview::count();
        $disputedReviews = 0; // Will be implemented when status column is added
        
        return view('admin.dashboard', compact(
            'userCounts', 
            'propertyCount', 
            'pendingVerifications', 
            'pendingDocuments',
            'totalReviews',
            'disputedReviews'
        ));
    }

    /**
     * Show all users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users', compact('users'));
    }

    /**
     * Show all landlords.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function landlords()
    {
        $landlords = User::where('role', 'landlord')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.landlords', compact('landlords'));
    }

    /**
     * Show all agents.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function agents()
    {
        $agents = User::where('role', 'agent')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.agents', compact('agents'));
    }

    /**
     * Show all tenants.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tenants()
    {
        $tenants = User::where('role', 'tenant')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.tenants', compact('tenants'));
    }

    /**
     * Show the form to edit a user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editUser(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    /**
     * Update a user.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:15',
            'verified' => 'nullable|boolean',
            'verification_badge' => 'nullable|boolean',
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->verified = $request->has('verified');
        $user->verification_badge = $request->has('verification_badge');
        $user->save();
        
        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyUser(User $user)
    {
        // Prevent deleting own account
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')
                ->with('error', 'You cannot delete your own account.');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Show all verification requests.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function verifications()
    {
        $pendingVerifications = VerificationRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.verifications', compact('pendingVerifications'));
    }

    /**
     * Show all unverified documents.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function documents()
    {
        $pendingDocuments = Document::with('user')
            ->where('verified', false)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.documents', compact('pendingDocuments'));
    }

    /**
     * Show all disputed reviews.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviewDisputes()
    {
        $disputedReviews = TenantReview::with(['tenant', 'reviewer', 'property'])
            ->where('status', 'disputed')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.review-disputes', compact('disputedReviews'));
    }

    /**
     * Show analytics.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function analytics()
    {
        // Get user registration counts by month
        $userRegistrations = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'), 'role')
            ->groupBy('year', 'month', 'role')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
            
        // Get review counts by month
        $reviewCounts = DB::table('tenant_reviews')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
            
        // Get verification request counts by month
        $verificationCounts = DB::table('verification_requests')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'), 'status')
            ->groupBy('year', 'month', 'status')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
            
        return view('admin.analytics', compact('userRegistrations', 'reviewCounts', 'verificationCounts'));
    }
}
