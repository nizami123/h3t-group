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
                $(".sales").addClass("active");
                $(".seta").addClass("active");
                $(".sidebar-list.sales").addClass('active');
                $(".sidebar-list.sales .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.sales ul.sidebar-submenu").slideDown('normal');
            }else if (segment1 == "data-kustomer"){
                $(".sales").addClass("active");
                $(".scst").addClass("active");
                $(".sidebar-list.sales").addClass('active');
                $(".sidebar-list.sales .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.sales ul.sidebar-submenu").slideDown('normal');
            }else if(segment1 == "riwayat-penjualan"){
                $(".sales").addClass("active");
                $(".shst").addClass("active");
                $(".sidebar-list.sales").addClass('active');
                $(".sidebar-list.sales .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.sales ul.sidebar-submenu").slideDown('normal');
            }else if(segment1 == "produk-list"){
                $(".sales").addClass("active");
                $(".sprd").addClass("active");
                $(".sidebar-list.sales").addClass('active');
                $(".sidebar-list.sales .sidebar-title").find('.according-menu i').removeClass('fa-angle-right').addClass('fa-angle-down');
                $(".sidebar-list.sales ul.sidebar-submenu").slideDown('normal');
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
            }
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
        });
    </script>    
  </body>
</html>        