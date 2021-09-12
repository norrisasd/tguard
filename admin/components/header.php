<?php
require_once '../functions.php';
$userinfo = $_SESSION['userInfo'];
if($userinfo['access']==2){
    header("Location: ../");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Guard</title>
    <link rel="icon" href="../dist/img/logo.png">
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-select/css/select.bootstrap4.min.css">
    
    <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="../css/Style.css">
    <link rel="stylesheet" href="components/main.css">
    <!-- toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <!-- Drop Zone-->
    <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">

    <style>
        .loaderB {
            border: 16px solid #f3f3f3;
            background: white;
            width: 100%;
            height: 100%;
            overflow: hidden;
            opacity: 75%;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3c8dbc;
            border-bottom: 16px solid #3c8dbc;
            width: 200px;
            height: 200px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }

        }

        @media only screen and (max-width: 600px) {}
    </style>

</head>