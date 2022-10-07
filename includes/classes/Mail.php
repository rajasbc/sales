<?php

class Mail extends Dbconnection {
	var $mail;
	var $db;

	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}

	public function sendEmail(){
		
		$headers  = "From: no-reply@2crsi.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

		$subject = 'Registered as PO Tracking System - 2crsi';
		$message = 'Hi, You are registered as 2crsi PO Tracking System, Your login details below., <br /><br /><table><tr><td>User Name : '.$users['username'].'</td></tr><tr><td>User Name : '.$originalpassword.'</td></tr></table><br />Thank You,';

		$to = $users['email'];


		if(mail($to, $subject, $message, $headers))
		{

			return 'Success';

		}


		

	}


}