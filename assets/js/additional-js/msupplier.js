var tsupp;
$(document).ready(async function () {
    reload();
    getid();
    deletedata();
	await populateProvinces();
	$("#province").change(async function() {
        var province = $(this).val();
        $("#prov_name").val($(this).find(":selected").text());
        $("#kabupaten").empty().append("<option disabled selected>Loading...</option>");
        try {
            const cities = await getCityData(province);

            $("#kabupaten").empty();
            var defaultOption = "<option value='0' disabled selected required>Pilih Kota / Kab ...</option>";
            $("#kabupaten").append(defaultOption);

			if (cities && cities.data) {
				$.each(cities.data, function(index, item) {
					$("#kabupaten").append($("<option>", {
						value: item.code,
						text: item.name
					}));
				});	
			} else {
				$("#kabupaten").append("<option disabled>Data tidak tersedia</option>");
			}

            $('#kabupaten').select2({
                language: 'id',
            });
        } catch (error) {
            console.error(error);
            $("#kabupaten").empty().append("<option value='0' disabled selected>Error loading data</option>");
        }
    });

    $("#kabupaten").change(async function() {
        var kabupaten = $(this).val();
        $("#kab_name").val($(this).find(":selected").text());
        $("#kecamatan").empty().append("<option disabled selected>Loading...</option>");

        try {
            const subdistricts = await getSubdistrictData(kabupaten);

            $("#kecamatan").empty();
            var defaultOption = "<option value='0' disabled selected required>Pilih Kecamatan...</option>";
            $("#kecamatan").append(defaultOption);

			if (subdistricts && subdistricts.data) {
				$.each(subdistricts.data, function(index, item) {
					$("#kecamatan").append($("<option>", {
						value: item.code,
						text: item.name
					}));
				});	
			} else {
				$("#kecamatan").append("<option disabled>Data tidak tersedia</option>");
			}

            $('#kecamatan').select2({
                language: 'id',
            });
        } catch (error) {
            console.error(error);
            $("#kecamatan").empty().append("<option value='0' disabled selected>Error loading data</option>");
        }
    });

    $("#kecamatan").change(function() {
        $("#kec_name").val($(this).find(":selected").text());
    });
});

function reload() {
    if ($.fn.DataTable.isDataTable('#table-supplier')) {
      tsupp.destroy();
    }
    tsupp = $("#table-supplier").DataTable({
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
            "url": base_url+'master-supplier/jsonsup',
            "type": "POST"
        },
        "columns": [
            { "data": "id_supplier"},
            { "data": "nama_supplier"},
            { "data": "pic"},
            { "data": "kontak"},
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
              "data": "id_supplier",
              "orderable": false, // Disable sorting for this column
              "render": function(data, type, full, meta) {
                if (type === "display") {
                  if (data) {
                    return `
                      <ul class="action">
                        <li class="edit">
                          <button class="btn" id="edit-btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#EditMasterSupplierModal"><i class="icon-pencil"></i></button>
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
async function getProvinces() {
    const response = await $.ajax({
        url: base_url + "ApiWilayah/provinsi_json/",
        dataType: "json",
    });

    return response;
}
async function getCityData(province) {
    const response = await $.ajax({
        url: base_url + "ApiWilayah/kota_json/" + province,
        dataType: "json",
    });

    return response;
}

async function getSubdistrictData(kabupaten) {
    const response = await $.ajax({
        url: base_url + "ApiWilayah/kecamatan_json/" + kabupaten,
        dataType: "json",
    });

    return response;
}
async function populateProvinces() {
    $("#province").empty();

    const loadingOption = "<option disabled selected>Loading...</option>";
    $("#province").append(loadingOption);

    try {
        const provinces = await getProvinces();

        $("#province").empty();
        const defaultOption = "<option value='0' disabled selected>Pilih Provinsi ...</option>";
        $("#province").append(defaultOption);

        if (provinces && provinces.data) {
            $.each(provinces.data, function(index, item) {
                $("#province").append($("<option>", {
                    value: item.code,
                    text: item.name
                }));
            });
        } else {
            $("#province").append("<option disabled>Data tidak tersedia</option>");
        }

        $('#province').select2({
            language: 'id',
            placeholder: 'Pilih Provinsi ...'
        });

    } catch (error) {
        console.error("Error fetching provinces:", error);
        $("#province").empty().append("<option value='0' disabled selected>Error loading data</option>");
    }
}

function getid(){
  $('#EditMasterSupplierModal').on('show.bs.modal', function (e) {
      $('#estatus').select2({
          dropdownParent: $("#EditMasterSupplierModal"),
          language: 'id',
      });  
      var button = $(e.relatedTarget);
      var id_sup = button.data('id');
      
      $.ajax({
          url: base_url + "master-supplier/edit/"+id_sup,
          dataType: "json",
          success: function(data) {
              $.each(data.get_id, function(index, item) {
                  $("#eid").val(item.id_supplier);
                  $("#enama").val(item.nama_supplier);
                  $("#epic").val(item.pic);
                  $("#ekontak").val(item.kontak);
                  $("#eprov").val(item.provinsi);
                  $("#ekot").val(item.kabupaten);
                  $("#ekec").val(item.kecamatan);
                  $("#ealamat").val(item.alamat);
                  $("#estatus").val(item.status).trigger('change');
              });
          }
      });
      updatedata();
  });
}
function updatedata(){
  $("#update").on("click", function (){
      var id = $("#eid").val();
      var nama = $("#enama").val();
      var pic = $("#epic").val();
      var kontak = $("#ekontak").val();
      var prov = $("#eprov").val();
      var kota = $("#ekot").val();
      var kec = $("#ekec").val();
      var alamat = $("#ealamat").val();
      var status = $("#estatus").val();
      if (!nama || !prov || !kota || !kec || !pic || !alamat || !kontak) {
          swal("Error", "Lengkapi form yang kosong", "error");
          return;
      }
      $.ajax({
          type: "POST",
          url: "master-supplier/update-data",
          data: {
              eid: id,
              epic: pic,
              ekontak: kontak,
              enama: nama,
              eprov: prov,
              ekot: kota,
              ekec: kec,
              ealamat: alamat,
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
function deletedata() {
  $('#table-supplier').on('click', '#delete-btn', function (e) {
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
                  url: base_url + 'master-supplier/hapus/' + id,
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
