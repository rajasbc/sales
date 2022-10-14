<?php
include '../includes/config.php';
include 'header.php';

// error_reporting(E_ALL);

$userobj = new Admin();
$userresult = $userobj->getsalesperson();
$userdet = $userobj->getusername($uid);
$tusers = $userobj->getUserData();

$cobj = new Customer();
$tcust = $cobj->get_cust();

$slobj = new Salesorder();
$sgrt = $slobj->totalorders();

$sqty = $slobj->totalqty();

$vobj = new Vendor();
$tvend = $vobj->get_vend();

$purchase_obj = new Purchaseorder();
$purchase_res =  $purchase_obj->get_reminderorders();

?>

<style type="text/css">
	
.form-control
{
	height: 31px;
}

select.custom-select {
    -webkit-appearance: menulist;
  }

</style>

<!-- [ Main Content ] start -->
	<div class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="main-body">
						<div class="page-wrapper">
							<!-- [ breadcrumb ] start -->
							<div class="page-header">
								<div class="page-block">
									<div class="row align-items-center">
										<div class="col-md-12">
											<div class="page-header-title">
												<h5>Home</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#!">Analytics Dashboard</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->
							<!-- [ Main Content ] start -->

							<div class="card">

								<div class="container mb-4">

							<?php

							if($_SESSION['utype']=='Admin')
							{

							?>

							<div class="row mt-4">

								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-red">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Total Buyers</h6>
													<h3 class="m-b-0 text-white"><?php if(count($tcust)>0){ echo count($tcust); } else{ echo '0'; } ?></h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-users text-c-red f-18"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-green">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Product Sold</h6>
													<h3 class="m-b-0 text-white"><?php if($sqty['qty']>0){ echo $sqty['qty']; } else{ echo '0'; } ?></h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-tags text-c-green f-18"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-yellow">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Total Vendors</h6>
													<h3 class="m-b-0 text-white"><?php if(count($tvend)>0){ echo count($tvend); } else{ echo '0'; } ?></h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-database text-c-yellow f-18"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-blue">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Total Users</h6>
													<h3 class="m-b-0 text-white"><?=count($tusers)?></h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-user text-c-blue f-18"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>

							<?php

							}

							?>



							<div class="row mt-4">

								<h5 style="margin-left:25px;">Orders Summary</h5>

								<div class="col-md-12 mt-1">
									
									<table style="margin-left:15px;">
			                           <thead>
			                            <tr>
							                <th class="ts-pager">
							                  <div class="form-inline">
							                    <div class="btn-group" role="group">
							                      <button type="button" class="btn first" title="first"><i class="fa fa-backward" aria-hidden="true"></i></button>
							                      <button type="button" class="btn prev" title="previous"><i class="fa fa-caret-left fa-lg" aria-hidden="true"></i></button>
							                    </div>
							                    <span class="pagedisplay"></span>
							                    <div class="btn-group" role="group">
							                      <button type="button" class="btn  next" title="next"><i class="fa fa-caret-right fa-lg" aria-hidden="true"></i></button>
							                      <button type="button" class="btn  last" title="last"><i class="fa fa-forward" aria-hidden="true"></i></button>
							                    </div>
							                    <select class="form-control custom-select pagesize"  style="padding: 0px 15px; height: 31px; display: none;" title="Select page size">
							                      <option selected="selected" value="10">10</option>
							                      <option value="20">20</option>
							                      <option value="30">30</option>
							                    </select>

							                    <!-- <input type="text" class="form-control" placeholder="Search...." id="mySearch" style="width: 150px; margin: 5px;" /> -->

							                  </div>
							                </th>

							                <th>

							                <div class="form-inline">
 &nbsp;  &nbsp; 

							                <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">From Date</span>
                                                </div>
                                                <input type="date" style="padding:0px 3px;" class="form-control" id="fromdate" value="<?=date('Y-m-d')?>">
                                            </div> &nbsp; &nbsp; 


                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">To Date</span>
                                                </div>
                                                <input type="date" style="padding:0px 3px;" class="form-control" id="todate" value="<?=date('Y-m-d')?>">
                                            </div> &nbsp; &nbsp; 

                                            <?php

                                            if($_SESSION['utype']!='Sales Person')
                                            {

                                            ?>

                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Sales Person</span>
                                                </div>
                                                <select id="salesperson" class="custom-select custom-select-sm">
                                                	<option value="All">All</option>

                                                	<?php

									                foreach($userresult as $row)
									                {
									                  echo"<option value='".$row['id']."'>".$row['name']."</option>";
									                }

									                ?>

                                                </select>
                                            </div>&nbsp;

                                            <?php

                                        	}
                                        	else
                                        	{

                                        	echo"<input type='hidden' id='salesperson' value='".$_SESSION['uid']."' />";

                                        	}

                                        	?>

                                            &nbsp;<button class="btn btn-sm btn-primary mt-1" id="go">Go</button>

							                </div>

							                </th>

							              </tr>
				                        </thead>
				                    </table>

								</div>
								
								<div class="card-body table-border-style">
								      <div class="table-responsive">

								        <table class="table table-hover">
								          <thead>
								           <tr>
								            <th style="width:10%;">Order#</th>
								            <th>Date</th>
								            <th>Customer</th>
								            <th>Email</th>
								            <th>Status</th>
								            <th>Actions</th>
								          </tr>
								        </thead>
								        <tbody id="mytable">

								        </tbody>
								      </table>
								    </div>
								</div>
<?php if(count($purchase_res)>0){?>
								<div class="card-body table-border-style">
									<h5>Reminder Orders</h5><br>
								      <div class="table-responsive">

								        <table class="table table-hover">
								           <thead>
           <tr>
            <th style="width:10%;">Order#</th>
            <th>Date</th>
            <th>Expected Date</th>
            <th>Vendor</th>
            <th>Email</th>
            <th>Total ($)</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
								        <tbody>
								        	<?php 
$k = 0;
	foreach ($purchase_res as $row) {

		$cresult = $vobj->get_vendors($row['vendor']);

		$k++;
		echo  "
		<tr>
		<td>" . $row['invoice_no'] . "</td>
		<td>" . date('d-m-Y',strtotime($row['date'])) . "</td>";
		if ($row['expected_date']!='') {
			echo "<td>" . date('d-m-Y',strtotime($row['expected_date'])) . "</td>";
		}else{
			echo "<td></td>";
		}
		
		echo "<td>" . $cresult[0]['name']. "</td>
		<td>" . $cresult[0]['email'] . "</td>
		<td>" . $row['grandtotal'] . "</td>
		<td>" . $row['status'] . "</td>
		<td>
		<a class='btn btn-sm btn-success' href='viewpurchaseorderdetails.php?id=".$row['orderid']."'>View</a> &nbsp; ";

		if($_SESSION['utype']=='Admin')
		{

		if($row['status']=='New' || $row['status']=='Partially Completed')
		{
		echo "<a class='btn btn-sm btn-warning' href='purchase.php?bill_check_group=".base64_encode($row['orderid'])."'>Invoice</a>";
		}

		}

		echo "</td>
		</tr>";
	}
								        	?>

								        </tbody>
								      </table>
								    </div>
								</div>
							<?php }?>

							</div>



							<!-- [ Main Content ] end -->
						</div>

						</div>
					</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
include 'footer.php';
?>

<script>
    $(document).ready(function(){


    	var from = $("#fromdate").val();
    	var to = $("#todate").val();
    	var salesperson = $("#salesperson").val();

    	getdata(from,to,salesperson);


     $("#mySearch").keyup(function() {
    var value = $(this).val().toLowerCase();
    $("#mytable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


     $("#go").click(function() {
     	
     	var from = $("#fromdate").val();
    	var to = $("#todate").val();
    	var salesperson = $("#salesperson").val();

    	getdata(from,to,salesperson);

     });


   });



    function getdata(a,b,c)
    {

    	var from = a;
    	var to = b;
    	var person = c;

    	// alert();

    	$.ajax({
	      type:"POST",
	      url:'ajaxCalls/getdashsalesorders.php',
	      dataType:"json",
	      data:{'from':from,'to':to,'person':person},
	      success: function(res){

	        $('#mytable').html(res.out);
	        $("table").trigger('update');

	      }
	    });

    }


 </script>

 <script id="js">
  $(function() {
$.fn.columnCount = function() {
    return $('th', $(this).find('thead')).length;
        };
       var count=$('table').columnCount();
//alert(count);

    $("table").tablesorter({
       theme : "bootstrap",

        widthFixed: true,

        // widget code contained in the jquery.tablesorter.widgets.js file
        // use the zebra stripe widget if you plan on hiding any rows (filter widget)
        // the uitheme widget is NOT REQUIRED!
        //widgets : [ "filter"],
        headers: {
        4: { sorter: false, filter: false },
        7: { sorter: false, filter: false },
        //5: { sorter: false, filter: false },
        //8: { sorter: false, filter: false },
        //9: { sorter: false, filter: false },
        10: { sorter: false, filter: false }
        },
        widgetOptions : {
            // using the default zebra striping class name, so it actually isn't included in the theme variable above
            // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
            zebra : ["even", "odd"],

            // class names added to columns when sorted
            // columns: [ "primary", "secondary", "tertiary" ],

            // reset filters button
            filter_reset : ".reset",

            // extra css class name (string or array) added to the filter element (input or select)
            filter_cssFilter: [
                'form-control',
                'form-control',
                'form-control', // select needs custom class names :(
                'form-control',
                'form-control',
                'form-control',
        'form-control',
                'form-control',
                'form-control'
            ]

        }


    })
    .tablesorterPager({

        // target the pager markup - see the HTML block below
        container: $(".ts-pager"),

        // target the pager page select dropdown - choose a page
        cssGoto  : ".pagenum",

        // remove rows from the table to speed up the sort of large tables.
        // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
        removeRows: false,

        // output string - default is '{page}/{totalPages}';
        // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
        output: '{startRow} to {endRow} of {filteredRows} ({totalRows})'

    });
    

});



</script>