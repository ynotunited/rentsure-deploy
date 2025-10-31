@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">{{ $property->name }} - Tenants</h1>
            <p class="text-gray-600">{{ $property->address }}, {{ $property->city }}, {{ $property->state }}</p>
        </div>
        <div>
            <a href="{{ route('agent.properties') }}" class="text-blue-600 hover:text-blue-800">
                Back to Properties
            </a>
        </div>
    </div>
</div>

<!-- Property Owner Info -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <div class="flex items-center">
        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
            <span class="text-xl font-bold text-blue-600">{{ substr($property->landlord->name, 0, 1) }}</span>
        </div>
        <div>
            <h3 class="font-bold text-gray-900">Owner: {{ $property->landlord->name }}</h3>
            <p class="text-sm text-gray-600">{{ $property->landlord->email }}</p>
        </div>
    </div>
</div>

<!-- Add Tenant Section -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-xl font-bold mb-4">Add New Tenant</h2>
    <p class="text-gray-600 mb-4">
        Search for verified tenants to add to this property.
    </p>
    
    <a href="{{ route('agent.tenant.search') }}?property_id={{ $property->id }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Search for Tenants
    </a>
</div>

<!-- Tenants List -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Current Tenants</h2>
    
    @if($tenants->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tenant
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lease Period
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
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
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-green-600">{{ substr($tenant->name, 0, 1) }}</span>
                                            @if($tenant->verification_badge)
                                                <span class="absolute -bottom-1 -right-1 h-5 w-5 bg-green-500 rounded-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $tenant->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $tenant->email }}</div>
                                @if($tenant->phone_number)
                                    <div class="text-sm text-gray-500">{{ $tenant->phone_number }}</div>
                                @endif
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
                                @if($tenant->pivot->active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button type="button" class="text-blue-600 hover:text-blue-800"
                                        onclick="document.getElementById('review-modal-{{ $tenant->id }}').classList.remove('hidden')">
                                    Submit Review
                                </button>
                                
                                <!-- Review Modal -->
                                <div id="review-modal-{{ $tenant->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                        <h3 class="text-lg font-bold mb-4">Review Tenant: {{ $tenant->name }}</h3>
                                        
                                        <form method="POST" action="{{ route('agent.review.store', $tenant) }}">
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
                                            
                                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                                                <div class="flex">
                                                    <div class="flex-shrink-0">
                                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm text-yellow-700">
                                                            Your review will be sent to the landlord for approval before being published.
                                                        </p>
                                                    </div>
                                                </div>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Tenants Found</h2>
            <p class="text-gray-500 mb-6">
                There are no active tenants for this property yet.
            </p>
            <a href="{{ route('agent.tenant.search') }}?property_id={{ $property->id }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add First Tenant
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
