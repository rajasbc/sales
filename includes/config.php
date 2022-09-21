<?php
session_start();
error_reporting(0);
date_default_timezone_get('Asia/Kolkata');
ini_set('date.timezone', 'Asia/Kolkata');

// if (strpos($_SERVER['HTTP_HOST'], 'nigsoft') !== false) {
// 	$connDb = new mysqli("localhost", "labs_admin", "Zz?B^%cGPWuM", "main_labs");
// } else if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
// 	$connDb = new mysqli("localhost", "root", "", "main_labs");

// } else {
// 	$connDb = new mysqli("maindb.c8gat1novuuo.ap-south-1.rds.amazonaws.com", "labs_admin", "Zz?B^%cGPWuM", "main_labs");
// }
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
	$_SERVER["DOCUMENT_ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/lab/";
}
/************************************/
/* global functions                 */
/************************************/
function hex2dec($color = "#000000") {
	$tbl_color = array();
	$tbl_color['R'] = hexdec(substr($color, 1, 2));
	$tbl_color['G'] = hexdec(substr($color, 3, 2));
	$tbl_color['B'] = hexdec(substr($color, 5, 2));
	return $tbl_color;
}

function px2mm($px) {
	return $px * 25.4 / 72;
}

function txtentities($html) {
	$trans = get_html_translation_table(HTML_ENTITIES);
	$trans = array_flip($trans);
	return strtr($html, $trans);
}
function numberFormat($number) {
	$result = number_format($number, 2);
	return $result;
}

function ISOutsideLab() {
	return $_SESSION['outside_lab'] === 'ENABLED' ? true : false;
}

function ISConsolidateApprove() {
	return $_SESSION['consolidate_approve'] === 'ENABLED' ? true : false;
}
function ISHospitalReference() {
	return $_SESSION['hospital'] === 'YES' ? true : false;
}

function DisplayOutSideLab($isOutsideLab, $labType) {
	$show = false;
	if (empty($labType) === false && $labType === 'outsideLab' && $isOutsideLab === true) {
		$show = true;
	}
	return $show;
}
function DisplayHospitalReference($isHospitalReference, $labType) {
	$show = false;
	if (empty($labType) === false && $labType === 'hospital' && $isHospitalReference === true) {
		$show = true;
	}
	return $show;
}


function checkPermission($labConfig=[],$pagename='dashBoard'){

	$normalBlockforStaff = ['approveStatus','modalityRevenueReport'];
	if(($labConfig[0]['menu_selection']=='ENABLED' && $_SESSION[$pagename]==$pagename || $_SESSION['type'] == 'MA' || $_SESSION['type'] == 'LA') || ($labConfig[0]['menu_selection']=='DISABLED' && ($_SESSION['type'] == 'LD' ||$_SESSION['type'] == 'LC' ||$_SESSION['type'] == 'LA' || $_SESSION['type'] == 'LB' || $_SESSION['type'] == 'LS' || $_SESSION[$pagename]==$pagename))){

		if($_SESSION['type'] == 'LS' && in_array($_SESSION[$pagename],$normalBlockforStaff)){
			return false;
		}
			
		return true;
	}else{
		if($_SESSION['type'] == 'DOCTOR' && $pagename=='approveStatus'){
		return true;
		}
		
			return false;
		
	}

}
// $t=time();
// if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 5000)) {
// session_destroy();
// session_unset();
// header('location: sessionClose.php');
// }else {$_SESSION['logged'] = time();}
?>