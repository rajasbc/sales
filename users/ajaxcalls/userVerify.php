<?php
include'../../includes/config.php';
$obj=new Admin();
$result=$obj->getUserVerify();
echo json_encode($result);

?>