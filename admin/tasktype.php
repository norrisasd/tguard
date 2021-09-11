<?php include("components/header.php"); ?>
<?php include("components/loader.php"); ?>
<!-- 
  Admin Task Type: 
    * Contains a dashboard of all the upcoming and in progress tasks of that Task Type. 
-->


<body class="hold-transition sidebar-mini layout-fixed">
  <div class="loaderB" id="logoloader" style="position:absolute;z-index:5;display:none">
    <div class="loader" style="margin:20% 50%"></div>
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
    <h4 style="margin-top:.5%;">Tasks / <span id="taskTitle">Agrisoft - SEO</span></h4>
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
              <h3><b>All the tasks related to <br> <span id="taskTitle1">Agrisoft - SEO</span></b></h3>
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
                <p class="text-muted m-b-30 font-13">You currently have <span id=total>
                    n
                  </span> of upcoming tasks</p>
                <div class="input-group rounded" style="margin-bottom:1%">
                  <input type="search" onkeydown="w3.filterHTML('#upcomingTasks', 'li', this.value)" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                  <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <div class="clearfix"></div>
                <ul class="sortable-list taskList list-unstyled ui-sortable" id="upcomingTasks" style="margin-top: 3%;">
                </ul>
              </div>

            </div>
            <div class="col">
              <div class="card-box cardTask" id="inProgress">
                <!-- In Progress-->
                <h5><b>In Progress</b></h5>
                <p class="text-muted m-b-30 font-13">You currently have <span id=total>
                    n
                  </span> of in progress tasks</p>
                <div class="input-group rounded" style="margin-bottom:1%">
                  <input type="search" onkeydown="w3.filterHTML('#inprogressTasks', 'li', this.value)" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                  <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <div class="clearfix"></div>
                <ul class="sortable-list taskList list-unstyled ui-sortable" id="inprogressTasks" style="margin-top: 3%;">
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

  <!-- Modal for the Add -->
  <div class="modal fade bd-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
              <label for="inputTaskType">Task Type</label>
              <select class="form-control" id="inputTaskType" disabled>
                <option value="" selected hidden>Select Task Type</option>
                <?php displayAllTaskType() ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputClient">Client</label>
              <select class="form-control" id="inputClientID" disabled>
                <option value="" selected hidden>Select Client</option>
                <?php displayAllClients() ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputAgent">Employee</label>
              <select class="form-control" id="inputAgentID" required>
                <option value="" selected hidden>Select Employee</option>
                <?php displayAllAgentsEnabled()
                ?>
              </select>
            </div>
            <!-- <div class="form-group">
              <label for="inputDueDate">Due Date: </label>
              <input type="date" class="form-control" id="inputDueDate"></input>
            </div> -->
            <div class="form-group">
              <label for="inputDescription">Notes</label>
              <textarea type="text" class="form-control" id="inputNotes"></textarea>
            </div>

            <div class="form-group">
              <label for="inputSubTasks">Sub-Tasks: </label>
              <textarea type="text" class="form-control" id="subTasks"></textarea>
            </div>

            <!-- 
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label for="inputFile">Attachments: </label><br>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add Attachments</button>
                      <div class="dropdown-menu cases" id="attachments">
                        <a class="dropdown-item" href="#" value="file">File</a>
                        <a class="dropdown-item" href="#" value="link">Link</a>
                      </div>
                    </div>
                    <div class="custom-file file" id="viewFile">
                      <input type="file" class="custom-file-input" id="inputType">
                      <label class="custom-file-label" for="inputGroupFile01 text-truncate">Choose File</label>
                    </div>
                    <div class="input-group-append uploadBtn" id="viewUpload">
                      <button class="btn btn-outline-secondary" type="button">Upload</button>
                    </div>

                    <div class="custom-file link" id="viewLink">
                      <input type="text input-pr-rev" class="form-control" id="basic-url" placeholder="Link">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Add</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container" style="height: 150px; overflow-y: auto;">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <td>File Name</td>
                      <td>Size</td>
                      <td><button class="btn btn-danger btn-sm waves-effect waves-light float-right"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                    <tr>
                      <td>Link</td>
                      <td></td>
                      <td><button class="btn btn-danger btn-sm waves-effect waves-light float-right"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div> -->

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
                <!-- <div class="col">
                  <label for="modalStatus">Status: </label>
                  <p id="modalStatus">---</p>
                </div> -->
                <div class="col">
                  <div class="float-right">
                    <button type="button" class="btn btn-outline-success btn-sm" style="margin-right: 2px;" id="btnPlay"><i class="fas fa-play"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" style="margin-right: 2px;" id="btnPause"><i class="fas fa-pause"></i></button>
                    <button type="button" class="btn btn-outline-danger btn-sm" id="btnStop"><i class="fas fa-stop"></i></button>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <!-- <div class="col">
                  <label for="modalDueDate">Due Date: </label>
                  <p id="modalDueDate">January 01, 2021</p>
                </div>
                <div class="col"></div> -->
                <div class="col">
                  <div class="float-right">
                    <button type="button" class="btn btn-primary mr-auto" id="btnFinish" style="min-width: 102px;">Finish</button>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <hr class="mt-2 mb-3" />
                  <div class="form-group">
                    <label for="inputTask">Task Name</label>
                    <input type="text" class="form-control" id="viewTaskName" placeholder="" required />
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="viewTaskType">Task Type</label>
                    <select class="form-control" onchange="setInputClientView(this.value)" id="viewTaskType" required>
                      <option value="" selected hidden>Select Task Type</option>
                      <?php displayAllTaskTypeEnabled() ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="viewClient">Client</label>
                    <select class="form-control" id="viewClient" disabled>
                      <option value="" selected hidden>Select Client</option>
                      <?php displayAllClients() ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="viewEmployee">Employee</label>
                    <select class="form-control" id="viewEmployee" disabled>
                      <option value="" selected hidden>Select Employee</option>
                      <?php displayAllAgentsEnabled() ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col">
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
              <!-- <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="inputFile">Attachments: </label><br>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add Attachments</button>
                        <div class="dropdown-menu cases" id="attachments">
                          <a class="dropdown-item" href="#" value="file">File</a>
                          <a class="dropdown-item" href="#" value="link">Link</a>
                        </div>
                      </div>
                      <div class="custom-file file" id="viewFile">
                        <input type="file" class="custom-file-input" id="inputType">
                        <label class="custom-file-label" for="inputGroupFile01 text-truncate">Choose File</label>
                      </div>
                      <div class="input-group-append uploadBtn" id="viewUpload">
                        <button class="btn btn-outline-secondary" type="button">Upload</button>
                      </div>

                      <div class="custom-file link" id="viewLink">
                        <input type="text input-pr-rev" class="form-control" id="basic-url" placeholder="Link">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button">Add</button>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="container" style="height: 150px; overflow-y: auto;">
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td>File Name</td>
                        <td>Size</td>
                        <td><button class="btn btn-danger btn-sm waves-effect waves-light float-right"><i class="fas fa-trash-alt"></i></button></td>
                      </tr>
                      <tr>
                        <td>Link</td>
                        <td></td>
                        <td><button class="btn btn-danger btn-sm waves-effect waves-light float-right"><i class="fas fa-trash-alt"></i></button></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div> -->
            </div>
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
  <!-- DropZone -->
  <script src="../plugins/dropzone/min/dropzone.min.js"></script>
  <!-- TOASTR -->
  <script src="../plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <script src="./js/DashboardFunctions.js"></script>
  <script src="./js/Main.js"></script>
  <script src="https://www.w3schools.com/lib/w3.js"></script>

  <script>
    $(".mt-2 ul li").removeClass("menu-open");
    $(".mt-2 ul li a").removeClass("active");
    $(".mt-2 ul li:nth-child(4) ul li:nth-child(1)").removeClass("menu-open");
    $(".mt-2 ul li:nth-child(4) ul li:nth-child(1) a").removeClass("active");
    $(".mt-2 ul li:nth-child(4) ul li:nth-child(2)").addClass("menu-open");
    $(".mt-2 ul li:nth-child(4) ul li:nth-child(2) a").addClass("active");

    //Hiding the div
    var defaultTypeID = localStorage.getItem("tasktype_id");
    $("#inputTaskType").val(defaultTypeID);
    setInputClient(defaultTypeID);
    $('#taskTitle').html(localStorage.getItem("type"));
    $('#taskTitle1').html(localStorage.getItem("type"));
    $(".custom-file").hide();
    $(".uploadBtn").hide();

    //Showing the div for the inputs
    $(document).ready(function() {
      $('.cases a').on('click', function() {
        var txt = ($(this).attr('value'));
        if (txt == 'file') {
          $(".file").show();
          $(".link").hide();
          $(".uploadBtn").show();
        }
        if (txt == 'link') {
          $(".link").show();
          $(".file").hide();
          $(".uploadBtn").hide();
        }
      });
    });

    //Changing text label of the File attachments
    // document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    //   var fileName = document.getElementById("inputType").files[0].name;
    //   var nextSibling = e.target.nextElementSibling
    //   nextSibling.innerText = fileName
    // });



    // Dropzone.autoDiscover = false;
    // $("div#dropzone-example").dropzone({
    //   url: "../php/upload", //Change the url to the php code
    //   paramName: "file", // The name that will be used to transfer the file
    //   maxFilesize: .5, // MB
    //   addRemoveLinks: true,
    //   dictDefaultMessage: '<span class="">Drop files (or click) to upload  </span> <br> \
    //                 <i class="fas fa-cloud-upload-alt"></i>',
    //   dictResponseError: 'Error while uploading file!',
    // });
  </script>


</body>

</html>