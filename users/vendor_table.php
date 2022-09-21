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
           <h5 class="m-b-10">Basic Tables</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item"><a href="#!">Tables</a></li>
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
      <h5>Vendor Table</h5><h5 class="float-right"><a class="btn btn-sm btn-primary" href="Vendor.php" >ADD NEW</a></h5>
      
    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>City</th>
            <th>Action</th>
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
    get_allcust_list();

  });
</script>
<!-- <script>
   function get_allcust_list() {

    // alert('dfghj');
      $("table").tablesorter({
        theme : "bootstrap",

        widthFixed: true,

    widgets : [ "filter", "columns", "zebra" ],
    headers:{
      0:{sorter:false,filter:false},
      7:{sorter:false,filter:false},

    },

    widgetOptions : {
      
      zebra : ["even", "odd"],

    
      columns: [ "primary", "secondary", "tertiary" ],

      filter_reset : ".reset",

      filter_cssFilter: [
      'form-control',
      'form-control',
        'form-control ',
        'form-control',
        'form-control',
        'form-control',
        'form-control',
        'form-control',
        'form-control','form-control'
        ]

      }
    })
      .tablesorterPager({

   
    container: $(".ts-pager"),

    
    cssGoto  : ".pagenum",

  
    removeRows: false,

    ajaxUrl: "ajaxCalls/get_customer_list_ajax.php?filter={filterList:filter}&page={page}&size={size}&term=all",
      customAjaxUrl: function(table, url) {
            // trigger my custom event
            $(table).trigger('changingUrl');
            // send the server the current page
            return url += '&currentUrl=' + window.location.href;
          },
          ajaxProcessing: function(data){
            // console.log(data);
            // if (data && data.hasOwnProperty("rows")) {
              var total = data.count;
              $("#count_item").text(data.count).css('color','blue');
              $('#mytable').html(data.out);
              $("table").trigger('update');
              return [total];
            // }
          },
          output: "{startRow} to {endRow} ({totalRows})"

   

  });
    }

    
  </script> -->
  <script>
    function get_allcust_list(){

     $.ajax({
      type:"POST",
      url:'ajaxCalls/get_vendor_list_ajax.php',
      dataType:"json",
      success: function(res){

        $('#mytable').html(res.out);
        $("table").trigger('update');


      }
    });
   }
 </script>
 