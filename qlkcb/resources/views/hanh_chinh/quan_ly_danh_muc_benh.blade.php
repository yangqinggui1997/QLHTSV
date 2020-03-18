@extends('hanh_chinh.layout')

@section('title')
    {{ "Thông tin bệnh" }}
@endsection

@section('css')
<link href="public/css/tempusdominus-bootstrap-4.css" rel="stylesheet" media="all">
<style type="text/css">
    textarea {
       resize: none;
    }
</style>
@endsection

@section('content')
    <div class="main-content"><input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
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
                <!-- THÊM MỚI THÔNG TIN BỆNH-->
                <section class="p-t-20 hidden" id="formb" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="formtitle">THÊM THÔNG TIN BỆNH MỚI</h3>
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
                                                                <label class=" form-control-label">Mã bệnh (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="VD: H10.1" class="form-control" id="mabenh"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tên bệnh (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập tên bệnh..." class="form-control" id="tenbenh"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Ngày phát hiện</label>
                                                                <div class="input-group date" id="dtpngayph" data-target-input="nearest">
                                                                    <input type="text" onkeydown="return false" id="ngayph" class="form-control datetimepicker-input" data-target="#dtpngayph" />
                                                                    <div class="input-group-append" data-target="#dtpngayph" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chủng vi sinh gây bệnh (<span class="color-red">*</span>)</label>
                                                                <textarea rows="1" placeholder="Nhập tên chủng vi sinh gây bệnh..." class="form-control" id="chungvsgb"></textarea>   
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Triệu chứng lâm sàng (<span class="color-red">*</span>)</label>
                                                                <textarea rows="1" placeholder="Nhập tên chủng vi sinh gây bệnh..." class="form-control" id="trieuchung"></textarea>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chủng vi sinh kháng bệnh (<span class="color-red">*</span>)</label>
                                                                <textarea rows="1" placeholder="Nhập tên chủng vi sinh kháng bệnh..." class="form-control" id="chungvskb"></textarea>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Bệnh thuộc chuyên khoa</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <select class="form-control" id="dskhoa">
                                                                            @if(isset($dskhoa))
                                                                            @foreach($dskhoa as $khoa)
                                                                                <option value="{{$khoa->IdKhoa}}">{{$khoa->TenKhoa}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                        
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class=" form-control-label"></label>
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Thêm chuyên khoa" id="btnthemck">
                                                <i class="fa fa-plus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-4">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Các chuyên khoa đã chọn (<span class="color-red">*</span>)</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <select class="form-control" id="dskhoac">
                                                                            
                                                                        </select>
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class=" form-control-label"></label>
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px"  data-toggle="tooltip" title="Xóa chuyên khoa" id="btnxoack">
                                                <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>    
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
                <!-- END THÊM MỚI THÔNG TIN BỆNH-->

                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH BỆNH</h3>
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
                                        <button class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="fa fa-hospital-o"></i></button>
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
                                                <th style="position: sticky; top: 0; z-index: 99;">Tên bệnh</th>
                                                <th>ngày phát hiện</th>
                                                <th>chủng vi sinh gây bệnh</th>
                                                <th>triệu chứng lâm sàng</th>
                                                <th>chủng vi sinh kháng bệnh</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_benh">
                                            @if(isset($dsbenh))
                                            @foreach($dsbenh as $benh)
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $benh->IdBenh }}" data-name="{{ $benh->TenBenh }}">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td class="text-left">{{$benh->TenBenh}}</td>
                                                <td>{{date('d/m/Y', strtotime($benh->NgayPH))}}</td>
                                                <td>{{$benh->ChungVSGayBenh}}</td>
                                                <td>{{$benh->TrieuChungLS}}</td>
                                                <td>{{$benh->ChungKhang}}</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{ $benh->IdBenh }}">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{ $benh->IdBenh }}" data-name="{{ $benh->TenBenh}}">
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
<script src="public/js/moment.js"></script>
<script src="public/js/tempusdominus-bootstrap-4.js"></script>
<script src="public/js/pusher.js"></script>
<script>

    $(function () {
        //khởi tạo flag tìm kiếm
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false;
        //end

        if ($("#dtpngayph").length) {
            $('#dtpngayph').datetimepicker({
                icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                format: 'DD/MM/YYYY'
            });
        }
        
        $('#ngayph').on('input', function (){
           $('#dtpngayph').datetimepicker('minDate', '01/01/1900 00:00');
           $('#dtpngayph').datetimepicker('maxDate', new Date());
        });

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

        var channel = pusher.subscribe('Benh');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var ttb='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.benh.id+'" data-name="'+data.benh.tenbenh+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td class="text-left">'+data.benh.tenbenh+'</td>\n\
                        <td>'+data.benh.ngayph+'</td>\n\
                        <td>'+data.benh.chungvsgb+'</td>\n\
                        <td>'+data.benh.trieuchung+'</td>\n\
                        <td>'+data.benh.chungvskb+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.benh.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.benh.id+'" data-name="'+data.benh.tenbenh+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    ttb+='<tr class="spacer"></tr>';
                    $('#tbl_benh').prepend(ttb);
                }
                else{

                    $('#tbl_benh tr').has('td div button[data-id="'+data.benh.macu+'"]').replaceWith(ttb);
                }

                $('button[data-id="'+data.benh.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isArray(data.benh)){
                    for (var i = 0; i < data.benh.length; i++) {
                        $('#tbl_benh tr').has('td div button[data-id="'+data.benh[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_benh tr').has('td div button[data-id="'+data.benh[i]+'"]').remove();

                    }
                }
                else{
                    $('#tbl_benh tr').has('td div button[data-id="'+data.benh+'"]').next('tr.spacer').remove();
                    $('#tbl_benh tr').has('td div button[data-id="'+data.benh+'"]').remove();

                }
            }
        }

        channel.bind('App\\Events\\HanhChinh\\Benh', laytt);
        //end xử lý channel
        
        $('#btnthemck').click(function (){
            var flag=false;
            $('#dskhoac option').each(function(){
                if($(this).attr('value') == $('#dskhoa').val()){
                    flag=true;
                    return false;
                }
            });
            
            if(flag==false)
            {
                $('#dskhoac').prepend('<option value="'+$('#dskhoa').val()+'">'+$('#dskhoa option[value="'+$('#dskhoa').val()+'"]').text()+'</option>');
            }
            
        });
        
        $('#btnxoack').click(function(){
            $('#dskhoac option[value="'+$('#dskhoac').val()+'"]').remove();
        });
        
        //Submit thêm mới
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
               
            var mabenh=$('#mabenh').val(), tenbenh=$('#tenbenh').val(), ngayph=$('#ngayph').val(), chungvcgb=$('#chungvsgb').val(), chungvskb=$('#chungvskb').val(), trieuchung=$('#trieuchung').val();

            if(mabenh.toString().trim() == ''){
                alert("Vui lòng nhập thông tin mã bệnh!");
                return false;
            }
            if(tenbenh.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên gọi của bệnh!");
                return false;
            }
            else if(chungvcgb.toString().trim() == ''){
                alert("Vui lòng nhập tên những chủng vi sinh gây bệnh!");
                return false;
            }
            else if(chungvskb.toString().trim() == ''){
                alert("Vui lòng nhập tên những chủng vi sinh kháng bệnh!");
                return false;
            }
            else if(trieuchung.toString().trim() == ''){
                alert("Vui lòng nhập triệu chứng lâm sàng của bệnh!");
                return false;
            }
            
            var khoa=[];
            $('#dskhoac option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        khoa.push(this.value);
                    }
                });
            });
            
            if(khoa.length == 0){
                alert('Vui lòng thêm chuyên khoa của bệnh!');
                return false;
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('mabenh', mabenh.toString().trim());
            formData.append('tenbenh', tenbenh.toString().trim());
            formData.append('khoa', khoa);
            formData.append('chungvskb', chungvskb);
            formData.append('ngayph', ngayph);
            formData.append('chungvsgb', chungvcgb);
            formData.append('trieuchung', trieuchung);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_danh_muc_benh/them_moi',
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
                        alert("Thêm thông tin bệnh mới thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);

                        $('#kqtimliem').text("");
                        tk=false;locds=false;keySearch='';
                    }
                    else if(data.msg == 'trungten'){
                        alert("Tên bệnh này đã được sử dụng!");
                    }
                    else if(data.msg == 'trungma'){
                        alert("Mã bệnh này đã được sử dụng!");
                    }
                    else{
                        alert("Thêm thông tin bệnh mới thất bại! Lỗi: "+data.msg);
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
            
            var mabenh=$('#mabenh').val(), tenbenh=$('#tenbenh').val(), ngayph=$('#ngayph').val(), chungvcgb=$('#chungvsgb').val(), chungvskb=$('#chungvskb').val(), trieuchung=$('#trieuchung').val();

            if(mabenh.toString().trim() == ''){
                alert("Vui lòng nhập thông tin mã bệnh!");
                return false;
            }
            if(tenbenh.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên gọi của bệnh!");
                return false;
            }
            else if(chungvcgb.toString().trim() == ''){
                alert("Vui lòng nhập tên những chủng vi sinh gây bệnh!");
                return false;
            }
            else if(chungvskb.toString().trim() == ''){
                alert("Vui lòng nhập tên những chủng vi sinh kháng bệnh!");
                return false;
            }
            else if(trieuchung.toString().trim() == ''){
                alert("Vui lòng nhập triệu chứng lâm sàng của bệnh!");
                return false;
            }
            
            var khoa=[];
            $('#dskhoac option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        khoa.push(this.value);
                    }
                });
            });
            
            if(khoa.length == 0){
                alert('Vui lòng thêm chuyên khoa của bệnh!');
                return false;
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('mabenh', mabenh.toString().trim());
            formData.append('tenbenh', tenbenh.toString().trim());
            formData.append('khoa', khoa);
            formData.append('chungvskb', chungvskb);
            formData.append('ngayph', ngayph);
            formData.append('chungvsgb', chungvcgb);
            formData.append('trieuchung', trieuchung);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_danh_muc_benh/cap_nhat',
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
                        alert("Cập nhật thông tin bệnh thành công!");
                    }
                    else if(data.msg == 'trungten'){
                        alert("Tên bệnh này đã được sử dụng!");
                    }
                    else if(data.msg == 'trungma'){
                        alert("Mã bệnh này đã được sử dụng!");
                    }
                    else{
                        alert("Cập nhật thông tin bệnh thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin bệnh thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin bệnh thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin bệnh thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật

        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formb').slideUp(800);
        });
        //end đóng form nhập liệu
        
        //mở form để thêm
        $('#btnadd').click(function(){
            $('#btnthemarea').fadeIn(800);
            $('#btnlamlaiarea').fadeIn(800);
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('THÊM THÔNG TIN BỆNH MỚI');
            $('#btnlamlai').click();
            $('#formb').slideDown(800);
            $('html, body').animate({
                scrollTop: $("#formb").offset().top
            }, 800);
        });
        //end mở form để thêm

        //xóa
        $('#tbl_benh').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin của bệnh "+name+"?");
            if(cf==true){
                if($('#btnsuaarea').css('display') == 'block' && id == $('#btncapnhat').attr('data-id')){//đóng form sửa khi click xóa
                   $('#btndong').click();
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/hanh_chinh/quan_ly_danh_muc_benh/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" bệnh được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" bệnh được tìm thấy!");
                                    }
                                }
                            }
                            if($('#tbl_benh').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            alert("Xóa thông tin bệnh thành công!");
                        }
                        else{
                            alert("Xóa thông tin bệnh thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin bệnh thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin bệnh thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin bệnh thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa 

        //mở form để sửa
        $('#tbl_benh').on('click','button[data-button="sua"]',function(){
            $('#btnthemarea').fadeOut(800);
            $('#btnlamlaiarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN BỆNH');

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_danh_muc_benh/lay_tt_cap_nhat',
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
                        
                        $('#mabenh').val(data.id);$('#tenbenh').val(data.tenbenh); $('#ngayph').val(data.ngayph); $('#chungvsgb').val(data.chungvsgb); $('#chungvskb').val(data.chungvskb); $('#trieuchung').val(data.trieuchung);

                        if($.isPlainObject(data.khoa[0])){
                            $('#dskhoac').html('');
                            //convert object to array
                            var t = data.khoa;
                            var keys = Object.keys(t);
                            var values = keys.map(function(key) {
                              return t[key];
                            });
                            for (var i = 0; i < values.length; i++) {
                                $('#dskhoac').prepend('<option value="'+values[i]['id']+'">'+values[i]['name']+'</option>');
                            }
                            
                        }
                        
                        $('#formb').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formb").offset().top
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

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_danh_muc_benh/tim_kiem',
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
                            var ttb='';
                            for(var i=0; i<data.benh.length; ++i){
                                ttb+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.benh[i].id+'" data-name="'+data.benh[i].tenbenh+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td class="text-left">'+data.benh[i].tenbenh+'</td>\n\
                                    <td>'+data.benh[i].ngayph+'</td>\n\
                                    <td>'+data.benh[i].chungvsgb+'</td>\n\
                                    <td>'+data.benh[i].trieuchung+'</td>\n\
                                    <td>'+data.benh[i].chungvskb+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.benh[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.benh[i].id+'" data-name="'+data.benh[i].tenbenh+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                            $('#tbl_benh').html(ttb);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'
                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);

                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" bệnh được tìm thấy!");
                        }
                        else{
                            $('#tbl_benh').html("");
                            $('#kqtimliem').text("Không có bệnh nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/hanh_chinh/quan_ly_danh_muc_benh/lay_ds_benh',
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
                        alert("Lỗi khi tải danh sách bệnh! Mô tả: "+data.msg);
                    }else{
                        var ttb='';
                        for(var i=0; i<data.benh.length; ++i){
                            ttb+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.benh[i].id+'" data-name="'+data.benh[i].tenbenh+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td class="text-left">'+data.benh[i].tenbenh+'</td>\n\
                                    <td>'+data.benh[i].ngayph+'</td>\n\
                                    <td>'+data.benh[i].chungvsgb+'</td>\n\
                                    <td>'+data.benh[i].trieuchung+'</td>\n\
                                    <td>'+data.benh[i].chungvskb+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.benh[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.benh[i].id+'" data-name="'+data.benh[i].tenbenh+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                        }

                        $('#tbl_benh').html(ttb);
                        $('#tbl_benh button[data-id]').tooltip({
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
            $('#mabenh').val(''); $('#tenbenh').val(''); $('#ngayph').val(''); $('#chungvsgb').val(''); $('#chungvskb').val(''); $('#trieuchung').val('');
            $('#dskhoac').html('');
            var d=new Date();
            var s = (d.getDate() < 10 ? '0'+d.getDate() : d.getDate())+"/"+((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1))+"/"+d.getFullYear()+" ";
            $('#ngayph').val(s);
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
        $('#tbl_benh').on('change', 'input[data-input="check"]', function(){
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
                alert("Bạn chưa chọn bệnh để xóa!");
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của các bệnh "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của bệnh "+name+"?");
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
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/hanh_chinh/quan_ly_danh_muc_benh/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" bệnh được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" bệnh được tìm thấy!");
                                            }
                                        }
                                    }
                                    if($('#tbl_benh').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các bệnh thành công!");
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" bệnh được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" bệnh được tìm thấy!");
                                        }
                                    }
                                    if($('#tbl_benh').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin bệnh thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các bệnh thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin bệnh thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các bệnh thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các bệnh thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các bệnh thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }

                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin bệnh thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin bệnh thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin bệnh thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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