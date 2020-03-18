@extends('ke_toan.layout')

@section('title')
    {{ "Lịch sử xác nhận tạm ứng phí dịch vụ" }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
        <input type="hidden" id="loaind" value="{{$nd->Quyen}}">
        <!-- DATA TABLE-->
        <section class="p-t-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" m-b-35">
                                <h3 class="title-5 font-weight-bold text-green">DANH SÁCH PHIẾU TẠM ỨNG PHÍ DỊCH VỤ Y TẾ - KT. {{mb_convert_case($nd->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8')}}</h3>
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
                                        <th style="position: sticky; top: 0; z-index: 99;">bệnh nhân</th>
                                        <th>Đối tượng tiếp nhận</th>
                                        <th>hình thức điều trị</th>
                                        <th>Bác sĩ điều trị</th>
                                        <th>Tên dịch vụ y tế</th>
                                        <th>Ngày Xác nhận</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_ptu">
                                    @if(isset($dsptu))
                                    @foreach($dsptu as $ptu)
                                        @if($ptu['loaidv'] == 'cls')
                                        @foreach($ptu['dsptu'] as $pcls)
                                            @if(is_object($pcls->canLamSang->benhAnNgoaiTru))
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $pcls->IdTA }}" data-name="<?php echo $pcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$pcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                <td>
                                                    @if($pcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                    BHYT
                                                    @else
                                                    Thu phí
                                                    @endif
                                                </td>
                                                <td>Ngoại trú</td>
                                                <td>{{$pcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV}}</td>
                                                <td>{{$pcls->canLamSang->danhMucCLS->TenCLS}}</td>
                                                <td>
                                                    {{\comm_functions::deDateFormat($pcls->created_at)}}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modaltu" data-button="btnxemtu" data-id="{{$pcls->canLamSang->IdCLS}}" rel="tooltip" title="Xem nội dụng" data-loaidv="cls">
                                                            <i class="fa fa-list-alt"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$pcls->IdTA}}" data-name="{{$pcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            @elseif(is_object($pcls->canLamSang->benhAnNoiTruCT))
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $pcls->IdTA }}" data-name="<?php echo $pcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$pcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                <td>
                                                    @if($pcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                    BHYT
                                                    @else
                                                    Thu phí
                                                    @endif
                                                </td>
                                                <td>Nội trú</td>
                                                <td>{{$pcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV}}</td>
                                                <td>{{$pcls->canLamSang->danhMucCLS->TenCLS}}</td>
                                                <td>
                                                    {{\comm_functions::deDateFormat($pcls->created_at)}}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modaltu" data-button="btnxemtu" data-id="{{$pcls->canLamSang->IdCLS}}" rel="tooltip" title="Xem nội dụng" data-loaidv="cls">
                                                            <i class="fa fa-list-alt"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$pcls->IdTA}}" data-name="{{$pcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            @endif
                                        @endforeach
                                        @elseif($ptu['loaidv'] == 'tt')
                                        @foreach($ptu['dsptu'] as $ptt)
                                            @if(is_object($ptt->chiDinhTT->benhAnNgoaiTru))
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $ptt->IdTA }}" data-name="<?php echo $ptt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$ptt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                <td>
                                                    @if($ptt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                    BHYT
                                                    @else
                                                    Thu phí
                                                    @endif
                                                </td>
                                                <td>Ngoại trú</td>
                                                <td>{{$ptt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV}}</td>
                                                <td>{{$ptt->chiDinhTT->danhMucCLS->TenCLS}}</td>
                                                <td>
                                                    {{\comm_functions::deDateFormat($ptt->created_at)}}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modaltu" data-button="btnxemtu" data-id="{{$ptt->chiDinhTT->IdThuThuat}}" rel="tooltip" title="Xem nội dụng" data-loaidv="tt">
                                                            <i class="fa fa-list-alt"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$ptt->IdTA}}" data-name="{{$ptt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            @elseif(is_object($ptt->chiDinhTT->benhAnNoiTruCT))
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $ptt->IdTA }}" data-name="<?php echo $ptt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$ptt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                <td>
                                                    @if($ptt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                    BHYT
                                                    @else
                                                    Thu phí
                                                    @endif
                                                </td>
                                                <td>Nội trú</td>
                                                <td>{{$ptt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV}}</td>
                                                <td>{{$ptt->chiDinhTT->danhMucCLS->TenCLS}}</td>
                                                <td>
                                                    {{\comm_functions::deDateFormat($ptt->created_at)}}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modaltu" data-button="btnxemtu" data-id="{{$ptt->chiDinhTT->IdThuThuat}}" rel="tooltip" title="Xem nội dụng" data-loaidv="tt">
                                                            <i class="fa fa-list-alt"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$ptt->IdTA}}" data-name="{{$ptt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            @endif
                                        @endforeach    
                                        @else
                                        @foreach($ptu['dsptu'] as $ppt)
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $ppt->IdTA }}" data-name="<?php echo $ppt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$ppt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                <td>
                                                    @if($ppt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                    BHYT
                                                    @else
                                                    Thu phí
                                                    @endif
                                                </td>
                                                <td>Nội trú</td>
                                                <td>{{$ppt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV}}</td>
                                                <td>{{$ppt->chiDinhPT->danhMucCLS->TenCLS}}</td>
                                                <td>
                                                    {{\comm_functions::deDateFormat($ppt->created_at)}}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modaltu" data-button="btnxemtu" data-id="{{$ppt->chiDinhPT->IdPT}}" rel="tooltip" title="Xem nội dụng" data-loaidv="pt">
                                                            <i class="fa fa-list-alt"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$ppt->IdTA}}" data-name="{{$ppt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                            <i class="zmdi zmdi-delete"></i>
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
                        <h5 class="modal-title" id="largeModalLabel1">Xem lại phiếu tạm ứng dịch vụ y tế</h5>
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
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL XÁC NHẬN TẠM ỨNG - PHIẾU MÀU HỒNG-->
        
    </div>
@endsection

@section('js')
<script src="public/js/pusher.js"></script>
<script>
    $(function () {
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false, htbn=false, bnddd=false, themba=false, flagcls=false, flagtt=false, file_name_tt='', tstrangtt = 1;
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

        $('#tbl_ptu').on ('click', 'button[data-button="btnxemtu"]', function(){
            var id=$(this).attr('data-id');
            var loaidv=$(this).attr('data-loaidv');
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
                        $('.gtu_ngaythu').text(data.ngaythu);
                        $('.gtu_nv').text(data.nv);
                        $('.stu').text(data.stu);
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
        
        $('#tbl_ptu').on('click','button[data-button="btnxoa"]',function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm('Bạn có chắc chắn muốn hủy phiếu tạm ứng dịch vụ của bệnh nhân '+name+'?');
            if(cf == false){
                return false;
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/ke_toan/lich_su_tam_ung/xoa',
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
                        if($('#tbl_ptu').children().length == 0){
                            $('input[data-input="checksum"]').prop("checked",false);
                        }
                        if(locds == true){
                            soluongl--;
                            if(soluongl == 0){
                                 $('#kqtimliem').text("");
                            }
                            else{
                                $('#kqtimliem').text("Có "+soluongl+" phiếu tạm ứng dịch vụ được tìm thấy!");
                            }
                        }
                        else{
                            if(tk == true){
                                soluongtk--;
                                if(soluongtk == 0){
                                    $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongtk+" phiếu tạm ứng dịch vụ tìm thấy!");
                                }
                            }
                        }
                        $('#tbl_ptu tr').has('td div button[data-id="'+id+'"]').next('tr.spacer').remove();
                        $('#tbl_ptu tr').has('td div button[data-id="'+id+'"]').remove();
                        
                        alert("Xóa thông tin phiếu tạm ứng dịch vụ thành công!");
                    }
                    else{
                        alert("Xóa phiếu tạm ứng dịch vụ gặp lỗi! Mô tả: "+data.msg);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Không thể xóa phiếu tạm ứng dịch vụ! Lỗi: "+jqXHR.msg+" | "+errorThrown);
                }
            });
        });
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if(!$('#tbl_ptu input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn phiếu tạm ứng dịch vụ để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[]
                $('#tbl_ptu input[data-input="check"]').each(function(){
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
                    cf=confirm("Bạn có thực sự muốn xóa các phiếu tạm ứng dịch vụ của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa phiếu tạm ứng dịch vụ của bệnh nhân "+name+"?");
                }
                if(cf==true){
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/ke_toan/lich_su_tam_ung/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" phiếu tạm ứng dịch vụ được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" phiếu tạm ứng dịch vụ được tìm thấy!");
                                            }
                                        }
                                    }
                                    for (var i = 0; i < arr.length; i++) {
                                        $('#tbl_ptu tr').has('td div button[data-id="'+arr[i]+'"]').next('tr.spacer').remove();
                                        $('#tbl_ptu tr').has('td div button[data-id="'+arr[i]+'"]').remove();
                                    }
                                    if($('#tbl_ptu').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các phiếu tạm ứng dịch vụ thành công!");
                                    
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" phiếu tạm ứng dịch vụ được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" phiếu tạm ứng dịch vụ được tìm thấy!");
                                        }
                                    }
                                    $('#tbl_ptu tr').has('td div button[data-id="'+arr[0]+'"]').next('tr.spacer').remove();
                                    $('#tbl_ptu tr').has('td div button[data-id="'+arr[0]+'"]').remove();
                                    
                                    if($('#tbl_ptu').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin phiếu tạm ứng dịch vụ thành công!");
                                    
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các phiếu tạm ứng dịch vụ thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin phiếu tạm ứng dịch vụ thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các phiếu tạm ứng dịch vụ thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các phiếu tạm ứng dịch vụ thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các phiếu tạm ứng dịch vụ thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                } 
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin phiếu tạm ứng dịch vụ thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin phiếu tạm ứng dịch vụ thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin phiếu tạm ứng dịch vụ thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                } 
                            }
                        }
                    });
                }
            }
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
                url: '/qlkcb/ke_toan/lich_su_tam_ung/tim_kiem',
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
                            var tt_ptu='';
                            
                            for(var i=0; i<data.dsptu.length; ++i){
                                tt_ptu+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dsptu[i].id+'" data-name="'+data.dsptu[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.dsptu[i].hoten+'</td>\n\
                                    <td>'+data.dsptu[i].dttn+'</td>\n\
                                    <td>'+data.dsptu[i].htdt+'</td>\n\
                                    <td>'+data.dsptu[i].bsdt+'</td>\n\
                                    <td>'+data.dsptu[i].tendv+'</td>\n\
                                    <td>'+data.dsptu[i].ngaylap+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" data-toggle="modal" data-target="#modaltu" data-button="btnxemtu" data-id="'+data.dsptu[i].idcls+'" rel="tooltip" title="Xem nội dụng" data-loaidv="'+data.dsptu[i].loaidv+'">\n\
                                                <i class="fa fa-list-alt"></i>\n\
                                            </button>\n\
                                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="'+data.dsptu[i].id+'" data-name="'+data.dsptu[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                            $('#tbl_ptu').html(tt_ptu);
                            $('#tbl_ptu button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                    
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" phiếu tạm ứng dịch vụ được tìm thấy!");
                        }
                        else{
                            $('#tbl_gcv').html("");
                            $('#kqtimliem').text("Không có phiếu tạm ứng dịch vụ nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/ke_toan/lich_su_tam_ung/lay_ds_tu',
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
                        alert("Lỗi khi tải danh sách phiếu tạm ứng dịch vụ! Mô tả: "+data.msg);
                    }else{
                        var tt_ptu='';
                            
                        for(var i=0; i<data.dsptu.length; ++i){
                            tt_ptu+='\n\
                                <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dsptu[i].id+'" data-name="'+data.dsptu[i].hoten+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.dsptu[i].hoten+'</td>\n\
                                <td>'+data.dsptu[i].dttn+'</td>\n\
                                <td>'+data.dsptu[i].htdt+'</td>\n\
                                <td>'+data.dsptu[i].bsdt+'</td>\n\
                                <td>'+data.dsptu[i].tendv+'</td>\n\
                                <td>'+data.dsptu[i].ngaylap+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button type="button" class="item" data-toggle="modal" data-target="#modaltu" data-button="btnxemtu" data-id="'+data.dsptu[i].idcls+'" rel="tooltip" title="Xem nội dụng" data-loaidv="'+data.dsptu[i].loaidv+'">\n\
                                            <i class="fa fa-list-alt"></i>\n\
                                        </button>\n\
                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="'+data.dsptu[i].id+'" data-name="'+data.dsptu[i].hoten+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_ptu').html(tt_ptu);
                        $('#tbl_ptu button[data-button]').tooltip({
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
                $('#tbl_ptu input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_ptu input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_ptu').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksum"]').prop("checked",false);
            }
            else{
                if($('#tbl_ptu input[data-input="check"]:checked').length == $('#tbl_ptu input[data-input="check"]').length){
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