<?php
include '../../includes/config.php';
// error_reporting(E_ALL);
$obj = new Salesorder();

$output_array=array();
$output='';

$result = $obj->get_orderdocumentdetails($_POST['bill_id']);

    // print_r($customer_result);

$sno=0;
$items=array();
foreach ($result as $key => $value) {

$sno++;
    $output_array['main_id']=$value['id'];
    $output_array['file_name']=$value['document_name'];
    $output_array['file_type']='';
    $output_array['file_base']='';
    $output_array['file_description']=$value['description'];

    $new_array[$sno]=$output_array;

// <td>".$sno."</td>

$output .=  "<tr id='trDoc_".$sno."'><input type='hidden' id='calcmethod".$sno."' value='".$calc."'>";
$output.="<td>".$value['document_name']."</td>";

$output .="<td>".$value['description']."</td>";

$output .="<td><button type='button' data-id='old' id='removedoc_tr".$sno."' class='btn btn-default btn-sm' onclick='removeDocItem(".$sno.")'><span class='glyphicon glyphicon-trash'>
<i class='fas fa-trash'></i>
</span></button></td>";

$output.="</tr>";

}


$out=['out'=>$output,'item'=>$new_array,'sno'=>$sno];

echo json_encode($out);


?>