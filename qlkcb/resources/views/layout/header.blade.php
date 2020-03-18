<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache"); ?>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <!-- provide the csrf token -->
    <meta name="_token" content="{{ csrf_token() }}" />

    <!-- Title Page-->
    <title>@yield('title')</title>
    <!-- Fontfaces CSS-->
    <base href="{{asset('')}}">
    <link rel="shortcut icon" href="public/images/icon/favicon.png">
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
    @yield('css')
    <!-- Main CSS-->
    <link href="public/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">