<?php
error_reporting(0);
session_start();
$menu = '';
if (isset($_GET['menu'])) {
  $menu = $_GET['menu'];
}

if (
  !isset($_SESSION['apriori_id']) &&
  ($menu != 'tentang' & $menu != 'not_found' & $menu != 'forbidden')
) {
  header("location:login.php");
}
include_once 'fungsi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Market Basket Analysis</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
  <link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
  <link rel="stylesheet" href="assets/css/daterangepicker.min.css" />
  <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />
  <link rel="stylesheet" href="assets/css/bootstrap-colorpicker.min.css" />

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mart Baiturrahman</div>
      </a>

      <?php
      $menu_active = '';
      if (isset($_GET['menu'])) {
        $menu_active = $_GET['menu'];
      }
      ?>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php echo ($menu_active == '') ? "active" : ""; ?>">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-mosque"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      
      <li class="nav-item <?php
                          echo ($menu_active == 'data_transaksi') ? "active" : "";
                          echo ($menu_active == 'edit_transaksi') ? "active" : "";
                          ?>">
        <a class="nav-link" href="index.php?menu=data_transaksi">
          <i class="fas fa-fw fa-book"></i>
          <span>Data Transaksi</span></a>
      </li>

      <li class="nav-item <?php echo ($menu_active == 'proses_apriori') ? "active" : ""; ?>">
        <a class="nav-link" href="index.php?menu=proses_apriori">
          <i class="fas fa-fw fa-hourglass-start"></i>
          <span>Proses Apriori</span></a>
      </li>

      <li class="nav-item <?php echo ($menu_active == 'proses_cmar') ? "active" : ""; ?>">
        <a class="nav-link" href="index.php?menu=proses_cmar">
          <i class="fas fa-fw fa-hourglass-end"></i>
          <span>Proses CMAR</span></a>
      </li>


      <li class="nav-item <?php
                          echo ($menu_active == 'hasil') ? "active" : "";
                          echo ($menu_active == 'view_rule') ? "active" : "";

                          ?>">
        <a class="nav-link" href="index.php?menu=hasil">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Data Hasil</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  Admin
                </span>
                <img class="img-profile rounded-circle" src="assets/img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <div class="container-fluid">


          <?php
          $menu = ''; //variable untuk menampung menu
          if (isset($_GET['menu'])) {
            $menu = $_GET['menu'];
          }

          if ($menu != '') {
            if (can_access_menu($menu)) {
              if (file_exists($menu . ".php")) {
                include $menu . '.php';
              } else {
                include "not_found.php";
              }
            } else {
              include "forbidden.php";
            }
          } else {
            include "home.php";
          }
          ?>

        </div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
              <div class="modal-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i>Cancel</button>
                <a class="btn btn-success" href="logout.php"><i class="fas fa-fw fa-check mr-1"></i>Logout</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="assets/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="assets/js/demo/chart-area-demo.js"></script>
        <script src="assets/js/demo/chart-pie-demo.js"></script>

        <!-- Page level plugins -->
        <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="assets/js/demo/datatables-demo.js"></script>

        <script src="assets/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/bootstrap-timepicker.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets/js/bootstrap-colorpicker.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/daterangepicker.min.js"></script>
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
          jQuery(function($) {
            //datepicker plugin
            //link
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
              })
              //show datepicker when clicking on the icon
              .next().on(ace.click_event, function() {
                $(this).prev().focus();
              });

            //or change it into a date range picker
            $('.input-daterange').datepicker({
              autoclose: true
            });


            //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
            $('input[name=range_tanggal]').daterangepicker(

                {
                  'applyClass': 'btn-sm btn-success',
                  'cancelClass': 'btn-sm btn-default',
                  locale: {
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                    format: 'DD/MM/YYYY',
                  }
                })
              .prev().on(ace.click_event, function() {
                $(this).next().focus();
              });

            $('#id-input-file-1 , #id-input-file-2').ace_file_input({
              no_file: 'No File ...',
              btn_choose: 'Choose',
              btn_change: 'Change',
              droppable: false,
              onchange: null,
              thumbnail: false //| true | large
              //whitelist:'gif|png|jpg|jpeg'
              //blacklist:'exe|php'
              //onchange:''
              //
            });

            //tapi terkadang muncul kesalahan pada event handler pengubahan ukuran normal
            $.resize.throttleWindow = false;

            //
            $(document).one('ajaxloadstart.page', function(e) {
              $tooltip.remove();
            });
          });
        </script>

</body>

</html>