    //SIDEBAR ACTIVE BUTTON
    $(".mt-2 ul li").removeClass("menu-open");
    $(".mt-2 ul li a").removeClass("active");
    $(".mt-2 ul li:nth-child(3)").addClass("menu-open");
    $(".mt-2 ul li:nth-child(3) a").removeClass("active");
    $(".mt-2 ul li:nth-child(3) ul li:nth-child(2)").addClass("menu-open");
    $(".mt-2 ul li:nth-child(3) ul li:nth-child(2) a").addClass("active");
    //---------------------------------------------
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
      "columnDefs": [ {
        "targets"  : 0,
        "orderable": false,
        "className": "text-center select-checkbox",
      },{
        "targets"  : 10,
        "className": "text-center",
      }],
      select:{style:'multi',selector: 'tr>td:nth-child(1)'},
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["excel", "pdf", "print",]
    });
    dt.buttons().container().appendTo('#beforeLD');
    new $.fn.dataTable.Buttons( dt, {
      "buttons": [{
        extend: 'excel',
        text: 'Excel Selected',
        exportOptions: {
            modifier: {
                selected: true
            }
        },
    },{
      extend: 'pdf',
      text: 'PDF Selected',
      exportOptions: {
          modifier: {
              selected: true
          }
      },
  },{
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
    var startDate ='';
    var endDate = '';
    $('#actDate').daterangepicker({
      opens: 'left',
    }, function(start, end, label) {
      startDate = start.format('YYYY-MM-DD');
      endDate = end.format('YYYY-MM-DD');
    });
    $('#actDate').val('');
    $('#actDate').attr("placeholder","Between First & Last Date");
    function checkID(value){
      toastr.error(value);
    }
    function refreshTable(){
      let cb="";
      $.ajax({
        type:'get',
        url:'./main.php',
        data:{
          getAllTask:'true',
          status:1
        },
        success:function(response){
          data = JSON.parse(response);
          dt.clear().draw();
          for(var da in data){
            btn =`<button class="btn btn-success btn-sm waves-effect waves-light text-center" onclick='taskInfo(`+JSON.stringify(data[da])+`)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>`;
            time = data[da].TimeSpent;
            const timeArr=time.split(":");
            time = timeArr[0]+"hrs "+timeArr[1]+"mins";
            dt.row.add([
              cb,
              "TO BE ATTACHED",
              data[da].TaskName,
              data[da].client_name,
              data[da].type,
              data[da].name,
              data[da].Notes,
              data[da].DateStarted,
              data[da].DateEnded,
              // data[da].DueDate,
              time,
              btn,
            ]).draw();
          }
        }
      });
      return false;
    }
    function searchTable(){
        let searchClientName = document.getElementById("clientName").value;
        let searchAgentName = document.getElementById("agentName").value;
        let searchStartDate = document.getElementById("startDate").value;
        let searchEndDate = document.getElementById("endDate").value;
        let searchTaskType = document.getElementById("taskType").value;
        // let searchDueDate=document.getElementById("dueDate").value;
        cb='';
        $.ajax({
            type:'get',
            url:'./main.php',
            data:{
              search:true,
              searchClientName:searchClientName,
              searchStartDate:searchStartDate,
              searchEndDate:searchEndDate,
              searchAgentName:searchAgentName,
              startDate:startDate,
              endDate:endDate,
              searchTaskType:searchTaskType,
              // searchDueDate:searchDueDate,
              status:1
            },
            success:function(response){
                if(response !=""){
                    data = JSON.parse(response);
                      dt.clear().draw();
                      for(var da in data){
                        btn =`<button class="btn btn-success btn-sm waves-effect waves-light text-center" onclick='taskInfo(`+JSON.stringify(data[da])+`)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>`;
                        time = data[da].TimeSpent;
                        const timeArr=time.split(":");
                        time = timeArr[0]+"hrs "+timeArr[1]+"mins "+timeArr[2]+"sec";
                        dt.row.add([
                          cb,
                          "TO BE ATTACHED",
                          data[da].TaskName,
                          data[da].client_name,
                          data[da].type,
                          data[da].name,
                          data[da].Notes,
                          data[da].DateStarted,
                          data[da].DateEnded,
                          // data[da].DueDate,
                          time,
                          btn,
                        ]).draw();
                      }
                }else{
                    dt.clear().draw();
                }  
            }
          });
          return false;
    }
    function selectAll(source) {
      sa = document.getElementById("selectAll").checked;
      checkboxes = document.getElementsByName('list[]');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = sa;
      }
    }
    function clearSearch(type){
      switch(type){
        case 1:
          $("#clientName").prop('selectedIndex',0);
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
          $('#actDate').val('');
          startDate ='';
          endDate='';
          break;
        case 6:
          $("#clientName").prop('selectedIndex',0);
          document.getElementById("startDate").valueAsDate = null;
          document.getElementById("endDate").valueAsDate = null;
          document.getElementById("timeHr").value = '';
          document.getElementById("timeMn").value = '';
          $('#actDate').val('');
          startDate ='';
          endDate='';
          break;
      }
      searchTable();

    }
  function taskInfo(data){
    if(data.total_time == null){
      data.total_time='00:00:00';
    }
    $("#modalStatus").html("Finished");
    $("#btnPlay").prop('disabled', true);
    $("#btnPause").prop('disabled', true);
    $("#btnStop").prop('disabled', true);
    $("#btnFinish").prop('disabled', true);
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
    $("#modalTimeSpent").html(data.TimeSpent.match("00:00:00")?"---":data.TimeSpent);
    $("#inputSubTasks").val(data.sub_task);
    $("#inputComments").val(data.comments);
    $("#modalAgent").html(data.name);
    $("#modalClient").html(data.client_name);
    $("#modalDueDate").html(data.DueDate);
    $("#inputClient").val(data.client_name);
    $("#inputTaskName").val(data.TaskName);
    $("#inputEmployee").val(data.user_id);
    $("#inputTaskType").val(data.tasktype_id);
  }
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
          refreshTable();
        }else{
          toastr.error(response);
        }
        
      }
    });
    return false;
    
  });
  $("#btnSearch").click(function(){
    searchTable();
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
            searchTable();
          } else {
            toastr.error("There was an error!");
          }
  
        }
      });
    }
  
  });
  