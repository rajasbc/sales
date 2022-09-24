<?php
include '../../includes/config.php';
// print_r($_POST);die();
 $obj = new Customer();
 
 $result =  $obj->search_email();

 echo json_encode($result);


?>
