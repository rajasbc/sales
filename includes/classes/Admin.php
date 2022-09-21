<?php
class Admin extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`admin`";
	
	

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();

	}
	function login_checkup(){

		$username = $this->db->getpost('username');
		$password = md5($this->db->getpost('password'));

	$sql = "select * from " . $this->tablename . " where  username='" . $username . " ' and password='".$password."'";
		$result = $this->db->GetResultsArray($sql);


		if (count($result)>0) {
			
			return ['status'=>'success'];

	}else{
		return ['status'=>'failed'];

	}

	
}
}