<?php include("components/header.php"); ?>
<?php include("components/loader.php"); ?>
<!-- 
  Admin Form - Client: 
    * Create, read, update and delete clients  
    * Contains a table of all the clients
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
            <h4 style="margin-top:.5%;">Forms / Clients</h4>
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
                                <label for="clientName">Client</label>
                                <select id="clientName" onchange="searchTable()" class="form-control" style="margin-right:0.5%;">
                                    <option value="" selected>Select Client</option>
                                    <?php displayAllClients(); ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="status">Status</label>
                                <select id="status" onchange="searchTable()" class="form-control" style="margin-right:0.5%;">
                                    <option value="" selected hidden>Select Status</option>
                                    <option value="">Active</option>
                                    <option value="">Archive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-end" style="margin-top:2%;">
                            <div class="col-auto">
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" style="width:auto" aria-expanded="false">
                                        Clear Search
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" type="button" onclick="clearSearch(6)">All</button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(1)">Task Type</button>
                                        <button class="dropdown-item" type="button" onclick="clearSearch(2)">Status</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-start" style="margin-bottom: 1%; margin-top: 2.5%;">
                            <div class="col-auto" id="beforeLD" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export All Data shown in the Table" aria-hidden="true"></i>
                            </div>
                            <div class="col-auto" id="beforeLD1" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export Selected Data shown in the Table" aria-hidden="true"></i>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addClient">
                                        Add
                                    </button>
                                </div>
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
                                    <th class="text-center"><input type="checkbox" onchange="
                                        if(this.checked)
                                            dt.rows().select();
                                        else
                                            dt.rows().deselect();
                                    "></th>
                                    <th>Client</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Date Created</th>
                                    <th>No. of Tasks</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td><a href="#" class="table" onclick="" data-toggle="modal" data-target="#userInfo">Norris Hipolito</a></td>
                                <td>norris@gmail.com</td>
                                <td>Client</td>
                                <td>June 5, 2017</td>
                                <td>2</td>
                                <td>Active</td>
                                <td><button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#viewClient"><i class="fas fa-eye"></i></button>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Client</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Date Created</th>
                                    <th>No. of Tasks</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>
        </div>
        </section>
    </div>
    </div>
    </section>
    </div>
    </div>


    <!-- Modal for Add Client -->
    <div class="modal fade" id="addClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" onsubmit="return addClient();" autocomplete="off" id="">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Client Name</label>
                            <input type="text" class="form-control" id="clientname" placeholder="" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" id="clientemail" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone</label>
                            <input type="text" class="form-control" id="clientphone" autocomplete="off" required>
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


    <!-- Modal for Client Information -->
    <div class="modal fade" id="viewClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Client Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" autocomplete="off" id="">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Client Name</label>
                            <input type="text" class="form-control" id="viewName" placeholder="" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone</label>
                            <input type="text" class="form-control" id="viewPhone" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" id="viewEmail" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Status</label>
                            <select class="form-control" id="inputStatus">
                                <option value="" selected>Active</option>
                                <option value="">Archived</option>
                            </select>
                        </div>

                        <!-- <div class="form-group">
                            <label class="form-label">Access</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" <?php echo $userinfo['access'] == 1 ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Enabled
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" <?php echo $userinfo['access'] == 2 ? "checked" : "" ?>>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Disabled
                                </label>
                            </div>
                        </div> -->
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger mr-auto" id="btnDelete">Delete</button> -->
                    <button type="button" class="btn btn-info mr-auto" id="btnArchive">Archive</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                </div>

                </form>
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
    <script src="../plugins/popper/popper.js"></script>
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- TOASTR -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <script src="./js/Main.js"></script>

    <script src="./js/ClientsFunctions.js"></script>

</body>

</html>