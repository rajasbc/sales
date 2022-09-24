<?php
class Salesorder extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "salesorder";
	var $tablename1 = "salesorder_details";		

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
		$this->customerObj = new Customer();
	}
	
	function get_orders() {
		$sql = "select * from " . $this->tablename;
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}



	function addbill_details(){
        // print_r("dsfs");die();


$item = array();
$response = array();
$order=array();
$bill_det_tab = array();
$bill_tab = array();
$invoice = array();
$updatearray = array();
$item = $_POST;
$bill_date = date('Y-m-d');
$cust_id=$_POST['cid'];

$customerDetails = $this->customerObj->getcustDetails($cust_id);
// print_r($customerDetails);die();        
try 
{

	$sales['customer']=$_POST['cid'];
    $sales['date']=date('Y-m-d');
    $sales['createdby']=$_POST['salesperson'];
    $sales['status']='New';
    $sales['created_at']=date('Y-m-d H:i:s');
    $bill_id=$this->db->mysql_insert($this->tablename,$sales);

    $up="update salesorder set orderid='".$bill_id."' where id='".$bill_id."'";
    $this->db->ExecuteQuery($up);

	foreach ($item as $itemvar) {

    if ((isset($itemvar["itemname"]) && $itemvar["itemname"] !== '')) 
    {
    $sales_details=array();
    
    $sales_details['orderid']=$bill_id;
    $sales_details['product']=$itemvar['itemno'];
    $sales_details['qty']=$itemvar['qty'];
    $sales_details['balance_qty']=$itemvar['qty'];
    $sql=$this->db->mysql_insert($this->tablename1,$sales_details);
	}

    }

$response = ["status" => "success" ,"order_id"=>$bill_id];
        } 

        catch (Exception $e) {
            $response = ["status" => "failed", 'message' => $e->getMessage()];
        }

        return $response;
    }


	function get_order($id) {
		$sql = "select * from " . $this->tablename." where orderid='".$id."'";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}

	function get_orderdetails($id) {
		$sql = "select * from " . $this->tablename1." where orderid='".$id."'";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	

}




?>