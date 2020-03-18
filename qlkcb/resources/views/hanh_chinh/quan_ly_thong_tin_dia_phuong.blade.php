@extends('hanh_chinh.layout')

@section('title')
    {{ "Thông tin địa phương" }}
@endsection

@section('css')
<style type="text/css">
    textarea {
       resize: none;
    }
</style>
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
                <!-- THÊM MỚI THÔNG TIN DP-->
                <section class="p-t-20 hidden" id="formdp" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="formtitle"></h3>
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
                                                                <label class=" form-control-label">Mã hành chính (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="VD: 89" class="form-control" id="madp"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tên địa phương (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập tên địa phương..." class="form-control" id="tendp"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7 hidden" id="dsdparea">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tên địa phương trực thuộc</label>
                                                                <select class="form-control" id="dsdp">
                                                               
                                                                </select>
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
                <!-- END THÊM MỚI THÔNG DP-->

                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="dstitle">DANH SÁCH TỈNH - THÀNH PHỐ</h3>
                                    <hr class="line-seprate">
                                </div>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light width-230px m-b-15">
                                            <select class="js-select2" id="ds_f">
                                                <option value="tinh">Danh sách Tỉnh/ TP</option>
                                                <option value="huyen">Danh sách Quận/ Huyện</option>
                                                <option value="xa">Danh sách Xã/ Phường</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-230px m-b-15 hidden" id="tinh_farea">
                                            <select class="js-select2" id="tinh_f">
                                                <option value="all">Tất cả Tỉnh/ Thành phố</option>
                                                @if(isset($dstinh))
                                                    <?php foreach($dstinh as $t){ ?>
                                                <option value="<?php echo $t->IdTinh; ?>">{{$t->TenTinh}}</option>
                                                    <?php }?>
                                                @endif
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15 hidden" id="huyen_farea">
                                            <select class="js-select2" id="huyen_f">
                                                <option value="all">Tất cả Quận/ Huyện</option>
                                                
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="fas fa-compass"></i></button>
                                        <button type="button" class="au-btn au-btn--teal au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Nạp lại danh sách" id="btnnapds"><i class="zmdi zmdi-refresh"></i></button>
                                        <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatc"><i class="zmdi zmdi-delete"></i></button>
                                    </div>
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
                                                <th style="position: sticky; top: 0; z-index: 99;">mã đại phương</th>
                                                <th>Tên đại phương</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_dp">
                                            @if(isset($dstinh))
                                            @foreach($dstinh as $tinh)
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $tinh->IdTinh }}" data-name="{{ $tinh->TenTinh }}">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$tinh->IdTinh}}</td>
                                                <td>{{$tinh->TenTinh}}</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{ $tinh->IdTinh }}">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{ $tinh->IdTinh }}" data-name="{{ $tinh->TenTinh}}">
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
<script src="public/js/pusher.js"></script>
<script>

    $(function () {
        //khởi tạo flag tìm kiếm
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false;
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
        
        var channel = pusher.subscribe('DP');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var ttdp='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.dp.id+'" data-name="'+data.dp.tendp+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td>'+data.dp.id+'</td>\n\
                        <td>'+data.dp.tendp+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dp.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dp.id+'" data-name="'+data.dp.tendp+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    ttdp+='<tr class="spacer"></tr>';
                    $('#tbl_dp').prepend(ttdp);
                    if(data.loaidp == 'tinh'){
                        $('#tinh_f').append('<option value="'+data.dp.id+'">'+data.dp.tendp+'</option>');
                    }
                    else if(data.loaidp == 'huyen'){
                        $('#huyen_f').append('<option value="'+data.dp.id+'">'+data.dp.tendp+'</option>');
                    }
                }
                else{

                    $('#tbl_dp tr').has('td div button[data-id="'+data.macu+'"]').replaceWith(ttdp);
                    if(data.loaidp == 'tinh'){
                        $('#tinh_f option[value="'+data.macu+'"]').replaceWith('<option value="'+data.dp.id+'">'+data.dp.tendp+'</option>');
                    }
                    else if(data.loaidp == 'huyen'){
                        $('#huyen_f option[value="'+data.macu+'"]').replaceWith('<option value="'+data.dp.id+'">'+data.dp.tendp+'</option>');
                    }

                    $('#btncapnhat').attr('data-id', data.mamoi);
                }

                $('button[data-id="'+data.dp.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isArray(data.dp)){
                    for (var i = 0; i < data.dp.length; i++) {
                        $('#tbl_dp tr').has('td div button[data-id="'+data.dp[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_dp tr').has('td div button[data-id="'+data.dp[i]+'"]').remove();
                        if(data.loaidp == 'tinh'){
                            $('#tinh_f option[value="'+data.dp[i]+'"]').remove();
                        }
                        else if(data.loaidp == 'huyen'){
                            $('#huyen_f option[value="'+data.dp[i]+'"]').remove();
                        }
                    }
                }
                else{
                    $('#tbl_dp tr').has('td div button[data-id="'+data.dp+'"]').next('tr.spacer').remove();
                    $('#tbl_dp tr').has('td div button[data-id="'+data.dp+'"]').remove();
                    if(data.loaidp == 'tinh'){
                        $('#tinh_f option[value="'+data.dp+'"]').remove();
                    }
                    else if(data.loaidp == 'huyen'){
                        $('#huyen_f option[value="'+data.dp+'"]').remove();
                    }
                }
            }
        }

        channel.bind('App\\Events\\HanhChinh\\DP', laytt);
        //end xử lý channel
        
        $('#ds_f').change(function (){
            $('#btndong').click();
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if($(this).val() == 'tinh'){
                $('#tinh_farea').addClass('hidden');
                $('#huyen_farea').addClass('hidden');
                $('#dstitle').text('DANH SÁCH TỈNH - THÀNH PHỐ');
                formData.append('laydssp', 'all-tinh');
            }
            else if($(this).val()== 'huyen'){
                $('#tinh_farea').removeClass('hidden');
                $('#huyen_farea').addClass('hidden');
                formData.append('laydssp', 'all-huyen');
                $('#dstitle').text('DANH SÁCH QUẬN - HUYỆN');
                $('#tinh_f').val('all');
                $('#select2-tinh_f-container').attr('title', 'Tất cả Tỉnh/ Thành phố');
                $('#select2-tinh_f-container').text('Tất cả Tỉnh/ Thành Phố');
            }
            else
            {
                $('#tinh_farea').removeClass('hidden');
                $('#huyen_farea').removeClass('hidden');
                $('#dstitle').text('DANH SÁCH XÃ - PHƯỜNG');
                $('#tinh_f').val('all');
                $('#select2-tinh_f-container').attr('title', 'Tất cả Tỉnh/ Thành phố');
                $('#select2-tinh_f-container').text('Tất cả Tỉnh/ Thành Phố');
                $('#huyen_f option').not("[value='all']").remove();

                formData.append('laydssp', 'all-xa');
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/lay_ds_dp',
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
                        alert("Lỗi khi tải danh sách địa phương! Mô tả: "+data.msg);
                    }else{
                        var ttdp='';
                        for(var i=0; i<data.dp.length; ++i){
                            ttdp+='\n\
                            <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.dp[i].id+'</td>\n\
                                <td>'+data.dp[i].tendp+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dp[i].id+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_dp').html(ttdp);
                        $('#tbl_dp button[data-id]').tooltip({
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
        
        $('#tinh_f').change(function(){
            $('#btndong').click();
            var id=$(this).val();
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if($('#huyen_farea').hasClass('hidden')){
                if(id == 'all'){
                    formData.append('laydssp', 'all-huyen');
                }
                else{
                    formData.append('laydssp', 'sp-tinh');
                    formData.append('tinh', id);
                }
            }
            else{
                formData.append('flag', 'flag');
                if(id == 'all'){
                    formData.append('laydssp', 'all-xa');
                }
                else{
                    formData.append('laydssp', 'sp-xa');
                    formData.append('tinh', id);
                }
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/lay_ds_dp',
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
                        alert("Lỗi khi tải danh sách địa phương! Mô tả: "+data.msg);
                    }else{
                        var ttdp='';
                        for(var i=0; i<data.dp.length; ++i){
                            ttdp+='\n\
                            <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.dp[i].id+'</td>\n\
                                <td>'+data.dp[i].tendp+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dp[i].id+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_dp').html(ttdp);
                        $('#tbl_dp button[data-id]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                        
                        if(!$('#huyen_farea').hasClass('hidden')){
                            $('#huyen_f option').not("[value='all']").remove();
                            $('#huyen_f').append(data.dshuyen);
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
        
        $('#huyen_f').change(function(){
            $('#btndong').click();
            var id=$(this).val();
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if(id == 'all'){
                if($('#tinh_f').val() == 'all'){
                    formData.append('laydssp', 'all-xa');
                }
                else{
                    formData.append('laydssp', 'sp-xa');
                    formData.append('tinh', $('#tinh_f').val());
                }
            }
            else{
                formData.append('laydssp', 'sp-huyen');
                formData.append('huyen', id);
            }
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/lay_ds_dp',
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
                        alert("Lỗi khi tải danh sách địa phương! Mô tả: "+data.msg);
                    }else{
                        var ttdp='';
                        for(var i=0; i<data.dp.length; ++i){
                            ttdp+='\n\
                            <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.dp[i].id+'</td>\n\
                                <td>'+data.dp[i].tendp+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dp[i].id+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_dp').html(ttdp);
                        $('#tbl_dp button[data-id]').tooltip({
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
        
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
               
            var ma=$('#madp').val(), tendp=$('#tendp').val();

            if(ma.toString().trim() == ''){
                alert("Vui lòng nhập thông tin mã địa phương!");
                return false;
            }
            if(tendp.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên địa phương!");
                return false;
            }
            
            if(!$('#dsdparea').hasClass('hidden')){
                if($('#dsdp').children().length == 0){
                    alert("Chưa chọn địa phương trực thuộc!");
                    return false;
                }
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('ma', ma.toString().trim());
            formData.append('ten', tendp.toString().trim());
            if($('#ds_f').val() == 'huyen'){
                if($('#tinh_f').val() != 'all'){
                    formData.append('huyen', $('#tinh_f').val());
                }
                else{
                    formData.append('huyen', $('#dsdp').val());
                }
            }
            else if($('#ds_f').val() == 'xa'){
                if($('#huyen_f').val() != 'all'){
                    formData.append('xa', $('#huyen_f').val());
                }
                else{
                    formData.append('xa', $('#dsdp').val());
                }
            }
            else{
                formData.append('tinh', 'tinh');
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/them_moi',
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
                        alert("Thêm thông tin địa phương thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);

                        $('#kqtimliem').text("");
                        tk=false;locds=false;keySearch='';
                    }
                    else if(data.msg == 'trungten'){
                        alert("Tên địa phương này đã được sử dụng!");
                    }
                    else if(data.msg == 'trungma'){
                        alert("Mã địa phương này đã được sử dụng!");
                    }
                    else{
                        alert("Thêm thông tin địa phương mới thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
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
            
            var ma=$('#madp').val(), tendp=$('#tendp').val();

            if(ma.toString().trim() == ''){
                alert("Vui lòng nhập thông tin mã địa phương!");
                return false;
            }
            if(tendp.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên địa phương!");
                return false;
            }
            
            if(!$('#dsdparea').hasClass('hidden')){
                if($('#dsdp').children().length == 0){
                    alert("Chưa chọn địa phương trực thuộc!");
                    return false;
                }
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('ma', ma.toString().trim());
            formData.append('ten', tendp.toString().trim());
            if($('#ds_f').val() == 'huyen'){
                if($('#tinh_f').val() != 'all'){
                    formData.append('huyen', $('#tinh_f').val());
                }
                else{
                    formData.append('huyen', $('#dsdp').val());
                }
            }
            else if($('#ds_f').val() == 'xa'){
                if($('#huyen_f').val() != 'all'){
                    formData.append('xa', $('#huyen_f').val());
                }
                else{
                    formData.append('xa', $('#dsdp').val());
                }
            }
            else{
                formData.append('tinh', 'tinh');
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/cap_nhat',
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
                        alert("Cập nhật thông tin địa phương thành công!");
                    }
                    else if(data.msg == 'trungten'){
                        alert("Tên địa phương này đã được sử dụng!");
                    }
                    else if(data.msg == 'trungma'){
                        alert("Mã địa phương này đã được sử dụng!");
                    }
                    else{
                        alert("Cập nhật thông tin địa phương thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin địa phương thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin địa phương thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin địa phương thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật

        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formdp').slideUp(800);
        });
        //end đóng form nhập liệu
        
        function OpenForm(){
            $('#btnthemarea').fadeIn(800);
            $('#btnlamlaiarea').fadeIn(800);
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('THÊM THÔNG TIN ĐỊA PHƯƠNG');
            $('#btnlamlai').click();
            $('#formdp').slideDown(800);
            $('html, body').animate({
                scrollTop: $("#formdp").offset().top
            }, 800);
        }

        //mở form để thêm
        $('#btnadd').click(function(){
            if($('#ds_f').val() == 'tinh'){
                $('#dsdparea').addClass('hidden');
                OpenForm();
            }
            else if($('#ds_f').val() == 'huyen'){
                if($('#tinh_f').val() != 'all'){
                    $('#dsdparea').addClass('hidden');
                    OpenForm();
                }
                else{
                    $('#dsdparea').removeClass('hidden');
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('laydssp', 'laydstinh');
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/lay_ds_dp',
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
                                alert("Lỗi khi tải danh sách địa phương! Mô tả: "+data.msg);
                            }else{
                                $('#dsdp').html(data.dstinh);
                                OpenForm();
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
                }
            }
            else if($('#ds_f').val() == 'xa'){
                if($('#huyen_f').val() == 'all'){
                    $('#dsdparea').removeClass('hidden');
                    if($('#tinh_f').val() != 'all'){
                        var formData = new FormData();
                        formData.append('_token', CSRF_TOKEN);
                        formData.append('laydssp', 'laydshuyen_t');
                        formData.append('tinh', $('#tinh_f').val());
                        $.ajax({
                            type: 'POST',
                            dataType: "JSON",
                            url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/lay_ds_dp',
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
                                    alert("Lỗi khi tải danh sách địa phương! Mô tả: "+data.msg);
                                }else{
                                    $('#dsdp').html(data.dshuyen);
                                    OpenForm();
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
                    }
                    else{
                        var formData = new FormData();
                        formData.append('_token', CSRF_TOKEN);
                        formData.append('laydssp', 'laydshuyen');
                        $.ajax({
                            type: 'POST',
                            dataType: "JSON",
                            url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/lay_ds_dp',
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
                                    alert("Lỗi khi tải danh sách địa phương! Mô tả: "+data.msg);
                                }else{
                                    $('#dsdp').html(data.dshuyen);
                                    OpenForm();
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
                    }
                }
                else{
                    $('#dsdparea').addClass('hidden');
                    OpenForm();
                }
            }

            
        });
        //end mở form để thêm

        //xóa
        $('#tbl_dp').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin của địa phương "+name+"?");
            if(cf==true){
                if($('#btnsuaarea').css('display') == 'block' && id == $('#btncapnhat').attr('data-id')){//đóng form sửa khi click xóa
                   $('#btndong').click();
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                if($('#ds_f').val() == 'huyen'){
                    formData.append('huyen', 'huyen');
                }
                else if($('#ds_f').val() == 'xa'){
                    formData.append('xa', 'xa');
                }
                else{
                    formData.append('tinh', 'tinh');
                }
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" địa phương được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" địa phương được tìm thấy!");
                                    }
                                }
                            }
                            if($('#tbl_dp').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            alert("Xóa thông tin địa phương thành công!");
                        }
                        else{
                            alert("Xóa thông tin địa phương thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin địa phương thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin địa phương thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin địa phương thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa 

        //mở form để sửa
        $('#tbl_dp').on('click','button[data-button="sua"]',function(){
            $('#btnthemarea').fadeOut(800);
            $('#btnlamlaiarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN ĐỊA PHƯƠNG');
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            if($('#ds_f').val() == 'huyen'){
                if($('#tinh_f').val() != 'all'){
                    formData.append('huyen', 'huyen');
                }
                else{
                    formData.append('huyen', 'huyen');
                    formData.append('flag', 'flag');
                }
            }
            else if($('#ds_f').val() == 'xa'){
                if($('#huyen_f').val() != 'all'){
                    formData.append('xa', 'xa');
                }
                else{
                    formData.append('xa', 'xa');
                    formData.append('flag', 'flag');
                }
            }
            else{
                formData.append('tinh', 'tinh');
            }
            
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/lay_tt_cap_nhat',
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
                        
                        $('#madp').val(data.id);$('#tendp').val(data.tendp);
                        
                        if($('#ds_f').val() == 'huyen'){
                            if($('#tinh_f').val() != 'all'){
                                $('#dsdparea').addClass('hidden');
                            }
                            else{
                                $('#dsdp').html(data.dstinh);
                                $('#dsdp').val(data.idtinh);
                                $('#dsdparea').removeClass('hidden');
                            }
                        }
                        else if($('#ds_f').val() == 'xa'){
                            if($('#huyen_f').val() != 'all'){
                                $('#dsdparea').addClass('hidden');
                            }
                            else{
                                $('#dsdp').html(data.dshuyen);
                                $('#dsdp').val(data.idhuyen);
                                $('#dsdparea').removeClass('hidden');
                            }
                        }
                        else{
                            $('#dsdparea').addClass('hidden');
                        }
                        
                        $('#formdp').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formdp").offset().top
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
            formData.append('_token', CSRF_TOKEN);
            if($('#ds_f').val() == 'huyen'){
                if($('#tinh_f').val() == 'all'){
                    formData.append('laydssp', 'all-huyen');
                }
                else{
                    formData.append('laydssp', 'sp-tinh');
                    formData.append('tinh', $('#tinh_f').val());
                }
            }
            else if($('#ds_f').val() == 'xa'){
                if($('#huyen_f').val() == 'all'){
                    if($('#tinh_f').val() == 'all'){
                        formData.append('laydssp', 'all-xa');
                    }
                    else{
                        formData.append('laydssp', 'sp-xa');
                        formData.append('tinh', $('#tinh_f').val());
                    }
                }
                else{
                    formData.append('laydssp', 'sp-huyen');
                    formData.append('huyen', $('#huyen_f').val());
                }
            }
            else{
                formData.append('laydssp', 'all-tinh');
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/tim_kiem',
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
                            var ttdp='';
                            for(var i=0; i<data.dp.length; ++i){
                                ttdp+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.dp[i].id+'</td>\n\
                                    <td>'+data.dp[i].tendp+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dp[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }

                            $('#tbl_dp').html(ttdp);

                            $('button[data-button]').tooltip({
                                trigger: 'manual'
                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);

                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" địa phương được tìm thấy!");
                        }
                        else{
                            $('#tbl_dp').html("");
                            $('#kqtimliem').text("Không có địa phương nào được tìm thấy!");tk=false;
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
            if($('#ds_f').val() == 'huyen'){
                if($('#tinh_f').val() == 'all'){
                    formData.append('laydssp', 'all-huyen');
                }
                else{
                    formData.append('laydssp', 'sp-tinh');
                    formData.append('tinh', $('#tinh_f').val());
                }
            }
            else if($('#ds_f').val() == 'xa'){
                if($('#huyen_f').val() == 'all'){
                    if($('#tinh_f').val() == 'all'){
                        formData.append('laydssp', 'all-xa');
                    }
                    else{
                        formData.append('laydssp', 'sp-xa');
                        formData.append('tinh', $('#tinh_f').val());
                    }
                }
                else{
                    formData.append('laydssp', 'sp-huyen');
                    formData.append('huyen', $('#huyen_f').val());
                }
            }
            else{
                formData.append('laydssp', 'all-tinh');
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/lay_ds_dp',
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
                        alert("Lỗi khi tải danh sách địa phương! Mô tả: "+data.msg);
                    }else{
                        var ttdp='';
                        for(var i=0; i<data.dp.length; ++i){
                            ttdp+='\n\
                            <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.dp[i].id+'</td>\n\
                                <td>'+data.dp[i].tendp+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dp[i].id+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dp[i].id+'" data-name="'+data.dp[i].tendp+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_dp').html(ttdp);
                        $('#tbl_dp button[data-id]').tooltip({
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
            $('#madp').val(''); $('#tendp').val('');
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
        $('#tbl_dp').on('change', 'input[data-input="check"]', function(){
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
                alert("Bạn chưa chọn địa phương để xóa!");
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của các địa phương "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của địa phương "+name+"?");
                }
                if(cf==true){
                    for (var i = 0; i < arr.length; i++) {
                        if($('#btnsuaarea').css('display') == 'block' && arr[i] == $('#btncapnhat').attr('data-id')){//đóng form sửa khi click xóa
                           $('#btndong').click();
                           break;
                        }
                    }
                    
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    if($('#ds_f').val() == 'huyen'){
                        formData.append('huyen', 'huyen');
                    }
                    else if($('#ds_f').val() == 'xa'){
                        formData.append('xa', 'xa');
                    }
                    else{
                        formData.append('tinh', 'tinh');
                    }
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/hanh_chinh/quan_ly_thong_tin_dia_phuong/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" địa phương được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" địa phương được tìm thấy!");
                                            }
                                        }
                                    }
                                    if($('#tbl_dp').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các địa phương thành công!");
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" địa phương được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" địa phương được tìm thấy!");
                                        }
                                    }
                                    if($('#tbl_dp').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin địa phương thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các địa phương thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin địa phương thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các địa phương thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các địa phương thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các địa phương thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin địa phương thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin địa phương thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin địa phương thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }

            }
        });
        //end
        
    });
    </script>
@endsection