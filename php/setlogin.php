<?php
    require '../Config.php';
    $query = "SELECT * FROM user WHERE username = '".$_GET['username']."' AND password ='".$_GET['password']."'";
    $result =mysqli_query($dbConnection,$query);
    if(mysqli_num_rows($result)==1){
        $_SESSION['login']=true;
        $_SESSION['userInfo'] =mysqli_fetch_assoc($result);
        $result=true;
    }else{
        $result = false;
    };
    echo $result;
?>