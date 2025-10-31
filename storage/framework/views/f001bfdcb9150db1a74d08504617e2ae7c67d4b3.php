<?php $__env->startSection('content'); ?>
<div class="px-4 py-6 max-w-md mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Landlord Dashboard</h1>
        <p class="text-gray-600">Welcome back, <?php echo e(Auth::user()->name); ?>!</p>
    </div>

    <!-- Tenant Search Section -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900">Search Tenant Profiles</h2>
            <p class="text-sm text-gray-600 mt-1">Find and verify tenants by name, phone, or NIN</p>
        </div>
        
        <div class="p-4">
            <form action="<?php echo e(route('landlord.tenant.search')); ?>" method="GET" class="space-y-4">
                <div class="space-y-4">
                    <div>
                        <label for="search_name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" id="search_name" name="name" value="<?php echo e(request('name')); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter tenant name">
                    </div>
                    <div>
                        <label for="search_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" id="search_phone" name="phone" value="<?php echo e(request('phone')); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter phone number">
                    </div>
                    <div>
                        <label for="search_nin" class="block text-sm font-medium text-gray-700 mb-1">NIN</label>
                        <input type="text" id="search_nin" name="nin" value="<?php echo e(request('nin')); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter NIN" maxlength="11">
                    </div>
                </div>
                <div class="flex flex-col space-y-3">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                        Search Tenants
                    </button>
                    <?php if(request()->hasAny(['name', 'phone', 'nin'])): ?>
                        <a href="<?php echo e(route('landlord.dashboard')); ?>" class="text-center text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 text-sm">Clear Search</a>
                    <?php endif; ?>
                </div>
            </form>

            <!-- Search Results -->
            <?php if(isset($searchResults)): ?>
                <div class="mt-6 border-t pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Search Results (<?php echo e($searchResults->count()); ?>)</h3>
                    <?php if($searchResults->count() > 0): ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <?php if($tenant->verification_badge): ?>
                                                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-medium text-gray-900"><?php echo e($tenant->name); ?></h4>
                                                <p class="text-sm text-gray-600"><?php echo e($tenant->email); ?></p>
                                                <p class="text-sm text-gray-600"><?php echo e($tenant->phone_number); ?></p>
                                                <?php if($tenant->state): ?>
                                                    <p class="text-sm text-gray-500"><?php echo e($tenant->state); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <?php if($tenant->verification_badge): ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Verified ⭐
                                                </span>
                                            <?php endif; ?>
                                            <?php if($tenant->nin): ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    NIN Verified
                                                </span>
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('landlord.tenant.profile', $tenant)); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700">
                                                View Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No tenants found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search criteria.</p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Cards Grid -->
    <div class="grid grid-cols-1 gap-4 mb-6">
        <!-- Property Stats Card -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Properties</h2>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($propertyCount); ?></span>
            <span class="text-gray-500 ml-2"><?php echo e(Str::plural('property', $propertyCount)); ?></span>
        </div>
        <div class="mt-4">
            <a href="<?php echo e(route('landlord.properties')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                View all properties
            </a>
        </div>
    </div>

    <!-- Tenants Stats Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Tenants</h2>
            <span class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($tenantCount); ?></span>
            <span class="text-gray-500 ml-2">active <?php echo e(Str::plural('tenant', $tenantCount)); ?></span>
        </div>
        <div class="mt-4">
            <a href="<?php echo e(route('landlord.tenants')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Manage tenants
            </a>
        </div>
    </div>

    <!-- Agent Reviews Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Agent Reviews</h2>
            <span class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($pendingAgentReviews); ?></span>
            <span class="text-gray-500 ml-2">pending <?php echo e(Str::plural('review', $pendingAgentReviews)); ?></span>
        </div>
        <div class="mt-4">
            <a href="<?php echo e(route('landlord.agent-reviews')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Review pending submissions
            </a>
        </div>
    </div>

    <!-- Agents Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Agents</h2>
            <span class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($verifiedAgentCount); ?></span>
            <span class="text-gray-500 ml-2">verified <?php echo e(Str::plural('agent', $verifiedAgentCount)); ?></span>
        </div>
        <div class="mt-4">
            <a href="<?php echo e(route('landlord.agents')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Manage agents
            </a>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="mb-8">
    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="<?php echo e(route('landlord.property.create')); ?>" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow flex items-center">
            <div class="mr-4">
                <span class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </span>
            </div>
            <div>
                <h3 class="font-medium">Add New Property</h3>
                <p class="text-sm text-gray-500">Register a new rental property</p>
            </div>
        </a>

        <a href="<?php echo e(route('landlord.tenant.search')); ?>" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow flex items-center">
            <div class="mr-4">
                <span class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div>
                <h3 class="font-medium">Search for Tenants</h3>
                <p class="text-sm text-gray-500">Find and verify tenant profiles</p>
            </div>
        </a>

        <a href="<?php echo e(route('landlord.agent-reviews')); ?>" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow flex items-center">
            <div class="mr-4">
                <span class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </span>
            </div>
            <div>
                <h3 class="font-medium">Review Agent Submissions</h3>
                <p class="text-sm text-gray-500">Approve or reject agent reviews</p>
            </div>
        </a>
    </div>
</div>

<!-- Recent Activities Section -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Recent Properties</h2>
    
    <?php if($landlord->properties->count() > 0): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Property
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Active Tenants
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $landlord->properties->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo e($property->name); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo e($property->city); ?>, <?php echo e($property->state); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo e($property->property_type); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500"><?php echo e($property->activeTenants()->count()); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="<?php echo e(route('landlord.property.show', $property)); ?>" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                <a href="<?php echo e(route('landlord.property.edit', $property)); ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        
        <?php if($landlord->properties->count() > 5): ?>
            <div class="mt-4 text-center">
                <a href="<?php echo e(route('landlord.properties')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    View all properties
                </a>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="bg-gray-50 p-4 rounded text-gray-500 text-center">
            You haven't added any properties yet.
            <a href="<?php echo e(route('landlord.property.create')); ?>" class="text-blue-600 hover:text-blue-800">Add your first property</a>.
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rentsure\resources\views/landlord/dashboard.blade.php ENDPATH**/ ?>