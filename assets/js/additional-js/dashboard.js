var tableAP;
var tableAPC;
var tablePC;
var tableLB;
var tableSP;
var tableSPC;
var tablePiutang;
var tableDK;
var tableCT;
var tableKY;
var tableCB;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
var monthNames = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];
var formatdec = new Intl.NumberFormat('id-ID', {
    style: 'decimal',
    minimumFractionDigits: 0
});
$(document).ready(function () {
    card();
    cardgd();
    allcount(formatcur);
    topsales();
    detaillaba();
    detailasset();
    detailassetcab();
    detailprodcab();
    detailsales();
    detailsalescab();
    detaildiskon();
    // detailcust();
    detailcb();
    detailkar();
    detailpiutang();
    updateDateTime();
});

function card() {
    $('.cardlaba').click(function(event) {
        event.preventDefault();
        $('#spinner').removeClass('d-none');
        $('#laba').addClass('d-none');
        countlaba(formatcur);
    });
    $('.cap').click(function(event) {
        event.preventDefault();
        $('#spintp').removeClass('d-none');
        $('#cardtp').addClass('d-none');
        countassetp(formatcur);
    });
    $('.cdp').click(function(event) {
        event.preventDefault();
        $('#spindp').removeClass('d-none');
        $('#carddp').addClass('d-none');
        countdis(formatcur);
    });
    $('.cp').click(function(event) {
        event.preventDefault();
        $('#spinp').removeClass('d-none');
        $('#cardp').addClass('d-none');
        countpen(formatcur);
    });
    $('.ctc').click(function(event) {
        event.preventDefault();
        $('#spintc').removeClass('d-none');
        $('#cardtc').addClass('d-none');
        countct(formatcur);
    });
    $('.ctu').click(function(event) {
        event.preventDefault();
        $('#spintu').removeClass('d-none');
        $('#counttu').addClass('d-none');
        countus(formatcur);
    });
    $('.cts').click(function(event) {
        event.preventDefault();
        $('#spints').removeClass('d-none');
        $('#countts').addClass('d-none');
        countos(formatcur);
    });
    $('.ctse').click(function(event) {
        event.preventDefault();
        $('#spintse').removeClass('d-none');
        $('#counttse').addClass('d-none');
        countose(formatcur);
    });
    $('.ctsp').click(function(event) {
        event.preventDefault();
        $('#spintsp').removeClass('d-none');
        $('#counttsp').addClass('d-none');
        countosp(formatcur);
    });
    $('.cardLink').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $('#spinst-' + id).removeClass('d-none');
        $('#counst-' + id).addClass('d-none');
        countStockByStore(id);
    });
    $('.cardhpp').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $('#spinhpp-' + id).removeClass('d-none');
        $('#counthpp-' + id).addClass('d-none');
        countbystore(id, formatcur);
    });
    $('.cardhj').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $('#spinhj-' + id).removeClass('d-none');
        $('#counthj-' + id).addClass('d-none');
        countbysalesstore(id);
    });
}
function allcount(formatcur) {
    $('#spinner').removeClass('d-none');
    $('#spintp').removeClass('d-none');
    $('#spinp').removeClass('d-none');
    $('#spindp').removeClass('d-none');
    $('#spintc').removeClass('d-none');
    $('#spinpk').removeClass('d-none');
    $('#spintpp').removeClass('d-none');
    $('#spinnpmg').removeClass('d-none');
    $('#spintu').removeClass('d-none');
    $('#spints').removeClass('d-none');
    $('.spinst').removeClass('d-none');
    getCountStock(formatcur);
    countlaba(formatcur);
    countassetp(formatcur);
    countpen(formatcur);
    countdis(formatcur);
    countct(formatcur);
    countus(formatcur);
    countos(formatcur);
    countose(formatcur);
    countosp(formatcur);
    getCountPM();
    getCountPK();
    getCountTotal();
}
function countlaba(formatcur) {
    $.ajax({
        url: base_url + 'Welcome/labakotor/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#laba').removeClass('d-none');
            $.each(data, function(index, item) {
                var formattedValue = formatcur.format(item.laba_kotor);
                var fpen = formatcur.format(item.total_pen);
                var fjasa = formatcur.format(item.total_jasa);
                var fhpp = formatcur.format(item.total_hpp);
                var fdisk = formatcur.format(item.total_disk);
                var fcashb = formatcur.format(item.total_cb);
                var bulan = item.start_date;
                var tahun = item.end_date;
                $('#laba').text(formattedValue);
                $('.cardlaba').attr('data-total_laba', formattedValue);
                $('.cardlaba').attr('data-total_hpp', fhpp);
                $('.cardlaba').attr('data-total_pen', fpen);
                $('.cardlaba').attr('data-total_jasa', fjasa);
                $('.cardlaba').attr('data-total_disk', fdisk);
                $('.cardlaba').attr('data-total_cashb', fcashb);
                $('.cardlaba').attr('data-bulanlb', bulan);
                $('.cardlaba').attr('data-tahunlb', tahun);
                return false;
            });
            $('#spinner').addClass('d-none');
        }
    });
}
function countassetp(formatcur) {
    $.ajax({
        url: base_url + 'Welcome/tproduk/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#cardtp').removeClass('d-none');
            $.each(data, function(index, item) {
                $('#cardtp').text(formatcur.format(item.total_hpp));
                $('.cap').attr('data-total_asset', formatcur.format(item.total_hpp));
                return false;
            });
            $('#spintp').addClass('d-none');
        }
    });
}
function countpen(formatcur) {
    $.ajax({
        url: base_url + 'Welcome/tpenjualan/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#cardp').removeClass('d-none');
            $.each(data, function(index, item) {
                var sales = formatcur.format(item.total_penjualan)
                var salesprd = formatcur.format(item.total_penjualan_no_jasa)
                var totjasa = formatcur.format(item.total_jasa)
                $('#cardp').text(sales);
                $('.cp').attr('data-total_sales', salesprd);
                $('.cp').attr('data-total_jasa', totjasa);
                return false;
            });
            $('#spinp').addClass('d-none');
        }
    });
}
function countdis(formatcur) {
    $.ajax({
        url: base_url + 'Welcome/tdiskon/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#carddp').removeClass('d-none');
            $.each(data, function(index, item) {
                var diskon = formatcur.format(item.total_diskon)
                $('#carddp').text(diskon);
                $('.cdp').attr('data-diskon_sales', diskon);
                return false;
            });
            $('#spindp').addClass('d-none');
        }
    });
}
function countct(formatcur) {
    $.ajax({
        url: base_url + 'Welcome/tcb/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#cardtc').removeClass('d-none');
            $.each(data, function(index, item) {
                var tcba = formatcur.format(item.total_cashback);
                var bulan = item.start_date;
                var tahun = item.end_date;
                $('#cardtc').text(tcba);
                $('.ctc').attr('data-total_cba', tcba);
                $('.ctc').attr('data-bulancb', bulan);
                $('.ctc').attr('data-tahuncb', tahun);
                return false;
            });
            $('#spintc').addClass('d-none');
        }
    });
}
function countus(formatcur) {
    $.ajax({
        url: base_url + 'Welcome/tuser/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#counttu').removeClass('d-none');
            $.each(data, function(index, item) {
                var usr = formatcur.format(item.total_user).replace(/\D/g, '');
                $('#counttu').text(usr);
                $('.ctu').attr('data-total_usr', usr);
                return false;
            });
            $('#spintu').addClass('d-none');
        }
    });
}
function countos(formatcur) {
    $.ajax({
        url: base_url + 'Welcome/tsupp/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#countts').removeClass('d-none');
            $.each(data, function(index, item) {
                var supp = formatcur.format(item.total_supplier).replace(/\D/g, '');
                $('#countts').text(supp);
                $('.cts').attr('data-total_supp', supp);
                return false;
            });
            $('#spints').addClass('d-none');
        }
    });
}
function countose(formatcur) {
    $.ajax({
        url: base_url + 'Welcome/tservice/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#counttse').removeClass('d-none');
            $.each(data, function(index, item) {
                var supp = formatcur.format(item.total_supplier).replace(/\D/g, '');
                $('#counttse').text(supp);
                $('.ctse').attr('data-total_service', supp);
                return false;
            });
            $('#spintse').addClass('d-none');
        }
    });
}
function countosp(formatcur) {
    $.ajax({
        url: base_url + 'Welcome/tpiutang/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#counttsp').removeClass('d-none');

            $.each(data, function(index, item) {
                var formatted = formatcur.format(item.total_supplier); // hasil: Rp xxx.xxx,00
                formatted = formatted.replace(',00', ''); // hapus desimal
                $('#counttsp').text(formatted);
                $('.ctsp').attr('data-total_piutang', formatted);
                return false; // hanya ambil 1 baris
            });

            $('#spintsp').addClass('d-none');
        }
    });
}

function topsales() {
    $.ajax({
        url: base_url + 'Welcome/topsales/',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var topSalesTableBody = $('#topSalesTableBody');
            topSalesTableBody.empty(); // Clear previous entries
            var counter = 1; // Initialize counter
            $.each(data, function(index, item) {
                var row = $('<tr>');
                var buttonClass = 'btn btn-primary'; // Default button class
                if (counter === 2) {
                    buttonClass = 'btn btn-secondary';
                } else if (counter === 3) {
                    buttonClass = 'btn btn-success';
                } else if (counter > 3) {
                    buttonClass = 'btn btn-secondary disabled';
                }
                row.append($('<td>').html('<span class="' + buttonClass + '">' + counter + '</span>'));
                row.append($('<td>').html('<a class="f-w-500" href="#" data-bs-toggle="modal" data-bs-target="#DetailKasir" data-id_ksr="'+item.id_ksr+'" data-total_ksr="'+item.total_jual+'">' + item.nama_ksr + '</a><br><span class="f-light">' + formatcur.format(item.total_jual) + '</span>'));
                topSalesTableBody.append(row);
                counter++;
            });
        }
    });
}
function cardgd() {
    $('#cardpmg').click(function(event) {
        event.preventDefault();
        $('#spinnpmg').removeClass('d-none');
        $('#pm').addClass('d-none');
        getCountPM();
    });
    $('#cardpk').click(function(event) {
        event.preventDefault();
        $('#spinpk').removeClass('d-none');
        $('#pk').addClass('d-none');
        getCountPK();
    });
    $('#cardtpp').click(function(event) {
        event.preventDefault();
        $('#spintpp').removeClass('d-none');
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
            $('#spinnpmg').addClass('d-none');
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error);
            $('#spinnpmg').addClass('d-none');
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
            $('#spintpp').addClass('d-none');
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error);
            $('#spintpp').addClass('d-none');
        }
    });
}
function countStockByStore(id){
    $.ajax({
        url: base_url + 'barang-keluar/stock/'+id,
        type: 'GET',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            var matched = false;
            $('#counst-' + id).removeClass('d-none');
            $.each(data, function(index, item) {
                if (item.id_toko === id) {
                    var formattedNumber = formatcur.format(item.brg_rdy).replace(/\D/g, '');
                    $('#counst-' + id).text(formattedNumber);
                    matched = true;
                    return false;
                }
            });
            if (!matched) {
                $('#counst-' + id).text('0');
            }
            $('#spinst-' + id).addClass('d-none');
        }
    });
}
function countbystore(id, formatcur){
    $.ajax({
        url: base_url + 'produk-list/asset-store/'+id,
        type: 'GET',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            var matched = false;
            $('#counthpp-' + id).removeClass('d-none');
            $.each(data, function(index, item) {
                if (item.id_toko === id) {
                    $('#counthpp-' + id).text('Rp '+item.total_asset);
                    matched = true;
                    return false;
                }
            });
            if (!matched) {
                $('#counthpp-' + id).text('0');
            }
            $('#spinhpp-' + id).addClass('d-none');
        }
    });
}
function countbysalesstore(id){
    $.ajax({
        url: base_url + 'total-sales-cabang/'+id,
        type: 'GET',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            var matched = false;
            $('#counthj-' + id).removeClass('d-none');
            $.each(data, function(index, item) {
                if (item.id_toko === id) {
                    $('#counthj-' + id).text('Rp '+item.total_jual);
                    matched = true;
                    return false;
                }
            });
            if (!matched) {
                $('#counthj-' + id).text('0');
            }
            $('#spinhj-' + id).addClass('d-none');
        }
    });
}
function getCountStock(formatcur) {
    $('h5#id_toko').each(function() {
        var id = $(this).data('id');
        var count = $(this).closest('.card').find('.counst');
        var spinner = $(this).closest('.card').find('.spinst');

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
                        var formattedNumber = formatcur.format(item.brg_rdy).replace(/\D/g, '');
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
function tablelaba(m,y) {
    m = m;
    y = y ? y : m;
    let ajaxConfig = {
        type: "POST",
        url: base_url + 'detail-laba/'+m+'/'+y,
    };
    if ($.fn.DataTable.isDataTable('#table-laba')) {
        tableLB.destroy();
    }
    tableLB = $("#table-laba").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": ajaxConfig,
        "columns": [
            { "data": "kode_penjualan" },
            { "data": "sn_brg" },
            { "data": "nama_brg" },   
            { 
                "data": "hrg_hpp",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "nilai",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_cashback",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },   
            { 
                "data": "laba_unit",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },   
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableLB.ajax.reload();
                }
            },
        ]
            
    });
    return tableLB;
}
function tableasset() {
    if ($.fn.DataTable.isDataTable('#table-asset')) {
        tableAP.destroy();
    }
    tableAP = $("#table-asset").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'detail-asset',
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },   
            { 
                "data": "hrg_hpp",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "nama_toko" },   
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableAP.ajax.reload();
                }
            },
        ]
            
    });
    return tableAP;
}
function tableassetcab(idtoko) {
    if ($.fn.DataTable.isDataTable('#table-assetc')) {
        tableAPC.destroy();
    }
    tableAPC = $("#table-assetc").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'detail-asset-cabang/'+idtoko,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },   
            { 
                "data": "hrg_hpp",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "nama_toko" },   
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableAPC.ajax.reload();
                }
            },
        ]
            
    });
    return tableAPC;
}
function tableprodcab(idtoko) {
    if ($.fn.DataTable.isDataTable('#table-prodc')) {
        tablePC.destroy();
    }
    tablePC = $("#table-prodc").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'detail-produk-cabang/'+idtoko,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },
            { 
                "data": "kondisi",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "Baru") {
                            return `<span class="badge rounded-pill badge-light-primary">BARU</span>`;
                          } else {
                            return `<span class="badge rounded-pill badge-light-warning">BEKAS</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                },
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css('text-align', 'center');
                }
            },   
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tablePC.ajax.reload();
                }
            },
        ]
            
    });
    return tablePC;
}
function tablesales() {
    if ($.fn.DataTable.isDataTable('#table-sales')) {
        tableSP.destroy();
    }
    tableSP = $("#table-sales").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'detail-sales',
            "type": "POST"
        },
        "columns": [
            { "data": "kode_penjualan" },
            { "data": "sn_brg" },
            { "data": "nama_brg" },   
            { 
                "data": "harga_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_diskon",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_cashback",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_bayar",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "nama_toko" },   
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableSP.ajax.reload();
                }
            },
        ]
            
    });
    return tableSP;
}
function tablesalescab(id) {
    if ($.fn.DataTable.isDataTable('#table-salesc')) {
        tableSPC.destroy();
    }
    tableSPC = $("#table-salesc").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'detail-sales-cabang/'+id,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },   
            { 
                "data": "harga_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_diskon",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_cashback",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_bayar",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "nama_toko" },   
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableSPC.ajax.reload();
                }
            },
        ]
            
    });
    return tableSPC;
}

function tablepiutang() {
    if ($.fn.DataTable.isDataTable('#table-piutang')) {
        tablePiutang.destroy();
    }
    tablePiutang = $("#table-piutang").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [4, 'asc'] 
        ],
        "ajax": {
            "url": base_url + 'penjualan/laporanpiutang/',
            "type": "POST"
        },
        "columns": [
            { "data": "kode_penjualan" },
            { 
                "data": "tanggal",
                "render": function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var date = new Date(data);
                        var day = ('0' + date.getDate()).slice(-2);
                        var month = monthNames[date.getMonth()];
                        var year = date.getFullYear();
                        return `${day} ${month} ${year}`;
                    }
                    return data;
                }
            },
            { "data": "nama_plg" },
            { "data": "alamat" },
            { 
                "data": "tempo",
                "render": function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var date = new Date(data);
                        var day = ('0' + date.getDate()).slice(-2);
                        var month = monthNames[date.getMonth()];
                        var year = date.getFullYear();
                        return `${day} ${month} ${year}`;
                    }
                    return data;
                }
            },
            { 
                "data": "total",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (data === "0") {
                            return `<span class="badge rounded-pill badge-secondary">Menunggu</span>`;
                        } else if(data ==="2"){
                            return `<span class="badge rounded-pill badge-primary">Lunas</span>`;
                        } else if(data==="1"){
                            return `<span class="badge rounded-pill badge-success">Dp</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-info">Batal</span>`;
                        } 
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },       
            {
                "data": "kode_penjualan",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (full.status == 1 || full.status == 2) {
                            return `
                                <ul class="action">
                                    <li class="edit">
                                        <button class="btn download-button" type="button" id="downloadnota" data-id="${data}">
                                            <i class="icofont icofont-print"></i>
                                        </button>
                                    </li>
                                </ul>
                            `;
                        } else {
                            return ''; // kalau status bukan 1/2, kosong, gak ada tombol
                        }
                    }
                    return data;
                }
            }
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tablePiutang.ajax.reload();
                }
            },
        ]
            
    });
    return tablePiutang;
}
function tablediskon() {
    if ($.fn.DataTable.isDataTable('#table-diskon')) {
        tableDK.destroy();
    }
    tableDK = $("#table-diskon").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'detail-diskon',
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { 
                "data": "total_diskon",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "nama_toko" },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableDK.ajax.reload();
                }
            },
        ]
            
    });
    return tableDK;
}
function tablecb(m, y) {
    m = m;
    y = y ? y : m;
    let ajaxConfig = {
        type: "POST",
        url: base_url + 'detail-cb/'+m+'/'+y,
    };
    if ($.fn.DataTable.isDataTable('#table-cb')) {
        tableCB.destroy();
    }
    tableCB = $("#table-cb").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [1, 'asc'] 
        ],
        "ajax": ajaxConfig,
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { 
                "data": "cbd",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "nama_supplier" },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableCB.ajax.reload();
                }
            },
        ]
            
    });
    return tableCB;
}
function tablecust() {
    if ($.fn.DataTable.isDataTable('#table-cust')) {
        tableCT.destroy();
    }
    tableCT = $("#table-cust").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'detail-customer',
            "type": "POST"
        },
        "columns": [
            { "data": "id_plg" },
            { "data": "nama_plg" },
            { "data": "no_ponsel" },
            { "data": "email" },
            { "data": "alamat" },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableCT.ajax.reload();
                }
            },
        ]
            
    });
    return tableCT;
}
function tabledts(ids) {
    if ($.fn.DataTable.isDataTable('#table-dt')) {
        tableDRS.destroy();
    }
    tableDRS = $("#table-dt").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'riwayat-penjualan/laporan-detail-penjualan/'+ids,
            "type": "POST"
        },
        "columns": [
            { "data": "kode_penjualan" },
            { "data": "sn_brg" },   
            { "data": "nama_brg" },   
            { 
                "data": "harga_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "diskon",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "harga_ril",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-4'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
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
                    tableRS.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Detail Penjualan',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            }
        ]
            
    });
    return tableDRS;
}
function detaillaba() {
    $('#DetailLaba').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var total = button.data('total_laba');
        var totalhpp = button.data('total_hpp');
        var totalpen = button.data('total_pen');
        var totaljasa = button.data('total_jasa');
        var totaldisk = button.data('total_disk');
        var totalcba = button.data('total_cashb');
        var m = button.data('bulanlb');
        var y = button.data('tahunlb');
        $("#tlk").text(total);
        $("#tlh").text(totalhpp);
        $("#tlp").text(totalpen);
        $("#tpj").text(totaljasa);
        $("#tld").text(totaldisk);
        $("#tlc").text(totalcba);
        filterlb();
        tablelaba(m,y);
    });
}
function filterlb(){
	flatpickr("#fdlb", {
		mode: "range",
	});
    $('#fdlb').on('change', function() {
        let lbval = $(this).val();
        let [start, end] = lbval.split(' to ');
        $.ajax({
            url: base_url + 'Welcome/labakotor',  
            type: 'POST',
            data: {
                lbval: lbval,
                start: start,  
                end: end ? end : start
            },
            dataType: 'json',
            success: function(response) {
                $.each(response, function(index, item) {
                    $("#tlk").text(formatcur.format(item.laba_kotor));
                    $("#tlh").text(formatcur.format(item.total_hpp));
                    $("#tlp").text(formatcur.format(item.total_pen));
                    $("#tpj").text(formatcur.format(item.total_jasa));
                    $("#tld").text(formatcur.format(item.total_disk));
                    $("#tlc").text(formatcur.format(item.total_cb));
                    tablelaba(start,end);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    });
}
function detailasset() {
    $('#DetailAssetProduk').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var total = button.data('total_asset');
        $("#tap").text(total);
        tableasset();
    });
}
function detailassetcab() {
    $('#DetailAssetProdukCab').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var total = button.data('total');
        var cabang = button.data('cabang');
        $("#tapc").text(total);
        $("#dapc").text(cabang);
        tableassetcab(id);
    });
}
function detailprodcab() {
    $('#DetailProdukCab').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var cabang = button.data('cabang');
        $("#dpcab").text(cabang);
        $.ajax({
            url: base_url + 'barang-keluar/stock/'+id,
            type: 'GET',
            dataType: 'json',
            data: { id: id },
            success: function(data) {
                $.each(data, function(index, item) {
                    if (item.id_toko === id) {
                        var formattedNumber = formatcur.format(item.brg_rdy).replace(/\D/g, '');
                        $('#tpc').text(formattedNumber);
                    }
                });
            }
        });
        tableprodcab(id);
    });
}
function detailsales() {
    $('#DetailSales').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var total = button.data('total_sales');
        var totalj = button.data('total_jasa');
        $("#totp").text(total);
        $("#totj").text(totalj);
        tablesales();
    });
}
function detailsalescab() {
    $('#DetailSalesProdukCab').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var total = button.data('total');
        var cabang = button.data('cabang');
        $("#tapt").text(total);
        $("#datc").text(cabang);
        tablesalescab(id);
    });
}
function detailpiutang() {
    $('#DetailPiutangCS').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var total = button.data('total');
        var cabang = button.data('cabang');
        $("#tappiutang").text(total);
        $("#datpiutang").text(cabang);
        tablepiutang();
    });
}
function detaildiskon() {
    $('#DetailDiskon').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var total = button.data('diskon_sales');
        $("#td").text(total);
        tablediskon();
    });
}
function detailcb() {
    $('#DetailCashback').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var total = button.data('total_cba');
        var m = button.data('bulancb');
        var y = button.data('tahuncb');
        $("#tca").text(total);
        filtercb();
        tablecb(m,y);
    });
}
function filtercb(){
	flatpickr("#fdcb", {
		mode: "range",
	});
    $('#fdcb').on('change', function() {
        let cbval = $(this).val();
        let [start, end] = cbval.split(' to ');
        $.ajax({
            url: base_url + 'Welcome/tcb',  
            type: 'POST',
            data: {
                cbval: cbval,
                start: start,  
                end: end ? end : start
            },
            dataType: 'json',
            success: function(response) {
                $.each(response, function(index, item) {
                    $("#tca").text(formatcur.format(item.total_cashback));
                    tablecb(start,end);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    });
}
function detailcust() {
    $('#DetailCust').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var total = button.data('total_cust');
        $("#tk").text(total);
        tablecust();
    });
}
function detailksr(){
    $('#DetailKasir').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var ids = button.data('id_ksr');
        var tt = button.data('total_ksr');
        $("#ttdh").text(formatcur.format(tt));
        $("#saldh").text(ids+' | '+sl);
        tabledts(ids);
    });
}
function detailkar() {
    $('#DetailUser').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var total = button.data('total_usr');
        $("#ttk").text(total);
        tablekar();
    });
}
function tablekar() {
    if ($.fn.DataTable.isDataTable('#table-kar')) {
        tableKY.destroy();
    }
    tableKY = $("#table-kar").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'Welcome/detailkar',
            "type": "POST"
        },
        "columns": [
            { "data": "id_admin" },
            { "data": "nama_admin" },
            // { "data": "email_admin" },
            {
                "data": "nama_toko",
                "render": function (data, type, row, meta) {
                    return '<select class="select2" id="cab" value="'+row.id_toko+'" data-id_toko="'+row.id_toko+'" data-id_admin="' + row.id_admin + '" data-current-value="' + data + '" data-cab="' + row.id_toko + '"></select>';
                },
            },                     
        ],
        "drawCallback": function(settings) {
            $('.select2').each(function() {
                var $select = $(this);
                var currentValue = $select.data('current-value');
                var value = $select.data('id_toko');
                var id_admin = $select.data('id_admin');
        
                $select.select2({
                    dropdownParent: $("#DetailUser"),
                    language: 'id',
                    ajax: {
                        url: base_url + 'BarangTerima/loadstore',
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id_toko,
                                        text: item.nama_toko
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
                if (currentValue) {
                    $select.append('<option value="' + value + '" selected>' + currentValue + '</option>').trigger('change');
                }

                $select.on('change', function() {
                    var newValue = $(this).val();
                    var toko = $(this).find('option:selected').text();
                    var id_admin = $select.data('id_admin');
                    
                    $.ajax({
                        url: 'Welcome/updatekar',
                        method: 'POST',
                        data: {
                            ids: id_admin, // Array of IDs
                            cab: newValue // Value of cab
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                swal("Berhasil dipindah "+toko, {
                                    icon: "success",
                                }).then((value) => {
                                    reload();
                                });
                            } else {
                                swal("Gagal pindah barang", {
                                    icon: "error",
                                });
                            }
                        },
                    });
                });
            });
        },
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
                        tableKY.ajax.reload();
                    }
                },
            ]
    });
    return tableKY;
}
function reload() {
    var bkReloaded = tablekar();
    if (bkReloaded) {
        bkReloaded.clear().draw();
        bkReloaded.ajax.reload();
    }
}
function updateDateTime() {
    const now = new Date();
    const month = ('0' + (now.getMonth() + 1)).slice(-2);
    const year = now.getFullYear();
    const currentMonth = `${year}-${month}`;
    $('#fdcb').val(currentMonth);
    $('#fdlb').val(currentMonth);
}
