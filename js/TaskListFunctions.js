    //SIDEBAR ACTIVE BUTTON
    $(".mt-2 ul li").removeClass("menu-open");
    $(".mt-2 ul li a").removeClass("active");
    $(".mt-2 ul li:nth-child(3)").addClass("menu-open");
    $(".mt-2 ul li:nth-child(3) a").addClass("active");
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
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": ["excel", "pdf", "print"]
      });
      dt.buttons().container().appendTo('#beforeLD');
      refreshTable();
      // DATE RANGE PICKER (DATE RANGE INPUT)
      var startDate ='';
      var endDate = '';
      $('#actDate').daterangepicker({
        opens: 'left',
      }, function(start, end, label) {
        startDate = start.format('YYYY-MM-DD');
        endDate = end.format('YYYY-MM-DD');
        searchBy('');
      });
      $('#actDate').val('');
      $('#actDate').attr("placeholder","Between First & Last Date");
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
          data = JSON.parse(response);
          dt.clear().draw();
          for(var da in data){
            time = data[da].TimeSpent;
            const timeArr=time.split(":");
            time = timeArr[0]+"hrs "+timeArr[1]+"mins";
            dt.row.add([
              data[da].callback_id,
              data[da].TaskName,
              data[da].client_name,
              data[da].Notes,
              data[da].DateStarted,
              data[da].DateEnded,
              time,
            ]).draw();
          }
        }
      });
      return false;
    }
    function searchTable(){
        let searchClientName = document.getElementById("clientName").value;
        let searchStartDate = document.getElementById("startDate").value;
        let searchEndDate = document.getElementById("endDate").value;
        let searchHr=document.getElementById("timeHr").value;
        let searchMn=document.getElementById("timeMn").value;
        mn = searchMn==""?"00":searchMn;
        hr = searchHr==""?"00":searchHr;
        let searchTime=hr+":"+mn;
        $.ajax({
            type:'get',
            url:'./main.php',
            data:{
              searchClientName:searchClientName,
              searchStartDate:searchStartDate,
              searchEndDate:searchEndDate,
              searchTime:searchTime,

            },
            success:function(response){
                if(response !=""){
                    data = JSON.parse(response);
                      dt.clear().draw();
                      for(var da in data){
                        time = data[da].TimeSpent;
                        const timeArr=time.split(":");
                        time = timeArr[0]+"hrs "+timeArr[1]+"mins";
                        dt.row.add([
                          data[da].callback_id,
                          data[da].TaskName,
                          data[da].client_name,
                          data[da].Notes,
                          data[da].DateStarted,
                          data[da].DateEnded,
                          time,
                        ]).draw();
                      }
                }else{
                    dt.clear().draw();
                }  
            }
          });
          return false;
    }
  