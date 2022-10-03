<?php
include '../../includes/config.php';
// error_reporting(E_ALL);
$obj = new Salesorder();
$Itemobj = new Product();

$output_array=array();
$output='';


    $result = $obj->get_orderdetails($_POST['bill_id']);

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
    $output_array['final_gst']=0;
    $output_array['final_gstpercentage']=0;
    $output_array['final_price']=$itemresult['price'];
   
    $new_array[$sno]=$output_array;


$output .=  "<tr id='trItem_".$sno."'><input type='hidden' id='calcmethod".$sno."' value='".$calc."'>
<td>".$sno."</td>";
$output.="<td>".$itemresult['name']."</td>";

$output .="<td><input onkeyup=costupdate(".$sno.",this) type='text' class='form-control price enterKeyclass' name='price[]' id='priceid".$sno."' data-id='".$sno."' value='".number_format($itemresult['price'])."' style='width:5rem; height:1.75rem' onkeypress='if(this.value.length==8) return false'></td>";

  $output.="<td><input onkeyup=priceupdate1(".$sno.",this) type='text' class='form-control qty' name='qty[]' id='num_qty".$sno."' value='".number_format($value['qty'])."' style='width:5rem; height:1.75rem' onkeypress='if(this.value.length==8) return false'></td>";


$output.="<td><input onkeyup=gstupdate(".$sno.",this) type='text' value='".number_format($value['tax'])."' class='form-control gst'
name='gst[]' id='gstpid".$sno."' style='width:5rem; height:1.75rem'
onkeypress='if(this.value.length==6) return false'></td>";


$output.="<td class='text-right' id='totalid".$sno."' value='".number_format($value['total'])."'>".number_format($value['total'])."</td><td><button type='button' class='btn btn-default btn-sm' onclick='removeItem(".$sno.")'><span class='glyphicon glyphicon-trash'>
<i class='fas fa-trash'></i>
</span></button></td>";


$output.="</tr>";
$total_product_value=$itemresult['price']*$value['qty'];
// $total_tax_value=$total_tax_value+$value['tax'];
$total_subtotal=$total_subtotal+$total_product_value;

$overalltotal=$overalltotal+$value['total'];
$total_tax=$total_tax+$value['tax'];

}

$out=['out'=>$output,'item'=>$new_array,'sno'=>$sno,'gtotal'=>$overalltotal,'subtotal'=>$total_subtotal,'totaltax'=>$total_tax];

echo json_encode($out);

?>