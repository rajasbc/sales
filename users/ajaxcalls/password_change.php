<?php
include '../../includes/config.php';

$obj = new Admin();
$result =  $obj->password_change();

echo json_encode($result);

?>