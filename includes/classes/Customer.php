<?php
class Customer extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "customer";
	var $countries = "bird_countries";
	
	

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();

	}
	function add_customer(){
		$customer = array();
		$customer['name'] = $this->db->getpost('name');
		$customer['address'] = $this->db->getpost('address');
		$customer['state'] =$this->db->getpost('state');
		$customer['email'] =$this->db->getpost('email');
		$customer['company_name'] = $this->db->getpost('company_name');
		$customer['city'] = $this->db->getpost('city');
		$customer['country'] = $this->db->getpost('country');
		$customer['mobile'] = $this->db->getpost('mobile');

		if ($this->db->getpost('id')=='') {
			$customer_insert = $this->db->mysql_insert($this->tablename, $customer);

			$custid = $customer_insert;
		}else{
			$customer_insert = $this->db->mysql_update($this->tablename, $customer,'id='.$this->db->getpost('id'));

			$custid = $this->db->getpost('id');
		}


		$sel="select * from bird_countries where id='".$customer['country']."'";
		$selres = $this->db->GetAsIsArray($sel);
		

		return  ["status"=>"success",'id'=>$custid,"name"=>$customer['name'],"company_name"=>$customer['company_name'],"email"=>$vendor['email'],"mobile"=>$customer['mobile'],"address"=>$customer['address'],"city"=>$customer['city'],"state"=>$customer['state'],"country"=>$selres['name'],"companyname"=>$vendor['company_name']];

	}

	function get_cust() {

		$sql="select * from ".$this->tablename."";
		$result = $this->db->GetResultsArray($sql);
		return $result;

	}

	function get_customer() {

		$no_of_records_per_page =$this->db->getpost('size');
		$pageno= $this->db->getpost('page');
		$offset = ($pageno) * $no_of_records_per_page;
		$search=$this->db->getpost('search');

		if($search!='')
		{
		$sql = "select * from ".$this->tablename." where (name like '%".strtolower($search)."%' or company_name like '%".strtolower($search)."%' or email like '%".strtolower($search)."%' or mobile like '%".strtolower($search)."%' or city like '%".strtolower($search)."%') LIMIT ". $offset .",". $no_of_records_per_page;
		}
		else
		{
		$sql = "select * from " . $this->tablename." LIMIT ". $offset .",". $no_of_records_per_page;
		}

		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	function get_totalcustomer() {

		$no_of_records_per_page =$this->db->getpost('size');
		$pageno= $this->db->getpost('page');
		$offset = ($pageno) * $no_of_records_per_page;
		$search=$this->db->getpost('search');

		if($search!='')
		{
		$sql = "select * from ".$this->tablename." where (name like '%".strtolower($search)."%' or company_name like '%".strtolower($search)."%' or email like '%".strtolower($search)."%' or mobile like '%".strtolower($search)."%' or city like '%".strtolower($search)."%')";
		}
		else
		{
		$sql = "select * from " . $this->tablename;
		}

		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	function get_customers($id) {
		$sql = " select * from " . $this->tablename." where id='".$id."'";
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

	function getcustom_details(){
         $sql = "select * from " . $this->tablename." WHERE is_delete='NO' and  (name LIKE '%".$this->db->getpost('term')."%' ) LIMIT 0,15";
        $result = $this->db->GetResultsArray($sql);
        return $result;

    }
        function getcustDetails($cId=0) {
        if($cId==0){
            return 'No Name';
        }
        else{
$sql = "select * from " . $this->tablename . " where  id = ".$cId;
        $result = $this->db->GetResultsArray($sql);
            return $result;
        }
        }
        function get_countries() {
		$sql = "select * from bird_countries";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	public function search_email(){

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