<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
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
    <h3 align="center">Orders</h3>
    <br />
    <div align="right">
        <button type="button" name="add" id="add_data" class="btn btn-success btn-sm">Add</button>
    </div>
    <br />
    <table id="orders_table" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID​ </th>
                <th> Ordered User Name</th>
                <th>Delivering Address</th>
                <th>Creation Date</th>
                <th>Doctor Name</th>
                <th>Is Insured</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
      
        </tbody>
    </table>
</div>
<!-- order inser -->
<div id="orderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="order_form">
           

                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Select User</h4>
                </div>
                <div class="modal-body">
                     
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>Select User</label>
                            <select name="user_id" class="form-control">
                            @foreach($orders as $order)   
                            <option value="{{$order->id}}">{{$order->name}}</option>
                            @endforeach
                            </select>
                
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {{ csrf_field() }}
               
            </form>
        </div>
    </div>
</div>
  <!-- order insert -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#orders_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('orders.getdata')}}",
        columns: [
            
            {data: 'id', name: 'orders.id'},
            {data: 'name', name: 'users.name'},
            {data: 'street_name', name: 'users.street_name'},
            {data: 'created_at', name: 'orders.created_at'},
            {data: 'doctor_name', name: 'doctors.doctor_name'},
            {data: 'is_insured', name:'orders.is_insured'},
            {data: 'status', name: 'orders.status'},
            {data: "action", orderable:false, searchable: false}

          

            
        ]
    });

    // insert
    $('#add_data').click(function(){
        $('#orderModal').modal('show');
        $('#order_form')[0].reset();
        $('#form_output').html('');
        $('#button_action').val('insert');
        $('#action').val('Add');
    });

    $('#order_form').on('submit', function(event){
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
                    $('#form_output').html(error_html);
                }
                else
                {
                    $('#form_output').html(data.success);
                    $('#order_form')[0].reset();
                    $('#action').val('Add');
                    $('.modal-title').text('Add Data');
                    $('#button_action').val('insert');
                    $('#orders_table').DataTable().ajax.reload();
                }
            }
        })
    });
    });
   
</script>

</body>
</html>