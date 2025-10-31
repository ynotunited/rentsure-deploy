@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Tenant Reviews</h1>
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
        <a href="{{ route('agent.reviews') }}" class="border-b-2 border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 font-medium text-sm">
            All Reviews
        </a>
        
        <a href="{{ route('agent.reviews.pending') }}" class="border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 font-medium text-sm text-gray-500 ml-8">
            Pending
            @if($agent->writtenReviews()->where('status', 'pending_approval')->count() > 0)
                <span class="ml-1 bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $agent->writtenReviews()->where('status', 'pending_approval')->count() }}
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

<!-- Filter Form -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <form method="GET" action="{{ route('agent.reviews') }}" class="flex flex-wrap items-end gap-4">
        <div>
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Filter by Status</label>
            <select id="status" name="status" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline min-w-[200px]">
                <option value="">All Statuses</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="pending_approval" {{ request('status') == 'pending_approval' ? 'selected' : '' }}>Pending Approval</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="disputed" {{ request('status') == 'disputed' ? 'selected' : '' }}>Disputed</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Filter
        </button>
        
        @if(request()->has('status'))
            <a href="{{ route('agent.reviews') }}" class="text-gray-600 hover:text-gray-800 py-2">
                Clear Filters
            </a>
        @endif
    </form>
</div>

<!-- Reviews List -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">All My Reviews</h2>
    
    @if($reviews->count() > 0)
        <div class="space-y-6">
            @foreach($reviews as $review)
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-50 p-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <span class="text-lg font-bold text-green-600">{{ substr($review->tenant->name, 0, 1) }}</span>
                                    @if($review->tenant->verification_badge)
                                        <span class="absolute -bottom-1 -right-1 h-5 w-5 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @endif
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
                                @elseif($review->status === 'pending_approval')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Pending Approval
                                    </span>
                                @elseif($review->status === 'rejected')
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Rejected
                                    </span>
                                @elseif($review->status === 'disputed')
                                    <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Disputed
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
                                Submitted: {{ $review->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        
                        @if($review->status === 'rejected')
                            <div class="mt-4 bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">
                                            This review was rejected by the landlord. It remains private in your dashboard.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        @if($review->status === 'pending_approval')
                            <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            This review is awaiting approval from the landlord before it becomes public.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
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
                @if(request('status'))
                    You don't have any reviews with the selected status.
                @else
                    You haven't submitted any tenant reviews yet.
                @endif
            </p>
        </div>
    @endif
</div>
@endsection
