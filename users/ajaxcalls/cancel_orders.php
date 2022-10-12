<?php
include '../../includes/config.php';
// error_reporting(E_ALL);
if ($_POST['type']=='sales') {
	$obj = new Salesorder();
$result = $obj->cancel_order($_POST['id']);
}else{
	$obj = new Purchaseorder();
$result = $obj->cancel_order($_POST['id']);
}

echo json_encode($result);
?>

