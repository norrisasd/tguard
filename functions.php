<?php
    require_once 'Config.php';
    $userinfo = $_SESSION['userInfo'];
    $user_id = $userinfo['user_id'];
    $image=$userinfo['image_file'];
    if(!isset($_SESSION['login'])){
        if(is_dir('admin')){
            header("Location: login");
        }else{
            header("Location: ../login");
        }
    }
    function displayAllClientsEnabled(){
        global $dbConnection;
        $query="SELECT * FROM client WHERE enabled = 1";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['ClientName'].'">'.$data['ClientName'].'</option>';
            }
        }
    }
    function displayAllClientsEnabledValID(){
        global $dbConnection;
        $query="SELECT * FROM client WHERE enabled = 1";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['client_id'].'">'.$data['ClientName'].'</option>';
            }
        }
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
        $query="SELECT * FROM user";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['user_id'].'">'.$data['name'].'</option>';
            }
        }
    }
    function displayAllAgentsEnabled(){
        global $dbConnection;
        $query="SELECT * FROM user WHERE enabled =1";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['user_id'].'">'.$data['name'].'</option>';
            }
        }
    }
    function displayAllAgentsName(){
        global $dbConnection;
        $query="SELECT * FROM user";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['name'].'">'.$data['name'].'</option>';
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
    function displayAllTaskTypeEnabled(){
        global $dbConnection;
        $query="SELECT tasktype.* FROM tasktype INNER JOIN client ON client.client_id = tasktype.client_id WHERE client.enabled =1";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['tasktype_id'].'" onchange="alert(this.value)">'.$data['type'].'</option>';
            }
        }
    }
    function displayAssignedTaskType(){
        global $dbConnection,$user_id;
        $query="SELECT tasktype.tasktype_id,tasktype.type FROM assigned_tasktype INNER JOIN tasktype ON assigned_tasktype.tasktype_id = tasktype.tasktype_id WHERE assigned_tasktype.user_id=" .$user_id;
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['tasktype_id'].'" onchange="alert(this.value)">'.$data['type'].'</option>';
            }
        }
    }
    function checkUsername($username){
        global $dbConnection;
        $query ="SELECT * FROM user where username ='$username'";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            if(mysqli_num_rows($result)==1){
                return true;
            }
        }
        return false;
    }
    function displayAllFlagType(){
        global $dbConnection;
        $query="SELECT * FROM flagtype";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['flagtype'].'">'.$data['flagtype'].'</option>';
            }
        }
    }
    function displayAllFlagTypeValID(){
        global $dbConnection;
        $query="SELECT * FROM flagtype";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['flagtype_id'].'">'.$data['flagtype'].'</option>';
            }
        }
    }
    function displayAssignedClient(){
        global $dbConnection,$user_id;
        $query="SELECT DISTINCT client.ClientName FROM assigned_tasktype INNER JOIN tasktype ON assigned_tasktype.tasktype_id = tasktype.tasktype_id INNER JOIN client ON client.client_id = tasktype.client_id WHERE assigned_tasktype.user_id = $user_id;";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['ClientName'].'" onchange="alert(this.value)">'.$data['ClientName'].'</option>';
            }
        }
    }
    // function
?>