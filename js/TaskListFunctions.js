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
      "order": [],
      "columnDefs": [ {
        "targets"  : 0,
        "orderable": false,
        "className": "text-center select-checkbox",
      }],
      select:{style:'multi'},
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
              cb,
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
        cb='';
        $.ajax({
            type:'get',
            url:'./main.php',
            data:{
              searchClientName:searchClientName,
              searchStartDate:searchStartDate,
              searchEndDate:searchEndDate,
              searchTime:searchTime,
              startDate:startDate,
              endDate:endDate,
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
                          cb,
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
  