<?php
include '../includes/config.php';

$obj = new Salesorder();
$obj1 = new Customer();
$obj2= new Product();

$bill_id = $_GET['order_id'] ;
$billget = $obj->get_order($bill_id);
$itemDetails=$obj->get_orderdetails($bill_id);
$start_index=0;
?>
<?php
// error_reporting(E_ALL);
$c_id = $billget['customer'];
$custom = $obj1->get_customers($c_id);

if (count($custom) > 0)
{
  $cid = $custom[0]['id'];

  $customerName = $custom[0]['name'];
  $customerCompanyname = $custom[0]['company_name'];
  $customerAddress=$custom[0]['address'];
  $customerCity= $custom[0]['city'];
  $customerState = $custom[0]['state'];
  $customerPhone = $custom[0]['mobile'];
  $customerEmail = $custom[0]['email'];
  $customerCountry= $custom[0]['country'];
}

$output = array();
if (count($itemDetails) > 0) {
  foreach ($itemDetails as $row) {
  // print_r($row);die();
    $itemDetails=$obj2->getitem($row['product']);
    $temp_array = array();
    $temp_array['id'] = $row['id'];
    $temp_array['name'] = $itemDetails['name'];
    $temp_array['qty'] = $row['qty'];
    $output[] = $temp_array;
  }
} else {
  $output['value'] = '';
  $output['label'] = 'No Record Found';
}
?>
<style type="text/css">

/* below CSS to print as A4 size */
.gst_fsize{
  font-size:10px !important;
  padding:0px !important;
}
.gst_fsize1{
  font-size:14px !important;
  padding:0px !important;
}
.body {
  margin: 0;
  padding: 0;
  background-color: #FAFAFA;
  box-sizing: border-box;
}
* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}
.page {
  font-size: <?=$fontsize?>px;
  width: 21cm;
  min-height: 29.7cm;
  padding-left: 0.5cm;
  padding-top: 0.5cm;
  margin: 1cm auto;
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
  padding: 1cm;
  border: 5px #D3D3D3 solid;
  height: 256mm;
  outline: 2cm #FFEAEA solid;
}
@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body, div, span, h1, h2, h3, h4, h5, h6, p, ul, li, form, label, legend, table,tbody, tfoot, thead, tr, th, td {
   font-size: <?=$fontsize?>px !important;
 }
/* body {zoom: 70%;}*/
.page {
  margin: 0;
  border: initial;
  border-radius: initial;
  width: initial;
  min-height: initial;
  box-shadow: initial;
  background: initial;
  page-break-after: always;
}
@page {
  size: A4;
  margin: 0;
}
}
/* above CSS to print as A4 size */
.footer {
  height: 0rem;
}

.container-fluid {
  font-size: <?=$fontsize?>px;
  width: 98%;
  margin: 0;
/*height: 1180px;*/
}

.bill-table tr.line_1 {
  height: 20px;
  line-height: 20px;
}

div.declaration_p p{
  margin-bottom: 0px !important;
}

}
</style>


<div >
  <main >
    <div class="page">
      <div class="col-lg-12 " style="margin-left:300px; font-size: 25px;"><b>Sales Order</b></div>
      <div class="container-fluid border " >

        <table style="width:100%; border:1px solid #333;border-bottom: none; ">
          <tr><td>
            <div class="col-sm-6 col-md-6 col-lg-6" style="
            padding-left: 25px;">
            <div class="row" style="font-size:15px"><label><b>Buyer</b></label></div>

            <?php  if (empty($customerCompanyname) === false) {?>
              <div class="row" >&nbsp;&nbsp;<b><?php echo strtoupper($customerCompanyname); ?></b></div>
            <?php }
            if (empty($customerAddress) === false) {?>
              <div class="row" >&nbsp;&nbsp;<?php echo $customerAddress; ?></div>
            <?php }            
            if (empty($customerCity) === false) {?>
              <div class="row" >&nbsp;&nbsp;<?php echo $customerCity." (Dt)-"; ?>, <?php echo $customerState.""; ?></div>
            <?php }
            if (empty($customerPhone) === false) {?>
              <div class="row" >&nbsp;&nbsp;<?php echo $customerPhone; ?> &nbsp; </div>
            <?php }
            if (empty($customerEmail) === false) {?>
              <div class="row" >&nbsp;&nbsp;<?php echo $customerEmail; ?> &nbsp; </div>
            <?php }

            if (empty($customerGst) === false && $required_nogst!='yes') {?>

            <?php }?>
          </div>
        </td></tr></table>

        <table border="1" style="width: 100%; border-collapse: collapse;" class="table  text-center " id="bill-table" >
          <thead  >
            <tr class=" font-weight-bold" style="font-size:17px;" >
             <th style="width: 5px; margin-left:40px;">S.no</th>
             <th style="width: 50px; " >Item Name</th>
             <th style="width: 30px;">Quantity</th>

           </tr>
         </thead>
         <tbody class="text-center" id="tdata">
          <?php

          $totalQuantity = 0;
          $temp=0;
          $sno=0;
          foreach ($output as $row) {

            $name=$row['name'];
            $item_qty=$row['qty'];
            $temp+=1;
            $sno++;
            ?>
            <tr>
             <td style="width: 5px; margin-left:40px; text-align: center; height:31px;" ><?php echo $sno; ?></td>
             <td  style="width: 50px; text-align: center; height:31px;" ><?php echo $name; ?></td>
             <td  style="width: 30px; text-align: center; height:31px;"><?php echo $item_qty; ?></td>

           </tr>
           <?php
           $totalQuantity=$totalQuantity+$item_qty;
         }
         while($sno<24){

          echo'<tr class="border-right  line_1">
          <td style="width: 5px; margin-left:40px; height:30px;" ></td>
          <td  style="width: 50px;"></td>
          <td  style="width: 30px;"></td>
          </tr>';

          $sno++;

        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td>&nbsp;</td>
          <td style="text-align: center;"><b>Total</b></td>
          <td style="text-align: center;"><b><?php echo $totalQuantity; ?></b></td>
        </tr>
      </tfoot>
    </table>

    <table style="width:100%; border:1px solid #333; border-collapse: collapse;border-top: none;">
      <tr><td style="width:60%;">
      </td>
      <td style="width:40%;">
        <b>For </b>
      </td></tr>
      <tr><td style="width:60%;">
      </td>
      <td style="width:40%; padding-top: 75px;">
        Authorised Signature
      </td></tr>
    </table>


  </div>
</div> <!--  page -->
</main>
</div>



<?php
function getIndianCurrency(float $number) {
  $decimal = round($number - ($no = floor($number)), 2) * 100;
  $hundred = null;
  $digits_length = strlen($no);
  $i = 0;
  $str = array();
  $words = array(0 => '', 1 => 'one', 2 => 'two',
    3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
    7 => 'seven', 8 => 'eight', 9 => 'nine',
    10 => 'ten', 11 => 'eleven', 12 => 'twelve',
    13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
    16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
    19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
    40 => 'forty', 50 => 'fifty', 60 => 'sixty',
    70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
  $digits = array('', 'hundred and', 'thousand', 'lakh', 'crore');
  while ($i < $digits_length) {
    $divider = ($i == 2) ? 10 : 100;
    $number = floor($no % $divider);
    $no = floor($no / $divider);
    $i += $divider == 10 ? 1 : 2;
    if ($number) {
      $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
      // $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
      $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
      $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
    } else {
      $str[] = null;
    }
  }
  $Rupees = implode('', array_reverse($str));
  $paise = ($decimal > 0) ? ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' paise' : '';
      // $paise = ($decimal > 0) ? " and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
      // return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
  return 'INR ' . ucwords($Rupees) . ($paise ? ' and ' . ucwords($paise) : '') . ' Only';
}
      // $grandTotalInWords = getIndianCurrency($grand_total);
function getFormatedDate($value, $bill_date) {
  if ($bill_date == '') {
    $date = new DateTime($bill_date);
  } else {
    $date = new DateTime($bill_date);
  }
  return $date->format('d-M-Y');
}
function getNumberFormat2digit($amount) {
  $amount = round($amount);
  return number_format((float) $amount, 2, '.', '');
}
?>

<script type="text/javascript">
  window.print();
</script>
