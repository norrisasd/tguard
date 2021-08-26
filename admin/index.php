<?php include("components/header.php");?>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../dist/img/logo.png" alt="AdminLogo" height="100" width="100">
    </div>
  </div>

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
    <h4 style="margin-top:.5%;">Dashboard</h4>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- Notifications Dropdown Menu -->
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-primary elevation-4">
    <?php include("components/SidebarAdmin.php"); ?>
  </aside>
  <div class="content-wrapper">
    <section class="content">
      <div class="content-fluid" style="padding:1%; padding-top: 2%">
        <div class="row">
          <div class="col">
            <div class="float-left" style="padding-left:15px;">
              <h3><b>Welcome back,<br> Admin</b></h3>

            </div>
          </div>
          <div class="col">
            <p class="float-right" style="padding-right:10px;">
              <br>
              <button type="button" style="padding-left:50px; padding-right:50px" class="btn btn-primary btn-width" data-toggle="modal" data-target="#addModal">Add</button>
            </p>
          </div>
        </div>

        <!-- Task Board Starts -->
        <div class="content-fluid" style="padding:1%; padding-top:0%" id="mainContent">
          <div class="row">
            <div class="col">
              <div class="card-box cardTask" id="upcoming">
                <!-- Upcoming Task-->
                <h5><b>Upcoming</b></h5>
                <p class="text-muted m-b-30 font-13">You currently have n no. of upcoming tasks</p>
                <ul class="sortable-list taskList list-unstyled ui-sortable">
                </ul>
              </div>

            </div>
            <div class="col">
              <div class="card-box cardTask" id="inProgress">
                <!-- In Progress-->
                <h5><b>In Progress</b></h5>
                <p class="text-muted m-b-30 font-13">You currently have n no. of in progress tasks</p>
                <ul class="sortable-list taskList list-unstyled ui-sortable">
                  <li class="task-warning ui-sortable-handle" id="task1">
                    <div class="checkbox checkbox-custom checkbox-single float-right">
                      <input type="checkbox" aria-label="Single checkbox Two">
                      <label></label>
                    </div>
                    <b>Name of Task</b>
                    <div class="clearfix"></div>
                    Short Description
                    <div class="mt-3">
                      <p class="float-right">
                        <button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-eye"></i></button>
                      </p>
                      <p class="mb-2">Client:
                        <span><i>Petey Cruiser</i></span>
                      </p>
                    </div>
                  </li>
                  <li class="task-warning ui-sortable-handle" id="task1">
                    <div class="checkbox checkbox-custom checkbox-single float-right">
                      <input type="checkbox" aria-label="Single checkbox Two">
                      <label></label>
                    </div>
                    <b>Name of Task</b>
                    <div class="clearfix"></div>
                    Short Description
                    <div class="mt-3">
                      <p class="float-right">
                        <button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-eye"></i></button>
                      </p>
                      <p class="mb-2">Client:
                        <span><i>Petey Cruiser</i></span>
                      </p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  </div>


  <!-- Modal for the Add -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="get" id="addTaskForm" action="" onsubmit="return addTask();">
          <div class="modal-body">
            <div class="form-group">
              <label for="inputTask">Task Name</label>
              <input type="text" class="form-control" id="inputTaskName" placeholder="" required />
            </div>
            <div class="form-group">
              <label for="inputClient">Client Name</label>
              <select class="form-control" id="inputClientID" required>
                <option value="" selected hidden>Select Client</option>
                <?php displayAllClients() ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputAgent">Agent Name</label>
              <select class="form-control" id="inputAgentID" required>
                <option value="" selected hidden>Select Agent</option>
                <?php displayAllAgents() 
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputDescription">Notes</label>
              <textarea type="text" class="form-control" id="inputNotes"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal for the View -->
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
              <div class="form-row">
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
  <!-- DropZone -->
  <script src="../plugins/dropzone/min/dropzone.min.js"></script>
  <!-- TOASTR -->
  <script src="../plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <script src="./js/DashboardFunctions.js"></script>


  <script>
    Dropzone.autoDiscover = false;
    $("div#dropzone-example").dropzone({
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