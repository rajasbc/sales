<?php
include '../../includes/config.php';
 $obj = new Admin();
 $result =  $obj->deleteUser();
 echo json_encode($result);
?>
