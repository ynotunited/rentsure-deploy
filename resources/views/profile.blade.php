@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h1 class="text-2xl font-bold mb-4">Your Profile</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Information -->
            <div class="md:col-span-2">
                <h2 class="text-lg font-semibold mb-3">Profile Information</h2>
                
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                        <input id="name" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
                        
                        @error('name')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                        <input id="email" type="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                        
                        @error('email')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                        <input id="phone_number" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone_number') border-red-500 @enderror" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" autocomplete="phone_number">
                        
                        @error('phone_number')
                            <span class="text-red-500 text-xs italic" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Account Information -->
            <div class="md:col-span-1">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-lg font-semibold mb-3">Account Information</h2>
                    
                    <ul class="space-y-2">
                        <li>
                            <span class="text-gray-600 text-sm">Account Type:</span>
                            <span class="font-medium">{{ ucfirst($user->role) }}</span>
                        </li>
                        <li>
                            <span class="text-gray-600 text-sm">Member Since:</span>
                            <span class="font-medium">{{ $user->created_at->format('M d, Y') }}</span>
                        </li>
                        @if($user->isTenant())
                            <li>
                                <span class="text-gray-600 text-sm">NIN Verified:</span>
                                <span class="font-medium">
                                    @if($user->verified)
                                        <span class="text-green-600">Yes</span>
                                    @else
                                        <span class="text-red-600">No</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <span class="text-gray-600 text-sm">Verification Badge:</span>
                                <span class="font-medium">
                                    @if($user->verification_badge)
                                        <span class="text-green-600">Awarded</span>
                                    @else
                                        <span class="text-gray-600">Not Awarded</span>
                                    @endif
                                </span>
                            </li>
                        @endif
                    </ul>
                    
                    <div class="mt-4 border-t pt-4">
                        <div class="text-center">
                            <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                Go to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Change Password Section -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Change Password</h2>
        
        <form method="POST" action="{{ route('password.change') }}">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
                <input id="current_password" type="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('current_password') border-red-500 @enderror" name="current_password" required>
                
                @error('current_password')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <input id="password" type="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                
                @error('password')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                <input id="password-confirm" type="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required autocomplete="new-password">
            </div>
            
            <div class="mb-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Change Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
