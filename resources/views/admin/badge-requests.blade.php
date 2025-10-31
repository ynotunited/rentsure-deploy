@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Badge Requests</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Verification Type Navigation -->
<div class="mb-6 border-b border-gray-200">
    <nav class="flex -mb-px">
        <a href="{{ route('admin.verifications') }}" class="border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 font-medium text-sm text-gray-500">
            NIN Verification
            @if($ninRequests > 0)
                <span class="ml-1 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $ninRequests }}
                </span>
            @endif
        </a>
        
        <a href="{{ route('admin.documents') }}" class="border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 font-medium text-sm text-gray-500 ml-8">
            Document Review
            @if($documentReviews > 0)
                <span class="ml-1 bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $documentReviews }}
                </span>
            @endif
        </a>
        
        <a href="{{ route('admin.badge.requests') }}" class="border-b-2 border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 font-medium text-sm ml-8">
            Badge Requests
            @if($badgeRequests->count() > 0)
                <span class="ml-1 bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $badgeRequests->count() }}
                </span>
            @endif
        </a>
    </nav>
</div>

<!-- Filter Section -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <form method="GET" action="{{ route('admin.badge.requests') }}" class="flex flex-wrap gap-4 items-end">
        <div>
            <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Search</label>
            <input type="text" id="search" name="search" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Name or email" value="{{ request('search') }}">
        </div>
        
        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Search
            </button>
            
            @if(request()->has('search'))
                <a href="{{ route('admin.badge.requests') }}" class="ml-2 text-gray-600 hover:text-gray-800">
                    Clear Search
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Badge Requests List -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Tenant Badge Verification Requests ({{ $badgeRequests->total() }})</h2>
    
    @if($badgeRequests->count() > 0)
        <div class="space-y-6">
            @foreach($badgeRequests as $request)
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-50 p-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                    <span class="text-xl font-bold text-green-600">{{ substr($request->tenant->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $request->tenant->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Tenant
                                        </span>
                                        <span class="ml-2">{{ $request->tenant->email }}</span>
                                        @if($request->tenant->phone_number)
                                            <span class="ml-2">· {{ $request->tenant->phone_number }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Requested {{ $request->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium mb-2">Tenant Information</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <div class="mb-2">
                                    <span class="font-medium text-gray-700">Account Created:</span>
                                    <span class="ml-2">{{ $request->tenant->created_at->format('M d, Y') }}</span>
                                </div>
                                
                                <div class="mb-2">
                                    <span class="font-medium text-gray-700">NIN Verification Status:</span>
                                    @if($request->tenant->verified)
                                        <span class="ml-2 text-green-600">Verified</span>
                                    @else
                                        <span class="ml-2 text-red-600">Not Verified</span>
                                    @endif
                                </div>
                                
                                <div class="mb-2">
                                    <span class="font-medium text-gray-700">Document Status:</span>
                                    @php
                                        $verifiedDocs = $request->tenant->documents()->where('verified', true)->count();
                                        $totalDocs = $request->tenant->documents()->count();
                                    @endphp
                                    <span class="ml-2">
                                        {{ $verifiedDocs }}/{{ $totalDocs }} documents verified
                                    </span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Landlord Reviews:</span>
                                    @php
                                        $reviewCount = $request->tenant->receivedReviews()->where('status', 'approved')->count();
                                        $avgRating = $reviewCount > 0 
                                            ? round($request->tenant->receivedReviews()->where('status', 'approved')->avg('rating'), 1)
                                            : 0;
                                    @endphp
                                    <span class="ml-2">
                                        {{ $reviewCount }} {{ Str::plural('review', $reviewCount) }}
                                        @if($reviewCount > 0)
                                        with {{ $avgRating }}/5 avg rating
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <h4 class="font-medium mt-4 mb-2">Properties History</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                @php
                                    $currentProperties = $request->tenant->properties()->wherePivot('end_date', null)->orWherePivot('end_date', '>=', now())->count();
                                    $historicalProperties = $request->tenant->properties()->wherePivot('end_date', '<', now())->count();
                                    $totalMonthsRenting = 18; // This would be calculated from actual property history
                                @endphp
                                
                                <div class="mb-2">
                                    <span class="font-medium text-gray-700">Current Properties:</span>
                                    <span class="ml-2">{{ $currentProperties }}</span>
                                </div>
                                
                                <div class="mb-2">
                                    <span class="font-medium text-gray-700">Historical Properties:</span>
                                    <span class="ml-2">{{ $historicalProperties }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Total Rental History:</span>
                                    <span class="ml-2">{{ $totalMonthsRenting }} {{ Str::plural('month', $totalMonthsRenting) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="font-medium mb-2">Verification Requirements</h4>
                            
                            <div class="bg-gray-50 p-4 rounded mb-4">
                                <ul class="space-y-2">
                                    <li class="flex items-center">
                                        @if($request->tenant->verified)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                        <span>NIN Verification</span>
                                    </li>
                                    
                                    <li class="flex items-center">
                                        @if($verifiedDocs >= 2)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                        <span>At least 2 verified documents</span>
                                    </li>
                                    
                                    <li class="flex items-center">
                                        @if($totalMonthsRenting >= 12)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                        <span>At least 12 months rental history</span>
                                    </li>
                                    
                                    <li class="flex items-center">
                                        @if($reviewCount >= 2 && $avgRating >= 3.5)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                        <span>At least 2 positive reviews (3.5+ rating)</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <h4 class="font-medium mb-2">Decision</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                @php
                                    $meetsRequirements = 
                                        $request->tenant->verified && 
                                        $verifiedDocs >= 2 && 
                                        $totalMonthsRenting >= 12 && 
                                        $reviewCount >= 2 && 
                                        $avgRating >= 3.5;
                                @endphp
                                
                                @if($meetsRequirements)
                                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-green-700">
                                                    This tenant meets all requirements for verification badge.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    This tenant does not meet all requirements for a verification badge.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <form method="POST" action="{{ route('admin.badge.approve', $request) }}" class="w-full sm:w-auto">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline {{ !$meetsRequirements ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ !$meetsRequirements ? 'disabled' : '' }}>
                                            Approve Badge
                                        </button>
                                    </form>
                                    
                                    <button type="button" class="w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            onclick="document.getElementById('reject-modal-{{ $request->id }}').classList.remove('hidden')">
                                        Reject Request
                                    </button>
                                </div>
                                
                                <!-- Reject Modal -->
                                <div id="reject-modal-{{ $request->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                        <h3 class="text-lg font-bold mb-4">Reject Badge Request</h3>
                                        
                                        <form method="POST" action="{{ route('admin.badge.reject', $request) }}">
                                            @csrf
                                            
                                            <div class="mb-4">
                                                <label for="rejection_reason-{{ $request->id }}" class="block text-gray-700 text-sm font-bold mb-2">Reason for Rejection</label>
                                                <textarea id="rejection_reason-{{ $request->id }}" name="rejection_reason" rows="3" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                                            </div>
                                            
                                            <div class="flex justify-end">
                                                <button type="button" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                                                        onclick="document.getElementById('reject-modal-{{ $request->id }}').classList.add('hidden')">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Confirm Rejection
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $badgeRequests->links() }}
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Badge Requests</h2>
            <p class="text-gray-500">
                There are currently no pending verification badge requests.
            </p>
        </div>
    @endif
</div>

<!-- Badge Guidelines -->
<div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mt-6" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm">
                <strong>Verification Badge Guidelines:</strong> The verification badge is a symbol of trustworthiness and reliability. It indicates that a tenant has a verified identity, consistent rental history, and positive reviews from landlords. Only approve badges for tenants who meet all the requirements.
            </p>
        </div>
    </div>
</div>
@endsection
