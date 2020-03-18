
@extends('tiep_don.layout')

@section('title')
    {{ "Tiếp nhận cấp cứu" }}
@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="idphong" value="{{$nd->nhanVien->phongBan->IdPB}}">
        <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
                <!-- LẬP PHIẾU ĐĂNG KÝ CẤP CỨU-->
                <section class="p-t-20 hidden" id="formdkk">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">TIẾP NHẬN CẤP CỨU</h3>
                                    <hr class="line-seprate">
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body card-block">
                                                <form>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Đối tượng tiếp nhận</label>
                                                                <select class="form-control" id="htk">
                                                                    <option value="0">BHYT</option>
                                                                    <option value="1">Thu phí</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label" id="lblmabn">Mã bệnh nhân (<span class="color-red">*</span>)</label>
                                                                <input type="text" list="dlt_hoten" id="hoten" placeholder="Nhập họ tên bệnh nhân" class="form-control"/>
                                                                <datalist id="dlt_hoten">
                                                                    @if(isset($dsbn))
                                                                        @foreach($dsbn as $bn)
                                                                        <option value="{{$bn->IdBN}}">{{$bn->HoTen}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </datalist>
                                                                <input type="hidden" id="hoten_hide"> 
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
                                                        <div class="col-lg-2">
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
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Số điện thoại</label>
                                                                <input type="text" readonly="" class="form-control" id="sdt">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tuổi</label>
                                                                <input type="text" readonly="" class="form-control" id="tuoi">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Địa chỉ</label>
                                                                <input type="text" readonly="" class="form-control" id="diachi">
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
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Mã thẻ BHYT</label>
                                                                <input type="text" readonly="" class="form-control" id="mathe">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">GTSD từ ngày</label>
                                                                <input type="text" readonly="" class="form-control" id="ngaydk">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">TG đủ 5 năm LT từ ngày</label>
                                                                <input type="text" readonly="" class="form-control" id="ngayhh">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Nơi đăng ký KCBBĐ</label>
                                                                <input type="text" readonly="" class="form-control" id="ndk">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15 hidden thearea">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Đối tượng BHYT</label>
                                                                <input type="text" readonly="" class="form-control" id="doituong">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2"> 
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Mức hưởng</label>
                                                                <input type="text" readonly="" class="form-control" id="mh">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tuyến</label>
                                                                <input type="text" data-value="" readonly="" class="form-control" id="tuyen">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chuyển đến từ</label>
                                                                <input type="text" readonly="" class="form-control" id="chuyentu">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Giấy chuyển</label>
                                                                <select class="form-control" id="giaychuyen">
                                                                    <option value="0">Không có giấy chuyển</option>
                                                                    <option value="1">Có giấy chuyển</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Phòng khám</label>
                                                                <select class="form-control" id="phong">
                                                                    @if(isset($dsphong))
                                                                        @foreach($dsphong as $k)
                                                                        <option value="{{$k->IdPB}}">{{$k->SoPhong.' - '.$k->TenPhong}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        @if($nd->Quyen != 'admin')
                                                        <div class="col-lg-1 hidden" id="btnthemarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Thêm mới" id="btnthem"><span class="fa fa-plus"></span></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btnsuaarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Cập nhật" id="btncapnhat" data-id=""><span class="fa fa-edit"></span></button>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btnllarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--remove au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Làm lại" id="btnlamlai"><span class="fa fa-eraser"></span></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btninarea">
                                                            <div class="form-group">
                                                                <button type="button" rel="tooltip" title="In phiếu" class="au-btn au-btn--print au-btn--small au-btn-shadow height-43px" data-toggle ="modal" data-target="#mdprint" id="btnin"><span class="zmdi zmdi-print"></span></button>
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
                <!-- END LẬP PHIẾU ĐĂNG KÝ CẤP CỨU-->
                
                <!-- DANH SÁCH PHIẾU ĐĂNG KÝ CẤP CỨU VỪA THÊM-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH BỆNH NHÂN CẤP CỨU TIẾP NHẬN TRONG NGÀY</h3>
                                    <hr class="line-seprate">
                                </div>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light width-230px m-b-15">
                                            <select class="js-select2" id="htk_f">
                                                <option value="all">Tất cả đối tượng cấp cứu</option>
                                                <option value="0">BHYT</option>
                                                <option value="1">Thu phí</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <div class="rs-select2--light width-300px">
                                            <div class="au-breadcrumb-content">
                                                <form class="au-form-icon--sm" id="ftimkiem" >
                                                    <input type="text" class="au-input--w300 au-input--style2" id="txttimkiem" placeholder="Nhập thông tin cần tìm...">
                                                    <button type="button" class="au-btn--submit2" data-toggle="tooltip" title="Tìm kiếm" id="btntimkiem">
                                                        <i class="zmdi zmdi-search"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <div class="row">
                                            <div class="col-lg-4 m-b-15">
                                                <button type="button"  class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="fa fa-plus-square"></i></button>
                                            </div>
                                            <div class="col-lg-4 m-b-15">
                                                <button type="button" class="au-btn au-btn--teal au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Nạp lại danh sách" id="btnnapds"><i class="zmdi zmdi-refresh"></i></button>
                                            </div>
                                            <div class="col-lg-4 m-b-15">
                                                <button type="button" class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatc"><i class="zmdi zmdi-delete"></i></button>
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
                                                <th style="position: sticky; top: 0; z-index: 99;">Bệnh nhân</th>
                                                <th>Ngày sinh</th>
                                                <th>giới tính</th>
                                                <th>đối tượng cấp cứu</th>
                                                <th>Phòng tiếp nhận</th>
                                                <th>tuyến</th>
                                                <th>giấy chuyển</th>
                                                <th>Ngày tiếp nhận</th>
                                                <th>thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_phieudk">
                                            @if(isset($phieudk))
                                                @foreach($phieudk as $pdk)
                                                    <tr class="tr-shadow">
                                                        <td style="vertical-align: middle;">
                                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                                <input type="checkbox" data-input="check" data-id="{{ $pdk->IdPhieuDKKB }}" data-name="<?php echo $pdk->benhNhan->HoTen; ?>">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td data-idbn="<?php echo $pdk->benhNhan->IdBN; ?>"><?php echo $pdk->benhNhan->HoTen; ?></td>
                                                        <td data-ngaysinh="<?php echo $pdk->benhNhan->IdBN; ?>"><?php echo date('d/m/Y', strtotime($pdk->benhNhan->NgaySinh)); ?></td>
                                                        <td data-gt="<?php echo $pdk->benhNhan->IdBN; ?>">@if($pdk->benhNhan->GioiTinh == 1){{'Nam'}}@else {{'Nữ'}}@endif</td>
                                                        <td>
                                                            @if($pdk->KhamBHYT==0)
                                                                {{"BHYT"}}
                                                            @else
                                                                {{"Thu phí"}}
                                                            @endif
                                                        </td>
                                                        <td><?php echo $pdk->phongKham->SoPhong.' - '.$pdk->phongKham->TenPhong; ?></td>
                                                        <td>
                                                            @if($pdk->TuyenKham==0)
                                                                {{"Đúng tuyến"}}
                                                            @elseif($pdk->TuyenKham==1)
                                                                {{"Vượt tuyến (huyện)"}}
                                                            @else
                                                                {{"Vượt tuyến (xã)"}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($pdk->GiayChuyen==0)
                                                                {{"Không có giấy chuyển"}}
                                                            @else
                                                                {{"Có giấy chuyển"}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <?php
                                                                echo comm_functions::deDateFormat($pdk->created_at); 
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <button class="item" rel="tooltip" title="In phiếu" data-toggle="modal" data-target="#mdprint" data-placement="top" data-button="in" data-id="{{$pdk->IdPhieuDKKB}}">
                                                                    <i class="zmdi zmdi-print"></i>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{$pdk->IdPhieuDKKB}}">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{$pdk->IdPhieuDKKB}}" data-name="<?php echo $pdk->benhNhan->HoTen; ?>">
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
                <!-- END DANH SÁCH PHIẾU VỪA THÊM-->
                
                <!--MODAL PRINT-->
                <div class="modal fade" id="mdprint" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">In phiếu tiếp nhận cấp cứu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card" style="font-family: 'Noto Serif'; font-size: 10pt; font-weight: normal;">
                                    <div class="card-body card-block" id="printcontent" style="padding: 0;">
                                        <div class="row text-center">
                                            <div class="col-lg-12">
                                                <label id="lblpk"></label>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-lg-12">
                                                <label id="barcode_mabn" style="margin-bottom: 3px;"></label>
                                            </div>
                                        </div>
                                        <div class="row text-center" style="font-size: 11pt; font-weight: 700;">
                                            <div class="col-lg-12">
                                                <label style="margin: 0;"><?php echo mb_convert_case('phòng số:', MB_CASE_UPPER,'utf-8');?></label> <label id="sophong" style="margin: 0;"></label>
                                            </div>
                                        </div>
                                        <div class="row text-center" style="font-size: 11pt;">
                                            <div class="col-lg-12" style="margin: 0;">
                                                <label style="margin: 0;"><?php echo mb_convert_case('Số tiếp nhận:', MB_CASE_UPPER,'utf-8');?></label> <label id="sttkham" style="margin: 0; font-weight: 700;"></label>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-lg-12" style="margin: 0;">
                                                <label style="margin: 0;"><?php echo mb_convert_case('họ tên:', MB_CASE_UPPER,'utf-8');?></label> <label id="lblhoten" style="margin: 0; font-weight: 600;"></label>
                                            </div>
                                        </div>
                                        <div class="row text-center" style="font-size: 9pt; margin: 0;">
                                            <div class="col-lg-5">
                                                <label style="margin: 0;">Mã:</label> <label id="lblmabnin" style="margin: 0; font-weight: 600;"></label>
                                            </div>
                                            <div class="col-lg-7">
                                                <label style="margin: 0;">Ngày TN:</label> <label id="lblngaydk" style="margin: 0; font-weight: 600;"></label>
                                            </div>
                                        </div>
                                        <div class="row text-center" style="font-size: 8pt;">
                                            <div class="col-lg-12" style="margin-top: 5px;">
                                                <label id="lblnvlap"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row text-center'>
                                    <div class="col-lg-12">
                                        <button type="button" class="au-btn au-btn--darkgreen au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="In phiếu" id="btnprint"><span class="fa fa-download"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END MODAL PRINT-->
            </div>
@endsection

@section('js')
<script src="public/js/pusher.js"></script>
<script src="public/js/jspdf.debug.js"></script>
<script src="public/js/html2canvas.js"></script>
<script>
   
    $(function () {
        //khởi tạo flag tìm kiếm
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false, htbn=false;
        //end

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

        //Đăng ký với kênh CapCuu đã tạo trong file CapCuu.php
        var channel = pusher.subscribe('CapCuu');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                if($('#idphong').val() == data.dkkham.idphongdk){
                    var dkk='\n\
                        <tr class="tr-shadow">\n\
                            <td style="vertical-align: middle;">\n\
                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.dkkham.id+'" data-name="'+data.dkkham.hoten+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td data-idbn="'+data.dkkham.idbn+'">'+data.dkkham.hoten+'</td>\n\
                            <td>'+data.dkkham.ngaysinh+'</td>\n\
                            <td>'+data.dkkham.gt+'</td>\n\
                            <td>'+data.dkkham.htk+'</td>\n\
                            <td>'+data.dkkham.phong+'</td>\n\
                            <td>'+data.dkkham.tuyen+'</td>\n\
                            <td>'+data.dkkham.giaychuyen+'</td>\n\
                            <td>'+data.dkkham.ngaydkkham+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button class="item" rel="tooltip" title="In phiếu" data-toggle="modal" data-target="#mdprint" data-placement="top" data-button="in" data-id="'+data.dkkham.id+'">\n\
                                        <i class="zmdi zmdi-print"></i>\n\
                                    </button>\n\
                                    <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dkkham.id+'">\n\
                                        <i class="zmdi zmdi-edit"></i>\n\
                                    </button>\n\
                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dkkham.id+'" data-name="'+data.dkkham.hoten+'" data-idbn="'+data.dkkham.idbn+'">\n\
                                        <i class="zmdi zmdi-delete"></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>';
                    if(data.thaotac == 'them'){
                        dkk+='<tr class="spacer"></tr>';
                        $('#tbl_phieudk').prepend(dkk);

                    }
                    else{

                        $('#tbl_phieudk tr').has('td div button[data-id="'+data.dkkham.id+'"]').replaceWith(dkk);
                    }

                    $('button[data-id="'+data.dkkham.id+'"]').tooltip({
                        trigger: 'manual'

                    })
                    .focus(hideTooltip)
                    .blur(hideTooltip)
                    .hover(showTooltip, hideTooltip);
                }
            }
            else{
                if($.isArray(data.dkkham)){
                    for (var i = 0; i < data.dkkham.length; i++) {
                        $('#tbl_phieudk tr').has('td div button[data-id="'+data.dkkham[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_phieudk tr').has('td div button[data-id="'+data.dkkham[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_phieudk tr').has('td div button[data-id="'+data.dkkham+'"]').next('tr.spacer').remove();
                    $('#tbl_phieudk tr').has('td div button[data-id="'+data.dkkham+'"]').remove();
                    
                }  
            }
        }
        
        //Bind một function laytt với sự kiện CapCuu.php
        channel.bind('App\\Events\\TiepDon\\CapCuu', laytt);
        //end xử lý channel
        
        //Nếu có thay đổi các thông tin liên quan đến bệnh nhân thông tin trên view hiện tại sẽ thay đổi
        //Đăng ký với kênh BenhNhan đã tạo trong file BenhNhan.php
        var channel1 = pusher.subscribe('BenhNhan');
        function changeData(data) {
            if(data.thaotac == 'them'){
                var bn='<option value="'+data.benhnhan.id+'">'+data.benhnhan.hoten+'</option>';
                $('#dlt_hoten').prepend(bn);
            }
            else if(data.thaotac == 'sua'){
                var bn='<option value="'+data.benhnhan.id+'">'+data.benhnhan.hoten+'</option>';
                $('#dlt_hoten option[value="'+data.benhnhan.id+'"]').replaceWith(bn);
                
                $('#tbl_phieudk tr td[data-idbn="'+data.benhnhan.id+'"]').text(data.benhnhan.hoten);
                $('#tbl_phieudk tr td[data-ngaysinh="'+data.benhnhan.id+'"]').text(data.benhnhan.ngaysinh);
                $('#tbl_phieudk tr td[data-gt="'+data.benhnhan.id+'"]').text(data.benhnhan.gt);
            }
            else
            {
                
                if($.isArray(data.benhnhan)){
                    for (var i = 0; i < data.benhnhan.length; i++) {
                        $('#dlt_hoten option[value="'+data.benhnhan[i]+'"]').remove();
                        $('#tbl_phieudk tr').has('td[data-idbn="'+data.benhnhan[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_phieudk tr').has('td[data-idbn="'+data.benhnhan[i]+'"]').remove();
                    }
                }
                else{
                    $('#dlt_hoten option[value="'+data.benhnhan+'"]').remove();
                    $('#tbl_phieudk tr').has('td[data-idbn="'+data.benhnhan+'"]').next('tr.spacer').remove();
                    $('#tbl_phieudk tr').has('td[data-idbn="'+data.benhnhan+'"]').remove();
                }  
            }
            $('input[list="dlt_hoten"]').trigger('input',[false, "null"]);
        }
        
        //Bind một function changeData với sự kiện BenhNhan.php
        channel1.bind('App\\Events\\TiepDon\\BenhNhan', changeData);
        //end xử lý channel
        
        //Nếu có thay đổi các thông tin liên quan đến thẻ bhyt thông tin trên view hiện tại sẽ thay đổi
        //Đăng ký với kênh TheBHYT đã tạo trong file TheBHYT.php
        var channel2 = pusher.subscribe('TheBHYT');
        function changeDataThe() {
            $('input[list="dlt_hoten"]').trigger('input', [false, "null"]);
        }
        
        //Bind một function changeDataThe với sự kiện TheBHYT.php
        channel2.bind('App\\Events\\TiepDon\\TheBHYT', changeDataThe);
        //end xử lý channel
        
        //chọn khám thu phí
        $('#htk').change(function(){
            if($(this).val() == 1)
            {
                $('#giaychuyen').val(0);
                $('#giaychuyen').attr('disabled','');
            }
            else
            {
                if($('#tuyen').attr('data-value') != 0)
                {
                    $('#giaychuyen').removeAttr('disabled');
                }
                else
                {
                    $('#giaychuyen').attr('disabled','');
                }
            }
        });
        //end

        //Submit thêm mới đăng ký khám
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var hoten=$('#hoten_hide').val(), phong=$('#phong').val(), htk=$('#htk').val();
            
            //chọn khám thu phí
            var tuyen=$('#tuyen').attr('data-value');
            var giaychuyen=$('#giaychuyen').val();
            if($('#htk').val() == 1){
                tuyen=0;
                giaychuyen=0;
            }
            //end
            if(hoten.toString().trim() == '' || htbn==false){
                alert("Vui lòng nhập chính xác thông tin họ tên bệnh nhân!");
                return false;
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('hoten', hoten);
            formData.append('phong', phong);
            formData.append('htk', htk);
            formData.append('tuyen', tuyen);
            formData.append('giaychuyen', giaychuyen);
            formData.append('cc', 'cc');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/dang_ky_kham/them_moi',
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
                        alert("Thêm phiếu tiếp nhận cấp cứu thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);
                        $('#kqtimliem').text("");
                        tk=false;locds=false;keySearch='';
                        $('#btnin').attr('data-id',data.id);
                        $('#btninarea').fadeIn(800);
                    }
                    else if(data.msg == 'trung'){
                        alert("Đã tiếp nhận bệnh nhân váo cấp cứu!");
                    }
                    else if(data.msg == 'thektt'){
                        alert("Thẻ BHYT của bệnh nhân này không tồn tại, có thể đã bị hủy!");
                    }
                    else if(data.msg == 'thehh'){
                        alert("Thẻ BHYT đã hết giá trị sử dụng!");
                    }
                    else if(data.msg == 'dangdt'){
                        alert("Bệnh nhân đang được điều trị!");
                    }
                    else{
                        $('#btninarea').fadeOut(800);
                        alert("Thêm phiếu tiếp nhận cấp cứu thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#btninarea').fadeOut(800);
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
        // end Submit thêm mới phiếu đăng ký khám
        
        //Submit cập nhật phiếu đăng ký khám
        $('#btncapnhat').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            
            var hoten=$('#hoten').val(), phong=$('#phong').val(), htk=$('#htk').val(), id=$(this).attr('data-id');
            
            var tuyen=$('#tuyen').attr('data-value');
            var giaychuyen=$('#giaychuyen').val();

            if(hoten.toString().trim() == '' || htbn==false){
                alert("Bệnh nhân không tồn tại, có thể đã bị xóa thông tin!");
                return false;
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('hoten', hoten);
            formData.append('phong', phong);
            formData.append('htk', htk);
            formData.append('tuyen', tuyen);
            formData.append('giaychuyen', giaychuyen);
            formData.append('id', id);
            formData.append('cc', 'cc');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/dang_ky_kham/cap_nhat',
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
                        alert("Cập nhật thông tin phiếu tiếp nhận cấp cứu thành công!");
                    }
                    else if(data.msg == 'da_lap_ba'){
                        alert("Phiếu tiếp nhận cấp cứu này đã lập bệnh án, không cập nhật được!");
                    }
                    else{
                        alert("Cập nhật thông tin phiếu tiếp nhận cấp cứuthất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin phiếu tiếp nhận cấp cứu thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin phiếu tiếp nhận cấp cứu thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin phiếu tiếp nhận cấp cứu thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật phiếu đăng ký khám
        
        //mở form preview bản in trên from nhập
        $('#btnin').click(function(){
            var formData = new FormData();
            var id=$(this).attr('data-id');
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/dang_ky_kham/in',
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
                        $('#lblpk').text(data.pk);$('#barcode_mabn').html(data.bar_code);$('#sophong').text(data.sophong);$('#sttkham').text(data.sttkham);$('#lblhoten').text(data.hoten);$('#lblmabnin').text(data.mabn);$('#lblngaydk').text(data.ngaydk);$('#lblnvlap').text(data.nvlap);
                        $('#btnprint').attr('data-id',id);
                    }
                    else{
                        alert("Lấy dữ liệu in thất bại. Lỗi: "+data.msg);
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy dữ liệu in thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        return false;
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy dữ liệu in thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        return false;
                    }
                    else{
                        alert("Lấy dữ liệu in thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        return false;
                    }
                }
            });
        });
        //end mở form preview bản in trên from nhập
        
        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formdkk').slideUp(800);
        });
        //end đóng form nhập liệu
        //
        //mở form để thêm
        $('#btnadd').click(function(){
            $('#btnthemarea').fadeIn(800);
            $('#btnllarea').fadeIn(800);
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('TIẾP NHẬN CẤP CỨU');
            $('#btnlamlai').click();
            $('#hoten').removeAttr('readonly');
            $('#lblmabn').html('Mã bệnh nhân (<span class="color-red">*</span>)');
            $('#btninarea').fadeOut(800);
            $('html, body').animate({
                scrollTop: $("#formdkk").offset().top
            }, 800);
            $('#formdkk').slideDown(800);
        });
        //end mở form để thêm
        
        //xóa phiếu dăng ký khám
        $('#tbl_phieudk').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin phiếu tiếp nhận cấp cứu của bệnh nhân "+name+"?");
            if(cf==true){
                if($('#btnsuaarea').css('display') == 'block' && $('#btncapnhat').attr('data-id') == id){//đóng form sửa khi click xóa
                   $('#btndong').click();
                }
                if($('#btninarea').css('display') == 'block' && $('#btnin').attr('data-id')==id){
                    $('#btninarea').fadeOut(800);
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                formData.append('cc', 'cc');
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/tiep_don/dang_ky_kham/xoa',
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
                            if(data.flag == false){
                                if(locds == true){
                                    soluongl--;
                                    if(soluongl == 0){
                                         $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongl+" phiếu tiếp nhận cấp cứu được tìm thấy!");
                                    }
                                }
                                else{
                                    if(tk == true){
                                        soluongtk--;
                                        if(soluongtk == 0){
                                            $('#kqtimliem').text("");
                                        }
                                        else{
                                            $('#kqtimliem').text("Có "+soluongtk+" phiếu tiếp nhận cấp cứu tìm thấy!");
                                        }
                                    }
                                }

                                alert("Xóa thông tin phiếu tiếp nhận cấp cứu thành công!");
                            }
                            else{
                                alert("Phiếu tiếp nhận cấp cứu này đã lập bệnh án, không xóa được!");
                            }
                            
                        }
                        else{
                            alert("Xóa thông tin phiếu tiếp nhận cấp cứu thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin phiếu tiếp nhận cấp cứu thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin phiếu tiếp nhận cấp cứu thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin phiếu tiếp nhận cấp cứu thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa phiếu đăng ký khám
        
        //mở form để sửa
        $('#tbl_phieudk').on('click','button[data-button="sua"]',function(){
            $('#btnthemarea').fadeOut(800);
            $('#btnllarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT TIẾP NHẬN CẤP CỨU');
            
            var formData = new FormData();
            var id=$(this).attr('data-id');
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            $('#btncapnhat').attr('data-id',id);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/dang_ky_kham/lay_tt_cap_nhat',
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
                    $('#hoten').val(data.hoten);$('#hoten').attr('readonly', '');$('#lblmabn').text('Mã bệnh nhân');
                    $('#btnin').attr('data-id',id);
                    
                    $('input[list="dlt_hoten"]').trigger('input', [true, data]);
                    $('html, body').animate({
                        scrollTop: $("#formdkk").offset().top
                    }, 800);
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
        
        //mở modal preview bản in
        $('#tbl_phieudk').on('click','button[data-button="in"]',function(){
            var formData = new FormData();
            var id=$(this).attr('data-id');
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/dang_ky_kham/in',
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
                    $('#lblpk').text(data.pk);$('#barcode_mabn').html(data.bar_code);$('#sophong').text(data.sophong);$('#sttkham').text(data.sttkham);$('#lblhoten').text(data.hoten);$('#lblmabnin').text(data.mabn);$('#lblngaydk').text(data.ngaydk);$('#lblnvlap').text(data.nvlap);
                    $('#btnprint').attr('data-id',id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy dữ liệu in thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy dữ liệu in thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy dữ liệu in thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end mở modal preview bản in
        
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
            formData.append('cc', 'cc');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/dang_ky_kham/tim_kiem',
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
                            var dkk='';
                            for(var i=0; i<data.dkkham.length; ++i){
                                dkk+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dkkham[i].id+'" data-name="'+data.dkkham[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td data-idbn="'+data.dkkham[i].idbn+'">'+data.dkkham[i].hoten+'</td>\n\
                                    <td data-ngaysinh="'+data.dkkham[i].idbn+'">'+data.dkkham[i].ngaysinh+'</td>\n\
                                    <td data-gt="'+data.dkkham[i].idbn+'">'+data.dkkham[i].gt+'</td>\n\
                                    <td>'+data.dkkham[i].htk+'</td>\n\
                                    <td>'+data.dkkham[i].phong+'</td>\n\
                                    <td>'+data.dkkham[i].tuyen+'</td>\n\
                                    <td>'+data.dkkham[i].giaychuyen+'</td>\n\
                                    <td>'+data.dkkham[i].ngaydk+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" rel="tooltip" title="In phiếu" data-toggle="modal" data-target="#mdprint" data-placement="top" data-button="in" data-id="'+data.dkkham[i].id+'">\n\
                                                <i class="zmdi zmdi-print"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dkkham[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dkkham[i].id+'" data-name="'+data.dkkham[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }

                            $('#tbl_phieudk').html(dkk);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                    
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" phiếu tiếp nhân cấp cứu được tìm thấy!");
                        }
                        else{
                            $('#tbl_phieudk').html("");
                            $('#kqtimliem').text("Không có phiếutiếp nhận cấp cứu nào được tìm thấy!");tk=false;
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

        //lọc danh sách
        $('#htk_f').change(function (){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('dtk', $(this).val());
            formData.append('cc', 'cc');
            if(tk == true){
                formData.append('keySearch', keySearch);
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/dang_ky_kham/loc_ds',
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
                        alert("Lọc danh sách gặp phải lỗi! Mô tả: "+data.msg);
                    }else{
                        if(data.sl > 0){
                            soluongl=data.sl;
                            var dkk='';
                            for(var i=0; i<data.dkkham.length; ++i){
                                
                                dkk+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td>\n\
                                        <label class="au-checkbox">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dkkham[i].id+'" data-name="'+data.dkkham[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td data-idbn="'+data.dkkham[i].idbn+'">'+data.dkkham[i].hoten+'</td>\n\
                                    <td data-ngaysinh="'+data.dkkham[i].idbn+'">'+data.dkkham[i].ngaysinh+'</td>\n\
                                    <td data-gt="'+data.dkkham[i].idbn+'">'+data.dkkham[i].gt+'</td>\n\
                                    <td>'+data.dkkham[i].htk+'</td>\n\
                                    <td>'+data.dkkham[i].phong+'</td>\n\
                                    <td>'+data.dkkham[i].tuyen+'</td>\n\
                                    <td>'+data.dkkham[i].giaychuyen+'</td>\n\
                                    <td>'+data.dkkham[i].ngaydk+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" rel="tooltip" title="In phiếu" data-toggle="modal" data-target="#mdprint" data-placement="top" data-button="in" data-id="'+data.dkkham[i].id+'">\n\
                                                <i class="zmdi zmdi-print"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dkkham[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dkkham[i].id+'" data-name="'+data.dkkham[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }

                            $('#tbl_phieudk').html(dkk);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                            
                            $('#kqtimliem').text("Có "+data.sl+" phiếu đăng ký khám được tìm thấy!");locds=true;
                            
                        }
                        else{
                            $('#tbl_phieudk').html("");
                            $('#kqtimliem').text("Không có phiếu đăng ký khám nào được tìm thấy!");locds=false;
                        }
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lọc danh sách thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lọc danh sách thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lọc danh sách thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end lọc danh sách
 
        //Nạp lại danh sách phiếu dk
        $('#btnnapds').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('cc', 'cc');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/dang_ky_kham/lay_ds_pdk',
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
                        alert("Lỗi khi tải danh sách phiếu đăng ký khám! Mô tả: "+data.msg);
                    }else{
                        var dkk='';
                        for(var i=0; i<data.dkkham.length; ++i){
                            
                            dkk+='\n\
                                <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dkkham[i].id+'" data-name="'+data.dkkham[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td data-idbn="'+data.dkkham[i].idbn+'">'+data.dkkham[i].hoten+'</td>\n\
                                    <td data-ngaysinh="'+data.dkkham[i].idbn+'">'+data.dkkham[i].ngaysinh+'</td>\n\
                                    <td data-gt="'+data.dkkham[i].idbn+'">'+data.dkkham[i].gt+'</td>\n\
                                    <td>'+data.dkkham[i].htk+'</td>\n\
                                    <td>'+data.dkkham[i].phong+'</td>\n\
                                    <td>'+data.dkkham[i].tuyen+'</td>\n\
                                    <td>'+data.dkkham[i].giaychuyen+'</td>\n\
                                    <td>'+data.dkkham[i].ngaydk+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" rel="tooltip" title="In phiếu" data-toggle="modal" data-target="#mdprint" data-placement="top" data-button="in" data-id="'+data.dkkham[i].id+'">\n\
                                                <i class="zmdi zmdi-print"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dkkham[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dkkham[i].id+'" data-name="'+data.dkkham[i].hoten+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }

                        $('#tbl_phieudk').html(dkk);
                        $('#tbl_phieudk button[data-id]').tooltip({
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
        
        //reset input
        $('#btnlamlai').click(function(){
            $('#hoten').val("");$('#btninarea').fadeOut(800);
            $('input[list="dlt_hoten"]').trigger('input', [false, "null"]);
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
        $('#tbl_phieudk').on('change', 'input[data-input="check"]', function(){
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
                alert("Bạn chưa chọn phiếu đăng ký khám để xóa!");
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin phiếu tiếp nhận cấp cứu của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin phiếu tiếp nhận cấp cứu của bệnh nhân "+name+"?");
                }
                if(cf==true){
                    for(var i=0; i<arr.length; i++){
                        if($('#btnsuaarea').css('display') == 'block' && $('#btncapnhat').attr('data-id') == arr[i]){//đóng form sửa khi click xóa
                           $('#btndong').click();
                        }
                        if($('#btninarea').css('display') == 'block' && $('#btnin').attr('data-id')==arr[i]){
                            $('#btninarea').fadeOut(800);
                        }
                    }
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    formData.append('cc', 'cc');
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/tiep_don/dang_ky_kham/xoa',
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
                                    if(data.flag == false){
                                        if(locds == true){
                                            soluongl = soluongl - arr.length;
                                            if(soluongl == 0)
                                            {
                                                $('#kqtimliem').text("");
                                            }
                                            else
                                            {
                                                $('#kqtimliem').text("Có "+soluongl+" phiếu tiếp nhận cấp cứu được tìm thấy!");
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
                                                    $('#kqtimliem').text("Có "+soluongtk+" phiếu tiếp nhận cấp cứu được tìm thấy!");
                                                }
                                            }
                                        }

                                        alert("Xóa thông tin các phiếu tiếp nhận cấp cứu thành công!");
                                    }
                                    else{
                                        alert("Một số phiếu tiếp nhận cấp cứu đã lập bệnh án, những phiếu này không xóa được!");
                                    }
                                    
                                    $('input[data-input="checksum"]').prop("checked",false);
                                    
                                }
                                else
                                {
                                    if(data.flag == false){
                                        if(locds == true){
                                            $('#kqtimliem').text("Có "+(soluongl - 1)+" phiếu tiếp nhận cấp cứu được tìm thấy!");
                                        }
                                        else{
                                            if(tk == true){
                                                $('#kqtimliem').text("Có "+(soluongtk - 1)+" phiếu tiếp nhận cấp cứu được tìm thấy!");
                                            }
                                        }

                                        alert("Xóa thông tin phiếu tiếp nhận cấp cứu thành công!");
                                    }
                                    else{
                                        alert("Phiếu tiếp nhận cấp cứu này đã lập bệnh án, không xóa được!");
                                    }
                                    $('input[data-input="checksum"]').prop("checked",false);
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các phiếu tiếp nhận cấp cứu thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin phiếu tiếp nhận cấp cứu thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các phiếu tiếp nhận cấp cứu thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các phiếu tiếp nhận cấp cứu thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các phiếu tiếp nhận cấp cứu thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin phiếu tiếp nhận cấp cứu thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin phiếu tiếp nhận cấp cứu thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin phiếu tiếp nhận cấp cứu thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }
                
            }
        });
        //end
        
        //xử lý lấy phần text cho datalist họ tên
        $('input[list="dlt_hoten"]').on('input', function(e, flag, dt) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('hoten_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];

                if(option.value === inputValue || option.innerText === inputValue) {
                    input.value=option.innerText;
                    htbn=true;
                    hiddenInput.value=option.value;
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('idbn', option.value);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/tiep_don/dang_ky_kham/lay_tt_bn',
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
                            $('#ngaysinh').val(data.ngaysinh);$('#gt').val(data.gt);$('#dantoc').val(data.dantoc);$('#scmnd').val(data.scmnd);$('#sdt').val(data.sdt);$('#diachi').val(data.diachi);$('#tuoi').val(data.tuoi);
                            if(data.anh != null)
                            {
                                $('p[class*="anhbn"]').addClass('hidden');$('img[class*="anhbn"]').attr('src','public/upload/anhbn/'+data.anh);$('img[class*="anhbn"]').removeClass('hidden');
                            }
                            else
                            {
                                $('p[class*="anhbn"]').removeClass('hidden');$('img[class*="anhbn"]').addClass('hidden');
                            }   
                            if(data.idthe != 'null')
                            {
                                $('#mathe').val(data.idthe);$('#ngaydk').val(data.ngaydk);$('#ngayhh').val(data.ngayhh);$('#ndk').val(data.ndk);$('#doituong').val(data.doituong);$('#mh').val(data.mh);
                                if(data.tuyencode == 'dung_tuyen'){
                                    $('#tuyen').val('Đúng tuyến');$('#chuyentu').val('Không chuyển');
                                    $('#giaychuyen').val(0);
                                    $('#giaychuyen').attr('disabled','');
                                    $('#tuyen').attr('data-value',0);
                                    $('#htk').val(0);
                                }
                                else{
                                    $('#tuyen').val('Vượt tuyến');
                                    $('#chuyentu').val(data.chuyentu);
                                    if(data.chuyentucode == 'tuyen_huyen'){
                                        $('#tuyen').attr('data-value',1);
                                    }
                                    else{
                                        $('#tuyen').attr('data-value',2);
                                    }
                                    $('#giaychuyen').removeAttr('disabled');
                                }
                                    
                                $('.thearea').removeClass('hidden');
                                $('#htk').removeAttr('disabled');
                                if($('#htk').val() == 1)
                                {
                                    $('#htk').val(0);//reset
                                    $('#giaychuyen').val(0);
                                    $('#giaychuyen').removeAttr('disabled');
                                }
                            }
                            else{
                                $('#mathe').val('');
                                $('#tuyen').attr('data-value',0);$('#giaychuyen').val(0);$('#htk').val(1);$('#htk').attr('disabled','');$('#giaychuyen').attr('disabled','');$('#tuyen').attr('data-value',0);
                                $('.thearea').addClass('hidden');
                            }
                            
                            if(flag == true) //lấy thông tin cập nhật
                            {
                                $('#htk').val(dt.htk);$('#tuyen').attr('data-value', dt.tuyen);$('#giaychuyen').val(dt.giaychuyen);$('#khoa').val(dt.khoa);$('#khoa').change();$('#phong').val(dt.phong);
                                $('#htk').change();
                                $('#btninarea').fadeIn(800);
                                $('#formdkk').slideDown(800);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(jqXHR.status == 419){
                                alert("Lấy thông tin bệnh nhân thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                            }
                            else if(jqXHR.status == 500){
                                alert("Lấy thông tin bệnh nhân thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                            }
                            else{
                                alert("Lấy thông tin bệnh nhân thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                            }
                            if(flag == true) //lấy thông tin cập nhật
                            {
                                $('#formdkk').slideUp(800);
                            }
                            else{
                                htbn=false;
                                $('#ngaysinh').val('');$('#gt').val('');$('#dantoc').val('');$('#scmnd').val('');$('#sdt').val('');$('#diachi').val('');$('#tuoi').val('');
                                
                                $('#doituong').val('');$('#mathe').val('');$('#ndk').val('');$('#dt').val('');$('#mh').val('');$('#tuyen').val('');$('#chuyentu').val('');$('#ngaydk').val('');$('#ngayhh').val('');
                                
                                $('.thearea').addClass('hidden');$('#htk').removeAttr('disabled');
                                $('p[class*="anhbn"]').addClass('hidden');
                                $('img[class*="anhbn"]').addClass('hidden');
                            }
                            return false;
                        }
                    });
                    break;
                }
                else{
                    hiddenInput.value='';
                    htbn=false;
                    $('#ngaysinh').val('');$('#gt').val('');$('#dantoc').val('');$('#scmnd').val('');$('#sdt').val('');$('#diachi').val('');$('#tuoi').val('');

                    $('.thearea').addClass('hidden');$('#htk').removeAttr('disabled');
                    $('p[class*="anhbn"]').removeClass('hidden');
                    $('img[class*="anhbn"]').addClass('hidden');
                    $('#btninarea').fadeOut(800);
                }  
            }
        });
        //end
        
        var pdf,element_section,HTML_Width,HTML_Height,top_left_margin,PDF_Width,PDF_Height;
	
        function calculatePDF_height_width(selector,index){
		element_section = $(selector).eq(index);
		HTML_Width = element_section.width();
		HTML_Height= element_section.height();
		top_left_margin = 1;
		PDF_Width = HTML_Width + (top_left_margin * 2);
		PDF_Height = HTML_Height + (top_left_margin * 2);
	}
        
        //in phiếu
        $('#btnprint').click(function(){
            pdf = new jsPDF('p','pt');
            var id=$(this).attr('data-id');
            html2canvas($("#printcontent")[0], {
                useCORS: true, scale: 5}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                   'image/png');
                calculatePDF_height_width($("#printcontent")[0],0);
                pdf = new jsPDF('l','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'PNG', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.autoPrint({variant: 'non-conform'});
                pdf.save(id+'.pdf');

            });
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