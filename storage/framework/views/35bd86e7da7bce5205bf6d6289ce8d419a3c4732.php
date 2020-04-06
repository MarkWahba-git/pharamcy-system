<?php $__env->startSection('title', 'pharmacies'); ?>

<?php $__env->startSection('content_header'); ?>
<a href="<?php echo e(route('pharmacies.create')); ?>" class="btn btn-success">Add pharmacy</a>
<center><h2>Pharmacies</h2></center>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Owner National Id</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pharmacies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pharmacy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($pharmacy->id); ?></th>
                            <td><?php echo e($pharmacy->name); ?></td>
                            <td><?php echo e($pharmacy->owner_nat_id); ?></td>
                            <td>
                                <a href="<?php echo e(route('pharmacies.show',['pharmacy' => $pharmacy->id])); ?>" type="button" class="btn btn-primary btn-xs">View</a>                                
                                <a type="button" class="btn btn-primary btn-xs">Edit</a>
                                <a type="button" class="btn btn-danger btn-xs">Delete</a>
                            </td>   
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script> console.log('Hi!'); </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marc/Desktop/ITI intake 40/php framwework-laravel/project/mark.wahba33-gmail.com/resources/views/pharmacies/index.blade.php ENDPATH**/ ?>