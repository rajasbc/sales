<?php
include '../../includes/config.php';
 $obj = new Product();
 $result =  $obj->add_item();
 echo json_encode($result);

?>