<?php
require_once 'Config.php';
require_once 'functions.php';
$userinfo = $_SESSION['userInfo'];
$user_id = $userinfo['user_id'];
$result = '';

if (isset($_GET['taskname']) && isset($_GET['clientname']) && isset($_GET['notes']) && $_GET['agent']) {
    //add session name
    $taskname = $_GET['taskname'];
    $clientname = $_GET['clientname'];
    $notes = $_GET['notes'];
    $agent = $_GET['agent'];
    // $ddate=$_GET['duedate'];
    $subtask = $_GET['subtask'];
    $ttype = $_GET['tasktype'];
    $query = "INSERT INTO `callback`(`user_id`,`TaskName`, `client_name`, `Notes`, `datecreated`, `status`,`tasktype_id`) VALUES ('$agent','$taskname','$clientname','$notes',CURDATE(),0,$ttype)";
    if (mysqli_query($dbConnection, $query)) {
        $query = "INSERT INTO `callback_extend`(`callback_id`, `sub_task`, `comments`) VALUES (last_insert_id(),'$subtask','');";
        if (mysqli_query($dbConnection, $query)) {
            $result = "Task Created!";
        } else {
            echo mysqli_error($dbConnection);
        }
    } else {
        echo mysqli_error($dbConnection);
    }
}

//DISPLAY ALL TASK
if (isset($_GET['getTaskByUser'])) {
    $query = "SELECT callback.*,tasktype.*,SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) as total_time,flagtype.flagtype,flagtype.textcolor,flagtype.bgcolor FROM callback INNER JOIN timerecord ON timerecord.callback_id= callback.callback_id INNER JOIN user on callback.user_id = user.user_id INNER JOIN callback_extend ON callback_extend.callback_id = callback.callback_id INNER JOIN tasktype ON tasktype.tasktype_id = callback.tasktype_id LEFT JOIN flagtype ON flagtype.flagtype_id = callback.flagtype_id WHERE callback.user_id=$user_id AND callback.callback_id=timerecord.callback_id AND callback.tasktype_id=tasktype.tasktype_id AND callback.status =1 GROUP BY callback.callback_id;";
    $result = mysqli_query($dbConnection, $query);
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = json_encode($result);
    }
}
/* 
// FILTERING
if (isset($_GET['searchClientName']) || isset($_GET['searchStartDate']) || isset($_GET['searchEndDate']) || isset($_GET['searchTime']) || isset($GET['startDate'])) {
    $cname = $_GET['searchClientName'];
    $sdate = $_GET['searchStartDate'];
    $edate = $_GET['searchEndDate'];
    $bsdate = $_GET['startDate'];
    $bedate = $_GET['endDate'];
    $ddate = $_GET['searchDueDate'];
    $cname = $cname == "" ? "" : "AND client_name ='" . $cname . "'";
    $sdate = $sdate == "" ? "" : "AND DateStarted='" . $sdate . "'";
    $edate = $edate == "" ? "" : "AND DateEnded='" . $edate . "'";
    $ddate = $ddate == "" ? "" : "AND DueDate='" . $ddate . "'";
    $betweenDate = $bsdate == '' ? '' : "AND (('$bsdate' between DateStarted and DateEnded) or ('$bedate' between DateStarted and DateEnded) or ('$bsdate' <= DateStarted and '$bedate' >= DateEnded))";
    $query = "SELECT callback.*,SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) as total_time FROM `callback`,timerecord WHERE callback.user_id=$user_id AND callback.callback_id=timerecord.callback_id AND callback.status =1 $cname $sdate $edate $ddate $betweenDate GROUP BY callback.callback_id;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result = json_encode($result);
        } else {
            $result = mysqli_error($dbConnection);
        }
    } else {
        $result = mysqli_error($dbConnection);
    }
}
*/


// FILTERING
if (isset($_GET['search'])) {
    $cname = $_GET['searchClientName'];
    // $aID = $_GET['searchAgentName'];
    $sdate = $_GET['searchStartDate'];
    $edate = $_GET['searchEndDate'];
    // $ddate=$_GET['searchDueDate'];
    $ftype = $_GET['searchFlagType'];
    $ttype = $_GET['searchTaskType'];
    $bsdate = $_GET['startDate'];
    $bedate = $_GET['endDate'];
    $status = $_GET['status'];
    $cname = $cname == "" ? "" : "AND callback.client_name ='" . $cname . "'";
    // $aID = $aID == "" ? "" : "AND callback.user_id =" . $aID . "";
    $sdate = $sdate == "" ? "" : "AND callback.DateStarted='" . $sdate . "'";
    $edate = $edate == "" ? "" : "AND callback.DateEnded='" . $edate . "'";
    $ttype = $ttype == "" ? "" : "AND callback.tasktype_id=$ttype";
    $ftype = $ftype == "" ? "" : "AND callback.flagtype_id=$ftype";
    // $ddate = $ddate==""?"":"AND callback.DueDate='".$ddate."'";
    $betweenDate = $bsdate == '' ? '' : "AND (('$bsdate' between DateStarted and DateEnded) or ('$bedate' between DateStarted and DateEnded) or ('$bsdate' <= DateStarted and '$bedate' >= DateEnded))";

    $query = "SELECT flagtype.flagtype,flagtype.textcolor,flagtype.bgcolor,callback.*,ADDTIME(callback.TimeSpent,(Select SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME(CURTIME(),timerecord.TimeStarted)))) FROM timerecord WHERE status = 0))AS current_time_spent,user.name,callback_extend.sub_task,callback_extend.comments, tasktype.type FROM `callback` INNER JOIN timerecord on callback.callback_id=timerecord.callback_id INNER JOIN user on callback.user_id = user.user_id INNER JOIN callback_extend ON callback_extend.callback_id = callback.callback_id INNER JOIN tasktype ON tasktype.tasktype_id = callback.tasktype_id LEFT JOIN flagtype ON flagtype.flagtype_id = callback.flagtype_id WHERE callback.user_id=$user_id AND callback.status = $status $cname $sdate $edate $betweenDate $ttype $ftype GROUP BY callback.callback_id ORDER BY callback.user_id;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result = json_encode($result);
        } else {
            $result = "";
        }
    } else {
        $result = mysqli_error($dbConnection);
    }
}



//Show all upcoming tasks 
if (isset($_GET['displayUpcoming'])) {
    $tasktypeID = $_GET['tasktype_id'] == "" ? "" : " AND callback.tasktype_id=" . $_GET['tasktype_id'] . "";
    $query = "SELECT DISTINCT callback.*,callback_extend.sub_task,callback_extend.comments FROM `callback` INNER JOIN callback_extend ON callback.callback_id = callback_extend.callback_id INNER JOIN assigned_tasktype ON assigned_tasktype.tasktype_id=callback.tasktype_id WHERE callback.user_id =$user_id $tasktypeID AND callback.DateStarted is NULL;";
    $result = mysqli_query($dbConnection, $query);
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = json_encode($result);
    } else {
        $result = "";
    }
}


//Show all the in display tasks
if (isset($_GET['displayProgress'])) {
    $tasktypeID = $_GET['tasktype_id'] == "" ? "" : " AND callback.tasktype_id=" . $_GET['tasktype_id'] . "";
    $query = "SELECT callback.*,SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) as total_time,callback_extend.sub_task,callback_extend.comments FROM `callback` INNER JOIN timerecord ON callback.callback_id=timerecord.callback_id INNER JOIN callback_extend ON callback.callback_id =callback_extend.callback_id INNER JOIN assigned_tasktype ON assigned_tasktype.tasktype_id=callback.tasktype_id WHERE callback.user_id =$user_id $tasktypeID AND callback.status=0 AND callback.DateStarted is not NULL GROUP BY callback.callback_id;";
    $result = mysqli_query($dbConnection, $query);
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = json_encode($result);
    } else {
        $result = "";
    }
}


if (isset($_GET['btnPlay'])) {
    $cb_id = $_GET['cb_id'];
    $query = "UPDATE `callback` SET `DateStarted`= CURDATE() WHERE `DateStarted` IS NULL AND callback_id = $cb_id ";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        $query = "INSERT INTO `timerecord`(`callback_id`,`TimeStarted`,`status`) VALUES ($cb_id,CURTIME(),0)";
        $result = mysqli_query($dbConnection, $query);
        if ($result) {
            $result = 'updated';
        }
    } else {
        $result = 'kek';
    }
}


if (isset($_GET['getTimeStatus'])) {
    $cb_id = $_GET['cb_id'];
    $query = "SELECT * FROM timerecord WHERE callback_id = $cb_id ORDER BY TimeRecord_ID desc";
    $result = mysqli_query($dbConnection, $query);
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        $result = json_encode($result);
    } else {
        $result = '';
    }
}

if (isset($_GET['btnPause'])) {
    $cb_id = $_GET['cb_id'];
    $query = "UPDATE `timerecord` SET  `TimeStop`= CURTIME(), TimeSpent=SUBTIME(CURTIME(),TimeStarted) ,status = 1 WHERE callback_id = $cb_id AND status= 0 ";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        $query = "UPDATE `callback` SET `TimeSpent`= (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) FROM timerecord WHERE timerecord.callback_id= $cb_id) WHERE callback.callback_id= $cb_id";
        $result = mysqli_query($dbConnection, $query);
        if ($result) {
            $result = 'updated';
        } else {
            $result = mysqli_error($dbConnection);
        }
    } else {
        $result = mysqli_error($dbConnection);
    }
}

if (isset($_GET['btnDelete'])) {
    $cb_id = $_GET['cb_id'];
    $query = "DELETE FROM `callback` WHERE callback_id = $cb_id ";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        $query = "DELETE FROM `timerecord` WHERE callback_id = $cb_id ";
        $result = mysqli_query($dbConnection, $query);
        if ($result) {
            $result = 'deleted';
        } else {
            $result = '';
        }
    } else {
        $result = '';
    }
}

if (isset($_GET['btnStop'])) {
    $cb_id = $_GET['cb_id'];
    $query = "UPDATE `callback` set DateStarted = NULL WHERE callback_id = $cb_id ";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        $query = "DELETE FROM `timerecord` WHERE callback_id = $cb_id ";
        $result = mysqli_query($dbConnection, $query);
        if ($result) {
            $result = 'stopped';
        } else {
            $result = '';
        }
    } else {
        $result = '';
    }
}


if (isset($_GET['btnFinish'])) {
    $cb_id = $_GET['cb_id'];
    $query = "UPDATE `callback` SET status = 1, DateEnded = CURDATE() WHERE callback_id = $cb_id";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        $query = "UPDATE `timerecord` SET status = 1, `TimeStop`= CURTIME(), TimeSpent=SUBTIME(CURTIME(),TimeStarted) WHERE callback_id = $cb_id and status = 0 ";
        $result = mysqli_query($dbConnection, $query);
        if ($result) {
            $query = "UPDATE `callback` SET `TimeSpent`= (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(timerecord.TimeSpent))) FROM timerecord WHERE timerecord.callback_id= $cb_id) WHERE callback.callback_id= $cb_id";
            $result = mysqli_query($dbConnection, $query);
            if ($result) {
                $result = 'updated';
            } else {
                $result = mysqli_error($dbConnection);
            }
        } else {
            $result = mysqli_error($dbConnection);
        }
    }
}


if (isset($_POST['btnSave'])) {
    $notes = $_POST['notes'];
    $subtask = $_POST['subtask'];
    $comments = $_POST['comments'];
    $cb_id = $_POST['cb_id'];
    $taskname = $_POST['taskname'];
    $tasktype = $_POST['tasktype'];
    $client = $_POST['client'];
    $employee = $_POST['employee'];
    $query = "UPDATE `callback` SET  user_id=$employee,TaskName = '$taskname', client_name='$client' ,Notes = '$notes',tasktype_id=$tasktype WHERE callback_id = $cb_id";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        $query = "UPDATE `callback_extend` SET sub_task = '$subtask', comments='$comments' WHERE callback_id = $cb_id";
        $result = mysqli_query($dbConnection, $query);
        if ($result) {
            $result = 'updated';
        } else {
            $result = mysqli_error($dbConnection);
        }
    } else {
        $result = mysqli_error($dbConnection);
    }
}



if (isset($_GET['getClientsJSON'])) {
    $query = "SELECT * FROM client";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result = json_encode($result);
        } else {
            echo mysqli_error($dbConnection);
        }
    } else {
        echo mysqli_error($dbConnection);
    }
}
if (isset($_GET['getAgentsJSON'])) {
    $query = "SELECT * FROM user";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result = json_encode($result);
        } else {
            echo mysqli_error($dbConnection);
        }
    } else {
        echo mysqli_error($dbConnection);
    }
}

if (isset($_GET['getTaskTypes'])) {
    $query = "SELECT tasktype.tasktype_id,tasktype.type,client.* FROM tasktype INNER JOIN client ON client.client_id = tasktype.client_id";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result = json_encode($result);
        } else {
            echo mysqli_error($dbConnection);
        }
    } else {
        echo mysqli_error($dbConnection);
    }
}

if (isset($_POST['addTaskType'])) {
    $query = "INSERT INTO `tasktype`(`type`, `client_id`) VALUES ('" . $_POST['tasktype'] . "'," . $_POST['client'] . ")";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        $result = "inserted";
    } else {
        $result = "mysqli_error($dbConnection)";
    }
}
if (isset($_POST['btnDeleteTaskType'])) {
    $query = "DELETE FROM `tasktype` WHERE tasktype_id=" . $_POST['tasktype_id'];
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        $result = 'deleted';
    } else {
        $result = mysqli_error($dbConnection);
    }
}
if (isset($_GET['getInputClientByTasktypeID'])) {
    $query = "SELECT client.ClientName,client.client_id FROM tasktype INNER JOIN client ON client.client_id = tasktype.client_id WHERE tasktype.tasktype_id =" . $_GET['tasktype_id'];
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result = json_encode($result);
        } else {
            $result = '';
        }
    } else {
        $result = mysqli_error($dbConnection);
    }
}
if (isset($_GET['getTimeStatusByID'])) {
    $query = "SELECT status FROM timerecord WHERE TimeRecord_id=" . $_GET['timerecord_id'];
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_assoc($result);
            $result = json_encode($result);
        }
    }
}
if (isset($_GET['getAssignedTaskTypes'])) {
    $query = "SELECT tasktype.tasktype_id,tasktype.type FROM assigned_tasktype INNER JOIN tasktype ON assigned_tasktype.tasktype_id = tasktype.tasktype_id WHERE assigned_tasktype.user_id=" . $user_id;
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result = json_encode($result);
        }
    }
}
if (isset($_FILES['image'])) {
    $title = $_POST["title"];
    $username=$_POST['uname'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    #temporary file name to store file
    $tname = $_FILES["image"]["tmp_name"];
    $img_size = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    #upload directory path
    $uploads_dir = './dist/profpic';
    #TO move the uploaded file to specific location
    if ($error == 0) {

        move_uploaded_file($tname, $uploads_dir . '/' . $title);
        $title=",`image_file`='$title'";
        
    }
        $sql = "UPDATE `user` SET `name`='$name',`email`='$email',`username`='$username',`password`='$password'$title WHERE `user_id`=$user_id";
        if (mysqli_query($dbConnection, $sql)) {

            
            $query = "SELECT * FROM user WHERE user_id = $user_id";
            $result =mysqli_query($dbConnection,$query);
            if(mysqli_num_rows($result)==1){
                $data = mysqli_fetch_assoc($result);
                $_SESSION['userInfo'] = $data;
                $result= "updated";
                
            }
        } else {
            $result= mysqli_error($dbConnection);
        }
}
echo $result;
