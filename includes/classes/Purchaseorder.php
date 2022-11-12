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

        $no_of_records_per_page =$this->db->getpost('size');
        $pageno= $this->db->getpost('page');
        $offset = ($pageno) * $no_of_records_per_page;
        $search=$this->db->getpost('search');

        $fdate = $this->db->getpost('fdate');
        $tdate = $this->db->getpost('tdate');

        if($search!='')
        {
		$sql = "select a.*,b.name as name from " . $this->tablename." a join vendor b on a.vendor=b.id where a.date between '".$fdate."' and '".$tdate."' and (a.invoice_no like '%".strtolower($search)."%' or DATE_FORMAT(a.date,'%d-%m-%Y') like '%".strtolower($search)."%' or a.grandtotal like '%".strtolower($search)."%' or b.name like '%".strtolower($search)."%') order by id desc LIMIT ". $offset .",". $no_of_records_per_page;
        }
        else
        {
        $sql = "select a.*,b.name as name from " . $this->tablename." a join vendor b on a.vendor=b.id where a.date between '".$fdate."' and '".$tdate."' order by id desc LIMIT ". $offset .",". $no_of_records_per_page;
        }

        // echo $sql;

		$result = $this->db->GetResultsArray($sql);
		return $result;
	}

    function get_totalorders() {

        $no_of_records_per_page =$this->db->getpost('size');
        $pageno= $this->db->getpost('page');
        $offset = ($pageno) * $no_of_records_per_page;
        $search=$this->db->getpost('search');

        $fdate = $this->db->getpost('fdate');
        $tdate = $this->db->getpost('tdate');

        if($search!='')
        {
        $sql = "select a.*,b.name as name from " . $this->tablename." a join vendor b on a.vendor=b.id where a.date between '".$fdate."' and '".$tdate."' and (a.invoice_no like '%".strtolower($search)."%' or DATE_FORMAT(a.date,'%d-%m-%Y') like '%".strtolower($search)."%' or a.grandtotal like '%".strtolower($search)."%' or b.name like '%".strtolower($search)."%') order by id desc";
        }
        else
        {
        $sql = "select a.*,b.name as name from " . $this->tablename." a join vendor b on a.vendor=b.id where a.date between '".$fdate."' and '".$tdate."' order by id desc";
        }

        // echo $sql;

        $result = $this->db->GetResultsArray($sql);
        return $result;
    }

    function get_reminderorders() {
        $date = date('Y-m-d');
        $date = date('Y-m-d', strtotime($date.' + 5 days'));
        $sql = "select * from " . $this->tablename.' where status="New" and date(expected_date)<="'.$date.'"';
        // echo $sql;die();
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
    if ($_POST['exp_date']!='') {
       $purchase['expected_date']=$_POST['exp_date'];
    }
    
    $purchase['date']=date('Y-m-d');
    $purchase['status']='New';
    $purchase['created_at']=date('Y-m-d H:i:s');
    $bill_id=$this->db->mysql_insert($this->tablename,$purchase);


    $seldt = "select MAX(invoice_id) as iid from purchaseorder where date='".date('Y-m-d')."'";
    $selin = $this->db->GetAsIsArray($seldt);

    $newinv = $selin['iid']+1;

    $invoiceno = '2crsipo'.date('ymd').sprintf("%04d", $newinv);


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
    $order_details['balance_qty']=$itemvar['qty'];
    $order_details['rate']=$itemvar['price'];
    $order_details['tax_amount']=$itemvar['gstamount'];
    $order_details['tax']=$itemvar['gst'];
    $order_details['total']=$rowtotal;
    $sql=$this->db->mysql_insert($this->tablename1,$order_details);


    $sub=$sub+$totalvalue;
    $gtax=$gtax+$itemvar['gstamount'];
    $gtot=$gtot+$rowtotal;
	}

    if ((isset($itemvar["file_name"]) && $itemvar["file_name"] !== '' && $itemvar["file_base"] !== '')) 
    {
    $image_data = $itemvar["file_base"];
    // $fileext = basename($itemvar["file_name"]);
    $fileext  = pathinfo( $itemvar["file_name"], PATHINFO_EXTENSION );
    $fullname = 'ord'.$bill_id.date('Ymdhis').'.'.$fileext; //$itemvar["file_name"]
    $tsrget="../../upload/purchaseorder_documents/";



    if (file_put_contents($tsrget . $fullname, file_get_contents($image_data))) {
    $result = $fullname;
    } else {
    $result = "error";
    }
    if ($result!='error') {
        $document_array=array();
        $document_array['order_id']=$bill_id;
        $document_array['document_name']=$result;
        $document_array['description']=$itemvar["file_description"];
        $this->db->mysql_insert('purchaseorder_documents',$document_array);
    }
    
    }

    }

    $up="update purchaseorder set orderid='".$bill_id."',subtotal='".$sub."',tax_amount='".$gtax."',grandtotal='".$gtot."',invoice_id='".$newinv."',invoice_no='".$invoiceno."' where id='".$bill_id."'";
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
public function cancel_order($id)
    {
    $up="update ".$this->tablename." set status='Cancelled' where orderid='".$id."'";
    $this->db->ExecuteQuery($up);
    return ['status'=>'success'];
    }
	function get_orderdetails($id,$condition='hide') {
        if ($condition=='hide') {
            $sql = "select * from " . $this->tablename1." where orderid='".$id."'";
        }else{
            $sql = "select * from " . $this->tablename1." where orderid='".$id."' and balance_qty!=0";
        }
		
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}



    function get_docdetails($id) {
        $sql = "select * from purchaseorder_documents where order_id='".$id."' and is_deleted='NO'";
        $result = $this->db->GetResultsArray($sql);
        return $result;
    }
    function delete_document($id) {

        $sql = "UPDATE `purchaseorder_documents` SET is_deleted='YES' WHERE id=".$id;
        $result = $this->db->ExecuteQuery($sql);
        return ['status'=>'success'];
    }

	

}






?>