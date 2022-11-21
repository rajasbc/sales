<?php
include '../../includes/config.php';
$obj = new Sales();
$result =  $obj->get_list();
$tresult =  $obj->get_saleslist();

$robj = new Receipt();

$cobj = new Customer();

$sobj = new Salesorder();

$out = '';

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {

		$cresult = $cobj->get_customers($row['customer']);

		$rsresult = $robj->gettotalpaid($row['billid']);

		$bal = $row['grandtotal']-$rsresult['paid'];

		$sordresult = $sobj->get_order($row['sales_orderid']);

		$i++;
		$out .= "
		<tr>
		<td>" . $row['invoice_no'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>
		<td>" . $cresult[0]['name']. "</td>
		<td>" . $row['grandtotal'] . "</td>
		<td>". $sordresult['invoice_no'] ."</td>
		<td>
		<a class='btn btn-sm btn-success' href='viewsalesdetails.php?id=".$row['billid']."'>View</a> &nbsp; ";


		if($_SESSION['utype']=='Admin')
		{

		$out.="<a class='btn btn-sm btn-info' href='editsales.php?bill_check_group=".base64_encode($row['billid'])."'><i class='feather icon-edit'></i></a>";

		}

		$out .="</td>
		</tr>";
	}
}
else
{
	$out .="<td colspan='8' style='text-align:center;'>No Record Found</td>";
}

$output=['out'=>$out,'count'=>count($tresult)];

echo json_encode($output);


?>