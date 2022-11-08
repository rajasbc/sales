<?php
class Outstandings extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "purchase";
	var $countries = "sales";
	
	

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();

	}
	
	function getpurchase($id) {
		$sql = "select sum(grandtotal) as total from purchase where vendor='".$id."'";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}

	function getpaid($id) {
		$sql = "select sum(pay) as paid from payment where vendor='".$id."'";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}


	function getlastpaymentdate($id) {
		$sql = "select * from payment where vendor='".$id."' order by date(created_at) desc";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}


	function getvendorpayable($id) {

		$sql = "select created_at as time, date as date, concat('Purchase Bill #', invoice_no) as description, grandtotal as credit, null as debit from purchase where vendor='".$id."' and date between '".$this->db->getpost('fromdate')."' and '".$this->db->getpost('todate')."'
		UNION
		select created_at as time, date(created_at) as date, concat('Payment #', id) as description, null as credit, pay as debit from payment where vendor='".$id."' and date(created_at) between '".$this->db->getpost('fromdate')."' and '".$this->db->getpost('todate')."' order by time asc";

		$result = $this->db->GetResultsArray($sql);
		return $result;
	}


	function getvendorbf($id) {

		$sql = "select sum(grandtotal) as total from purchase where vendor='".$id."' and date<'".$this->db->getpost('fromdate')."'";
		$result = $this->db->GetAsIsArray($sql);

		$sel = "select sum(pay) as paid from payment where vendor='".$id."' and date(created_at)<'".$this->db->getpost('fromdate')."'";
		$presult = $this->db->GetAsIsArray($sel);

		$balance = $result['total']-$presult['paid'];

		return $balance;
	}



	function getsales($id) {
		$sql = "select sum(grandtotal) as total from sales where customer='".$id."'";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}

	function getreceived($id) {
		$sql = "select sum(pay) as paid from receipt where customer='".$id."'";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}


	function getlastreceiveddate($id) {
		$sql = "select * from receipt where customer='".$id."' order by date(created_at) desc";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}


	function getcustomerreceivable($id) {

		$sql = "select created_at as time, date as date, concat('Sales Bill #', invoice_no) as description, grandtotal as credit, null as debit from sales where customer='".$id."' and date between '".$this->db->getpost('fromdate')."' and '".$this->db->getpost('todate')."'
		UNION
		select created_at as time, date(created_at) as date, concat('Receipt #', id) as description, null as credit, pay as debit from receipt where customer='".$id."' and date(created_at) between '".$this->db->getpost('fromdate')."' and '".$this->db->getpost('todate')."' order by time asc";

		$result = $this->db->GetResultsArray($sql);
		return $result;
	}


	function getcustomerbf($id) {

		$sql = "select sum(grandtotal) as total from sales where customer='".$id."' and date<'".$this->db->getpost('fromdate')."'";
		$result = $this->db->GetAsIsArray($sql);

		$sel = "select sum(pay) as paid from receipt where customer='".$id."' and date(created_at)<'".$this->db->getpost('fromdate')."'";
		$presult = $this->db->GetAsIsArray($sel);

		$balance = $result['total']-$presult['paid'];

		return $balance;
	}


}

?>