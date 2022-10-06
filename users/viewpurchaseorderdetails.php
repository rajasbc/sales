<?php
include '../includes/config.php';
include 'header.php';

$id=$_GET['id'];

// error_reporting(E_ALL);

$obj = new Purchaseorder();
$ordresult = $obj->get_order($id);
$result = $obj->get_orderdetails($id);

$cobj = new Vendor();
$cresult = $cobj->get_vendors($ordresult['vendor']);

$pobj = new Product();

// $aobj = new Admin();
// $aresult = $aobj->getusername($ordresult['createdby']);


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
           <h5 class="m-b-10">Outgoing PO Details</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item"><a href="viewpurchaseorder.php">Outgoing PO</a></li>
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
        
      <h4>Order# <?=$_GET['id']?></h4>

      </div>

      <div class="col-md-2">
      
      </div>
    </div>

    </div>
    <div class="card-body table-border-style">


      <div class="row">
        
        <div class="col-md-6">
          
          <table style="line-height: 25px;">
            
            <tr><td class="first-col">Vendor Name</td><td style="padding:0 7px;">:</td><td><?=$cresult[0]['name']?></td></tr>
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
            <tr><td class="first-col">Sales Order Ref No.</td><td style="padding:0 7px;">:</td><td><?=$ordresult['sales_orderid']?></td></tr>
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
            <th>Qty</th>
            <th>Rate ($)</th>
            <th>VAT (%)</th>
            <th>Total ($)</th>
          </tr>
        </thead>
        <tbody>

          <?php

          $sno=0;
          $tqty = 0;
          $total=0;
          $total_tax=0;
          $overalltotal=0;
          $total_subtotal=0;
          $tax=0;
          foreach($result as $row)
          {

            $sno=$sno+1;

            $presult = $pobj->getitem($row['product']);

            echo"<tr><td>".$sno."</td><td>".$presult['name']."</td>
            <td>".$row['qty']."</td>
            <td>".$row['rate']."</td>
            <td>".$row['tax']." %</td>
            <td >".$row['total']."</td></tr>";

            $tax_value=$row['rate']*$row['tax'];


            $total=$total+$row['total'];
            $total_product_value=$row['rate']*$row['qty'];
// $total_tax_value=$total_tax_value+$value['tax'];
$total_subtotal=$total_subtotal+$total_product_value;

$overalltotal=$overalltotal+$row['total'];
$total_tax=$total_tax+$row['tax'];
$tax=$tax+$tax_value*($row['tax']/100);

          }

          ?>

        </tbody>

        <tfoot>
          
       <!--    <tr style="font-weight: bold;"><td colspan="5" style="text-align: right;">Total ($)</td><td><?=number_format($total,2,'.','')?></td></tr> -->

                           <tr>
            <td colspan="13" class="td-last-1">

              <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-2 col-sm-2 col-md-2">
                  <div class="">
                    <span class="">Total Amount  Before Tax ($)</span>
                    <span class="" id="subid"><?=number_format($total_subtotal,2,'.','')?></span>
                    <input type="hidden" name="subid1" id="subid1">
                  </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-2 col-sm-2 col-md-2">
                  <div class="">

                    <span>VAT ($)</span>
                    <span class="" id="taxid"><?=number_format($tax,2,'.','')?></span>

                  </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                  <div class="">

                    <span class="">Total Amount ($)</span>

                    <span class="text" id="grandid"><?=number_format($overalltotal,2,'.','')?></span>
                    <input type='hidden' class="text" id="grandid1" value="0">
                  </div>
                </div>
              </div>
  

            </td>
          </tr>

        </tfoot>

      </table>
    </div>

    </div>

    <div class="row mt-2" style="float:right;"><a href="viewpurchaseorder.php" class="btn btn-sm btn-primary" style="float:right;">Back</a></div>

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