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

         <div class="col-md-6">
          <div class="page-header-title">
           <h5 class="m-b-10">Incoming PO</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <!-- <li class="breadcrumb-item">Incoming Po</li> -->
           <li class="breadcrumb-item">Incoming Po List</li>
         </ul>
       </div>

       <div class="col-md-6">

        <a class="btn btn-sm btn-info" href="sales_order.php" style="margin-top: 10px; float: right;">+New</a>

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
                    <select class="form-control custom-select pagesize" style="padding: 0px 15px; height: 31px; margin: 5px; width: 100px;" title="Select page size">
                      <option selected="selected" value="10">10</option>
                      <option value="20">20</option>
                      <option value="30">30</option>
                    </select>
                    <select class="form-control custom-select px-4 pagenum"  style="padding: 0px 15px; height: 31px; margin: 5px; display:none;" title="Select page number"></select>

                    <input type="text" class="form-control" placeholder="Search...." id="mySearch" style="width: 170px; margin: 5px;" onkeyup="get_data(this)" autocomplete="off" />

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

      <!-- <div class="col-md-2">
      <a class="btn btn-sm btn-info" href="sales_order.php" style="margin-top: 10px; float: right;">+New</a>
      </div> -->

    </div>

    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th style="width:10%;">Order#</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Sales Person</th>
            <th>Total ($)</th>
            <th>Status</th>
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
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="customerModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="cform" onsubmit="javascript:return false;">
      <input type="hidden" name="cust_address_id" id="cust_address_id" value="0">
      <input type="hidden" name="address_info" id="address_info" value="primary">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="customerModalTitle"><strong>Confirmation Alert</strong></h5>
          <button class="close" type="button" data-dismiss="modal" id="customerCloseBtn" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
         <h6>Are You Sure Cancel This Order...</h6>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="delete_order_id" id="delete_order_id">
              <button class="btn btn-sm btn-secondary cust_form" type="button" id="delete_order" >Yes</button>
              <button class="btn btn-sm btn-danger" id="modelclose" type="button" data-dismiss="modal">No</button>
            </div>
          </div>
          </div>
    </div>
<?php

include 'footer.php';

?>

  <script>
    $(document).ready(function(){

    get_data();


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
  function open_alert(e){
    $("#alertModal").modal('show');
    $("#delete_order_id").val(e);
  }
  $("#delete_order").click(function(){
   $.ajax({
      type:"POST",
      url:'ajaxCalls/cancel_orders.php',
      data:{'id':$("#delete_order_id").val(),'type':'sales'},
      dataType:"json",
      success: function(res){

        if (res.status=='success') {
          get_data();
          $("#alertModal").modal('hide');
        }


      }
    });
  });

  
    // $.ajax({
    //   type:"POST",
    //   url:'ajaxCalls/getsalesorders.php',
    //   dataType:"json",
    //   success: function(res){

    //     $('#mytable').html(res.out);
    //     $("table").trigger('update');


    //   }
    // });
  
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

        ajaxUrl: "ajaxCalls/getsalesorders.php?page={page}&size={size}&search="+search+"&fdate="+ fdate +"&tdate="+ tdate,
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
