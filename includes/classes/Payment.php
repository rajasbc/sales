<?php
class Payment extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "payment";
	
	

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();

	}
	function add_payment(){
		$vendor = array();
		$vendor['vendor'] = $this->db->getpost('v_id');
		$vendor['billid'] = $this->db->getpost('bill_id');
		$vendor['invoice_no'] = $this->db->getpost('invoice_no');
		$vendor['pay'] =$this->db->getpost('pay');

		$insert_id = $this->db->mysql_insert($this->tablename, $vendor);
		

		return  ["status"=>'success','id'=>$insert_id];

	}
	function get_payment() {

		$no_of_records_per_page =$this->db->getpost('size');
        $pageno= $this->db->getpost('page');
        $offset = ($pageno) * $no_of_records_per_page;
        $search=$this->db->getpost('search');

        $fdate = $this->db->getpost('fdate');
        $tdate = $this->db->getpost('tdate');

        if($search!='')
        {
        $sql = " select a.*,b.name as name from " . $this->tablename." a join vendor b on a.vendor=b.id where date(a.created_at) between '".$fdate."' and '".$tdate."' and (a.invoice_no like '%".strtolower($search)."%' or DATE_FORMAT(a.created_at,'%d-%m-%Y') like '%".strtolower($search)."%' or a.pay like '%".strtolower($search)."%' or b.name like '%".strtolower($search)."%') order by id desc";
        }
        else
        {
        $sql = " select a.*,b.name as name from " . $this->tablename." a join vendor b on a.vendor=b.id where date(a.created_at) between '".$fdate."' and '".$tdate."' order by id desc";
        }

		
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