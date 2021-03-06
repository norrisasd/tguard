<?php include("components/header.php"); ?>
<?php include("components/loader.php"); ?>
<!-- 
  Admin Charts: 
    * Contain charts of all the data in both employee and client
-->


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="loaderB" id="logoloader" style="position:absolute;z-index:5;display:none">
        <div class="loader" style="margin:20% 50%"></div>
    </div>
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

        //Just using the old data in the config
        //to change the data just change the config
        var chartWeek = new Chart(
            document.getElementById('chartWeek'),
            config

        );

        //Area Chart
        var ctx = document.getElementById("chartHour").getContext("2d");

        const colors = {
            green: {
                fill: '#e0eadf',
                stroke: '#5eb84d',
            },
            lightBlue: {
                stroke: '#6fccdd',
            },
            darkBlue: {
                fill: '#92bed2',
                stroke: '#3282bf',
            },
            purple: {
                fill: '#8fa8c8',
                stroke: '#75539e',
            },
        };

        const loggedIn = [26, 36, 42, 38, 40, 30, 12];
        const available = [34, 44, 33, 24, 25, 28, 25];
        const availableForExisting = [16, 13, 25, 33, 40, 33, 45];
        const unavailable = [5, 9, 10, 9, 18, 19, 20];
        const xData = [13, 14, 15, 16, 17, 18, 19];

        const chartHour = new Chart(ctx, {
            type: 'line',
            data: {
                labels: xData,
                datasets: [{
                    label: "Unavailable",
                    fill: true,
                    backgroundColor: colors.purple.fill,
                    pointBackgroundColor: colors.purple.stroke,
                    borderColor: colors.purple.stroke,
                    pointHighlightStroke: colors.purple.stroke,
                    borderCapStyle: 'butt',
                    data: unavailable,

                }, {
                    label: "Available for Existing",
                    fill: true,
                    backgroundColor: colors.darkBlue.fill,
                    pointBackgroundColor: colors.darkBlue.stroke,
                    borderColor: colors.darkBlue.stroke,
                    pointHighlightStroke: colors.darkBlue.stroke,
                    borderCapStyle: 'butt',
                    data: availableForExisting,
                }, {
                    label: "Available",
                    fill: true,
                    backgroundColor: colors.green.fill,
                    pointBackgroundColor: colors.lightBlue.stroke,
                    borderColor: colors.lightBlue.stroke,
                    pointHighlightStroke: colors.lightBlue.stroke,
                    borderCapStyle: 'butt',
                    data: available,
                }, {
                    label: "Logged In",
                    fill: true,
                    backgroundColor: colors.green.fill,
                    pointBackgroundColor: colors.green.stroke,
                    borderColor: colors.green.stroke,
                    pointHighlightStroke: colors.green.stroke,
                    data: loggedIn,
                }]
            },
            options: {
                responsive: true,
                // Can't just just `stacked: true` like the docs say
                scales: {
                    yAxes: [{
                        stacked: true,
                    }]
                },
                animation: {
                    duration: 750,
                },
            }
        });

        $(".mt-2 ul li").removeClass("menu-open");
        $(".mt-2 ul li a").removeClass("active");
        $(".mt-2 ul li:nth-child(3)").addClass("menu-open");
        $(".mt-2 ul li:nth-child(3) a").removeClass("active");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(3)").addClass("menu-open");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(3) a").addClass("active");
    </script>


</body>

</html>