<?php
    require_once 'Config.php';
    $userinfo = $_SESSION['userInfo'];
    if(!isset($_SESSION['login'])){
        header("Location: login");
    }
    function displayAllClients(){
        global $dbConnection;
        $query="SELECT * FROM client";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['ClientName'].'">'.$data['ClientName'].'</option>';
            }
        }
    }
    // function
?>