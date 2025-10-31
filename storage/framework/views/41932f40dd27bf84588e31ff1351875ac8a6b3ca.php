<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-3xl font-bold">Agent Dashboard</h1>
    <p class="text-gray-600">Welcome back, <?php echo e($agent->name); ?></p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Landlords Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Landlords</h2>
            <span class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($verifiedLandlords->count()); ?></span>
            <span class="text-gray-500 ml-2">verified <?php echo e(Str::plural('landlord', $verifiedLandlords->count())); ?></span>
        </div>
        <div class="mt-4">
            <a href="<?php echo e(route('agent.landlords')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                View all landlords
            </a>
        </div>
    </div>

    <!-- Pending Landlord Requests Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Pending Requests</h2>
            <span class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($pendingLandlordsCount); ?></span>
            <span class="text-gray-500 ml-2">pending <?php echo e(Str::plural('request', $pendingLandlordsCount)); ?></span>
        </div>
        <div class="mt-4">
            <a href="<?php echo e(route('agent.landlords')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                View pending requests
            </a>
        </div>
    </div>

    <!-- Reviews Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Reviews</h2>
            <span class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($pendingReviewsCount); ?></span>
            <span class="text-gray-500 ml-2">pending <?php echo e(Str::plural('review', $pendingReviewsCount)); ?></span>
        </div>
        <div class="mt-4">
            <a href="<?php echo e(route('agent.reviews.pending')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                View pending reviews
            </a>
        </div>
    </div>

    <!-- Rejected Reviews Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Rejected Reviews</h2>
            <span class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($rejectedReviewsCount); ?></span>
            <span class="text-gray-500 ml-2">rejected <?php echo e(Str::plural('review', $rejectedReviewsCount)); ?></span>
        </div>
        <div class="mt-4">
            <a href="<?php echo e(route('agent.reviews.rejected')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                View rejected reviews
            </a>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="mb-8">
    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="<?php echo e(route('agent.landlords')); ?>" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow flex items-center">
            <div class="mr-4">
                <span class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </span>
            </div>
            <div>
                <h3 class="font-medium">Connect with a Landlord</h3>
                <p class="text-sm text-gray-500">Request to work with a property owner</p>
            </div>
        </a>

        <a href="<?php echo e(route('agent.tenant.search')); ?>" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow flex items-center">
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

        <a href="<?php echo e(route('agent.properties')); ?>" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow flex items-center">
            <div class="mr-4">
                <span class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </span>
            </div>
            <div>
                <h3 class="font-medium">View Properties</h3>
                <p class="text-sm text-gray-500">Manage landlord properties</p>
            </div>
        </a>
    </div>
</div>

<!-- Landlords Section -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">My Landlords</h2>
    
    <?php if($verifiedLandlords->count() > 0): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Landlord
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Properties
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Working Since
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $verifiedLandlords->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $landlord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-blue-600"><?php echo e(substr($landlord->name, 0, 1)); ?></span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo e($landlord->name); ?>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo e($landlord->email); ?></div>
                                <?php if($landlord->phone_number): ?>
                                    <div class="text-sm text-gray-500"><?php echo e($landlord->phone_number); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php
                                    $propertyCount = $landlord->properties->count();
                                ?>
                                <div class="text-sm text-gray-900"><?php echo e($propertyCount); ?> <?php echo e(Str::plural('property', $propertyCount)); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo e($landlord->pivot->updated_at->format('M d, Y')); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        
        <?php if($verifiedLandlords->count() > 5): ?>
            <div class="mt-4 text-center">
                <a href="<?php echo e(route('agent.landlords')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    View all landlords
                </a>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Verified Landlords Yet</h2>
            <p class="text-gray-500 mb-6">
                You need to connect with landlords before you can manage properties and tenants.
            </p>
            <a href="<?php echo e(route('agent.landlords')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Connect with Landlords
            </a>
        </div>
    <?php endif; ?>
    
    <!-- Bottom Spacing -->
    <div class="pb-20"></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rentsure\resources\views/agent/dashboard.blade.php ENDPATH**/ ?>