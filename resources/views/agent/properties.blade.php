@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Properties</h1>
        <div>
            <a href="{{ route('agent.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Filter Form -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <form method="GET" action="{{ route('agent.properties') }}" class="flex flex-wrap items-end gap-4">
        <div>
            <label for="landlord_id" class="block text-gray-700 text-sm font-bold mb-2">Filter by Landlord</label>
            <select id="landlord_id" name="landlord_id" class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline min-w-[200px]">
                <option value="">All Landlords</option>
                @foreach($agent->landlords()->wherePivot('verified', true)->get() as $landlord)
                    <option value="{{ $landlord->id }}" {{ request('landlord_id') == $landlord->id ? 'selected' : '' }}>
                        {{ $landlord->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Filter
        </button>
        
        @if(request()->has('landlord_id') || request()->has('search'))
            <a href="{{ route('agent.properties') }}" class="text-gray-600 hover:text-gray-800 py-2">
                Clear Filters
            </a>
        @endif
    </form>
</div>

<!-- Properties List -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Available Properties</h2>
    
    @if($properties->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($properties as $property)
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-blue-600 py-4 px-6 text-white">
                        <h3 class="text-lg font-bold">{{ $property->name }}</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-4">
                            <p class="text-gray-600 mb-1">
                                <span class="font-medium">Address:</span> {{ $property->address }}
                            </p>
                            <p class="text-gray-600 mb-1">
                                <span class="font-medium">Location:</span> {{ $property->city }}, {{ $property->state }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Type:</span> {{ $property->property_type }}
                            </p>
                        </div>
                        
                        <div class="mb-4">
                            <div class="flex items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="text-gray-700">{{ $property->activeTenants()->count() }} active {{ Str::plural('tenant', $property->activeTenants()->count()) }}</span>
                            </div>
                            
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="text-gray-700">Owner: {{ $property->landlord->name }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <a href="{{ route('agent.property.tenants', $property) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-2 px-4 rounded">
                                Manage Tenants
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $properties->links() }}
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Properties Available</h2>
            <p class="text-gray-500 mb-6">
                @if(request('landlord_id'))
                    This landlord hasn't added any properties yet.
                @else
                    You don't have access to any properties yet. Make sure you're connected with landlords who have properties.
                @endif
            </p>
            <a href="{{ route('agent.landlords') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Manage Landlord Connections
            </a>
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
                <strong>About Property Management:</strong> As an agent, you can manage tenants for properties owned by landlords who have verified you. You can add tenants to properties and submit reviews, which the landlord will need to approve.
            </p>
        </div>
    </div>
</div>
@endsection
