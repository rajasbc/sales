<?php
include '../../includes/config.php';
$obj = new Purchaseorder();
$result =  $obj->get_orders();
$tresult =  $obj->get_totalorders();

$cobj = new Vendor();

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_vendors($row['vendor']);

		$i++;
		$out .= "
		<tr>
		<td>" . $row['invoice_no'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>";
		if ($row['expected_date']!='') {
			$out .="<td>" . date('d-m-Y',strtotime($row['expected_date'])) . "</td>";
		}else{
			$out .="<td></td>";
		}
		
		$out .="<td>" . $cresult[0]['name']. "</td>
		<td>" . $row['grandtotal'] . "</td>
		<td>" . $row['status'] . "</td>
		<td>
		<a class='btn btn-sm btn-success' href='viewpurchaseorderdetails.php?id=".$row['orderid']."'>View</a>";

		if($_SESSION['utype']=='Admin')
		{

		if($row['status']=='New' || $row['status']=='Partially Completed')
		{
		$out .="<a class='btn btn-sm btn-warning' href='purchase.php?bill_check_group=".base64_encode($row['orderid'])."'>Invoice</a>";
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
	$out .="<td colspan='7' style='text-align:center;'>No Record Found</td>";
}


$output=['out'=>$out,'count'=>count($tresult)];

echo json_encode($output);

?>