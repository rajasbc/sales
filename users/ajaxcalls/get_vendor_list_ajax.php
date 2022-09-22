<?php
include '../../includes/config.php';
$obj = new Vendor();
$result =  $obj->get_vendor();

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
		<td>" . $row['city'] . "</td>
		<td>
		<a data-id=".$row['id']." class='btn btn-sm btn-success' href='vendor.php?id=".$row['id']."' value='".$row['id']."'>Edit</a> 
		</td>
		</tr>";
	}
}


$output=['out'=>$out];





echo json_encode($output);


?>
