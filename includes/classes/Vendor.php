<?php
class Vendor extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "vendor";
	
	

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();

	}
	function add_vendor(){
		$vendor = array();
		$vendor['name'] = $this->db->getpost('name');
		$vendor['address'] = $this->db->getpost('address');
		$vendor['state'] =$this->db->getpost('state');
		$vendor['email'] =$this->db->getpost('email');
		$vendor['company_name'] = $this->db->getpost('company_name');
		$vendor['city'] = $this->db->getpost('city');
		$vendor['country'] = $this->db->getpost('country');
		$vendor['mobile'] = $this->db->getpost('mobile');
		if ($this->db->getpost('id')=='') {
			$vendor_insert = $this->db->mysql_insert($this->tablename, $vendor);
		}else{
			$vendor_insert = $this->db->mysql_update($this->tablename, $vendor,'id='.$this->db->getpost('id'));
		}
		

		return  ["status"=>'success'];

	}
	function get_vendor() {
		$sql = " select * from " . $this->tablename;
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	function get_vendors($id) {
		$sql = " select * from " . $this->tablename." where id=".$id;
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	function getAllcustomersfilter() {

		$no_of_records_per_page =$this->db->getpost('size');
		$pageno= $this->db->getpost('page');
		$offset = ($pageno) * $no_of_records_per_page;
		$term_data=$this->db->getpost('filter');
		$term_var=explode('=', $term_data);
		$term_search=$term_var[1];


		$sql = "select * from ".$this->tablename." where ORDER BY id DESC LIMIT ". $offset .",". $no_of_records_per_page;

		$result = $this->db->GetResultsArray($sql);
		return $result;	
	}

}
?>