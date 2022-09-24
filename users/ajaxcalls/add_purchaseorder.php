<?php
include '../../includes/config.php';
$obj = new Purchaseorder();
$result = $obj->addbill_details();
echo json_encode($result);
?>


