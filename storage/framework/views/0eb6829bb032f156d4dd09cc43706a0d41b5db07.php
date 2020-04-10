<?php $__env->startSection('title', 'Manage Doctors'); ?>

<?php $__env->startSection('content_header'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<center><h2>Manage Doctors</h2></center>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<a href="https://www.google.com" class="btn btn-secondary">Back to Post</a>
<a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-doctor">Add New</a>
<br><br>
  
<table class="table table-bordered table-striped" id="laravel_datatable">
   <thead>
      <tr>
         <th>ID</th>
         <th>S. No</th>
         <th>Title</th>
         <th>Doctor Code</th>
         <th>Description</th>
         <th>Created at</th>
         <th>Action</th>
      </tr>
   </thead>
</table>
</div>
  
<div class="modal fade" id="ajax-doctor-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="doctorCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="doctorForm" name="doctorForm" class="form-horizontal">
           <input type="hidden" name="doctor_id" id="doctor_id">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Tilte" value="" maxlength="50" required="">
                </div>
            </div> 
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Doctor Code</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="doctor_code" name="doctor_code" placeholder="Enter Tilte" value="" maxlength="50" required="">
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
          url: SITEURL + "doctor-list",
          type: 'GET',
         },
         columns: [
                  {data: 'id', name: 'id', 'visible': false},
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'title', name: 'title' },
                  { data: 'doctor_code', name: 'doctor_code' },
                  { data: 'description', name: 'description' },
                  { data: 'created_at', name: 'created_at' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });
 
 /*  When user click add user button */
    $('#create-new-doctor').click(function () {
        $('#btn-save').val("create-doctor");
        $('#doctor_id').val('');
        $('#doctorForm').trigger("reset");
        $('#doctorCrudModal').html("Add New Doctor");
        $('#ajax-doctor-modal').modal('show');
    });
  
   /* When click edit user */
    $('body').on('click', '.edit-doctor', function () {
      var doctor_id = $(this).data('id');
      $.get('doctor-list/' + doctor_id +'/edit', function (data) {
         $('#title-error').hide();
         $('#doctor_code-error').hide();
         $('#description-error').hide();
         $('#doctorCrudModal').html("Edit Doctor");
          $('#btn-save').val("edit-doctor");
          $('#ajax-doctor-modal').modal('show');
          $('#doctor_id').val(data.id);
          $('#title').val(data.title);
          $('#doctor_code').val(data.doctor_code);
          $('#description').val(data.description);
      })
   });
 
    $('body').on('click', '#delete-doctor', function () {
  
        var doctor_id = $(this).data("id");
        
        if(confirm("Are You sure want to delete !")){
          $.ajax({
              type: "get",
              url: SITEURL + "doctor-list/delete/"+doctor_id,
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
  
if ($("#doctorForm").length > 0) {
      $("#doctorForm").validate({
  
     submitHandler: function(form) {
  
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
       
      $.ajax({
          data: $('#doctorForm').serialize(),
          url: SITEURL + "doctor-list/store",
          type: "POST",
          dataType: 'json',
          success: function (data) {
  
              $('#doctorForm').trigger("reset");
              $('#ajax-doctor-modal').modal('hide');
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







<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marc/Desktop/pharmacy-system/pharamcy-system/resources/views/doctor/list.blade.php ENDPATH**/ ?>