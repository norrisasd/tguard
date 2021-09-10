<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Guard</title>
    <?php include("./components/icon.php"); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<?php include("./components/loader.php"); ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="dist/img/logo.png" class="mx-auto d-block" style="max-width: 15%;">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <form class="form-signin" role="form" action="" method="get" onsubmit="return setLogin();">
                            <div class="form-label-group">
                                <h5><b>Login</b></h5>
                            </div>
                            <div class="form-label-group mb-3">
                                <input type="text" class="form-control" id="username" placeholder="Username">
                                <label for="username">Username</label>
                            </div>
                            <div class="form-label-group mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Password">
                                <label for="password">Password</label>
                            </div>

                            <div class="link forget-pass mb-2 text-right">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                </label>
                            </div>
                            <div class="link forget-pass text-left mb-3">
                                <a href="#" data-toggle="modal" data-target="#emailSending" style="color:#343a40">Forgot password?</a>
                            </div>
                            <div class="form-group d-grid">
                                <input class="form-control btn btn-primary btn-dark" type="submit" value="Login" name="login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- MODAL -->
    <div class="modal fade bd-example-modal-lg" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">User Agreement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <iframe src="./pages/TermsAndConditions" id="agreement" title="Terms And Conditions" style="height:500px;width:100%"></iframe> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="acceptBtn">I Accept</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="emailSending" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verify Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="emailVerificationForm">
                        <div class="form-group">
                            <label for="verUsername"><b>Username</b></label>
                            <input type="text" class="form-control" id="verUsername" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="email"><b>Email address</b></label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                            <button type="button" class="btn btn-outline-primary btn-sm float-right" id="vfBtn" style="margin:2%">Check Email</button>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="code"><b>Email Verification Code (6 digits)</b></label>
                            <input type="number" class="form-control" id="code" placeholder="123456" min="100000" max="999999">
                            <button type="button" class="btn btn-outline-primary btn-sm float-right" id="cdBtn" style="margin:2%" disabled>Send Code</button>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitBtn" value="">Verify</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    Change Password
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <input type="password" class="form-control" id="changePassw" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confrim Password</label>
                        <input type="password" class="form-control" id="confirmChangePass" placeholder="Enter Username">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="changeBtn">Change Password</button>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- jquery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="js/LoginFunctions.js"></script>

</html>