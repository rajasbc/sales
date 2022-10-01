<?php
include '../../includes/config.php';

$outobj = new Outstandings();
$result = $outobj->getcustomerreceivable($_POST['customer']);

$bfresult = $outobj->getcustomerbf($_POST['customer']);

$out = '';

if($bfresult>0)
{
		$out .= "
		<tr>
		<td></td>
		<td> B/F </td>
		<td style='text-align:right; padding-right:15px;'>" . number_format($bfresult,2,'.','') . "</td>
		<td></td>
		<td style='text-align:right; padding-right:15px;'>" . number_format($bfresult,2,'.','') . "</td>
		</tr>";
}

if (count($result) > 0) {

	$i = 0;

	if($bfresult>0)
	{
	$cre = 0;
	}
	else
	{
	$cre = 0;
	}
	$deb = 0;

	foreach ($result as $row) {

		$cre = $cre+$row['credit'];
		$deb = $deb+$row['debit'];
		$cbl = $cre-$deb;

		$i++;
		$out .= "
		<tr>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>
		<td>" . $row['description'] . "</td>
		<td style='text-align:right; padding-right:15px;'>" . number_format($row['credit'],2,'.','') . "</td>
		<td style='text-align:right; padding-right:15px;'>" . number_format($row['debit'],2,'.','') . "</td>
		<td style='text-align:right; padding-right:15px;'>" . number_format($cbl,2,'.','') . "</td>
		</tr>";

	}

	$out .= "<tr style='font-weight:bold;'><td colspan='2' style='text-align:center;'>Total</td><td style='text-align:right; padding-right:15px;'>".number_format($cre,2,'.','')."</td><td style='text-align:right; padding-right:15px;'>".number_format($deb,2,'.','')."</td><td></td></tr>";


}

elseif(count($result)==0 && $bfresult>0)
{

	$out .= "<tr style='font-weight:bold;'><td colspan='2' style='text-align:center;'>Total</td><td style='text-align:right; padding-right:15px;'>".number_format($bfresult,2,'.','')."</td><td style='text-align:right; padding-right:15px;'></td><td></td></tr>";

}

else
{

$out .= '<td colspan="5" style="text-align:center;">No Records Found</td>';

}

$output=['out'=>$out];

echo json_encode($output);


?>