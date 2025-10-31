@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Tenant Reviews</h1>
        <div>
            <a href="{{ route('landlord.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">All Reviews</h2>
            
            <div class="flex items-center">
                <form method="GET" action="{{ route('landlord.reviews') }}" class="flex space-x-2">
                    <select name="property" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">All Properties</option>
                        @foreach($landlord->properties as $property)
                            <option value="{{ $property->id }}" {{ request('property') == $property->id ? 'selected' : '' }}>
                                {{ $property->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <select name="status" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">All Statuses</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="disputed" {{ request('status') == 'disputed' ? 'selected' : '' }}>Disputed</option>
                    </select>
                    
                    <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                        Filter
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    @if($reviews->count() > 0)
        <div class="space-y-6">
            @foreach($reviews as $review)
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-50 p-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                    <span class="text-lg font-bold text-blue-600">{{ substr($review->tenant->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $review->tenant->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        Tenant at {{ $review->property->name }}
                                    </p>
                                </div>
                            </div>
                            
                            <div>
                                @if($review->status === 'approved')
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Approved
                                    </span>
                                @elseif($review->status === 'disputed')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Disputed
                                    </span>
                                @elseif($review->status === 'pending_approval')
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Pending Approval
                                    </span>
                                @elseif($review->status === 'rejected')
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Rejected
                                    </span>
                                @endif
                                
                                @if($review->public)
                                    <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Public
                                    </span>
                                @else
                                    <span class="ml-2 bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Private
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="mb-4">
                            <div class="flex items-center mb-2">
                                <div class="flex">
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
                                <span class="ml-2 text-sm text-gray-600">
                                    {{ $review->rating }}/5
                                </span>
                            </div>
                            
                            <div class="text-gray-700">{{ $review->comment }}</div>
                            
                            <div class="mt-2 text-sm text-gray-600">
                                @if($review->reviewer_id !== $landlord->id)
                                    Review by Agent: {{ $review->reviewer->name }} |
                                @endif
                                {{ $review->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-2">
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
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $reviews->links() }}
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Reviews Found</h2>
            <p class="text-gray-500">
                You haven't written any tenant reviews yet. Reviews will appear here once you write them.
            </p>
        </div>
    @endif
</div>

<!-- Tips for Writing Reviews -->
<div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mt-6" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm">
                <strong>Tips for writing helpful tenant reviews:</strong> Be honest, objective, and specific. Mention both positive and negative aspects of the tenancy. Avoid personal attacks and focus on behaviors that are relevant to being a tenant, such as payment history, property care, and following lease terms.
            </p>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Star rating styling */
    .edit-rating-input label {
        color: #cbd5e0;
        transition: 0.2s ease-in-out;
        cursor: pointer;
    }
    
    .edit-rating-input label:hover,
    .edit-rating-input label:hover ~ label,
    .edit-rating-input input:checked ~ label {
        color: #ecc94b;
    }
    
    .edit-rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
</style>
@endpush
@endsection
