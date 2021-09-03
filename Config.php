<?php
    $cred = file_get_contents(__DIR__."/Strings.json");
    $cred = json_decode($cred);
    //DB CONNECTION
    $host=$cred->dbHost;
    $user=$cred->dbUser;
    $pass=$cred->dbPass;
    $data=$cred->dbData;
    $dbConnection = mysqli_connect($host,$user,$pass,$data);
    if (!$dbConnection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    session_start();
    if(!isset($_SESSION['login'])){
        if(is_dir("admin")){
            header("Location: login");
        }else{
            header("Location: ../login");
        }
        
        
    }
?>
