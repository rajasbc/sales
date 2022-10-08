<?php
include '../../includes/config.php';
$obj = new Vendor();
$result =  $obj->get_vendor();

$outobj = new Outstandings();

// error_reporting(E_ALL);

$out = '';

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$purtotal = $outobj->getpurchase($row['id']);

		$paytotal = $outobj->getpaid($row['id']);

		$balance = $purtotal['total']-$paytotal['paid'];

		//lastpaymentdate

		$lastpaymentdate = $outobj->getlastpaymentdate($row['id']);


		$i++;
		$out .= "
		<tr>
		<td>" . $i . "</td>
		<td>" . $row['name'] . "</td>
		<td style='text-align:right; padding-right:21px;'>" . number_format($balance,2,'.','') . "</td>
		<td>";

		if($lastpaymentdate['created_at']!='')
		{
			$out .= date('d-m-Y',strtotime($lastpaymentdate['created_at']));
		}

		$out .= "</td>
		<td><a href='vendorpayable.php?id=".$row['id']."' class='btn btn-sm btn-primary'>View</a></td>
		</tr>";

	}
}


// $output=['out'=>$out];

$output1=['out'=>$out,'count'=>count($result)];




echo json_encode($output1);


?>