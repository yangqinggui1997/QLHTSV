@extends('layouts.index')
@section('taiKhoan'){{'admin/tai_khoan_ca_nhan'}}@endsection
@section('menu')
<div class="menu_section">
	<ul class="nav side-menu">
	  <li>
	  	<a data-a-menu="he_thong"><i class="fa fa-cogs"></i>Hệ thống<span class="fa fa-chevron-down"></span></a>
	    <ul class="nav child_menu">
	      <li><a target="_blank" href="{{url('admin/quan_ly_nguoi_dung')}}">Quản lý người dùng</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_tin_nhan_nguoi_dung')}}">Quản lý tin nhắn</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_thong_bao_nguoi_dung')}}">Quản lý thông báo</a></li>
	    </ul>
	  </li>
	  <li><a data-a-menu="hanh_chinh"><i class="fa fa-university"></i>Hành chính<span class="fa fa-chevron-down"></span></a>
	    <ul class="nav child_menu">
	      <li><a target="_blank" href="{{url('admin/quan_ly_khoa_vs_bo_mon')}}">Quản lý khoa - bộ môn</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_can_bo__giang_vien')}}">Quản lý cán bộ, giảng viên</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_van_ban_bieu_mau')}}">Quản lý văn bản - biểu mẫu</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_hoc_phan')}}">Quản lý học phần</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_dang_ky_hoc_phan')}}">Quản lý đăng ký học phần</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_chuong_trinh_dao_tao')}}">Quản lý chương trình đào tạo</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_lop_vs_sinh_vien')}}">Quản lý lớp - sinh viên</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_tieu_chi_danh_gia_truong')}}">Quản lý tiêu chí đánh giá trường</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_tieu_chi_danh_gia_giang_day')}}">Quản lý tiêu chí đánh giá giảng dạy</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_tieu_chi_danh_gia_diem_ren_luyen')}}">Quản lý tiêu chí đánh giá điểm rèn luyện</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_thong_tin_dia_phuong')}}">Quản lý thông tin địa phương</a></li>
	      <li><a target="_blank" href="{{url('admin/quan_ly_phieu_danh_gia_truong')}}">Quản lý phiếu đánh giá trường</a></li>
	    </ul>
	  </li>
	  <li>
	  	<a data-a-menu="ca_nhan"><i class="fa fa-user"></i>Cá nhân<span class="fa fa-chevron-down"></span></a>
	    <ul class="nav child_menu">
	      <li><a target="_blank" href="{{url('admin/tin_nhan')}}">Tin nhắn</a></li>
	      <li><a target="_blank" href="{{url('admin/thong_bao')}}">Thông báo</a></li>
	      <li><a target="_blank" href="{{url('admin/van_ban_vs_bieu_mau')}}">Văn bản - biểu mẫu</a></li>
	    </ul>
	  </li>
	</ul>
</div>
@endsection