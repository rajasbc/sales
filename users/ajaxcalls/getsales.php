<?php
include '../../includes/config.php';
$obj = new Sales();
$result =  $obj->get_list();

$robj = new Receipt();

$cobj = new Customer();

$out = '';

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_customers($row['customer']);

		$rsresult = $robj->gettotalpaid($row['billid']);

		$bal = $row['grandtotal']-$rsresult['paid'];

		$i++;
		$out .= "
		<tr>
		<td>" . $row['billid'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>
		<td>" . $cresult[0]['name']. "</td>
		<td>" . $row['grandtotal'] . "</td>
		<td>". number_format($rsresult['paid'],2,'.','') ."</td>
		<td>" . number_format($bal,2,'.','') . "</td>
		<td>";

		if($bal!='0')
		{
			$out.="<button class='btn btn-warning btn-action btn-sm' data-id='" . $row['billid'] . "' data-url='selectBill.php?t=".$row['billid']."' value='".$row['billid']."' name='pay' id='test_edit".$row['billid']."' data-toggle='modal'>Pay</button>";
		}
		else if($bal=='0')
		{
			$out.="<button class='btn btn-primary btn-sm'>Paid</button>";
		}

		$out .="</td>
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