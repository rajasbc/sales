<?php
include '../includes/config.php';
include 'header.php';

?>

<style type="text/css">
  
.form-control
{
  height: 31px;
}

select.custom-select {
    -webkit-appearance: menulist;
  }

</style>

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
           <h5 class="m-b-10">Incoming Invoice</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <!-- <li class="breadcrumb-item">Outgoing</li> -->
           <li class="breadcrumb-item">Incoming Invoice</li>
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
      <div class="col-md-12">
        
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
                    <select class="form-control custom-select pagesize" style="padding: 0px 15px; height: 31px; margin: 5px; width:100px;" title="Select page size">
                      <option selected="selected" value="10">10</option>
                      <option value="20">20</option>
                      <option value="30">30</option>
                      <!-- <option value="all">All Rows</option> -->
                    </select>
                    <select class="form-control custom-select px-4 pagenum" style="padding: 0px 15px; height: 31px; margin: 5px; display:none;" title="Select page number"></select>

                    <input type="text" class="form-control" placeholder="Search...." id="mySearch" style="width: 170px; margin: 5px;" autocomplete="off" />

                        <div class="input-group input-group-sm ml-3">
                              <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">From Date</span>
                            </div>
                          <input type="date" style="padding:0px 3px;" class="form-control" id="fromdate" value="<?=date('Y-m-d')?>">
                          </div> &nbsp; &nbsp; 

                          <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">To Date</span>
                                              </div>
                                  <input type="date" style="padding:0px 3px;" class="form-control" id="todate" value="<?=date('Y-m-d')?>">
                          </div> &nbsp; 

                          <button class="btn btn-sm btn-primary" style="padding:3px 7px;" id="go"> Go </button>

                  </div>
                </th>
              </tr>
                        </thead>
                    </table>

      </div>

      <!--<div class="col-md-2">
       <a class="btn btn-sm btn-primary" href="purchaseorder.php" style="margin-top: 10px; float: right;">+New</a>
      </div> -->
    </div>

    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th style="width:10%;">Bill#</th>
            <th>Date</th>
            <th>Vendor</th>
            <th>Total ($)</th>
            <th>Order #</th>
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

      get_data();

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
    // var value = $(this).val().toLowerCase();
    // $("#mytable tr").filter(function() {
    //   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    // });
    get_data();
  });

     $("#go").click(function(){
   
      get_data();

     });

   });
 </script>

 <script type="text/javascript">
   

   function postValue(){

    // alert("df");
        
                    if($("#balance_received").val()==''){
                        $("#balance_received").css("border","1px solid red");
                        $("#balance_received").focus();
                        return false;
                    }
            $("#add_balance").attr("disabled","disabled");
            var bill_id=$("#bill_id").val();
            var invoice_no=$("#invoice_no").val();
            var balance=$("#balance").val();
            var balance_received=$("#balance_received").val();

            var max_total=$("#max_total").val();
            
            var totalBalance=balance-balance_received;
            
            
            var v_id=$('#vend_id').val();
            $.ajax({
                type:"POST",
                url:"ajaxCalls/addpayment.php",
                dataType:"json",
                data:({"bill_id":bill_id,"v_id":v_id,"pay":balance_received,"invoice_no":invoice_no}),
                success:function(res)
                {
                    // console.log(res);
                    $.growl.notice({
                        title:"SUCCESS",
                        message:"The Bill Amount Received"
                    });
                     
                     $("#bill_settlement").modal('hide');
                     get_data();

                }
                });
}


   // function getpurchase() {
     
   //    $.ajax({
   //    type:"POST",
   //    url:'ajaxCalls/getpurchase.php',
   //    dataType:"json",
   //    success: function(res){

   //      $('#mytable').html(res.out);
   //      $("table").trigger('update');


   //    }
   //    });

   // }


 </script>

 <script id="js">

function get_data(){

  var fdate = $("#fromdate").val();
  var tdate = $("#todate").val();
  var search = $("#mySearch").val();

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

        container: $(".ts-pager"),

        cssGoto  : ".pagenum",

        removeRows: false,

        ajaxUrl: "ajaxCalls/getpurchase.php?page={page}&size={size}&search="+search+"&fdate="+ fdate +"&tdate="+ tdate,
      customAjaxUrl: function(table, url) {

            $(table).trigger('changingUrl');

            return url += '&currentUrl=' + window.location.href;
          },
          ajaxProcessing: function(data){

              var total = data.count;

              $("#count_item").text(data.count).css('color','blue');
              $('#mytable').html(data.out);
              $("table").trigger('update');
              return [total];

          },

        output: '{startRow} to {endRow} of {filteredRows} ({totalRows})'

    });
    

});


}



</script>