

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin: auto;
    border:1px solid #ccc;
   }
  </style>
</head>
<body>
  <div class="container box" >
    <h3 align="center">Choose Drug details </h3>
    <br>
    <div class="form-group">
    <label>Enter the Drug Name</label>
      <select name="drug_name" id="select_drug_name" class="form-control input-lg "
      data-dependent="drug_type">
      @foreach($drugs_list as $drug)
     <option value="{{ $drug -> drug_name }}">{{ $drug -> drug_name }}</option>
     @endforeach
    </select>
    </div>
    <br>
    <div class="form-group">
    <label>Enter the Drug Type</label>
      <select name="drug_type" id="select_drug_type" class="form-control input-lg "
      data-dependent="drug_type">
      @foreach($drugs_list as $drug)
     <option value="{{ $drug -> drug_type }}">{{ $drug -> drug_type }}</option>
     @endforeach
    </select>
    </div>
    <br>
    <div class="form-group">
    <label>Enter the Quantity</label>
          <input type="text" name="select_drug_price" id="select_drug_price" class="form-control" placeholder="Quantity" />
      </div>
    
  </div>

<script type="text/javascript">
$(document).ready(function() {
$('#select_drug_name').select2(
  {
    placeholder:'Drug Name',
    allowClear: true,
    tags: true
  }
);
$('#select_drug_type').select2(
  {
    placeholder:'Drug type',
    allowClear: true,
    tags: true
  }
);


});

</script>
</body>
</html>