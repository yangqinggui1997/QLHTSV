@extends('hanh_chinh.layout')

@section('title')
    {{ "Thông tin thuốc" }}
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
                <!-- THÊM MỚI THÔNG TIN DƯỢC-->
                <section class="p-t-20 hidden" id="formd" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="formtitle">THÊM THÔNG TIN THUỐC MỚI</h3>
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
                                                                <label class=" form-control-label">Tên thuốc (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập tên thuốc..." class="form-control" id="tenthuoc"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Nhà sản xuất (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập nhà sản xuất..." class="form-control" id="nsx"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Nhà cung ứng (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập nhà cung ứng..." class="form-control" id="ncu"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Ngày sản xuất</label>
                                                                <div class="input-group date" id="dtpngaysx" data-target-input="nearest">
                                                                    <input type="text" onkeydown="return false" id="ngaysx" class="form-control datetimepicker-input" data-target="#dtpngaysx" />
                                                                    <div class="input-group-append" data-target="#dtpngaysx" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Ngày hết hạn</label>
                                                                <div class="input-group date" id="dtpngayhh" data-target-input="nearest">
                                                                    <input type="text" onkeydown="return false" id="ngayhh" class="form-control datetimepicker-input" data-target="#dtpngayhh"/>
                                                                    <div class="input-group-append" data-target="#dtpngayhh" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Số lượng nhập</label>
                                                                <input type="number" min="1" placeholder="VD: 1000" class="form-control" id="sl"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Đơn vị tính</label>
                                                                <select class="form-control" id="dvt">
                                                                    <option value="Hộp">Hộp</option>
                                                                    <option value="Viên">Viên</option>
                                                                    <option value="Vĩ">Vĩ</option>
                                                                    <option value="Tuýp">Tuýp</option>
                                                                    <option value="Ống">Ống</option>
                                                                    <option value="Cái">Cái</option>
                                                                    <option value="Gói">Gói</option>
                                                                    <option value="Miếng">Miếng</option>
                                                                    <option value="Lần">Lần</option>
                                                                    <option value="Bịch">Bịch</option>
                                                                    <option value="Lọ">Lọ</option>
                                                                    <option value="Bình xịt">Bình xịt</option>
                                                                    <option value="Chiếc">Chiếc</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Đơn giá nhập (<span class="color-red">*</span>)</label>
                                                                <input type="number" min="1" placeholder="VD: 25000" class="form-control" id="dgn"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Đơn giá bán (<span class="color-red">*</span>)</label>
                                                                <input type="number" min="1" placeholder="VD: 30000" class="form-control" id="dgb"/>  
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chỉ định bệnh</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <input type="text" class="form-control" id="benh" list="dsbenh" placeholder="Nhập chỉ định đối với các loại bệnh...">
                                                                        <datalist id="dsbenh">
                                                                            @if(isset($dsbenh))
                                                                            @foreach($dsbenh as $benh)
                                                                                <option value="{{$benh->IdBenh}}">{{$benh->TenBenh}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </datalist>
                                                                        <input type="hidden" id="benh_hide">
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class=" form-control-label"></label>
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Thêm chỉ định bệnh" id="btnthemb">
                                                <i class="fa fa-plus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Các bệnh đã chỉ định (<span class="color-red">*</span>)</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <select class="form-control" id="dsbenhc">
                                                                            
                                                                        </select>
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class=" form-control-label"></label>
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px"  data-toggle="tooltip" title="Xóa bệnh này" id="btnxoab">
                                                <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>    
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chống chỉ định (<span class="color-red">*</span>)</label>
                                                                <textarea rows="1" placeholder="Nhập chống chỉ định đối với các đối tượng bệnh, hoặc vi sinh..." class="form-control" id="ccd"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Thành phần hoạt chất (<span class="color-red">*</span>)</label>
                                                                <textarea rows="1" placeholder="Nhập thành phần thuốc..." class="form-control" id="tphc"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Cách dùng</label>
                                                                <select class="form-control" id="pl">
                                                                    <option value="uong">Uống</option>
                                                                    <option value="tiem_chich">Tiêm (chích)</option>
                                                                    <option value="thoi_khi_truyen_hoi">Thỏi khí (truyền hơi)</option>
                                                                    <option value="truyen_dich">Truyền dịch</option>
                                                                    <option value="xit">Xịt</option>
                                                                    <option value="dan">Dán</option>
                                                                    <option value="nho_giot">Nhỏ giọt</option>
                                                                    <option value="boi">Bôi (thoa)</option>
                                                                    <option value="dat">Đặt (để)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Danh mục BHYT</label>
                                                                <select class="form-control" id="dmbhyt">
                                                                    <option value="0">Không</option>
                                                                    <option value="1">Có</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 hidden" id="ptbhytarea">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">% BHYT hỗ trợ (<span class="color-red">*</span>)</label>
                                                                <input type="number" min="1" max="100" placeholder="VD: 100" class="form-control" id="ptbhyt"/>  
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
                <!-- END THÊM MỚI THÔNG TIN DƯỢC-->

                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH THUỐC</h3>
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
                                        <button class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="fa fa-leaf"></i></button>
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
                                                <th style="position: sticky; top: 0; z-index: 99;">Tên thuốc</th>
                                                <th>nhà sản xuất</th>
                                                <th>nhà cung ứng</th>
                                                <th>ngày sản xuất</th>
                                                <th>ngày hết hạn</th>
                                                <th>Số lượng còn</th>
                                                <th>đơn vị tính</th>
                                                <th>đơn giá nhập</th>
                                                <th>đơn giá bán</th>
                                                <th>Danh mục bhyt</th>
                                                <th>% BHYT</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_thuoc">
                                            @if(isset($dsthuoc))
                                            @foreach($dsthuoc as $thuoc)
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $thuoc->IdThuoc }}" data-name="{{ $thuoc->TenThuoc }}">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$thuoc->TenThuoc}}</td>
                                                <td>{{$thuoc->NSX}}</td>
                                                <td>{{$thuoc->NCU}}</td>
                                                <td>{{date('d/m/Y', strtotime($thuoc->NgaySX))}}</td>
                                                <td>{{date('d/m/Y', strtotime($thuoc->NgayHH))}}</td>
                                                <td>{{number_format($thuoc->SL)}}</td>
                                                <td>{{$thuoc->DonViTinh}}</td>
                                                <td>{{number_format($thuoc->DonGiaNhap)}} VNĐ</td>
                                                <td>{{number_format($thuoc->DonGiaBan)}} VNĐ</td>
                                                <td>
                                                    @if($thuoc->DanhMucBHYT == 0)
                                                        Không
                                                    @else
                                                        Có
                                                    @endif
                                                </td>
                                                <td>{{$thuoc->BHYTTT}}%</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{ $thuoc->IdThuoc }}">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{ $thuoc->IdThuoc }}" data-name="{{ $thuoc->TenThuoc}}">
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

        if ($("#dtpngaysx").length) {
            $('#dtpngaysx').datetimepicker({
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
        }
        $('#ngaysx').on('input', function (){
           $('#dtpngaysx').datetimepicker('minDate', '01/01/1900 00:00');
           $('#dtpngaysx').datetimepicker('maxDate', new Date());
        });

        $('#ngayhh').on('input', function (){
           $('#dtpngayhh').datetimepicker('minDate', '01/01/1900 00:00');
           $('#dtpngayhh').datetimepicker('maxDate', new Date());
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
        
        //Đăng ký với kênh Thuoc đã tạo trong file Thuoc.php
        var channel = pusher.subscribe('Thuoc');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var ttt='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.thuoc.id+'" data-name="'+data.thuoc.tenthuoc+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td>'+data.thuoc.tenthuoc+'</td>\n\
                        <td>'+data.thuoc.nsx+'</td>\n\
                        <td>'+data.thuoc.ncu+'</td>\n\
                        <td>'+data.thuoc.ngaysx+'</td>\n\
                        <td>'+data.thuoc.ngayhh+'</td>\n\
                        <td>'+data.thuoc.sl+'</td>\n\
                        <td>'+data.thuoc.dvt+'</td>\n\
                        <td>'+data.thuoc.dgn+'</td>\n\
                        <td>'+data.thuoc.dgb+'</td>\n\
                        <td>'+data.thuoc.dmbhyt+'</td>\n\
                        <td>'+data.thuoc.ptbhyt+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.thuoc.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.thuoc.id+'" data-name="'+data.thuoc.tenthuoc+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    ttt+='<tr class="spacer"></tr>';
                    $('#tbl_thuoc').prepend(ttt);
                }
                else{

                    $('#tbl_thuoc tr').has('td div button[data-id="'+data.thuoc.id+'"]').replaceWith(ttt);
                }

                $('button[data-id="'+data.thuoc.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isArray(data.thuoc)){
                    for (var i = 0; i < data.thuoc.length; i++) {
                        $('#tbl_thuoc tr').has('td div button[data-id="'+data.thuoc[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_thuoc tr').has('td div button[data-id="'+data.thuoc[i]+'"]').remove();

                    }
                }
                else{
                    $('#tbl_thuoc tr').has('td div button[data-id="'+data.thuoc+'"]').next('tr.spacer').remove();
                    $('#tbl_thuoc tr').has('td div button[data-id="'+data.thuoc+'"]').remove();

                }
            }
        }

        //Bind một function laytt với sự kiện Thuoc.php
        channel.bind('App\\Events\\HanhChinh\\Thuoc', laytt);
        //end xử lý channel

        $('#btnthemb').click(function (){
            var flag=false;
            $('#dsbenhc option').each(function(){
                if($(this).attr('value') == $('#benh_hide').val()){
                    flag=true;
                    return false;
                }
            });
            
            $('input[list="dsbenh"]').trigger('input');
            
            if(flag==false && $('#benh_hide').val() != '')
            {
                $('#dsbenhc').prepend('<option value="'+$('#benh_hide').val()+'">'+$('#benh').val()+'</option>');
            }
            
        });
        
        $('#btnxoab').click(function(){
            $('#dsbenhc option[value="'+$('#dsbenhc').val()+'"]').remove();
        });
        
        $('input[list="dsbenh"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('benh_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue ||  option.getAttribute('value') === inputValue) {
                    hiddenInput.value = option.getAttribute('value');
                    input.value=option.innerText;
                    break;
                }
                else{
                    hiddenInput.value='';
                }  
            }
        });
        
        //Submit thêm mới
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
               
            var tenthuoc=$('#tenthuoc').val(), nsx=$('#nsx').val(), ncu=$('#ncu').val(), pl=$('#pl').val(), ngaysx=$('#ngaysx').val(), ngayhh=$('#ngayhh').val(), sl=$('#sl').val(), dvt=$('#dvt').val(), dgn=$('#dgn').val(), dgb=$('#dgb').val(), ccd=$('#ccd').val(), tphc=$('#tphc').val(), dmbhyt=$('#dmbhyt').val(), ptbhyt=$('#ptbhyt').val();

            if(tenthuoc.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên thuốc!");
                return false;
            }
            else if(nsx.toString().trim() == ''){
                alert("Vui lòng nhập tên nhà sản xuất!");
                return false;
            }
            else if(ncu.toString().trim() == ''){
                alert("Vui lòng nhập tên nhà cung ứng!");
                return false;
            }
            else if(sl.toString().trim() == '' || parseInt(sl) == 0){
                alert("Vui lòng nhập số lượng thuốc!");
                return false;
            }
            else if(dgn.toString().trim() == '' || parseInt(dgn) == 0){
                alert("Vui lòng nhập đơn giá nhập!");
                return false;
            }
            else if(dgb.toString().trim() == '' || parseInt(dgb) == 0){
                alert("Vui lòng nhập đơn giá bán!");
                return false;
            }
            else if(ccd.toString().trim() == ''){
                alert("Vui lòng nhập chống chỉ định!");
                return false;
            }
            else if(tphc.toString().trim() == ''){
                alert("Vui lòng nhập thành phần hoạt chất!");
                return false;
            }
            else if(dmbhyt == 1 && (parseInt(ptbhyt) == 0 || ptbhyt.toString().trim() == '')){
                alert("Vui lòng nhập % BHYT hỗ trợ!");
                return false;
            }
            
            if(parseInt(ptbhyt) > 100){
                alert("% BHYT hỗ trợ phải nhỏ hơn hoặc bằng 100!");
                return false;
            }

            if(parseInt(dgn) > parseInt(dgb)){
                alert("Đơn giá bán không thể nhỏ hơn đơn giá nhập!");
                return false;
            }
            
            var time1=ngaysx.toString().split('/');
            var time2=ngayhh.toString().split('/');
            
            if(parseInt(time2[2]) < parseInt(time1[2])){
                
                alert('Thời gian hết hạn sử dụng không thể nhỏ hơn thời gian sản xuất!');
                return false;
            }
            else{
                if(parseInt(time2[1]) < parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                    alert('Thời gian hết hạn sử dụng không thể nhỏ hơn thời gian sản xuất!');
                    return false;
                }
                else{
                    if(parseInt(time2[0]) < parseInt(time1[0]) && parseInt(time2[1]) == parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                        alert('Thời gian hết hạn sử dụng không thể nhỏ hơn thời gian sản xuất!');
                        return false;
                    }
                }
            }
            
            var benh=[];
            $('#dsbenhc option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        benh.push(this.value);
                    }
                });
            });
            
            if(benh.length == 0){
                alert('Vui lòng thêm chỉ định bệnh cho thuốc!');
                return false;
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('tenthuoc', tenthuoc.toString().trim());
            formData.append('benh', benh);
            formData.append('nsx', nsx);
            formData.append('ncu', ncu);
            formData.append('ngaysx', ngaysx);
            formData.append('ngayhh', ngayhh);
            formData.append('sl', sl);
            formData.append('dvt', dvt);
            formData.append('dgn', dgn);
            formData.append('dgb', dgb);
            formData.append('cd', benh);
            formData.append('ccd', ccd);
            formData.append('tphc', tphc);
            formData.append('ngayhh', ngayhh);
            formData.append('pl', pl);
            formData.append('dmbhyt', dmbhyt);
            if(dmbhyt == 1){
                var  ptbhyt=$('#ptbhyt').val();
                formData.append('ptbhyt', ptbhyt);
            }
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_duoc/them_moi',
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
                        alert("Thêm thông tin thuốc mới thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);

                        $('#kqtimliem').text("");
                        tk=false;locds=false;keySearch='';
                    }
                    else if(data.msg == 'trungten'){
                        alert("Tên thuốc này đã được sử dụng!");
                    }
                    else{
                        alert("Thêm thông tin thuốc mới thất bại! Lỗi: "+data.msg);
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
            
            var tenthuoc=$('#tenthuoc').val(), nsx=$('#nsx').val(), ncu=$('#ncu').val(), pl=$('#pl').val(), ngaysx=$('#ngaysx').val(), ngayhh=$('#ngayhh').val(), sl=$('#sl').val(), dvt=$('#dvt').val(), dgn=$('#dgn').val(), dgb=$('#dgb').val(), ccd=$('#ccd').val(), tphc=$('#tphc').val(), dmbhyt=$('#dmbhyt').val(), ptbhyt=$('#ptbhyt').val();

            if(tenthuoc.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên thuốc!");
                return false;
            }
            else if(nsx.toString().trim() == ''){
                alert("Vui lòng nhập tên nhà sản xuất!");
                return false;
            }
            else if(ncu.toString().trim() == ''){
                alert("Vui lòng nhập tên nhà cung ứng!");
                return false;
            }
            else if(sl.toString().trim() == '' || parseInt(sl) == 0){
                alert("Vui lòng nhập số lượng thuốc!");
                return false;
            }
            else if(dgn.toString().trim() == '' || parseInt(dgn) == 0){
                alert("Vui lòng nhập đơn giá nhập!");
                return false;
            }
            else if(dgb.toString().trim() == '' || parseInt(dgb) == 0){
                alert("Vui lòng nhập đơn giá bán!");
                return false;
            }
            else if(ccd.toString().trim() == ''){
                alert("Vui lòng nhập chống chỉ định!");
                return false;
            }
            else if(tphc.toString().trim() == ''){
                alert("Vui lòng nhập thành phần hoạt chất!");
                return false;
            }
            else if(dmbhyt == 1 && (parseInt(ptbhyt) == 0 || ptbhyt.toString().trim() == '')){
                alert("Vui lòng nhập % BHYT hỗ trợ!");
                return false;
            }
            
            if(parseInt(ptbhyt) > 100){
                alert("% BHYT hỗ trợ phải nhỏ hơn hoặc bằng 100!");
                return false;
            }

            if(parseInt(dgn) > parseInt(dgb)){
                alert("Đơn giá bán không thể nhỏ hơn đơn giá nhập!");
                return false;
            }
            
            var time1=ngaysx.toString().split('/');
            var time2=ngayhh.toString().split('/');
            
            if(parseInt(time2[2]) < parseInt(time1[2])){
                
                alert('Thời gian hết hạn sử dụng không thể nhỏ hơn thời gian sản xuất!');
                return false;
            }
            else{
                if(parseInt(time2[1]) < parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                    alert('Thời gian hết hạn sử dụng không thể nhỏ hơn thời gian sản xuất!');
                    return false;
                }
                else{
                    if(parseInt(time2[0]) < parseInt(time1[0]) && parseInt(time2[1]) == parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                        alert('Thời gian hết hạn sử dụng không thể nhỏ hơn thời gian sản xuất!');
                        return false;
                    }
                }
            }
            
            var benh=[];
            $('#dsbenhc option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        benh.push(this.value);
                    }
                });
            });
            
            if(benh.length == 0){
                alert('Vui lòng thêm chỉ định bệnh cho thuốc!');
                return false;
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('tenthuoc', tenthuoc.toString().trim());
            formData.append('benh', benh);
            formData.append('nsx', nsx);
            formData.append('ncu', ncu);
            formData.append('ngaysx', ngaysx);
            formData.append('ngayhh', ngayhh);
            formData.append('sl', sl);
            formData.append('dvt', dvt);
            formData.append('dgn', dgn);
            formData.append('dgb', dgb);
            formData.append('cd', benh);
            formData.append('ccd', ccd);
            formData.append('tphc', tphc);
            formData.append('ngayhh', ngayhh);
            formData.append('pl', pl);
            formData.append('dmbhyt', dmbhyt);
            if(dmbhyt == 1){
                var  ptbhyt=$('#ptbhyt').val();
                formData.append('ptbhyt', ptbhyt);
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_duoc/cap_nhat',
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
                        alert("Cập nhật thông tin thuốc thành công!");
                    }
                    else if(data.msg == 'trungten'){
                        alert("Tên thuốc này đã được sử dụng!");
                    }
                    else{
                        alert("Cập nhật thông tin thuốc thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật

        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formd').slideUp(800);
        });
        //end đóng form nhập liệu
        
        $('#dmbhyt').change(function(){
            if($(this).val() == 1){
                $('#ptbhytarea').fadeIn(800);
            }
            else{
                $('#ptbhytarea').fadeOut(800);
            }
        });
        
        //mở form để thêm
        $('#btnadd').click(function(){
            $('#btnthemarea').fadeIn(800);
            $('#btnlamlaiarea').fadeIn(800);
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('THÊM THÔNG TIN THUỐC MỚI');
            $('#btnlamlai').click();
            $('#formd').slideDown(800);
            $('html, body').animate({
                scrollTop: $("#formd").offset().top
            }, 800);
        });
        //end mở form để thêm

        //xóa
        $('#tbl_thuoc').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin của thuốc "+name+"?");
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
                    url: '/qlkcb/hanh_chinh/quan_ly_duoc/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" tên thuốc được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" tên thuốc được tìm thấy!");
                                    }
                                }
                            }
                            if($('#tbl_thuoc').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            alert("Xóa thông tin thuốc thành công!");
                        }
                        else{
                            alert("Xóa thông tin thuốc thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa 

        //mở form để sửa
        $('#tbl_thuoc').on('click','button[data-button="sua"]',function(){
            $('#btnthemarea').fadeOut(800);
            $('#btnlamlaiarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN THUỐC');

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_duoc/lay_tt_cap_nhat',
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
                        $('#tenthuoc').val(data.tenthuoc); $('#nsx').val(data.nsx); $('#ncu').val(data.ncu); $('#pl').val(data.pl); $('#ngaysx').val(data.ngaysx); $('#ngayhh').val(data.ngayhh); $('#sl').val(data.sl); $('#dvt').val(data.dvt); $('#dgn').val(data.dgn); $('#dgb').val(data.dgb); $('#ccd').val(data.ccd); $('#tphc').val(data.tphc); $('#dmbhyt').val(data.dmbhyt); $('#dmbhyt').trigger('change');$('#ptbhyt').val(data.ptbhyt);

                        $('#dsbenhc').html('');

                        if($.isPlainObject(data.benh[0])){
                            //convert object to array
                            var t = data.benh;
                            var keys = Object.keys(t);
                            var values = keys.map(function(key) {
                              return t[key];
                            });
                            for (var i = 0; i < values.length; i++) {
                                $('#dsbenhc').prepend('<option value="'+values[i]['id']+'">'+values[i]['name']+'</option>');
                            }
                            
                        }
                        
                        $('#formd').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formd").offset().top
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
                url: '/qlkcb/hanh_chinh/quan_ly_duoc/tim_kiem',
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
                            var ttt='';
                            for(var i=0; i<data.thuoc.length; ++i){
                                ttt+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.thuoc[i].id+'" data-name="'+data.thuoc[i].tenthuoc+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td>'+data.thuoc[i].tenthuoc+'</td>\n\
                                        <td>'+data.thuoc[i].nsx+'</td>\n\
                                        <td>'+data.thuoc[i].ncu+'</td>\n\
                                        <td>'+data.thuoc[i].ngaysx+'</td>\n\
                                        <td>'+data.thuoc[i].ngayhh+'</td>\n\
                                        <td>'+data.thuoc[i].sl+'</td>\n\
                                        <td>'+data.thuoc[i].dvt+'</td>\n\
                                        <td>'+data.thuoc[i].dgn+'</td>\n\
                                        <td>'+data.thuoc[i].dgb+'</td>\n\
                                        <td>'+data.thuoc[i].dmbhyt+'</td>\n\
                                        <td>'+data.thuoc[i].ptbhyt+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.thuoc[i].id+'">\n\
                                                    <i class="zmdi zmdi-edit"></i>\n\
                                                </button>\n\
                                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.thuoc[i].id+'" data-name="'+data.thuoc[i].tenthuoc+'">\n\
                                                    <i class="zmdi zmdi-delete"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                            }
                            $('#tbl_thuoc').html(ttt);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'
                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);

                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" tên thuốc được tìm thấy!");
                        }
                        else{
                            $('#tbl_thuoc').html("");
                            $('#kqtimliem').text("Không có tên thuốc nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/hanh_chinh/quan_ly_duoc/lay_ds_thuoc',
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
                        alert("Lỗi khi tải danh sách thuốc! Mô tả: "+data.msg);
                    }else{
                        var ttt='';
                        for(var i=0; i<data.thuoc.length; ++i){
                            ttt+='\n\
                            <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.thuoc[i].id+'" data-name="'+data.thuoc[i].tenthuoc+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.thuoc[i].tenthuoc+'</td>\n\
                                <td>'+data.thuoc[i].nsx+'</td>\n\
                                <td>'+data.thuoc[i].ncu+'</td>\n\
                                <td>'+data.thuoc[i].ngaysx+'</td>\n\
                                <td>'+data.thuoc[i].ngayhh+'</td>\n\
                                <td>'+data.thuoc[i].sl+'</td>\n\
                                <td>'+data.thuoc[i].dvt+'</td>\n\
                                <td>'+data.thuoc[i].dgn+'</td>\n\
                                <td>'+data.thuoc[i].dgb+'</td>\n\
                                <td>'+data.thuoc[i].dmbhyt+'</td>\n\
                                <td>'+data.thuoc[i].ptbhyt+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.thuoc[i].id+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.thuoc[i].id+'" data-name="'+data.thuoc[i].tenthuoc+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }

                        $('#tbl_thuoc').html(ttt);
                        $('#tbl_thuoc button[data-id]').tooltip({
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
            $('#tenthuoc').val(''); $('#nsx').val(''); $('#ncu').val(''); $('#sl').val(''); $('#dgn').val(''); $('#dgb').val(''); $('#ccd').val(''); $('#tphc').val(''); $('#ptbhyt').val('');
            $('#dsbenhc').html('');
            var d=new Date();
            var s = (d.getDate() < 10 ? '0'+d.getDate() : d.getDate())+"/"+((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1))+"/"+d.getFullYear()+" ";
            $('#ngaysx').val(s);$('#ngayhh').val(s);
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
        $('#tbl_thuoc').on('change', 'input[data-input="check"]', function(){
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
                alert("Bạn chưa chọn thuốc để xóa!");
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của các thuốc "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của thuốc "+name+"?");
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
                        url: '/qlkcb/hanh_chinh/quan_ly_duoc/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" tên thuốc được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" tên thuốc được tìm thấy!");
                                            }
                                        }
                                    }
                                    if($('#tbl_thuoc').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các tên thuốc thành công!");
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" tên thuốc được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" tên thuốc được tìm thấy!");
                                        }
                                    }
                                    if($('#tbl_thuoc').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin tên thuốc thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các tên thuốc thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin tên thuốc thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các tên thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các tên thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các tên thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin tên thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin tên thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin tên thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
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
        
        $("#ptbhyt").on("keypress", function (evt) {
            if ($(this).val().toString().length == 3)
            {
                evt.preventDefault();
            }
        });
    });
    </script>
@endsection