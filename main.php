<?php
    require_once 'Config.php';
    require_once 'functions.php';
    $userinfo = $_SESSION['userInfo'];
    $user_id = $userinfo['user_id'];
    $result='';

    if(isset($_GET['taskname']) && isset($_GET['clientname'])&& isset($_GET['notes'])){
        //add session name
        $taskname=$_GET['taskname'];
        $clientname=$_GET['clientname'];
        $notes=$_GET['notes'];
        $query ="INSERT INTO `callback`(`user_id`,`TaskName`, `client_name`, `Notes`, `datecreated`, `status`) VALUES ('".$userinfo['user_id']."','$taskname','$clientname','$notes',CURDATE(),0)";
        if(mysqli_query($dbConnection,$query)){
            $result.="Task Created";
        }else{
            echo mysqli_error($dbConnection);
        }
    }

    //DISPLAY ALL TASK
    if(isset($_GET['getTaskByUser'])){
        $query="SELECT * FROM callback WHERE user_id = $user_id";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $result=json_encode($result);
        }
    }

    // FILTERING
    if(isset($_GET['searchClientName']) || isset($_GET['searchStartDate']) || isset($_GET['searchEndDate']) || isset($_GET['searchTime']) || isset($GET['startDate'])){
        $cname=$_GET['searchClientName'];
        $sdate=$_GET['searchStartDate'];
        $edate=$_GET['searchEndDate'];
        $time = $_GET['searchTime'];
        $bsdate=$_GET['startDate'];
        $bedate=$_GET['endDate'];
        $cname = $cname==""?"":"AND client_name ='".$cname."'";
        $sdate = $sdate==""?"":"AND DateStarted='".$sdate."'";
        $edate = $edate==""?"":"AND DateEnded='".$edate."'";
        $time = $time=="00:00"?"":"AND TimeSpent='".$time."'";
        $betweenDate=$bsdate==''?'':"AND (('$bsdate' between DateStarted and DateEnded) or ('$bedate' between DateStarted and DateEnded) or ('$bsdate' <= DateStarted and '$bedate' >= DateEnded))";
        $query="SELECT * FROM callback WHERE status = 0 AND user_id = $user_id $cname $sdate $edate $time $betweenDate";
        $result=mysqli_query($dbConnection,$query);
        if($result){
            if(mysqli_num_rows($result)>0){
                $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
                $result=json_encode($result);
            }else{
                $result="";
            }
        }else{
            $result=mysqli_error($dbConnection);
        }
        
    }

    if(isset($_GET['displayUpcoming'])){
        $query="SELECT * FROM callback WHERE DateStarted is NULL";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $result=json_encode($result);
        }else{
            $result="";
        }
    }

    if(isset($_GET['displayProgress'])){
        $query="SELECT callback.*,SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) as total_time FROM `callback`,timerecord WHERE callback.DateStarted is not NULL AND callback.callback_id=timerecord.callback_id GROUP BY callback.callback_id;";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $result=json_encode($result);
        }else{
            $result="";
        }
        
    }
    if(isset($_GET['btnPlay'])){
        $cb_id = $_GET['cb_id'];
        $query = "UPDATE `callback` SET `DateStarted`= CURDATE() WHERE `DateStarted` IS NULL AND callback_id = $cb_id ";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $query="INSERT INTO `timerecord`(`callback_id`,`TimeStarted`,`status`) VALUES ($cb_id,CURTIME(),0)";
            $result = mysqli_query($dbConnection,$query);
            if($result){
                $result = 'updated';
            }
        }else{
            $result = 'kek';
        }
    }
    if(isset($_GET['getTimeStatus'])){
        $cb_id = $_GET['cb_id'];
        $query = "SELECT * FROM timerecord WHERE callback_id = $cb_id ORDER BY TimeRecord_ID desc";
        $result = mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result = mysqli_fetch_assoc($result);
            $result=json_encode($result);
        }else{
            $result ='';
        }
    }
    if(isset($_GET['btnPause'])){
        $cb_id = $_GET['cb_id'];
        $query = "UPDATE `timerecord` SET  `TimeStop`= CURTIME(), TimeSpent=SUBTIME(CURTIME(),TimeStarted) ,status = 1 WHERE callback_id = $cb_id AND status= 0 ";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $result = 'updated';

        }else{
            $result = '';
        }
    }

    echo $result;
?>