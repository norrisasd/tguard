toastr.options.progressBar = true;
toastr.options.preventDuplicates = true;
toastr.options.closeButton = true;

displayUpcomingTask();
displayInProgress();
$.widget.bridge('uibutton', $.ui.button);
$('[data-toggle="popover"]').popover();

function checkID(value) {
  toastr.error(value);
}

function addTask() {
  taskname = $("#inputTaskName").val();
  clientname = $("#inputClientID").val();
  notes = $("#inputNotes").val();
  agent = $("#inputAgentID").val();
  subtask = $("#subTasks").val();
  tasktype= $("#inputTaskType").val();
  // duedate = document.getElementById("inputDueDate").value;
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      taskname: taskname,
      clientname: clientname,
      notes: notes,
      agent: agent,
      // duedate: duedate,
      subtask: subtask,
      tasktype:tasktype
    },
    success: function (response) {
      if (response.match("Task Created!")=='Task Created!') {
        toastr.success(response);
        document.getElementById("addTaskForm").reset();
        $(".modal").modal("hide");
        displayUpcomingTask();
      }
      else {
        toastr.error(response);
      }
    }
  });
  return false;
}

function displayUpcomingTask() {
  let content = '';
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      displayUpcoming: true,
      tasktype_id:localStorage.getItem("tasktype_id")
    },
    success: function (response) {
      if (response == '') {
        $("#upcoming ul").html(content);
        return false;
      }
      result = JSON.parse(response); 
      $.each(result, function (key, item) {
        let str = JSON.stringify(item);
        content += `<li class="task-warning ui-sortable-handle">
        <!-- 
        <div class="float-right">
        <p class="" id="duedate">Due Date: <b>`+ item.DueDate + `</b></p>
        </div> -->
          <b>`+ item.TaskName + `</b>
          <div class="clearfix"></div>
          `+ nl2br(item.Notes) + `
          <div class="mt-3">
            <!-- <p class="mb-1">Employee:
              <span><i>`+ item.name + `</i></span>
            </p> -->
            <p class="float-right">
              <button class="btn btn-success btn-sm waves-effect waves-light" onclick='taskInfo(`+ str + `)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>
            </p>
            <p class="mb-2">Client:
              <span><i>`+ item.client_name + `</i></span>
            </p>
          </div>
        </li>`;
      });
      $("#upcoming ul").html(content);
    }
  });
  return false;
}

function displayInProgress() {
  let content = '';
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      displayProgress: true,
      tasktype_id: localStorage.getItem("tasktype_id")
    },
    success: function (response) {
      if (response == "") {
        $("#inProgress ul").html(content);
        return false;
      }
      result = JSON.parse(response);
      $.each(result, function (key, item) {
        let str = JSON.stringify(item);
        content += `<li class="task-warning ui-sortable-handle" id="task1">
        <!-- <div class="float-right">
        <p class="" id="duedate">Due Date: <b>January 01, 2021</b></p>
        </div> -->
          <b>`+ item.TaskName + `</b>
          <div class="clearfix"></div>
          `+ nl2br(item.Notes) + `
          <div class="mt-3">
            <p class="float-right">
              <button class="btn btn-success btn-sm waves-effect waves-light" onclick='taskInfo(`+ str + `)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>
            </p>
            <p class="mb-2">Client:
              <span><i>`+ item.client_name + `</i></span>
            </p>
          </div>
        </li>`;
      });
      $("#inProgress ul").html(content);
    }
  });
  return false;
}

function taskInfo(data) {
  if (data.total_time == null) {
    data.total_time = '';
  }
  if (data.DateStarted == null) {
    $("#btnPause").prop('disabled', true);
    $("#btnStop").prop('disabled', true);
    $("#btnFinish").prop('disabled', true);
  } else {
    if ($('#btnPlay').prop('disabled')) {
      $("#modalStatus").html("Running");
    } else {
      $("#modalStatus").html("Paused");
    }
  }
  setButtonForProgress(data.callback_id);
  $("#btnPlay").val(data.callback_id);
  $("#btnPause").val(data.callback_id);
  $("#btnStop").val(data.callback_id);
  $("#btnDelete").val(data.callback_id);
  $("#btnFinish").val(data.callback_id);
  $("#btnSave").val(data.callback_id);
  $("#inputDescription2").val(data.Notes);
  $("#viewTaskName").val(data.TaskName);
  $("#modalStartDate").html(data.DateStarted == null ? "---" : data.DateStarted);
  $("#modalEndDate").html(data.DateEnded == null ? "---" : data.DateEnded);
  $("#modalTimeSpent").html(data.total_time == "" ? "---" : data.total_time);
  $("#inputSubTasks").val(data.sub_task);
  $("#inputComments").val(data.comments);
  $("#modalAgent").html(data.name);
  $("#modalClient").html(data.client_name);
  $("#modalDueDate").html(data.DueDate);
  $("#viewTaskType").val(data.tasktype_id);
  setInputClientView(data.tasktype_id);
  $("#viewEmployee").val(data.user_id);
}
function nl2br(str, is_xhtml) {
  if (typeof str === 'undefined' || str === null) {
    return '';
  }
  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function setButtonForProgress(cb_id) {
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      getTimeStatus: true,
      cb_id: cb_id
    },
    success: function (response) {

      if (response == '') {
        $("#btnPlay").prop('disabled', false);
        return false;
      }
      result = JSON.parse(response);
      if (result.status == 1) {
        $("#btnPlay").prop('disabled', false);
        $("#btnPause").prop('disabled', true);
        $("#btnStop").prop('disabled', true);
      } else {
        $("#btnPlay").prop('disabled', true);
        $("#btnPause").prop('disabled', false);
        $("#btnStop").prop('disabled', false);
        $("#btnFinish").prop('disabled', false);
      }
    }
  });
}

$("#btnPlay").click(function () {
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      btnPlay: true,
      cb_id: this.value,
    },
    success: function (response) {
      if (response == 'updated') {
        $(".modal").modal("hide");
        toastr.success("Task started");
        displayInProgress();
        displayUpcomingTask();
      } else {
        toastr.error("There was an error!");
      }

    }
  });
});

$("#btnPause").click(function () {
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      btnPause: true,
      cb_id: this.value,
    },
    success: function (response) {
      if (response == 'updated') {
        $(".modal").modal("hide");
        toastr.success("Task Paused");
        displayInProgress();
        displayUpcomingTask();
      } else {
        toastr.error("There was an error!");
      }

    }
  });
});

$("#btnStop").click(function () {
  if (confirm("Are you sure you want to stop and reset this task?")) {
    $.ajax({
      type: 'get',
      url: './main.php',
      data: {
        btnStop: true,
        cb_id: this.value,
      },
      success: function (response) {
        if (response == 'stopped') {
          $(".modal").modal("hide");
          toastr.success("Task Stopped");
          displayInProgress();
          displayUpcomingTask();
        } else {
          toastr.error("There was an error!");
        }

      }
    });
  }
});

$("#btnDelete").click(function () {
  if (confirm("Are you sure you want to delete this task?")) {
    $.ajax({
      type: 'get',
      url: './main.php',
      data: {
        btnDelete: true,
        cb_id: this.value,
      },
      success: function (response) {
        if (response == 'deleted') {
          $(".modal").modal("hide");
          toastr.success("Task Deleted");
          displayInProgress();
          displayUpcomingTask();
        } else {
          toastr.error("There was an error!");
        }

      }
    });
  }

});
$("#btnFinish").click(function () {
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      btnFinish: true,
      cb_id: this.value,
    },
    success: function (response) {
      if (response == 'updated') {
        $(".modal").modal("hide");
        toastr.success("Task Finish!");
        displayInProgress();
        displayUpcomingTask();
      } else {
        toastr.error(response);
      }

    }
  });

});
$("#btnSave").click(function () {
  notes = $("#inputDescription2").val();
  subtask = $("#inputSubTasks").val();
  comments = $("#inputComments").val();
  taskname = $("#viewTaskName").val();
  tasktype = $("#viewTaskType").val();
  client = $("#viewClient").val();
  employee = $("#viewEmployee").val();

  $.ajax({
    type: 'post',
    url: './main.php',
    data: {
      btnSave: true,
      cb_id: this.value,
      notes: notes,
      subtask: subtask,
      comments: comments,
      taskname: taskname,
      tasktype: tasktype,
      client: client,
      employee: employee,
    },
    success: function (response) {
      if (response == 'updated') {
        $(".modal").modal("hide");
        toastr.success("Task Saved!");
        displayInProgress();
        displayUpcomingTask();
      } else {
        toastr.error(response);
      }
    }
  });
  return false;
});


