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

	function totalorders() {
		$sql = "select sum(grandtotal) as grandtotal from " . $this->tablename;
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}

	function totalqty() {
		$sql = "select sum(qty) as qty from " . $this->tablename1;
		$result = $this->db->GetAsIsArray($sql);
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


    $seldt = "select MAX(invoice_id) as iid from salesorder where date='".date('Y-m-d')."'";
    $selin = $this->db->GetAsIsArray($seldt);

    $newinv = $selin['iid']+1;

    $invoiceno = '2crsiso'.date('ymd').sprintf("%04d", $newinv);


    //update orderid and invoiceno

    $up="update salesorder set orderid='".$bill_id."',invoice_id='".$newinv."',invoice_no='".$invoiceno."' where id='".$bill_id."'";
    $this->db->ExecuteQuery($up);

    $sub=0;
    $gtax=0;
    $gtot=0;
	foreach ($item as $itemvar) {
		// print_r($itemvar);die();

    if ((isset($itemvar["itemname"]) && $itemvar["itemname"] !== '')) 
    {
    $sales_details=array();

    $totalvalue = $itemvar['qty']*$itemvar['price'];

    $rowtotal = $totalvalue+$itemvar['gstamount'];
    
    $sales_details['orderid']=$bill_id;
    $sales_details['product']=$itemvar['itemno'];
    $sales_details['qty']=$itemvar['qty'];
    $sales_details['rate']=$itemvar['price'];
    $sales_details['tax']=$itemvar['gst'];
    $sales_details['tax_amount']=$itemvar['gstamount'];
    $sales_details['balance_qty']=$itemvar['qty'];
    $sales_details['total']=$rowtotal;
    $sql=$this->db->mysql_insert($this->tablename1,$sales_details);


    $sub=$sub+$totalvalue;
    $gtax=$gtax+$itemvar['gstamount'];
    $gtot=$gtot+$rowtotal;


	}

    }


    $up="update salesorder set subtotal='".$sub."',tax_amount='".$gtax."',grandtotal='".$gtot."' where id='".$bill_id."'";
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



	function getdashorders() {

		$salesperson = $this->db->getpost('person');
		$from = $this->db->getpost('from');
		$to = $this->db->getpost('to');

		if($salesperson=='All')
		{
		$sql = "select * from ".$this->tablename." where date between '$from' and '$to'";
		}
		else
		{
		$sql = "select * from ".$this->tablename." where createdby='".$salesperson."' and date between '$from' and '$to'";
		}

		$result = $this->db->GetResultsArray($sql);
		return $result;

	}
	

}




?>