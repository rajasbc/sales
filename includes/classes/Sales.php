<?php
class Sales extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "sales";
	var $tablename1 = "sales_details";

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	
	function get_list() {
		$sql = "select * from " . $this->tablename;
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}



	function addbill_details(){

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

        
try 
{

	$purchase['customer']=$_POST['cid'];
	$purchase['sales_orderid']=$_POST['salesorderno'];
    $purchase['date']=date('Y-m-d');
    $purchase['status']='New';
    $purchase['created_at']=date('Y-m-d H:i:s');
    $bill_id=$this->db->mysql_insert($this->tablename,$purchase);


    $sub=0;
    $gtax=0;
    $gtot=0;
	foreach ($item as $itemvar) {



    if ((isset($itemvar["itemname"]) && $itemvar["itemname"] !== '')) 
    {
    $order_details=array();

    $totalvalue = $itemvar['qty']*$itemvar['price'];

    $rowtotal = $totalvalue+$itemvar['gstamount'];
    
    $order_details['billid']=$bill_id;
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


    $sl="select * from salesorder_details where orderid='".$_POST['purchaseorderno']."' and product='".$itemvar['itemno']."'";
    $sl1=$this->db->GetAsIsArray($sl);

    $bal = $sl1['balance_qty']-$itemvar['qty'];


    $upsales = "update salesorder_details set balance_qty='".$bal."' where id='".$sl1['id']."'";
    $this->db->ExecuteQuery($upsales);


	}

    }

    //order details update

    $sl="select * from salesorder_details where orderid='".$_POST['salesorderno']."' and balance_qty!='0'";
    $sl1=$this->db->GetResultsArray($sl);

    $spl="select * from salesorder_details where orderid='".$_POST['salesorderno']."' and balance_qty!=qty";
    $spl1=$this->db->GetResultsArray($spl);

    if(count($sl1)==0)
    {
    $up="update salesorder set status='Completed' where orderid='".$_POST['purchaseorderno']."'";
    $this->db->ExecuteQuery($up);
	}
	elseif(count($sl1)!=0 && count($spl1)!=0)
	{
	$up="update salesorder set status='Partially Completed' where orderid='".$_POST['purchaseorderno']."'";
    $this->db->ExecuteQuery($up);
	}


	//purchase total update

	$up="update sales set billid='".$bill_id."',subtotal='".$sub."',tax_amount='".$gtax."',grandtotal='".$gtot."' where id='".$bill_id."'";
    $this->db->ExecuteQuery($up);

	$response = ["status" => "success" ,"bill_id"=>$bill_id];
    }

        catch (Exception $e) {
            $response = ["status" => "failed", 'message' => $e->getMessage()];
        }

        return $response;
    }


	function get_bill($id) {
		$sql = "select * from " . $this->tablename." where billid='".$id."'";
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}

	function get_billdetails($id) {
		$sql = "select * from " . $this->tablename1." where billid='".$id."'";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	

}




?>