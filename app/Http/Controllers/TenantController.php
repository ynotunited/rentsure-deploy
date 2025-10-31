<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\TenantReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:tenant');
    }

    /**
     * Show the tenant dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('tenant.dashboard');
    }

    /**
     * Show the tenant profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $tenant = Auth::user();
        $documents = $tenant->documents;
        $properties = $tenant->tenantProperties;
        $verificationStatus = $tenant->verified;
        $verificationBadge = $tenant->verification_badge;
        
        return view('tenant.profile', compact(
            'tenant', 
            'documents', 
            'properties', 
            'verificationStatus', 
            'verificationBadge'
        ));
    }

    /**
     * Show the tenant's reviews.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews()
    {
        $tenant = Auth::user();
        $reviews = $tenant->receivedReviews()
            ->where('public', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('tenant.reviews', compact('tenant', 'reviews'));
    }
}
