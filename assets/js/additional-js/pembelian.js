var tableRS;
var tableDRS;
var tableJL;
var tableDJL;
var tablePRDJ;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
var monthNames = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];
$(document).ready(function () {
    tablers();
    tablejl();
    tableprdj();
    detailpen();
    detaillappen();
    detailprdj();
});

function tablejl() {
    if ($.fn.DataTable.isDataTable('#table-pembelian')) {
        tableJL.destroy();
    }
    tableJL = $("#table-pembelian").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [1, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'pembelian/laporanpembelian/',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { "data": "no_fm" },
            { 
                "data": "tanggal",
                "render": function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var date = new Date(data);
                        var day = ('0' + date.getDate()).slice(-2);
                        var month = monthNames[date.getMonth()];
                        var year = date.getFullYear();
                        var hours = ('0' + date.getHours()).slice(-2);
                        var minutes = ('0' + date.getMinutes()).slice(-2);
                        return `${day} ${month} ${year} <br><b>${hours}:${minutes}</b>`;
                    }
                    return data;
                }
            },
            { "data": "nama_supplier" },
            { "data": "alamat" },
            { 
                "data": "harga_beli",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "status_pem",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if(data ==="0"){
                            return `<span class="badge rounded-pill badge-danger">Belum Lunas</span>`;
                        }else if(data ==="1"){
                            return `<span class="badge rounded-pill badge-primary">DP</span>`;
                        } else if(data==="2"){
                            return `<span class="badge rounded-pill badge-success">LUNAS</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-warning">BATAL</span>`;
                        } else if(data==="9"){
                            return `<span class="badge rounded-pill badge-warning">GESTUN</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },       
            // {
            //     "data": "kode_penjualan",
            //     "orderable": false,
            //     "render": function (data, type, full, meta) {
            //         if (type === "display") {
            //             return `
            //                     <ul class="action">
            //                         <div class="btn-group">
            //                             <button class="btn btn-primary" 
            //                             data-id="${data}" data-total="${full.total}" data-idksr="${full.id_ksr}"
            //                             data-sales="${full.nama_ksr}" data-hj="${full.total_harga_jual}" data-dis="${full.total_diskon}" 
            //                             data-cb="${full.total_cb}" data-lb="${full.total_laba}" data-cst="${full.nama_plg}" data-tb="${full.cara_bayar}" 
            //                             data-btf="${full.bank_tf}" data-nr="${full.no_rek}" data-tn="${full.tunai}" data-status="${full.status}"
            //                             data-bnk="${full.bank}" data-krd="${full.kredit}" data-toko="${full.nama_toko}" data-tgltr="${full.tgl_transaksi}"
            //                             data-jasa="${full.jasa}" data-jasanom="${full.jml_donasi}"
            //                             data-bs-toggle="modal" data-bs-target="#DetailLapPenjualan" title="detail penjualan"><i class="fa fa-exclamation-circle"></i></button>
            //                         </div>
            //                     </ul>
            //                 `;
            //         }
            //         return data;
            //     }
            // }      
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
                title: 'Laporan Pembelian',
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
                    window.location.href = base_url + 'pembelianInput'; // Ganti dengan URL tujuan
                }
            }
        ]
            
    });
    return tableJL;
}

function tableprdj() {
    if ($.fn.DataTable.isDataTable('#table-prdj')) {
        tablePRDJ.destroy();
    }
    tablePRDJ = $("#table-prdj").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'asc'] 
        ],
        "ajax": {
            "url": base_url + 'riwayat-penjualan/laporan-produk-jual/',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { 
                "data": "sn_brg",
                "render": function(data, type, row, meta) {
                    return `<a href="#" id="infoprd" 
                    data-inv="${row.kode_penjualan}" data-cab="${row.nama_toko}" data-tgl="${row.tgl_transaksi}"
                    data-ksr="${row.nama_ksr}" data-sls="${row.nama_admin}" data-plg="${row.nama_plg}" data-idplg="${row.id_plg}"
                    data-bs-toggle="modal" data-bs-target="#InfoDetail">${data}</a>`;
                }
            },   
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
            { 
                "data": "hrg_hpp",
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
                    tablePRDJ.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Laporan Produk Terjual',
            }
        ]
            
    });
    return tablePRDJ;
}

function tablers() {
    if ($.fn.DataTable.isDataTable('#table-sales')) {
        tableRS.destroy();
    }
    tableRS = $("#table-sales").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'asc'] 
        ],
        "ajax": {
            "url": base_url + 'riwayat-penjualan/laporan-penjualan/',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { "data": "sales" },
            { 
                "data": "total_harga_jual",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "total_jasa",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "total_diskon",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "total_harga_cb",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
                "data": "total_penjualan",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            {
                "data": "id_ksr",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-primary" data-id="${data}" 
                                        data-total="${full.total_penjualan}" data-ids="${full.id_ksr}" data-sales="${full.nama_ksr}" 
                                        data-hj="${full.total_harga_jual}" data-cb="${full.total_harga_cb}" data-ds="${full.total_diskon}"
                                        data-js="${full.total_jasa}" data-subt="${full.subtotal}"
                                        data-bs-toggle="modal" data-bs-target="#DetailPenjualan" title="detail penjualan"><i class="fa fa-exclamation-circle"></i></button>
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
                    tableRS.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Laporan Penjualan Sales',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            }
        ]
            
    });
    return tableRS;
}

function detaillappen(){
    $('#DetailLapPenjualan').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var inv = button.data('id');
        var tgl = button.data('tgltr');
        var date = new Date(tgl);
        var stat = button.data('status');
        var monthName = date.toLocaleString('id-ID', { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        }).replace(' pukul ', ' ').replace(/\./g, ':');
        var cst = button.data('cst');
        var tipe = button.data('tb');
        var bpen = button.data('btf');
        var nor = button.data('nr');
        var tn = button.data('tn');
        var bnk = button.data('bnk');
        var krd = button.data('krd');
        var idksr = button.data('idksr');
        var sales = button.data('sales');
        var hj = button.data('hj');
        var dis = button.data('dis');
        var cb = button.data('cb');
        var lb = button.data('lb');
        var total = button.data('total');
        var jasanom = button.data('jasanom');
        var jasa = button.data('jasa');
        $('#ttcs').text(cst+' ('+monthName+') ');
        $('#ttdi').text(inv);
        $('#tp').text(tipe);
        $('#tp').text(tipe);
        if (tipe == 'Tunai') {
            $('#banktf').addClass('d-none');
            $('#tftn').removeClass('d-none');
            $('#tftb').addClass('d-none');
            $('#tfkr').addClass('d-none');
            $('#tn').text(formatcur.format(tn));
        } else if (tipe == 'Transfer'){
            $('#banktf').removeClass('d-none');
            $('#tftn').addClass('d-none');
            $('#tftb').removeClass('d-none');
            $('#tfkr').addClass('d-none');
            $('#bp').text(bpen+' - '+nor);
            $('#tb').text(formatcur.format(bnk));
        } else {
            $('#banktf').removeClass('d-none');
            $('#tftn').removeClass('d-none');
            $('#tftb').removeClass('d-none');
            $('#tfkr').removeClass('d-none');
            $('#bp').text(bpen+' - '+nor);
            $('#tn').text(formatcur.format(tn));
            $('#tb').text(formatcur.format(bnk));
            $('#kr').text(formatcur.format(krd));
        }
        $("#ttsales").text(idksr+' | '+sales);
        $("#tthj").text(formatcur.format(hj));
        $("#ketjasa").text(jasa);
        $("#nomjasa").text(formatcur.format(jasanom));
        $("#ttds").text(formatcur.format(dis));
        $("#ttcb").text(formatcur.format(cb));
        $("#ttlb").text(formatcur.format(lb));
        $("#ttgt").text(formatcur.format(total));
        if (stat == '3' || stat == '9') {
            $("#canceltrans").addClass('d-none');
        }else{
            $("#canceltrans").removeClass('d-none');
            $('#canceltrans').attr('data-id', inv);
            canceltrans();
        }
        tabledtliv(inv);
    });
}

function detailpen(){
    $('#DetailPenjualan').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var ids = button.data('id');
        var tt = button.data('total');
        var subt = button.data('subt');
        var hj = button.data('hj');
        var js = button.data('js');
        var ds = button.data('ds');
        var cb = button.data('cb');
        var sl = button.data('sales');
        $("#tthjs").text(formatcur.format(hj));
        $("#ttjs").text(formatcur.format(js));
        $("#ttdis").text(formatcur.format(ds));
        $("#ttcbs").text(formatcur.format(cb));
        $("#ttdh").text(formatcur.format(tt));
        $("#ttst").text(formatcur.format(subt));
        $("#saldh").text(ids+' | '+sl);
        tabledts(ids);
    });
}
function detailprdj(){
    $('#InfoDetail').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var inv = button.data('inv');
        var cab = button.data('cab');
        var tgl = button.data('tgl');
        var sl = button.data('sls');
        var ksr = button.data('ksr');
        var plg = button.data('plg');
        var idplg = button.data('idplg');
        var date = new Date(tgl);
        var monthName = date.toLocaleString('id-ID', { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        }).replace(' pukul ', ' ').replace(/\./g, ':');
        $("#prdcab").text(cab);
        $("#prdiv").text(inv);
        $('#prdtgl').text(monthName);
        $("#prdks").text(ksr);
        $("#prdsl").text(sl);
        if (idplg == 'Umum') {
            $("#prdcst").text(idplg);
        } else {
            $("#prdcst").text(plg);
        }
    });
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
                "data": "harga_cashback",
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
function tabledtliv(inv) {
    if ($.fn.DataTable.isDataTable('#table-dtpn')) {
        tableDJL.destroy();
    }
    tableDJL = $("#table-dtpn").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'riwayat-penjualan/detail-laporan-jual/',
            "type": "POST",
            "data": function(d) {
                d.invid = inv;
            }
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
            { 
                "data": "hrg_hpp",
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
                    tableDJL.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Detail Laporan Penjualan '+inv,
            }
        ]
            
    });
    return tableDJL;
}

function canceltrans() {
    $('#canceltrans').on('click', function (e) {
        e.preventDefault();
        var inv = $(this).data('id');
    
        swal({
            title: 'Apa anda yakin untuk membatalkan transaksi ini?',
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Tidak',
                    value: null,
                    visible: true,
                    className: 'btn-secondary',
                    closeModal: true,
                },
                confirm: {
                    text: 'Iya',
                    value: true,
                    visible: true,
                    className: 'btn-danger',
                    closeModal: true
                }
            }
        }).then((result) => {
            if (result) {
                $.ajax({
                    type: "POST",
                    url: base_url+"order-masuk/cancel",
                    dataType: "json", 
                    data: {
                        inv: inv,
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            swal("Transaksi dibatalkan", {
                                icon: "warning",
                            }).then((value) => {
                                $('#DetailLapPenjualan').modal('hide');
                                tableJL.ajax.reload();
                            });
                        } else {
                            swal("Gagal membatalkan transaksi", {
                                icon: "error",
                            });
                        }
                    },
                    error: function (error) {
                        swal("Gagal", {
                            icon: "error",
                        });
                    }
                });
            }
        });
    });
}