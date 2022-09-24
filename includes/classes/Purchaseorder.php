<?php
class Purchaseorder extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "purchaseorder";
	var $tablename1 = "purchaseorder_details";

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
		// $this->customerObj = new Customer();
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
$purchase = array();
$item = $_POST;
$bill_date = date('Y-m-d');
$cust_id=$_POST['cid'];

// $customerDetails = $this->customerObj->getcustDetails($cust_id);
// print_r($customerDetails);die();        
try 
{

	$purchase['vendor']=$_POST['cid'];
	$purchase['sales_orderid']=$_POST['salesorderno'];
    $purchase['date']=date('Y-m-d');
    $purchase['status']='New';
    $purchase['created_at']=date('Y-m-d H:i:s');
    $bill_id=$this->db->mysql_insert($this->tablename,$purchase);


    $upsales = "update salesorder set status='Converted' where orderid='".$_POST['salesorderno']."'";
    $this->db->ExecuteQuery($upsales);

// print_r();die();

    $sub=0;
    $gtax=0;
    $gtot=0;
	foreach ($item as $itemvar) {



    if ((isset($itemvar["itemname"]) && $itemvar["itemname"] !== '')) 
    {
    $order_details=array();

    $totalvalue = $itemvar['qty']*$itemvar['price'];

    $rowtotal = $totalvalue+$itemvar['gstamount'];
    
    $order_details['orderid']=$bill_id;
    $order_details['product']=$itemvar['itemno'];
    $order_details['qty']=$itemvar['qty'];
    $order_details['rate']=$itemvar['price'];
    $order_details['tax_amount']=$itemvar['gstamount'];
    $order_details['tax']=$itemvar['gst'];
    $order_details['total']=$rowtotal;
    $sql=$this->db->mysql_insert($this->tablename1,$order_details);


    $sub=$sub+$totalvalue;
    $gtax=$gtax+$itemvar['gstamount'];
    $gtot=$gtot+$rowtotal;
	}

    }

    $up="update purchaseorder set orderid='".$bill_id."',subtotal='".$sub."',tax_amount='".$gtax."',grandtotal='".$gtot."' where id='".$bill_id."'";
    $this->db->ExecuteQuery($up);

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