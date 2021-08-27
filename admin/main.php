<?php
// ADMIN MAIN PHP
    require_once '../Config.php';
    require_once '../functions.php';
    $userinfo = $_SESSION['userInfo'];
    $user_id = $userinfo['user_id'];
    $result='';

    if(isset($_GET['taskname']) && isset($_GET['clientname'])&& isset($_GET['notes']) && $_GET['agent']){
        //add session name
        $taskname=$_GET['taskname'];
        $clientname=$_GET['clientname'];
        $notes=$_GET['notes'];
        $agent=$_GET['agent'];
        $query ="INSERT INTO `callback`(`user_id`,`TaskName`, `client_name`, `Notes`, `datecreated`, `status`) VALUES ('$agent','$taskname','$clientname','$notes',CURDATE(),0)";
        if(mysqli_query($dbConnection,$query)){
            $query ="INSERT INTO `callback_extend`(`callback_id`, `sub_task`, `comments`) VALUES (last_insert_id(),'','');";
            if(mysqli_query($dbConnection,$query)){
                $result.="Task Created";
            }else{
                echo mysqli_error($dbConnection);
            }
        }else{
            echo mysqli_error($dbConnection);
        }
    }

    //DISPLAY ALL TASK
    if(isset($_GET['getAllTask'])){
        $status = $_GET['status'];
        $query="SELECT callback.*,SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) as total_time,user.name,callback_extend.sub_task,callback_extend.comments FROM `callback` INNER JOIN timerecord on callback.callback_id=timerecord.callback_id INNER JOIN user on callback.user_id = user.user_id INNER JOIN callback_extend ON callback_extend.callback_id = callback.callback_id WHERE callback.status = $status GROUP BY callback.callback_id ORDER BY callback.user_id;";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $result=json_encode($result);
        }
    }
    if(isset($_GET['getAllInProgressTask'])){
        $status = $_GET['status'];
        $query="SELECT callback.*,SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME(CURTIME(),timerecord.TimeStarted)))) as total_time,user.name,callback_extend.sub_task,callback_extend.comments FROM `callback` INNER JOIN timerecord on callback.callback_id=timerecord.callback_id INNER JOIN user on callback.user_id = user.user_id INNER JOIN callback_extend ON callback_extend.callback_id = callback.callback_id WHERE callback.status = $status GROUP BY callback.callback_id ORDER BY callback.user_id;";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $result=json_encode($result);
        }
    }

    // FILTERING
    if(isset($_GET['search'])){
        $cname=$_GET['searchClientName'];
        $aID=$_GET['searchAgentName'];
        $sdate=$_GET['searchStartDate'];
        $edate=$_GET['searchEndDate'];
        $time = $_GET['searchTime'];
        $bsdate=$_GET['startDate'];
        $bedate=$_GET['endDate'];
        $status = $_GET['status'];
        $cname = $cname==""?"":"AND callback.client_name ='".$cname."'";
        $aID = $aID==""?"":"AND callback.user_id =".$aID."";
        $sdate = $sdate==""?"":"AND callback.DateStarted='".$sdate."'";
        $edate = $edate==""?"":"AND callback.DateEnded='".$edate."'";
        $time = $time=="00:00"?"":"AND callback.TimeSpent='".$time."'";
        $betweenDate=$bsdate==''?'':"AND (('$bsdate' between DateStarted and DateEnded) or ('$bedate' between DateStarted and DateEnded) or ('$bsdate' <= DateStarted and '$bedate' >= DateEnded))";
        $query="SELECT callback.*,SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) as total_time,user.name,callback_extend.sub_task,callback_extend.comments FROM `callback` INNER JOIN timerecord on callback.callback_id=timerecord.callback_id INNER JOIN user on callback.user_id = user.user_id INNER JOIN callback_extend ON callback_extend.callback_id = callback.callback_id WHERE callback.status = $status $cname $aID $sdate $edate $time $betweenDate GROUP BY callback.callback_id ORDER BY callback.user_id;";
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
        $query="SELECT callback.*,callback_extend.sub_task,callback_extend.comments,user.name FROM `callback` INNER JOIN callback_extend ON callback.callback_id = callback_extend.callback_id INNER JOIN user ON user.user_id=callback.user_id WHERE callback.DateStarted is NULL;";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $result=json_encode($result);
        }else{
            $result="";
        }
    }

    if(isset($_GET['displayProgress'])){
        $query="SELECT callback.*,SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) as total_time,callback_extend.sub_task,callback_extend.comments,user.name FROM `callback` INNER JOIN timerecord ON callback.callback_id=timerecord.callback_id INNER JOIN callback_extend ON callback.callback_id =callback_extend.callback_id INNER JOIN user ON user.user_id = callback.user_id WHERE callback.status=0 AND callback.DateStarted is not NULL GROUP BY callback.callback_id;";
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

    if(isset($_GET['btnDelete'])){
        $cb_id = $_GET['cb_id'];
        $query = "DELETE FROM `callback` WHERE callback_id = $cb_id ";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $query = "DELETE FROM `timerecord` WHERE callback_id = $cb_id ";
            $result = mysqli_query($dbConnection,$query);
            if($result){
                $result = 'deleted';
            }else{
                $result= '';
            }
            
        }else{
            $result = '';
        }
    }

    if(isset($_GET['btnStop'])){
        $cb_id = $_GET['cb_id'];
        $query = "UPDATE `callback` set DateStarted = NULL WHERE callback_id = $cb_id ";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $query = "DELETE FROM `timerecord` WHERE callback_id = $cb_id ";
            $result = mysqli_query($dbConnection,$query);
            if($result){
                $result = 'stopped';
            }else{
                $result= '';
            }
            
        }else{
            $result = '';
        }
    }
    if(isset($_GET['btnFinish'])){
        $cb_id = $_GET['cb_id'];
        $query = "UPDATE `callback` SET status = 1, DateEnded = CURDATE() WHERE callback_id = $cb_id";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $query = "UPDATE `timerecord` SET status = 1 WHERE callback_id = $cb_id and status = 0 ";
            $result = mysqli_query($dbConnection,$query);
            if($result){
                $result = 'updated';
            }else{
                $result= mysqli_error($dbConnection);
            }
            
        }else{
            $result = mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['btnSave'])){
        $notes = $_POST['notes'];
        $subtask = $_POST['subtask'];
        $comments = $_POST['comments'];
        $cb_id = $_POST['cb_id'];
        $query = "UPDATE `callback` SET Notes = '$notes' WHERE callback_id = $cb_id";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $query = "UPDATE `callback_extend` SET sub_task = '$subtask', comments='$comments' WHERE callback_id = $cb_id";
            $result = mysqli_query($dbConnection,$query);
            if($result){
                $result = 'updated';
            }else{
                $result= mysqli_error($dbConnection);
            }
            
        }else{
            $result = mysqli_error($dbConnection);
        }
    }

    if(isset($_GET['getClientsJSON'])){
        $query = "SELECT * FROM client";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            if(mysqli_num_rows($result)>0){
                $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                $result = json_encode($result);
            }else{
                echo mysqli_error($dbConnection);
            }
        }else{
            echo mysqli_error($dbConnection);
        }
    }
    if(isset($_GET['getAgentsJSON'])){
        $query = "SELECT * FROM user";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            if(mysqli_num_rows($result)>0){
                $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                $result = json_encode($result);
            }else{
                echo mysqli_error($dbConnection);
            }
        }else{
            echo mysqli_error($dbConnection);
        }
    }

    echo $result;
?>