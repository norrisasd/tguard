<?php include("components/header.php"); ?>
<?php include("components/loader.php"); ?>
<!-- 
  Admin Tasks - Tasklist : 
    * User can view all the on going task types available 
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
            <h4 style="margin-top:.5%;">Tasks / Task List</h4>
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
                        <!-- <div class="row align-items-start">
                            <div class="col-sm-6">
                                <label for="clientName">Task Types</label>
                                <select id="clientName" onchange="searchTable()" class="form-control" style="margin-right:0.5%;">
                                    <option value="" selected>Select Task Types</option>
                                    <?php displayAllClients(); ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="agentName">Client</label>
                                <select id="agentName" onchange="searchTable()" class="form-control" style="margin-right:0.5%;">
                                    <option value="" selected>Select Client</option>
                                    <?php displayAllAgents(); ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="row align-items-start" style="margin-bottom: 1%; margin-top: 2.5%;">
                            <!-- <div class="col-auto" style="margin-top:1%">
                                <input type="checkbox" value="" style="margin-left:10px;" id="selectAll" onclick="selectAll(this)"> Select All
                            </div> -->
                            <div class="col-auto" id="beforeLD" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export All Data shown in the Table" aria-hidden="true"></i>
                            </div>
                            <div class="col-auto" id="beforeLD1" style="margin-right:1%;">
                                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export Selected Data shown in the Table" aria-hidden="true"></i>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskType">
                                        Add
                                    </button>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#assignUser">
                                        Assign to a User
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
                                    <th class="text-center"></th>
                                    <th>Task Type</th>
                                    <th>Client Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <td class="text-center"></td>
                            <td>Norris Hipolito</td>
                            <td>Finish Task Guard</td>
                            <td>John Doe</td>
                            <td>Lorem Ipsum</td>
                            <td>June 20, 2021 at 2:30 AM</td>
                            <td>June 20, 2021 at 2:30 PM</td>
                            <td>12 hrs</td>
                            <td> <button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-eye"></i></button>
                            </td> -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Task Type</th>
                                    <th>Client Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        </div>
        </section>
    </div>

    <!-- Modal for Add  -->
    <div class="modal fade" id="addTaskType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" onsubmit="return addTaskType();" autocomplete="off" id="addTaskTypes">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Task Type</label>
                            <input type="text" class="form-control" name="name" id="inputTaskType" placeholder="" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="inputClient">Client</label>
                            <select class="form-control" id="inputClient" required>
                                <option value="" selected hidden>Select Client</option>
                                <?php displayAllClientsEnabledValID() ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription2">Notes: </label>
                            <textarea type="text" class="form-control" id="inputNotes"></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" required>
                        </div> 
                        <div class="form-group">
                            <label for="inputDescription2">Notes: </label>
                            <textarea type="text" class="form-control" id="inputDescription2">Lorem Ipsum Lorem Ipsum</textarea>
                        </div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for View  -->
    <div class="modal fade" id="viewTaskType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTaskName">Task Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="get" id="viewTask" action="">
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-group">
                                <label for="viewTaskType">Task Type</label>
                                <input type="text" class="form-control" id="viewType" placeholder="" required />

                            </div>

                            <div class="form-group">
                                <label for="viewClient">Client</label>
                                <select class="form-control" id="viewClient" required>
                                    <option value="" selected hidden>Select Task Type</option>
                                    <?php displayAllClientsEnabledValID() ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription2">Notes: </label>
                                <textarea type="text" class="form-control" id="viewNotes"></textarea>
                            </div>
                            <!-- 
                            <div class="form-group">
                                <label for="inputDescription2">Notes: </label>
                                <textarea type="text" class="form-control" id="inputDescription2">Lorem Ipsum Lorem Ipsum</textarea>
                            </div>
                            

                            <div class="form-group">
                                <label for="inputSubTasks">Sub-Tasks: </label>
                                <textarea type="text" class="form-control" id="inputSubTasks"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputComments">Comments: </label>
                                <textarea type="text" class="form-control" id="inputComments"></textarea>
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-danger mr-auto" id="btnDelete">Delete</button> -->
                            <button type="button" class="btn btn-danger mr-auto" id="btnDelete">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assignUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task Type</h5>
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
                                <?php displayAllTaskType() ?>
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
    <script src="./js/TaskListFunctions.js"></script>
    <script src="./js/Main.js"></script>
    <script>
        function resetTaskTypeOption() {
            $("#assignTaskType").html('<option value="" selected hidden>Select Task Type</option>' + '<?php echo displayAllTaskType() ?>');
            $('#assignClient').val("");
        }
    </script>


</body>

</html>