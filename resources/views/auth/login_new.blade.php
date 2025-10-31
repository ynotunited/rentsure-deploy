@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100"
     style="background-image: url('{{ asset('images/rentsure-bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    
    <div class="w-full max-w-md mx-auto p-6">
        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Sign In</h1>
            <p class="text-gray-600 text-sm">Please enter your credentials to access your account</p>
        </div>
        
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <!-- Username/Email Field -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       class="w-full pl-12 pr-4 py-4 bg-gray-50 border-0 rounded-2xl text-gray-900 placeholder-gray-500 focus:bg-white focus:ring-2 focus:ring-pink-500 focus:outline-none transition-all @error('email') ring-2 ring-red-500 @enderror"
                       placeholder="Username">
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
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full pl-12 pr-12 py-4 bg-gray-50 border-0 rounded-2xl text-gray-900 placeholder-gray-500 focus:bg-white focus:ring-2 focus:ring-pink-500 focus:outline-none transition-all @error('password') ring-2 ring-red-500 @enderror"
                       placeholder="••••••••">
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <button type="button" class="text-gray-400 hover:text-gray-600" onclick="togglePassword()">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Forgot Password -->
            <div class="text-right">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">Forgot Password?</a>
                @endif
            </div>
            
            <!-- Sign In Button -->
            <button type="submit" class="w-full bg-[#0000ff] text-white font-semibold py-4 rounded-2xl hover:bg-blue-700 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                Sign In
            </button>
            
            <!-- Sign Up Link -->
            <div class="text-center mt-6">
                <p class="text-gray-600 text-sm">
                    Don't have account? 
                    <a href="{{ route('register') }}" class="font-semibold text-gray-900 hover:text-pink-600">Sign Up</a>
                </p>
            </div>
        </form>
    </div>
    
    <!-- Copyright Footer -->
    <div class="text-center mt-8">
        <p class="text-gray-500 text-xs">
            &copy; {{ date('Y') }} RentSure. All rights reserved.
        </p>
    </div>
</div>

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    }
</script>
@endpush
@endsection
