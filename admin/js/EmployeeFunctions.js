$(".mt-2 ul li").removeClass("menu-open");
$(".mt-2 ul li a").removeClass("active");
$(".mt-2 ul li:nth-child(3) ul li:nth-child(1)").removeClass("menu-open");
$(".mt-2 ul li:nth-child(3) ul li:nth-child(1) a").removeClass("active");
$(".mt-2 ul li:nth-child(5) ul li:nth-child(2)").addClass("menu-open");
$(".mt-2 ul li:nth-child(5) ul li:nth-child(2) a").addClass("active");
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
        "targets": [8, 9],
        "className": "text-center"
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
            getAgentsJSON: true
        },
        success: function (response) {
            data = JSON.parse(response);
            dt.clear().draw();
            for (var da in data) {
                access = data[da].access == '2' ? "Agent" : "Admin";
                btn = `<button class="btn btn-success btn-sm waves-effect waves-light text-center" onclick='taskInfo(` + JSON.stringify(data[da]) + `)' data-toggle="modal" data-target="#viewUser" ><i class="fas fa-eye"></i></button>`;
                btnAccess = `<button class="btn btn-info btn-sm waves-effect waves-light" onclick='displayTaskTypeAccess(` + data[da].user_id + `)' data-toggle="modal" data-target="#accessUser">Access</button>`;
                dt.row.add([
                    cb,
                    data[da].name,
                    data[da].email,
                    data[da].username,
                    data[da].password,
                    data[da].phone,
                    access,
                    "status",
                    btn,
                    btnAccess
                ]).draw();
            }
        }
    })
}
refreshTable();
function addUser() {
    fullname = $("#name").val();
    username = $("#username").val();
    password = $("#password").val();
    cpassword = $("#cpassword").val();
    email = $("#email").val();
    phone = $("#phone").val();
    access = $('input[name="radioBtnType"]:checked').val();
    if (cpassword != password) {
        toastr.error("Password doesnt match!");
        $("#password").val("");
        $("#cpassword").val("");
        return false;
    }

    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            addUser: true,
            fullname: fullname,
            username: username,
            password: password,
            cpassword: cpassword,
            email: email,
            phone: phone,
            access: access,

        },
        success: function (response) {
            if (response == "inserted") {
                toastr.success("User Created");
                refreshTable();
                $(".modal").modal("hide");
                document.getElementById("addUserModal").reset();
            } else if (response == "taken") {
                toastr.error("Username Taken");
            } else {
                toastr.error(response);
            }
        }

    });
    return false;
}

function taskInfo(data) {
    $("#btnDelete").val(data.user_id);
    $("#btnSave").val(data.user_id);
    $("#viewName").val(data.name);
    $("#viewUsername").val(data.username);
    $("#viewPassword").val(data.password);
    $("#viewEmail").val(data.email);
    $("#viewPhone").val(data.phone);
    if (data.access == 1)
        $("#viewAdminRadioBtn").prop("checked", true);
    else
        $("#viewAgentRadioBtn").prop("checked", true);
}
$("#btnSave").click(function () {
    fullname = $("#viewName").val();
    username = $("#viewUsername").val();
    password = $("#viewPassword").val();
    email = $("#viewEmail").val();
    phone = $("#viewPhone").val();
    access = $('input[name="viewRadioBtnType"]:checked').val();
    user_id = $("#btnSave").val();
    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            saveUser: true,
            fullname: fullname,
            username: username,
            password: password,
            email: email,
            phone: phone,
            access: access,
            user_id: user_id

        },
        success: function (response) {
            if (response == "updated") {
                toastr.success("User Updated");
                refreshTable();
                $(".modal").modal("hide");
            } else if (response == "taken") {
                toastr.error("Username Taken");
            } else {
                toastr.error(response);
            }
        }

    });
    return false;
});
$("#btnDelete").click(function () {
    if (confirm("Are you sure you want to archive this employee?")) {
        $.ajax({
            type: 'post',
            url: './main.php',
            data: {
                archiveEmployee: this.value,
            },
            success: function (response) {
                if (response == 'archived') {
                    toastr.success("Employee has been Archived!");
                    refreshTable();
                    $(".modal").modal("hide");
                } else {
                    toastr.error(response);
                }
            }
        });
    }

});
function displayTaskTypeAccess(id) {
    let str = "";
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            displayEmployeeAccess: id
        },
        success: function (response) {
            if (response == "") {
                
            } else {
                data = JSON.parse(response);
                for (var da in data) {
                    str += `<tr>
                    <td>`+data[da].type+`</td>
                    <td> <button type="button" class="btn btn-outline-danger" onclick='revokeAccess(`+data[da].assigned_tasktype_id+`)'>Revoke</button>
                    </td>
                </tr>`;
                }
                
            }
            $("#accessBody").html(str);

        }
    });
}
function revokeAccess(id){
    if(confirm("Are you sure you want to revoke this tasktype from this user?")){
        $.ajax({
            type:'post',
            url:'./main.php',
            data:{
                revokeAccess:id,
            },
            success:function(response){
                if(response =='revoked'){
                    toastr.info("Tasktype revoked");
                }
            }
        });
        return false;
    }
}


