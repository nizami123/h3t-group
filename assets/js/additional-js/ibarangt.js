var tableSK;
var tableSP;
var detailSK;
var detailSP;
var defaultSelectedName = null;
var defcabsp = null;
var now = new Date();
var day = String(now.getDate()).padStart(2, '0');
var month = String(now.getMonth() + 1).padStart(2, '0');
var year = now.getFullYear();
var formattedDate = day + month + year;

function tablesk() {
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'terima-barang/groupsk/',
    };
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
        "ajax": ajaxConfig,
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
                        }  else if(data==="0"){
                            return `<span class="badge rounded-pill badge-success">KIRIM</span>`;
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
                        if (data) { 
                            return `
                                <ul class="action">
                                    <li class="edit">
                                        <button class="btn" type="button" id="approvesk" data-id="${data}"><i class="icofont icofont-ui-check"></i></button>
                                    </li>
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
function tablesp() {
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'terima-barang/groupsp/',
    };
    if ($.fn.DataTable.isDataTable('#table-sp')) {
        tableSP.destroy();
    }
    tableSP = $("#table-sp").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": ajaxConfig,
        "columns": [
            { "data": "tgl_pindah" },
            { "data": "nosp" },
            { "data": "kpd_cab" },
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
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
            {
                "data": "id_pindah",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (data) { 
                            return `
                                <ul class="action">
                                    <li class="edit">
                                        <button class="btn download-button" type="button" id="approvesp" data-id="${data}"><i class="icofont icofont-ui-check"></i></button>
                                    </li>
                                    <li class="delete">
                                        <button class="btn" type="button" data-id="${data}" data-sp="${full.nosp}" data-tglp="${full.tgl_pindah}" data-kpd="${full.kpd_cab}" data-bs-toggle="modal" data-bs-target="#DetailSuratPindah"><i class="fa fa-info-circle"></i></button>
                                    </li>
                                    <li class="edit">
                                        <button class="btn download-button" type="button" id="btn-printsp" data-id="${full.nosp}"><i class="icofont icofont-print"></i></button>
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
                    tableSP.ajax.reload();
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
    
    return tableSP;
}

$(document).on('select2:select', '#cab', function (e) {
    var selectedValue = e.params.data.id;
    var selectedName = selectedValue.split('|')[1];
    
    if (selectedValue !== defaultSelectedName) { 
        var ajaxUrl = base_url + 'terima-barang/filtersk/' + selectedName;
        reloadDataTable(ajaxUrl, selectedName); 
    } else {
        var ajaxUrl = base_url + 'terima-barang/groupsk/';
        reloadDataTable(ajaxUrl, null); 
    }
});
$(document).on('select2:select', '#cabsp', function (e) {
    var selectedValue = e.params.data.id;
    var selectedName = selectedValue.split('|')[1];
    
    if (selectedValue !== defcabsp) { 
        var ajaxUrl = base_url + 'terima-barang/filtersp/' + selectedName;
        filtersp(ajaxUrl, selectedName); 
    } else {
        var ajaxUrl = base_url + 'terima-barang/groupsp/';
        filtersp(ajaxUrl, null); 
    }
});

function approve() {
    $('#table-sk').on('click', '#approvesk', function() {
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "terima-barang/approve",
            dataType: "json", 
            data: {
                ska: id
            },
            success: function (response) {
                if (response.status === 'success') {
                    swal("Surat keluar berhasil disetujui", {
                        icon: "success",
                    }).then((value) => {
                        tableSK.ajax.reload();
                    });
                } else {
                    swal("Gagal approve surat keluar", {
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
    });
    $('#table-sp').on('click', '#approvesp', function() {
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "terima-barang/approvesp",
            dataType: "json", 
            data: {
                idp: id
            },
            success: function (response) {
                if (response.status === 'success') {
                    swal("Surat pindah berhasil diterima", {
                        icon: "success",
                    }).then((value) => {
                        tableSP.ajax.reload();
                    });
                } else {
                    swal("Gagal approve surat keluar", {
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
    });
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
                        } else if(data==="0"){
                            return `<span class="badge rounded-pill badge-success">KIRIM</span>`;
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
function infosk() {
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
function printsk() {
    $('#table-sk').on('click', '.download-button', function() {
        var nosk = $(this).data('id');
        var printUrl = base_url + 'barang-keluar/printsk/' + nosk;
        window.open(printUrl, '_blank');
    });
}
function detailsp(sp) {
    if ($.fn.DataTable.isDataTable('#table-detailp')) {
        detailSP.destroy();
    }
    detailSP = $("#table-detailp").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'BarangTerima/getsp/'+sp,
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
                        detailSP.ajax.reload();
                        getCountStock(formatter);
                    }
                },
            ]
            
    });
    return detailSP;
}
function infosp() {
    $('#DetailSuratPindah').on('show.bs.modal', function (e) {
        getselect();
        var button = $(e.relatedTarget);
        var sp = button.data('id');
        var nosp = button.data('sp');
        var tglp = button.data('tglp');
        var kpd = button.data('kpd');
        var date = new Date(tglp);
        var formattedDate = formatDate(date);
        $('#dsp').text(nosp);
        $('#dtglp').text(formattedDate);
        $('#dcabp').text(kpd);
        detailsp(nosp);
    });
}
function printsp() {
    $(document).on('click', '#btn-printsp', function() {
        var nosp = $(this).data('id');
        var printUrl = base_url + 'BarangPindah/printsp/' + nosp;
        window.open(printUrl, '_blank');
    });
}
$(document).ready(function () {
    $("#cab").val('0').trigger('change.select2'); // Set default value on page load
    defaultSelectedName = $("#cab").val();
    defcabsp = $("#cabsp").val();
    tablesk();
    tablesp();
    approve();
    getselect();
    infosk();
    infosp();
    printsk();
    printsp();
});

function getselect(){
    $('#cab').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangTerima/loadstore',
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
                            id: item.id_toko+'|'+item.nama_toko,
                            text: item.id_toko+' | '+item.nama_toko,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#cabsp').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangTerima/loadstore',
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
                            id: item.id_toko+'|'+item.nama_toko,
                            text: item.id_toko+' | '+item.nama_toko,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
}
function formatDate(date) {
    var options = { day: 'numeric', month: 'long', year: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}
function reloadDataTable(url, selectedName) {
    if ($.fn.DataTable.isDataTable('#table-sk')) {
        tableSK.ajax.url(url).load(); 
        if (selectedName) {
            tableSK.column(2).search(selectedName).draw(); 
        } else {
            tableSK.column(2).search('').draw(); 
        }
    }
}
function filtersp(url, selectedName) {
    if ($.fn.DataTable.isDataTable('#table-sp')) {
        tableSP.ajax.url(url).load(); 
        if (selectedName) {
            tableSP.column(2).search(selectedName).draw(); 
        } else {
            tableSP.column(2).search('').draw(); 
        }
    }
}