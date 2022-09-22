<?php
include '../../includes/config.php';
$obj = new Admin();
$result =  $obj->update_users();
// print_r($result);
echo json_encode($result);
?>