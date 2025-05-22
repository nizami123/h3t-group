var table;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});


function formatRupiah(angka, prefix = 'Rp. ') {
    let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      let separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    return prefix + rupiah;
  }

  // Fungsi untuk hapus format dan ambil angka asli
  function getAngka(str) {
    return parseInt(str.replace(/[^0-9]/g, '')) || 0;
  }

  // Fungsi hitung total
  function hitungTotal() {
    let harga = getAngka($('#hrg_jual').val());  // Ambil harga jual asli
    let diskon = getAngka($('#diskon').val());   // Ambil diskon asli

    let total = harga - diskon;
    if (total < 0) total = 0; // Biar gak minus

    $('#total').val(formatRupiah(total.toString()));
  }

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
            "url": base_url + 'PenjualanInput/loadbm/',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { "data": "tanggal" },
            { "data": "kode_penjualan" },
            { "data": "nama_plg" },
            { "data": "nama_brg" },
            { 
                "data": "hrg_jual",
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
            { "data": "jml" },
            
            { 
                "data": "total",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "keterangan" },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
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
                url: base_url + 'PenjualanInput/hapus/' + id_m,
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
//         url: base_url+'PenjualanInput/gensnacc', 
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
            url: base_url + 'PenjualanInput/gensnacc',
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
            url: base_url + 'PenjualanInput/loadsupp',
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
                            id: item.id_plg,
                            text: item.id_plg+' | '+item.nama_plg,
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
            url: base_url + 'PenjualanInput/loadbrg',
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
                        id: item.sn_brg,
                        text: item.sn_brg+' | '+item.nama_brg+ ' '+item.warna ,
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
    });  
    
    $('#prodbaru').on('select2:select', function (e) {
        console.log("Selected data:", e.params.data);
        var data = e.params.data;
        $('#hjbaru').val(data.hrg_jual); // Pastikan ada input dengan ID ini
    });

    $('#suppbekas').select2({
        language: 'id',
        ajax: {
            url: base_url + 'PenjualanInput/loadsupp',
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
            url: base_url + 'PenjualanInput/loadbrg',
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
                        text: item.id_brg+' | '+item.nama_brg+ ' '+item.warna 
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
            url: base_url + 'PenjualanInput/loadsupp',
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
            url: base_url + 'PenjualanInput/loadacc',
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
                        text: item.id_brg+' | '+item.nama_brg+ ' '+item.warna 
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
        var hj = $("#hjbaru").val();
        var diskon = $("#diskon").val();
        var jumlah = $("#jumlah").val();
        var ket = $("#keterangan").val();
        var genhj = parseFloat(hj.replace(/\D/g, ''));
        var diskonbr = parseFloat(diskon.replace(/\D/g, ''));
        if (!sup || !fk || !brg ) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: "penjualan-input/simpan-barang-baru",
            data: {
                tglbaru: tgl,
                suppbaru: sup,
                nofakbaru: fk,
                prodbaru: brg,
                hjbaru: genhj,
                diskon: diskonbr,
                jumlah: jumlah,
                ket: ket,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#suppbaru").val($("#suppbaru").find('option').last().val()).trigger('change.select2');
                        $("#prodbaru").val('0').trigger('change.select2');
                        $("#hjbaru").val('');
                        $("#diskon").val('');
                        $("#keterangan").val('');
                        $("#jumlah").val(1);
                        reload();
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
            url: "penjualan-input/simpan-acc",
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