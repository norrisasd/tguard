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
        "targets": 8,
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
function refreshTable(){
    let cb="";
    $.ajax({
      type:'get',
      url:'./main.php',
      data:{
        getAllInProgressTask:'true',
        status:0
      },
      success:function(response){
        data = JSON.parse(response);
        dt.clear().draw();
        for(var da in data){
          btn =`<button class="btn btn-success btn-sm waves-effect waves-light text-center" onclick='taskInfo(`+JSON.stringify(data[da])+`)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>`;
          time = data[da].total_time;
          const timeArr=time.split(":");
          time = timeArr[0]+"hrs "+timeArr[1]+"mins "+timeArr[2]+"sec";
          dt.row.add([
            cb,
            data[da].TaskName,
            data[da].client_name,
            data[da].name,
            data[da].Notes,
            data[da].DateStarted,
            data[da].DateEnded,
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
            search:true,
            searchClientName:searchClientName,
            searchStartDate:searchStartDate,
            searchEndDate:searchEndDate,
            searchAgentName:searchAgentName,
            startDate:startDate,
            endDate:endDate,
            searchTime:searchTime,
            status:0
          },
          success:function(response){
              if(response !=""){
                  data = JSON.parse(response);
                    dt.clear().draw();
                    for(var da in data){
                      btn =`<button class="btn btn-success btn-sm waves-effect waves-light text-center" onclick='taskInfo(`+JSON.stringify(data[da])+`)' data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-eye"></i></button>`;
                      time = data[da].total_time;
                      const timeArr=time.split(":");
                      time = timeArr[0]+"hrs "+timeArr[1]+"mins "+timeArr[2]+"sec";
                      dt.row.add([
                        cb,
                        data[da].TaskName,
                        data[da].client_name,
                        data[da].name,
                        data[da].Notes,
                        data[da].DateStarted,
                        data[da].DateEnded,
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