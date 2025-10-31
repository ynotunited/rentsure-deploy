<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Add New Property</h1>
    <a href="<?php echo e(route('landlord.properties')); ?>" class="text-blue-600 hover:text-blue-800">
        Back to Properties
    </a>
</div>

<div class="bg-white p-6 rounded-lg shadow-md">
    <form method="POST" action="<?php echo e(route('landlord.property.store')); ?>">
        <?php echo csrf_field(); ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Property Name</label>
                <input id="name" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required>
                
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div>
                <label for="property_type" class="block text-gray-700 text-sm font-bold mb-2">Property Type</label>
                <select id="property_type" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php $__errorArgs = ['property_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="property_type" required>
                    <option value="" disabled <?php echo e(old('property_type') ? '' : 'selected'); ?>>Select property type</option>
                    <option value="Apartment" <?php echo e(old('property_type') == 'Apartment' ? 'selected' : ''); ?>>Apartment</option>
                    <option value="House" <?php echo e(old('property_type') == 'House' ? 'selected' : ''); ?>>House</option>
                    <option value="Duplex" <?php echo e(old('property_type') == 'Duplex' ? 'selected' : ''); ?>>Duplex</option>
                    <option value="Flat" <?php echo e(old('property_type') == 'Flat' ? 'selected' : ''); ?>>Flat</option>
                    <option value="Bungalow" <?php echo e(old('property_type') == 'Bungalow' ? 'selected' : ''); ?>>Bungalow</option>
                    <option value="Commercial" <?php echo e(old('property_type') == 'Commercial' ? 'selected' : ''); ?>>Commercial</option>
                    <option value="Other" <?php echo e(old('property_type') == 'Other' ? 'selected' : ''); ?>>Other</option>
                </select>
                
                <?php $__errorArgs = ['property_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="md:col-span-2">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                <input id="address" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address" value="<?php echo e(old('address')); ?>" required>
                
                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div>
                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                <input id="city" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="city" value="<?php echo e(old('city')); ?>" required>
                
                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div>
                <label for="state" class="block text-gray-700 text-sm font-bold mb-2">State</label>
                <select id="state" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="state" required>
                    <option value="" disabled <?php echo e(old('state') ? '' : 'selected'); ?>>Select a state</option>
                    <option value="Abia" <?php echo e(old('state') == 'Abia' ? 'selected' : ''); ?>>Abia</option>
                    <option value="Adamawa" <?php echo e(old('state') == 'Adamawa' ? 'selected' : ''); ?>>Adamawa</option>
                    <option value="Akwa Ibom" <?php echo e(old('state') == 'Akwa Ibom' ? 'selected' : ''); ?>>Akwa Ibom</option>
                    <option value="Anambra" <?php echo e(old('state') == 'Anambra' ? 'selected' : ''); ?>>Anambra</option>
                    <option value="Bauchi" <?php echo e(old('state') == 'Bauchi' ? 'selected' : ''); ?>>Bauchi</option>
                    <option value="Bayelsa" <?php echo e(old('state') == 'Bayelsa' ? 'selected' : ''); ?>>Bayelsa</option>
                    <option value="Benue" <?php echo e(old('state') == 'Benue' ? 'selected' : ''); ?>>Benue</option>
                    <option value="Borno" <?php echo e(old('state') == 'Borno' ? 'selected' : ''); ?>>Borno</option>
                    <option value="Cross River" <?php echo e(old('state') == 'Cross River' ? 'selected' : ''); ?>>Cross River</option>
                    <option value="Delta" <?php echo e(old('state') == 'Delta' ? 'selected' : ''); ?>>Delta</option>
                    <option value="Ebonyi" <?php echo e(old('state') == 'Ebonyi' ? 'selected' : ''); ?>>Ebonyi</option>
                    <option value="Edo" <?php echo e(old('state') == 'Edo' ? 'selected' : ''); ?>>Edo</option>
                    <option value="Ekiti" <?php echo e(old('state') == 'Ekiti' ? 'selected' : ''); ?>>Ekiti</option>
                    <option value="Enugu" <?php echo e(old('state') == 'Enugu' ? 'selected' : ''); ?>>Enugu</option>
                    <option value="FCT" <?php echo e(old('state') == 'FCT' ? 'selected' : ''); ?>>Federal Capital Territory</option>
                    <option value="Gombe" <?php echo e(old('state') == 'Gombe' ? 'selected' : ''); ?>>Gombe</option>
                    <option value="Imo" <?php echo e(old('state') == 'Imo' ? 'selected' : ''); ?>>Imo</option>
                    <option value="Jigawa" <?php echo e(old('state') == 'Jigawa' ? 'selected' : ''); ?>>Jigawa</option>
                    <option value="Kaduna" <?php echo e(old('state') == 'Kaduna' ? 'selected' : ''); ?>>Kaduna</option>
                    <option value="Kano" <?php echo e(old('state') == 'Kano' ? 'selected' : ''); ?>>Kano</option>
                    <option value="Katsina" <?php echo e(old('state') == 'Katsina' ? 'selected' : ''); ?>>Katsina</option>
                    <option value="Kebbi" <?php echo e(old('state') == 'Kebbi' ? 'selected' : ''); ?>>Kebbi</option>
                    <option value="Kogi" <?php echo e(old('state') == 'Kogi' ? 'selected' : ''); ?>>Kogi</option>
                    <option value="Kwara" <?php echo e(old('state') == 'Kwara' ? 'selected' : ''); ?>>Kwara</option>
                    <option value="Lagos" <?php echo e(old('state') == 'Lagos' ? 'selected' : ''); ?>>Lagos</option>
                    <option value="Nasarawa" <?php echo e(old('state') == 'Nasarawa' ? 'selected' : ''); ?>>Nasarawa</option>
                    <option value="Niger" <?php echo e(old('state') == 'Niger' ? 'selected' : ''); ?>>Niger</option>
                    <option value="Ogun" <?php echo e(old('state') == 'Ogun' ? 'selected' : ''); ?>>Ogun</option>
                    <option value="Ondo" <?php echo e(old('state') == 'Ondo' ? 'selected' : ''); ?>>Ondo</option>
                    <option value="Osun" <?php echo e(old('state') == 'Osun' ? 'selected' : ''); ?>>Osun</option>
                    <option value="Oyo" <?php echo e(old('state') == 'Oyo' ? 'selected' : ''); ?>>Oyo</option>
                    <option value="Plateau" <?php echo e(old('state') == 'Plateau' ? 'selected' : ''); ?>>Plateau</option>
                    <option value="Rivers" <?php echo e(old('state') == 'Rivers' ? 'selected' : ''); ?>>Rivers</option>
                    <option value="Sokoto" <?php echo e(old('state') == 'Sokoto' ? 'selected' : ''); ?>>Sokoto</option>
                    <option value="Taraba" <?php echo e(old('state') == 'Taraba' ? 'selected' : ''); ?>>Taraba</option>
                    <option value="Yobe" <?php echo e(old('state') == 'Yobe' ? 'selected' : ''); ?>>Yobe</option>
                    <option value="Zamfara" <?php echo e(old('state') == 'Zamfara' ? 'selected' : ''); ?>>Zamfara</option>
                </select>
                
                <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="md:col-span-2">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Property Description (Optional)</label>
                <textarea id="description" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="description" rows="4"><?php echo e(old('description')); ?></textarea>
                
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add Property
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rentsure\resources\views/landlord/property/create.blade.php ENDPATH**/ ?>