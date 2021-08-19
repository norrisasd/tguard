<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Task Guard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="icon" href="dist/img/TURTLE.png">
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
  <!-- toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
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
      <h4 style="margin-top:.5%;"><b>New Task</b></h4>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- Notifications Dropdown Menu -->
        <li>
          <a class="nav-link" href="#" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus
sagittis lacus vel augue laoreet rutrum faucibus.">
            <i class="fas fa-user"></i><i class="fa fa-caret-down" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-primary elevation-4">
      <?php include("./components/Sidebar-nexttask.php"); ?>
    </aside>
    <div class="content-wrapper">
      <section class="content">
        <div class="container-fluid">
          <div class="card-body" style="padding:0 auto">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Task Guard</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="post">
                      <div class="form-group">
                        <label for="inputTask">Task Name</label>
                        <input type="text" class="form-control" id="inputTask" placeholder="" required>
                      </div>
                      <div class="form-group">
                        <label for="inputClient">Client Name</label>
                        <select id="clientName" class="form-control" onchange="" required>
                          <option value="" selected>Select</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="inputNotes">Notes</label>
                        <input type="text" class="form-control" id="inputNotes">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="card-body" style="padding:0 auto">
              <table id="dataTable" class="table table-bordered table-hover" style="height:100%;background-color:white">
                <thead>
                  <tr>
                    <th></th>
                    <th>Task Name</th>
                    <th>Client Name</th>
                    <th>Notes</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Time Spent</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="searchTable">
                  <tr>
                    <th><input type="checkbox" name="checkbox" id="inputCheckbox"></th>
                    <td>Lorem Ipsum</td>
                    <td>John Doe</td>
                    <td>Lorem Ipsum</td>
                    <td>8/19/21 11:17 PM</td>
                    <td>8/19/21 11:30 PM</td>
                    <td>n mins</td>
                    <td>
                      <button type="button" class="btn btn-primary"><i class="fas fa-play"></i></button>
                    </td>
                    <td><button type="button" class="btn btn-success"><i class="fas fa-pause"></i></button></td>
                    <td>
                      <button type="button" class="btn btn-danger"><i class="fas fa-stop"></i></button>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Task Name</th>
                    <th>Client Name</th>
                    <th>Notes</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Time Spent</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
    </div>
  </div>
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
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
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
      });
    });
  </script>
</body>

</html>