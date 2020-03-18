@extends('hanh_chinh.layout')

@section('title')
    {{ "Thống kê thuốc tồn kho" }}
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
                                    <h3 class="title-5 font-weight-bold text-green">THỐNG KÊ THUỐC TỒN KHO</h3>
                                    <hr class="line-seprate">
                                </div>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light width-200px">
                                            <select class="js-select2" id="danhmuc">
                                                <option value="all">Tất cả danh mục thuốc</option>
                                                <option value="1">Danh mục BHYT</option>
                                                <option value="0">Ngoài danh mục BHYT</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        @if($nd->Quyen != 'admin' && $flag == FALSE)
                                        <div class="rs-select2--light width-180px">
                                            <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Tạo thống kê" id="btnlocds">
                                            <i class="fa fa-filter"></i></button>
                                            
                                        </div>
                                        <div class="rs-select2--light width-180px">
                                            <button type="button" class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Làm lại" id="btnlamlai">
                                            <i class="fa fa-refresh"></i></button>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button type="button" class="au-btn au-btn--green au-btn--small au-btn-shadow height-40px hidden" rel="tooltip" title="In thống kê này" data-toggle ="modal" data-target="#mdprint" id="btnin"><i class="zmdi zmdi-print"></i></button>
                                       
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
                                                <th>Tên thuốc</th>
                                                <th>Nhà sản xuất</th>
                                                <th>Nhà cung ứng</th>
                                                <th>Ngày sản xuất</th>
                                                <th>Ngày hết hạn</th>
                                                <th>Đơn giá nhập (VNĐ)</th>
                                                <th>Đơn vị tính</th>
                                                <th>Tổng số lượng tồn</th>
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
<script src="public/js/pusher.js"></script>
<script src="public/js/html2canvas.js"></script>
<script>
    $(function () {

        var tgt='', tgty='', quy='', tgbd='', tgkt='', tinh='', huyen='', xa='', title='', tgtaotk='';
        var tstrang=1;//tong so trang in
        var file_name_print='';
        var q='I';
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
        //end xử lý channel
        
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
            var danhmuc=$('#danhmuc').val();
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('pl', danhmuc);
            file_name_print='TK_THUOC_NGAY_'+d.getDate()+'_'+thang+'_'+d.getFullYear()+'_'+gio+'_'+phut+'_'+giay+'_'+apm;
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/thong_ke_thuoc_ton_kho/them_tk',
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
                        alert('Không thể tạo thống kê! Lỗi: '+data.msg);
                        return false;
                    }
                    // Success
                    
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
                    title='BẢNG THỐNG KÊ THUỐC TỒN KHO';
                    
                    var ngaytk='NGÀY TẠO: '+ngay+'/'+thang+'/'+d.getFullYear()+' '+gio+':'+phut+':'+giay+' '+apm;
                    
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
                                <label style="margin: 0; font-size:13pt; height: 21px"></label><br>\n\
                                <label style="margin: 0; font-size:8pt">'+ngaytk+'</label>\n\
                            </div>\n\
                        </div>\n\
                        <div class="row" style="height: 87px"></div>\n\
                        <hr class="line-seprate">\n\
                        <div class="row" style="margin-top: 15px;">\n\
                                <div class="col-lg-12">\n\
                                    <table class="table table-bordered" style="font-size: 10pt;">\n\
                                        <thead style="font-size: 8pt; vertical-align: middle">\n\
                                            <tr>\n\
                                                <th><center>STT</center></th>\n\
                                                <th><center>TÊN THUỐC</center></th>\n\
                                                <th><center>NHÀ SẢN XUẤT</center></th>\n\
                                                <th><center>NHÀ CUNG ỨNG</center></th>\n\
                                                <th><center>NGÀY SẢN XUẤT</center></th>\n\
                                                <th><center>NGÀY HẾT HẠN</center></th>\n\
                                                <th><center>ĐƠN GIÁ NHẬP (VNĐ)</center></th>\n\
                                                <th><center>ĐƠN VỊ TÍNH</center></th>\n\
                                                <th><center>TỔNG SỐ LƯỢNG TỒN</center></th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody style="font-size: 9pt;">';
                    var newpage_bf='\n\
                    <div class="card-body card-block printcontent" style="min-height: 1300px; max-height: 1300px;">\n\
                        <div class="row" style="margin-top: 15px;">\n\
                                <div class="col-lg-12">\n\
                                    <table class="table table-bordered" style="font-size: 10pt;">\n\
                                        <thead style="font-size: 8pt; vertical-align: middle">\n\
                                            <tr>\n\
                                                <th><center>STT</center></th>\n\
                                                <th><center>TÊN THUỐC</center></th>\n\
                                                <th><center>NHÀ SẢN XUẤT</center></th>\n\
                                                <th><center>NHÀ CUNG ỨNG</center></th>\n\
                                                <th><center>NGÀY SẢN XUẤT</center></th>\n\
                                                <th><center>NGÀY HẾT HẠN</center></th>\n\
                                                <th><center>ĐƠN GIÁ NHẬP (VNĐ)</center></th>\n\
                                                <th><center>ĐƠN VỊ TÍNH</center></th>\n\
                                                <th><center>TỔNG SỐ LƯỢNG TỒN</center></th>\n\
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
                                    var space_height=128+((13-n)*42)-80;
                                    content+='\n\
                                                        </tbody>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        <div class="row m-t-45 text-center">\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">NGƯỜI LẬP BIỂU</label><br>\n\
                                                <label style="margin-bottom: 60px;">(Ký tên)</label><br>\n\
                                                <label style="font-size: 10pt; font-weight: 600; margin-bottom: 0;">'+data.nv+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                <label>(Ký tên)</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                <label>(Ký tên, đóng dấu)</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div style="height:'+space_height+'px"></div>\n\
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
                                                <label style="margin-bottom: 60px;">(Ký tên)</label><br>\n\
                                                <label style="font-size: 10pt; font-weight: 600; margin-bottom: 0;">'+data.nv+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                <label>(Ký tên)</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                <label>(Ký tên, đóng dấu)</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div style="height: 48px"></div>\n\
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
                                        var space_height=20+((18-parseInt(data.result_print.length))*42)-20;
                                        var space_height1=1104-80;
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
                                                <label style="margin-bottom: 60px;">(Ký tên)</label><br>\n\
                                                <label style="font-size: 10pt; font-weight: 600; margin-bottom: 0;">'+data.nv+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                <label>(Ký tên)</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                <label>(Ký tên, đóng dấu)</label>\n\
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
                                        var space_height1=(22*42)+158-80;
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
                                                <label style="margin-bottom: 60px;">(Ký tên)</label><br>\n\
                                                <label style="font-size: 10pt; font-weight: 600; margin-bottom: 0;">'+data.nv+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                <label>(Ký tên)</label>\n\
                                            </div>\n\
                                            <div class="col-lg-4">\n\
                                                <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                <label>(Ký tên, đóng dấu)</label>\n\
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
                                                    <label style="margin-bottom: 60px;">(Ký tên)</label><br>\n\
                                                    <label style="font-size: 10pt; font-weight: 600; margin-bottom: 0;">'+data.nv+'</label>\n\
                                                </div>\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                    <label>(Ký tên)</label>\n\
                                                </div>\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                    <label>(Ký tên, đóng dấu)</label>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div style="height: 10px"></div>\n\
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
                                            var space_height=20;
                                            var space_height1=(22*42)+158-80;
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
                                                    <label style="margin-bottom: 60px;">(Ký tên)</label><br>\n\
                                                    <label style="font-size: 10pt; font-weight: 600; margin-bottom: 0;">'+data.nv+'</label>\n\
                                                </div>\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                    <label>(Ký tên)</label>\n\
                                                </div>\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                    <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                    <label>(Ký tên, đóng dấu)</label>\n\
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
                                            var space_height=20;
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
                                                var space_height=38+((26-((n-18) % 26))*42)-20;
                                                var space_height1=(22*42)+158-80;
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
                                                            <label style="margin-bottom: 60px;">(Ký tên)</label><br>\n\
                                                            <label style="font-size: 10pt; font-weight: 600; margin-bottom: 0;">'+data.nv+'</label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-4">\n\
                                                            <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                            <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                            <label>(Ký tên)</label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-4">\n\
                                                            <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                            <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                            <label>(Ký tên, đóng dấu)</label>\n\
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
                                                var space_height=20+((22-((n-18) % 26))*42)-80;
                                                if(n<40){
                                                    space_height=88+((40-n)*42)-80;
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
                                                        <label style="margin-bottom: 60px;">(Ký tên)</label><br>\n\
                                                        <label style="font-size: 10pt; font-weight: 600; margin-bottom: 0;">'+data.nv+'</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-4">\n\
                                                        <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                        <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">TRƯỞNG PHÒNG KHTH</label><br>\n\
                                                        <label>(Ký tên)</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-4">\n\
                                                        <label style="margin-bottom: 0;">An Giang, ngày......., tháng......., năm.......</label><br>\n\
                                                        <label style="font-size: 11pt; font-weight: 600; margin-bottom: 0;">GIÁM ĐỐC</label><br>\n\
                                                        <label>(Ký tên, đóng dấu)</label>\n\
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
                        alert("Thống kê thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Thống kê thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Thống kê thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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
            $('#tongso').val('');$('#khambhyt').val('');$('#khamthuphi').val('');$('#dungtuyen').val('');$('#vuottuyen').val('');$('#khamthuong').val('');$('#khamcc').val('');$('#cogiaychuyen').val('');$('#kocogiaychuyen').val('');$('#quyarea').addClass('hidden');$('#quy').val('');
            $('#tqarea').slideUp(800);       
            $('#filtertime').val(0);$('#filtertime').change();$('#khoa_f').val('all');$('#tinh_f').val('all');$('#tinh_f').change();
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