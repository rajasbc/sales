<?php
include '../includes/config.php';
include 'header.php';

?>

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
           <h5 class="m-b-10">Sales</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item">Sales</li>
           <li class="breadcrumb-item">Sales Invoice</li>
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
     <div class="card-header">

      <div class="row">
      <div class="col-md-10">
        
        <table>
                        <thead>
                            <tr>
                <th class="ts-pager">
                  <div class="form-inline">
                    <div class="btn-group" style="margin: 5px;" role="group">
                      <button type="button" class="btn first" title="first"><i class="fa fa-backward" aria-hidden="true"></i></button>
                      <button type="button" class="btn prev" title="previous"><i class="fa fa-caret-left fa-lg" aria-hidden="true"></i></button>
                    </div>
                    <span class="pagedisplay"></span>
                    <div class="btn-group"  style="margin: 5px;" role="group">
                      <button type="button" class="btn  next" title="next"><i class="fa fa-caret-right fa-lg" aria-hidden="true"></i></button>
                      <button type="button" class="btn  last" title="last"><i class="fa fa-forward" aria-hidden="true"></i></button>
                    </div>
                    <select class="form-control custom-select pagesize"  style="margin: 5px;" title="Select page size">
                      <option selected="selected" value="10">10</option>
                      <option value="20">20</option>
                      <option value="30">30</option>
                      <option value="all">All Rows</option>
                    </select>
                    <select class="form-control custom-select px-4 pagenum"  style="margin: 5px;" title="Select page number"></select>

                    <input type="text" class="form-control" placeholder="Search...." id="mySearch" style="width: 270px; margin: 5px;" />

                  </div>
                </th>
              </tr>
                        </thead>
                    </table>

      </div>

      <div class="col-md-2">
      <!-- <a class="btn btn-sm btn-primary" href="purchaseorder.php" style="margin-top: 10px; float: right;">+New</a> -->
      </div>
    </div>

    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th style="width:10%;">Bill#</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Balance</th>
            <th>Pay</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="mytable">

        </tbody>
      </table>
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

<div id="bill_settlement" class="modal fade" tabindex="3" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<?php

include 'footer.php';

?>

  <script>
    $(document).ready(function(){

     $.ajax({
      type:"POST",
      url:'ajaxCalls/getsales.php',
      dataType:"json",
      success: function(res){

        $('#mytable').html(res.out);
        $("table").trigger('update');


      }
    });


     $('#mytable').on('click',".btn-action",function(){
      var url=$(this).data("url");
      var title=$(this).data("title");
            // var shop_id=$('#shop_id').val();
      $.ajax({
        type:"GET",
        url:url,
        success: function(res){
          $("#bill_settlement .modal-body").html(res);
          $("#bill_settlement").modal('show');
        }
      });

    });


     $("#mySearch").keyup(function() {
    var value = $(this).val().toLowerCase();
    $("#mytable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


   });
 </script>

 <script type="text/javascript">
   
   function postValue(){
        
                    if($("#balance_received").val()==''){
                        $("#balance_received").css("border","1px solid red");
                        $("#balance_received").focus();
                        return false;
                    }
            $("#add_balance").attr("disabled","disabled");
            var bill_id=$("#bill_id").val();
            var balance=$("#balance").val();
            var balance_received=$("#balance_received").val();

            var max_total=$("#max_total").val();
            
            var totalBalance=balance-balance_received;
            
            
            var cust_id=$('#cust_id').val();
            $.ajax({
                type:"POST",
                url:"ajaxCalls/addBalance.php",
                dataType:"json",
                data:({"shop_id":shop_id,"bill_id":bill_id,"invoice_no_for_log":invoice_no,"balance":balance,"balance_received":balance_received,"add_discount":add_discount,"discount":'<?=$row['final_discount']?>',"advance":'<?=$row['advance']?>',"max_total":max_total,"payment_mode":payment_mode,'chequenumber':chequenumber,'change_val':change_val,'paypage':'bill_list','is_credit_checked':is_credit_checked,"cust_id":cust_id,"is_credit_amount_checked":is_credit_amount_checked,"remain_balance_check":remain_balance_check}),
                success:function(res)
                {
                    // console.log(res);
                    $.growl.notice({
                        title:"SUCCESS",
                        message:"The Balance Bill Amount Received"
                    });
                     //$(".check").attr('checked',true);
                    $("#bill_settlement .close").click();
                    window.reload="bill_list.php";
                   $("#balance_amount"+res.id).html(res.balance);
                   $("#discount"+res.id).html(res.discount);
                   $("#paid_amount"+res.id).html(res.paid);

                    //$("#balance_amount").apped(res.balance);
                    if(res.balance==0){
                        // console.log(res.balance);
                        $("#balance_amount"+res.id).html(res.balance);
                        $("#test_edit"+res.id).hide();
                         //$("#paid"+res.id).removeClass('d-none');
                         $("#"+res.id).prop('checked',true);
                          //$().click();
                          $("#paid_status"+res.id).html("<button class='btn btn-success btn-block paid btn-sm' data-id='"+res.id+"' data-url='paidDetails.php?t="+res.id+"&shop_id="+res.shop_id+"' value='"+res.id+"' name='test_edit' id='test_edit"+res.id+"' data-toggle='modal'>Paid</button>")
                         // echo"";
                         setTimeout(function(){ $('table').trigger("update"); }, 500);
                    }

                }
                });
}

 </script>

 <script id="js">
  $(function() {
$.fn.columnCount = function() {
    return $('th', $(this).find('thead')).length;
        };
       var count=$('table').columnCount();
//alert(count);

    $("table").tablesorter({
       theme : "bootstrap",

        widthFixed: true,

        // widget code contained in the jquery.tablesorter.widgets.js file
        // use the zebra stripe widget if you plan on hiding any rows (filter widget)
        // the uitheme widget is NOT REQUIRED!
        //widgets : [ "filter"],
        headers: {
        4: { sorter: false, filter: false },
        7: { sorter: false, filter: false },
        //5: { sorter: false, filter: false },
        //8: { sorter: false, filter: false },
        //9: { sorter: false, filter: false },
        10: { sorter: false, filter: false }
        },
        widgetOptions : {
            // using the default zebra striping class name, so it actually isn't included in the theme variable above
            // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
            zebra : ["even", "odd"],

            // class names added to columns when sorted
            // columns: [ "primary", "secondary", "tertiary" ],

            // reset filters button
            filter_reset : ".reset",

            // extra css class name (string or array) added to the filter element (input or select)
            filter_cssFilter: [
                'form-control',
                'form-control',
                'form-control', // select needs custom class names :(
                'form-control',
                'form-control',
                'form-control',
        'form-control',
                'form-control',
                'form-control'
            ]

        }


    })
    .tablesorterPager({

        // target the pager markup - see the HTML block below
        container: $(".ts-pager"),

        // target the pager page select dropdown - choose a page
        cssGoto  : ".pagenum",

        // remove rows from the table to speed up the sort of large tables.
        // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
        removeRows: false,

        // output string - default is '{page}/{totalPages}';
        // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
        output: '{startRow} to {endRow} of {filteredRows} ({totalRows})'

    });
    

});



</script>