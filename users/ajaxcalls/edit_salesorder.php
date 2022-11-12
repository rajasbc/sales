<?php
include '../../includes/config.php';
// error_reporting(E_ALL);
$obj = new Salesorder();
$result = $obj->editbill_details();
echo json_encode($result);
?>

