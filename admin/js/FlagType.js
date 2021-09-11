$(".mt-2 ul li").removeClass("menu-open");
$(".mt-2 ul li a").removeClass("active");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(1)").removeClass("menu-open");
$(".mt-2 ul li:nth-child(4) ul li:nth-child(1) a").removeClass("active");
$(".mt-2 ul li:nth-child(5) ul li:nth-child(3)").addClass("menu-open");
$(".mt-2 ul li:nth-child(5) ul li:nth-child(3) a").addClass("active");
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
        "targets": 3,
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

$('.my-colorpicker1').colorpicker();

$('.my-colorpicker1').on('colorpickerChange', function (event) {
    $('.my-colorpicker1 .fa-square').css('color', event.color.toString());
    $('#textColor').css('color', event.color.toString());
})
$('.my-colorpicker2').colorpicker();

$('.my-colorpicker2').on('colorpickerChange', function (event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    $('#backColor').css('background-color', event.color.toString());
})
$('.my-colorpicker3').colorpicker();

$('.my-colorpicker3').on('colorpickerChange', function (event) {
    $('.my-colorpicker3 .fa-square').css('color', event.color.toString());
    $('#viewTextColor').css('color', event.color.toString());
})
$('.my-colorpicker4').colorpicker();

$('.my-colorpicker4').on('colorpickerChange', function (event) {
    $('.my-colorpicker4 .fa-square').css('color', event.color.toString());
    $('#viewBackColor').css('background-color', event.color.toString());
})

$('.my-colorpicker4').on('colorpickerChange', function (event) {
    $('#output').css('background-color', event.color.toString());
})

$('.my-colorpicker3').on('colorpickerChange', function (event) {
    $('#output').css('color', event.color.toString());

})


refreshTable();

function refreshTable() {
    var cb = "";
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getFlagType: true
        },
        success: function (response) {
            data = JSON.parse(response);
            dt.clear().draw();
            for (var da in data) {
                btn = `<button class="btn btn-success btn-sm waves-effect waves-light text-center" onclick='taskInfo(` + JSON.stringify(data[da]) + `)' data-toggle="modal" data-target="#viewTaskType" ><i class="fas fa-eye"></i></button>`;
                dt.row.add([
                    cb,
                    data[da].flagtype,
                    data[da].notes,
                    btn,
                ]).draw();
            }
        }
    })
}

function addFlagType() {
    flagtype = $("#inputFlagType").val();
    notes = $("#inputNotes").val();
    textcolor = $("#textColor").val();
    bgcolor = $("#backColor").val();
    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            addFlagType: true,
            flagtype: flagtype,
            notes: notes,
            textcolor: textcolor,
            bgcolor: bgcolor,
        },
        success: function (response) {
            if (response == "inserted") {
                toastr.success("Flag Created");
                refreshTable();
                $(".modal").modal("hide");
            }
        }
    });
    return false;
}


function taskInfo(data) {
    $("#viewFlagType").val(data.flagtype);
    $("#viewNotes").val(data.notes);
    $("#viewBackColor").val(data.bgcolor);
    $("#viewTextColor").val(data.textcolor);
    $('#btnSave').val(data.flagtype_id);
    $('#btnDelete').val(data.flagtype_id);
    // Colors 
    $('.my-colorpicker3 .fa-square').css('color', data.textcolor);
    $('.my-colorpicker4 .fa-square').css('color', data.bgcolor);
    $('#viewTextColor').css('color', data.textcolor);
    $('#viewBackColor').css('background-color', data.bgcolor);
    $("#output").val(data.flagtype);
}
$("#btnSave").click(function () {
    flagtype = $("#viewFlagType").val();
    notes = $("#viewNotes").val();
    textcolor = $("#viewTextColor").val();
    bgcolor = $("#viewBackColor").val();
    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            saveFlagType: this.value,
            flagtype: flagtype,
            notes: notes,
            textcolor: textcolor,
            bgcolor: bgcolor,
        },
        success: function (response) {
            if (response == "updated") {
                toastr.success("Flag Updated");
                refreshTable();
                $(".modal").modal("hide");
            }
        }
    });
    return false;
});
$("#btnDelete").click(function () {
    if (confirm("Are you sure you want to delete this flagtype?")) {
        $.ajax({
            type: 'post',
            url: './main.php',
            data: {
                deleteFlagType: this.value,
            },
            success: function (response) {
                if (response == "deleted") {
                    toastr.success("Flag deleted");
                    refreshTable();
                    $(".modal").modal("hide");
                } else {
                    toastr.error(response);
                }
            }
        });
        return false;
    }

});