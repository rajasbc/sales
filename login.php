<!DOCTYPE html>
<html lang="en">

<head>

	<title>Purchase Order Management System</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Codedthemes" />

	<!-- Favicon icon -->
	<link rel="icon" href="users/assets/images/favicon.ico" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="users/assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<!-- animation css -->
	<link rel="stylesheet" href="users/assets/plugins/animation/css/animate.min.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="users/assets/css/style.css">


<style type="text/css">
	
.form-control
{
	font-size: 12px;
}

</style>

</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content container">
		<div class="card" style="background: #ffffffeb;">
			<!-- <div class="row align-items-center">
				<div class="col-md-6"> -->
					<div class="card-body">
						<form id="parent">
						<!-- <img src="assets/images/logo-dark.png" alt="" class="img-fluid mb-4"> -->
						
						<center><img src="users/assets/logo.png" width="200" /></center>

						<div class="mt-4" style="text-align:center;">
						
						<div class="text-danger" id="errorTxt3"></div>
						
						<h3 style="text-align:center;">Purchase Order Management System</h3>
						<h6 class="mb-3 f-w-400 mt-2">To signin enter your username and password</h6>

						<div class="input-group input-group-lg mb-2 mt-4" style="background-color:#fff;">

							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-user"></i></span>
							</div>
							<input type="email" id="username"class="form-control" placeholder="Email address or Username" style="background-color:#fff; font-size: 17px;">
						</div>
						<div class="input-group input-group-lg mb-3" style="background-color:#fff;">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-lock"></i></span>
							</div>
							<input type="password" id="password" class="form-control" placeholder="Password" style="background-color:#fff; font-size: 17px;">
						</div>
						
						<!-- <div class="form-group text-left mt-2">
							<div class="checkbox checkbox-primary d-inline">
								<input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
								<label for="checkbox-fill-a1" class="cr"> Save credentials</label>
							</div>
						</div> -->
						<button class="btn btn-warning mb-4" id="login_btn" style="font-weight:bold;">SIGN IN &nbsp; <i class="fas fa-arrow-alt-circle-right mt-1"></i></button>
						</div>
						<!-- <p class="mb-2 text-muted">Forgot password? <a href="#" class="f-w-400">Reset</a></p>
						<p class="mb-0 text-muted">Don’t have an account? <a href="signup.php" class="f-w-400">Signup</a></p> -->
						</form>
					</div>
				<!-- </div> -->
				<!-- <div class="col-md-6 d-none d-md-block">
					<img src="users/assets/images/sign-bg.jpg" alt="" class="img-fluid">
				</div> -->
			<!-- </div> -->
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="users/assets/js/vendor-all.min.js"></script>
<script src="users/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

	$('#parent').on('keydown', '#input', function (e) {
    var key = e.which;
    if(key == 13) {
        // alert("enter");
        $('#login_btn').click();
        // return false;
    }
});

	$('#login_btn').click(function(){

		
		var $btn = $(this);
                       // alert('hi');
                      // var username=$('#username').val();
                       //alert(username);
                       if($('#username').val()==""){
                       	$('#username').css("border","1px solid red");
                       	$('#username').focus();
                       	return false
                       }
                       else{
                       	$('#username').css("border","1px solid lightgray");
                       }
                       if($('#password').val()==""){
                       	$(".errorTxt").html("Please Enter Your Password");
                       	$('#password').css("border","1px solid red");
                       	$('#password').focus();
                       	return false

                       }
                       else{
                       	$('#password').css("border","1px solid lightgray");
                       }
                       var username=$("#username").val();
                       var password=$("#password").val();
                       $btn.button('loading');
                       $.ajax({
                       	type: "POST",
                       	dataType:"json",
                       	url: 'users/ajaxCalls/loginCheck.php',
                       	data: {"username": username,"password":password},
                       	success: function(res){
                       		if(res.status=='success'){
                       			window.location='users/index.php';
                       		}
                       		if(res.status=='failed'){
                       			// window.location='index.php';
                       			$("#errorTxt3").html("Username or Password are incorrect");
                       			$("#username").val('');
                       			$("#password").val('');
                       		}
                       		
                       	}

                       });
                       return false;
                   });
               </script>





           </body>

           </html>