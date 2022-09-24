<?php
include '../../includes/config.php';
// print_r($_POST);die();
 $obj = new Vendor();
 
 $result =  $obj->search_email1();

 echo json_encode($result);


?>
