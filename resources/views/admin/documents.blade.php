@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Document Review</h1>
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
        
        <a href="{{ route('admin.documents') }}" class="border-b-2 border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 font-medium text-sm ml-8">
            Document Review
            @if($documents->count() > 0)
                <span class="ml-1 bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $documents->count() }}
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
    <form method="GET" action="{{ route('admin.documents') }}" class="flex flex-wrap gap-4 items-end">
        <div>
            <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Document Type</label>
            <select id="type" name="type" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">All Types</option>
                <option value="id" {{ request('type') == 'id' ? 'selected' : '' }}>Identification</option>
                <option value="utility" {{ request('type') == 'utility' ? 'selected' : '' }}>Utility Bill</option>
                <option value="residence" {{ request('type') == 'residence' ? 'selected' : '' }}>Proof of Residence</option>
                <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        
        <div>
            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">User Role</label>
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
            
            @if(request()->hasAny(['type', 'role', 'search']))
                <a href="{{ route('admin.documents') }}" class="ml-2 text-gray-600 hover:text-gray-800">
                    Clear Filters
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Documents List -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Pending Documents Review ({{ $documents->total() }})</h2>
    
    @if($documents->count() > 0)
        <div class="grid grid-cols-1 gap-6">
            @foreach($documents as $document)
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-50 p-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-full flex items-center justify-center mr-4 
                                    @if($document->user->role === 'tenant') bg-green-100 @endif
                                    @if($document->user->role === 'landlord') bg-blue-100 @endif
                                    @if($document->user->role === 'agent') bg-purple-100 @endif">
                                    <span class="text-xl font-bold 
                                        @if($document->user->role === 'tenant') text-green-600 @endif
                                        @if($document->user->role === 'landlord') text-blue-600 @endif
                                        @if($document->user->role === 'agent') text-purple-600 @endif">
                                        {{ substr($document->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $document->user->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($document->user->role === 'tenant') bg-green-100 text-green-800 @endif
                                            @if($document->user->role === 'landlord') bg-blue-100 text-blue-800 @endif
                                            @if($document->user->role === 'agent') bg-purple-100 text-purple-800 @endif">
                                            {{ ucfirst($document->user->role) }}
                                        </span>
                                        <span class="ml-2">{{ $document->user->email }}</span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Uploaded {{ $document->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium mb-2">Document Information</h4>
                                <div class="bg-gray-50 p-4 rounded mb-4">
                                    <div class="mb-2">
                                        <span class="font-medium text-gray-700">Type:</span>
                                        <span class="ml-2">
                                            @switch($document->type)
                                                @case('id')
                                                    Identification
                                                    @break
                                                @case('utility')
                                                    Utility Bill
                                                    @break
                                                @case('residence')
                                                    Proof of Residence
                                                    @break
                                                @default
                                                    Other Document
                                            @endswitch
                                        </span>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <span class="font-medium text-gray-700">Description:</span>
                                        <span class="ml-2">{{ $document->description }}</span>
                                    </div>
                                    
                                    <div>
                                        <span class="font-medium text-gray-700">Filename:</span>
                                        <span class="ml-2">{{ $document->filename }}</span>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-300 rounded-lg overflow-hidden">
                                    <!-- In a real app, this would show the actual document -->
                                    <div class="bg-gray-200 h-64 flex items-center justify-center">
                                        @if(in_array(pathinfo($document->filename, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'pdf']))
                                            <img src="{{ asset('storage/documents/'.$document->filename) }}" alt="Document" class="max-h-full object-contain">
                                        @else
                                            <div class="text-center p-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="mt-2 text-gray-600">{{ $document->filename }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="p-4 bg-gray-50 border-t">
                                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            View Full Document
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="font-medium mb-2">Verification Decision</h4>
                                <div class="bg-gray-50 p-4 rounded mb-4">
                                    <p class="mb-4 text-sm text-gray-600">
                                        Please verify the document details and authenticity before approving or rejecting.
                                    </p>
                                    
                                    <form method="POST" action="{{ route('admin.document.verify', $document) }}">
                                        @csrf
                                        
                                        <div class="mb-4">
                                            <label for="verification_notes-{{ $document->id }}" class="block text-gray-700 text-sm font-bold mb-2">Notes (Optional)</label>
                                            <textarea id="verification_notes-{{ $document->id }}" name="verification_notes" rows="3" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Add any notes about this verification"></textarea>
                                        </div>
                                        
                                        <div class="flex flex-col sm:flex-row gap-2">
                                            <button type="submit" name="action" value="approve" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                Approve
                                            </button>
                                            
                                            <button type="button" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                    onclick="document.getElementById('reject-modal-{{ $document->id }}').classList.remove('hidden')">
                                                Reject
                                            </button>
                                        </div>
                                    </form>
                                    
                                    <!-- Reject Modal -->
                                    <div id="reject-modal-{{ $document->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                            <h3 class="text-lg font-bold mb-4">Reject Document</h3>
                                            
                                            <form method="POST" action="{{ route('admin.document.reject', $document) }}">
                                                @csrf
                                                
                                                <div class="mb-4">
                                                    <label for="rejection_reason-{{ $document->id }}" class="block text-gray-700 text-sm font-bold mb-2">Reason for Rejection</label>
                                                    <textarea id="rejection_reason-{{ $document->id }}" name="rejection_reason" rows="3" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                                                </div>
                                                
                                                <div class="flex justify-end">
                                                    <button type="button" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                                                            onclick="document.getElementById('reject-modal-{{ $document->id }}').classList.add('hidden')">
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
                                
                                <!-- Guidelines Box -->
                                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 rounded">
                                    <h5 class="font-medium mb-2">Verification Guidelines</h5>
                                    <ul class="list-disc pl-5 space-y-1 text-sm">
                                        <li>Ensure document is current and not expired</li>
                                        <li>Verify document belongs to the user</li>
                                        <li>Check for signs of tampering or forgery</li>
                                        <li>Confirm information matches user profile</li>
                                        <li>For utility bills, verify they are recent (within last 3 months)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $documents->links() }}
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Pending Documents</h2>
            <p class="text-gray-500">
                There are currently no documents waiting for verification.
            </p>
        </div>
    @endif
</div>
@endsection
