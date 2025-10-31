@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">{{ $property->name }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('landlord.property.edit', $property) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Property
            </a>
            <a href="{{ route('landlord.properties') }}" class="text-blue-600 hover:text-blue-800 py-2">
                Back to Properties
            </a>
        </div>
    </div>
    <p class="text-gray-600">{{ $property->address }}, {{ $property->city }}, {{ $property->state }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Property Details -->
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-bold mb-4">Property Details</h2>
            
            <ul class="space-y-3">
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <div>
                        <span class="font-medium">Type:</span> {{ $property->property_type }}
                    </div>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div>
                        <span class="font-medium">Active Tenants:</span> {{ $tenants->count() }}
                    </div>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <div>
                        <span class="font-medium">Reviews:</span> {{ $reviews->count() }}
                    </div>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <div>
                        <span class="font-medium">Created on:</span> {{ $property->created_at->format('M d, Y') }}
                    </div>
                </li>
            </ul>

            @if($property->description)
                <div class="mt-4 pt-4 border-t">
                    <h3 class="font-medium mb-2">Description</h3>
                    <p class="text-gray-600">{{ $property->description }}</p>
                </div>
            @endif
        </div>

        <!-- Search Tenants Box -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Add New Tenant</h2>
            <p class="text-sm text-gray-600 mb-4">
                Search for verified tenants and add them to this property.
            </p>
            
            <a href="{{ route('landlord.tenant.search') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-2 px-4 rounded">
                Search for Tenants
            </a>
        </div>
    </div>
    
    <!-- Tenants and Reviews -->
    <div class="lg:col-span-2">
        <!-- Active Tenants -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Active Tenants</h2>
            </div>
            
            @if($tenants->count() > 0)
                <div class="space-y-4">
                    @foreach($tenants as $tenant)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                        <span class="text-lg font-bold text-blue-600">{{ substr($tenant->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium">{{ $tenant->name }}</h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $tenant->pivot->start_date }} to {{ $tenant->pivot->end_date ?? 'Present' }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <button type="button" class="text-blue-600 hover:text-blue-800 mr-2" 
                                            onclick="document.getElementById('review-modal-{{ $tenant->id }}').classList.remove('hidden')">
                                        Leave Review
                                    </button>
                                    
                                    <form method="POST" action="{{ route('landlord.tenant.remove', ['tenant' => $tenant->id, 'property' => $property->id]) }}" 
                                          onsubmit="return confirm('Are you sure you want to remove this tenant from the property?');">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Review Modal -->
                            <div id="review-modal-{{ $tenant->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                    <h3 class="text-lg font-bold mb-4">Review Tenant: {{ $tenant->name }}</h3>
                                    
                                    <form method="POST" action="{{ route('landlord.review.store', $tenant) }}">
                                        @csrf
                                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                                        
                                        <div class="mb-4">
                                            <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
                                            <div class="flex items-center">
                                                <div class="rating-input">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <input type="radio" id="rating-{{ $tenant->id }}-{{ $i }}" name="rating" value="{{ $i }}" class="hidden" required>
                                                        <label for="rating-{{ $tenant->id }}-{{ $i }}" class="text-2xl cursor-pointer">★</label>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="comment-{{ $tenant->id }}" class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
                                            <textarea id="comment-{{ $tenant->id }}" name="comment" rows="3" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                                        </div>
                                        
                                        <div class="flex justify-end">
                                            <button type="button" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                                                    onclick="document.getElementById('review-modal-{{ $tenant->id }}').classList.add('hidden')">
                                                Cancel
                                            </button>
                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                Submit Review
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 p-4 rounded text-gray-500 text-center">
                    No active tenants for this property.
                </div>
            @endif
        </div>
        
        <!-- Previous Tenants -->
        @if($inactiveTenants->count() > 0)
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-bold mb-4">Previous Tenants</h2>
                
                <div class="space-y-4">
                    @foreach($inactiveTenants as $tenant)
                        <div class="border rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                    <span class="text-lg font-bold text-gray-600">{{ substr($tenant->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $tenant->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        {{ $tenant->pivot->start_date }} to {{ $tenant->pivot->end_date ?? 'Unknown' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        
        <!-- Tenant Reviews -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Reviews</h2>
            
            @if($reviews->count() > 0)
                <div class="space-y-6">
                    @foreach($reviews as $review)
                        <div class="border rounded-lg p-4">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</p>
                                </div>
                                
                                <div class="flex space-x-2">
                                    <button type="button" class="text-blue-600 hover:text-blue-800" 
                                            onclick="document.getElementById('edit-review-modal-{{ $review->id }}').classList.remove('hidden')">
                                        Edit
                                    </button>
                                    
                                    <form method="POST" action="{{ route('landlord.review.delete', $review) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <h3 class="font-medium">
                                    Review for {{ $review->tenant->name }}
                                    @if($review->reviewer_id !== $landlord->id)
                                        <span class="text-sm text-gray-500">(by Agent: {{ $review->reviewer->name }})</span>
                                    @endif
                                </h3>
                            </div>
                            
                            <p class="text-gray-700">{{ $review->comment }}</p>
                            
                            @if($review->status === 'disputed')
                                <div class="mt-2">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Tenant has disputed this review
                                    </span>
                                </div>
                            @endif
                            
                            <!-- Edit Review Modal -->
                            <div id="edit-review-modal-{{ $review->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                    <h3 class="text-lg font-bold mb-4">Edit Review for {{ $review->tenant->name }}</h3>
                                    
                                    <form method="POST" action="{{ route('landlord.review.update', $review) }}">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="mb-4">
                                            <label for="edit-rating-{{ $review->id }}" class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
                                            <div class="flex items-center">
                                                <div class="edit-rating-input">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <input type="radio" id="edit-rating-{{ $review->id }}-{{ $i }}" name="rating" value="{{ $i }}" 
                                                               {{ $review->rating == $i ? 'checked' : '' }} class="hidden" required>
                                                        <label for="edit-rating-{{ $review->id }}-{{ $i }}" class="text-2xl cursor-pointer">★</label>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="edit-comment-{{ $review->id }}" class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
                                            <textarea id="edit-comment-{{ $review->id }}" name="comment" rows="3" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $review->comment }}</textarea>
                                        </div>
                                        
                                        <div class="flex justify-end">
                                            <button type="button" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                                                    onclick="document.getElementById('edit-review-modal-{{ $review->id }}').classList.add('hidden')">
                                                Cancel
                                            </button>
                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                Update Review
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 p-4 rounded text-gray-500 text-center">
                    No reviews have been submitted for tenants at this property yet.
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Star rating styling */
    .rating-input label, .edit-rating-input label {
        color: #cbd5e0;
        transition: 0.2s ease-in-out;
        cursor: pointer;
    }
    
    .rating-input label:hover,
    .rating-input label:hover ~ label,
    .rating-input input:checked ~ label,
    .edit-rating-input label:hover,
    .edit-rating-input label:hover ~ label,
    .edit-rating-input input:checked ~ label {
        color: #ecc94b;
    }
    
    .rating-input, .edit-rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
</style>
@endpush
@endsection
