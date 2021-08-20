<?php
    require_once 'Config.php';
    require_once 'functions.php';
    $result='';
    if(isset($_GET['taskname']) && isset($_GET['clientname'])&& isset($_GET['notes'])){
        //add session name
        $taskname=$_GET['taskname'];
        $clientname=$_GET['clientname'];
        $notes=$_GET['notes'];
        $query ="INSERT INTO `callback`(`TaskName`, `client_name`, `Notes`, `datecreated`, `status`) VALUES ('$taskname','$clientname','$notes',CURDATE(),0)";
        if(mysqli_query($dbConnection,$query)){
            $result.="Task Created";
        }else{
            echo mysqli_error($dbConnection);
        }
    }
    if(isset($_GET['getTaskByUser'])){
        $query="SELECT * FROM callback";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $result=json_encode($result);
        }
    }
    if(isset($_GET['searchClientName']) || isset($_GET['searchStartDate']) || isset($_GET['searchEndDate']) || isset($_GET['searchTime'])){
        $cname=$_GET['searchClientName'];
        $sdate=$_GET['searchStartDate'];
        $edate=$_GET['searchEndDate'];
        $time = $_GET['searchTime'];
        $cname = $cname==""?"":"AND client_name ='".$cname."'";
        $sdate = $sdate==""?"":"AND DateStarted='".$sdate."'";
        $edate = $edate==""?"":"AND DateEnded='".$edate."'";
        $time = $time=="00:00"?"":"AND TimeSpent='".$time."'";
        $query="SELECT * FROM callback WHERE status = 0 $cname $sdate $edate $time";
        $result=mysqli_query($dbConnection,$query);
        if($result){
            if(mysqli_num_rows($result)>0){
                $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
                $result=json_encode($result);
            }else{
                $result="";
            }
        }else{
            $result="";
        }
        
    }
    echo $result;
?>