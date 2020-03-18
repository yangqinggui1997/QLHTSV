@extends('ke_toan.layout')

@section('title')
    {{ "Tạm ứng phí dịch vụ" }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
        <!-- DATA TABLE-->
        <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" m-b-35">
                                <h3 class="title-5 font-weight-bold text-green">DANH SÁCH PHIẾU DỊCH VỤ ĐÓNG TẠM ỨNG HÔM NAY - KT. {{mb_convert_case($nd->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8')}}</h3>
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
                                    <button type="button" class="au-btn au-btn--teal au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Nạp lại danh sách" id="btnnapds"><i class="zmdi zmdi-refresh"></i></button>
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
                                            <th>Tên dịch vụ</th>
                                            <th>Bác sĩ chỉ định</th>
                                            <th>Phòng chỉ định</th>
                                            <th>Phòng thực hiện</th>
                                            <th>Ngày ra chỉ định</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_tamung">
                                        @if(isset($dsdv))
                                        @foreach($dsdv as $dv)
                                        @if($dv['loaidv'] == 'cls')
                                            @foreach($dv['dsdv'] as $cls)
                                            @if(is_object($cls->benhAnNgoaiTru))
                                                <tr class="tr-shadow">
                                                    <td style="vertical-align: middle;">
                                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                            <input type="checkbox" data-input="check" data-id="{{ $cls->IdCLS }}" data-name="<?php echo $cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>{{$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                    <td>
                                                        @if($cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                        BHYT
                                                        @else
                                                        Thu phí
                                                        @endif
                                                    </td>
                                                    <td>Ngoại trú</td>
                                                    <td>{{$cls->danhMucCLS->TenCLS}}</td>
                                                    <td>{{$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV}}</td>
                                                    <td>Phòng số {{$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->SoPhong}} - {{$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->TenPhong}}</td>
                                                    <td>Phòng số {{$cls->phongBan->SoPhong}} - {{$cls->phongBan->TenPhong}}</td>
                                                    <td>
                                                        {{\comm_functions::deDateFormat($cls->created_at)}}
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="{{$cls->IdCLS}}" data-name="{{$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}" data-loaidv="cls" data-toggle="modal" data-target="#modaltu">
                                                                <i class="fa fa-check"  ></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="spacer"></tr>
                                            @elseif(is_object($cls->benhAnNoiTruCT))
                                                <tr class="tr-shadow">
                                                    <td style="vertical-align: middle;">
                                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                            <input type="checkbox" data-input="check" data-id="{{ $cls->IdCLS }}" data-name="<?php echo $cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>{{$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                    <td>
                                                        @if($cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                        BHYT
                                                        @else
                                                        Thu phí
                                                        @endif
                                                    </td>
                                                    <td>Nội trú</td>
                                                    <td>{{$cls->danhMucCLS->TenCLS}}</td>
                                                    <td>{{$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV}}</td>
                                                    <td>Phòng số {{$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->SoPhong}} - {{$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->TenPhong}}</td>
                                                    <td>Phòng số {{$cls->phongBan->SoPhong}} - {{$cls->phongBan->TenPhong}}</td>
                                                    <td>
                                                        {{\comm_functions::deDateFormat($cls->created_at)}}
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="{{$cls->IdCLS}}" data-name="{{$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}" data-loaidv="cls" data-toggle="modal" data-target="#modaltu">
                                                                <i class="fa fa-check"  ></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="spacer"></tr>
                                            @endif
                                            @endforeach
                                        @elseif($dv['loaidv'] == 'tt')
                                            @foreach($dv['dsdv'] as $tt)
                                            @if(is_object($tt->benhAnNgoaiTru))
                                                <tr class="tr-shadow">
                                                    <td style="vertical-align: middle;">
                                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                            <input type="checkbox" data-input="check" data-id="{{ $tt->IdThuThuat }}" data-name="<?php echo $tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>{{$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                    <td>
                                                        @if($tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                        BHYT
                                                        @else
                                                        Thu phí
                                                        @endif
                                                    </td>
                                                    <td>Ngoại trú</td>
                                                    <td>{{$tt->danhMucCLS->TenCLS}}</td>
                                                    <td>{{$tt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV}}</td>
                                                    <td>Phòng số {{$tt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->SoPhong}} - {{$tt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->TenPhong}}</td>
                                                    <td>Phòng số {{$tt->phongBan->SoPhong}} - {{$tt->phongBan->TenPhong}}</td>
                                                    <td>
                                                        {{\comm_functions::deDateFormat($tt->created_at)}}
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="{{$tt->IdThuThuat}}" data-name="{{$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}" data-loaidv="tt" data-toggle="modal" data-target="#modaltu">
                                                                <i class="fa fa-check"  ></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="spacer"></tr>
                                            @elseif(is_object($tt->benhAnNoiTruCT))
                                                <tr class="tr-shadow">
                                                    <td style="vertical-align: middle;">
                                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                            <input type="checkbox" data-input="check" data-id="{{ $tt->IdThuThuat }}" data-name="<?php echo $tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>{{$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                    <td>
                                                        @if($tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                        BHYT
                                                        @else
                                                        Thu phí
                                                        @endif
                                                    </td>
                                                    <td>Nội trú</td>
                                                    <td>{{$tt->danhMucCLS->TenCLS}}</td>
                                                    <td>{{$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV}}</td>
                                                    <td>Phòng số {{$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->SoPhong}} - {{$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->TenPhong}}</td>
                                                    <td>Phòng số {{$tt->phongBan->SoPhong}} - {{$tt->phongBan->TenPhong}}</td>
                                                    <td>
                                                        {{\comm_functions::deDateFormat($tt->created_at)}}
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="{{$tt->IdThuThuat}}" data-name="{{$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}" data-loaidv="tt" data-toggle="modal" data-target="#modaltu">
                                                                <i class="fa fa-check"  ></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="spacer"></tr>
                                            @endif
                                            @endforeach
                                        @elseif($dv['loaidv'] == 'pt')
                                            @foreach($dv['dsdv'] as $pt)
                                                <tr class="tr-shadow">
                                                    <td style="vertical-align: middle;">
                                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                            <input type="checkbox" data-input="check" data-id="{{ $pt->IdPT }}" data-name="<?php echo $pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>{{$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                    <td>
                                                        @if($pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                        BHYT
                                                        @else
                                                        Thu phí
                                                        @endif
                                                    </td>
                                                    <td>Nội trú</td>
                                                    <td>{{$pt->danhMucCLS->TenCLS}}</td>
                                                    <td>{{$pt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV}}</td>
                                                    <td>Phòng số {{$pt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->SoPhong}} - {{$pt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->TenPhong}}</td>
                                                    <td>Phòng số {{$pt->phongBan->SoPhong}} - {{$pt->phongBan->TenPhong}}</td>
                                                    <td>
                                                        {{\comm_functions::deDateFormat($pt->created_at)}}
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="{{$pt->IdPT}}" data-name="{{$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}" data-loaidv="pt" data-toggle="modal" data-target="#modaltu">
                                                                <i class="fa fa-check"  ></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="spacer"></tr>
                                            @endforeach
                                        @endif
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
        
        <!--MODAL XÁC NHẬN TẠM ỨNG - PHIẾU MÀU HỒNG-->
        <div class="modal fade" id="modaltu" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lgest" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Lập phiếu tạm ứng dịch vụ y tế</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row fit_table_height_400" style="font-family: Verdana; font-size: 8pt; color: #0b6542">
                            <div style="width: 130px !important;"></div>
                            <div class="col-lg-10">
                                <div class="card" style="font-weight: normal; height: 470px; width: 750px !important;">
                                    <div class="card-block card-body printcontent_tu" style="height: 470px; width: 750px !important; font-weight: 800; background: #f9d6d5">
                                        <div class="row m-b-5" style="font-size: 7pt;">
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="col-lg-4 text-center" style="margin: 0; margin-top: 8px; padding: 0;">
                                                        <label><img src="public/images/logo3.png" style="height: 60px;"></label>
                                                    </div>
                                                    <div class="col-lg-8" style="margin: 0; padding: 0;">
                                                        <label style="margin-bottom: 0;">Sở Y tế An Giang</label><br>
                                                        <label style="margin-bottom: 0;">Bệnh Viện ĐKTT An Giang</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">60 Ung Văn Khiêm, P.Mỹ Phước, TP.LX - AG</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">ĐT: 3852989 – 3852862</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">MST:</label> <label style="margin-bottom: 0;">1600258404</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 text-center">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                        <label style="margin-bottom: 0;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</label>
                                                     </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label style="margin-bottom: 0;">Độc lập - Tự do - Hạnh phúc</label>
                                                        <hr class="line-seprate" style="margin-top: 10px; margin-left: 85px; background: black; width: 30%;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" style="padding: 0">
                                                <label style="margin-bottom: 0; font-weight: normal">Ký hiệu:</label> <label style="margin-bottom: 0;">AA/2017-TU</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">Số:</label> <label style="margin-bottom: 0;" class="stu">......................</label>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-size: 12pt">PHIẾU THU TIỀN TẠM ỨNG VIỆN PHÍ</label><br>
                                                <label style="margin-bottom: 0; font-size: 9pt; font-weight: normal">Liên 2: Giao bệnh nhân</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Họ và tên bệnh nhân:</label> <label style="margin-bottom: 0; font-size: 10pt;" class="gtu_hoten"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0; font-weight: normal">Mã BN:</label> <label style="margin-bottom: 0;" class="gtu_mabn"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0; font-weight: normal">Năm sinh:</label> <label style="margin-bottom: 0;" class="gtu_ns"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Địa chỉ:</label> <label style="margin-bottom: 0;" class="gtu_dc"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Khoa:</label> <label style="margin-bottom: 0;" class="gtu_k"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Lý do thu tiền:</label> <label style="margin-bottom: 0;">Tạm ứng phí dịch vụ y tế</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Số tiền:</label> <label style="margin-bottom: 0;" class="gtu_st"></label>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-6">
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-size: 8pt; font-weight: normal; font-style: italic" class="gtu_ngaythu">fsfsfsf</label><br>
                                                <label style="margin-bottom: 0">Thu ngân</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal;font-style: italic">(Ký, ghi rõ họ tên)</label><br>
                                                <label style="margin-bottom: 0;" class="gtu_nv"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-1 text-right" style="padding: 0">
                                                <label style="margin-bottom: 0; font-style: italic; text-decoration: underline">Lưu ý:</label>
                                            </div>
                                            <div class="col-lg-11">
                                                <label style="margin-bottom: 0; font-weight: normal; font-style: italic">1. Khi bệnh nhân làm thủ tục xuất viện, yêu cầu phải nộp lại toàn bộ Phiếu thu tiền tạm ứng.</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal; font-style: italic">2. Phiếu thu tiền tạm ứng không có giá trị thanh toán.</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal; font-style: italic">3. Phiếu thu tiền tạm ứng chỉ cấp 01 lần. Bệnh nhân phải lưu giữ cẩn thận. Bệnh viện không chịu trách nhiệm khi bệnh nhân mất Phiếu thu tiền tạm ứng.</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-block card-body printcontent_tu" style="height: 470px; width: 750px !important; font-weight: 800; background: #BEE9EA">
                                        <div class="row m-b-5" style="font-size: 7pt;">
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="col-lg-4 text-center" style="margin: 0; margin-top: 8px; padding: 0;">
                                                        <label><img src="public/images/logo3.png" style="height: 60px;"></label>
                                                    </div>
                                                    <div class="col-lg-8" style="margin: 0; padding: 0;">
                                                        <label style="margin-bottom: 0;">Sở Y tế An Giang</label><br>
                                                        <label style="margin-bottom: 0;">Bệnh Viện ĐKTT An Giang</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">60 Ung Văn Khiêm, P.Mỹ Phước, TP.LX - AG</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">ĐT: 3852989 – 3852862</label><br>
                                                        <label style="margin-bottom: 0; font-weight: normal">MST:</label> <label style="margin-bottom: 0;">1600258404</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 text-center">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                        <label style="margin-bottom: 0;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</label>
                                                     </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label style="margin-bottom: 0;">Độc lập - Tự do - Hạnh phúc</label>
                                                        <hr class="line-seprate" style="margin-top: 10px; margin-left: 85px; background: black; width: 30%;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" style="padding: 0">
                                                <label style="margin-bottom: 0; font-weight: normal">Ký hiệu:</label> <label style="margin-bottom: 0;">AA/2017-TU</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">Số:</label> <label style="margin-bottom: 0;" class="stu">......................</label>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-size: 12pt">PHIẾU THU TIỀN TẠM ỨNG VIỆN PHÍ</label><br>
                                                <label style="margin-bottom: 0; font-size: 9pt; font-weight: normal">Liên 1: Giao bệnh viện</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-weight: normal">Họ và tên bệnh nhân:</label> <label style="margin-bottom: 0; font-size: 10pt;" class="gtu_hoten"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0; font-weight: normal">Mã BN:</label> <label style="margin-bottom: 0;" class="gtu_mabn"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0; font-weight: normal">Năm sinh:</label> <label style="margin-bottom: 0;" class="gtu_ns"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Địa chỉ:</label> <label style="margin-bottom: 0;" class="gtu_dc"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Khoa:</label> <label style="margin-bottom: 0;" class="gtu_k"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Lý do thu tiền:</label> <label style="margin-bottom: 0;">Tạm ứng phí dịch vụ y tế</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Số tiền:</label> <label style="margin-bottom: 0;" class="gtu_st"></label>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-6">
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-size: 8pt; font-weight: normal; font-style: italic" class="gtu_ngaythu"></label><br>
                                                <label style="margin-bottom: 0">Thu ngân</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal;font-style: italic">(Ký, ghi rõ họ tên)</label><br>
                                                <label style="margin-bottom: 0;" class="gtu_nv"></label>
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
                                                        <button type="button" class="au-btn au-btn--print au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Lập phiếu tạm ứng" id="btningtu"><span class="zmdi zmdi-print"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row" style="font-size: 10pt;">
                                                <div class="col-lg-12">
                                                    <div class="row hidden" id="dtbiareagtu">
                                                        <div class="col-lg-12">
                                                            <label style="font-weight: normal" id="dtbigtu">Đang tạo bản in!</label>
                                                        </div>
                                                    </div>
                                                    <div class='row hidden' id="proccessgtu">
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
        <!--END MODAL XÁC NHẬN TẠM ỨNG - PHIẾU MÀU HỒNG-->
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

        $('button[class*="close"]').click(function(){});

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
        
        //        Đăng ký kênh chỉ định cls 
        var channelcls = pusher.subscribe('CanLamSang');
        function layttcls(data) {
            if(data.thaotac != 'xoa'){
                if(data.thaotac != 'chuyendv'){
                    var cls='\n\
                        <tr class="tr-shadow">\n\
                            <td style="vertical-align: middle;">\n\
                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.cls.idcls+'" data-name="'+data.cls.hoten+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td>'+data.cls.hoten+'</td>\n\
                            <td>'+data.cls.dttn+'</td>\n\
                            <td>'+data.cls.htdt+'</td>\n\
                            <td>'+data.cls.tencls+'</td>\n\
                            <td>'+data.cls.nvcd+'</td>\n\
                            <td>'+data.cls.phongcd+'</td>\n\
                            <td>'+data.cls.pth+'</td>\n\
                            <td>'+data.cls.ngayracd+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="'+data.cls.idcls+'" data-name="'+data.cls.hoten+'" data-loaidv="cls" data-toggle="modal" data-target="#modaltu">\n\
                                        <i class="fa fa-check"></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>\n\
                        ';
                    if(data.thaotac == 'them'){
                        cls+='<tr class="spacer"></tr>';
                        $('#tbl_tamung').prepend(cls);
                    }
                    else{
                        $('#tbl_tamung tr').has('td div button[data-id="'+data.cls.idcls+'"]').replaceWith(cls);
                    }

                    $('#tbl_tamung button[data-id="'+data.cls.idcls+'"]').tooltip({
                        trigger: 'manual'

                    })
                    .focus(hideTooltip)
                    .blur(hideTooltip)
                    .hover(showTooltip, hideTooltip);
                }
            }
            else{
                if($.isArray(data.cls)){
                    for (var i = 0; i < data.cls.length; i++) {
                        $('#tbl_tamung tr').has('td div button[data-id="'+data.cls[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_tamung tr').has('td div button[data-id="'+data.cls[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_tamung tr').has('td div button[data-id="'+data.cls+'"]').next('tr.spacer').remove();
                    $('#tbl_tamung tr').has('td div button[data-id="'+data.cls+'"]').remove();
                }  
            }
        }
        
        //Bind một function layttcls với sự kiện CanLamSang.php
        channelcls.bind('App\\Events\\KhamVaDieuTri\\CanLamSang', layttcls);
        //end xử lý channel
        
        //         Đăng ký kênh kết quả chỉ định thủ thuật 
        var channelcdtt = pusher.subscribe('ChiDinhTT');
        function layttcdtt(data) {
            if(data.thaotac != 'xoa'){
                var cdtt='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.cdtt.idtt+'" data-name="'+data.cdtt.benhnhan+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td>'+data.cdtt.benhnhan+'</td>\n\
                        <td>'+data.cdtt.dttn+'</td>\n\
                        <td>'+data.cdtt.htdt+'</td>\n\
                        <td>'+data.cdtt.tentt+'</td>\n\
                        <td>'+data.cdtt.nvcd+'</td>\n\
                        <td>'+data.cdtt.phongcd+'</td>\n\
                        <td>'+data.cdtt.pth+'</td>\n\
                        <td>'+data.cdtt.ngayracd+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="'+data.cdtt.idtt+'" data-name="'+data.cdtt.benhnhan+'" data-loaidv="tt" data-toggle="modal" data-target="#modaltu">\n\
                                    <i class="fa fa-check"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    cdtt+='<tr class="spacer"></tr>';
                    $('#tbl_tamung').prepend(cdtt);
                }
                else{
                    $('#tbl_tamung tr').has('td div button[data-id="'+data.cdtt.idtt+'"]').replaceWith(cdtt);
                }
                $('#tbl_tamung button[data-id="'+data.cdtt.idtt+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isArray(data.cdtt)){
                    for (var i = 0; i < data.cdtt.length; i++) {
                        $('#tbl_tamung tr').has('td div button[data-id="'+data.cdtt[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_tamung tr').has('td div button[data-id="'+data.cdtt[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_tamung tr').has('td div button[data-id="'+data.cdtt+'"]').next('tr.spacer').remove();
                    $('#tbl_tamung tr').has('td div button[data-id="'+data.cdtt+'"]').remove();

                }  
            }
        }
        
        //Bind một function layttcdtt với sự kiện ChiDinhTT.php
        channelcdtt.bind('App\\Events\\KhamVaDieuTri\\ChiDinhTT', layttcdtt);
        //end xử lý channel
        
        //         Đăng ký kênh kết quả chỉ định phẫu thuật 
        var channelcdpt = pusher.subscribe('ChiDinhPT');
        function layttcdpt(data) {
            if(data.thaotac != 'xoa'){
                var cdpt='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.cdpt.idpt+'" data-name="'+data.cdpt.benhnhan+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td>'+data.cdpt.benhnhan+'</td>\n\
                        <td>'+data.cdpt.dttn+'</td>\n\
                        <td>'+data.cdpt.htdt+'</td>\n\
                        <td>'+data.cdpt.tenpt+'</td>\n\
                        <td>'+data.cdpt.nvcd+'</td>\n\
                        <td>'+data.cdpt.phongcd+'</td>\n\
                        <td>'+data.cdpt.pth+'</td>\n\
                        <td>'+data.cdpt.ngayracd+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="'+data.cdpt.idpt+'" data-name="'+data.cdpt.benhnhan+'" data-loaidv="pt" data-toggle="modal" data-target="#modaltu">\n\
                                    <i class="fa fa-check"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    cdpt+='<tr class="spacer"></tr>';

                    $('#tbl_tamung').prepend(cdpt);
                }
                else{
                    $('#tbl_tamung tr').has('td div button[data-id="'+data.cdpt.idpt+'"]').replaceWith(cdpt);
                }
                $('#tbl_tamung button[data-id="'+data.cdpt.idpt+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isArray(data.cdpt)){
                    for (var i = 0; i < data.cdpt.length; i++) {
                        $('#tbl_tamung tr').has('td div button[data-id="'+data.cdpt[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_tamung tr').has('td div button[data-id="'+data.cdpt[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_tamung tr').has('td div button[data-id="'+data.cdpt+'"]').next('tr.spacer').remove();
                    $('#tbl_tamung tr').has('td div button[data-id="'+data.cdpt+'"]').remove();

                }  
            }
        }
        
        //Bind một function layttcdpt với sự kiện ChiDinhPT.php
        channelcdpt.bind('App\\Events\\KhamVaDieuTri\\ChiDinhPT', layttcdpt);
        //end xử lý channel
        
        function genPDFGTU(data1, data2) { 
            var deferreds = [];
            for (let i = 0; i < 2; i++) {
                var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvasGTU(i, deferred, data1, data2);
            }
            $.when.apply($, deferreds).then(function () { 
                $('#dtbigtu').text('Đã tạo xong!');
                $('#proccessgtu').addClass('hidden');
                $('button[class*="close"]').click();
            });
        }

        function generateCanvasGTU(i, deferred, data1, data2){
            html2canvas($("div[class*='printcontent_tu']:eq('"+i+"')")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent_tu']",i);
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
        
        $('#tbl_tamung').on ('click', 'button[data-button="btnxnldadongtu"]', function(){
            $('#dtbiareagtu').addClass('hidden');
            $('#proccessgtu').addClass('hidden');
            var id=$(this).attr('data-id');
            var loaidv=$(this).attr('data-loaidv');
            var name=$(this).attr('data-name');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('loaidv', loaidv);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/ke_toan/tam_ung/lay_tt',
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
                        $('.gtu_hoten').text(data.hoten);$('.gtu_mabn').text(data.mabn);$('.gtu_ns').text(data.ns);$('.gtu_dc').text(data.dc);$('.gtu_k').text(data.k);$('.gtu_st').text(data.st);
                        var d=new Date();
                        var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
                        var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
                        var nam=d.getFullYear();
                        $('.gtu_ngaythu').text('Ngày '+ngay+' tháng '+thang+' năm '+nam);
                        $('.gtu_nv').text(data.nv);
                        $('#btningtu').attr('data-id',id);
                        $('#btningtu').attr('data-name', name);
                        $('#btningtu').attr('data-loaidv',loaidv);
                    }
                    else if(data.msg == 'ktt'){
                        alert('Phiếu dịch vụ này không tồn tại, có thể đã bị xóa!');
                    }
                    else{
                        alert("Lấy thông tin phiếu dịch vụ thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy thông tin phiếu dịch vụ thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy thông tin phiếu dịch vụ thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy thông tin phiếu dịch vụ thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    } 
                }
            });
        });

        $('#btningtu').click(function(){
            var id=$(this).attr('data-id');
            var loaidv=$(this).attr('data-loaidv');
            var name=$(this).attr('data-name');
            var cf=confirm('Đã thu tiền của bệnh nhân '+name+'?');
            if(cf == false){
                return false;
            }
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('loaidv', loaidv);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/ke_toan/tam_ung/xn_tu',
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
                        $('#tbl_tamung tr').has('td div button[data-id="'+id+'"]').next('tr.spacer').remove();
                        $('#tbl_tamung tr').has('td div button[data-id="'+id+'"]').remove();
                        alert('Đã xác nhận thành công!');
                        var d=new Date();
                        var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
                        var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
                        var nam=d.getFullYear();
                        var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
                        var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
                        var giay=((d.getSeconds()<10) ? '0' : '') + d.getSeconds();
                        var data1='PHIEU_TAM_UNG_BN_'+data.hoten.toString().toUpperCase()+'_KHOA_'+data.khoa.toString().toUpperCase()+'_DV_'+data.dv.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam+'_'+gio+'_'+'_'+phut+'_'+giay+'_HDH';
                        var data2='PHIEU_TAM_UNG_BV_'+data.hoten.toString().toUpperCase()+'_KHOA_'+data.khoa.toString().toUpperCase()+'_DV_'+data.dv.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam+'_'+gio+'_'+'_'+phut+'_'+giay+'_HDX';
                        $('.stu').text(data.stu);
                        $('#dtbiareagtu').removeClass('hidden');$('#dtbigtu').text('Đang tạo bản in!');
                        $('#proccessgtu').removeClass('hidden');
                        genPDFGTU(data1, data2);
                    }
                    else if(data.msg == 'ktt'){
                        $('#dtbiareagtu').addClass('hidden');
                        $('#proccessgtu').addClass('hidden');
                        alert('Phiếu dịch vụ này không tồn tại, có thể đã bị xóa!');
                    }
                    else{
                        $('#dtbiareagtu').addClass('hidden');
                        $('#proccessgtu').addClass('hidden');
                        alert("Xác nhận tạm ứng thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareagtu').addClass('hidden');
                    $('#proccessgtu').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Xác nhận tạm ứng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Xác nhận tạm ứng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Xác nhận tạm ứng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    } 
                }
            });
            
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
                url: '/qlkcb/ke_toan/tam_ung/tim_kiem',
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
                            var dv='';
                            for(var i=0; i<data.dsdv.length; ++i){
                                dv+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.dsdv[i].id+'" data-name="'+data.dsdv[i].hoten+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td>'+data.dsdv[i].hoten+'</td>\n\
                                        <td>'+data.dsdv[i].dttn+'</td>\n\
                                        <td>'+data.dsdv[i].htdt+'</td>\n\
                                        <td>'+data.dsdv[i].tendv+'</td>\n\
                                        <td>'+data.dsdv[i].nvcd+'</td>\n\
                                        <td>'+data.dsdv[i].phongcd+'</td>\n\
                                        <td>'+data.dsdv[i].pth+'</td>\n\
                                        <td>'+data.dsdv[i].ngayracd+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="'+data.dsdv[i].id+'" data-name="'+data.dsdv[i].hoten+'" data-loaidv="'+data.dsdv[i].loaidv+'" data-toggle="modal" data-target="#modaltu">\n\
                                                    <i class="fa fa-check"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                            $('#tbl_tamung').html(dv);
                            $('#tbl_tamung button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                    
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" phiếu dịch vụ được tìm thấy!");
                        }
                        else{
                            $('#tbl_tamung').html("");
                            $('#kqtimliem').text("Không có phiếu dịch vụ nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/ke_toan/tam_ung/lay_ds_tu',
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
                        alert("Lỗi khi tải danh sách phiếu dịch vụ! Mô tả: "+data.msg);
                    }else{
                        var dv='';
                        for(var i=0; i<data.dsdv.length; ++i){
                            dv+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dsdv[i].id+'" data-name="'+data.dsdv[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.dsdv[i].hoten+'</td>\n\
                                    <td>'+data.dsdv[i].dttn+'</td>\n\
                                    <td>'+data.dsdv[i].htdt+'</td>\n\
                                    <td>'+data.dsdv[i].tendv+'</td>\n\
                                    <td>'+data.dsdv[i].nvcd+'</td>\n\
                                    <td>'+data.dsdv[i].phongcd+'</td>\n\
                                    <td>'+data.dsdv[i].pth+'</td>\n\
                                    <td>'+data.dsdv[i].ngayracd+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" rel="tooltip" data-placement="top" title="Đã đóng phí tạm ứng" data-button="btnxnldadongtu" data-id="'+data.dsdv[i].id+'" data-name="'+data.dsdv[i].hoten+'" data-loaidv="'+data.dsdv[i].loaidv+'" data-toggle="modal" data-target="#modaltu">\n\
                                                <i class="fa fa-check"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_tamung').html(dv);
                        $('#tbl_tamung button[data-button]').tooltip({
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
        
        //click check sum
        $('body').on('change', 'input[data-input="checksum"]', function(){
            if($(this).prop("checked")){
                $('#tbl_tamung input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_tamung input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_tamung').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksum"]').prop("checked",false);
            }
            else{
                if($('#tbl_tamung input[data-input="check"]:checked').length == $('#tbl_tamung input[data-input="check"]').length){
                    $('input[data-input="checksum"]').prop("checked",true);
                }   
            }
        });
        //end
        
        $(document).on("keypress", function (evt) {
            if (evt.keyCode == 27)
            {
                $('button[class="close"]').click();
            }
        });
    });
</script>
@endsection