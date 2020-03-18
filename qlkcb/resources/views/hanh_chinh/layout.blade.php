@extends('layout.index')

@section('nav_mobile')
    <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none" >
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{ url('hanh_chinh') }}">
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
                            <a target="_blank" href="{{ url('hanh_chinh/quan_ly_nhan_su') }}" data-menu='qlns'>
                                <i class="fas fa-user-md"></i>NHÂN SỰ</a>
                        </li>
                        <li class="has-sub hovergray">
                            <a class="js-arrow none_href" href="#">
                                <i class="fa fa-money"></i>TIỀN LƯƠNG</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/quan_ly_cham_cong') }}" data-menu='qlcc'>CHẤM CÔNG</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/ke_khai_tien_luong') }}" data-menu='qll'>KÊ KHAI LƯƠNG</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub hovergray" >
                            <a class="js-arrow none_href" href="#">
                                <i class="fas fa-hospital"></i>KHOA - PHÒNG</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/quan_ly_khoa') }}" data-menu='qlk'>KHOA</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/quan_ly_phong_ban') }}" data-menu='qlpb'>PHÒNG</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub hovergray" >
                            <a class="js-arrow none_href" href="#">
                                <i class="fas fa-wheelchair"></i>VẬT TƯ Y TẾ</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/quan_ly_duoc') }}" data-menu='qlt'>DANH MỤC DƯỢC</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/quan_ly_danh_muc_ky_thuat') }}" data-menu='qlkt'>DANH MỤC KỸ THUẬT</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/quan_ly_danh_muc_benh') }}" data-menu='qlb'>DANH MỤC BỆNH</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/quan_ly_trang_thiet_bi_yt') }}" data-menu='qltb'>TRANG THIẾT BỊ Y TẾ</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/quan_ly_thong_tin_dia_phuong') }}" data-menu='qldp'>THÔNG TIN ĐỊA PHƯƠNG</a>
                                </li>
                            </ul>
                        </li>
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('hanh_chinh/duyet_van_ban') }}" data-menu='dvb'>
                                <i class="fas fa-file-text"></i>DUYỆT VĂN BẢN</a>
                        </li>
                        <li class="has-sub hovergray">
                            <a class="js-arrow none_href" href="#">
                                <i class="fas fa-chart-bar"></i>THỐNG KÊ</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('hanh_chinh/thong_ke_thuoc_ton_kho') }}" data-menu='tkttk'>
                                <i class="fas fa-chart-bar"></i>THUỐC TỒN KHO</a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none" >
            <div class="header__tool anounttk">
                @if($nd->Quyen == 'qlbv')
                <div class="noti-wrap" style="margin-right: 50px">
                    @if(count($dsbc) > 0)
                    <a target="_blank" href="#" class="noti__item none_href bctk" data-toggle="tooltip" title="Có {{count($dsbc)}} báo cáo chờ duyệt!">
                        <i class="zmdi zmdi-notifications"></i>
                        <span class="quantity spantk" data-slbc="{{ count($dsbc) }}">{{count($dsbc)}}</span>
                    </a>
                    @else
                    <a target="_blank" href="#" class="noti__item none_href bctk" data-toggle="tooltip" title="Hiện chưa có báo cáo nào!">
                        <i class="zmdi zmdi-notifications"></i>
                    </a>
                    @endif
                </div>
                @else
                <?php foreach($nd->capQuyen as $cq){ ?>
                @if($cq->Quyen == 'qlbv' || $cq->Quyen == 'khth')
                <div class="noti-wrap" style="margin-right: 50px">
                    @if(count($dsbc) > 0)
                    <a target="_blank" href="#" class="noti__item none_href bctk" data-toggle="tooltip" title="Có {{count($dsbc)}} báo cáo chờ duyệt!">
                        <i class="zmdi zmdi-notifications"></i>
                        <span class="quantity spantk" data-slbc="{{ count($dsbc) }}">{{count($dsbc)}}</span>
                    </a>
                    @else
                    <a target="_blank" href="#" class="noti__item none_href bctk" data-toggle="tooltip" title="Hiện chưa có báo cáo nào!">
                        <i class="zmdi zmdi-notifications"></i>
                    </a>
                    @endif
                </div>
                <?php break;?>
                @endif
                <?php } ?>
                @endif
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
                            <a class="js-acc-btn none_href" href="#" >@if(isset($nd)){{$nd->nhanVien->TenNV}} @else {{'Tên người dùng'}} @endif</a>
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
                                <a href="{{ url('hanh_chinh') }}">
                                    <img src="public/images/logo4.png" alt="Logo Bệnh Viện ĐKTT An Giang" />
                                </a>
                            </div>
                            <div class="header__navbar">
                                <ul class="list-unstyled" >
                                    <li>
                                        <a target="_blank" href="{{ url('hanh_chinh/quan_ly_nhan_su') }}" style="padding: 25px 12px" data-menu='qlns'>
                                            <i class="fas fa-user-md"></i>
                                            <span class="bot-line"></span>NHÂN SỰ</a>
                                    </li>
                                    <li class="has-sub">
                                        <a class="none_href" href="#" style="padding: 25px 12px">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span class="bot-line"></span>TIỀN LƯƠNG
                                        </a>
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/quan_ly_cham_cong') }}"><span class="bot-line" data-menu='qlcc'></span>CHẤM CÔNG</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/ke_khai_tien_luong') }}"><span class="bot-line" data-menu='qll'></span>KÊ KHAI LƯƠNG</a>
                                            </li>
                                        </ul> 
                                    </li>
                                    <li class="has-sub">
                                        <a class="none_href" href="#" style="padding: 25px 12px">
                                            <i class="fas fa-hospital"></i>
                                            <span class="bot-line"></span>KHOA - PHÒNG
                                        </a> 
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/quan_ly_khoa') }}" data-menu='qlk'>
                                                    <span class="bot-line"></span>KHOA</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/quan_ly_phong_ban') }}" data-menu='qlpb'>
                                                    <span class="bot-line"></span>PHÒNG</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-sub">
                                        <a class="none_href" href="#" style="padding: 25px 12px">
                                            <i class="fas fa-wheelchair"></i>
                                            <span class="bot-line"></span>VẬT TƯ Y TẾ
                                        </a> 
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/quan_ly_duoc') }}" data-menu='qlt'>
                                                    <span class="bot-line"></span>DANH MỤC DƯỢC</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/quan_ly_danh_muc_ky_thuat') }}" data-menu='qlkt'>
                                                    <span class="bot-line"></span>DANH MỤC KỸ THUẬT</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/quan_ly_danh_muc_benh') }}" data-menu='qlb'>
                                                    <span class="bot-line"></span>DANH MỤC BỆNH</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/quan_ly_trang_thiet_bi_yt') }}" data-menu='qltb'>
                                                    <span class="bot-line"></span>TRANG THIẾT BỊ Y TẾ</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/quan_ly_thong_tin_dia_phuong') }}" data-menu='qldp'>
                                                    <span class="bot-line"></span>THÔNG TIN ĐỊA PHƯƠNG</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ url('hanh_chinh/duyet_van_ban') }}" style="padding: 25px 12px" data-menu='dvb'>
                                            <i class="fas fa-file-text"></i>
                                            <span class="bot-line"></span>DUYỆT VĂN BẢN</a>
                                    </li>
                                    
                                    <li class="has-sub">
                                        <a class="none_href" href="#" style="padding: 25px 12px">
                                            <i class="fas fa-chart-bar"></i>
                                            <span class="bot-line"></span>THỐNG KÊ
                                        </a>
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('hanh_chinh/thong_ke_thuoc_ton_kho') }}" data-menu='tkttk'>
                                                    <span class="bot-line"></span>THUỐC TỒN KHO</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="header__tool anounttk">
                                @if($nd->Quyen == 'qlbv')
                                <div class="noti-wrap" style="width: 50px">
                                    @if(count($dsbc) > 0)
                                    <a target="_blank" href="#" class="noti__item none_href bctk" data-toggle="tooltip" title="Có {{count($dsbc)}} báo cáo chờ duyệt!">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity spantk" data-slbc="{{ count($dsbc) }}">{{count($dsbc)}}</span>
                                    </a>
                                    @else
                                    <a target="_blank" href="#" class="noti__item none_href bctk" data-toggle="tooltip" title="Hiện chưa có báo cáo nào!">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </a>
                                    @endif
                                </div>
                                @else
                                <?php foreach($nd->capQuyen as $cq){ ?>
                                @if($cq->Quyen == 'qlbv' || $cq->Quyen == 'khth')
                                <div class="noti-wrap" style="width: 50px">
                                    @if(count($dsbc) > 0)
                                    <a target="_blank" href="#" class="noti__item none_href bctk" data-toggle="tooltip" title="Có {{count($dsbc)}} báo cáo chờ duyệt!">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity spantk" data-slbc="{{ count($dsbc) }}">{{count($dsbc)}}</span>
                                    </a>
                                    @else
                                    <a target="_blank" href="#" class="noti__item none_href bctk" data-toggle="tooltip" title="Hiện chưa có báo cáo nào!">
                                        <i class="zmdi zmdi-notifications"></i>
                                    </a>
                                    @endif
                                </div>
                                <?php break;?>
                                @endif
                                <?php } ?>
                                @endif
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
                                                <div class="account-dropdown__item" >
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
                        <div class="footer-logo"><a href="{{ url('hanh_chinh')}}"><img src="public/images/logo3.png" alt=""></a></div>
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
                           <li><a target="_blank" href="{{ url('hanh_chinh/quan_ly_nhan_su') }}" data-menu='qlns'>Quản lý nhân sự</a></li>
                           <li><a target="_blank" href="{{ url('hanh_chinh/quan_ly_cham_cong') }}" data-menu='qlcc'>Quản lý chấm công</a></li>
                           <li><a target="_blank" href="{{ url('hanh_chinh/quan_ly_duoc') }}" data-menu='qlt'>Quản lý danh mục dược</a></li>
                           <li><a target="_blank" href="{{ url('hanh_chinh/quan_ly_danh_muc_ky_thuat') }}" data-menu='qlkt'>Quản lý danh mục kỹ thuật</a></li>
                           <li><a target="_blank" href="{{ url('hanh_chinh/thong_ke') }}" data-menu='tkhc'>Thống kê</a></li>
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