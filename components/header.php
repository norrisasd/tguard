<?php
require_once './functions.php';
$userinfo = $_SESSION['userInfo'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Guard</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- Icons -->
    <?php include("./components/icon.php"); ?>
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
    <!-- Dropzone -->
    <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
</head>