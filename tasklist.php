<?php
  require_once './functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Guard</title>
    <?php include("./components/icon.php"); ?>
    <!-- Google Font: Source Sans Pro -->
   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-select/css/select.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="css/Style.css">
    <!-- toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
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
            <h4 style="margin-top:.5%;">Task List</h4>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!-- Notifications Dropdown Menu -->
                <li>
                    <a class="nav-link" href="#" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus
sagittis lacus vel augue laoreet rutrum faucibus.">
                        <i class="fas fa-user"></i><i class="fa fa-caret-down" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-primary elevation-4">
            <?php include("./components/Sidebar.php"); ?>
        </aside>

        <!-- Main Content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <label for="clientName">Client Name</label>
                                <select id="clientName" class="form-control" onchange="searchTable()" style="margin-right:0.5%;width:150px">
                                    <option value="" selected>Select</option>
                                    <?php displayAllClients()?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="startDate">Start Date</label>
                                <input type="date" class="form-control" id="startDate" onchange="searchTable()" value="" style="margin-right:0.5%;width:170px">
                            </div>
                            <div class="col-auto">
                                <label for="endDate">End Date</label>
                                <input type="date" class="form-control" id="endDate" onchange="searchTable()" value="" style="margin-right:0.5%;width:170px">
                            </div>
                            <div class="col-auto">
                                <label for="endDate">Time Spent (hr:mn)</label>
                                <div class="d-flex">
                                    <input type="number" class="form-control" id="timeHr" placeholder="hr" onchange="searchTable()" value="" style="margin-right:0.5%;width:85px">
                                    <input type="number" class="form-control" id="timeMn" placeholder="mn" min="0" max="60" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;searchTable()"  value="" style="margin-right:0.5%;width:85px">
                                </div>
                            </div>
                            <div class="col-auto">
                                <label for="actDate">Task Date (Date Range)</label>
                                <!-- Start Date -->
                                <input type="text" class="form-control" id="actDate" value="" style="margin-right:0.5%;background:white;width:200px" onchange="searchTable()" readonly>
                            </div>
                            <div class="col-auto" style="margin-top: 2.5%;">
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" style="width:auto" aria-expanded="false">
                                        Clear Search
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" type="button" onclick="clearSearch(6)">All</button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(1)">Client</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(2)">Date Created</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(3)">Date Ended</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(4)">Time Spent</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(5)">Task Date</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:1%">
                            <div class="col-auto" id="beforeLD" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export All Data shown in the Table" aria-hidden="true"></i>
                            </div>
                            <div class="col-auto" id="beforeLD1" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export Selected Data shown in the Table" aria-hidden="true"></i>
                            </div>
                        </div>
                        <table id="dataTable" class="table table-bordered table-hover" style="height:100%;background-color:white">
                            <thead>
                                <tr>
                                    <th class="text-center"></th></th>
                                    <th>Task Name</th>
                                    <th>Client Name</th>
                                    <th>Notes</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Spent</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Task Name</th>
                                    <th>Client Name</th>
                                    <th>Notes</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Time Spent</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </section>
    </div>
    </div>
   <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="./plugins/jszip/jszip.min.js"></script>
  <script src="./plugins/pdfmake/pdfmake.min.js"></script>
  <script src="./plugins/pdfmake/vfs_fonts.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="./plugins/datatables-select/js/dataTables.select.min.js"></script>
  <!-- InputMask -->
  <script src="./plugins/popper/popper.js"></script>
  <script src="./plugins/moment/moment.min.js"></script>
  <script src="./plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="./plugins/daterangepicker/daterangepicker.js"></script>
  <!-- TOASTR -->
  <script src="plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <script src="js/TaskListFunctions.js"></script>
</body>

</html>