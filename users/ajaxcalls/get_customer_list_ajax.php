<?php
include '../../includes/config.php';
$obj = new Customer();
$result =  $obj->get_customer();
// print_r($result);die();
// error_reporting(E_ALL);

// $out_count=count($result);

// $resultdata = $obj->getAllcustomersfilter();
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
		<a data-id=".$row['id']." class='btn btn-sm btn-success' href='customer.php?id=".$row['id']."' value='".$row['id']."'>Edit</a> 
		</td>";

		}

		$out .= "</tr>";
	}
}


$output=['out'=>$out];





echo json_encode($output);


?>

