<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Make a Drug Order </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <form>
        <section>
          <div class="panel panel-header">
            <div class="row">
              <div class="col-md-3">
              <div class="form-group">
              <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
             </div>
             </div>
             <!-- -------------------------------------------------->
             <div class="col-md-3">
              <div class="form-group">
              <input type="text" name="customer_address" class="form-control" placeholder="Customer Address">
             </div>
             </div>
              <!-- -------------------------------------------------->
              <div class="col-md-3">
              <div class="form-group">
              <input type="text" name="drug_type" class="form-control" placeholder="Drug Type">
             </div>
             </div>
              <!-- -------------------------------------------------->
              

          </div>
          </div>
          <div class="panel paner-footer">
            <table class="table" table-bordered>
              <thead>
                <tr>
                  <th>Drug Name</th>
                  <th>Drug Type</th>
                  <th>Quantity</th>
                  <th>Price/unit</th>
                  <th><a href="#" class="AddRow"><i class="glyphicon glyphicon-plus"></i> </a></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                  <select name="drug_name[]"  class="form-control input-lg select_drug_name "
                  >
                  <?php $__currentLoopData = $drugs_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($drug -> drug_name); ?>"><?php echo e($drug -> drug_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
                  </td>
                  <!-- -------------------------------------------------->
                  <td>
                  <select name="drug_type[]"  class="form-control input-lg select_drug_type"
                  >
                  <?php $__currentLoopData = $drugs_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($drug -> drug_type); ?>"><?php echo e($drug -> drug_type); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
                  </td>
                  <!-- -------------------------------------------------->
                  <td>
                  <input type="text" name="drug_qty[]" class="form-control" placeholder="Quantity">
                  </td>
                  <!-- -------------------------------------------------->
                  <td>
                  <select name="drug_unit_price[]"  class="form-control input-lg select_drug_unit_price "
                  >
                  <?php $__currentLoopData = $drugs_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($drug -> drug_unit_price); ?>"><?php echo e($drug -> drug_unit_price); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
                  </td>
                  <!-- -------------------------------------------------->
                  <td>
                    <a href="#" class="btn btn-danger remove "><i class="glyphicon glyphicon-remove"></i></a>
                  </td>

                  
                </tr>
                
              </tbody>

            </table>

          </div>
        </section>
      </form>
    </div>


  </div>
  <script type="text/javascript">
$(document).ready(function() {
$('.select_drug_name').select2(
  {
    placeholder:'Drug Name',
    allowClear: true,
    tags: true
  }
);
$('.select_drug_type').select2(
  {
    placeholder:'Drug Type',
    allowClear: true,
    tags: true
  }
);
$('.select_drug_unit_price').select2(
  {
    placeholder:'Drug Type',
    allowClear: true,
    tags: true
  }
);
$('.AddRow').on('click',function(){
  addRow();

});
function addRow()
{
var tr =    '<tr>'+
                  '<td>'+
                  '<select name="drug_name[]"  class="form-control input-lg select_drug_name "'+
                  '>'+
                  '<?php $__currentLoopData = $drugs_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'+
                  '<option value="<?php echo e($drug -> drug_name); ?>"><?php echo e($drug -> drug_name); ?></option>'+
                  '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>'+
                 '</select>'+
                  '</td>'+
                  '<!-- -------------------------------------------------->'+
                 '<td>'+
                  '<select name="drug_type[]"  class="form-control input-lg select_drug_type"'+
                  '>'+
                  '<?php $__currentLoopData = $drugs_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'+
                  '<option value="<?php echo e($drug -> drug_type); ?>"><?php echo e($drug -> drug_type); ?></option>'+
                  '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>'+
                 '</select>'+
                  '</td>'+
                  '<!-- -------------------------------------------------->'+
'                  <td>'+
                  '<input type="text" name="drug_qty[]" class="form-control" placeholder="Quantity">'+
                  '</td>'+
                  '<!-- -------------------------------------------------->'+
                 ' <td>'+
                  '<select name="drug_unit_price[]"  class="form-control input-lg select_drug_unit_price "'+
                  '>'+
                  '<?php $__currentLoopData = $drugs_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>'+
                  '<option value="<?php echo e($drug -> drug_unit_price); ?>"><?php echo e($drug -> drug_unit_price); ?></option>'+
                 ' <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>'+
                 '</select>'+
                 ' </td>'+
                  '<!-- -------------------------------------------------->'+
                  '<td>'+
                   ' <a href="#" class="btn btn-danger remove "><i class="glyphicon glyphicon-remove"></i></a>'+
                  '</td>'+
                '</tr>';
                var temp = '<tr><td><select name="drug_unit_price[]"  class="form-control input-lg select_drug_unit_price " </td></tr>';
            $('tbody').append(tr    );

}

});
</script>
</body>
</html><?php /**PATH /home/non/Documents/ITI/Laravel/LaravleProject/mark.wahba33-gmail.com/resources/views/drugs/order_drugs.blade.php ENDPATH**/ ?>