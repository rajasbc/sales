<?php
include '../../includes/config.php';
$obj = new Vendor();
$result =  $obj->get_vendor();
$tresult =  $obj->get_totalvendor();

$out='';

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {
		$i++;
		$out .= "
		<tr id='row" . $row['id'] . "'>
		<td>" . $i . "</td>
		<td>" . $row['name'] . "</td>
		<td>" . $row['company_name']. "</td>
		<td>" .$row['email'] . "</td>
		<td>" . $row['mobile'] . "</td>
		<td>" . $row['city'] . "</td>";


		if($_SESSION['utype']=='Admin')
        {

		$out .= "<td>
		<a data-id=".$row['id']." class='btn btn-sm btn-success' href='vendor.php?id=".$row['id']."' value='".$row['id']."'>Edit</a> 
		</td>";

		}

		$out .= "</tr>";
	}
}


// $output=['out'=>$out];

$output1=['out'=>$out,'count'=>count($tresult)];





echo json_encode($output1);


?>

