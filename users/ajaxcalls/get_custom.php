<?php
include '../../includes/config.php';
// error_reporting(E_ALL);
$obj= new Customer();
$result =  $obj->getcustom_details();
$output=array();
if(count($result)>0){
foreach($result as $row){
$temp_array=array();
$temp_array['id']=$row['id'];
$temp_array['label']=$row['name'];
$temp_array['name']=$row['name'];
$temp_array['email']=$row['email'];
$temp_array['mobile']=$row['mobile'];
$temp_array['address']=$row['address'];
$temp_array['city']=$row['city'];
$temp_array['state']=$row['state'];
$temp_array['country']=$row['country'];
$temp_array['companyname']=$row['company_name'];
$output[]=$temp_array;
}
}
// else{
//  $output['label'] = 'No Record Found';
// }
echo json_encode($output);
?>