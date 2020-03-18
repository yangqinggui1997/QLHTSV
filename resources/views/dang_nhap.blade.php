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
  <title>HỆ THỐNG QUẢN LÝ HỌC TẬP SINH VIÊN! | ĐẠI HỌC AN GIANG</title>
  <base href="{{asset('')}}">
  <!-- Bootstrap -->
  <link rel="shortcut icon" href="resources/images/_favicon.ico" type="image/ico" media="all" />
  <link href="resources/bootstraps/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="all">
  <!-- Font Awesome -->
  <link href="resources/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="all">
  <!-- NProgress -->
  <link href="resources/bootstraps/nprogress/nprogress.css" rel="stylesheet" media="all">
  
  <!-- Custom Theme Style -->
  <link href="resources/css/custom.min.css" rel="stylesheet" media="all">
</head>

<body class="login">
  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form method="post">
            {{csrf_field()}}
            <h1>ĐĂNG NHẬP</h1>
            @if(isset($tenTaiKhoan) && isset($matKhau))
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="tenTaiKhoan" value="{{ $tenTaiKhoan }}" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Mật khẩu" required="" name="matKhau" autocomplete value="{{ $matKhau }}" />
              </div>
              <div>
                <div style="float: left; width: 100%; margin-bottom: 10px" id="div__id__ghiNhoDN">
                  <input style="float: left; margin-right: 7px" type="checkbox" checked="" name="ghiNhoDangNhap"><span style="float: left; line-height: 2;font-size: 13px;"> Ghi nhớ thông tin đăng nhập.</span>
                </div>
            @else
                <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="tenTaiKhoan" value="" />
              </div>
              <div>
                <input type="password" class="form-control" autocomplete placeholder="Mật khẩu" required="" name="matKhau" value="" />
              </div>
              <div>
                <div style="float: left; width: 100%; margin-bottom: 10px" id="div__id__ghiNhoDN">
                  <input style="float: left; margin-right: 7px" type="checkbox" name="ghiNhoDangNhap"><span style="float: left; line-height: 2;font-size: 13px;"> Ghi nhớ thông tin đăng nhập.</span>
                </div>
            @endif
              <button class="btn btn-success submit" id="button__id__submit">DO</button>
              <a class="reset_pass" href="javascript:void(0)">Quên mật khẩu?</a>
            </div>
            <div class="clearfix"></div>
            @if(session("loi"))
              <div class="alert alert-danger alert-dismissible fade in" role="alert" style="text-shadow: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                {{ session("loi") }}
                </div>
            @endif
            <div class="separator">
              <div class="clearfix"></div>
              <div>
                <h1 style="font-size: 19px"><i class="glyphicon glyphicon-education"></i> Hệ Thống Quản Lý Học Tập Sinh Viên!</h1>
                <p>Khoa Công Nghệ Thông Tin - Đại học An Giang.</p>
                <p>©@php $y='2019';$cury=date('Y');@endphp @if($y!==$cury){{$y.' - '.$cury.'.'}}@else{{$y.'.'}}@endif All Rights Reserved.</p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="resources/js/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="resources/bootstraps/bootstrap/dist/js/bootstrap.min.js"></script>  
  <!-- NProgress -->
  <script src="resources/bootstraps/nprogress/nprogress.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="resources/js/custom.min.js"></script>
  <script>
    $(function(){
        $('#div__id__ghiNhoDN').on('click', function(){
            if($('[name="ghiNhoDangNhap"]').prop('checked'))
                $('[name="ghiNhoDangNhap"]').prop('checked', false);
            else
                $('[name="ghiNhoDangNhap"]').prop('checked', true);
        });

        $('[name="ghiNhoDangNhap"]').on('click', function(e){
            e.stopPropagation();
        });

        $('#button__id__submit').on('mouseenter', function(){$(this).addClass('aminateZoom');});
        $('#button__id__submit').on('mouseout', function(){$(this).removeClass('aminateZoom');});
    });
  </script>
</body>
</html>
