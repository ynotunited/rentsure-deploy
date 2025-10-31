@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Pending Reviews</h1>
        <div>
            <a href="{{ route('agent.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Reviews Navigation -->
<div class="mb-6 border-b border-gray-200">
    <nav class="flex -mb-px">
        <a href="{{ route('agent.reviews') }}" class="border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 font-medium text-sm text-gray-500">
            All Reviews
        </a>
        
        <a href="{{ route('agent.reviews.pending') }}" class="border-b-2 border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 font-medium text-sm ml-8">
            Pending
            @if($pendingReviews->count() > 0)
                <span class="ml-1 bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $pendingReviews->count() }}
                </span>
            @endif
        </a>
        
        <a href="{{ route('agent.reviews.rejected') }}" class="border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 font-medium text-sm text-gray-500 ml-8">
            Rejected
            @if($agent->writtenReviews()->where('status', 'rejected')->count() > 0)
                <span class="ml-1 bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $agent->writtenReviews()->where('status', 'rejected')->count() }}
                </span>
            @endif
        </a>
    </nav>
</div>

<!-- Pending Reviews List -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Reviews Awaiting Landlord Approval</h2>
    
    @if($pendingReviews->count() > 0)
        <div class="space-y-6">
            @foreach($pendingReviews as $review)
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-50 p-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <span class="text-lg font-bold text-green-600">{{ substr($review->tenant->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $review->tenant->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        Tenant at {{ $review->property->name }}
                                    </p>
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
                                Submitted: {{ $review->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        
                        <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        This review is awaiting approval from <strong>{{ $review->landlord->name }}</strong> before it becomes public.
                                    </p>
                                </div>
                            </div>
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
                You don't have any reviews waiting for landlord approval.
            </p>
        </div>
    @endif
</div>

<!-- Info Box -->
<div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mt-6" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm">
                <strong>About Pending Reviews:</strong> When you submit a tenant review, it requires approval from the landlord before becoming public. You'll be notified once the landlord takes action on your review.
            </p>
        </div>
    </div>
</div>
@endsection
