<?php
include '../../includes/config.php';


// error_reporting(E_ALL);

$obj = new Admin();
$result =  $obj->add_users();

echo json_encode($result);

?>