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
    "buttons": ["excel", "pdf", "print", ]
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
    $.ajax({
        type: 'get',
        url: './main.php',
        data: {
            getFlagType: true
        },
        success: function(response) {
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
    $.ajax({
        type: 'post',
        url: './main.php',
        data: {
            addFlagType: true,
            flagtype: flagtype,
            notes: notes
        },
        success: function(response) {
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
  
  }

