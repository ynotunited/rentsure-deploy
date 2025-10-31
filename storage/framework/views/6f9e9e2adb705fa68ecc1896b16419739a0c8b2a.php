<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-3xl font-bold">Admin Dashboard</h1>
    <p class="text-gray-600">Platform management and analytics</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Users Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
            <span class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e(array_sum($userCounts)); ?></span>
            <span class="text-gray-500 ml-2">users</span>
        </div>
        <div class="mt-4 flex flex-wrap gap-2">
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                <?php echo e($userCounts['tenants']); ?> Tenants
            </span>
            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                <?php echo e($userCounts['landlords']); ?> Landlords
            </span>
            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">
                <?php echo e($userCounts['agents']); ?> Agents
            </span>
            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
                <?php echo e($userCounts['admins']); ?> Admins
            </span>
        </div>
    </div>

    <!-- Properties Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Properties</h2>
            <span class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($propertyCount); ?></span>
            <span class="text-gray-500 ml-2"><?php echo e(Str::plural('property', $propertyCount)); ?></span>
        </div>
        <div class="mt-4">
            <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium">
                View property analytics
            </a>
        </div>
    </div>

    <!-- Verifications Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Pending Verifications</h2>
            <span class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($pendingVerifications + $pendingDocuments); ?></span>
            <span class="text-gray-500 ml-2">pending items</span>
        </div>
        <div class="mt-4 flex flex-wrap gap-2">
            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                <?php echo e($pendingVerifications); ?> Requests
            </span>
            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                <?php echo e($pendingDocuments); ?> Documents
            </span>
        </div>
    </div>

    <!-- Disputes Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Disputed Reviews</h2>
            <span class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </span>
        </div>
        <div class="flex items-baseline">
            <span class="text-3xl font-bold text-gray-900"><?php echo e($disputedReviews); ?></span>
            <span class="text-gray-500 ml-2"><?php echo e(Str::plural('dispute', $disputedReviews)); ?></span>
        </div>
        <div class="mt-4">
            <a href="<?php echo e(route('admin.reviews.disputes')); ?>" class="text-red-600 hover:text-red-800 text-sm font-medium">
                Resolve disputes
            </a>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mb-8">
    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="<?php echo e(route('admin.verifications')); ?>" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow flex items-center">
            <div class="mr-4">
                <span class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </span>
            </div>
            <div>
                <h3 class="font-medium">Process Verifications</h3>
                <p class="text-sm text-gray-500">Approve or reject NIN verification requests</p>
            </div>
        </a>

        <a href="<?php echo e(route('admin.documents')); ?>" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow flex items-center">
            <div class="mr-4">
                <span class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </span>
            </div>
            <div>
                <h3 class="font-medium">Verify Documents</h3>
                <p class="text-sm text-gray-500">Review and verify user documents</p>
            </div>
        </a>

        <a href="<?php echo e(route('admin.reviews.disputes')); ?>" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow flex items-center">
            <div class="mr-4">
                <span class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                    </svg>
                </span>
            </div>
            <div>
                <h3 class="font-medium">Handle Disputes</h3>
                <p class="text-sm text-gray-500">Resolve tenant review disputes</p>
            </div>
        </a>
    </div>
</div>

<!-- User Registration Chart -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-xl font-bold mb-4">User Registrations</h2>
    
    <div class="h-64 bg-gray-50 rounded border flex items-center justify-center">
        <p class="text-gray-500">User registration chart would be displayed here</p>
        <!-- In a real implementation, you would include a chart library like Chart.js -->
    </div>
    
    <div class="mt-4 text-right">
        <a href="<?php echo e(route('admin.analytics')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
            View detailed analytics
        </a>
    </div>
</div>

<!-- Recent Activity -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Recent Activity</h2>
        <a href="<?php echo e(route('admin.users')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
            View all users
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Joined
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__currentLoopData = \App\Models\User::latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <?php if($user->role === 'tenant'): ?>
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-green-600"><?php echo e(substr($user->name, 0, 1)); ?></span>
                                        </div>
                                    <?php elseif($user->role === 'landlord'): ?>
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-blue-600"><?php echo e(substr($user->name, 0, 1)); ?></span>
                                        </div>
                                    <?php elseif($user->role === 'agent'): ?>
                                        <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-purple-600"><?php echo e(substr($user->name, 0, 1)); ?></span>
                                        </div>
                                    <?php else: ?>
                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-gray-600"><?php echo e(substr($user->name, 0, 1)); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo e($user->name); ?>

                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php echo e($user->email); ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($user->role === 'tenant'): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Tenant
                                </span>
                            <?php elseif($user->role === 'landlord'): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Landlord
                                </span>
                            <?php elseif($user->role === 'agent'): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    Agent
                                </span>
                            <?php else: ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Admin
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($user->verified): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Verified
                                </span>
                            <?php else: ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Unverified
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php echo e($user->created_at->format('M d, Y')); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="<?php echo e(route('admin.user.edit', $user)); ?>" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rentsure\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>