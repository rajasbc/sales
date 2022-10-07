<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail extends Dbconnection {
	var $mail;
	var $db;

	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}

	public function sendEmail(){

		$mail = new PHPMailer(true);

		$mail->From = "adminpo@2crsi.com";
		$mail->FromName = "Admin";


		$mail->addAddress($users['email'], $users['name']);

		$mail->isHTML(true);

		$mail->Subject = "Registered as PO Tracking System - 2crsi";
		$mail->Body = "Hi, You are registered as 2crsi PO Tracking System, Your login details below., <br /><br /><table><tr><td>User Name : ".$users['username']."</td></tr><tr><td>User Name : ".$originalpassword."</td></tr></table><br />Thank You,";

		try {
		    $mail->send();
		    return 'Success';
		} catch (Exception $e) {
		    return 'Failed';
		}
		

	}


}