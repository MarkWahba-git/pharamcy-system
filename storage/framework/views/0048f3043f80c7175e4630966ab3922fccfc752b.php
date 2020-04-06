<?php $__env->startSection('title', 'pharmacies'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <form class="form-horizontal" method="post" action="<?php echo e(route('pharmacies.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="control-label col-sm" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter pharmacy's name" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm" for="street name">Street Name</label>
                <div class="col-sm-10">          
                    <input type="text" class="form-control" id="street_name" placeholder="Enter street's name" name="street_name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm" for="building number">Building Number</label>
                <div class="col-sm-10">          
                    <input type="number" class="form-control" id="building_number" placeholder="Enter building number" name="building_number" required>
                </div>
            </div>
            <label class="control-label col-sm" for="users">Owner</label>
            <select class="form-control" id="users">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value=<?php echo e($user->nat_id); ?>><?php echo e($user->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <br>
            <label class="control-label col-sm" for="areas">Area</label>
            <select class="form-control" id="areas">
            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value=<?php echo e($area->area_id); ?>><?php echo e($area->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <label class="control-label col-sm" for="priority_area">Priority Area</label>
            <select class="form-control" id="areas">
            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value=<?php echo e($area->area_id); ?>><?php echo e($area->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <br>
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marc/Desktop/ITI intake 40/php framwework-laravel/project/mark.wahba33-gmail.com/resources/views/pharmacies/create.blade.php ENDPATH**/ ?>