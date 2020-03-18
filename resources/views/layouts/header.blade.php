<!DOCTYPE html>
<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache"); ?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Hệ thống quản lý học tập sinh viên - Trường Đại học An Giang">
    <meta name="keywords" content="QLHTSV">
    <meta name="author" content="Yang Qing Gui">
    <meta name="_token" id="_token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <base href="{{ asset('') }}">
    <link rel="shortcut icon" href="resources/images/_favicon.ico" type="image/ico" media="all"/>
    <link href="resources/bootstraps/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Font Awesome -->
    <link href="resources/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- NProgress -->
    <link href="resources/bootstraps/nprogress/nprogress.css" rel="stylesheet" media="all">
    <!-- jQuery custom content scroller -->
    <link href="resources/bootstraps/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet" media="all"/>
    <!-- ALertify JS -->
    <!-- CSS -->
    <link rel="stylesheet" href="resources/bootstraps/alertifyjs/css/alertify.min.css" media="all"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="resources/bootstraps/alertifyjs/css/themes/default.min.css" media="all"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="resources/bootstraps/alertifyjs/css/themes/semantic.min.css" media="all"/>

    @yield('css')
    <!-- Custom Theme Style -->
    <link href="resources/css/custom.min.css" rel="stylesheet" media="all">
  </head>

  <body class="nav-md">
    <div class="container body">
        <div class="main_container">