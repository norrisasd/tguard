<?php include("components/header.php"); ?>
<?php include("components/loader.php"); ?>
<!-- 
  Admin Form Flag Type: 
    * Contains the table of all flag type and can create, view, edit and delete flag types. 
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
            <h4 style="margin-top:.5%;">Forms / Flag Types</h4>
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
                                <label for="clientName">Flag Types</label>
                                <select id="clientName" onchange="dt.columns(1).search( this.value ).draw();" class="form-control" style="margin-right:0.5%;">
                                    <option value="" selected>Select Flag Types</option>
                                    <?php displayAllFlagType(); ?>
                                </select>
                            </div>

                        </div>
                        <div class="row align-items-start" style="margin-bottom: 1%; margin-top: 2.5%;">
                            <div class="col-auto">
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFlagType">
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
                                    <th>Flag Type</th>
                                    <!-- <th>Color</th>
                                    <th>Background Color</th> -->
                                    <th>Notes</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Flag Type</th>
                                    <!-- <th>Color</th>
                                    <th>Background Color</th> -->
                                    <th>Notes</th>
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
    <div class="modal fade" id="addFlagType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTaskName">Add Flag Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="get" id="viewTask" onsubmit="return addFlagType()" action="">
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-group">
                                <label for="inputTaskType">Flag Type</label>
                                <input type="text" class="form-control" id="inputFlagType" placeholder="" required />

                            </div>


                            <div class="form-group">
                                <label for="inputNotes">Notes: </label>
                                <textarea type="text" class="form-control" id="inputNotes"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="textColor">Text Color: </label>
                                <div class="input-group my-colorpicker1">
                                    <input type="text" class="form-control" id="textColor">

                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="textColor">Background Color: </label>
                                <div class="input-group my-colorpicker2">
                                    <input type="text" class="form-control" id="backColor">

                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                </div>
                            </div>



                            <!--
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
                    <h5 class="modal-title" id="modalTaskName">Flag Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="get" id="viewTask" action="">
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-group">
                                <label for="viewFlagType">Flag Type</label>
                                <input type="text" class="form-control" id="viewFlagType" placeholder="" required />

                            </div>


                            <div class="form-group">
                                <label for="viewNotes">Notes: </label>
                                <textarea type="text" class="form-control" id="viewNotes"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="textColor">Text Color: </label>
                                <div class="input-group my-colorpicker3">
                                    <input type="text" class="form-control" id="viewTextColor">

                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textColor">Background Color: </label>
                                <div class="input-group my-colorpicker4">
                                    <input type="text" class="form-control" id="viewBackColor">

                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="output">Output </label>
                                <input type="text" class="form-control" style="color: #FFFFFF; background-color: #FFFFF; font-weight: bold;" id="output" value="Sample Text" disabled>

                            </div>


                            <!-- <div class="form-group">
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
    <script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="./js/Main.js"></script>
    <script src="./js/FlagType.js"></script>


    <script>

    </script>

</body>

</html>