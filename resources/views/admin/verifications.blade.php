@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Verification Requests</h1>
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
        <a href="{{ route('admin.verifications') }}" class="border-b-2 border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 font-medium text-sm">
            NIN Verification
            @if($verificationRequests->count() > 0)
                <span class="ml-1 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $verificationRequests->count() }}
                </span>
            @endif
        </a>
        
        <a href="{{ route('admin.documents') }}" class="border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 font-medium text-sm text-gray-500 ml-8">
            Document Review
            @if($pendingDocuments > 0)
                <span class="ml-1 bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $pendingDocuments }}
                </span>
            @endif
        </a>
        
        <a href="{{ route('admin.badge.requests') }}" class="border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 font-medium text-sm text-gray-500 ml-8">
            Badge Requests
            @if($badgeRequests > 0)
                <span class="ml-1 bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $badgeRequests }}
                </span>
            @endif
        </a>
    </nav>
</div>

<!-- Filter Section -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <form method="GET" action="{{ route('admin.verifications') }}" class="flex flex-wrap gap-4 items-end">
        <div>
            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Filter by Role</label>
            <select id="role" name="role" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">All Roles</option>
                <option value="tenant" {{ request('role') == 'tenant' ? 'selected' : '' }}>Tenants</option>
                <option value="landlord" {{ request('role') == 'landlord' ? 'selected' : '' }}>Landlords</option>
                <option value="agent" {{ request('role') == 'agent' ? 'selected' : '' }}>Agents</option>
            </select>
        </div>
        
        <div>
            <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Search</label>
            <input type="text" id="search" name="search" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Name or email" value="{{ request('search') }}">
        </div>
        
        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Filter
            </button>
            
            @if(request()->hasAny(['role', 'search']))
                <a href="{{ route('admin.verifications') }}" class="ml-2 text-gray-600 hover:text-gray-800">
                    Clear Filters
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Verification Requests List -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Pending NIN Verification Requests ({{ $verificationRequests->total() }})</h2>
    
    @if($verificationRequests->count() > 0)
        <div class="grid grid-cols-1 gap-6">
            @foreach($verificationRequests as $request)
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-50 p-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-full flex items-center justify-center mr-4 
                                    @if($request->user->role === 'tenant') bg-green-100 @endif
                                    @if($request->user->role === 'landlord') bg-blue-100 @endif
                                    @if($request->user->role === 'agent') bg-purple-100 @endif">
                                    <span class="text-xl font-bold 
                                        @if($request->user->role === 'tenant') text-green-600 @endif
                                        @if($request->user->role === 'landlord') text-blue-600 @endif
                                        @if($request->user->role === 'agent') text-purple-600 @endif">
                                        {{ substr($request->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $request->user->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($request->user->role === 'tenant') bg-green-100 text-green-800 @endif
                                            @if($request->user->role === 'landlord') bg-blue-100 text-blue-800 @endif
                                            @if($request->user->role === 'agent') bg-purple-100 text-purple-800 @endif">
                                            {{ ucfirst($request->user->role) }}
                                        </span>
                                        <span class="ml-2">{{ $request->user->email }}</span>
                                        @if($request->user->phone_number)
                                            <span class="ml-2">· {{ $request->user->phone_number }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Submitted {{ $request->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium mb-2">NIN Details</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <div class="mb-2">
                                    <span class="font-medium text-gray-700">NIN:</span>
                                    <span class="ml-2">{{ $request->nin }}</span>
                                </div>
                                
                                <!-- In a production app, you might integrate with a real NIN verification API -->
                                <!-- For this MVP, we're simulating verification data -->
                                <div class="mb-2">
                                    <span class="font-medium text-gray-700">Full Name (from NIN):</span>
                                    <span class="ml-2">{{ $request->user->name }}</span>
                                </div>
                                
                                <div class="mb-2">
                                    <span class="font-medium text-gray-700">Date of Birth:</span>
                                    <span class="ml-2">{{ now()->subYears(rand(18, 60))->format('d M Y') }}</span>
                                </div>
                                
                                <div class="mb-2">
                                    <span class="font-medium text-gray-700">Gender:</span>
                                    <span class="ml-2">{{ ['Male', 'Female'][rand(0, 1)] }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium text-gray-700">Address:</span>
                                    <span class="ml-2">{{ ['Lagos', 'Abuja', 'Port Harcourt', 'Ibadan', 'Kano'][rand(0, 4)] }}, Nigeria</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="font-medium mb-2">Decision</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600">Please verify the NIN information against our database or external verification API.</p>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <form method="POST" action="{{ route('admin.verification.approve', $request) }}" class="w-full sm:w-auto">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Approve
                                        </button>
                                    </form>
                                    
                                    <button type="button" class="w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            onclick="document.getElementById('reject-modal-{{ $request->id }}').classList.remove('hidden')">
                                        Reject
                                    </button>
                                </div>
                                
                                <!-- Reject Modal -->
                                <div id="reject-modal-{{ $request->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                        <h3 class="text-lg font-bold mb-4">Reject Verification</h3>
                                        
                                        <form method="POST" action="{{ route('admin.verification.reject', $request) }}">
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
            {{ $verificationRequests->links() }}
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Pending Requests</h2>
            <p class="text-gray-500">
                There are currently no pending NIN verification requests.
            </p>
        </div>
    @endif
</div>

<!-- Process Tips -->
<div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mt-6" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm">
                <strong>Verification Process:</strong> NIN verification should match the user's information with official records. Verify that the name, date of birth, and other details match the information in the user's profile. If details don't match, reject the verification and provide a clear reason.
            </p>
        </div>
    </div>
</div>
@endsection
