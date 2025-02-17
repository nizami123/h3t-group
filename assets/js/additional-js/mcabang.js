var tcab;
function tablemrk() {
    if ($.fn.DataTable.isDataTable('#table-barang')) {
        table.destroy();
    }
    table = $("#table-barang").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'master-barang/loadbrg/',
            "type": "POST"
        },
        "columns": [
            { "data": "id_brg" },
            { "data": "merk" },
            { "data": "jenis" },
            { "data": "nama_brg" },
            {
                "data": "id_brg",
                "orderable": false, // Disable sorting for this column
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (data) {
                            return `
                                <ul class="action">
                                    <li class="edit">
                                        <button class="btn" id="edit-btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#EditBarang"><i class="icon-pencil"></i></button>
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
$(document).ready(function () {
    reload();
    getSelect();
    getid();
    deletedata();
});

function reload() {
    if ($.fn.DataTable.isDataTable('#table-cabang')) {
        tcab.destroy();
    }
    tcab = $("#table-cabang").DataTable({
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
            "url": base_url+'master-cabang/jsoncab',
            "type": "POST"
        },
        "columns": [
            { "data": "id_toko"},
            { "data": "nama_lengkap"},
            { "data": "nama_toko"},
            { "data": "provinsi" },
            { "data": "kabupaten" },
            { "data": "kecamatan" },
            { "data": "alamat" },
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
              "data": "id_toko",
              "orderable": false, // Disable sorting for this column
              "render": function(data, type, full, meta) {
                if (type === "display") {
                  if (data) {
                    return `
                      <ul class="action">
                        <li class="edit">
                            <button class="btn" id="edit-btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#EditMasterCabangModal"><i class="icon-pencil"></i></button>
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

function getSelect() {
    $('#FormKepalaCabang').select2({
        // dropdownParent: $("#EditBarang"),
        language: 'id',
        ajax: {
            url: base_url + 'MasterCabang/loadkar',
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
                            id: item.id_user,
                            text: item.id_user+'|'+item.nama_lengkap,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#jenis').select2({
        language: 'id',
    });
}

function getid(){
    $('#EditMasterCabangModal').on('show.bs.modal', function (e) {
        $('#ejenis').select2({
            dropdownParent: $("#EditMasterCabangModal"),
            language: 'id',
        });
        $('#estatus').select2({
            dropdownParent: $("#EditMasterCabangModal"),
            language: 'id',
        });
        $('#ekacab').select2({
            dropdownParent: $("#EditMasterCabangModal"),
            language: 'id',
            ajax: {
                url: base_url + 'MasterCabang/loadkar',
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
                                id: item.id_user,
                                text: item.id_user+'|'+item.nama_lengkap,
                            };
                        }),
                    };
                },
                cache: false,
            },
        });        
        var button = $(e.relatedTarget);
        var id_cab = button.data('id');
        
        $.ajax({
            url: base_url + "master-cabang/edit/"+id_cab,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    $("#eid").val(item.id_toko);
                    $("#ecab").val(item.nama_toko);
                    $("#eprov").val(item.provinsi);
                    $("#ekot").val(item.kabupaten);
                    $("#ekec").val(item.kecamatan);
                    $("#ekode").val(item.kode_pos);
                    $("#ealamat").val(item.alamat);
                    $("#ejenis").val(item.jenis_toko).trigger('change');
                    $("#ekacab").empty().append('<option value="' + item.id_user + '">' +item.id_user+'|'+ item.nama_lengkap + '</option>').trigger('change.select2');
                    $("#estatus").val(item.status).trigger('change');
                });
            }
        });
        updatedata();
    });
}
function deletedata() {
    $('#table-cabang').on('click', '#delete-btn', function (e) {
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
                    url: base_url + 'master-cabang/hapus/' + id,
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
}
function updatedata(){
    $("#update").on("click", function (){
        var id = $("#eid").val();
        var cab = $("#ecab").val();
        var prov = $("#eprov").val();
        var kota = $("#ekot").val();
        var kec = $("#ekec").val();
        var kode = $("#ekode").val();
        var alamat = $("#ealamat").val();
        var kacab = $("#ekacab").val();
        var jenis = $("#ejenis").val();
        var status = $("#estatus").val();
        if (!cab || !prov || !kota || !kec || !kode || !alamat) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        }
        $.ajax({
            type: "POST",
            url: "master-cabang/update-data",
            data: {
                eid: id,
                ekacab: kacab,
                ecab: cab,
                eprov: prov,
                ekot: kota,
                ekec: kec,
                ekode: kode,
                ealamat: alamat,
                ejenis: jenis,
                estatus: status,
            },
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