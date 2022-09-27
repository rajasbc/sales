<?php
include'../../includes/config.php';
$obj=new Receipt();

// error_reporting(E_ALL);

$result=$obj->add_receipt();

echo json_encode($result);

?>