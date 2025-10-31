@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">My Landlords</h1>
        <div>
            <a href="{{ route('agent.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Pending Requests Section -->
@if($pendingLandlords->count() > 0)
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-bold mb-4">Pending Verification Requests</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Requested On
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pendingLandlords as $landlord)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-blue-600">{{ substr($landlord->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $landlord->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $landlord->email }}</div>
                                @if($landlord->phone_number)
                                    <div class="text-sm text-gray-500">{{ $landlord->phone_number }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $landlord->pivot->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 bg-yellow-50 p-4 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Waiting for landlord verification</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>These landlords need to verify your connection request before you can manage their properties.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Connect with Landlord Form -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-xl font-bold mb-4">Connect with a Landlord</h2>
    
    <form id="landlord-search-form" method="GET" action="{{ route('agent.landlords') }}" class="mb-6">
        <div class="flex">
            <div class="flex-1 mr-2">
                <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Search by email</label>
                <input id="search" type="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="search" value="{{ request('search') }}" placeholder="landlord@example.com">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Search
                </button>
            </div>
        </div>
    </form>
    
    @if(request()->has('search') && !empty(request('search')))
        @php
            // This would normally be handled in the controller, but here's a simulation
            $searchResult = \App\Models\User::where('email', request('search'))
                ->where('role', 'landlord')
                ->first();
        @endphp
        
        @if($searchResult)
            <div class="border rounded-lg p-4 mb-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                            <span class="text-lg font-bold text-blue-600">{{ substr($searchResult->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="font-medium">{{ $searchResult->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $searchResult->email }}</p>
                        </div>
                    </div>
                    
                    @php
                        $alreadyConnected = $agent->landlords->contains($searchResult->id);
                    @endphp
                    
                    @if($alreadyConnected)
                        <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded">
                            Already Connected
                        </span>
                    @else
                        <form method="POST" action="{{ route('agent.landlord.request', $searchResult) }}">
                            @csrf
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-1 px-3 rounded text-sm">
                                Send Request
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-gray-50 p-4 rounded-md mb-6">
                <p class="text-gray-700">No landlord found with email "{{ request('search') }}"</p>
            </div>
        @endif
    @endif
    
    <div class="bg-blue-50 p-4 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">How to connect with landlords</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p>You need to know the landlord's email address to send a connection request. Once they verify your request, you'll be able to manage their properties and tenants.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Verified Landlords Section -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">My Verified Landlords</h2>
    
    @if($verifiedLandlords->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Properties
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Connected Since
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($verifiedLandlords as $landlord)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-blue-600">{{ substr($landlord->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $landlord->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $landlord->email }}</div>
                                @if($landlord->phone_number)
                                    <div class="text-sm text-gray-500">{{ $landlord->phone_number }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $propertyCount = $landlord->properties->count();
                                @endphp
                                <div class="text-sm text-gray-900">{{ $propertyCount }} {{ Str::plural('property', $propertyCount) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $landlord->pivot->updated_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('agent.properties') }}?landlord_id={{ $landlord->id }}" class="text-blue-600 hover:text-blue-900">
                                    View Properties
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Verified Landlords Yet</h2>
            <p class="text-gray-500">
                You don't have any verified landlord connections yet. Use the form above to search for landlords and send connection requests.
            </p>
        </div>
    @endif
</div>
@endsection
