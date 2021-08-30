<?php include("components/header.php"); ?>

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
            <h4 style="margin-top:.5%;">Users / Employee</h4>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table id="dataTable" class="table table-bordered table-hover" style="height:100%;background-color:white">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Employee Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Access</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <td><button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#userInfo"><i class="fas fa-eye"></i></button> -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Employee Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Access</th>
                                    <th></th>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="nav-icon fas fa-user"></i> Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" onsubmit="return addUser();" autocomplete="off" id="addUserModal">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="text" class="form-control" name="name" id="username" placeholder="" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="ex ampleFormControlInput1">Password</label>
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Access</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioBtnType" value="1" id="adminRadioBtn" required>
                                <label class="form-check-label" for="adminRadioBtn">
                                    Admin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="radioBtnType">
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



    <!-- Modal for Employee Information -->
    <div class="modal fade" id="userInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit"></i>Employee Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" onsubmit="return editUserInfo();">
                        <div id="editInfoBody">
                            <dl class="row">
                                <dt class="col-sm-3">Username: </dt>
                                <dd class="col-sm-9">Norris</dd>

                                <dt class="col-sm-3">Password: </dt>
                                <dd class="col-sm-9">norris</dd>

                                <dt class="col-sm-3">Email: </dt>
                                <dd class="col-sm-9">norris@gmail</dd>

                                <dt class="col-sm-3">User Access: </dt>
                                <dd class="col-sm-9">Employee</dd>
                            </dl>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success mr-auto" data-toggle="modal" data-target="#editInfo">Edit Information</button>
                    <a href="#" target="_blank" data-toggle="modal" data-target="#changeAccess" style="color:#0645AD;">Change Access</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for Edit Employee Information -->
    <div class="modal fade" id="editInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="nav-icon fas fa-user"></i>Edit Employee Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" onsubmit="" autocomplete="off" id="addUserModal">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="text" class="form-control" name="name" id="username" placeholder="" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="ex ampleFormControlInput1">Password</label>
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Change Access -->
    <div class="modal fade" id="changeAccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Access</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="margin:auto">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="caradioBtnType" value="1" id="radAdm" required>
                            <label class="form-check-label" for="radAdm">
                                Admin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="caradioBtnType" id="radAge">
                            <label class="form-check-label" for="radAge">
                                Employee
                            </label>
                        </div>
                        <!-- <div class="form-check">
                            <input class="form-check-input" type="radio" value="NULL" name="caradioBtnType" id="radMod">
                            <label class="form-check-label" for="radMod">
                                MODERATOR
                            </label>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="updateAccess()" class="btn btn-primary" id="btnAccess">Save changes</button>
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
    <script src="../plugins/popper/popper.js"></script>
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- TOASTR -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <script>
        $(".mt-2 ul li").removeClass("menu-open");
        $(".mt-2 ul li a").removeClass("active");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(1)").removeClass("menu-open");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(1) a").removeClass("active");
        $(".mt-2 ul li:nth-child(4) ul li:nth-child(1)").addClass("menu-open");
        $(".mt-2 ul li:nth-child(4) ul li:nth-child(1) a").addClass("active");
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
                getAgentsJSON: true
            },
            success: function(response) {
                data = JSON.parse(response);
                dt.clear().draw();
                for (var da in data) {
                    access = data[da].access == '2' ? "Agent" : "Admin";
                    dt.row.add([
                        cb,
                        data[da].name,
                        data[da].phone,
                        data[da].email,
                        data[da].username,
                        access,
                        data[da].access,
                    ]).draw();
                }
            }
        })
    </script>

</body>

</html>