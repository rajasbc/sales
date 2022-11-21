 <?php
class Product extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "product";
	var $tablename1 = "`bird_countries`";

	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}

	function add_product(){
		// print_r("sdfasd");die();
		$product=array();
		$product['name']=$this->db->getpost('product_name');
		$product['hsncode']=$this->db->getpost('hsn_code');
		$product['price']=$this->db->getpost('price');

		if ($this->db->getpost('id')=='') {
             $product_insert=$this->db->mysql_insert($this->tablename,$product);

             $prodid = $product_insert; 
         }else{
             $product_insert=$this->db->mysql_update($this->tablename,$product,'id='.$this->db->getpost('id'));

             $prodid = $this->db->getpost('id'); 

         }
         return['status'=>'success','name'=>$product['name'],'hsncode'=>$product['hsncode'],'qty'=>$this->db->getpost('qty'),'price'=>$product['price'],'id'=>$prodid];

	}


	function add_item(){
		// print_r("sdfasd");die();
		$product=array();
		$product['name']=$this->db->getpost('product_name');


		$sel="select * from ".$this->tablename." where name='".$this->db->getpost('product_name')."'";
		$selres = $this->db->GetNumRows($sel);

		if($selres==0)
		{
			$product_insert=$this->db->mysql_insert($this->tablename,$product);

            $prodid = $product_insert;

            return['status'=>'success','name'=>$product['name'],'hsncode'=>$product['hsncode'],'qty'=>$this->db->getpost('qty'),'price'=>$product['price'],'id'=>$prodid];
		}
		else
		{

			return['status'=>'Failed'];

		}
         
	}

	function getitem_details(){
		 $sql = "select * from " . $this->tablename." WHERE   is_delete='NO' and  (name LIKE '%".$this->db->getpost('term')."%' ) LIMIT 0,15";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}


	function get_products() {

		$no_of_records_per_page =$this->db->getpost('size');
		$pageno= $this->db->getpost('page');
		$offset = ($pageno) * $no_of_records_per_page;
		$search=$this->db->getpost('search');

		if($search!='')
		{
		$sql = "select * from ".$this->tablename." where (name like '%".strtolower($search)."%') LIMIT ". $offset .",". $no_of_records_per_page;
		}
		else
		{
		$sql = "select * from " . $this->tablename." LIMIT ". $offset .",". $no_of_records_per_page;
		}

		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	function get_totalproducts() {

		$no_of_records_per_page =$this->db->getpost('size');
		$pageno= $this->db->getpost('page');
		$offset = ($pageno) * $no_of_records_per_page;
		$search=$this->db->getpost('search');

		if($search!='')
		{
		$sql = "select * from ".$this->tablename." where (name like '%".strtolower($search)."%')";
		}
		else
		{
		$sql = "select * from " . $this->tablename;
		}

		$result = $this->db->GetResultsArray($sql);
		return $result;
	}



	function getitem($id){
		 $sql = "select * from " . $this->tablename." where id='".$id."'";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}

	
 function get_countries(){
	$sql="select * from ".$this->tablename1." order by name asc";
		$result = $this->db->GetResultsArray($sql);
		return $result;

	}


	function get_prlist(){
	$sql="select * from ".$this->tablename." where is_delete='NO' order by name asc";
		$result = $this->db->GetResultsArray($sql);
		return $result;

	}



}
