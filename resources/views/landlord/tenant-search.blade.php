@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Find Tenants</h1>
        <div>
            <a href="{{ route('landlord.tenants') }}" class="text-blue-600 hover:text-blue-800">
                Back to My Tenants
            </a>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-md">
    <form method="GET" action="{{ route('landlord.tenant.search') }}" class="mb-8">
        <div class="flex">
            <div class="flex-1 mr-4">
                <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Search for tenants by name, phone or NIN</label>
                <input id="search" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="search" value="{{ $search ?? '' }}" required>
                <p class="mt-1 text-sm text-gray-500">Only verified tenants will appear in search results</p>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Search
                </button>
            </div>
        </div>
    </form>
    
    @if(isset($tenants))
        <h2 class="text-xl font-bold mb-4">Search Results</h2>
        
        @if($tenants->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tenants as $tenant)
                    <div class="border rounded-lg overflow-hidden">
                        <div class="bg-gray-50 p-4">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                    <span class="text-xl font-bold text-blue-600">{{ substr($tenant->name, 0, 1) }}</span>
                                    @if($tenant->verification_badge)
                                        <span class="absolute -bottom-1 -right-1 h-5 w-5 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-bold">{{ $tenant->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        @if($tenant->verification_badge)
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Verified Tenant
                                            </span>
                                        @else
                                            Verified User
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <p class="text-sm mb-2">
                                <span class="font-medium">Email:</span> {{ $tenant->email }}
                            </p>
                            
                            @if($tenant->phone_number)
                                <p class="text-sm mb-2">
                                    <span class="font-medium">Phone:</span> {{ $tenant->phone_number }}
                                </p>
                            @endif
                            
                            <!-- Check if tenant has any reviews -->
                            @php
                                $reviews = $tenant->receivedReviews()->where('public', true)->get();
                                $reviewCount = $reviews->count();
                                $avgRating = $reviewCount > 0 ? round($reviews->avg('rating'), 1) : 0;
                            @endphp
                            
                            <div class="mt-4">
                                <div class="flex items-center mb-1">
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $avgRating)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-600 ml-1">
                                        @if($reviewCount > 0)
                                            {{ $avgRating }} ({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})
                                        @else
                                            No reviews yet
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 border-t">
                            <button type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="document.getElementById('add-tenant-modal-{{ $tenant->id }}').classList.remove('hidden')">
                                Add to Property
                            </button>
                            
                            <!-- Add Tenant Modal -->
                            <div id="add-tenant-modal-{{ $tenant->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                    <h3 class="text-lg font-bold mb-4">Add {{ $tenant->name }} to a Property</h3>
                                    
                                    @php
                                        $properties = Auth::user()->properties;
                                    @endphp
                                    
                                    @if($properties->count() > 0)
                                        <form method="POST" action="{{ route('landlord.tenant.add', ['tenant' => $tenant->id, 'property' => '__property_id__']) }}" id="add-tenant-form-{{ $tenant->id }}">
                                            @csrf
                                            
                                            <div class="mb-4">
                                                <label for="property-{{ $tenant->id }}" class="block text-gray-700 text-sm font-bold mb-2">Select Property</label>
                                                <select id="property-{{ $tenant->id }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required
                                                        onchange="document.getElementById('add-tenant-form-{{ $tenant->id }}').action = document.getElementById('add-tenant-form-{{ $tenant->id }}').action.replace('__property_id__', this.value);">
                                                    <option value="" disabled selected>Choose a property</option>
                                                    @foreach($properties as $property)
                                                        <option value="{{ $property->id }}">{{ $property->name }} - {{ $property->city }}, {{ $property->state }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <label for="start_date-{{ $tenant->id }}" class="block text-gray-700 text-sm font-bold mb-2">Lease Start Date</label>
                                                <input type="date" id="start_date-{{ $tenant->id }}" name="start_date" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <label for="end_date-{{ $tenant->id }}" class="block text-gray-700 text-sm font-bold mb-2">Lease End Date (Optional)</label>
                                                <input type="date" id="end_date-{{ $tenant->id }}" name="end_date" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            </div>
                                            
                                            <div class="flex justify-end">
                                                <button type="button" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                                                        onclick="document.getElementById('add-tenant-modal-{{ $tenant->id }}').classList.add('hidden')">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                    Add Tenant
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="bg-yellow-50 p-4 rounded-md mb-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-yellow-800">No Properties Available</h3>
                                                    <div class="mt-2 text-sm text-yellow-700">
                                                        <p>You need to add a property before you can add tenants.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <a href="{{ route('landlord.property.create') }}" class="text-sm font-medium text-yellow-800 hover:text-yellow-900">
                                                    Add a Property
                                                    <span aria-hidden="true"> &rarr;</span>
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-end">
                                            <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                                                    onclick="document.getElementById('add-tenant-modal-{{ $tenant->id }}').classList.add('hidden')">
                                                Close
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $tenants->links() }}
            </div>
        @else
            <div class="bg-gray-50 p-8 rounded-lg text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h2 class="text-xl font-medium text-gray-600 mb-2">No Tenants Found</h2>
                <p class="text-gray-500">
                    No verified tenants match your search criteria. Try different search terms or check back later.
                </p>
            </div>
        @endif
    @endif
</div>
@endsection
