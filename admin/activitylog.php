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
            <h4 style="margin-top:.5%;">Reports / User Activity Log</h4>
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
                                <label for="clientName">Client Name</label>
                                <select id="clientName" class="form-control" style="margin-right:0.5%;">
                                    <option value="" selected>Select Client</option>
                                    <?php displayAllClients(); ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="agentName">Agent Name</label>
                                <select id="agentName" class="form-control" style="margin-right:0.5%;">
                                    <option value="" selected>Select Agent</option>
                                    <?php displayAllAgents(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="row " style="margin-top: 1%;">
                            <div class="col-sm-6">
                                <label for="taskName">Task Name</label>
                                <select id="taskName" class="form-control" style="margin-right:0.5%; ">
                                    <option value="" selected>Select Task</option>
                                    <?php displayAllTasks(); ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="startDate">Start Date</label>
                                <input type="date" class="form-control" id="startDate" value="" style="margin-right:0.5%;">
                            </div>
                            <div class="col-sm-3">
                                <label for="endDate">End Date</label>
                                <input type="date" class="form-control" id="endDate" value="" style="margin-right:0.5%;">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-auto" style="margin-top: 2.5%;">
                                <button type="button" class="btn btn-primary" id="btnSearch" style="padding-left:35px; padding-right:35px;">
                                    Search
                                </button>
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
                    </div>
                    <!-- Table Starts -->

                    <div class="row" style="margin-top:1%; margin-bottom:1%">
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
                                <th class="text-center"></th>
                                </th>
                                <th>Task Name</th>
                                <th>Client Name</th>
                                <th>Agent Name</th>
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
                                <th>Task Name</th>
                                <th>Client Name</th>
                                <th>Agent Name</th>
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
    <!-- MODAL FOR VIEW -->
    <div class="modal fade bd-example-modal-lg" id="" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTaskName">Title of Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="get" id="viewTask" action="">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col">
                  <label for="modalStartDate">Start Date: </label>
                  <p id="modalStartDate">June 8, 2021 at 11:00 PM</p>
                </div>
                <div class="col">
                  <label for="modalEndDate">End Date: </label>
                  <p id="modalEndDate">June 8, 2021 at 11:00 PM</p>
                </div>
                <div class="col">
                  <label for="modalTimeSpent">Time Spent: </label>
                  <p id="modalTimeSpent">18 mins</p>

                </div>
                <div class="col">
                  <div class="float-right">
                    <button type="button" class="btn btn-outline-success btn-sm" style="margin-right: 2px;" id="btnPlay"><i class="fas fa-play"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" style="margin-right: 2px;" id="btnPause"><i class="fas fa-pause"></i></button>
                    <button type="button" class="btn btn-outline-danger btn-sm" id="btnStop"><i class="fas fa-stop"></i></button>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <label for="modalClient">Client: </label>
                  <p id="modalClient">Agrisoft</p>
                </div>
                <div class="col">
                  <label for="modalAgent">Agent: </label>
                  <p id="modalAgent">John Doe</p>
                </div>
                <div class="col ">
                  <div class="float-right">
                    <button type="button" class="btn btn-primary mr-auto" id="btnFinish" style="min-width: 102px;">Finish</button>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <hr class="mt-2 mb-3" />
                  <div class="form-group">
                    <label for="inputDescription2">Notes: </label>
                    <textarea type="text" class="form-control" id="inputDescription2">Lorem Ipsum Lorem Ipsum</textarea>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="inputSubTasks">Sub-Tasks: </label>
                    <textarea type="text" class="form-control" id="inputSubTasks"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="inputComments">Comments: </label>
                    <textarea type="text" class="form-control" id="inputComments">Lorem Ipsum Lorem Ipsum</textarea>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="inputFile">Attachments: </label><br>

                    <div class="form-row">
                      <div class="form-group" style="width:100%; padding-left: 1%">
                        <div class="dropzone inputDrop" id="dropzone-example" enctype="multipart/form-data">
                        
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger mr-auto">Delete</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
          </div>


      </div>
      </form>
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
    <script src="../plugins/popper/popper.min.js"></script>
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <!-- DropZone -->
    <script src="../plugins/dropzone/min/dropzone.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- TOASTR -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <script src="./js/ActivityLogFunctions.js"></script>

    <script>
        $(".mt-2 ul li").removeClass("menu-open");
        $(".mt-2 ul li a").removeClass("active");
        $(".mt-2 ul li:nth-child(3)").removeClass("menu-open");
        $(".mt-2 ul li:nth-child(3) a").removeClass("active");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(1)").addClass("menu-open");
        $(".mt-2 ul li:nth-child(3) ul li:nth-child(1) a").addClass("active");

        Dropzone.autoDiscover = false;
        var attachment=$("div#dropzone-example").dropzone({
        url: "../php/upload", //Change the url to the php code
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: .5, // MB
        addRemoveLinks: true,
        dictDefaultMessage: '<span class="">Drop files (or click) to upload  </span> <br> \
                        <i class="fas fa-cloud-upload-alt"></i>', 
        dictResponseError: 'Error while uploading file!',
        });
    </script>

</body>

</html>