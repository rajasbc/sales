<?php
include '../../includes/config.php';
// error_reporting(E_ALL);
if ($_POST['type']=='sales') {
$obj = new Sales();
$result = $obj->delete_document($_POST['id']);
}
else if ($_POST['type']=='salesorder') {
$obj = new Salesorder();
$result = $obj->delete_document($_POST['id']);
}
else if ($_POST['type']=='purchase') {
$obj = new Purchase();
$result = $obj->delete_document($_POST['id']);
}

echo json_encode($result);
?>

