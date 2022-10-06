<?php
include '../includes/config.php';
include 'header.php';

$id=$_GET['id'];

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
           <h5 class="m-b-10">Payables</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item">Outstandings</li>
           <li class="breadcrumb-item">Payables</li>
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
        
                  <div class="form-group col-lg-4 col-md-4 col-sm-4">
                    <div class="input-group input-group-sm mx-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text ">From</span>
                      </div>
                      <input type="date" class="form-control" name="date" id="wfdate" value='<?=date('Y-m-d')?>'>
                    </div>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4">

                    <div class="input-group input-group-sm mx-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text ">To</span>
                      </div>
                      <input type="date" class="form-control" name="date" id="wtdate" value='<?=date('Y-m-d',strtotime($todate))?>' >
                    </div>
                  </div>

      </div>

      <div class="col-md-2">
      

      </div>
    </div>

    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th>S.No</th>
            <th style="width:30%;">Vendor</th>
            <th>Balance</th>
            <th>Last Payment Date</th>
            <th>View</th>
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

<?php

include 'footer.php';

?>

  <script>
    $(document).ready(function(){

     $.ajax({
      type:"POST",
      url:'ajaxCalls/getvendorpayable.php',
      dataType:"json",
      success: function(res){

        $('#mytable').html(res.out);
        $("table").trigger('update');


      }
    });


     $("#mySearch").keyup(function() {
    var value = $(this).val().toLowerCase();
    $("#mytable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


   });
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