@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Reviews</h1>
        <a href="{{ route('tenant.profile') }}" class="text-blue-600 hover:text-blue-800">
            Back to Profile
        </a>
    </div>
    
    <!-- Review Stats -->
    @if($reviews->count() > 0)
        @php
            $averageRating = $reviews->avg('rating');
            $ratingCounts = [
                1 => $reviews->where('rating', 1)->count(),
                2 => $reviews->where('rating', 2)->count(),
                3 => $reviews->where('rating', 3)->count(),
                4 => $reviews->where('rating', 4)->count(),
                5 => $reviews->where('rating', 5)->count(),
            ];
        @endphp
        
        <div class="bg-gray-50 p-6 rounded-lg mb-6">
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="flex flex-col items-center mb-4 md:mb-0 md:mr-8">
                    <div class="text-5xl font-bold text-blue-600">
                        {{ number_format($averageRating, 1) }}
                    </div>
                    <div class="flex items-center mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($averageRating))
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
                    <div class="text-sm text-gray-500 mt-1">
                        Based on {{ $reviews->count() }} {{ Str::plural('review', $reviews->count()) }}
                    </div>
                </div>
                
                <div class="flex-grow">
                    @for($i = 5; $i >= 1; $i--)
                        <div class="flex items-center mb-1">
                            <div class="text-sm w-10 text-gray-600">{{ $i }} star</div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mx-2">
                                @php 
                                    $percentage = $reviews->count() > 0 ? ($ratingCounts[$i] / $reviews->count()) * 100 : 0;
                                @endphp
                                <div class="bg-yellow-400 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="text-sm w-10 text-gray-600">{{ $ratingCounts[$i] }}</div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    @endif
    
    <!-- Reviews List -->
    @if($reviews->count() > 0)
        <div class="space-y-6">
            @foreach($reviews as $review)
                <div class="border rounded-lg p-6">
                    <div class="flex justify-between items-start mb-4">
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
                            
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $review->created_at->format('M d, Y') }}
                            </p>
                        </div>
                        
                        @if($review->status !== 'disputed')
                            <button type="button" class="text-sm text-blue-600 hover:text-blue-800" onclick="document.getElementById('dispute-modal-{{ $review->id }}').classList.remove('hidden')">
                                Dispute Review
                            </button>
                        @else
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                Disputed
                            </span>
                        @endif
                    </div>
                    
                    <h3 class="font-medium mb-1">
                        Review by {{ $review->reviewer->name }} ({{ ucfirst($review->reviewer->role) }})
                    </h3>
                    <p class="text-sm text-gray-600 mb-2">
                        For property: {{ $review->property->name }} ({{ $review->property->city }}, {{ $review->property->state }})
                    </p>
                    <p class="text-gray-700">
                        {{ $review->comment }}
                    </p>
                    
                    <!-- Dispute Modal -->
                    <div id="dispute-modal-{{ $review->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50" x-cloak>
                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                            <h3 class="text-lg font-bold mb-4">Dispute Review</h3>
                            <p class="text-gray-600 mb-4">
                                Please explain why you believe this review is inaccurate or unfair.
                            </p>
                            
                            <form method="POST" action="{{ route('tenant.review.dispute', $review) }}">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="dispute_reason" class="block text-gray-700 text-sm font-bold mb-2">Reason for Dispute</label>
                                    <textarea id="dispute_reason" name="dispute_reason" rows="3" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                                </div>
                                
                                <div class="flex justify-end">
                                    <button type="button" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300" onclick="document.getElementById('dispute-modal-{{ $review->id }}').classList.add('hidden')">
                                        Cancel
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Submit Dispute
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Reviews Yet</h2>
            <p class="text-gray-500">
                You haven't received any reviews yet. Reviews will appear here once landlords or agents leave them.
            </p>
        </div>
    @endif
</div>
@endsection
