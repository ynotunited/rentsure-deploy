@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Agent Reviews</h1>
        <div>
            <a href="{{ route('landlord.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Pending Agent Review Approvals</h2>
    
    @if($pendingReviews->count() > 0)
        <div class="space-y-6">
            @foreach($pendingReviews as $review)
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-50 p-4">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                    <span class="text-lg font-bold text-purple-600">{{ substr($review->reviewer->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $review->reviewer->name }}</h3>
                                    <p class="text-sm text-gray-600">Agent</p>
                                </div>
                            </div>
                            <div>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Pending Approval
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="mb-4">
                            <h3 class="font-medium">Review for {{ $review->tenant->name }}</h3>
                            <p class="text-sm text-gray-600 mb-1">
                                Property: {{ $review->property->name }} ({{ $review->property->city }}, {{ $review->property->state }})
                            </p>
                            <p class="text-sm text-gray-600">
                                Submitted on {{ $review->created_at->format('M d, Y') }}
                            </p>
                        </div>
                        
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
                            
                            <div class="bg-gray-50 p-4 rounded-md">
                                <p class="text-gray-700">{{ $review->comment }}</p>
                            </div>
                        </div>
                        
                        <div class="flex space-x-2 justify-end">
                            <form method="POST" action="{{ route('landlord.review.reject', $review) }}">
                                @csrf
                                <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 font-medium py-2 px-4 rounded">
                                    Reject Review
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('landlord.review.approve', $review) }}">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                                    Approve & Publish
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $pendingReviews->links() }}
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Pending Reviews</h2>
            <p class="text-gray-500">
                There are no agent reviews waiting for your approval at this time.
            </p>
        </div>
    @endif
</div>
@endsection
