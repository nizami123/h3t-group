var Tetalase;
var cabr;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'decimal',
    // currency: 'IDR',
    minimumFractionDigits: 0
});
var tableDO;
var monthNames = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];
$(document).ready(function () {
    table_etalase();
    getselect();
    detailbrg();
    tablejl();
    detailpenerimaan();
});
function table_etalase() {
    getselect();
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'penerimaan/loadproduk/',
        data: function(d) {
            d.no_faktur = $('#no_faktur').val();
        }
    };
    if ($.fn.DataTable.isDataTable('#table-etalase')) {
        Tetalase.destroy();
    }
    Tetalase = $("#table-etalase").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [1, 'asc']
        ],
        "ajax": ajaxConfig,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { 
                "data": "id_masuk",
                "orderable": false,
                "render": function (data, type, row, meta) {
                    var checkboxId = 'checkbox-' + data;
                    return `
                        <input class="checkbox-class" type="checkbox" id="${checkboxId}" data-id="${data}" data-input-id="${checkboxId}-status"">
                    `;
                }
            },
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },
            { "data": "no_imei" },
            { "data": "kondisi" }
            
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
               "<'row'<'col-sm-12 col-md-2'B>>" +
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
                        Tetalase.ajax.reload();
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    title: 'Daftar DP Supplier',
                    exportOptions: {
                        columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                    }
                },
                {
                    "text": 'Simpan', // Font Awesome icon for refresh
                    "attr": {
                        "id": "update" // Set the ID attribute
                    },
                    "action": function () {
                        var checkedData = [];
                        
                        $('.checkbox-class:checked').each(function() {
                            var row = Tetalase.row($(this).closest('tr')).data();
                            checkedData.push({
                                idm: row.id_masuk,
                                status: 1 // Ubah status saja
                            });
                        });
                        if (checkedData.length==0){
                            console.log('no data');
                        }else{
                            var jsonData = JSON.stringify(checkedData);
                            $.ajax({
                                url: base_url + 'penerimaan/terima_data',
                                type: 'POST',
                                dataType: 'json',
                                contentType: 'application/json',
                                data: jsonData,
                                success: function(response) {
                                    if (response.status === 'success') {
                                        swal("success", "Barang sudah diterima", "success").then(() => {
                                            window.location.href = base_url + 'penerimaan';
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error updating data:', error);
                                }
                            });
                        }
                    }
                }
            ]
            
    });


    $('#generate').on('click', function() {
        var noFaktur = $('#no_faktur').val(); // Ambil nilai No Faktur
        console.log('Mengirim No Faktur:', noFaktur); 
        Tetalase.draw();
    });

    $('#table-etalase').on('change', '.checkbox-class', function() {
        var inputId = $(this).data('input-id');
        var inputPub = $(this).data('input-pub');
        var inputMar = $(this).data('input-mar');
        var inputCb = $(this).data('input-cb');
        var inputField = $('#' + inputId);
        var inputPubField = $('#'+ inputPub);
        var inputMarField = $('#'+ inputMar);
        var inputCbField = $('#'+ inputCb);
        inputField.prop('disabled', !this.checked);
        inputPubField.prop('disabled', !this.checked);
        inputMarField.prop({
            'disabled': !this.checked,
            'readonly': true
        });
        inputCbField.prop('disabled', !this.checked);
        inputCbField.on('click', function() {
            // If the value is "0", clear the value
            if ($(this).val() === "0") {
                $(this).val('');
            }
        });
    });
    $('#table-etalase').on('input', '.input-hpp, .input-pub', function() {
        var row = Tetalase.row($(this).closest('tr')).data();
        var hppInputId = 'checkbox-' + row.id_keluar + '-hpp';
        var pubInputId = 'checkbox-' + row.id_keluar + '-pub';
        var marInputId = 'checkbox-' + row.id_keluar + '-mar';
    
        var hppValue = parseFloat($('#' + hppInputId).val().replace(/\D/g, ''));
        var pubValue = parseFloat($('#' + pubInputId).val().replace(/\D/g, ''));
    
            var margin = ((pubValue - hppValue) / hppValue) * 100;
            $('#' + marInputId).val(margin.toFixed(2));
    });   
    $('#cabr, #cab, #tipe').on('change', function() {
        Tetalase.draw();
    }); 
    return Tetalase;
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
            "url": base_url + 'penerimaan/detail_penerimaan/'+id,
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },   
            { "data": "kondisi" },       
            { 
                "data": "status_pen",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "1") {
                            return `<span class="badge rounded-pill badge-success">DITERIMA</span>`;
                        } else if(data ==="0"){
                            return `<span class="badge rounded-pill badge-danger">DITOLAK</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
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

function detailpenerimaan() {
    $('#DetailPenerimaan').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        tabledo(id);
    });
}

function tablejl() {
    if ($.fn.DataTable.isDataTable('#table-penerimaan')) {
        tableJL.destroy();
    }
    tableJL = $("#table-penerimaan").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'penerimaan/penerimaan_list/',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { 
                "data": "tgl_masuk",
                "render": function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var date = new Date(data);
                        var day = ('0' + date.getDate()).slice(-2);
                        var month = monthNames[date.getMonth()];
                        var year = date.getFullYear();
                        var hours = ('0' + date.getHours()).slice(-2);
                        var minutes = ('0' + date.getMinutes()).slice(-2);
                        return `${day} ${month} ${year}`;
                    }
                    return data;
                }
            },
            { "data": "no_fm" },           
            { "data": "nama_supplier" },
            { "data": "alamat" },
            { "data": "nama_lengkap" }, 
            { "data": "no_fm",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-id="${data}" data-bs-toggle="modal" data-bs-target="#DetailPenerimaan"><i class="fa fa-eye"></i></button>
                                        <!-- <button class="btn btn-secondary" type="button" id="export" data-kode="${data}"><i class="fa fa-cloud-download"></i></button> -->
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            }      
           
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
                    tableJL.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Laporan Penerimaan',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            },
            {
                text: 'Create', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Tambah Penerimaan',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                },
                action: function (e, dt, button, config) {
                    window.location.href = base_url + 'penerimaan/input_penerimaan'; // Ganti dengan URL tujuan
                }
            }
            
        ]
            
    });
    return tableJL;
}


function getselect(){
    $('#cab').select2({
        language: 'id',
        ajax: {
            url: base_url + 'InventoriStok/loadsupp',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // Add the search term to your AJAX request
                };
            },
            processResults: function (data) {
                var results = $.map(data, function (item) {
                    return {
                        id: item.id_supplier,
                        text: item.id_supplier+' | '+item.nama_supplier,
                    };
                });
    
                results.unshift({
                    id: '0',
                    text: 'Semua Supplier',
                    value: '0',
                });
    
                return {
                    results: results,
                };
            },
            cache: false,
        },
    });
    $('#cabr').select2({
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
                    id: '0',
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
                    id: '0',
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
}
function detailbrg() {
    $('#InfoDetail').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        $.ajax({
            url: base_url + 'PenEtalase/infoBrg/'+id,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    var tgl_keluar = item.tgl_keluar;
                    var datePart = tgl_keluar.split(' ')[0];
                    var timePart = tgl_keluar.split(' ')[1];
                    $('#bardh').attr('src', base_url+'assets/dhdokumen/snbarcode/'+item.sn_brg+'.jpg').css('width', '100px');
                    $('#dhsn').text(item.sn_brg);
                    $('#H3TSUPP').text(item.nama_supplier);
                    $('#dhnm').text(item.nama_brg);
                    $('#dhkon').text(item.kondisi);
                    $('#dhmerk').text(item.merk);
                    $('#dhjen').text(item.jenis);
                    $('#spek').text(item.spek);
                    $('#dhdreg').text(datePart);
                    $('#dhtreg').text(timePart);
                    $('#dhcab').text(item.nama_toko);
                });
            }
        });
    });
}