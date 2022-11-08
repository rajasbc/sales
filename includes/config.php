<?php
session_start();
error_reporting(0);
date_default_timezone_get('Asia/Kolkata');
ini_set('date.timezone', 'Asia/Kolkata');


include_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createMutable(__DIR__."/../");
$dotenv->load();
spl_autoload_register(function ($class_name) {
	include "classes/" . $class_name . '.php';
});

include_once 'barcode128.php';
global $pagename;
global $CONFIG_;
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$pagename = $parts[count($parts) - 1];

if ($_SERVER['HTTP_HOST'] == "localhost") {
	$_SERVER["DOCUMENT_ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/sales/";
}


?>