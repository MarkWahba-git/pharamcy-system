<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacies</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<button type="button" name="add" id="add_pharmacy" class="btn btn-success btn-sm">Add Pharmacy</button>
<br><br>
<div> 
    <table class="table table-bordered table-striped" id="pharmacy_table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Street Name</th>
            <th>Building Number</th>
            <th>Owner</th>
            <th>Area</th>
            <th>Action</th>
        </tr>
    </thead>
    </table>
</div>


<div id="pharmacyModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="pharmacy_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Pharmacy</h4>
                </div>
                <div class="modal-body">
                    <?php echo e(csrf_field()); ?>

                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="name" id="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Street Name</label>
                        <input type="text" name="street_name" id="street_name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Enter Building Number</label>
                        <input type="text" name="building_number" id="building_number" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Enter Owner</label>
                        <input type="text" name="nat_id" id="nat_id" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Enter Area</label>
                        <input type="text" name="area" id="area" class="form-control"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pharmacy_id" value=""/>
                    <input type="hidden" name="button_action" id="button_action" value="insert"/>
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-info"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#pharmacy_table').DataTable({
            "processing" : true,
            "serverSide" : true,
            "ajax"       : "<?php echo e(route('pharmacies.getPharmacies')); ?>",
            "columns"    : [
                { "data" : "name" },
                { "data" : "street_name" },
                { "data" : "building_number" },
                { "data" : "owner_id" },
                { "data" : "area_id" },
                { "data" : "action" , orderable:false , searchable:false },
            ],
        });

        $('#add_pharmacy').click(function(){
            $('#pharmacyModal').modal('show');
            $('#pharmacy_form')[0].reset();
            $('#form_output').html('');
            $('#button_action').val('insert');
            $('#action').val('Add');
        });

        $('#pharmacy_form').on('submit',function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url : '<?php echo e(route("pharmacies.postPharmacies")); ?>',
                method : "POST",
                data : form_data,
                dataType : "json",
                success:function(data)
                {
                    if(data.error.length > 0)
                    {
                        var error_html = '';
                        for(var count=0 ; count<data.error.length ; count++)
                        {
                            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                        }
                        $('#form_output').html(error_html);
                    }
                    else
                    {
                        $('#form_output').html(data).success;
                        $('#pharmacy_form')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add Pharmacy');
                        $('#button_action').val('insert');
                        $('#pharmacy_table').DataTable().ajax.reload();
                    }
                }
            })
        });

        $(document).on('click','.edit',function(){
            var id = $(this).attr("id");
            $.ajax({
                url         : "<?php echo e(route('pharmacies.fetchPharmacies')); ?>",
                method      : 'get',
                data        : {id:id},
                dataType    : 'json',
                success:function(data)
                {
                    $('#name').val(data.name);
                    $('#street_name').val(data.street_name);
                    $('#building_number').val(data.building_number);
                    $('#owner_id').val(data.nat_id);
                    $('#area_id').val(data.area_id);
                    $('#pharmacy_id').val(id);
                    $('#pharmacyModal').modal('show');
                    $('#action').val('Edit');
                    $('.modal-title').text('Edit Pharmacy');
                    $('#button_action').val('update');
                }
            })
        });

        $(document).on('click','delete',function(){
            var id = $(this).attr('id');
            if(confirm("Are you sure you want to Delete this Pharmacy?"))
            {
                $.ajax({
                    url         : "<?php echo e(route('pharmacies.removePharmacy')); ?>",
                    method      : "get",
                    data        : {id:id},
                    success:function(data)
                    {
                        alert(data);
                        $('#pharmacy_table').DataTable.ajax.reload();   
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
</html><?php /**PATH /home/marc/Desktop/pharmacy-system/pharamcy-system/resources/views/pharmacies/index.blade.php ENDPATH**/ ?>