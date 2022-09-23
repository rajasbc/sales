<?php
include '../../includes/config.php';
$obj = new Salesorder();
$result = $obj->addbill_details();
echo json_encode($result);
?>


