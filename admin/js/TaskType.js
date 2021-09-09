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
        "targets": 5,
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
var cb = "";
$.ajax({
    type: 'get',
    url: './main.php',
    data: {
        getTaskTypes: true
    },
    success: function(response) {
        data = JSON.parse(response);
        dt.clear().draw();
        for (var da in data) {
            btn = `<button class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#viewTaskType"><i class="fas fa-eye"></i></button>`;
            dt.row.add([
                cb,
                data[da].type,
                data[da].ClientName,
                data[da].email,
                data[da].enabled==1?"Active":"Archived",
                btn,
            ]).draw();
        }
    }
})