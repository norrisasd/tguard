function setDashboardDisplay(tasktype) {
    localStorage.setItem("type",tasktype.type);
    localStorage.setItem("tasktype_id",tasktype.tasktype_id);
}
getTaskTypes();
function getTaskTypes() {
    let str = '';
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getTaskTypes: 'true',
        },
        success: function (response) {
            data = JSON.parse(response);
            for (var da in data) {
                str+= `<li class="nav-item has-treeview">
                        <a href="tasktype" class="nav-link" onclick='setDashboardDisplay(`+JSON.stringify(data[da])+`)'>
                        <i class="nav-icon far fas fa-gavel"></i>
                        <p>`+data[da].type+`</p>
                        </a>
                    </li>`;
            }
            $('ul #tasktypes > li:eq(2)').html(str);
        }
    });
    return false;
}
function resetDisplay(){
    localStorage.clear();
}