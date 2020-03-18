@extends('ke_toan.layout')

@section('title')
    {{ "Hóa đơn dịch vụ" }}
@endsection

@section('css')
<style type="text/css">
    .padding_adjust_td tr td {
        padding: 5px; padding-top: 2px; padding-bottom: 2px;
    }
    textarea {
       resize: none;
    }
</style>
@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
        <!-- LẬP HÓA ĐƠN-->
        <section class="p-t-20 " id="formba">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" m-b-35">
                            <h3 class="title-5 font-weight-bold text-green" id="formtitle">LẬP HÓA ĐƠN DỊCH VỤ</h3>
                            <hr class="line-seprate">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row m-b-15 hidden formba">
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Họ tên bệnh nhân</label>
                                                        <input type="text" readonly="" class="form-control" id="hoten"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ngày sinh</label>
                                                        <input type="text" readonly="" class="form-control" id="ngaysinh">
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Giới tính</label>
                                                        <input type="text" readonly="" class="form-control" id="gt">
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Dân tộc</label>
                                                        <input type="text" readonly="" class="form-control" id="dantoc">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Số CMND</label>
                                                        <input type="text" readonly="" class="form-control" id="scmnd">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Địa chỉ</label>
                                                        <input type="text" readonly="" class="form-control " id="diachi">
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 text-center">
                                                    <div class="form-group" style="padding-top: 15px;">
                                                        <img class="avatar hidden anhbn" alt="Ảnh bệnh nhân">
                                                        <p class="anhbn">Ảnh bệnh nhân</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15 hidden thearea">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Mã thẻ BHYT</label>
                                                        <input type="tel" readonly="" class="form-control" id="mathe">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ngày đăng ký BHYT</label>
                                                        <input type="text" readonly="" class="form-control" id="ngaydk">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ngày hết hạn BHYT</label>
                                                        <input type="text" readonly="" class="form-control" id="ngayhh">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Nơi đăng ký KCBBĐ</label>
                                                        <input type="text" readonly="" class="form-control" id="noidkkcbbd">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15 hidden thearea">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Đối tượng BHYT</label>
                                                        <input type="text" readonly="" class="form-control" id="doituong">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">M.hưởng</label>
                                                        <input type="text" readonly="" class="form-control" id="mh">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tuyến</label>
                                                        <input type="text" readonly="" class="form-control" id="tuyen">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2" >
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Chuyển đến từ</label>
                                                        <input type="text" readonly="" class="form-control" id="chuyentu">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Giấy chuyển</label>
                                                        <input type="text" readonly="" class="form-control" id="giaychuyen">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15 hidden formba">
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Hình thức điều trị</label>
                                                        <input type="text" class="form-control" readonly="" id="htdt">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Đối tượng tiếp nhận</label>
                                                        <input type="text" readonly="" class="form-control" id="doituongtn">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Hình thức thanh toán</label>
                                                        <select class="form-control" id="httt">
                                                            <option value="0">Tiền mặt</option>
                                                            <option value="1">Thanh toán bằng thẻ tín dụng</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Nhập họ tên bệnh nhân..." class="form-control" id="bn" list="dsbn"/>
                                                        <datalist id="dsbn">
                                                            @if(isset($dsbn))
                                                                @foreach($dsbn as $bn)
                                                                <option value="{{$bn->IdBN}}" data-value="{{$bn->IdBN}}">{{$bn->HoTen}}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </div>
                                                </div>
                                                @if($nd->Quyen != 'admin')
                                                <div class="col-lg-1 hidden" id="btnthemarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" rel="tooltip" title="Lập hóa đơn dịch vụ" id="btnthem" data-toggle="modal" data-target="#modalhd"><span class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-lg-1 hidden" id="btnxempkkarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--showdetail au-btn--small au-btn-shadow height-43px" data-toggle="modal" data-target="#modalkkvp" rel="tooltip" title="Xem phiếu kê khai viện phí" id="btnxempkk"><span class="zmdi zmdi-eye"></span></button>
                                                    </div>
                                                </div>
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
        <!-- END LẬP HÓA ĐƠN-->
        
        <!-- DATA TABLE-->
        <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" m-b-35">
                                <h3 class="title-5 font-weight-bold text-green">DANH SÁCH HÓA ĐƠN DỊCH VỤ - KT. {{mb_convert_case($nd->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8')}}</h3>
                                <hr class="line-seprate">
                            </div>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="au-breadcrumb-content">
                                        <form class="au-form-icon--sm" id="ftimkiem" >
                                            <input type="text" class="au-input--w300 au-input--style2" id="txttimkiem" placeholder="Nhập thông tin cần tìm...">
                                            <button type="button" class="au-btn--submit2" data-toggle="tooltip" title="Tìm kiếm" id="btntimkiem">
                                                <i class="zmdi zmdi-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-data__tool-right">
                                    <div class="row">
                                        <div class="col-lg-4 m-b-15">
                                            <button type="button"  class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="fa fa-file-text"></i></button>
                                        </div>
                                        <div class="col-lg-4 m-b-15">
                                            <button type="button" class="au-btn au-btn--teal au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Nạp lại danh sách" id="btnnapds"><i class="zmdi zmdi-refresh"></i></button>
                                        </div>
                                        <div class="col-lg-4 m-b-15">
                                            <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatc"><i class="zmdi zmdi-delete"></i></button>
                                        </div>
                                    </div>
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
                                            <th style="position: sticky; top: 0; z-index: 99;">bệnh nhân</th>
                                            <th>Đối tượng tiếp nhận</th>
                                            <th>hình thức điều trị</th>
                                            <th>Bác sĩ Điều trị</th>
                                            <th>Ngày lập hóa đơn</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_hd">
                                        @if(isset($dshdngoai))
                                        @foreach($dshdngoai as $hd)
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $hd->IdHDDVNgoai }}" data-name="<?php echo $hd->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$hd->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                <td>
                                                    @if($hd->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                    BHYT
                                                    @else
                                                    Thu phí
                                                    @endif
                                                </td>
                                                <td>Ngoại trú</td>
                                                <td>{{$hd->benhAnNgoaiTru->nhanVien->TenNV}}</td>
                                                <td>
                                                    {{\comm_functions::deDateFormat($hd->created_at)}}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modalkkvp" data-button="btnxempkk" data-id="{{$hd->benhAnNgoaiTru->IdBANgoaiT}}" rel="tooltip" title="Xem phiếu kê khai viện phí" data-loaiba="ngoai">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modalhd" data-button="btnxemhd" data-id="{{$hd->benhAnNgoaiTru->IdBANgoaiT}}" rel="tooltip" title="Xem nội dung hóa đơn" data-loaiba="ngoai">
                                                            <i class="fa fa-file-text"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$hd->IdHDDVNgoai}}" data-name="{{$hd->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                            <i class="zmdi zmdi-delete"  ></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @endforeach
                                        @endif
                                        
                                        @if(isset($dshdnoi))
                                        @foreach($dshdnoi as $hd)
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $hd->IdHDDVNoi }}" data-name="<?php echo $hd->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$hd->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                <td>
                                                    @if($hd->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                    BHYT
                                                    @else
                                                    Thu phí
                                                    @endif
                                                </td>
                                                <td>Nội trú</td>
                                                <td>{{$hd->benhAnNoiTru->nhanVien->TenNV}}</td>
                                                <td>
                                                    {{\comm_functions::deDateFormat($hd->created_at)}}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modalkkvp" data-button="btnxempkk" data-id="{{$hd->benhAnNoiTru->IdBANoiT}}" rel="tooltip" title="Xem phiếu kê khai viện phí" data-loaiba="noi">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modalhd" data-button="btnxemhd" data-id="{{$hd->benhAnNoiTru->IdBANoiT}}" rel="tooltip" title="Xem nội dung hóa đơn" data-loaiba="noi">
                                                            <i class="fa fa-file-text"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$hd->IdHDDVNoi}}" data-name="{{$hd->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                            <i class="zmdi zmdi-delete"  ></i>
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
        
        <!--MODAL XEM CHI TIẾT VIỆN PHÍ-->
        <div class="modal fade" id="modalkkvp" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaltitle">Chi tiết phiếu kê khai viện phí khám, chữa bệnh nội trú</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500" style="font-family: 'Noto Serif'; font-size: 7pt;">
                        <div class="row">
                            <div style="width: 45px !important;"></div>
                            <div class="col-lg-10" id="print_content_vp">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="font-size: 9pt;">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Tổng chi phí đợt điều trị</label>
                                                        <input type="text" class="form-control" readonly="" id="tongphi">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Số tiền BHYT thanh toán</label>
                                                        <input type="text" readonly="" class="form-control" id="tongbh">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Số tiền bệnh nhân trả</label>
                                                        <input type="text" readonly="" class="form-control" id="tongbn">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Nguồn khác</label>
                                                        <input type="text" readonly="" class="form-control" id="tongnk">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="font-size: 8pt;">
                            <div class="col-lg-12">
                                <div class="row hidden" id="dtbiareapkk">
                                    <div class="col-lg-12">
                                        <label style="font-weight: normal" id="dtbipkk">Đang tạo bản in!</label>
                                    </div>
                                </div>
                                <div class='row hidden' id="proccesspkk">
                                    <div class='col-lg-12'>

                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                <span style="font-size: 8pt;">Vui lòng chờ<span class="dotdotdot"></span></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL XEM CHI TIẾT VIỆN PHÍ-->
        
        <!--MODAL HÓA ĐƠN-->
        <div class="modal fade" id="modalhd" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lgest" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Lập hóa đơn dịch vụ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row fit_table_height_400 hidden" id="hdarea" style="font-family: Verdana; font-size: 8pt; color: #0b6542">
                            <div style="width: 130px !important;"></div>
                            <div class="col-lg-10">
                                <div class="card" style="font-weight: normal; height: 550px; width: 750px !important;">
                                    <div class="card-block card-body printcontent_hd" style="height: 550px; width: 750px !important; font-weight: 800; background: #f9d6d5">
                                        <div class="row m-b-5" style="font-size: 7pt;">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-4 text-center" style="margin: 0; margin-top: 8px; padding: 0;">
                                                        <label><img src="public/images/logo3.png" style="height: 60px;"></label>
                                                    </div>
                                                    <div class="col-lg-8" style="margin: 0; padding: 0;">
                                                        <label style="margin-bottom: 0;">BỆNH VIỆN ĐA KHOA TRUNG TÂM AN GIANG</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">Mã số thuế:</label> <label style="margin-bottom: 0;">1 6 0 0 2 5 8 4 0 4</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">Địa chỉ: Số 60 Ung Văn Khiêm, Mỹ Phước, Thành phố Long Xuyên, An Giang</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">Điện thoại: 3852989 – 3852862</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">Số tài khoản: 3712.2.1015942</label><br>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 text-center" style="padding: 0">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                         <label style="margin-bottom: 0; font-size: 12pt">HÓA ĐƠN BÁN HÀNG</label><br>
                                                         <label style="margin-bottom: 0; font-size: 8pt">(DỊCH VỤ KHÁM CHỮA BỆNH THEO KHUNG GIÁ)</label><br>
                                                         <label style="margin-bottom: 0; font-size: 8pt">Liên 2: Giao người mua</label><br>
                                                         <label style="margin-bottom: 0; font-weight: normal; font-size: 8pt" class="ngaylap"></label>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" style="padding: 0">
                                                <label style="margin-bottom: 0; font-weight: normal">Mẫu số:</label> <label style="margin-bottom: 0;">02GTTT2/001</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">Ký hiệu:</label> <label style="margin-bottom: 0;">AA/18P</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">Số:</label> <label style="margin-bottom: 0;" class="sthd">......................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <hr class="line-seprate" style="margin-top: 10px; background: #0b6542;">
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Họ tên người mua hàng:</label> <label style="margin-bottom: 0; font-size: 10pt;" class="hd_hoten"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Tên đơn vị:</label> <label style="margin-bottom: 0;">......................................................................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Địa chỉ:</label> <label style="margin-bottom: 0;" class="hd_dc"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Mã số thuế:</label> <label style="margin-bottom: 0; font-weight: normal">.....................................................................</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Đối tượng bệnh nhân:</label> <label style="margin-bottom: 0;" class="hd_dttn"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Hình thức thanh toán:</label> <label style="margin-bottom: 0;" class="hd_httt"></label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Số tài khoản:</label> <label style="margin-bottom: 0;">...................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered" style="color: #0b6542; font-size: 8pt; border-color: #0b6542 !important">
                                                    <thead style="vertical-align: middle;">
                                                        <tr>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">STT</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">Tên hàng hóa, dịch vụ</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">Đơn vị tính</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">Số lượng</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">Đơn giá</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px; width:100px;" class="text-center">Thành tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="padding_adjust_td">
                                                        <tr class="text-center">
                                                            <td>1</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                            <td>5</td>
                                                            <td>6 = 4 x 5</td>
                                                        </tr>
                                                        <tr class="hd_nd text-center">
                                                           
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Cộng tiền bán hàng hóa, dịch vụ:</label> <label style="margin-bottom: 0;" class="hd_tt"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <hr class="line-seprate" style="margin-top: 10px; background: #0b6542;">
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0">Người mua hàng</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal;font-style: italic">(Ký, ghi rõ họ tên)</label><br>
                                                <label style="margin-bottom: 0;" class="hd_bn"></label>
                                            </div>
                                            <div class="col-lg-3 text-left">
                                                <label style="margin-bottom: 0;font-weight: normal;">Bệnh nhân chi trả:</label> <label style="margin-bottom: 0;font-weight: normal;" class="hd_bnct"></label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">% BHYT:</label> <label style="margin-bottom: 0;font-weight: normal;" class="hd_bhyt"></label>
                                            </div>
                                            <div class="col-lg-2 text-left">
                                                <label style="margin-bottom: 0;font-weight: normal;">Tạm ứng:</label> <label style="margin-bottom: 0;font-weight: normal;" class="hd_tu"></label>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-bottom: 0">Người bán hàng</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal;font-style: italic">(Ký,đóng dấu, ghi rõ họ tên)</label><br>
                                                <label style="margin-bottom: 0;" class="hd_nv"></label><br>
                                                <label style="margin-bottom: 0; font-weight: normal;" class="hd_ngayin"></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-block card-body printcontent_hd" style="height: 550px; width: 750px !important; font-weight: 800; background: #BEE9EA">
                                        <div class="row m-b-5" style="font-size: 7pt;">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-4 text-center" style="margin: 0; margin-top: 8px; padding: 0;">
                                                        <label><img src="public/images/logo3.png" style="height: 60px;"></label>
                                                    </div>
                                                    <div class="col-lg-8" style="margin: 0; padding: 0;">
                                                        <label style="margin-bottom: 0;">BỆNH VIỆN ĐA KHOA TRUNG TÂM AN GIANG</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">Mã số thuế:</label> <label style="margin-bottom: 0;">1 6 0 0 2 5 8 4 0 4</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">Địa chỉ: Số 60 Ung Văn Khiêm, Mỹ Phước, Thành phố Long Xuyên, An Giang</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">Điện thoại: 3852989 – 3852862</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">Số tài khoản: 3712.2.1015942</label><br>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 text-center" style="padding: 0">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                         <label style="margin-bottom: 0; font-size: 12pt">HÓA ĐƠN BÁN HÀNG</label><br>
                                                         <label style="margin-bottom: 0; font-size: 8pt">(DỊCH VỤ KHÁM CHỮA BỆNH THEO KHUNG GIÁ)</label><br>
                                                         <label style="margin-bottom: 0; font-size: 8pt">Liên 1: Giao Bệnh viện</label><br>
                                                         <label style="margin-bottom: 0; font-weight: normal; font-size: 8pt" class="ngaylap"></label>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" style="padding: 0">
                                                <label style="margin-bottom: 0; font-weight: normal">Mẫu số:</label> <label style="margin-bottom: 0;">02GTTT2/001</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">Ký hiệu:</label> <label style="margin-bottom: 0;">AA/18P</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">Số:</label> <label style="margin-bottom: 0;" class="sthd">......................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <hr class="line-seprate" style="margin-top: 10px; background: #0b6542;">
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Họ tên người mua hàng:</label> <label style="margin-bottom: 0; font-size: 10pt;" class="hd_hoten"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Tên đơn vị:</label> <label style="margin-bottom: 0;">......................................................................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Địa chỉ:</label> <label style="margin-bottom: 0;" class="hd_dc"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Mã số thuế:</label> <label style="margin-bottom: 0; font-weight: normal">.....................................................................</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Đối tượng bệnh nhân:</label> <label style="margin-bottom: 0;" class="hd_dttn"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Hình thức thanh toán:</label> <label style="margin-bottom: 0;" class="hd_httt"></label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Số tài khoản:</label> <label style="margin-bottom: 0;">...................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered" style="color: #0b6542; font-size: 8pt; border-color: #0b6542 !important">
                                                    <thead style="vertical-align: middle;">
                                                        <tr>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">STT</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">Tên hàng hóa, dịch vụ</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">Đơn vị tính</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">Số lượng</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px;" class="text-center">Đơn giá</th>
                                                            <th style="padding: 5px; padding-top: 2px; padding-bottom: 2px; width:100px;" class="text-center">Thành tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="padding_adjust_td">
                                                        <tr class="text-center">
                                                            <td>1</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                            <td>5</td>
                                                            <td>6 = 4 x 5</td>
                                                        </tr>
                                                        <tr class="hd_nd text-center">
                                                           
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Cộng tiền bán hàng hóa, dịch vụ:</label> <label style="margin-bottom: 0;" class="hd_tt"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <hr class="line-seprate" style="margin-top: 10px; background: #0b6542;">
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0">Người mua hàng</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal;font-style: italic">(Ký, ghi rõ họ tên)</label><br>
                                                <label style="margin-bottom: 0;" class="hd_bn"></label>
                                            </div>
                                            <div class="col-lg-3 text-left">
                                                <label style="margin-bottom: 0;font-weight: normal;">Bệnh nhân chi trả:</label> <label style="margin-bottom: 0;font-weight: normal;" class="hd_bnct"></label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">% BHYT:</label> <label style="margin-bottom: 0;font-weight: normal;" class="hd_bhyt"></label>
                                            </div>
                                            <div class="col-lg-2 text-left">
                                                <label style="margin-bottom: 0;font-weight: normal;">Tạm ứng:</label> <label style="margin-bottom: 0;font-weight: normal;" class="hd_tu"></label>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-bottom: 0">Người bán hàng</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal;font-style: italic">(Ký,đóng dấu, ghi rõ họ tên)</label><br>
                                                <label style="margin-bottom: 0;" class="hd_nv"></label><br>
                                                <label style="margin-bottom: 0; font-weight: normal;" class="hd_ngayin"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="font-size: 10pt;">
                            <div class="col-lg-12">
                                <div class="row hidden" id="dtbiareahd">
                                    <div class="col-lg-12">
                                        <label style="font-weight: normal" id="dtbihd">Đang xử lý!</label>
                                    </div>
                                </div>
                                <div class='row hidden' id="proccesshd">
                                    <div class='col-lg-12'>

                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                <span style="font-size: 8pt;">Vui lòng chờ<span class="dotdotdot"></span></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="font-size: 11pt;">
                                    <div class="card-body card-block">
                                        <form>
                                            @if($nd->Quyen != 'admin')
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--print au-btn--small au-btn-shadow height-40px" rel="tooltip" title="In hóa đơn" id="btninhd"><span class="zmdi zmdi-print"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row" style="font-size: 10pt;">
                                                <div class="col-lg-12">
                                                    <div class="row hidden" id="dtbiareahd">
                                                        <div class="col-lg-12">
                                                            <label style="font-weight: normal" id="dtbihd">Đang tạo bản in!</label>
                                                        </div>
                                                    </div>
                                                    <div class='row hidden' id="proccesshd">
                                                        <div class='col-lg-12'>

                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                    <span style="font-size: 8pt;">Vui lòng chờ<span class="dotdotdot"></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
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
        </div>
        <!--END MODAL HÓA ĐƠN-->
    </div>
@endsection
@section('js')
<script src="public/js/pusher.js"></script>
<script src="public/js/jspdf.debug.js"></script>
<script src="public/js/html2canvas.js"></script>
<script>
    $(function () {
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false, htbn=false, bnddd=false, themba=false, flagcls=false, flagtt=false, file_name_tt='', tstrangtt = 1;
        
        //print
        var element_section,HTML_Width,HTML_Height,top_left_margin,PDF_Width,PDF_Height;
        function calculatePDF_height_width(selector,index){
            element_section = $(selector).eq(index);
            HTML_Width = element_section.width();
            HTML_Height= element_section.height();
            top_left_margin = 1;
            PDF_Width = HTML_Width + (top_left_margin * 2);
            PDF_Height = HTML_Height + (top_left_margin * 2);
	}
        
        var showTooltip = function () {
            $(this).tooltip('show');
        }
        , hideTooltip = function () {
            $(this).tooltip('hide');
        };
        
        $('[rel="tooltip"]').tooltip({
            trigger: 'manual'
        })
        .focus(hideTooltip)
        .blur(hideTooltip)
        .hover(showTooltip, hideTooltip);

        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'manual'
        })
        .focus(hideTooltip)
        .blur(hideTooltip)
        .hover(showTooltip, hideTooltip);

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
        
        var channelnhantb = pusher.subscribe('DVB');
        
        function nhantbbc(data) {
            if(data.thaotac == 'duyet'){
                if(data.dvb.idnv == $('#id_nv').val()){
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
            else if(data.thaotac == 'xoa'){ 
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
            }
        }

        channelnhantb.bind('App\\Events\\HanhChinh\\DVB', nhantbbc);
        
        var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
        
        $('input[list="dsbn"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue || option.value === inputValue) {
                    input.value=option.innerText;
                    var formData = new FormData();
                    var id=option.getAttribute('data-value');
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', id);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/ke_toan/hoa_don_dv/lay_tt',
                        xhr: function() {
                            var myXhr = $.ajaxSettings.xhr();
                            return myXhr;
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(data) {
                            if(data.msg == 'tc')
                            {
                                // Success
                                $('#hoten').val(data.hotenbn);$('#ngaysinh').val(data.ngaysinh);$('#gt').val(data.gt);$('#dantoc').val(data.dantoc);$('#scmnd').val(data.socmnd);$('#diachi').val(data.diachi);
                                $('#htdt').val(data.htdt);
                                $('#doituongtn').val(data.dttn);
                                if(data.anh != null && data.anh !='' && data.anh != 'null')
                                {
                                    $('p[class*="anhbn"]').addClass('hidden');$('img[class*="anhbn"]').attr('src','public/upload/anhbn/'+data.anh);$('img[class*="anhbn"]').removeClass('hidden');
                                }
                                else
                                {
                                    $('p[class*="anhbn"]').removeClass('hidden');$('img[class*="anhbn"]').addClass('hidden');
                                }   

                                if(data.htk == 'bhyt'){
                                    if(data.mathe != 'koco')
                                    {
                                        $('#tuyen').val(data.tuyen);$('#chuyentu').val(data.chuyentu);$('#giaychuyen').val(data.giaychuyen);
                                        $('#mathe').val(data.mathe);$('#ngaydk').val(data.ngaydk);$('#ngayhh').val(data.ngayhh);$('#noidkkcbbd').val(data.noidk);$('#doituong').val(data.doituong);$('#mh').val(data.mh);
                                        $('[class*="thearea"]').removeClass('hidden');
                                    }
                                    else
                                    {
                                        $('[class*="thearea"]').addClass('hidden');
                                    }
                                }
                                
                                $('[class*="formba"]').removeClass('hidden');
                                
                                $('#btnxempkk').attr('data-id', data.id);
                                $('#btnxempkk').attr('data-loaiba', data.loaiba);
                                $('#btnxempkkarea').removeClass('hidden');
                                $('#btnthemarea').removeClass('hidden');
                                $('#btnthem').attr('data-id', data.id);
                                $('#btnthem').attr('data-loaiba', data.loaiba);
                            }
                            else if(data.msg=='ktt'){
                                $('[class*="thearea"]').addClass('hidden');
                                $('[class*="formba"]').addClass('hidden');
                                $('#btnxempkkarea').addClass('hidden');
                                $('#btnthemarea').addClass('hidden');
                            }
                            else{
                                $('[class*="thearea"]').addClass('hidden');
                                $('[class*="formba"]').addClass('hidden');
                                $('#btnxempkkarea').addClass('hidden');
                                $('#btnthemarea').addClass('hidden');
                                alert("Lấy dữ liệu thất bại. Lỗi: "+data.msg);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('[class*="thearea"]').addClass('hidden');
                            $('[class*="formba"]').addClass('hidden');
                            $('#btnxempkkarea').addClass('hidden');
                            $('#btnthemarea').addClass('hidden');
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
                    break;
                }
                else{
                    $('[class*="thearea"]').addClass('hidden');
                    $('[class*="formba"]').addClass('hidden');
                    $('#btnxempkkarea').addClass('hidden');
                    $('#btnthemarea').addClass('hidden');
                }  
            }
        });
        
        function genPDFHD(data1, data2) { 
            var deferreds = [];
            for (let i = 0; i < 2; i++) {
                var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvasHD(i, deferred, data1, data2);
            }
            $.when.apply($, deferreds).then(function () { 
                $('#dtbihd').text('Đã tạo xong!');
                $('#proccesshd').addClass('hidden');
            });
        }

        function generateCanvasHD(i, deferred, data1, data2){
            html2canvas($("div[class*='printcontent_hd']:eq('"+i+"')")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent_hd']",i);
                var pdf = new jsPDF('l','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.autoPrint({variant: 'non-conform'});
                if(i == 1){
                    pdf.save(data2+'.pdf');
                }
                else{
                    pdf.save(data1+'.pdf');
                }
                deferred.resolve();
             });
        }
        
        $('#btnxempkk').click(function(e, maba, loaibenhan){
            
            var id=$(this).attr('data-id');
            var loaiba=$(this).attr('data-loaiba');
            if(!$.isEmptyObject(maba)){
                id=maba;
                loaiba=loaibenhan;
            }
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', id);
            var url='/qlkcb/kham_va_dieu_tri/phieu_ke_khai_vp/in_noi';
            if(loaiba.toString() == 'ngoai'){
                url='/qlkcb/kham_va_dieu_tri/phieu_ke_khai_vp/in';
                $('#modaltitle').text('Chi tiết phiếu kê khai viện phí khám, chữa bệnh ngoại trú');
            }
            else{
                $('#modaltitle').text('Chi tiết phiếu kê khai viện phí khám, chữa bệnh nội trú');
            }
            $('#print_content_vp').html('');
            $('#tongnk').val(0);$('#tongphi').val(0);$('#tongbh').val(0);$('#tongbn').val(0);
            $('#dtbiareapkk').removeClass('hidden');$('#dtbipkk').text('Đang tải dữ liệu!');
            $('#proccesspkk').removeClass('hidden');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: url,
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
                        if(loaiba == 'ngoai'){
                            $.when(prepare_content_to_print_pkk_ngoai(data.data, data.bn)).done(function(){
                                $('#dtbipkk').text('Đã tải xong!');
                                $('#proccesspkk').addClass('hidden');
                            });
                        }
                        else{
                            $.when(prepare_content_to_print_pkk_noi(data.data, data.bn)).done(function(){
                                $('#dtbipkk').text('Đã tải xong!');
                                $('#proccesspkk').addClass('hidden');
                            });
                        }
                    }
                    else if(data.msg == 'ktt'){
                        $('#dtbiareapkk').addClass('hidden');$('#proccesspkk').addClass('hidden');
                        alert('Bệnh án của bệnh nhân này không tồn tại, có thể đã bị xóa!');
                    }
                    else{
                        $('#dtbiareapkk').addClass('hidden');$('#proccesspkk').addClass('hidden');
                        alert("Tải dữ liệu thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareapkk').addClass('hidden');$('#proccesspkk').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Tải dữ liệu thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Tải dữ liệu thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Tải dữ liệu thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }     
                }
            });
            
        });
        
        $('#tbl_hd').on('click','button[data-button="btnxempkk"]',function(){
            var maba=$(this).attr('data-id');
            var loaibenhan=$(this).attr('data-loaiba');
            $('#btnxempkk').trigger('click', [maba, loaibenhan]);
        });
        
        $('#btnthem').click(function(e, maba, loaibenhan, flag = false){
            $("#hdarea").addClass('hidden');
            $('#dtbiareahd').removeClass('hidden');$('#dtbihd').text('Đang tải dữ liệu!');
            $('#proccesshd').removeClass('hidden');
            var id=$(this).attr('data-id');
            var loaiba=$(this).attr('data-loaiba');
            var httt= $('#httt').val();
            if(!$.isEmptyObject(maba)){
                id=maba;
                loaiba=loaibenhan;
                httt='';
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', id);
            formData.append('loaiba', loaiba);
            formData.append('httt', httt);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/ke_toan/hoa_don_dv/them_moi',
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
                        $('#dtbihd').text('Đã tải xong!');
                        $('#proccesshd').addClass('hidden');
                        var d=new Date();
                        var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
                        var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
                        var nam=d.getFullYear();
                        var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
                        var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
                        var giay=((d.getSeconds()<10) ? '0' : '') + d.getSeconds();
                        $('.ngaylap').text('Ngày '+ngay+' tháng '+thang+' năm '+nam);
                        $('.sthd').text(data.hd.shd);
                        $('.hd_hoten').text(data.hd.bn);$('.hd_dc').text(data.hd.dc);$('.hd_dttn').text(data.hd.dttn);$('[class*="hd_nd"]').html(data.hd.nd);
                        $('.hd_tt').text(data.hd.tt);
                        $('.hd_bn').text(data.hd.hoten);$('.hd_httt').text(data.hd.httt);
                        $('.hd_nv').text(data.hd.nv);$('.hd_bnct').text(data.hd.bnct);$('.hd_bhyt').text(data.hd.bhyt);$('.hd_tu').text(data.hd.tu);$('.hd_ngayin').text('Ngày in: '+ngay+'/'+thang+'/'+nam+' - '+gio+':'+phut+':'+giay);
                        $('#btninhd').attr('data-name',data.hd.hoten);
                        
                        if(flag ==false){
                            var hd='\n\
                            <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.hd.shd+'" data-name="'+data.hd.hoten+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.hd.hoten+'</td>\n\
                                <td>'+data.hd.dttn+'</td>\n\
                                <td>'+data.hd.htdt+'</td>\n\
                                <td>'+data.hd.bsdt+'</td>\n\
                                <td>'+data.hd.ngaylap+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button type="button" class="item" data-toggle="modal" data-target="#modalkkvp" data-button="btnxempkk" data-id="'+data.hd.idba+'" rel="tooltip" title="Xem phiếu kê khai viện phí" data-loaiba="'+data.hd.loaiba+'">\n\
                                        <i class="zmdi zmdi-eye"></i>\n\
                                    </button>\n\
                                    <button type="button" class="item" data-toggle="modal" data-target="#modalhd" data-button="btnxemhd" data-id="'+data.hd.idba+'" rel="tooltip" title="Xem nội dung hóa đơn" data-loaiba="'+data.hd.loaiba+'">\n\
                                        <i class="fa fa-file-text"></i>\n\
                                    </button>\n\
                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="'+data.hd.shd+'" data-name="'+data.hd.hoten+'">\n\
                                        <i class="zmdi zmdi-delete"  ></i>\n\
                                    </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';

                            $('#tbl_hd').prepend(hd);
                            $('#tbl_hd button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                        }
                        $("#hdarea").removeClass('hidden');
                    }
                    else if(data.msg == 'ktt'){
                        $('#dtbiareahd').addClass('hidden');$('#proccesshd').addClass('hidden');
                        alert('Bệnh án của bệnh nhân này không tồn tại, có thể đã bị xóa!');
                    }
                    else{
                        $('#dtbiareahd').addClass('hidden');$('#proccesshd').addClass('hidden');
                        alert("Lập hóa đơn thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareahd').addClass('hidden');$('#proccesshd').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Lập hóa đơn thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lập hóa đơn thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lập hóa đơn thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    } 
                }
            });
            
        });
        
        $('#tbl_hd').on('click','button[data-button="btnxemhd"]',function(){
            var maba=$(this).attr('data-id');
            var loaibenhan=$(this).attr('data-loaiba');
            $('#btnthem').trigger('click', [maba, loaibenhan, true]);
        });
        
        $('#tbl_hd').on('click','button[data-button="btnxoa"]',function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm('Bạn có chắc chắn muốn hủy hóa đơn dịch vụ của bệnh nhân '+name+'?');
            if(cf == false){
                return false;
            }
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/ke_toan/hoa_don_dv/xoa',
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
                        if($('#tbl_hd').children().length == 0){
                            $('input[data-input="checksum"]').prop("checked",false);
                        }
                        if(locds == true){
                            soluongl--;
                            if(soluongl == 0){
                                 $('#kqtimliem').text("");
                            }
                            else{
                                $('#kqtimliem').text("Có "+soluongl+" hóa đơn dịch vụ được tìm thấy!");
                            }
                        }
                        else{
                            if(tk == true){
                                soluongtk--;
                                if(soluongtk == 0){
                                    $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongtk+" hóa đơn dịch vụ tìm thấy!");
                                }
                            }
                        }
                        $('#tbl_hd tr').has('td div button[data-id="'+id+'"]').next('tr.spacer').remove();
                        $('#tbl_hd tr').has('td div button[data-id="'+id+'"]').remove();
                        
                        alert("Xóa thông tin hóa đơn dịch vụ thành công!");
                    }
                    else{
                        alert("Xóa hóa đơn dịch vụ gặp lỗi! Mô tả: "+data.msg);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Không thể xóa hóa đơn dịch vụ! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể xóa hóa đơn dịch vụ! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể xóa hóa đơn dịch vụ! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }     
                }
            });
        });
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if(!$('#tbl_hd input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn hóa đơn dịch vụ để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[]
                $('#tbl_hd input[data-input="check"]').each(function(){
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
                    cf=confirm("Bạn có thực sự muốn xóa các hóa đơn dịch vụ của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa hóa đơn dịch vụ của bệnh nhân "+name+"?");
                }
                if(cf==true){
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/ke_toan/hoa_don_dv/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" hóa đơn dịch vụ được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" hóa đơn dịch vụ được tìm thấy!");
                                            }
                                        }
                                    }
                                    for (var i = 0; i < arr.length; i++) {
                                        $('#tbl_hd tr').has('td div button[data-id="'+arr[i]+'"]').next('tr.spacer').remove();
                                        $('#tbl_hd tr').has('td div button[data-id="'+arr[i]+'"]').remove();
                                    }
                                    if($('#tbl_hd').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các hóa đơn dịch vụ thành công!");
                                    
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" hóa đơn dịch vụ được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" hóa đơn dịch vụ được tìm thấy!");
                                        }
                                    }
                                    $('#tbl_hd tr').has('td div button[data-id="'+arr[0]+'"]').next('tr.spacer').remove();
                                    $('#tbl_hd tr').has('td div button[data-id="'+arr[0]+'"]').remove();
                                    
                                    if($('#tbl_hd').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin hóa đơn dịch vụ thành công!");
                                    
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các hóa đơn dịch vụ thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin hóa đơn dịch vụ thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các hóa đơn dịch vụ thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các hóa đơn dịch vụ thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các hóa đơn dịch vụ thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }     
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin hóa đơn dịch vụ thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin hóa đơn dịch vụ thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin hóa đơn dịch vụ thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }     
                            }
                        }
                    });
                }
            }
        });
        //end
        
        $('#btninhd').click(function(){
            var name=$(this).attr('data-name');
            var cf=confirm('Đã thu tiền của bệnh nhân '+name+'?');
            if(cf == false){
                return false;
            }
            var d=new Date();
            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var nam=d.getFullYear();
            var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
            var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
            var giay=((d.getSeconds()<10) ? '0' : '') + d.getSeconds();
            var data1='HOA_DON_DV_BN_'+name.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam+'_'+gio+'_'+'_'+phut+'_'+giay+'_HDH';
            var data2='HOA_DON_DV_BV_'+name.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam+'_'+gio+'_'+'_'+phut+'_'+giay+'_HDX';
            $('#dtbiareahd').removeClass('hidden');$('#dtbihd').text('Đang tạo bản in!');
            $('#proccesshd').removeClass('hidden');
            genPDFHD(data1, data2);
        });
        
        //nhấn enter tìm kiếm
        $("#ftimkiem").keypress(function(e) {
              var key = e.charCode || e.keyCode || 0;     
              if (key == 13) {
                e.preventDefault();
                $('#btntimkiem').click();
              }
        });
        //end
        
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
                url: '/qlkcb/ke_toan/hoa_don_dv/tim_kiem',
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
                            var hd='';
                            for(var i=0; i<data.dshd.length; ++i){
                                hd+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dshd[i].shd+'" data-name="'+data.dshd[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.dshd[i].hoten+'</td>\n\
                                    <td>'+data.dshd[i].dttn+'</td>\n\
                                    <td>'+data.dshd[i].htdt+'</td>\n\
                                    <td>'+data.dshd[i].bsdt+'</td>\n\
                                    <td>'+data.dshd[i].ngaylap+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" data-toggle="modal" data-target="#modalkkvp" data-button="btnxempkk" data-id="'+data.dshd[i].idba+'" rel="tooltip" title="Xem phiếu kê khai viện phí" data-loaiba="'+data.dshd[i].loaiba+'">\n\
                                            <i class="zmdi zmdi-eye"></i>\n\
                                        </button>\n\
                                        <button type="button" class="item" data-toggle="modal" data-target="#modalhd" data-button="btnxemhd" data-id="'+data.dshd[i].idba+'" rel="tooltip" title="Xem nội dung hóa đơn" data-loaiba="'+data.dshd[i].loaiba+'">\n\
                                            <i class="fa fa-file-text"></i>\n\
                                        </button>\n\
                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="'+data.dshd[i].shd+'" data-name="'+data.dshd[i].hoten+'">\n\
                                            <i class="zmdi zmdi-delete"  ></i>\n\
                                        </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                            $('#tbl_hd').html(hd);
                            $('#tbl_hd button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                    
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" hóa đơn dịch vụ được tìm thấy!");
                        }
                        else{
                            $('#tbl_hd').html("");
                            $('#kqtimliem').text("Không có hóa đơn dịch vụ nào được tìm thấy!");tk=false;
                        }
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Tìm kiếm thất bại! Lỗi: "+jqXHR.msg+" | "+errorThrown);
                }
            });
        });
        //end tìm kiếm
        
        $('#btndong').click(function(){
            $("#formba").slideUp(800);
        });
        
        $('#btnadd').click(function(){
            $('#bn').val('');
            $('[class*="thearea"]').addClass('hidden');
            $('[class*="formba"]').addClass('hidden');
            $('#btnxempkkarea').addClass('hidden');
            $('#btnthemarea').addClass('hidden');
            $("#formba").slideDown(800);
            $('html, body').animate({
                scrollTop: $("#formba").offset().top
            }, 800);
        });
        
        //Nạp lại danh sách
        $('#btnnapds').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/ke_toan/hoa_don_dv/lay_ds_hd',
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
                        alert("Lỗi khi tải danh sách hóa đơn dịch vụ! Mô tả: "+data.msg);
                    }else{
                        var hd='';
                        for(var i=0; i<data.dshd.length; ++i){
                            hd+='\n\
                            <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dshd[i].shd+'" data-name="'+data.dshd[i].hoten+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.dshd[i].hoten+'</td>\n\
                                <td>'+data.dshd[i].dttn+'</td>\n\
                                <td>'+data.dshd[i].htdt+'</td>\n\
                                <td>'+data.dshd[i].bsdt+'</td>\n\
                                <td>'+data.dshd[i].ngaylap+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button type="button" class="item" data-toggle="modal" data-target="#modalkkvp" data-button="btnxempkk" data-id="'+data.dshd[i].idba+'" rel="tooltip" title="Xem phiếu kê khai viện phí" data-loaiba="'+data.dshd[i].loaiba+'">\n\
                                        <i class="zmdi zmdi-eye"></i>\n\
                                    </button>\n\
                                    <button type="button" class="item" data-toggle="modal" data-target="#modalhd" data-button="btnxemhd" data-id="'+data.dshd[i].idba+'" rel="tooltip" title="Xem nội dung hóa đơn" data-loaiba="'+data.dshd[i].loaiba+'">\n\
                                        <i class="fa fa-file-text"></i>\n\
                                    </button>\n\
                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="'+data.dshd[i].shd+'" data-name="'+data.dshd[i].hoten+'">\n\
                                        <i class="zmdi zmdi-delete"  ></i>\n\
                                    </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_hd').html(hd);
                        $('#tbl_hd button[data-button]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);

                        tk=false;locds=false;keySearch='';
                        $('#kqtimliem').text("");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Tải danh sách thất bại! Lỗi: "+jqXHR.msg+" | "+errorThrown);
                }
            });
        });
        //end Nạp lại danh sách
        
        //click check sum
        $('body').on('change', 'input[data-input="checksum"]', function(){
            if($(this).prop("checked")){
                $('#tbl_hd input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_hd input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_hd').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksum"]').prop("checked",false);
            }
            else{
                if($('#tbl_hd input[data-input="check"]:checked').length == $('#tbl_hd input[data-input="check"]').length){
                    $('input[data-input="checksum"]').prop("checked",true);
                }   
            }
        });
        //end
        
        function prepare_content_to_print_pkk_noi(data, bn){
            var d=new Date();
            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var nam=d.getFullYear();
            var flagthe=false;
            var content='<div class="card" style="font-weight: normal; height: 814px; width: 660px !important;">\n\
                            <div class="card-block card-body printcontent_vp" style="height: 814px; width: 660px !important;">\n\
                                <div style="height: 715px">\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Bộ Y tế/ Sở Y tế/ Y tế ngành: SỞ Y TẾ TỈNH AN GIANG</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Mẫu số: 01/KBCB</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Cơ sỡ khám, chữa bệnh: BỆNH VIỆN ĐKTT AN GIANG</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Mã số người bệnh: '+bn.mabn+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">Khoa: '+bn.pk+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Số khám bệnh: '+bn.skb+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-10">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">Mã khoa: '+bn.makhoa+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0;">'+bn.barcode+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center m-b-10">\n\
                                        <div class="col-lg-11">\n\
                                            <label style="margin-bottom: 0; font-weight: 600; font-size: 10pt">BẢNG KÊ KHAI CHI PHÍ KHÁM, CHỮA BỆNH NỘI TRÚ</label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="2" cellpadding="2" style="font-size: 10pt; width: 20px; float: right">\n\
                                                <thead>\n\
                                                    <tr>';
                    if(bn.ttbn == true){
                        content+='<th class="text-center">1</th>';
                    }
                    else{
                        content+='<th class="text-center">2</th>';
                    }
                                                        content+='\n\
                                                    </tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0; font-weight: 600;">I. Hành chính:</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-5">\n\
                                            <label style="margin-bottom: 0;">(1) Họ tên: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.hoten+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <label style="margin-bottom: 0;">Ngày sinh: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.ngaysinh+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <label style="margin-bottom: 0;">Giới tính: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.gt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9">\n\
                                            <label style="margin-bottom: 0;">(2) Địa chỉ hiện tại: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.diachi+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <label style="margin-bottom: 0;">(3) Mã khu vực: </label>\n\
                                        </div>\n\
                                    </div>';
            if(bn.mathe != 'koco'){
                flagthe=true;
                                    content+='<div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-4" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(4) Mã thẻ BHYT: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-8">\n\
                                                    <table border="2" style="font-size: 8pt; width: 20px;">\n\
                                                        <thead class="text-center">\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(0,2)+'</th><th style="border: 2px solid; padding: 2px">4</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(2,4)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(4,6)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(6,9)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(9,14)+'</th><th style="border: 2px solid; padding: 2px">'+bn.macsk+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0;">Giá trị từ:</label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tungay+'</label> <label>đến</label> <label style="margin-bottom: 0; font-weight: 600">'+bn.denngay+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9" style="padding-right: 0">\n\
                                            <label style="margin-bottom: 0;">(5) Cơ sở đăng ký KCB BHYT ban đầu: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.tencsk+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-6 text-right" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(6) Mã: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-6">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 50px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th class="text-center" style="border: 2px solid; padding: 2px">'+bn.macsk+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
            }
                                    content+='<div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">(7) Đến khám: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.ngaydt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">(8) Điều trị ngoại trú/nội trú từ: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.ngaydt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">(9) Kết thúc khám/điều trị: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.ngaykt+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-5">\n\
                                                    <label style="margin-bottom: 0;">Tổng số ngày điều trị: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.sndt+'</label>\n\
                                                </div>\n\
                                                <div class="col-lg-5 text-right">\n\
                                                    <label style="margin-bottom: 0;">(10) Tình trạng ra viện: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-2">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 20px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>';
                                if(bn.ttbn == true){
                                    content+='<th class="text-center" style="border: 2px solid; padding: 2px">1</th>';
                                }
                                else{
                                    content+='<th class="text-center" style="border: 2px solid; padding: 2px">2</th>';
                                }
                                                                content+='\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5">\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(11) Cấp cứu: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>\n\
                                                        <th style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(12) Đúng tuyến: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>';
                if(bn.tuyen == true){
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px">X</th>';}
                else{
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>';
                }
                                                    content+='</tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">Nơi chuyển đến từ: '+bn.giaychuyenden+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(13) Thông tuyến: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>\n\
                                                        <th style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(14) Trái tuyến: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>';
            if(bn.tuyen == false){
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px">X</th>';}
                else{
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>';
                }
                                                       
                                                    content+='</tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">Nơi chuyển đi: '+bn.giaychuyendi+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5">\n\
                                        <div class="col-lg-8">\n\
                                            <label style="margin-bottom: 0;">(15) Chuẩn đoán xác định: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.chuandoan+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-5 text-right" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(16) Mã bệnh: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-7">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 100px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mabenh+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">(17) Bệnh kèm theo: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.chuandoan+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-6 text-right" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(18) Mã bệnh kèm theo: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-6">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 100px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mabenh+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">(19) Thời gian đủ 5 năm liêm tục từ ngày: </label> <label style="margin-bottom: 0; font-weight: 600"></label>\n\
                                        </div>\n\
                                        <div class="col-lg-5">\n\
                                            <label style="margin-bottom: 0;">(20) Miễn cùng chi trả trong năm từ ngày: </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">II. Chi phí khám, chữa bệnh: </label>\n\
                                        </div>\n\
                                    </div>';
            if(bn.mathe !='koco'){
                            content+='<div class="row">\n\
                                        <div class="col-lg-5">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-4" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">Mã thẻ BHYT: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-8">\n\
                                                    <table border="2" style="font-size: 8pt; width: 20px;">\n\
                                                        <thead class="text-center">\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(0,2)+'</th><th style="border: 2px solid; padding: 2px">4</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(2,4)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(4,6)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(6,9)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(9,14)+'</th><th style="border: 2px solid; padding: 2px">'+bn.macsk+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <label style="margin-bottom: 0;">Giá trị từ: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tungay+'</label> <label> đến </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.denngay+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-7 text-right">\n\
                                                    <label>Mức hưởng: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-5 text-center" style="padding-left: 12px">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 40px">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th class="text-center" style="border: 2px solid; padding: 2px">'+bn.mh+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                }
                            content+='<div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">(Chi phí KBCB từ ngày '+bn.ngaybd+' đến ngày '+bn.ngayketthuc+')</label>\n\
                                        </div>\n\
                                    </div>';
                    var start_table='<div class="row" style="margin-top: 5px;">\n\
                                        <div class="col-lg-12">\n\
                                            <table class="table table-bordered" style="font-size: 6pt;">\n\
                                                <thead style="vertical-align: middle;">\n\
                                                    <tr>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px; width: 180px"><center>Nội dung</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Đơn vị tính</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Số lượng</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Đơn giá <br>(đồng)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Đơn giá BH <br>(đồng)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Tỷ lệ TT theo dich vụ <br>(%)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Thành tiền BV<br>(đồng)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Tỷ lệ TT BH YT<br>(%)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Thành tiền BHYT<br>(đồng)</center></th>\n\
                                                        <th colspan="4" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Nguồn thanh toán (đồng)</center></th>\n\
                                                    </tr>\n\
                                                    <tr>\n\
                                                        <th class="padding_adjust"><center>Qũy BHYT</center></th>\n\
                                                        <th class="padding_adjust"><center>Người bệnh cùng chi trả</center></th>\n\
                                                        <th class="padding_adjust"><center>Khác</center></th>\n\
                                                        <th class="padding_adjust"><center>Người bệnh tự trả</center></th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                                <tbody class="padding_adjust_td text-right">\n\
                                                    <tr class="vertical-align-midle">\n\
                                                        <td class="vertical-align-midle text-center">(1)</td>\n\
                                                        <td class="text-center">(2)</td>\n\
                                                        <td class="text-center">(3)</td>\n\
                                                        <td class="text-center">(4)</td>\n\
                                                        <td class="text-center">(5)</td>\n\
                                                        <td class="text-center">(6)</td>\n\
                                                        <td class="text-center">(7)</td>\n\
                                                        <td class="text-center">(8)</td>\n\
                                                        <td class="text-center">(9)</td>\n\
                                                        <td class="text-center">(10)</td>\n\
                                                        <td class="text-center">(11)</td>\n\
                                                        <td class="text-center">(12)</td>\n\
                                                        <td class="text-center">(13)</td>\n\
                                                    </tr>';
                    var newpage_bf='<div class="card" style="font-weight: normal; height: 814px; width: 660px !important;">\n\
                            <div class="card-block card-body printcontent_vp" style="height: 814px; width: 660px !important;">\n\
                                <div style="height: 715px">';
                    var end_table='\n\
                                                </tbody>\n\
                                            </table>\n\
                                        </div>\n\
                                    </div>';
                    var end_pk_nv='    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0">Tổng chi phí lần khám bệnh/ ca đợt điều trị: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tongcp+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Trong đó,</label> <label style="margin-bottom: 0;">số tiền do: </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">- Số tiền Qũy BHYT thanh toán:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.tongbh+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">- Người bệnh trả, trong đó:</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">&nbsp;&nbsp;&nbsp;+ Cùng trả trong phạm vi BHYT:</label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tongbncungtra+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">&nbsp;&nbsp;&nbsp;+ Các khoản phải trả khác:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.tongbntutra+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">Nguồn khác:</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">BN đã tạm ứng:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.bntamung+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">Bệnh nhân phải nộp thêm:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.tongtien+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center">\n\
                                        <div class="col-lg-6 ">\n\
                                            <br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">NGƯỜI LẬP BẢNG KÊ KHAI</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="margin-bottom: 0; font-weight: 600; font-size: 9pt">BS. '+bn.nv+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0; font-size: 8pt">Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">KẾ TOÁN VIỆN PHÍ</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center">\n\
                                        <div class="col-lg-6 ">\n\
                                            <br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">XÁC NHẬN CỦA NGƯỜI BỆNH</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="margin-bottom: 0; font-weight: 600; font-size: 9pt">'+bn.hoten+'</label><br>\n\
                                            <label style="margin-bottom: 0">(Tôi đã nhận......phim......Xquang......CT.....MR)</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0; font-size: 8pt">Ngày...... tháng...... năm......</label><br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">GIÁM ĐỊNH BHYT</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="row" style="margin-top: 20px">\n\
                                    <div class="col-lg-10">\n\
                                        <label style="margin-bottom: 0;">Họ tên người bệnh: '+bn.hoten+' - Mã Y Tế: '+bn.mabn+' - Năm Sinh: '+bn.namsinh+'</label>\n\
                                    </div>\n\
                                    <div class="col-lg-2 text-right">';
                var end_pk='</div>\n\
                                <div class="row" style="margin-top: 20px">\n\
                                    <div class="col-lg-10">\n\
                                        <label style="margin-bottom: 0;">Họ tên người bệnh: '+bn.hoten+' - Mã Y Tế: '+bn.mabn+' - Năm Sinh: '+bn.namsinh+'</label>\n\
                                    </div>\n\
                                    <div class="col-lg-2 text-right">';
            content+=start_table;
            if($.isArray(data))
            {
                var n=1; var trang=1;
                if(flagthe == true){
                    if(data.length <= 24){
                        tstrangtt = 2;
                    }
                    else{
                        if(parseInt((data.length - 10) % 37) > 14){
                            tstrangtt = parseInt(((data.length - 10)/37) + 3);
                        }
                        else{
                            if((data.length - 10)/37 < 0){
                                tstrangtt = parseInt(-((data.length - 10)/37) + 2);
                            }
                            else{
                                tstrangtt = parseInt(((data.length - 10)/37) + 2);
                            }
                        }
                    }
                    for (var i = 0; i < data.length; i++) {
                        content+=data[i];
                        if(n <= 24)
                        {
                            if(n <= 10){
                                if(n == 10){
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'<label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>'+newpage_bf+end_pk_nv+'<label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>';
                                    }
                                    else{
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+start_table;
                                        trang++;
                                    }
                                }
                                else{
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+end_pk_nv+'\n\
                                                        <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    content+=end_table+end_pk_nv+'\n\
                                                    <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                                }
                            }
                        }
                        else
                        {
                            if((n-24) % 37 == 0) //chia hết cho 14
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';

                                }
                            }
                            else if((n-10) % 37 == 0)
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                }
                                else{
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf  + start_table;
                                    trang++;
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    if((n-10)%37 > 14){
                                        content+=end_table + end_pk + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                    else{
                                        content+= end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }

                                }
                            }
                        }
                        n++;
                    }
                }
                else{
                    if(data.length <= 28){
                        tstrangtt = 2;
                    }
                    else{
                        if(parseInt((data.length - 14) % 37) > 14){
                            tstrangtt = parseInt(((data.length - 14)/37) + 3);
                        }
                        else{
                            if((data.length - 14)/37 < 0){
                                tstrangtt = parseInt(-((data.length - 14)/37) + 2);
                            }
                            else{
                                tstrangtt = parseInt(((data.length - 14)/37) + 2);
                            }
                        }
                    }
                    for (var i = 0; i < data.length; i++) {
                        content+=data[i];
                        if(n <= 28)
                        {
                            if(n <= 14){
                                if(n == 14){
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'<label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>'+newpage_bf+end_pk_nv+'<label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>';
                                    }
                                    else{
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+start_table;
                                        trang++;
                                    }
                                }
                                else{
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+end_pk_nv+'\n\
                                                        <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    content+=end_table+end_pk_nv+'\n\
                                                    <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                                }
                            }
                        }
                        else
                        {
                            if((n-28) % 37 == 0) //chia hết cho 14
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';

                                }
                            }
                            else if((n-14) % 37 == 0)
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                }
                                else{
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf  + start_table;
                                    trang++;
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    if((n-14)%37 > 14){
                                        content+=end_table + end_pk + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                    else{
                                        content+= end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }

                                }
                            }
                        }
                        n++;
                    }
                }
            }
            else
            {
                content='';//
            } 
            $('#print_content_vp').html(content);
            
            $('#tongnk').val(0);$('#tongphi').val(addCommas(bn.tongcp));$('#tongbh').val(addCommas(bn.tongbh));$('#tongbn').val(addCommas(bn.tongtien));
        }
        
        function prepare_content_to_print_pkk_ngoai(data, bn){
            var d=new Date();
            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var nam=d.getFullYear();
            var flagthe=false;
            var content='<div class="card" style="font-weight: normal; height: 814px; width: 660px !important;">\n\
                            <div class="card-block card-body printcontent_vp" style="height: 814px; width: 660px !important;">\n\
                                <div style="height: 715px">\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Bộ Y tế/ Sở Y tế/ Y tế ngành: SỞ Y TẾ TỈNH AN GIANG</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Mẫu số: 01/KBCB</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Cơ sỡ khám, chữa bệnh: BỆNH VIỆN ĐKTT AN GIANG</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Mã số người bệnh: '+bn.mabn+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">Khoa: '+bn.pk+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Số khám bệnh: '+bn.skb+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-10">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">Mã khoa: '+bn.makhoa+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0;">'+bn.barcode+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center m-b-10">\n\
                                        <div class="col-lg-11">\n\
                                            <label style="margin-bottom: 0; font-weight: 600; font-size: 10pt">BẢNG KÊ KHAI CHI PHÍ KHÁM, CHỮA BỆNH NGOẠI TRÚ</label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="2" cellpadding="2" style="font-size: 10pt; width: 20px; float: right">\n\
                                                <thead>\n\
                                                    <tr>\n\
                                                        <th class="text-center">1</th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0; font-weight: 600;">I. Hành chính:</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-5">\n\
                                            <label style="margin-bottom: 0;">(1) Họ tên: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.hoten+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <label style="margin-bottom: 0;">Ngày sinh: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.ngaysinh+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <label style="margin-bottom: 0;">Giới tính: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.gt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9">\n\
                                            <label style="margin-bottom: 0;">(2) Địa chỉ hiện tại: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.diachi+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <label style="margin-bottom: 0;">(3) Mã khu vực: </label>\n\
                                        </div>\n\
                                    </div>';
            if(bn.mathe != 'koco'){
                flagthe=true;
                                    content+='<div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-4" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(4) Mã thẻ BHYT: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-8">\n\
                                                    <table border="2" style="font-size: 8pt; width: 20px;">\n\
                                                        <thead class="text-center">\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(0,2)+'</th><th style="border: 2px solid; padding: 2px">4</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(2,4)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(4,6)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(6,9)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(9,14)+'</th><th style="border: 2px solid; padding: 2px">'+bn.macsk+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0;">Giá trị từ:</label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tungay+'</label> <label>đến</label> <label style="margin-bottom: 0; font-weight: 600">'+bn.denngay+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9" style="padding-right: 0">\n\
                                            <label style="margin-bottom: 0;">(5) Cơ sở đăng ký KCB BHYT ban đầu: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.tencsk+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-6 text-right" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(6) Mã: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-6">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 50px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th class="text-center" style="border: 2px solid; padding: 2px">'+bn.macsk+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
            }
                                    content+='<div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">(7) Đến khám: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.ngaydt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">(8) Điều trị ngoại trú/nội trú từ: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.ngaydt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">(9) Kết thúc khám/điều trị: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.ngaykt+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-5">\n\
                                                    <label style="margin-bottom: 0;">Tổng số ngày điều trị: </label> <label style="margin-bottom: 0; font-weight: 600">1</label>\n\
                                                </div>\n\
                                                <div class="col-lg-5 text-right">\n\
                                                    <label style="margin-bottom: 0;">(10) Tình trạng ra viện: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-2">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 20px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th class="text-center" style="border: 2px solid; padding: 2px">1</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5">\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(11) Cấp cứu: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>\n\
                                                        <th style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(12) Đúng tuyến: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>';
                if(bn.tuyen == true){
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px">X</th>';}
                else{
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>';
                }
                                                    content+='</tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">Nơi chuyển đến từ: '+bn.giaychuyenden+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(13) Thông tuyến: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>\n\
                                                        <th style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(14) Trái tuyến: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>';
            if(bn.tuyen == false){
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px">X</th>';}
                else{
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>';
                }
                                                       
                                                    content+='</tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">Nơi chuyển đi: '+bn.giaychuyendi+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5">\n\
                                        <div class="col-lg-8">\n\
                                            <label style="margin-bottom: 0;">(15) Chuẩn đoán xác định: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.chuandoan+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-5 text-right" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(16) Mã bệnh: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-7">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 100px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mabenh+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">(17) Bệnh kèm theo: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.chuandoan+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-6 text-right" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(18) Mã bệnh kèm theo: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-6">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 100px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mabenh+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">(19) Thời gian đủ 5 năm liêm tục từ ngày: </label> <label style="margin-bottom: 0; font-weight: 600"></label>\n\
                                        </div>\n\
                                        <div class="col-lg-5">\n\
                                            <label style="margin-bottom: 0;">(20) Miễn cùng chi trả trong năm từ ngày: </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">II. Chi phí khám, chữa bệnh: </label>\n\
                                        </div>\n\
                                    </div>';
            if(bn.mathe !='koco'){
                            content+='<div class="row">\n\
                                        <div class="col-lg-5">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-4" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">Mã thẻ BHYT: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-8">\n\
                                                    <table border="2" style="font-size: 8pt; width: 20px;">\n\
                                                        <thead class="text-center">\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(0,2)+'</th><th style="border: 2px solid; padding: 2px">4</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(2,4)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(4,6)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(6,9)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(9,14)+'</th><th style="border: 2px solid; padding: 2px">'+bn.macsk+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <label style="margin-bottom: 0;">Giá trị từ: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tungay+'</label> <label> đến </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.denngay+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-7 text-right">\n\
                                                    <label>Mức hưởng: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-5 text-center" style="padding-left: 12px">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 40px">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th class="text-center" style="border: 2px solid; padding: 2px">'+bn.mh+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                }
                            content+='<div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">(Chi phí KBCB từ ngày '+bn.ngaybd+' đến ngày '+bn.ngayketthuc+')</label>\n\
                                        </div>\n\
                                    </div>';
                    var start_table='<div class="row" style="margin-top: 5px;">\n\
                                        <div class="col-lg-12">\n\
                                            <table class="table table-bordered" style="font-size: 6pt;">\n\
                                                <thead style="vertical-align: middle;">\n\
                                                    <tr>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px; width: 180px"><center>Nội dung</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Đơn vị tính</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Số lượng</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Đơn giá <br>(đồng)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Đơn giá BH <br>(đồng)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Tỷ lệ TT theo dich vụ <br>(%)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Thành tiền BV<br>(đồng)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Tỷ lệ TT BH YT<br>(%)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Thành tiền BHYT<br>(đồng)</center></th>\n\
                                                        <th colspan="4" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Nguồn thanh toán (đồng)</center></th>\n\
                                                    </tr>\n\
                                                    <tr>\n\
                                                        <th class="padding_adjust"><center>Qũy BHYT</center></th>\n\
                                                        <th class="padding_adjust"><center>Người bệnh cùng chi trả</center></th>\n\
                                                        <th class="padding_adjust"><center>Khác</center></th>\n\
                                                        <th class="padding_adjust"><center>Người bệnh tự trả</center></th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                                <tbody class="padding_adjust_td text-right">\n\
                                                    <tr class="vertical-align-midle">\n\
                                                        <td class="vertical-align-midle text-center">(1)</td>\n\
                                                        <td class="text-center">(2)</td>\n\
                                                        <td class="text-center">(3)</td>\n\
                                                        <td class="text-center">(4)</td>\n\
                                                        <td class="text-center">(5)</td>\n\
                                                        <td class="text-center">(6)</td>\n\
                                                        <td class="text-center">(7)</td>\n\
                                                        <td class="text-center">(8)</td>\n\
                                                        <td class="text-center">(9)</td>\n\
                                                        <td class="text-center">(10)</td>\n\
                                                        <td class="text-center">(11)</td>\n\
                                                        <td class="text-center">(12)</td>\n\
                                                        <td class="text-center">(13)</td>\n\
                                                    </tr>';
                    var newpage_bf='<div class="card" style="font-weight: normal; height: 814px; width: 660px !important;">\n\
                            <div class="card-block card-body printcontent_vp" style="height: 814px; width: 660px !important;">\n\
                                <div style="height: 715px">';
                    var end_table='\n\
                                                </tbody>\n\
                                            </table>\n\
                                        </div>\n\
                                    </div>';
                    var end_pk_nv='    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0">Tổng chi phí lần khám bệnh/ ca đợt điều trị: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tongcp+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Trong đó,</label> <label style="margin-bottom: 0;">số tiền do: </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">- Số tiền Qũy BHYT thanh toán:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.tongbh+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">- Người bệnh trả, trong đó:</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">&nbsp;&nbsp;&nbsp;+ Cùng trả trong phạm vi BHYT:</label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tongbncungtra+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">&nbsp;&nbsp;&nbsp;+ Các khoản phải trả khác:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.tongbntutra+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">Nguồn khác:</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">BN đã tạm ứng:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.bntamung+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">Bệnh nhân phải nộp thêm:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.tongtien+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center">\n\
                                        <div class="col-lg-6 ">\n\
                                            <br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">NGƯỜI LẬP BẢNG KÊ KHAI</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="margin-bottom: 0; font-weight: 600; font-size: 9pt">BS. '+bn.nv+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0; font-size: 8pt">Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">KẾ TOÁN VIỆN PHÍ</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center">\n\
                                        <div class="col-lg-6 ">\n\
                                            <br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">XÁC NHẬN CỦA NGƯỜI BỆNH</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="margin-bottom: 0; font-weight: 600; font-size: 9pt">'+bn.hoten+'</label><br>\n\
                                            <label style="margin-bottom: 0">(Tôi đã nhận......phim......Xquang......CT.....MR)</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0; font-size: 8pt">Ngày...... tháng...... năm......</label><br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">GIÁM ĐỊNH BHYT</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="row" style="margin-top: 20px">\n\
                                    <div class="col-lg-10">\n\
                                        <label style="margin-bottom: 0;">Họ tên người bệnh: '+bn.hoten+' - Mã Y Tế: '+bn.mabn+' - Năm Sinh: '+bn.namsinh+'</label>\n\
                                    </div>\n\
                                    <div class="col-lg-2 text-right">';
                var end_pk='</div>\n\
                                <div class="row" style="margin-top: 20px">\n\
                                    <div class="col-lg-10">\n\
                                        <label style="margin-bottom: 0;">Họ tên người bệnh: '+bn.hoten+' - Mã Y Tế: '+bn.mabn+' - Năm Sinh: '+bn.namsinh+'</label>\n\
                                    </div>\n\
                                    <div class="col-lg-2 text-right">';
            content+=start_table;
            if($.isArray(data))
            {
                var n=1; var trang=1;
                if(flagthe == true){
                    if(data.length <= 24){
                        tstrangtt = 2;
                    }
                    else{
                        if(parseInt((data.length - 10) % 37) > 14){
                            tstrangtt = parseInt(((data.length - 10)/37) + 3);
                        }
                        else{
                            if((data.length - 10)/37 < 0){
                                tstrangtt = parseInt(-((data.length - 10)/37) + 2);
                            }
                            else{
                                tstrangtt = parseInt(((data.length - 10)/37) + 2);
                            }
                        }
                    }
                    for (var i = 0; i < data.length; i++) {
                        content+=data[i];
                        if(n <= 24)
                        {
                            if(n <= 10){
                                if(n == 10){
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'<label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>'+newpage_bf+end_pk_nv+'<label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>';
                                    }
                                    else{
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+start_table;
                                        trang++;
                                    }
                                }
                                else{
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+end_pk_nv+'\n\
                                                        <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    content+=end_table+end_pk_nv+'\n\
                                                    <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                                }
                            }
                        }
                        else
                        {
                            if((n-24) % 37 == 0) //chia hết cho 14
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';

                                }
                            }
                            else if((n-10) % 37 == 0)
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                }
                                else{
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf  + start_table;
                                    trang++;
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    if((n-10)%37 > 14){
                                        content+=end_table + end_pk + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                    else{
                                        content+= end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }

                                }
                            }
                        }
                        n++;
                    }
                }
                else{
                    if(data.length <= 28){
                        tstrangtt = 2;
                    }
                    else{
                        if(parseInt((data.length - 14) % 37) > 14){
                            tstrangtt = parseInt(((data.length - 14)/37) + 3);
                        }
                        else{
                            if((data.length - 14)/37 < 0){
                                tstrangtt = parseInt(-((data.length - 14)/37) + 2);
                            }
                            else{
                                tstrangtt = parseInt(((data.length - 14)/37) + 2);
                            }
                        }
                    }
                    for (var i = 0; i < data.length; i++) {
                        content+=data[i];
                        if(n <= 28)
                        {
                            if(n <= 14){
                                if(n == 14){
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'<label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>'+newpage_bf+end_pk_nv+'<label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>';
                                    }
                                    else{
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+start_table;
                                        trang++;
                                    }
                                }
                                else{
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+end_pk_nv+'\n\
                                                        <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    content+=end_table+end_pk_nv+'\n\
                                                    <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                                }
                            }
                        }
                        else
                        {
                            if((n-28) % 37 == 0) //chia hết cho 14
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';

                                }
                            }
                            else if((n-14) % 37 == 0)
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                }
                                else{
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf  + start_table;
                                    trang++;
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    if((n-14)%37 > 14){
                                        content+=end_table + end_pk + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                    else{
                                        content+= end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }

                                }
                            }
                        }
                        n++;
                    }
                }
            }
            else
            {
                content='';//
            }            
            
            $('#print_content_vp').html(content);
            
            $('#tongnk').val(0);$('#tongphi').val(addCommas(bn.tongcp));$('#tongbh').val(addCommas(bn.tongbh));$('#tongbn').val(addCommas(bn.tongtien));
        }
        
        function addCommas(numberString) {
          var resultString = numberString + '',
              x = resultString.split('.'),
              x1 = x[0],
              x2 = x.length > 1 ? '.' + x[1] : '',
              rgxp = /(\d+)(\d{3})/;

          while (rgxp.test(x1)) {
            x1 = x1.replace(rgxp, '$1' + ',' + '$2');
          }

          return x1 + x2;
        }
    });
</script>
@endsection