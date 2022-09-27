<?php
include '../../includes/config.php';
// error_reporting(E_ALL);
$obj = new Purchaseorder();
$vendor_obj=new Vendor();
$Itemobj = new Product();

$output_array=array();
$output='';

$ordresult = $obj->get_order($_POST['bill_id']);
$result = $obj->get_orderdetails($_POST['bill_id']);

$vendor_result=$vendor_obj->get_vendors($ordresult['vendor']);

// print_r($vendor_result);

// echo $ordresult['vendor'];

$sno=0;
$items=array();
$stot=0;
$taxamt=0;
$gtot=0;
foreach ($result as $key => $value) {

  $itemresult = $Itemobj->getitem($value['product']);

        $calc="qty_calc";

$sno++;
    $output_array['item_id']=$value['product'];
    $output_array['final_itemname']=$itemresult['name'];
    $output_array['final_qty']=$value['qty'];
    $output_array['final_total']=$value['total'];
    $output_array['final_gst']=$value['tax'];
    $output_array['gstamount']=$value['tax_amount'];
    $output_array['final_gstpercentage']=$value['tax'];
    $output_array['final_price']=$value['rate'];
   
    $new_array[$sno]=$output_array;


$output .=  "<tr id='trItem_".$sno."'><input type='hidden' id='calcmethod".$sno."' value='".$calc."'>
<td>".$sno."</td>";
$output.="<td>".$itemresult['name']."</td>";

$output .="<td><input onkeyup=costupdate(".$sno.",this) type='text' class='form-control price enterKeyclass' name='price[]' id='priceid".$sno."' data-id='".$sno."' value='".$value['rate']."' style='width:5rem; height:1.75rem' return false'></td>";

  $output.="<td><input onkeyup=priceupdate1(".$sno.",this) type='text' class='form-control qty' name='qty[]' id='num_qty".$sno."' value='".$value['qty']."' style='width:5rem; height:1.75rem' onkeypress='if(this.value.length==8) return false'></td>";


$output.="<td><input onkeyup=gstupdate(".$sno.",this) type='text' value='".$value['tax']."' class='form-control gst'
name='gst[]' id='gstpid".$sno."' style='width:5rem; height:1.75rem'
onkeypress='if(this.value.length==6) return false'></td>";


$output.="<td class='text-right' id='totalid".$sno."'>".$value['total']."</td><td><button type='button' class='btn btn-default btn-sm' onclick='removeItem(".$sno.")'><span class='glyphicon glyphicon-trash'>
<i class='fas fa-trash'></i>
</span></button></td>";


$output.="</tr>";

$stl = $value['qty']*$value['rate'];
$tx = $stl*$value['tax']/100;

$gt = $stl+$tx;

$stot=$stot+$stl;
$taxamt=$taxamt+$tx;
$gtot=$gtot+$gt;

}


$out=['out'=>$output,'item'=>$new_array,'sno'=>$sno,'gtotal'=>number_format($gtot,2,'.',''),'subtotal'=>number_format($stot,2,'.',''),'totaltax'=>number_format($taxamt,2,'.',''),'vid'=>$vendor_result[0]['id'],'cvendorname'=>$vendor_result[0]['name'],'ccompanyname'=>$vendor_result[0]['company_name'],'ccaddress_line_1'=>$vendor_result[0]['address'],'city'=>$vendor_result[0]['city'],'cstate'=>$vendor_result[0]['state'],'ccphone'=>$vendor_result[0]['mobile'],'cemailid'=>$vendor_result[0]['email'],'orderdate'=>date('d-m-Y',strtotime($ordresult['date']))];

echo json_encode($out);


?>