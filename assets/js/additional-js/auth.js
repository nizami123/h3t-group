$(document).ready(function() {
    login();
    show_hide();
    register();
});

function show_hide() {
    $("#sh").click(function() {
        var passwordField = $("#password");
        var icon = $(this);

        if (passwordField.attr("type") === "password") {
            passwordField.attr("type", "text");
            icon.text("Hide");
        } else {
            passwordField.attr("type", "password");
            icon.text("Show");
        }
    });    
}
function login() {
    $('.theme-form').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        $('#spinner').removeClass('d-none');
        $('#signin').addClass('d-none');
        $('#btnlogin').prop('disabled', true);

        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            type: 'POST',
            url: base_url+'/cek-auth', // Replace with the URL of your PHP script
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.success) {
                    // Redirect to home page or do any other actions upon successful login
                    if (response.message === 'Login berhasil kepala cabang') {
                        window.location.href = base_url + 'cabang/' + response.id_toko;
                        localStorage.setItem('cabangNama', response.nama_toko);
                    } else {
                        window.location.href = base_url;
                    }
                } else {
                    // Show error message
                    // $('#loginMessage').text(response.message);
                    swal("Warning", response.message, "warning").then(() => {
                        // ('#email').val('');
                        // ('#password').val('');
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors to console
            },
            complete: function() {
                $('#spinner').addClass('d-none');
                $('#signin').removeClass('d-none');
                $('#btnlogin').prop('disabled', false);
            }
        });
    });
}

function register() {
    $('#RegistOwn').on('show.bs.modal', function (e) {
        $('#nl').val('');
        $('#em').val('');
        $('#pass').val('');
        $("#rsh").click(function() {
            var passwordField = $("#pass");
            var icon = $(this);
    
            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                icon.text("Hide");
            } else {
                passwordField.attr("type", "password");
                icon.text("Show");
            }
        });
    });
    $("#addregist").on("click", function () {
        var nl = $("#nl").val();
        var em = $("#em").val();
        var pass = $("#pass").val();
        if (!nl || !em || !pass) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: base_url+"registrasi",
            data: {
                nl: nl,
                em: em,
                pass: pass
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Berhasil terdaftar", "success").then(() => {
                        location.reload();
                    });
                } else if(response.status === 'exists') {
                    swal("Error", "Owner sudah ada", "error").then(() => {
                        // $("#prodbaru").val($("#prodbaru").find('option').last().val()).trigger('change.select2');
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
