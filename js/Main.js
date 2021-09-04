function setDashboardDisplay(tasktype) {
    localStorage.setItem("type", tasktype.type);
    localStorage.setItem("tasktype_id", tasktype.tasktype_id);
}
getTaskTypes();
function getTaskTypes() {
    let str = '';
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getAssignedTaskTypes: 'true',
        },
        success: function (response) {
            data = JSON.parse(response);
            for (var da in data) {
                str += `<li class="nav-item has-treeview">
                        <a href="tasktype" class="nav-link" onclick='setDashboardDisplay(`+ JSON.stringify(data[da]) + `)'>
                        <i class="nav-icon far fas fa-gavel"></i>
                        <p>`+ data[da].type + `</p>
                        </a>
                    </li>`;
            }
            $('ul #assignedTask > li:eq(0)').html(str);
        }
    });
    return false;
}
function resetDisplay() {
    localStorage.clear();
}
function setInputClient(value) {
    // alert(value);
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getInputClientByTasktypeID: true,
            tasktype_id: value
        },
        success: function (response) {
            data = JSON.parse(response);
            $("#inputClientID").val(data[0].ClientName);
        }
    });
    return false;
}

function setInputClientView(value) {
    // alert(value);
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getInputClientByTasktypeID: true,
            tasktype_id: value
        },
        success: function (response) {
            data = JSON.parse(response);
            $("#viewClient").val(data[0].ClientName);
            $("#inputClient").val(data[0].ClientName);
        }
    });
    return false;
}
function getTimeStatusByID(timerecord_id) {
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getTimeStatusByID: true,
            timerecord_id: timerecord_id,
        },
        success: function (response) {
            data = JSON.parse(response);
            $('#passStatus').val(data.status);
        }
    })
}

