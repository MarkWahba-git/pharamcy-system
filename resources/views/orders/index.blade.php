

<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
    
     <br>
     <div align="right">
     <button type="button" name="add_order_btn" id="add_order_btn" class="btn btn-success btn-sm">Add Order</button>
     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="order_table">
           <thead>
            <tr>
             
                <th width="10%">ID​</th>
                <th width="15%"> Ordered User Name</th>
                <th width="10%">Delivering Address</th>
                <th width="10%">Creation Date</th>
                <th width="10%">Doctor Name</th>
                <th width="10%">Is Insured</th>
                <th width="10%">Status</th>
                <th width="30%">Actions</th>
            </tr>
           </thead>
       </table>
    </div>
  </div>
  
  <div id="orderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <!--  -->
        <form method="post" id="order_form">
            
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Add Data</h4>
                </div>
                <div class="modal-body">
                {{csrf_field()}}
                    <span id="form_output"></span>
                    <div class="form-group">
                    <label for="">Users</label>
                    <select name="user_id" class="form-control">
                        @foreach($users as $user)  
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        
                        <option value="new">new</option>
                        <option value="processing">processing</option>
                        <option value="WaitingForUserConfirmation">WaitingForUserConfirmation</option>
                        <option value="Canceled">Canceled</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Delivered">Delivered</option>

                       
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="">Is Insured</label>
                    <select name="is_insured" class="form-control">
                        
                        <option value="0">NO</option>
                        <option value="1">Yes</option>
                       
                    </select>
                   </div>
                   <div class="form-group">
                   <label for="">Doctor</label>
                    <select name="doctor_id" class="form-control">
                        @foreach($doctors as $doctor)  
                        <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="">Pharmacy</label>
                    <select name="pharmacy_id" class="form-control">
                        @foreach($pharmacies as $pharmacy)  
                        <option value="{{$pharmacy->id}}">{{$pharmacy->name}}</option>
                        @endforeach
                    </select>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="hidden" name="order_id" id="order_id" value="" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                 
            </form>
       

        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {


    $('#add_order_btn').click(function(){
        $('#orderModal').modal('show');
        $('#order_form')[0].reset();
        $('#form_output').html('');
        $('#button_action').val('insert');
        $('#action').val('Add');
    });
    

     $('#order_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{route('orders.getdata')}}",
        "columns":[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'street_name', name: 'addresses.street_name'},
             {data: 'created_at', name: 'orders.created_at'},
             {data: 'doctor_name', name: 'doctors.doctor_name'},
             {data: 'is_insured', name:'orders.is_insured'},
             {data: 'status', name: 'orders.status'},
             {data: "action", orderable:false, searchable: false}
        ]
     });
   
$('#order_form').on('submit', function(event){
          event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"{{route('orders.postorder')}}",
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
                }   else
                {
                    $('#form_output').html(data.success);
                    $('#order_form')[0].reset();
                    $('#action').val('Add');
                    $('.modal-title').text('Add Data');
                    $('#button_action').val('insert');
                    $('#order_table').DataTable().ajax.reload();
                    setTimeout(function() {
                    $('#orderModal').modal('hide');
                    }, 1000);
                    
                }
            }
        })
    });
    $(document).on('click', '.edit', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        $.ajax({
            url:"{{route('orders.fetchorder')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {
                $('#user_id').val(data.user_id);
                $('#status').val(data.status);
                $('#is_insured').val(data.is_insured);
                $('#doctor_id').val(data.doctor_id);
                $('#pharmacy_id').val(data.pharmacy_id);

                $('#order_id').val(id);
                $('#orderModal').modal('show');
                $('#action').val('Edit');
                $('.modal-title').text('Edit Data');
                $('#button_action').val('update');
            }
        })
    });
    $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        if(confirm("Are you sure you want to Delete this Order?"))
        {
            $.ajax({
                url:"{{route('orders.removeorder')}}",
                mehtod:"get",
                data:{id:id},
                success:function(data)
                {
                    alert(data);
                    $('#order_table').DataTable().ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
    }); 

    $(document).on('click', '.adddrugs', function(){
        var id = $(this).attr('id');
        
            $.ajax({
                url:"{{route('drugs.orderdrugs')}}",
                mehtod:"POST",
                data:{id:id},
                success:function(data)
                {
                    alert(data);
                    $('#order_table').DataTable().ajax.reload();
                }
            })
        
    }); 
    

    
});

  

</script>
</body>
</html>
