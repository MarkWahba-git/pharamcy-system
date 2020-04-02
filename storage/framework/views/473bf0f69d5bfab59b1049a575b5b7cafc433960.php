

<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 5.8 - DataTables Server Side Processing using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">Laravel 5.8 Ajax Crud Tutorial - Delete or Remove Data</h3>
     <br />
     <div align="right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
     </div>
     <br />
     <button type="button" name="add_drug_btn" id="add_drug_btn" class="btn btn-success btn-sm">Add Drug</button>
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="drug_table">
           <thead>
            <tr>
             
                <th width="35%">Drug Name</th>
                <th width="35%">Drug Type</th>
                <th width="30%">Unit Price</th>
            </tr>
           </thead>
       </table>
    </div>
  </div>
  <div id="drugModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="add_drug_form">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Add Drug</h4>
                </div>
                <div class="modal-body">
                    <?php echo e(csrf_field()); ?>

                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>Enter the Drug Name</label>
                        <input type="text" name="form_drug_name" id="form_drug_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter the Drug Type</label>
                        <input type="text" name="form_drug_name" id="form_drug_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter the Drug Price </label>
                        <input type="text"placeholder="$" name="form_drug_unit_price" id="form_drug_unit_price" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="button_action" id="button_action" value="create" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('#add_drug_btn').click(function(){
        $('#drugModal').modal('show');
        $('#add_drug_form')[0].reset();
        $('#form_output').html('');
        $('#button_action').val('create');
        $('#action').val('Add');
    });
$('#drug_table').DataTable({
 processing: true,
 serverSide: true, 
 ajax:{
  url: "<?php echo e(route('drugs.getdrugs')); ?>",
 },
 columns:[
  {
   data: 'drug_name',
  },
  {
   data: 'drug_type',
  },
  {
    data: 'drug_unit_price'
  },
 
 ]
});
});

</script>
</body>

<?php /**PATH /home/non/Documents/ITI/Laravel/LaravleProject/mark.wahba33-gmail.com/resources/views/drugs/index.blade.php ENDPATH**/ ?>