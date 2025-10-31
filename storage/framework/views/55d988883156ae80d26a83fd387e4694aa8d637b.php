<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">My Properties</h1>
    <a href="<?php echo e(route('landlord.property.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Add New Property
    </a>
</div>

<?php if($properties->count() > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-600 py-4 px-6 text-white">
                    <h2 class="text-xl font-bold"><?php echo e($property->name); ?></h2>
                </div>
                
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-gray-600 mb-1">
                            <span class="font-medium">Address:</span> <?php echo e($property->address); ?>

                        </p>
                        <p class="text-gray-600 mb-1">
                            <span class="font-medium">Location:</span> <?php echo e($property->city); ?>, <?php echo e($property->state); ?>

                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">Type:</span> <?php echo e($property->property_type); ?>

                        </p>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex items-center mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-gray-700"><?php echo e($property->activeTenants()->count()); ?> active <?php echo e(Str::plural('tenant', $property->activeTenants()->count())); ?></span>
                        </div>
                        
                        <?php
                            $reviewCount = $property->reviews()->count();
                        ?>
                        
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <span class="text-gray-700"><?php echo e($reviewCount); ?> <?php echo e(Str::plural('review', $reviewCount)); ?> submitted</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-between items-center border-t pt-4">
                        <a href="<?php echo e(route('landlord.property.show', $property)); ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                            View Details
                        </a>
                        <div class="flex space-x-2">
                            <a href="<?php echo e(route('landlord.property.edit', $property)); ?>" class="text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            
                            <form method="POST" action="<?php echo e(route('landlord.property.destroy', $property)); ?>" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <h2 class="text-xl font-medium text-gray-600 mb-2">No Properties Added Yet</h2>
        <p class="text-gray-500 mb-6">
            You haven't added any properties to your account yet. Start by adding your first property.
        </p>
        <a href="<?php echo e(route('landlord.property.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Your First Property
        </a>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rentsure\resources\views/landlord/properties.blade.php ENDPATH**/ ?>