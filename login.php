<?php
session_start(); // Memulai sesi untuk pengguna

// Jika ada sesi 'apriori_id', alihkan ke halaman index.php
if (isset($_SESSION['apriori_id'])) {
    header("location:index.php");
}

// Inisialisasi variabel login dengan nilai 0
$login = 0;

// Jika terdapat parameter 'login' pada URL, set nilai $login dengan nilai parameter tersebut
if (isset($_GET['login'])) {
    $login = $_GET['login'];
}

// Jika nilai $login adalah 1, set pesan kesalahan untuk ditampilkan
if ($login == 1) {
    $komen = "Silahkan Login Ulang, Cek username dan Password Anda!!";
}

// Mengikutkan file fungsi.php
include_once "fungsi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Market Basket Analysis</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <section>
        <div class="circle"></div>
        <header>
            <a href="img"><img src="img/Logo.png" class="logo"></a>
            <a class="navbar-brand text-success" style="font-weight: 1000;" href="index.php"> <i class="fa fa-shopping-cart"></i> Market Basket Analysis Menggunakan Algoritma Apriori dan CMAR Pada Mart Baiturrahman </a>
        </header>

        <div class="content">
            <div class="container">
                <!-- Outer Row -->
                <div class="row justify-content-center mt-5">
                    <div class="col-xl-5 col-lg-6 col-md-8 mt-5">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                            </div>
                                            <?php
                                            // Jika ada pesan kesalahan, tampilkan
                                            if (isset($komen)) {
                                                display_error("Login failed");
                                            }
                                            ?>
                                            <form class="user" action="cek-login.php" method="post">
                                                <div class="form-group">
                                                    <input autocomplete="off" name="username" type="text" class="form-control form-control-user" id="exampleInputUser" required="" placeholder="Username" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" required="" placeholder="Password" />
                                                </div>
                                                <button type="submit" class="btn btn-success btn-block btn-user"><i class="fas fa-fw fa-sign-in-alt mr-1"></i> Log In</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="imgBox">
                <img src="img/img11.png" class="market">
            </div>
        </div>
        
        <ul class="thumb">
            <li><img src="img/thumb11.png" onclick="imgSlider('img/img11.png');changeCircleColor('#017143')"></li>
            <li><img src="img/thumb22.png" onclick="imgSlider('img/img22.png');changeCircleColor('#017143')"></li>
            <li><img src="img/thumb33.png" onclick="imgSlider('img/img33.png');changeCircleColor('#017143')"></li>
            <li><img src="img/thumb44.png" onclick="imgSlider('img/img44.png');changeCircleColor('#017143')"></li>
            <li><img src="img/thumb55.png" onclick="imgSlider('img/img55.png');changeCircleColor('#017143')"></li>
        </ul>
    </section>

    <!-- Fungsi JavaScript untuk mengubah gambar dan warna latar belakang lingkaran -->
    <script type="text/javascript">
        // Fungsi untuk mengganti gambar pada slider
        function imgSlider(anything) {
            document.querySelector('.market').src = anything;
        }

        // Fungsi untuk mengganti warna latar belakang lingkaran
        function changeCircleColor(color) {
            const circle = document.querySelector('.circle');
            circle.style.background = color;
        }
    </script>

    <body class="bg-gradient-success">

        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>
    </body>
</body>

</html>