toastr.options.progressBar = true;
toastr.options.preventDuplicates = true;
toastr.options.closeButton = true;
displayUpcomingTask();  
displayInProgress();
$("#btnPlay").click(function() {
  $("#btnPlay").attr("disabled", true);
  $(".modal").modal("hide");
  toastr.success("Task started");
});
$("#btnPause").click(function() {
  $("#btnPause").attr("disabled", true);
  $("#btnPlay").attr("disabled", false);
  $(".modal").modal("hide");
  toastr.success("Task paused");
});
$("#btnStop").click(function() {
  $("#btnPlay").attr("disabled", true);
  $("#btnPause").attr("disabled", true);
  $("#btnStop").attr("disabled", true);
  $(".modal").modal("hide");
  toastr.success("Task stopped");
});
$.widget.bridge('uibutton', $.ui.button);
$('[data-toggle="popover"]').popover();
  var dt = $('#dataTable').DataTable({
    "oLanguage": {
      "sLengthMenu": "Show Entries _MENU_",
    },
    dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-6'l><'col-sm-2'i><'col-md-4'p>>",
    "pageLength": 10,
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
  refreshTable();
function checkID(value){
  toastr.error(value);
}
function refreshTable(){
  $.ajax({
    type:'get',
    url:'./main.php',
    data:{
      getTaskByUser:'true'
    },
    success:function(response){
      var btnStart= '<button type="button" class="btn btn-primary" onclick="refreshTable()">Start</button>';
      var btnPause='<button type="button" class="btn btn-success">Pause</button>';
      var btnStop='<button type="button" class="btn btn-danger">Stop</button>';
      var cb ='';
      data = JSON.parse(response);
      dt.clear().draw();
      for(var da in data){
        btnStart= '<button type="button" class="btn btn-primary" value="'+data[da].callback_id+'">Start</button>';
        btnPause='<button type="button" class="btn btn-success" value="'+data[da].callback_id+'">Pause</button>';
        btnStop='<button type="button" class="btn btn-danger" value="'+data[da].callback_id+'">Stop</button>';
        cb ='<input class="form-control" type="checkbox" name="list[]" value="'+data[da].callback_id+'">';
        dt.row.add([
          cb,
          data[da].TaskName,
          data[da].client_name,
          data[da].Notes,
          data[da].TimeSpent,
          data[da].TimeSpent,
          data[da].TimeSpent,
          btnStart,
          btnPause,
          btnStop,
        ]).draw();
      }
    }
  });
  return false;
}
function addTask(){
  taskname= $("#inputTaskName").val();
  clientname=$("#inputClientID").val();
  notes=$("#inputNotes").val();

  
  $.ajax({
    type:'get',
    url:'./main.php',
    data:{
      taskname:taskname,
      clientname:clientname,
      notes:notes
    },
    success:function(response){
      if(response=='Task Created'){
        toastr.success(response);
        document.getElementById("addTaskForm").reset();
        $(".modal").modal("hide");
        displayUpcomingTask();
      }
      else{
        toastr.error(response);
      }
    }
  });
  return false;
}
  function displayUpcomingTask(){
    let content = '';
    $.ajax({
      type:'get',
      url:'./main.php',
      data:{
        displayUpcoming:true
      },
      success:function(response){
        result = JSON.parse(response);
        $.each(result, function(key, item) {
          let str = JSON.stringify(item);
          content+=`<li class="task-warning ui-sortable-handle" id="task1">
          <div class="checkbox checkbox-custom checkbox-single float-right">
            <input type="checkbox" aria-label="Single checkbox Two">
            <label></label>
          </div>
          <b>`+item.TaskName+`</b>
          <div class="clearfix"></div>
          `+item.Notes+`
          <div class="mt-3">
            <p class="float-right">
              <button class="btn btn-success btn-sm waves-effect waves-light" onclick='taskInfo(`+str+`)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>
            </p>
            <p class="mb-2">Client:
              <span><i>`+item.client_name+`</i></span>
            </p>
          </div>
        </li>`;
        });
        $("#upcoming ul").html(content);
      }
    });
    return false;
  }
  function displayInProgress(){
    let content = '';
    $.ajax({
      type:'get',
      url:'./main.php',
      data:{
        displayProgress:true
      },
      success:function(response){
        result = JSON.parse(response);
        $.each(result, function(key, item) {
          let str = JSON.stringify(item);
          content+=`<li class="task-warning ui-sortable-handle" id="task1">
          <div class="checkbox checkbox-custom checkbox-single float-right">
            <input type="checkbox" aria-label="Single checkbox Two">
            <label></label>
          </div>
          <b>`+item.TaskName+`</b>
          <div class="clearfix"></div>
          `+item.Notes+`
          <div class="mt-3">
            <p class="float-right">
              <button class="btn btn-success btn-sm waves-effect waves-light" onclick='taskInfo(`+str+`)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>
            </p>
            <p class="mb-2">Client:
              <span><i>`+item.client_name+`</i></span>
            </p>
          </div>
        </li>`;
        });
        $("#inProgress ul").html(content);
      }
    });
    return false;
  }

  function taskInfo(data){
    $("#inputDescription2").val(data.Notes);
    $("#modalTaskName").html(data.TaskName);
    $("#modalStartDate").html(data.DateStarted==null?"---":data.DateStarted);
    $("#modalEndDate").html(data.DateEnded==null?"---":data.DateEnded);
    $("#modalTimeSpent").html(data.TimeSpent.match("00:00:00")?"---":data.TimeSpent);
  }