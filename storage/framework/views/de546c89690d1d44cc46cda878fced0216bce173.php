<?php $__env->startSection('title', 'Manage Users'); ?>

<?php $__env->startSection('content_header'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<center><h2>Manage Users</h2></center>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<a href="javascript:void(0)" class="btn btn-info ml-3" id="add_user">Add User</a>
<br><br>
  
<table class="table table-bordered table-striped" id="laravel_datatable">
   <thead>
      <tr>
         <th>National ID</th>
         <th>Name</th>
         <th>Email</th>
         <th>Password</th>
         <th>Role</th>
         <th>Street Name</th>
         <th>Building Number</th>
         <th>Floor Number</th>
         <th>Flat Number</th>
         <th>Area</th>
      </tr>
   </thead>
</table>
</div>
  
<div class="modal fade" id="ajax-user-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="userCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="userForm" name="userForm" class="form-horizontal">
           <input type="hidden" name="user_id" id="user_id">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Tilte" value="" maxlength="50" required="">
                </div>
            </div> 
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">user Code</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="user_code" name="user_code" placeholder="Enter Tilte" value="" maxlength="50" required="">
                </div>
            </div>
  
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" required="">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
         
    </div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
var SITEURL = '<?php echo e(URL::to('')); ?>';
 $(document).ready( function () {
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('#laravel_datatable').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: SITEURL + "user-list",
          type: 'GET',
         },
         columns: [
                  {data: 'id', name: 'id', 'visible': false},
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'title', name: 'title' },
                  { data: 'user_code', name: 'user_code' },
                  { data: 'description', name: 'description' },
                  { data: 'created_at', name: 'created_at' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });
 
 /*  When user click add user button */
    $('#create-new-user').click(function () {
        $('#btn-save').val("create-user");
        $('#user_id').val('');
        $('#userForm').trigger("reset");
        $('#userCrudModal').html("Add New user");
        $('#ajax-user-modal').modal('show');
    });
  
   /* When click edit user */
    $('body').on('click', '.edit-user', function () {
      var user_id = $(this).data('id');
      $.get('user-list/' + user_id +'/edit', function (data) {
         $('#title-error').hide();
         $('#user_code-error').hide();
         $('#description-error').hide();
         $('#userCrudModal').html("Edit user");
          $('#btn-save').val("edit-user");
          $('#ajax-user-modal').modal('show');
          $('#user_id').val(data.id);
          $('#title').val(data.title);
          $('#user_code').val(data.user_code);
          $('#description').val(data.description);
      })
   });
 
    $('body').on('click', '#delete-user', function () {
  
        var user_id = $(this).data("id");
        
        if(confirm("Are You sure want to delete !")){
          $.ajax({
              type: "get",
              url: SITEURL + "user-list/delete/"+user_id,
              success: function (data) {
              var oTable = $('#laravel_datatable').dataTable(); 
              oTable.fnDraw(false);
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
        }
    }); 
   
   });
  
if ($("#userForm").length > 0) {
      $("#userForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
       
      $.ajax({
          data: $('#userForm').serialize(),
          url: SITEURL + "user-list/store",
          type: "POST",
          dataType: 'json',
          success: function (data) {
  
              $('#userForm').trigger("reset");
              $('#ajax-user-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
               
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
</script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marc/Desktop/pharmacy-system/pharamcy-system/resources/views/users/index.blade.php ENDPATH**/ ?>