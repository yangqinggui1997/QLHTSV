@extends('hanh_chinh.layout')

@section('title')
    {{ "Chấm công nhân viên" }}
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
                <!-- CẬP NHẬT BẢNG CHẤM CÔNG -->
                <section class="p-t-20 hidden" id="formcc" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="formtitle">CẬP NHẬT THÔNG TIN BẢNG CHẤM CÔNG</h3>
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
                                                                <label class=" form-control-label">Họ tên nhân viên</label>
                                                                <input readonly="" type="text" class="form-control" id="hoten"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Giới tính</label>
                                                                <input readonly=""  type="text" class="form-control" id="gt"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Loại nhân viên</label>
                                                                <input readonly=""  type="text" class="form-control" id="loainv"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Hợp đồng từ ngày</label>
                                                                <input readonly=""  type="text" class="form-control" id="hdtn"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Hợp đồng đến ngày</label>
                                                                <input readonly=""  type="text" class="form-control" id="hddn"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chuyên môn</label>
                                                                <input readonly=""  type="text" class="form-control" id="chuyenmon"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chức vụ</label>
                                                                <select class="form-control" id="cv">
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Công việc</label>
                                                                <input readonly=""  type="text" class="form-control" id="congviec"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">HSL</label>
                                                                <input readonly=""  type="text" class="form-control" id="hsl"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Lương cơ bản</label>
                                                                <input readonly=""  type="text" class="form-control" id="luongcb"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Số ngày công (<span class="color-red">*</span>)</label>
                                                                <input onkeydown="return false" max="26" min="1" maxlength="2" type="number" placeholder="Số ngày công..." class="form-control" id="snc"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tiền thưởng</label>
                                                                <input min="0" type="number" placeholder="Tiền thưởng..." class="form-control" id="tienthuong"/>
                                                                <input type="text" readonly="" class="form-control hidden" id="txttienthuong"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tiền phạt</label>
                                                                <input min="0" type="number" placeholder="Tiền phạt..." class="form-control" id="tienphat"/>
                                                                <input type="text" readonly="" class="form-control hidden" id="txttienphat"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 hidden"  id="tlarea">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Thực lĩnh</label>
                                                                <input readonly=""  type="text" class="form-control" id="thuclinh"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        @if($nd->Quyen != 'admin' && $flag == FALSE)
                                                        <div class="col-lg-1" id="btnsuaarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Cập nhật" id="btncapnhat"><span class="fa fa-edit"></span></button>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-1" id="btntlarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--addyellow au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Tính lương" id="btntinhluong"><span class="fa fa-money"></span></button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-lg-1">
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
                <!-- END CẬP NHẬT BẢNG CHẤM CÔNG -->

                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH CHẤM CÔNG</h3>
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
                                <div class="custom-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home"
                                             aria-selected="true">DANH SÁCH CHẤM CÔNG</a>
                                            <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile"
                                             aria-selected="false">LỊCH SỬ CHẤM CÔNG</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                                            <div class="table-responsive table-responsive-data2 fit_table_height_500 tableFixHead">
                                                <table class="table table-data2 table-hover m-b-20 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th style="position: sticky; top: 0; z-index: 99;">nhân viên</th>
                                                            <th>Chức vụ</th>
                                                            <th>Công việc</th>
                                                            <th>Ngày vào làm</th>
                                                            <th>Ngày tạo</th>
                                                            <th>Cập nhật lần cuối</th>
                                                            <th>Số ngày công</th>
                                                            <th>Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbl_cc">
                                                        @if (isset($dscc))
                                                            @foreach($dscc as $cc)
                                                                <tr class="tr-shadow">
                                                                    <td class="text-left _x{{ $cc->IdCC }}" @if($cc->TTCN == 0) style="vertical-align: middle; color: red" @else @if(date('d/m/Y', strtotime($cc->updated_at)) != date('d/m/Y') && $cc->TTCN == 1) <?php $cc->TTCN = 0; $cc->save(); ?> style="vertical-align: middle; color: red"  @else style="vertical-align: middle;"  @endif @endif>{{ $cc->nhanVien->TenNV}}</td>
                                                                    <td class="text-left">
                                                                        <?php
                                                                            if(count($cc->nhanVien->chucVu) == 0){
                                                                                echo 'Nhân viên';
                                                                            }
                                                                            else{
                                                                                $i=1;
                                                                                foreach($cc->nhanVien->chucVu as $cv){
                                                                                    if($i == count($cc->nhanVien->chucVu)){
                                                                                        echo '- '.$cv->chucVu->TenCV;
                                                                                    }
                                                                                    else{
                                                                                        echo '- '.$cv->chucVu->TenCV.'<br>';
                                                                                    }
                                                                                    $i++;
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        {{ \comm_functions::decodeCongViec($cc->nhanVien->CV) }}
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo date( "d/m/Y", strtotime($cc->nhanVien->created_at));
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo \comm_functions::dedateFormat($cc->created_at);
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo \comm_functions::dedateFormat($cc->updated_at);
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-right _{{ $cc->IdCC }}">{{ $cc->SoNgayCong }}</td>
                                                                    <td>
                                                                        <div class="table-data-feature">
                                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Cập nhật" data-button="sua" data-id="{{$cc->IdCC}}">
                                                                                <i class="zmdi zmdi-edit"></i>
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
                                        <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
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
                                                            <th style="position: sticky; top: 0; z-index: 99;">nhân viên</th>
                                                            <th>Chức vụ</th>
                                                            <th>Công việc</th>
                                                            <th>Ngày vào làm</th>
                                                            <th>Ngày tạo</th>
                                                            <th>Cập nhật lần cuối</th>
                                                            <th>Số ngày công</th>
                                                            <th>Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbl_lscc">
                                                        @if (isset($dslscc))
                                                            @foreach($dslscc as $cc)
                                                                <tr class="tr-shadow">
                                                                    <td style="vertical-align: middle;">
                                                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                                            <input type="checkbox" data-input="check" data-id="{{ $cc->IdCC }}" data-name="{{ $cc->nhanVien->TenNV }}">
                                                                            <span class="au-checkmark"></span>
                                                                        </label>
                                                                    </td>
                                                                    <td class="text-left">{{ $cc->nhanVien->TenNV}}</td>
                                                                    <td class="text-left">
                                                                        <?php
                                                                            if(count($cc->nhanVien->chucVu) == 0){
                                                                                echo 'Nhân viên';
                                                                            }
                                                                            else{
                                                                                $i=1;
                                                                                foreach($cc->nhanVien->chucVu as $cv){
                                                                                    if($i == count($cc->nhanVien->chucVu)){
                                                                                        echo '- '.$cv->chucVu->TenCV;
                                                                                    }
                                                                                    else{
                                                                                        echo '- '.$cv->chucVu->TenCV.'<br>';
                                                                                    }
                                                                                    $i++;
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        {{ \comm_functions::decodeCongViec($cc->nhanVien->CV) }}
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo date( "d/m/Y", strtotime($cc->nhanVien->created_at));
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo \comm_functions::dedateFormat($cc->created_at);
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo \comm_functions::dedateFormat($cc->updated_at);
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-right">{{ $cc->SoNgayCong }}</td>
                                                                    <td>
                                                                        <div class="table-data-feature">
                                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-button="xemct" data-id="{{$cc->IdCC}}">
                                                                                <i class="fa fa-list-alt"></i>
                                                                            </button>
                                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{$cc->IdCC}}" data-name="{{$cc->nhanVien->TenNV}}">
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

        var channel = pusher.subscribe('QLCC');
        function laytt(data) {
            if(data.thaotac == 'tl'){
                var ttlscc='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.ccc.id+'" data-name="'+data.ccc.hoten+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td class="text-left">'+data.ccc.hoten+'</td>\n\
                        <td class="text-left">'+data.ccc.cv+'</td>\n\
                        <td class="text-left">'+data.ccc.congviec+'</td>\n\
                        <td>'+data.ccc.nvl+'</td>\n\
                        <td>'+data.ccc.ntcc+'</td>\n\
                        <td>'+data.ccc.ncn+'</td>\n\
                        <td class="text-right">'+data.ccc.snc+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="xemct" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-id="'+data.ccc.id+'">\n\
                                    <i class="fa fa-list-alt"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.ccc.id+'" data-name="'+data.ccc.hoten+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr><tr class="spacer"></tr>';

                var ttcc='\n\
                    <tr class="tr-shadow">\n\
                        <td class="text-left _x'+data.cc.id+'" style="vertical-align: middle;">'+data.cc.hoten+'</td>\n\
                        <td class="text-left">'+data.cc.cv+'</td>\n\
                        <td class="text-left">'+data.cc.congviec+'</td>\n\
                        <td>'+data.cc.nvl+'</td>\n\
                        <td>'+data.cc.ntcc+'</td>\n\
                        <td>'+data.cc.ncn+'</td>\n\
                        <td class="text-right _'+data.cc.id+'">'+data.cc.snc+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Cập nhật" data-id="'+data.cc.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';

                $('#tbl_lscc').prepend(ttlscc);

                $('#tbl_cc tr').has('td div button[data-id="'+data.ccc.id+'"]').replaceWith(ttcc);

                $('#tbl_lscc button[data-id="'+data.ccc.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);

                $('#tbl_cc button[data-id="'+data.cc.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else if(data.thaotac == 'sua'){
                $('#tbl_cc tr td[class*="_'+data.cc.id+'"]').text(data.cc.snc);
                if(data.cc.flag==true){
                    $('#tbl_cc tr td[class*="_x'+data.cc.id+'"]').css('color', '#555');
                }
                
            }
            else{
                if($.isArray(data.cc)){
                    for (var i = 0; i < data.cc.length; i++) {
                        $('#tbl_lscc tr').has('td div button[data-id="'+data.cc[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_lscc tr').has('td div button[data-id="'+data.cc[i]+'"]').remove();

                    }
                }
                else{
                    $('#tbl_lscc tr').has('td div button[data-id="'+data.cc+'"]').next('tr.spacer').remove();
                    $('#tbl_lscc tr').has('td div button[data-id="'+data.cc+'"]').remove();

                }
            }
        }

        channel.bind('App\\Events\\HanhChinh\\QLCC', laytt);

        $('#custom-nav-profile-tab').click(function(){
            $('#kqtimliem').text('');soluongtk=0;
            $('#btndong').trigger('click');
        });

        $('#custom-nav-home-tab').click(function(){
            $('#kqtimliem').text('');soluongtk=0;
            $('#btndong').trigger('click');
        });
        
        //Submit cập nhật
        $('#btncapnhat').click(function(){
            var id=$(this).attr('data-id');
            var snc=$('#snc').val(), tt=$('#tienthuong').val(), tp=$('#tienphat').val();

            if(tt.toString().trim() == '' || parseInt(tt) == 0){
                tt=0;
            }
            if(tp.toString().trim() == '' || parseInt(tp) == 0){
                tp=0;
            }
alert(tp);return false;
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('snc', snc);
            formData.append('tt', tt);
            formData.append('tp', tp);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/cap_nhat',
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
                        alert("Cập nhật thành công!");
                    }
                    else if(data.msg == 'ktt'){
                        alert("Bảng chấm công không tồn tại, có thể đã bị xóa!");
                    }
                    else{
                        alert("Cập nhật thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật

        $('#btntinhluong').click(function(){
            var id=$(this).attr('data-id');

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/kt_snc',
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
                            var cf= confirm("Số ngày công hiện chưa đủ 26 ngày. Bạn có muốn tiếp tục?");
                            if(cf == true){
                                $.ajax({
                                    type: 'POST',
                                    dataType: "JSON",
                                    url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/tinh_luong',
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
                                            alert("Đã tính xong! Bạn có thể xem lại thông tin bảng chấm công này trong mục [LỊCH SỬ CHẤM CÔNG].");
                                            $('#btnsuaarea').fadeOut(800);$('#btntlarea').fadeOut(800);
                                            $('#tlarea').removeClass('hidden');
                                            $('#thuclinh').val(data.tl);
                                            
                                        }
                                        else{
                                            alert("Tính lương thất bại! Lỗi: "+data.msg);
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        if(jqXHR.status == 419){
                                            alert("Tính lương thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                        }
                                        else if(jqXHR.status == 500){
                                            alert("Tính lương thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                        }
                                        else{
                                            alert("Tính lương thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                        }
                                    }
                                });
                            }
                        }
                        else{
                            $.ajax({
                                type: 'POST',
                                dataType: "JSON",
                                url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/tinh_luong',
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
                                        alert("Đã tính xong! Bạn có thể xem lại thông tin bảng chấm công này trong mục [LỊCH SỬ CHẤM CÔNG].");
                                        $('#btnsuaarea').fadeOut(800);$('#btntlarea').fadeOut(800);
                                            $('#tlarea').removeClass('hidden');
                                            $('#thuclinh').val(data.tl);
                                    }
                                    else{
                                        alert("Tính lương thất bại! Lỗi: "+data.msg);
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    if(jqXHR.status == 419){
                                        alert("Tính lương thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                    }
                                    else if(jqXHR.status == 500){
                                        alert("Tính lương thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                    }
                                    else{
                                        alert("Tính lương thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                    }
                                }
                            });
                        }
                    }
                    else if(data.msg == 'ktt'){
                        alert("Bảng chấm công không tồn tại, có thể đã bị xóa!");
                    }
                    else{
                        alert("Kiểm tra số ngày công thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Kiểm tra số ngày công thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Kiểm tra số ngày công thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Kiểm tra số ngày công thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });  
        });

        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formcc').slideUp(800);
        });
        //end đóng form nhập liệu
        
        //xóa
        $('#tbl_lscc').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa bảng chấm công của nhân viên "+name+"?");
            if(cf==true){
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" bảng chấm công được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    if(soluongtk > 0){
                                        soluongtk--;
                                    }
                                    
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" bảng chấm công được tìm thấy!");
                                    }
                                }
                            }
                            if($('#tbl_lscc').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            alert("Xóa thông tin bảng chấm công thành công!");
                        }
                        else{
                            alert("Xóa thông tin bảng chấm công thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin bảng chấm công thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin bảng chấm công thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin bảng chấm công thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });

        //mở form để sửa
        $('#tbl_cc').on('click','button[data-button="sua"]',function(){
            $('#formtitle').text('CẬP NHẬT THÔNG TIN BẢNG CHẤM CÔNG');
            $('#btnsuaarea').fadeIn(800);$('#btntlarea').fadeIn(800);

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            $('#btntinhluong').attr('data-id',$(this).attr('data-id'));
            $('#snc').removeAttr('readonly');$('#tienthuong').removeClass('hidden');$('#tienphat').removeClass('hidden');
            $('#txttienthuong').addClass('hidden');$('#txttienphat').addClass('hidden');
            $('#tlarea').addClass('hidden');
            $('#thuclinh').val('');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/lay_tt_cap_nhat',
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
                        $('#loainv').val(data.loainv);$('#hdtn').val(data.hdtn);$('#hddn').val(data.hddn);$('#chuyenmon').val(data.chuyenmon);

                        $('#hoten').val(data.hoten);$('#gt').val(data.gt);$('#hsl').val(data.hsl);$('#luongcb').val(data.lcb);$('#cv').html(data.cv);$('#congviec').val(data.congviec);
                        $('#snc').val(data.snc);$('#tienthuong').val(data.tt);$('#tienphat').val(data.tp);
                        var max =data.snc + 1;
                        if(max > 26){
                            max=26;
                        }
                        $('#snc').attr('min', data.snc);$('#snc').attr('max', max);
                        
                        if(data.flag == false){
                            $('#snc').attr('readonly','');
                        }
                        else{
                            $('#snc').removeAttr('readonly');
                        }
                        
                        $('#formcc').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formcc").offset().top
                        }, 800);
                    }
                    else if(data.msg == 'ktt'){
                        alert("Bảng chấm công không tồn tại, có thể đã bị xóa!");
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

        $('#tbl_lscc').on('click','button[data-button="xemct"]',function(){
            $('#formtitle').text('XEM THÔNG TIN BẢNG CHẤM CÔNG');
            $('#btnsuaarea').fadeOut(800);$('#btntlarea').fadeOut(800);
            $('#snc').attr('readonly','');$('#tienthuong').addClass('hidden');$('#tienphat').addClass('hidden');
            $('#txttienthuong').removeClass('hidden');$('#txttienphat').removeClass('hidden');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            formData.append('xemct', 'xem');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/lay_tt_cap_nhat',
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
                        $('#loainv').val(data.loainv);$('#hdtn').val(data.hdtn);$('#hddn').val(data.hddn);$('#chuyenmon').val(data.chuyenmon);
                        $('#hoten').val(data.hoten);$('#gt').val(data.gt);$('#hsl').val(data.hsl);$('#luongcb').val(data.lcb);$('#cv').html(data.cv);$('#congviec').val(data.congviec);
                        $('#snc').val(data.snc);$('#txttienthuong').val(addCommas(data.tt.toString()));$('#txttienphat').val(addCommas(data.tp.toString()));
                        $('#tlarea').removeClass('hidden');
                        $('#thuclinh').val(data.tl);
                        $('#formcc').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formcc").offset().top
                        }, 800);
                    }
                    else if(data.msg == 'ktt'){
                        alert("Bảng chấm công không tồn tại, có thể đã bị xóa!");
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

        //tìm kiếm
        $('#btntimkiem').click(function (){
            if($('#txttimkiem').val().toString().trim() == ''){
                alert('Vui lòng nhập thông tin tìm kiếm!');
                return false;
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('keyWords', $('#txttimkiem').val());

            if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                $('input[data-input="checksum"]').prop("checked",false);
                $('input[data-input="check"]').prop("checked",false);
                formData.append('loaicc', 'ls');
            }

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/tim_kiem',
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
                            var ttcc='';
                            if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                                for(var i=0; i<data.cc.length; ++i){
                                    ttcc+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.cc[i].id+'" data-name="'+data.cc[i].hoten+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td class="text-left">'+data.cc[i].hoten+'</td>\n\
                                        <td class="text-left">'+data.cc[i].cv+'</td>\n\
                                        <td class="text-left">'+data.cc[i].congviec+'</td>\n\
                                        <td>'+data.cc[i].nvl+'</td>\n\
                                        <td>'+data.cc[i].ntcc+'</td>\n\
                                        <td>'+data.cc[i].ncn+'</td>\n\
                                        <td class="text-right">'+data.cc[i].snc+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button class="item" data-button="xemct" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-id="'+data.cc[i].id+'">\n\
                                                    <i class="fa fa-list-alt"></i>\n\
                                                </button>\n\
                                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.cc[i].id+'" data-name="'+data.cc[i].hoten+'">\n\
                                                    <i class="zmdi zmdi-delete"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr><tr class="spacer"></tr>';
                                }

                                $('#tbl_lscc').html(ttcc);
                                $('#tbl_lscc button[data-button]').tooltip({
                                    trigger: 'manual'

                                })
                                .focus(hideTooltip)
                                .blur(hideTooltip)
                                .hover(showTooltip, hideTooltip);
                            }
                            else{
                                for(var i=0; i<data.cc.length; ++i){
                                    ttcc+='\n\
                                    <tr class="tr-shadow">';
                                    if(data.cc[i].flag == true){
                                        ttcc+='<td class="text-left _x'+data.cc[i].id+'" style="vertical-align: middle; color:red">'+data.cc[i].hoten+'</td>';
                                    }
                                    else{
                                        ttcc+='<td class="text-left _'+data.cc[i].id+'" style="vertical-align: middle;">'+data.cc[i].hoten+'</td>';
                                    }    
                                        ttcc+='<td class="text-left">'+data.cc[i].cv+'</td>\n\
                                        <td class="text-left">'+data.cc[i].congviec+'</td>\n\
                                        <td>'+data.cc[i].nvl+'</td>\n\
                                        <td>'+data.cc[i].ntcc+'</td>\n\
                                        <td>'+data.cc[i].ncn+'</td>\n\
                                        <td class="text-right _'+data.cc[i].id+'">'+data.cc[i].snc+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Cập nhật" data-id="'+data.cc[i].id+'">\n\
                                                    <i class="zmdi zmdi-edit"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr><tr class="spacer"></tr>';
                                }

                                $('#tbl_cc').html(ttcc);
                                $('#tbl_cc button[data-button]').tooltip({
                                    trigger: 'manual'

                                })
                                .focus(hideTooltip)
                                .blur(hideTooltip)
                                .hover(showTooltip, hideTooltip);
                            }

                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" bảng chấm công được tìm thấy!");
                        }
                        else{
                            if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                                $('#tbl_lscc').html("");
                            }
                            else{
                                $('#tbl_cc').html("");
                            }
                            $('#kqtimliem').text("Không có bảng chấm công nào được tìm thấy!");tk=false;
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
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                $('input[data-input="checksum"]').prop("checked",false);
                $('input[data-input="check"]').prop("checked",false);
                formData.append('loaicc', 'ls');
            }

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/lay_ds',
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
                        var ttcc='';
                        if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                            for(var i=0; i<data.cc.length; ++i){
                                ttcc+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.cc[i].id+'" data-name="'+data.cc[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td class="text-left">'+data.cc[i].hoten+'</td>\n\
                                    <td class="text-left">'+data.cc[i].cv+'</td>\n\
                                    <td class="text-left">'+data.cc[i].congviec+'</td>\n\
                                    <td>'+data.cc[i].nvl+'</td>\n\
                                    <td>'+data.cc[i].ntcc+'</td>\n\
                                    <td>'+data.cc[i].ncn+'</td>\n\
                                    <td class="text-right">'+data.cc[i].snc+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="xemct" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-id="'+data.cc[i].id+'">\n\
                                                <i class="fa fa-list-alt"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.cc[i].id+'" data-name="'+data.cc[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr><tr class="spacer"></tr>';
                            }

                            $('#tbl_lscc').html(ttcc);
                            $('#tbl_lscc button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                        }
                        else{
                            for(var i=0; i<data.cc.length; ++i){
                                ttcc+='\n\
                                    <tr class="tr-shadow">';
                                    if(data.cc[i].flag == true){
                                        ttcc+='<td class="text-left _x'+data.cc[i].id+'" style="vertical-align: middle; color:red">'+data.cc[i].hoten+'</td>';
                                    }
                                    else{
                                        ttcc+='<td class="text-left _'+data.cc[i].id+'" style="vertical-align: middle;">'+data.cc[i].hoten+'</td>';
                                    }    
                                    ttcc+='<td class="text-left">'+data.cc[i].cv+'</td>\n\
                                    <td class="text-left">'+data.cc[i].congviec+'</td>\n\
                                    <td>'+data.cc[i].nvl+'</td>\n\
                                    <td>'+data.cc[i].ntcc+'</td>\n\
                                    <td>'+data.cc[i].ncn+'</td>\n\
                                    <td class="text-right _'+data.cc[i].id+'">'+data.cc[i].snc+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Cập nhật" data-id="'+data.cc[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr><tr class="spacer"></tr>';
                            }

                            $('#tbl_cc').html(ttcc);
                            $('#tbl_cc button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                        } 
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
        $('#tbl_lscc').on('change', 'input[data-input="check"]', function(){
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
                alert("Bạn chưa chọn bảng chấm công để xóa!");
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin bảng chấm công của các nhân viên "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin bảng chấm công của nhân viên "+name+"?");
                }
                if(cf==true){
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/hanh_chinh/quan_ly_cham_cong/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" bảng chấm công được tìm thấy!");
                                        }
                                    }
                                    else{
                                        if(tk == true){
                                            if(soluongtk > 0){
                                                soluongtk = soluongtk - arr.length;
                                            }
                                            
                                            if(soluongtk == 0)
                                            {
                                                $('#kqtimliem').text("");
                                            }
                                            else
                                            {
                                                $('#kqtimliem').text("Có "+soluongtk+" bảng chấm công được tìm thấy!");
                                            }
                                        }
                                    }
                                    if($('#tbl_lscc').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các bảng chấm công thành công!");
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" bảng chấm công được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" bảng chấm công được tìm thấy!");
                                        }
                                    }
                                    if($('#tbl_lscc').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin bảng chấm công thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các bảng chấm công thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin bảng chấm công thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các bảng chấm công thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các bảng chấm công thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các bảng chấm công thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin bảng chấm công thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin bảng chấm công thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin bảng chấm công thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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
//
//        $('#snc').on('keypress', function (evt){
//            if($(this).val().toString().length == 2){
//                evt.preventDefault();
//            }
//
//        });

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