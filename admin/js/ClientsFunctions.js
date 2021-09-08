$(".mt-2 ul li").removeClass("menu-open");
$(".mt-2 ul li a").removeClass("active");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(1)").removeClass("menu-open");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(1) a").removeClass("active");
$(".mt-2 ul li:nth-child(5) ul li:nth-child(1)").addClass("menu-open");
$(".mt-2 ul li:nth-child(5) ul li:nth-child(1) a").addClass("active");

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
        "targets": 6,
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

function refreshTable() {
    var cb = "";
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getClientsJSON: true
        },
        success: function (response) {
            data = JSON.parse(response);
            dt.clear().draw();
            for (var da in data) {
                btn = `<button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" onclick='taskInfo(` + JSON.stringify(data[da]) + `)' data-target="#viewClient"><i class="fas fa-eye"></i></button>`;
                dt.row.add([
                    cb,
                    data[da].ClientName,
                    data[da].phone,
                    data[da].email,
                    data[da].email,
                    data[da].email,
                    btn,
                ]).draw();
            }
        }
    })
}
refreshTable();

function addClient() {
    name = $("#clientname").val();
    phone = $("#clientphone").val();
    email = $("#clientemail").val();
    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            addClient: true,
            name: name,
            phone: phone,
            email: email
        },
        success: function (response) {
            if (response == "inserted") {
                toastr.success("Client Created");
                refreshTable();
                $(".modal").modal("hide");
            } else {
                toastr.error(response);
            }
        }
    });
    return false;
}
function taskInfo(data) {
    $("#btnDelete").val(data.client_id);
    $("#btnSave").val(data.client_id);
    $("#viewName").val(data.ClientName);
    $("#viewEmail").val(data.email);
    $("#viewPhone").val(data.phone);
}
$("#btnSave").click(function () {
    fullname = $("#viewName").val();
    email = $("#viewEmail").val();
    phone = $("#viewPhone").val();
    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            saveClient: this.value,
            fullname: fullname,
            email: email,
            phone: phone,

        },
        success: function (response) {
            if (response == "updated") {
                toastr.success("Client Updated");
                refreshTable();
                $(".modal").modal("hide");
            }else {
                toastr.error(response);
            }
        }

    });
    return false;
});
$("#btnDelete").click(function () {
    if(confirm("Are you sure you want to archive this employee?")){
        $.ajax({
            type:'post',
            url:'./main.php',
            data:{
                archiveClient:this.value,
            },
            success: function(response){
                if(response == 'archived'){
                    toastr.success("Client has been Archived!");
                    refreshTable();
                    $(".modal").modal("hide");
                    getTaskTypes();
                }else{
                    toastr.error(response);
                }
            }
        });
    }

});