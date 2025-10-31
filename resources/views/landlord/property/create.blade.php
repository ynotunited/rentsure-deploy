@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Add New Property</h1>
    <a href="{{ route('landlord.properties') }}" class="text-blue-600 hover:text-blue-800">
        Back to Properties
    </a>
</div>

<div class="bg-white p-6 rounded-lg shadow-md">
    <form method="POST" action="{{ route('landlord.property.store') }}">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Property Name</label>
                <input id="name" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required>
                
                @error('name')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div>
                <label for="property_type" class="block text-gray-700 text-sm font-bold mb-2">Property Type</label>
                <select id="property_type" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('property_type') border-red-500 @enderror" name="property_type" required>
                    <option value="" disabled {{ old('property_type') ? '' : 'selected' }}>Select property type</option>
                    <option value="Apartment" {{ old('property_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="House" {{ old('property_type') == 'House' ? 'selected' : '' }}>House</option>
                    <option value="Duplex" {{ old('property_type') == 'Duplex' ? 'selected' : '' }}>Duplex</option>
                    <option value="Flat" {{ old('property_type') == 'Flat' ? 'selected' : '' }}>Flat</option>
                    <option value="Bungalow" {{ old('property_type') == 'Bungalow' ? 'selected' : '' }}>Bungalow</option>
                    <option value="Commercial" {{ old('property_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                    <option value="Other" {{ old('property_type') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                
                @error('property_type')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="md:col-span-2">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                <input id="address" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror" name="address" value="{{ old('address') }}" required>
                
                @error('address')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div>
                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                <input id="city" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('city') border-red-500 @enderror" name="city" value="{{ old('city') }}" required>
                
                @error('city')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div>
                <label for="state" class="block text-gray-700 text-sm font-bold mb-2">State</label>
                <select id="state" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('state') border-red-500 @enderror" name="state" required>
                    <option value="" disabled {{ old('state') ? '' : 'selected' }}>Select a state</option>
                    <option value="Abia" {{ old('state') == 'Abia' ? 'selected' : '' }}>Abia</option>
                    <option value="Adamawa" {{ old('state') == 'Adamawa' ? 'selected' : '' }}>Adamawa</option>
                    <option value="Akwa Ibom" {{ old('state') == 'Akwa Ibom' ? 'selected' : '' }}>Akwa Ibom</option>
                    <option value="Anambra" {{ old('state') == 'Anambra' ? 'selected' : '' }}>Anambra</option>
                    <option value="Bauchi" {{ old('state') == 'Bauchi' ? 'selected' : '' }}>Bauchi</option>
                    <option value="Bayelsa" {{ old('state') == 'Bayelsa' ? 'selected' : '' }}>Bayelsa</option>
                    <option value="Benue" {{ old('state') == 'Benue' ? 'selected' : '' }}>Benue</option>
                    <option value="Borno" {{ old('state') == 'Borno' ? 'selected' : '' }}>Borno</option>
                    <option value="Cross River" {{ old('state') == 'Cross River' ? 'selected' : '' }}>Cross River</option>
                    <option value="Delta" {{ old('state') == 'Delta' ? 'selected' : '' }}>Delta</option>
                    <option value="Ebonyi" {{ old('state') == 'Ebonyi' ? 'selected' : '' }}>Ebonyi</option>
                    <option value="Edo" {{ old('state') == 'Edo' ? 'selected' : '' }}>Edo</option>
                    <option value="Ekiti" {{ old('state') == 'Ekiti' ? 'selected' : '' }}>Ekiti</option>
                    <option value="Enugu" {{ old('state') == 'Enugu' ? 'selected' : '' }}>Enugu</option>
                    <option value="FCT" {{ old('state') == 'FCT' ? 'selected' : '' }}>Federal Capital Territory</option>
                    <option value="Gombe" {{ old('state') == 'Gombe' ? 'selected' : '' }}>Gombe</option>
                    <option value="Imo" {{ old('state') == 'Imo' ? 'selected' : '' }}>Imo</option>
                    <option value="Jigawa" {{ old('state') == 'Jigawa' ? 'selected' : '' }}>Jigawa</option>
                    <option value="Kaduna" {{ old('state') == 'Kaduna' ? 'selected' : '' }}>Kaduna</option>
                    <option value="Kano" {{ old('state') == 'Kano' ? 'selected' : '' }}>Kano</option>
                    <option value="Katsina" {{ old('state') == 'Katsina' ? 'selected' : '' }}>Katsina</option>
                    <option value="Kebbi" {{ old('state') == 'Kebbi' ? 'selected' : '' }}>Kebbi</option>
                    <option value="Kogi" {{ old('state') == 'Kogi' ? 'selected' : '' }}>Kogi</option>
                    <option value="Kwara" {{ old('state') == 'Kwara' ? 'selected' : '' }}>Kwara</option>
                    <option value="Lagos" {{ old('state') == 'Lagos' ? 'selected' : '' }}>Lagos</option>
                    <option value="Nasarawa" {{ old('state') == 'Nasarawa' ? 'selected' : '' }}>Nasarawa</option>
                    <option value="Niger" {{ old('state') == 'Niger' ? 'selected' : '' }}>Niger</option>
                    <option value="Ogun" {{ old('state') == 'Ogun' ? 'selected' : '' }}>Ogun</option>
                    <option value="Ondo" {{ old('state') == 'Ondo' ? 'selected' : '' }}>Ondo</option>
                    <option value="Osun" {{ old('state') == 'Osun' ? 'selected' : '' }}>Osun</option>
                    <option value="Oyo" {{ old('state') == 'Oyo' ? 'selected' : '' }}>Oyo</option>
                    <option value="Plateau" {{ old('state') == 'Plateau' ? 'selected' : '' }}>Plateau</option>
                    <option value="Rivers" {{ old('state') == 'Rivers' ? 'selected' : '' }}>Rivers</option>
                    <option value="Sokoto" {{ old('state') == 'Sokoto' ? 'selected' : '' }}>Sokoto</option>
                    <option value="Taraba" {{ old('state') == 'Taraba' ? 'selected' : '' }}>Taraba</option>
                    <option value="Yobe" {{ old('state') == 'Yobe' ? 'selected' : '' }}>Yobe</option>
                    <option value="Zamfara" {{ old('state') == 'Zamfara' ? 'selected' : '' }}>Zamfara</option>
                </select>
                
                @error('state')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="md:col-span-2">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Property Description (Optional)</label>
                <textarea id="description" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" name="description" rows="4">{{ old('description') }}</textarea>
                
                @error('description')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add Property
            </button>
        </div>
    </form>
</div>
@endsection
