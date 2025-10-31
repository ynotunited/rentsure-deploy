@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Tenant Profile Card -->
    <div class="col-span-1">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-center mb-6">
                @if($tenant->verification_badge)
                    <div class="h-24 w-24 rounded-full bg-blue-100 flex items-center justify-center relative">
                        <span class="text-4xl font-bold text-blue-600">{{ substr($tenant->name, 0, 1) }}</span>
                        <span class="absolute -bottom-2 -right-2 h-8 w-8 bg-green-500 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                @else
                    <div class="h-24 w-24 rounded-full bg-blue-100 flex items-center justify-center">
                        <span class="text-4xl font-bold text-blue-600">{{ substr($tenant->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>
            
            <h1 class="text-2xl font-bold text-center mb-1">{{ $tenant->name }}</h1>
            
            @if($tenant->verification_badge)
                <div class="flex items-center justify-center mb-4">
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Verified Tenant
                    </span>
                </div>
            @endif
            
            <ul class="space-y-2 mb-6">
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-gray-700">{{ $tenant->email }}</span>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span class="text-gray-700">{{ $tenant->phone_number ?: 'Not provided' }}</span>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                    </svg>
                    <span class="text-gray-700">
                        @if($tenant->nin)
                            NIN: {{ substr($tenant->nin, 0, 3) . '•••••' . substr($tenant->nin, -3) }}
                        @else
                            NIN not provided
                        @endif
                    </span>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-gray-700">Member since {{ $tenant->created_at->format('M d, Y') }}</span>
                </li>
            </ul>
            
            <div class="border-t pt-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('profile') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        Edit Profile
                    </a>
                    <a href="{{ route('tenant.reviews') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        View My Reviews
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Verification Status -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h2 class="text-lg font-bold mb-4">Verification Status</h2>
            
            <ul class="space-y-4">
                <li class="flex items-start">
                    <div class="flex-shrink-0">
                        @if($tenant->verified)
                            <span class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @else
                            <span class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </div>
                    <div class="ml-3">
                        <h3 class="font-medium">NIN Verification</h3>
                        <p class="text-sm text-gray-500">
                            @if($tenant->verified)
                                Your Nigerian Identification Number has been verified.
                            @else
                                Your Nigerian Identification Number needs to be verified.
                                @if($tenant->nin)
                                    <a href="#" onclick="document.getElementById('request-nin-verification').submit();" class="text-blue-600 hover:text-blue-800">Request verification</a>
                                    <form id="request-nin-verification" method="POST" action="{{ route('tenant.verification.request') }}" class="hidden">
                                        @csrf
                                        <input type="hidden" name="request_type" value="nin">
                                    </form>
                                @else
                                    Please update your profile to add your NIN.
                                @endif
                            @endif
                        </p>
                    </div>
                </li>
                
                <li class="flex items-start">
                    <div class="flex-shrink-0">
                        @if($tenant->verification_badge)
                            <span class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @else
                            <span class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </div>
                    <div class="ml-3">
                        <h3 class="font-medium">Verification Badge</h3>
                        <p class="text-sm text-gray-500">
                            @if($tenant->verification_badge)
                                You have been awarded the verification badge.
                            @else
                                @if($tenant->verified)
                                    You can now request a verification badge.
                                    <a href="#" onclick="document.getElementById('request-badge-verification').submit();" class="text-blue-600 hover:text-blue-800">Request badge</a>
                                    <form id="request-badge-verification" method="POST" action="{{ route('tenant.verification.request') }}" class="hidden">
                                        @csrf
                                        <input type="hidden" name="request_type" value="badge">
                                    </form>
                                @else
                                    You must verify your NIN first.
                                @endif
                            @endif
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Tenant Documents and Properties -->
    <div class="col-span-2">
        <!-- Document Upload Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-bold mb-4">Your Documents</h2>
            
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-4">
                    Upload your documents for identity verification and record keeping.
                </p>
                
                <form method="POST" action="{{ route('tenant.document.upload') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="document_type" class="block text-gray-700 text-sm font-bold mb-2">Document Type</label>
                        <select id="document_type" name="document_type" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('document_type') border-red-500 @enderror" required>
                            <option value="" disabled selected>Select document type</option>
                            <option value="id">National ID Card</option>
                            <option value="lease">Lease Agreement</option>
                            <option value="photo">Profile Photo</option>
                            <option value="other">Other Document</option>
                        </select>
                        
                        @error('document_type')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="document" class="block text-gray-700 text-sm font-bold mb-2">Upload Document</label>
                        <input id="document" type="file" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('document') border-red-500 @enderror" name="document" required>
                        
                        <p class="text-xs text-gray-500 mt-1">
                            Supported formats: JPEG, PNG, PDF, DOC. Max size: 10MB.
                        </p>
                        
                        @error('document')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Upload Document
                        </button>
                    </div>
                </form>
            </div>
            
            <h3 class="font-medium text-gray-800 mb-2">Uploaded Documents</h3>
            
            @if($documents->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">Document Type</th>
                                <th class="px-4 py-2">Date Uploaded</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($documents as $document)
                                <tr>
                                    <td class="px-4 py-3">{{ ucfirst($document->document_type) }}</td>
                                    <td class="px-4 py-3">{{ $document->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-3">
                                        @if($document->verified)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                Verified
                                            </span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-gray-50 p-4 rounded text-gray-500 text-center">
                    No documents uploaded yet.
                </div>
            @endif
        </div>
        
        <!-- Properties Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-bold mb-4">Your Properties</h2>
            
            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($properties as $property)
                        <div class="border rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800">{{ $property->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $property->address }}</p>
                            <p class="text-gray-600 text-sm">{{ $property->city }}, {{ $property->state }}</p>
                            
                            <div class="mt-2 text-sm">
                                <p class="text-gray-500">
                                    <span class="font-medium">Type:</span> {{ $property->property_type }}
                                </p>
                                <p class="text-gray-500">
                                    <span class="font-medium">Start Date:</span> {{ $property->pivot->start_date }}
                                </p>
                                @if($property->pivot->end_date)
                                    <p class="text-gray-500">
                                        <span class="font-medium">End Date:</span> {{ $property->pivot->end_date }}
                                    </p>
                                @endif
                            </div>
                            
                            <div class="mt-2">
                                @if($property->pivot->active)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Active Tenant
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 p-4 rounded text-gray-500 text-center">
                    You are not currently associated with any properties.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
