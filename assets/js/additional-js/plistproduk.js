var tablePL;
var tableDT;
var defaultSelectedName = null;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
$(document).ready(function () {
    // $("#cab").val('0').trigger('change.select2');
    // defaultSelectedName = $("#cab").val();
    filterexport();
    tablepl();
    detailbrg();
    getselect();
    // card(formatcur);
});
function filterexport() {
    $('#tipe').on('select2:select', function(e) {
        var selectedText = e.params.data.id;
        $('#update').attr('data-jenis', selectedText);
    });
    $('#kondisi').on('select2:select', function(e) {
        var selectedText = e.params.data.id;
        $('#update').attr('data-kond', selectedText);
    });
    $('#cab').on('select2:select', function(e) {
        var selectedText = e.params.data.id;
        $('#update').attr('data-cab', selectedText);
    });
    $('#table-pl').on('search.dt', function() {
        var searchValue = $('.dataTables_filter input').val();
        $('#update').attr('data-search', searchValue);
    });
}
function tablepl() {
    getselect();
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'produk-list/daftar/',
        data: function(d) {
            d.cab = $('#cab').val();
            d.kond = $('#kondisi').val();
            d.jns = $('#tipe').val();
            d.search = $('input[type="search"]').val();
        }
    };
    if ($.fn.DataTable.isDataTable('#table-pl')) {
        tablePL.destroy();
    }
    tablePL = $("#table-pl").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": ajaxConfig,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { 
                "data": "kondisi",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (type === "display") {
                            return data === "Baru" ? 
                                '<span class="badge rounded-pill badge-light-primary">Baru</span>' : 
                                '<span class="badge rounded-pill badge-light-warning">Bekas</span>';
                        }
                        return data;
                    }
                    return data;
                }
            },
            { "data": "nama_toko" },
            { 
                "data": "hrg_hpp",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "hrg_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if(data ==="2"){
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-success">TERJUAL</span>`;
                        } else if(data==="4"){
                            return `<span class="badge rounded-pill badge-info">BOOKING</span>`;
                        } else if(data==="6"){
                            return `<span class="badge rounded-pill badge-warning">UNVERIFIED</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
            {
                "data": "id_keluar",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action d-flex justify-content-center">
                                    <div class="btn-group">
                                        <button class="btn btn-primary" data-id="${data}" data-bs-toggle="modal" data-bs-target="#InfoDetail" title="detail barang"><i class="fa fa-exclamation-circle"></i></button>
                                    </div>
                                </ul>
                            `;
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
                    tablePL.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export Excel', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Produk List',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            },
            {
                "text": 'Export Barcode', 
                "attr": {
                    "id": "update",
                    "data-jenis": "all",
                    "data-cab": "AllCab",
                    "data-kond": "all",
                    'data-search': ''
                },
                "action": function () {
                    var dataJenis = $('#update').attr('data-jenis');
                    var dataCab = $('#update').attr('data-cab');
                    var dataKond = $('#update').attr('data-kond');
                    var dataSearch = $('#update').attr('data-search');

                    dataSearch = dataSearch ? dataSearch : '';

                    var printUrl;
                    if (dataSearch !== '') {
                        printUrl = base_url + 'produk-list/export-barcode/' + 
                            encodeURIComponent(dataJenis) + '/' + 
                            encodeURIComponent(dataKond) + '/' + 
                            encodeURIComponent(dataCab) + '/' + 
                            encodeURIComponent(dataSearch);
                    } else {
                        printUrl = base_url + 'produk-list/export-barcode-select/' + 
                            encodeURIComponent(dataJenis) + '/' + 
                            encodeURIComponent(dataKond) + '/' + 
                            encodeURIComponent(dataCab);
                    }
                    window.open(printUrl, '_blank');
                }
            }
        ]
            
    });
    $('#tipe, #kondisi, #cab').on('change', function() {
        tablePL.draw();
    }); 
    return tablePL;
}
function detailbrg() {
    $('#InfoDetail').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        $.ajax({
            url: base_url + 'produk-list/detailbrg/'+id,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    // var tgl_keluar = item.tgl_keluar;
                    // var datePart = tgl_keluar.split(' ')[0];
                    // var timePart = tgl_keluar.split(' ')[1];
                    $('#bardh').attr('src', base_url+'assets/dhdokumen/snbarcode/'+item.sn_brg+'.jpg').css('width', '100px');
                    $('#dhsn').text(item.sn_brg);
                    // $('#H3TSUPP').text(item.nama_supplier);
                    $('#dhnm').text(item.nama_brg);
                    $('#dhkon').text(item.kondisi);
                    $('#dhmerk').text(item.merk);
                    $('#dhjen').text(item.jenis);
                    $('#spek').text(item.spek);
                    // $('#dhdreg').text(datePart);
                    // $('#dhtreg').text(timePart);
                    $('#dhcab').text(item.nama_toko);
                });
            }
        });
    });
}
// $(document).on('select2:select', '#cab', function (e) {
//     e.preventDefault();
//     var selectedValue = e.params.data.id;
    
//     if (selectedValue !== 'AllCab') { 
//         var ajaxUrl = base_url + 'produk-list/filtercab/' + selectedValue;
//         filterCab(ajaxUrl, selectedValue); 
//     } else {
//         var ajaxUrl = base_url + 'produk-list/daftar/';
//         filterCab(ajaxUrl, null); 
//     }
// });
function getselect(){
    $('#cab').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangTerima/loadstore',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var results = $.map(data, function (item) {
                    return {
                        id: item.id_toko,
                        text: item.id_toko+' | '+item.nama_toko,
                    };
                });
    
                results.unshift({
                    id: 'AllCab',
                    text: 'Semua Cabang',
                    value: '0',
                });
    
                return {
                    results: results,
                };
            },
            cache: false,
        },
    });
    $('#tipe').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterBarang/loadjenis',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var results = $.map(data, function (item) {
                    return {
                        id: item.nama_kategori,
                        text: item.nama_kategori,
                    };
                });
    
                results.unshift({
                    id: 'all',
                    text: 'Semua Tipe',
                    value: '0',
                });
    
                return {
                    results: results,
                };
            },
            cache: false,
        },
    });
    $('#kondisi').select2({
        language: 'id',
        ajax: {
            url: base_url + 'PenList/loadkondisi',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var results = $.map(data, function (item) {
                    return {
                        id: item.kondisi,
                        text: item.kondisi,
                    };
                });
    
                results.unshift({
                    id: 'all',
                    text: 'Semua Kondisi',
                    value: '0',
                });
    
                return {
                    results: results,
                };
            },
            cache: false,
        },
    });
}
function filterCab(url, selectedName) {
    if ($.fn.DataTable.isDataTable('#table-pl')) {
        tablePL.ajax.url(url).load(); 
        if (selectedName) {
            tablePL.column(2).search(selectedName).draw(); 
        } else {
            tablePL.column(2).search('').draw(); 
        }
    }
}
function card(formatcur) {
    $('.cardLink').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $('#spinner-' + id).removeClass('d-none');
        $('#counting-' + id).addClass('d-none');
        countbystore(id, formatcur);
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
            $('#counting-' + id).removeClass('d-none');
            $.each(data, function(index, item) {
                if (item.id_toko === id) {
                    $('#counting-' + id).text('Rp '+item.total_asset);
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