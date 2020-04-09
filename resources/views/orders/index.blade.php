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
            {data: 'is_insured', name:'orders.is_insured'},
            {data: 'status', name: 'orders.status'},
            
          

            
        ]
    });
    });
   
</script>

</body>
</html>