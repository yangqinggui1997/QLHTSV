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
  <title>CẬP NHẬT TÀI KHOẢN - HỆ THỐNG QUẢN LÝ HỌC TẬP SINH VIÊN! | ĐẠI HỌC AN GIANG</title>
  <base href="{{asset('')}}>">
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
    <div class="login_wrapper" style="max-width: 480px">
      <div class="animate form login_form">
        <section class="login_content">
          <form method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <h1>THÔNG TIN TÀI KHOẢN</h1>
            <div style="text-align: center;">
		        <img src="{{(isset($nd) ? ($nd->canBoGiangVienNguoiDung ? ($nd->canBoGiangVienNguoiDung->canBoGiangVien ? ($nd->canBoGiangVienNguoiDung->canBoGiangVien->anh ? (file_exists('resources/images/avatars/anhcanbo/'.$nd->canBoGiangVienNguoiDung->canBoGiangVien->anh) ? 'resources/images/avatars/anhcanbo/'.$nd->canBoGiangVienNguoiDung->canBoGiangVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : ($nd->sinhVienNguoiDung ? ($nd->sinhVienNguoiDung->sinhVien ? ($nd->sinhVienNguoiDung->sinhVien->anh ? (file_exists('resources/images/avatars/anhsinhvien/'.$nd->sinhVienNguoiDung->sinhVien->anh) ? 'resources/images/avatars/anhsinhvien/'.$nd->sinhVienNguoiDung->sinhVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png')) : 'resources/images/avatars/user.png')}}" alt="Ảnh người dùng" class="img-circle profile_img" style="margin-left:0;width:220px;height:220px;" id="avatar" data-toggle="tooltip" data-original-title="Click để thay đổi ảnh đại diện!" crossOrigin="anonymous">
		        <input type="file" name="avatar" style="display: none;">
		    </div>
		    <div style="text-align: center; margin-top: 20px">
		    	<button class="btn btn-success submit" id="button__id__submit" formaction="{{url('admin/tai_khoan_ca_nhan')}}">Cập nhật</button>
		    </div>
            <div class="clearfix"></div>
            @if(isset($loi))
              <div class="alert alert-danger alert-dismissible fade in" role="alert" style="text-shadow: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                {{$loi}}
                </div>
            @elseif(isset($tc))
            	<div class="alert alert-success alert-dismissible fade in" role="alert" style="text-shadow: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                {{$tc}}
                </div>
            @endif
            <div class="separator" style="padding-top: 0">
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
        $('#button__id__submit').on('mouseenter', function(){$(this).addClass('aminateZoom');});
        $('#button__id__submit').on('mouseout', function(){$(this).removeClass('aminateZoom');});
        $('[name="avatar"]').on('click', function(){});
        $('#avatar').on('click', function(){$('[name="avatar"]').trigger('click')});
        $('[name="avatar"]').on('change', function(){
        	try
        	{
        		var reader = null;
        		if($(this).prop('files').length && $(this).prop('files')[0])
        		{
        			reader = new FileReader();
        			reader.onload = function(e)
        			{
        				$('#avatar').attr('src', e.target.result).width(210).height(210);
        			}
        			reader.readAsDataURL($(this).prop('files')[0]);
        		}
        		return true;
        	}
        	catch(err)
			{
				alert('Lỗi: ' + err.stack + '!');
				return false;
			}
        });
    });
  </script>
</body>
</html>
