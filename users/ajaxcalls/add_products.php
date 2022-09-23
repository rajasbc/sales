<?php
include '../../includes/config.php';
 $obj = new Product();
 $result =  $obj->add_product();
 echo json_encode($result);


?>