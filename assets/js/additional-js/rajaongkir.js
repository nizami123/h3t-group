$(document).ready(async function() {
    $('#province').select2({
        language: 'id',
    });
    $('#kabupaten').select2({
        language: 'id',
    });
    $('#kecamatan').select2({
        language: 'id',
    });

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

            $.each(cities, function(index, item) {
                $("#kabupaten").append($("<option>", {
                    value: item.city_id,
                    text: item.city_name
                }));
            });

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

            $.each(subdistricts, function(index, item) {
                $("#kecamatan").append($("<option>", {
                    value: item.subdistrict_id,
                    text: item.subdistrict_name
                }));
            });

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
        url: base_url + "RajaOngkir/getProvince",
        dataType: "json",
    });

    return response;
}

async function populateProvinces() {
    $("#province").empty();

    var loadingOption = "<option disabled selected>Loading...</option>";
    $("#province").append(loadingOption);

    try {
        const provinces = await getProvinces();

        $("#province").empty();
        var defaultOption = "<option value='0' disabled selected>Pilih Provinsi ...</option>";
        $("#province").append(defaultOption);

        $.each(provinces, function(index, item) {
            $("#province").append($("<option>", {
                value: item.province_id,
                text: item.province
            }));
        });

        $('#province').select2({
            language: 'id',
        });
    } catch (error) {
        console.error("Error fetching provinces:", error);
        $("#province").empty().append("<option value='0' disabled selected>Error loading data</option>");
    }
}

async function getCityData(province) {
    const response = await $.ajax({
        url: base_url + "RajaOngkir/getCity/" + province,
        dataType: "json",
    });

    return response;
}

async function getSubdistrictData(kabupaten) {
    const response = await $.ajax({
        url: base_url + "RajaOngkir/getKecamatan/" + kabupaten,
        dataType: "json",
    });

    return response;
}
