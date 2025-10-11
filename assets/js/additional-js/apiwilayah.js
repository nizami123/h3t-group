$(document).ready(async function () {
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