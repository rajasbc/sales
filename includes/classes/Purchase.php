<?php
class Purchase extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "purchase";
	var $tablename1 = "purchase_details";

	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	
	function get_list() {

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


    function get_totallist() {

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
$bill_date = $_POST['date']; //date('Y-m-d')
$shippingcharges = $_POST['shippingcharges'];

        
try 
{

	$purchase['vendor']=$_POST['cid'];
	$purchase['purchase_orderid']=$_POST['purchaseorderno'];
    $purchase['date']=$_POST['date'];
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


    $sl="select * from purchaseorder_details where orderid='".$_POST['purchaseorderno']."' and product='".$itemvar['itemno']."'";
    $sl1=$this->db->GetAsIsArray($sl);

    $bal = $sl1['qty']-$itemvar['qty'];


    $upsales = "update purchaseorder_details set balance_qty=balance_qty-".$itemvar['qty'].",delivered_qty=delivered_qty+".$itemvar['qty']." where id='".$sl1['id']."'";
    $this->db->ExecuteQuery($upsales);


	}
    if ((isset($itemvar["file_name"]) && $itemvar["file_name"] !== '' && $itemvar["file_base"] !== '')) 
    {
    $image_data = $itemvar["file_base"]; 
    // $fileext = basename($itemvar["file_name"]);
    $fileext  = pathinfo( $itemvar["file_name"], PATHINFO_EXTENSION );
    $fullname = 'pinv'.$bill_id.date('Ymdhis').'.'.$fileext; //$itemvar["file_name"]
    $tsrget="../../upload/purchase_documents/";

    if (file_put_contents($tsrget . $fullname, file_get_contents($image_data))) {
    $result = $fullname;
    } else {
    $result = "error";
    }
    if ($result!='error') {
        $document_array=array();
        $document_array['purchase_id']=$bill_id;
        $document_array['document_name']=$result;
        $document_array['description']=$itemvar["file_description"];
        $this->db->mysql_insert('purchase_documents',$document_array);
    }
    
    }

    }
    //order details update

    $sl="select * from purchaseorder_details where orderid='".$_POST['purchaseorderno']."' and balance_qty!='0'";
    $sl1=$this->db->GetResultsArray($sl);

    $spl="select * from purchaseorder_details where orderid='".$_POST['purchaseorderno']."' and balance_qty!=qty";
    $spl1=$this->db->GetResultsArray($spl);

    if(count($sl1)==0)
    {
    $up="update purchaseorder set status='Completed' where orderid='".$_POST['purchaseorderno']."'";
    $this->db->ExecuteQuery($up);
	}
	elseif(count($sl1)!=0 && count($spl1)!=0)
	{
	$up="update purchaseorder set status='Partially Completed' where orderid='".$_POST['purchaseorderno']."'";
    $this->db->ExecuteQuery($up);
	}


    $seldt = "select MAX(invoice_id) as iid from purchase where date='".date('Y-m-d')."'";
    $selin = $this->db->GetAsIsArray($seldt);

    $newinv = $selin['iid']+1;

    $invoiceno = '2CRSIPI'.date('ymd').sprintf("%04d", $newinv);



	//purchase total update

    $gtot = $gtot+$shippingcharges;

	$up="update purchase set billid='".$bill_id."',subtotal='".$sub."',tax_amount='".$gtax."',shippingcharges='".$shippingcharges."',grandtotal='".$gtot."',invoice_id='".$newinv."',invoice_no='".$invoiceno."' where id='".$bill_id."'";
    $this->db->ExecuteQuery($up);

	$response = ["status" => "success" ,"bill_id"=>$bill_id];
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
$billno=$_POST['billno'];
$shippingcharges=$_POST['shippingcharges'];

// $customerDetails = $this->customerObj->getcustDetails($cust_id);
// print_r($customerDetails);die();        
try 
{

    $sales['vendor']=$_POST['cid'];
    $sales['date']=date('Y-m-d');
    $sales['status']='New';
    $sales['created_at']=date('Y-m-d H:i:s');


    // $bill_id=$this->db->mysql_insert($this->tablename,$sales);


    $seldt = "select * from purchase where id='".$billno."'";
    $selin = $this->db->GetAsIsArray($seldt);

    $invoiceno = $selin['invoice_no'];


    //update orderid and invoiceno

    $bill_id=$billno;

    $up="update purchase set date='".$_POST['date']."',invoice_no='".$invoiceno."' where id='".$billno."'";
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
    
    $sales_details['billid']=$bill_id;
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
    
    $del = "delete from purchase_details where id='".$itemvar['main_id']."'";
    $this->db->ExecuteQuery($del);

    }

    if($itemvar['deleted']=='no')
    {


        $sord = "select sum(qty) as qty from purchaseorder_details where product='".$itemvar['itemno']."' and orderid='".$selin['purchase_orderid']."'";
        $sordr = $this->db->GetAsIsArray($sord);

        $sordv = "select sum(purchase_details.qty) as rqty from purchase_details left join purchase on purchase.id=purchase_details.billid where purchase_details.product='".$itemvar['itemno']."' and purchase.purchase_orderid='".$selin['purchase_orderid']."'";
        $sordvr = $this->db->GetAsIsArray($sordv);

        $received = $sordvr['rqty'];
        $ordered = $sordr['qty'];


        if($received<$ordered)
        {
            $blq = $ordered-$received;

            $updq = "update purchaseorder_details set delivered_qty='".$received."',balance_qty='".$blq."' where orderid='".$selin['purchase_orderid']."' and product='".$itemvar['itemno']."'";
            $this->db->ExecuteQuery($updq);
        }
        else
        {
            $updq = "update purchaseorder_details set balance_qty='0.00' where orderid='".$selin['purchase_orderid']."' and product='".$itemvar['itemno']."'";
            $this->db->ExecuteQuery($updq);
        }



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
    $fullname = 'pinv'.$bill_id.date('Ymdhis').'.'.$fileext; //$itemvar["file_name"]
    $tsrget="../../upload/purchase_documents/";



    if (file_put_contents($tsrget . $fullname, file_get_contents($image_data))) {
    $result = $fullname;
    } else {
    $result = "error";
    }
    if ($result!='error') {
        $document_array=array();
        $document_array['purchase_id']=$bill_id;
        $document_array['document_name']=$result;
        $document_array['description']=$itemvar["file_description"];
        $this->db->mysql_insert('purchase_documents',$document_array);
    }

    }
    else
    {

        if($itemvar['deleted']=='yes')
        {
        
        $del = "delete from purchase_documents where id='".$itemvar['docmain_id']."'";
        $this->db->ExecuteQuery($del);

        }

    }

    
    }

    }



    //order details update

    $sl="select * from purchaseorder_details where orderid='".$selin['purchase_orderid']."' and balance_qty!='0'";
    $sl1=$this->db->GetResultsArray($sl);

    $spl="select * from purchaseorder_details where orderid='".$selin['purchase_orderid']."' and balance_qty!=qty";
    $spl1=$this->db->GetResultsArray($spl);

    if(count($sl1)==0)
    {
    $up="update purchaseorder set status='Completed' where orderid='".$selin['purchase_orderid']."'";
    $this->db->ExecuteQuery($up);
    }
    elseif(count($sl1)!=0 && count($spl1)!=0)
    {
    $up="update purchaseorder set status='Partially Completed' where orderid='".$selin['purchase_orderid']."'";
    $this->db->ExecuteQuery($up);
    }


    $gtot=$gtot+$shippingcharges;
    

    $up="update purchase set subtotal='".$sub."',tax_amount='".$gtax."',shippingcharges='".$shippingcharges."',grandtotal='".$gtot."' where id='".$bill_id."'";
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


	function getpaymentdetails($id)
	{
		$sql = "select * from payment where billid='".$id."'";
		$result = $this->db->GetResultsArray($sql);
		return $result;
	}


    function get_documentdetails($id) {

        $sql = "select * from purchase_documents where purchase_id='".$id."' and is_deleted='NO'";
        $result = $this->db->GetResultsArray($sql);
        return $result;

    }


    function get_docdetails($id) {
        $sql = "select * from purchase_documents where purchase_id='".$id."' and is_deleted='NO'";
        $result = $this->db->GetResultsArray($sql);
        return $result;
    }
    function delete_document($id) {

        $sql = "UPDATE purchase_documents SET is_deleted='YES' WHERE id=".$id;
        $result = $this->db->ExecuteQuery($sql);
        return ['status'=>'success'];
    }

	

}



?>