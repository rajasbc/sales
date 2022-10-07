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

	$sql = "select * from " . $this->tablename . " where  (username='".$username."' or email='".$username."') and password='".$password."' and status='Active'";
		$result = $this->db->GetResultsArray($sql);

		$_SESSION['username'] = $result[0]['username'];
		$_SESSION['email'] = $result[0]['email'];
		$_SESSION['uid'] = $result[0]['id'];
		$_SESSION['utype'] = $result[0]['type'];

		if (count($result)>0) {
			
			return ['status'=>'success'];

	}else{
		return ['status'=>'failed'];

	}

	
}


	function getUserData()
	{

		$sql="select * from ".$this->tablename." where status='Active' order by id asc";
		$result = $this->db->GetResultsArray($sql);

		return $result;

	}


	function add_users() {
		
		$sqlEmail="select * from ".$this->tablename." where email='".$this->db->getpost('email_id')."'";
		$emailResult = $this->db->GetResultsArray($sqlEmail);
		if(count($emailResult)>0 && $this->db->getpost('email_id')!='')
		{
			return ['status'=>'Failed Email','msg' => 'This Email Already Exist'];
		}

		$users = array();
		$users['name'] = $this->db->getpost('username');
		$users['email'] = $this->db->getpost('email_id');
		$users['mobile'] = $this->db->getpost('mobile_no');
		$users['password'] = md5($this->db->getpost('password'));
		$users['type'] = $this->db->getpost('staff_category');
		$users['username'] = $this->db->getpost('login_username');
		$users['status'] = 'Active';

		$originalpassword = $this->db->getpost('password');

		$userId = $this->db->mysql_insert($this->tablename, $users);


		$mobj = new Mail();
		$mres = $mobj->sendEmail();


		if (!$userId) {
			return ["status" => "failed", "msg" => "This User Allready Created"];
		}
		
		else {

			$sql="select * from ".$this->tablename." where id='".$userId."'";
			$result = $this->db->GetResultsArray($sql);

			return ["status" => "success", "msg" => "User Created Successfully", "name" => $result[0]['name'], "mobile_no" => $result[0]['mobile'], "email" => $result[0]['email'], "username" => $result[0]['username'], "type" => $result[0]['type'], "id" => $userId];
		}

	}


	function getusername($id) {
		$sql = "select * from " . $this->tablename . " where id='" . $id . "'";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}


	function update_users() {
		$users = array();
		$users['name'] = $this->db->getpost('username_edit');
		$users['username'] = $this->db->getpost('username');
		$users['password'] = md5($this->db->getpost('password_edit'));
		$users['email'] = $this->db->getpost('edit_email_id');
		$users['mobile'] = $this->db->getpost('edit_mobile_no');
		$users['type'] = $this->db->getpost('edit_staff_category');
		
		
		$sqlUser="select * from ".$this->tablename." where id!=".$this->db->getpost('userId')." and email='".$this->db->getpost('edit_email_id')."'";
		$userResult = $this->db->GetResultsArray($sqlUser);

// echo count($userResult);

		if($this->db->getpost('edit_email_id')!='' && count($userResult)>0)
		{
			return ['status'=>'Failed Email','msg' => 'This Email Already Exist'];
		}
		else
		{
		$userId = $this->db->mysql_update($this->tablename, $users, 'id=' . $this->db->getpost('userId'));
		if (!$userId) {
			return ["status" => "faild", "msg" => "User Data not Update "];
		}
		$sql = "select * from " . $this->tablename . " where id=" . $this->db->getpost('userId');
		$result = $this->db->GetResultsArray($sql);
		if (count($result) > 0) {
			return ["status" => "success", "msg" => "User Updated Successfully", "name" => $result[0]['name'], "mobile_no" => $result[0]['mobile'], "username" => $result[0]['username'], "email" => $result[0]['email'], "type" => $result[0]['type'], "id" => $result[0]['id']];
		}
		}
	}

	function deleteUser() {

			$myid = $this->db->getpost('userId');
		
			$sql = "update " . $this->tablename . " set status='Inactive' where id=" . $this->db->getpost('userId');

			$result1 = $this->db->ExecuteQuery($sql);

			if ($result1 == true) {
				return ["status" => "success", "id" => $myid];
			} else {
				return ["status" => "faild"];
			}

	}

	function getsalesperson()
	{
		$sql="select * from ".$this->tablename." where type='Sales Person'";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}


	function password_change()
	{


	$password = $this->db->getpost('password');

	$opass = md5($password);


	$sql = "update " . $this->tablename . " set password='".$opass."' where id ='" . $_SESSION['uid'] . "'";
	$result = $this->db->ExecuteQuery($sql);


	
		return ["status" => "success"];
	

	}


	function getUserVerify() {
		
		$name = $this->db->getpost('name');

		$id = $this->db->getpost('userId');

		if($id!='')
		{
		$sql = "select username from " . $this->tablename . " where username='" . $name . "' and id!='".$id."'";
		}
		else
		{
		$sql = "select username from " . $this->tablename . " where username='" . $name . "'";
		}

		$result = $this->db->GetAsIsArray($sql);

		if (count($result) > 0) {
			return ["status" => 'failed'];
		} else {
			return ["status" => 'success', "username" => $name];
		}

	}


	function getEmailVerify() {
		
		$email = $this->db->getpost('email');

		$id = $this->db->getpost('userId');

		if($id!='')
		{
		$sql = "select email from " . $this->tablename . " where email='" . $email . "' and id!='".$id."'";
		}
		else
		{
		$sql = "select email from " . $this->tablename . " where email='" . $email . "'";
		}

		$result = $this->db->GetAsIsArray($sql);

		if (count($result) > 0) {
			return ["status" => 'failed'];
		} else {
			return ["status" => 'success', "email" => $email];
		}

	}


}