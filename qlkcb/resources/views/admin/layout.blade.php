@extends('layout.index')

@section('nav_mobile')
    <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none" >
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{url('admin')}}">
                            <img src="public/images/logo4.png" alt="Logo Bệnh Viện ĐKTT An Giang" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('admin/quan_ly_nguoi_dung') }}">
                                <i class="fas fa-male"></i>QUẢN LÝ NGƯỜI DÙNG</a>
                        </li>
                        <li class="has-sub hovergray" >
                            <a class="js-arrow none_href" href="#">
                                <i class="fas fa-smile-o"></i>MỞ RỘNG</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri') }}">KHU VỰC KHÁM VÀ ĐỀU TRỊ</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh') }}">KHU VỰC HÀNH CHÍNH</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('ke_toan') }}">KHU VỰC KẾ TOÁN</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('tiep_don') }}">KHU VỰC QUẦY TIẾP ĐÓN</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none" >
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            @if(isset($nd))
                                @if($nd->nhanVien->Anh != '')
                                    <img data-anhtk="anhtk" src="public/upload/anhnv/{{$nd->nhanVien->Anh}}" alt="Ảnh người dùng" />
                                @else
                                     <img data-anhtk="anhtk" src="public/images/icon/avatar-01.jpg" alt="Ảnh người dùng" />
                                @endif
                            @endif
                        </div>
                        <div class="content">
                            <a class="js-acc-btn none_href" href="#">@if(isset($nd)){{$nd->nhanVien->TenNV}} @else {{'Tên người dùng'}} @endif</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#" class="none_href">
                                        @if(isset($nd))
                                            @if($nd->nhanVien->Anh != '')
                                                <img data-anhtk="anhtk" src="public/upload/anhnv/{{$nd->nhanVien->Anh}}" alt="Ảnh người dùng" />
                                            @else
                                                 <img data-anhtk="anhtk" src="public/images/icon/avatar-01.jpg" alt="Ảnh người dùng" />
                                            @endif
                                        @endif
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#" class="none_href">@if(isset($nd)){{$nd->nhanVien->TenNV}} @else {{'Tên người dùng'}} @endif</a>
                                    </h5>
                                    <span class="email">@if(isset($nd)){{$nd->email}} @else {{'Mail người dùng'}} @endif</span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a target="_blank" href="{{ url('cap_nhat_tai_khoan') }}">
                                        <i class="zmdi zmdi-account"></i>Tài Khoản</a>
                                </div>
                                
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="{{ url('dangxuat') }}">
                                    <i class="zmdi zmdi-power"></i>Đăng Xuất</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->
@endsection

@section('nav_desktop')
    <!-- HEADER DESKTOP-->
            <header class="header-desktop d-none d-lg-block">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                           <div class="header__logo" >
                                <a href="{{url('admin')}}">
                                    <img src="public/images/logo4.png" alt="Logo Bệnh Viện ĐKTT An Giang" />
                                </a>
                            </div>
                            <div class="header__navbar">
                                <ul class="list-unstyled" >
                                    <li>
                                        <a target="_blank" href="{{ url('admin/quan_ly_nguoi_dung') }}">
                                            <i class="fas fa-users"></i>
                                            <span class="bot-line"></span>QUẢN LÝ NGƯỜI DÙNG</a>
                                    </li>
                                    <li class="has-sub" >
                                        <a class="none_href" href="#" >
                                            <i class="fas fa-sitemap"></i>MỞ RỘNG
                                            <span class="bot-line"></span>
                                        </a> 
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri') }}"><span class="bot-line"></span>KHU VỰC KHÁM VÀ ĐỀU TRỊ</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh') }}"><span class="bot-line"></span>KHU VỰC HÀNH CHÍNH</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('ke_toan') }}"><span class="bot-line"></span>KHU VỰC KẾ TOÁN</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('tiep_don') }}"><span class="bot-line"></span>KHU VỰC QUẦY TIẾP ĐÓN</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="header__tool">
                                <div class="account-wrap">
                                    <div class="account-item account-item--style2 clearfix js-item-menu">
                                        <div class="image" data-toggle="tooltip" @if(isset($nd)) title="{{$nd->nhanVien->TenNV}}" @else title="{{'Tên người dùng'}}" @endif>
                                            @if(isset($nd))
                                                @if($nd->nhanVien->Anh != '')
                                                    <img data-anhtk="anhtk" src="public/upload/anhnv/{{$nd->nhanVien->Anh}}" alt="Ảnh người dùng" />
                                                @else
                                                     <img data-anhtk="anhtk" src="public/images/icon/avatar-01.jpg" alt="Ảnh người dùng" />
                                                @endif
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn none_href" href="#"></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown" >
                                            <div class="info clearfix" >
                                                <div class="image">
                                                    <a href="#" class="none_href">
                                                        @if(isset($nd))
                                                            @if($nd->nhanVien->Anh != '')
                                                                <img data-anhtk="anhtk" src="public/upload/anhnv/{{$nd->nhanVien->Anh}}" alt="Ảnh người dùng" />
                                                            @else
                                                                 <img data-anhtk="anhtk" src="public/images/icon/avatar-01.jpg" alt="Ảnh người dùng" />
                                                            @endif
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#" class="none_href">@if(isset($nd)){{$nd->nhanVien->TenNV}} @else {{'Tên người dùng'}} @endif</a>
                                                    </h5>
                                                    <span class="email">@if(isset($nd)){{$nd->email}} @else {{'Mail người dùng'}} @endif</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a target="_blank" href="{{ url('cap_nhat_tai_khoan') }}">
                                                        <i class="zmdi zmdi-account"></i>Tài Khoản</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{ url('dangxuat') }}">
                                                    <i class="zmdi zmdi-power"></i>Đăng Xuất</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->
@endsection

@section('danhmucfooter')
                    <div class="col-md-4">
                        <div class="footer-logo"><a hhref="{{ url('admin')}}"><img src="public/images/logo3.png" alt=""></a></div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <h4 class="title" style="color: #0b6542;">THÔNG TIN LIÊN HỆ</h4>
                        <p>60 Ung Văn Khiêm - P.Mỹ Phước - Tp.Long Xuyên - An Giang </p>
                        <p>Di động: (0296).3852989 – 3852862</p>
                        <p>Email: benhviendkttangiang@angiang.gov.vn</p>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h4 class="title" style="color: #0b6542;">CÁC DANH MỤC CHÍNH</h4>
                        <ul class="support">
                           <li><a target="_blank" href="{{ url('admin/quan_ly_nguoi_dung') }}">Quản lý người dùng</a></li>
                           <li><a target="_blank" href="{{ url('admin/quan_ly_truy_cap') }}">Quản lý truy cập</a></li>
                           <li><a target="_blank" href="{{ url('admin/quan_ly_phan_hoi') }}">Quản lý phản hồi</a></li>
                        </ul>
                     </div>
                    
@endsection