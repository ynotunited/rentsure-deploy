@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gray-300 h-64 flex items-center justify-center">
            <svg class="w-24 h-24 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
        </div>
        
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $property->name }}</h1>
            
            <div class="flex flex-wrap mb-6">
                <div class="w-full md:w-1/2 mb-4 md:mb-0">
                    <p class="text-gray-600"><span class="font-semibold">Address:</span> {{ $property->address }}</p>
                    <p class="text-gray-600"><span class="font-semibold">Location:</span> {{ $property->city }}, {{ $property->state }}</p>
                    <p class="text-gray-600"><span class="font-semibold">Type:</span> {{ $property->property_type }}</p>
                </div>
                
                <div class="w-full md:w-1/2">
                    <p class="text-gray-600"><span class="font-semibold">Listed by:</span> {{ $property->landlord->name }}</p>
                    <p class="text-gray-600"><span class="font-semibold">Listed on:</span> {{ $property->created_at->format('M d, Y') }}</p>
                </div>
            </div>
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Description</h2>
                <p class="text-gray-600">{{ $property->description }}</p>
            </div>
            
            <div class="flex flex-wrap items-center justify-between">
                <a href="{{ route('properties.index') }}" class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition-colors">Back to Listings</a>
                
                @auth
                    @if(auth()->user()->role === 'tenant')
                        <button class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">Contact Landlord</button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">Login to Contact</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection