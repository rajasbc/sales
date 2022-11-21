<?php
include '../../includes/config.php';
$obj = new Salesorder();
$result =  $obj->getdashorders();

// error_reporting(E_ALL);

$pobj = new Purchaseorder();

$cobj = new Customer();

$aobj = new Admin();

$out = '';

$ordertotal = 0;
$pototal = 0;

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_customers($row['customer']);

		$aresult = $aobj->getusername($row['createdby']);

		$presult = $pobj->get_salesorderpototal($row['orderid']);

		$i++;
		$out .= "
		<tr>
		<td>" . $row['invoice_no'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>
		<td>" . $cresult[0]['name']. "</td>";


		$out .= "<td>" . $aresult['name']. "</td>
		<td>" . $row['grandtotal']. "</td>
		<td>" . $presult['grandtotal']. "</td>";


		$out .="<td>" . $row['status'] . "</td>
		<td>
		<a class='btn btn-sm btn-success' href='viewsalesorderdetails.php?id=".$row['orderid']."'>View</a> &nbsp; ";

		if($_SESSION['utype']=='Admin')
		{

		if($row['status']=='New')
		{
		$out .="<a class='btn btn-sm btn-warning' href='purchaseorder.php?bill_check_group=".base64_encode($row['orderid'])."'>Raise PO</a>";
		}

		if($row['status']!='New' && $row['status']!='Completed' && $row['status']!='Cancelled')
		{
		$out .="<a class='btn btn-sm btn-danger' href='sales.php?bill_check_group=".base64_encode($row['orderid'])."'>Invoice</a>";
		}

		}

		$out .="</td>
		</tr>";

		$ordertotal = $ordertotal+$row['grandtotal'];
		$pototal = $pototal+$presult['grandtotal'];
	}
}
else
{

	$out .= "<td colspan='8' style='text-align:center;'>No Data Found</td>";

}


$output=['out'=>$out,'ordertotal'=>number_format($ordertotal,2,'.',''),'pototal'=>number_format($pototal,2,'.',''),'count'=>count($result)];

echo json_encode($output);

?>