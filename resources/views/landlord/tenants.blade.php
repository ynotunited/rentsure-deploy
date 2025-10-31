@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">My Tenants</h1>
        <div>
            <a href="{{ route('landlord.tenant.search') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Search for Tenants
            </a>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">All Active Tenants</h2>
            
            <div class="relative">
                <form method="GET" action="{{ route('landlord.tenants') }}">
                    <input type="text" name="search" placeholder="Search by name" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <button type="submit" class="absolute right-0 top-0 mt-2 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    @if(count($tenants) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tenant
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Property
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lease Period
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Verification
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tenants as $tenant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-blue-600">{{ substr($tenant->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $tenant->name }}
                                            @if($tenant->verification_badge)
                                                <span class="ml-1 inline-flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $tenant->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $tenant->property_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $startDate = \Carbon\Carbon::parse($tenant->pivot->start_date);
                                    $endDate = $tenant->pivot->end_date ? \Carbon\Carbon::parse($tenant->pivot->end_date) : null;
                                @endphp
                                <div class="text-sm text-gray-900">
                                    {{ $startDate->format('M d, Y') }} - 
                                    @if($endDate)
                                        {{ $endDate->format('M d, Y') }}
                                    @else
                                        Present
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500">
                                    @if($endDate)
                                        {{ $startDate->diffInMonths($endDate) }} months
                                    @else
                                        {{ $startDate->diffInMonths(now()) }} months so far
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($tenant->verified)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Verified
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Not Verified
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button type="button" class="text-blue-600 hover:text-blue-800 mr-3"
                                        onclick="document.getElementById('review-modal-{{ $tenant->id }}').classList.remove('hidden')">
                                    Review
                                </button>
                                <form method="POST" action="{{ route('landlord.tenant.remove', ['tenant' => $tenant->id, 'property' => $tenant->property_id]) }}" 
                                      class="inline-block" onsubmit="return confirm('Are you sure you want to remove this tenant from the property?');">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        Remove
                                    </button>
                                </form>
                                
                                <!-- Review Modal -->
                                <div id="review-modal-{{ $tenant->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                        <h3 class="text-lg font-bold mb-4">Review Tenant: {{ $tenant->name }}</h3>
                                        
                                        <form method="POST" action="{{ route('landlord.review.store', $tenant) }}">
                                            @csrf
                                            <input type="hidden" name="property_id" value="{{ $tenant->property_id }}">
                                            
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Tenants Found</h2>
            <p class="text-gray-500 mb-6">
                You don't have any active tenants across your properties yet.
            </p>
            <a href="{{ route('landlord.tenant.search') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Search for Tenants
            </a>
        </div>
    @endif
</div>

@push('styles')
<style>
    /* Star rating styling */
    .rating-input label {
        color: #cbd5e0;
        transition: 0.2s ease-in-out;
        cursor: pointer;
    }
    
    .rating-input label:hover,
    .rating-input label:hover ~ label,
    .rating-input input:checked ~ label {
        color: #ecc94b;
    }
    
    .rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
</style>
@endpush
@endsection
