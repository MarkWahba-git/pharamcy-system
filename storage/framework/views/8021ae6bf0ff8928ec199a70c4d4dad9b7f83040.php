<?php $__env->startSection('title', 'pharmacies'); ?>

<?php $__env->startSection('content_header'); ?>
    <center><h2><?php echo e($pharmacy->name); ?></h2></center>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-body">Name: <?php echo e($pharmacy->name); ?></div>
            <div class="card-body">Owner National ID: <?php echo e($pharmacy->owner_nat_id); ?></div>
            <div class="card-body">
                <table>
                    <tr>
                        <td>Adress:</td>
                        <td></td>
                        <td>Street Name:</td>
                        <td></td>
                        <td></td>
                        <td><?php echo e($pharmacy->street_name); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Building Number:</td>
                        <td></td>
                        <td></td>
                        <td><?php echo e($pharmacy->building_number); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Area:</td>
                        <td></td>
                        <td></td>
                        <td><?php echo e($pharmacy->area_id); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Priority Area:</td>
                        <td></td>
                        <td></td>
                        <td><?php echo e($pharmacy->priority_area_id); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marc/Desktop/ITI intake 40/php framwework-laravel/project/mark.wahba33-gmail.com/resources/views/pharmacies/show.blade.php ENDPATH**/ ?>