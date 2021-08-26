toastr.options.progressBar = true;
toastr.options.preventDuplicates = true;
toastr.options.closeButton = true;
displayUpcomingTask();  
displayInProgress();
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
  agent = $("#inputAgentID").val();
  
  $.ajax({
    type:'get',
    url:'./main.php',
    data:{
      taskname:taskname,
      clientname:clientname,
      notes:notes,
      agent:agent
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
        if(response ==''){
          $("#upcoming ul").html(content);
          return false;
        }
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
          `+nl2br(item.Notes)+`
          <div class="mt-3">
            <p class="mb-1">Agent:
              <span><i>`+item.name+`</i></span>
            </p>
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
        if(response ==''){
          $("#inProgress ul").html(content);
          return false;
        }
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
          `+nl2br(item.Notes)+`
          <div class="mt-3">
            <p class="mb-1">Agent:
              <span><i>`+item.name+`</i></span>
            </p>
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
    if(data.total_time == null){
      data.total_time='';
    }
    if(data.DateStarted == null){
      $("#btnPause").prop('disabled', true);
      $("#btnStop").prop('disabled', true);
      $("#btnFinish").prop('disabled', true);
    }
    setButtonForProgress(data.callback_id);
    $("#btnPlay").val(data.callback_id);
    $("#btnPause").val(data.callback_id);
    $("#btnStop").val(data.callback_id);
    $("#btnDelete").val(data.callback_id);
    $("#btnFinish").val(data.callback_id);
    $("#btnSave").val(data.callback_id);
    $("#inputDescription2").val(data.Notes);
    $("#modalTaskName").html(data.TaskName);
    $("#modalStartDate").html(data.DateStarted==null?"---":data.DateStarted);
    $("#modalEndDate").html(data.DateEnded==null?"---":data.DateEnded);
    $("#modalTimeSpent").html(data.total_time.match("")?"---":data.total_time);
    $("#inputSubTasks").val(data.sub_task);
    $("#inputComments").val(data.comments);
    $("#modalAgent").html(data.name);
    $("#modalClient").html(data.client_name);
  }
  function setButtonForProgress(cb_id){
    $.ajax({
      type:'get',
      url:'./main.php',
      data:{
        getTimeStatus:true,
        cb_id:cb_id
      },
      success:function(response){
        
        if(response == ''){
          $("#btnPlay").prop('disabled', false);
          return false;
        }
        result = JSON.parse(response);
        if(result.status==1){
          $("#btnPlay").prop('disabled', false);
          $("#btnPause").prop('disabled', true);
          $("#btnStop").prop('disabled', true);
        }else{
          $("#btnPlay").prop('disabled', true);
          $("#btnPause").prop('disabled', false);
          $("#btnStop").prop('disabled', false);
          $("#btnFinish").prop('disabled', false);
        }
      }
    });

  }
  $("#btnPlay").click(function() {
    $.ajax({
      type:'get',
      url:'./main.php',
      data:{
        btnPlay:true,
        cb_id:this.value,
      },
      success:function(response){
        if(response == 'updated'){
          $(".modal").modal("hide");
          toastr.success("Task started");
          displayInProgress();
          displayUpcomingTask();
        }else{
          toastr.error("There was an error!");
        }
        
      }
    });
  });
  $("#btnPause").click(function(){
    $.ajax({
      type:'get',
      url:'./main.php',
      data:{
        btnPause:true,
        cb_id:this.value,
      },
      success:function(response){
        if(response == 'updated'){
          $(".modal").modal("hide");
          toastr.success("Task Paused");
          displayInProgress();
          displayUpcomingTask();
        }else{
          toastr.error("There was an error!");
        }
        
      }
    });
  });
  $("#btnStop").click(function() {
    if(confirm("Are you sure you want to stop and reset this task?")){
      $.ajax({
        type:'get',
        url:'./main.php',
        data:{
          btnStop:true,
          cb_id:this.value,
        },
        success:function(response){
          if(response == 'stopped'){
            $(".modal").modal("hide");
            toastr.success("Task Stopped");
            displayInProgress();
            displayUpcomingTask();
          }else{
            toastr.error("There was an error!");
          }
          
        }
      });
    }
  });
  $("#btnDelete").click(function() {
    if(confirm("Are you sure you want to delete this task?")){
      $.ajax({
        type:'get',
        url:'./main.php',
        data:{
          btnDelete:true,
          cb_id:this.value,
        },
        success:function(response){
          if(response == 'deleted'){
            $(".modal").modal("hide");
            toastr.success("Task Deleted");
            displayInProgress();
            displayUpcomingTask();
          }else{
            toastr.error("There was an error!");
          }
          
        }
      });
    }
    
  });
  $("#btnFinish").click(function() {
    $.ajax({
      type:'get',
      url:'./main.php',
      data:{
        btnFinish:true,
        cb_id:this.value,
      },
      success:function(response){
        if(response == 'updated'){
          $(".modal").modal("hide");
          toastr.success("Task Finish!");
          displayInProgress();
          displayUpcomingTask();
        }else{
          toastr.error(response);
        }
        
      }
    });
    
  });
  $("#btnSave").click(function() {
    notes = $("#inputDescription2").val();
    subtask=$("#inputSubTasks").val();
    comments=$("#inputComments").val();
    $.ajax({
      type:'post',
      url:'./main.php',
      data:{
        btnSave:true,
        cb_id:this.value,
        notes:notes,
        subtask:subtask,
        comments:comments
      },
      success:function(response){
        if(response == 'updated'){
          $(".modal").modal("hide");
          toastr.success("Task Saved!");
          displayInProgress();
          displayUpcomingTask();
        }else{
          toastr.error(response);
        }
        
      }
    });
    return false;
  });
  function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}