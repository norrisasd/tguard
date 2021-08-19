<?php
    require_once '../Config.php';
    require_once './functions.php';
    $result='';
    if(isset($_GET['taskname']) && isset($_GET['clientid'])&& isset($_GET['notes'])){
        //add session name
        $taskname=$_GET['taskname'];
        $clientid=$_GET['clientid'];
        $notes=$_GET['notes'];
        $query ="INSERT INTO `callback`(`TaskName`, `client_id`, `Notes`, `datecreated`, `status`) VALUES ('$taskname',$clientid,'$notes',CURDATE(),0)";
        if(mysqli_query($dbConnection,$query)){
            $result.="Task Created";
        }else{
            echo mysqli_error($dbConnection);
        }
    }
    if(isset($_GET['refreshTable'])){
        
    }
    echo $result;
?>