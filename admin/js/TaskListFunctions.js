$(".mt-2 ul li").removeClass("menu-open");
$(".mt-2 ul li a").removeClass("active");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(1)").removeClass("menu-open");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(1) a").removeClass("active");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(2)").addClass("menu-open");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(2) a").addClass("active");
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
        "targets": 5,
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
});
var cb = "";
refreshTable();
function refreshTable() {
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
                btn = `<button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" onclick='tasktypeInfo(` + JSON.stringify(data[da]) + `)' data-target="#viewTaskType"><i class="fas fa-eye"></i></button>`;
                dt.row.add([
                    cb,
                    data[da].type,
                    data[da].ClientName,
                    data[da].email,
                    data[da].phone,
                    btn,


                ]).draw();
            }
        }
    })
}
function tasktypeInfo(data) {
    $("#viewType").val(data.type);
    $("#viewClient").val(data.client_id);
    $("#btnDelete").val(data.tasktype_id);
}
function addTaskType() {
    client = $("#inputClient").val();
    tasktype = $("#inputTaskType").val();
    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            addTaskType: true,
            client: client,
            tasktype: tasktype
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
function setTaskTypeOptions(value) {
    resetTaskTypeOption();
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getExistedTaskType: true,
            user_id: value
        },
        success: function (response) {
            if (response == "") {
                return false;
            } else {
                data = JSON.parse(response);
                for (var da in data) {
                    if(data[da].tasktype_id !=0){
                        $("#assignTaskType option[value='" + data[da].tasktype_id + "']").remove();
                    }
                    
                }
            }

        }
    });
}
function assignUser(){
    user=$("#assignAgent").val();
    tasktype=$("#assignTaskType").val();
    $.ajax({
        type:'post',
        url:'./main.php',
        data:{
            assignUser:true,
            user:user,
            tasktype:tasktype
        },
        success:function(response){
            if(response == "assigned"){
                toastr.success("Assigned Successfully");
                $(".modal").modal("hide");
                document.getElementById("assignUserForm").reset();
            }else{
                toastr.error(response);
            }
        }
    });
    return false;
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