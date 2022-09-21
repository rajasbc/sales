<?php
include '../includes/config.php';
include 'header.php';
?>

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
                                                <h5 class="m-b-10">Morris Chart</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="#!">Chart</a></li>
                                                <li class="breadcrumb-item"><a href="#!">Morris Chart</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ breadcrumb ] end -->
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- [ bar-simple Chart ] start -->
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Bar [ Simple ] Chart</h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="morris-bar-chart" style="height:300px"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ bar-simple Chart ] end -->
                                <!-- [ bar-stacked Chart ] start -->
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Bar [ Stacked ] Chart</h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="morris-bar-stacked-chart" style="height:300px"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ bar-stacked Chart ] end -->
                                <!-- [ line-angle Chart ] start -->
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Line [ Angle ] Chart</h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="morris-area-chart" style="height:300px"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ line-angle Chart ] end -->
                                <!-- [ area-smooth Chart ] start -->
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Area [ Smooth ] Chart</h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="morris-area-curved-chart" style="height:300px"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ area-smooth Chart ] end -->
                                <!-- [ line-angle Chart ] start -->
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Line [ Angle ] Chart</h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="morris-line-chart" class="ChartShadow" style="height:300px"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ line-angle Chart ] end -->
                                <!-- [ line-smooth Chart ] start -->
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Line [ Smooth ] Chart</h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="morris-line-smooth-chart" class="ChartShadow" style="height:300px"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ line-smooth Chart ] end -->
                                <!-- [ donut-Chart ] start -->
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Donut Chart</h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="morris-donut-chart" style="height:300px"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ donut-Chart ] end -->
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

    
    <!-- chart-morris Js -->
    <script src="assets/plugins/chart-morris/js/raphael.min.js"></script>
    <script src="assets/plugins/chart-morris/js/morris.min.js"></script>
    <script src="assets/js/pages/chart-morris-custom.js"></script>
    