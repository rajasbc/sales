<?php
class Vendor extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "vendor";
	var $countries = "bird_countries";
	
	

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
			$vendid = $vendor_insert;
		}else{
			$vendor_insert = $this->db->mysql_update($this->tablename, $vendor,'id='.$this->db->getpost('id'));
			$vendid = $this->db->getpost('id');
		}
		

		return  ["status"=>'success','id'=>$vendid,"name"=>$vendor['name'],"company_name"=>$vendor['company_name'],"email"=>$vendor['email'],"mobile"=>$vendor['mobile'],"address"=>$vendor['address'],"city"=>$vendor['city'],"state"=>$vendor['state'],"country"=>$vendor['country'],"companyname"=>$vendor['company_name']];

	}
	function get_vendor() {

		$no_of_records_per_page =$this->db->getpost('size');
		$pageno= $this->db->getpost('page');
		$offset = ($pageno) * $no_of_records_per_page;
		$search=$this->db->getpost('search');

		if($search!='')
		{
		$sql = " select * from ".$this->tablename." where (name like '%".strtolower($search)."%' or company_name like '%".strtolower($search)."%' or email like '%".strtolower($search)."%' or mobile like '%".strtolower($search)."%' or city like '%".strtolower($search)."%') LIMIT ". $offset .",". $no_of_records_per_page;
		}
		else
		{
		$sql = " select * from " . $this->tablename;
		}
		
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	function get_vendors($id) {
		$sql = " select * from " . $this->tablename." where id='".$id."'";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}

	function getvendor_details(){
         $sql = "select * from " . $this->tablename." WHERE is_delete='NO' and  (name LIKE '%".$this->db->getpost('term')."%' ) LIMIT 0,15";
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
	function get_countries() {
		$sql = "select * from bird_countries";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	public function search_email1(){

		$id = $this->db->getpost('id');

		if($id!='')
		{
		$sql = "select email from " . $this->tablename . " where  email = '".$this->db->getpost('email')."' and id!='".$id."'";
		}
		else
		{
		$sql = "select email from " . $this->tablename . " where  email = '".$this->db->getpost('email')."'";
		}

		$res=$this->db->GetResultsArray($sql);
		if(count($res)==0)
		{
			return "Email Availble";
			
		}
		else
		{
			return "Email Already Exist";
		}

	}

}


?>