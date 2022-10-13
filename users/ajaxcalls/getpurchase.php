<?php
include '../../includes/config.php';
$obj = new Purchase();
$result =  $obj->get_list();

// error_reporting(E_ALL);

$robj = new Payment();

$cobj = new Vendor();

$out = '';

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_vendors($row['vendor']);

		$rsresult = $robj->gettotalpaid($row['billid']);

		$bal = $row['grandtotal']-$rsresult['paid'];

		$i++;
		$out .= "
		<tr>
		<td>" . $row['invoice_no'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>
		<td>" . $cresult[0]['name']. "</td>
		<td>" . $row['grandtotal'] . "</td>
		<td>". number_format($rsresult['paid'],2,'.','') ."</td>
		<td>" . number_format($bal,2,'.','') . "</td>
		<td>";

		if($bal!='0')
		{
		$out .= "<button class='btn btn-warning btn-action btn-sm' data-id='" . $row['billid'] . "' data-url='selectPurchase.php?t=".$row['billid']."' value='".$row['billid']."' name='pay' id='test_edit".$row['billid']."' data-toggle='modal'>Pay</button>";
		}
		else if($bal=='0')
		{
			$out.="<button class='btn btn-primary btn-sm'>Paid</button>";
		}

		$out .= "</td>
		<td>
		<a class='btn btn-sm btn-success' href='viewpurchasedetails.php?id=".$row['billid']."'>View</a> &nbsp; ";

		// if($row['status']=='New')
		// {
		// $out .="<a class='btn btn-sm btn-warning' href='purchase.php?bill_check_group=".base64_encode($row['orderid'])."'>Invoice</a>";
		// }

		$out .="</td>
		</tr>";
	}
}


$output=['out'=>$out,'count'=>count($result)];

echo json_encode($output);


?>