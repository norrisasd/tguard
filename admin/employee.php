<?php include("components/header.php"); ?>
<?php include("components/loader.php"); ?>
<!-- 
  Admin Form - Employee: 
    * Create, read, update and delete employee  
    * Contains a table of all the employee
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
            <h4 style="margin-top:.5%;">Forms / Employee</h4>
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
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-sm-6">
                                <label for="employeeName">Employee</label>
                                <select id="employeeName" onchange="searchEmployee(this.value)" class="form-control" style="margin-right:0.5%;">
                                    <option value="" selected>All</option>
                                    <?php displayAllAgentsName(); ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="status">Status</label>
                                <select id="status" onchange="searchStatus(this.value)" class="form-control" style="margin-right:0.5%;">
                                    <option value="" selected>All</option>
                                    <option value="Active">Active</option>
                                    <option value="Archive">Archive</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="row justify-content-end" style="margin-top:2%;">
                            <div class="col-auto">
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" style="width:auto" aria-expanded="false">
                                        Clear Search
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" type="button" onclick="clearSearch(6)">All</button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(1)">Employee</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(2)">Status</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row align-items-start" style="margin-bottom: 1%; margin-top: 2.5%;">
                            <div class="col-auto" id="beforeLD" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export All Data shown in the Table" aria-hidden="true"></i>
                            </div>
                            <div class="col-auto" id="beforeLD1" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export Selected Data shown in the Table" aria-hidden="true"></i>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
                                        Add
                                    </button>
                                </div>
                            </div>
                            <div class="btn-group dropright">
                                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#assignUser">
                                    Assign to a User
                                </button>
                            </div>
                            <div class="col"> </div>
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
                                    <th class="text-center"><input type="checkbox" onchange="
                                        if(this.checked)
                                            dt.rows().select();
                                        else
                                            dt.rows().deselect();
                                    "></th>
                                    <th>Employee Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Phone</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <td><button class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal" data-target="#accessUser">Access</button></td> -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Employee Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Phone</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                    <!-- <td><button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#userInfo"><i class="fas fa-eye"></i></button></td> -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal for Add Employee -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" onsubmit="return addUser();" autocomplete="off" id="addUserModal">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Employeee Name</label>
                            <input type="text" class="form-control" id="name" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="ex ampleFormControlInput1">Password</label>
                            <input type="password" class="form-control" id="password" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" id="email" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone</label>
                            <input type="text" class="form-control" id="phone" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Access</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioBtnType" value="1" required>
                                <label class="form-check-label" for="adminRadioBtn">
                                    Admin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="2" name="radioBtnType">
                                <label class="form-check-label" for="employeeBtn">
                                    Employee
                                </label>
                            </div>
                            <!-- <div class="form-check">
                                <input class="form-check-input" type="radio" value="NULL" name="radioBtnType">
                                <label class="form-check-label" for="moderatorRadioBtn">
                                    MODERATOR
                                </label>
                            </div> -->
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for View Employee -->
    <div class="modal fade" id="viewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Employee Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Employeee Name</label>
                        <input type="text" class="form-control" id="viewName" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Username</label>
                        <input type="text" class="form-control" id="viewUsername" placeholder="" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="ex ampleFormControlInput1">Password</label>
                        <input type="password" class="form-control" id="viewPassword" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" id="viewEmail" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Phone</label>
                        <input type="text" class="form-control" id="viewPhone" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Access</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="viewRadioBtnType" value="1" id="viewAdminRadioBtn" required>
                            <label class="form-check-label" for="adminRadioBtn">
                                Admin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="2" name="viewRadioBtnType" id="viewAgentRadioBtn">
                            <label class="form-check-label" for="employeeBtn">
                                Employee
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Status</label>
                        <select class="form-control" id="inputStatus">
                            <option value="1" selected>Active</option>
                            <option value="0">Archived</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info mr-auto" id="btnArchive">Archive</button>
                    <button type="button" class="btn btn-info mr-auto" id="btnActive" style="display:none">Activate</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Access Employee -->
    <div class="modal fade" id="accessUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Access</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table table-hover" id="accessTable">
                        <thead>
                            <tr>
                                <th>Task Types</th>
                                <th>Access</th>
                            </tr>
                        </thead>
                        <tbody id="accessBody">
                            <tr>
                                <td>Agrisoft</td>
                                <td> <select id="accessType" class="form-control" style="margin-right:0.5%;">
                                        <option value="" selected>Select Access Type</option>
                                        <?php displayAllClients(); ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="assignUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Task Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" onsubmit="return assignUser();" autocomplete="off" id="assignUserForm">
                        <div class="form-group">
                            <label for="inputClient">Agent</label>
                            <select class="form-control" onchange="setTaskTypeOptions(this.value)" id="assignAgent" required>
                                <option value="" selected hidden>Select Agent</option>
                                <?php displayAllAgents() ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="assignTaskType">Task Type</label>
                            <select class="form-control" onchange="setInputClientView(this.value)" id="assignTaskType" required>
                                <option value="" selected hidden>Select Task Type</option>
                                <?php displayAllTaskTypeEnabled() ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="assignClient">Client</label>
                            <select class="form-control" id="assignClient" disabled>
                                <option value="" selected hidden>Select Client</option>
                                <?php displayAllClientsValID() ?>
                            </select>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
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
    <script src="../plugins/popper/umd/popper.js"></script>
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- TOASTR -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <script src="./js/Main.js"></script>
    <script src="./js/EmployeeFunctions.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script>
        function resetTaskTypeOption() {
            $("#assignTaskType").html('<option value="" selected hidden>Select Task Type</option>' + '<?php echo displayAllTaskTypeEnabled() ?>');
            $('#assignClient').val("");
        }
    </script>
</body>

</html>