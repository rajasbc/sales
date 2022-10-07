<?php
include '../../includes/config.php';
// error_reporting(E_ALL);
$obj = new Salesorder();
$result = $obj->addbill_details();
echo json_encode($result);
?>

