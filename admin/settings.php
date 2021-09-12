<?php include("components/header.php"); ?>
<?php include("components/loader.php"); ?>
<!-- 
  Admin Settings: 
    * User can view and edit his/her account information 
    * User can change profile picture
    * User can change his/her access
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

    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content" style="padding-top: 2%; padding-bottom:2%">
            <div class="container light-style flex-grow-1 container-p-y" style="width: 70%;">
                <div class="card overflow-hidden p-3">
                    <div class="row no-gutters row-bordered row-border-light ">
                        <div class="col">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="account-general">
                                    <form action="" method="post" onsubmit="return updateSettings(this);" enctype="multipart/form-data">
                                        <div class="card-body media align-items-center">
                                            <img src="../dist/profpic/<?php echo $image?>" alt="" id="myPic" class="d-block" style="max-width: 200px; max-height: 200px">
                                            <div class="media-body ml-4">
                                                <div class="custom-file w-75">
                                                    <input type="file" onchange="readURL(this);" name="image" class="custom-file-input" id="customFile">
                                                    
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <div class="small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                            </div>
                                        </div>
                                        <input type="text" name="title" id="title" style="display:none">
                                        <hr class="border-light m-0">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control mb-1" name="uname" id="username" value="<?php echo $userinfo['username'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $userinfo['name'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">E-mail</label>
                                                <input type="text" class="form-control mb-1" name="email" id="email" value="<?php echo $userinfo['email'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" id="password" value="<?php echo $userinfo['password'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Access</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" value="1" type="radio" name="flexRadioDefault" id="flexRadioDefault1" <?php echo $userinfo['access'] == 1 ? "checked" : "" ?>>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Admin
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="2" name="flexRadioDefault" id="flexRadioDefault2" <?php echo $userinfo['access'] == 2 ? "checked" : "" ?>>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Employee
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary" value="<?php echo $userinfo['user_id'] ?>" id="btnSave">Save</button>
                </div>
                </form>
            </div>
        </section>
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
    <script src="./js/Main.js"></script>

    <script>
        //Changing text label of the File attachments
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("customFile").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#myPic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }


        }

        function updateSettings(data) {
            var name = document.getElementById("customFile").value;
            name = name.split("\\").pop();
            document.getElementById("title").value=name;
            title =document.getElementById("title").value;
            $.ajax({
                type: 'post',
                url: './main.php',
                // data: new FormData(this),
                data: new FormData(data),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if(response == 'updated'){
                        toastr.success("User Information Updated");
                        $('#navPic').attr('src', '../dist/profpic/'+title);
                    }
                }
            });
            return false;
        }
    </script>


</body>

</html>