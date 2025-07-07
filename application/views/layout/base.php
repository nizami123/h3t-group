<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This Project Made by Akira Digital Creative with CLIENT ID AWS005">
    <meta name="keywords" content="akira.id adalah softwarehouse terkemuka di dalam dunia digital yang fokus memberikan solusi bagi pelaku bisnis untuk transisi dalam dunia digital">
    <meta name="author" content="akira.id">
    <link rel="icon" href="<?=base_url()?>assets/images/logo/logo-icon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo/logo-icon.png" type="image/x-icon">
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
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/animate.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?=base_url()?>assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/responsive.css">
    <?php echo $css; ?>
    <?php 
      $jab= $this->session->userdata('jabatan'); 
      $idtoko = $this->session->userdata('id_toko'); 
      $nmtoko = $this->session->userdata('nama_toko'); 
    ?>
  </head>
  <body> 
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"> <span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper modern-type" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <!-- Logo -->
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
              <a href="<?=base_url()?>">
                <img class="img-fluid" src="<?=base_url()?>assets/images/logo/logo.png" alt="logohope" loading="lazy">
              </a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <!-- End Logo -->
          <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div class="notification-slider">
              <div class="d-flex h-100"> <img src="<?=base_url()?>assets/images/giftools.gif" alt="gif">
                <h6 class="mb-0 f-w-400"><span class="font-primary">Hey, Founder! </span> <span class="f-light"> Welcome to Akira Creative System.</span></h6><i class="icon-arrow-top-right f-light"></i>
              </div>
              <div class="d-flex h-100"><img src="<?=base_url()?>assets/images/giftools.gif" alt="gif">
                <h6 class="mb-0 f-w-400"><span class="f-light">Regrats from me </span></h6><a class="ms-1" href="https://www.akira.id/" target="_blank">AKIRA Official !</a>
              </div>
            </div>
          </div>
          <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
              <!-- Dark Mode -->
              <li>
                <div class="mode">
                  <svg>
                    <use href="<?=base_url()?>assets/svg/icon-sprite.svg#moon"></use>
                  </svg>
                </div>
              </li>
              <!-- Notifikasi -->
              <div class="btn-group">
                <button class="btn dropdown-toggle d-flex align-items-center rounded-pill px-0 py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="rounded-circle me-2" src="<?=base_url()?>assets/images/dashboard/profile.png" alt="Profile Picture" loading="lazy" width="40" height="40">
                    <div class="text-start">
                        <span class="d-block fw-bold"><?php echo $this->session->userdata('nama_lengkap'); ?></span>
                        <small class="text-muted"><?php echo $this->session->userdata('jabatan'); ?></small>
                    </div>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?=base_url()?>logout/"><i data-feather="log-in"></i> Keluar</a></li>
                </ul>
              </div>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" sidebar-layout="stroke-svg">
          <div>
            <div class="logo-wrapper">
                <a href="<?=base_url()?>">
                    <img class="img-fluid for-light" src="<?=base_url()?>assets/images/logo/logo.png" alt="logodeha">
                    <img class="img-fluid for-dark" src="<?=base_url()?>assets/images/logo/logo_dark.png" alt="logodeha">
                </a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
              <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
            </div>
            <div class="logo-icon-wrapper">
                <a href="<?=base_url()?>">
                    <img class="img-fluid" src="<?=base_url()?>assets/images/logo/logo-icon.png" alt="">
                </a>
            </div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="<?=base_url()?>"><img class="img-fluid" src="<?=base_url()?>assets/images/logo/logo-icon.png" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="pin-title sidebar-main-title">
                    <div> 
                      <h6>Pinned</h6>
                    </div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-1">General</h6>
                    </div>
                  </li>
                  <!-- Menu Dashboard General -->
                  <li class="sidebar-list dash"><i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title dash" href="#">
                    <svg class="stroke-icon">
                      <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-home"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-home"></use>
                    </svg><span>Home</span></a>
                    <ul class="sidebar-submenu">
                      <?php if ($jab=='OWNER' || $jab=='Finance' || $jab=='ADMIN BARANG') { ?>
                        <li class="scab"><a class="scab" href="<?=base_url()?>">Semua Cabang</a></li>
                        <?php foreach ($setcabang as $sc) { ?>
                          <li class="<?=$sc['id_toko']?>" data-cabangnama="<?=$sc['nama_toko']?>"><a class="<?=$sc['id_toko']?>" href="<?=base_url()?>cabang/<?=$sc['id_toko']?>"><?=$sc['nama_toko']?></a></li>
                        <?php } ?>
                      <?php } else if($jab=='KEPALA CABANG') { ?>
                        <?php foreach ($barangcabang as $bc) { ?>
                          <li class="<?=$bc['id_toko']?>" data-cabangnama="<?=$bc['nama_toko']?>"><a class="<?=$bc['id_toko']?>" href="<?=base_url()?>cabang/<?=$bc['id_toko']?>"><?=$bc['nama_toko']?></a></li>
                        <?php } ?>
                      <?php } ?>
                    </ul>
                  </li>
                  <!-- Menu Master Menu -->
                  <li class="sidebar-list master"><i class="fa fa-thumb-tack"></i>
                      <a class="sidebar-link sidebar-title master" href="#">
                      <svg class="stroke-icon">
                        <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-animation"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-animation"></use>
                      </svg><span>Data Master</span></a>
                      <ul class="sidebar-submenu">
                        <li class="mcab"><a class="mcab" href="<?=base_url()?>master-cabang">Master Cabang</a></li>
                        <li class="mdis"><a class="mdis" href="<?=base_url()?>master-diskon">Master Diskon</a></li>
                        <li class="msup"><a class="msup" href="<?=base_url()?>master-supplier">Master Supplier</a></li>
                        <?php if ($jab=='OWNER') { ?>
                        <li class="mkar"><a class="mkar" href="<?=base_url()?>master-karyawan">Master Karyawan</a></li>
                        <?php } ?>
                        <li class="mkus"><a class="mkus" href="<?=base_url()?>master-kustomer">Master Kustomer</a></li>
                        <li class="mkat"><a class="mkat" href="<?=base_url()?>master-kategori">Master Kategori</a></li>
                        <li class="mbrg"><a class="mbrg" href="<?=base_url()?>master-barang">Master Barang</a></li>
                        <li class="mbnk"><a class="mbnk" href="<?=base_url()?>master-bank">Master Bank</a></li>
                      </ul>
                  </li>            
                  <!-- Menu Aplikasi-->
                  <li class="sidebar-main-title">
                    <div>
                        <h6 class="lan-8">Applications</h6>
                    </div>
                  </li>
                  <!-- Menu Order Masuk -->
                  <?php if ($jab=='OWNER' || $jab=='PIC' || $jab=='ADMIN BARANG') { ?>
                  <li class="sidebar-list order">
                      <i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav order" href="<?=base_url()?>order-masuk/">
                      <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-social"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-social"></use>
                      </svg><span>Order Masuk</span></a>
                  </li>
                  <!-- <li class="sidebar-list order">
                      <i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav order" href="<?=base_url()?>order-masuk/">
                      <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-table"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-table"></use>
                      </svg><span>Retur Barang</span></a>
                  </li> -->
                  <?php } ?>       
                  <!-- Finnance -->
                  <!-- <li class="sidebar-list finance"><i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title" href="#">
                        <svg class="stroke-icon">
                        <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-table"></use>
                        </svg>
                        <svg class="fill-icon">
                        <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-table"></use>
                        </svg><span>Akuntansi</span>
                    </a>
                    <ul class="sidebar-submenu">
                      <li><a href="boardneraca.html">Board Neraca</a></li>
                      <li><a class="submenu-title" href="#">Karyawan<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                          <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="datadendakaryawan.html">Data Denda</a></li>
                              <li><a href="dataliburcutikaryawan.html">Data Cuti & Libur</a></li>
                              <li><a href="datainsentive.html">Data Insentive</a></li>
                              <li><a href="pembayarangpi.html">Pembayaran GPI</a></li>
                          </ul>
                      </li>
                      <li><a class="submenu-title" href="#">Neraca Besar<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                          <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="">Neraca Perusahaan</a></li>
                              <li><a href="">Kas Modal</a></li>
                              <li><a href="">Kas Masuk</a></li>
                              <li><a href="">Kas Keluar</a></li>
                              <li><a href="">Operasional</a></li>
                          </ul>
                      </li>
                      <li><a class="submenu-title" href="#">Neraca Kecil<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                          <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="neracatoko.html">Neraca Toko</a></li>
                              <li><a href="datatradein.html">Data Trade In</a></li>
                              <li><a href="datapenjualan.html">Data Penjualan</a></li>
                              <li><a href="dpcustomer.html">DP Customer</a></li>
                              <li><a href="kasmodalkecil.html">Kas Modal</a></li>
                              <li><a href="kasmasuk.html">Kas Masuk</a></li>
                              <li><a href="kaskeluar.html">Kas Keluar</a></li>
                              <li><a href="operasional.html">Operasional</a></li>
                              <li><a href="laporantransaksi.html">Laporan Transaksi</a></li>
                          </ul>
                      </li>
                      <li><a class="submenu-title fnc" href="#">Suppliers<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                          <ul class="nav-sub-childmenu submenu-content">
                            <li class="dps"><a class="dps" href="<?=base_url()?>finance-supplier/dp-supplier">DP Supplier</a></li>
                            <li class="cbs"><a class="cbs" href="<?=base_url()?>finance-supplier/cashback-supplier">Casback Supplier</a></li>
                            <li class="pbs"><a class="pbs" href="pembayaransupplier.html">Pembayaran Supplier</a></li>
                            <li class="trs"><a class="trs" href="suppliertransaksi.html">Riwayat Transaksi</a></li>
                          </ul>
                      </li>
                    </ul>
                  </li> -->
                  <!-- Menu Karyawan -->
                  <!-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title" href="#">
                        <svg class="stroke-icon">
                        <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-user"></use>
                        </svg>
                        <svg class="fill-icon">
                        <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-user"></use>
                        </svg><span>Karyawan</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="/karyawan/index.html">Perfoma Karyawan</a></li>
                        <li><a href="/karyawan/datakaryawan.html">Data Karyawan</a></li>
                        <li><a href="/karyawan/presensikaryawan.html">Presensi Karyawan</a></li>
                    </ul>
                  </li> -->
                  <!-- Menu Inventori -->
                  <li class="sidebar-list inven"><i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title inven" href="#">
                        <svg class="stroke-icon">
                        <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-job-search"></use>
                        </svg>
                        <svg class="fill-icon">
                        <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-job-search"></use>
                        </svg><span>Inventori Stok</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <!-- <li class="idaf"><a class="idaf" href="<?=base_url()?>daftar-inventori">Daftar Inventori</a></li> -->
                        <?php if ($jab=='OWNER' || $jab=='Finance' || $jab=='ADMIN BARANG' || $jab=='PIC') { ?> 
                        <li class="ibm"><a class="ibm" href="<?=base_url()?>barang-masuk">Barang Gudang</a></li>
                        <li class="ibk"><a class="ibk" href="<?=base_url()?>barang-keluar">Barang Cabang</a></li>
                        <?php } ?>
                        <?php if ($jab=='OWNER' || $jab=='KEPALA CABANG' || $jab=='PIC' || $jab=='ADMIN BARANG') { ?>
                        <li class="iskb"><a class="iskb" href="<?=base_url()?>terima-barang">Terima Barang Cabang</a></li>
                        <li class="ipb"><a class="ipb" href="<?=base_url()?>pindah-barang">Pindah Barang Cabang</a></li>
                        <li class="iso"><a class="iso" href="<?=base_url()?>stock-opname">Stok Opname Cabang</a></li>
                        <?php } ?>
                    </ul>
                  </li>
                  <li class="sidebar-list servis">
                      <i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav servis" href="<?=base_url()?>servis/">
                      <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-icons"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-icons"></use>
                      </svg><span>Servis</span></a>
                  </li>
                  <!-- Transaksi -->
                  <li class="sidebar-list trans"><i class="fa fa-thumb-tack"></i>
                      <a class="sidebar-link sidebar-title trans" href="#">
                          <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-task"></use>
                          </svg>
                          <svg class="fill-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-task"></use>
                          </svg><span>Transaksi</span>
                      </a>
                      <ul class="sidebar-submenu">
                          <li class="tdk"><a class="tdk" href="<?=base_url()?>data-kustomer/">Data Kustomer</a></li>
                          <li class="tpl"><a class="tpl" href="<?=base_url()?>produk-list/">Produk List</a></li>
                          <li class="teta"><a class="teta" href="<?=base_url()?>etalase-toko/">Etalase Toko</a></li>
                          <li class="tsh"><a class="tsh" href="<?=base_url()?>riwayat-penjualan/">Riwayat Penjualan</a></li>
                      </ul>
                  </li>
                  <!-- Purchasing -->
                  <li class="sidebar-list purchase"><i class="fa fa-thumb-tack"></i>
                      <a class="sidebar-link sidebar-title purchase" href="#">
                          <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-widget"></use>
                          </svg>
                          <svg class="fill-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-widget"></use>
                          </svg><span>Purchasing</span>
                      </a>
                      <ul class="sidebar-submenu">
                          <li class="scst"><a class="scst" href="<?=base_url()?>pembelian/">Pembelian</a></li>
                          <li class="shst"><a class="shst" href="<?=base_url()?>pelunasan/">Pelunasan</a></li>
                          <li class="sprd"><a class="sprd" href="<?=base_url()?>penerimaan/">Penerimaan</a></li>
                          <li class="spck"><a class="spck" href="<?=base_url()?>pengecekan/">Pengecekan</a></li>
                      </ul>
                  </li>
                  <!-- End Menu Toko -->
                    <li class="sidebar-list sales"><i class="fa fa-thumb-tack"></i>
                      <a class="sidebar-link sidebar-title sales" href="#">
                         <svg class="stroke-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#stroke-ecommerce"></use>
                          </svg>
                          <svg class="fill-icon">
                          <use href="<?=base_url()?>assets/svg/icon-sprite.svg#fill-ecommerce"></use>
                          </svg><span>Penjualan</span>
                      </a>
                      <ul class="sidebar-submenu">
                          <li class="seta"><a class="seta" href="<?=base_url()?>penjualan/">Penjualan</a></li>
                          <li class="spmb"><a class="spmb" href="<?=base_url()?>pembayaran/">Pembayaran</a></li>
                      </ul>
                  </li>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>

        <?=$content;?>

        <?=$modal;?>

        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright <span class="copyright-year"></span> © touch by AKIRA DIGITAL CREATIVE | akira.id</p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="<?=base_url()?>assets/js/jquery-3.6.0.min.js"></script>
    <?php echo $js; ?>
    <!-- latest jquery-->
    <!-- Bootstrap js-->
    <script src="<?=base_url()?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="<?=base_url()?>assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?=base_url()?>assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="<?=base_url()?>assets/js/scrollbar/simplebar.js"></script>
    <script src="<?=base_url()?>assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="<?=base_url()?>assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="<?=base_url()?>assets/js/sidebar-menu.js"></script>
    <script src="<?=base_url()?>assets/js/sidebar-pin.js"></script>
    <script src="<?=base_url()?>assets/js/slick/slick.min.js"></script>
    <script src="<?=base_url()?>assets/js/slick/slick.js"></script>
    <script src="<?=base_url()?>assets/js/header-slick.js"></script>
    <script src="<?=base_url()?>assets/js/height-equal.js"></script>
    <!-- etc -->
    <script src="<?=base_url()?>assets/js/script.js"></script>
    <script>
        $(document).ready(function () {
            var currentYear = new Date().getFullYear();
            var segment1 = "<?php echo $this->uri->segment(1); ?>";
            var segment2 = "<?php echo $this->uri->segment(2); ?>";
            $(".copyright-year").text(currentYear);

            $('.sidebar-submenu').on('click', 'li', function(event) {
                event.preventDefault(); // Prevent the default action if necessary
                var cabangNama = $(this).data('cabangnama');
                localStorage.setItem('cabangNama', cabangNama); // Save to localStorage
                window.location.href = $(this).find('a').attr('href');
            });

            $(".dash").removeClass("active");
                
            if (segment1 == "") {
                $(".dash").addClass("active");
                $(".scab").addClass("active");
                $(".sidebar-list.dash").addClass('active');
                $(".sidebar-list.dash .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.dash ul.sidebar-submenu").slideDown('normal');
            }else if (segment1=="cabang" && segment2=="H3T-0001"){
                $(".dash").addClass("active");
                $(".H3T-0001").addClass("active");
                $(".sidebar-list.dash").addClass('active');
                $(".sidebar-list.dash .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.dash ul.sidebar-submenu").slideDown('normal');
            }else if (segment1=="cabang" && segment2=="H3T-0002"){
                $(".dash").addClass("active");
                $(".H3T-0002").addClass("active");
                $(".sidebar-list.dash").addClass('active');
                $(".sidebar-list.dash .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.dash ul.sidebar-submenu").slideDown('normal');
            }else if (segment1 == "master-cabang"){
                $(".master").addClass("active");
                $(".mcab").addClass("active");
                $(".sidebar-list.master").addClass('active');
                $(".sidebar-list.master .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.master ul.sidebar-submenu").slideDown('normal');                                  
            }else if (segment1 == "master-diskon"){
                $(".master").addClass("active");
                $(".mdis").addClass("active");
                $(".sidebar-list.master").addClass('active');
                $(".sidebar-list.master .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.master ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "master-supplier"){
                $(".master").addClass("active");
                $(".msup").addClass("active");
                $(".sidebar-list.master").addClass('active');
                $(".sidebar-list.master .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.master ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "master-karyawan"){
                $(".master").addClass("active");
                $(".mkar").addClass("active");
                $(".sidebar-list.master").addClass('active');
                $(".sidebar-list.master .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.master ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "master-kustomer"){
                $(".master").addClass("active");
                $(".mkus").addClass("active");
                $(".sidebar-list.master").addClass('active');
                $(".sidebar-list.master .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.master ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "master-kategori"){
                $(".master").addClass("active");
                $(".mkat").addClass("active");
                $(".sidebar-list.master").addClass('active');
                $(".sidebar-list.master .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.master ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "master-barang"){
                $(".master").addClass("active");
                $(".mbrg").addClass("active");
                $(".sidebar-list.master").addClass('active');
                $(".sidebar-list.master .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.master ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "master-bank"){
                $(".master").addClass("active");
                $(".mbnk").addClass("active");
                $(".sidebar-list.master").addClass('active');
                $(".sidebar-list.master .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.master ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "terima-barang"){
                $(".inven").addClass("active");
                $(".iskb").addClass("active");
                $(".sidebar-list.inven").addClass('active');
                $(".sidebar-list.inven .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.inven ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "pindah-barang"){
                $(".inven").addClass("active");
                $(".ipb").addClass("active");
                $(".sidebar-list.inven").addClass('active');
                $(".sidebar-list.inven .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.inven ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "stock-opname"){
                $(".inven").addClass("active");
                $(".iso").addClass("active");
                $(".sidebar-list.inven").addClass('active');
                $(".sidebar-list.inven .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.inven ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "barang-masuk"){
                $(".inven").addClass("active");
                $(".ibm").addClass("active");
                $(".sidebar-list.inven").addClass('active');
                $(".sidebar-list.inven .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.inven ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "barang-keluar"){
                $(".inven").addClass("active");
                $(".ibk").addClass("active");
                $(".sidebar-list.inven").addClass('active');
                $(".sidebar-list.inven .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.inven ul.sidebar-submenu").slideDown('normal');   
            }else if (segment1 == "etalase-toko"){
                $(".trans").addClass("active");
                $(".teta").addClass("active");
                $(".sidebar-list.trans").addClass('active');
                $(".sidebar-list.trans .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.trans ul.sidebar-submenu").slideDown('normal');
            }else if (segment1 == "data-kustomer"){
                $(".trans").addClass("active");
                $(".tdk").addClass("active");
                $(".sidebar-list.trans").addClass('active');
                $(".sidebar-list.trans .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.trans ul.sidebar-submenu").slideDown('normal');
            }else if(segment1 == "riwayat-penjualan"){
                $(".trans").addClass("active");
                $(".tsh").addClass("active");
                $(".sidebar-list.trans").addClass('active');
                $(".sidebar-list.trans .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.trans ul.sidebar-submenu").slideDown('normal');
            }else if(segment1 == "produk-list"){
                $(".trans").addClass("active");
                $(".tpl").addClass("active");
                $(".sidebar-list.trans").addClass('active');
                $(".sidebar-list.trans .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.trans ul.sidebar-submenu").slideDown('normal');
            }else if (segment1 == "order-masuk"){
                $(".order").addClass("active");
            }else if (segment1 == "finance-supplier" && segment2 == "dp-supplier"){
                $(".finance").addClass("active");
                $(".dps").addClass("active");
                $(".sidebar-list.finance").addClass('active');
                $(".sidebar-list.finance .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.finance ul.sidebar-submenu").slideDown('normal');
                $(".submenu-title.fnc").addClass('active'); 
                $(".submenu-title.fnc").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".submenu-title.fnc + .submenu-content").slideDown('normal');
            }else if (segment1 == "finance-supplier" && segment2 == "cashback-supplier"){
                $(".finance").addClass("active");
                $(".cbs").addClass("active");
                $(".sidebar-list.finance").addClass('active');
                $(".sidebar-list.finance .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.finance ul.sidebar-submenu").slideDown('normal');
                $(".submenu-title.fnc").addClass('active'); 
                $(".submenu-title.fnc").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".submenu-title.fnc + .submenu-content").slideDown('normal');
            }else if (segment1 == "servis"){
                $(".servis").addClass("active");
            }else if (segment1 == "pembelian"){
                $(".purchase").addClass("active");
                $(".scst").addClass("active");
                $(".sidebar-list.purchase").addClass('active');
                $(".sidebar-list.purchase .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.purchase ul.sidebar-submenu").slideDown('normal');
            }else if (segment1 == "pelunasan"){
                $(".purchase").addClass("active");
                $(".shst").addClass("active");
                $(".sidebar-list.purchase").addClass('active');
                $(".sidebar-list.purchase .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.purchase ul.sidebar-submenu").slideDown('normal');
            }else if (segment1 == "penerimaan"){
                $(".purchase").addClass("active");
                $(".sprd").addClass("active");
                $(".sidebar-list.purchase").addClass('active');
                $(".sidebar-list.purchase .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.purchase ul.sidebar-submenu").slideDown('normal');
            }else if (segment1 == "pengecekan"){
                $(".purchase").addClass("active");
                $(".spck").addClass("active");
                $(".sidebar-list.purchase").addClass('active');
                $(".sidebar-list.purchase .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.purchase ul.sidebar-submenu").slideDown('normal');
            }else if (segment1 == "penjualan"){
                $(".sales").addClass("active");
                $(".seta").addClass("active");
                $(".sidebar-list.sales").addClass('active');
                $(".sidebar-list.sales .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.sales ul.sidebar-submenu").slideDown('normal');
            }else if (segment1 == "pembayaran"){
                $(".sales").addClass("active");
                $(".spmb").addClass("active");
                $(".sidebar-list.sales").addClass('active');
                $(".sidebar-list.sales .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.sales ul.sidebar-submenu").slideDown('normal');
            }
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
        });
    </script>    
  </body>
</html>        
