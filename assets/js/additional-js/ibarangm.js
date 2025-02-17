var table;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});

function tablebm() {
    if ($.fn.DataTable.isDataTable('#table-bm')) {
        table.destroy();
    }
    table = $("#table-bm").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'barang-masuk/loadbm/',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { "data": "tgl_masuk" },
            { "data": "no_fm" },
            { "data": "nama_supplier" },
            { "data": "sn_brg" },
            { "data": "no_imei" },
            { "data": "nama_brg" },
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
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "1") {
                            return `<span class="badge rounded-pill badge-secondary">BARANG GUDANG</span>`;
                        } else if(data ==="2"){
                            return `<span class="badge rounded-pill badge-primary">BARANG TOKO</span>`;
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
                "data": "id_masuk",
                "orderable": false, // Disable sorting for this column
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
                        } else if(full.status === "2") {
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
                "<'row'<'col-sm-12 col-md-12'B>>" +
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
                        table.ajax.reload();
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    exportOptions: {
                        columns: ':visible' // Export only visible columns
                    }
                }
            ]
            
    });
}

$(document).on('click', '#delete-btn', function (e) {
    e.preventDefault();

    var id_m = $(this).data('id');

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
                url: base_url + 'barang-masuk/hapus/' + id_m,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        swal('Deleted!', response.message, 'success');
                        reload();
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

// function generateid() {
//     $.ajax({
//         url: base_url+'InventoriStok/gensnacc', 
//         type: 'GET',
//         dataType: 'json',
//         success: function(response) {
//             var def = response.defID;
//             var opnameid = response.newID;

//             if (opnameid != def){
//                 $('#snacc').val(opnameid);
//             }else{
//                 $('#snacc').val(def);
//             }
//         },
//         error: function(xhr, status, error) {
//           console.error('Error fetching id data:', error);
//         }
//     });
// }

function generateid() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: base_url + 'InventoriStok/gensnacc',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var def = response.defID;
                var opnameid = response.newID;
                if (opnameid != def) {
                    $('#snacc').val(opnameid);
                    resolve(opnameid);
                } else {
                    $('#snacc').val(def);
                    resolve(def);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching id data:', error);
                reject(error);
            }
        });
    });
}
async function processIds() {
    var ts = parseInt($("#totalstok").val(), 10); 
    var generatedid = [];

    for (var index = 0; index < ts; index++) {
        try {
            var id = await generateid();
            generatedid.push(id);
            $('#snacc').val(id); 

            await insacc(id);
        } catch (error) {
            console.error('Failed to generate ID:', error);
        }
    }
    
    swal("success", "Data aksesori berhasil ditambahkan sebanyak " +ts+ " stok", "success").then(() => {
        $('#spinner').addClass('d-none');
        $('#tacc').removeClass('d-none');
        $('#tambahacc').prop('disabled', false);
        $("#suppacc").val($("#suppacc").find('option').last().val()).trigger('change.select2');
        $("#prodacc").val('0').trigger('change.select2');
        $("#hppacc").val('');
        $("#hjacc").val('');
        $("#totalstok").val('')
        reload();
        generateid();
    });
}
$(document).ready(function () {
    getselect();  
    setInterval(updateDateTime, 1000);
    addmb();
    addmk();
    addacc();
    reload();
    generateid();
});

function reload() {
    if (tablebm()) {
        table.clear().draw();
        table.ajax.reload();
    }
}
$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});
function getselect(){
    $('#suppbaru').select2({
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
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id_supplier,
                            text: item.id_supplier+' | '+item.nama_supplier,
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
            url: base_url + 'InventoriStok/loadbrg',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // Add the search term to your AJAX request
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
                        id: item.id_brg,
                        text: item.id_brg+' | '+item.nama_brg
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
    });  
    $('#suppbekas').select2({
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
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id_supplier,
                            text: item.id_supplier+' | '+item.nama_supplier,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#prodbekas').select2({
        language: 'id',
        ajax: {
            url: base_url + 'InventoriStok/loadbrg',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // Add the search term to your AJAX request
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
                        id: item.id_brg,
                        text: item.id_brg+' | '+item.nama_brg
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
    });
    $('#suppacc').select2({
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
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id_supplier,
                            text: item.id_supplier+' | '+item.nama_supplier,
                        };
                    }),
                };
            },
            cache: false,
        },
    });        
    $('#prodacc').select2({
        language: 'id',
        ajax: {
            url: base_url + 'InventoriStok/loadacc',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // Add the search term to your AJAX request
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
                        id: item.id_brg,
                        text: item.id_brg+' | '+item.nama_brg
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
    });    
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

function addmb() {
    $("#tambahbaru").on("click", function () {
        var tgl = $("#tglbaru").val();
        var sup = $("#suppbaru").val();
        var fk = $("#fakturbarang").val();
        var brg = $("#prodbaru").val();
        var sn = $("#snbaru").val();
        var imei = $("#imeibaru").val();
        var hpp = $("#hppbaru").val();
        var hj = $("#hjbaru").val();
        var spek = $("#spekbaru").val();
        var kond = 'Baru';
        var genhpp = parseFloat(hpp.replace(/\D/g, ''));
        var genhj = parseFloat(hj.replace(/\D/g, ''));
        if (!sup || !fk || !brg || !sn || !hpp || !hj) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: "barang-masuk/simpan-barang-baru",
            data: {
                tglbaru: tgl,
                suppbaru: sup,
                nofakbaru: fk,
                prodbaru: brg,
                snbaru: sn,
                imeibaru: imei,
                hppbaru: genhpp,
                hjbaru: genhj,
                spekbaru: spek,
                kondisi: kond,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#suppbaru").val($("#suppbaru").find('option').last().val()).trigger('change.select2');
                        $("#prodbaru").val('0').trigger('change.select2');
                        $("#snbaru").val('');
                        $("#imeibaru").val('');
                        $("#hppbaru").val('');
                        $("#hjbaru").val('');
                        $("#spekbaru").val('');
                        reload();
                    });
                } else if(response.status === 'exists') {
                    swal("Warning", "SN Produk sudah ada", "warning").then(() => {
                        $("#snbaru").focus();
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
function addmk() {
    $("#tambahbekas").on("click", function () {
        var tgl = $("#tglbekas").val();
        var sup = $("#suppbekas").val();
        var fk = $("#nofakbekas").val();
        var brg = $("#prodbekas").val();
        var sn = $("#snbekas").val();
        var imei = $("#imeibekas").val();
        var hpp = $("#hppbekas").val();
        var hj = $("#hjbekas").val();
        var spek = $("#spekbekas").val();
        var kond = 'Bekas';
        var genhpp = parseFloat(hpp.replace(/\D/g, ''));
        var genhj = parseFloat(hj.replace(/\D/g, ''));
        if (!sup || !fk || !brg || !sn || !hpp || !hj) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: "barang-masuk/simpan-barang-bekas",
            data: {
                tglbekas: tgl,
                suppbekas: sup,
                nofakbekas: fk,
                prodbekas: brg,
                snbekas: sn,
                imeibekas: imei,
                hppbekas: genhpp,
                hjbekas: genhj,
                spekbekas: spek,
                kondisik: kond,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#suppbekas").val($("#suppbekas").find('option').last().val()).trigger('change.select2');
                        $("#prodbekas").val('0').trigger('change.select2');
                        $("#snbekas").val('');
                        $("#imeibekas").val('');
                        $("#hppbekas").val('');
                        $("#hjbekas").val('');
                        $("#spekbekas").val('');
                        reload();
                    });
                } else if(response.status === 'exists'){
                    swal("Warning", "SN Produk sudah ada", "warning").then(() => {
                        $("#snbekas").focus();
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
function addacc() {
    $("#tambahacc").on("click", function () {
        var sup = $("#suppacc").val();
        var fk = $("#nofakacc").val();
        var brg = $("#prodacc").val();
        var sn = $("#snacc").val();
        var hpp = $("#hppacc").val();
        var hj = $("#hjacc").val();
        if (!sup || !fk || !brg || !sn || !hpp || !hj) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $('#spinner').removeClass('d-none');
        $('#tacc').addClass('d-none');
        $('#tambahacc').prop('disabled', true);
        processIds();
    });
}
function insacc(id) {
    return new Promise((resolve, reject) => {
        var tgl = $("#tglacc").val();
        var sup = $("#suppacc").val();
        var fk = $("#nofakacc").val();
        var brg = $("#prodacc").val();
        var hpp = $("#hppacc").val();
        var hj = $("#hjacc").val();
        var kond = 'Baru';
        var genhpp = parseFloat(hpp.replace(/\D/g, ''));
        var genhj = parseFloat(hj.replace(/\D/g, '')); 
        $.ajax({
            type: "POST",
            url: "barang-masuk/simpan-acc",
            data: {
                tglacc: tgl,
                suppacc: sup,
                nofakacc: fk,
                prodacc: brg,
                snacc: id,
                hppacc: genhpp,
                hjacc: genhj,
                kondacc: kond,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    $("#suppacc").val($("#suppacc").find('option').last().val()).trigger('change.select2');
                    $("#prodacc").val($("#prodacc").find('option').last().val()).trigger('change.select2');
                    resolve(response);
                } else if(response.status === 'exists'){
                    swal("Warning", "SN Produk sudah ada", "warning").then(() => {
                        $("#snbekas").focus();
                    });
                    reject("SN Produk sudah ada");
                } else {
                    reject("Unknown status");
                }
            },
            error: function (error) {
                swal("Gagal "+error, {
                    icon: "error",
                });
            },
        });
    });
}