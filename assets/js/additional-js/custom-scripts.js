function formatRupiah(angka) {
    var number_string = angka.value.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    angka.value = rupiah;
}

function kuotaDiskon(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}

function formatPhoneNumber(input) {
    let phoneNumber = input.value.replace(/\D/g, '');

    if (phoneNumber.startsWith('0')) {
        phoneNumber = phoneNumber.substring(1);
    } else if (phoneNumber.startsWith('62')) {
        phoneNumber = phoneNumber.substring(2);
    }
    input.value = '+62' + phoneNumber;
}