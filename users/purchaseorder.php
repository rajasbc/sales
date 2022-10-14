<?php
include '../includes/config.php';
include 'header.php';
$obj1= new Product();
$get_countries=$obj1->get_countries();

if($_GET['bill_check_group']!='')
{
  $oobj = new Salesorder();
  $ores = $oobj->get_order(base64_decode($_GET['bill_check_group']));
}

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
           <h5 class="m-b-10">Outgoing PO</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item"><a href="viewpurchaseorder.php">Outgoing PO view </a></li>
           <li class="breadcrumb-item">Outgoing PO List</li>
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

            <div id="customer_icon_hide" style="display: none;">
          <div id="companyname_show_hide">
            <em id="companyname_1">
              <img src="images\company_icon.png" class="media-object" style="width:10px">
            </em>
            <em id='ccompanyname'></em>
          </div>
          <div id="address_1_show_hide">
            <em>
              <img src="images\location_icon.png" class="media-object" style="width:10px">
            </em>
            <em id="ccaddress"></em>
          </div>

          <span id="area_show_hide">
            <em id="carea"></em>
          </span>
          <span id="city_show_hide">
            <em id="ccity"></em>
          </span>
          <span id="state_show_hide">
            <em id="cstate"></em>
          </span>
          <span id="Country_show_hide">
            <em id="ccountry"></em>
          </span>

          <div id="phone_show_hide">
            <em id="cphone">
              <img src="images\landline.svg" class="media-object" style="width:10px">
            </em>
            <em id="ccphone"></em><br>
          </div>

          <em id="ccgst"></em>
        </div>


          </div>

          <div class="col-md-5">
            <div class="form-group row">
              <!-- <div class=" col-lg-7 col-sm-7 col-sm-7 md-6">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text ">🔎</span>
                  </div>
                  <input type='text' id='searchItem' name='searchItem'  class="form-control" placeholder="Search Product Here" autocomplete="off">
                  <input type='hidden' id='originalname' name='originalname' >
                </div>
              </div> -->

              <div class=" col-lg-10 col-sm-10 col-sm-10 md-6">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text ">S.Order No.</span>

                    <input type='hidden' id='salesorderno' name='salesorderno' class="form-control" placeholder="Sales Order No" value="<?=base64_decode($_GET['bill_check_group'])?>" readonly />

                  </div>
                  <input type='text' class="form-control" value="<?=$ores['invoice_no']?>" readonly />
                </div>
              </div>
              <br>
              <br>
              <div class=" col-lg-10 col-sm-10 col-sm-10 md-6">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text ">Shipment Date</span>
                  </div>
                  <input type='date' class="form-control" id="exp_date" min="<?=date('Y-m-d')?>">
                </div>
              </div>

            </div>

            <div class="form-group row">
              <!-- <div class="col-lg-4 col-sm-4 col-md-4"> -->
       <!--          <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">VAT (%)</span>
                  </div>
                  <input class="form-control"  id="id6" type="text" autocomplete="off">
                  <input class="form-control" id="gst_val" type="text" autocomplete="off">
                </div>
                <input id="gstpercentage" type="hidden" >
              </div> -->
        <!--       <div class=" col-lg-4 col-sm-4 col-md-4" >
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Price ($)</span>
                  </div>
                  <input class="form-control" id="price1" type="number" onkeypress="if(this.value.length==15)return false" autocomplete="off">
                </div>
                <input class="form-control" id="price2" type="hidden" onkeypress="if(this.value.length==15)return false">                
              </div> -->
<!--               <div class="col-lg-4 col-sm-4 col-md-4">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">QTY<div id="available_qty" style="display:none"> <span class="ml-3"  data-toggle='view_qty' title='QTY=' style="cursor:pointer">i</span></div></span>
                  </div>
                  <input class="form-control focus" id="qty1" type="number"  onkeypress="if(this.value.length==10)return false" autocomplete="off">
                  
                </div>
                <input class="form-control" id="qty2" type="hidden" >
              </div> -->
            </div>

             <!--  <div class="form-group row">              
              <div class="col-lg-2 col-sm-2 col-md-2">
                <input id="itemno" type="hidden" value="0">
                  <button class="btn btn-sm btn-info align-center" id="add" type="button>">ADD</button>
              </div>
            </div> -->


          </div>

        </div>
        <!-- row -->

        <div class="row">
          <div class="well col-sm-12 col-md-12 col-lg-12 mt-1">
            <div id="table-scroll" class="table-scroll">
              <table class="table bill-table table-bordered" id="bill-table">
                <thead>
                  <tr>
                    <!-- <th class="text-left">S.No</th> -->
                    <th class="text-left">Items</th>
                    <th class="text-left">Price ($)</th>
                    <th class="text-left">Qty</th>
                    <th class="text-left">VAT % </th>
                    <th class="text-left">Total ₹</th>
                    <th class="text-left">Action</th>
                  </tr>
                </thead>
                <tbody class="text-left" id="tdata">
                  <?php for ($i = 1; $i < 4; $i++) { ?>
                    <tr class="emptyTr">
                      <!-- <td>&nbsp;</td> -->
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
                    <td colspan="7" class="td-last-1">

                      <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-2 col-sm-2 col-md-2">
                          <div class="">
                            <span class="">Amount Before Tax ($)</span>
                            <span class="" id="subid">0</span>
                            <input type="hidden" name="subid1" id="subid1">
                          </div>
                        </div>
<div class="col-lg-2"></div>
                        <div class="col-lg-2 col-sm-2 col-md-2">
                          <div class="">

                            <span>VAT ($)</span>
                            <span class="" id="taxid">0</span>

                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3">
                          <div class="">

                            <span class="">Total Amount ($)</span>

                            <span class="text" id="grandid">0</span>
                            <input type='hidden' class="text" id="grandid1" value="0">
                          </div>
                        </div>
</div>
<div class="row mt-3">
  <div class="col-lg-10"></div>
                        

                          <div class="col-lg-2 col-sm-2 col-md-2">
                            <input type="button" class="btn btn-sm btn-success save_bill" id="pay" value="Save" />
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
        <input type="hidden" id="price1">
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
                          <span class="input-group-text input-group-text1">Mobile<span style="color: red">&nbsp;*</span></span>
                        </div>
                        <input class="form-control cust_form"  id="mobile" name="mobile" onKeyPress="if(this.value.length==10)return false;" type="text" autocomplete="off"placeholder='Mobile No.'>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-12">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text input-group-text1">Email<span style="color: red">&nbsp;*</span></span>
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
                          <span class="input-group-text input-group-text1">Address<span style="color: red" class="<?php echo $hide_silver_data1?>">&nbsp;</span></span>
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
                        <input class="form-control cust_form" id="state" name="state" type="text" autocomplete="off" placeholder="State" onkeypress="if(this.value.length==25) return false;">

                      </div>
                    </div>

                  </div>
                  <div class="form-group row">
                    <div class="col-lg-12">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text input-group-text1">Country</span>
                        </div>

                        <select name="country" class="form-control cust_form" id="country" >
                           <option value="select">Select Country</option>

                         <?php

                         foreach ($get_countries as $value) {
                                      // print_r($value);die();
                          if ($value['name']=="INDIA") {
                           echo "<option value='".$value['id']."' selected='selected' data-id='".$value['phonecode']."'>". $value["name"]."</option>";

                         }
                         else
                         {                        
                           echo "<option value='".$value['id']."' data-id='".$value['phonecode']."' >" . $value["name"]."</option>";

                         }
                       }

                       ?>

                     </select>
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



</main>
</div>


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

    $('#weight').val('');
    <?php if ($shopConfiguration['required_weight_multiple']=='yes') {?>
      $('#weight').val(item.default_wt);
    <?php } ?>
    $('#qty1').val(1);
    $('#qty2').val(item.qty);

  //MULTIPLE ITEM PRICE

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


  // Assume that it is from the scanner if it was entered really fast

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

    // alert("sd");

    $(ele).focus();
    // return false;
    $('#pay').attr('disabled',true);
      return false;
    
  }
  else
  {
    $('#pay').attr('disabled',false);
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
    else
    {
      $('#pay').attr('disabled',false);
      $(ele).css("border","1px solid #ccc");
      // return false;
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
  

  itemslist = items;
  qtyarray = [];
  
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

  // alert(tempItem.gstpercentage);

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
  $("#grandid").html(fgrand_total.toFixed(2));
  $("#grandid1").val(fgrand_total.toFixed(2));
  
  // grand['id']=fgrand_total;
  // other_charges_calc();

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
var country=$("#country option:selected").val();
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
$('#ccountry').html(country);
$('#companynameid').html(companynamevar);
$('#ccaddress').html(address_line_1);
$('#ccity').html(city);
$('#cstate').html(state);
// $('#cstate_code').val(state_code);
$("#modelclose").click();

customers["customname"]=customname;
customers["email"]=email;
customers["phonevar"]=phonevar;
customers["address"]=address_line_1;
customers["city"]=city;
customers["pincode"]=pincode;
customers["state"]=state;
customers["companynamevar"]=companynamevar;
customers["country"]=country;

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
var country=$("#country option:selected").val();
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
  $('#ccountry').html(dataResult.country);
  $('#companyname').val(dataResult.companyname);

  $('#billadd').hide();
  $('#saveCustomerBtn').attr('disabled',false);
  $('#saveCustomerBtn').html('Save');
  $("#credit_amt").val(dataResult.prepaid);
  $("#destination").val($("#shipping_destination").val());
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
(country !== '') ? $("#country_show_hide").show(): $("#country_show_hide").hide();
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
}
<?php } ?>

else{
  // $("#success").hide();
  $(this).css("border","1px solid lightgray");
  $('#add').attr('disabled',false);
}
});

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
        var billType = getBillType();
        var checked_credit=check_credit_bill();
        var gst_calc_type=$('#cal_type_gst').val();
        if ($('#cal_type_gst').val()=="") {
          var gst_calc_type='GST';
        }
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
        customerarray["totalgstamount"]=$("#taxid").text();
        var cobj=$.extend({},customerarray);
        var obj = $.extend({}, items);

        if($.isEmptyObject(items)==true)
        {

          $.growl.warning({title:"Error",message:"Enter the Item Details"});

          return false;

        }

        $('#pay').attr('disabled','disabled');
        $('#pay').val('loading');
        var bill_id=atob('<?php echo $_GET['bill_check_group']?>');
        if(bill_id=='')
        {
          bill_id=0;
        }
        var cd_amt = $("#cd_charges").text();
        var dc_number = $("#dc_number").val();
        var bill_number = $("#bill_number").val();
        var pack_per=pack_percentage();

        var salesorderno=$("#salesorderno").val();
        var exp_date=$("#exp_date").val();
        $.ajax({
          type: "POST",
          url:"ajaxCalls/add_purchaseorder.php",
          dataType:'JSON',
          data: $.param(obj)+'&'+$.param(cobj)+'&salesorderno='+salesorderno+'&exp_date='+exp_date,
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
