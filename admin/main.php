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
        // $ddate=$_GET['duedate'];
        $subtask=$_GET['subtask'];
        $ttype=$_GET['tasktype'];
        $query ="INSERT INTO `callback`(`user_id`,`TaskName`, `client_name`, `Notes`, `datecreated`, `status`,`tasktype_id`) VALUES ('$agent','$taskname','$clientname','$notes',CURDATE(),0,$ttype)";
        if(mysqli_query($dbConnection,$query)){
            $query ="INSERT INTO `callback_extend`(`callback_id`, `sub_task`, `comments`) VALUES (last_insert_id(),'$subtask','');";
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
        $query="SELECT callback.*,user.name,callback_extend.sub_task,callback_extend.comments, tasktype.type FROM `callback` INNER JOIN timerecord on callback.callback_id=timerecord.callback_id INNER JOIN user on callback.user_id = user.user_id INNER JOIN callback_extend ON callback_extend.callback_id = callback.callback_id INNER JOIN tasktype ON tasktype.tasktype_id = callback.tasktype_id WHERE callback.status = $status GROUP BY callback.callback_id ORDER BY callback.user_id;";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $result=json_encode($result);
        }
    }
    
    if(isset($_GET['getAllInProgressTask'])){
        $status = $_GET['status'];
        $query="SELECT timerecord.TimeRecord_ID,callback.*,ADDTIME(callback.TimeSpent,(Select SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME(CURTIME(),timerecord.TimeStarted)))) FROM timerecord WHERE timerecord.status = 0))AS current_time_spent,user.name,callback_extend.sub_task,callback_extend.comments, tasktype.type FROM `callback` INNER JOIN timerecord on callback.callback_id=timerecord.callback_id INNER JOIN user on callback.user_id = user.user_id INNER JOIN callback_extend ON callback_extend.callback_id = callback.callback_id INNER JOIN tasktype ON tasktype.tasktype_id = callback.tasktype_id WHERE callback.status = $status GROUP BY callback.callback_id ORDER BY callback.user_id;";
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
        // $ddate=$_GET['searchDueDate'];
        $ttype=$_GET['searchTaskType'];
        $bsdate=$_GET['startDate'];
        $bedate=$_GET['endDate'];
        $status = $_GET['status'];
        $cname = $cname==""?"":"AND callback.client_name ='".$cname."'";
        $aID = $aID==""?"":"AND callback.user_id =".$aID."";
        $sdate = $sdate==""?"":"AND callback.DateStarted='".$sdate."'";
        $edate = $edate==""?"":"AND callback.DateEnded='".$edate."'";
        $ttype= $ttype ==""?"":"AND callback.tasktype_id=$ttype";
        // $ddate = $ddate==""?"":"AND callback.DueDate='".$ddate."'";
        $betweenDate=$bsdate==''?'':"AND (('$bsdate' between DateStarted and DateEnded) or ('$bedate' between DateStarted and DateEnded) or ('$bsdate' <= DateStarted and '$bedate' >= DateEnded))";
        $query="SELECT callback.*,ADDTIME(callback.TimeSpent,(Select SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME(CURTIME(),timerecord.TimeStarted)))) FROM timerecord WHERE status = 0))AS current_time_spent,user.name,callback_extend.sub_task,callback_extend.comments, tasktype.type FROM `callback` INNER JOIN timerecord on callback.callback_id=timerecord.callback_id INNER JOIN user on callback.user_id = user.user_id INNER JOIN callback_extend ON callback_extend.callback_id = callback.callback_id INNER JOIN tasktype ON tasktype.tasktype_id = callback.tasktype_id WHERE callback.status = $status $cname $aID $sdate $edate $betweenDate $ttype GROUP BY callback.callback_id ORDER BY callback.user_id;";
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
        $tasktypeID=$_GET['tasktype_id']==""?"AND callback.user_id = $user_id":" AND callback.tasktype_id=".$_GET['tasktype_id']."";
        $query="SELECT callback.*,callback_extend.sub_task,callback_extend.comments,user.name FROM `callback` INNER JOIN callback_extend ON callback.callback_id = callback_extend.callback_id INNER JOIN user ON user.user_id=callback.user_id WHERE callback.DateStarted is NULL $tasktypeID;";
        $result=mysqli_query($dbConnection,$query);
        if(mysqli_num_rows($result)>0){
            $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $result=json_encode($result);
        }else{
            $result="";
        }
    }

    if(isset($_GET['displayProgress'])){
        $tasktypeID=$_GET['tasktype_id']==""?"":" AND callback.tasktype_id=".$_GET['tasktype_id']."";
        $query="SELECT callback.*,SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) as total_time,callback_extend.sub_task,callback_extend.comments,user.name FROM `callback` INNER JOIN timerecord ON callback.callback_id=timerecord.callback_id INNER JOIN callback_extend ON callback.callback_id =callback_extend.callback_id INNER JOIN user ON user.user_id = callback.user_id WHERE callback.status=0 $tasktypeID AND callback.DateStarted is not NULL GROUP BY callback.callback_id;";
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
            $query ="UPDATE `callback` SET `TimeSpent`= (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) FROM timerecord WHERE timerecord.callback_id= $cb_id) WHERE callback.callback_id= $cb_id";
            $result=mysqli_query($dbConnection,$query);
            if($result){
                $result = 'updated';
            }else{
                $result = mysqli_error($dbConnection);
            }
        }else{
            $result = mysqli_error($dbConnection);
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
            $query = "UPDATE `timerecord` SET status = 1, `TimeStop`= CURTIME(), TimeSpent=SUBTIME(CURTIME(),TimeStarted) WHERE callback_id = $cb_id and status = 0 ";
            $result = mysqli_query($dbConnection,$query);
            if($result){
                $query ="UPDATE `callback` SET `TimeSpent`= (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) FROM timerecord WHERE timerecord.callback_id= $cb_id) WHERE callback.callback_id= $cb_id";
                $result=mysqli_query($dbConnection,$query);
                if($result){
                    $result = 'updated';
                }else{
                    $result = mysqli_error($dbConnection);
                }
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
        $taskname =$_POST['taskname'];
        $tasktype=$_POST['tasktype'];
        $client=$_POST['client'];
        $employee=$_POST['employee'];
        $query = "UPDATE `callback` SET  user_id=$employee,TaskName = '$taskname', client_name='$client' ,Notes = '$notes',tasktype_id=$tasktype WHERE callback_id = $cb_id";
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
        $query = "SELECT client.*,COUNT(tasktype.client_id) as tasktype_count FROM client LEFT JOIN tasktype ON tasktype.client_id = client.client_id GROUP BY client.client_id ORDER BY client.enabled DESC; ";
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
    
    if(isset($_GET['getTaskTypes'])){
        $query="SELECT tasktype.tasktype_id,tasktype.notes,tasktype.type,client.* FROM tasktype INNER JOIN client ON client.client_id = tasktype.client_id ORDER BY client.enabled desc";
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

    if(isset($_POST['addTaskType'])){
        $query="INSERT INTO `tasktype`(`type`,`notes`, `client_id`) VALUES ('".$_POST['tasktype']."','".$_POST['notes']."',".$_POST['client'].")";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $result = "inserted";
        }else{
            $result = "mysqli_error($dbConnection)";
        }
    }
    if(isset($_POST['btnDeleteTaskType'])){
        $query="DELETE FROM `tasktype` WHERE tasktype_id=".$_POST['tasktype_id'];
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result = 'deleted';
        }else{
            $result= mysqli_error($dbConnection);
        }
    }
    if(isset($_GET['getInputClientByTasktypeID'])){
        $query="SELECT client.ClientName,client.client_id FROM tasktype INNER JOIN client ON client.client_id = tasktype.client_id WHERE tasktype.tasktype_id =".$_GET['tasktype_id'];
        $result = mysqli_query($dbConnection,$query);
        // echo $query;
        if($result){
            if(mysqli_num_rows($result)>0){
                $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                $result = json_encode($result);
            }else{
                $result ='';
            }
        }else{
            $result=mysqli_error($dbConnection);
        }
    }
    if(isset($_GET['getTimeStatusByID'])){
        $query = "SELECT status FROM timerecord WHERE TimeRecord_id=".$_GET['timerecord_id'];
        $result=mysqli_query($dbConnection,$query);
        if($result){
            if(mysqli_num_rows($result)>0){
                $result=mysqli_fetch_assoc($result);
                $result = json_encode($result);
            }
        }
    }
    if(isset($_GET['getExistedTaskType'])){
        $query="SELECT tasktype.* FROM `tasktype`,assigned_tasktype WHERE assigned_tasktype.user_id=".$_GET['user_id']." AND assigned_tasktype.tasktype_id=tasktype.tasktype_id;";
        $result=mysqli_query($dbConnection,$query);
        if($result){
            if(mysqli_num_rows($result)>0){
                $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                $result = json_encode($result);
            }else{
                $result="";
            }
        }else{
            $result ="";
        }
    }
    if(isset($_POST['assignUser'])){
        $query="INSERT INTO `assigned_tasktype`(`tasktype_id`, `user_id`) VALUES (".$_POST['tasktype'].",".$_POST['user'].")";
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="assigned";
        }else{
            $result=mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['addUser'])){
        $retval=checkUsername($_POST['username']);
        if($retval){
            echo "taken";
            return;
        }
        $query="INSERT INTO `user`(`name`, `phone`, `email`, `username`, `password`, `access`) VALUES ('".$_POST['fullname']."',".$_POST['phone'].",'".$_POST['email']."','".$_POST['username']."','".$_POST['password']."',".$_POST['access'].")";
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="inserted";
        }else{
            echo mysqli_error($dbConnection);
        }
    }

    if(isset($_POST['saveUser'])){
        $query="UPDATE `user` SET `name`='".$_POST['fullname']."',`phone`=".$_POST['phone'].",`email`='".$_POST['email']."',`username`='".$_POST['username']."',`password`='".$_POST['password']."',`access`=".$_POST['access'].",`enabled`=".$_POST['enabled']." WHERE user_id =".$_POST['user_id'];
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="updated";
        }else{
            echo mysqli_error($dbConnection);
        }
    }

    if(isset($_POST['addClient'])){
        $query="INSERT INTO `client`(`ClientName`, `phone`, `email`) VALUES ('".$_POST['name']."',".$_POST['phone'].",'".$_POST['email']."')";
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="inserted";
        }else{
            echo mysqli_error($dbConnection);
        }
    }   
    if(isset($_POST['archiveEmployee'])){
        $query ="UPDATE user set enabled = 0 WHERE user_id=".$_POST['archiveEmployee'];
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="archived";
        }else{
            echo mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['activateEmployee'])){
        $query ="UPDATE user set enabled = 1 WHERE user_id=".$_POST['activateEmployee'];
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="activated";
        }else{
            echo mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['saveClient'])){
        $query="UPDATE `client` SET `ClientName`='".$_POST['fullname']."',`phone`=".$_POST['phone'].",`email`='".$_POST['email']."', `enabled`=".$_POST['enabled']." WHERE client_id =".$_POST['saveClient'];
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="updated";
        }else{
            echo mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['archiveClient'])){
        $query ="UPDATE client set enabled = 0 WHERE client_id=".$_POST['archiveClient'];
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="archived";
        }else{
            echo mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['activateClient'])){
        $query ="UPDATE client set enabled = 1 WHERE client_id=".$_POST['activateClient'];
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="activated";
        }else{
            echo mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['addFlagType'])){
        $query="INSERT INTO `flagtype`(`flagtype`, `notes`,`textcolor`,`bgcolor`) VALUES ('".$_POST['flagtype']."','".$_POST['notes']."','".$_POST['textcolor']."','".$_POST['bgcolor']."')";
        $result=mysqli_query($dbConnection,$query);
        if($result){
            $result="inserted";
        }else{
            echo mysqli_error($dbConnection);
        }
    }
    if(isset($_GET['getFlagType'])){
        $query = "SELECT * FROM flagtype";
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
    if(isset($_GET['displayEmployeeAccess'])){
        $query = "SELECT assigned_tasktype.assigned_tasktype_id,tasktype.type FROM `assigned_tasktype` INNER JOIN tasktype on tasktype.tasktype_id=assigned_tasktype.assigned_tasktype_id WHERE assigned_tasktype.user_id=".$_GET['displayEmployeeAccess'];
        $result = mysqli_query($dbConnection,$query);
        if($result){
            if(mysqli_num_rows($result)>0){
                $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                $result = json_encode($result);
            }else{
                $result= '';
            }
        }else{
            $result = mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['revokeAccess'])){
        $query="DELETE FROM `assigned_tasktype` WHERE assigned_tasktype_id=".$_POST['revokeAccess'];
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $result="revoked";
        }else{
            $result = mysqli_error($dbConnection);
        }
    }

    if(isset($_POST['saveTasktype'])){
        $query = "UPDATE `tasktype` SET `type`='".$_POST['tasktype']."',`notes`='".$_POST['notes']."',`client_id`=".$_POST['client']." WHERE tasktype_id=".$_POST['saveTasktype'];
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $result="updated";
        }else{
            $result = mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['saveFlagType'])){
        $query = "UPDATE `flagtype` SET `flagtype`='".$_POST['flagtype']."',`notes`='".$_POST['notes']."',`textcolor`='".$_POST['textcolor']."',`bgcolor`='".$_POST['bgcolor']."' WHERE flagtype_id=".$_POST['saveFlagType'];
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $result="updated";
        }else{
            $result = mysqli_error($dbConnection);
        }
    }
    if(isset($_POST['deleteFlagType'])){
        $query="DELETE FROM `flagtype` WHERE flagtype_id=".$_POST['deleteFlagType'];
        $result = mysqli_query($dbConnection,$query);
        if($result){
            $result="deleted";
        }else{
            $result = mysqli_error($dbConnection);
        }
    }
    echo $result;
?>