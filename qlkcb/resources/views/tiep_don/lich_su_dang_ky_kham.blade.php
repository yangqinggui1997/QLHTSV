@extends('tiep_don.layout')

@section('title')
    {{ "Lịch sử đăng ký khám bệnh" }}
@endsection

@section('css')
<link href="public/css/tempusdominus-bootstrap-4.css" rel="stylesheet" media="all">
@endsection

@section('content')
    <div class="main-content">
                <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
                <!-- THÔNG TIN PHIẾU KHÁM-->
                <section class="p-t-20 hidden" id="formdkk">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">THÔNG TIN PHIẾU ĐĂNG KÝ KHÁM BỆNH</h3>
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
                                                                <label class=" form-control-label">Hình thức khám</label>
                                                                <input type="text" class="form-control" id="htk" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Họ tên bệnh nhân</label>
                                                                <input type="text" id="hoten" readonly="" class="form-control"/>
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
                                                                <img class="avatar hidden anhbn" src="anh/" alt="Ảnh bệnh nhân">                                                  
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
                                                                <input type="text" readonly="" class="form-control" id="giaychuyen">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Khoa khám</label>
                                                               <input type="text" readonly=""class="form-control" id="khoa">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Phòng khám</label>
                                                                <input type="text" readonly="" class="form-control" id="phong">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
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
                <!-- END LẬP PHIẾU KHÁM-->
                
                <!-- DANH SÁCH PHIẾU ĐĂNG KÝ KHÁM-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH PHIẾU ĐĂNG KÝ KHÁM BỆNH</h3>
                                    <hr class="line-seprate">
                                </div>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="khoa_f">
                                                <option value="all">Tất cả khoa</option>
                                                @if(isset($dskhoa))
                                                    @foreach($dskhoa as $k)
                                                    <option value="{{$k->IdKhoa}}">{{$k->TenKhoa}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-240px m-b-15">
                                            <select class="js-select2" id="tg_f">
                                                <option value="all">K.lọc theo thời gian tiếp nhận</option>
                                                <option value="0">Lọc theo thời gian tiếp nhận</option>
                                                
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md m-b-15" data-toggle="tooltip" data-placement="bottom" title="Từ ngày">
                                            <div class="input-group date" id="datetimepickerfilter" data-target-input="nearest">
                                                <input onkeydown="return false" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerfilter" id="txtthoigiantao" />
                                                <div class="input-group-append" data-target="#datetimepickerfilter" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md m-b-15" data-toggle="tooltip" data-placement="bottom" title="Đến ngày">
                                            <div class="input-group date" id="datetimepickerfilter1" data-target-input="nearest">
                                                <input onkeydown="return false" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerfilter1" id="txtthoigiankt" />
                                                <div class="input-group-append" data-target="#datetimepickerfilter1" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rs-select2--light width-230px m-b-15">
                                            <select class="js-select2" id="htk_f">
                                                <option value="all">Tất cả đối tượng khám</option>
                                                <option value="0">BHYT</option>
                                                <option value="1">Thu phí</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="gt_f">
                                                <option value="all">Tất cả phái</option>
                                                <option value="0">Nữ</option>
                                                <option value="1">Nam</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="tinh_f">
                                                <option value="all">Tất cả tỉnh / thành phố</option>
                                                @if(isset($dstinh))
                                                    <?php foreach($dstinh as $t){ ?>
                                                <option value="<?php echo $t->IdTinh; ?>">{{$t->TenTinh}}</option>
                                                    <?php }?>
                                                @endif
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="huyen_f">
                                                <option value="all">Tất cả quận / huyện</option>
                                                
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="xa_f">
                                                <option value="all">Tất cả phường / xã</option>
                                                
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-180px">
                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Lọc danh sách" id="btnlocds">
                                            <i class="fa fa-filter"></i></button>
                                        </div>
                                    </div>
<!--                                    <div class="table-data__tool-right">
                                        
                                    </div>-->
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
                                            <div class="col-lg-6 m-b-15">
                                                <button type="button" class="au-btn au-btn--teal au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Nạp lại danh sách" id="btnnapds"><i class="zmdi zmdi-refresh"></i></button>
                                            </div>
                                            <div class="col-lg-6 m-b-15">
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
                                                <th>khoa khám</th>
                                                <th>phòng khám</th>
                                                <th>Đối tượng tiếp nhận</th>
                                                <th>tuyến</th>
                                                <th>giấy chuyển</th>
                                                <th>ngày đăng ký</th>
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
                                                        <td><?php echo $pdk->phongKham->Khoa->TenKhoa; ?></td>
                                                        <td><?php echo $pdk->phongKham->SoPhong.' - '.$pdk->phongKham->TenPhong; ?></td>
                                                        <td>
                                                            @if($pdk->KhamBHYT==0)
                                                                {{"BHYT"}}
                                                            @else
                                                                {{"Thu phí"}}
                                                            @endif
                                                        </td>
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
                                                                $timeStamp = date( "d/m/Y", strtotime($pdk->created_at));
                                                                echo $timeStamp;  
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-button="xemct" data-id="{{$pdk->IdPhieuDKKB}}">
                                                                    <i class="fa fa-info"></i>
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
                <!-- END DANH SÁCH PHIẾU ĐĂNG KÝ KHÁM-->
            </div>
@endsection

@section('js')
<script src="public/js/moment.js"></script>
<script src="public/js/tempusdominus-bootstrap-4.js"></script>
<script src="public/js/datepicker.js"></script>
<script src="public/js/pusher.js"></script>
<script src="public/js/jspdf.debug.js"></script>
<script src="public/js/html2canvas.js"></script>
<script>
   
    $(function () {
        //khởi tạo flag tìm kiếm
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false, htbn=false;
        //end
        
        $('#txtthoigiantao').on('input', function (){
           $('#datetimepickerfilter1').datetimepicker('minDate', '01/01/1900 00:00'); 
           $('#datetimepickerfilter1').datetimepicker('maxDate', new Date()); 
        });
        
        $('#txtthoigiantaotk').on('input', function (){
           $('#datetimepickerfilter2').datetimepicker('minDate', '01/01/1900 00:00'); 
           $('#datetimepickerfilter2').datetimepicker('maxDate', new Date()); 
        });
        
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

        //Đăng ký với kênh DangKyKham đã tạo trong file DangKyKham.php
        var channel = pusher.subscribe('DangKyKham');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var dkk='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.dkkham.id+'" data-name="'+data.dkkham.hoten+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td data-idbn="'+data.dkkham.idbn+'">'+data.dkkham.hoten+'</td>\n\
                        <td>'+data.dkkham.khoa+'</td>\n\
                        <td>'+data.dkkham.phong+'</td>\n\
                        <td>'+data.dkkham.htk+'</td>\n\
                        <td>'+data.dkkham.tuyen+'</td>\n\
                        <td>'+data.dkkham.giaychuyen+'</td>\n\
                        <td>'+data.dkkham.ngaydk+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-button="xemct" data-id="'+data.dkkham.id+'">\n\
                                    <i class="fa fa-info"></i>\n\
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
        
        //Bind một function laytt với sự kiện DangKyKham.php
        channel.bind('App\\Events\\TiepDon\\DangKyKham', laytt);
        //end xử lý channel
        
        //Nếu có thay đổi các thông tin liên quan đến bệnh nhân thông tin trên view hiện tại sẽ thay đổi
        //Đăng ký với kênh BenhNhan đã tạo trong file BenhNhan.php
        var channel1 = pusher.subscribe('BenhNhan');
        function changeData(data) {
            if(data.thaotac == 'sua'){
                $('#hoten[data-id="'+data.benhnhan.id+'"]').val(data.benhnhan.hoten);
                
                $('#tbl_phieudk tr td[data-idbn="'+data.benhnhan.id+'"]').text(data.benhnhan.hoten);
            }
            else
            {
                
                if($.isArray(data.benhnhan)){
                    for (var i = 0; i < data.benhnhan.length; i++) {
                        if($('#hoten').attr('data-id') == data.benhnhan[i]){
                            $('#formdkk').slideUp(800);
                        }
                        $('#tbl_phieudk tr').has('td[data-idbn="'+data.benhnhan[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_phieudk tr').has('td[data-idbn="'+data.benhnhan[i]+'"]').remove();
                    }
                }
                else{
                    if($('#hoten').attr('data-id') == data.benhnhan){
                        $('#formdkk').slideUp(800);
                    }
                    $('#tbl_phieudk tr').has('td[data-idbn="'+data.benhnhan+'"]').next('tr.spacer').remove();
                    $('#tbl_phieudk tr').has('td[data-idbn="'+data.benhnhan+'"]').remove();
                }  
            }
            $('#hoten').trigger('input');
        }
        
        //Bind một function changeData với sự kiện BenhNhan.php
        channel1.bind('App\\Events\\TiepDon\\BenhNhan', changeData);
        //end xử lý channel
        
        //Nếu có thay đổi các thông tin liên quan đến thẻ bhyt thông tin trên view hiện tại sẽ thay đổi
        //Đăng ký với kênh TheBHYT đã tạo trong file TheBHYT.php
        var channel2 = pusher.subscribe('TheBHYT');
        function changeDataThe() {
            $('#hoten').trigger('input');
        }
        
        //Bind một function changeDataThe với sự kiện TheBHYT.php
        channel2.bind('App\\Events\\TiepDon\\TheBHYT', changeDataThe);
        //end xử lý channel
        
        //Lấy danh sách tỉnh để lọc
        $('#tinh_f').change(function(){
            var id=$(this).val();
            $.ajax({
                type: 'post',
                url: "/qlkcb/tiep_don/thong_tin_benh_nhan/lay_ds_huyen",
                dataType: 'JSON',
                data: {_token: CSRF_TOKEN, idtinh: id},
                success: function(data){
                    $('#huyen_f option').not("[value='all']").remove();
                    $('#huyen_f').append(data.msg);
                    $("#huyen_f").change();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Không thể lấy danh sách quận - huyện. Lỗi: "+jqXHR+" | "+errorThrown);
                }
            });
        });
        //end Lấy danh sách tỉnh để lọc
        
        //Lấy danh sách huyện
        $('#huyen_f').change(function(){
            var id=$(this).val();
            $.ajax({
                type: 'post',
                url: "/qlkcb/tiep_don/thong_tin_benh_nhan/lay_ds_xa",
                dataType: 'JSON',
                data: {_token: CSRF_TOKEN, idhuyen: id},
                success: function(data){
                    $('#xa_f option').not("[value='all']").remove();
                    $('#xa_f').append(data.msg);
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert("Không thể lấy danh sách xã - phường. Lỗi: "+jqXHR+" | "+errorThrown);
                }
            });
        });
        //end Lấy danh sách huyện để loc
        
        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formdkk').slideUp(800);
        });
        //end đóng form nhập liệu
        
        //xóa phiếu dăng ký khám
        $('#tbl_phieudk').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin phiếu đăng ký khám của bệnh nhân "+name+"?");
            if(cf==true){
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
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
                            $('#btndong').click();//đóng form xem
                            if(locds == true){
                                soluongl--;
                                if(soluongl == 0){
                                     $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongl+" phiếu đăng ký khám được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" phiếu đăng ký khám tìm thấy!");
                                    }
                                }
                            }
                            
                            alert("Xóa thông tin phiếu đăng ký khám thành công!");
                        }
                        else{
                            alert("Xóa thông tin phiếu đăng ký khám thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin phiếu đăng ký khám thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin phiếu đăng ký khám thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin phiếu đăng ký khám thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa phiếu đăng ký khám
        
        //mở form để sửa
        $('#tbl_phieudk').on('click','button[data-button="xemct"]',function(){
            var formData = new FormData();
            var id=$(this).attr('data-id');
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
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
                    $('#hoten').val(data.ht);$('#hoten').attr('data-id', data.hoten);
                    if(data.htk == 0)
                    {
                        $('#htk').val("Khám BHYT");
                    }
                    else
                    {
                        $('#htk').val("Khám thu phí");
                    }
                    if(data.giaychuyen == 0)
                    {
                        $('#giaychuyen').val('Không có giấy chuyển');
                    }
                    else
                    {
                        $('#giaychuyen').val('Có giấy chuyển');
                    }
                    $('#khoa').val(data.tenkhoa);$('#phong').val(data.tenphong);
                    
                    $('#hoten').trigger('input');
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
            formData.append('ls', 'ls');
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
                                    <td>'+data.dkkham[i].khoa+'</td>\n\
                                    <td>'+data.dkkham[i].phong+'</td>\n\
                                    <td>'+data.dkkham[i].htk+'</td>\n\
                                    <td>'+data.dkkham[i].tuyen+'</td>\n\
                                    <td>'+data.dkkham[i].giaychuyen+'</td>\n\
                                    <td>'+data.dkkham[i].ngaydk+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-button="xemct" data-id="'+data.dkkham[i].id+'">\n\
                                                <i class="fa fa-info"></i>\n\
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
                            $('#kqtimliem').text("Có "+data.sl+" phiếu đăng ký khám được tìm thấy!");
                        }
                        else{
                            $('#tbl_phieudk').html("");
                            $('#kqtimliem').text("Không có phiếu đăng ký khám nào được tìm thấy!");tk=false;
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
        $('#btnlocds').click(function (){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('khoa', $('#khoa_f').val());
            formData.append('dtk', $('#htk_f').val());
            formData.append('tgt', $('#tg_f').val());
            formData.append('tgbd', $('#txtthoigiantao').val());
            formData.append('tgkt', $('#txtthoigiankt').val());
            formData.append('gt', $('#gt_f').val());
            formData.append('tinh', $('#tinh_f').val());
            formData.append('huyen', $('#huyen_f').val());
            formData.append('xa', $('#xa_f').val());
            formData.append('ls', 'ls');
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
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dkkham[i].id+'" data-name="'+data.dkkham[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td data-idbn="'+data.dkkham[i].idbn+'">'+data.dkkham[i].hoten+'</td>\n\
                                    <td>'+data.dkkham[i].khoa+'</td>\n\
                                    <td>'+data.dkkham[i].phong+'</td>\n\
                                    <td>'+data.dkkham[i].htk+'</td>\n\
                                    <td>'+data.dkkham[i].tuyen+'</td>\n\
                                    <td>'+data.dkkham[i].giaychuyen+'</td>\n\
                                    <td>'+data.dkkham[i].ngaydk+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-button="xemct" data-id="'+data.dkkham[i].id+'">\n\
                                                <i class="fa fa-info"></i>\n\
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
            formData.append('ls', 'ls');
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
                                    <td>'+data.dkkham[i].khoa+'</td>\n\
                                    <td>'+data.dkkham[i].phong+'</td>\n\
                                    <td>'+data.dkkham[i].htk+'</td>\n\
                                    <td>'+data.dkkham[i].tuyen+'</td>\n\
                                    <td>'+data.dkkham[i].giaychuyen+'</td>\n\
                                    <td>'+data.dkkham[i].ngaydk+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-button="xemct" data-id="'+data.dkkham[i].id+'">\n\
                                                <i class="fa fa-info"></i>\n\
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
        //end Nạp lại danh sách bệnh nhân

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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin phiếu đăng ký khám của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin phiếu đăng ký khám của bệnh nhân "+name+"?");
                }
                if(cf==true){
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
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
                                $('#btndong').click();
                                if(arr.length > 1){
                                    if(locds == true){
                                        soluongl = soluongl - arr.length;
                                        if(soluongl == 0)
                                        {
                                            $('#kqtimliem').text("");
                                        }
                                        else
                                        {
                                            $('#kqtimliem').text("Có "+soluongl+" phiếu đăng ký khám được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" phiếu đăng ký khám được tìm thấy!");
                                            }
                                        }
                                    }

                                    alert("Xóa thông tin các phiếu đăng ký khám thành công!");
                                    $('input[data-input="checksum"]').prop("checked",false);
                                    
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" phiếu đăng ký khám được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" phiếu đăng ký khám được tìm thấy!");
                                        }
                                    }

                                    alert("Xóa thông tin phiếu đăng ký khám thành công!");
                                    $('input[data-input="checksum"]').prop("checked",false);
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các phiếu đăng ký khám thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin phiếu đăng ký khám thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các phiếu đăng ký khám thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các phiếu đăng ký khám thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các phiếu đăng ký khám thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin phiếu đăng ký khám thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin phiếu đăng ký khám thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin phiếu đăng ký khám thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }
                
            }
        });
        //end
        
        //xử lý lấy phần text cho textbox họ tên
        $('#hoten').on('input', function(e) {
            var input = e.target,
                idbn = input.getAttribute('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idbn', idbn);
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
                        $('p[class="anhbn"]').fadeOut(800);$('img[class*="anhbn"]').attr('src','public/upload/anhbn/'+data.anh);$('img[class*="anhbn"]').fadeIn(800);
                    }
                    else
                    {
                        $('p[class="anhbn"]').fadeIn(800);$('img[class*="anhbn"]').fadeOut(800);
                    }   
                    if(data.idthe != 'null')
                    {
                        $('#mathe').val(data.idthe);$('#ngaydk').val(data.ngaydk);$('#ngayhh').val(data.ngayhh);$('#ndk').val(data.ndk);$('#doituong').val(data.doituong);$('#mh').val(data.mh);
                        if(data.tuyencode == 'dung_tuyen'){
                            $('#tuyen').val('Đúng tuyến');$('#chuyentu').val('Không chuyển');
                        }
                        else{
                            $('#tuyen').val(data.tuyen);$('#chuyentu').val(data.chuyentu);
                        }

                        $('.thearea').removeClass('hidden');
                    }
                    else{
                        $('.thearea').addClass('hidden');
                    }
                    $('#formdkk').slideDown(800);
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
                    $('#formdkk').slideUp(800);
                }
            });
        });
        //end
    });
</script>
@endsection