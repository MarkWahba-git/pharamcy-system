<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <button type="button" name="add" id="add_user" class="btn btn-success btn-sm">Add User</button>
    <br><br>
    <div> 
        <table class="table table-bordered table-striped" id="user_table">
        <thead>
            <tr>
                <th>National ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Of Birth</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Password</th>
                <th>Role</th>
                <th>Avatar</th>
                <th>Is Banned</th>
                <th>Action</th>
            </tr>
        </thead>
        </table>
    </div>


    <div id="userModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="user_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add User</h4>
                    </div>
                    <div class="modal-body">
                        <?php echo e(csrf_field()); ?>

                        <span id="form_output"></span>
                        <div class="form-group">
                            <label>Enter National ID</label>
                            <input type="text" name="nat_id" id="nat_id" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Enter Name</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Enter Email</label>
                            <input type="text" name="email" id="email" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Enter Date Of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Choose Gender</label>
                            <br>
                            <input type="radio" name="gender" id="male" />
                            <label for="male">Male</label>
                            <br>
                            <input type="radio" name="gender" id="female" />
                            <label for="female">Female</label>
                        </div>
                        <div class="form-group">
                            <label>Enter Phone Number</label>                        
                            <input type="text" id="phone_number" name="phone_number" placeholder="+20-1x-xxxx-xxxx" 
                            required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Enter Password</label>
                            <input type="text" name="password" id="password" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="role">Select Role</label>
                            <select id="role" name="role" class="form-control">
                                <option value="Doctor">Doctor</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Enter Avatar</label>
                            <input type="text" name="avatar" id="avatar" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Banned or Ubanned</label>
                            <br>
                            <input type="radio" name="is_banned" id="1" />
                            <label for="1">Banned</label>
                            <br>
                            <input type="radio" name="is_banned" id="0" />
                            <label for="0">Unbanned</label>                    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" value=""/>
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
        $('#user_table').DataTable({
            "processing" : true,
            "serverSide" : true,
            "ajax"       : "<?php echo e(route('users.getUsers')); ?>",
            "columns"    : [
                { "data" : "nat_id" },
                { "data" : "name" },
                { "data" : "email" },
                { "data" : "dob" },
                { "data" : "gender" },
                { "data" : "phone_number" },
                { "data" : "password" },
                { "data" : "role" },
                { "data" : "avatar" },
                { "data" : "is_banned" },
                { "data" : "action" , orderable:false , searchable:false },
            ],
        });

        $('#add_user').click(function(){
            $('#userModal').modal('show');
            $('#user_form')[0].reset();
            $('#form_output').html('');
            $('#button_action').val('insert');
            $('#action').val('Add');
        });

        $('#user_form').on('submit',function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url : '<?php echo e(route("users.postUsers")); ?>',
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
                        $('#user_form')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add User');
                        $('#button_action').val('insert');
                        $('#user_table').DataTable().ajax.reload();
                    }
                }
            })
        });

        $(document).on('click','.edit',function(){
            var id = $(this).attr("id");
            $.ajax({
                url         : "<?php echo e(route('users.fetchUsers')); ?>",
                method      : 'get',
                data        : {id:id},
                dataType    : 'json',
                success:function(data)
                {
                    $('#nat_id').val(data.nat_id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#dob').val(data.dob);
                    $('#gender').val(data.gender);
                    $('#phone_number').val(data.phone_number);
                    $('#password').val(data.password);
                    $('#role').val(data.role);
                    $('#avatar').val(data.avatar);
                    $('#is_banned').val(data.is_banned);
                    $('#user_id').val(id);
                    $('#userModal').modal('show');
                    $('#action').val('Edit');
                    $('.modal-title').text('Edit User');
                    $('#button_action').val('update');
                }
            })
        });

        $(document).on('click','delete',function(){
            var id = $(this).attr('id');
            if(confirm("Are you sure you want to Delete this User?"))
            {
                $.ajax({
                    url         : "<?php echo e(route('users.removeUser')); ?>",
                    method      : "get",
                    data        : {id:id},
                    success:function(data)
                    {
                        alert(data);
                        $('#user_table').DataTable.ajax.reload();   
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
</html><?php /**PATH /home/marc/Desktop/pharmacy-system/pharamcy-system/resources/views/users/index.blade.php ENDPATH**/ ?>