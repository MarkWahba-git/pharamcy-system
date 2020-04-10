<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .container{
            margin-top: 100px !important;
        } */
         #doctor{
            margin-top: 100px !important;
        }
      
    </style>
    <title>Doctor</title>
</head>
<body>



   <h3 class="d-flex justify-content-center" id="doctor">Doctors</h3>
<div class="container" id='container'>
<a href="<?php echo e(route('doctorstab.create')); ?>" class="btn btn-success  m-5">Create Doctor</a>

  <div class="row">
        <table class="table table-dark">
        <thead>
            <tr class="text-center">
            <th scope="col" >Name</th>
            <th scope="col" >Created at</th>
            <th scope="col" >Image</th>
            <th scope="col" >Email</th>
            <th scope="col" >National id</th>
            <th scope="col" >Is Banned</th>
            <th scope="col" >Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-center">
            <td scope="row"><?php echo e($doctor->name); ?></td>
            
            <td><?php echo e($doctor->created_at->toDateString()); ?></td>
                <td>
                <img src="doctorstab/fetch_image/<?php echo e($doctor->id); ?>" class="img-thumbnail" width="75" />

                </td>
                <td><?php echo e($doctor->email); ?></td> 
                <td><?php echo e($doctor->nat_id); ?></td> 
                <td><?php echo e($doctor->is_banned==1 ?'un banned':'banned'); ?></td> 
                <td>
                <div class="row">
                <?php if($doctor->is_banned==1): ?>
                   
                <form action="<?php echo e(route('doctorstab.ban',$doctor->id)); ?>" method="POST"> 
                 <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="col-2 mr-1">

                <input  type="hidden" class="btn btn-primary" name="is_banned" value="0">

                <input  type="submit" class="btn btn-primary" value="Bann">

                </div>
                </form>
                <?php else: ?>
                <form action="<?php echo e(route('doctorstab.ban',$doctor->id)); ?>" method="POST">

                 <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="col-2 mr-1">
                <input  type="hidden" class="btn btn-primary" name="is_banned" value="1">

                <input  type="submit" class="btn btn-primary" value="un Bann">

                </div>
                </form>
                <?php endif; ?>
                <div class="col-2 mr-3">
                <a href="<?php echo e(route('doctorstab.edit',$doctor->id)); ?>" class="btn btn-primary ">Edit</a>
                </div>
                <div class="col-2">
                <form action="<?php echo e(route('doctorstab.destroy',$doctor->id)); ?>" method="POST"> 
                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?><button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure that you want to delete this doctor ?')">Delete </button>
                </form>
                </div>
                </div>
                </td>
            </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
        </tbody>
        </table>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
</body>
</html><?php /**PATH /media/ahmed/edu/ITI/laravel/laravel-project/mark.wahba33-gmail.com/resources/views/doctorstab/index.blade.php ENDPATH**/ ?>