<?php
include '../../includes/config.php';
$obj = new Salesorder();
$result =  $obj->get_orders();

$cobj = new Customer();

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_customers($row['customer']);

		$i++;
		$out .= "
		<tr>
		<td>" . $row['orderid'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>
		<td>" . $cresult[0]['name']. "</td>
		<td>" . $cresult[0]['email'] . "</td>
		<td>" . $row['status'] . "</td>
		<td>
		<a class='btn btn-sm btn-success' href='viewsalesorderdetails.php?id=".$row['orderid']."'>View</a>
		</td>
		</tr>";
	}
}


$output=['out'=>$out];

echo json_encode($output);

?>