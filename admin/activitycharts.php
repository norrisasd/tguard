<?php
require_once '../functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Guard</title>
    <link rel="icon" href="../dist/img/logo.png">
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-select/css/select.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="../css/Style.css">
    <!-- toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color:black!important"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="../index.php" class="nav-link">Home</a>
        </li> -->
            </ul>
            <h4 style="margin-top:.5%;">Reports / User Activity Charts</h4>
            <!-- Right navbar links -->

        </nav>
        <aside class="main-sidebar sidebar-primary elevation-4">
            <?php include("components/SidebarAdmin.php"); ?>
        </aside>

        <!-- Main Content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="card-body">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">User Time By Day</h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-body">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Users Time By Week</h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chartWeek"></canvas>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Users Activity Report By Hour - Day View</h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="chartHour"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
    </section>
    </div>
    </div>
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="../plugins/datatables-select/js/dataTables.select.min.js"></script>
    <!-- InputMask -->
    <script src="../plugins/popper/popper.js"></script>
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- TOASTR -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <script src="../js/TaskListFunctions.js"></script>

    <!-- Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }],
            options: {
                responsive: true,
                maintainAspectRatio: false,

            }
        };
        const config = {
            type: 'doughnut',
            data: data,
        };


        var myChart = new Chart(
            document.getElementById('myChart'),
            config

        );

        var chartWeek = new Chart(
            document.getElementById('chartWeek'),
            config

        );
   
        $(".mt-2 ul li").removeClass("menu-open");
        $(".mt-2 ul li a").removeClass("active");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(1)").removeClass("menu-open");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(1) a").removeClass("active");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(2)").addClass("menu-open");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(2) a").addClass("active");
    </script>

</body>

</html>