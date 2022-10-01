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
           <h5 class="m-b-10">Receivables</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item">Outstandings</li>
           <li class="breadcrumb-item">Receivables</li>
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
        
                  <div class="form-row col-lg-12 col-md-12 col-sm-12 mt-3">


                  <div class="form-group col-lg-4 col-md-4 col-sm-4">
                    <div class="input-group input-group-sm mx-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text ">From</span>
                      </div>
                      <input type="date" class="form-control" name="date" id="fdate" value='<?=date('Y-m-d')?>'>
                    </div>
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-4">
                    <div class="input-group input-group-sm mx-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text ">To</span>
                      </div>
                      <input type="date" class="form-control" name="date" id="tdate" value='<?=date('Y-m-d')?>' >
                    </div>
                  </div>

                  <div class="col-lg-2 col-md-2 col-sm-2">
                      <button class="btn btn-sm btn-danger" id="search" name="Search" type="submit">Search</button>
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
            <th>Date</th>
            <th>Description</th>
            <th style="width:15%;">Credit</th>
            <th style="width:15%;">Debit</th>
            <th style="width:15%;">Balance</th>
          </tr>
        </thead>
        <tbody id="mytable">

        </tbody>
      </table>
    </div>
    <a href="receivables.php"><button class="btn btn-sm btn-info">Back</button></a>
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

      
      var from = $("#fdate").val();
      var to = $("#tdate").val();

      getcustomerreceivable(from,to);
     

    });


    $("#search").click(function(){

      var from = $("#fdate").val();
      var to = $("#tdate").val();

      getcustomerreceivable(from,to);

    });


    function getcustomerreceivable(a,b)
    {

      var customer = '<?= $id ?>';
      var from = a;
      var to = b;

      $.ajax({
      type:"POST",
      url:'ajaxCalls/getcustomerreceivable.php',
      dataType:"json",
      data:{'customer':customer, 'fromdate': a, 'todate': b},
      success: function(res){

        $('#mytable').html(res.out);
        $("table").trigger('update');

      }
      });


    }


  </script>