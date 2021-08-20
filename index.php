<?php
require_once './functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Task Guard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="icon" href="dist/img/logo.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="css/Style.css">
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
      <h4 style="margin-top:.5%;">Dashboard</h4>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- Notifications Dropdown Menu -->
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-primary elevation-4">
      <?php include("./components/Sidebar.php"); ?>
    </aside>
    <div class="content-wrapper">
      <section class="content">
        <div class="content-fluid" style="padding:1%; padding-top: 2%">
          <div class="row">
            <div class="col">
              <h3><b>Welcome back,<br> Agent Joe</b></h3>
            </div>
            <div class="col">
              <p class="float-right">
                <br>
                <button type="button" style="padding-left:50px; padding-right:50px" class="btn btn-primary btn-width" data-toggle="modal" data-target="#addModal">Add</button>
              </p>
            </div>
          </div>
        </div>
        <!-- Task Board Starts -->
        <div class="content-fluid" style="padding:1%; padding-top:0%">
          <div class="row">
            <div class="col">
              <div class="card-box cardTask">
                <!-- Upcoming Task-->
                <h5><b>Upcoming</b></h5>
                <p class="text-muted m-b-30 font-13">Your awesome text goes here. Your awesome text goes here.</p>
                <ul class="sortable-list taskList list-unstyled ui-sortable" id="upcoming">
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
            <div class="col">
              <div class="card-box cardTask">
                <!-- In Progress-->
                <h5><b>In Progress</b></h5>
                <p class="text-muted m-b-30 font-13">Your awesome text goes here. Your awesome text goes here.</p>
                <ul class="sortable-list taskList list-unstyled ui-sortable" id="inprogress">
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
      </section>
    </div>
  </div>


  <!-- Modal for the Add -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Task Guard</h5>
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
              <label for="inputTask">Kind of Task</label>
              <select class="form-control" id="inputTask" required>
                <option value="0">Upcoming</option>
                <option value="1">In Progress</option>

              </select>
            </div>
            <div class="form-group">
              <label for="inputNotes">Notes</label>
              <textarea type="text" class="form-control" id="inputNotes"></textarea>
            </div>
            <div class="form-horizontal">

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
          <h5 class="modal-title" id="exampleModalLabel">Title of Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="get" id="viewTask" action="">
          <div class="modal-body">
            <div class="container-fluid">
              
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
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

  <script>
    $.widget.bridge('uibutton', $.ui.button);
    $('[data-toggle="popover"]').popover();

    $(function() {
      $('#dataTable').DataTable({
        "oLanguage": {
          "sLengthMenu": "Show Entries _MENU_",
        },
        dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-8'l><'col-sm-2'i><'col-md-2'p>>",
        "pageLength": 10,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": ["excel", "pdf", "print"]
      }).buttons().container().appendTo('#beforeLD');
    });
  </script>
</body>

</html>