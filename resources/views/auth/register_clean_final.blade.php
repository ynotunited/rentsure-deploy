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
