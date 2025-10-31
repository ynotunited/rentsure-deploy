<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="px-4 py-6 max-w-md mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Hi, <?php echo e(Auth::user()->name); ?> 👋</h1>
                    <p class="text-gray-600 dark:text-gray-400">Welcome to your verification center</p>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-8">
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 rounded-full text-sm font-medium flex items-center space-x-2">
                    <span>😊</span>
                    <span>All</span>
                </button>
                <button class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-full text-sm font-medium flex items-center space-x-2 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <span>👨</span>
                    <span>Verification</span>
                </button>
                <button class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-full text-sm font-medium flex items-center space-x-2 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <span>👩</span>
                    <span>Documents</span>
                </button>
            </div>
        </div>

        <!-- Main Cards Grid -->
        <div class="grid grid-cols-1 gap-4 mb-6">
            <!-- Verification Status Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="gradient-purple rounded-xl p-4 text-white mb-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold mb-1">Verification</h3>
                            <p class="text-white/80 text-sm">Status</p>
                        </div>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">NIN Verification</span>
                        <?php if(Auth::user()->nin): ?>
                            <span class="text-green-600 dark:text-green-400 text-sm font-medium">✓ Verified</span>
                        <?php else: ?>
                            <span class="text-red-600 dark:text-red-400 text-sm font-medium">Pending</span>
                        <?php endif; ?>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Verification Badge</span>
                        <?php if(Auth::user()->verification_badge): ?>
                            <span class="text-yellow-600 dark:text-yellow-400 text-sm font-medium">⭐ Verified</span>
                        <?php else: ?>
                            <span class="text-gray-600 dark:text-gray-400 text-sm font-medium">Not verified</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Documents Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="gradient-pink rounded-xl p-4 text-white mb-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold mb-1">Documents</h3>
                            <p class="text-white/80 text-sm">Upload & Verify</p>
                        </div>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <?php
                    $approvedDocs = Auth::user()->documents()->where('status', 'approved')->count();
                    $totalDocs = Auth::user()->documents()->count();
                ?>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Approved Documents</span>
                        <span class="text-gray-900 dark:text-white text-sm font-medium"><?php echo e($approvedDocs); ?>/<?php echo e($totalDocs); ?></span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-pink-500 h-2 rounded-full" style="width: <?php echo e($totalDocs > 0 ? ($approvedDocs / $totalDocs) * 100 : 0); ?>%"></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Secondary Cards Grid -->
        <div class="grid grid-cols-1 gap-4 mb-6">
            <!-- Profile Completion Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="gradient-orange rounded-xl p-4 text-white mb-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold mb-1">Profile</h3>
                            <p class="text-white/80 text-sm">Completion</p>
                        </div>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <?php
                    $completionScore = 0;
                    if(Auth::user()->nin) $completionScore += 25;
                    if(Auth::user()->phone_number) $completionScore += 25;
                    if(Auth::user()->address) $completionScore += 25;
                    if($approvedDocs > 0) $completionScore += 25;
                ?>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Profile Complete</span>
                        <span class="text-gray-900 dark:text-white text-sm font-medium"><?php echo e($completionScore); ?>%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: <?php echo e($completionScore); ?>%"></div>
                    </div>
                </div>
            </div>

            <!-- Trust Score Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="gradient-yellow rounded-xl p-4 text-white mb-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold mb-1">Trust Score</h3>
                            <p class="text-white/80 text-sm">Landlord Rating</p>
                        </div>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <?php
                    $trustScore = 0;
                    if(Auth::user()->nin) $trustScore += 30;
                    if(Auth::user()->verification_badge) $trustScore += 40;
                    if($approvedDocs > 0) $trustScore += 20;
                    if(Auth::user()->created_at->diffInMonths() > 6) $trustScore += 10;
                ?>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Trust Level</span>
                        <span class="text-gray-900 dark:text-white text-sm font-medium"><?php echo e($trustScore); ?>%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: <?php echo e($trustScore); ?>%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Quick Actions</h2>
                <button class="text-blue-600 dark:text-blue-400 text-sm font-medium hover:text-blue-700 dark:hover:text-blue-300">More →</button>
            </div>
            
            <!-- Action Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Upload Documents</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Complete your verification</p>
                    </div>
                    <button class="bg-purple-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-purple-700 transition-colors">START</button>
                </div>
            </div>
        </div>

        <!-- Document Upload Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Upload Documents</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Upload your documents for verification</p>
            </div>
        
        <div class="p-6">
            <form action="<?php echo e(route('documents.upload')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>
                
                <!-- Document Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Document Type</label>
                    <select id="type" name="type" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select document type</option>
                        <option value="live_photo">Live Photo (Selfie)</option>
                        <option value="id_document">ID Document</option>
                        <option value="rental_document">Rental Document</option>
                        <option value="proof_of_income">Proof of Income</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <!-- File Upload -->
                <div>
                    <label for="document" class="block text-sm font-medium text-gray-700 mb-2">Choose File</label>
                    <input type="file" id="document" name="document" required 
                           accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Supported formats: JPG, PNG, PDF, DOC, DOCX (Max: 10MB)</p>
                </div>
                
                <!-- Upload Button -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Upload Document
                </button>
            </form>
        </div>
    </div>

    <!-- Uploaded Documents -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Your Documents</h2>
        </div>
        
        <div class="p-6">
            <?php if(Auth::user()->documents()->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = Auth::user()->documents()->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <?php if($document->status === 'approved'): ?>
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    <?php elseif($document->status === 'rejected'): ?>
                                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    <?php else: ?>
                                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900"><?php echo e(ucfirst(str_replace('_', ' ', $document->type))); ?></h4>
                                    <p class="text-sm text-gray-500"><?php echo e($document->original_name); ?></p>
                                    <p class="text-xs text-gray-400">Uploaded <?php echo e($document->created_at->diffForHumans()); ?></p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    <?php if($document->status === 'approved'): ?> bg-green-100 text-green-800
                                    <?php elseif($document->status === 'rejected'): ?> bg-red-100 text-red-800
                                    <?php else: ?> bg-yellow-100 text-yellow-800 <?php endif; ?>">
                                    <?php echo e(ucfirst($document->status)); ?>

                                </span>
                                <?php if($document->admin_notes): ?>
                                    <p class="text-xs text-gray-500 mt-1"><?php echo e($document->admin_notes); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No documents uploaded</h3>
                    <p class="mt-1 text-sm text-gray-500">Upload your first document to get started with verification.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Request Verification Badge -->
    <?php if(!Auth::user()->verification_badge && !Auth::user()->hasPendingVerificationRequest()): ?>
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-medium text-blue-900">Ready for Verification?</h3>
                    <p class="text-sm text-blue-700 mt-1">
                        Once you've uploaded your documents, request a verification badge to build trust with landlords.
                    </p>
                </div>
                <div class="ml-4">
                    <form action="<?php echo e(route('verification.request')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Request Verification
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Bottom Spacing -->
    <div class="pb-20"></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rentsure\resources\views/tenant/dashboard.blade.php ENDPATH**/ ?>