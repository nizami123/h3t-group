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
    editPelunasan();
    detailpelunasan();
    setInterval(updateDateTime, 1000);
});
function table_etalase() {
    getselect();
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'pelunasan/loadproduk/',
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
                                url: base_url + 'pelunasan/terima_data',
                                type: 'POST',
                                dataType: 'json',
                                contentType: 'application/json',
                                data: jsonData,
                                success: function(response) {
                                    if (response.status === 'success') {
                                        swal("success", "Barang sudah diterima", "success").then(() => {
                                            window.location.href = base_url + 'pelunasan';
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
    
        if (noFaktur) {
            $.ajax({
                url: base_url + 'pelunasan/get_faktur', // File PHP untuk mengambil data
                type: 'POST',
                data: { no_faktur: noFaktur },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#namasupplier').val(response.nama_supplier); // Isi kolom nama_supp
                        $('#tagihan').val(response.tagihan); // Isi kolom nilai_tagihan
                    } else {
                        swal("error", "Faktur Tidak Ditemukan", "error")
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            alert('Silakan masukkan No Faktur');
        }
    });    

    $(document).on("click", ".btn-refresh", function () {
        let id = $(this).data("id");
    
        swal({
            title: "Konfirmasi",
            text: "Masukkan keterangan sebelum Unpost data:",
            content: {
                element: "input",
                attributes: {
                    placeholder: "Masukkan keterangan...",
                    type: "text",
                },
            },
            icon: "warning",
            buttons: ["Batal", "Unpost Data!"],
            dangerMode: true,
        }).then((keterangan) => {
            if (keterangan) {
                $.ajax({
                    url: base_url + "pelunasan/unpostData",
                    type: "POST",
                    data: { id: id, keterangan: keterangan },
                    success: function (response) {
                        swal("Berhasil!", "Data berhasil diunpost.", "success");
                        tableJL.draw();
                    },
                    error: function () {
                        swal("Gagal!", "Terjadi kesalahan, silakan coba lagi.", "error");
                    }
                });
            } else if (keterangan === "") {
                swal("Gagal!", "Keterangan tidak boleh kosong.", "error");
            }
        });
    });
    
    
    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");
        let bayar = $(this).data("bayar");
    
        // Ganti URL sesuai kebutuhan
        window.location.href = base_url + "pelunasan/edit_pelunasan/" + id ;
    });
    
    $("#editBayarForm").on("submit", function (e) {
        e.preventDefault();
    
        let id = $("#editBayarId").val();
        let bayar = $("#editBayarAmount").val();
    
        $.ajax({
            url: base_url + "pelunasan/updateBayar", // Ganti dengan URL Controller Anda
            type: "POST",
            data: { id: id, bayar: bayar },
            success: function (response) {
                $("#EditBayarModal").modal("hide");
                tableJL.draw();
            }
        });
    });

    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        swal({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: {
                cancel: "Batal",
                confirm: {
                    text: "Ya, hapus!",
                    value: true,
                    className: "btn-danger"
                }
            },
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: base_url+ "pelunasan/deleteData", // Ganti dengan URL Controller Anda
                    type: "POST",
                    data: { id: id },
                    success: function (response) {
                        swal({
                            title: "Berhasil!",
                            text: "Data telah dihapus.",
                            icon: "success",
                            timer: 2000,
                            buttons: false
                        }).then(() => {
                            tableJL.draw()
                        });
                    },
                    error: function () {
                        swal({
                            title: "Gagal!",
                            text: "Terjadi kesalahan saat menghapus data.",
                            icon: "error"
                        });
                    }
                });
            }
        });        
    });
    
    

    $('#simpan').on('click', function () {
        var noPelunasan = $('#no_pelunasan').val().trim();
    var noFaktur = $('#no_faktur').val().trim();
    var tanggal = $('#tanggal').val().trim();
    var namaSupplier = $('#namasupplier').val().trim();
    var metode = $('#metode').val().trim();
    var norek = $('#norek').val().trim();
    var tagihan = parseInt($('#tagihan').val().replace(/[^0-9]/g, '')) || 0;
    var bayar = parseInt($('#bayar').val().replace(/[^0-9]/g, '')) || 0;

    // Validasi: Cek apakah ada kolom yang kosong
    if (!noPelunasan || !noFaktur || !tanggal || !namaSupplier || !metode || !norek || tagihan === 0 ||  (bayar === 0 && metode !== 'Indent')) {
        swal("Peringatan!", "Semua kolom wajib diisi!", "warning");
        return;
    }

    // Validasi: Bayar tidak boleh lebih besar dari Tagihan
    if (bayar > tagihan) {
        swal("Error!", "Jumlah Bayar tidak boleh lebih dari Nilai Tagihan!", "error");
        return;
    }

    var formData = {
        no_pelunasan: noPelunasan,
        no_faktur: noFaktur,
        tanggal: tanggal,
        nama_supplier: namaSupplier,
        metode: metode,
        norek: norek,
        tagihan: tagihan,
        bayar: bayar
    };

        $.ajax({
            url: base_url + 'pelunasan/simpan',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    swal("success", "Data Sudah Disimpan", "success").then(() => {
                        window.location.href = base_url + 'pelunasan';
                    });
                } else {
                    swal("error", "Ada Kesalahan Sistem", "error")
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                swal("error", "Terjadi Kesalahan", "error")
            }
        });
    });

    $('#post').on('click', function () {
        var noPelunasan = $('#no_pelunasan').val().trim();
        var noFaktur = $('#no_faktur').val().trim();
        var tanggal = $('#tanggal').val().trim();
        var namaSupplier = $('#namasupplier').val().trim();
        var metode = $('#metode').val().trim();
        var norek = $('#norek').val().trim();
        var tagihan = parseInt($('#tagihan').val().replace(/[^0-9]/g, '')) || 0;
        var bayar = parseInt($('#bayar').val().replace(/[^0-9]/g, '')) || 0;
    
        // Validasi: Cek apakah ada kolom yang kosong
        if (!noPelunasan || !noFaktur || !tanggal || !namaSupplier || !metode || !norek || tagihan === 0 || bayar === 0) {
            swal("Peringatan!", "Semua kolom wajib diisi!", "warning");
            return;
        }
    
        // Validasi: Bayar tidak boleh lebih besar dari Tagihan
        if (bayar > tagihan) {
            swal("Error!", "Jumlah Bayar tidak boleh lebih dari Nilai Tagihan!", "error");
            return;
        }
    
        var formData = {
            no_pelunasan: noPelunasan,
            no_faktur: noFaktur,
            tanggal: tanggal,
            nama_supplier: namaSupplier,
            metode: metode,
            norek: norek,
            tagihan: tagihan,
            bayar: bayar
        };

        $.ajax({
            url: base_url + 'pelunasan/posting',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    swal("success", "Data Sudah Diposting", "success").then(() => {
                        window.location.href = base_url + 'pelunasan';
                    });
                } else {
                    swal("error", "Ada Kesalahan Sistem", "error")
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                swal("error", "Terjadi Kesalahan", "error")
            }
        });
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

function editPelunasan(){
    $('#EditBayarModal').on('show.bs.modal', function (e) {
        let button = $(e.relatedTarget); 
        let id = button.data('id'); 
        let bayar = button.data('bayar');

        console.log(id);
        console.log(bayar);
    
        $("#editBayarId").val(id);
        $("#editBayarAmount").val(bayar);
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
            "url": base_url + 'pelunasan/detail_pelunasan/'+id,
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

function detailpelunasan() {
    $('#DetailPelunasan').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        tabledo(id);
    });
}

function tablejl() {
    if ($.fn.DataTable.isDataTable('#table-pelunasan')) {
        tableJL.destroy();
    }
    tableJL = $("#table-pelunasan").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'pelunasan/pelunasan_list/',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
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
            { "data": "no_faktur" },           
            { 
                "data": "ispost",
                "render": function(data, type, row) {
                    let checked = data == 1 ? 'checked' : '';
                    return `<input type="checkbox" class="post-checkbox" data-id="${row.no_faktur}" ${checked} disabled>`;
                }
            },
            { "data": "nama_supplier" },
            { "data": "metode" },
            { "data": "no_rekening" },
            { "data": "jumlah" }, 
            { "data": "nama_lengkap" }, 
            {
                "data": "id_pelunasan",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        let buttons = '';
            
                        if (full.ispost == 1) {
                            // Jika ispost == 1, hanya tombol refresh
                            buttons = `
                                <button class="btn btn-warning btn-refresh" data-id="${data}">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            `;
                        } else {
                            // Jika ispost == 0, tombol edit dan delete
                            buttons = `
                               <button class="btn btn-primary btn-edit" data-id="${data}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-delete" data-id="${data}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            `;
                        }
            
                        return `
                            <ul class="action">
                                <div class="btn-group">
                                    ${buttons}
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
                title: 'Laporan pelunasan',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            },
            {
                text: 'Create', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Tambah pelunasan',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                },
                action: function (e, dt, button, config) {
                    window.location.href = base_url + 'pelunasan/input_pelunasan'; // Ganti dengan URL tujuan
                }
            }
            
        ]
            
    });
    return tableJL;
}


function updateDateTime() {
    var now = new Date();
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0');
    var day = now.getDate().toString().padStart(2, '0');
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    $('#tanggal').val(year + '-' + month + '-' + day + 'T' + hours + ':' + minutes);
    
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