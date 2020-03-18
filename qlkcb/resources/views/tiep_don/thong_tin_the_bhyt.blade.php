@extends('tiep_don.layout')

@section('title')
    {{ "Thông tin thẻ BHYT" }}
@endsection

@section('css')
<link href="public/css/tempusdominus-bootstrap-4.css" rel="stylesheet" media="all">
@endsection

@section('content')
    <div class="main-content">
            <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
                <!-- THÊM, SỬA THẺ BHYT-->
                <section class="p-t-20 hidden" id="formthebhyt" >
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
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label" id="lblmabn">Mã bệnh nhân (<span class="color-red">*</span>)</label>
                                                                <input type="text" list="dlt_hoten" id="hoten" placeholder="Nhập mã bệnh nhân" class="form-control"/>
                                                                <datalist id="dlt_hoten">
                                                                    @if(isset($dsbn))
                                                                        @foreach($dsbn as $bn)
                                                                        <option value="{{$bn->IdBN}}">{{$bn->HoTen}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </datalist>
                                                                <input type="hidden" id="hoten_hide"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class=" form-control-label" id="lblmt">Mã thẻ (<span class="color-red">*</span>)</label>
                                                                <div class="row">
                                                                    <div class="col-lg-2 m-b-15">
                                                                        <input type="text" list="dlt_doituong" id="doituong" data-toggle="tooltip" title="Mã đối tượng bảo hiểm y tế" class="form-control"/>
                                                                        <datalist id="dlt_doituong">
                                                                            @if(isset($dsdoituong))
                                                                                @foreach($dsdoituong as $dt)
                                                                                <option data-muchuong="<?php echo comm_functions::getMucHuongDTK($dt["id"]); ?>" value="<?php echo $dt["id"]; ?>"><?php echo $dt["name"]; ?></option>
                                                                                @endforeach
                                                                            @endif
                                                                        </datalist>
                                                                    </div> 
                                                                    <div class="col-lg-2 m-b-15">
                                                                        <select data-toggle="tooltip" title="Mã mức hưởng BHYT" class="form-control" id="mmh"/>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </div> 
                                                                    <div class="col-lg-2 m-b-15">
                                                                        <select id="matinh" data-toggle="tooltip" title="Mã tỉnh thành phố" class="form-control"/>
                                                                        @if(isset($dstinh))
                                                                            @foreach($dstinh as $t)
                                                                            <option value="{{$t->IdTinh}}">{{$t->IdTinh}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    </div> 
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" min="0" id="mathe" placeholder="Các ký số tiếp theo" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label" id="lblndk">Nơi đăng ký KCBBĐ (<span class="color-red">*</span>)</label>
                                                                <input type="text" list="dlt_noidkkcbbd" id="noidkkcbbd" placeholder="Nhập nơi đăng ký KCBBĐ" class="form-control"/>
                                                                <datalist id="dlt_noidkkcbbd">
                                                                    @if(isset($dsndkkcbbd))
                                                                        @foreach($dsndkkcbbd as $ndk)
                                                                            <option data-value="{{$ndk->IdCSKBHYT}}">{{$ndk->TenCS}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </datalist>
                                                                <input type="hidden" id="noidkkcbbd_hide">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Giá trị sử dụng từ ngày</label>
                                                                <div class="input-group date" id="datetimepickerngaydk" data-target-input="nearest">
                                                                    <input onkeydown="return false" type="text" id="ngaydk" class="form-control datetimepicker-input" data-target="#datetimepickerngaydk" />
                                                                    <div class="input-group-append" data-target="#datetimepickerngaydk" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Giá trị sử dụng đến ngày</label>
                                                                <div class="input-group date" id="dtpngayhh" data-target-input="nearest">
                                                                    <input onkeydown="return false" type="text" id="ngayhhsd" class="form-control datetimepicker-input" data-target="#dtpngayhh" />
                                                                    <div class="input-group-append" data-target="#dtpngayhh" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Thời gian đủ 5 năm liên tục từ ngày</label>
                                                                <div class="input-group date" id="datetimepickerngayhh" data-target-input="nearest">
                                                                    <input onkeydown="return false" type="text" id="ngayhh" class="form-control datetimepicker-input" data-target="#datetimepickerngayhh" />
                                                                    <div class="input-group-append" data-target="#datetimepickerngayhh" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Đối tượng BHYT</label>
                                                                <input type="text" readonly="" id="dt" class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">M.hưởng</label>
                                                                <input type="text" readonly="" id="mh" class="form-control"/>
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
                <!-- END THÊM, SỬA THẺ BHYT-->
                
                 <!--DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH THẺ BHYT</h3>
                                    <hr class="line-seprate">
                                </div>
                                
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light width-230px m-b-15">
                                            <select class="js-select2" id="hoten_f">
                                                <option value="all">Tất cả bệnh nhân</option>
                                                @if(isset($thebhyt))
                                                    @foreach($thebhyt as $t)
                                                    <option value="<?php echo $t->benhNhan->IdBN; ?>"><?php echo $t->benhNhan->HoTen; ?></option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-400px m-b-15">
                                            <select class="js-select2" id="noidkkcbbd_f">
                                                <option value="all">Tất cả nơi đăng ký khám chữa bệnh ban đầu</option>
                                                @if(isset($dsndkkcbbd))
                                                    @foreach($dsndkkcbbd as $ndk)
                                                        <option value="{{$ndk->IdCSKBHYT}}">{{$ndk->TenCS}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-320px m-b-15">
                                            <select class="js-select2" id="dtk_f">
                                                <option value="all">Tất cả đối tượng bảo hiểm y tế</option>
                                                @if(isset($dsdoituong))
                                                    @foreach($dsdoituong as $dt)
                                                    <option value="<?php echo $dt["id"]; ?>"><?php echo $dt["name"]; ?></option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Lọc danh sách" id="btnlocds">
                                            <i class="fa fa-filter"></i></button>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <div class="row">
                                            <div class="col-lg-4 m-b-15">
                                                <button type="button"  class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="zmdi zmdi-card-sim"></i></button>
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
                                                <th style="position: sticky; top: 0; z-index: 99;">Bệnh nhân</th>
                                                <th>Mã thẻ</th>
                                                <th>nơi đăng ký KCBBĐ</th>
                                                <th>Giá trị sử dụng từ ngày</th>
                                                <th>Giá trị sử dụng đến ngày</th>
                                                <th>TG đủ 5 năm LT từ ngày</th>
                                                <th>Đối tượng BHYT</th>
                                                <th>Mức hưởng</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_thebhyt">
                                            @if(isset($thebhyt))
                                                @foreach($thebhyt as $t)
                                                    <tr class="tr-shadow">
                                                        <td style="vertical-align: middle;">
                                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                                <input type="checkbox" data-input="check" data-id="{{ $t->IdTheBHYT }}" data-name="<?php echo $t->benhNhan->HoTen; ?>">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td data-idbn="<?php echo $t->benhNhan->IdBN; ?>"><?php echo $t->benhNhan->HoTen; ?></td>
                                                        <td><?php echo substr($t->IdTheBHYT, 0, 2)." ".substr($t->IdTheBHYT, 2, 1)." ".substr($t->IdTheBHYT, 3, 2)." ".substr($t->IdTheBHYT, 5, 10); ?></td>
                                                        <td><?php echo $t->coSoKhamBHYT->TenCS; ?></td>
                                                        <td>
                                                            <?php
                                                                echo date( "d/m/Y", strtotime($t->NgayDK));  
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                echo date( "d/m/Y", strtotime($t->NgayHHDT));
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                echo date( "d/m/Y", strtotime($t->NgayHH));
                                                            ?>
                                                        </td>
                                                        <td><?php echo \comm_functions::getDTK($t->DoiTuongBHYT); ?>
                                                        <td>{{ $t->BHYTHoTro.'%' }}</td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{$t->IdTheBHYT}}">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{$t->IdTheBHYT}}" data-name="<?php echo $t->benhNhan->HoTen; ?>">
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
        //khởi tạo flag
        var soluongl=0, locds=false, dtbhyt=false, noidkk=false, htbn=false;
        //end
        
        if ($("#datetimepickerngaydk").length) {
            $('#datetimepickerngaydk').datetimepicker({
                icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                format: 'DD/MM/YYYY'

            });
            $("#datetimepickerngaydk").on("change.datetimepicker", function(e) {
                $('#datetimepickerngayhh').datetimepicker('minDate', e.date);
                $('#dtpngayhh').datetimepicker('minDate', e.date);
            });
        }
        
        if ($("#dtpngayhh").length) {
            $('#dtpngayhh').datetimepicker({
                icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                format: 'DD/MM/YYYY'

            });
            $("#datetimepickerngaydk").on("change.datetimepicker", function(e) {
                $('#datetimepickerngayhh').datetimepicker('minDate', e.date);
            });
        }
        
        if ($("#datetimepickerngayhh").length) {
            $('#datetimepickerngayhh').datetimepicker({
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
        
        $('#ngaydk').on('input', function (e){
           $('#datetimepickerngaydk').datetimepicker('minDate', '01/01/1900 00:00'); 
           $('#datetimepickerngaydk').datetimepicker('maxDate', new Date()); 
           
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

        //Đăng ký với kênh TheBHYT đã tạo trong file TheBHYT.php
        var channel = pusher.subscribe('TheBHYT');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var ttthe='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.thebhyt.id+'" data-name="'+data.thebhyt.hoten+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td data-idbn="'+data.thebhyt.idbn+'">'+data.thebhyt.hoten+'</td>\n\
                        <td>'+data.thebhyt.id.toString().substring(0,2)+' '+data.thebhyt.id.toString().substring(2,3)+' '+data.thebhyt.id.toString().substring(3,5)+' '+data.thebhyt.id.toString().substring(5,15)+'</td>\n\
                        <td>'+data.thebhyt.ndk+'</td>\n\
                        <td>'+data.thebhyt.ngaydk+'</td>\n\
                        <td>'+data.thebhyt.ngayhhsd+'</td>\n\
                        <td>'+data.thebhyt.ngayhh+'</td>\n\
                        <td>'+data.thebhyt.doituong+'</td>\n\
                        <td>'+data.thebhyt.muchuong+'%</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.thebhyt.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.thebhyt.id+'" data-name="'+data.thebhyt.hoten+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    ttthe+='<tr class="spacer"></tr>';
                    $('#tbl_thebhyt').prepend(ttthe);
                    var bn='<option value="'+data.thebhyt.idbn+'">'+data.thebhyt.hoten+'</option>';
                    $(bn).insertAfter('#hoten_f option[value="all"]');
                }
                else{
                    
                    $('#tbl_thebhyt tr').has('td div button[data-id="'+data.thebhyt.id+'"]').replaceWith(ttthe);
                }
                
                $('button[data-id="'+data.thebhyt.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isPlainObject(data.thebhyt[0])){
                    
                    //convert object to array
                    var t = data.thebhyt;
                    var keys = Object.keys(t);
                    var values = keys.map(function(key) {
                      return t[key];
                    });
                    for (var i = 0; i < values.length; i++) {
                        $('#tbl_thebhyt tr').has('td div button[data-id="'+values[i]['idthe']+'"]').next('tr.spacer').remove();
                        $('#tbl_thebhyt tr').has('td div button[data-id="'+values[i]['idthe']+'"]').remove();
                        $('#hoten_f option[value="'+values[i]['idbn']+'"]').remove();
                    }

                }
                else{
                    $('#tbl_thebhyt tr').has('td div button[data-id="'+data.thebhyt['idthe']+'"]').next('tr.spacer').remove();
                    $('#tbl_thebhyt tr').has('td div button[data-id="'+data.thebhyt['idthe']+'"]').remove();
                    $('#hoten_f option[value="'+data.thebhyt['idbn']+'"]').remove();
                }
            }
        }
        
        //Bind một function laytt với sự kiện TheBHYT.php
        channel.bind('App\\Events\\TiepDon\\TheBHYT', laytt);
        //end xử lý channel

        //Nếu có thay đổi các thông tin liên quan đến bệnh nhân thông tin trên view hiện tại sẽ thay đổi
        //Đăng ký với kênh BenhNhan đã tạo trong file BenhNhan.php
        var channel1 = pusher.subscribe('BenhNhan');
        function changeData(data) {
            if(data.thaotac == 'them'){
                var bn='<option value="'+data.benhnhan.id+'">'+data.benhnhan.hoten+'</option>';
                $('#dlt_hoten').prepend(bn);
            }
            else if(data.thaotac == 'sua'){
                var bn='<option value="'+data.benhnhan.id+'">'+data.benhnhan.hoten+'</option>';
                $('#dlt_hoten option[value="'+data.benhnhan.id+'"]').replaceWith(bn);
                $('#tbl_thebhyt tr td[data-idbn="'+data.benhnhan.id+'"]').text(data.benhnhan.hoten);
            }
            else
            {
                if($.isArray(data.benhnhan)){
                    for (var i = 0; i < data.benhnhan.length; i++) {
                        $('#dlt_hoten option[value="'+data.benhnhan[i]+'"]').remove();
                        $('#tbl_thebhyt tr').has('td[data-idbn="'+data.benhnhan[i]+'"]').remove();
                    }
                }
                else{
                    $('#dlt_hoten option[value="'+data.benhnhan+'"]').remove();
                    $('#tbl_thebhyt tr').has('td[data-idbn="'+data.benhnhan+'"]').remove();
                }  
            }
        }
        
        //Bind một function changeData với sự kiện BenhNhan.php
        channel1.bind('App\\Events\\TiepDon\\BenhNhan', changeData);
        //end xử lý channel
        
        //Submit thêm mới thẻ bhyt
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var hoten=$('#hoten_hide').val(), mathe=$('#mathe').val(), ndk=$('#noidkkcbbd_hide').val(), ngaydk=$('#ngaydk').val(), ngayhhsd=$('#ngayhhsd').val(), ngayhh=$('#ngayhh').val(), dt=$('#doituong').val(), label_bdk=$('#noidkkcbbd').val(), label_ht=$('#hoten').val(),mmh=$('#mmh').val(), matinh=$('#matinh').val();
            
            if(label_ht.toString().trim() == '' || dt.toString().trim() == '' || mathe.length == 0 || label_bdk.toString().trim() == '' || mmh.toString().trim() == '' || matinh.toString().trim() == ''){
                alert("Vui lòng nhập thông tin họ tên, mã thẻ BHYT (nhập đầy đủ và chính xác) và nơi đăng ký khám chữa bệnh ban đầu của thẻ!");
                return false;
            }
            else{
                if(dtbhyt == false || noidkk == false || htbn == false)
                {
                    alert("Vui lòng nhập chính xác thông tin họ tên bệnh nhân, mã thẻ BHYT và nơi đăng ký khám chữa bệnh ban đầu!");
                    return false;
                }
                else{
                    if(mathe.length != 10){
                        alert("Mã thẻ phải hợp lệ, nhập đúng 10 số cuối!");
                        return false;
                    }
                }
            }
            var time1=ngaydk.toString().split('/');
            var time2=ngayhh.toString().split('/');
            var time3=ngayhhsd.toString().split('/');
            
            if(parseInt(time2[2]) < parseInt(time1[2]) || parseInt(time3[2]) < parseInt(time1[2])){
                
                alert('Giá trị sử dụng thẻ và thời gian đủ 5 năm liên tục không thẻ nhỏ hơn thời gian bắt đầu sử dụng!');
                return false;
            }
            else{
                if((parseInt(time2[1]) < parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])) || (parseInt(time3[1]) < parseInt(time1[1]) && parseInt(time3[2]) == parseInt(time1[2]))){
                    alert('Giá trị sử dụng thẻ và thời gian đủ 5 năm liên tục không thẻ nhỏ hơn thời gian bắt đầu sử dụng!');
                    return false;
                }
                else{
                    if((parseInt(time2[0]) < parseInt(time1[0]) && parseInt(time2[1]) == parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])) || (parseInt(time3[0]) < parseInt(time1[0]) && parseInt(time3[1]) == parseInt(time1[1]) && parseInt(time3[2]) == parseInt(time1[2]))){
                        alert('Giá trị sử dụng thẻ và thời gian đủ 5 năm liên tục không thẻ nhỏ hơn thời gian bắt đầu sử dụng!');
                        return false;
                    }
                }
            }
            
            if(parseInt(time3[2]) > parseInt(time2[2])){
                alert('Thời gian đủ 5 năm liên tục không thẻ nhỏ hơn giá trị sử dụng của thẻ!');
                return false;
            }
            else{
                if(parseInt(time3[1]) > parseInt(time2[1]) && parseInt(time3[2]) == parseInt(time2[2])){
                    alert('Thời gian đủ 5 năm liên tục không thẻ nhỏ hơn giá trị sử dụng của thẻ!');
                    return false;
                }
                else{
                    if(parseInt(time3[0]) > parseInt(time2[0]) && parseInt(time3[1]) == parseInt(time2[1]) && parseInt(time3[2]) == parseInt(time2[2])){
                        alert('Thời gian đủ 5 năm liên tục không thẻ nhỏ hơn giá trị sử dụng của thẻ');
                        return false;
                    }
                }
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('hoten', hoten);
            formData.append('ngaydk', ngaydk);
            formData.append('ngayhh', ngayhh);
            formData.append('ngayhhsd', ngayhhsd);
            formData.append('mathe', mathe);
            formData.append('ndk', ndk);
            formData.append('dt', dt);
            formData.append('mmh', mmh);
            formData.append('mt', matinh);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_the_bhyt/them_moi',
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
                        alert("Thêm thẻ BHYT thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);
                        $('#kqtimliem').text("");
                        locds=false;
                    }
                    else if(data.msg == 'tontai')
                    {
                        alert("Bệnh nhân đã có thẻ hoặc mã thẻ đã bị trùng!");
                    }
                    else{
                        alert("Thêm thẻ BHYT thất bại! Lỗi: "+data.msg);
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
        // end Submit thêm mới thẻ bhyt
        
        //Submit cập nhật thẻ bhyt
        $('#btncapnhat').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var ngaydk=$('#ngaydk').val(), ngayhh=$('#ngayhh').val(), ngayhhsd=$('#ngayhhsd').val(), dt=$('#doituong').val(),id=$(this).attr('data-id');
            
            var time1=ngaydk.toString().split('/');
            var time2=ngayhh.toString().split('/');
            var time3=ngayhhsd.toString().split('/');
            
            if(parseInt(time2[2]) < parseInt(time1[2]) || parseInt(time3[2]) < parseInt(time1[2])){
                
                alert('Giá trị sử dụng thẻ và thời gian đủ 5 năm liên tục không thẻ nhỏ hơn thời gian bắt đầu sử dụng!');
                return false;
            }
            else{
                if((parseInt(time2[1]) < parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])) || (parseInt(time3[1]) < parseInt(time1[1]) && parseInt(time3[2]) == parseInt(time1[2]))){
                    alert('Giá trị sử dụng thẻ và thời gian đủ 5 năm liên tục không thẻ nhỏ hơn thời gian bắt đầu sử dụng!');
                    return false;
                }
                else{
                    if((parseInt(time2[0]) < parseInt(time1[0]) && parseInt(time2[1]) == parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])) || (parseInt(time3[0]) < parseInt(time1[0]) && parseInt(time3[1]) == parseInt(time1[1]) && parseInt(time3[2]) == parseInt(time1[2]))){
                        alert('Giá trị sử dụng thẻ và thời gian đủ 5 năm liên tục không thẻ nhỏ hơn thời gian bắt đầu sử dụng!');
                        return false;
                    }
                }
            }
            
            if(parseInt(time3[2]) > parseInt(time2[2])){
                alert('Thời gian đủ 5 năm liên tục không thẻ nhỏ hơn giá trị sử dụng của thẻ!');
                return false;
            }
            else{
                if(parseInt(time3[1]) > parseInt(time2[1]) && parseInt(time3[2]) == parseInt(time2[2])){
                    alert('Thời gian đủ 5 năm liên tục không thẻ nhỏ hơn giá trị sử dụng của thẻ!');
                    return false;
                }
                else{
                    if(parseInt(time3[0]) > parseInt(time2[0]) && parseInt(time3[1]) == parseInt(time2[1]) && parseInt(time3[2]) == parseInt(time2[2])){
                        alert('Thời gian đủ 5 năm liên tục không thẻ nhỏ hơn giá trị sử dụng của thẻ');
                        return false;
                    }
                }
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('ngaydk', ngaydk);
            formData.append('ngayhh', ngayhh);
            formData.append('ngayhhsd', ngayhhsd);
            formData.append('dt', dt);
            formData.append('id', id);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_the_bhyt/cap_nhat',
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
                        alert("Cập nhật thông tin thẻ BHYT thành công!");
                    }
                    else{
                        alert("Cập nhật thông tin thẻ BHYT thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin thẻ BHYT thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin thẻ BHYT thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin thẻ BHYT thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật thẻ bhyt
        
        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formthebhyt').slideUp(800);
        });
        //end đóng form nhập liệu
        
        //mở form để thêm
        $('#btnadd').click(function(){
            $('#btnthemarea').fadeIn(800);
            $('#btnllarea').fadeIn(800);
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('THÊM MỚI THÔNG TIN THẺ BHYT');
            $('#lblmabn').html('Họ tên bệnh nhân (<span class="color-red">*</span>)');
            $('#lblndk').html('Nơi đăng ký KCBBĐ (<span class="color-red">*</span>)');
            $('#lblmt').html('Mã thẻ (<span class="color-red">*</span>)');
            $('#dt').val('');
            $('#mh').val('');
            $('#btnlamlai').click();
            $('#hoten').removeAttr('readonly');$('#mathe').removeAttr('readonly');$('#noidkkcbbd').removeAttr('readonly','');$('#doituong').removeAttr('readonly');$('#mmh').removeAttr('disabled');$('#matinh').removeAttr('disabled');
            $('html, body').animate({
                scrollTop: $("#formthebhyt").offset().top
            }, 800);
            $('#formthebhyt').slideDown(800);
        });
        //end mở form để thêm
        
        //xóa thẻ bhyt
        $('#tbl_thebhyt').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin thẻ bhyt của bệnh nhân "+name+"?");
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
                    url: '/qlkcb/tiep_don/thong_tin_the_bhyt/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" thẻ BHYT được tìm thấy!");
                                }
                            }
                            alert("Xóa thông tin thẻ BHYT thành công!");
                        }
                        else{
                            alert("Xóa thông tin thẻ BHYT thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin thẻ BHYT thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin thẻ BHYT thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin thẻ BHYT thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa thẻ bhyt
        
        //mở form để sửa
        $('#tbl_thebhyt').on('click','button[data-button="sua"]',function(){
            $('#btnthemarea').fadeOut(800);
            $('#btnllarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN THẺ BHYT');
            $('#lblmabn').text('Họ tên bệnh nhân');
            $('#lblndk').text('Nơi đăng ký KCBBĐ');
            $('#lblmt').text('Mã thẻ');
            
            $('#hoten').attr('readonly','');$('#mathe').attr('readonly','');$('#noidkkcbbd').attr('readonly','');$('#doituong').attr('readonly','');$('#mmh').attr('disabled','');$('#matinh').attr('disabled','');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_the_bhyt/lay_tt_cap_nhat',
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
                    $('#hoten').val(data.hoten);$('#mmh').val(data.mathe.toString().substring(2,3));$('#matinh').val(data.mathe.toString().substring(3,5));$('#mathe').val(data.mathe.toString().substring(5,15));$('#ngaydk').val(data.ngaydk);$('#ngayhh').val(data.ngayhh);$('#ngayhhsd').val(data.ngayhhsd);$('#noidkkcbbd').val(data.ndk);$('#doituong').val(data.dt);$('#dt').val($('#dlt_doituong option[value="'+data.dt+'"]').text());$('#mh').val(data.mh+'%');
                    
                    $('#formthebhyt').slideDown(800);
                    $('html, body').animate({
                        scrollTop: $("#formthebhyt").offset().top
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
        
        //lọc danh sách
        $('#btnlocds').click(function (){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('hoten', $('#hoten_f').val());
            formData.append('ndk', $('#noidkkcbbd_f').val());
            formData.append('dt', $('#dtk_f').val());
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_the_bhyt/loc_ds',
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
                            var ttthe='';
                            for(var i=0; i<data.thebhyt.length; ++i){
                                
                                ttthe+='\n\
                                    <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.thebhyt[i].id+'" data-name="'+data.thebhyt[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td data-idbn="'+data.thebhyt[i].idbn+'">'+data.thebhyt[i].hoten+'</td>\n\
                                    <td>'+data.thebhyt[i].id.toString().substring(0,2)+' '+data.thebhyt[i].id.toString().substring(2,3)+' '+data.thebhyt[i].id.toString().substring(3,5)+' '+data.thebhyt[i].id.toString().substring(5,15)+'</td>\n\
                                    <td>'+data.thebhyt[i].ndk+'</td>\n\
                                    <td>'+data.thebhyt[i].ngaydk+'</td>\n\
                                    <td>'+data.thebhyt[i].ngayhhsd+'</td>\n\
                                    <td>'+data.thebhyt[i].ngayhh+'</td>\n\
                                    <td>'+data.thebhyt[i].doituong+'</td>\n\
                                    <td>'+data.thebhyt[i].muchuong+'%</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.thebhyt[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.thebhyt[i].id+'" data-name="'+data.thebhyt[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }

                            $('#tbl_thebhyt').html(ttthe);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                            
                            $('#kqtimliem').text("Có "+data.sl+" thẻ BHYT được tìm thấy!");locds=true;
                            
                        }
                        else{
                            $('#tbl_thebhyt').html("");
                            $('#kqtimliem').text("Không có thẻ BHYT nào được tìm thấy!");locds=false;
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
            
        //Nạp lại danh sách thẻ bhyt
        $('#btnnapds').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
 
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/tiep_don/thong_tin_the_bhyt/lay_ds_the_bhyt',
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
                        alert("Lỗi khi tải danh sách thẻ bhyt! Mô tả: "+data.msg);
                    }else{
                        var ttthe='';
                        for(var i=0; i<data.thebhyt.length; ++i){
                            
                            ttthe+='\n\
                                <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.thebhyt[i].id+'" data-name="'+data.thebhyt[i].hoten+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td data-idbn="'+data.thebhyt[i].idbn+'">'+data.thebhyt[i].hoten+'</td>\n\
                                <td>'+data.thebhyt[i].id.toString().substring(0,2)+' '+data.thebhyt[i].id.toString().substring(2,3)+' '+data.thebhyt[i].id.toString().substring(3,5)+' '+data.thebhyt[i].id.toString().substring(5,15)+'</td>\n\
                                <td>'+data.thebhyt[i].ndk+'</td>\n\
                                <td>'+data.thebhyt[i].ngaydk+'</td>\n\
                                <td>'+data.thebhyt[i].ngayhhsd+'</td>\n\
                                <td>'+data.thebhyt[i].ngayhh+'</td>\n\
                                <td>'+data.thebhyt[i].doituong+'</td>\n\
                                <td>'+data.thebhyt[i].muchuong+'%</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.thebhyt[i].id+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.thebhyt[i].id+'" data-name="'+data.thebhyt[i].hoten+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }

                        $('#tbl_thebhyt').html(ttthe);
                        $('#tbl_thebhyt button[data-id]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                
                        locds=false;
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
        //end Nạp lại danh sách thẻ bhyt
        
        //reset input
        $('#btnlamlai').click(function(){
            $('#hoten').val('');$('#mathe').val('');$('#noidkkcbbd').val('');$('#doituong').val('');
            var d=new Date();
            var s = (d.getDate() < 10 ? '0'+d.getDate() : d.getDate())+"/"+((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1))+"/"+d.getFullYear()+" ";
            $('#ngaydk').val(s);$('#ngayhh').val(s);$('#ngayhhsd').val(s);
            
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
        $('#tbl_thebhyt').on('change', 'input[data-input="check"]', function(){
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
                alert("Bạn chưa chọn thẻ BHYT để xóa!");
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin thẻ BHYT của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin thẻ BHYT của bệnh nhân "+name+"?");
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
                        url: '/qlkcb/tiep_don/thong_tin_the_bhyt/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" thẻ BHYT được tìm thấy!");
                                        }
                                    }
                                    alert("Xóa thông tin các thẻ BHYT thành công!");
                                    $('input[data-input="checksum"]').prop("checked",false);
                                    
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" thẻ BHYT được tìm thấy!");
                                    }
                                    alert("Xóa thông tin thẻ BHYT thành công!");
                                    $('input[data-input="checksum"]').prop("checked",false);
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các thẻ BHYT thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin thẻ BHYT thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các thẻ BHYT thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các thẻ BHYT thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các thẻ BHYT thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin thẻ BHYT thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin thẻ BHYT thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin thẻ BHYT thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }
            }
        });
        //end
        
        //xử lý lấy phần text cho datalist đối tượng bhyt
        document.querySelector('input[list="dlt_doituong"]').addEventListener('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];

                if(option.value === inputValue) {
                    dtbhyt=true;
                    $('#dt').val(option.innerText);
                    $('#mh').val(option.getAttribute('data-muchuong')+'%');
                    break;
                }
                else{
                    dtbhyt=false;
                    $('#dt').val("");
                    $('#mh').val("");
                }
            }
        });
        //end
        
        //xử lý lấy phần text cho datalist nơi đkkcbbđ
        document.querySelector('input[list="dlt_noidkkcbbd"]').addEventListener('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('noidkkcbbd_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];

                if(option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    noidkk=true;
                    break;
                }
                else{
                    noidkk=false;
                }
            }
        });
        //end
        
        //xử lý lấy phần text cho datalist họ tên
        document.querySelector('input[list="dlt_hoten"]').addEventListener('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('hoten_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];

                if(option.value === inputValue || option.innerText === inputValue) {
                    input.value=option.innerText;
                    hiddenInput.value = option.getAttribute('value');
                    htbn=true;
                    break;
                }
                else{
                    htbn=false;
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
        
        $('#mathe').on('keypress', function (e){
            if($(this).val().toString().length == 10){
                e.preventDefault();
            }
        });
    });
    </script>
@endsection