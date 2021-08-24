<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Guard</title>
    <?php include("./components/icon.php"); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="./css/main.css">

    <!-- jquery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="dist/img/logo.png" class="mx-auto d-block" style="max-width: 15%;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">

                <form accept-charset="UTF-8" class="form-signin" role="form" action="" method="post" onsubmit="return setLogin();">

                    <div class="form-label-group">
                        <h5><b>Login</b></h5>

                    </div>
                    <div class="form-label-group">
                        <input class="form-control" placeholder="Username" id="username" type="text">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-label-group">
                        <input class="form-control" placeholder="Password" id="password" type="password" value="">
                        <label for="password">Password</label>
                    </div>
                    <div class="link forget-pass text-right">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                        </label>
                    </div>
                    <div class="link forget-pass text-left"><a href="#" data-toggle="modal" data-target="#emailSending">Forgot password?</a></div>

                    <div class="form-group">
                        <input class="form-control btn btn-dark" type="submit" value="Login" name="login">
                    </div>
                    <!-- <div class="link login-link text-center">Not yet a member? <a href="signup-user.php">Signup now</a></div> -->
                </form>
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
                    <iframe src="./pages/TermsAndConditions" id="agreement" title="Terms And Conditions" style="height:500px;width:100%"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="acceptBtn" onclick="updateStatus()">I Accept</button>
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
                            <button type="button" class="btn btn-outline-primary btn-sm float-right" id="vfBtn" onclick="verifyEmail()" style="margin:2%">Check Email</button>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="code"><b>Email Verification Code (6 digits)</b></label>
                            <input type="number" class="form-control" id="code" placeholder="123456" min="100000" max="999999">
                            <button type="button" class="btn btn-outline-primary btn-sm float-right" id="cdBtn" onclick="generateCode()" style="margin:2%" disabled>Send Code</button>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitBtn" value="" onclick="verify()">Verify</button>
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
                    <button type="button" class="btn btn-primary" id="changeBtn" onclick="changePass()">Change Password</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="plugins/toastr/toastr.min.js"></script>

</html>