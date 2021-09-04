<!-- 
  Agent Reports
    * Contain a report of all completed tasks with the flags
-->

<?php include("./components/header.php"); ?>
<?php include("./components/loader.php"); ?>

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
            <h4 style="margin-top:.5%;">Reports </h4>
            <!-- Right navbar links -->
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
                        <div class="row align-items-start">
                            <div class="col-sm-6">
                                <label for="clientName">Client</label>
                                <select id="clientName" class="form-control" onclick="searchTable()" style="margin-right:0.5%;">
                                    <option value="" selected>Select</option>
                                    <?php displayAllClients() ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="startDate">Start Date</label>
                                <input type="date" class="form-control" id="startDate" onclick="searchTable()" value="" style="margin-right:0.5%;">
                            </div>
                            <div class="col-sm-3">
                                <label for="endDate">End Date</label>
                                <input type="date" class="form-control" id="endDate" onclick="searchTable()" value="" style="margin-right:0.5%;">
                            </div>

                        </div>
                        <div class="row" style="margin-top: 1%;">
                            <!-- <div class="col-sm-3">
                                <label for="dueDate">Due Date</label>
                                <input type="date" class="form-control" id="dueDate" onclick="searchTable()" value="" style="margin-right:0.5%;">
                            </div> -->
                            <div class="col-sm-6">
                                <label for="actDate">Task Date (Date Range)</label>
                                <!-- Start Date -->
                                <input type="text" class="form-control" onclick="searchTable()" id="actDate" value="" style="margin-right:0.5%;background:white;" readonly>
                            </div>
                            <div class="col-sm-3">
                                <label for="taskType">Task Type</label>
                                <select id="taskType" class="form-control" onclick="searchTable()" style="margin-right:0.5%;">
                                    <option value="" selected>Select Task Type</option>
                                    <?php displayAllClients() ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="flagType">Flag Type</label>
                                <select id="flagType" class="form-control" onclick="searchTable()" style="margin-right:0.5%;">
                                    <option value="" selected>Select Flag Type</option>
                                    <?php displayAllClients() ?>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-auto" style="margin-top: 1%;">
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" style="width:auto" aria-expanded="false">
                                        Clear Search
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" type="button" onclick="clearSearch(7)">All</button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(1)">Client</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(2)">Start Date</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(3)">End Date</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(4)">Task Date</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(5)">Task Type</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(6)">Flag Type</button>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Table Starts-->
                        <div class="row" style="margin-top:1%; margin-bottom:1%">
                            <div class="col-auto" id="beforeLD" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export All Data shown in the Table" aria-hidden="true"></i>
                            </div>
                            <div class="col-auto" id="beforeLD1" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export Selected Data shown in the Table" aria-hidden="true"></i>
                            </div>
                            <div class="col"></div>
                            <div class="col-auto">
                                <div class="input-group rounded" id="beforeLD2" style="margin-right:1%;">
                                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" id="searchInputTable" onkeyup="dt.search( this.value ).draw();">
                                    <span class="input-group-text border-0" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <table id="dataTable" class="table table-bordered table-hover" style="height:100%;background-color:white">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Flag Type</th>
                                    <th>Task Name</th>
                                    <th>Task Type</th>
                                    <th>Client</th>
                                    <th>Notes</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Spent</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Flag Type</th>
                                    <th>Task Name</th>
                                    <th>Task Type</th>
                                    <th>Client</th>
                                    <th>Notes</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Time Spent</th>
                                    <th></th>
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