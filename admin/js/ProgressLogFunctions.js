Dropzone.autoDiscover = false;
$("div#dropzone-example").dropzone({
  url: "../php/upload", //Change the url to the php code
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: .5, // MB
  addRemoveLinks: true,
  dictDefaultMessage: '<span class="">Drop files (or click) to upload  </span> <br> \
                    <i class="fas fa-cloud-upload-alt"></i>',
  dictResponseError: 'Error while uploading file!',
});
$(".mt-2 ul li").removeClass("menu-open");
$(".mt-2 ul li a").removeClass("active");
$(".mt-2 ul li:nth-child(3)").addClass("menu-open");
$(".mt-2 ul li:nth-child(3) a").removeClass("active");
$(".mt-2 ul li:nth-child(3) ul li:nth-child(1)").addClass("menu-open")
$(".mt-2 ul li:nth-child(3) ul li:nth-child(1) a").addClass("active");
toastr.options.progressBar = true;
toastr.options.preventDuplicates = true;
toastr.options.closeButton = true;
$.widget.bridge('uibutton', $.ui.button);
$('[data-toggle="popover"]').popover();
var dt = $('#dataTable').DataTable({
  "oLanguage": {
    "sLengthMenu": "Show Entries _MENU_",
  },
  dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-6'l><'col-sm-2'i><'col-md-4'p>>",
  "pageLength": 10,
  "order": [],
  "columnDefs": [{
    "targets": 0,
    "orderable": false,
    "className": "text-center select-checkbox",
  }, {
    "targets": 9,
    "className": "text-center",
  }],
  select: { style: 'multi', selector: 'tr>td:nth-child(1)' },
  "paging": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  "responsive": true,
  "buttons": ["excel", "pdf", "print",]
});
dt.buttons().container().appendTo('#beforeLD');
new $.fn.dataTable.Buttons(dt, {
  "buttons": [{
    extend: 'excel',
    text: 'Excel Selected',
    exportOptions: {
      modifier: {
        selected: true
      }
    },
  }, {
    extend: 'pdf',
    text: 'PDF Selected',
    exportOptions: {
      modifier: {
        selected: true
      }
    },
  }, {
    extend: 'print',
    text: 'Print Selected',
    exportOptions: {
      modifier: {
        selected: true
      }
    },
  }]
}).container().appendTo('#beforeLD1');
refreshTable();
// DATE RANGE PICKER (DATE RANGE INPUT)
var startDate = '';
var endDate = '';
$('#actDate').daterangepicker({
  opens: 'left',
}, function (start, end, label) {
  startDate = start.format('YYYY-MM-DD');
  endDate = end.format('YYYY-MM-DD');
});
$('#actDate').val('');
$('#actDate').attr("placeholder", "Between First & Last Date");
function refreshTable() {
  let cb = "";
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      getAllInProgressTask: 'true',
      status: 0
    },
    success: function (response) {
      if(response ==""){
        return false;
      }
      data = JSON.parse(response);
      dt.clear().draw();
      for (var da in data) {
        btn = `<button class="btn btn-success btn-sm waves-effect waves-light text-center" onclick='taskInfo(` + JSON.stringify(data[da]) + `)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>`;
        time = data[da].current_time_spent == null ? data[da].TimeSpent : data[da].current_time_spent;
        const timeArr = time.split(":");
        time = timeArr[0] + "hrs " + timeArr[1] + "mins " + timeArr[2] + "sec";
        dt.row.add([
          cb,
          data[da].TaskName,
          data[da].client_name,
          data[da].type,
          data[da].name,
          data[da].Notes,
          data[da].DateStarted,
          "Task In Progress",
          // data[da].DueDate,
          'Running',
          btn,
        ]).draw();
      }
    }
  });
  return false;
}
function searchTable() {
  let searchClientName = document.getElementById("clientName").value;
  let searchAgentName = document.getElementById("agentName").value;
  let searchStartDate = document.getElementById("startDate").value;
  let searchEndDate = document.getElementById("endDate").value;
  let searchTaskType = document.getElementById("taskType").value;
  // let searchFlagType = document.getElementById("flagType").value;
  cb = '';
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      search: true,
      searchClientName: searchClientName,
      searchStartDate: searchStartDate,
      searchEndDate: searchEndDate,
      searchAgentName: searchAgentName,
      startDate: startDate,
      endDate: endDate,
      searchTaskType: searchTaskType,
      status: 0
    },
    success: function (response) {
      if (response != "") {
        data = JSON.parse(response);
        dt.clear().draw();
        for (var da in data) {
          btn = `<button class="btn btn-success btn-sm waves-effect waves-light text-center" onclick='taskInfo(` + JSON.stringify(data[da]) + `)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>`;
          time = data[da].current_time_spent == null ? data[da].TimeSpent : data[da].current_time_spent;
          const timeArr = time.split(":");
          time = timeArr[0] + "hrs " + timeArr[1] + "mins " + timeArr[2] + "sec";
          dt.row.add([
            cb,
            data[da].TaskName,
            data[da].client_name,
            data[da].type,
            data[da].name,
            data[da].Notes,
            data[da].DateStarted,
            "Task In Progress",
            // data[da].DueDate,
            'Running',
            btn,
          ]).draw();
        }
      } else {
        dt.clear().draw();
      }
    }
  });
  return false;
}
function clearSearch(type) {
  switch (type) {
    case 1:
      $("#clientName").prop('selectedIndex', 0);
      break;
    case 2:
      document.getElementById("startDate").valueAsDate = null;
      break;
    case 3:
      document.getElementById("endDate").valueAsDate = null;
      break;
    case 4:
      document.getElementById("timeHr").value = '';
      document.getElementById("timeMn").value = '';
      break;
    case 5:
      $("#taskType").prop('selectedIndex', 0);
      break;
    case 6:
      $('#actDate').val('');
      startDate = '';
      endDate = '';
      break;
    case 8: 
      $("#agentName").prop('selectedIndex', 0);
      break; 
    case 7:
      $("#clientName").prop('selectedIndex', 0);
      $("#agentName").prop('selectedIndex', 0);
      $("#taskType").prop('selectedIndex', 0);
      $('#actDate').val('');
      startDate = '';
      endDate = '';
      document.getElementById("startDate").valueAsDate = null;
      document.getElementById("endDate").valueAsDate = null;
      document.getElementById("timeHr").value = '';
      document.getElementById("timeMn").value = '';
      break;
  }
  searchTable();

}
$("#btnDelete").click(function () {
  if (confirm("Are you sure you want to delete this task?")) {
    $(".modal").modal("hide");
    w3.show('#logoloader');
    $.ajax({
      type: 'get',
      url: './main.php',
      data: {
        btnDelete: true,
        cb_id: this.value,
      },
      success: function (response) {
        if (response == 'deleted') {
          toastr.success("Task Deleted");
          searchTable();
        } else {
          toastr.error("There was an error!");
        }
        w3.hide('#logoloader');
      }
    });
  }

});
function taskInfo(data) {
  if (data.total_time == null) {
    data.total_time = '00:00:00';
  }
  setButtonForProgress(data.callback_id);
  if ($("#btnPlay").prop("disabled")) {
    $("#modalStatus").html("Running");
  } else {
    $("#modalStatus").html("Paused");
  }
  $("#btnPlay").val(data.callback_id);
  $("#btnPause").val(data.callback_id);
  $("#btnStop").val(data.callback_id);
  $("#btnDelete").val(data.callback_id);
  $("#btnFinish").val(data.callback_id);
  $("#btnSave").val(data.callback_id);
  $("#inputDescription2").val(data.Notes);
  $("#modalTaskName").html(data.TaskName);
  $("#modalStartDate").html(data.DateStarted == null ? "---" : data.DateStarted);
  $("#modalEndDate").html(data.DateEnded == null ? "Task In Progress" : data.DateEnded);
  $("#modalTimeSpent").html(data.TimeSpent.match("00:00:00") ? "---" : data.TimeSpent);
  $("#inputSubTasks").val(data.sub_task);
  $("#inputComments").val(data.comments);
  $("#modalAgent").html(data.name);
  $("#modalClient").html(data.client_name);
  // $("#modalDueDate").html(data.DueDate);
  $("#inputClient").val(data.client_name);
  $("#inputTaskName").val(data.TaskName);
  $("#inputEmployee").val(data.user_id);
  $("#inputTaskType").val(data.tasktype_id);


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
        $("#btnStop").prop('disabled', false);
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
  $(".modal").modal("hide");
    w3.show('#logoloader');
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      btnPlay: true,
      cb_id: this.value,
    },
    success: function (response) {
      if (response == 'updated') {
        toastr.success("Task started");
        refreshTable();
      } else {
        toastr.error("There was an error!");
      }
      w3.hide('#logoloader');
    }
  });
});
$("#btnPause").click(function () {
  $(".modal").modal("hide");
    w3.show('#logoloader');
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      btnPause: true,
      cb_id: this.value,
    },
    success: function (response) {
      if (response == 'updated') {
        toastr.success("Task Paused");
        refreshTable();
      } else {
        toastr.error("There was an error!");
      }
      w3.hide('#logoloader');
    }
  });
});
$("#btnStop").click(function () {
  if (confirm("Are you sure you want to stop and reset this task?")) {
    $(".modal").modal("hide");
    w3.show('#logoloader');
    $.ajax({
      type: 'get',
      url: './main.php',
      data: {
        btnStop: true,
        cb_id: this.value,
      },
      success: function (response) {
        if (response == 'stopped') {
          toastr.success("Task Stopped");
          refreshTable();
        } else {
          toastr.error("There was an error!");
        }
        w3.hide('#logoloader');
      }
    });
  }
});
$("#btnFinish").click(function () {
  $(".modal").modal("hide");
    w3.show('#logoloader');
  $.ajax({
    type: 'get',
    url: './main.php',
    data: {
      btnFinish: true,
      cb_id: this.value,
    },
    success: function (response) {
      if (response == 'updated') {
        toastr.success("Task Finish!");
        refreshTable();
      } else {
        toastr.error(response);
      }
      w3.hide('#logoloader');
    }
  });

});
$("#btnSave").click(function () {
  $(".modal").modal("hide");
  w3.show('#logoloader');
  notes = $("#inputDescription2").val();
  subtask = $("#inputSubTasks").val();
  comments = $("#inputComments").val();
  taskname = $("#inputTaskName").val();
  tasktype = $("#inputTaskType").val();
  client = $("#inputClient").val();
  employee = $("#inputEmployee").val();
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
        toastr.success("Task Saved!");
        refreshTable();
      } else {
        toastr.error(response);
      }
      w3.hide('#logoloader');
    }
  });
  return false;
});
