<?php
include'../../includes/config.php';
$obj=new Payment();

// error_reporting(E_ALL);

$result=$obj->add_payment();

echo json_encode($result);

?>