@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col">
    <div class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-sm">
            <!-- Logo -->
            <div class="text-center mb-12">
                <div class="w-20 h-20 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-8">
                    <img src="{{ asset('images/rentsure-icon.png') }}" alt="RentSure" class="w-10 h-10">
                </div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Sign Up</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Create your account to get started</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                
                <!-- Full Name Field -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                           class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-800 border-0 rounded-2xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm @error('name') ring-2 ring-red-500 @enderror"
                           placeholder="Full Name">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email Field -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                           class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-800 border-0 rounded-2xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm @error('email') ring-2 ring-red-500 @enderror"
                           placeholder="Email">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Phone Number Field -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <input id="phone_number" type="tel" name="phone_number" value="{{ old('phone_number') }}" required
                           class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-800 border-0 rounded-2xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm @error('phone_number') ring-2 ring-red-500 @enderror"
                           placeholder="Phone Number">
                    @error('phone_number')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Role Selection -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <select id="role" name="role" required
                            class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-800 border-0 rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm @error('role') ring-2 ring-red-500 @enderror">
                        <option value="">Select Role</option>
                        <option value="tenant" {{ old('role') == 'tenant' ? 'selected' : '' }}>Tenant</option>
                        <option value="landlord" {{ old('role') == 'landlord' ? 'selected' : '' }}>Landlord</option>
                        <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>Agent</option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Address Field -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <input id="address" type="text" name="address" value="{{ old('address') }}" required
                           class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-800 border-0 rounded-2xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm @error('address') ring-2 ring-red-500 @enderror"
                           placeholder="Address">
                    @error('address')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- State Selection -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <select id="state" name="state" required
                            class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-800 border-0 rounded-2xl text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm @error('state') ring-2 ring-red-500 @enderror">
                        <option value="">Select State</option>
                        <option value="Lagos" {{ old('state') == 'Lagos' ? 'selected' : '' }}>Lagos</option>
                        <option value="Abuja" {{ old('state') == 'Abuja' ? 'selected' : '' }}>Abuja (FCT)</option>
                        <option value="Kano" {{ old('state') == 'Kano' ? 'selected' : '' }}>Kano</option>
                        <option value="Rivers" {{ old('state') == 'Rivers' ? 'selected' : '' }}>Rivers</option>
                        <option value="Oyo" {{ old('state') == 'Oyo' ? 'selected' : '' }}>Oyo</option>
                        <option value="Kaduna" {{ old('state') == 'Kaduna' ? 'selected' : '' }}>Kaduna</option>
                        <option value="Katsina" {{ old('state') == 'Katsina' ? 'selected' : '' }}>Katsina</option>
                        <option value="Ogun" {{ old('state') == 'Ogun' ? 'selected' : '' }}>Ogun</option>
                        <option value="Ondo" {{ old('state') == 'Ondo' ? 'selected' : '' }}>Ondo</option>
                        <option value="Osun" {{ old('state') == 'Osun' ? 'selected' : '' }}>Osun</option>
                        <option value="Delta" {{ old('state') == 'Delta' ? 'selected' : '' }}>Delta</option>
                        <option value="Anambra" {{ old('state') == 'Anambra' ? 'selected' : '' }}>Anambra</option>
                        <option value="Enugu" {{ old('state') == 'Enugu' ? 'selected' : '' }}>Enugu</option>
                        <option value="Edo" {{ old('state') == 'Edo' ? 'selected' : '' }}>Edo</option>
                        <option value="Cross River" {{ old('state') == 'Cross River' ? 'selected' : '' }}>Cross River</option>
                        <option value="Akwa Ibom" {{ old('state') == 'Akwa Ibom' ? 'selected' : '' }}>Akwa Ibom</option>
                        <option value="Plateau" {{ old('state') == 'Plateau' ? 'selected' : '' }}>Plateau</option>
                        <option value="Kwara" {{ old('state') == 'Kwara' ? 'selected' : '' }}>Kwara</option>
                        <option value="Benue" {{ old('state') == 'Benue' ? 'selected' : '' }}>Benue</option>
                        <option value="Niger" {{ old('state') == 'Niger' ? 'selected' : '' }}>Niger</option>
                        <option value="Other" {{ old('state') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('state')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- NIN Field (Required for Tenants) -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <input id="nin" type="text" name="nin" value="{{ old('nin') }}" maxlength="11"
                           class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-800 border-0 rounded-2xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm @error('nin') ring-2 ring-red-500 @enderror"
                           placeholder="NIN (Required for Tenants)">
                    @error('nin')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">11-digit Nigerian National Identification Number</p>
                </div>
                
                <!-- Password Field -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-800 border-0 rounded-2xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm @error('password') ring-2 ring-red-500 @enderror"
                           placeholder="Password">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Confirm Password Field -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-800 border-0 rounded-2xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm"
                           placeholder="Confirm Password">
                </div>
                
                <!-- Sign Up Button -->
                <button type="submit" class="w-full bg-[#0000ff] text-white font-semibold py-4 rounded-2xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors shadow-lg">
                    Sign Up
                </button>
                
                <!-- Divider -->
                <div class="text-center my-6">
                    <span class="text-gray-400 dark:text-gray-500 text-sm">Or</span>
                </div>
                
                <!-- Sign In Link -->
                <div class="text-center">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold text-[#0000ff] hover:text-blue-700">Sign In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-[#0000ff] py-4">
        <div class="text-center">
            <div class="text-sm text-white mb-2">
                &copy; {{ date('Y') }} RentSure. All rights reserved.
            </div>
            <div class="text-sm">
                <a href="{{ route('terms') }}" class="text-white hover:text-gray-300">Terms</a>
                <span class="mx-2 text-white">|</span>
                <a href="{{ route('privacy') }}" class="text-white hover:text-gray-300">Privacy</a>
            </div>
        </div>
    </footer>
</div>
@endsection