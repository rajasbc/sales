<?php

$user = $_SESSION['username'];

if ($user == '') 
{
header('location:sessionClose.php');
}
else
{

$uobj = new Admin();
$udetails = $uobj->getusername($_SESSION['uid']);

if($udetails['type']=='Admin')
{

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Purchase Order Management System</title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords"
		content="">
	<meta name="author" content="Codedthemes" />

	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">

	<!-- animation css -->
	<link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/pages/jquery.growl.css">
	<link rel="stylesheet" href="assets/css/theme.bootstrap_4.css">
<!-- users\assets\css\pages
 -->	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">

<style type="text/css">
  
  .ts-pager .btn
  {
    padding: 2px 0px;
    margin: 2px 0px;
  }

  .ts-pager .prev
  {
  	padding-top: 5px;
  }

  .ts-pager .next
  {
  	padding-top: 5px;
  	padding-left: 10px;
  }

  .table thead th
  {
  	font-size: 12px;
  	padding: 10px;
  }

  .icon-home
  {
  	color: #666;
  }

</style>

</head>

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->

	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
		<div class="navbar-wrapper ">
			<div class="navbar-brand header-logo">
				<a href="index.php" class="b-brand">
					<img src="images/logo.png" alt="" class="logo images" style="width: 170px;">
					<img src="assets/images/logo-icon1.png" alt="" class="logo-thumb images">
				</a>
				<span class="mobile-menu" id="mobile-collapse" style="cursor: pointer;"><span></span></span>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item">
						<a href="index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item">
						<a href="viewcustomer.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Customer</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="" class="nav-link disable-anchor"><span class="pcoded-micon"><i class="feather icon-grid"></i></span><span class="pcoded-mtext">Incoming</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="viewsalesorder.php" class="">Incoming PO</a></li>
							<li class=""><a href="viewsales.php" class="">Outgoing Invoice</a></li>
							<li class=""><a href="viewreceipt.php" class="">Receipt</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="viewvendor.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-align-left"></i></span><span class="pcoded-mtext">Vendor</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="" class="nav-link disable-anchor"><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Outgoing</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="viewpurchaseorder.php" class="">Outgoing PO</a></li>
							<li class=""><a href="viewpurchase.php" class="">Incoming Invoice</a></li>
							<li class=""><a href="viewpayment.php" class="">Payment</a></li>
						</ul>
					</li>

					<li class="nav-item pcoded-hasmenu">
						<a href="" class="nav-link disable-anchor"><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Outstandings</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="payables.php" class="">Payables</a></li><!-- payables.php -->
							<li class=""><a href="receivables.php" class="">Receivables</a></li><!-- receivables.php -->
						</ul>
					</li>
					<li class="nav-item">
						<a href="users.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Users</span></a>
					</li>	
					<li class="nav-item">
						<a href="changepassword.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Change Password</span></a>
					</li>				

				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
			<a href="index.php" class="b-brand">
				<img src="assets/images/logo1.png" alt="" class="logo images">
				<img src="assets/images/logo-icon1.png" alt="" class="logo-thumb images">
			</a>
		</div>
		<a class="mobile-menu" id="mobile-header" href="#!">
			<i class="feather icon-more-horizontal"></i>
		</a>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto">
				<li>
					<div class="dropdown drp-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon feather icon-settings"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<ul class="pro-body">
								<li><a href="logout.php" class="dropdown-item"><i class="feather icon-lock"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</header>
	

<?php

}

elseif($udetails['type']=='Sales Person')
{

?>



<!DOCTYPE html>
<html lang="en">

<head>

	<title>Purchase Order Management System</title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords"
		content="">
	<meta name="author" content="Codedthemes" />

	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">

	<!-- animation css -->
	<link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/pages/jquery.growl.css">
	<link rel="stylesheet" href="assets/css/theme.bootstrap_4.css">
<!-- users\assets\css\pages
 -->	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">

<style type="text/css">
  
  .ts-pager .btn
  {
    padding: 2px 0px;
    margin: 2px 0px;
  }

  .ts-pager .prev
  {
  	padding-top: 5px;
  }

  .ts-pager .next
  {
  	padding-top: 5px;
  	padding-left: 10px;
  }

  .table thead th
  {
  	font-size: 12px;
  	padding: 10px;
  }

  .icon-home
  {
  	color: #666;
  }

</style>

</head>

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->

	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
		<div class="navbar-wrapper ">
			<div class="navbar-brand header-logo">
				<a href="index.php" class="b-brand">
					<img src="images/logo.png" alt="" class="logo images" style="width: 170px;">
					<img src="assets/images/logo-icon1.png" alt="" class="logo-thumb images">
				</a>
				<span class="mobile-menu" id="mobile-collapse" style="cursor: pointer;"><span></span></span>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item">
						<a href="index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item">
						<a href="viewcustomer.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Customer</span></a>
					</li>

					<li class="nav-item">
						<a href="viewsalesorder.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-grid"></i></span><span class="pcoded-mtext">Incoming PO</span></a>
					</li>

					<li class="nav-item">
						<a href="changepassword.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Change Password</span></a>
					</li>

				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
			<a href="index.php" class="b-brand">
				<img src="assets/images/logo1.png" alt="" class="logo images">
				<img src="assets/images/logo-icon1.png" alt="" class="logo-thumb images">
			</a>
		</div>
		<a class="mobile-menu" id="mobile-header" href="#!">
			<i class="feather icon-more-horizontal"></i>
		</a>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto">
				<li>
					<div class="dropdown drp-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon feather icon-settings"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<ul class="pro-body">
								<li><a href="logout.php" class="dropdown-item"><i class="feather icon-lock"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</header>


<?php

}

elseif($udetails['type']='Accounts')
{


?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Purchase Order Management System</title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords"
		content="">
	<meta name="author" content="Codedthemes" />

	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">

	<!-- animation css -->
	<link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/pages/jquery.growl.css">
	<link rel="stylesheet" href="assets/css/theme.bootstrap_4.css">
<!-- users\assets\css\pages
 -->	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">

<style type="text/css">
  
  .ts-pager .btn
  {
    padding: 2px 0px;
    margin: 2px 0px;
  }

  .ts-pager .prev
  {
  	padding-top: 5px;
  }

  .ts-pager .next
  {
  	padding-top: 5px;
  	padding-left: 10px;
  }

  .table thead th
  {
  	font-size: 12px;
  	padding: 10px;
  }

  .icon-home
  {
  	color: #666;
  }

</style>

</head>

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->

	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
		<div class="navbar-wrapper ">
			<div class="navbar-brand header-logo">
				<a href="index.php" class="b-brand">
					<img src="images/logo.png" alt="" class="logo images" style="width: 170px;">
					<img src="assets/images/logo-icon1.png" alt="" class="logo-thumb images">
				</a>
				<span class="mobile-menu" id="mobile-collapse" style="cursor: pointer;"><span></span></span>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item">
						<a href="index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item">
						<a href="viewcustomer.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Customer</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="" class="nav-link disable-anchor"><span class="pcoded-micon"><i class="feather icon-grid"></i></span><span class="pcoded-mtext">Incoming</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="viewsalesorder.php" class="">Incoming PO</a></li>
							<li class=""><a href="viewsales.php" class="">Outgoing Invoice</a></li>
							<li class=""><a href="viewreceipt.php" class="">Receipt</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="viewvendor.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-align-left"></i></span><span class="pcoded-mtext">Vendor</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="" class="nav-link disable-anchor"><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Outgoing</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="viewpurchaseorder.php" class="">Outgoing PO</a></li>
							<li class=""><a href="viewpurchase.php" class="">Incoming Invoice</a></li>
							<li class=""><a href="viewpayment.php" class="">Payment</a></li>
						</ul>
					</li>

					<li class="nav-item pcoded-hasmenu">
						<a href="" class="nav-link disable-anchor"><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Outstandings</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="payables.php" class="">Payables</a></li><!-- payables.php -->
							<li class=""><a href="receivables.php" class="">Receivables</a></li><!-- receivables.php -->
						</ul>
					</li>

					<li class="nav-item">
						<a href="changepassword.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Change Password</span></a>
					</li>

				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
			<a href="index.php" class="b-brand">
				<img src="assets/images/logo1.png" alt="" class="logo images">
				<img src="assets/images/logo-icon1.png" alt="" class="logo-thumb images">
			</a>
		</div>
		<a class="mobile-menu" id="mobile-header" href="#!">
			<i class="feather icon-more-horizontal"></i>
		</a>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto">
				<li>
					<div class="dropdown drp-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon feather icon-settings"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<ul class="pro-body">
								<li><a href="logout.php" class="dropdown-item"><i class="feather icon-lock"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</header>




<?php


}

}

?>