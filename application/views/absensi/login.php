<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This Project Made by Akira Digital Creative with CLIENT ID AWS005">
    <meta name="keywords" content="akira.id adalah softwarehouse terkemuka di dalam dunia digital yang fokus memberikan solusi bagi pelaku bisnis untuk transisi dalam dunia digital">
    <meta name="author" content="akira.id">
    <link rel="icon" href="<?=base_url()?>assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.png" type="image/x-icon">
    <title>H3T - GROUPS | Akira System</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/feather-icon.css">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?=base_url()?>assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/responsive.css">
    <?=$css;?>
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7 order-1"><img class="bg-img-cover bg-center" src="<?=base_url()?>assets/images/login/1.jpg" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card login-dark">
            <div>
              <div><a class="logo text-start" href="<?=base_url()?>"><img class="img-fluid for-light" src="<?=base_url()?>assets/images/logo/logo.png" alt="looginpage"><img class="img-fluid for-dark" src="<?=base_url()?>assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
              <div class="login-main"> 
                <form class="theme-form">
                  <h4>Selamat Datang!</h4>
                  <p>Masukkan email & password and untuk login</p>
                  <div class="form-group">
                    <label class="col-form-label">Email</label>
                    <input class="form-control" type="email" name="email" id="email" required="" placeholder="input email">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" id="password" required="" placeholder="*********">
                      <div class="show-hide" id="sh"><span class="show"></span></div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox">
                      <label class="text-muted" for="checkbox1">Remember password</label>
                    </div>
                    <a class="link" target="_blank" href="https://api.whatsapp.com/send/?phone=6281399669066&text=Hai+*AKIRA2%DEV*%2C+Kami+dari+DH+COMP+lupa+password+masuk.">Forgot password?</a>
                    <div class="text-end mt-3">
                        <button class="btn btn-primary btn-block w-100" type="submit" id="btnlogin">
                            <span id="spinner" class="spinner-border spinner-border-sm text-light d-none" role="status" aria-hidden="true"></span>
                            <span id="signin">Sign in</span>
                        </button>
                    </div>
                    <?php if ($own > 0) { ?>
                      <div class="text-end mt-3 d-none">
                        <button class="btn btn-primary btn-block w-100" data-bs-toggle="modal" data-bs-target="#RegistOwn" type="button" id="btnregist">Register</button>
                      </div>
                    <?php }else{ ?>
                      <div class="text-end mt-3">
                        <button class="btn btn-primary btn-block w-100" data-bs-toggle="modal" data-bs-target="#RegistOwn" type="button" id="btnregist">Register</button>
                      </div>
                    <?php } ?>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="RegistOwn" tabindex="-1" role="dialog" aria-labelledby="RegistOwn" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content dark-sign-up">
                <div class="modal-body social-profile text-start" style="max-height: 95vh; overflow-y: auto;">
                    <div class="modal-toggle-wrapper">
                        <div class="modal-header mb-4">
                            <h5>Register Owner</h5>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="row g-3">
                          <!-- Nama Lengkap -->
                          <div class="col-md-12 position-relative">
                              <label class="form-label" for="FormNamaLengkap">Nama Lengkap</label>
                              <input class="form-control" id="nl" name="nl" type="text" placeholder="Masukkan Nama Lengkap">
                              <div class="valid-tooltip">Looks good!</div>
                          </div>
                          <!-- Email -->
                          <div class="col-md-12 position-relative">
                              <label class="form-label" for="FormEmail">Email</label>
                              <input class="form-control" id="em" name="em" type="email" placeholder="Masukkan Email">
                              <div class="valid-tooltip">Looks good!</div>
                          </div>
                          <!-- Password -->
                          <div class="col-md-12 position-relative">
                            <div class="form-group">
                                <label class="form-label" for="FormPassword">Password</label>
                                <div class="form-input">
                                  <input class="form-control" id="pass" name="pass" type="password" placeholder="Masukkan Password">
                                  <div class="show-hide" id="rsh"><span class="show"></span></div>
                                </div>
                                <div class="valid-tooltip">Looks good!</div>
                            </div>
                          </div>
                          <!-- Button Simpan -->
                          <div class="col-12">
                              <button class="btn btn-primary" type="button" id="addregist" data-bs-dismiss="modal">Tambahkan</button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>      
      <!-- latest jquery-->
      <script src="<?=base_url()?>assets/js/jquery-3.6.0.min.js"></script>
      <!-- Bootstrap js-->
      <script src="<?=base_url()?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="<?=base_url()?>assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="<?=base_url()?>assets/js/icons/feather-icon/feather-icon.js"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="<?=base_url()?>assets/js/config.js"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="<?=base_url()?>assets/js/script.js"></script>
      <?=$js;?>
    </div>
  </body>
</html>