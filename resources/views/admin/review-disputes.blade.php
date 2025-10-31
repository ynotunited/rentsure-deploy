@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Review Disputes</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <form method="GET" action="{{ route('admin.reviews.disputes') }}" class="flex flex-wrap gap-4 items-end">
        <div>
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Filter by Status</label>
            <select id="status" name="status" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="dismissed" {{ request('status') == 'dismissed' ? 'selected' : '' }}>Dismissed</option>
            </select>
        </div>
        
        <div>
            <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Search</label>
            <input type="text" id="search" name="search" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Tenant or landlord name" value="{{ request('search') }}">
        </div>
        
        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Filter
            </button>
            
            @if(request()->hasAny(['status', 'search']))
                <a href="{{ route('admin.reviews.disputes') }}" class="ml-2 text-gray-600 hover:text-gray-800">
                    Clear Filters
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Disputes List -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Review Disputes ({{ $disputes->total() }})</h2>
    
    @if($disputes->count() > 0)
        <div class="space-y-6">
            @foreach($disputes as $dispute)
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-50 p-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium">Dispute #{{ $dispute->id }}</h3>
                                    <p class="text-sm text-gray-600">
                                        @if($dispute->status === 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @elseif($dispute->status === 'resolved')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Resolved
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Dismissed
                                            </span>
                                        @endif
                                        <span class="ml-2">Submitted {{ $dispute->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium mb-2">Disputed Review</h4>
                            <div class="bg-gray-50 p-4 rounded mb-4">
                                <div class="flex items-center mb-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                            <span class="text-lg font-bold text-blue-600">{{ substr($dispute->review->reviewer->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $dispute->review->reviewer->name }}</p>
                                            <p class="text-sm text-gray-500">
                                                @if($dispute->review->reviewer->role === 'landlord')
                                                    Landlord
                                                @elseif($dispute->review->reviewer->role === 'agent')
                                                    Agent
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center mb-2">
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $dispute->review->rating)
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
                                        {{ $dispute->review->rating }}/5
                                    </span>
                                </div>
                                
                                <div class="mt-2">
                                    <p class="text-gray-700">{{ $dispute->review->comment }}</p>
                                </div>
                                
                                <div class="mt-3 text-sm text-gray-500">
                                    <p>Posted on {{ $dispute->review->created_at->format('M d, Y') }}</p>
                                    <p class="mt-1">Property: {{ $dispute->review->property->name }}</p>
                                </div>
                            </div>
                            
                            <h4 class="font-medium mb-2">Dispute Reason</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <div class="flex items-center mb-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                            <span class="text-lg font-bold text-green-600">{{ substr($dispute->tenant->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $dispute->tenant->name }}</p>
                                            <p class="text-sm text-gray-500">Tenant</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-2">
                                    <p class="text-gray-700">{{ $dispute->reason }}</p>
                                </div>
                                
                                @if($dispute->evidence)
                                    <div class="mt-3">
                                        <p class="font-medium text-gray-700">Supporting Evidence:</p>
                                        <p class="text-gray-700">{{ $dispute->evidence }}</p>
                                    </div>
                                @endif
                                
                                <div class="mt-3 text-sm text-gray-500">
                                    <p>Submitted on {{ $dispute->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            @if($dispute->status === 'pending')
                                <h4 class="font-medium mb-2">Resolution</h4>
                                <div class="bg-gray-50 p-4 rounded">
                                    <form method="POST" action="{{ route('admin.dispute.resolve', $dispute) }}">
                                        @csrf
                                        
                                        <div class="mb-4">
                                            <label for="decision-{{ $dispute->id }}" class="block text-gray-700 text-sm font-bold mb-2">Decision</label>
                                            <select id="decision-{{ $dispute->id }}" name="decision" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                <option value="" selected disabled>Select a decision</option>
                                                <option value="remove">Remove Review</option>
                                                <option value="modify">Modify Review</option>
                                                <option value="keep">Keep Review (Dismiss Dispute)</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-4 hidden" id="modify-section-{{ $dispute->id }}">
                                            <label for="modified_rating-{{ $dispute->id }}" class="block text-gray-700 text-sm font-bold mb-2">Modified Rating</label>
                                            <div class="flex items-center">
                                                <div class="rating-input">
                                                    @for($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="rating-{{ $dispute->id }}-{{ $i }}" name="modified_rating" value="{{ $i }}" class="hidden">
                                                        <label for="rating-{{ $dispute->id }}-{{ $i }}" class="text-2xl cursor-pointer">★</label>
                                                    @endfor
                                                </div>
                                            </div>
                                            
                                            <label for="modified_comment-{{ $dispute->id }}" class="block text-gray-700 text-sm font-bold mt-4 mb-2">Modified Comment</label>
                                            <textarea id="modified_comment-{{ $dispute->id }}" name="modified_comment" rows="3" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $dispute->review->comment }}</textarea>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="notes-{{ $dispute->id }}" class="block text-gray-700 text-sm font-bold mb-2">Resolution Notes</label>
                                            <textarea id="notes-{{ $dispute->id }}" name="notes" rows="3" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required placeholder="Explain your decision here..."></textarea>
                                        </div>
                                        
                                        <div class="flex justify-end">
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                Submit Decision
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mt-4" role="alert">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm">
                                                <strong>Guidelines for Dispute Resolution:</strong>
                                            </p>
                                            <ul class="list-disc pl-5 mt-1 text-sm space-y-1">
                                                <li>Remove reviews that are clearly false, abusive, or violate platform policies</li>
                                                <li>Modify reviews that contain some inaccuracies but are otherwise valid</li>
                                                <li>Keep reviews that are truthful and factual, even if unfavorable</li>
                                                <li>Always provide clear reasoning for your decision</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h4 class="font-medium mb-2">Resolution Details</h4>
                                <div class="bg-gray-50 p-4 rounded">
                                    <div class="mb-3">
                                        <span class="font-medium text-gray-700">Decision:</span>
                                        <span class="ml-2">
                                            @if($dispute->resolution === 'remove')
                                                Review Removed
                                            @elseif($dispute->resolution === 'modify')
                                                Review Modified
                                            @else
                                                Review Kept (Dispute Dismissed)
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <span class="font-medium text-gray-700">Resolution Notes:</span>
                                        <p class="mt-1 text-gray-700">{{ $dispute->resolution_notes }}</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <span class="font-medium text-gray-700">Resolved By:</span>
                                        <span class="ml-2">{{ $dispute->resolvedBy->name }}</span>
                                    </div>
                                    
                                    <div>
                                        <span class="font-medium text-gray-700">Resolved On:</span>
                                        <span class="ml-2">{{ $dispute->resolved_at->format('M d, Y') }}</span>
                                    </div>
                                    
                                    @if($dispute->resolution === 'modify')
                                        <div class="mt-4 p-3 border border-gray-300 rounded">
                                            <p class="font-medium text-gray-700 mb-2">Modified Review:</p>
                                            
                                            <div class="flex items-center mb-2">
                                                <div class="flex">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $dispute->modified_rating)
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
                                                    {{ $dispute->modified_rating }}/5
                                                </span>
                                            </div>
                                            
                                            <p class="text-gray-700">{{ $dispute->modified_comment }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $disputes->links() }}
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Review Disputes</h2>
            <p class="text-gray-500">
                @if(request()->hasAny(['status', 'search']))
                    No disputes match your filter criteria.
                @else
                    There are currently no review disputes pending resolution.
                @endif
            </p>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($disputes as $dispute)
            if (document.getElementById('decision-{{ $dispute->id }}')) {
                document.getElementById('decision-{{ $dispute->id }}').addEventListener('change', function(e) {
                    if (e.target.value === 'modify') {
                        document.getElementById('modify-section-{{ $dispute->id }}').classList.remove('hidden');
                    } else {
                        document.getElementById('modify-section-{{ $dispute->id }}').classList.add('hidden');
                    }
                });
            }
        @endforeach
    });
</script>
@endpush

@push('styles')
<style>
    /* Star rating styling */
    .rating-input label {
        color: #cbd5e0;
        transition: 0.2s ease-in-out;
    }
    
    .rating-input label:hover,
    .rating-input label:hover ~ label,
    .rating-input input:checked ~ label {
        color: #ecc94b;
    }
    
    .rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-start;
    }
</style>
@endpush
@endsection
