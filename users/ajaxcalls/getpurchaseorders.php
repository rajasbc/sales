<?php
include '../../includes/config.php';
$obj = new Purchaseorder();
$result =  $obj->get_orders();

$cobj = new Vendor();

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_vendors($row['vendor']);

		$i++;
		$out .= "
		<tr>
		<td>" . $row['orderid'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>
		<td>" . $cresult[0]['name']. "</td>
		<td>" . $cresult[0]['email'] . "</td>
		<td>" . $row['grandtotal'] . "</td>
		<td>" . $row['status'] . "</td>
		<td>
		<a class='btn btn-sm btn-success' href='viewpurchaseorderdetails.php?id=".$row['orderid']."'>View</a> &nbsp; ";

		// if($row['status']=='New')
		// {
		// $out .="<a class='btn btn-sm btn-warning' href='purchaseorder.php?bill_check_group=".base64_encode($row['orderid'])."'>Raise PO</a>";
		// }

		$out .="</td>
		</tr>";
	}
}


$output=['out'=>$out];

echo json_encode($output);

?>