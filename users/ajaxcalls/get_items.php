<?php
include '../../includes/config.php';
$obj= new Product();
$result =  $obj->getitem_details();
$output=array();
if(count($result)>0){
foreach($result as $row){
$temp_array=array();
$temp_array['id']=$row['id'];
$temp_array['label']=$row['name'];
$temp_array['name']=$row['name'];
$temp_array['category']=$row['category'];
$temp_array['subcategory']=$row['subcategory'];
$temp_array['mrp']=$row['mrp'];
$temp_array['qty']=$row['qty'];
$temp_array['price']=$row['price'];
$temp_array['vendor']=$row['vendor'];
$temp_array['gst']=$row['gst'];
$temp_array['cgst']=$row['cgst'];
$temp_array['sgst']=$row['sgst'];
$temp_array['hsncode']=$row['hsncode'];
$output[]=$temp_array;
}
}
else{
 $output['label'] = 'No Record Found';
}
echo json_encode($output);


?>