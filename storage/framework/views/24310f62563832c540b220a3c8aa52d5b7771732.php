<?php $__env->startSection('content'); ?>
<div class="relative">
    <!-- Mobile Onboarding (Hidden on Desktop) -->
    <div class="lg:hidden fixed top-16 left-0 right-0 bottom-0 z-40" x-data="{ 
        currentScreen: 1, 
        totalScreens: 3,
        nextScreen() {
            if (this.currentScreen < this.totalScreens) {
                this.currentScreen++;
            } else {
                window.location.href = '<?php echo e(route('login')); ?>';
            }
        },
        skipOnboarding() {
            window.location.href = '<?php echo e(route('login')); ?>';
        }
    }">
        <!-- Screen 1: Trust Starts Here -->
        <div x-show="currentScreen === 1" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 transform translate-x-full" 
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100 transform translate-x-0" 
             x-transition:leave-end="opacity-0 transform -translate-x-full"
             class="h-full relative overflow-hidden" style="background-image: url('<?php echo e(asset('images/34555666.png')); ?>'); background-size: cover; background-position: center;">
            
            <!-- Skip Button -->
            <div class="absolute top-12 right-6 z-10">
                <button @click="skipOnboarding()" class="text-white/80 text-sm font-medium">Skip</button>
            </div>
            
            
            <!-- Decorative Curves -->
            <div class="absolute inset-0">
                <svg class="absolute bottom-0 left-0 w-full h-2/3" viewBox="0 0 400 300" fill="none">
                    <path d="M0 150C100 100 200 200 400 150V300H0V150Z" fill="rgba(0,0,0,0.1)"/>
                    <path d="M0 180C120 120 280 240 400 180V300H0V180Z" fill="rgba(0,0,0,0.05)"/>
                </svg>
            </div>
            
            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-end h-full p-6 pb-32">
                <div class="text-white">
                    <h1 class="text-4xl font-bold mb-4 leading-tight">
                        Trust Starts Here
                    </h1>
                    <h2 class="text-2xl font-semibold mb-4">
                        Verify. Review. Rent with Confidence.
                    </h2>
                    <p class="text-lg text-white/90 mb-8 leading-relaxed">
                        Build trust between landlords, tenants, and agents — all in one place.
                    </p>
                </div>
                
                <!-- Progress Indicator -->
                <div class="flex space-x-2 mb-6">
                    <div class="h-1 bg-white rounded-full flex-1"></div>
                    <div class="h-1 bg-white/30 rounded-full flex-1"></div>
                    <div class="h-1 bg-white/30 rounded-full flex-1"></div>
                </div>
                
                <!-- Next Button -->
                <button @click="nextScreen()" 
                        class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center ml-auto shadow-lg hover:bg-orange-600 transition-colors">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Screen 2: No More Guesswork -->
        <div x-show="currentScreen === 2" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 transform translate-x-full" 
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100 transform translate-x-0" 
             x-transition:leave-end="opacity-0 transform -translate-x-full"
             class="h-full relative overflow-hidden" style="background-image: url('<?php echo e(asset('images/34555666.png')); ?>'); background-size: cover; background-position: center;">
            
            <!-- Skip Button -->
            <div class="absolute top-12 right-6 z-10">
                <button @click="skipOnboarding()" class="text-white/80 text-sm font-medium">Skip</button>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute inset-0">
                <svg class="absolute top-20 right-0 w-3/4 h-2/3" viewBox="0 0 300 400" fill="none">
                    <path d="M150 0C200 50 250 100 300 150V400H0C50 300 100 150 150 0Z" fill="rgba(255,255,255,0.1)"/>
                </svg>
            </div>
            
            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-end h-full p-6 pb-32">
                <div class="text-white">
                    <h1 class="text-4xl font-bold mb-4 leading-tight">
                        No More Guesswork
                    </h1>
                    <h2 class="text-xl font-semibold mb-4">
                        Know who you're renting to — before the keys change hands.
                    </h2>
                    <p class="text-lg text-white/90 mb-8 leading-relaxed">
                        Access verified tenant profiles, honest reviews, and live ID checks.
                    </p>
                </div>
                
                <!-- Progress Indicator -->
                <div class="flex space-x-2 mb-6">
                    <div class="h-1 bg-white/30 rounded-full flex-1"></div>
                    <div class="h-1 bg-white rounded-full flex-1"></div>
                    <div class="h-1 bg-white/30 rounded-full flex-1"></div>
                </div>
                
                <!-- Next Button -->
                <button @click="nextScreen()" 
                        class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center ml-auto shadow-lg hover:bg-blue-600 transition-colors">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Screen 3: Reputation You Can Count On -->
        <div x-show="currentScreen === 3" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 transform translate-x-full" 
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100 transform translate-x-0" 
             x-transition:leave-end="opacity-0 transform -translate-x-full"
             class="h-full relative overflow-hidden" style="background-image: url('<?php echo e(asset('images/34555666.png')); ?>'); background-size: cover; background-position: center;">
            
            <!-- Skip Button -->
            <div class="absolute top-12 right-6 z-10">
                <button @click="skipOnboarding()" class="text-white/80 text-sm font-medium">Skip</button>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute inset-0">
                <svg class="absolute bottom-0 left-0 w-full h-3/4" viewBox="0 0 400 300" fill="none">
                    <circle cx="100" cy="100" r="80" fill="rgba(255,255,255,0.1)"/>
                    <circle cx="300" cy="200" r="60" fill="rgba(255,255,255,0.05)"/>
                </svg>
            </div>
            
            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-end h-full p-6 pb-32">
                <div class="text-white">
                    <h1 class="text-4xl font-bold mb-4 leading-tight">
                        Reputation You Can Count On
                    </h1>
                    <h2 class="text-xl font-semibold mb-4">
                        Your rental history should open doors, not close them.
                    </h2>
                    <p class="text-lg text-white/90 mb-8 leading-relaxed">
                        Build a trusted profile that speaks for you wherever you move next.
                    </p>
                </div>
                
                <!-- Progress Indicator -->
                <div class="flex space-x-2 mb-6">
                    <div class="h-1 bg-white/30 rounded-full flex-1"></div>
                    <div class="h-1 bg-white/30 rounded-full flex-1"></div>
                    <div class="h-1 bg-white rounded-full flex-1"></div>
                </div>
                
                <!-- Get Started Button -->
                <button @click="nextScreen()" 
                        class="w-full bg-white text-green-600 py-4 rounded-2xl font-semibold text-lg shadow-lg hover:bg-gray-50 transition-colors">
                    Let's Go
                </button>
            </div>
        </div>
    </div>

    <!-- Desktop Version (Hidden on Mobile) -->
    <div class="hidden lg:block">
        <!-- Hero Section -->
        <div class="py-16 bg-gradient-to-r from-[#0000ff] to-[#00001a] text-white">
            <div class="max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center mb-6">
                    <img src="<?php echo e(asset('images/rentsure-logowhite.png')); ?>" alt="RentSure Logo" class="h-16 w-auto">
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
                    Verify Rental Identities in Nigeria
                </h1>
                <p class="text-xl md:text-2xl mb-8">
                    RentSure helps landlords make informed decisions, tenants build credibility, and agents provide better service.
                </p>
                <div class="flex justify-center space-x-4">
                    <a href="<?php echo e(route('register')); ?>" class="inline-block px-6 py-3 bg-[#0000ff] text-white rounded-md font-medium hover:bg-[#00001a] transition-colors">
                        Get Started
                    </a>
                    <a href="<?php echo e(route('properties.index')); ?>" class="inline-block px-6 py-3 bg-green-600 text-white rounded-md font-medium hover:bg-green-700 transition-colors">
                        View Properties
                    </a>
                    <a href="#features" class="inline-block px-6 py-3 bg-[#00001a] text-white rounded-md font-medium hover:bg-[#aaaaaa] transition-colors">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

    <!-- Features Section -->
    <div id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-12">
<div class="relative">
    <!-- Mobile Onboarding (Hidden on Desktop) -->
    <div class="lg:hidden" x-data="{ 
        currentScreen: 1, 
        totalScreens: 3,
        nextScreen() {
            if (this.currentScreen < this.totalScreens) {
                this.currentScreen++;
            } else {
                window.location.href = '<?php echo e(route('login')); ?>';
            }
        },
        skipOnboarding() {
            window.location.href = '<?php echo e(route('login')); ?>';
        }
    }">
        <!-- Screen 1: Trust Starts Here -->
        <div x-show="currentScreen === 1" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 transform translate-x-full" 
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100 transform translate-x-0" 
             x-transition:leave-end="opacity-0 transform -translate-x-full"
             class="min-h-screen bg-gradient-to-br from-orange-400 via-orange-500 to-yellow-500 relative overflow-hidden">
            
            <!-- Skip Button -->
            <div class="absolute top-12 right-6 z-10">
                <button @click="skipOnboarding()" class="text-white/80 text-sm font-medium">Skip</button>
            </div>
            
            <!-- Logo -->
            <div class="absolute top-12 left-6 z-10">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-2">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                How RentSure Works
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Tenants -->
                <div class="bg-[#f0f0f0] p-6 rounded-lg">
                    <div class="w-12 h-12 bg-[#0000ff] text-white flex items-center justify-center rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">For Tenants</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Verify your identity with NIN
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Upload rental documents
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Build your rental reputation
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Get verification badge
                        </li>
                    </ul>
                </div>
                
                <!-- Landlords -->
                <div class="bg-[#f0f0f0] p-6 rounded-lg">
                    <div class="w-12 h-12 bg-[#0000ff] text-white flex items-center justify-center rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">For Landlords</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Manage property listings
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Search for verified tenants
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Add and review tenants
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Manage agents
                        </li>
                    </ul>
                </div>
                
                <!-- Agents -->
                <div class="bg-[#f0f0f0] p-6 rounded-lg">
                    <div class="w-12 h-12 bg-[#0000ff] text-white flex items-center justify-center rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">For Agents</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Link with landlords
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Manage properties
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Submit tenant reviews
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#0000ff] mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Build reputation
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-12">
                Benefits of Using RentSure
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">For Property Owners</h3>
                    <ul class="space-y-4 text-gray-600">
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-[#0000ff] mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Reduced Risk</h4>
                                <p>Make better decisions with verified tenant profiles and historical reviews.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-[#0000ff] mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Time Saving</h4>
                                <p>Streamline the tenant screening process with verified information.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-[#0000ff] mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Better Communication</h4>
                                <p>Manage agents and property communications in one platform.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">For Tenants</h3>
                    <ul class="space-y-4 text-gray-600">
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-[#0000ff] mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Build Credibility</h4>
                                <p>Verified profiles and positive reviews make you more attractive to potential landlords.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-[#0000ff] mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Faster Approval</h4>
                                <p>Verification badges speed up the rental application process.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-[#0000ff] mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Control Your Profile</h4>
                                <p>Ability to dispute reviews and manage your rental history.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Call to Action -->
    <div class="py-16 bg-[#0000ff]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white mb-4">
                Start Building Trusted Rental Relationships
            </h2>
            <p class="text-xl text-[#aaaaaa] mb-8">
                Join RentSure today and be part of Nigeria's trusted rental verification platform
            </p>
            <a href="<?php echo e(route('register')); ?>" class="inline-block px-8 py-3 bg-[#00001a] text-white rounded-md font-medium hover:bg-[#aaaaaa] transition-colors">
                Register Now
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rentsure\resources\views/welcome.blade.php ENDPATH**/ ?>