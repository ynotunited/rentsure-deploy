@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Available Properties</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($properties as $property)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-300 h-48 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $property->name }}</h2>
                    <p class="text-gray-600 mb-2">{{ $property->address }}</p>
                    <p class="text-gray-600 mb-2">{{ $property->city }}, {{ $property->state }}</p>
                    <p class="text-gray-600 mb-4">{{ $property->property_type }}</p>
                    <a href="{{ route('properties.show', $property->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">View Details</a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-8">
                <p class="text-gray-600 text-lg">No properties available at the moment.</p>
            </div>
        @endforelse
    </div>
    
    <div class="mt-8">
        {{ $properties->links() }}
    </div>
</div>
@endsection