@extends('hanh_chinh.layout')

@section('title')
    {{ "Thông tin nhân viên" }}
@endsection

@section('css')
<link href="public/css/tempusdominus-bootstrap-4.css" rel="stylesheet" media="all">
@endsection

@section('content')
    <div class="main-content">
            <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
        <?php $flag=FALSE;?>
        @foreach($nd->capQuyen as $cqnd)
            @if($cqnd->Quyen == 'khth')
            <input type="hidden" id="quyen_bs" value="TRUE">
            <?php $flag=TRUE; break;?>
            @endif  
        @endforeach
        @if($flag==FALSE)
        <input type="hidden" id="quyen_bs" value="FALSE">
        @endif
                <!-- THÊM MỚI THÔNG TIN NHÂN VIÊN-->
                <section class="p-t-20 hidden" id="formnv" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="formtitle">THÊM THÔNG TIN NHÂN VIÊN MỚI</h3>
                                    <hr class="line-seprate">
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body card-block">
                                                <form>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Họ tên nhân viên (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập họ tên nhân viên..." class="form-control" id="hoten"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Ngày sinh</label>
                                                                <div class="input-group date" id="ngaysinh" data-target-input="nearest">
                                                                    <input onkeydown="return false" type="text" class="form-control datetimepicker-input" data-target="#ngaysinh" id="ns"/>
                                                                    <div class="input-group-append" data-target="#ngaysinh" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Giới tính</label>
                                                                <select class="form-control" id="gt">
                                                                    <option value="0">Nữ</option>
                                                                    <option value="1">Nam</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Số CMND (<span class="color-red">*</span>)</label>
                                                                <input maxlength="9" min="0" type="number" placeholder="Nhập số chứng minh nhân dân..." class="form-control" id="scmnd"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Số điện thoại (<span class="color-red">*</span>)</label>
                                                                <input maxlength="10" type="number" min="0" placeholder="Nhập số điện thoại..." class="form-control" id="sdt"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Email (<span class="color-red">*</span>)</label>
                                                                <input type="email" placeholder="Nhập địa chỉ email..." class="form-control" id="email"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">ĐC Tỉnh / TP</label>
                                                                <select class="form-control" id="tinh">
                                                                    @if(isset($dstinh))
                                                                        @foreach($dstinh as $tinh)
                                                                            <option value="{{$tinh->IdTinh}}">{{$tinh->TenTinh}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">ĐC Quận / Huyện</label>
                                                                <select class="form-control" id="huyen">

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">ĐC Xã / Phường</label>
                                                                <select class="form-control" id="xa">

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Dân tộc</label>
                                                                <select class="form-control" id="dantoc">
                                                                    @if(isset($dsdantoc))
                                                                        <?php foreach($dsdantoc as $dt){ ?>
                                                                    <option value="<?php echo \comm_functions::changeTitle($dt); ?>">{{$dt}}</option>
                                                                        <?php }?>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Số nhà / tên đường</label>
                                                                <input type="text" placeholder="Nhập số nhà / tên đường..." class="form-control" id="diachi"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Trình độ</label>
                                                                <select class="form-control" id="trinhdo">
                                                                    <option value="giao_su">Giáo sư</option>
                                                                    <option value="pho_gii trung cấp</option>ao_su">Phó giáo sư</option>
                                                                    <option value="pho_giao_su_ts">Phó giáo sư - Tiến sĩ</option>
                                                                    <option value="tien_si">Tiến sĩ</option>
                                                                    <option value="thac_si">Thạc sĩ</option>
                                                                    <option value="cu_nhan">Cử nhân</option>
                                                                    <option value="cao_dang">Cao đẳng</option>
                                                                    <option value="trung_cap">Trung cấp</option>
                                                                    <option value="duoi_trung_cap">Dưới trung cấp
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chuyên môn (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập chuyên môn nghiệp vụ..." class="form-control" id="chuyenmon"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chức vụ</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <select class="form-control" id="chucvu">
                                                                            <option value="giam_doc">Giám đốc</option>
                                                                            <option value="pho_giam_doc">Phó giám đốc</option>
                                                                            <option value="truong_khoa">Trưởng khoa</option>
                                                                            <option value="pho_truong_khoa">Phó trưởng khoa</option>
                                                                            <option value="truong_phong">Trưởng phòng</option>
                                                                            <option value="pho_truong_phong">Phó trưởng phòng</option>
                                                                            <option value="chuyen_vien">Chuyên viên</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group"  >
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm chức vụ" id="btnthemcv"><span class="fa fa-plus"></span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chức vụ đã chọn (<span class="color-red">*</span>)</label>
                                                                <div class="row">
                                                                    <div class="col-lg-8 m-b-15">
                                                                        <select class="form-control" id="dschucvu">

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group" >
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa chức vụ" id="btnxoacv"><span class="fa fa-minus"></span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Loại nhân viên</label>
                                                                <select class="form-control" id="loainv">
                                                                    <option value="0">Hợp đồng</option>
                                                                    <option value="1">Biên chế</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Hợp đồng từ ngày</label>
                                                                <div class="input-group date" id="hdtungay" data-target-input="nearest">
                                                                    <input onkeydown="return false" type="text" class="form-control datetimepicker-input" data-target="#hdtungay" id="hdtn"/>
                                                                    <div class="input-group-append" data-target="#hdtungay" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Hợp đồng đến ngày</label>
                                                                <div class="input-group date" id="hddenngay" data-target-input="nearest">
                                                                    <input onkeydown="return false" type="text" class="form-control datetimepicker-input" data-target="#hddenngay" id="hddn"/>
                                                                    <div class="input-group-append" data-target="#hddenngay" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Các công việc</label>
                                                                <select class="form-control" id="congviec">
                                                                    <option value="quan_tri_he_thong">Quản trị hệ thống</option>
                                                                    <option value="quan_ly_benh_vien">Quản lý bệnh viện</option>
                                                                    <option value="hanh_chinh_tong_hop">Hành chính tổng hợp</option>
                                                                    <option value="bac_si_chuyen_khoa_kham_va_dieu_tri">Bác sĩ chuyên khoa khám và điều trị</option>
                                                                    <option value="bac_si_ky_thuat_cls">Bác sĩ kỹ thuật cận lâm sàng</option>
                                                                    <option value="bac_si_cap_cuu">Bác sĩ trực cấp cứu</option>
                                                                    <option value="ke_toan">Thu ngân</option>
                                                                    <option value="tiep_don_cc">Trực tiếp nhận cấp cứu</option>
                                                                    <option value="tiep_don_kham_benh">Tiếp đón bệnh nhân đến khám</option>
                                                                    <option value="phat_thuoc">Phát thuốc</option>
                                                                    <option value="ky_thuat_dien">Kỹ thuật điện</option>
                                                                    <option value="ky_thuat_y_te">Kỹ thuật y tế</option>
                                                                    <option value="bao_ve">Bảo vệ</option>
                                                                    <option value="lao_cong">Lao công</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Phòng làm việc</label>
                                                                <select class="form-control" id="phonglv">
                                                                    @if(isset($dsphong))
                                                                        @foreach($dsphong as $p)
                                                                            <option value="{{$p->IdPB}}">{{$p->SoPhong.' - '.$p->TenPhong}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Bậc lương (<span class="color-red">*</span>)</label>
                                                                <input min="1" type="number" placeholder="1" class="form-control" id="bl"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Số tài khoản (<span class="color-red">*</span>)</label>
                                                                <input min="0" maxlength="13" type="number" placeholder="Số tài khoản ngân hàng..." class="form-control" id="stk"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Ảnh</label>
                                                                <input type="file" class="form-control" id="anh"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        @if($nd->Quyen != 'admin' && $flag == FALSE)
                                                        <div class="col-lg-1" id="btnthemarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Thêm mới" id="btnthem"><span class="fa fa-plus"></span></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btnsuaarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Cập nhật" id="btncapnhat"><span class="fa fa-edit"></span></button>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-1" id="btnlamlaiarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--remove au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Làm lại" id="btnlamlai"><span class="fa fa-eraser"></span></button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-lg-1" >
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--close au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Đóng" id="btndong"><span class="fa fa-remove"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END THÊM MỚI THÔNG TIN NHÂN VIÊN-->

                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH NHÂN VIÊN</h3>
                                    <hr class="line-seprate">
                                </div>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="au-breadcrumb-content">
                                            <div class="au-breadcrumb-left">
                                            </div>
                                            <form class="au-form-icon--sm" id="ftimkiem" >
                                                <input type="text" class="au-input--w300 au-input--style2" id="txttimkiem" placeholder="Nhập thông tin cần tìm...">
                                                <button type="button" class="au-btn--submit2" data-toggle="tooltip" title="Tìm kiếm" id="btntimkiem">
                                                    <i class="zmdi zmdi-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="fa fa-user-md"></i></button>
                                        <button type="button" class="au-btn au-btn--teal au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Nạp lại danh sách" id="btnnapds"><i class="zmdi zmdi-refresh"></i></button>
                                        <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatc"><i class="zmdi zmdi-delete"></i></button>
                                    </div>
                                </div>
                                <div class="table-data__tool">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <p class="color-redlight font-size-10" id="kqtimliem"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-data__tool hidden" id="tb_bc" style="margin-bottom: 0">
                                    <div class="table-data__tool-left" id="thong_bao">
                                        
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2 fit_table_height_500 tableFixHead">
                                    <table class="table table-data2 table-hover m-b-20 text-center">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox" data-input="checksum">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th style="width: 10%; position: sticky; top: 0; z-index: 99;">nhân viên</th>
                                                <th>ngày sinh</th>
                                                <th>Giới tính</th>
                                                <th>SĐT</th>
                                                <th>Email</th>
                                                <th>Trình độ</th>
                                                <th>Chuyên môn</th>
                                                <th>Ngày vào làm</th>
                                                <th>Phòng làm việc</th>
                                                <th>Loại nhân viên</th>
                                                <th>Ảnh</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_nv">
                                            @if (isset($nhanvien))
                                                @foreach($nhanvien as $nv)
                                                    <tr class="tr-shadow">
                                                        <td style="vertical-align: middle;">
                                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                                <input type="checkbox" data-input="check" data-id="{{ $nv->IdNV }}" data-name="{{ $nv->TenNV }}">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>{{ $nv->TenNV}}</td>
                                                        <td>
                                                            <?php
                                                                echo date( "d/m/Y", strtotime($nv->NgaySinh));
                                                            ?>
                                                        </td>
                                                        <td>@if($nv->GioiTinh == 1) {{ "Nam" }} @else {{ "Nữ" }} @endif</td>
                                                        <td>{{$nv->SDT}}</td>
                                                        <td>{{$nv->Email}}</td>
                                                        <td><?php echo \comm_functions::decodeTrinhDo($nv->TrinhDo);?></td>
                                                        <td>{{$nv->ChuyenMon}}</td>
                                                        <td>
                                                            <?php
                                                                echo date( "d/m/Y", strtotime($nv->HopDongTuNgay));
                                                            ?>
                                                        </td>
                                                        <td>{{$nv->phongBan->SoPhong. ' - '.$nv->phongBan->TenPhong}}</td>
                                                        <td>
                                                            @if($nv->LoaiNV == 0)
                                                                {{ "Hợp đồng" }}
                                                            @else
                                                                {{"Biên chế"}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($nv->Anh == '')
                                                                {{ "Chưa cập nhật!" }}
                                                            @else
                                                                <img class="avatar" src="public/upload/anhnv/{{$nv->Anh}}" alt="Ảnh nhân viên" style="height: 45px; width: 45px">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{$nv->IdNV}}">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{$nv->IdNV}}" data-name="{{$nv->TenNV}}">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="spacer"></tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END DATA TABLE-->
            </div>
@endsection

@section('js')
<script src="public/js/moment.js"></script>
<script src="public/js/tempusdominus-bootstrap-4.js"></script>
<script src="public/js/pusher.js"></script>
<script>

    $(function () {
        //khởi tạo flag tìm kiếm
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false, themnv=false;
        //end

        if ($("#ngaysinh").length) {
            
            $('#ngaysinh').datetimepicker({
                icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                format: 'DD/MM/YYYY'
            });
        }
        
        if ($("#hddenngay").length) {
            
            $('#hddenngay').datetimepicker({
                icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                format: 'DD/MM/YYYY'
            });
        }
        if ($("#hdtungay").length) {
            
            $('#hdtungay').datetimepicker({
                icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                format: 'DD/MM/YYYY'
            });
        }
        $('#ns').on('input', function (){
           $('#ngaysinh').datetimepicker('minDate', '01/01/1900 00:00');
           $('#ngaysinh').datetimepicker('maxDate', new Date());
        });

        $('#hdtn').on('input', function (){
           $('#hdtungay').datetimepicker('minDate', '01/01/1900 00:00');
           $('#hdtungay').datetimepicker('maxDate', new Date());
        });

        $('#hddn').on('input', function (){
           $('#hddenngay').datetimepicker('minDate',  new Date());
        });

        var showTooltip = function () {
            $(this).tooltip('show');
        }
        , hideTooltip = function () {
            $(this).tooltip('hide');
        };

        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'manual'

        })
        .focus(hideTooltip)
        .blur(hideTooltip)
        .hover(showTooltip, hideTooltip);

        var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

        //Phần xử lý cho channel
        // Khởi tạo một đối tượng Pusher với app_key
        var pusher = new Pusher('d2f4702dc798a781c566', {
            cluster: 'ap1',
            encrypted: true
        });

        var chaneltk = pusher.subscribe('UserEvent');

        function capnhattk(data) {
            if(data.thaotac == 'cntk'){
                $('img[data-anhtk="anhtk"]').attr('src', 'public/upload/anhnv/'+data.anh);
            }
        }

        chaneltk.bind('App\\Events\\Admin\\UserEvent', capnhattk);
        
        var audio='';
        $('a[class*="bctk"]').click(function(){
            $.ajax({
                url: 'http://localhost/qlkcb/public/audios/sound.mp3',
                type: 'GET',
                error: function()
                {
                    //not exists
                },
                success: function()
                {
                    // exists
                    audio.pause();
                }
            });
        });
        var channelnhantb = pusher.subscribe('DVB');
        
        function nhantbbc(data) {
            if(data.thaotac != 'xoa'){
                if(data.thaotac == 'duyet'){
                    if(data.dvb.idnvd == $('#id_nv').val()){
                        if($('a[class*="bctk"]').find('span[class*="spantk"]').length > 0){
                            var slht=$('span[class*="spantk"]').attr('data-slbc');
                            var slm=parseInt(slht)-1;
                            if(slm == 0){
                                $('span[class*="spantk"]').remove();
                                $('a[class*="bctk"]').attr('data-original-title', 'Hiện chưa báo cáo nào!');
                            }
                            else{
                                $('span[class*="spantk"]').text(slm);
                                $('span[class*="spantk"]').attr('data-slbc', slm);
                                $('a[class*="bctk"]').attr('data-original-title', 'Có '+slm+' báo cáo chờ duyệt!');
                            }
                        }
                        else{
                            $('a[class*="bctk"]').attr('data-original-title', 'Hiện chưa báo cáo nào!');
                        }
                    }
                    else if(data.dvb.idnv == $('#id_nv').val()){
                        if(data.dvb.pl == 'thong_ke'){
                            if($('#tb_bc').hasClass('hidden')){
                                $('#tb_bc').removeClass('hidden');

                                var tb='<div class="rs-select2--light _'+data.dvb.id+'">\n\
                                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-success">Thông báo!</span> Thống kê ['+data.dvb.cd+'] đã được duyệt bởi '+data.dvb.nd+'<button type="button" data-ma="'+data.dvb.id+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">×</span></button>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>';

                                $('#thong_bao').append(tb);
                            }
                            else{
                                var tb='<div class="rs-select2--light _'+data.dvb.id+'">\n\
                                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-success">Thông báo!</span> Thống kê ['+data.dvb.cd+'] đã được duyệt bởi '+data.dvb.nd+'<button type="button" data-ma="'+data.dvb.id+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">×</span></button>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>';

                                $('#thong_bao').append(tb);
                            }
                        }
                    }
                }
                else{
                    if(data.dvb.pl ==  'thong_ke' || (data.dvb.pl ==  'grv' && $('#quyen_bs').val() == 'TRUE')){
                        if($('[class*="anounttk"]').find('[class*="noti-wrap"]').length > 0){
                            if($('a[class*="bctk"]').find('span[class*="spantk"]').length > 0){
                                var slht=$('span[class*="spantk"]').attr('data-slbc');
                                var slm=parseInt(slht)+1;
                                $('span[class*="spantk"]').text(slm);
                                $('span[class*="spantk"]').attr('data-slbc', slm);
                                $('a[class*="bctk"]').attr('data-original-title', 'Có '+slm+' báo cáo chờ duyệt!');
                            }
                            else{
                                var ct='<span class="quantity spantk">1</span>';
                                $('a[class*="bctk"]').append(ct);
                                $('span[class*="spantk"]').attr('data-slbc', 1);
                                $('a[class*="bctk"]').attr('data-original-title', 'Có 1 báo cáo chờ duyệt!');
                            }

                            $.ajax({
                                url: 'http://localhost/qlkcb/public/audios/sound.mp3',
                                type: 'GET',
                                error: function()
                                {
                                    //not exists
                                },
                                success: function()
                                {
                                    // exists
                                    audio = new Audio('public/audios/sound.mp3');
                                    audio.play();
                                }
                            });
                        }
                    }
                }
            }
            else{
                for (var i = 0; i < data.dshuy.length; i++) {
                    if(data.dshuy[i]['idnv'] == $('#id_nv').val()){
                        if(data.dshuy[i]['pl'] == 'thong_ke'){
                            if($('#tb_bc').hasClass('hidden')){
                                $('#tb_bc').removeClass('hidden');

                                var tb='<div class="rs-select2--light _'+data.dshuy[i]['id']+'">\n\
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-danger">Thông báo!</span> Yêu cầu duyệt thống kê ['+data.dshuy[i]['cd']+'] đã bị hủy bởi '+data.dshuy[i]['nd']+'<button type="button" data-ma="'+data.dshuy[i]['id']+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">×</span></button>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>';

                                $('#thong_bao').append(tb);
                            }
                            else{
                                var tb='<div class="rs-select2--light _'+data.dshuy[i]['id']+'">\n\
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-danger">Thông báo!</span> Yêu cầu duyệt thống kê ['+data.dshuy[i]['cd']+'] đã bị hủy bởi '+data.dshuy[i]['nd']+'<button type="button" data-ma="'+data.dshuy[i]['id']+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">×</span></button>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>';
                                                
                                $('#thong_bao').append(tb);
                            }
                        }
                    }
                }
                if($.isArray(data.dvb)){
                    if(data.pl == 'cd'){
                        if($('#id_nv').val() == data.idnvd){
                            if($('a[class*="bctk"]').find('span[class*="spantk"]').length > 0){
                                var slht=$('span[class*="spantk"]').attr('data-slbc');
                                var slm=parseInt(slht)-data.dvb.length;
                                if(slm == 0){
                                    $('span[class*="spantk"]').remove();
                                    $('a[class*="bctk"]').attr('data-original-title', 'Hiện chưa có báo cáo nào!');
                                }
                                else{
                                    $('span[class*="spantk"]').text(slm);
                                    $('span[class*="spantk"]').attr('data-slbc', slm);
                                    $('a[class*="bctk"]').attr('data-original-title', 'Có '+slm+' báo cáo chờ duyệt!');
                                }
                            }
                        }
                    }
                }
                else{
                    if(data.pl == 'cd'){
                        if($('#id_nv').val() == data.idnvd){
                            if($('a[class*="bctk"]').find('span[class*="spantk"]').length > 0){
                                var slht=$('span[class*="spantk"]').attr('data-slbc');
                                var slm=parseInt(slht)-1;
                                if(slm == 0){
                                    $('span[class*="spantk"]').remove();
                                    $('a[class*="bctk"]').attr('data-original-title', 'Hiện chưa có báo cáo nào!');
                                }
                                else{
                                    $('span[class*="spantk"]').text(slm);
                                    $('span[class*="spantk"]').attr('data-slbc', slm);
                                    $('a[class*="bctk"]').attr('data-original-title', 'Có '+slm+' báo cáo chờ duyệt!');
                                }
                            }
                        }
                    }
                }
            }
        }

        channelnhantb.bind('App\\Events\\HanhChinh\\DVB', nhantbbc);
        
        //Đăng ký với kênh NhanVien đã tạo trong file NhanVien.php
        var channel = pusher.subscribe('NhanVien');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var anh='';
                if(data.nhanvien.anh == null){
                    anh='Chưa cập nhật!';
                }
                else{
                    anh='<img class="avatar" src="public/upload/anhnv/'+data.nhanvien.anh+'" alt="Ảnh nhân viên" style="height: 45px; width: 45px">';
                }
                var ttnv='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.nhanvien.id+'" data-name="'+data.nhanvien.hoten+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td>'+data.nhanvien.hoten+'</td>\n\
                        <td>'+data.nhanvien.ngaysinh+'</td>\n\
                        <td>'+data.nhanvien.gt+'</td>\n\
                        <td>'+data.nhanvien.sdt+'</td>\n\
                        <td>'+data.nhanvien.email+'</td>\n\
                        <td>'+data.nhanvien.trinhdo+'</td>\n\
                        <td>'+data.nhanvien.chuyenmon+'</td>\n\
                        <td>'+data.nhanvien.ngayvaolam+'</td>\n\
                        <td>'+data.nhanvien.phong+'</td>\n\
                        <td>'+data.nhanvien.loainv+'</td>\n\
                        <td style="width: 100px ;">'+anh+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.nhanvien.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.nhanvien.id+'" data-name="'+data.nhanvien.hoten+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    ttnv+='<tr class="spacer"></tr>';
                    $('#tbl_nv').prepend(ttnv);
                }
                else{

                    $('#tbl_nv tr').has('td div button[data-id="'+data.nhanvien.id+'"]').replaceWith(ttnv);
                }

                $('button[data-id="'+data.nhanvien.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isArray(data.nhanvien)){
                    for (var i = 0; i < data.nhanvien.length; i++) {
                        $('#tbl_nv tr').has('td div button[data-id="'+data.nhanvien[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_nv tr').has('td div button[data-id="'+data.nhanvien[i]+'"]').remove();

                    }
                }
                else{
                    $('#tbl_nv tr').has('td div button[data-id="'+data.nhanvien+'"]').next('tr.spacer').remove();
                    $('#tbl_nv tr').has('td div button[data-id="'+data.nhanvien+'"]').remove();

                }
            }
        }

        //Bind một function laytt với sự kiện NhanVien.php
        channel.bind('App\\Events\\HanhChinh\\NhanVien', laytt);
        //end xử lý channel

        //Lấy danh sách tỉnh
        $('#tinh').change(function(){
            var id=$(this).val();
            $.ajax({
                type: 'post',
                url: "/qlkcb/tiep_don/thong_tin_benh_nhan/lay_ds_huyen",
                dataType: 'JSON',
                data: {_token: CSRF_TOKEN, idtinh: id},
                success: function(data){
                    $('#huyen').html(data.msg);
                    $("#huyen").change();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Không thể lấy danh sách quận - huyện. Lỗi: "+jqXHR+" | "+errorThrown);
                }
            });
        });
        //end Lấy danh sách tỉnh

        //Lấy danh sách huyện
        $('#huyen').change(function(){
            var id=$(this).val();
            $.ajax({
                type: 'post',
                url: "/qlkcb/tiep_don/thong_tin_benh_nhan/lay_ds_xa",
                dataType: 'JSON',
                data: {_token: CSRF_TOKEN, idhuyen: id},
                success: function(data){
                    $('#xa').html(data.msg);
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert("Không thể lấy danh sách xã - phường. Lỗi: "+jqXHR+" | "+errorThrown);
                }
            });
        });
        //end Lấy danh sách huyện

        $('#btnthemcv').click(function (){
            var flag=false;
            $('#dschucvu option').each(function(){
                if($(this).val() == $('#chucvu').val()){
                    flag=true;
                    return false;
                }
            });

            if(flag==false)
            {
                if(themnv == true){
                    $('#dschucvu').prepend('<option value="'+$('#chucvu').val()+'">'+$('#chucvu option[value="'+$('#chucvu').val()+'"]').text()+'</option>');
                }
            }
        });

        $('#btnxoacv').click(function(){
            if(themnv == true)
            {
                $('#dschucvu option[value="'+$('#dschucvu').val()+'"]').remove();
            }
        });

        function ktemail(){
            var s = $('#email').val();
            var acarr=s.toString().split('@');
            var acong = s.indexOf('@');
            var daucham = s.lastIndexOf('.');
            var khoangtrang = s.indexOf(' ');
            if ((acong < 1) || (daucham < 1) || (acarr.length > 2)||
                (daucham == acong+1) || (daucham < acong)||
                (daucham == s.length-1) ||
                (khoangtrang != -1)){
                return false;
            }
            else{
                return true;
            }

        };

        //Submit thêm mới
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);

            var hoten=$('#hoten').val(), ngaysinh=$('#ns').val(), gt=$('#gt').val(), scmnd=$('#scmnd').val(), sdt=$('#sdt').val(), diachi=$('#diachi').val(), dantoc=$('#dantoc').val(), xa=$('#xa').val(), email=$('#email').val(), trinhdo=$('#trinhdo').val(), chuyenmon=$('#chuyenmon').val(), loainv=$('#loainv').val(), hdtn=$('#hdtn').val(), hddn=$('#hddn').val(), congviec=$('#congviec').val(), phong=$('#phonglv').val(), stk=$('#stk').val();

            var chucvu=[];
            $('#dschucvu option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        chucvu.push(this.value);
                    }
                });
            });

            if(hoten.toString().trim() == ''){
                alert("Vui lòng nhập thông tin họ tên nhân viên!");
                return false;
            }
            else if(scmnd.toString().trim() == ''){
                alert("Vui lòng nhập số chứng minh nhân dân!");
                return false;
            }
            else if(sdt.toString().trim() == ''){
                alert("Vui lòng nhập số điện thoại!");
                return false;
            }
            else if(xa.toString().trim() == ''){
                alert("Vui lòng nhập thông tin xã!");
                return false;
            }
            else if(chuyenmon.toString().trim() == ''){
                alert("Vui lòng nhập chuyên môn!");
                return false;
            }
            else if(email.toString().trim() == ''){
                alert("Vui lòng nhập email!");
                return false;
            }
            else if(stk.toString().trim() == ''){
                alert("Vui lòng nhập số tài khoản ngân hàng!");
                return false;
            }
            else{
                if(scmnd.length != 9 || sdt.length != 10 || stk.length != 13){
                    alert("Số chứng minh nhân dân, số tài khoản ngân hàng và số điện thoại phải hợp lệ, nhập đúng 9 số chứng minh và 10 số điện thoại, số tài khoản là 13 số!");
                    return false;
                }
                if(!ktemail()){
                    alert('Email không hợp lệ!');
                    return false;
                }
            }

            var time1=hdtn.toString().split('/');
            var time2=hddn.toString().split('/');
            
            if(parseInt(time2[2]) < parseInt(time1[2])){
                
                alert('Thời gian kết thúc hợp đồng không thể nhỏ hơn thời gian bắt đầu hợp đồng!');
                return false;
            }
            else{
                if(parseInt(time2[1]) < parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                    alert('Thời gian kết thúc hợp đồng không thể nhỏ hơn thời gian bắt đầu hợp đồng!');
                    return false;
                }
                else{
                    if(parseInt(time2[0]) < parseInt(time1[0]) && parseInt(time2[1]) == parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                        alert('Thời gian kết thúc hợp đồng không thể nhỏ hơn thời gian bắt đầu hợp đồng!');
                        return false;
                    }
                }
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if ($('#anh')[0].files.length > 0) {
                formData.append('file', $('#anh')[0].files[0]);
            }
            formData.append('hoten', hoten);
            formData.append('ngaysinh', ngaysinh);
            formData.append('gt', gt);
            formData.append('scmnd', scmnd);
            formData.append('sdt', sdt);
            formData.append('diachi', diachi);
            formData.append('dantoc', dantoc);
            formData.append('xa', xa);
            formData.append('email', email);
            formData.append('trinhdo', trinhdo);
            formData.append('chuyenmon', chuyenmon);
            formData.append('loainv', loainv);
            formData.append('hdtn', hdtn);
            formData.append('hddn', hddn);
            formData.append('congviec', congviec);
            formData.append('phong', phong);
            formData.append('stk', stk);
            if(chucvu.length > 0){
                formData.append('chucvu', chucvu);
            }

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_nhan_su/them_moi',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    // Success
                    if(data.msg == 'ko_ho_tro_kieu_file'){
                        alert("Thêm nhân viên thành công! Upload file thất bại, kiểu file ảnh không được hỗ trợ, kiểu hỗ trợ là file .jpeg, .png, .svg và .jpg!");
                    }
                    else if(data.msg == 'Email'){
                        alert("Email đã tồn tại!");
                    }
                    else if(data.msg == 'tc'){
                        alert("Thêm nhân viên thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);
                        themnv=false;
                        $('#kqtimliem').text("");
                        tk=false;locds=false;keySearch='';
                    }
                    else{
                        themnv=true;
                        alert("Thêm nhân viên thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    themnv=true;
                    if(jqXHR.status == 419){
                        alert("Thêm thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Thêm thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Thêm thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        // end Submit thêm mới

        //Submit cập nhật
        $('#btncapnhat').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);

            var id=$(this).attr('data-id');
            var hoten=$('#hoten').val(), ngaysinh=$('#ns').val(), gt=$('#gt').val(), scmnd=$('#scmnd').val(), sdt=$('#sdt').val(), diachi=$('#diachi').val(), dantoc=$('#dantoc').val(), xa=$('#xa').val(), email=$('#email').val(), trinhdo=$('#trinhdo').val(), chuyenmon=$('#chuyenmon').val(), loainv=$('#loainv').val(), hdtn=$('#hdtn').val(), hddn=$('#hddn').val(), congviec=$('#congviec').val(), phong=$('#phonglv').val(), bl=$('#bl').val(), stk=$('#stk').val();

            var chucvu=[];
            $('#dschucvu option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        chucvu.push(this.value);
                    }
                });
            });

            if(hoten.toString().trim() == ''){
                alert("Vui lòng nhập thông tin họ tên nhân viên!");
                return false;
            }
            else if(scmnd.toString().trim() == ''){
                alert("Vui lòng nhập số chứng minh nhân dân!");
                return false;
            }
            else if(sdt.toString().trim() == ''){
                alert("Vui lòng nhập số điện thoại!");
                return false;
            }
            else if(xa.toString().trim() == ''){
                alert("Vui lòng nhập thông tin xã!");
                return false;
            }
            else if(chuyenmon.toString().trim() == ''){
                alert("Vui lòng nhập chuyên môn!");
                return false;
            }
            else if(bl.toString().trim() == ''){
                alert("Vui lòng nhập bậc lương!");
                return false;
            }
            else if(email.toString().trim() == ''){
                alert("Vui lòng nhập email!");
                return false;
            }
            else if(stk.toString().trim() == ''){
                alert("Vui lòng nhập số tài khoản ngân hàng!");
                return false;
            }
            else{
                if(scmnd.length != 9 || sdt.length != 10 || stk.length != 13){
                    alert("Số chứng minh nhân dân, số tài khoản ngân hàng và số điện thoại phải hợp lệ, nhập đúng 9 số chứng minh và 10 số điện thoại, số tài khoản là 13 số!");
                    return false;
                }
                if(!ktemail()){
                    alert('Email không hợp lệ!');
                    return false;
                }
            }
            var time1=hdtn.toString().split('/');
            var time2=hddn.toString().split('/');
            
            if(parseInt(time2[2]) < parseInt(time1[2])){
                
                alert('Thời gian kết thúc hợp đồng không thể nhỏ hơn thời gian bắt đầu hợp đồng!');
                return false;
            }
            else{
                if(parseInt(time2[1]) < parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                    alert('Thời gian kết thúc hợp đồng không thể nhỏ hơn thời gian bắt đầu hợp đồng!');
                    return false;
                }
                else{
                    if(parseInt(time2[0]) < parseInt(time1[0]) && parseInt(time2[1]) == parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                        alert('Thời gian kết thúc hợp đồng không thể nhỏ hơn thời gian bắt đầu hợp đồng!');
                        return false;
                    }
                }
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if ($('#anh')[0].files.length > 0) {
                formData.append('file', $('#anh')[0].files[0]);
            }
            formData.append('hoten', hoten);
            formData.append('ngaysinh', ngaysinh);
            formData.append('gt', gt);
            formData.append('scmnd', scmnd);
            formData.append('sdt', sdt);
            formData.append('diachi', diachi);
            formData.append('dantoc', dantoc);
            formData.append('xa', xa);
            formData.append('email', email);
            formData.append('trinhdo', trinhdo);
            formData.append('chuyenmon', chuyenmon);
            formData.append('loainv', loainv);
            formData.append('hdtn', hdtn);
            formData.append('hddn', hddn);
            formData.append('congviec', congviec);
            formData.append('phong', phong);
            formData.append('bl', bl);
            formData.append('stk', stk);
            if(chucvu.length > 0){
                formData.append('chucvu', chucvu);
            }
            
            formData.append('id', id);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_nhan_su/cap_nhat',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    // Success
                    if(data.msg == 'ko_ho_tro_kieu_file'){
                        alert("Cập nhật thông tin nhân viên thành công! Upload file thất bại, kiểu file ảnh không được hỗ trợ, kiểu hỗ trợ là file .jpeg, .png, .svg và .jpg!");
                    }
                    else if(data.msg == 'tc'){
                        alert("Cập nhật thông tin nhân viên thành công!");
                    }
                    else if(data.msg == 'Email'){
                        alert("Email đã tồn tại!");
                    }
                    else if(data.msg == 'bl'){
                        alert("Bậc lương không hợp lệ! Bậc lương phù hợp với công việc của nhân viện này là từ 1 - "+data.bl+".");
                    }
                    else{
                        alert("Cập nhật thông tin nhân viên thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin nhân viên thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin nhân viên thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin nhân viên thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật

        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formnv').slideUp(800);
        });
        //end đóng form nhập liệu
        //
        //mở form để thêm
        $('#btnadd').click(function(){
            $('#btnthemarea').fadeIn(800);
            $('#btnlamlaiarea').fadeIn(800);
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('THÊM THÔNG TIN NHÂN VÊN MỚI');
            $('#btnlamlai').click();
            $("#tinh").change();
            $('#formnv').slideDown(800);
            $('html, body').animate({
                scrollTop: $("#formnv").offset().top
            }, 800);
        });
        //end mở form để thêm

        //xóa
        $('#tbl_nv').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin của nhân viên "+name+"?");
            if(cf==true){
                if($('#btnsuaarea').css('display') == 'block' && id == $('#btncapnhat').attr('data-id')){//đóng form sửa khi click xóa
                   $('#btndong').click();
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/hanh_chinh/quan_ly_nhan_su/xoa',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        return myXhr;
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        // Success
                        if(data.msg == 'tc'){
                            if(locds == true){
                                soluongl--;
                                if(soluongl == 0){
                                     $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongl+" nhân viên được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" nhân viên được tìm thấy!");
                                    }
                                }
                            }
                            if($('#tbl_nv').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            alert("Xóa thông tin nhân viên thành công!");
                        }
                        else{
                            alert("Xóa thông tin nhân viên thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin nhân viên thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin nhân viên thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin nhân viên thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa bệnh nhân

        //mở form để sửa
        $('#tbl_nv').on('click','button[data-button="sua"]',function(){
            $('#btnthemarea').fadeOut(800);
            $('#btnlamlaiarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN NHÂN VIÊN');

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_nhan_su/lay_tt_cap_nhat',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    // Success
                    if(data.msg =='tc'){
                        $('#email').val(data.email);$('#trinhdo').val(data.trinhdo);$('#chuyenmon').val(data.chuyenmon);$('#loainv').val(data.loainv);$('#hdtn').val(data.hdtn);$('#hddn').val(data.hddn);$('#congviec').val(data.congviec);$('#phonglv').val(data.phonglv);$('#bl').val(data.bl);$('#stk').val(data.stk);$('#dschucvu').html(data.cv);

                        $('#hoten').val(data.hoten);$('#ns').val(data.ngaysinh);$('#gt').val(data.gt);$('#dantoc').val(data.dantoc);$('#scmnd').val(data.scmnd);$('#sdt').val(data.sdt);$('#diachi').val(data.diachi);$('#tinh').val(data.idtinh);$('#huyen').html(data.h);$('#huyen').val(data.idhuyen);$('#xa').html(data.x);$('#xa').val(data.idxa);

                        themnv=true;
                        $('#bl').removeAttr('readonly');
                        $('#formnv').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formnv").offset().top
                        }, 800);
                    }
                    else{
                        alert("Lấy dữ liệu thất bại. Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy dữ liệu thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy dữ liệu thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy dữ liệu thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end mở form để sửa

        //tìm kiếm
        $('#btntimkiem').click(function (){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            if($('#txttimkiem').val().toString().trim() == ''){
                alert('Vui lòng nhập thông tin tìm kiếm!');
                return false;
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('keyWords', $('#txttimkiem').val());

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_nhan_su/tim_kiem',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    // Success
                    if(data.msg != 'tc'){
                        alert("Tìm kiếm gặp phải lỗi! Mô tả: "+data.msg);
                    }else{
                        if(data.sl > 0){
                            soluongtk=data.sl;
                            var ttnv='';
                            for(var i=0; i<data.nhanvien.length; ++i){
                                var anh='';
                                if(data.nhanvien[i].anh == null){
                                    anh='Chưa cập nhật!';
                                }
                                else{
                                    anh='<img class="avatar" src="public/upload/anhnv/'+data.nhanvien[i].anh+'" alt="Ảnh nhân viên" style="height: 45px; width: 45px">';
                                }
                                
                                ttnv+='\n\
                                        <tr class="tr-shadow">\n\
                                            <td style="vertical-align: middle;">\n\
                                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                    <input type="checkbox" data-input="check" data-id="'+data.nhanvien[i].id+'" data-name="'+data.nhanvien[i].hoten+'">\n\
                                                    <span class="au-checkmark"></span>\n\
                                                </label>\n\
                                            </td>\n\
                                            <td>'+data.nhanvien[i].hoten+'</td>\n\
                                            <td>'+data.nhanvien[i].ngaysinh+'</td>\n\
                                            <td>'+data.nhanvien[i].gt+'</td>\n\
                                            <td>'+data.nhanvien[i].sdt+'</td>\n\
                                            <td>'+data.nhanvien[i].email+'</td>\n\
                                            <td>'+data.nhanvien[i].trinhdo+'</td>\n\
                                            <td>'+data.nhanvien[i].chuyenmon+'</td>\n\
                                            <td>'+data.nhanvien[i].ngayvaolam+'</td>\n\
                                            <td>'+data.nhanvien[i].phong+'</td>\n\
                                            <td>'+data.nhanvien[i].loainv+'</td>\n\
                                            <td style="width: 100px ;">'+anh+'</td>\n\
                                            <td>\n\
                                                <div class="table-data-feature">\n\
                                                    <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.nhanvien[i].id+'">\n\
                                                        <i class="zmdi zmdi-edit"></i>\n\
                                                    </button>\n\
                                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.nhanvien[i].id+'" data-name="'+data.nhanvien[i].hoten+'">\n\
                                                        <i class="zmdi zmdi-delete"></i>\n\
                                                    </button>\n\
                                                </div>\n\
                                            </td>\n\
                                        </tr>\n\
                                    <tr class="spacer"></tr>';
                            }

                            $('#tbl_nv').html(ttnv);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);

                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" nhân viên được tìm thấy!");
//                            $('#btnlocds').tooltip('hide').attr('data-original-title', 'Lọc danh sách tìm kiếm').tooltip('fixTitle').tooltip('show');
                        }
                        else{
                            $('#tbl_nv').html("");
                            $('#kqtimliem').text("Không có nhân viên nào được tìm thấy!");tk=false;
                        }
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Tìm kiếm thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Tìm kiếm thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Tìm kiếm thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end tìm kiếm

        //Nạp lại danh sách
        $('#btnnapds').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_nhan_su/lay_ds_nv',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    // Success
                    if(data.msg != 'tc'){
                        alert("Lỗi khi tải danh sách nhân viên! Mô tả: "+data.msg);
                    }else{
                        var ttnv='';
                        for(var i=0; i<data.nhanvien.length; ++i){
                            var anh='';
                            if(data.nhanvien[i].anh == null){
                                anh='Chưa cập nhật!';
                            }
                            else{
                                anh='<img class="avatar" src="public/upload/anhnv/'+data.nhanvien[i].anh+'" alt="Ảnh nhân viên" style="height: 45px; width: 45px">';
                            }

                            ttnv+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.nhanvien[i].id+'" data-name="'+data.nhanvien[i].hoten+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td>'+data.nhanvien[i].hoten+'</td>\n\
                                        <td>'+data.nhanvien[i].ngaysinh+'</td>\n\
                                        <td>'+data.nhanvien[i].gt+'</td>\n\
                                        <td>'+data.nhanvien[i].sdt+'</td>\n\
                                        <td>'+data.nhanvien[i].email+'</td>\n\
                                        <td>'+data.nhanvien[i].trinhdo+'</td>\n\
                                        <td>'+data.nhanvien[i].chuyenmon+'</td>\n\
                                        <td>'+data.nhanvien[i].ngayvaolam+'</td>\n\
                                        <td>'+data.nhanvien[i].phong+'</td>\n\
                                        <td>'+data.nhanvien[i].loainv+'</td>\n\
                                        <td style="width: 100px ;">'+anh+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.nhanvien[i].id+'">\n\
                                                    <i class="zmdi zmdi-edit"></i>\n\
                                                </button>\n\
                                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.nhanvien[i].id+'" data-name="'+data.nhanvien[i].hoten+'">\n\
                                                    <i class="zmdi zmdi-delete"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                <tr class="spacer"></tr>';
                        }

                        $('#tbl_nv').html(ttnv);
                        $('#tbl_nv button[data-id]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);

                        tk=false;locds=false;keySearch='';
                        $('#kqtimliem').text("");
//                        $('#btnlocds').tooltip('hide').attr('data-original-title', 'Lọc danh sách').tooltip('fixTitle').tooltip('show');

                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Tải danh sách thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Tải danh sách thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Tải danh sách thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Nạp lại danh sách

        //reset input
        $('#btnlamlai').click(function(){
            $('#email').val('');$('#chuyenmon').val('');$('#loainv').val(0);$('#bl').val('');$('#bl').attr('readonly','');$('#stk').val('');$('#dschucvu').html('');
            $('#hoten').val("");$('#scmnd').val("");$('#sdt').val("");$('#diachi').val("");
            var d=new Date();
            var s = (d.getDate() < 10 ? '0'+d.getDate() : d.getDate())+"/"+((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1))+"/"+d.getFullYear()+" ";
            $('#ns').val(s);$('#hdtn').val(s);$('#hddn').val(s);
            themnv=true;
        });
        //end

        //nhấn enter tìm kiếm
        $("#ftimkiem").keypress(function(e) {
              var key = e.charCode || e.keyCode || 0;
              if (key == 13) {
                e.preventDefault();
                $('#btntimkiem').click();
              }
        });
        //end

        //click check sum
        $('body').on('change', 'input[data-input="checksum"]', function(){
            if($(this).prop("checked")){
                $('input[data-input="check"]').prop("checked",true);
            }
            else{
                $('input[data-input="check"]').prop("checked",false);
            }
        });
        //end

        //click check
        $('#tbl_nv').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksum"]').prop("checked",false);
            }
            else{
                if($('input[data-input="check"]:checked').length == $('input[data-input="check"]').length){
                    $('input[data-input="checksum"]').prop("checked",true);
                }
            }
        });
        //end

        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if(!$('input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn nhân viên để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[];
                $('input[data-input="check"]').each(function(){
                    if($(this).is(":checked")){
                        $.each(this.attributes, function() {
                            if (this.name.indexOf('data-id') == 0) {
                                arr.push(this.value);
                            }
                            if (this.name.indexOf('data-name') == 0) {
                                arr_name.push(this.value);
                            }
                        });
                    }
                });

                if(arr_name.length > 1){
                    for (var i = 0; i < arr_name.length; i++) {
                        name+=arr_name[i];
                        if(i == arr_name.length - 2){
                            name+=' và ';
                        }
                        else if(i < arr_name.length - 2)
                        {
                            name+=', ';
                        }
                    }
                }
                else
                {
                    name=arr_name[0];
                }
                var cf;
                if(arr_name.length > 1){
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của các nhân viên "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của nhân viên "+name+"?");
                }
                if(cf==true){
                    for (var i = 0; i < arr.length; i++) {
                        if($('#btnsuaarea').css('display') == 'block' && arr[i]== $('#btncapnhat').attr('data-id')){//đóng form sửa khi click xóa
                           $('#btndong').click();
                           break;
                        }
                    }
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/hanh_chinh/quan_ly_nhan_su/xoa',
                        xhr: function() {
                            var myXhr = $.ajaxSettings.xhr();
                            return myXhr;
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(data) {
                            // Success
                            if(data.msg == 'tc'){
                                if(arr.length > 1){
                                    if(locds == true){
                                        soluongl = soluongl - arr.length;
                                        if(soluongl == 0)
                                        {
                                            $('#kqtimliem').text("");
                                        }
                                        else
                                        {
                                            $('#kqtimliem').text("Có "+soluongl+" nhân viên được tìm thấy!");
                                        }
                                    }
                                    else{
                                        if(tk == true){
                                            soluongtk = soluongtk - arr.length;
                                            if(soluongtk == 0)
                                            {
                                                $('#kqtimliem').text("");
                                            }
                                            else
                                            {
                                                $('#kqtimliem').text("Có "+soluongtk+" nhân viên được tìm thấy!");
                                            }
                                        }
                                    }
                                    if($('#tbl_nv').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các nhân viên thành công!");
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" nhân viên được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" nhân viên được tìm thấy!");
                                        }
                                    }
                                    if($('#tbl_nv').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin nhân viên thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các nhân viên thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin nhân viên thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các nhân viên thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các nhân viên thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các nhân viên thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin nhân viên thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin nhân viên thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin nhân viên thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }

            }
        });
        //end

        $("input[type='number']").on("keypress", function (evt) {
            if (evt.which < 48 || evt.which > 57)
            {
                evt.preventDefault();
            }
        });

        $('#scmnd').on('keypress', function (e){
            if($(this).val().toString().length == 9){
                e.preventDefault();
            }
        });
        
        $('#bl').on('keypress', function (e){
            if($(this).val().toString().length == 1){
                e.preventDefault();
            }

            if (e.which < 49 || e.which > 57)
            {
                e.preventDefault();
            }
        });

        $('#sdt').on('keypress', function (e){
            if($(this).val().toString().length == 10){
                e.preventDefault();
            }
        });
        
        $('#stk').on('keypress', function (e){
            if($(this).val().toString().length == 13){
                e.preventDefault();
            }
        });

    });
    </script>
@endsection