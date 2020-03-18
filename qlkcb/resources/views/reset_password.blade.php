<!DOCTYPE html>
<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache"); ?>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Yang Gui">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Khôi phục mật khẩu</title>
    <base href="{{ asset('') }}">
    <link rel="shortcut icon" href="public/images/icon/favicon.png">
    <!-- Fontfaces CSS-->
    <link href="public/css/font-face.css" rel="stylesheet" media="all">
    <link href="public/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="public/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="public/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="public/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="public/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="public/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="public/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="public/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5" style="overflow-x: auto;">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#" class="none_href">
                                <img src="public/images/logo.jpg" alt="Logo BVĐKTT An Giang">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="reset_password" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Email nhận mật khẩu khôi phục</label>
                                    <input class="au-input au-input--full" type="email" name="email" >
                                </div>
                                @if(session('success'))
                                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                        <span class="badge badge-pill badge-success">Success!</span>
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @elseif(session('error'))
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error!</span>
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif
                                <button class="au-btn au-btn--block au-btn--darkgreen m-b-10 m-t-25 font-bolder" type="submit">Gửi</button>
                                <a class="au-btn au-btn--block au-btn--darkyellow m-b-10 m-t-25 font-bolder text-center" href="{{ url('') }}">VỀ TRANG ĐĂNG NHẬP</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="public/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="public/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="public/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="public/vendor/slick/slick.min.js">
    </script>
    <script src="public/vendor/wow/wow.min.js"></script>
    <script src="public/vendor/animsition/animsition.min.js"></script>
    <script src="public/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="public/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="public/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="public/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="public/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="public/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="public/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="public/js/main.js"></script>

</body>

</html>
<!-- end document-->