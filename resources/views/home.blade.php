@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Welcome to RentSure</h1>
    
    <div class="mb-6">
        <p class="mb-4">
            Thank you for logging in. You'll be redirected to your dashboard in a moment.
        </p>
        
        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
            <p>If you're not redirected automatically, please click one of the links below:</p>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Admin Dashboard
            </a>
        @elseif(Auth::user()->isLandlord())
            <a href="{{ route('landlord.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Landlord Dashboard
            </a>
        @elseif(Auth::user()->isAgent())
            <a href="{{ route('agent.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Agent Dashboard
            </a>
        @elseif(Auth::user()->isTenant())
            <a href="{{ route('tenant.profile') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tenant Profile
            </a>
        @endif
        
        <a href="{{ route('profile') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
            My Profile
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto redirect based on role
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            @if(Auth::user()->isAdmin())
                window.location.href = "{{ route('admin.dashboard') }}";
            @elseif(Auth::user()->isLandlord())
                window.location.href = "{{ route('landlord.dashboard') }}";
            @elseif(Auth::user()->isAgent())
                window.location.href = "{{ route('agent.dashboard') }}";
            @elseif(Auth::user()->isTenant())
                window.location.href = "{{ route('tenant.profile') }}";
            @endif
        }, 2000);
    });
</script>
@endpush
