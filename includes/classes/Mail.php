<?php

include_once '../../vendor/autoload.php';
include_once '../config.php';

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

class Mail extends Dbconnection {
	var $mail;
	var $db;

	// use PHPMailer\PHPMailer\PHPMailer;
	// use PHPMailer\PHPMailer\Exception;


	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}

	public function sendEmail(){

		$mail = new PHPMailer();

		$mail->From = "adminpo@2crsi.com";
		$mail->FromName = "Admin";


		$mail->addAddress($this->db->getpost('email_id'), $this->db->getpost('username'));

		$mail->isHTML(true);

		$mail->Subject = "Registered as PO Tracking System - 2crsi";
		$mail->Body = "Hi, You are registered as 2crsi PO Tracking System, Your login details below., <br /><br /><table><tr><td>User Name : ".$this->db->getpost('username')."</td></tr><tr><td>User Name : ".$this->db->getpost('password')."</td></tr></table><br />Thank You,";

		// echo $mail;

		try {
		    $mail->send();
		    return 'Success';
		} catch (Exception $e) {
		    return 'Failed';
		}
		

	}

	public function sendorderEmail(){

		$mail = new PHPMailer();

		$mail->From = "adminpo@2crsi.com";
		$mail->FromName = "Admin";


		$obj = new Admin();
		$adres = $obj -> getadmin();

		$ures = $obj->getusername($_POST['salesperson']);	


		$mail->addAddress($adres['email'], $adres['username']);

		$mail->isHTML(true);

		$mail->Subject = "New PO - 2crsi";
		$mail->Body = "Hi Admin, a salesperson ".$ures['name']." has raised a new PO.<br />Thank You,";

		// echo $mail;

		try {
		    $mail->send();
		    return 'Success';
		} catch (Exception $e) {
		    return 'Failed';
		}
		

	}


}