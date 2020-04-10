<!DOCTYPE html>
<html lang="en">
<head>
  
  <title> Inventory </title>
<link rel="stylesheet" href="/css/admin_custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"defer></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<div class="container">    
     <br />
     <h3 align="center">Our inventory of Drugs</h3>
     <br />
     <div align="right">
     <button type="button" name="add_drug_btn" id="add_drug_btn" class="btn btn-success btn-sm">Add Drug</button>
     </div>
     <br />
     
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="drug_table">
           <thead>
            <tr>
             
                <th width="25%">Drug Name</th>
                <th width="25%">Drug Type</th>
                <th width="25%">Unit Price</th>
                <th width="25%">Actions</th>
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
                    {{csrf_field()}}
                    <span id="form_error_output"></span>
                    <div class="form-group">
                        <label>Enter the Drug Name</label>
                        <input type="text" name="form_drug_name" id="form_drug_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter the Drug Type</label>
                        <input type="text" name="form_drug_type" id="form_drug_type" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter the Drug Price </label>
                        <input type="text"placeholder="$" name="form_drug_unit_price" id="form_drug_unit_price" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- a hidden input to check for it's type later C, R, U, or D -->
                    <input type="hidden" name="button_action" id="button_action" value="create" />
                    <input type="hidden" name="form_drug_id" id="form_drug_id" value="" />
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
        $('#form_error_output').html('');
        $('#button_action').val('create');
        $('#action').val('Add');
    });

    $('#add_drug_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"{{ route('drugs.postdrugs') }}",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
                if(data.error.length > 0)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#form_error_output').html(error_html);
                }
                else
                {
                    $('#form_error_output').html(data.success);
                    $('#add_drug_form')[0].reset();
                    $('#action').val('Add');
                    $('.modal-title').text('Add Data');
                    $('#button_action').val('create');
                    $('#drug_table').DataTable().ajax.reload();
                    setTimeout(function() {
                    $('#drugModal').modal('hide');
                    }, 1000);
                }

            }
        })
        
    });

$('#drug_table').DataTable({
 processing: true,
 serverSide: true, 
 ajax:{
  url: "{{ route('drugs.getdrugs') }}",
 },
 columns:[
  {
   data: 'drug_name',
  },
  {
   data: 'drug_type',
  },
  { 
      data: 'drug_unit_price', render: function (data, type, row) {
             return '$ '+ data /1000 ;
            } },
    {
    data: "action", orderable:false, searchable: false
    }

 
 ]
});

$(document).on('click', '.edit', function(){
        var id = $(this).attr("id");
        $('#form_error_output').html('');
        $.ajax({
            url:"{{route('drugs.fetchdrugs')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {
                $('#form_drug_name').val(data.drug_name);
                $('#form_drug_type').val(data.drug_type);
                $('#form_drug_unit_price').val(data.drug_unit_price);
                $('#form_drug_id').val(id);
                $('#drugModal').modal('show');
                $('#action').val('Edit');
                $('.modal-title').text('Edit Data');
                $('#button_action').val('update');
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        if(confirm("Are you sure you want to Delete this Drug?"))
        {
            $.ajax({
                url:"{{route('drugs.deletedrugs')}}",
                mehtod:"get",
                data:{id:id},
                success:function(data)
                {
                    alert(data);
                    $('#drug_table').DataTable().ajax.reload();
                    setTimeout(function() {
                    $('#drugModal').modal('hide');
                    }, 1000);
                }
            })
        }
        else
        {
            return false;
        }
    }); 




});

</script>
</body>
</html>
