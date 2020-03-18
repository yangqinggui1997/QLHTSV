@extends('hanh_chinh.layout')

@section('title')
    {{ "Kê khai tiền lương" }}
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
                <!--DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <?php  ?> 
                                    <h3 class="title-5 font-weight-bold text-green">KÊ KHAI TIỀN LƯƠNG</h3>
                                    <hr class="line-seprate">
                                </div>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" id="filtertime">
                                                <option value="1">Theo ngày</option>
                                                <option value="0">Tùy ý thời gian</option>
                                                <option value="2">Theo tháng</option>
                                                <option value="3">Theo quý</option>
                                                <option value="4">Theo năm</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md hidden" id="quyarea">
                                            <input type="number" class="form-control" id="quy" min="1" max="4">
                                        </div>
                                        <div class="rs-select2--light rs-select2--md" id="khongtuyy">
                                            <div class="input-group date" id="datetimepickerfilter" data-target-input="nearest">
                                                <input type="text" onkeydown="return false" class="form-control datetimepicker-input" data-target="#datetimepickerfilter" id="thoigankty" />
                                                <div class="input-group-append" data-target="#datetimepickerfilter" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="rs-select2--light rs-select2--md m-b-15 hidden" id="loctungay">
                                            <div class="input-group date" id="datetimepickerfilter1" data-target-input="nearest">
                                                <input type="text" onkeydown="return false" class="form-control datetimepicker-input" data-target="#datetimepickerfilter1" id="thoigiantungay" data-toggle="tooltip" data-placement="bottom" title="Từ ngày"/>
                                                <div class="input-group-append" data-target="#datetimepickerfilter1" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md hidden" id="locdenngay">
                                            <div class="input-group date" id="datetimepickerfilter2" data-target-input="nearest">
                                                <input type="text" onkeydown="return false" class="form-control datetimepicker-input" data-target="#datetimepickerfilter2" id="thoigiandenngay" data-toggle="tooltip" data-placement="bottom" title="Đến ngày"/>
                                                <div class="input-group-append" data-target="#datetimepickerfilter2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($nd->Quyen != 'admin' && $flag == FALSE)
                                        <div class="rs-select2--light width-180px">
                                            <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Tạo bảng kê khai lương" id="btnlocds">
                                            <i class="fa fa-filter"></i></button> 
                                        </div>
                                        <div class="rs-select2--light width-180px">
                                            <button type="button" class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Làm lại" id="btnlamlai">
                                            <i class="fa fa-refresh"></i></button>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button type="button" class="au-btn au-btn--green au-btn--small au-btn-shadow height-40px hidden" rel="tooltip" title="In bảng kê khai này" data-toggle ="modal" data-target="#mdprint" id="btnin"><i class="zmdi zmdi-print"></i></button>
                                       
                                    </div>
                                </div>
                                <div class="table-data__tool hidden" id="tqarea">
                                    <div class="card" style="font-family: 'Noto Serif'; font-size: 10pt; font-weight: normal;">
                                        <div class="card-body card-block" id="tqarea">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label" style="font-weight: 600">Tổng chi tiền lương</label>
                                                        <input type="text" readonly="" class="form-control" id="tongso">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label" style="font-weight: 600">Tổng trừ BHXH</label>
                                                        <input type="text" readonly="" class="form-control" id="tongbhxh">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label" style="font-weight: 600">Tổng chi thưởng</label>
                                                        <input type="text" readonly="" class="form-control" id="tongthuong">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label" style="font-weight: 600">Tổng tiền phạt</label>
                                                        <input type="text" readonly="" class="form-control" id="tongphat">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label" style="font-weight: 600">Tổng PCCV</label>
                                                        <input type="text" readonly="" class="form-control" id="tongpc">
                                                    </div>
                                                </div>
                                            </div>
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
                                                <th>Nhân viên</th>
                                                <th>Loại nhân viên</th>
                                                <th>Công việc</th>
                                                <th>Chức vụ</th>
                                                <th>Số ngày công</th>
                                                <th>HSL</th>
                                                <th>Lương cơ bản</th>
                                                <th>Phụ cấp chức vụ</th>
                                                <th>Tiền thưởng</th>
                                                <th>Tiền phạt</th>
                                                <th>10.5% trích đóng BHXH</th>
                                                <th>Thực lĩnh</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_tk">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--END DATA TABLE-->
                 
                <!--MODAL PRINT-->
                <div class="modal fade" id="mdprint" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lgest" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Xem bản in thống kê</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card fit_table_height_400 print_content" style="font-family: 'Noto Serif'; font-size: 10pt; font-weight: normal;">

                                </div>
                                <div class="row hidden" id="dtbiarea">
                                    <div class="col-lg-12">
                                        <label style="font-weight: normal" id="dtbi">Đang tạo bản in!</label>
                                    </div>
                                </div>
                                <div class='row hidden' id="proccess">
                                    <div class='col-lg-12'>
                                        
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                <span>Vui lòng chờ<span class="dotdotdot" id="dot"></span></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class="col-lg-12 text-center" id="btniarea">
                                        <button type="button" class="au-btn au-btn--darkgreen au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="In thống kê" id="btnprint"><span class="fa fa-download"></span></button>
                                    </div>
                                    <div class="col-lg-1 hidden" id="bntfilearea">
                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Gửi file báo cáo cho lãnh đạo" id="btnguifile"><span class="fa fa-upload"></span></button>
                                    </div>
                                    <div class="col-lg-3 text-left hidden" id="cdarea">
                                        <textarea rows="1" class="form-control" id="cd" placeholder="Nhập chủ đề file..."></textarea>
                                    </div>
                                    <div class="col-lg-3 text-left hidden" id="filearea">
                                        <input multiple="" type="file" class="form-control" id="filebc">
                                    </div>
                                    <div class="col-lg-2">
                                        
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
<script src="public/js/moment.js"></script>
<script src="public/js/tempusdominus-bootstrap-4.js"></script>
<script src="public/js/jspdf.debug.js"></script>
<script src="public/js/html2canvas.js"></script>
<script src="public/js/pusher.js"></script>
<script type="text/javascript">
    $(function () {

        var tgt='', tgty='', quy='', tgbd='', tgkt='', tinh='', huyen='', xa='', title='', tgtaotk='', flagbenh=false;
        var tstrang=1;//tong so trang in
        var file_name_print='';
        var q='';
        var dd=new Date();
        if($('#datetimepickerfilter').length){
            $('#datetimepickerfilter').datetimepicker({
                icons: {
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                defaultDate:dd,
                format: "DD/MM/YYYY"
            });

        }

        if($('#datetimepickerfilter1').length){
            $('#datetimepickerfilter1').datetimepicker({
                icons: {
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                defaultDate:dd,
                format: "DD/MM/YYYY"
            });

        }

        if($('#datetimepickerfilter2').length){
            $('#datetimepickerfilter2').datetimepicker({
                icons: {
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                defaultDate:dd,
                format: "DD/MM/YYYY"
            });

        }
        
        $('#thoigankty').on('input', function (){
           $('#datetimepickerfilter').datetimepicker('maxDate', new Date()); 
        });
        
        $('#thoigiantungay').on('input', function (){
           $('#datetimepickerfilter1').datetimepicker('minDate', '01/01/1900 00:00'); 
           $('#datetimepickerfilter1').datetimepicker('maxDate', new Date()); 
        });
        
        $('#thoigiandenngay').on('input', function (){
           $('#datetimepickerfilter2').datetimepicker('minDate', '01/01/1900 00:00'); 
           $('#datetimepickerfilter2').datetimepicker('maxDate', new Date()); 
           
        });
        
        var element_section,HTML_Width,HTML_Height,top_left_margin,PDF_Width,PDF_Height;
    
        function calculatePDF_height_width(selector,index){
            element_section = $(selector).eq(index);
            HTML_Width = element_section.width();
            HTML_Height= element_section.height();
            top_left_margin = 25;
            PDF_Width = HTML_Width + (top_left_margin * 2);
            PDF_Height = (PDF_Width * 1.2) + (top_left_margin * 2);
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
        
        var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

        $('#btnguifile').click(function(){
            var file=$('#filebc').val(), cd=$('#cd').val();
            if(file == ''){
                alert('Vui lòng chọn file báo cáo!');
                return false;
            }
            else if(cd.toString().trim() == ''){
                alert('Vui lòng ghi rõ chủ đề báo cáo!');
                return false;
            }

            $('#dtbiarea').removeClass('hidden');$('#dtbi').text('Đang xử lý!');
            $('#proccess').removeClass('hidden');
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('cd', cd);
            formData.append('pl', 'thong_ke');
            if ($('#filebc')[0].files.length > 0) {
                for (var i = 0; i < $('#filebc')[0].files.length; i++){
                    formData.append('file[]', $('#filebc')[0].files[i]);
                } 
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/up_file',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    if(data.msg == 'tc'){
                        $('#dtbi').text('Đã xử lý xong!');
                        $('#proccess').addClass('hidden');
                    }
                    else if(data.msg == 'ko_ho_tro_kieu_file'){
                        alert("Không hỗ trợ kiểu file upload! Kiểu hỗ trợ là file .pdf hoặc .docx");
                        $('#proccess').addClass('hidden');
                        $('#dtbiarea').addClass('hidden');
                    }
                    else{
                        alert("Up file thất bại! Lỗi: "+data.msg);
                        $('#proccess').addClass('hidden');
                        $('#dtbiarea').addClass('hidden');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#proccess').addClass('hidden');
                    $('#dtbiarea').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Up file thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Up file thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Up file thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });

        //tạo tk
        $('#btnlocds').click(function (){
            
            var d=new Date();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
            var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
            var giay=((d.getSeconds()<10) ? '0' : '') + d.getSeconds();
            
            var apm='AM';
            if(gio > 12){
                gio=gio-12;
                apm='PM';
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if($('#filtertime').val() == 0)
            {
                tgt='tuyytg'; tgbd=$('#thoigiantungay').val(); tgkt=$('#thoigiandenngay').val();
                formData.append('tgt', tgt);
                formData.append('tgbd', tgbd);
                formData.append('tgkt', tgkt);
                file_name_print='KE_KHAI_LUONG_TUY_Y_TG_'+d.getDate()+'_'+thang+'_'+d.getFullYear()+'_'+gio+'_'+phut+'_'+giay+'_'+apm;
            }
            else if($('#filtertime').val() == 1)
            {
                tgt='ngay'; tgty=$('#thoigankty').val();
                formData.append('tgt', 'ngay');
                file_name_print='KE_KHAI_LUONG_NGAY_'+'_'+d.getDate()+'_'+thang+'_'+d.getFullYear()+'_'+gio+'_'+phut+'_'+giay+'_'+apm;
            }
            else if($('#filtertime').val() == 2)
            {
                tgt='thang'; tgty=$('#thoigankty').val();
                formData.append('tgt', 'thang');
                file_name_print='KE_KHAI_LUONG_THANG_'+d.getDate()+'_'+thang+'_'+d.getFullYear()+'_'+gio+'_'+phut+'_'+giay+'_'+apm;
            }
            else if($('#filtertime').val() == 3)
            {
                if($('#quy').val().toString().trim() == ''){
                    alert('Vui lòng nhập quý mà bạn muốn kê khai lương!');
                    return false;
                }
                tgt='quy'; tgty=$('#thoigankty').val();quy=$('#quy').val();
                formData.append('tgt', 'quy');
                formData.append('quy', quy);
                if(quy.toString() == '1'){q='I';}else if(quy.toString() == '2'){q='II';}else if(quy.toString() == '3'){q='III';}else if(quy.toString() == '4'){q='IV';}
                file_name_print='KE_KHAI_LUONG_QUY_'+q+d.getDate()+'_'+thang+'_'+d.getFullYear()+'_'+gio+'_'+phut+'_'+giay+'_'+apm;
            }
            else
            {
                tgt='nam'; tgty=$('#thoigankty').val();
                formData.append('tgt', 'nam');
                file_name_print='KE_KHAI_LUONG_NAM_'+d.getDate()+'_'+thang+'_'+d.getFullYear()+'_'+gio+'_'+phut+'_'+giay+'_'+apm;
            }
            formData.append('tgty', tgty);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/ke_khai_tien_luong/them_tk',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    if(data.msg != 'tc')
                    {
                        alert('Không thể tạo bảng kê khai lương! Lỗi: '+data.msg);
                        return false;
                    }
                    // Success
                    
                    $('#tongso').val(data.slt);$('#tongbhxh').val(data.slbh);$('#tongthuong').val(data.slthuong);
                    $('#tongphat').val(data.slphat);$('#tongpc').val(data.slpc);
                    $('#tqarea').slideDown(800);
                    $('#btnin').fadeIn(800);
                    
                    d=new Date();
                    var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
                    var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
                    var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
                    var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
                    var apm='AM';
                    if(gio > 12){
                        gio=gio-12;
                        apm='PM';
                    }
                    title='BẢNG KÊ KHAI LƯƠNG';
                    tgtaotk='TỪ '+tgbd+' ĐẾN '+tgkt;
                    var ngaytk='NGÀY TẠO: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+':'+giay+' '+apm;
                    if(tgt == 'ngay')
                    {
                        tgtaotk='NGÀY '+tgty;
                    }
                    else if(tgt == 'thang')
                    {
                        tgtaotk='THÁNG '+tgty;
                    }
                    else if(tgt == 'quy')
                    {
                        tgtaotk='Quý '+q+' năm '+tgty;
                    }
                    else if(tgt == 'nam') 
                    {
                        tgtaotk='NĂM '+tgty;
                    }
                    var content='\n\
                    <div class="card-body card-block printcontent" style="min-height: 1300px; max-height: 1300px;">\n\
                        <div class="row" style="font-weight: bold; margin-bottom: 15px;">\n\
                            <div class="col-lg-4 text-left">\n\
                                <div class="row">\n\
                                    <div class="col-lg-4 text-center" style="margin: 0; padding: 0;">\n\
                                        <label><img src="public/images/logo3.png" style="height: 50px;"></label>\n\
                                    </div>\n\
                                    <div class="col-lg-8" style="margin: 0; font-size: 9pt; padding: 0">\n\
                                        <label style="margin: 0; margin-top: 5px;">SỞ Y TẾ TỈNH AN GIANG</label><br>\n\
                                        <label style="margin: 0;">BỆNH VIỆN ĐKTT AN GIANG</label>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="row text-left" style="margin-bottom: 15px;">\n\
                                    <div class="col-lg-12" style="margin: 0; font-size: 8pt;">\n\
                                        <label style="margin: 0;">Địa chỉ: 60 Ung Văn Khiêm - P.Mỹ Phước - </label><br><label style="margin: 0;">Tp.Long Xuyên - An Giang</label><br>\n\
                                        <label style="margin: 0">Đường dây nóng: (0296).3852989 – 3852862</label><br>\n\
                                        <label style="margin: 0">Fax: 84 296 3854283</label>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                            <div class="col-lg-8 text-center">\n\
                                <label style="margin: 0">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</label>\n\
                                <br>\n\
                                <label style="margin: 0">Đôc lập - Tự do - Hạnh phúc</label>\n\
                                <br>\n\
                                <label style="margin: 0">------*------</label>\n\
                            </div>\n\
                        </div>\n\
                        <div class="row text-center" style="font-weight: bold; margin-bottom: 30px;">\n\
                            <div class="col-lg-12">\n\
                                <label style="margin: 0; font-size:13pt">'+title+'</label><br>\n\
                                <label style="margin: 0;">'+tgtaotk+'</label><br>\n\
                                <label style="margin: 0; font-size:8pt">'+ngaytk+'</label>\n\
                            </div>\n\
                        </div>\n\
                        <div class="row">\n\
                            <div class="col-lg-2">\n\
                                <label class="form-control-label">Tổng chi tiền lương:</label>\n\
                            </div>\n\
                            <div class="col-lg-2">\n\
                                <label style="font-weight: 600">'+data.slt+'</label>\n\
                            </div>\n\
                            <div class="col-lg-2">\n\
                                <label class="form-control-label">Tổng trừ BHXH:</label>\n\
                            </div>\n\
                            <div class="col-lg-2">\n\
                                <label style="font-weight: 600">'+data.slbh+'</label>\n\
                            </div>\n\
                            <div class="col-lg-2">\n\
                                <label class="form-control-label">Tổng chi thưởng:</label>\n\
                            </div>\n\
                            <div class="col-lg-2">\n\
                                <label style="font-weight: 600">'+data.slthuong+'</label>\n\
                            </div>\n\
                            <div class="col-lg-2">\n\
                                <label class="form-control-label">Tổng tiền phạt:</label>\n\
                            </div>\n\
                            <div class="col-lg-2">\n\
                                <label style="font-weight: 600">'+data.slphat+'</label>\n\
                            </div>\n\
                            <div class="col-lg-2">\n\
                                <label class="form-control-label">Tổng PCCV:</label>\n\
                            </div>\n\
                            <div class="col-lg-2">\n\
                                <label style="font-weight: 600">'+data.slpc+'</label>\n\
                            </div>\n\
                        </div>\n\
                        <hr class="line-seprate">\n\
                        <div class="row" style="margin-top: 15px;">\n\
                                <div class="col-lg-12">\n\
                                    <table class="table table-bordered" style="font-size: 9pt;">\n\
                                        <thead style="font-size: 7pt; vertical-align: middle">\n\
                                            <tr>\n\
                                                <th><center>STT</center></th>\n\
                                                <th><center>NHÂN VIÊN</th>\n\
                                                <th><center>CHỨC VỤ</center></th>\n\
                                                <th><center>SỐ NGÀY CÔNG</center></th>\n\
                                                <th><center>HSL</center></th>\n\
                                                <th><center>LƯƠNG CƠ BẢN</center></th>\n\
                                                <th><center>PHỤ CẤP CHỨC VỤ</center></th>\n\
                                                <th><center>TIỀN THƯỞNG</center></th>\n\
                                                <th><center>TIỀN PHẠT</center></th>\n\
                                                <th><center>10.5% TRÍCH ĐÓNG BHXH</center></th>\n\
                                                <th><center>THỰC LĨNH</center></th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody style="font-size: 9pt;">';
                    var newpage_bf='\n\
                    <div class="card-body card-block printcontent" style="min-height: 1300px; max-height: 1300px;">\n\
                        <div class="row" style="margin-top: 15px;">\n\
                                <div class="col-lg-12">\n\
                                    <table class="table table-bordered" style="font-size: 9pt;">\n\
                                        <thead style="font-size: 7pt; vertical-align: middle">\n\
                                            <tr>\n\
                                                <th><center>STT</center></th>\n\
                                                <th><center>NHÂN VIÊN</th>\n\
                                                <th><center>CHỨC VỤ</center></th>\n\
                                                <th><center>SỐ NGÀY CÔNG</center></th>\n\
                                                <th><center>HSL</center></th>\n\
                                                <th><center>LƯƠNG CƠ BẢN</center></th>\n\
                                                <th><center>PHỤ CẤP CHỨC VỤ</center></th>\n\
                                                <th><center>TIỀN THƯỞNG</center></th>\n\
                                                <th><center>TIỀN PHẠT</center></th>\n\
                                                <th><center>10.5% TRÍCH ĐÓNG BHXH</center></th>\n\
                                                <th><center>THỰC LĨNH</center></th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody style="font-size: 9pt;">';
                                            
                    if($.isArray(data.result_print))
                    {
                        var n=1; var trang=1;
                        if(data.result_print.length > 13) //so trang > 1
                        {
                            if((data.result_print.length - 13) % 26 == 0)
                            {
                                tstrang = parseInt(((data.result_print.length - 13)/26) + 1);
                            }
                            else{
                                tstrang = parseInt(((data.result_print.length - 13)/26) + 2);
                            }
                        }
                        for (var i = 0; i < data.result_print.length; i++) {
                            content+=data.result_print[i];
                            if(n < 13)
                            {
                                if(i == data.result_print.length - 1)
                                {
                                    var space_height=128+((13-n)*42)-50;
                                    content+='\n\
                                                        </tbody>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        <div class="row m-t-45 text-center">\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">NGƯỜI LẬP BIỂU</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên)</label><br>\n\
                                                <label style="font-size: 9pt; font-weight: 600;">'+data.tennv.toString().toUpperCase()+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên)</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên, đóng dấu)</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div style="height: '+space_height+'px"></div>\n\
                                        <hr class="line-seprate">\n\
                                        <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                            <div class="col-lg-10">\n\
                                                Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                            </div>\n\
                                            <div class="col-lg-2 text-right">Trang 1/1.</div>\n\
                                        </div>\n\
                                    </div>';
                                }
                            }
                            else if(n==13)
                            {
                                if(i == data.result_print.length - 1)
                                {
                                    content+='\n\
                                                        </tbody>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        <div class="row m-t-45 text-center">\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">NGƯỜI LẬP BIỂU</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên)</label><br>\n\
                                                <label style="font-size: 9pt; font-weight: 600;">'+data.tennv.toString().toUpperCase()+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên)</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên, đóng dấu)</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div style="height: 128px"></div>\n\
                                        <hr class="line-seprate">\n\
                                        <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                            <div class="col-lg-10">\n\
                                                Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                            </div>\n\
                                            <div class="col-lg-2 text-right">Trang 1/1.</div>\n\
                                        </div>\n\
                                    </div>';
                                }
                            }
                            else
                            {
                                if(n < 18)
                                {
                                    if(i == data.result_print.length - 1)
                                    {
                                        var space_height=20+((18-parseInt(data.result_print.length))*42)-50;
                                        var space_height1=1104-50;
                                        content+='\n\
                                                        </tbody>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        <div style="height: '+space_height+'px"></div>\n\
                                        <hr class="line-seprate">\n\
                                        <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                            <div class="col-lg-10">\n\
                                                Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                            </div>\n\
                                            <div class="col-lg-2 text-right">Trang '+trang+'/'+tstrang+'.</div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="card-body card-block printcontent" style="min-height: 1300px; max-height: 1300px;">\n\
                                        <div class="row m-t-15 text-center">\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">NGƯỜI LẬP BIỂU</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên)</label><br>\n\
                                                <label style="font-size: 9pt; font-weight: 600;">'+data.tennv.toString().toUpperCase()+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên)</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên, đóng dấu)</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div style="height: '+space_height1+'px"></div>\n\
                                        <hr class="line-seprate">\n\
                                        <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                            <div class="col-lg-10">\n\
                                                Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                            </div>\n\
                                            <div class="col-lg-2 text-right">Trang '+(trang+1)+'/'+tstrang+'.</div>\n\
                                        </div>\n\
                                    </div>';
                                    }
                                }
                                else if(n == 18)
                                {
                                    if(i == data.result_print.length - 1)
                                    {
                                        var space_height=15;
                                        var space_height1=(22*42)+158-50;
                                        content+='\n\
                                                        </tbody>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        <div style="height: '+space_height+'px"></div>\n\
                                        <hr class="line-seprate">\n\
                                        <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                            <div class="col-lg-10">\n\
                                                Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                            </div>\n\
                                            <div class="col-lg-2 text-right">Trang '+trang+'/'+tstrang+'.</div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="card-body card-block printcontent" style="min-height: 1300px; max-height: 1300px;">\n\
                                        <div class="row m-t-45 text-center">\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">NGƯỜI LẬP BIỂU</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên)</label><br>\n\
                                                <label style="font-size: 9pt; font-weight: 600;">'+data.tennv.toString().toUpperCase()+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên)</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký tên, đóng dấu)</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div style="height: '+space_height1+'px"></div>\n\
                                        <hr class="line-seprate">\n\
                                        <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                            <div class="col-lg-10">\n\
                                                Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                            </div>\n\
                                            <div class="col-lg-2 text-right">Trang '+(trang+1)+'/'+tstrang+'.</div>\n\
                                        </div>\n\
                                    </div>';
                                    }
                                    else{
                                        content+='\n\
                                                        </tbody>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        <div style="height: 15px"></div>\n\
                                        <hr class="line-seprate">\n\
                                        <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                            <div class="col-lg-10">\n\
                                                Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                            </div>\n\
                                            <div class="col-lg-2 text-right">Trang '+trang+'/'+tstrang+'.</div>\n\
                                        </div>\n\
                                    </div>'+newpage_bf;
                                    trang++;                           
                                    }
                                }
                                else{
                                    if((n-40) % 26 == 0) //chia hết cho 22
                                    {
                                        if(i == data.result_print.length - 1)
                                        {
                                            content+='\n\
                                                            </tbody>\n\
                                                        </table>\n\
                                                    </div>\n\
                                                </div>\n\
                                            <div class="row m-t-45 text-center">\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">NGƯỜI LẬP BIỂU</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký tên)</label><br>\n\
                                                    <label style="font-size: 9pt; font-weight: 600;">'+data.tennv.toString().toUpperCase()+'</label>\n\
                                                </div>\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký tên)</label>\n\
                                                </div>\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký tên, đóng dấu)</label>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div style="height: 90px"></div>\n\
                                            <hr class="line-seprate">\n\
                                            <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                                <div class="col-lg-10">\n\
                                                    Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                                </div>\n\
                                                <div class="col-lg-2 text-right">Trang '+trang+'/'+tstrang+'.</div>\n\
                                            </div>\n\
                                        </div>';
                                            
                                        }
                                    }
                                    else if((n-18) % 26 == 0)
                                    {
                                        if(i == data.result_print.length - 1)
                                        {
                                            var space_height=40;
                                            var space_height1=(22*42)+158-50;
                                            content+='\n\
                                                            </tbody>\n\
                                                        </table>\n\
                                                    </div>\n\
                                                </div>\n\
                                            <div style="height: '+space_height+'px"></div>\n\
                                            <hr class="line-seprate">\n\
                                            <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                                <div class="col-lg-10">\n\
                                                    Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                                </div>\n\
                                                <div class="col-lg-2 text-right">Trang '+trang+'/'+tstrang+'.</div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="card-body card-block printcontent" style="min-height: 1300px; max-height: 1300px;">\n\
                                            <div class="row m-t-45 text-center">\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">NGƯỜI LẬP BIỂU</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký tên)</label><br>\n\
                                                    <label style="font-size: 9pt; font-weight: 600;">'+data.tennv.toString().toUpperCase()+'</label>\n\
                                                </div>\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký tên)</label>\n\
                                                </div>\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký tên, đóng dấu)</label>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div style="height: '+space_height1+'px"></div>\n\
                                            <hr class="line-seprate">\n\
                                            <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                                <div class="col-lg-10">\n\
                                                    Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                                </div>\n\
                                                <div class="col-lg-2 text-right">Trang '+(trang+1)+'/'+tstrang+'.</div>\n\
                                            </div>\n\
                                        </div>';
                                        }
                                        else{
                                            var space_height=40;
                                            content+='\n\
                                                                </tbody>\n\
                                                            </table>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                <div style="height: '+space_height+'px"></div>\n\
                                                <hr class="line-seprate">\n\
                                                <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                                    <div class="col-lg-10">\n\
                                                        Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                                    </div>\n\
                                                    <div class="col-lg-2 text-right">Trang '+trang+'/'+tstrang+'.</div>\n\
                                                </div>\n\
                                            </div>'+newpage_bf;
                                            trang++;
                                        }
                                    }
                                    else{
                                        if(i == data.result_print.length - 1)
                                        {
                                            if((n-18) % 26 > 22){
                                                var space_height=38+((26-((n-18) % 26))*42)-50;
                                                var space_height1=(22*42)+158 -50;
                                                content+='\n\
                                                                        </tbody>\n\
                                                                    </table>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        <div style="height: '+space_height+'px"></div>\n\
                                                        <hr class="line-seprate">\n\
                                                        <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                                            <div class="col-lg-10">\n\
                                                                Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                                            </div>\n\
                                                            <div class="col-lg-2 text-right">Trang '+trang+'/'+tstrang+'.</div>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div class="card-body card-block printcontent" style="min-height: 1300px; max-height: 1300px;">\n\
                                                    <div class="row m-t-45 text-center">\n\
                                                        <div class="col-lg-4">\n\
                                                            <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                            <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">NGƯỜI LẬP BIỂU</label><br>\n\
                                                            <label style="margin-bottom: 50px;">(Ký tên)</label><br>\n\
                                                            <label style="font-size: 9pt; font-weight: 600;">'+data.tennv.toString().toUpperCase()+'</label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-4">\n\
                                                            <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                            <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                            <label style="margin-bottom: 50px;">(Ký tên)</label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-4">\n\
                                                            <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                            <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                            <label style="margin-bottom: 50px;">(Ký tên, đóng dấu)</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div style="height: '+space_height1+'px"></div>\n\
                                                    <hr class="line-seprate">\n\
                                                    <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                                        <div class="col-lg-10">\n\
                                                            Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                                        </div>\n\
                                                        <div class="col-lg-2 text-right">Trang '+(trang+1)+'/'+tstrang+'.</div>\n\
                                                    </div>\n\
                                                </div>';
                                            }
                                            else{
                                                var space_height=20+((22-((n-18) % 26))*42) -50;
                                                if(n<40){
                                                    space_height=88+((40-n)*42)-50;
                                                }
                                                
                                                content+='\n\
                                                                </tbody>\n\
                                                            </table>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                <div class="row m-t-45 text-center">\n\
                                                    <div class="col-lg-4">\n\
                                                        <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                        <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">NGƯỜI LẬP BIỂU</label><br>\n\
                                                        <label style="margin-bottom: 50px;">(Ký tên)</label><br>\n\
                                                        <label style="font-size: 9pt; font-weight: 600;">'+data.tennv.toString().toUpperCase()+'</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-4">\n\
                                                        <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                        <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                        <label style="margin-bottom: 50px;">(Ký tên)</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-4">\n\
                                                        <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                        <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                        <label style="margin-bottom: 50px;">(Ký tên, đóng dấu)</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                                <div style="height: '+space_height+'px"></div>\n\
                                                <hr class="line-seprate">\n\
                                                <div class="row" style="font-size: 8pt; font-weight: bold">\n\
                                                    <div class="col-lg-10">\n\
                                                        Ngày in: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+' '+apm+'\n\
                                                    </div>\n\
                                                    <div class="col-lg-2 text-right">Trang '+trang+'/'+tstrang+'.</div>\n\
                                                </div>\n\
                                            </div>';
                                            }
                                            
                                        }
                                    }
                                }
                            }
                            n++;
                        }
                    }
                    else
                    {
                        content='';//
                    }
                    
                    //load data
                    $('#tbl_tk').html(data.result);
                    //prepare infor to print
                    $('div[class*="print_content"]').html(content);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Tạo thống kê thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Tạo thống kê thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Tạo thống kê thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end
        
        $('#btnin').click(function (){
            $('#dtbiarea').addClass('hidden');$('#proccess').addClass('hidden');
            $('#bntfilearea').fadeOut();$('#cdarea').fadeOut();$('#filearea').fadeOut();
            $('#btniarea').removeClass('col-lg-3');
            $('#btniarea').removeClass('text-right');
            $('#btniarea').addClass('col-lg-12 text-center');
        });
        
        //reset input
        $('#btnlamlai').click(function(){
            $('#tongso').val('');$('#quyarea').addClass('hidden');$('#quy').val('');
            $('#tqarea').slideUp(800);       
            $('#filtertime').val(1);$('#filtertime').change();
            $('#tbl_tk').html(''); $('#tbl_tk_print').html('');
            $('#btnin').fadeOut(800);
        });
        //end

        function genPDF(PDF_Width,  PDF_Height, len) { 
            var deferreds = [];
            var trang = 1;
            for (let i = 0; i < len; i++) {
                var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvas(i, trang, deferred, PDF_Width,  PDF_Height);
                trang++;
            }

            $.when.apply($, deferreds).then(function () {
                $('#dtbi').text('Đã tạo xong!');
                $('#proccess').addClass('hidden');
                $('#bntfilearea').fadeIn(800);$('#cdarea').fadeIn(800);$('#filearea').fadeIn(800);
                $('#btniarea').removeClass('col-lg-12');
                $('#btniarea').removeClass('text-center');
                $('#btniarea').addClass('col-lg-3 text-right');
            });
        }

        function generateCanvas(i, trang,  deferred, PDF_Width,  PDF_Height){

            html2canvas($("div[class*='printcontent']:eq("+i+")")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'PNG', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.save(file_name_print+'_TRANG_'+trang+'.pdf');  
                deferred.resolve();
             });
        }

        //in thống kê
        $('#btnprint').click(function(){
            $('#dtbiarea').removeClass('hidden');$('#dtbi').text('Đang tạo bản in!');
            $('#proccess').removeClass('hidden');
            
            calculatePDF_height_width("div[class*='printcontent']",0);
            if(tstrang > 1)
            {
                genPDF(PDF_Width,  PDF_Height, tstrang);
            }
            else
            {
                html2canvas($("div[class*='printcontent']")[0], {
                    useCORS: true, scale: 3}).then(function (canvas) {
                    var imgData = canvas.toDataURL(
                       'image/png');
                    var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                    pdf.addImage(imgData, 'PNG', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                    pdf.save(file_name_print+'.pdf');
                    $('#dtbi').text('Đã tạo xong!');
                    $('#proccess').addClass('hidden');
                    $('#bntfilearea').fadeIn(800);$('#cdarea').fadeIn(800);$('#filearea').fadeIn(800);
                    $('#btniarea').removeClass('col-lg-12');
                    $('#btniarea').removeClass('text-center');
                    $('#btniarea').addClass('col-lg-3 text-right');
                });
                
            }
        });
//        end
        $('#filtertime').change(function(){
            if($('#filtertime').val() == 0 || $('#filtertime').val() == 1){
                $('#datetimepickerfilter').datetimepicker('viewMode','days');

                $('#datetimepickerfilter').datetimepicker('format','DD/MM/YYYY');

            }
            else if($('#filtertime').val() == 2){
                $('#datetimepickerfilter').datetimepicker('viewMode','months');

                $('#datetimepickerfilter').datetimepicker('format','MM/YYYY');
            }
            else{
                $('#datetimepickerfilter').datetimepicker('viewMode','years');

                $('#datetimepickerfilter').datetimepicker('format','YYYY');
            }
            if($('#filtertime').val() == 0){
               $('#loctungay').removeClass('hidden');
               $('#locdenngay').removeClass('hidden');
               $('#khongtuyy').addClass('hidden');
               $('#quyarea').addClass('hidden');
            }
            else{
               $('#loctungay').addClass('hidden');
               $('#locdenngay').addClass('hidden');
               $('#khongtuyy').removeClass('hidden');
               if($('#filtertime').val() == 3){
                   $('#quyarea').removeClass('hidden');
               }
               else{
                   $('#quyarea').addClass('hidden');
               }
            }
        });
        
        $(document).on("keypress", function (evt) {
            if (evt.keyCode == 27)
            {
                $('button[class="close"]').click();
            }
        });

        $('#quy').on('keypress', function (e){
            if($(this).val().toString().length == 1){
                e.preventDefault();
            }
        });
        
        $("input[type='number']").on("keypress", function (evt) {
            if (evt.which < 49 || evt.which > 52)
            {
                evt.preventDefault();
            }
        });
        
        //nhấn enter tk
        $("#quy").keypress(function(e) {
              var key = e.charCode || e.keyCode || 0;     
              if (key == 13) {
                $('#btnlocds').click();
              }
        });
        //end
    });
    
</script>
@endsection