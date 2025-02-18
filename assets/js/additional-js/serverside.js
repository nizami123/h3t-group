var tkar;
$(document).ready(function() {
    reload();
    getid();
    rolejab();
    addroljab();
    deletedata();
});

function rolejab() {
    $('#jabatan').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterKaryawan/loadjab',
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
                            id: item.nama_jab,
                            text: item.nama_jab,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#role').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterKaryawan/loadrole',
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
                            id: item.nama_role,
                            text: item.nama_role,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
}
function addroljab(){
    $("#tambahjab").on("click", function () {
        var jabatan = $("#jabkar").val();

        if (!jabatan) {
            swal("Error", "Form masih kosong", "error").then(() => {
                $("#jabkar").focus();
            });
            return;
        }
        $.ajax({
            type: "POST",
            url: "MasterKaryawan/createjabatan",
            data: {
                namajab: jabatan
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Berhasil ditambahkan", {
                        icon: "success",
                    });
                    $("#jabkar").val('');
                    $('#TambahJabatanBaru').modal('hide');
                } else if (response.status === 'exists') {
                    swal("Warning", "Nama sudah ada", "warning").then(() => {
                        $("#jabkar").val('');
                        $("#jabkar").focus();
                    });
                    return;
                }
            },
            error: function (error) {
                swal("Gagal ", {
                    icon: "error",
                });
            }
        });
    });
    $("#tambahrole").on("click", function () {
        var role = $("#rolekar").val();

        if (!role) {
            swal("Error", "Form masih kosong", "error").then(() => {
                $("#rolekar").focus();
            });
            return;
        }
        $.ajax({
            type: "POST",
            url: "MasterKaryawan/createrole",
            data: {
                namarole: role
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Berhasil ditambahkan", {
                        icon: "success",
                    });
                    $("#rolekar").val('');
                    $('#TambahRoleBaru').modal('hide');
                } else if (response.status === 'exists') {
                    swal("Warning", "Nama sudah ada", "warning").then(() => {
                        $("#rolekar").val('');
                        $("#rolekar").focus();
                    });
                    return;
                }
            },
            error: function (error) {
                swal("Gagal ", {
                    icon: "error",
                });
            }
        });
    });
}
function getid() {
    $('#EditMasterKaryawan').on('show.bs.modal', function (event) {
        $('#e_jabatan').select2({
            // dropdownParent: $("#EditMasterKaryawan"),
            language: 'id',
            ajax: {
                url: base_url + 'MasterKaryawan/loadjab',
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
                                id: item.nama_jab,
                                text: item.nama_jab,
                            };
                        }),
                    };
                },
                cache: false,
            },
        });
        $('#e_role').select2({
            // dropdownParent: $("#EditMasterKaryawan"),
            language: 'id',
            ajax: {
                url: base_url + 'MasterKaryawan/loadrole',
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
                                id: item.nama_role,
                                text: item.nama_role,
                            };
                        }),
                    };
                },
                cache: false,
            },
        });
        var button = $(event.relatedTarget);
        var id_user = button.data('id');

        $.ajax({
            url: base_url + "master-karyawan/edit/"+id_user,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    $("#e_id").val(item.id_user);
                    $("#e_nl").val(item.nama_lengkap);
                    $("#e_tl").val(item.tanggal_lahir);
                    $("#e_jk").val(item.jen_kel);
                    $("#e_email").val(item.email);
                    $("#e_password").val(item.password);
                    $("#ex_prov").val(item.provinsi);
                    $("#ex_kab").val(item.kabupaten);
                    $("#ex_kec").val(item.kecamatan);
                    $("#e_kode").val(item.kode_pos);
                    $("#e_alamat").val(item.alamat);
                    $("#e_wa").val(item.no_wa);
                    $("#oldfile").val(item.file_cv);
                    $("#filecv_filename").attr("href", base_url+"assets/dhdokumen/karyawan/" + item.file_cv);
                    $("#filecv").text(item.file_cv);
                    $("#e_jabatan").empty().append('<option value="' + item.jabatan + '">' +item.jabatan+ '</option>').trigger('change.select2');
                    $("#e_role").empty().append('<option value="' + item.role_user + '">' +item.role_user+ '</option>').trigger('change.select2');
                    $("#e_gaji").val(item.gaji);
                    formatRupiah(document.getElementById("e_gaji"));
                    $("#e_status").val(item.status);
                });
            }
        });
        updatedata();
    });
}
function updatedata() {
    $("#update").on("click", function () {
        var id = $("#e_id").val();
        var nama = $("#e_nl").val();
        var tgl = $("#e_tl").val();
        var jk = $("#e_jk").val();
        var email = $("#e_email").val();
        var password = $("#e_password").val();
        var prov = $("#ex_prov").val();
        var kab = $("#ex_kab").val();
        var kec = $("#ex_kec").val();
        var kode = $("#e_kode").val();
        var alamat = $("#e_alamat").val();
        var wa = $("#e_wa").val();
        var jabatan = $("#e_jabatan").val();
        var role = $("#e_role").val();
        var gaji = parseFloat($("#e_gaji").val().replace(/\D/g, ''));
        var status = $("#e_status").val();
        var fileInput = $('#e_filecv')[0].files[0];
        var oldfile = $("#oldfile").val();
        var formData = new FormData();
        formData.append('eid', id);
        formData.append('enama', nama);
        formData.append('etgl', tgl);
        formData.append('ejk', jk);
        formData.append('email', email);
        formData.append('epassword', password);
        formData.append('eprov', prov);
        formData.append('ekot', kab);
        formData.append('ekec', kec);
        formData.append('ekode', kode);
        formData.append('ealamat', alamat);
        formData.append('ewa', wa);
        formData.append('ejabatan', jabatan);
        formData.append('erole', role);
        formData.append('egaji', gaji);
        formData.append('estatus', status);

        if (fileInput) {
            formData.append('e_filecv', fileInput); // Add new file to FormData
        } else {
            // If no file is selected, add old file name to FormData
            formData.append('efile', oldfile);
        }

        $.ajax({
            type: "POST",
            url: "master-karyawan/update-data",
            data: formData,
            contentType: false,
            processData: false, // Prevent jQuery from processing the data
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    swal("Data berhasil diupdate", {
                        icon: "success",
                    }).then((value) => {
                        reload();
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
function deletedata() {
    $('#table-karyawan').on('click', '#delete-btn', function (e) {
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
                    url: base_url + 'master-karyawan/hapus/' + id,
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        if (response.result && response.result.success) {
                            swal('Deleted!', response.result.message, 'success');
                            reload();
                        } else {
                            swal('Error!', 'Tidak bisa menghapus data karyawan ini', 'error');
                        }
                    },
                });
            }
        });        
    });
}
function reload() {
    var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0 // Set the number of decimal places to 0 for whole numbers
    });
    if ($.fn.DataTable.isDataTable('#table-karyawan')) {
        tkar.destroy();
    }
    tkar = $("#table-karyawan").DataTable({
        "processing": true,
        "language": { 
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
            // "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',            
        },
        "serverSide": true,
        "order": [
            [0, 'asc']
        ],
        "ajax": {
            "url": base_url+'master-karyawan/jsonkar',
            "type": "POST"
        },
        "columns": [
            { "data": "id_user"},
            { "data": "nama_lengkap"},
            { "data": "jabatan"},
            { "data": "role_user" },
            // { 
            //     "data": "gaji",
            //     "render": function (data, type, row) {
            //         return formatter.format(data);
            //     }
            // },
            { 
                "data": "file_cv",
                "render": function (data, type, row) {
                    if (type === 'display' && data !== null && data !== "") {
                        // Assuming 'data' is the filename (e.g., 'sample.pdf')
                        var pdfLink = '<a class="pdf" href="' + base_url + 'assets/dhdokumen/karyawan/' + data + '" target="_blank">' +
                            '<i class="icofont icofont-file-pdf">'+ data +'</i>' +
                            '</a>';
                        return pdfLink;
                    } else {
                        return data;
                    }
                }
            },
            { "data": "no_wa" },
            { "data": "email" },
            { "data": "password" },
            {
              "data": "status",
              "render": function (data, type, full, meta) {
                  // You can customize the rendering here
                  if (type === "display") {
                      if (data === "1") {
                          return `<span class="badge rounded-pill badge-success">Aktif</span>`;
                        } else {
                          return `<span class="badge rounded-pill badge-secondary">Non Aktif</span>`;
                      }
                      return data; // return the original value for other cases
                  }
                  return data;
              }
            },
            { 
              "data": "id_user",
              "orderable": false, // Disable sorting for this column
              "render": function(data, type, full, meta) {
                if (type === "display") {
                  if (data) {
                    return `
                        <ul class="action">
                            <li class="edit">
                                <button class="btn" id="edit-btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#EditMasterKaryawan"><i class="icon-pencil"></i></button>
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
