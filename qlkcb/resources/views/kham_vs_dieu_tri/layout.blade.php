@extends('layout.index')

@section('nav_mobile')
    <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none" >
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{ url('kham_va_dieu_tri') }}">
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
                                <i class="fas fa-book"></i>BỆNH ÁN</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/benh_an_noi_tru') }}" data-menu="banoi">BỆNH ÁN NỘI TRÚ</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/benh_an_ngoai_tru') }}" data-menu="banngoai">BỆNH ÁN NGOẠI TRÚ</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/giay_chuyen_vien') }}" data-menu="gcv">GIẤY CHUYỂN VIỆN</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/giay_ra_vien') }}" data-menu="grv">GIẤY RA VIỆN</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub hovergray" >
                            <a class="js-arrow none_href" href="#" data-toggle="tooltip" title="TOA THUỐC">
                                <i class="fas fa-file-text"></i>T.T</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/toa_thuoc_ngoai_tru') }}" data-menu="ttngoai">TOA NGOẠI TRÚ</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/toa_thuoc_noi_tru') }}" data-menu="ttnoi">TOA NỘI TRÚ</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub hovergray">
                            <a class="js-arrow none_href" href="#" data-toggle="tooltip" title="KỸ THUẬT Y TẾ">
                                <i class="fas fa-umbrella"></i>K.T.Y.T</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/can_lam_sang') }}" data-menu="cls">CHỈ ĐỊNH CẬN LÂM SÀNG</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/tra_ket_qua_cls') }}" data-menu="kqcls">TRẢ KẾT QUẢ CẬN LÂM SÀNG</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/chi_dinh_phau_thuat') }}" data-menu="pt">CHỈ ĐỊNH PHẪU THUẬT</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/chi_dinh_thu_thuat') }}" data-menu="tt">CHỈ ĐỊNH THỦ THUẬT</a>
                                </li>
                            </ul>
                        </li>
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('kham_va_dieu_tri/phieu_ke_khai_vp') }}" data-menu="kkvp" data-toggle="tooltip" title="KÊ KHAI VIỆN PHÍ">
                                <i class="fas fa-money-bill-alt"></i>K.K.V.P</a>
                        </li>
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('kham_va_dieu_tri/benh_su') }}" data-menu="bs" data-toggle="tooltip" title="KỸ THUẬT Y TẾ">
                                <i class="fas fa-history"></i>B.S</a>
                        </li>
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('kham_va_dieu_tri/cap_cuu') }}" data-menu="dtcc">
                                <i class="fas fa-ambulance"></i>CẤP CỨU</a>
                        </li>
                        @if($nd->Quyen != 'pt')
                        <li class="hovergray">
                            <a target="_blank" href="{{ url('kham_va_dieu_tri/duyet_van_ban') }}" data-toggle="tooltip" title="DUYỆT VĂN BẢN">
                                <i class="fas fa-files-o"></i>D.V.B</a>
                        </li>
                        @endif
                        <li class=" has-sub hovergray">
                            <a class="js-arrow none_href" href="#" data-toggle="tooltip" title="THỐNG KÊ">
                                <i class="fas fa-chart-bar"></i>T.K</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/thong_ke_dieu_tri') }}" data-menu="tkk">KHÁM VÀ ĐIỀU TRỊ</a>
                                </li>
                                <li class="hovergray">
                                    <a target="_blank" href="{{ url('kham_va_dieu_tri/thong_ke_cls') }}" data-menu="tkcls">CẬN LÂM SÀNG</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none" >
            <div class="header__tool anounttk">
                @if($nd->Quyen == 'bsk')
                <div class="noti-wrap" style="margin-right: 50px">
                    @if(count($dsbachotn) > 0)
                    <a target="_blank" href="#" class="noti__item none_href cba" data-toggle="tooltip" title="Có {{count($dsbachotn)}} bệnh án chờ tiếp nhận!">
                        <i class="zmdi zmdi-comment-more"></i>
                        <span class="quantity">{{count($dsbachotn)}}</span>
                    </a>
                    @else
                    <a target="_blank" href="#" class="noti__item none_href cba" data-toggle="tooltip" title="Hiện chưa có bệnh án nào chuyển đến!">
                        <i class="zmdi zmdi-comment-more"></i>
                    </a>
                    @endif
                </div>
                @endif
                <?php foreach($nd->capQuyen as $cq){ ?>
                @if($cq->Quyen == 'qlck')
                <div class="noti-wrap notiwrap" style="width: 70px">
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
                                <a href="{{ url('kham_va_dieu_tri') }}">
                                    <img src="public/images/logo4.png" alt="Logo Bệnh Viện ĐKTT An Giang" />
                                </a>
                            </div>
                            <div class="header__navbar">
                                <ul class="list-unstyled" >
                                    <li class="has-sub">
                                        <a class="none_href" href="#" style="padding: 25px 10px">
                                            <i class="fas fa-book"></i>BỆNH ÁN
                                            <span class="bot-line"></span>
                                        </a> 
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/benh_an_noi_tru') }}" data-menu="banoi"><span class="bot-line"></span>BỆNH ÁN NỘI TRÚ</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/benh_an_ngoai_tru') }}" data-menu="bangoai"><span class="bot-line"></span>BỆNH ÁN NGOẠI TRÚ</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/giay_chuyen_vien') }}" data-menu="gcv"><span class="bot-line"></span>GIẤY CHUYỂN VIỆN</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/giay_ra_vien') }}" data-menu="grv"><span class="bot-line"></span>GIẤY RA VIỆN</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-sub" >
                                        <a class="none_href" href="#" style="padding: 25px 10px" data-toggle="tooltip" title="TOA THUỐC" data-placement="right">
                                            <i class="fas fa-file-text"></i>T.T
                                            <span class="bot-line"></span>
                                        </a> 
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/toa_thuoc_ngoai_tru') }}" data-menu="ttngoai"><span class="bot-line"></span>TOA NGOẠI TRÚ</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/toa_thuoc_noi_tru') }}" data-menu="ttnoi"><span class="bot-line"></span>TOA NỘI TRÚ</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-sub">
                                        <a class="none_href" href="#" style="padding: 25px 10px" data-toggle="tooltip" title="KỸ THUẬT Y TẾ" data-placement="left">
                                            <i class="fas fa-umbrella"></i>
                                            <span class="bot-line"></span>K.T.Y.T</a>
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/can_lam_sang') }}" data-menu="cls"><span class="bot-line"></span>CHỈ ĐỊNH CẬN LÂM SÀNG</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/tra_ket_qua_cls') }}" data-menu="kqcls"><span class="bot-line"></span>TRẢ KẾT QUẢ CẬN LÂM SÀNG</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/chi_dinh_phau_thuat') }}" data-menu="pt"><span class="bot-line"></span>CHỈ ĐỊNH PHẪU THUẬT</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/chi_dinh_thu_thuat') }}" data-menu="tt"><span class="bot-line"></span>CHỈ ĐỊNH THỦ THUẬT</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ url('kham_va_dieu_tri/phieu_ke_khai_vp') }}" data-menu="kkvp" style="padding: 25px 10px" data-toggle="tooltip" title="KÊ KHAI VIỆN PHÍ">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span class="bot-line"></span>K.K.V.P</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ url('kham_va_dieu_tri/benh_su') }}" data-menu="bs" style="padding: 25px 10px" data-toggle="tooltip" title="BỆNH SỬ" data-placement="right">
                                            <i class="fas fa-history"></i>
                                            <span class="bot-line"></span>B.S</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ url('kham_va_dieu_tri/cap_cuu') }}" data-menu="dtcc" style="padding: 25px 10px">
                                            <i class="fas fa-ambulance"></i>
                                            <span class="bot-line"></span>CẤP CỨU</a>
                                    </li>
                                    @if($nd->Quyen != 'pt')
                                    <li>
                                        <a target="_blank" href="{{ url('kham_va_dieu_tri/duyet_van_ban') }}" style="padding: 25px 10px" data-toggle="tooltip" title="DUYỆT VĂN BẢN">
                                            <i class="fas fa-files-o"></i>
                                            <span class="bot-line"></span>D.V.B</a>
                                    </li>
                                    @endif
                                    <li class=" has-sub">
                                        <a class="none_href" href="#" style="padding: 25px 10px" data-toggle="tooltip" title="THỐNG KÊ" data-placement="left">
                                            <i class="fas fa-chart-bar"></i>
                                            <span class="bot-line"></span>T.K</a>
                                        <ul class="header3-sub-list list-unstyled">
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/thong_ke_dieu_tri') }}" data-menu="tkk"><span class="bot-line"></span>KHÁM VÀ ĐIỀU TRỊ</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('kham_va_dieu_tri/thong_ke_cls') }}" data-menu="tkcls"><span class="bot-line"></span>CẬN LÂM SÀNG</a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="header__tool anounttk">
                                @if($nd->Quyen == 'bsk')
                                <div class="noti-wrap" style="width: 70px">
                                    @if(count($dsbachotn) > 0)
                                    <a target="_blank" href="#" class="noti__item none_href cba" data-toggle="tooltip" title="Có {{count($dsbachotn)}} bệnh án chờ tiếp nhận!">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">{{count($dsbachotn)}}</span>
                                    </a>
                                    @else
                                    <a target="_blank" href="#" data-menu="banoi" class="noti__item none_href cba" data-toggle="tooltip" title="Hiện chưa có bệnh án nào chuyển đến!">
                                        <i class="zmdi zmdi-comment-more"></i>
                                    </a>
                                    @endif
                                </div>
                                @endif
                                <?php foreach($nd->capQuyen as $cq){ ?>
                                @if($cq->Quyen == 'qlck')
                                <div class="noti-wrap notiwrap" style="width: 70px">
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
                        <div class="footer-logo"><a href="{{ url('kham_va_dieu_tri') }}"><img src="public/images/logo3.png" alt=""></a></div>
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
                           <li><a target="_blank" href="{{ url('kham_va_dieu_tri/benh_an_ngoai_tru') }}" data-menu="bangoai">Bệnh án ngoại trú</a></li>
                           <li><a target="_blank" href="{{ url('kham_va_dieu_tri/benh_an_noi_tru') }}" data-menu="banoi">Bệnh án nội trú</a></li>
                           <li><a target="_blank" href="{{ url('kham_va_dieu_tri/toa_thuoc_ngoai_tru') }}" data-menu="ttngoai">Toa thuốc ngoại trú</a></li>
                           <li><a target="_blank" href="{{ url('kham_va_dieu_tri/toa_thuoc_noi_tru') }}" data-menu="ttnoi">Toa thuốc nội trú</a></li>
                           
                           <li><a target="_blank" href="{{ url('kham_va_dieu_tri/cap_cuu') }}" data-menu="dtcc">Bệnh án cấp cứu</a></li>
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