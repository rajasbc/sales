<?php
include '../includes/config.php';
include 'header.php';

$id=$_GET['id'];

// error_reporting(E_ALL);

$obj = new Salesorder();
$ordresult = $obj->get_order($id);
$result = $obj->get_orderdetails($id);

$cobj = new Customer();
$cresult = $cobj->get_customers($ordresult['customer']);

$pobj = new Product();

$aobj = new Admin();
$aresult = $aobj->getusername($ordresult['createdby']);


?>

<style type="text/css">
  
.first-col
{
  font-weight: bold;
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
           <h5 class="m-b-10">Incoming PO Details</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item"><a href="sales_order.php">Incoming PO List</a></li>
           <li class="breadcrumb-item">Order Details</li>
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
        
      <h4>Order# <span style="color:#fd6a01;"><?=$ordresult['invoice_no']?></span></h4>

      </div>

      <div class="col-md-2">
      
      </div>
    </div>

    </div>
    <div class="card-body table-border-style">


      <div class="row">
        
        <div class="col-md-6">
          
          <table style="line-height: 25px;">
            
            <tr><td class="first-col">Customer Name</td><td style="padding:0 7px;">:</td><td><?=$cresult[0]['name']?></td></tr>
            <tr><td class="first-col" valign="top">Address</td><td valign="top" style="padding:0 7px;">:</td><td><?=$cresult[0]['address']?>
              
            <?php

            echo $cresult[0]['city']?'<br>'.$cresult[0]['city']:'';

            echo $cresult[0]['state']?'<br>'.$cresult[0]['state']:'';

            ?>


            </td></tr>
            <tr><td class="first-col">Email</td><td style="padding:0 7px;">:</td><td><?=$cresult[0]['email']?></td></tr>
            <tr><td class="first-col">Mobile</td><td style="padding:0 7px;">:</td><td><?=$cresult[0]['mobile']?></td></tr>

          </table>

        </div>

        <div class="col-md-6">

          <table>
            <tr><td class="first-col">Sales Person</td><td style="padding:0 7px;">:</td><td><?=$aresult['name']?></td></tr>
          </table>
          
        </div>


      </div>

      <div class="row mt-3">

      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th>S.No.</th>
            <th>Product</th>
            <th>Price($)</th>
            <th>Qty</th>
            <th>VAT(%)</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>

          <?php

          $sno=0;
          $tqty = 0;
          $tprice=0;
          $total_amount=0;
          $tvat=0;
          $total_tax=0;
          $overalltotal=0;
          $total_subtotal=0;
          $tax=0;
          foreach($result as $row)
          {

            $sno=$sno+1;

            $presult = $pobj->getitem($row['product']);

            $total_value= $row['qty']*$row['rate'];

            echo"<tr><td>".$sno."</td><td>".$presult['name']."</td><td>".$row['rate']."</td><td>".$row['qty']."</td><td>".$row['tax']."</td><td style='text-align:right;'>".$row['total']."</td></tr>";

            $tqty=$tqty+$row['qty'];
            // $tprice=$tprice+$presult['price'];
            $tvat=$tvat+$row['tax'];
            $total_amount=$total_amount+$row['total'];


          }

          ?>

        </tbody>

        <tfoot>

                     <tr>

                        <td colspan="5" style="text-align:right;">
                   
                          <span class="text-right">Total Amount ($)</span>

                        </td>
                       
                       <td style="text-align:right;">
                    
                    <span class="text" id="grandid"> <?=number_format($total_amount,2,'.','')?></span>

                  </td>
                </tr>

        </tfoot>

      </table>
    </div>

    </div>

    <div class="row mt-2" style="float:right;"><a href="viewsalesorder.php" class="btn btn-sm btn-primary" style="float:right;">Back</a></div>

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