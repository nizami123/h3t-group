var tableBK;
var tableSK;
var detailSK;
var tableBM;
var now = new Date();
var day = String(now.getDate()).padStart(2, '0');
var month = String(now.getMonth() + 1).padStart(2, '0');
var year = now.getFullYear();
var formattedDate = day + month + year;
var formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
// datatable
function tablebk(formatter) {
    if ($.fn.DataTable.isDataTable('#table-bk')) {
        tableBK.destroy();
    }
    tableBK = $("#table-bk").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'barang-keluar/loadbk/',
            "type": "POST"
        },
        "columns": [
            { "data": "tgl_keluar" },
            { "data": "no_surat_keluar" },
            { "data": "nama_toko" },
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            {
                "data": "spek",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (data === null) {
                            return ''; // Return an empty string or any default value you prefer
                        } else {
                            var formattedDeskripsi = data.replace(/\n/g, '<br>');
                            return formattedDeskripsi;
                        }
                    }
                    return data;
                }
            },
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
                }
            },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "1") {
                            return `<span class="badge rounded-pill badge-secondary">ON PROSES</span>`;
                        } else if(data ==="2"){
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-success">TERJUAL</span>`;
                        } else if(data==="4"){
                            return `<span class="badge rounded-pill badge-info">BOOKING</span>`;
                        } else if(data==="5"){
                            return `<span class="badge rounded-pill badge-danger">PINDAH</span>`;
                        } else if(data==="6"){
                            return `<span class="badge rounded-pill badge-warning">UNVERIFIED</span>`;
                        } else if(data==="0"){
                            return `<span class="badge rounded-pill badge-success">KIRIM</span>`;
                        } else if(data==="9"){
                            return `<span class="badge rounded-pill badge-success">GESTUN</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
            { 
                "data": "sn_brg",
                "render": function(data, type, full, meta) {
                  // You can customize the rendering of the image here
                  if (type === "display") {
                      if (data) {
                          return `<img class="img-fluid table-avtar img-90" src="${base_url+'assets/dhdokumen/snbarcode/'+data+'.jpg'}" alt="Image" loading="lazy">`;
                      } else {
                          return "No Image";
                      }
                  }
                  return data;
              }
            },
            {
                "data": "id_keluar",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (full.status === "1") { 
                            return `
                                <ul class="action">
                                    <li class="delete">
                                        <button class="btn" id="delete-btn" type="button" data-id="${data}"><i class="icon-trash"></i></button>
                                    </li>
                                </ul>
                            `;
                        } else if(full.status === "2"  || full.status === "3" || full.status === "4" || full.status === "5" || full.status ==="6" || full.status ==="0" || full.status ==="9") {
                            return `
                                <ul class="action">
                                    <li class="delete">
                                        <button class="btn" id="disabled-btn" type="button" data-id="${data}"><i class="icon-trash disabled"></i></button>
                                    </li>
                                </ul>
                            `;
                        }
                    }
                    return data;
                }
            }            
        ],
        "dom":  "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
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
                        tableBK.ajax.reload();
                        getCountStock(formatter);
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    exportOptions: {
                        columns: ':visible:not(:last-child):not(:nth-last-child(2))'
                    }
                }
            ]
            
    });
    return tableBK;
}
function tablesk(formatter) {
    if ($.fn.DataTable.isDataTable('#table-sk')) {
        tableSK.destroy();
    }
    tableSK = $("#table-sk").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'barang-keluar/groupsk/',
            "type": "POST"
        },
        "columns": [
            { "data": "tgl_keluar" },
            { "data": "no_surat_keluar" },
            { "data": "nama_toko" },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "1") {
                            return `<span class="badge rounded-pill badge-secondary">ON PROSES</span>`;
                        } else if(data ==="2"){
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-success">TERJUAL</span>`;
                        } else if(data==="4"){
                            return `<span class="badge rounded-pill badge-info">BOOKING</span>`;
                        } else if(data==="6"){
                            return `<span class="badge rounded-pill badge-warning">UNVERIFIED</span>`;
                        } else if(data==="0"){
                            return `<span class="badge rounded-pill badge-success">KIRIM</span>`;
                        } else if(data==="9"){
                            return `<span class="badge rounded-pill badge-success">GESTUN</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
            {
                "data": "no_surat_keluar",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (full.status == 1) {
                            return `
                                <ul class="action">
                                    <li class="edit">
                                        <button class="btn kirim-button" type="button" id="kirimcb" data-id="${data}"><i class="icofont icofont-ui-check"></i></button>
                                    </li>
                                    <li class="delete">
                                        <button class="btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#DetailSuratKeluar"><i class="fa fa-info-circle"></i></button>
                                    </li>
                                    <li class="edit">
                                        <button class="btn download-button" type="button" id="downloadsk" data-id="${data}"><i class="icofont icofont-print"></i></button>
                                    </li>
                                </ul>
                            `;
                        } else {
                            return `
                                <ul class="action">
                                    <li class="delete">
                                        <button class="btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#DetailSuratKeluar"><i class="fa fa-info-circle"></i></button>
                                    </li>
                                    <li class="edit">
                                        <button class="btn download-button" type="button" id="downloadsk" data-id="${data}"><i class="icofont icofont-print"></i></button>
                                    </li>
                                </ul>
                            `;
                        }
                    }
                    return data;
                }
            }            
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
                        tableSK.ajax.reload();
                        getCountStock(formatter);
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    exportOptions: {
                        columns: ':visible:not(:last-child):not(:nth-last-child(2))'
                    }
                }
            ]
            
    });
    return tableSK;
}
function detailsk(sk) {
    if ($.fn.DataTable.isDataTable('#table-detail')) {
        detailSK.destroy();
    }
    detailSK = $("#table-detail").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'barang-keluar/getsk/'+sk,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "jenis" },
            { "data": "merk" },
            {
                "data": "spek",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (data === null) {
                            return ''; // Return an empty string or any default value you prefer
                        } else {
                            var formattedDeskripsi = data.replace(/\n/g, '<br>');
                            return formattedDeskripsi;
                        }
                    }
                    return data;
                }
            },
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
                }
            },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "1") {
                            return `<span class="badge rounded-pill badge-secondary">ON PROSES</span>`;
                        } else if(data ==="2"){
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-success">TERJUAL</span>`;
                        } else if(data==="4"){
                            return `<span class="badge rounded-pill badge-info">BOOKING</span>`;
                        } else if(data==="6"){
                            return `<span class="badge rounded-pill badge-warning">UNVERIFIED</span>`;
                        } else if(data==="0"){
                            return `<span class="badge rounded-pill badge-success">KIRIM</span>`;
                        } else if(data==="9"){
                            return `<span class="badge rounded-pill badge-success">GESTUN</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
            { 
                "data": "sn_brg",
                "render": function(data, type, full, meta) {
                  // You can customize the rendering of the image here
                  if (type === "display") {
                      if (data) {
                          return `<img class="img-fluid table-avtar img-90" src="${base_url+'assets/dhdokumen/snbarcode/'+data+'.jpg'}" alt="Image" loading="lazy">`;
                      } else {
                          return "No Image";
                      }
                  }
                  return data;
              }
            },
            {
                "data": "id_keluar",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (full.status === "1") { 
                            return `
                                <ul class="action">
                                    <li class="delete">
                                        <button class="btn" id="delete-btn" type="button" data-id="${data}"><i class="icon-trash"></i></button>
                                    </li>
                                </ul>
                            `;
                        } else {
                            return `
                                <ul class="action">
                                    <li class="delete">
                                        <button class="btn" id="disabled-btn" type="button" data-id="${data}"><i class="icon-trash disabled"></i></button>
                                    </li>
                                </ul>
                            `;
                        }
                    }
                    return data;
                }
            }            
        ],
        "dom":  "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
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
                        detailSK.ajax.reload();
                        getCountStock(formatter);
                    }
                },
            ]
            
    });
    return detailSK;
}
function tablebm() {
    if ($.fn.DataTable.isDataTable('#table-prdacc')) {
        tableBM.destroy();
    }
    tableBM = $("#table-prdacc").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'BarangKeluar/loadprdacc/',
            "type": "POST",
            data: function(d) {
                d.nm = $('#prodacc').val();
                d.mk = $('#merkacc').val();
            }
        },
        "columns": [
            { "data": "id_masuk",
                "render": function(data, type, row, meta) {
                  return '<input type="checkbox" class="checkbox_prod" data-hpp="'+row.hrg_hpp+'" data-hj="'+row.hrg_jual+'" id="checkbox_' + data + '" value="' + data + '">';
                },
                "orderable": false
            },
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },
            { 
                "data": "hrg_hpp",
                "render": function (data, type, row) {
                    return formatter.format(data);
                }
            },
            { 
                "data": "hrg_jual",
                "render": function (data, type, row) {
                    return formatter.format(data);
                }
            },         
        ],
        "dom":  "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
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
                        tableBM.ajax.reload();
                        // getCountStock(formatter);
                    }
                },
            ],
    });
    // Event listener for "select all" control
    $('#select-all').on('click', function() {
        var rows = tableBM.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // Event listener to handle row checkbox changes
    $('#table-prdacc tbody').on('change', 'input.checkbox_prod', function() {
        if (!this.checked) {
            var el = $('#select-all').get(0);
            if (el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });
    
    $('#prodacc, #merkacc').on('change', function() {
        tableBM.draw();
    }); 
    $('input[type="search"]').on('change', function() {
        tableBM.draw();
    }); 
    return tableBM;
}
// datatable
function formatDate(date) {
    var options = { day: 'numeric', month: 'long', year: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}
function getsk(){
    $('#DetailSuratKeluar').on('show.bs.modal', function (e) {
        getselect();
        var button = $(e.relatedTarget);
        var sk = button.data('id');
        
        $.ajax({
            url: base_url + "barang-keluar/getdetailsk/"+sk,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    var date = new Date(item.tgl_keluar);
                    var formattedDate = formatDate(date);
                    $('#dsk').text(item.no_surat_keluar);
                    $('#dtgl').text(formattedDate);
                    $('#dcab').text(item.nama_toko);
                });
            }
        });
        detailsk(sk);
    });
}
$(document).on('click', '#delete-btn', function (e) {
    e.preventDefault();

    var id_k = $(this).data('id');

    swal({
        title: 'Apa anda yakin?',
        text: 'Data yang sudah terhapus hilang permanen!',
        icon: 'warning',
        buttons: {
            cancel: {
                text: 'Cancel',
                value: null,
                visible: true,
                className: 'btn-secondary',
                closeModal: true,
            },
            confirm: {
                text: 'Delete',
                value: true,
                visible: true,
                className: 'btn-danger',
                closeModal: true
            }
        }
    }).then((result) => {
        if (result) {
            // User clicked 'Delete', proceed with the deletion
            $.ajax({
                type: 'POST',
                url: base_url + 'barang-keluar/hapus/' + id_k,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        swal('Deleted!', response.message, 'success');
                        reload(formatter);
                    } else {
                        swal('Error!', response.message, 'error');
                    }
                },
                error: function (error) {
                    swal('Error!', 'An error occurred while processing the request.', 'error');
                }
            });
        }
    });
});
$(document).on('click', '#kirimcb', function (e) {
    e.preventDefault();

    var nosk = $(this).data('id');

    swal({
        title: 'Apa anda yakin?',
        text: 'Surat yang sudah disetujui, wajib dikirim kecabang tujuan',
        icon: 'warning',
        buttons: {
            cancel: {
                text: 'Batal',
                value: null,
                visible: true,
                className: 'btn-secondary',
                closeModal: true,
            },
            confirm: {
                text: 'Setuju',
                value: true,
                visible: true,
                className: 'btn-success',
                closeModal: true
            }
        }
    }).then((result) => {
        if (result) {
            
            $.ajax({
                type: 'POST',
                url: base_url + 'barang-keluar/approve-sk/' + nosk,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        swal("success", "Surat berhasil dikirim", "success");
                        reload(formatter);
                    } else {
                        swal('Error!', "Gagal disetujui", 'error');
                    }
                },
                error: function (error) {
                    swal('Error!', 'An error occurred while processing the request.', 'error');
                }
            });
        }
    });
});
$(document).ready(function () {
    getCountStock(formatter);
    card(formatter);
    getselect();
    setInterval(updateDateTime, 1000);
    selectedbrg();
    addmb(formatter);
    addmk(formatter);
    addacc(formatter);
    reload(formatter);
    getsk();
    printsk();
    tablebm();
});
function printsk() {
    $('#table-sk').on('click', '.download-button', function() {
        var nosk = $(this).data('id');
        var printUrl = base_url + 'barang-keluar/printsk/' + nosk;
        window.open(printUrl, '_blank');
    });
}
// card
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
// card
function selectedbrg() {
    $('#prodbaru').on('select2:select', function(e) {
        var data = e.params.data;
        var textParts = data.id.split('-');
        var merk = e.params.data.merk;
        var jenis = e.params.data.jenis;
        var spek = e.params.data.spek;
        $('#merkbaru').val(merk);
        $('#jenisbaru').val(jenis);
        $('#spekbaru').val(spek);
    });
    $('#prodbekas').on('select2:select', function(e) {
        var data = e.params.data;
        var textParts = data.id.split('-');
        var merk = e.params.data.merk;
        var jenis = e.params.data.jenis;
        var spek = e.params.data.spek;
        $('#merkbekas').val(merk);
        $('#jenisbekas').val(jenis);
        $('#spekbekas').val(spek);
    });
    $('#cabangbaru').on('select2:select', function(e) {
        var data = e.params.data;
        var cab = data.id.split('-');
        var get = cab[1].trim();
        var nowdate = new Date();
        var day = String(nowdate.getDate()).padStart(2, '0');
        var month = String(nowdate.getMonth() + 1).padStart(2, '0');
        var year = nowdate.getFullYear();
        var hours = String(nowdate.getHours()).padStart(2, '0');
        var minutes = String(nowdate.getMinutes()).padStart(2, '0');
        var seconds = String(nowdate.getSeconds()+1).padStart(2, '0');
        var formatsk = 'SK'+get+hours+minutes+seconds+day+month+year;
        $('#nosuratb').val(formatsk);
    });
    $('#cabangbekas').on('select2:select', function(e) {
        var data = e.params.data;
        var cab = data.id.split('-');
        var get = cab[1].trim();
        var nowdate = new Date();
        var day = String(nowdate.getDate()).padStart(2, '0');
        var month = String(nowdate.getMonth() + 1).padStart(2, '0');
        var year = nowdate.getFullYear();
        var hours = String(nowdate.getHours()).padStart(2, '0');
        var minutes = String(nowdate.getMinutes()).padStart(2, '0');
        var seconds = String(nowdate.getSeconds()+1).padStart(2, '0');
        var formatsk = 'SK'+get+hours+minutes+seconds+day+month+year;
        $('#nosuratk').val(formatsk);
    });
    $('#cabangacc').on('select2:select', function(e) {
        var data = e.params.data;
        var cab = data.id.split('-');
        var get = cab[1].trim();
        var nowdate = new Date();
        var day = String(nowdate.getDate()).padStart(2, '0');
        var month = String(nowdate.getMonth() + 1).padStart(2, '0');
        var year = nowdate.getFullYear();
        var hours = String(nowdate.getHours()).padStart(2, '0');
        var minutes = String(nowdate.getMinutes()).padStart(2, '0');
        var seconds = String(nowdate.getSeconds()+1).padStart(2, '0');
        var formatsk = 'SK'+get+hours+minutes+seconds+day+month+year;
        $('#nosuratacc').val(formatsk);
    });
}
function getselect(){
    $('#cabangbaru').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadstore',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // Add the search term to your AJAX request
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id_toko,
                            text: item.id_toko+' | '+item.nama_toko,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#cabangbekas').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadstore',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // Add the search term to your AJAX request
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id_toko,
                            text: item.id_toko+' | '+item.nama_toko,
                            // id_total: item.id_toko
                        };
                    }),
                };
            },
            cache: false,
        },
    });    
    $('#cabangacc').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadstore',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // Add the search term to your AJAX request
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id_toko,
                            text: item.id_toko+' | '+item.nama_toko,
                            // id_total: item.id_toko
                        };
                    }),
                };
            },
            cache: false,
        },
    });    
    $('#prodbaru').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadbrgb',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var groups = {};
                var results = [];
    
                data.forEach(function (item) {
                    var groupName = item.merk + ' - ' + item.jenis;
                    if (!groups[groupName]) {
                        groups[groupName] = [];
                    }
                    groups[groupName].push({
                        id: item.id_masuk,
                        text: item.sn_brg+' | '+item.nama_brg,
                        merk : item.merk,
                        spek : item.spek,
                        jenis : item.jenis,
                        hrg_hpp: item.hrg_hpp, 
                        hrg_jual: item.hrg_jual
                    });
                });
    
                Object.keys(groups).forEach(function (groupName) {
                    results.push({
                        text: groupName,
                        children: groups[groupName]
                    });
                });
    
                return {
                    results: results
                };
            },
            cache: false,
        },
        templateResult: function (data) {
            if (!data.id) {
                return data.text;
            }
            return getDataBM(data);
        }
    });
    $('#prodbekas').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadbrgk',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var groups = {};
                var results = [];
    
                data.forEach(function (item) {
                    var groupName = item.merk + ' - ' + item.jenis;
                    if (!groups[groupName]) {
                        groups[groupName] = [];
                    }
                    groups[groupName].push({
                        id: item.id_masuk,
                        text: item.sn_brg+' | '+item.nama_brg,
                        merk : item.merk,
                        spek : item.spek,
                        jenis : item.jenis,
                        hrg_hpp: item.hrg_hpp, 
                        hrg_jual: item.hrg_jual
                    });
                });
    
                Object.keys(groups).forEach(function (groupName) {
                    results.push({
                        text: groupName,
                        children: groups[groupName]
                    });
                });
    
                return {
                    results: results
                };
            },
            cache: false,
        },
        templateResult: function (data) {
            if (!data.id) {
                return data.text;
            }
            return getDataBM(data);
        }        
    });
    $('#merkacc').select2({
        language: 'id',
    });
    $('#prodacc').select2({
        language: 'id',
        ajax: {
            transport: async function (params, success, failure) {
                try {
                    const response = await fetch(base_url + 'BarangKeluar/loadbrgacc', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                    const data = await response.json();
                    success({
                        results: data.map(item => ({
                            id: item.nama_brg,
                            text: item.nama_brg
                        }))
                    });
                } catch (error) {
                    failure(error);
                }
            },
            delay: 250,
            cache: false
        },
        templateResult: function (data) {
            if (!data.id) {
                return data.text;
            }
            return getDataBM(data);
        }
    });

    $('#prodacc').on('change', async function () {
        const data = $('#prodacc').select2('data')[0]; // Get the selected data
        const nm = data.id;

        // Show loading message
        $("#merkacc").empty().append("<option disabled selected>Loading...</option>");

        // Fetch new data for #merkacc
        try {
            const response = await fetch(base_url + 'BarangKeluar/loadmerkacc/' + encodeURIComponent(nm), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const data = await response.json();
            
            $("#merkacc").empty().append("<option disabled selected value='0'>Pilih Merk</option>");
            
            // Populate #merkacc with new options
            const newOptions = data.map(item => new Option(item.merk, item.merk, false, false));
            $('#merkacc').append(newOptions);
            $('#merkacc option[value="0"]').remove();
        } catch (error) {
            console.error('Error fetching data:', error);
            $("#merkacc").empty().append("<option disabled selected>Error loading data</option>");
        }
    });
}
function getDataBM(data) {
    var $option = $('<span></span>');
    $option.text(data.text);
    $option.attr('data-hrg_hpp', data.hrg_hpp);
    $option.attr('data-hrg_jual', data.hrg_jual);
    $option.attr('data-merk', data.merk);
    $option.attr('data-spek', data.spek);
    $option.attr('data-jenis', data.jenis);
    return $option;
}
function updateDateTime() {
    var now = new Date();
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0');
    var day = now.getDate().toString().padStart(2, '0');
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    $('#tglbaru').val(year + '-' + month + '-' + day + 'T' + hours + ':' + minutes);
    $('#tglbekas').val(year + '-' + month + '-' + day + 'T' + hours + ':' + minutes);
    $('#tglacc').val(year + '-' + month + '-' + day + 'T' + hours + ':' + minutes);
    
}
function addmb(formatter) {
    $("#tambahbaru").on("click", function () {
        var tgl = $("#tglbaru").val();
        var cab = $("#cabangbaru").val();
        var sk = $("#nosuratb").val();
        var idm = $("#prodbaru").val();
        var selectBM = $("#prodbaru").select2('data')[0];
        var hrg_hpp = selectBM.hrg_hpp;
        var hrg_jual = selectBM.hrg_jual;
        var margin = ((hrg_jual - hrg_hpp) / hrg_hpp) * 100;

        if (!cab || !sk || !hrg_hpp || !hrg_jual) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        }
        
        $.ajax({
            type: "POST",
            url: "barang-keluar/simpan-barang-baru",
            data: {
                tglbaru: tgl,
                cabangbaru: cab,
                nosuratb: sk,
                prodbaru: idm,
                hrg_hpp: hrg_hpp,
                hrg_jual: hrg_jual,
                margin: margin.toFixed(2)
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#cabangbaru").val($("#cabangbaru").find('option').last().val()).trigger('change.select2');
                        $("#prodbaru").val('0').trigger('change.select2');
                        $("#merkbaru").val('');
                        $("#jenisbaru").val('');
                        $("#spekbaru").val('');
                        reload(formatter);
                    });
                } else if(response.status === 'exists') {
                    swal("Warning", "Barang sudah diinputkan", "warning").then(() => {
                        $("#prodbaru").val($("#prodbaru").find('option').last().val()).trigger('change.select2');
                    });
                }
            },
            error: function (error) {
                swal("Gagal "+error, {
                    icon: "error",
                });
            }
        });
    });
}
function addmk(formatter) {
    $("#tambahbekas").on("click", function () {
        var tgl = $("#tglbekas").val();
        var cab = $("#cabangbekas").val();
        var sk = $("#nosuratk").val();
        var idm = $("#prodbekas").val();
        var selectBM = $("#prodbekas").select2('data')[0];
        var hrg_hpp = selectBM.hrg_hpp;
        var hrg_jual = selectBM.hrg_jual;
        var margin = ((hrg_jual - hrg_hpp) / hrg_hpp) * 100;
        
        if (!cab || !sk || !hrg_hpp || !hrg_jual) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        }
        $.ajax({
            type: "POST",
            url: "barang-keluar/simpan-barang-bekas",
            data: {
                tglbekas: tgl,
                cabangbekas: cab,
                nosuratk: sk,
                prodbekas: idm,
                hrg_hpp: hrg_hpp,
                hrg_jual: hrg_jual,
                margin: margin.toFixed(2)
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#cabangbekas").val($("#cabangbekas").find('option').last().val()).trigger('change.select2');
                        $("#prodbekas").val('0').trigger('change.select2');
                        $("#merkbekas").val('');
                        $("#jenisbekas").val('');
                        $("#spekbekas").val('');
                        reload(formatter);
                    });
                } else if(response.status === 'exists'){
                    swal("Warning", "Barang sudah diinputkan", "warning").then(() => {
                        $("#prodbekas").val($("#prodbekas").find('option').last().val()).trigger('change.select2');
                    });
                }
            },
            error: function (error) {
                swal("Gagal "+error, {
                    icon: "error",
                });
            }
        });
    });
}
function addacc(formatter) {
    $("#tambahacc").on("click", function () {
        var nsc = $('#nosuratacc').val();
        if (!nsc) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        }
        var checkedCheckboxes = [];
        $('.checkbox_prod:checked').each(function() {
            var idm = $(this).val();
            var tgl = $("#tglacc").val();
            var cab = $("#cabangacc").val();
            var sk = $("#nosuratacc").val();
            var hrg_hpp = $(this).data('hpp');
            var hrg_jual = $(this).data('hj');
            var margin = ((hrg_jual - hrg_hpp) / hrg_hpp) * 100;

            checkedCheckboxes.push({
                id_masuk: idm,
                id_toko: cab,
                tgl_keluar: tgl,
                no_surat_keluar: sk,
                hrg_hpp: hrg_hpp,
                hrg_jual: hrg_jual,
                margin: margin.toFixed(2),
                status: '1' 
            });
        });

        if (checkedCheckboxes.length > 0) {
            $.ajax({
                url: base_url + 'barang-keluar/simpan-acc',
                type: 'POST',
                dataType: 'json',
                data: { checkedCheckboxes: checkedCheckboxes },
                success: function(response) {
                    if (response.status === 'success') {
                        swal("Success", "Data berhasil ditambahkan", "success").then(() => {
                            reload(formatter);
                            // tableBM.ajax.reload();
                        });
                    } else if (response.status === 'exists') {
                        swal("Warning", "Barang sudah diinputkan", "warning").then(() => {
                            
                        });
                    }
                },
                error: function(xhr, status, error) {
                    swal("Gagal "+error, {
                        icon: "error",
                    });
                }
            });
        }
    });
}

function reload(formatter) {
    var bkReloaded = tablebk(formatter);
    var skReloaded = tablesk(formatter);
    var acReloaded = tablebm()
    if (bkReloaded && skReloaded && acReloaded) {
        bkReloaded.clear().draw();
        bkReloaded.ajax.reload();
        skReloaded.clear().draw();
        skReloaded.ajax.reload();
        acReloaded.clear().draw();
        acReloaded.ajax.reload();
    }
}