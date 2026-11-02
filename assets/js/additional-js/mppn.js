$(document).ready(function() {
    let tablePpn;

    loadPpnTable();

    function loadPpnTable() {
        if ($.fn.DataTable.isDataTable('#table-ppn')) {
            $('#table-ppn').DataTable().destroy();
        }

        tablePpn = $('#table-ppn').DataTable({
            "processing": true,
            "ajax": {
                "url": base_url + 'master-ppn/loadppn',
                "type": "GET"
            },
            "columns": [
                { "data": "no", "className": "text-center", "orderable": false },
                { "data": "nama", "orderable": false },
                { "data": "nilai", "className": "text-center", "orderable": false },
                {
                    "data": "id",
                    "className": "text-center",
                    "orderable": false,
                    "render": function(data) {
                        return `
                            <button class="btn btn-primary btn-sm btn-edit" data-id="${data}"><i class="icofont icofont-pencil"></i> Edit</button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="${data}"><i class="icofont icofont-trash"></i> Hapus</button>
                        `;
                    }
                }
            ],
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'col-sm-12 col-md-2'B>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
                   "buttons": [
                    {
                        "text": 'Refresh <i class="fa fa-refresh"></i>', // Font Awesome icon for refresh
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
                            tablePpn.ajax.reload();
                        }
                    }
            ]
        });
    }

    function resetForm() {
        $('#ppn_id').val('');
        $('#nama').val('');
        $('#nilai').val('');
        $('#tambah').text('Tambah PPN');
        $('#batal').hide();
    }

    $('#batal').click(function() {
        resetForm();
    });

    $('#tambah').click(function(e) {
        e.preventDefault();

        var id = $('#ppn_id').val();
        var nama = $('#nama').val();
        var nilai = $('#nilai').val();

        if (!nama || nilai === '') {
            swal("Warning", "Nama dan Nilai harus diisi!", "warning");
            return;
        }

        if (nilai < 0 || nilai > 100) {
            swal("Warning", "Nilai PPN harus antara 0 sampai 100!", "warning");
            return;
        }

        var url = id ? base_url + 'master-ppn/update-data' : base_url + 'master-ppn/simpan-data';
        var formData = {
            id: id,
            nama: nama,
            nilai: nilai
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    swal("Success", response.message, "success").then(() => {
                        resetForm();
                        loadPpnTable();
                    });
                } else {
                    swal("Gagal", response.message, "error");
                }
            },
            error: function() {
                swal("Error", "Terjadi kesalahan pada server.", "error");
            }
        });
    });

    $('#table-ppn').on('click', '.btn-edit', function() {
        var id = $(this).data('id');

        $.ajax({
            url: base_url + 'master-ppn/edit/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    var data = response.data;
                    $('#ppn_id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#nilai').val(data.nilai);
                    $('#tambah').text('Update PPN');
                    $('#batal').show();
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                } else {
                    swal("Gagal", response.message, "error");
                }
            },
            error: function() {
                swal("Error", "Terjadi kesalahan pada server.", "error");
            }
        });
    });

    $('#table-ppn').on('click', '.btn-delete', function() {
        var id = $(this).data('id');

        swal({
            title: "Apakah Anda yakin?",
            text: "Data PPN yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: ["Batal", "Ya, Hapus!"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: base_url + 'master-ppn/hapus/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            swal("Terhapus!", response.message, "success");
                            loadPpnTable();
                        } else {
                            swal("Gagal", response.message, "error");
                        }
                    },
                    error: function() {
                        swal("Error", "Terjadi kesalahan pada server.", "error");
                    }
                });
            }
        });
    });
});
