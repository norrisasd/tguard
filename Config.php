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
    
?>
