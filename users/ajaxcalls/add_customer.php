<?php
include '../../includes/config.php';
// print_r($_POST);die();
 $obj = new Customer();
 
 $result =  $obj->add_customer();

 echo json_encode($result);


?>
