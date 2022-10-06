<?php
include'../../includes/config.php';
$obj=new Admin();
$result=$obj->getEmailVerify();
echo json_encode($result);

?>