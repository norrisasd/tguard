<!-- 
  Admin Form Task Type: 
    * Contains the table of all present and past task type and can create, view, edit and delete task types. 
-->

<?php include("components/header.php"); ?>
<?php include("components/loader.php"); ?>

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
            <h4 style="margin-top:.5%;">Forms / Task Types</h4>
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
                                        <button class="dropdown-item" type="button" onclick="clearSearch(2)">Client</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-start" style="margin-bottom: 1%; margin-top: 2.5%;">
                            <div class="col-auto" style="margin-top:1%">
                                <input type="checkbox" value="" style="margin-left:10px;" id="selectAll" onclick="selectAll(this)"> Select All
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-success">
                                    Export
                                </button>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskType">
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
                                    <th class="text-center"></th>
                                    <th>Task Type</th>
                                    <th>Client Name</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td><a href="#" class="table" onclick="" data-toggle="modal" data-target="#userInfo"></a></td>
                                <td>norris@gmail.com</td>
                                <td>2</td>
                                <td><button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#viewTaskType"><i class="fas fa-eye"></i></button>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Task Type</th>
                                    <th>Client Name</th>
                                    <th></th>
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
                    <h5 class="modal-title" id="modalTaskName">Add Task Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="get" id="viewTask" action="">
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-group">
                                <label for="inputTaskType">Task Type</label>
                                <input type="text" class="form-control" id="inputTaskType" placeholder="" required />

                            </div>

                            <div class="form-group">
                                <label for="inputClient">Client</label>
                                <select class="form-control" id="inputClient" required>
                                    <option value="" selected hidden>Select Task Type</option>
                                    <?php displayAllClients() ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputDescription2">Notes: </label>
                                <textarea type="text" class="form-control" id="inputDescription2">Lorem Ipsum Lorem Ipsum</textarea>
                            </div>

                            <!-- <div class="form-group">
                                <label for="inputSubTasks">Sub-Tasks: </label>
                                <textarea type="text" class="form-control" id="inputSubTasks"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputComments">Comments: </label>
                                <textarea type="text" class="form-control" id="inputComments"></textarea>
                            </div>  -->

                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-danger mr-auto" id="btnDelete">Delete</button> -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                        </div>
                    </div>
                </form>
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
                                <label for="inputTaskType">Task Type</label>
                                <input type="text" class="form-control" id="inputTaskType" placeholder="" required />

                            </div>

                            <div class="form-group">
                                <label for="inputClient">Client</label>
                                <select class="form-control" id="inputClient" required>
                                    <option value="" selected hidden>Select Task Type</option>
                                    <?php displayAllClients() ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputDescription2">Notes: </label>
                                <textarea type="text" class="form-control" id="inputDescription2">Lorem Ipsum Lorem Ipsum</textarea>
                            </div>

                            <!-- <div class="form-group">
                                <label for="inputSubTasks">Sub-Tasks: </label>
                                <textarea type="text" class="form-control" id="inputSubTasks"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputComments">Comments: </label>
                                <textarea type="text" class="form-control" id="inputComments"></textarea>
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mr-auto" id="btnDelete">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                        </div>
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

    <script>
        $(".mt-2 ul li").removeClass("menu-open");
        $(".mt-2 ul li a").removeClass("active");
        $(".mt-2 ul li:nth-child(4) ul li:nth-child(1)").removeClass("menu-open");
        $(".mt-2 ul li:nth-child(4) ul li:nth-child(1) a").removeClass("active");
        $(".mt-2 ul li:nth-child(4) ul li:nth-child(2)").addClass("menu-open");
        $(".mt-2 ul li:nth-child(4) ul li:nth-child(2) a").addClass("active");
        var dt = $('#dataTable').DataTable({
            "oLanguage": {
                "sLengthMenu": "Show Entries _MENU_",
            },
            dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-6'l><'col-sm-2'i><'col-md-4'p>>",
            "pageLength": 10,
            "order": [],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "className": "text-center select-checkbox",
            }, {
                "targets": 6,
                "orderable": false,
                "className": "text-center",
            }],
            select: {
                style: 'multi',
                selector: 'tr>td:nth-child(1)'
            },
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["excel", "pdf", "print", ]
        });
        dt.buttons().container().appendTo('#beforeLD');
        new $.fn.dataTable.Buttons(dt, {
            "buttons": [{
                extend: 'excel',
                text: 'Excel Selected',
                exportOptions: {
                    modifier: {
                        selected: true
                    }
                },
            }, {
                extend: 'pdf',
                text: 'PDF Selected',
                exportOptions: {
                    modifier: {
                        selected: true
                    }
                },
            }, {
                extend: 'print',
                text: 'Print Selected',
                exportOptions: {
                    modifier: {
                        selected: true
                    }
                },
            }]
        }).container().appendTo('#beforeLD1');
        var cb = "";
        $.ajax({
            type: 'get',
            url: './main.php',
            data: {
                getClientsJSON: true
            },
            success: function(response) {
                data = JSON.parse(response);
                dt.clear().draw();
                for (var da in data) {
                    btn = `<button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#userInfo"><i class="fas fa-eye"></i></button>`;
                    dt.row.add([
                        cb,
                        data[da].ClientName,
                        data[da].phone,
                        data[da].email,
                        data[da].email,
                        data[da].email,
                        btn,
                    ]).draw();
                }
            }
        })
    </script>

</body>

</html>