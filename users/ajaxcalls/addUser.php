<?php
include '../../includes/config.php';

$obj = new Admin();
$result =  $obj->add_users();

echo json_encode($result);

?>