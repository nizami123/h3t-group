var formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
var tableRO;
var tableDO;

$(document).ready(function () {
    getCountPM();
    getCountPK();
    getCountTotal();
    cardgd();
    getCountStock(formatter);
    card(formatter);
    reload();
    // exportexcel();
    detailopname();
    filter();
});
function filter() {
    $('#ftgl').on('change', function() {
        var selectedDate = $(this).val();
        tableRO.ajax.reload(); 
    });
}
//count produk in and out
function cardgd() {
    $('#cardLink').click(function(event) {
        event.preventDefault();
        $('#spinner').removeClass('d-none');
        $('#pm').addClass('d-none');
        getCountPM();
    });
    $('#cardpk').click(function(event) {
        event.preventDefault();
        $('#spinpk').removeClass('d-none');
        $('#pk').addClass('d-none');
        getCountPK();
    });
    $('#cardtp').click(function(event) {
        event.preventDefault();
        $('#spintp').removeClass('d-none');
        $('#tp').addClass('d-none');
        getCountTotal();
    });
}
function getCountPM() {
    $.ajax({
        url: base_url+'StockOpname/countpm/', 
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#pm').removeClass('d-none');
            $('#pm').text(response);
            $('#spinner').addClass('d-none');
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error);
            $('#spinner').addClass('d-none');
        }
    });
}
function getCountPK() {
    $.ajax({
        url: base_url+'StockOpname/countpk/', 
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#pk').removeClass('d-none');
            $('#pk').text(response);
            $('#spinpk').addClass('d-none');
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error);
            $('#spinpk').addClass('d-none');
        }
    });
}
function getCountTotal() {
    $.ajax({
        url: base_url+'StockOpname/counttotal/', 
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#tp').removeClass('d-none');
            $('#tp').text(response);
            $('#spintp').addClass('d-none');
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error);
            $('#spintp').addClass('d-none');
        }
    });
}
//count produk in and out

// table riwayat
function formatDate(date) {
    var options = { day: 'numeric', month: 'long', year: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}
function tablero() {
    if ($.fn.DataTable.isDataTable('#table-ro')) {
        tableRO.destroy();
    }
    tableRO = $("#table-ro").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] // Urutkan kolom pertama (indeks 0) secara ascending (asc)
        ],
        "ajax": {
            "url": base_url + 'stock-opname/riwayat-opname/',
            "type": "POST",
            data: function(d) {
                d.tgl = $('#ftgl').val();
            }
        },
        "columns": [
            { "data": "kode_opname" },
            { "data": "tgl_opname",
                "render": function (data, type, row) {
                    var date = new Date(data);
                    return formatDate(date);
                }
            },
            { "data": "nama_lengkap" },
            { "data": "jabatan" },
            { "data": "nama_toko" },
            {
                "data": "total_produk",
                "render": function (data, type, full, meta) {
                    return `<span class="badge badge-primary">${data}</span>`;
                }
            },            
            { "data": "id_opname",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-id="${data}" data-bs-toggle="modal" data-bs-target="#DetailStockopname"><i class="fa fa-eye"></i></button>
                                        <!-- <button class="btn btn-secondary" type="button" id="export" data-kode="${data}"><i class="fa fa-cloud-download"></i></button> -->
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            }            
        ],
        'columnDefs': [
            {
                "targets": 5, // your case first column
                "className": "text-center",
                "width": "4%"
           },
         ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'col-sm-12 col-md-2'B>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
               "buttons": [
                {
                    "text": 'Refresh', // Font Awesome icon for refresh
                    "className": 'custom-refresh-button', // Add a class name for identification
                    "attr": {
                        "id": "refresh-button" // Set the ID attribute
                    },
                    "init": function (api, node, config) {
                        $(node).removeClass('btn-default');
                        $(node).addClass('btn-primary');
                        $(node).attr('title', 'Refresh'); // Add a title attribute for tooltip
                    },
                    "action": function () {
                        tableRO.ajax.reload();
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    title: 'Riwayat Stock Opname',
                    exportOptions: {
                        columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                    }
                }
            ]
            
    });
    return tableRO;
}
function reload() {
    var roReloaded = tablero();
    if (roReloaded) {
        roReloaded.clear().draw();
        roReloaded.ajax.reload();
    }
}

function exportexcel() {
    $('#table-ro').on('click', '#export', function() {
        var kode = $(this).data('kode');
        window.location.href = base_url + 'StockOpname/exportexcel/' + kode;
    });
}
function tabledo(id) {
    if ($.fn.DataTable.isDataTable('#table-do')) {
        tableDO.destroy();
    }
    tableDO = $("#table-do").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'asc'] // Urutkan kolom pertama (indeks 0) secara ascending (asc)
        ],
        "ajax": {
            "url": base_url + 'stock-opname/detail-opname/'+id,
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },       
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'col-sm-12 col-md-2'B>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
            "buttons": [
                {
                    "text": 'Refresh', // Font Awesome icon for refresh
                    "className": 'custom-refresh-button', // Add a class name for identification
                    "attr": {
                        "id": "refresh-button" // Set the ID attribute
                    },
                    "init": function (api, node, config) {
                        $(node).removeClass('btn-default');
                        $(node).addClass('btn-primary');
                        $(node).attr('title', 'Refresh'); // Add a title attribute for tooltip
                    },
                    "action": function () {
                        tableDO.ajax.reload();
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    title: 'Detail Stock Opname',
                }
            ]
            
    });
    return tableDO;
}
function detailopname() {
    $('#DetailStockopname').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        tabledo(id);
    });
}
// table riwayat

//count total in store
function card(formatter) {
    $('.cardLink').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $('#spinner-' + id).removeClass('d-none');
        $('#counting-' + id).addClass('d-none');
        countbystore(id, formatter);
    });
}
function countbystore(id, formatter){
    $.ajax({
        url: base_url + 'barang-keluar/stock/'+id,
        type: 'GET',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            var matched = false;
            $('#counting-' + id).removeClass('d-none');
            $.each(data, function(index, item) {
                if (item.id_toko === id) {
                    var formattedNumber = formatter.format(item.brg_rdy).replace(/\D/g, '');
                    $('#counting-' + id).text(formattedNumber);
                    matched = true;
                    return false;
                }
            });
            if (!matched) {
                $('#counting-' + id).text('0');
            }
            $('#spinner-' + id).addClass('d-none');
        }
    });
}
function getCountStock(formatter) {
    $('h5#id_toko').each(function() {
        var id = $(this).data('id');
        var count = $(this).closest('.card').find('.counting');
        var spinner = $(this).closest('.card').find('.spinner-border');

        $.ajax({
            url: base_url + 'barang-keluar/stock/'+id,
            type: 'GET',
            dataType: 'json',
            data: { id: id },
            success: function(data) {
                var matched = false;
                count.removeClass('d-none');
                $.each(data, function(index, item) {
                    if (item.id_toko === id) {
                        var formattedNumber = formatter.format(item.brg_rdy).replace(/\D/g, '');
                        count.text(formattedNumber);
                        matched = true;
                        return false;
                    }
                });
                if (!matched) {
                    count.text('0');
                }
                spinner.addClass('d-none');
            }
        });
    });
}
//count total in store