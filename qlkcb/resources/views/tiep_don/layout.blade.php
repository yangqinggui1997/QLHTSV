@extends('layout.index')

@section('nav_mobile')
    <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none" >
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{url('tiep_don')}}">
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
                        <li class="has-sub hovergray" >
                            <a class="js-arrow none_href" href="#">
                                <i class="fas fa-smile-o"></i>TIẾP ĐÓN BỆNH NHÂN</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('tiep_don/dang_ky_kham') }}" data-menu="dkkb">ĐĂNG KÝ KHÁM BỆNH</a>
                                </li>                                
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('tiep_don/lich_su_dang_ky_kham') }}">LỊCH SỬ ĐĂNG KÝ KHÁM</a>
                                </li>
                            </ul>
                        </li>
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('tiep_don/thong_tin_benh_nhan') }}">
                                <i class="fas fa-male"></i>THÔNG TIN BỆNH NHÂN</a>
                        </li>
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('tiep_don/thong_tin_the_bhyt') }}">
                                <i class="fas fa-credit-card"></i>THÔNG TIN THẺ BHYT</a>
                        </li>
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('tiep_don/cap_cuu') }}" data-menu="cc">
                                <i class="fas fa-ambulance"></i>CẤP CỨU</a>
                        </li>
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('ke_toan/duyet_van_ban') }}" data-menu='dvb'>
                                <i class="fas fa-file-text"></i>DUYỆT VĂN BẢN</a>
                        </li>
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('tiep_don/thong_ke') }}">
                                <i class="fas fa-chart-bar"></i>THỐNG KÊ</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
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
                                <a href="{{url('tiep_don')}}">
                                    <img src="public/images/logo4.png" alt="Logo Bệnh Viện ĐKTT An Giang" />
                                </a>
                            </div>
                            <div class="header__navbar">
                                <ul class="list-unstyled" >
                                    <li class="has-sub" >
                                        <a class="none_href" href="#" style="padding: 25px 10px">
                                            <i class="fas fa-smile-o"></i>TIẾP ĐÓN
                                            <span class="bot-line"></span>
                                        </a> 
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('tiep_don/dang_ky_kham') }}" data-menu="dkkb">
                                                    <span class="bot-line"></span>ĐĂNG KÝ KHÁM BỆNH</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('tiep_don/lich_su_dang_ky_kham') }}">
                                                    <span class="bot-line"></span>LỊCH SỬ ĐĂNG KÝ KHÁM</a>
                                            </li>

                                        </ul>
                                    </li>

                                    <li>
                                        <a target="_blank" href="{{ url('tiep_don/thong_tin_benh_nhan') }}" style="padding: 25px 10px">
                                            <i class="fas fa-male"></i>
                                            <span class="bot-line"></span>THÔNG TIN BỆNH NHÂN</a>
                                    </li>

                                    <li>
                                        <a target="_blank" href="{{ url('tiep_don/thong_tin_the_bhyt') }}" style="padding: 25px 10px">
                                            <i class="fas fa-credit-card"></i>
                                            <span class="bot-line"></span>THÔNG TIN THẺ BHYT</a>

                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ url('tiep_don/cap_cuu') }}" data-menu="cc" style="padding: 25px 10px">
                                            <i class="fas fa-ambulance"></i>
                                            <span class="bot-line"></span>CẤP CỨU</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ url('tiep_don/duyet_van_ban') }}" style="padding: 25px 10px" data-menu='dvb'>
                                            <i class="fas fa-file-text"></i>
                                            <span class="bot-line"></span>DUYỆT VĂN BẢN</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ url('tiep_don/thong_ke') }}" style="padding: 25px 10px">
                                            <i class="fas fa-chart-bar"></i>
                                            <span class="bot-line"></span>THỐNG KÊ</a>
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
                        <div class="footer-logo"><a href="#"><img src="public/images/logo3.png" alt=""></a></div>
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
                           <li><a target="_blank" href="{{ url('tiep_don/dang_ky_kham') }}">Đăng ký khám bệnh</a></li>
                           <li><a target="_blank" href="{{ url('tiep_don/thong_tin_benh_nhan') }}">Thông tin bệnh nhân</a></li>
                           <li><a target="_blank" href="{{ url('tiep_don/thong_tin_the_bhyt') }}">Thông tin thẻ BHYT</a></li>
                           <li><a target="_blank" href="{{ url('tiep_don/cap_cuu') }}">Đăng ký cấp cứu</a></li>
                           
                           <li><a target="_blank" href="{{ url('tiep_don/thong_ke') }}">Thống kê</a></li>
                        </ul>
                     </div>
                     {{-- <div class="col-md-3">
                        <h4 class="title" style="color: #0b6542;">GỬI PHẢN HỒI CHO ADMIN</h4>
                        <p>Vui lòng ghi rõ nội dung phản hồi về chúng tôi!</p>
                        <form class="p-t-10">
                            <div class=" row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <textarea rows="1" style="resize: none;" id="noidungphanhoi" placeholder="Nội dung muốn gửi...." class="form-control "></textarea> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" id="btnguiph" class="au-btn au-btn--blue2 au-btn--small height-40px" data-toggle="tooltip" title="Gửi" ><span class="fa fa-send"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                
                            </div>
                        </form>
                     </div> --}}
@endsection