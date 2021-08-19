<?php
    require_once 'Config.php';
    function displayAllClients(){
        global $dbConnection;
        $query="SELECT * FROM client";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['client_id'].'">'.$data['ClientName'].'</option>';
            }
        }
    }
    function getTaskByUser(){//session
        global $dbConnection;
        $query="SELECT * FROM callback";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $data=mysqli_fetch_assoc($result);
            return json_encode($data);
        }
    }
?>