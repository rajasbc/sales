<?php
include '../../includes/config.php';
$obj = new Product();
$result =  $obj->get_products();
$tresult =  $obj->get_totalproducts();

$out='';

if (count($result) > 0) {

	$i = 0;
	foreach ($result as $row) {
		$i++;
		$out .= "
		<tr id='row" . $row['id'] . "'>
		<td>" . $i . "</td>
		<td>" . $row['name'] . "</td>";


		if($_SESSION['utype']=='Admin')
        {

		$out .= "<td>
		<a data-id=".$row['id']." class='btn btn-sm btn-success' href='product.php?id=".$row['id']."' value='".$row['id']."'>Edit</a> 
		</td>";

		}

		$out .= "</tr>";
	}
}
else
{
	$out .= "<td colspan='7'>No Records Found.</td>";
}


// $output=['out'=>$out];

$output1=['out'=>$out,'count'=>count($tresult)];





echo json_encode($output1);


?>

