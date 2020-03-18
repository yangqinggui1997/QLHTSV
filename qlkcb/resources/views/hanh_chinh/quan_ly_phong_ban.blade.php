@extends('hanh_chinh.layout')

@section('title')
    {{ "Thông tin phòng ban" }}
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
                <!-- THÊM MỚI THÔNG TIN PHÒNG BAN-->
                <section class="p-t-20 hidden" id="formpb" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="formtitle">THÊM THÔNG TIN PHÒNG BAN MỚI</h3>
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
                                                                <label class=" form-control-label">Tên phòng (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập tên phòng..." class="form-control" id="tenphong"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Khoa trực thuộc</label>
                                                                <select class="form-control" id="khoa">
                                                                    @if(isset($dskhoa))
                                                                    @foreach($dskhoa as $k)
                                                                    <option value="{{$k->IdKhoa}}">{{$k->TenKhoa}} - {{\comm_functions::decodeKhoa($k->TenKDau)}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Phòng số (<span class="color-red">*</span>)</label>
                                                                <input type="number" min="0" placeholder="Nhập số của phòng..." class="form-control" id="sophong"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tầng (lầu) (<span class="color-red">*</span>)</label>
                                                                <input type="number" min="0" placeholder="Nhập số tầng lầu phòng tọa lạc..." class="form-control" id="tang"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Phân loại</label>
                                                                <select class="form-control" id="pl">
                                                                    <option value="phong_kham">Phòng khám</option>
                                                                    <option value="can_lam_sang">Phòng thực hiện cận lâm sàng</option>
                                                                    <option value="thu_thuat">Phòng thực hiện thủ thuật</option>
                                                                    <option value="phau_thuat">Phòng thực hiện phẫu thuật</option>
                                                                    <option value="thu_ngan">Phòng thu ngân dịch vụ</option>
                                                                    <option value="phat_thuoc">Phòng phát thuốc</option>
                                                                    <option value="phong_luu_benh">Phòng lưu bệnh</option>
                                                                    <option value="hanh_chinh">Phòng hành chính</option>
                                                                    <option value="quan_tri_he_thong">Phòng quản trị hệ thống</option>
                                                                    <option value="tiep_don_cap_cuu">Phòng trực tiếp đón cấp cứu</option>
                                                                    <option value="tiep_don_kham_benh">Phòng tiếp đón khám bệnh</option>
                                                                    <option value="ky_thuat_dien">Phòng kỹ thuật điện</option>
                                                                    <option value="khac">Phòng chức năng khác</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chức năng (<span class="color-red">*</span>)</label>
                                                                <textarea rows="1" placeholder="Nhập số chức năng của phòng..." class="form-control" id="cn"></textarea>
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
                <!-- END THÊM MỚI THÔNG TIN PHÒNG BAN-->

                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH PHÒNG BAN</h3>
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
                                                <th style="position: sticky; top: 0; z-index: 99;">Tên phòng</th>
                                                <th>phòng số</th>
                                                <th>Khoa trực thuộc</th>
                                                <th>Tầng (lầu)</th>
                                                <th>Chức năng</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_pb">
                                            @if(isset($dspb))
                                            @foreach($dspb as $p)
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $p->IdPB }}" data-name="{{ $p->TenPhong }}">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td class="text-left">{{$p->TenPhong}}</td>
                                                <td>{{$p->SoPhong}}</td>
                                                <td class="text-left">
                                                    {{$p->Khoa->TenKhoa}}
                                                </td>
                                                <td>
                                                    @if($p->Tang == 0) {{'Triệt'}}
                                                    @else {{'Lầu '.$p->Tang}}
                                                    @endif
                                                </td>
                                                <td class="text-left">{{$p->ChucNang}}</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{ $p->IdPB }}">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{ $p->IdPB }}" data-name="{{ $p->TenPhong }}">
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

        //Đăng ký với kênh PhongBan đã tạo trong file PhongBan.php
        var channel = pusher.subscribe('PhongBan');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var ttpb='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.phongban.id+'" data-name="'+data.phongban.tenphong+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td class="text-left">'+data.phongban.tenphong+'</td>\n\
                        <td>'+data.phongban.sophong+'</td>\n\
                        <td class="text-left">'+data.phongban.tenkhoa+'</td>';
                    if(data.phongban.tang == 0){
                        ttpb+='<td>Triệt</td>';
                    }
                    else{
                        ttpb+='<td>Lầu '+data.phongban.tang+'</td>';
                    }
                        ttpb+='<td class="text-left">'+data.phongban.cn+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.phongban.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.phongban.id+'" data-name="'+data.phongban.tenphong+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    ttpb+='<tr class="spacer"></tr>';
                    $('#tbl_pb').prepend(ttpb);
                }
                else{

                    $('#tbl_pb tr').has('td div button[data-id="'+data.phongban.id+'"]').replaceWith(ttpb);
                }

                $('button[data-id="'+data.phongban.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isArray(data.phongban)){
                    for (var i = 0; i < data.phongban.length; i++) {
                        $('#tbl_pb tr').has('td div button[data-id="'+data.phongban[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_pb tr').has('td div button[data-id="'+data.phongban[i]+'"]').remove();

                    }
                }
                else{
                    $('#tbl_pb tr').has('td div button[data-id="'+data.phongban+'"]').next('tr.spacer').remove();
                    $('#tbl_pb tr').has('td div button[data-id="'+data.phongban+'"]').remove();

                }
            }
        }

        //Bind một function laytt với sự kiện PhongBan.php
        channel.bind('App\\Events\\HanhChinh\\PhongBan', laytt);
        //end xử lý channel
        
        //Submit thêm mới
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);

            var tenphong=$('#tenphong').val(), khoa=$('#khoa').val(), sp=$('#sophong').val(), tang=$('#tang').val(), pl=$('#pl').val(), cn=$('#cn').val();

            if(tenphong.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên phòng!");
                return false;
            }
            else if(sp.toString().trim() == ''){
                alert("Vui lòng nhập số phòng!");
                return false;
            }
            else if(tang.toString().trim() == ''){
                alert("Vui lòng nhập tầng (lầu) của phòng!");
                return false;
            }
            else if(cn.toString().trim() == ''){
                alert("Vui lòng nhập chức năng của phòng!");
                return false;
            }
            else if(parseInt(sp) == 0){
                alert("Số phòng phải có giá trị!");
                return false;
            }
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('khoa', khoa);
            formData.append('tenphong', tenphong);
            formData.append('pl', pl);
            formData.append('cn', cn);
            formData.append('sp', sp);
            formData.append('tang', tang);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_phong_ban/them_moi',
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
                        alert("Thêm phòng ban mới thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);

                        $('#kqtimliem').text("");
                        tk=false;locds=false;keySearch='';
                    }
                    else if(data.msg == 'trungsp'){
                        var dssp='';
                        if($.isArray(data.gysp)){
                            for (var i = 0; i < data.gysp.length; i++) {
                                dssp+=data.gysp[i];
                                if(i == data.gysp.length - 2){
                                    dssp+=' và ';
                                }
                                else if(i < data.gysp.length - 2)
                                {
                                    dssp+=', ';
                                }
                            }
                        }
                        alert("Số phòng này đã được sử dụng! Bạn có thể sử dụng các số phòng sau "+dssp+"!");
                    }
                    else{
                        alert("Thêm phòng ban mới thất bại! Lỗi: "+data.msg);
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
            var tenphong=$('#tenphong').val(), khoa=$('#khoa').val(), sp=$('#sophong').val(), tang=$('#tang').val(), pl=$('#pl').val(), cn=$('#cn').val();

            if(tenphong.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên phòng!");
                return false;
            }
            else if(sp.toString().trim() == ''){
                alert("Vui lòng nhập số phòng!");
                return false;
            }
            else if(tang.toString().trim() == ''){
                alert("Vui lòng nhập tầng (lầu) của phòng!");
                return false;
            }
            else if(cn.toString().trim() == ''){
                alert("Vui lòng nhập chức năng của phòng!");
                return false;
            }
            else if(parseInt(sp) == 0){
                alert("Số phòng phải có giá trị!");
                return false;
            }
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('khoa', khoa);
            formData.append('tenphong', tenphong);
            formData.append('pl', pl);
            formData.append('cn', cn);
            formData.append('sp', sp);
            formData.append('tang', tang);
            formData.append('id', id);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_phong_ban/cap_nhat',
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
                        alert("Cập nhật thông tin phòng ban thành công!");
                    }
                    else if(data.msg == 'trungsp'){
                        var dssp='';
                        if($.isArray(data.gysp)){
                            for (var i = 0; i < data.gysp.length; i++) {
                                dssp+=data.gysp[i];
                                if(i == data.gysp.length - 2){
                                    dssp+=' và ';
                                }
                                else if(i < data.gysp.length - 2)
                                {
                                    dssp+=', ';
                                }
                            }
                        }
                        alert("Số phòng này đã được sử dụng! Bạn có thể sử dụng các số phòng sau "+dssp+"!");
                    }
                    else{
                        alert("Cập nhật thông tin phòng ban thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin phòng ban thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin phòng ban thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin phòng ban thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật

        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formpb').slideUp(800);
        });
        //end đóng form nhập liệu
        //
        //mở form để thêm
        $('#btnadd').click(function(){
            $('#btnthemarea').fadeIn(800);
            $('#btnlamlaiarea').fadeIn(800);
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('THÊM THÔNG TIN PHÒNG BAN MỚI');
            $('#btnlamlai').click();
            $('#formpb').slideDown(800);
            $('html, body').animate({
                scrollTop: $("#formpb").offset().top
            }, 800);
        });
        //end mở form để thêm

        //xóa
        $('#tbl_pb').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin của phòng ban "+name+"?");
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
                    url: '/qlkcb/hanh_chinh/quan_ly_phong_ban/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" phòng ban được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" phòng ban được tìm thấy!");
                                    }
                                }
                            }
                            if($('#tbl_pb').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            alert("Xóa thông tin phòng ban thành công!");
                        }
                        else{
                            alert("Xóa thông tin phòng ban thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin phòng ban thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin phòng ban thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin phòng ban thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa 

        //mở form để sửa
        $('#tbl_pb').on('click','button[data-button="sua"]',function(){
            $('#btnthemarea').fadeOut(800);
            $('#btnlamlaiarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN PHÒNG BAN');

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_phong_ban/lay_tt_cap_nhat',
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
                        $('#tenphong').val(data.tenphong);$('#khoa').val(data.khoa);$('#sophong').val(data.sophong);$('#tang').val(data.tang);$('#cn').val(data.cn);$('#pl').val(data.pl);
                        $('#formpb').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formpb").offset().top
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
                url: '/qlkcb/hanh_chinh/quan_ly_phong_ban/tim_kiem',
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
                            var ttpb='';
                            for(var i=0; i<data.phongban.length; ++i){
                                ttpb+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.phongban[i].id+'" data-name="'+data.phongban[i].tenphong+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td class="text-left">'+data.phongban[i].tenphong+'</td>\n\
                                    <td>'+data.phongban[i].sophong+'</td>\n\
                                    <td class="text-left">'+data.phongban[i].tenkhoa+'</td>';
                                if(data.phongban[i].tang == 0){
                                    ttpb+='<td>Triệt</td>';
                                }
                                else{
                                    ttpb+='<td>Lầu '+data.phongban[i].tang+'</td>';
                                }
                                    ttpb+='<td class="text-left">'+data.phongban[i].cn+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.phongban[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.phongban[i].id+'" data-name="'+data.phongban[i].tenphong+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }

                            $('#tbl_pb').html(ttpb);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'
                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);

                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" phòng ban được tìm thấy!");
//                            $('#btnlocds').tooltip('hide').attr('data-original-title', 'Lọc danh sách tìm kiếm').tooltip('fixTitle').tooltip('show');
                        }
                        else{
                            $('#tbl_pb').html("");
                            $('#kqtimliem').text("Không có phòng ban nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/hanh_chinh/quan_ly_phong_ban/lay_ds_pb',
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
                        alert("Lỗi khi tải danh sách phòng ban! Mô tả: "+data.msg);
                    }else{
                        var ttpb='';
                        for(var i=0; i<data.phongban.length; ++i){
                            ttpb+='\n\
                                <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.phongban[i].id+'" data-name="'+data.phongban[i].tenphong+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td class="text-left">'+data.phongban[i].tenphong+'</td>\n\
                                <td>'+data.phongban[i].sophong+'</td>\n\
                                <td class="text-left">'+data.phongban[i].tenkhoa+'</td>';
                            if(data.phongban[i].tang == 0){
                                ttpb+='<td>Triệt</td>';
                            }
                            else{
                                ttpb+='<td>Lầu '+data.phongban[i].tang+'</td>';
                            }
                                ttpb+='<td class="text-left">'+data.phongban[i].cn+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.phongban[i].id+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.phongban[i].id+'" data-name="'+data.phongban[i].tenphong+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }

                        $('#tbl_pb').html(ttpb);
                        $('#tbl_pb button[data-id]').tooltip({
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

        //reset input
        $('#btnlamlai').click(function(){
            $('#tenphong').val('');$('#cn').val('');$('#sophong').val('');$('#tang').val('');
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
        $('#tbl_pb').on('change', 'input[data-input="check"]', function(){
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
                alert("Bạn chưa chọn phòng ban để xóa!");
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của các phòng ban "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của phòng ban "+name+"?");
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
                        url: '/qlkcb/hanh_chinh/quan_ly_phong_ban/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" phòng ban được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" phòng ban được tìm thấy!");
                                            }
                                        }
                                    }
                                    if($('#tbl_pb').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các phòng ban thành công!");
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" phòng ban được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" phòng ban được tìm thấy!");
                                        }
                                    }
                                    if($('#tbl_pb').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin phòng ban thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các phòng ban thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin phòng ban thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các phòng ban thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các phòng ban thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các phòng ban thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin phòng ban thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin phòng ban thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin phòng ban thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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
        
        $("#sophong").on("keypress", function (evt) {
            if ($("#sophong").val().toString().length == 3)
            {
                evt.preventDefault();
            }
        });
        
        $("#tang").on("keypress", function (evt) {
            if ($("#tang").val().toString().length == 3)
            {
                evt.preventDefault();
            }
        });
    });
    </script>
@endsection