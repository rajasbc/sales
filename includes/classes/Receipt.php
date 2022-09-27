<?php
class Receipt extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "receipt";
	
	

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();

	}
	function add_receipt(){
		$vendor = array();
		$vendor['customer'] = $this->db->getpost('cust_id');
		$vendor['billid'] = $this->db->getpost('bill_id');
		$vendor['pay'] =$this->db->getpost('pay');

		$insert_id = $this->db->mysql_insert($this->tablename, $vendor);
		

		return  ["status"=>'success','id'=>$insert_id];

	}
	function get_receipt() {
		$sql = " select * from " . $this->tablename;
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	function gettotalpaid($id) {
		$sql = " select sum(pay) as paid from " . $this->tablename." where billid='".$id."'";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}
	

}

?>