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
        refreshTable();
      }
      else{
        toastr.error(response);
      }
    }
  });
  return false;
}