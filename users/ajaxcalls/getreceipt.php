<?php
include '../../includes/config.php';
$obj = new Receipt();
$result =  $obj->get_receipt();
$tresult =  $obj->get_totalreceipt();

$cobj = new Customer();

$out = '';

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_customers($row['customer']);


		$i++;
		$out .= "
		<tr>
		<td>" . date('d-m-Y',strtotime($row['created_at'])) . "</td>
		<td>" . $row['invoice_no'] . "</td>
		<td>" . $cresult[0]['name']. "</td>
		<td>". number_format($row['pay'],2,'.','') ."</td>
		</tr>";
	}
}
else
{
	$out .="<td colspan='4' style='text-align:center;'>No Record Found</td>";
}


$output=['out'=>$out,'count'=>count($tresult)];

echo json_encode($output);

?>