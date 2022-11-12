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

		$no_of_records_per_page =$this->db->getpost('size');
		$pageno= $this->db->getpost('page');
		$offset = ($pageno) * $no_of_records_per_page;
		$search=$this->db->getpost('search');

		$fdate = $this->db->getpost('fdate');
		$tdate = $this->db->getpost('tdate');

		if($search!='')
		{
		$sql = "select a.*,b.name as name,c.name as sperson from " . $this->tablename." a join customer b on a.customer=b.id join admin c on a.createdby=c.id where a.date between '".$fdate."' and '".$tdate."' and (a.invoice_no like '%".strtolower($search)."%' or DATE_FORMAT(a.date,'%d-%m-%Y') like '%".strtolower($search)."%' or a.grandtotal like '%".strtolower($search)."%' or a.status like '%".strtolower($search)."%' or b.name like '%".strtolower($search)."%' or c.name like '%".strtolower($search)."%') order by a.id desc LIMIT ". $offset .",". $no_of_records_per_page;
		}
		else
		{
		$sql = "select a.*,b.name as name,c.name as sperson from " . $this->tablename." a join customer b on a.customer=b.id join admin c on a.createdby=c.id where a.date between '".$fdate."' and '".$tdate."' order by a.id desc LIMIT ". $offset .",". $no_of_records_per_page;
		}


		// echo $sql;



		$result = $this->db->GetResultsArray($sql);
		return $result;
	}

	function get_totorders() {

		$no_of_records_per_page =$this->db->getpost('size');
		$pageno= $this->db->getpost('page');
		$offset = ($pageno) * $no_of_records_per_page;
		$search=$this->db->getpost('search');

		$fdate = $this->db->getpost('fdate');
		$tdate = $this->db->getpost('tdate');

		if($search!='')
		{
		$sql = "select a.*,b.name as name,c.name as sperson from " . $this->tablename." a join customer b on a.customer=b.id join admin c on a.createdby=c.id where a.date between '".$fdate."' and '".$tdate."' and (a.invoice_no like '%".strtolower($search)."%' or DATE_FORMAT(a.date,'%d-%m-%Y') like '%".strtolower($search)."%' or a.grandtotal like '%".strtolower($search)."%' or a.status like '%".strtolower($search)."%' or b.name like '%".strtolower($search)."%' or c.name like '%".strtolower($search)."%') order by a.id desc";
		}
		else
		{
		$sql = "select a.*,b.name as name,c.name as sperson from " . $this->tablename." a join customer b on a.customer=b.id join admin c on a.createdby=c.id where a.date between '".$fdate."' and '".$tdate."' order by a.id desc";
		}

		$result = $this->db->GetResultsArray($sql);
		return $result;
	}

	function totalorders() {
		$sql = "select sum(grandtotal) as grandtotal from " . $this->tablename;
		$result = $this->db->GetAsIsArray($sql);
		return $result;
	}

	function totalqty() {
		$sql = "select sum(qty) as qty from " . $this->tablename1." a join ".$this->tablename." b on a.orderid=b.orderid where b.status='Completed'";
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

	if ((isset($itemvar["file_name"]) && $itemvar["file_name"] !== '' && $itemvar["file_base"] !== '')) 
    {
    $image_data = $itemvar["file_base"];
    // $fileext = basename($itemvar["file_name"]);
    $fileext  = pathinfo( $itemvar["file_name"], PATHINFO_EXTENSION );
    $fullname = 'ord'.$bill_id.date('Ymdhis').'.'.$fileext; //$itemvar["file_name"]
    $tsrget="../../upload/salesorder_documents/";



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
        $this->db->mysql_insert('salesorder_documents',$document_array);
    }
    
    }

    }


    $up="update salesorder set subtotal='".$sub."',tax_amount='".$gtax."',grandtotal='".$gtot."' where id='".$bill_id."'";
    $this->db->ExecuteQuery($up);


  //   	$mobj = new Mail();
		// $mres = $mobj->sendorderEmail();

    

$response = ["status" => "success" ,"order_id"=>$bill_id];
        } 

        catch (Exception $e) {
            $response = ["status" => "failed", 'message' => $e->getMessage()];
        }

        return $response;
    }


    function editbill_details(){
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
$salesorderno=$_POST['salesorderno'];

$customerDetails = $this->customerObj->getcustDetails($cust_id);
// print_r($customerDetails);die();        
try 
{

	$sales['customer']=$_POST['cid'];
    $sales['date']=date('Y-m-d');
    $sales['createdby']=$_POST['salesperson'];
    $sales['status']='New';
    $sales['created_at']=date('Y-m-d H:i:s');


    // $bill_id=$this->db->mysql_insert($this->tablename,$sales);


    $seldt = "select * from salesorder where id='".$salesorderno."'";
    $selin = $this->db->GetAsIsArray($seldt);

    $invoiceno = $selin['invoice_no'];


    //update orderid and invoiceno

    $bill_id=$salesorderno;

    $up="update salesorder set invoice_no='".$invoiceno."' where id='".$salesorderno."'";
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

    if($itemvar['flag']=='new' && $itemvar['deleted']=='no')
    {

    $sql=$this->db->mysql_insert($this->tablename1,$sales_details);

	}
	else if($itemvar['flag']=='old' && $itemvar['deleted']=='no')
    {
	
    $sql=$this->db->mysql_update($this->tablename1,$sales_details,'id='.$itemvar['main_id']);

	}
	else if($itemvar['deleted']=='yes')
    {
	
    $del = "delete from salesorder_details where id='".$itemvar['main_id']."'";
    $this->db->ExecuteQuery($del);

	}

	if($itemvar['deleted']=='no')
	{
    $sub=$sub+$totalvalue;
    $gtax=$gtax+$itemvar['gstamount'];
    $gtot=$gtot+$rowtotal;
	}

	}

	if ((isset($itemvar["file_name"]) && $itemvar["file_name"] !== '')) 
    {


    if($itemvar["file_base"] !== '')
    {

    $image_data = $itemvar["file_base"];
    // $fileext = basename($itemvar["file_name"]);
    $fileext  = pathinfo( $itemvar["file_name"], PATHINFO_EXTENSION );
    $fullname = 'ord'.$bill_id.date('Ymdhis').'.'.$fileext; //$itemvar["file_name"]
    $tsrget="../../upload/salesorder_documents/";



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
        $this->db->mysql_insert('salesorder_documents',$document_array);
    }

	}
	else
	{

		if($itemvar['deleted']=='yes')
	    {
		
	    $del = "delete from salesorder_documents where id='".$itemvar['docmain_id']."'";
	    $this->db->ExecuteQuery($del);

		}

	}

    
    }

    }


    $up="update salesorder set subtotal='".$sub."',tax_amount='".$gtax."',grandtotal='".$gtot."' where id='".$bill_id."'";
    $this->db->ExecuteQuery($up);


  //   	$mobj = new Mail();
		// $mres = $mobj->sendorderEmail();

    

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

	function get_orderdetails($id,$condition='hide') {
		if ($condition=='hide') {
			$sql = "select * from " . $this->tablename1." where orderid='".$id."'";

		}else{
			$sql = "select * from " . $this->tablename1." where orderid='".$id."' and balance_qty!=0";

		}
				$result = $this->db->GetResultsArray($sql);
		return $result;
	}
	public function cancel_order($id)
	{
	$up="update ".$this->tablename." set status='Cancelled' where orderid='".$id."'";
    $this->db->ExecuteQuery($up);
    return ['status'=>'success'];
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


	function get_orderdocumentdetails($id) {

		$sql = "select * from salesorder_documents where order_id='".$id."' and is_deleted='NO'";
		$result = $this->db->GetResultsArray($sql);
		return $result;

	}
	
	function get_docdetails($id) {
        $sql = "select * from salesorder_documents where order_id='".$id."' and is_deleted='NO'";
        $result = $this->db->GetResultsArray($sql);
        return $result;
    }
    function delete_document($id) {

        $sql = "UPDATE `salesorder_documents` SET is_deleted='YES' WHERE id=".$id;
        $result = $this->db->ExecuteQuery($sql);
        return ['status'=>'success'];
    }


}




?>