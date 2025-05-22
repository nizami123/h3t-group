var tdis;
var formatter;
var formatcur;
$(document).ready(function () {
    formatter = new Intl.NumberFormat('id-ID', {
        style: 'decimal',
        minimumFractionDigits: 0
    });
    formatcur = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    });
    reload();
    initSweetAlert();
    getid();
    deletedata();
});

function reload() {
    if ($.fn.DataTable.isDataTable('#table-diskon')) {
        tdis.destroy();
    }
    tdis = $("#table-diskon").DataTable({
        "processing": true,
        "language": { 
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
            // "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',            
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url+'master-diskon/jsondis',
            "type": "POST"
        },
        "columns": [
            { "data": "kode_diskon"},
            { 
                "data": "nilai",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "kuota"},
            { 
                "data": "total_diskon",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { 
              "data": "kode_diskon",
              "orderable": false, // Disable sorting for this column
              "render": function(data, type, full, meta) {
                if (type === "display") {
                  if (data) {
                    return `
                      <ul class="action">
                        <li class="edit">
                            <button class="btn" id="edit-btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#EditMasterDiskonModal"><i class="icon-pencil"></i></button>
                        </li>
                        <li class="delete">
                            <button class="btn" id="delete-btn" type="button" data-id="${data}"><i class="icon-trash"></i></button>
                        </li>
                      </ul>
                    `;
                  }
                }
                return data;
              }
            }
          ],                        
    });    
}

function initSweetAlert() {
    $(".tambahdiskon").on("click", function () {
        var nilaiDiskon = $("#FormBuatKuotaDiskon").val();
        var kuotaDiskon = $("#kuota").val();
        var kode = $("#kode").val();
        var selectedValues = $("#tipe").val();
        var numbdiscount = parseFloat(nilaiDiskon.replace(/\D/g, ''));
        var total = numbdiscount * kuotaDiskon;


        if (!nilaiDiskon || !kuotaDiskon || !kode || !selectedValues) {
            // Display an error message or take appropriate action for missing values
            swal("Error", "Please fill out all required fields.", "error");
            return;
        }
        $("#total").val(total);
        swal({
            title: "Apa anda yakin?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            content: {
                element: "div",
                attributes: {
                    innerHTML: "Menambahkan kode diskon <strong>" + kode + "</strong> dengan nilai Total <strong>" + formatter.format(total) + "</strong>",
                },
            },
            closeOnClickOutside: false,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "master-diskon/simpan-data", // Adjust the URL to match your CodeIgniter controller method
                    data: {
                        kode: kode,
                        tipe: selectedValues,
                        nilai: numbdiscount,
                        kuota: kuotaDiskon,
                        total: total
                    },
                    dataType: "json", // Specify the expected data type
                    success: function (response) {
                        // Handle the server response here
                        if (response.status === 'success') {
                            swal("Berhasil! Diskon Baru telah ditambahkan!", {
                                icon: "success",
                            });
                            reload(formatter);
                            $("#tipe").val('0');
                            $("#kode").val('');
                            $("#FormBuatKuotaDiskon").val('');
                            $("#kuota").val('');
                            $("#total").val('');
                        } else {
                            swal("Gagal menambahkan diskon baru", {
                                icon: "error",
                            });
                        }
                    },
                    error: function (error) {
                        // Handle the error here
                        swal("Gagal menambahkan diskon baru", {
                            icon: "error",
                        });
                    }
                });
            } else {
                swal("Anda telah membatalkan pembuatan diskon baru");
            }
        });
    });
}

function getid(){
    $('#EditMasterDiskonModal').on('show.bs.modal', function (e) {   
        var button = $(e.relatedTarget);
        var kode = button.data('id');
        
        $.ajax({
            url: base_url + "master-diskon/edit/"+kode,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    $("#etipe").val(item.tipe).trigger('change');
                    $("#ekode").val(item.kode_diskon);
                    $("#ediskon").val(formatter.format(item.nilai));
                    $("#ekuota").val(item.kuota);
                    $("#etotal").val(formatter.format(item.total_diskon));
                });
            }
        });
        $("#ediskon").on('input', function() {
            var diskon = parseFloat($("#ediskon").val().replace(/\D/g, ''));
            var kuota = parseFloat($("#ekuota").val().replace(/\D/g, '')); 
            var total = diskon * kuota;
            $("#etotal").val(formatter.format(total));
        });
        $("#ekuota").on('input', function() {
            var diskon = parseFloat($("#ediskon").val().replace(/\D/g, ''));
            var kuota = parseFloat($("#ekuota").val().replace(/\D/g, '')); 
            var total = diskon * kuota;
            $("#etotal").val(formatter.format(total));
        });
        updatedata();
    });
}

function refresh() {
    $("#table-diskon").DataTable().ajax.reload();
}

function deletedata() {
    $('#table-diskon').on('click', '#delete-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
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
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'master-diskon/hapus/' + id,
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
}
function updatedata(){
    $("#update").on("click", function (){
        var kode = $("#ekode").val();
        var tipe = $("#etipe").val();
        var disc = parseFloat($("#ediskon").val().replace(/\D/g, ''));
        var kuota = $("#ekuota").val();
        var tot = parseFloat($("#etotal").val().replace(/\D/g, ''));
        if (!disc || !kuota || !tot || !kode) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        }
        $.ajax({
            type: "POST",
            url: "master-diskon/update-data",
            data: {
                ekode: kode,
                etipe: tipe,
                ediskon: disc,
                ekuota: kuota,
                etotal: tot
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Data berhasil diupdate", {
                        icon: "success",
                    }).then((value) => {
                        reload(formatter);
                    });
                } else {
                    swal("Gagal update data", {
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