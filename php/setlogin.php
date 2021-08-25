<?php
    require '../Config.php';
    $query = "SELECT * FROM user WHERE username = '".$_GET['username']."' AND password ='".$_GET['password']."'";
    $result =mysqli_query($dbConnection,$query);
    if(mysqli_num_rows($result)==1){
        $data = mysqli_fetch_assoc($result);
        if($data['access']==1){
            $result='admin';
        }else{
            $result='agent';
        }
        $_SESSION['login']=true;
        $_SESSION['userInfo'] = $data;
        
    }else{
        $result = false;
    };
    echo $result;
?>