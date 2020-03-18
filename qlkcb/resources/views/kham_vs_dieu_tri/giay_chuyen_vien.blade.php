@extends('kham_vs_dieu_tri.layout')

@section('title')
    {{ "Giấy chuyển viện" }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
        <input type="hidden" id="loaind" value="{{$nd->Quyen}}">
        <input type="hidden" id="khoa_nv" value="{{$nd->nhanVien->phongBan->Khoa->IdKhoa}}">
        <?php $flag=FALSE;?>
        @foreach($nd->capQuyen as $cqnd)
            @if($cqnd->Quyen == 'qlck')
            <input type="hidden" id="quyen_bs" value="TRUE">
            <?php $flag=TRUE; break;?>
            @endif  
        @endforeach
        @if($flag==FALSE)
        <input type="hidden" id="quyen_bs" value="FALSE">
        @endif
        <!-- DATA TABLE-->
        <section class="p-t-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" m-b-35">
                                <h3 class="title-5 font-weight-bold text-green">DANH SÁCH GIẤY CHUYỂN VIỆN - KHOA [{{mb_convert_case($nd->nhanVien->phongBan->Khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8')}}] - BS. {{mb_convert_case($nd->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8')}}</h3>
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
                                        <th>hình thức điều trị</th>
                                        <th>Chuẩn đoán</th>
                                        <th>Ngày lập GCV</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_gcv">
                                    @if(isset($dsgcv))
                                    @foreach($dsgcv as $gcv)
                                    @if(is_object($gcv->benhAnNgoaiTru))
                                    <tr class="tr-shadow">
                                        <td style="vertical-align: middle;">
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                <input type="checkbox" data-input="check" data-id="{{ $gcv->IdGCVNgoai }}" data-name="<?php echo $gcv->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>{{$gcv->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                        <td>Ngoại trú</td>
                                        <td class="text-left">
                                            @foreach($gcv->benhAnNgoaiTru->chuanDoan as $cd)
                                                {{'- '.$cd->danhMucBenh->TenBenh}}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{\comm_functions::deDateFormat($gcv->created_at)}}
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button type="button" class="item" data-toggle="modal" data-target="#modalgrv" data-button="btnxemtt" data-id="{{$gcv->benhAnNgoaiTru->IdBANgoaiT}}" rel="tooltip" title="Xem nội dụng" data-loaiba="ngoai">
                                                    <i class="fa fa-list-alt"></i>
                                                </button>
                                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$gcv->IdGCVNgoai}}" data-name="{{$gcv->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}" data-loaiba="ngoai">
                                                    <i class="zmdi zmdi-delete"  ></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @elseif(is_object($gcv->benhAnNoiTru))
                                    <tr class="tr-shadow">
                                        <td style="vertical-align: middle;">
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                <input type="checkbox" data-input="check" data-id="{{ $gcv->IdGCVNoi }}" data-name="<?php echo $gcv->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>{{$gcv->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                        <td>Nội trú</td>
                                        <td class="text-left">
                                            @foreach($gcv->benhAnNoiTru->chuanDoan as $cd)
                                                {{'- '.$cd->danhMucBenh->TenBenh}}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{\comm_functions::deDateFormat($gcv->created_at)}}
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button type="button" class="item" data-toggle="modal" data-target="#modalgrv" data-button="btnxemtt" data-id="{{$gcv->benhAnNoiTru->IdBANoiT}}" rel="tooltip" title="Xem nội dụng" data-loaiba="noi">
                                                    <i class="fa fa-list-alt"></i>
                                                </button>
                                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$gcv->IdGCVNoi}}" data-name="{{$gcv->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}" data-loaiba="noi">
                                                    <i class="zmdi zmdi-delete"  ></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
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
        
        <!--MODAL GIẤY CHUYỂN VIỆN-->
        <div class="modal fade" id="modalgrv" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Lập giấy chuyển viện</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row fit_table_height_500" style="font-family: Verdana; font-size: 8pt;">
                            <div style="width: 45px !important;"></div>
                            <div class="col-lg-10" id="print_content_gcv" >
                                <div class="card" style="font-weight: normal; height: 900px; width: 660px !important;">
                                    <div class="card-block card-body printcontent_gcv" style="height: 900px; width: 660px !important; font-weight: 800;">
                                        <div class="row" style="font-size: 7pt;">
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-4 text-center" style="margin: 0; padding: 0;">
                                                        <label><img src="public/images/logo3.png" style="height: 50px;"></label>
                                                    </div>
                                                    <div class="col-lg-8" style="margin: 0; padding: 0;">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                 <label style="margin-bottom: 0;">Sở Y tế An Giang</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                 <label style="margin-bottom: 0;">Bệnh Viện ĐKTT An Giang</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                 <label style="margin-bottom: 0;">Số: ....../20.../GCT</label>
                                                            </div>
                                                        </div>
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
                                            <div class="col-lg-3">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">MS: 06</label>
                                                     </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">Số Hồ sơ:</label> <label style="margin-bottom: 0;" id="shs">......................</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">Vào sổ chuyển tuyến số:</label> <label style="margin-bottom: 0;" id="sct">.....................................</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-size: 12pt">GIẤY CHUYỂN TUYẾN KHÁM BỆNH, CHỮA BỆNH BẢO HIỂM Y TẾ</label>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-15">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Kính gửi:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_ncd">....................................</label>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Cơ sở khám bệnh, chữa bệnh: Bệnh viện Đa khoa TT An Giang trân trọng giới thiệu:</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0;">Họ và tên người bệnh:</label> <label style="margin-bottom: 0; font-size: 8pt; font-weight: normal" id="gcv_hoten"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0;">Nam/Nữ:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_gt"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0;">Tuổi:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_tuoi"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-5">
                                                <label style="margin-bottom: 0;">Dân tộc:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_dt"></label>
                                            </div>
                                            <div class="col-lg-7">
                                                <label style="margin-bottom: 0;">Quốc tịch:</label> <label style="margin-bottom: 0; font-weight: normal">.....................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-5">
                                                <label style="margin-bottom: 0;">Nghề nghiệp:</label> <label style="margin-bottom: 0; font-weight: normal">.......................................</label>
                                            </div>
                                            <div class="col-lg-7">
                                                <label style="margin-bottom: 0;">Nơi làm việc:</label> <label style="margin-bottom: 0; font-weight: normal">.................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Mã thẻ BHYT:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_mathe"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Địa chỉ:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_diachi"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Đã được khám bệnh/điều trị:</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12" id="gcv_tgdt">

                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">TÓM TẮT BỆNH ÁN</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Dấu hiệu lâm sàng:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_dauhieuls">.........................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Kết quả xét nghiệm, cận lâm sàng:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_kqls">.................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Chuẩn đoán:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_cd">...................................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Phương pháp, thủ thuật, kỹ thuật, thuốc đã sử dụng trong điều trị:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_thuoc">................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Tình trạng người bệnh lúc chuyển tuyến:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_ttbn">........................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Lí do chuyển tuyến: Khoanh tròn vào lý do chuyển tuyến phù hợp sau đây:</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">1. Đủ điều kiện chuyển tuyến.</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">2. Theo yêu cầu của người bệnh hoặc người đại diện hợp pháp của người bệnh.</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Hướng điều trị: </label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_ppdt">....................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Chuyển tuyến hồi: </label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_tgc"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Phương tiện vận chuyển: </label> <label style="margin-bottom: 0; font-weight: normal" >................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-20">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Họ tên, chức danh, trình độ chuyên môn của người hộ tống: </label> <label style="margin-bottom: 0; font-weight: normal">...........................................................</label>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-lg-6">
                                                <br>
                                                <label style="margin-bottom: 0">Y, BÁC SĨ KHÁM, ĐIỀU TRỊ</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal; font-style: italic">(Ký và ghi rõ họ tên)</label><br>
                                                <label style="margin-bottom: 0; font-weight: 800" id="gcv_bs"></label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-size: 8pt; font-weight: normal; font-style: italic">Ngày.......tháng.......năm........</label><br>
                                                <label style="margin-bottom: 0">NGƯỜI CÓ THẨM QUYỀN CHUYỂN TUYẾN</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal;font-style: italic">(Ký tên, đóng dấu)</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">...........................</label>
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
                                            <div class="row">
                                                <div class="col-lg-4">  
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Nơi chuyển đến</label>
                                                        <input type="text" readonly="" class="form-control" id="cskhambhyt">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Dấu hiệu LS của bệnh nhân</label>
                                                        <textarea rows="2" readonly="" class="form-control" id="dauhieuls"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Hướng điều trị</label>
                                                        <textarea rows="2" readonly="" class="form-control" id="huongdieutri"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">  
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tình trạng bệnh nhân lúc chuyển</label>
                                                        <textarea row="2" readonly="" class="form-control" id="ttbnlucchuyen"></textarea>
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
        <!--END MODAL GIẤY CHUYỂN VIỆN-->
        
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
        
        var audiotk='';
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
                    audiotk.pause();
                }
            });
        });

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
                    if(data.dvb.pl == 'grv'){
                        if($('#tb_bc').hasClass('hidden')){
                            $('#tb_bc').removeClass('hidden');

                            var tb='<div class="rs-select2--light _'+data.dvb.id+'">\n\
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">\n\
                                    <span class="badge badge-pill badge-success">Thông báo!</span> Giấy ra viện ['+data.dvb.cd+'] đã được duyệt bởi '+data.dvb.nd+'<button type="button" data-ma="'+data.dvb.id+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">×</span></button>\n\
                                    </button>\n\
                                </div>\n\
                            </div>';

                            $('#thong_bao').append(tb);
                        }
                        else{
                            var tb='<div class="rs-select2--light _'+data.dvb.id+'">\n\
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">\n\
                                    <span class="badge badge-pill badge-success">Thông báo!</span> Giấy ra viện ['+data.dvb.cd+'] đã được duyệt bởi '+data.dvb.nd+'<button type="button" data-ma="'+data.dvb.id+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">×</span></button>\n\
                                    </button>\n\
                                </div>\n\
                            </div>';

                            $('#thong_bao').append(tb);
                        }
                    }
                }
                else if(data.dvb.idnvd == $('#id_nv').val()){
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
            }
            else if(data.thaotac == 'them'){ 
                if(data.dvb.pl ==  'grv' && $('#quyen_bs').val() == 'TRUE' && $('#khoa_nv').val() == data.dvb.khoa){
                    if($('[class*="anounttk"]').find('[class*="notiwrap"]').length > 0){
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
                                audiotk = new Audio('public/audios/sound.mp3');
                                audiotk.play();
                            }
                        });
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
                        if(data.dshuy[i]['pl'] == 'grv'){
                            if($('#tb_bc').hasClass('hidden')){
                                $('#tb_bc').removeClass('hidden');

                                var tb='<div class="rs-select2--light _'+data.dshuy[i]['id']+'">\n\
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-danger">Thông báo!</span> Yêu cầu duyệt giấy ra viện ['+data.dshuy[i]['cd']+'] đã bị hủy bởi '+data.dshuy[i]['nd']+'<button type="button" data-ma="'+data.dshuy[i]['id']+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">×</span></button>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>';

                                $('#thong_bao').append(tb);
                            }
                            else{
                                var tb='<div class="rs-select2--light _'+data.dshuy[i]['id']+'">\n\
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-danger">Thông báo!</span> Yêu cầu duyệt giấy ra viện ['+data.dshuy[i]['cd']+'] đã bị hủy bởi '+data.dshuy[i]['nd']+'<button type="button" data-ma="'+data.dshuy[i]['id']+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
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
        
        var audio='';
        $('a[class*="cba"]').click(function(){
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

        var channelcc = pusher.subscribe('CapCuu');
        function layttbac(data) {
            if(data.tt == 'them'){
                if($('#id_nv').val() == data.idnvnhan){
                    if($('a[class*="cba"]').find('span[class*="quantity"]').length > 0){
                        $('span[class*="quantity"]').text(data.slba);
                        $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');
                    }
                    else{
                        var ct='<span class="quantity">'+data.slba+'</span>';
                        $('a[class*="cba"]').append(ct);
                        $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');
                    }
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
            else if(data.tt == 'nhanba'){
                if($('#id_nv').val() == data.idnvnhan){
                    if($('a[class*="cba"]').find('span[class*="quantity"]').length > 0){
                        if(data.slba.toString() == '0'){
                            $('span[class*="quantity"]').remove();
                            $('a[class*="cba"]').attr('data-original-title', 'Hiện chưa có bệnh án nào chuyển đến!');
                        }
                        else{
                            $('span[class*="quantity"]').text(data.slba);
                            $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');

                        }
                    }
                    else{
                        $('a[class*="cba"]').attr('data-original-title', 'Hiện chưa có bệnh án nào chuyển đến!');
                    }
                }
            }
            else{
                if($('#id_nv').val() == data.idnvnhan){
                    if($('a[class*="cba"]').find('span[class*="quantity"]').length > 0){
                        if(data.slba.toString() == '0'){
                            $('span[class*="quantity"]').remove();
                            $('a[class*="cba"]').attr('data-original-title', 'Hiện chưa có bệnh án nào chuyển đến!');
                        }
                        else{
                            $('span[class*="quantity"]').text(data.slba);
                            $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');
                        }
                    }
                }
                
            }
        }
        
        channelcc.bind('App\\Events\\KhamVaDieuTri\\CapCuu', layttbac);
        
        var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

        $('#tbl_gcv').on ('click', 'button[data-button="btnxemtt"]', function(){
            var id=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            var loaiba=$(this).attr('data-loaiba');
            var url='/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/them_moi_noi';
            if(loaiba=='ngoai'){
                url='/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/them_moi';
            }
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
                        $('#shs').text(data.shs);
                        $('#sct').text(data.sct);
                        $('#dauhieuls').attr('readonly','');$('#huongdieutri').attr('readonly','');
                        $('#ttbnlucchuyen').attr('readonly','');$('#cskhambhyt').attr('readonly','');
                        $('#dauhieuls').val(data.dhls);$('#huongdieutri').val(data.ppdt);
                        $('#dauhieuls').attr('data-dhls', 'co');
                        $('#gcv_ppdt').text(data.ppdt);
                        $('#gcv_dauhieuls').text(data.dhls);
                        $('#gcv_ncd').text(data.ncd);
                        $('#cskhambhyt').val(data.ncd);$('#ttbnlucchuyen').val(data.ttbn);
                        $('#gcv_tgc').text(data.tgct);
                        $('#gcv_ttbn').text(data.ttbn);
                        
                        $('#gcv_bs').text(data.bs);$('#gcv_cd').text(data.cd);
                        $('#gcv_diachi').text(data.diachi);$('#gcv_dt').text(data.dantoc);
                        $('#gcv_gt').text(data.gt);$('#gcv_hoten').text(data.hoten);
                        
                        $('#gcv_tuoi').text(data.tuoi);
                        if(data.flagkqcls == true){
                            $('#gcv_kqls').text(data.kqls);
                        }
                        else{
                            $('#gcv_kqls').text('.................................................................................................');
                        }
                        $('#gcv_mathe').text(data.mathe);
                        
                        $('#gcv_tgdt').html(data.tgdt);
                        
                        if(data.thuoc_cls_tt == 'koco'){
                            $('#gcv_thuoc').text('................................................');
                        }
                        else{
                            $('#gcv_thuoc').text(data.thuoc_cls_tt);
                        }
                        
                    }
                    else if(data.msg == 'ktt'){
                        alert("Bệnh án này không tồn tại, có thể đã bị xóa!");
                    }
                    else{
                        alert("Lỗi khi tải dữ liệu cho giấy chuyển viện! Mô tả: "+data.msg);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
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
        
        $('#tbl_gcv').on('click','button[data-button="btnxoa"]',function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm('Bạn có chắc chắn muốn hủy giấy chuyển viện của bệnh nhân '+name+'?');
            if(cf == false){
                return false;
            }
            var loaiba=$(this).attr('data-loaiba');
            var url='/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/xoa_noi';
            if(loaiba=='ngoai'){
                url='/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/xoa';
            }
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
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
                        if($('#tbl_gcv').children().length == 0){
                            $('input[data-input="checksum"]').prop("checked",false);
                        }
                        if(locds == true){
                            soluongl--;
                            if(soluongl == 0){
                                 $('#kqtimliem').text("");
                            }
                            else{
                                $('#kqtimliem').text("Có "+soluongl+" giấy chuyển viện được tìm thấy!");
                            }
                        }
                        else{
                            if(tk == true){
                                soluongtk--;
                                if(soluongtk == 0){
                                    $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongtk+" giấy chuyển viện tìm thấy!");
                                }
                            }
                        }
                        $('#tbl_gcv tr').has('td div button[data-id="'+id+'"]').next('tr.spacer').remove();
                        $('#tbl_gcv tr').has('td div button[data-id="'+id+'"]').remove();
                        
                        alert("Xóa thông tin giấy chuyển viện thành công!");
                    }
                    else{
                        alert("Xóa giấy chuyển viện gặp lỗi! Mô tả: "+data.msg);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Không thể xóa giấy chuyển viện! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể xóa giấy chuyển viện! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể xóa giấy chuyển viện! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if(!$('#tbl_gcv input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn giấy chuyển viện để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[]
                $('#tbl_gcv input[data-input="check"]').each(function(){
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
                    cf=confirm("Bạn có thực sự muốn xóa các giấy chuyển viện của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa giấy chuyển viện của bệnh nhân "+name+"?");
                }
                if(cf==true){
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/xoa_all',
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
                                            $('#kqtimliem').text("Có "+soluongl+" giấy chuyển viện được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" giấy chuyển viện được tìm thấy!");
                                            }
                                        }
                                    }
                                    for (var i = 0; i < arr.length; i++) {
                                        $('#tbl_gcv tr').has('td div button[data-id="'+arr[i]+'"]').next('tr.spacer').remove();
                                        $('#tbl_gcv tr').has('td div button[data-id="'+arr[i]+'"]').remove();
                                    }
                                    if($('#tbl_gcv').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các giấy chuyển viện thành công!");
                                    
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" giấy chuyển viện được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" giấy chuyển viện được tìm thấy!");
                                        }
                                    }
                                    $('#tbl_gcv tr').has('td div button[data-id="'+arr[0]+'"]').next('tr.spacer').remove();
                                    $('#tbl_gcv tr').has('td div button[data-id="'+arr[0]+'"]').remove();
                                    
                                    if($('#tbl_gcv').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin giấy chuyển viện thành công!");
                                    
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các giấy chuyển viện thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin giấy chuyển viện thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các giấy chuyển viện thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các giấy chuyển viện thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các giấy chuyển viện thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin giấy chuyển viện thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin giấy chuyển viện thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin giấy chuyển viện thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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
                url: '/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/tim_kiem',
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
                            var tt_gcv='';
                            for(var i=0; i<data.dsgcv.length; ++i){
                                tt_gcv+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dsgcv[i].id+'" data-name="'+data.dsgcv[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.dsgcv[i].hoten+'</td>\n\
                                    <td>'+data.dsgcv[i].htdt+'</td>\n\
                                    <td class="text-left">'+data.dsgcv[i].chuandoan+'</td>\n\
                                    <td>'+data.dsgcv[i].ngaylap+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" data-toggle="modal" data-target="#modalgrv" data-button="btnxemtt" data-id="'+data.dsgcv[i].idba+'" rel="tooltip" title="Xem nội dung" data-loaiba="'+data.dsgcv[i].loaiba+'">\n\
                                                <i class="fa fa-list-alt"></i>\n\
                                            </button>\n\
                                            <button type="button" class="item" data-button="btnxoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dsgcv[i].id+'" data-name="'+data.dsgcv[i].hoten+'" data-loaiba="'+data.dsgcv[i].loaiba+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                            $('#tbl_gcv').html(tt_gcv);
                            $('#tbl_gcv button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                    
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" giấy chuyển viện được tìm thấy!");
                        }
                        else{
                            $('#tbl_gcv').html("");
                            $('#kqtimliem').text("Không có giấy chuyển viện nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/lay_ds_gcv',
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
                        alert("Lỗi khi tải danh sách giấy chuyển viện! Mô tả: "+data.msg);
                    }else{
                        var tt_gcv='';
                        for(var i=0; i<data.dsgcv.length; ++i){
                            tt_gcv+='\n\
                                <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dsgcv[i].id+'" data-name="'+data.dsgcv[i].hoten+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.dsgcv[i].hoten+'</td>\n\
                                <td>'+data.dsgcv[i].htdt+'</td>\n\
                                <td class="text-left">'+data.dsgcv[i].chuandoan+'</td>\n\
                                <td>'+data.dsgcv[i].ngaylap+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button type="button" class="item" data-toggle="modal" data-target="#modalgrv" data-button="btnxemtt" data-id="'+data.dsgcv[i].idba+'" rel="tooltip" title="Xem nội dung" data-loaiba="'+data.dsgcv[i].loaiba+'">\n\
                                            <i class="fa fa-list-alt"></i>\n\
                                        </button>\n\
                                        <button type="button" class="item" data-button="btnxoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dsgcv[i].id+'" data-name="'+data.dsgcv[i].hoten+'" data-loaiba="'+data.dsgcv[i].loaiba+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_gcv').html(tt_gcv);
                        $('#tbl_gcv button[data-id]').tooltip({
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
                $('#tbl_gcv input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_gcv input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_gcv').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksum"]').prop("checked",false);
            }
            else{
                if($('#tbl_gcv input[data-input="check"]:checked').length == $('#tbl_gcv input[data-input="check"]').length){
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