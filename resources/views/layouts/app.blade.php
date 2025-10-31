<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-bind:class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'RentSure') }} - Landlord-Tenant Verification Platform</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('rentsure-favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('rentsure-favicon') }}">
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif'],
                    },
                    colors: {
                        'primary': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom Styles -->
    <style>
        [x-cloak] { display: none !important; }
        
        /* Ensure full width */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }
        
        body { 
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif; 
        }
        
        #app {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        
        /* Mobile-only: Hide on desktop */
        @media (min-width: 768px) {
            .mobile-only { display: none !important; }
            .desktop-message { display: flex !important; }
        }
        
        @media (max-width: 767px) {
            .desktop-message { display: none !important; }
        }
        
        /* Smooth transitions */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
        
        /* Custom gradient backgrounds */
        .gradient-purple { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-pink { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .gradient-orange { background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); }
        .gradient-yellow { background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%); }
        .gradient-blue { background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%); }
        .gradient-green { background: linear-gradient(135deg, #00b894 0%, #00cec9 100%); }
        
        /* Dark mode gradients */
        .dark .gradient-purple { background: linear-gradient(135deg, #4c63d2 0%, #5a4fcf 100%); }
        .dark .gradient-pink { background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%); }
        .dark .gradient-orange { background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%); }
        .dark .gradient-yellow { background: linear-gradient(135deg, #f39c12 0%, #d63031 100%); }
        .dark .gradient-blue { background: linear-gradient(135deg, #0984e3 0%, #74b9ff 100%); }
        .dark .gradient-green { background: linear-gradient(135deg, #00b894 0%, #55a3ff 100%); }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
    <!-- Desktop Message (Hidden on Mobile) -->
    <div class="desktop-message hidden min-h-screen bg-blue-600 items-center justify-center p-8">
        <div class="text-center text-white max-w-md">
            <div class="mb-6">
                <svg class="w-20 h-20 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"/>
                </svg>
                <img src="{{ asset('images/rentsure-logowhite.png') }}" alt="RentSure" class="h-12 mx-auto mb-4">
            </div>
            <h1 class="text-3xl font-bold mb-4">📱 Mobile Only</h1>
            <p class="text-xl mb-6">RentSure is designed exclusively for mobile devices.</p>
            <p class="text-lg mb-8">Please access this platform from your smartphone or tablet for the best experience.</p>
            <div class="bg-white/10 rounded-lg p-4">
                <p class="text-sm">🇳🇬 Optimized for the Nigerian mobile market</p>
            </div>
        </div>
    </div>

    <div id="app" class="mobile-only">
        @php
            $isAuthPage = request()->routeIs('login') || request()->routeIs('register');
        @endphp
        @unless($isAuthPage)
        <nav class="bg-[#0000ff] text-white shadow-md">
            <div class="px-4">
                <div class="flex justify-between h-14">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center">
                            <img src="{{ asset('images/rentsure-logowhite.png') }}" alt="RentSure Logo" class="h-8 w-auto">
                        </a>
                        
                        @auth
                            @unless($isAuthPage)
                            <div class="hidden md:ml-10 md:flex md:space-x-8">
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('admin.dashboard') ? 'bg-[#00001a]' : '' }}">Dashboard</a>
                                    <a href="{{ route('admin.users') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('admin.users*') ? 'bg-[#00001a]' : '' }}">Users</a>
                                    <a href="{{ route('admin.verifications') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('admin.verifications*') ? 'bg-[#00001a]' : '' }}">Verifications</a>
                                    <a href="{{ route('admin.documents') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('admin.documents*') ? 'bg-[#00001a]' : '' }}">Documents</a>
                                    <a href="{{ route('admin.reviews.disputes') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('admin.reviews*') ? 'bg-[#00001a]' : '' }}">Disputes</a>
                                    <a href="{{ route('admin.analytics') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('admin.analytics') ? 'bg-[#00001a]' : '' }}">Analytics</a>
                                @elseif(Auth::user()->isLandlord())
                                    <a href="{{ route('landlord.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('landlord.dashboard') ? 'bg-[#00001a]' : '' }}">Dashboard</a>
                                    <a href="{{ route('landlord.properties') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('landlord.properties*') ? 'bg-[#00001a]' : '' }}">Properties</a>
                                    <a href="{{ route('landlord.tenants') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('landlord.tenants*') ? 'bg-[#00001a]' : '' }}">Tenants</a>
                                    <a href="{{ route('landlord.reviews') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('landlord.reviews*') ? 'bg-[#00001a]' : '' }}">Reviews</a>
                                    <a href="{{ route('landlord.agents') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('landlord.agents*') ? 'bg-[#00001a]' : '' }}">Agents</a>
                                    <a href="{{ route('landlord.agent-reviews') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('landlord.agent-reviews*') ? 'bg-[#00001a]' : '' }}">
                                        Agent Reviews
                                    </a>
                                @elseif(Auth::user()->isAgent())
                                    <a href="{{ route('agent.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('agent.dashboard') ? 'bg-[#00001a]' : '' }}">Dashboard</a>
                                    <a href="{{ route('agent.landlords') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('agent.landlords*') ? 'bg-[#00001a]' : '' }}">Landlords</a>
                                    <a href="{{ route('agent.properties') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('agent.properties*') ? 'bg-[#00001a]' : '' }}">Properties</a>
                                    <a href="{{ route('agent.reviews') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('agent.reviews*') ? 'bg-[#00001a]' : '' }}">Reviews</a>
                                @elseif(Auth::user()->isTenant())
                                    <a href="{{ route('tenant.profile') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('tenant.profile') ? 'bg-[#00001a]' : '' }}">Profile</a>
                                    <a href="{{ route('tenant.reviews') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-[#00001a] {{ request()->routeIs('tenant.reviews') ? 'bg-[#00001a]' : '' }}">My Reviews</a>
                                @endif
                            </div>
                            @endunless
                        @endauth
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Theme Switcher -->
                        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                                class="p-2 rounded-lg hover:bg-white/10 transition-colors duration-200">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                            </svg>
                            <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                            </svg>
                        </button>
                        
                        @guest
                            @unless($isAuthPage)
                                <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-white/10">Login</a>
                                <a href="{{ route('register') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium hover:bg-white/10">Register</a>
                            @endunless
                        @else
                            <div x-data="{ open: false }" class="ml-3 relative">
                                <div>
                                    <button @click="open = !open" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-800 focus:ring-white">
                                        <span class="sr-only">Open user menu</span>
                                        <div class="h-8 w-8 rounded-full bg-[#0000ff] flex items-center justify-center">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    </button>
                                </div>
                                
                                <div x-show="open" 
                                     @click.away="open = false" 
                                     x-transition:enter="transition ease-out duration-100" 
                                     x-transition:enter-start="transform opacity-0 scale-95" 
                                     x-transition:enter-end="transform opacity-100 scale-100" 
                                     x-transition:leave="transition ease-in duration-75" 
                                     x-transition:leave-start="transform opacity-100 scale-100" 
                                     x-transition:leave-end="transform opacity-0 scale-95" 
                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" 
                                     role="menu" 
                                     aria-orientation="vertical" 
                                     aria-labelledby="user-menu" 
                                     x-cloak>
                                    <span class="block px-4 py-2 text-xs text-gray-500">
                                        Signed in as <strong class="text-gray-700">{{ Auth::user()->name }}</strong>
                                    </span>
                                    <hr>
                                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                            Sign out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                    
                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="bg-[#0000ff] inline-flex items-center justify-center p-2 rounded-md text-blue-200 hover:text-white hover:bg-[#00001a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#0000ff] focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        @endunless
        
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <main class="py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
        
        @unless($isAuthPage)
        <footer class="bg-[#0000ff] mt-8 py-4 lg:relative lg:z-auto fixed bottom-0 left-0 right-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="text-sm text-white mb-2">
                        &copy; {{ date('Y') }} RentSure - Landlord-Tenant Verification Platform for Nigeria
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('terms') }}" class="text-white hover:text-gray-300">Terms</a>
                        <span class="mx-2 text-white">|</span>
                        <a href="{{ route('privacy') }}" class="text-white hover:text-gray-300">Privacy</a>
                    </div>
                </div>
            </div>
        </footer>
        @endunless
    </div>
    
    @stack('scripts')
</body>
</html>
