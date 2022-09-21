<?php
include '../includes/config.php';
include 'header.php';

?>

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
												<h5 class="m-b-10">Progress</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#!">Basic Components</a></li>
												<li class="breadcrumb-item"><a href="#!">Progress</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->
							<!-- [ Main Content ] start -->
							<div class="row">
								<!-- [ progress ] start -->
								<div class="col-sm-12">
									<div class="card">
										<div class="card-header">
											<h5>Progress</h5>
										</div>
										<div class="card-body">
											<div class="progress mb-4">
												<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<div class="progress mb-4">
												<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<div class="progress mb-4">
												<div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<div class="progress mb-4">
												<div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<div class="progress mb-4">
												<div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>Labels</h5>
										</div>
										<div class="card-body">
											<div class="progress mb-4">
												<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>Height</h5>
										</div>
										<div class="card-body">
											<div class="progress mb-4" style="height: 1px;">
												<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<div class="progress mb-4" style="height: 20px;">
												<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>Backgrounds</h5>
										</div>
										<div class="card-body">
											<div class="progress mb-4">
												<div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<div class="progress mb-4">
												<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<div class="progress mb-4">
												<div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<div class="progress mb-4">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>Multiple Bars</h5>
										</div>
										<div class="card-body">
											<div class="progress mb-4">
												<div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
												<div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
												<div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
									
								</div>
								<!-- [ progress ] end -->
							</div>
							<!-- [ Main Content ] end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php

	include 'footer.php';

	?>