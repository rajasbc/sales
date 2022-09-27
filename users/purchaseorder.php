<?php
include '../includes/config.php';
include 'header.php';

?>

<style type="text/css">
  
.first-col
{
  font-weight: bold;
}


#ui-id-1,#ui-id-2
{
  z-index: 99999;
}

.input-group-text1{
    width: 110px;
  }

</style>

<link rel="stylesheet" href="assets/css/jquery-ui.css" />

<section class="pcoded-main-container">
 <div class="pcoded-wrapper">
  <div class="pcoded-content">
   <div class="pcoded-inner-content">
    <div class="main-body">
     <div class="page-wrapper">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
       <div class="page-block">
        <div class="row align-items-center">
         <div class="col-md-12">
          <div class="page-header-title">
           <h5 class="m-b-10">Purchase Order</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item">Purchase </li>
            <li class="breadcrumb-item">Purchase Order</li>
            <li class="breadcrumb-item">New Purchase Order</li>
         </ul>
       </div>
     </div>
   </div>
 </div>
 <!-- [ breadcrumb ] end -->
 <!-- [ Main Content ] start -->
 <div class="row">                                

   <!-- [ dark-table ] end -->
   <!-- [ stiped-table ] start -->
   <div class="col-xl-12">
    <div class="card">
    
    <div class="card-body table-border-style">

          <div class="row">
            
            <div class="col-md-6">
<input type="hidden" name="s_no" id="s_no">
                <em id="customername" data-toggle="tooltip" title="Select Vendor">
                  <img src="images\usericon.jpg" class="media-object" id ="selectCustomerBtn" data-toggle="modal" data-target="#customerModal" style="width:40px;cursor:pointer;margin-left:-14px">
                </em> 
                <em id='ccustomername'></em><br>

                <div id="companyname_show_hide" style="display:none;">
                    <em id="companyname_1">
                      <img src="images\company_icon.png" class="media-object" style="width:10px">
                    </em>
                    <em id='ccompanyname'></em><br>
                  
                  <div id="address_1_show_hide">
                    <em>
                      <img src="images\location_icon.png" class="media-object" style="width:10px">
                    </em>
                    <em id="ccaddress_line_1"></em>
                  </div>
                  <span id="area_show_hide">
                    <em id="carea"></em>
                  </span>
                  <span id="city_show_hide">
                    <em id="ccity"></em>
                  </span>
                  <span id="pincode_show_hide">
                    <em id="cpincode"></em>
                  </span>
                  <div id="phone_show_hide">
                    <em id="cphone">
                      <img src="images\landline.svg" class="media-object" style="width:10px">
                    </em>
                    <em id="ccphone"></em>
                  </div>

                  </div>

            </div>

            <div class="col-md-6">


              <div class="form-group row">
              <div class=" col-lg-7 col-sm-7 col-sm-7 md-6">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text ">🔎</span>
                  </div>
                  <input type='text' id='searchItem' name='searchItem'  class="form-control" placeholder="Search Product Here" autocomplete="off">
                  <input type='hidden' id='originalname' name='originalname' >
                </div>
              </div>

              <div class=" col-lg-5 col-sm-5 col-sm-5 md-6">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text ">S.Order No.</span>
                  </div>
                  <input type='text' id='salesorderno' name='salesorderno' class="form-control" placeholder="Sales Order No" value="<?=base64_decode($_GET['bill_check_group'])?>" readonly />
                </div>
              </div>

            </div>

            <div class="form-group row">
              <div class="col-lg-4 col-sm-4 col-md-4">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">VAT (%)</span>
                  </div>
                  <!-- <input class="form-control"  id="id6" type="text" autocomplete="off"> -->
                  <input class="form-control" id="gst_val" type="text" autocomplete="off">
                </div>
                <input id="gstpercentage" type="hidden" >
              </div>
              <div class=" col-lg-4 col-sm-4 col-md-4" >
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Price ₹</span>
                  </div>
                  <input class="form-control" id="price1" type="number" onkeypress="if(this.value.length==15)return false" autocomplete="off">
                </div>
                <input class="form-control" id="price2" type="hidden" onkeypress="if(this.value.length==15)return false">                
              </div>
              <div class="col-lg-4 col-sm-4 col-md-4">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">QTY<div id="available_qty" style="display:none"> <span class="ml-3"  data-toggle='view_qty' title='QTY=' style="cursor:pointer">i</span></div></span>
                  </div>
                  <input class="form-control focus" id="qty1" type="number"  onkeypress="if(this.value.length==10)return false" autocomplete="off">
                  
                </div>
                <input class="form-control" id="qty2" type="hidden" >
              </div>
            </div>

              <div class="form-group row">              
              <div class="col-lg-2 col-sm-2 col-md-2">
                <input id="itemno" type="hidden" value="0">
                  <button class="btn btn-sm btn-info align-center" id="add" type="button>">ADD</button>
              </div>
              </div>


          </div>

        </div><!-- row -->





        <div class="row">
          <div class="well col-sm-12 col-md-12 col-lg-12 mt-1">
            <div id="table-scroll" class="table-scroll">
              <table class="table bill-table table-bordered" id="bill-table">
                <thead>
                  <tr>
                    <th class="text-left">S.No</th>
                    <th class="text-left">Items</th>
                    <th class="text-left">Price ₹</th>
                    <th class="text-left">Qty</th>
                    <th class="text-left">VAT % </th>
                    <th class="text-left">Total ₹</th>
                    <th class="text-left">Action</th>
                  </tr>
                </thead>
                <tbody class="text-left" id="tdata">
                  <?php for ($i = 1; $i < 9; $i++) { ?>
                  <tr class="emptyTr">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <td colspan="13" class="td-last-1">
                   
                    <div class="row">
                      <div class="col-lg-3 col-sm-3 col-md-3">
                        <div class="">
                          <span class="">Total Amount  Before Tax ₹</span>
                          <span class="" id="subid">0</span>
                          <input type="hidden" name="subid1" id="subid1">
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-3 col-md-3">
                        <div class="">
                        
                          <span class="changegst">GST ₹</span>
                          <span class="" id="taxid">0</span>
                        
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-3 col-md-3">
                        <div class="">
                          
                          <span class="">Total Amount ₹</span>
                        
                          <span class="text" id="grandid">0</span>
                          <input type='hidden' class="text" id="grandid1" value="0">
                        </div>
                      </div>

                      <div class="col-lg-3 col-sm-3 col-md-3">

                      <div class="col-lg-1 col-sm-1 col-md-1">
                        <input type="button" class="btn btn-sm btn-success save_bill" id="pay" value="Save" />
                      </div>

                      </div>

                    </div>
                    
                  </td>
                </tr>
                
                </tfoot>
              </table>
            </div>
          </div>
        </div>

<input type="hidden" id="iname1">
        <input type="hidden" id="iprice1">
        <input type="hidden" id="iitem_id1">
        <input type="hidden" id="idiscount1">
        <input type="hidden" id="igst1">
        <input id="cid" type="hidden" name="cid" >
        <input id="custid" type="hidden" name="custid" >



<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="cform" onsubmit="javascript:return false;">
      <input type="hidden" name="cust_address_id" id="cust_address_id" value="0">
      <input type="hidden" name="address_info" id="address_info" value="primary">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="customerModalTitle"><strong>Vendor Details</strong></h5>
          <button class="close" type="button" data-dismiss="modal" id="customerCloseBtn" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">

                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">Name<span style="color: red;">&nbsp;*</span></span>
                    </div>
                    <input class="form-control cust_form" id="custnameid" name="custname" type="text" placeholder="Vendor Name" autocomplete="off" onkeypress="if(this.value.length==50) return false;">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-12 ">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">+91<span style="color: red">&nbsp;*</span></span>
                    </div>
                    <input class="form-control cust_form"  id="mobile" name="mobile" onKeyPress="if(this.value.length==10)return false;" type="text" autocomplete="off"placeholder='Mobile No.'>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">Email</span>
                    </div>
                    <input  class="form-control cust_form" type="email" id="email"  name="email" autocomplete="off" placeholder="Email Id" onkeypress="if(this.value.length==25) return false;">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1" id="com">Company Name<span style="color: red" class="<?php echo $hide_silver_data1?>"></span></span>
                    </div>
                    <input class="form-control cust_form" id="companyname" name="companyname" type="text" autocomplete="off" onkeypress="if(this.value.length==25) return false;">
                    <select class="form-control" style="border-left-width: 0px;display: none" id="billadd"></select>
                    
                    <input id="item_id" type="hidden" name="item_id" >
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">Address<span style="color: red" class="<?php echo $hide_silver_data1?>">&nbsp;*</span></span>
                    </div>
                    <input class="form-control cust_form" id="address" name="address" type="text" autocomplete="off" placeholder="Address" onkeypress="if(this.value.length==50) return false;">
                    <!-- <select class="form-control" style="border-left-width: 0px" id="billadd"></select> -->
                  </div>
                </div>
              </div>


              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">City</span>
                    </div>
                    <input class="form-control cust_form" id="city" name="city" type="text" autocomplete="off" placeholder="City" onkeypress="if(this.value.length==25) return false;">
                  </div>
                </div>
                

              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">State</span>
                    </div>
                    <input class="form-control cust_form" id="state" name="state" type="text" autocomplete="off" placeholder="City" onkeypress="if(this.value.length==25) return false;">
                    
                  </div>
                </div>

              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">Country</span>
                    </div>
                    <input class="form-control cust_form" id="country" name="country" type="text" autocomplete="off" placeholder="Country" onkeypress="if(this.value.length==25) return false;">
                  </div>
                </div>
                

              </div>
              <div style="margin-left: 320px;margin-top: 10px;"><span style="color: red;">&nbsp;* </span><i>Required Fields</i></div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-success cust_form" type="button" id="saveCustomerBtn" data-dismiss="modal">Save</button>
              <button class="btn btn-sm btn-warning" id="modelclose" type="button" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>



        </div>
      </div>
    </div>

</div>
</div>
</div>
</div>
</div>
</div>
</section>

<?php

include 'footer.php';

?>

<script type="text/javascript">

    $('#cform').on('keydown', 'input', function(e) {
var cid=$("#cid").val();
    if (e.key === "Enter") {
    var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
    // console.log(form.find)
    focusable = form.find('.cust_form').filter(':visible');
    next = focusable.eq(focusable.index(this)+1);
    if(cid!=''){
      $('#saveCustomerBtn').click();
    }
    else
    {
      if (next.length) {
    next.focus();
    } else {
    $('#saveCustomerBtn').click();
    }
    }
    
    return false;
    }

    })
    
  </script>

  <script>
     var time = new Date().getTime();
     $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 600000) 
             location.href = 'sessionClose.php'
         else 
             setTimeout(refresh, 600000);
     }

     setTimeout(refresh, 600000);
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#wholesale_check").on('change',function(){
      if($("#searchItem").val()!=''){
      if($("#wholesale_check").prop('checked')==true){
        $("#price1").val($("#wholesale_sale_price").val());
        // $("#discount1").val($("#wholesale_discount").val());
        <?php if($shopConfiguration['required_discount'] == 'yes'){?>
  $('#discount1').val($("#wholesale_discount").val());
  <?php if($shopConfiguration['over_all_disc'] == 'yes'){?>
  $('#discount1').val(0.00);
<?php }?>
<?php } else{?>
  $('#discount1').val(0.00);
<?php }?>

      }else{
        $("#price1").val($("#retail_sale_price").val());
        // $("#discount1").val($("#retail_discount").val());
        <?php if($shopConfiguration['required_discount'] == 'yes'){?>
  $('#discount1').val($("#retail_discount").val());
  <?php if($shopConfiguration['over_all_disc'] == 'yes'){?>
  $('#discount1').val(0.00);
<?php }?>
<?php } else{?>
  $('#discount1').val(0.00);
<?php }?>
      }
      }
    })
  })
</script>
<script>
    $('#modal_charge_id').click(function(){
    get_other_charges();
    other_charges_calc();
    $('#other_charges_modal').modal('toggle');
  });

      function get_other_charges(){
      var form_data=$('#other_charges_form').serialize();
      return form_data;
      }

      function  silver_price_upate(){
        var silver=$('#silver_price_id').val();
        var gold=$('#gold_price_id').val();
        if(Number(silver)>0 && silver!=''){
          $('#silver_price_id').css('border','1px solid #ced4da');
          $('#silver_price_span').text(silver);
        }
        else{
          $('#silver_price_id').css('border','1px solid red');
          $('#silver_price_id').focus();
          $.growl.error({title:"Error",message:"Please Enter Proper Silver Value"});
          return false;
        }
        if(Number(gold)>0 && gold!=''){
          $('#gold_price_id').css('border','1px solid #ced4da');
          $('#gold_price_span').text(gold);
        }
        else{
          $('#gold_price_id').css('border','1px solid red');
          $('#gold_price_id').focus();
          $.growl.error({title:"Error",message:"Please Enter Proper Gold Value"});
          return false;
        }
        
        

        $.ajax({
            url:"ajaxCalls/update_silver_price_ajax.php",
            type: "POST",
            dataType: "json",
            data: {"silver_price":silver,"gold_price":gold},
            success: function(response) {
              $('#silver_modal').modal('toggle');
              $.growl.notice({title:"SUCCESS",message:"Price Details Updated Successfully"});
              
            }
            });
      }


      $('#saveshippingBtn').on('click', function(){
      var transfort= $('#Dispatched_through').val();
      var transfortno= $('#motorVehicleNo').val();
      if(transfort!='')
      {
      if(transfortno!='')
      {
      $('#motorVehicleNo').css("border","1px solid #ced4da");
      $("#shippingClose").click();
      }
      else{
      $('#motorVehicleNo').css("border","1px solid red");
      }
      }
      else
      {
      $("#shippingClose").click();
      }
      
      });
      </script>

    </main>
  </div>

<script type="text/javascript">
$("#exchange_val").click(function(){
    if($("#exchange_val").prop('checked') == true){
    $("#description_box").css('display','');
    $("#wast_span").text("WAST g");
    if($("#searchItem").val()!=''){
    $('#is_weight_reduce').val('yes');
    var price=$('#silver_price_span').text();
    $('#price1').val(Number(price));
    if ($("#grams").val()!='') {
      wastage();
    }
    
  }
}else{
   $("#description_box").css('display','none');
   $("#wast_span").text("WAST %");
   if($("#searchItem").val()!=''){
   $('#is_weight_reduce').val('no');
    var price2=$('#price2').val();
    $('#price1').val(Number(price2));
  }
}
})
$("#wast").on('blur',function(){
  wastage();
})
function wastage(){
    if($("#exchange_val").prop('checked') == true){
   var grams =$("#grams").val();
   var wast =$("#wast").val();
   if (Number(grams) <= Number(wast) && grams>0) {
    $.growl.warning({title:"Warning",message:"Enter Wastage is Lesser Than Weight"});
    $("#wast").val('');
    $("#wast").focus();
   }
}
}
</script>



<script type="text/javascript">
    function customer_wise_price(item,cuid) {
      $.ajax({
  url:"ajaxCalls/customer_wise_price.php",
  type: "POST",
  dataType:"JSON",
  data:  {'shopid':'<?=$shop_id_for_bill?>','itemId':item.item_no,'combination_id':item.item_combination_id, 'cid':cuid},
  // cache: false,
  success: function(dataResult) {
    // console.log(dataResult);return false;
  // $("#diasvsa").val(item.id);
  autoFillSearchItem12(dataResult[0]);

  }
  });
    }
    function autoFillSearchItem12(item) {
  var expiry = '';
  var duplicatearr=new Array();
  $('#itemno').val(item.item_no);
  $('#searchItem').val(item.label);
  $('#wholesale_discount').val(item.wholesale_discount);
  $('#wholesale_sale_price').val(item.wholesale_sale_price);
  $('#retail_sale_price').val(item.price);
  $('#originalname').val(item.label);
  $('#perunit').val(item.units);
  $('#expiry_date').val(item.item_expiry_date);
  $('#is_weight_reduce').val(item.is_weight_reduce);
  $('#price2').val(item.price);
  if($("#wholesale_check").prop('checked')==true){
    $('#price2').val(item.wholesale_sale_price);
  }
  if($("#exchange_val").prop('checked') == true){
    $('#is_weight_reduce').val('yes');
  }
  if($('#is_weight_reduce').val()=='no'){
    $('#price1').val(item.price);
    if($("#wholesale_check").prop('checked')==true){
    $('#price1').val(item.wholesale_sale_price);
  }
  }
  else
  {
    var price=$('#silver_price_span').text().replace(/,/ , '');
    var gold_price=$('#gold_price_span').text().replace(/,/ , '');
    if(item.material_type=='silver'){
    $('#price1').val(parseFloat(price).toFixed(2));
    }
    else{
    $('#price1').val(parseFloat(gold_price).toFixed(2));
    }
  }
<?php if ($shopDetails['is_silver_shop']=='yes') {?>
$('#reorder_qty').val(item.reorder_qty);
$('#reorder_level').val(item.reorder_level);
<?php } ?>
  $('#weight').val('');
  $('#qty2').val(item.qty);

<?php if($shopConfiguration['multiple_item_price']=='yes'){?>
  $("#check_priceA").val(item.price1);
  $("#check_priceB").val(item.price2);
  $("#check_priceC").val(item.price3);
  $("#check_priceD").val(item.price4);
  $("#check_priceE").val(item.price5);
  $("#check_priceF").val(item.price);

  $("#check_priceA_disc").val(item.price1disc);
  $("#check_priceB_disc").val(item.price2disc);
  $("#check_priceC_disc").val(item.price3disc);
  $("#check_priceD_disc").val(item.price4disc);
  $("#check_priceE_disc").val(item.price5disc);
  $("#check_priceF_disc").val(item.discount);
<?php } ?>

<?php if($shopConfiguration['required_discount'] == 'yes'){?>
  $('#discount1').val(item.discount);
   $('#retail_discount').val(item.discount);
  if($("#wholesale_check").prop('checked')==true){
    $('#discount1').val(item.wholesale_discount);
  }
  <?php if($shopConfiguration['over_all_disc'] == 'yes'){?>
  $('#discount1').val(0.00);
   $('#retail_discount').val(0.00);
<?php }?>
<?php } else{?>
  $('#discount1').val(0.00);
   $('#retail_discount').val(0.00);
<?php }?>
  if(item.item_combination_id!=null){
  $('#combination_id').val(item.item_combination_id);
}
  <?php if ($shopConfiguration['required_commongst'] === 'yes') {
  $gst = $shopConfiguration['common_gst'];
  $cgst = $gst / 2;
  $sgst = $gst / 2;?>
  $('#gst_val').val(<?php echo $gst ?>);
  $('#sgst').val(<?php echo $sgst ?>);
  $('#cgst1').val(<?php echo $cgst ?>);
  <?php } else {?>
  $('#gst_val').val(item.gst);
  $('#sgst').val(item.sgst);
  $('#cgst1').val(item.cgst);
  <?php }?>
  expiry = item.expiry;
  if(expiry!="0000-00-00 00:00:00") {
  $('#ex').show();
  // $('#id5').val(item.expiry);
  } else {
  $('#ex').hide();
  }
  $('#id6').val(item.hsn);
  var product_name=$("#searchItem").val();
  if(product_name!="" && product_name!="No Record Found"){
    $("#available_qty").css('display','');
  }
  else{
    $("#available_qty").css('display','none');
  }
  <?php if ($shopDetails['is_silver_shop']=='yes') {?>
  $("#available_qty").html('<span class="ml-3"  data-toggle="view_qty" title="QTY='+item.qty+' , WEIGHT='+item.item_weight+'" style="cursor:pointer">i</span>');
<?php }else{ ?>
  $("#available_qty").html('<span class="ml-3"  data-toggle="view_qty" title="QTY='+item.qty+'" style="cursor:pointer">i</span>');
<?php } ?>

   <?php if($shopConfiguration['multiple_item_price']=='yes'){?>
  if($('#checked_val').val()=='A' && item.price1!='0') {
  $("#price1").val(item.price1);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price1disc);
  <?php } ?>
}
if($('#checked_val').val()=='B' && item.price2!='0') {
  $("#price1").val(item.price2);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price2disc);
  <?php } ?>
}
if($('#checked_val').val()=='C' && item.price3!='0') {
  $("#price1").val(item.price3);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price3disc);
  <?php } ?>
}
if($('#checked_val').val()=='D' && item.price4!='0') {
  $("#price1").val(item.price4);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price4disc);
  <?php } ?>
}
if($('#checked_val').val()=='E' && item.price5!='0') {
  $("#price1").val(item.price5);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price5disc);
  <?php } ?>
}
if($('#checked_val').val()=='F' && item.price!='0') {
  $("#price1").val(item.price);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.discount);
  <?php } ?>
}
<?php } ?>
  }
  </script>
  <script type="text/javascript">
  $(document).ready(function(){
  var bill_id=atob('<?php echo $_GET['bill_check_group']?>');
  if(bill_id!='')
  {
  $(".modal .close").click();
  $("#customerCloseBtn").click();
  $.ajax({
  data: {'bill_id':bill_id,"bill":"bill"} ,
  type: "POST",
  url:"ajaxCalls/getorderdetails.php",
  dataType:'JSON',
  success: function(dataResult) {
  if(dataResult.out=='Cancelled')
  {
  $.growl.warning({title:"Cancelled",message:"Bill Already Cancelled"});
  }
  else
  {
  if(Number(dataResult.bill_id)!=0){
  $('#search_pay_billid').attr("disabled","disabled");
  $('#tdata').prepend(dataResult.out);
  if(dataResult.bill_type=='Estimation'){
$('#bill_type').prop('checked',false);
getBillType();
  }
  $("#shop_id").val(dataResult.shop_id);
  $("#balance").val(dataResult.balance);
  $("#balancedb").val(dataResult.balance);
  $("#billDate").val(dataResult.bill_date);
  $("#billDate").attr('min',dataResult.previous_bill_date);

  $("#bill_no_val").val(dataResult.invoice_no);
  
  // $("#grandid1").val(dataResult.gtotal);
  // $("#taxid").html(dataResult.totaltax);
  $("#bill_id").val(dataResult.bill_id);
  // $("#advancedb").val(dataResult.advancedb);
  // $("#subid").html(dataResult.subtotal);
  if(dataResult.gst_calc_type=='igst'){

$('#gst_calc_type').prop('checked',false);
gst_calc_type_function();
$(".changegst").text("IGST ₹");
$(".changegst1").text("Bill Amount (inclusive IGST ");
$("#gst_calc_type").attr("disabled", true);

  }
  $("#billDate").removeAttr('readonly');
  $("#payment_mode").val(dataResult.payment_mode);
  $('#ccustomername').html(dataResult.ccustomername);
  $('#cid').val(dataResult.cid);
  $('#ccompanyname').html(dataResult.ccompanyname);
  $('#ccaddress_line_1').html(dataResult.ccaddress_line_1);
  $('#ccaddress_line_2').html(dataResult.ccaddress_line_2+","+dataResult.city+"-"+dataResult.cpincode);
  $('#cstate').html(dataResult.cstate);
  $('#ccphone').html(dataResult.ccphone);
  $('#cemailid').html(dataResult.cemailid);
  $('#ccgst').html(dataResult.ccgst);
   $("#s_no").val(dataResult.sno);
   var sno=0;
      $.each(dataResult.item,function(key, value){
         
       sno=sno+1;
          
    items["sid"+sno] = {
              "itemno":value.item_id,
              "itemname":value.final_itemname,
              "qty":Number(value.final_qty),
              "price":Number(value.final_price),
              "gst":Number(value.final_gst),
              "gstamount":Number(value.gstamount),
              "gstpercentage":value.final_gstpercentage,
              "total":Number(value.final_total),
    };
    calculation();
    });

    // $('#shipname').val(dataResult.shiping_details['shipname']);
    // $('#shipcname').val(dataResult.shiping_details['ship_companyname']);
    // $('#invoiceNumber').val(dataResult.shiping_details['invoice_number']);
    // $('#deliveryNote').val(dataResult.shiping_details['delivery_note']);
    // $('#supplierRef').val(dataResult.shiping_details['supplier_ref']);
    // $('#buyersOrderNo').val(dataResult.shiping_details['buyers_order_no']);
    // $('#despatchedDocumentNo').val(dataResult.shiping_details['despatched_document_no']);
    // $('#Dispatched_through').val(dataResult.shiping_details['despatched_through']);
    // $('#billOfLoading').val(dataResult.shiping_details['bill_of_loding']);
    // $('#ewaybillno').val(dataResult.shiping_details['EWay_No']);
    // $('#invoiceDated').val(dataResult.shiping_details['invoice_dated']);
    // $('#paymentMode').val(dataResult.shiping_details['payment_mode']);
    // $('#otherReference').val(dataResult.shiping_details['other_reference']);
    // $('#buyersDated').val(dataResult.shiping_details['buyers_dated']);
    // $('#deliveryNoteDate').val(dataResult.shiping_details['delivery_note_date']);
    // $('#destination').val(dataResult.shiping_details['destination']);
    // $('#motorVehicleNo').val(dataResult.shiping_details['motor_vehicle_no']);
    // $('#termsOfDelivery').val(dataResult.shiping_details['terms_of_delivery']);
    // $("#packing_price_id").val(dataResult.pack_amt);
    // $("#pack_gst").val(dataResult.pack_gst_rate);
    // $("#freight_gst").val(dataResult.freight_gst_rate);
    // $("#freight_price_id").val(dataResult.freight_amt);
    // $("#cd_price").val(dataResult.cd_percentage);
    // // $("#cd_percentage").val(dataResult.cd_percentage);
    // $("#pack_charge").text(dataResult.pack_charge);
    // $("#freight_charge").text(dataResult.freight_charge);
    // $("#cd_charges").text(dataResult.cd_charge);

    $("#taxid").html(dataResult.totaltax);
    $("#subid").html(dataResult.subtotal);

    $("#grandid").text(dataResult.gtotal);
    // $("#balance").val(dataResult.balance);
    // if(dataResult.pack_percentage!=0 || dataResult.freight_percentage!=0){
    //   $('#other_charge_check').prop('checked',true);
    // }
  }
  else
  {
  $.growl.warning({title:"Invalid Bill no",message:"Please enter valid bill number "});
  }
  }
  }
  });
  }
  else if ('<?=base64_decode($_GET['future_ids'])?>'=='' && bill_id=='' && localStorage.getItem('myArray')==null){
  $("#customerModal").modal('show');
  $('#pay').attr('disabled','disabled');
  $('#save_bill').attr('disabled','disabled');
  }
  $("#thisshopid").val(<?php echo $shopDetails['id']; ?>);
  // $('.shopname').on('click',function() {
  //         if($(this).is(':checked'))
  //           {
  //             var valv=$('input[name="shopname"]:checked').val();
  //             console.log("ram"+valv);
  //             // alert("it's checked");
  //              }
  //         });
  var shoplist="";
  var last_checked=0;
  $("#Select_shop").click(function(){
  var shop_id=$('#shop_id').val();
  var userid=$('#user_id').val();
  // console.log(userid);
  $.ajax({
  data: {'userid':userid} ,
  type: "POST",
  url:"ajaxCalls/getAllshop_details.php",
  success: function(e){
  $(".list_of_all_branches").html(e);
  var results=JSON.parse(e);
  var results_rows="";
  // console.log(results);
  shoplist=results;
  // console.log("ram"+shoplist);
  
  $.each( results, function( key1, value1 ) {
  var checked;
   
  if(shop_id==value1['id'])
  {
  checked="<input type='radio' class='shopname' id='shopname_"+key1+"' name='shopname' value='"+key1+"' checked>";
  }
  else
  {
  checked="<input type='radio' class='shopname' id='shopname_"+value1["id"]+"'  name='shopname' value='"+key1+"'>";
  }
   results_rows=results_rows+
                "<div style='margin-top:10px'>"+
                    checked+"&nbsp"+"<b>"+value1["name"]+"</b><br>"+"&nbsp;&nbsp;&nbsp;&nbsp"+
                    ('<img src="images/location_icon.png" style="width:15px">')+'&nbsp'+
                    value1["address1"]+", "+
                    value1["address2"]+"&nbsp"+value1["area"]+"<br>"+

                    "<div id='multiple_shop_area' style='display:none'>"
                    +value1["area"]+"<br>"+
                    "</div>"+

                    "&nbsp;&nbsp;&nbsp;&nbsp"+
                    ('<img src="images/location_icon.png" style="width:15px">')+'&nbsp'+
                    value1["city"]+"-"+
                    value1["pincode"]+", "+
                    value1["state"]+"<br>"+"&nbsp;&nbsp;&nbsp;&nbsp"+
                    ('<img src="images/landline.svg" style="width:15px">')+'&nbsp'+
                    value1["mobile_no"];

                "</div></option>";
  });
  
  $(".list_of_all_branches").html(results_rows);
  }
  });
  
  });
  $("#Select_shop").click(function(){
if($("#cid").val()==""){
$("#Select_shopModal").modal("show");
  }else{
     $.growl.error({
  title:"ERROR",
  message:"All information will be erased if you change to another shop"
  });
$("#Select_shopModal").modal("show");
  }
  })
  
  $("#selectedShopBtn").click(function(){
  var selectedBranch=shoplist[$('input[name="shopname"]:checked').val()];
  $('#tab_title').text(selectedBranch["name"]);
  $('#header_title').text(selectedBranch["name"]);
  
  $.ajax({
  url:'set_selected_shop.php',
  type : 'POST',
  dataType:'JSON',
  data:{'shop_id':selectedBranch["id"],'tab_title':selectedBranch["name"]},
  success:function(res){
// console.log(res);
$("#billformat").val(res.billformat);
location.reload();

  },
  error:function(e){
  // console.log(e);
  // console.log(<?=$_SESSION['shop_id_for_bill']?>);
  }
  });
  // $("#shopname_"+this).attr('checked', 'checked');
  // console.log();
  
  // console.log(selectedBranch);
  last_checked=$('input[name="shopname"]:checked').val();
  $('#shopname_'+1).prop('checked', false);
  $('#shopname_'+selectedBranch["id"]).prop('checked', true);
  // console.log(selectedBranch);
  $("#thisshopid").val(selectedBranch["id"]);
  // console.log(selectedBranch["id"]);
  $("#shop_id").val(selectedBranch["id"]);
  // console.log(selectedBranch);
  // $('#').html();
  if(selectedBranch["shop_logo"]!=''){
  $('#shop_logo_id').attr("src",'../uploads/'+selectedBranch["shop_logo"]);
  }
  else{
  $('#shop_logo_id').attr("src",'../uploads/no_image.png');
  }
  
  $("#shopname").html(selectedBranch["name"]);
  $("#shopname1").html(selectedBranch["name"]);
  $("#ph").html('<img src="images/landline.svg" style="width:10px">'+selectedBranch["mobile_no"]);
  $('#emailid').html(selectedBranch["email"]);
  $("#gstno").html("GSTN : "+(selectedBranch["shop_gst_no"]!='')?selectedBranch["shop_gst_no"]:"");
  var address=selectedBranch["address1"]+selectedBranch["address2"]+selectedBranch["city"];
  $("#addressid").html("Address : "+(address!='')?address:"");
  $("#addressid1").html("State : "+(selectedBranch["state"]!='')?selectedBranch["state"]:"");
  $("#addressid2").html("State Code : "+(selectedBranch["state_code"]!='')?selectedBranch["state_code"]:"");
  $("#Select_shopModal").modal('toggle');
  });
  });
  function getBillType() {
  var BILL_TYPE = 'bill';
  if ($('#bill_type').prop('checked') === false) {
  BILL_TYPE = 'Estimation';
  }
  return BILL_TYPE;
  }

  function getExchange() {
  var exchange = '';
  if ($('#exchange_val').prop('checked') === true) {
  exchange = 'yes'
  }
  else{
    exchange = 'no'
  }
  return exchange;
  }

  function check_credit_bill() {
  var credit_bill='';
  if ($('#credit_bill_check').prop('checked') === true) {
  credit_bill = 'credit_bill';
  }
  return credit_bill;
  }
    function checked_credit_bill() {
  if ($('#credit_bill_check').prop('checked') === true) {
   $("#payment_mode").val('Due').attr('selected','selected');
  }else{
    $("#payment_mode").val('Cash').attr('selected',"selected");
  }
  }

  function pack_percentage() {
  var pack_per='';
  if ($('#other_charge_check').prop('checked') === true) {
  pack_per = 'percentage';
  }
  return pack_per;
  }

  function gst_calc_type_function() {
  var gst_calc_type_val = 'GST';
  if ($('#gst_calc_type').prop('checked') === false) {
  gst_calc_type_val = 'IGST';

  }
  $('.gst_calc_type_change').text(gst_calc_type_val+" %");
  $("#cal_type_gst").val(gst_calc_type_val);
  $(".changegst").text(gst_calc_type_val+" ₹");
  $(".changegst1").text("Bill Amount (inclusive "+gst_calc_type_val+" ");
  return gst_calc_type_val;

  }
  function getRegEx(str) {
  return new RegExp('{{' + str + '}}', 'g');
  }
  $(document).ready(function(){
  // calculate height for posistion Stricky
  var tfootLastTdHeight = $('.table-scroll tfoot td.td-last').height();
  $('.table-scroll tfoot td.td-last-1').css("bottom", tfootLastTdHeight + 12);
  $("#customerModal").on('shown.bs.modal', function(){
  $(this).find('#custnameid').focus();
  });
  $("#phone").bind("keyup paste", function() {
  this.value=this.value.replace("^[a-zA-Z ]+$")
  });
  $("#custnameid").bind("keypress", function (event) {
  if (event.charCode!=0) {
  var regex = new RegExp("^[ a-zA-Z0-9@+'\".!#$'&quot;,:;=/\(\),\-\s]{1,255}$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
  event.preventDefault();
  return false;
  }
  }
  });
  $("#qty1").bind("keypress", function (event) {
  if (event.charCode!=0) {
  var regex = new RegExp("^[0-9.]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
  event.preventDefault();
  return false;
  }
  }
  });
  function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
  }
  $("#idemail").blur(function(){
  if(isEmail($("#idemail").val())==false){
  $("#idemail").addClass("errorCall");
  $("#idemail").val('');
  $("#idemail").attr('placeholder','Please Enter Valid Email ID');
  }else{
  $("#idemail").css("border","1px solid #ccc");
  }
  });
  });
  $(document).ready(function(){
  
  var inputStart, inputStop, firstKey, lastKey, timing, userFinishedEntering;
  var minChars = 3;
  function additemtolist(){
  $("#add").click();
  }
  
  function autoFillSearchItem(item) {
  var expiry = '';
  var duplicatearr=new Array();
  $('#itemno').val(item.item_no);
  $('#searchItem').val(item.label);
  $('#wholesale_discount').val(item.wholesale_discount);
  $('#wholesale_sale_price').val(item.wholesale_sale_price);
  $('#retail_sale_price').val(item.price);
  $('#originalname').val(item.label);
  $('#perunit').val(item.units);
  $('#expiry_date').val(item.item_expiry_date);
  <?php if ($shopConfiguration['required_weight_multiple']=='yes') {?>
  $('#weight').val(item.default_wt);
  <?php } ?>
  $('#is_weight_reduce').val(item.is_weight_reduce);
  $('#price2').val(item.price);
  if($("#wholesale_check").prop('checked')==true){
    $('#price2').val(item.wholesale_sale_price);
  }
  if($("#exchange_val").prop('checked') == true){
    $('#is_weight_reduce').val('yes');
  }
  if($('#is_weight_reduce').val()=='no'){
    $('#price1').val(item.price);
    if($("#wholesale_check").prop('checked')==true){
    $('#price1').val(item.wholesale_sale_price);
  }
  }
  else
  {
    var price=$('#silver_price_span').text().replace(/,/ , '');
    var gold_price=$('#gold_price_span').text().replace(/,/ , '');
    if(item.material_type=='silver'){
    $('#price1').val(parseFloat(price).toFixed(2));
    }
    else{
    $('#price1').val(parseFloat(gold_price).toFixed(2));
    }
  }
<?php if ($shopDetails['is_silver_shop']=='yes') {?>
$('#reorder_qty').val(item.reorder_qty);
$('#reorder_level').val(item.reorder_level);
<?php } ?>
  $('#weight').val('');
  <?php if ($shopConfiguration['required_weight_multiple']=='yes') {?>
  $('#weight').val(item.default_wt);
  <?php } ?>
  $('#qty1').val(1);
  $('#qty2').val(item.qty);

  //MULTIPLE ITEM PRICE
<?php if($shopConfiguration['multiple_item_price']=='yes'){?>
  $("#check_priceA").val(item.price1);
  $("#check_priceB").val(item.price2);
  $("#check_priceC").val(item.price3);
  $("#check_priceD").val(item.price4);
  $("#check_priceE").val(item.price5);
  $("#check_priceF").val(item.price);

  $("#check_priceA_disc").val(item.price1disc);
  $("#check_priceB_disc").val(item.price2disc);
  $("#check_priceC_disc").val(item.price3disc);
  $("#check_priceD_disc").val(item.price4disc);
  $("#check_priceE_disc").val(item.price5disc);
  $("#check_priceF_disc").val(item.discount);

<?php } ?>
<?php if($shopConfiguration['required_discount'] == 'yes'){?>
  $('#discount1').val(item.discount);
   $('#retail_discount').val(item.discount);
  if($("#wholesale_check").prop('checked')==true){
    $('#discount1').val(item.wholesale_discount);
  }
  <?php if($shopConfiguration['over_all_disc'] == 'yes'){?>
  $('#discount1').val(0.00);
   $('#retail_discount').val(0.00);
<?php }?>
<?php } else{?>
  $('#discount1').val(0.00);
   $('#retail_discount').val(0.00);
<?php }?>
  if(item.item_combination_id!=null){
  $('#combination_id').val(item.item_combination_id);
}
  <?php if ($shopConfiguration['required_commongst'] === 'yes') {
  $gst = $shopConfiguration['common_gst'];
  $cgst = $gst / 2;
  $sgst = $gst / 2;?>
  $('#gst_val').val(<?php echo $gst ?>);
  $('#sgst').val(<?php echo $sgst ?>);
  $('#cgst1').val(<?php echo $cgst ?>);
  <?php } else {?>
  $('#gst_val').val(item.gst);
  $('#sgst').val(item.sgst);
  $('#cgst1').val(item.cgst);
  <?php }?>
  expiry = item.expiry;
  if(expiry!="0000-00-00 00:00:00") {
  $('#ex').show();
  $('#expiry_date').val(expiry);
  // $('#id5').val(item.expiry);
  } else {
  $('#ex').hide();
  }
  $('#id6').val(item.hsn);
  var product_name=$("#searchItem").val();
  if(product_name!="" && product_name!="No Record Found"){
    $("#available_qty").css('display','');
  }
  else{
    $("#available_qty").css('display','none');
  }
  <?php if ($shopDetails['is_silver_shop']=='yes') {?>
  $("#available_qty").html('<span class="ml-3"  data-toggle="view_qty" title="QTY='+item.qty+' , WEIGHT='+item.item_weight+'" style="cursor:pointer">i</span>');
<?php }else{ ?>
  $("#available_qty").html('<span class="ml-3"  data-toggle="view_qty" title="QTY='+item.qty+'" style="cursor:pointer">i</span>');
<?php } ?>

<?php if($shopConfiguration['multiple_item_price']=='yes'){?>

  if($('#checked_val').val()=='A' && item.price1!='0') {
  $("#price1").val(item.price1);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price1disc);
  <?php } ?>
}
if($('#checked_val').val()=='B' && item.price2!='0') {
  $("#price1").val(item.price2);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price2disc);
  <?php } ?>
}
if($('#checked_val').val()=='C' && item.price3!='0') {
  $("#price1").val(item.price3);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price3disc);
  <?php } ?>
}
if($('#checked_val').val()=='D' && item.price4!='0') {
  $("#price1").val(item.price4);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price4disc);
  <?php } ?>
}
if($('#checked_val').val()=='E' && item.price5!='0') {
  $("#price1").val(item.price5);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.price5disc);
  <?php } ?>
}
if($('#checked_val').val()=='F' && item.price!='0') {
  $("#price1").val(item.price);
  <?php if($shopConfiguration['required_discount'] == 'yes'){?>
    $("#discount1").val(item.discount);
  <?php } ?>
}
<?php } ?>

  }
  function inputComplete() {
  $.ajax({
  url:"ajaxCalls/get_item.php",
  type: "POST",
  dataType:"JSON",
  data:  {'barcode':$("#searchItem").val(), 'type':'barcode'},
  // cache: false,
  success: function(dataResult) {
  if(dataResult.label != "No Record Found") {
  // $("#diasvsa").val(item.id);
  autoFillSearchItem(dataResult[0]);
  $("#add").click();
  }
  else {
  $('#ex').hide();
  }
  }
  });
  }
  $("#searchItem").on("change",function(){
    var item_id_check=$('#itemno').val();
      if(Number(item_id_check)==0)
  {
    if("<?=$shopDetails['customer_previous_prcie_and_discount']?>"=='no'){
  $("#searchItem").css("border","1px solid red");
  $("#searchItem").focus();
  $("#searchItem").val(''); 
  $.growl.error({
  title:"Item issue",
  message:"Please Add Items In Product List"
  });
  return false;
}
  }else{
  $("#searchItem").css("border","1px solid lightgray");
  return true;
  }
  })
  function resetValues() {
  // clear the variables
  inputStart = null;
  inputStop = null;
  firstKey = null;
  lastKey = null;
  // clear the results
  inputComplete();
  }
  // Assume that it is from the scanner if it was entered really fast
  function isScannerInput() {
  return (((inputStop - inputStart) / $("#searchItem").val().length) < 15);
  }
  // Determine if the user is just typing slowly
  function isUserFinishedEntering(){
  return !isScannerInput() && userFinishedEntering;
  }
  function inputTimeoutHandler(){
  // stop listening for a timer event
  clearTimeout(timing);
  // if the value is being entered manually and hasn't finished being entered
  if (!isUserFinishedEntering() || $("#searchItem").val().length < 3) {
  // keep waiting for input
  return;
  }
  else{
  reportValues();
  }
  }
  $('#searchItem').autocomplete({
  source: "ajaxCalls/get_items.php?type=text",
  minLength: 1,
  select: function(event,ui) {

      autoFillSearchItem(ui.item);
    

  }
  }).data('ui-autocomplete')._renderItem = function(ul, item){
  return $("<li class='ui-autocomplete-row'></li>")
  .data("item.autocomplete",item)
  .append(item.label+" ")
  .append(item.hsn)
  .appendTo(ul);
  };
  });

  customerarray = [];
  customers=[];
  items = [];
  var local_sms = [];
  var check=new Array();
  data=[];
  var sno=0;
  var total=0;
  var which_btn_click;
  var weight_preference='<?=$shopConfiguration['required_weight']?>';
  $('input[type="button"]').click(function() {
  which_btn_click=this.id;  
  });



$("#add").on('click',function(){
   if($("#searchItem").val()==''  ){
    $.growl.error({
      title:"Warning",
      message:"Atleast Add One Item"
    });
    $("#searchItem").focus();
    return false;
  }
  var product_name=$("#searchItem").val();
  // var hsn_code=$("#id6").val();
  var price=$("#price1").val();
  var id=$("#item_id").val();
  var qty=$("#qty1").val();

  $.ajax({
    type:"POST",
    url:"ajaxCalls/add_products.php",
    data:{'product_name':product_name,"price":price,"qty":qty,"id":id},
    dataType:'json',
    success: function(res){
      // alert(res);
      if(res.status=="success"){
        $("#itemno").val(res.id);


        add_productrow();

      }

    }
  });


});



  
  //add click function 
  function add_productrow(){




    // alert();
    

  
  var item_id_check=$('#itemno').val();
  if(Number($("#qty1").val())==0)
  {
  $("#qty1").css("border","1px solid red");
  $("#qty1").focus();
  var qty1= $("#qty1").val(); 
  $.growl.error({
  title:"Quantity issue",
  message:"Please enter quantity"
  });
  return false;
  }
  else
  {
  $("#qty1").css("border","1px solid #ced4da");
  }


  if($("#searchItem").val()!="" && $("#price1").val()!=""){
    var serial_no=$("#s_no").val();   
      if(Number(serial_no)!=0)
      {
        sno=Number(sno)+Number(serial_no);
        $("#s_no").val(0);   
      }
  sno=sno+1;
  var gqty=$("#qty1").val();
  var gstp = 0;
  var gstpercentage = 0;

  // alert(sno);

  gstp=Number($('#gst_val').val());
  gstpercentage=gstp/100;
  
  data["itemno"]=$("#itemno").val();

  var wast_unit='';

  // console.log(perunit);
  data["gstpercentage"]=gstpercentage;
  data["price"]=$("#price1").val();
  data["batch_no"]=$("#batch_no").val();
  data["qty"]=$("#qty1").val();
  data["gst"]=gstp;

  total1=Number(data["price"])*Number(data["qty"]);
  
  total=Number(total1)+Number(total1)*gstpercentage;

  var cqty=$("#qty1").val();
  data["total"]=total.toFixed(2);
  var cid=$("#cid").val();
  var itemcol=$("#searchItem").val();
  var allSelecteBox = $('.itemAttributeDynamicForm .attributes option:selected');
  // var selectedcolour ="";
  for(var k = 0; k < allSelecteBox.length; k += 1) {
  if (allSelecteBox[k].value != '') {
  itemcol = itemcol+ ' - ' + allSelecteBox[k].text;
  }
  }
  check[0]=itemcol;


    itemcol= itemcol;

data["itemname"]=itemcol;
var gst_calc_type=$('#cal_type_gst').val();

if ($('#cal_type_gst').val()=="") {
var gst_calc_type='GST';
}

prototal=Number(($("#price1").val()*$("#qty1").val()));

gstamount=prototal*Number(gstpercentage);

//item array insertion

  items["sid"+sno] = {
  "sid":sno,
  "itemno":$("#itemno").val(),
  "itemname":itemcol,
  "qty":$("#qty1").val(),
  "price":$("#price1").val(),
  "gst":gstp,
  "gstpercentage":gstpercentage,
  "gstamount":gstamount,
  "discount":$("#discount1").val(),
  "hsn":$("#id6").val(),
  "total":total,
  };
  

  calculation();
  $("#batch").hide();
  $("#comb_batch").hide();
  var trItemTemplate = [
  '<tr class="productrow" id="trItem_{{sno}}">',
    '<td class="text-left ch-4">{{sno}}</td>',
    '<td class="text-left ch-10">{{itemname}}</td>',

    '<td class="text-left ch-6">',
      '<input type="hidden" name="price[]" id="priceid{{sno}}" value="{{price}}">',
    '{{price}}</td>',
    '<td class="text-left ch-4">',
      '<input onkeyup=priceupdate({{sno}},this) type="number" class="form-control qty" name="qty[]" id="num_qty{{sno}}" value="{{cqty}}" style="width:5rem; height:1.75rem" onkeypress="if(this.value.length==8) return false">',
    '</td>',
    '<td class="text-left ch-4" id="gstpid{{sno}}"><input type="hidden" id="gstper{{sno}}" value="{{gst}}">{{gst}}</td>',
    '<td class="text-right ch-6" id="totalid{{sno}}">{{total}}</td>',
    '<td class="text-left ch-4">',
      '<button type="button" class="btn btn-default btn-sm" onclick="removeItem({{sno}})">',
      '<span class="glyphicon glyphicon-trash">',
        '<i class="fas fa-trash"></i>',
      '</span>',
      '</button>',
    '</td>',
  '</tr>'].join(''),
  tr = trItemTemplate;
  tr = tr.replace(getRegEx('sno'), sno);
  tr = tr.replace(getRegEx('itemname'), data['itemname']);
  tr = tr.replace(getRegEx('price'), data['price']);
  tr = tr.replace(getRegEx('cqty'), cqty);
  tr = tr.replace(getRegEx('gst'), data['gst']);
  tr = tr.replace(getRegEx('total'), data['total']);
  var emptyTr = $('#tdata .emptyTr').first();
  if (emptyTr.length === 0) {
  $('#tdata').append(tr);
  }
  else {
  $('#tdata .emptyTr').first().replaceWith(tr);
  }
  $('#pay').attr('disabled',false);
  $('#save_bill').attr('disabled',false);
  check_radio_id = $("#checked_val").val();
  $('#searchItemDetailForm').trigger("reset");
  $('#itemAttributeForm').trigger("reset");
  $(".itemAttributeDynamicForm").empty();
  $('#searchItem').val('').focus();
  $('#gst_val').val('');
  $('#price1').val('');
  $('#qty1').val('');  
  $("#combination_id").val(0);
  $("#description_box").css('display','none');
  }
  };

 function priceupdate(idval,ele){
  var gst_type=$('#gst_type').val();
  var totaltemp=0;
  var get_id=idval;
  var qtytemp1=$(ele).val();
  var qtytemp=$(ele).val();
  
  var pricetemp=$("#priceid"+get_id).val();


  var gstper=$("#gstpid"+idval).val();

  totaltemp=totaltemp+Number(pricetemp)*Number(qtytemp);

  $("#totalid"+get_id).html(totaltemp);
  var ref = "sid"+get_id;
  items[ref].qty=qtytemp1;
  items[ref].total=totaltemp;
  var availableQty=items[ref].availableQty;
  var name=items[ref].itemname;

  if(Number(qtytemp)<=0){
    $(ele).css("border","1px solid red");
    $.growl.error({
        title:"Valid Quantity",
        message:"Please enter Valid quantity:"
      });
    $('#pay').attr('disabled',true);
    return false;
  }
  else
  {
    $('#pay').attr('disabled',false);
    $(ele).css("border","1px solid #ccc");
    // return false;
  }

// alert(gstper);

  var gstpercentage=Number(gstper)/100;


prototal=Number(($("#priceid"+idval).val()*$("#num_qty"+idval).val()));

gstamount=prototal*Number(gstpercentage);

items[ref].gstamount=gstamount;
items[ref].gstpercentage=gstpercentage;

  calculation();

  }


function gstupdate(idval,ele){
  var gstamount=0;
  var prototal=0;
  var totaltemp=0;
  var qtytemp1=$(ele).val();
  var ref = "sid"+idval;
  items[ref].gst=Number(qtytemp1);
  if ($(ele).val()=='') {
    items[ref].gst=0;
  }
    var gst_type=$('#gst_type').val();
  var weight=1;
  if ($("#temp_weight"+idval).text()!=0){
    weight=$("#temp_weight"+idval).text();
  }

  var gstpercentage=$("#gstpid"+idval).val()/100;


prototal=Number(($("#priceid"+idval).val()*$("#num_qty"+idval).val()));

gstamount=prototal*Number(gstpercentage);


// alert(gstamount);

totaltemp=prototal+Number(gstamount);

totaltemp=totaltemp.toFixed(2);

$("#totalid"+idval).html(totaltemp);

items[ref].gstamount=gstamount;
items[ref].gstpercentage=gstpercentage;
  calculation();
// enkerkeypress();
  } 

  function costupdate(idval,ele){
  var gst_type=$('#gst_type').val();
  var totaltemp=0;
  var get_id=idval;
  var qtytemp1=$("#num_qty"+get_id).val();
  var qtytemp=$("#num_qty"+get_id).val();
  
  var pricetemp=$(ele).val();


  var gstper=$("#gstpid"+get_id).val();
  var temp_discount=$("#temp_discount"+get_id).val();
  totaltemp=totaltemp+Number(pricetemp)*Number(qtytemp);

  

  var ref = "sid"+get_id;
  items[ref].qty=qtytemp1;
  items[ref].price=pricetemp;
  items[ref].total=totaltemp;

  var name=items[ref].itemname;
  if(Number($(ele).val())==0 || Number($(ele).val())==''){
  $(ele).css("border","1px solid red");
        $.growl.error({
            title:"Error",
            message:"Please enter Valid Amount"
          });
        $(ele).focus();
        return false;
    
  }
  else
  {
    $(ele).css("border","1px solid #ccc");
  }

  
  var gstpercentage=Number(gstper)/100;

prototal=Number(($("#priceid"+idval).val()*$("#num_qty"+idval).val()));

gstamount=prototal*Number(gstpercentage);

// alert(gstamount);

totaltemp=totaltemp+Number(gstamount);

totaltemp=totaltemp.toFixed(2);

$("#totalid"+get_id).html(totaltemp);

items[ref].gstamount=gstamount;
items[ref].gstpercentage=gstpercentage;
  calculation();

  }
  function priceupdate1(idval,ele){
  if ($("#calcmethod"+idval).val()=='qty_calc') {
  var gst_type=$('#gst_type').val();
  var totaltemp=0;
  var get_id=idval;
  var qtytemp1=$(ele).val();
  var qtytemp=$(ele).val();
  
  var pricetemp=$("#priceid"+get_id).val();
  
  if(weight_preference=='yes'){
  qtytemp=qtytemp*$('#temp_weight'+idval).text();
  }


  var gstper=$("#gstpid"+get_id).val();
  var temp_discount=$("#temp_discount"+get_id).val();
  totaltemp=totaltemp+Number(pricetemp)*Number(qtytemp);

  $("#totalid"+get_id).html(totaltemp);
  var ref = "sid"+get_id;
  items[ref].qty=qtytemp1;
  items[ref].total=totaltemp;

  var name=items[ref].itemname;
  if(Number(qtytemp)<=0){
    $(ele).css("border","1px solid red");
    $.growl.error({
        title:"Valid Quantity",
        message:"Please enter Valid quantity:"
      });
    $('#pay').attr('disabled',true);
    return false;
  }


  

  var gstpercentage=Number(gstper)/100;


prototal=Number(($("#priceid"+idval).val()*$("#num_qty"+idval).val()));

gstamount=prototal*Number(gstpercentage);


// alert(gstamount);

totaltemp=totaltemp+Number(gstamount);

totaltemp=totaltemp.toFixed(2);

$("#totalid"+idval).html(totaltemp);


items[ref].gstamount=gstamount;
items[ref].gstpercentage=gstpercentage;
  calculation();
}else{
   var qtytemp=$(ele).val();
    var ref = "sid"+idval;
  items[ref].qty=qtytemp;
}
  }
  
  grand=[];
  $('#overall_disc').on('keyup',function(){
    if($('#grandid1').val()==0){
        $.growl.warning({title:"Notice",  message:"Please Enter Product "});
        $(this).css('border','1px solid red');
        return false;
    }
    else{
      $(this).css('border','1px solid #ced4da');
      $('#discid').text($(this).val());
      // over_all_discount();
    }
    
  });



  function calculation(){

  
    
  // var gst_type=$('#gst_type').val();
  

  itemslist = items;
  qtyarray = [];
  // console.log(itemslist);
  // sessionStorage.setItem("id", JSON.stringify(items));
  // var retrievedData = sessionStorage.getItem("id");
  // var id=JSON.parse(retrievedData);
  
  
  var qty;
  var i=0;
  var discount=0;
  var disamt=0;
  var val=0;
  var tempItem;

  var total=0;
  var temp_subtotal=0;
  var tax=0;
  var grand_total=0;
  var subtotal1=0;
  var temp_tax=0;
  var inclusive_tax=0;
  var inclusive_subtotal=0;


 if ("<?=$_GET['bill_check_group']?>"=="")  {


  for(vale in itemslist) {
  tempItem = itemslist[vale];
  val=Number(tempItem["qty"]);

  total= Number(tempItem["price"])*Number(tempItem["qty"]);
  
  qtyarray.push({
  'itemId': tempItem["itemno"],
  'itemPurchaseCount': val
  });
  
  // temp_subtotal=Number(tempItem["total"]);

  temp_subtotal=Number(total);

  subtotal1=Number(subtotal1)+Number(temp_subtotal);

  tax=Number(tax)+Number(temp_subtotal)*Number(tempItem.gstpercentage);
  i++;

  }



 }else{
  for(vale in itemslist) {

// alert(subtotal1);

  tempItem = itemslist[vale];
  val=Number(tempItem["qty"]);

  total= Number(tempItem["price"])*Number(tempItem["qty"]);


  qtyarray.push({
  'itemId': tempItem["itemno"],
  'itemPurchaseCount': val
  });
  
  // temp_subtotal=Number(tempItem["total"]);

  temp_subtotal=Number(total);
  
  subtotal1=Number(subtotal1)+Number(temp_subtotal);

  tax=Number(tax)+Number(temp_subtotal)*Number(tempItem.gstpercentage);
  i++;

  }
}

  // This calculation for exclusive_Tax and it was default calculation
  grand_total=Number(tax)+Number(subtotal1);
  var fgrand_total=(Number(grand_total));
  var oqty=$.extend({},qtyarray);
  $("#subid").html(subtotal1.toFixed(2));
  $("#subid1").val(subtotal1.toFixed(2));
  $("#taxid").html(tax.toFixed(2));
  $("#discid").html(discount.toFixed(2));
  $("#grandid").html(Math.round(fgrand_total));
  $("#grandid1").val(Math.round(fgrand_total));
  
  grand['id']=fgrand_total;
  other_charges_calc();

  }

  $('#change_disc_pref').on('click',function(){
  checked_disc=$('input[name=disc_pref]:checked').val();
  $('#add_over_all_disc').modal('toggle');
  over_all_discount();
  });

  $('#cancel_disc').on('click',function(){
  checked_disc=$('input[name=disc_pref]:checked').val();
  $('#disc_pref_rupee').prop('checked',true);  
  });

function over_all_discount(){
  var over_all_discout=$('#overall_disc').val();
  var taxable_after_disc=0;
  var grand_tot_after_disc=0;
  var gst_after_disc=0;
  var checked_disc=$('input[name=disc_pref]:checked').val();

  var taxable_amt_1=Number($('#subid1').val());
  var grand_id_val=Number($('#grandid1').val());
  var tax=Number($("#taxid").text());
  var gst_rate=Number($('#gst_val').val());
  
  if(isNaN(taxable_amt_1)==true) {
  taxable_amt_1=grand_id_val;
  }

  if(checked_disc=='percentage')
  {
    $('#span_disc').html('Disc %');
    over_all_discout=taxable_amt_1*(over_all_discout/100);
    $('#discid').text(over_all_discout);
  }
  else{
    $('#span_disc').html('Disc ₹');
    $('#discid').text(over_all_discout);
  }

  taxable_after_disc=taxable_amt_1-over_all_discout;
  gst_after_disc=taxable_after_disc*(gst_rate/100);
  grand_tot_after_disc=taxable_after_disc+gst_after_disc;
  $('#subid').text(taxable_after_disc.toFixed(2));
  $('#taxid').text(gst_after_disc.toFixed(2));
  $("#grandid").text(Math.round(grand_tot_after_disc));
  // bal=grand_tot_after_disc-$('#overall_disc').val();
  $('#balance').val(Math.round(grand_tot_after_disc));

}

function other_charges_calc()
{
  var cd_charge=0;
  var pack_charge=0;
  var freight_charge=0;
  var pack_gst_amt=0;
  var freight_gst_amt=0;
  var pack_taxable_amt=0;
  var freight_taxable_amt=0;
  var get_per=pack_percentage();
  var taxable_amt_1=Number($('#subid1').val());
  var grand_id_val=Number($('#grandid1').val());
  if(isNaN(taxable_amt_1)==true) {
  taxable_amt_1=grand_id_val;
  }
  
  //packing charges
  var pack_val=Number($('#packing_price_id').val());
  var pack_gst=($('#pack_gst').val()==''||$('#pack_gst').val()==0)?100:$('#pack_gst').val();

  pack_val=Number(pack_val)>0?Number(pack_val):0;
  pack_gst=Number(pack_gst)>0?Number(pack_gst):0;

  //Freight charges
  var freight_val=Number($('#freight_price_id').val());
  var freight_gst=($('#freight_gst').val()==''||$('#freight_gst').val()==0)?100:$('#freight_gst').val();

  freight_val=Number(freight_val)>0?Number(freight_val):0;
  freight_gst=Number(freight_gst)>0?Number(freight_gst):0;

  if(get_per=='percentage'){
  pack_charge+=taxable_amt_1*(Number(pack_val)/100);
  pack_taxable_amt=pack_charge;//Taxable Value
  if(pack_gst!=100){
  pack_gst_amt=pack_charge*(pack_gst/100); // Individual GST calculation
  pack_charge+=Number(pack_charge)*(Number(pack_gst)/100);
  }

  freight_charge+=taxable_amt_1*(Number(freight_val)/100);
  freight_taxable_amt=freight_charge;//Taxable Value
  if(freight_gst!=100){
  freight_gst_amt=freight_charge*(freight_gst/100);
  freight_charge+=Number(freight_charge)*(Number(freight_gst)/100);

  }
  var tax=Number($("#taxid").text());
  var over_all_taxable=taxable_amt_1+pack_taxable_amt+freight_taxable_amt;
  var over_all_gst=pack_gst_amt+freight_gst_amt+tax
  var over_all_amt=taxable_amt_1+tax+pack_charge+freight_charge;

  if(taxable_amt_1>0){
    if(pack_gst!=100 || freight_gst!=100){
    // $('#subid').text(over_all_taxable.toFixed(2));
    // $('#taxid').text(over_all_gst.toFixed(2));
    }
  $('#pack_charge').text(pack_charge.toFixed(2));
  $('#freight_charge').text(freight_charge.toFixed(2));
  $("#grandid").text(Math.round(over_all_amt));
  // if ("<?=$_GET['bill_check_group']?>"!='') {
  $("#balance").val(Math.round(over_all_amt));    
  // }

  }
  }
  else
  {
  pack_taxable_amt=pack_val;//Taxable Value
  if(pack_gst!=100){
  pack_gst_amt+=pack_val*(pack_gst/100); // Individual GST calculation
  pack_val+=Number(pack_val)*(Number(pack_gst)/100);
  }
  freight_taxable_amt=freight_val;//Taxable Value
  if(freight_gst!=100){
  freight_gst_amt+=freight_val*(freight_gst/100); // Individual GST calculation
  freight_val+=Number(freight_val)*(Number(freight_gst)/100);
  }
  var tax=Number($("#taxid").text());
  var over_all_taxable=taxable_amt_1+pack_taxable_amt+freight_taxable_amt;
  var over_all_gst=pack_gst_amt+freight_gst_amt+tax
  var over_all_amt=taxable_amt_1+tax+pack_val+freight_val;
  if(taxable_amt_1>0){
    if(pack_gst!=100 && freight_gst!=100){
    // $('#subid').text(over_all_taxable.toFixed(2));
    // $('#taxid').text(over_all_gst.toFixed(2));
    }
  $('#pack_charge').text(pack_val.toFixed(2));
  $('#freight_charge').text(freight_val.toFixed(2));
  $("#grandid").text(Math.round(over_all_amt));
  // if ("<?=$_GET['bill_check_group']?>"!='') {
  $("#balance").val(Math.round(over_all_amt));    
  // }
  }
  }
  //cd charges
  var cd_val=Number($('#cd_price').val());
  cd_val=Number(cd_val)>0?Number(cd_val):0;
  
  var cd_charge =Number(over_all_amt)*(cd_val/100);
  over_all_amt = Number(over_all_amt)-Number(cd_charge);
  $("#grandid").text(Math.round(over_all_amt));
  $("#cd_charges").text(Math.round(cd_charge));
  // if ("<?=$_GET['bill_check_group']?>"!='') {
  $("#balance").val(Math.round(over_all_amt));    
  // }
}

  function removeItem(idval){
  // $("#trItem_"+idval).remove();
  
  if ("<?=$_GET['bill_check_group']?>"=="") {
  jQuery("#trItem_"+idval).empty('');
  delete items["sid"+idval] ;
}else{
  jQuery("#trItem_"+idval).empty('');
  var ref = "sid"+idval;
  items[ref].deleted='yes';
}
  // sno--;
  $('#tdata tr').each(function(index){
    $(this).find('span.sn').html(index+1);
  });
  calculation();
  // $("#subid").remove();
  // $("#taxid").remove();
  }
  $(document).ready(function(){
  $('#custnameid').autocomplete({
  source: "ajaxCalls/get_vendor.php",
  minLength: 1,
  select: function(event,ui) {
  if( ui.item.label != 'No Record Found')
  {
  // console.log(ui.item);
  // alert(ui.item[0].address_info);
  $('#cid').val(ui.item.id);
  $('#custid').val(ui.item.id);
  $('#mobile').val(ui.item.mobile);
  $('#custnameid').val(ui.item.name);
  $('#email').val(ui.item.email);
  $('#address').val(ui.item.address);
  $('#city').val(ui.item.city);
  $('#state').val(ui.item.state);
  $('#country').val(ui.item.country);
  $('#companyname').val(ui.item.companyname);
  }
  },
  }).data('ui-autocomplete')._renderItem = function(ul, item){
  // console.log('item', item);
  return $("<li class='ui-autocomplete-row'></li>")
  .data("item.autocomplete",item)
  .append(item.label+" ")
  .appendTo(ul);
  };
  
$('#saveCustomerBtn').on('click', function(){
if($("#custnameid").val()=='' || $("#custnameid").val()=='No Record Found')
{
$('#custnameid').css("border","1px solid red");
$('#custnameid').focus();
$.growl.error({title:"Name Issue", message:"Please Enter Proper Name"});
return false;
}
else
{
$('#custnameid').css("border","1px solid #ced4da");
}



  if($("#email").val()=='')
  {
    $('#email').css("border","1px solid red");
    $('#email').focus();
    $.growl.error({title:"Name Issue", message:"Please Enter Email"});
    return false;
  }
  else
  {
    $('#email').css("border","1px solid #ced4da");
  }


  if($("#mobile").val()=='')
  {
    $('#mobile').css("border","1px solid red");
    $('#mobile').focus();
    $.growl.error({title:"Name Issue", message:"Please Enter Email"});
    return false;
  }
  else
  {
    $('#mobile').css("border","1px solid #ced4da");
  }


if($("#phone").val()=='')
{
$('#phone').css("border","1px solid red");
$('#phone').focus();
return false;
}
else
{
$('#phone').css("border","1px solid #ced4da");
}


var email=$("#idemail").val();
var customname=$("#custnameid").val();
var cid=$("#cid").val();
// alert(cid);
customerarray["cid"]=cid;
var phonevar=$("#mobile").val();
var address_line_1=$("#address").val();
var city=$("#city").val();
var pincode=$("#pincode").val();
var state=$("#state option:selected").text();
if (state=="Select State") {
state=""
}else{
state=$("#state option:selected").text();
}
var area=$("#area").val();
var state_code=$("#state_code").val();

var companynamevar=$("#companyname").val();
var cgst=$("#customer_gst").val();
var cdlno=$("#customer_dlno").val();
var shopscode=$("#addressid2").text();
if (state_code==0) {
state_codes=shopscode;
}else{
state_codes=$("#state_code").val();
}

if(shopscode==state_codes) {
$('#gst_calc_type').prop('checked',true);
gst_calc_type_function();
$(".changegst").text("GST ₹");
$(".changegst1").text("Bill Amount (inclusive GST ");
$("#gst_calc_type").attr("disabled", true);
}

if (shopscode!=state_codes) {
$('#gst_calc_type').prop('checked',false);
gst_calc_type_function();
$(".changegst").text("IGST ₹");
$(".changegst1").text("Bill Amount (inclusive IGST ");
$("#gst_calc_type").attr("disabled", true);
}

$('#ccustomername').html(customname);
$('#ccompanyname').html(companynamevar);
$('#ccphone').html(phonevar);
$('#ccemailid').html(email);
$('#companynameid').html(companynamevar);
$('#ccaddress_line_1').html(address_line_1);
$('#ccity').html(city);
$('#cstate').html("("+state_code+")"+state);
$('#cstate_code').val(state_code);
$("#modelclose").click();

customers["customname"]=customname;
customers["email"]=email;
customers["phonevar"]=phonevar;
customers["address"]=address_line_1;
customers["city"]=city;
customers["pincode"]=pincode;
customers["state"]=state;
customers["companynamevar"]=companynamevar;
customers["cgst"]=cgst;



$('#saveCustomerBtn').attr('disabled','disabled');
$('#saveCustomerBtn').html('loading');
$("#customerModal").modal("toggle");
$("#customer_icon_hide").show();

var cust_address_id=$('#cust_address_id').val();

  var name=$("#custnameid").val();
  var address=$("#address").val();
  var state=$("#state").val();
  var email=$("#email").val();
  var company_name=$("#companyname").val();
  var city=$("#city").val();
  var country=$("#country").val();
  var mobile=$("#mobile").val();
  var id = $("#cid").val();

if(cust_address_id==0){
$.ajax({
url:"ajaxCalls/add_vendor.php",
type: "POST",
dataType: "json",
data:{'name':name,'address':address,'state':state,'email':email,'company_name':company_name,'city':city,'country':country,'mobile':mobile,'id':id},
// cache: false,
success: function(dataResult)
{
  console.log(dataResult);
if(dataResult.status=="new Customer") {
$("#destination").show();
$("#shipadd").hide();
$("#credit_amt").val(dataResult.prepaid);
}
$("#cid").val(dataResult.id);
$("#custid").val(dataResult.id);

  $('#mobile').val(dataResult.mobile);
  $('#custnameid').val(dataResult.name);
  $('#email').val(dataResult.email);
  $('#address').val(dataResult.address);
  $('#city').val(dataResult.city);
  $('#state').val(dataResult.state);
  $('#country').val(dataResult.country);
  $('#companyname').val(dataResult.companyname);

$('#billadd').hide();
$('#saveCustomerBtn').attr('disabled',false);
$('#saveCustomerBtn').html('Save');
$("#credit_amt").val(dataResult.prepaid);
$("#destination").val($("#shipping_destination").val());
}
});
}
else
{
$.ajax({
url:"ajaxCalls/update_custom_address.php",
type: "POST",
dataType: "json",
data:  $('#cform').serialize(),
// cache: false,
success: function(dataResult)
{
$("#cid").val(dataResult.res.cid);
$("#cust_address_id").val(dataResult.res.id);
$('#billadd').hide();
$('#saveCustomerBtn').attr('disabled',false);
$('#saveCustomerBtn').html('Save');
}
});
}
$('#cform').trigger("reset");
(customname !== '') ? $("#customername").show(): $("#customername").hide();
(companynamevar !== '') ? $("#companyname_show_hide").show(): $("#companyname_show_hide").hide();
(phonevar !== '') ? $("#phone_show_hide").show(): $("#phone_show_hide").hide();
(email !== '') ? $("#email_show_hide").show(): $("#email_show_hide").hide();
(address_line_1 !== '') ? $("#address_1_show_hide").show(): $("#address_1_show_hide").hide();
(address_line_2 !== '') ? $("#address_2_show_hide").show(): $("#address_2_show_hide").hide();
(city !== '') ? $("#city_show_hide").show(): $("#city_show_hide").hide();
(area !== '') ? $("#area_show_hide").show(): $("#area_show_hide").hide();
(pincode !== '') ? $("#pincode_show_hide").show(): $("#pincode_show_hide").hide();
(state !== '') ? $("#state_show_hide").show(): $("#state_show_hide").hide(); 
(cgst !== '') ? $("#ccgst").show(): $("#ccgst").hide();
$('#searchItem').focus();
});
});

$("#selectCustomerBtn").click(function(){
$("#customername").show();
$("#cphone").show();
$("#cgst").show();
$("#cemailid").show();
$("#caddress").hide();
});

item_id=[];

$('#product_category').on('change', function(){
var product_category = $('#product_category').val();
var i=0;
$.ajax({
type:'POST',
url:'ajaxCalls/categorymap.php',
dataType:'JSON',
data:{product_category:product_category},
success:function(dataResult){
//console.log(dataResult);
$("#product_subcategory").empty();
$.each(dataResult,function(key, value){
// console.log(value.name);
$("#product_subcategory").append('<option value=' + value['name'] + '>' + value['name'] + '</option>');
});
}
});
});

  $("#qty1").keyup(function(){
  var qty1=$(this).val();
  var qty=$("#qty2").val();
  var reorder_level=$("#reorder_level").val();
  var reorder_qty=$("#reorder_qty").val();
  <?php if ($shopDetails['is_silver_shop']=='yes') {?>
    if($("#exchange_val").prop('checked')==false){
      if(Number(qty1)>Number(qty)){
  <?php if ($_SESSION['type'] == "bill") {?>
  // $(this).css("border","1px solid red");
  $.growl.error({
  title:"Available Quantity",
  message:"You have qty on this Item :" + qty
  });
  <?php }?>
  // $('#success').html(' Quantity available is : ' + qty).show();
  // $('#add').attr('disabled','disabled');
  }
    else if (Number(reorder_level)==Number(qty)) {

       $.growl.warning({
  title:"This Item Reached Reorder Level",
  message:"Please Add Reorder Qty :" + reorder_qty
  });
    }else if(Number(reorder_level)>Number(qty)){
 $.growl.error({
  title:"This Item Reached Below The Reorder Level",
  message:"Please Add Reorder Qty :" + reorder_qty
  });
    }
  }
  <?php }else{ ?>
     if(Number(qty1)>Number(qty)){
  <?php if ($_SESSION['type'] == "bill") {?>
  // $(this).css("border","1px solid red");
  if($("#exchange_val").prop('checked')==false){
  $.growl.error({
  title:"Available Quantity",
  message:"You have qty on this Item :" + qty
  });
}
  <?php }?>
  // $('#success').html(' Quantity available is : ' + qty).show();
  // $('#add').attr('disabled','disabled');
  }
  <?php } ?>
 
  else{
  // $("#success").hide();
  $(this).css("border","1px solid lightgray");
  $('#add').attr('disabled',false);
  }
  });
  /*
  */
  // $("#advance").keyup(function(){
  //     var advance=$(this).val();
  //     if(Number(advance)>grand['id']){
  //       $(this).css("border","1px solid red");
  //       // $(".errorCall").html("Should be less than Total Amount");
  //     }
  //     else{
  //       $(this).css("border","1px solid lightgray");
  //     }
  //   });
  $("#advance").keyup(function() {
  var bill_amt=Number($('#grandid').text());
  if(bill_amt<Number($('#advance').val()))
  {
  var change=Number($("#advance").val())-grand['id'];
  $('#change').val(Math.round(change));
  $('#balance').val('0');
  }
  else if(Number($('#advance').val())<grand['id']){
    var balance=bill_amt-Number($("#advance").val());
    $('#balance').val(Math.round(balance));
    $('#change').val('0');
    }
    else if(Number($('#advance').val())==bill_amt){
    $('#balance').val('0');
    $('#change').val('0');
    }
    }).blur();
    //var subid=$("#subid").val();
    $('.save_bill').on('click', function(e){

     
    if($('#advance').val()!='')
    {
    if($('#payment_mode_conf').val()=='yes')
    {
    if($('#payment_mode').val()=='')
    {
    $('#payment_mode').css('border','1px solid red');
    $('#payment_mode').focus();
    $.growl.error({title:"Missed field",message:"Please select the mode of payment"});
    return(false);
    }
    else
    {
    $('#payment_mode').css('border','1px solid #ced4da');
    }
    }
    }
         var bill_idi=atob('<?php echo $_GET['bill_check_group']?>');
  if(bill_idi!='')
  {
    check.length=1;
  }
  if('<?=base64_decode($_GET['future_ids'])?>'!=''){
check.length=1;
  }
   if(localStorage.getItem('myArray')!=''){
check.length=1;
  }

// alert(vale.length);

    if(check.length>0){
    var advance=$("#advance").val();
    var change=$("#change").val();
    var payment_mode=$("#payment_mode").val();
    var max_total=$("#max_total").val();
    var discount=$('#discid').text();
    var bill_amt=$('#grandid1').val();
    bill_log=[];
    bill_log['payment_mode']=payment_mode;
    bill_log['advance']=advance;
    bill_log['bill_amt']=bill_amt;
    bill_log['discount']=discount;
    if($('input[name=disc_pref]:checked').val()=='percentage'){
      bill_log['disc_percentage']=$('#overall_disc').val();
    }
    
    bill_log['change']=change;
    var cid=$("#cid").val();

    // alert(cid);

    var billType = getBillType();
    var checked_credit=check_credit_bill();
    // var gst_calc_type=$("#cal_type_gst").val();
    var gst_calc_type=$('#cal_type_gst').val();
  if ($('#cal_type_gst').val()=="") {
    var gst_calc_type='GST';
  }
  // if(checked_credit=='credit_bill'){
  //   if(cid==''|| cid==0){
  //   $.growl.warning({title:"Notice", message:"Customer Name is Mandatory for Credit Bill"
  //   });  
  //   return false;
  //   }
  // }



    // console.log(gst_calc_type);
    customerarray["cid"]=$("#custid").val();

    if(customerarray["cid"]=='')
    {
          $.growl.error({
           title:"SUCCESS",
           message:"Select Vendor"
          });
          return false;
    }


    customerarray["taxable_amt"]=$("#subid1").val();
    // customerarray["gst_calc_type"]=gst_calc_type;
    customerarray["totalgstamount"]=$("#taxid").text();
    // customerarray["cust_address_id"]=$("#cust_address_id").val();
    var cobj=$.extend({},customerarray);
    var obj = $.extend({}, items);
    // var bobj=$.extend({},bill_log);
    // console.log($.isEmptyObject(items));

    if($.isEmptyObject(items)==true)
    {

    $.growl.warning({title:"Error",message:"Enter the Item Details"});

    return false;

    }
    
    $('#pay').attr('disabled','disabled');
    $('#pay').val('loading');
    // var shop_id=$('#shop_id').val();
    // var gst_type=$('#gst_type').val();
    // var business_type =$("#businesstype").val();
    var bill_id=atob('<?php echo $_GET['bill_check_group']?>');
  if(bill_id=='')
  {
    bill_id=0;
  }
    var cd_amt = $("#cd_charges").text();
    var dc_number = $("#dc_number").val();
    var bill_number = $("#bill_number").val();
    // var other_charges=get_other_charges();
    var pack_per=pack_percentage();

    var salesorderno=$("#salesorderno").val();






      // ajaxRequest();
      $.ajax({
      type: "POST",
      url:"ajaxCalls/add_purchaseorder.php",
      dataType:'JSON',
      data: $.param(obj)+'&'+$.param(cobj)+'&salesorderno='+salesorderno,
      success: function(dataResult) {
        // localStorage.clear('myArray');
      // console.log(dataResult);
      if (dataResult['status'] === 'success') {
        // window.location.href="viewpurchaseorder.php";


          $.growl.notice({
           title:"SUCCESS",
           message:"Purchase Order Created Successfully"
          });

          setTimeout(function(){
          window.location='viewpurchaseorderdetails.php?id='+dataResult.order_id;
          }, 1000);

      }
      
      
      }
      });
    }
    else{
    $.growl.warning({title:"Error",message:"Enter the Item Details"});
    }
    });
    </script>
    <script type="text/javascript">
    $(".namevalidation").bind("keypress", function (event) {
    if (event.charCode!=0) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
    event.preventDefault();
    return false;
    }
    }
    });
    </script>
    <script type="text/javascript">
  //Enter functionality
    $('#searchItemDetailForm').on('keydown', 'input', function(e) {
    if (e.key === "Enter") {
    var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
    focusable = form.find('.focus').filter(':visible');
    next = focusable.eq(focusable.index(this)+1);
    if (next.length) {
    next.focus();
    } else {
    $('#add').click();
    }
    return false; 
    }
    })
    $(".save_bill").keypress(function(e) {
    if(e.which == 13) {
    $("#pay").click();
    }
    });
    </script>

    <script type="text/javascript">

    </script>
    <script type="text/javascript">
    // ajax loader
    var ajaxLoader = [
    '<div class="ajax-loader-overlay">',
      '<div class="ajax-loader">',
        '<svg class="lds-microsoft" width="80px"  height="80px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">',
          '<g transform="rotate(0)">',
            '<circle cx="81.73413361164941" cy="74.35045716034882" fill="#0062cc" r="5" transform="rotate(340.001 49.9999 50)">',
          '<animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite" dur="1.5s" begin="0s"></animateTransform>',
          '</circle>',
          '<circle cx="74.35045716034882" cy="81.73413361164941" fill="#0062cc" r="5" transform="rotate(348.352 50.0001 50.0001)">',
        '<animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite" dur="1.5s" begin="-0.0625s"></animateTransform>',
        '</circle>',
        '<circle cx="65.3073372946036" cy="86.95518130045147" fill="#0062cc" r="5" transform="rotate(354.236 50 50)">',
      '<animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite" dur="1.5s" begin="-0.125s"></animateTransform>',
      '</circle>',
      '<circle cx="55.22104768880207" cy="89.65779445495241" fill="#0062cc" r="5" transform="rotate(357.958 50.0002 50.0002)">',
    '<animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite" dur="1.5s" begin="-0.1875s"></animateTransform>',
    '</circle>',
    '<circle cx="44.77895231119793" cy="89.65779445495241" fill="#0062cc" r="5" transform="rotate(359.76 50.0064 50.0064)">',
  '<animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite" dur="1.5s" begin="-0.25s"></animateTransform>',
  '</circle>',
  '<circle cx="34.692662705396415" cy="86.95518130045147" fill="#0062cc" r="5" transform="rotate(0.183552 50 50)">',
'<animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite" dur="1.5s" begin="-0.3125s"></animateTransform>',
'</circle>',
'<circle cx="25.649542839651176" cy="81.73413361164941" fill="#0062cc" r="5" transform="rotate(1.86457 50 50)">',
'<animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite" dur="1.5s" begin="-0.375s"></animateTransform>',
'</circle>',
'<circle cx="18.2658663883506" cy="74.35045716034884" fill="#0062cc" r="5" transform="rotate(5.45126 50 50)">',
'<animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite" dur="1.5s" begin="-0.4375s"></animateTransform>',
'</circle>',
'<animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;0 50 50" times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite" dur="1.5s"></animateTransform>',
'</g>',
'</svg>',
'</div>',
'</div>'
].join('');
// appending SVG to BODY tag of
var div = document.createElement('div');
div.innerHTML = ajaxLoader;
document.body.appendChild(div);

// function ajaxRequest(){
// $(document).ajaxStart(function(){
// $('.ajax-loader').show();
// $('.ajax-loader-overlay').show();
// }).ajaxStop(function(){
// $('.ajax-loader').hide();
// $('.ajax-loader-overlay').hide();
// });
// }

</script>
<script type="text/javascript">
$("#back_to_home").click(function(){
window.location.href="billdashboard.php";
});
</script>
<style type="text/css">
.ajax-loader-overlay {
position: fixed;
top: 0;
left: 0;
height: 100vh; /* to make it responsive */
width: 100vw; /* to make it responsive */
overflow: hidden; /*to remove scrollbars */
z-index: 9999; /*to make it appear on topmost part of the page */
display: none; /*to make it visible only on fadeIn() function */
background: rgb(255,255,255,.8);
opacity: 1.0;
}
.ajax-loader {
position: fixed;
top: 50%;
left: 50%;
overflow: hidden; /*to remove scrollbars */
z-index: 9999; /*to make it appear on topmost part of the page */
}
</style>
<script>
$(document).ready(function(){
  $('#available_qty').tooltip();  
});

// setTimeout(function(){checkSession()},10000);


// function checkSession(){
//    $.ajax({
//             url:"checkSession.php",
//             type: "GET",
//             success: function(response) {
//               if(response=="0"){
//                 window.location.href="sessionClose.php";
//               }
//               setTimeout(function(){checkSession()},10000);
//             }
//             });
// }
</script>
<script type="text/javascript">
    $(document).ready(function(){
      var cost_j=0;
      if ('<?=base64_decode($_GET['future_ids'])?>'!='') {
          // $(".modal .close").click();
          // $("#customerCloseBtn").click();
          // return false;
    $.ajax({
  data: {'ids':"<?=base64_decode($_GET['future_ids'])?>"} ,
  type: "POST",
  url:"ajaxCalls/futuretobill.php",
  dataType:'JSON',
  success: function(dataResult) {
    $("#pay").removeAttr('disabled','disabled');
    $("#save_bill").removeAttr('disabled','disabled');
    $('#tdata').prepend(dataResult.out);
    $('#ccustomername').html(dataResult.ccustomername);
  $('#cid').val(dataResult.cid);
  $('#ccompanyname').html(dataResult.ccompanyname);
  $('#ccaddress_line_1').html(dataResult.ccaddress_line_1);
  $('#ccaddress_line_2').html(dataResult.ccaddress_line_2+","+dataResult.city+"-"+dataResult.cpincode);
  $('#cstate').html(dataResult.cstate);
  $('#ccphone').html(dataResult.ccphone);
  $('#cemailid').html(dataResult.cemailid);
  $('#ccgst').html(dataResult.ccgst);
   $("#s_no").val(dataResult.sno);
   var sno=0;
      $.each(dataResult.item,function(key, value){
         
       sno=sno+1;
          
    items["sid"+sno] = {
              "itemno":value.item_id,
              "itemname":value.final_itemname,
              "qty":Number(value.final_qty),
              "availableQty":100,
              "price":Number(value.final_price),
              "gst":Number(value.final_gst),
              "gstpercentage":value.final_gstpercentage,
              "discount":Number(value.final_discount),
              "total":Number(value.final_total),
              "batch_no":value.batch_no,
              "gstamount":Number(value.gstamount),
              "cost":Number(value.cost),
              "gsttype":value.gsttype,
              "weight":Number(value.weight),
              "grams":value.grams,
              "combination_id":value.combination_id,
              "hsn":value.hsn,
              "deleted":'no',
              "exchange":value.exchange,
              "perunit":value.perunit,
              "bill_date":value.bill_date,
              "flag":'new',
              "discount_val":Number(value.lessdiscount),
    };
    calculation();
    });
  }
  });
      }
    })
  </script>
  <script type="text/javascript">
    function clear_data() {
      var array2 = localStorage.getItem('myArray');
array2 = JSON.parse(array2);
var sno2=0;
$.each(array2,function(key, value){
  sno2=sno2+1;
      jQuery("#trItem_"+sno2).empty('');
  delete items["sid"+value.sid] ;
});
calculation();
  localStorage.clear('myArray');
    }

  </script>
  <script type="text/javascript">
     
      var array1 = localStorage.getItem('myArray');
array1 = JSON.parse(array1);
if (localStorage.getItem('myArray')!=null) {

      $.ajax({
      data: {'id':array1,'page':'bill1'} ,
      type: "POST",
      url:"ajaxCalls/storage_items_get.php",
      dataType:'JSON',
      success: function(res) {
     $('#tdata').prepend(res.out);
     var sno1=0;
         
       
     $.each(array1,function(key, value){
         sno1=sno1+1;
          
    items["sid"+value.sid] = {
  "sid":value.sid,
  "batch_no":value.batch_no,
  "cost": value.cost,
  "itemno":value.itemno,
  "itemname":value.itemname,
  "weight":value.weight,
  "combination_id":value.combination_id,
  "qty":value.qty,
  "availableQty":value.availableQty,
  "price":value.price,
  "gsttype":value.gsttype,
  "gst":value.gst,
  "gstpercentage":value.gstpercentage,
  "gstamount":value.gstamount,
  "discount":value.discount,
  "hsn":value.hsn,
  "total":value.total,
  "exchange":value.exchange,
  "bags":value.bags,
  "deleted":'no',
  "perunit":value.perunit,
  "grams":Number(value.grams),
  "silver_price":value.silver_price,
  "wast":value.wast,
  "mc":value.mc,
  "flag":'new',
  "discount_val":value.discount_val,
  "free_qty":value.free_qty,
    };
    });  
     $("#s_no").val(sno1);
     $("#clear_data").css('display','');
     $("#customerModal").modal('hide');
        calculation();
      }
      });
        
      }
    </script>
      <script type="text/javascript">
      $(document).ready(function(){
        if ("<?=$_SESSION['user_type']?>"=='Collectors') {
          $('#bill_type').prop('checked',false);
          $('#bill_type').attr('disabled','disabled');
          $('.hide_credit_bill').hide();
        }
      })
    </script>
    <script type="text/javascript">
      $('.price_radio_check').click(function(){   
          var checked_id=$(this).attr('id');
          // console.log(checked_id); 
          $("#checked_val").val(checked_id);
          $('.price_radio_check').prop('checked',false);
          $('#'+checked_id).prop('checked',true);
          checked_price=$('#check_price'+checked_id).val();
          checked_price_disc=$('#check_price'+checked_id+'_disc').val(); 
          if(checked_price!=0 && $("#searchItem").val()!='') { 
            $("#price1").val(checked_price);
            $("#discount1").val(checked_price_disc); 
          }  
        }) 
      </script>
      <script>
        $('#search_pay_billid').keypress(function(event){
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            tab();
          }
        });
      </script>
      <script>
        function tab()
      {
      if($("#search_pay_billid").val()!='')
      {
      // $('#pay').val('Pay Bill');
      $("#pay").css('display','none');
      $("#save_bill").css('display','none');
      $("#clear_data").css('display','');
      $('#pay').attr('disabled',false);
      var bill_id=$("#search_pay_billid").val();
      var shopid_invoice=$("#shop_id").val();
          $.ajax({
  data: {'invoice_no':bill_id,"bill":"bill","type":"search_invoice_no","shop_id":shopid_invoice} ,
  type: "POST",
  url:"ajaxCalls/getBillDetails.php",
  dataType:'JSON',
  success: function(dataResult) {
  if(dataResult.out=='Cancelled')
  {
  $.growl.warning({title:"Cancelled",message:"Bill Already Cancelled"});
  }
  else
  {
  if(Number(dataResult.bill_id)!=0){
  $('#search_pay_billid').attr("disabled","disabled");
  $('#tdata').prepend(dataResult.out);
  if(dataResult.bill_type=='Estimation'){
$('#bill_type').prop('checked',false);
getBillType();
  }
  $("#shop_id").val(dataResult.shop_id);
  $("#balance").val(dataResult.balance);
  $("#balancedb").val(dataResult.balance);
  $("#billDate").val(dataResult.bill_date);
  $("#bill_no_val").val(dataResult.invoice_no);
  // $("#grandid1").val(dataResult.gtotal);
  // $("#taxid").html(dataResult.totaltax);
  $("#bill_id").val(dataResult.bill_id);
  // $("#advancedb").val(dataResult.advancedb);
  // $("#subid").html(dataResult.subtotal);
  $("#billDate").removeAttr('readonly');
  $("#payment_mode").val(dataResult.payment_mode);
  $('#ccustomername').html(dataResult.ccustomername);
  $("#customer_icon_hide").show();
  $('#cid').val(dataResult.cid);
  $('#ccompanyname').html(dataResult.ccompanyname);
  $('#ccaddress_line_1').html(dataResult.ccaddress_line_1);
  $('#ccaddress_line_2').html(dataResult.ccaddress_line_2+","+dataResult.city+"-"+dataResult.cpincode);
  $('#cstate').html(dataResult.cstate);
  $('#ccphone').html(dataResult.ccphone);
  $('#cemailid').html(dataResult.cemailid);
  $('#ccgst').html(dataResult.ccgst);
   $("#s_no").val(dataResult.sno);
   var sno=0;
      $.each(dataResult.item,function(key, value){
         
       sno=sno+1;
          
    items["sid"+sno] = {
              "itemno":value.item_id,
              "itemname":value.final_itemname,
              "qty":Number(value.final_qty),
              "availableQty":100,
              "price":Number(value.final_price),
              "gst":Number(value.final_gst),
              "gstamount":Number(value.gstamount),
              "gsttype":value.gsttype,
              "gstpercentage":value.final_gstpercentage,
              "discount":value.final_discount,
              "total":Number(value.final_total),
              "batch_no":value.batch_no,
              "cost":Number(value.cost),
              "weight":Number(value.weight),
              "grams":value.grams,
              "combination_id":value.combination_id,
              "hsn":value.hsn,
              "deleted":'no',
              "exchange":value.exchange,
              "perunit":value.perunit,
              "bill_date":value.bill_date,
              "flag":'old',
              "discount_val":value.lessdiscount,
              "main_id":value.main_id,
    };
    calculation();
    });
  }
  else
  {
  $.growl.warning({title:"Invalid Bill no",message:"Please enter valid bill number "});
  }
  }
  }
  });
      }
      else{
      $('#pay').val('Print');
      $('#pay').attr('disabled','disabled');
      }
      }
      </script>
      <script>
        $("#qty1").blur(function(){
          if($("#searchItem").val()!='' && $("#qty1").val()=='' ){
            $.growl.error({
            title:"Quantity issue",
            message:"Please enter quantity"
            });
          $("#qty1").focus();
          return false;
          }
        })
      </script>
