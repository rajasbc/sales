<?php
include '../../includes/config.php';
$obj = new Sales();
$result =  $obj->get_list();

$cobj = new Customer();

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_customers($row['customer']);

		$i++;
		$out .= "
		<tr>
		<td>" . $row['billid'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>
		<td>" . $cresult[0]['name']. "</td>
		<td>" . $row['grandtotal'] . "</td>
		<td>0.00</td>
		<td>" . $row['grandtotal'] . "</td>
		<td><button class='btn btn-warning btn-action btn-sm' data-id='" . $row['billid'] . "' data-url='selectBill.php?t=".$row['billid']."' value='".$row['bill_id']."' name='pay' id='test_edit".$row['bill_id']."' data-toggle='modal'>Pay</button></td>
		<td>
		<a class='btn btn-sm btn-success' href='viewsalesdetails.php?id=".$row['billid']."'>View</a> &nbsp; ";

		// if($row['status']=='New')
		// {
		// $out .="<a class='btn btn-sm btn-warning' href='purchase.php?bill_check_group=".base64_encode($row['orderid'])."'>Invoice</a>";
		// }

		$out .="</td>
		</tr>";
	}
}


$output=['out'=>$out];

echo json_encode($output);


?>