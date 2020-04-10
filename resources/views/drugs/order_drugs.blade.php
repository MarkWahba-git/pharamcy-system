<body>
  <div class="container" >
    <div class="row">
    <br>
      <form action="{{ route('drugs.store',['order_id'=>$order_id ,1])}}" method="POST">
      @csrf
    @method('POST')
        <section>
          <div class="panel panel-header">
            <div class="row" >
            <label for="">{{ $order_id }}</label>
          </div>
          
          <div class="panel paner-footer">
            <table class="table" table-bordered style="background-color: #f0f0f0;">
              <thead>
                <tr>
                  <th>Drug Name</th>
                  <th>Drug Type</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Amount</th>
                  <th><a href="#" class="AddRow"><i class="glyphicon glyphicon-plus"></i> </a></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                  <select name="drug_name[]"  class="form-control input-lg select_drug_name "
                  >
                  @foreach($drugs_list as $drug)
                  <option value="{{ $drug -> drug_name }}">{{ $drug -> drug_name }}</option>
                  @endforeach
                 </select>
                  </td>
                  <!-- -------------------------------------------------->
                  <td>
                  <select name="drug_type[]"  class="form-control input-lg select_drug_type"
                  >
                  @foreach($drugs_list as $drug)
                  <option value="{{ $drug -> drug_type }}">{{ $drug -> drug_type }}</option>
                  @endforeach
                 </select>
                  </td>
                  <!-- -------------------------------------------------->
                  <td>
                  <input type="text" name="drug_qty[]" class="form-control select_drug_qty" placeholder="Quantity">
                  </td>
                  <!-- -------------------------------------------------->
                  <td>
                  <select name="drug_unit_price[]"  class="form-control input-lg select_drug_unit_price "
                  >
                  @foreach($drugs_list as $drug)
                  <option value="{{ $drug -> drug_unit_price }}">{{ $drug -> drug_unit_price /1000 }}</option>
                  @endforeach
                 </select>
                  </td>
                  <!-- -------------------------------------------------->
                   
                   <td>
                   <input type="text" name="amount[]" class="form-control amount" placeholder="Total" readonly>
                  </td>
                  <!-- -------------------------------------------------->
                  <td>
                    <a href="#" class="btn btn-danger remove "><i class="glyphicon glyphicon-remove"></i></a>
                  </td>

                  
                </tr>
                
              </tbody>
              <tfoot>
              <td style="border:none"></td>
              <td style="border:none"></td>
              <td style="border:none"></td>
              <td style="border:none"></td>
              <td style="border:none" class="total">Total</td>
              <input type="hidden" class="total" value="" name="total">
              <td style="border:none"><input type="submit" class="btn btn-success" value="submit"></td>
              </tfoot>

            </table>

          </div>
        </section>
      </form>
    </div>
    </div>

  </div>
  <script type="text/javascript">
$(document).ready(function() {
  
$('.AddRow').on('click',function(){
  addRow();

});
function addRow()
{
var tr =    '<tr>'+
                  '<td>'+
                  '<select name="drug_name[]"  class="form-control input-lg select_drug_name "'+
                  '>'+
                  '@foreach($drugs_list as $drug)'+
                  '<option value="{{ $drug -> drug_name }}">{{ $drug -> drug_name }}</option>'+
                  '@endforeach'+
                 '</select>'+
                  '</td>'+
                  '<!-- -------------------------------------------------->'+
                 '<td>'+
                  '<select name="drug_type[]"  class="form-control input-lg select_drug_type"'+
                  '>'+
                  '@foreach($drugs_list as $drug)'+
                  '<option value="{{ $drug -> drug_type }}">{{ $drug -> drug_type }}</option>'+
                  '@endforeach'+
                 '</select>'+
                  '</td>'+
                  '<!-- -------------------------------------------------->'+
'                  <td>'+
                  '<input type="text" name="drug_qty[]" class="form-control select_drug_qty" placeholder="Quantity">'+
                  '</td>'+
                  '<!-- -------------------------------------------------->'+
                 ' <td>'+
                  '<select name="drug_unit_price[]"  class="form-control input-lg select_drug_unit_price "'+
                  '>'+
                  '@foreach($drugs_list as $drug)'+
                  '<option value="{{ $drug -> drug_unit_price }}">{{ $drug -> drug_unit_price /1000}}</option>'+
                 ' @endforeach'+
                 '</select>'+
                 ' </td>'+
                  '<!-- -------------------------------------------------->'+
                  '<td>'+
                  '<input type="text" name="amount[]" class="form-control amount" placeholder="Total" readonly>'+
                  '</td>'+
                  '<td>'+
                   '<a href="#" class="btn btn-danger remove "><i class="glyphicon glyphicon-remove"></i></a>'+
                  '</td>'+
                '</tr>';
                var temp = '<tr><td><select name="drug_unit_price[]"  class="form-control input-lg select_drug_unit_price " </td></tr>';
            $('tbody').append(tr);

}

$('body').delegate('.select_drug_qty ,.select_drug_unit_price','change',function(){
  var tr= $(this).parent().parent();
  var qty = tr.find('.select_drug_qty').val();
  var price = tr.find('.select_drug_unit_price').val() /1000;
  var amount = (qty*price);
  tr.find('.amount').val(amount);
  get_total();

});
function get_total()
{
  var total = 0;
  $('.amount').each(function(i,e){
    var amount =$(this).val()-0;
    total+=amount;
  });
  $('.total').html("$"+total);
  $('.total').val(total);

}

$("body").delegate('.remove','click',function(){
  var last=$('tbody  tr').length;
  if(last == 1){
    alert("Order Cannot be empty");
  }
  else{
    $(this).parent().parent().remove();
  }

  
});
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


});
</script>
</body>
</html>