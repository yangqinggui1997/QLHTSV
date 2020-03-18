@extends('kham_vs_dieu_tri.layout')

@section('title')
    {{ "Toa thuốc ngoại trú" }}
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
        @if($nd->Quyen == 'bsk')
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" m-b-35">
                                <h3 class="title-5 font-weight-bold text-green">DANH SÁCH TOA THUỐC NGOẠI TRÚ - KHOA [{{mb_convert_case($nd->nhanVien->phongBan->Khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8')}}] - BS. {{mb_convert_case($nd->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8')}}</h3>
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
                                            <th>Chuẩn đoán</th>
                                            <th>Ngày ra toa</th>
                                            <th>Số ngày điều trị</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_toathuoc">
                                        @if(isset($dstoa))
                                        @foreach($dstoa as $toa)
                                        <tr class="tr-shadow">
                                            <td style="vertical-align: middle;">
                                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                    <input type="checkbox" data-input="check" data-id="{{ $toa->IdTT }}" data-name="<?php echo $toa->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>{{$toa->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                            <td>
                                                @if($toa->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                BHYT
                                                @else
                                                Thu phí
                                                @endif
                                            </td>
                                            <td class="text-left">
                                                @foreach($toa->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $cd)
                                                    {{'- '.$cd->danhMucBenh->TenBenh}}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{\comm_functions::deDateFormat($toa->created_at)}}
                                            </td>
                                            <td>
                                                <?php
                                                    echo $toa->benhAnNgoaiTru->benhAnNgoaiTru->SoNgayDT;
                                                ?>
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button type="button" class="item" data-toggle="modal" data-target="#modaltt" data-button="btnxemtt" data-id="{{$toa->IdTT}}" rel="tooltip" title="Xem toa thuốc">
                                                        <i class="fa fa-list-alt"></i>
                                                    </button>
                                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$toa->IdTT}}" data-name="{{$toa->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
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
        @else
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" m-b-35">
                                <h3 class="title-5 font-weight-bold text-green">DANH SÁCH TOA THUỐC NGOẠI TRÚ HÔM NAY - DS. {{mb_convert_case($nd->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8')}}</h3>
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
                            <div class="table-responsive table-responsive-data2 fit_table_height_500">
                                <table class="table table-data2 table-hover m-b-20 text-center">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="au-checkbox">
                                                    <input type="checkbox" data-input="checksum">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </th>
                                            <th>bệnh nhân</th>
                                            <th>Đối tượng tiếp nhận</th>
                                            <th>Bác sĩ kê đơn</th>
                                            <th>Chuẩn đoán</th>
                                            <th>Ngày ra toa</th>
                                            <th>Số ngày điều trị</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_toathuoc">
                                        @if(isset($dstoa))
                                        @foreach($dstoa as $toa)
                                        <tr class="tr-shadow">
                                            <td style="vertical-align: middle;">
                                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                    <input type="checkbox" data-input="check" data-id="{{ $toa->IdTT }}" data-name="<?php echo $toa->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>{{$toa->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                            <td class="text-left">
                                                @if($toa->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                BHYT
                                                @else
                                                Thu phí
                                                @endif
                                            </td>
                                            <td>{{$toa->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV}}</td>
                                            <td>
                                                @foreach($toa->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $cd)
                                                    {{'- '.$cd->danhMucBenh->TenBenh}}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{\comm_functions::deDateFormat($toa->created_at)}}
                                            </td>
                                            <td>
                                                <?php
                                                    echo $toa->benhAnNgoaiTru->benhAnNgoaiTru->SoNgayDT;
                                                ?>
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button type="button" class="item" data-toggle="modal" data-target="#modaltt" data-button="btnxemtt" data-id="{{$toa->IdTT}}" rel="tooltip" title="Xem toa thuốc">
                                                        <i class="fa fa-list-alt"></i>
                                                    </button>
                                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xác nhận đã lãnh thuốc" data-button="btnxnlanhthuoc" data-id="{{$toa->IdTT}}" data-name="{{$toa->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                        <i class="fa fa-check"  ></i>
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
        @endif
        <!-- END DATA TABLE-->
        
        <!--MODAL XEM TOA THUỐC ĐIỀU TRỊ-->
        <div class="modal fade" id="modaltt" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Chi tiết toa thuốc điều trị</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class=" m-b-20">
                                    <h5 class="title-5 font-weight-bold text-green font-size-11">PHẦN TOA THUỐC</h5>
                                    <hr class="line-seprate">
                                </div>
                                <div class="card">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ghi chú toa thuốc</label>
                                                        <textarea rows="1" id='ghichutoathuoc' class="form-control" readonly=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-data__tool" style="margin-bottom: 0">
                                    <div class="table-data__tool-left">
                                        <div class=" m-b-35">
                                            <h5 class="title-5 font-weight-bold text-green font-size-11">DANH SÁCH THUỐC ĐIỀU TRỊ</h5>
                                            <hr class="line-seprate">
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2 fit_table_height_300">
                            <table class="table table-data2 table-hover m-b-20 text-center">
                                <thead>
                                    <tr>
                                        <th>Tên thuốc</th>
                                        <th>đơn vị tính</th>
                                        <th>Cách dùng</th>
                                        <th>Liều dùng</th>
                                        <th>tổng số lượng</th>
                                        <th>số ngày dùng thuốc</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_toact">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL XEM TOA THUỐC ĐIỀU TRỊ-->
        
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
        
        $('#tbl_toathuoc').on ('click', 'button[data-button="btnxnlanhthuoc"]', function(){
            var idtt=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm('Bệnh nhân '+name+' đã lãnh thuốc?');
            if(cf == false){
                return false;
            }
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idtt', idtt);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_ngoai_tru/xac_nhan_lt',
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
                        $('#tbl_toathuoc tr').has('td div button[data-id="'+data.id+'"]').next('tr.spacer').remove();
                        $('#tbl_toathuoc tr').has('td div button[data-id="'+data.id+'"]').remove();
                        alert('Đã xác nhận thành công!');
                    }
                    else if(data.msg == 'ktt'){
                        alert('Toa thuốc không tồn tại, có thể đã bị xóa!');
                    }
                    else{
                        alert("Xác nhận lãnh thuốc thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Xác nhận lãnh thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Xác nhận lãnh thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Xác nhận lãnh thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
            
        });
        
        $('#tbl_toathuoc').on ('click', 'button[data-button="btnxemtt"]', function(){
            var idtt=$(this).attr('data-id');
            $('#tbl_toact').html('');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idtt', idtt);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_ngoai_tru_ct/lay_ds',
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
                    if(data.msg == 'cotoa'){
                        var toact='';
                        for(var i=0; i<data.dstoact.length; ++i){
                            toact+='\n\
                                <tr class="tr-shadow">\n\
                                <td data-idthuoc="'+data.dstoact[i].idthuoc+'">'+data.dstoact[i].tenthuoc+'</td>\n\
                                <td>'+data.dstoact[i].dvt+'</td>\n\
                                <td>'+data.dstoact[i].cachdung+'</td>\n\
                                <td>'+data.dstoact[i].lieudung+'</td>\n\
                                <td>'+data.dstoact[i].sl+'</td>\n\
                                <td>'+data.dstoact[i].snd+'</td>\n\
                                <td>'+data.dstoact[i].ghichu+'</td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#ghichutoathuoc').val(data.ghichu);
                        
                        $('#tbl_toact').html(toact);
                    }
                    else if(data.msg == 'koco'){
                        alert('Toa thuốc không tồn tại, có thể đã bị xóa!');
                    }
                    else{
                        alert("Lấy danh sách chi tiết toa thuốc gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy danh sách chi tiết toa thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy danh sách chi tiết toa thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy danh sách chi tiết toa thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
            
        });
        
        $('#tbl_toathuoc').on('click','button[data-button="btnxoa"]',function(){
            
            var idtt=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa toa thuốc của bệnh nhân "+name+"?");
            if(cf==true){
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('idtt', idtt);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_ngoai_tru/xoa',
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
                            if($('#tbl_toathuoc').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            if(locds == true){
                                soluongl--;
                                if(soluongl == 0){
                                     $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongl+" toa thuốc được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" toa thuốc tìm thấy!");
                                    }
                                }
                            }
                            $('#tbl_toathuoc tr').has('td div button[data-id="'+idtt+'"]').next('tr.spacer').remove();
                            $('#tbl_toathuoc tr').has('td div button[data-id="'+idtt+'"]').remove();
                            alert("Xóa thông tin toa thuốc thành công!");
                        }
                        else{
                            alert("Xóa thông tin toa thuốc thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin toa thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin toa thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin toa thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if(!$('#tbl_toathuoc input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn toa thuốc để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[]
                $('#tbl_toathuoc input[data-input="check"]').each(function(){
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
                    cf=confirm("Bạn có thực sự muốn xóa các toa thuốc của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa toa thuốc của bệnh nhân  "+name+"?");
                }
                if(cf==true){
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('idtt', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_ngoai_tru/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" toa thuốc được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" toa thuốc được tìm thấy!");
                                            }
                                        }
                                    }
                                    for (var i = 0; i < arr.length; i++) {
                                        $('#tbl_toathuoc tr').has('td div button[data-id="'+arr[i]+'"]').next('tr.spacer').remove();
                                        $('#tbl_toathuoc tr').has('td div button[data-id="'+arr[i]+'"]').remove();
                                    }
                                    if($('#tbl_toathuoc').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các toa thuốc thành công!");
                                    
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" toa thuốc được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" toa thuốc được tìm thấy!");
                                        }
                                    }
                                    $('#tbl_toathuoc tr').has('td div button[data-id="'+arr[0]+'"]').next('tr.spacer').remove();
                                    $('#tbl_toathuoc tr').has('td div button[data-id="'+arr[0]+'"]').remove();
                                    
                                    if($('#tbl_toathuoc').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin toa thuốc thành công!");
                                    
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các toa thuốc thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin toa thuốc thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các toa thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các toa thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các toa thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin toa thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin toa thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin toa thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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
            var url='/qlkcb/kham_va_dieu_tri/toa_thuoc_ngoai_tru/tim_kiem';
            if($('#loaind').val().toString() == 'pt'){
                url='/qlkcb/kham_va_dieu_tri/toa_thuoc_ngoai_tru/tim_kiem_nvpt';
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
                    if(data.msg != 'tc'){
                        alert("Tìm kiếm gặp phải lỗi! Mô tả: "+data.msg);
                    }else{
                        if(data.sl > 0){
                            soluongtk=data.sl;
                            var tt_toa='';
                            if($('#loaind').val().toString() == 'bsk'){
                                for(var i=0; i<data.dstoa.length; ++i){
                                    tt_toa+='\n\
                                        <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.dstoa[i].id+'" data-name="'+data.dstoa[i].hoten+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td>'+data.dstoa[i].hoten+'</td>\n\
                                        <td>'+data.dstoa[i].dttn+'</td>\n\
                                        <td class="text-left">'+data.dstoa[i].chuandoan+'</td>\n\
                                        <td>'+data.dstoa[i].ngayratoa+'</td>\n\
                                        <td>'+data.dstoa[i].sndt+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" data-toggle="modal" data-target="#modaltt" data-button="btnxemtt" data-id="'+data.dstoa[i].id+'" rel="tooltip" title="Xem toa thuốc">\n\
                                                    <i class="fa fa-list-alt"></i>\n\
                                                </button>\n\
                                                <button type="button" class="item" data-button="btnxoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dstoa[i].id+'" data-name="'+data.dstoa[i].hoten+'">\n\
                                                    <i class="zmdi zmdi-delete"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                                }
                            }
                            else{
                                for(var i=0; i<data.dstoa.length; ++i){
                                    tt_toa+='\n\
                                        <tr class="tr-shadow">\n\
                                        <td>\n\
                                            <label class="au-checkbox">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.dstoa[i].id+'" data-name="'+data.dstoa[i].hoten+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td>'+data.dstoa[i].hoten+'</td>\n\
                                        <td>'+data.dstoa[i].dttn+'</td>\n\
                                        <td>'+data.dstoa[i].bsdt+'</td>\n\
                                        <td class="text-left">'+data.dstoa[i].chuandoan+'</td>\n\
                                        <td>'+data.dstoa[i].ngayratoa+'</td>\n\
                                        <td>'+data.dstoa[i].sndt+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" data-toggle="modal" data-target="#modaltt" data-button="btnxemtt" data-id="'+data.dstoa[i].id+'" rel="tooltip" title="Xem toa thuốc">\n\
                                                    <i class="fa fa-list-alt"></i>\n\
                                                </button>\n\
                                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xác nhận đã lãnh thuốc" data-button="btnxnlanhthuoc" data-id="'+data.dstoa[i].id+'" data-name="'+data.dstoa[i].hoten+'">\n\
                                                    <i class="fa fa-check"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                                }
                            }

                            $('#tbl_toathuoc').html(tt_toa);
                            $('#tbl_toathuoc button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                    
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" toa thuốc được tìm thấy!");
                        }
                        else{
                            $('#tbl_toathuoc').html("");
                            $('#kqtimliem').text("Không có toa thuốc nào được tìm thấy!");tk=false;
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
            var url='/qlkcb/kham_va_dieu_tri/toa_thuoc_ngoai_tru/lay_ds_toa';
            if($('#loaind').val().toString() == 'pt'){
                url='/qlkcb/kham_va_dieu_tri/toa_thuoc_ngoai_tru/lay_ds_toa_nvpt';
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
                    if(data.msg != 'tc'){
                        alert("Lỗi khi tải danh sách toa thuốc! Mô tả: "+data.msg);
                    }else{
                        var tt_toa='';
                        if($('#loaind').val().toString() == 'bsk'){
                            for(var i=0; i<data.dstoa.length; ++i){
                                tt_toa+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dstoa[i].id+'" data-name="'+data.dstoa[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.dstoa[i].hoten+'</td>\n\
                                    <td>'+data.dstoa[i].dttn+'</td>\n\
                                    <td class="text-left">'+data.dstoa[i].chuandoan+'</td>\n\
                                    <td>'+data.dstoa[i].ngayratoa+'</td>\n\
                                    <td>'+data.dstoa[i].sndt+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" data-toggle="modal" data-target="#modaltt" data-button="btnxemtt" data-id="'+data.dstoa[i].id+'" rel="tooltip" title="Xem toa thuốc">\n\
                                                <i class="fa fa-list-alt"></i>\n\
                                            </button>\n\
                                            <button type="button" class="item" data-button="btnxoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dstoa[i].id+'" data-name="'+data.dstoa[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                        }
                        else{
                            for(var i=0; i<data.dstoa.length; ++i){
                                tt_toa+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td>\n\
                                        <label class="au-checkbox">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dstoa[i].id+'" data-name="'+data.dstoa[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.dstoa[i].hoten+'</td>\n\
                                    <td>'+data.dstoa[i].dttn+'</td>\n\
                                    <td>'+data.dstoa[i].bsdt+'</td>\n\
                                    <td class="text-left">'+data.dstoa[i].chuandoan+'</td>\n\
                                    <td>'+data.dstoa[i].ngayratoa+'</td>\n\
                                    <td>'+data.dstoa[i].sndt+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" data-toggle="modal" data-target="#modaltt" data-button="btnxemtt" data-id="'+data.dstoa[i].id+'" rel="tooltip" title="Xem toa thuốc">\n\
                                                <i class="fa fa-list-alt"></i>\n\
                                            </button>\n\
                                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xác nhận đã lãnh thuốc" data-button="btnxnlanhthuoc" data-id="'+data.dstoa[i].id+'" data-name="'+data.dstoa[i].hoten+'">\n\
                                                <i class="fa fa-check"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                        }
                        $('#tbl_toathuoc').html(tt_toa);
                        $('#tbl_toathuoc button[data-id]').tooltip({
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
                $('#tbl_toathuoc input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_toathuoc input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_toathuoc').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksum"]').prop("checked",false);
            }
            else{
                if($('#tbl_toathuoc input[data-input="check"]:checked').length == $('#tbl_toathuoc input[data-input="check"]').length){
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