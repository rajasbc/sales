<?php
include '../includes/config.php';
include 'header.php';
// error_reporting(E_ALL);
// if($_GET['id']!=''){
$id=$_GET['id'];
$obj = new Vendor();

  // $result =  $obj->get_vendors($id);
$obj1= new Product();


$get_countries=$obj1->get_countries();
// print_r($get_countries);die();
// echo $get_countries;

// }


$uid = $_SESSION['uid'];


$userobj = new Admin();
$userresult = $userobj->getsalesperson();
$userdet = $userobj->getusername($uid);


?>
<style>
  .danger{
    color: red;
  }
  .input-group-text1{
    width: 110px;
  }
</style>
<style type="text/css">

  .ui-autocomplete {
    max-height: 400px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
    /* add padding to account for vertical scrollbar */
    padding-right: 20px;
    z-index: 999999;
  } 

  #ui-id-1,#ui-id-2,#ui-id-3,#custnameid,{
    z-index: 99999;
  }
  
  .nav-fixed #layoutSidenav #layoutSidenav_content {
    padding-left: 0rem;
    top: 0rem;
  }
  .footer {
    height: 0rem;
  }

  #ui-id-1
  {
    z-index: 99999;
  }

  select.custom-select {
    -webkit-appearance: menulist;
  }

</style>

<link rel="stylesheet" href="assets/css/jquery-ui.css" />

<div class="pcoded-main-container">
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
           <h5 class="m-b-10">Incoming PO</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item"><a href="viewsalesorder.php">Incoming PO list</a></li>
           <li class="breadcrumb-item"><a href="#!">Incoming PO</a></li>
           
         </ul>
       </div>
     </div>
   </div>
 </div>

 <div class="row ">
   <div class="col-sm-12">
    <div class="card">
     <div class="card-body">


       <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 text-left">
         <em id="customername" data-toggle="tooltip" title="Select Customer">
          <img src="images\usericon.jpg" class="media-object" id ="selectCustomerBtn" data-toggle="modal" data-target="#customerModal" style="width:40px;cursor:pointer;margin-left:-14px">
        </em> 
        <em id='ccustomername'></em>
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

      
      <input type="hidden" id="s_no">
      <div class="col-sm-6 col-lg-6 ml-auto col-md-6 mt-1">
        <input class="form-control" id="combination_id" type="hidden" value="0" >

        <form id="searchItemDetailForm" onsubmit="javascript:return false;">


          <input type="hidden" name="checked_val" id="checked_val" value="F">
          <div class="form-group">
            <div class=" col-lg-7 col-sm-7 col-sm-7" style="padding:0px;">
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text ">🔎<span class="text-danger">*</span></span>
                </div>
                <input type='text' id='searchItem' name='searchItem'  class="form-control product_add" placeholder="Search Product Here" autocomplete="off">

                <input type='hidden' id='originalname' name='originalname' >
              </div>
            </div>  
          </div>
<!--       <div class="form-group">

        
        <div class="col-lg-7 col-sm-7 col-md-7" style="padding:0px;">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text">QTY<div id="available_qty" style="display:none"> <span class="ml-3"  data-toggle='view_qty' title='QTY=' style="cursor:pointer">i</span></div></span>
            </div>
            <input class="form-control focus numeric" id="qty1" type="text" placeholder="Enter Qty" autocomplete="off">

          </div>
          <input class="form-control" id="qty2" type="hidden" >
          <input class="form-control" id="reorder_qty" type="hidden" >
          <input class="form-control" id="reorder_level" type="hidden" >
          
        </div>

          <div class="col-lg-8 col-sm-8 col-md-8" style="padding:15px; border-left-width: 50px;">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text">Price<div id="price"> <span class="ml-3"  data-toggle='price' title='price=' style="cursor:pointer"></span></div></span>
            </div>
            <input class="form-control focus numeric" id="price1" type="text" placeholder="Enter Price" autocomplete="off">

          </div>
          
        </div>
        
      </div> -->


      <input id="itemno" type="hidden">
      <div class="form-group row">
        <div class="col-lg-4 col-sm-4 col-md-4">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text">VAT (%)</span>
            </div>
            <!-- <input class="form-control"  id="id6" type="text" autocomplete="off"> -->
            <input class="form-control product_add" id="gst_val" type="text" autocomplete="off">
          </div>
          <input id="gstpercentage" type="hidden" >
        </div>
        <div class=" col-lg-4 col-sm-4 col-md-4" >
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text">Price ($)</span>
            </div>
            <input class="form-control product_add" id="price1" type="text" onkeypress="if(this.value.length==15)return false" autocomplete="off">
          </div>
          <input class="form-control" id="price2" type="hidden" onkeypress="if(this.value.length==15)return false">                
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text">QTY<span class="text-danger">*</span><div id="available_qty" style="display:none"> <span class="ml-3"  data-toggle='view_qty' title='QTY=' style="cursor:pointer">i</span></div></span>
            </div>
            <input class="form-control focus product_add" id="qty1" type="text"  onkeypress="if(this.value.length==10)return false" autocomplete="off">

          </div>
          <input class="form-control" id="qty2" type="hidden" >
        </div>
      </div>


      

      <?php
      if($userdet['type']=='Admin')
      {
        ?>
        <div class="col-lg-7 col-sm-7 col-md-7" style="padding:0px;">
          <div class="form-group" style="height:25px;">

            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">Sales Person</span>
              </div>

              <select name="salesperson" id="salesperson" class="custom-select custom-select-sm product_add">
                <option value="">-- Select --</option>
                <?php

                foreach($userresult as $row)
                {
                  echo"<option value='".$row['id']."'>".$row['name']."</option>";
                }

                ?>
              </select>

            </div>
          </div>
        </div>

        <?php
      }
      else
      {
        echo"<input type='hidden' name='salesperson' id='salesperson' value='".$_SESSION['uid']."' />";
      }
      ?>

      


      <div class="form-group row">

        <div class="col-lg-2 col-sm-2 col-md-2">
          <button class="btn btn-sm btn-info align-center product_add" id="add" type="button>" >ADD</button>
        </div>

      </div>
    </form>
  </div>

</div>


<div class="row mt-2">
  <div class="well col-sm-12 col-md-12 col-lg-12 mt-1">
    <div id="table-scroll" class="table-scroll">
      <table class="table table-bordered bill-table" id="bill-table">
        <thead>
          <tr>
            <!-- <th class="text-left">S.No</th> -->
            <th class="text-left">Item Name</th>
            <th class="text-left">Price($)</th>
            <th class="text-left">Qty</th>
            <th class="text-left">VAT(
            %)</th>
            <th class="text-left">Total($)</th>
            <th class="text-left">Action</th>
          </tr>
        </thead>
        <tbody class="text-left" id="tdata">
          <?php for ($i = 1; $i < 3; $i++) { ?>
            <tr class="emptyTr">
              <!-- <td id="s_no">&nbsp;</td> -->
              <td id="item_name">&nbsp;</td>
              <td id="price">&nbsp;</td>
              <td id="qty">&nbsp;</td>
              <td id="vat">&nbsp;</td>
              <td id="total">&nbsp;</td>
              <td id="action">&nbsp;</td>

            </tr>
          <?php }?>
        </tbody>

        <tfoot>
          <tr>
            <td colspan="13" class="td-last-1">

              <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-2 col-sm-2 col-md-2">
                  <div class="">
                    <span class="">Total Amount  Before Tax ($)</span>
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
              <div class="row">
                <div class="col-lg-11"></div>

                <div class="col-lg-1 col-sm-1 col-md-1">
                  <input type="button" class="btn btn-sm btn-success save_bill" id="save_bill" value="Save" />
                </div>


              </div>

            </td>
          </tr>

        </tfoot>


      </table>
    </div>
  </div>
</div>
<!--   <div class='col-lg-12 col-sm-12 col-md-12 mt-2 text-right'>
    <div class='row'>
      <div class="col-lg-10 col-sm-10 col-md-10">
      </div>
      <div class="col-lg-2 col-sm-2 col-md-2">
       <button class="btn btn-info col-lg-6 col-sm-6 col-md-6" id="nextid" >Next</button> -->
       <!-- <input type="button" class=" col-lg-6 col-sm-6 col-md-6 mr-5 btn btn-sm btn-success save_bill" id="save_bill" value="Save"> -->
       <!-- <a class="btn btn-info col-lg-6 col-sm-6 col-md-6 mr-5" target="_blank" href="bill.php">Save/Next</a> -->
    <!--   </div>
       </div>
     </div>  -->


   </div>
 </div>
</div>
<!-- Modal -->

<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="cform" onsubmit="javascript:return false;">
      <input type="hidden" name="cust_address_id" id="cust_address_id" value="0">
      <input type="hidden" name="address_info" id="address_info" value="primary">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="customerModalTitle"><strong>Customer Details</strong></h5>
          <button class="close" type="button" data-dismiss="modal" id="customerCloseBtn" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <!--     <div class="col-lg-4 col-sm-4 col-md-4">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Title</span>
                    </div>
                    <select class="form-control cust_form" id="title" name="title">
                      <option value="Mr">Mr</option>
                      <option value="Ms">Ms</option>
                    </select>
                  </div>
                </div> -->
                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">Name<span style="color: red;">&nbsp;*</span></span>
                    </div>
                    <input class="form-control cust_form" id="custnameid" name="custname" type="text" placeholder="Customer Name" autocomplete="off" onkeypress="if(this.value.length==50) return false;">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-12 ">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">+91<span style="color: red">&nbsp;*</span></span>
                    </div>
                    <input class="form-control cust_form "  id="mobile" name="mobile" onKeyPress="if(this.value.length==10)return false;" type="text" autocomplete="off"placeholder='Mobile No.'>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1">Email<span style="color: red;">&nbsp;*</span></span>
                    </div>
                    <input  class="form-control cust_form" type="email" id="email" name="email" autocomplete="off" placeholder="Email Id" onkeypress="if(this.value.length==25) return false;">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-12">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text input-group-text1" id="com">Company Name<span style="color: red" class="<?php echo $hide_silver_data1?>"></span></span>
                    </div>
                    <input class="form-control cust_form" id="companyname" name="companyname" type="text" autocomplete="off" placeholder="Company name"onkeypress="if(this.value.length==25) return false;">
                    <select class="form-control" style="border-left-width: 0px;display: none" id="billadd"></select>
                    <input id="cid" type="hidden" name="cid" >
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
                    <!--  <input class="form-control cust_form" id="country" name="country" type="text" autocomplete="off" placeholder="Country" onkeypress="if(this.value.length==25) return false;"> -->

                    <select name="country" class="form-control cust_form" id="country" >
                      <option value="select">Select Country</option>

                      <?php

                      foreach ($get_countries as $value) {
                                      // print_r($value);die();
                        if ($value['name']=="INDIA") {
                         echo "<option value='".$value['name']."' selected='selected' data-id='".$value['phonecode']."'>". $value["name"]."</option>";

                       }
                       else
                       {                        
                         echo "<option value='".$value['name']."' data-id='".$value['phonecode']."' >" . $value["name"]."</option>";

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
            <button class="btn btn-sm btn-warning"  id="modelclose" type="button" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <?php
  include 'footer.php';
  ?>

  <script type="text/javascript">

    $('.numeric').on('input', function (event) { 
      this.value = this.value.replace(/[^0-9\.]/g, '');
    });

    $(document).ready(function(){

      $('#custnameid').autocomplete({

        source: "ajaxCalls/get_custom.php",
        minLength: 1,
        select: function(event,ui) {
          if( ui.item.label != 'No Record Found')
          {
  // console.log(ui.item);
  // alert(ui.item[0].address_info);
  $('#cid').val(ui.item.id);
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
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
      // alert();
      $('#searchItem').autocomplete({
    // console.log('df');

    source: "ajaxCalls/get_items.php",
    minLength: 1,
    select: function(event,ui) {
      if( ui.item.label != 'No Record Found')
      {
  // console.log(ui.item);
  // alert(ui.item[0].address_info);
  $('#searchItem').val(ui.item.name);
  $('#id6').val(ui.item.hsn_code);
  // $('#price1').val(ui.item.price);
  // $('#qty1').val(ui.item.qty);
  $('#item_id').val(ui.item.id);
  
}
},
}).data('ui-autocomplete')._renderItem = function(ul, item){
  // console.log('item', item);
  return $("<li class='ui-autocomplete-row'></li>")
  .data("item.autocomplete",item)
  .append(item.label+" ")
  // .append(item.name)
  .appendTo(ul);
};

});
</script>
<script type="text/javascript">

  data = [];

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
  var price=$("#price1").val();
  var price=$("#price1").val();
  var id=$("#item_id").val();
  var qty=$("#qty1").val();


  // if(Number($("#price1").val())==0)
  // {
  //   $("#price1").css("border","1px solid red");
  //   $("#price1").focus();
  //   var qty1= $("#qty1").val(); 
  //   $.growl.error({
  //     title:"Price issue",
  //     message:"Please enter price"
  //   });
  //   return false;
  // }
  // else
  // {
  //   $("#price1").css("border","1px solid #ced4da");
  // }


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

  function getRegEx(str) {
    return new RegExp('{{' + str + '}}', 'g');
  }
  function removeItem(idval){
  // $("#trItem_"+idval).remove();
  
  if ("<?=$_GET['bill_check_group']?>"=="") {
    jQuery("#trItem_"+idval).empty('');
    delete items["sid"+idval] ;
    $("#s_no").val(idval-sno);
  }else{
    jQuery("#trItem_"+idval).empty('');
    var ref = "sid"+idval;
    items[ref].deleted='yes';
  // $("#s_no").val(idval);
}
  // sno--;
  $('#tdata tr').each(function(index){
    $(this).find('span.sn').html(index+1);
  });
  calculation();
  // $("#subid").remove();
  // $("#taxid").remove();
}


var sno = 0;
customerarray = [];
items = [];

function add_productrow()
{

  $('#overall_disc').val('');
  
  $('#balance').val('');
  $('#advance').val('');
  $('#change').val('');

  
  // var item_id_check=$('#itemno').val();
  // if(Number($("#qty1").val())==0)
  // {
  //   $("#qty1").css("border","1px solid red");
  //   $("#qty1").focus();
  //   var qty1= $("#qty1").val(); 
  //   $.growl.error({
  //     title:"Quantity issue",
  //     message:"Please enter quantity"
  //   });
  //   return false;
  // }
  // else
  // {
  //   $("#qty1").css("border","1px solid #ced4da");
  // }


  if($("#searchItem").val()!=""){

// alert($("#searchItem").val());

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

  // data["itemno"]=$("#itemno").val();
  
  data['bags']='';

  data["qty"]=$("#qty1").val();
  
  var cqty=$("#qty1").val();
  // data["total"]=total.toFixed(2);
  // var cid=$("#cid").val();
  var itemcol=$("#searchItem").val();
  var price=$("#price1").val();
  var qty=$("#qty1").val();
  var itemno=$("#itemno").val();

  data["gstpercentage"]=gstpercentage;
  data["itemname"]=itemcol;
  data["price"]=price;
  data["id"]=itemno;
  data["gst"]=gstp;

  total1=Number(data["price"])*Number(data["qty"]);
  
  total=Number(total1)+Number(total1)*gstpercentage;

  prototal=Number(($("#price1").val()*$("#qty1").val()));

  gstamount=prototal*Number(gstpercentage);
  data["total"]=total.toFixed(2);
  // alert($("#qty1").val());

//item array insertion

items["sid"+sno] = {
  "sid":sno,
  "itemno":itemno,
  "itemname":itemcol,
  "price":price,
  "gst":gstp,
  "gstpercentage":gstpercentage,
  "gstamount":gstamount,
  "qty":$("#qty1").val(),
  "total":total,
};

//'<td class="text-left ch-4">{{sno}}</td>',

var trItemTemplate = [
'<tr class="productrow" id="trItem_{{sno}}">',
'<td class="text-left ch-10">{{itemname}}</td>',

'<td class="text-left ch-6">',
'<input type="text" onkeyup=costupdate({{sno}},this) class="form-control price" name="price[]" id="priceid{{sno}}" value="{{price}}" style="width:5rem; height:1.75rem">',
'</td>',
'<td class="text-left ch-4">',
'<input onkeyup=priceupdate({{sno}},this) type="text" class="form-control qty" name="qty[]" id="num_qty{{sno}}" value="{{qty}}" style="width:5rem; height:1.75rem" onkeypress="if(this.value.length==8) return false">',
'</td>',
'<td class="text-left ch-4"><input type="text" class="form-control gst" onkeyup=gstupdate({{sno}},this) id="gstpid{{sno}}" value="{{gst}}" style="width:5rem; height:1.75rem"></td>',
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
tr = tr.replace(getRegEx('price'),data['price']);
tr = tr.replace(getRegEx('qty'), data['qty']);
tr = tr.replace(getRegEx('gst'), data['gst']);
tr = tr.replace(getRegEx('total'), data['total']);
var emptyTr = $('#tdata .emptyTr').first();


if (emptyTr.length === 0) {
  $('#tdata').append(tr);
}
else {
  $('#tdata .emptyTr').first().replaceWith(tr);
}

$('#save_bill').attr('disabled',false);
// $('#searchItemDetailForm').trigger("reset");
$('#searchItem').val('').focus();
$('#qty1').val('');
$("#gst_val").val('');
$("#price1").val('');
calculation();
<?php if ($shopConfiguration['other_shop_product']=='no') {?>
  $('#itemno').val('');
<?php }else{ ?>
  $('#itemno').val('other');
<?php } ?>
}

}


function priceupdate(idval,ele){
  var gst_type=$('#gst_type').val();
  var totaltemp=0;
  var get_id=idval;
  var qtytemp1=$(ele).val();
  var qtytemp=$(ele).val();
  var pricetemp=$("#priceid"+get_id).val();
  var gstper=$("#gstpid"+idval).val();

  totaltemp=totaltemp+Number(pricetemp)*Number(qtytemp);

  
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

var grnd = Number(prototal)+Number(gstamount);

// alert(gstper);

$("#totalid"+get_id).html(grnd);

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

// alert();

  var gst_type=$('#gst_type').val();
  var weight=1;
  if ($("#temp_weight"+idval).text()!=0){
    weight=$("#temp_weight"+idval).text();
  }

  var gstpercentage=$(ele).val()/100;

  // alert(gstpercentage);


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




$("#saveCustomerBtn").on('click',function(){
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

  var name=$("#custnameid").val();
  var address=$("#address").val();
  var state=$("#state").val();
  var email=$("#email").val();
  var company_name=$("#companyname").val();
  var city=$("#city").val();
  var country=$("#country option:selected").val();
  var mobile=$("#mobile").val();
  var id = $("#cid").val();

  $.ajax({
    type:"POST",
    url:"ajaxCalls/add_customer.php",
    data:{'name':name,'address':address,'state':state,'email':email,'company_name':company_name,'city':city,'country':country,'mobile':mobile,'id':id},
    dataType:'json',
    success: function(res){
// alert(res.id);

if(res.status=='success'){

  $("#cid").val(res.id);
  $("#ccustomername").html(res.name);
  $("#ccompanyname").html(res.company_name);
  $("#email").html(res.email);
  $("#ccphone").html(res.mobile);
  $("#ccaddress").html(res.address);
  $("#ccity").html(res.city);
  $("#cstate").html(res.state);
  $("#ccountry").html(res.country);
  $("#customer_icon_hide").css('display','');


}

}
});
});
</script>
<script type="text/javascript">
  $('.save_bill').on('click', function(e){

    if ($("#bill_number").val()=='') {
      $.growl.error({title:"Error", message:"Please Enter Bill Number"
    });
      $("#bill_number").focus();
      $("#bill_number").css('border','1px solid red');
      return false;
    }else{
      $("#bill_number").css('border','1px solid grey');
    }

    if($("#tdata").length>0){

      var cid=$("#cid").val();


    // console.log(gst_calc_type);
    customerarray["bill_date"]=$("#billDate").val();
    customerarray["cid"]=cid;

    if(customerarray["cid"]=='')
    {
      $.growl.error({
       title:"SUCCESS",
       message:"Select Customer"
     });
      return false;
    }
    
    var cobj=$.extend({},customerarray);
    var obj = $.extend({}, items);

    // console.log(items);

    if($.isEmptyObject(items)==true)
    {

      $.growl.warning({title:"Error",message:"Enter the Item Details"});

      return false;

    }

    var salesperson = $("#salesperson").val();


    $('#save_bill').attr('disabled','disabled');
    

      // ajaxRequest();
      $.ajax({
        type: "POST",
        url:"ajaxCalls/add_order.php",
        dataType:'JSON',
        data: $.param(obj)+'&'+$.param(cobj)+'&salesperson='+salesperson,
        success: function(dataResult) {

          var order_id = (dataResult.order_id);
          // window.open('sales_order_bill.php?order_id='+order_id);
          // location.reload();

          $.growl.notice({
           title:"SUCCESS",
           message:"Sales Order Created Successfully"
         });

          setTimeout(function(){
            window.location='viewsalesorderdetails.php?id='+dataResult.order_id;
          }, 1000);


          localStorage.clear('myArray');

        }
      });
    }
    else{
      $.growl.warning({title:"Error",message:"Enter the Item Details"});
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

  // alert(temp_subtotal);

  subtotal1=Number(subtotal1)+Number(temp_subtotal);

  // alert(tempItem["gst"]);

  tax=Number(tax)+Number(temp_subtotal)*(Number(tempItem["gst"])/100);
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

// alert(tax);

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

</script>
<!-- <script type="text/javascript">
  var selector = '.cust_form';
  $('body').on('keydown', selector, function(e) {
    if (e.key === "Enter") {
      var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
      focusable = form.find(selector).filter(':visible');
      next = focusable.eq(focusable.index(this)+1);
      if ($(e.target).closest('#saveCustomerBtn').length > 0) {
       $("#saveCustomerBtn").click();
     }
     if (next.length) {
      next.focus();
    }else{
      $("#saveCustomerBtn").click();

    }
    return false;
  }
}); 
</script> -->

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
<script type="text/javascript">
  var selector = '.product_add';
  $('body').on('keydown', selector, function(e) {
    if (e.key === "Enter") {
      var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
      focusable = form.find(selector).filter(':visible');
      next = focusable.eq(focusable.index(this)+1);
      if ($(e.target).closest('#add').length > 0) {
       $("#add").click();
     }
     if (next.length) {
      next.focus();
    }else{
      $("#add").click();

    }
    return false;
  }
}); 
</script>

