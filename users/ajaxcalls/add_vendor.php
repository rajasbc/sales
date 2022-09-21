<?php
include '../../includes/config.php';
// print_r($_POST);die();
 $obj = new Vendor();
 
 $result =  $obj->add_vendor();

 echo json_encode($result);


?>
