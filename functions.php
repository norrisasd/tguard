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
    function displayAllClientsValID(){
        global $dbConnection;
        $query="SELECT * FROM client";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['client_id'].'">'.$data['ClientName'].'</option>';
            }
        }
    }
    function displayAllAgents(){
        global $dbConnection;
        $query="SELECT * FROM user WHERE access = 2";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['user_id'].'">'.$data['name'].'</option>';
            }
        }
    }

    function displayAllTasks(){
        global $dbConnection;
        $query="SELECT * FROM callback";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['callback_id'].'" onchange="alert(this.value)">'.$data['TaskName'].'</option>';
            }
        }
    }
    function displayAllTaskType(){
        global $dbConnection;
        $query="SELECT * FROM tasktype";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['tasktype_id'].'" onchange="alert(this.value)">'.$data['type'].'</option>';
            }
        }
    }
    // function
?>