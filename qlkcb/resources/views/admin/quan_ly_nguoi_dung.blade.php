@extends('admin.layout')

@section('title')
    {{ "Thông tin người dùng" }}
@endsection

@section('css')
<link href="public/css/tempusdominus-bootstrap-4.css" rel="stylesheet" media="all">
@endsection

@section('content')
    <div class="main-content">

                <!-- THÊM MỚI NGƯỜI DÙNG-->
                <section class="p-t-20 hidden" id="formnd" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class=" m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="formtitle">THÊM NGƯỜI DÙNG</h3>
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
                                                                <label class=" form-control-label">Họ tên nhân viên(<span class="color-red">*</span>)</label>
                                                                <input type="text" list="dsnv" id="nv" placeholder="Tên nhân viên..." class="form-control"/>
                                                                <datalist id="dsnv">
                                                                    @if(isset($dsnv))
                                                                    @foreach($dsnv as $nv)
                                                                        <option 
                                                                            @if($nv->CV == 'bac_si_chuyen_khoa_kham_va_dieu_tri')
                                                                            data-quyencode="bsk"
                                                                            data-quyen="Bác sĩ khám và điều trị chuyên khoa"
                                                                            @elseif($nv->CV == 'bac_si_ky_thuat_cls')
                                                                            data-quyencode="bskt"
                                                                            data-quyen="Bác sĩ khoa cận lâm sàng"
                                                                            @elseif($nv->CV == 'bac_si_cap_cuu')
                                                                            data-quyencode="bscc"
                                                                            data-quyen="Bác sĩ trực cấp cứu"
                                                                            @elseif($nv->CV == 'ke_toan')
                                                                            data-quyencode="kt"
                                                                            data-quyen="Kết toán (thu ngân)"
                                                                            @elseif($nv->CV == 'hanh_chinh_tong_hop')
                                                                            data-quyencode="hc"
                                                                            data-quyen="Hành chính tổng hợp"
                                                                            @elseif($nv->CV == 'quan_ly_benh_vien')
                                                                            data-quyencode="qlbv"
                                                                            data-quyen="Quản lý bệnh viện"
                                                                            @elseif($nv->CV == 'phat_thuoc')
                                                                            data-quyencode="pt"
                                                                            data-quyen="Phát thuốc"
                                                                            @elseif($nv->CV == 'tiep_don_cc')
                                                                            data-quyencode="tdcc"
                                                                            data-quyen="Trực tiếp đón bệnh nhân cấp cứu"
                                                                            @else
                                                                            data-quyencode="tdkb"
                                                                            data-quyen="Tiếp đón bệnh nhân đến khám bệnh"
                                                                            @endif
                                                                            value="{{$nv->IdNV}}" data-value="{{$nv->IdNV}}" data-email="{{$nv->Email}}">{{$nv->TenNV}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </datalist>
                                                                <input type="hidden" id="nv_hide">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Email (Tên đăng nhập)</label>
                                                                <input type="text" class="form-control" id="email" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Thêm quyền hạn khác</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <select class="form-control" id="quyenhan">
                                                                            <option value="qlbv">Quản lý bệnh viện</option>
                                                                            <option value="khth">Quản lý phòng kế hoạch tổng hợp</option>
                                                                            <option value="qlck">Quản lý chuyên khoa</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm quyền" id="btnthemquyen" disabled=""><span class="fa fa-plus"></span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Các quyền cấp thêm</label>
                                                                <div class="row">
                                                                    <div class="col-lg-8 m-b-15">
                                                                        <select class="form-control" id="quyenmoi">

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group" >
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa quyền" id="btnxoaquyen"><span class="fa fa-minus"></span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Quyền chính</label>
                                                                <input type="text" class="form-control" id="quyenht" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
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
                <!-- END THÊM MỚI NGƯỜI DÙNG-->

                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH NGƯỜI DÙNG</h3>
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
                                        <button class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="fa fa-user-md"></i></button>
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
                                                <th style="position: sticky; top: 0; z-index: 99;">người dùng</th>
                                                <th>Tài khoản</th>
                                                <th>Quyền hạn</th>
                                                <th>Trạng thái</th>
                                                <th>ảnh đại diện</th>
                                                <th>Ngày tạo</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_nd">
                                            @if (isset($dsnguoidung))
                                                @foreach($dsnguoidung as $nguoidung)
                                                    <tr class="tr-shadow">
                                                        <td style="vertical-align: middle;">
                                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                                <input type="checkbox" data-input="check" data-id="{{ $nguoidung->id }}" data-name="{{ $nguoidung->nhanVien->TenNV }}">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>{{ $nguoidung->nhanVien->TenNV}}</td>
                                                        <td>
                                                            {{$nguoidung->email}}
                                                        </td>
                                                        <td>@if($nguoidung->Quyen == 'admin') {{ "Quản trị hệ thống" }} 
                                                            @elseif($nguoidung->Quyen == 'bsk') {{ "Bác sĩ khám và điều trị bệnh" }}
                                                            @elseif($nguoidung->Quyen == 'bskt') {{ "Bác sĩ thực hiện cận lâm sàng" }}
                                                            @elseif($nguoidung->Quyen == 'hc') {{'Nhân viên hành chính'}}
                                                            @elseif($nguoidung->Quyen == 'qlbv') {{'Quản lý bệnh viện'}}
                                                            @elseif($nguoidung->Quyen == 'pt') {{'Nhân viên quầy phát thuốc'}}
                                                            @elseif($nguoidung->Quyen == 'kt') {{'Nhân viên kế toán'}}
                                                            @elseif($nguoidung->Quyen == 'bscc') {{'Bác sĩ trực cấp cứu'}}
                                                            @else {{'Nhân viên tiếp đón'}}
                                                            @endif</td>
                                                        <td>@if($nguoidung->TrangThai == 'dang_nhap'){{"Đăng nhập"}}@else{{"Đăng xuất"}} @endif</td>
                                                        <td>
                                                            @if($nguoidung->nhanVien->Anh == '')
                                                                {{ "Chưa cập nhật!" }}
                                                            @else
                                                                <img class="avatar" src="public/upload/anhnv/{{$nguoidung->nhanVien->Anh}}" alt="Ảnh nhân viên" style="height: 45px; width: 45px">
                                                            @endif
                                                        </td>
                                                        <td>{{\comm_functions::deDateFormat($nguoidung->created_at)}}</td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{$nguoidung->id}}">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{$nguoidung->id}}" data-name="{{$nguoidung->nhanVien->TenNV}}">
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
        var tk=false, soluongtk=0, soluongl=0, locds=false, flagnd=false;
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
       
        //Đăng ký với kênh UserEvent đã tạo trong file UserEvent.php
        var channel = pusher.subscribe('UserEvent');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var anh='';
                if(data.user.anh == null){
                    anh='Chưa cập nhật!';
                }
                else{
                    anh='<img class="avatar" src="public/upload/anhnv/'+data.user.anh+'" alt="Ảnh nhân viên" style="height: 45px; width: 45px">';
                }
                var ttnd='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.user.id+'" data-name="'+data.user.tennd+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td>'+data.user.tennd+'</td>\n\
                        <td>'+data.user.tk+'</td>\n\
                        <td>'+data.user.qh+'</td>\n\
                        <td>'+data.user.tt+'</td>\n\
                        <td style="width: 100px ;">'+anh+'</td>\n\
                        <td>'+data.user.ngaytao+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="'+data.user.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.user.id+'" data-name="'+data.user.tennd+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    ttnd+='<tr class="spacer"></tr>';
                    $('#tbl_nd').prepend(ttnd);
                    $('#dsnv option[data-value="'+data.user.idnv+'"]').remove();
                }
                else{
                    $('#tbl_nd tr').has('td div button[data-id="'+data.user.id+'"]').replaceWith(ttnd);
                }

                $('button[data-id="'+data.user.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else if(data.thaotac == 'cntk'){
                $('img[data-anhtk="anhtk"]').attr('src', 'public/upload/anhnv/'+data.anh);
            }
            else{
                if($.isArray(data.user)){
                    for (var i = 0; i < data.user.length; i++) {
                        $('#tbl_nd tr').has('td div button[data-id="'+data.user[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_nd tr').has('td div button[data-id="'+data.user[i]+'"]').remove();

                    }
                }
                else{
                    $('#tbl_nd tr').has('td div button[data-id="'+data.user+'"]').next('tr.spacer').remove();
                    $('#tbl_nd tr').has('td div button[data-id="'+data.user+'"]').remove();

                }
            }
        }

        //Bind một function laytt với sự kiện UserEvent.php
        channel.bind('App\\Events\\Admin\\UserEvent', laytt);
        //end xử lý channel

        $('#btnthemquyen').click(function (){
            if($('#quyenht').attr('data-quyen') == 'pt' || $('#quyenht').attr('data-quyen') == 'kt' || $('#quyenht').attr('data-quyen') == 'admin' || $('#quyenht').attr('data-quyen') == 'tdkb' || $('#quyenht').attr('data-quyen') == 'tdcc'){
                return false;
            }
            else{
                var flag=false;
                $('#quyenmoi option').each(function(){
                    if($(this).val() == $('#quyenhan').val() || (($('#quyenhan').val() == 'qlbv' || $('#quyenhan').val() == 'khth') && ($('#quyenht').attr('data-quyen') == 'bsk' || $('#quyenht').attr('data-quyen') == 'bskt' || $('#quyenht').attr('data-quyen') == 'bscc')) || (($('#quyenhan').val() == 'qlck') && ($('#quyenht').attr('data-quyen') == 'qlbv' || $('#quyenht').attr('data-quyen') == 'hc'))){
                        flag=true;
                        return false;
                    }
                });
                if(($('#quyenhan').val() == $('#quyenht').attr('data-quyen')) || (($('#quyenhan').val() == 'qlbv' || $('#quyenhan').val() == 'khth') && ($('#quyenht').attr('data-quyen') == 'bsk' || $('#quyenht').attr('data-quyen') == 'bskt' || $('#quyenht').attr('data-quyen') == 'bscc' || $('#quyenht').attr('data-quyen') == 'pt')) || (($('#quyenhan').val() == 'qlck') && ($('#quyenht').attr('data-quyen') == 'qlbv' || $('#quyenht').attr('data-quyen') == 'hc'))){
                    flag=true;
                }
                
                if(flag==false)
                {
                    $('#quyenmoi').prepend('<option value="'+$('#quyenhan').val()+'">'+$('#quyenhan option[value="'+$('#quyenhan').val()+'"]').text()+'</option>');
                }
            }
        });

        $('#btnxoaquyen').click(function(){
            $('#quyenmoi option[value="'+$('#quyenmoi').val()+'"]').remove();
        });
        
        //Submit thêm mới
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);

            var nv=$('#nv_hide').val();
            
            if($('#nv').val().toString().trim() == ''){
                alert("Vui lòng nhập thông tin họ tên nhân viên!");
                return false;
            }
            else{
                if(flagnd == false){
                    alert("Nhân viên này không tồn tại, có thể đã bị xóa!");
                    return false;
                }
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idnv', nv);
            if($('#quyenmoi').children().length > 0){
                var quyen=[];
                $('#quyenmoi option').each(function(){
                    $.each(this.attributes, function() {
                        if (this.name.indexOf('value') == 0) {
                            quyen.push(this.value);
                        }
                    });
                });
                formData.append('quyenmoi', quyen);
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/admin/quan_ly_nguoi_dung/them_moi',
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
                        alert("Thêm người dùng thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);
                        $('#nv').val('');
                        $('#quyenmoi').html('');
                        $('#quyenht').val('');
                        $('#kqtimliem').text("");
                        tk=false;locds=false;
                    }
                    else{
                        alert("Thêm người dùng thất bại! Lỗi: "+data.msg);
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
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if($('#quyenmoi').children().length > 0){
                var quyen=[];
                $('#quyenmoi option').each(function(){
                    $.each(this.attributes, function() {
                        if (this.name.indexOf('value') == 0) {
                            quyen.push(this.value);
                        }
                    });
                });
                formData.append('quyenmoi', quyen);
            }
            formData.append('id', id);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/admin/quan_ly_nguoi_dung/cap_nhat',
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
                        alert("Cập nhật thông tin người dùng thành công!");
                    }else{
                        alert("Cập nhật thông tin người dùng thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin người dùng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin người dùng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin người dùng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật
        
        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formnd').slideUp(800);
        });
        //end đóng form nhập liệu
        
        //mở form để thêm
        $('#btnadd').click(function(){
            $('#nv').val('');
            $('#quyenmoi').html('');
            $('#quyenht').val('');
            $('#btnthemarea').fadeIn(800);
            $('#btnlamlaiarea').fadeIn(800);
            $('#nv').removeAttr('disabled');
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('THÊM MỚI TÀI KHOẢN');
            $('#formnd').slideDown(800);
            $('html, body').animate({
                scrollTop: $("#formnd").offset().top
            }, 800);
        });
        //end mở form để thêm

        //xóa
        $('#tbl_nd').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin tài khoản của nhân viên "+name+"?");
            if(cf==true){
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/admin/quan_ly_nguoi_dung/xoa',
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
                            if(data.dskx.length == 0){
                                if(locds == true){
                                    soluongl--;
                                    if(soluongl == 0){
                                         $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongl+" người dùng được tìm thấy!");
                                    }
                                }
                                else{
                                    if(tk == true){
                                        soluongtk--;
                                        if(soluongtk == 0){
                                            $('#kqtimliem').text("");
                                        }
                                        else{
                                            $('#kqtimliem').text("Có "+soluongtk+" người dùng được tìm thấy!");
                                        }
                                    }
                                }
                                if($('#tbl_nd').children().length == 0){
                                    $('input[data-input="checksum"]').prop("checked",false);
                                }
                                $('#dsnv').prepend(data.dsx[0]);
                                alert("Xóa thông tin người dùng thành công!");
                            }
                            else{
                                alert("Người dùng "+data.dskx[0]+" không thể xóa vì họ đang thao tác trong hệ thống hoặc có quyền admin!");
                            }
                        }
                        else{
                            alert("Xóa thông tin người dùng thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin người dùng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin người dùng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin người dùng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa
        
        //mở form để sửa
        $('#tbl_nd').on('click','button[data-button="sua"]',function(){
            $('#btnthemarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN TÀI KHOẢN');

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/admin/quan_ly_nguoi_dung/lay_tt_cap_nhat',
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
                        $('#nv').attr('disabled','');$('#btnthemquyen').removeAttr('disabled');
                        $('#nv').val(data.nv);$('#quyenht').attr('data-quyen', data.quyen);$('#email').val(data.email);$('#quyenmoi').html(data.quyenmoi);$('#quyenht').val(data.quyenc);

                        $('#formnd').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formnd").offset().top
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
                        alert("Lấy dữ liệu thất bại. Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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
                url: '/qlkcb/admin/quan_ly_nguoi_dung/tim_kiem',
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
                            var ttnd='';
                            for(var i=0; i<data.user.length; ++i){
                                var anh='';
                                if(data.user[i].anh == null){
                                    anh='Chưa cập nhật!';
                                }
                                else{
                                    anh='<img class="avatar" src="public/upload/anhnv/'+data.user[i].anh+'" alt="Ảnh nhân viên" style="height: 45px; width: 45px">';
                                }
                                ttnd+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.user[i].id+'" data-name="'+data.user[i].tennd+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td>'+data.user[i].tennd+'</td>\n\
                                        <td>'+data.user[i].tk+'</td>\n\
                                        <td>'+data.user[i].qh+'</td>\n\
                                        <td>'+data.user[i].tt+'</td>\n\
                                        <td style="width: 100px ;">'+anh+'</td>\n\
                                        <td>'+data.user[i].ngaytao+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="'+data.user[i].id+'">\n\
                                                    <i class="zmdi zmdi-edit"></i>\n\
                                                </button>\n\
                                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.user[i].id+'" data-name="'+data.user[i].tennd+'">\n\
                                                    <i class="zmdi zmdi-delete"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                            }

                            $('#tbl_nd').html(ttnd);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);

                            tk=true;
                            $('#kqtimliem').text("Có "+data.sl+" người dùng được tìm thấy!");

                        }
                        else{
                            $('#tbl_nd').html("");
                            $('#kqtimliem').text("Không có người dùng nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/admin/quan_ly_nguoi_dung/lay_ds_nd',
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
                        alert("Lỗi khi tải danh sách người dùng! Mô tả: "+data.msg);
                    }else{
                        var ttnd='';
                        for(var i=0; i<data.user.length; ++i){
                            var anh='';
                            if(data.user[i].anh == null){
                                anh='Chưa cập nhật!';
                            }
                            else{
                                anh='<img class="avatar" src="public/upload/anhnv/'+data.user[i].anh+'" alt="Ảnh nhân viên" style="height: 45px; width: 45px">';
                            }
                            ttnd+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.user[i].id+'" data-name="'+data.user[i].tennd+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.user[i].tennd+'</td>\n\
                                    <td>'+data.user[i].tk+'</td>\n\
                                    <td>'+data.user[i].qh+'</td>\n\
                                    <td>'+data.user[i].tt+'</td>\n\
                                    <td style="width: 100px ;">'+anh+'</td>\n\
                                    <td>'+data.user[i].ngaytao+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="'+data.user[i].id+'">\n\
                                                    <i class="zmdi zmdi-edit"></i>\n\
                                                </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.user[i].id+'" data-name="'+data.user[i].tennd+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                        }

                        $('#tbl_nd').html(ttnd);
                        $('#tbl_nd button[data-id]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);

                        tk=false;locds=false;
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
        $('#tbl_nd').on('change', 'input[data-input="check"]', function(){
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
                alert("Bạn chưa chọn người dùng để xóa!");
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin tài khoản của các nhân viên "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin tài khoản của nhân viên "+name+"?");
                }
                if(cf==true){
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/admin/quan_ly_nguoi_dung/xoa',
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
                                    if(data.dskx.length == 0){
                                        if(locds == true){
                                            soluongl = soluongl - arr.length;
                                            if(soluongl == 0)
                                            {
                                                $('#kqtimliem').text("");
                                            }
                                            else
                                            {
                                                $('#kqtimliem').text("Có "+soluongl+" người dùng được tìm thấy!");
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
                                                    $('#kqtimliem').text("Có "+soluongtk+" người dùng được tìm thấy!");
                                                }
                                            }
                                        }
                                        if($('#tbl_nv').children().length == 0){
                                            $('input[data-input="checksum"]').prop("checked",false);
                                        }
                                        for (var i = 0; i < data.dsx.length; i++) {
                                            $('#dsnv').prepend(data.dsx[i]);
                                        }
                                        alert("Xóa thông tin các người dùng thành công!");
                                    }
                                    else{
                                        var name='';
                                        for (var i = 0; i < data.dskx.length; i++) {
                                            name+=data.dskx[i];
                                            if(i == data.dskx.length - 2){
                                                name+=' và ';
                                            }
                                            else if(i < data.dskx.length - 2){
                                                name+=', ';
                                            }
                                        }
                                        alert("Người dùng "+name+" không thể xóa do người dùng này đang thao tác trong hệ thống hoặc có quyền admin!");
                                    }
                                }
                                else
                                {
                                    if(data.dskx.length == 0){
                                        if(locds == true){
                                            $('#kqtimliem').text("Có "+(soluongl - 1)+" người dùng được tìm thấy!");
                                        }
                                        else{
                                            if(tk == true){
                                                $('#kqtimliem').text("Có "+(soluongtk - 1)+" người dùng được tìm thấy!");
                                            }
                                        }
                                        if($('#tbl_nv').children().length == 0){
                                            $('input[data-input="checksum"]').prop("checked",false);
                                        }
                                        $('#dsnv').prepend(data.dsx[0]);
                                        alert("Xóa thông tin người dùng thành công!");
                                    }
                                    else{
                                        alert("Người dùng "+data.dskx[0]+" không thể xóa vì họ đang thao tác trong hệ thống hoặc có quyền admin!");
                                    }
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các người dùng thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin người dùng thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các người dùng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các người dùng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các người dùng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }

                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin người dùng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin người dùng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin người dùng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }

                            }
                        }
                    });
                }

            }
        });
        //end
        
        //xử lý lấy phần text cho datalist tên nhân viên
        $('input[list="dsnv"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('nv_hide'),
                inputValue = input.value;
                $('#quyenmoi').html('');$('#btnthemquyen').attr('disabled','');
                flagnd=false;
                hiddenInput.value='';
                $('#email').val('');
                $('#quyenht').val('');
                $('#quyenht').attr('data-quyen','');
            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue || option.value == inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    input.value=option.innerText;
                    $('#email').val(option.getAttribute('data-email'));
                    $('#quyenht').val(option.getAttribute('data-quyen'));
                    $('#quyenht').attr('data-quyen',option.getAttribute('data-quyencode'));
                    $('#btnthemquyen').removeAttr('disabled', '');
                    flagnd=true;
                    break;
                } 
            }
        });
        //end
    });
    </script>
@endsection