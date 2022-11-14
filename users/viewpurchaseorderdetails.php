<?php
include '../includes/config.php';
include 'header.php';

$id=$_GET['id'];

// error_reporting(E_ALL);

$obj = new Purchaseorder();
$ordresult = $obj->get_order($id);
$result = $obj->get_orderdetails($id);
$doc_result = $obj->get_docdetails($id);

$cobj = new Vendor();
$cresult = $cobj->get_vendors($ordresult['vendor']);

$pobj = new Product();



$sobj = new Salesorder();
$sordresult = $sobj->get_order($ordresult['sales_orderid']);

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
            <tr><td class="first-col">Sales Order Ref No.</td><td style="padding:0 7px;">:</td><td><?=$sordresult['invoice_no']?></td></tr>
          </table>
          
        </div>


      </div>

      <div class="row mt-3">


<?php if (count($doc_result)>0) {?>
<div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th>S.No.</th>
            <th>Document Name</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php

          $i=0;
          foreach($doc_result as $value)
          {

            $i=$i+1;

            echo'<tr id="doc_data'.$value['id'].'"><td>'.$i.'</td><td>'.$value['document_name'].'</td>
            <td>'.$value['description'].'</td>
            <td><button type="button" class="btn btn-default btn-sm" data-id="../upload/purchaseorder_documents/'.$value['document_name'].'" onclick="viewItem(this)"><span class="glyphicon glyphicon-trash"><i class="fas fa-eye" style="color:darkblue;"></i></span></button></td></tr>';

            //<button type="button" class="btn btn-default btn-sm" onclick="removeItem('.$value['id'].')"><span class="glyphicon glyphicon-trash"><i class="fas fa-trash" style="    color: crimson;"></i></span></button>

          }

          ?>

        </tbody>

      </table>
    </div>
  <?php }?>

      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th>S.No.</th>
            <th style="width:21%;">Product</th>
            <th>Qty</th>
            <th>Rate ($)</th>
            <th>VAT (%)</th>
            <th style="width:15%;">Total ($)</th>
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
            <td class='text-center'>".$row['tax']." %</td>
            <td class='text-right pr-5'>".$row['total']."</td></tr>";

            $total=$total+$row['total'];
            $total_product_value=$row['rate']*$row['qty'];
            $total_subtotal=$total_subtotal+$total_product_value;

            $overalltotal=$overalltotal+$row['total'];
            $tax=$tax+$row['tax_amount'];

          }

          ?>

        </tbody>

        <tfoot>
          
                    <tr style="font-weight:bold;">

                      <td colspan="2"></td>
                      <td colspan="2">

                              <span class="">Total Amount  Before Tax ($)</span> &nbsp; 
                              <span class="" id="subid"><?=number_format($total_subtotal,2,'.','')?></span>
                              
                      </td>

                      <td>
                           
                              <span>VAT ($)</span> &nbsp; 
                              <span class="" id="taxid"><?=number_format($tax,2,'.','')?></span>

                      </td>

                        <td class="text-right pr-5">
                   
                        <span class="text-right">Total Amount ($)</span> &nbsp; 
                    
                        <span class="text" id="grandid"> <?=number_format($overalltotal,2,'.','')?></span>

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

<div id="confDelete" class="modal fade" tabindex="3" data-backdrop="static" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-8"> <h5 class="modal-title" id="exampleModalLabel">Are You Sure Delete This Item...</h5></div>
                        <div class="col-lg-4 text-right">
                            <!-- <button type="button" class="btn btnupdate" id='top' onclick='selectTest()'>Submit</button> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>

                </div>
              </div>
                                       
                                      
                                        <div class="modal-footer">
                                          <input type="hidden" name="delete_id" id="delete_id">
                                          <button type="button" class="btn btn-primary" id='delete_file' >Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

<?php

include 'footer.php';

?>
<script type="text/javascript">
  function removeItem(a) {
    $("#delete_id").val(a);
    $("#confDelete").modal('show');
  }
  function viewItem(e) {
    var page=$(e).data('id');
    window.open(page,'_blank');
  }
  $("#delete_file").click(function(){
    $.ajax({
url:"ajaxCalls/delete_documents.php",
type: "POST",
dataType: "json",
data: {'id':$("#delete_id").val(),'type':'purchaseorder'},
// cache: false,
success: function(res)
{
if (res.status=='success') {
  $.growl.notice({
  title:"Success",
  message:"This Document Deleted Successfully"
  });
  $("#confDelete").modal('hide');
  $("#doc_data"+$("#delete_id").val()).remove();
}
}
});
  })
</script>
