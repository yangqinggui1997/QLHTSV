@extends('tiep_don.layout')

@section('title')
    {{ "Thông tin bệnh nhân" }}
@endsection

@section('css')
<link href="public/css/tempusdominus-bootstrap-4.css" rel="stylesheet" media="all">
@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
                <!-- BREADCRUMB-->
                <section class="au-breadcrumb2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
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
                    </div>
                </section>
                <!-- END BREADCRUMB-->
                
                <!-- THÊM, SỬA BỆNH NHÂN-->
                <section class="p-t-20 hidden" id="formbn" >
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
                                                <form enctype="multipart/form-data" id="fthem" role="form">
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Họ tên bệnh nhân (<span class="color-red">*</span>)</label>
                                                                <input type="text" id="hoten" placeholder="Nhập họ tên bệnh nhân" class="form-control"/>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Ngày sinh</label>
                                                                <div class="input-group date" id="datetimepickerngaysinh" data-target-input="nearest">
                                                                    <input onkeydown="return false" type="text" id="ngaysinh" class="form-control datetimepicker-input" data-target="#datetimepickerngaysinh" />
                                                                    <div class="input-group-append" data-target="#datetimepickerngaysinh" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Giới tính</label>
                                                                <select class="form-control" id="gt">
                                                                    <option value="0">Nữ</option>
                                                                    <option value="1" selected="">Nam</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Dân tộc</label>
                                                                <select class="form-control" id="dantoc">
                                                                    @if(isset($dsdantoc))
                                                                        <?php foreach($dsdantoc as $dt){ ?>
                                                                    <option value="<?php echo \comm_functions::changeTitle($dt); ?>">{{$dt}}</option>
                                                                        <?php }?>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Số CMND</label>
                                                                <input type="number" min="0" maxlength="9" id="scmnd" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Số điện thoại</label>
                                                                <input type="number" min="0" maxlength="10" id="sdt" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tỉnh / TP</label>
                                                                <select class="form-control" id="tinh">
                                                                    @if(isset($dstinh))
                                                                        <?php foreach($dstinh as $t){ ?>
                                                                    <option value="<?php echo $t->IdTinh; ?>">{{$t->TenTinh}}</option>
                                                                        <?php }?>
                                                                    @endif
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Quận / Huyện</label>
                                                                <select class="form-control" id="huyen">
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Xã / Phường</label>
                                                                <select class="form-control" id="xa">
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Số nhà / Tên đường</label>
                                                                <input type="text" id="diachi" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Ảnh</label>
                                                                <input type="file" id="anh" class="form-control-file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        @if($nd->Quyen != 'admin')
                                                        <div class="col-lg-1 hidden" id="btnthemarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Thêm mới" id="btnthem"><span class="fa fa-plus"></span></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btnsuaarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Cập nhật" id="btncapnhat" data-id=""><span class="fa fa-edit"></span></button>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btnllarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--remove au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Làm lại" id="btnlamlai"><span class="fa fa-eraser"></span></button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-lg-1" >
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
                <!-- END THÊM, SỬA  BỆNH NHÂN-->
                
                 <!--DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH BỆNH NHÂN</h3>
                                    <hr class="line-seprate">
                                </div>
                                
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="dtk">
                                                <option value="all">Tất cả đối tượng khám</option>
                                                <option value="0">Không BHYT</option>
                                                <option value="1">Có BHYT</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="dantoc_f">
                                                <option value="all">Tất cả dân tộc</option>
                                                @if(isset($dsdantoc))
                                                    <?php foreach($dsdantoc as $dt){ ?>
                                                <option value="<?php echo \comm_functions::changeTitle($dt); ?>">{{$dt}}</option>
                                                    <?php }?>
                                                @endif
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="gt_f">
                                                <option value="all">Tất cả phái</option>
                                                <option value="0">Nữ</option>
                                                <option value="1">Nam</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="tinh_f">
                                                <option value="all">Tất cả tỉnh / thành phố</option>
                                                @if(isset($dstinh))
                                                    <?php foreach($dstinh as $t){ ?>
                                                <option value="<?php echo $t->IdTinh; ?>">{{$t->TenTinh}}</option>
                                                    <?php }?>
                                                @endif
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="huyen_f">
                                                <option value="all">Tất cả quận / huyện</option>
                                                
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-200px m-b-15">
                                            <select class="js-select2" id="xa_f">
                                                <option value="all">Tất cả phường / xã</option>
                                                
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Lọc danh sách" id="btnlocds">
                                            <i class="fa fa-filter"></i></button>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <div class="row">
                                            <div class="col-lg-4 m-b-15">
                                                <button type="button"  class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="zmdi zmdi-male"></i></button>
                                            </div>
                                            <div class="col-lg-4 m-b-15">
                                                <button type="button" class="au-btn au-btn--teal au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Nạp lại danh sách" id="btnnapds"><i class="zmdi zmdi-refresh"></i></button>
                                            </div>
                                            <div class="col-lg-4 m-b-15">
                                                <button type="button" class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatc"><i class="zmdi zmdi-delete"></i></button>
                                            </div>
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
                                                <th style="position: sticky; top: 0; z-index: 99;">họ tên</th>
                                                <th>Ngày Sinh</th>
                                                <th>giới tính</th>
                                                <th>Tuổi</th>
                                                <th>số cmnd</th>
                                                <th>số điện thoại</th>
                                                <th>địa chỉ</th>
                                                <th>dân tộc</th>
                                                <th>Ảnh</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_bn">
                                            @if (isset($benhnhan))
                                                @foreach($benhnhan as $b)
                                                    <tr class="tr-shadow">
                                                        <td style="vertical-align: middle;">
                                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                                <input type="checkbox" data-input="check" data-id="{{ $b->IdBN }}" data-name="{{ $b->HoTen }}">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td>{{ $b->HoTen}}</td>
                                                        <td>
                                                            <?php
                                                                $timeStamp = date( "d/m/Y", strtotime($b->NgaySinh));
                                                                echo $timeStamp;  
                                                            ?>
                                                        </td>
                                                        <td>@if($b->GioiTinh == 1) {{ "Nam" }} @else {{ "Nữ" }} @endif</td>
                                                        <td>
                                                            <?php
                                                                //date in mm/dd/yyyy format; or it can be in other formats as well
                                                                //explode the date to get month, day and year
                                                                $birthDate = explode("/", date( "m/d/Y", strtotime($b->NgaySinh)));
                                                                //get age from date or birthdate
                                                                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                                                                ? ((date("Y") - $birthDate[2]) - 1)
                                                                : (date("Y") - $birthDate[2]));
                                                                echo $age;
                                                            ?>
                                                        </td>
                                                        <td>@if($b->SoCMND != "")
                                                                {{ $b->SoCMND }}
                                                            @else
                                                                {{"Chưa cập nhật!"}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($b->SDT != "")
                                                                {{ $b->SDT }}
                                                            @else
                                                                {{"Chưa cập nhật!"}}
                                                            @endif
                                                        </td>
                                                        <td><?php
                                                            if($b->DiaChi != ''){
                                                                echo $b->DiaChi.", xã ".$b->phuongXa->TenXa.", huyện, ".$b->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$b->phuongXa->quanHuyen->tinhTP->TenTinh;
                                                            }
                                                            else{
                                                                echo "Xã ".$b->phuongXa->TenXa.", huyện, ".$b->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$b->phuongXa->quanHuyen->tinhTP->TenTinh;
                                                            }    
                                                            
                                                        ?></td>
                                                        <td>
                                                            @if($b->DanToc != "")
                                                                <?php echo \comm_functions::decodeDanToc($b->DanToc); ?>
                                                            @else
                                                                {{"Chưa cập nhật!"}}
                                                            @endif
                                                        </td>
                                                        <td style="width: 100px ;">
                                                            @if($b->Anh == '')
                                                                {{ "Chưa cập nhật!" }}
                                                            @else
                                                                <img class="avatar" src="public/upload/anhbn/{{$b->Anh}}" alt="Ảnh bệnh nhân" style="height: 45px; width: 45px">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{$b->IdBN}}">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{$b->IdBN}}" data-name="{{$b->HoTen}}">
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
                 <!--END DATA TABLE-->
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
        if ($("#datetimepickerngaysinh").length) {
            
            $('#datetimepickerngaysinh').datetimepicker({
                icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                format: 'DD/MM/YYYY HH:mm:ss'
            });
        }
        
        $('#ngaysinh').on('input', function (){
            $('#datetimepickerngaysinh').datetimepicker('minDate', '01/01/1900 00:00'); 
            $('#datetimepickerngaysinh').datetimepicker('maxDate', new Date()); 
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
        
        //Đăng ký với kênh BenhNhan đã tạo trong file BenhNhan.php
        var channel = pusher.subscribe('BenhNhan');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var anh='';
                if(data.benhnhan.anh == null){
                    anh='Chưa cập nhật!';
                }
                else{
                    anh='<img class="avatar" src="public/upload/anhbn/'+data.benhnhan.anh+'" alt="Ảnh bệnh nhân" style="height: 45px; width: 45px">';
                }
                var ttbn='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.benhnhan.id+'" data-name="'+data.benhnhan.hoten+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td>'+data.benhnhan.hoten+'</td>\n\
                        <td>'+data.benhnhan.ngaysinh+'</td>\n\
                        <td>'+data.benhnhan.gt+'</td>\n\
                        <td>'+data.benhnhan.tuoi+'</td>\n\
                        <td>'+data.benhnhan.scmnd+'</td>\n\
                        <td>'+data.benhnhan.sdt+'</td>\n\
                        <td>'+data.benhnhan.diachi+'</td>\n\
                        <td>'+data.benhnhan.dantoc+'</td>\n\
                        <td style="width: 100px ;">'+anh+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.benhnhan.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.benhnhan.id+'" data-name="'+data.benhnhan.hoten+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    ttbn+='<tr class="spacer"></tr>';
                    $('#tbl_bn').prepend(ttbn);
                }
                else{
                    
                    $('#tbl_bn tr').has('td div button[data-id="'+data.benhnhan.id+'"]').replaceWith(ttbn);
                }
                
                $('button[data-id="'+data.benhnhan.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isArray(data.benhnhan)){
                    for (var i = 0; i < data.benhnhan.length; i++) {
                        $('#tbl_bn tr').has('td div button[data-id="'+data.benhnhan[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_bn tr').has('td div button[data-id="'+data.benhnhan[i]+'"]').remove();
                        
                    }
                }
                else{
                    $('#tbl_bn tr').has('td div button[data-id="'+data.benhnhan+'"]').next('tr.spacer').remove();
                    $('#tbl_bn tr').has('td div button[data-id="'+data.benhnhan+'"]').remove();
                    
                }  
            }
        }
        
        //Bind một function laytt với sự kiện BenhNhan.php
        channel.bind('App\\Events\\TiepDon\\BenhNhan', laytt);
        //end xử lý channel
        
        //Lấy danh sách tỉnh
        $('#tinh').change(function(){
            var id=$(this).val();
            $.ajax({
                type: 'post',
                url: "/qlkcb/tiep_don/thong_tin_benh_nhan/lay_ds_huyen",
                dataType: 'JSON',
                data: {_token: CSRF_TOKEN, idtinh: id},
                success: function(data){
                    $('#huyen').html(data.msg);
                    $("#huyen").change();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Không thể lấy danh sách quận - huyện. Lỗi: "+jqXHR+" | "+errorThrown);
                }
            });
        });
        //end Lấy danh sách tỉnh
        
        //Lấy danh sách tỉnh để lọc
        $('#tinh_f').change(function(){
            var id=$(this).val();
            $.ajax({
                type: 'post',
                url: "/qlkcb/tiep_don/thong_tin_benh_nhan/lay_ds_huyen",
                dataType: 'JSON',
                data: {_token: CSRF_TOKEN, idtinh: id},
                success: function(data){
                    $('#huyen_f option').not("[value='all']").remove();
                    $('#huyen_f').append(data.msg);
                    $("#huyen_f").change();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Không thể lấy danh sách quận - huyện. Lỗi: "+jqXHR+" | "+errorThrown);
                }
            });
        });
        //end Lấy danh sách tỉnh để lọc

        //Lấy danh sách huyện
        $('#huyen').change(function(){
            var id=$(this).val();
            $.ajax({
                type: 'post',
                url: "/qlkcb/tiep_don/thong_tin_benh_nhan/lay_ds_xa",
                dataType: 'JSON',
                data: {_token: CSRF_TOKEN, idhuyen: id},
                success: function(data){
                    $('#xa').html(data.msg);
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert("Không thể lấy danh sách xã - phường. Lỗi: "+jqXHR+" | "+errorThrown);
                }
            });
        });
        //end Lấy danh sách huyện
        
        //Lấy danh sách huyện
        $('#huyen_f').change(function(){
            var id=$(this).val();
            $.ajax({
                type: 'post',
                url: "/qlkcb/tiep_don/thong_tin_benh_nhan/lay_ds_xa",
                dataType: 'JSON',
                data: {_token: CSRF_TOKEN, idhuyen: id},
                success: function(data){
                    $('#xa_f option').not("[value='all']").remove();
                    $('#xa_f').append(data.msg);
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert("Không thể lấy danh sách xã - phường. Lỗi: "+jqXHR+" | "+errorThrown);
                }
            });
        });
        //end Lấy danh sách huyện để loc
        
        //Submit thêm mới bệnh nhân
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var hoten=$('#hoten').val(), ngaysinh=$('#ngaysinh').val(), gt=$('#gt').val(), scmnd=$('#scmnd').val(), sdt=$('#sdt').val(), diachi=$('#diachi').val(), dantoc=$('#dantoc').val(), xa=$('#xa').val();
            if(hoten.toString().trim() == ''){
                alert("Vui lòng nhập thông tin họ tên bệnh nhân!");
                return false;
            }
            else{
                if((scmnd.length > 0 && scmnd.length != 9) || (sdt.length > 0 && sdt.length != 10)){
                    alert("Số chứng minh nhân dân và số điện thoại phải hợp lệ, nhập đúng 9 số chứng minh và 10 số điện thoại!");
                    return false;
                }
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('file', $('#anh')[0].files[0]);
            formData.append('hoten', hoten);
            formData.append('ngaysinh', ngaysinh);
            formData.append('gt', gt);
            formData.append('scmnd', scmnd);
            formData.append('sdt', sdt);
            formData.append('diachi', diachi);
            formData.append('dantoc', dantoc);
            formData.append('xa', xa);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_benh_nhan/them_moi',
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
                    if(data.msg == 'ko_ho_tro_kieu_file'){
                        alert("Thêm bệnh nhân thành công! Upload file thất bại, kiểu file ảnh không được hỗ trợ, kiểu hỗ trợ là file .jpeg, .png, .svg và .jpg!");
                    }
                    else if(data.msg == 'tc'){
                        alert("Thêm bệnh nhân thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);
                        $('#kqtimliem').text("");
                        tk=false;locds=false;keySearch='';
                        $('#btnlocds').attr('data-original-title', 'Lọc danh sách');
                        
                    }
                    else{
                        alert("Thêm bệnh nhân thất bại! Lỗi: "+data.msg);
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
        // end Submit thêm mới bệnh nhân
        
        //Submit cập nhật bệnh nhân
        $('#btncapnhat').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var hoten=$('#hoten').val(), ngaysinh=$('#ngaysinh').val(), gt=$('#gt').val(), scmnd=$('#scmnd').val(), sdt=$('#sdt').val(), diachi=$('#diachi').val(), dantoc=$('#dantoc').val(), xa=$('#xa').val(),id=$(this).attr('data-id');
            if(hoten.toString().trim() == ''){
                alert("Vui lòng nhập thông tin họ tên bệnh nhân!");
                return false;
            }
            else{
                if((scmnd.length > 0 && scmnd.length != 9) || (sdt.length > 0 && sdt.length != 10)){
                    alert("Số chứng minh nhân dân và số điện thoại phải hợp lệ, nhập đúng 9 số chứng minh và 10 số điện thoại!");
                    return false;
                }
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('file', $('#anh')[0].files[0]);
            formData.append('hoten', hoten);
            formData.append('ngaysinh', ngaysinh);
            formData.append('gt', gt);
            formData.append('scmnd', scmnd);
            formData.append('sdt', sdt);
            formData.append('diachi', diachi);
            formData.append('dantoc', dantoc);
            formData.append('xa', xa);
            formData.append('id', id);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_benh_nhan/cap_nhat',
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
                    if(data.msg == 'ko_ho_tro_kieu_file'){
                        alert("Cập nhật thông tin bệnh nhân thành công! Upload file thất bại, kiểu file ảnh không được hỗ trợ, kiểu hỗ trợ là file .jpeg, .png, .svg và .jpg!");
                    }
                    else if(data.msg == 'tc'){
                        alert("Cập nhật thông tin bệnh nhân thành công!");
                    }
                    else{
                        alert("Cập nhật thông tin bệnh nhân thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin bệnh nhân thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin bệnh nhân thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin bệnh nhân thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật bệnh nhân
        
        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formbn').slideUp(800);
        });
        //end đóng form nhập liệu
        //
        //mở form để thêm
        $('#btnadd').click(function(){
            $('#btnthemarea').fadeIn(800);
            $('#btnllarea').fadeIn(800);
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('THÊM MỚI THÔNG TIN BỆNH NHÂN');
            $('#btnlamlai').click();
            $("#tinh").change();
            $('html, body').animate({
                scrollTop: $("#formbn").offset().top
            }, 800);
            $('#formbn').slideDown(800);
            
        });
        //end mở form để thêm
        
        //xóa bệnh nhân
        $('#tbl_bn').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin của bệnh nhân "+name+"?");
            if(cf==true){
                if(!$('#btnsuaarea').hasClass('hidden')){//đóng form sửa khi click xóa
                   $('#btndong').click();
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/tiep_don/thong_tin_benh_nhan/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" bệnh nhân được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" bệnh nhân được tìm thấy!");
                                    }
                                }
                            }
                            
                            alert("Xóa thông tin bệnh nhân thành công!");
                        }
                        else{
                            alert("Xóa thông tin bệnh nhân thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin bệnh nhân thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin bệnh nhân thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin bệnh nhân thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa bệnh nhân
        
        //mở form để sửa
        $('#tbl_bn').on('click','button[data-button="sua"]',function(){
            $('#btnthemarea').fadeOut(800);
            $('#btnllarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN BỆNH NHÂN');
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_benh_nhan/lay_tt_cap_nhat',
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
                    $('#hoten').val(data.hoten);$('#ngaysinh').val(data.ngaysinh);$('#gt').val(data.gt);$('#dantoc').val(data.dantoc);$('#scmnd').val(data.scmnd);$('#sdt').val(data.sdt);$('#diachi').val(data.diachi);$('#tinh').html(data.t);$('#huyen').html(data.h);$('#xa').html(data.x);
                    
                    $('#formbn').slideDown(800);
                    $('html, body').animate({
                        scrollTop: $("#formbn").offset().top
                    }, 800);
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
                url: '/qlkcb/tiep_don/thong_tin_benh_nhan/tim_kiem',
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
                            var ttbn='';
                            for(var i=0; i<data.benhnhan.length; ++i){
                                var anh='';
                                if(data.benhnhan[i].anh == null){
                                    anh='Chưa cập nhật!';
                                }
                                else{
                                    anh='<img class="avatar" src="public/upload/anhbn/'+data.benhnhan[i].anh+'" alt="Ảnh bệnh nhân" style="height: 45px; width: 45px">';
                                }
                                ttbn+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.benhnhan[i].id+'" data-name="'+data.benhnhan[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.benhnhan[i].hoten+'</td>\n\
                                    <td>'+data.benhnhan[i].ngaysinh+'</td>\n\
                                    <td>'+data.benhnhan[i].gt+'</td>\n\
                                    <td>'+data.benhnhan[i].tuoi+'</td>\n\
                                    <td>'+data.benhnhan[i].scmnd+'</td>\n\
                                    <td>'+data.benhnhan[i].sdt+'</td>\n\
                                    <td>'+data.benhnhan[i].diachi+'</td>\n\
                                    <td>'+data.benhnhan[i].dantoc+'</td>\n\
                                    <td style="width: 100px ;">'+anh+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.benhnhan[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.benhnhan[i].id+'" data-name="'+data.benhnhan[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';


                            }

                            $('#tbl_bn').html(ttbn);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                    
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" bệnh nhân được tìm thấy!");
                            $('#btnlocds').attr('data-original-title', 'Lọc danh sách tìm kiếm');
                            
                        }
                        else{
                            $('#tbl_bn').html("");
                            $('#kqtimliem').text("Không có bệnh nhân nào được tìm thấy!");tk=false;
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

        //lọc danh sách
        $('#btnlocds').click(function (){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('dtk', $('#dtk').val());
            formData.append('dantoc', $('#dantoc_f').val());
            formData.append('gt', $('#gt_f').val());
            formData.append('tinh', $('#tinh_f').val());
            formData.append('huyen', $('#huyen_f').val());
            formData.append('xa', $('#xa_f').val());
            
            if(tk == true){
                formData.append('keySearch', keySearch);
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_benh_nhan/loc_ds',
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
                        alert("Lọc danh sách gặp phải lỗi! Mô tả: "+data.msg);
                    }else{
                        if(data.sl > 0){
                            soluongl=data.sl;
                            var ttbn='';
                            for(var i=0; i<data.benhnhan.length; ++i){
                                var anh='';
                                if(data.benhnhan[i].anh == null){
                                    anh='Chưa cập nhật!';
                                }
                                else{
                                    anh='<img class="avatar" src="public/upload/anhbn/'+data.benhnhan[i].anh+'" alt="Ảnh bệnh nhân" style="height: 45px; width: 45px">';
                                }
                                ttbn+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.benhnhan[i].id+'" data-name="'+data.benhnhan[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.benhnhan[i].hoten+'</td>\n\
                                    <td>'+data.benhnhan[i].ngaysinh+'</td>\n\
                                    <td>'+data.benhnhan[i].gt+'</td>\n\
                                    <td>'+data.benhnhan[i].tuoi+'</td>\n\
                                    <td>'+data.benhnhan[i].scmnd+'</td>\n\
                                    <td>'+data.benhnhan[i].sdt+'</td>\n\
                                    <td>'+data.benhnhan[i].diachi+'</td>\n\
                                    <td>'+data.benhnhan[i].dantoc+'</td>\n\
                                    <td style="width: 100px ;">'+anh+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.benhnhan[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.benhnhan[i].id+'" data-name="'+data.benhnhan[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }

                            $('#tbl_bn').html(ttbn);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                            
                            $('#kqtimliem').text("Có "+data.sl+" bệnh nhân được tìm thấy!");locds=true;
                            
                        }
                        else{
                            $('#tbl_bn').html("");
                            $('#kqtimliem').text("Không có bệnh nhân nào được tìm thấy!");locds=false;
                        }
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lọc danh sách thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lọc danh sách thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lọc danh sách thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end lọc danh sách
            
        //Nạp lại danh sách bệnh nhân
        $('#btnnapds').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
 
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_benh_nhan/lay_ds_bn',
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
                        alert("Lỗi khi tải danh sách bệnh nhân! Mô tả: "+data.msg);
                    }else{
                        var ttbn='';
                        for(var i=0; i<data.benhnhan.length; ++i){
                            var anh='';
                            if(data.benhnhan[i].anh == null){
                                anh='Chưa cập nhật!';
                            }
                            else{
                                anh='<img class="avatar" src="public/upload/anhbn/'+data.benhnhan[i].anh+'" alt="Ảnh bệnh nhân" style="height: 45px; width: 45px">';
                            }
                            ttbn+='\n\
                                <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.benhnhan[i].id+'" data-name="'+data.benhnhan[i].hoten+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.benhnhan[i].hoten+'</td>\n\
                                <td>'+data.benhnhan[i].ngaysinh+'</td>\n\
                                <td>'+data.benhnhan[i].gt+'</td>\n\
                                <td>'+data.benhnhan[i].tuoi+'</td>\n\
                                <td>'+data.benhnhan[i].scmnd+'</td>\n\
                                <td>'+data.benhnhan[i].sdt+'</td>\n\
                                <td>'+data.benhnhan[i].diachi+'</td>\n\
                                <td>'+data.benhnhan[i].dantoc+'</td>\n\
                                <td style="width: 100px ;">'+anh+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.benhnhan[i].id+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.benhnhan[i].id+'" data-name="'+data.benhnhan[i].hoten+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }

                        $('#tbl_bn').html(ttbn);
                        $('#tbl_bn button[data-id]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                
                        tk=false;locds=false;keySearch='';
                        $('#kqtimliem').text("");
                        $('#btnlocds').attr('data-original-title', 'Lọc danh sách');
                        
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
        //end Nạp lại danh sách bệnh nhân
        
        //reset input
        $('#btnlamlai').click(function(){
            $('#hoten').val("");$('#scmnd').val("");$('#sdt').val("");$('#diachi').val("");
            var d=new Date();
            var gio=d.getHours();
            var phut=d.getMinutes();
            var giay=d.getSeconds();
            var s = (d.getDate() < 10 ? '0'+d.getDate() : d.getDate())+"/"+((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1))+"/"+d.getFullYear()+" ";
            s += ((gio<10) ? '0' : '') + gio;
            s += ((phut<10) ? ':0' : ':') + phut;
            s += ((giay<10) ? ':0' : ':') + giay;
            $('#ngaysinh').val(s);
            
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
        $('#tbl_bn').on('change', 'input[data-input="check"]', function(){
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
                alert("Bạn chưa chọn bệnh nhân để xóa!");
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của bệnh nhân "+name+"?");
                }
                if(cf==true){
                    if($('#btnsuaarea').css('display') == 'block'){//đóng form sửa khi click xóa
                       $('#btndong').click();
                    }
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/tiep_don/thong_tin_benh_nhan/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" bệnh nhân được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" bệnh nhân được tìm thấy!");
                                            }
                                        }
                                    }

                                    alert("Xóa thông tin các bệnh nhân thành công!");
                                    $('input[data-input="checksum"]').prop("checked",false);
                                    
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" bệnh nhân được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" bệnh nhân được tìm thấy!");
                                        }
                                    }

                                    alert("Xóa thông tin bệnh nhân thành công!");
                                    $('input[data-input="checksum"]').prop("checked",false);
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các bệnh nhân thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin bệnh nhân thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các bệnh nhân thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các bệnh nhân thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các bệnh nhân thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin bệnh nhân thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin bệnh nhân thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin bệnh nhân thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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
        
        $('#scmnd').on('keypress', function (e){
            if($(this).val().toString().length == 9){
                e.preventDefault();
            }
        });
        
        $('#sdt').on('keypress', function (e){
            if($(this).val().toString().length == 10){
                e.preventDefault();
            }
        });
    });
    </script>
@endsection