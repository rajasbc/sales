<?php
include '../../includes/config.php';
// error_reporting(E_ALL);
$obj = new Salesorder();
$customer_obj=new Customer();
$Itemobj = new Product();

$output_array=array();
$output='';

$ordresult = $obj->get_order($_POST['bill_id']);
    $result = $obj->get_orderdetails($_POST['bill_id']);
    $customer_result=$customer_obj->get_customers($ordresult['customer']);

    // print_r($customer_result);

$sno=0;
$total_tax=0;
$total_subtotal=0;
$overalltotal=0;
$total_tax_value=0;
$items=array();
foreach ($result as $key => $value) {

  $itemresult = $Itemobj->getitem($value['product']);

        $calc="qty_calc";

$sno++;
    $output_array['item_id']=$value['product'];
    $output_array['final_itemname']=$itemresult['name'];
    $output_array['final_qty']=$value['qty'];
    $output_array['final_total']=$value['total'];
    $output_array['final_gst']=$value['tax'];
    $output_array['final_gstpercentage']=$value['tax'];
    $output_array['gstamount']=$value['tax_amount'];
    $output_array['final_price']=$itemresult['price'];
   
    $new_array[$sno]=$output_array;

// <td>".$sno."</td>

$output .=  "<tr id='trItem_".$sno."'><input type='hidden' id='calcmethod".$sno."' value='".$calc."'>";
$output.="<td>".$itemresult['name']."</td>";

$output .="<td><input onkeyup=costupdate(".$sno.",this) type='text' class='form-control price enterKeyclass' name='price[]' id='priceid".$sno."' data-id='".$sno."' value='".number_format($itemresult['price'],2,'.','')."' style='width:5rem; height:1.75rem' onkeypress='if(this.value.length==8) return false'></td>";

  $output.="<td><input onkeyup=priceupdate1(".$sno.",this) type='text' class='form-control qty' name='qty[]' id='num_qty".$sno."' value='".$value['qty']."' style='width:5rem; height:1.75rem' onkeypress='if(this.value.length==8) return false'></td>";


$output.="<td><input onkeyup=gstupdate(".$sno.",this) type='text' value='".number_format($value['tax'],2,'.','')."' class='form-control gst'
name='gst[]' id='gstpid".$sno."' style='width:5rem; height:1.75rem'
onkeypress='if(this.value.length==6) return false'></td>";


$output.="<td class='text-right' id='totalid".$sno."'>".number_format($value['total'],2,'.','')."</td><td><button type='button' class='btn btn-default btn-sm' onclick='removeItem(".$sno.")'><span class='glyphicon glyphicon-trash'>
<i class='fas fa-trash'></i>
</span></button></td>";


$output.="</tr>";

$total_product_value=$itemresult['price']*$value['qty'];
// $total_tax_value=$total_tax_value+$value['tax'];
$total_subtotal=$total_subtotal+$total_product_value;

$overalltotal=$overalltotal+$value['total'];
$total_tax=$total_tax+$value['tax_amount'];

}


$out=['out'=>$output,'item'=>$new_array,'sno'=>$sno,'gtotal'=>number_format($overalltotal,2,'.',''),'subtotal'=>number_format($total_subtotal,2,'.',''),'totaltax'=>number_format($total_tax,2,'.',''),'cid'=>$customer_result[0]['id'],'ccustomername'=>$customer_result[0]['name'],'ccompanyname'=>$customer_result[0]['company_name'],'ccaddress_line_1'=>$customer_result[0]['address'],'city'=>$customer_result[0]['city'],'cstate'=>$customer_result[0]['state'],'ccphone'=>$customer_result[0]['mobile'],'cemailid'=>$customer_result[0]['email'],'orderdate'=>date('d-m-Y',strtotime($ordresult['date']))];

echo json_encode($out);


?>