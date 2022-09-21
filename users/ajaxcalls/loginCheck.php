<?php
include '../../includes/config.php';
// echo "dsfsdf";
// error_reporting(E_ALL);

 $obj = new Admin();

 $result =  $obj->login_checkup();

 echo json_encode($result);


?>

