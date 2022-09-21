<?php

if($_SESSION['uid']!='')
{
	header("location:users/index.php");
}
else
{
	header("location:login.php");
}

?>