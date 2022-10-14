<?php
include '../../includes/config.php';
$obj = new Salesorder();
$result =  $obj->get_orders();

$totresult =  $obj->get_totorders();

$cobj = new Customer();

$aobj = new Admin();

$out = '';

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_customers($row['customer']);

		$aresult = $aobj->getusername($row['createdby']);

		$i++;
		$out .= "
		<tr>
		<td>" . $row['invoice_no'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>
		<td>" . $cresult[0]['name']. "</td>";


		$out .= "<td>" . $aresult['name']. "</td>";


		$out .="<td>" . $row['grandtotal'] . "</td>
		<td>" . $row['status'] . "</td>
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
		if($row['status']!='Completed' && $row['status']!='Cancelled')
		{
		$out .="<a class='btn btn-sm btn-secondary' style='color:white' onclick='open_alert(".$row['orderid'].")'>Cancel</a>";
		}

		}

		$out .="</td>
		</tr>";
	}
}
else
{
	$out .= '<td colspan="6" style="text-align:center;">No Record Found</td>';
}


$output=['out'=>$out,'count'=>count($totresult)];

echo json_encode($output);

?>