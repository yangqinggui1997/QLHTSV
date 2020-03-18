@extends('kham_vs_dieu_tri.layout')

@section('title')
    {{ "Phiếu kê khai viện phí" }}
@endsection

@section('css')
<style type="text/css">
    .padding_adjust_td tr td {
        padding: 5px; padding-top: 2px; padding-bottom: 2px;
    }
</style>
@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
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
                            <h3 class="title-5 font-weight-bold text-green">DANH SÁCH PHIẾU KÊ KHAI VIÊN PHÍ - KHOA [{{mb_convert_case($nd->nhanVien->phongBan->Khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8')}}] - BS. {{mb_convert_case($nd->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8')}}</h3>
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
                                        <th>Hình thức điều trị</th>
                                        <th>Chuẩn đoán</th>
                                        <th>Số ngày điều trị</th>
                                        <th>ngày lập phiếu</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_pkk">
                                    @if(isset($dspkk))
                                    @foreach($dspkk as $pkk)
                                        @if(is_object($pkk->benhAnNgoaiTru))
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $pkk->IdPKK }}" data-name="<?php echo $pkk->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$pkk->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                <td>
                                                    @if($pkk->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                    BHYT
                                                    @else
                                                    Thu phí
                                                    @endif
                                                </td>
                                                <td>
                                                    Ngoại trú
                                                </td>
                                                <td class="text-left">
                                                    @foreach($pkk->benhAnNgoaiTru->chuanDoan as $cd)
                                                        {{'- '.$cd->danhMucBenh->TenBenh}}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    {{\comm_functions::deDateFormat($pkk->created_at)}}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modalkkvp" data-button="btnxempkk" data-id="{{$pkk->benhAnNgoaiTru->IdBANgoaiT}}" rel="tooltip" title="Xem kết quả CLS" data-loaiba="ngoai">
                                                            <i class="fa fa-list-alt"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$pkk->IdPKK}}" data-name="{{$pkk->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                            <i class="zmdi zmdi-delete"  ></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @elseif(is_object($pkk->benhAnNoiTru))
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $pkk->IdPKK }}" data-name="<?php echo $pkk->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$pkk->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                                <td>
                                                    @if($pkk->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                    BHYT
                                                    @else
                                                    Thu phí
                                                    @endif
                                                </td>
                                                <td>
                                                    Nội trú
                                                </td>
                                                <td class="text-left">
                                                    @foreach($pkk->benhAnNoiTru->chuanDoan as $cd)
                                                        {{'- '.$cd->danhMucBenh->TenBenh}}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <?php
                                                        $present= date_create(date('Y-m-d', strtotime($pkk->created_at)));
                                                        $timeba= date_create(date('Y-m-d', strtotime($pkk->benhAnNoiTru->created_at)));
                                                        $t= date_diff($timeba, $present);
                                                        echo $t->format('%a') + 1;
                                                    ?>
                                                </td>
                                                <td>
                                                    {{\comm_functions::deDateFormat($pkk->created_at)}}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modalkkvp" data-button="btnxempkk" data-id="{{$pkk->benhAnNoiTru->IdBANoiT}}" rel="tooltip" title="Xem chi tiết" data-loaiba="noi">
                                                            <i class="fa fa-list-alt"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$pkk->IdPKK}}" data-name="{{$pkk->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
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
       
        <!--MODAL XEM CHI TIẾT VIỆN PHÍ-->
        <div class="modal fade" id="modalkkvp" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Chi tiết phiếu kê khai viện phí khám, chữa bệnh ngoại trú</h5>
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
        
        $('#tbl_pkk').on('click','button[data-button="btnxempkk"]',function(){
            $('#dtbiareapkk').removeClass('hidden');$('#dtbipkk').text('Đang tải dữ liệu!');
            $('#proccesspkk').removeClass('hidden');
            var id=$(this).attr('data-id');
            $('#print_content_vp').html('');
            $('#tongphi').val('');$('#tongbh').val('');$('#tongnk').val('');$('#tongbn').val('');$('#btnprintpkkarea').addClass('hidden');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', id);
            var url='/qlkcb/kham_va_dieu_tri/phieu_ke_khai_vp/in_noi';
            var loaip=$(this).attr('data-loaiba');
            if( loaip=== 'ngoai'){
                url='/qlkcb/kham_va_dieu_tri/phieu_ke_khai_vp/in';
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
                        if(loaip === 'ngoai'){
                            $.when(prepare_content_to_print_pkk_ngoai(data.data, data.bn)).done(function(){
                                $('#dtbipkk').text('Đã tải xong!');
                                $('#proccesspkk').addClass('hidden');
                                $('#btnprintpkkarea').removeClass('hidden');
                            });
                        }
                        else{
                            $.when(prepare_content_to_print_pkk_noi(data.data, data.bn)).done(function(){
                                $('#dtbipkk').text('Đã tải xong!');
                                $('#proccesspkk').addClass('hidden');
                                $('#btnprintpkkarea').removeClass('hidden');
                            });
                        }
                    }
                    else if(data.msg == 'ktt'){
                        alert("Bệnh án của phiếu kê khai này không tồn tại, có thể đã bị xóa!");
                    }
                    else{
                        $('#dtbiareapkk').addClass('hidden');$('#proccesspkk').addClass('hidden');
                        alert("Không thể tải dữ liệu in! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareapkk').addClass('hidden');$('#proccesspkk').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Không thể tải dữ liệu in! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể tải dữ liệu in! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể tải dữ liệu in! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        $('#tbl_pkk').on('click','button[data-button="btnxoa"]',function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa phiếu kê khai viện phí của bệnh nhân "+name+"?");
            if(cf==true){
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);

                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/phieu_ke_khai_vp/xoa',
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
                            if($('#tbl_pkk').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            if(locds == true){
                                soluongl--;
                                if(soluongl == 0){
                                     $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongl+" phiếu kê khai viện phí được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" phiếu kê khai viện phí tìm thấy!");
                                    }
                                }
                            }
                            $('#tbl_pkk tr').has('td div button[data-id="'+id+'"]').next('tr.spacer').remove();
                            $('#tbl_pkk tr').has('td div button[data-id="'+id+'"]').remove();
                            alert("Xóa phiếu kê khai viện phí thành công!");
                        }
                        else{
                            alert("Xóa phiếu kê khai viện phí thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa phiếu kê khai viện phí thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa phiếu kê khai viện phí thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa phiếu kê khai viện phí thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if(!$('#tbl_pkk input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn phiếu kê khai viện phí để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[]
                $('#tbl_pkk input[data-input="check"]').each(function(){
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
                    cf=confirm("Bạn có thực sự muốn xóa các phiếu kê khai viện phí của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa phiếu kê khai viện phí của bệnh nhân "+name+"?");
                }
                if(cf==true){
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/phieu_ke_khai_vp/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" phiếu kê khai viện phí được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" phiếu kê khai viện phí được tìm thấy!");
                                            }
                                        }
                                    }
                                    for (var i = 0; i < arr.length; i++) {
                                        $('#tbl_pkk tr').has('td div button[data-id="'+arr[i]+'"]').next('tr.spacer').remove();
                                        $('#tbl_pkk tr').has('td div button[data-id="'+arr[i]+'"]').remove();
                                    }
                                    if($('#tbl_pkk').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các phiếu kê khai viện phí thành công!");
                                    
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" phiếu kê khai viện phí được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" phiếu kê khai viện phí được tìm thấy!");
                                        }
                                    }
                                    $('#tbl_pkk tr').has('td div button[data-id="'+arr[0]+'"]').next('tr.spacer').remove();
                                    $('#tbl_pkk tr').has('td div button[data-id="'+arr[0]+'"]').remove();
                                    
                                    if($('#tbl_pkk').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin phiếu kê khai viện phí thành công!");
                                    
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các phiếu kê khai viện phí thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin phiếu kê khai viện phí thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các phiếu kê khai viện phí thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các phiếu kê khai viện phí thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các phiếu kê khai viện phí thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin phiếu kê khai viện phí thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin phiếu kê khai viện phí thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin  phiếu kê khai viện phí thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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
                url: '/qlkcb/kham_va_dieu_tri/phieu_ke_khai_vp/tim_kiem',
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
                            var tt_pkk='';
                            for(var i=0; i<data.pkk.length; ++i){
                                tt_pkk+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.pkk[i].id+'" data-name="'+data.pkk[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.pkk[i].hoten+'</td>\n\
                                    <td>'+data.pkk[i].dttn+'</td>\n\
                                    <td>'+data.pkk[i].htdt+'</td>\n\
                                    <td class="text-left">'+data.pkk[i].chuandoan+'</td>\n\
                                    <td>'+data.pkk[i].songaydt+'</td>\n\
                                    <td>'+data.pkk[i].ngaylap+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" data-toggle="modal" data-target="#modalkkvp" data-button="btnxempkk" data-id="'+data.pkk[i].idba+'" rel="tooltip" title="Xem kết quả CLS" data-loaiba="'+data.pkk[i].loaiba+'">\n\
                                                <i class="fa fa-list-alt"></i>\n\
                                            </button>\n\
                                            <button type="button" class="item" data-button="btnxoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.pkk[i].id+'" data-name="'+data.pkk[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }

                            $('#tbl_pkk').html(tt_pkk);
                            $('#tbl_pkk button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                    
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" phiếu kê khai viện phí được tìm thấy!");
//                            $('#btnlocds').tooltip('hide').attr('data-original-title', 'Lọc danh sách tìm kiếm').tooltip('fixTitle').tooltip('show');
                        }
                        else{
                            $('#tbl_pkk').html("");
                            $('#kqtimliem').text("Không có phiếu kê khai viên phí nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/kham_va_dieu_tri/phieu_ke_khai_vp/lay_ds_all',
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
                        alert("Lỗi khi tải danh sách phiếu kê khai viện phí! Mô tả: "+data.msg);
                    }else{
                        var tt_pkk='';
                        for(var i=0; i<data.pkk.length; ++i){
                            tt_pkk+='\n\
                                <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.pkk[i].id+'" data-name="'+data.pkk[i].hoten+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.pkk[i].hoten+'</td>\n\
                                <td>'+data.pkk[i].dttn+'</td>\n\
                                <td>'+data.pkk[i].htdt+'</td>\n\
                                <td class="text-left">'+data.pkk[i].chuandoan+'</td>\n\
                                <td>'+data.pkk[i].songaydt+'</td>\n\
                                <td>'+data.pkk[i].ngaylap+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button type="button" class="item" data-toggle="modal" data-target="#modalkkvp" data-button="btnxempkk" data-id="'+data.pkk[i].idba+'" rel="tooltip" title="Xem kết quả CLS" data-loaiba="'+data.pkk[i].loaiba+'">\n\
                                            <i class="fa fa-list-alt"></i>\n\
                                        </button>\n\
                                        <button type="button" class="item" data-button="btnxoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.pkk[i].id+'" data-name="'+data.pkk[i].hoten+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }

                        $('#tbl_pkk').html(tt_pkk);
                        $('#tbl_pkk button[data-id]').tooltip({
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
        
        //click check sum
        $('body').on('change', 'input[data-input="checksum"]', function(){
            if($(this).prop("checked")){
                $('#tbl_pkk input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_pkk input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_pkk').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksum"]').prop("checked",false);
            }
            else{
                if($('#tbl_pkk input[data-input="check"]:checked').length == $('#tbl_pkk input[data-input="check"]').length){
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