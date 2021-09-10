$(".mt-2 ul li").removeClass("menu-open");
$(".mt-2 ul li a").removeClass("active");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(1)").removeClass("menu-open");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(1) a").removeClass("active");
$(".mt-2 ul li:nth-child(5) ul li:nth-child(4)").addClass("menu-open");
$(".mt-2 ul li:nth-child(5) ul li:nth-child(4) a").addClass("active");
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
        "targets": 4,
        "orderable": false,
        "className": "text-center",
    }],
    select: {
        style: 'multi',
        selector: 'tr>td:nth-child(1)'
    },
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "buttons": ["excel", "pdf", "print",],
    // createdRow: function (row, data, index) {
    //     //
    //     // if the second column cell is blank apply special formatting
    //     //
    //     if (data[4] == "Archived") {
    //         $(row).css('color', 'red');
    //     }
    // }
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
function refreshTable() {
    var cb = "";
    let status=""
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getTaskTypes: true
        },
        success: function (response) {
            data = JSON.parse(response);
            dt.clear().draw();
            for (var da in data) {
                if(data[da].enabled == 1 || data[da].tenabled == 1){

                }
                btn = `<button class="btn btn-success btn-sm waves-effect waves-light" onclick='tasktypeInfo(` + JSON.stringify(data[da]) + `)' data-toggle="modal" data-target="#viewTaskType"><i class="fas fa-eye"></i></button>`;
                dt.row.add([
                    cb,
                    data[da].type,
                    data[da].ClientName,
                    data[da].email,
                    btn,
                ]).draw();
            }
        }
    })
}
function searchStatus(status){
    dt.columns(4).search( status ).draw();
}
function searchClient(name){
    dt.columns(1).search( name ).draw();
}
function addTaskType() {
    client = $("#inputClient").val();
    tasktype = $("#inputTaskType").val();
    notes=$("#inputNotes").val();
    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            addTaskType: true,
            client: client,
            tasktype: tasktype,
            notes:notes,
        },
        success: function (response) {
            if (response == "inserted") {
                toastr.success("Task Type Added");
                refreshTable();
                $(".modal").modal("hide");
                getTaskTypes();

            } else {
                toastr.error(response);
            }
        }
    });
    return false;
}
$("#btnSave").click(function(){
    client = $("#viewClient").val();
    tasktype = $("#viewType").val();
    notes=$("#viewNotes").val();
    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            saveTasktype: this.value,
            client: client,
            tasktype: tasktype,
            notes: notes,
        },
        success: function (response) {
            if (response == "updated") {
                toastr.success("Task Type updated");
                refreshTable();
                $(".modal").modal("hide");
                getTaskTypes();
            } else {
                toastr.error(response);
            }
        }
    });
    return false;
});
function tasktypeInfo(data) {
    $("#viewType").val(data.type);
    $("#viewClient").val(data.client_id);
    $("#btnDelete").val(data.tasktype_id);
    $("#btnSave").val(data.tasktype_id);
    $("#viewNotes").val(data.notes);
}
$("#btnDelete").click(function () {
    if (confirm("Are you sure you want to delete this tasktype?")) {
        $.ajax({
            type: 'post',
            url: './main.php',
            data: {
                btnDeleteTaskType: true,
                tasktype_id: this.value,
            },
            success: function (response) {
                if (response == 'deleted') {
                    $(".modal").modal("hide");
                    toastr.success("Task Deleted");
                    refreshTable();
                    getTaskTypes();
                } else {
                    toastr.error("There was an error!");
                }

            }
        });
    }

});