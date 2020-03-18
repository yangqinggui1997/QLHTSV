@include('layouts.header')
<!-- Left Menu -->
<div class="col-md-3 left_col" id="div__id__left_menu">
  <div class="scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{ url('/') }}" class="site_title"><i class="glyphicon glyphicon-education"></i> <span>HTQLHTSV!</span></a>
    </div>
    <div class="clearfix"></div>
    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="{{(isset($nd) ? ($nd->canBoGiangVienNguoiDung ? ($nd->canBoGiangVienNguoiDung->canBoGiangVien ? ($nd->canBoGiangVienNguoiDung->canBoGiangVien->anh ? (file_exists('resources/images/avatars/anhcanbo/'.$nd->canBoGiangVienNguoiDung->canBoGiangVien->anh) ? 'resources/images/avatars/anhcanbo/'.$nd->canBoGiangVienNguoiDung->canBoGiangVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : ($nd->sinhVienNguoiDung ? ($nd->sinhVienNguoiDung->sinhVien ? ($nd->sinhVienNguoiDung->sinhVien->anh ? (file_exists('resources/images/avatars/anhsinhvien/'.$nd->sinhVienNguoiDung->sinhVien->anh) ? 'resources/images/avatars/anhsinhvien/'.$nd->sinhVienNguoiDung->sinhVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png')) : 'resources/images/avatars/user.png')}}" alt="Ảnh người dùng" class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Xin chào,</span>
        <h2>{{(isset($nd) ? ($nd->canBoGiangVienNguoiDung ? ($nd->canBoGiangVienNguoiDung->canBoGiangVien ? $nd->canBoGiangVienNguoiDung->canBoGiangVien->hoTen : "User name") : ($nd->sinhVienNguoiDung ? ($nd->sinhVienNguoiDung->sinhVien ? $nd->sinhVienNguoiDung->sinhVien->hoTen : "User name") : "User name")) : "User name")}}</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <br/>
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	    @yield('menu')
  	</div>
    <!-- /sidebar menu -->
    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Cài đặt" class="a__class__caiDat">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Toàn màn hình" id="a__id__toanManHinh">
        <span id="span__id__toanManHinh" class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lên đầu trang" id="a__id__lenDauTrang">
        <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Khoá menu" id="a__id__khoaMenu">
        <span id="span__id__khoaMenu" class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Đăng xuất" href="{{ url('dang_xuat') }}" id="a__id__dangXuat">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
<!-- top navigation -->
<div class="top_nav" style="height: 58px; background: #F7F7F7;">
  <div class="nav_menu" style="margin-bottom: 0">
    <nav id="nav__id__nav_menu">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:void(0);" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{(isset($nd) ? ($nd->canBoGiangVienNguoiDung ? ($nd->canBoGiangVienNguoiDung->canBoGiangVien ? ($nd->canBoGiangVienNguoiDung->canBoGiangVien->anh ? (file_exists('resources/images/avatars/anhcanbo/'.$nd->canBoGiangVienNguoiDung->canBoGiangVien->anh) ? 'resources/images/avatars/anhcanbo/'.$nd->canBoGiangVienNguoiDung->canBoGiangVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : ($nd->sinhVienNguoiDung ? ($nd->sinhVienNguoiDung->sinhVien ? ($nd->sinhVienNguoiDung->sinhVien->anh ? (file_exists('resources/images/avatars/anhsinhvien/'.$nd->sinhVienNguoiDung->sinhVien->anh) ? 'resources/images/avatars/anhsinhvien/'.$nd->sinhVienNguoiDung->sinhVien->anh : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png') : 'resources/images/avatars/user.png')) : 'resources/images/avatars/user.png')}}" alt="Ảnh người dùng">&nbsp; {{(isset($nd) ? ($nd->canBoGiangVienNguoiDung ? ($nd->canBoGiangVienNguoiDung->canBoGiangVien ? $nd->canBoGiangVienNguoiDung->canBoGiangVien->hoTen : "User name") : ($nd->sinhVienNguoiDung ? ($nd->sinhVienNguoiDung->sinhVien ? $nd->sinhVienNguoiDung->sinhVien->hoTen : "User name") : "User name")) : "User name")}} &nbsp;<span class="fa fa-angle-double-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a target="_blank" href="@yield('taiKhoan')">Tài khoản</a></li>
            <li>
              <a href="javascript:void(0);">
                <span class="badge bg-red pull-right">50%</span>
                <span>Cài đặt</span>
              </a>
            </li>
            <li><a href="javascript:void(0);">Trợ giúp</a></li>
            <li><a href="{{ url('dang_xuat') }}"><i class="fa fa-sign-out pull-right"></i>Đăng xuất</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->
<!-- page content -->
<!-- <div style="
    height: 68px;
    background: #F7F7F7;
"></div> -->
<div class="right_col" role="main" id="div__id__right_col">
  @yield('content')
</div>
<!-- /page content -->
@include('layouts.footer')