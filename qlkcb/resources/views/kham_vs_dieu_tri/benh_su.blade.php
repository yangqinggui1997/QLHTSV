@extends('kham_vs_dieu_tri.layout')

@section('title')
    {{ "Bệnh sử" }}
@endsection

@section('css')
<link href="public/css/tempusdominus-bootstrap-4.css" rel="stylesheet" media="all">
<style type="text/css">
    .padding_adjust_td tr td {
        padding: 5px; padding-top: 2px; padding-bottom: 2px;
    }
    
    textarea {
       resize: none;
    }
</style>
@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
        <input type="hidden" id="khoa_nv" value="{{$nd->nhanVien->phongBan->Khoa->IdKhoa}}">
        <?php $flag=FALSE;?>
        @foreach($nd->capQuyen as $cqnd)
            @if($cqnd->Quyen == 'qlck')
            <input type="hidden" id="quyen_bs" value="TRUE">
            <?php $flag=TRUE; break;?>
            @endif  
        @endforeach
        @if($flag==FALSE)
        <input type="hidden" id="quyen_bs" value="FALSE">
        @endif

        <!-- BỆNH ÁN -->
        <section class="p-t-20 hidden" id="formba">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" m-b-35">
                            <h3 class="title-5 font-weight-bold text-green" id="formtitle">BỆNH ÁN NỘI TRÚ</h3>
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
                                                        <label class=" form-control-label">Họ tên bệnh nhân</label>
                                                        <input type="text" readonly="" class="form-control" id="hoten"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ngày sinh</label>
                                                        <input type="text" readonly="" class="form-control" id="ngaysinh">
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Giới tính</label>
                                                        <input type="text" readonly="" class="form-control" id="gt">
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Dân tộc</label>
                                                        <input type="text" readonly="" class="form-control" id="dantoc">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Số CMND</label>
                                                        <input type="text" readonly="" class="form-control" id="scmnd">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Địa chỉ</label>
                                                        <input type="text" readonly="" class="form-control " id="diachi">
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 text-center">
                                                    <div class="form-group" style="padding-top: 15px;">
                                                        <img class="avatar hidden anhbn" alt="Ảnh bệnh nhân">
                                                        <p class="anhbn">Ảnh bệnh nhân</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15 hidden thearea">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Mã thẻ BHYT</label>
                                                        <input type="tel" readonly="" class="form-control" id="mathe">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">GTSD từ ngày</label>
                                                        <input type="text" readonly="" class="form-control" id="ngaydk">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">TG đủ 5 năm LT từ ngày</label>
                                                        <input type="text" readonly="" class="form-control" id="ngayhh">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Nơi đăng ký KCBBĐ</label>
                                                        <input type="text" readonly="" class="form-control" id="noidkkcbbd">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15 hidden thearea">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Đối tượng BHYT</label>
                                                        <input type="text" readonly="" class="form-control" id="doituong">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">M.hưởng</label>
                                                        <input type="text" readonly="" class="form-control" id="mh">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tuyến</label>
                                                        <input type="text" readonly="" class="form-control" id="tuyen">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2" >
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Chuyển đến từ</label>
                                                        <input type="text" readonly="" class="form-control" id="chuyentu">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Giấy chuyển</label>
                                                        <input type="text" readonly="" class="form-control" id="giaychuyen">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tình trạng lúc nhập viện</label>
                                                        <input type="text" class="form-control" readonly="" id="tinhtrangbn">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">  
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Các bệnh đã chuẩn đoán</label>
                                                        <select class="form-control" id="dschuadoan">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15">
                                                <div class="col-lg-4 hidden" id="lydonvarea">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Lý do nhập viện</label>
                                                        <textarea rows="1" class="form-control" id="lydonv" readonly=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 hidden" id="songaydtarea">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Số ngày điều trị</label>
                                                        <input type="text" class="form-control" readonly="" id="songaydt">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 hidden" id="giuongarea">
                                                    <div class="form-group " >
                                                        <label class=" form-control-label">Giường bệnh số</label>
                                                        <input type="text" class="form-control" readonly="" id="giuong">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4" id="ghichuarea">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ghi chú</label>
                                                        <textarea rows="1" class="form-control" readonly="" id="ghichuba"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15">
                                                <div class="col-lg-1 hidden" id="btnxemctgdarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--showdetail au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Chi tiết các giai đoạn điều trị" id="btnxemctgd"><span class="fa fa-list-alt"></span></button>
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
        <!-- END BỆNH ÁN-->
        
        <!-- DATA TABLE BỆNH ÁN CHI TIẾT-->
        <section class="p-t-20 hidden" id="tblBACT">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" m-b-35">
                            <h3 class="title-5 font-weight-bold text-green">CÁC GIAI ĐOẠN ĐIỀU TRỊ NỘI TRÚ</h3>
                            <hr class="line-seprate">
                        </div>
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                            </div>
                            <div class="table-data__tool-right">
                                <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Đóng danh sách chi tiết" id="btndongdsbact"><i class="fa fa-remove"></i></button>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2 fit_table_height_300 tableFixHead">
                            <table class="table table-data2 table-hover m-b-20 text-center">
                                <thead>
                                    <tr>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>phương pháp điều trị</th>
                                        <th>tình trạng bệnh</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_bact">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END DATA TABLE BỆNH ÁN CHI TIẾT-->

        <!--MODAL XEM KẾT QUẢ CẬN LÂM SÀNG-->
        <div class="modal fade" id="modalcls" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lgest" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Kết quả cận lâm sàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="table-responsive table-responsive-data2 fit_table_height_500 tableFixHead">
                            <table class="table table-data2 table-hover m-b-20 text-center">
                                <thead>
                                    <tr>
                                        <th>Tên cận lâm sàng</th>
                                        <th>Bác sĩ thực hiện CLS</th>
                                        <th>Phòng thực hiện</th>
                                        <th>Ngày thực hiện</th>
                                        <th>Kết quả</th>
                                        <th style="width: 30%;">Kết quả hình ảnh</th>
                                        <th>Kết luận</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_kqcls">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL XEM KẾT QUẢ CẬN LÂM SÀNG-->

        <!--MODAL XEM CHỈ ĐỊNH THỦ THUẬT-->
        <div class="modal fade" id="modalxemthuthuat" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Xem các chỉ định thủ thuật đã ra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class=" m-b-35">
                                            <h5 class="title-5 font-weight-bold text-green font-size-11">DANH SÁCH CÁC CHỈ ĐỊNH</h5>
                                            <hr class="line-seprate">
                                        </div>

                                    </div>
                                    <div class="table-data__tool-right">
                                        
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2 fit_table_height_300 tableFixHead">
                                    <table class="table table-data2 table-hover m-b-20 text-center">
                                        <thead>
                                            <tr>
                                                <th>Tên thủ thuật</th>
                                                <th>Phòng thực hiện</th>
                                                <th>nhân viên thực hiện</th>
                                                <th>Ngày ra chỉ định</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_xemcdtt">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL XEM CHỈ ĐỊNH THỦ THUẬT-->
        
        <!--MODAL XEM CHỈ ĐỊNH PHẪU THUẬT-->
        <div class="modal fade" id="modalxemphauthuat" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Xem chỉ định phẫu thuật đã ra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table-responsive-data2 fit_table_height_300 tableFixHead">
                                    <table class="table table-data2 table-hover m-b-20 text-center">
                                        <thead>
                                            <tr>
                                                <th>Tên phẫu thuật</th>
                                                <th>Phòng thực hiện</th>
                                                <th>Bác sĩ thực hiện chính</th>
                                                <th>Phương pháp thực hiện PT</th>
                                                <th>Ngày ra chỉ định</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_cdpt">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL XEM CHỈ ĐỊNH PHẪU THUẬT-->
        
        <!--MODAL XEM TOA THUỐC ĐIỀU TRỊ-->
        <div class="modal fade" id="modalxemtt" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Xem chi tiết thuốc điều trị</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class=" m-b-20">
                                    <h5 class="title-5 font-weight-bold text-green font-size-11">PHẦN TOA THUỐC</h5>
                                    <hr class="line-seprate">
                                </div>
                                <div class="card">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ghi chú toa thuốc</label>
                                                        <textarea rows="1" id='ghichutoathuoc_xem' class="form-control" readonly=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-data__tool" style="margin-bottom: 0">
                                    <div class="table-data__tool-left">
                                        <div class=" m-b-35">
                                            <h5 class="title-5 font-weight-bold text-green font-size-11">DANH SÁCH THUỐC ĐIỀU TRỊ</h5>
                                            <hr class="line-seprate">
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2 fit_table_height_300 tableFixHead">
                            <table class="table table-data2 table-hover m-b-20 text-center">
                                <thead>
                                    <tr>
                                        <th>Tên thuốc</th>
                                        <th>đơn vị tính</th>
                                        <th>Cách dùng</th>
                                        <th>Liều dùng</th>
                                        <th>tổng số lượng</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_xemtoathuoc">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL XEM TOA THUỐC ĐIỀU TRỊ-->

        <!-- DATA TABLE-->
        <section class="p-t-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" m-b-35">
                            <h3 class="title-5 font-weight-bold text-green" id="formtitledb">XEM BỆNH SỬ CỦA BỆNH NHÂN</h3>
                            <hr class="line-seprate">
                        </div>

                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="au-breadcrumb-content">
                                    <form class="au-form-icon--sm" id="ftimkiem" >
                                        <input type="text" class="au-input--w300 au-input--style2" id="txttimkiem" placeholder="Nhập họ tên bệnh nhân..." list="dsbn">
                                        <datalist id="dsbn">
                                            @if(isset($dsbn))
                                                @foreach($dsbn as $bn)
                                            <option data-value="{{$bn->IdBN}}">{{$bn->HoTen}}</option>
                                                @endforeach
                                            @endif
                                        </datalist>
                                        <input type="hidden" id="bn_hide">
                                        <button type="button" class="au-btn--submit2" data-toggle="tooltip" title="Xem bệnh sử" id="btntimkiem">
                                            <i class="zmdi zmdi-eye"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <button type="button" class="au-btn au-btn--green au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Làm lại" id="btnlamlai"><i class="fa fa-refresh"></i></button>
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
                                        <th>Đối tượng tiếp nhận</th>
                                        <th>Khoa điều trị</th>
                                        <th>Bác sĩ điều trị</th>
                                        <th>Chuẩn đoán</th>
                                        <th>Hình thức điều trị</th>
                                        <th>ngày tiếp nhận điều trị</th>
                                        <th>Số ngày điều trị</th>
                                        <th>Trạng thái điều trị</th>
                                        <th>thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_ba">
                                    
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
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false, htbn=false, bnddd=false, themba=false, flagcls=false, flagtt=false, flagpt=false, file_name_tt='', tstrangtt = 1, dskham='', giuongc='', flagbn=false;
        //end
        
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
        
        var audiotk='';
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
                    audiotk.pause();
                }
            });
        });

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
                    if(data.dvb.pl == 'grv'){
                        if($('#tb_bc').hasClass('hidden')){
                            $('#tb_bc').removeClass('hidden');

                            var tb='<div class="rs-select2--light _'+data.dvb.id+'">\n\
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">\n\
                                    <span class="badge badge-pill badge-success">Thông báo!</span> Giấy ra viện ['+data.dvb.cd+'] đã được duyệt bởi '+data.dvb.nd+'<button type="button" data-ma="'+data.dvb.id+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">×</span></button>\n\
                                    </button>\n\
                                </div>\n\
                            </div>';

                            $('#thong_bao').append(tb);
                        }
                        else{
                            var tb='<div class="rs-select2--light _'+data.dvb.id+'">\n\
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">\n\
                                    <span class="badge badge-pill badge-success">Thông báo!</span> Giấy ra viện ['+data.dvb.cd+'] đã được duyệt bởi '+data.dvb.nd+'<button type="button" data-ma="'+data.dvb.id+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                        <span aria-hidden="true">×</span></button>\n\
                                    </button>\n\
                                </div>\n\
                            </div>';

                            $('#thong_bao').append(tb);
                        }
                    }
                }
                else if(data.dvb.idnvd == $('#id_nv').val()){
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
            }
            else if(data.thaotac == 'them'){ 
                if(data.dvb.pl ==  'grv' && $('#quyen_bs').val() == 'TRUE' && $('#khoa_nv').val() == data.dvb.khoa){
                    if($('[class*="anounttk"]').find('[class*="notiwrap"]').length > 0){
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
                                audiotk = new Audio('public/audios/sound.mp3');
                                audiotk.play();
                            }
                        });
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
                        if(data.dshuy[i]['pl'] == 'grv'){
                            if($('#tb_bc').hasClass('hidden')){
                                $('#tb_bc').removeClass('hidden');

                                var tb='<div class="rs-select2--light _'+data.dshuy[i]['id']+'">\n\
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-danger">Thông báo!</span> Yêu cầu duyệt giấy ra viện ['+data.dshuy[i]['cd']+'] đã bị hủy bởi '+data.dshuy[i]['nd']+'<button type="button" data-ma="'+data.dshuy[i]['id']+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">×</span></button>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>';

                                $('#thong_bao').append(tb);
                            }
                            else{
                                var tb='<div class="rs-select2--light _'+data.dshuy[i]['id']+'">\n\
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-danger">Thông báo!</span> Yêu cầu duyệt giấy ra viện ['+data.dshuy[i]['cd']+'] đã bị hủy bởi '+data.dshuy[i]['nd']+'<button type="button" data-ma="'+data.dshuy[i]['id']+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
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
        
        var audio='';
        $('a[class*="cba"]').click(function(){
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

        var channelcc = pusher.subscribe('CapCuu');
        function layttbac(data) {
            if(data.tt == 'them'){
                if($('#id_nv').val() == data.idnvnhan){
                    if($('a[class*="cba"]').find('span[class*="quantity"]').length > 0){
                        $('span[class*="quantity"]').text(data.slba);
                        $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');
                    }
                    else{
                        var ct='<span class="quantity">'+data.slba+'</span>';
                        $('a[class*="cba"]').append(ct);
                        $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');
                    }
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
            else if(data.tt == 'nhanba'){
                if($('#id_nv').val() == data.idnvnhan){
                    if($('a[class*="cba"]').find('span[class*="quantity"]').length > 0){
                        if(data.slba.toString() == '0'){
                            $('span[class*="quantity"]').remove();
                            $('a[class*="cba"]').attr('data-original-title', 'Hiện chưa có bệnh án nào chuyển đến!');
                        }
                        else{
                            $('span[class*="quantity"]').text(data.slba);
                            $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');

                        }
                    }
                    else{
                        $('a[class*="cba"]').attr('data-original-title', 'Hiện chưa có bệnh án nào chuyển đến!');
                    }
                }
            }
            else{
                if($('#id_nv').val() == data.idnvnhan){
                    if($('a[class*="cba"]').find('span[class*="quantity"]').length > 0){
                        if(data.slba.toString() == '0'){
                            $('span[class*="quantity"]').remove();
                            $('a[class*="cba"]').attr('data-original-title', 'Hiện chưa có bệnh án nào chuyển đến!');
                        }
                        else{
                            $('span[class*="quantity"]').text(data.slba);
                            $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');
                        }
                    }
                }
                
            }
        }
        
        channelcc.bind('App\\Events\\KhamVaDieuTri\\CapCuu', layttbac);
        
        var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
        
        $('input[list="dsbn"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('bn_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    flagbn=true;
                    break;
                }
                else{
                    hiddenInput.value='';
                    flagbn=false;
                }  
            }
        });

        //
        $('#btndong').click(function(){
            $('#formba').slideUp(800);
            if($('#tblBACT').css('display') == 'block'){
                $('#btndongdsbact').click();
            }
        });
        //end 

        $('#btndongdsbact').click(function(){
            $('#tblBACT').slideUp(800);
            if($('#formba').css('display')=='block'){
                $('html, body').animate({
                    scrollTop: $("#formba").offset().top
                }, 800);
            }
        });
        
        $('body').on('click', 'button[data-button="btnxemtt"]', function(){
            var idba=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idba);
            $('#tbl_xemtoathuoc').html('');
            $('#ghichutoathuoc_xem').val('');
            var url='/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru_ct/lay_ds';
            if($(this).attr('data-loaiba').toString() == 'ngoai'){
                url='/qlkcb/kham_va_dieu_tri/toa_thuoc_ngoai_tru_ct/lay_ds';
            }
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: url,
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
                    if(data.msg == 'cotoa'){
                        var toact='';
                        for(var i=0; i<data.dstoact.length; ++i){
                            toact+='\n\
                                <tr class="tr-shadow">\n\
                                <td data-idthuoc="'+data.dstoact[i].idthuoc+'">'+data.dstoact[i].tenthuoc+'</td>\n\
                                <td>'+data.dstoact[i].dvt+'</td>\n\
                                <td>'+data.dstoact[i].cachdung+'</td>\n\
                                <td>'+data.dstoact[i].lieudung+'</td>\n\
                                <td>'+data.dstoact[i].sl+'</td>\n\
                                <td>'+data.dstoact[i].ghichu+'</td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#ghichutoathuoc_xem').val(data.ghichu);
                        $('#tbl_xemtoathuoc').html(toact);
                    }
                    else if(data.msg != 'koco'){
                        alert("Lấy danh sách chi tiết toa thuốc gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy danh sách chi tiết toa thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy danh sách chi tiết toa thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy danh sách chi tiết toa thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
         
        $('body').on('click', 'button[data-button="btnxemcdtt"]', function(){
            var idba=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idba);
            $('#tbl_xemcdtt').html('');
            var url='/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/lay_ds_noi';
            if($(this).attr('data-loaiba').toString() == 'ngoai'){
                url='/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/lay_ds';
            }
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: url,
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
                    if(data.msg == 'cocd'){
                        var cdtt='';
                        for(var i=0; i<data.dscdtt.length; ++i){
                            cdtt+='\n\
                                <tr class="tr-shadow">\n\
                                <td data-iddmcls="'+data.dscdtt[i].iddmcls+'">'+data.dscdtt[i].tentt+'</td>\n\
                                <td>'+data.dscdtt[i].phongth+'</td>\n\
                                <td>'+data.dscdtt[i].nv+'</td>\n\
                                <td>'+data.dscdtt[i].ngayracd+'</td>\n\
                            </tr>\n\\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_xemcdtt').html(cdtt);
                    }
                    else if(data.msg != 'koco'){
                        alert("Lấy danh sách các chỉ định thủ thuật gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy danh sách các chỉ định thủ thuật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy danh sách các chỉ định thủ thuật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy danh sách các chỉ định thủ thuật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        $('body').on('click','button[data-button="btnxemkqcls"]',function(){
            var idba=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idba);
            $('#tbl_kqcls').html('');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/tra_ket_qua_cls/lay_ket_qua',
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
                        if(data.kqcls.length > 0){
                            var kqcls='';
                            for (var i = 0; i < data.kqcls.length; i++) {
                                kqcls+='<tr>\n\
                                    <td class="vertical-align-midle" data-idpkq="'+data.kqcls[i].idkqcls+'">'+data.kqcls[i].tencls+'</td>\n\
                                    <td>'+data.kqcls[i].nvth+'</td>\n\
                                    <td>'+data.kqcls[i].phong+'</td>\n\
                                    <td>'+data.kqcls[i].ngayth+'</td>\n\
                                    <td class="text-left">'+data.kqcls[i].kq+'</td>\n\
                                    <td>'+data.kqcls[i].kqha+'</td>\n\
                                    <td class="text-left">'+data.kqcls[i].kl+'</td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                            $('#tbl_kqcls').html(kqcls);
                        }
                    }
                    else{
                        alert("Lấy kết quả cận lâm sàng gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy kết quả cận lâm sàng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy kết quả cận lâm sàng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy kết quả cận lâm sàng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        $('#tbl_bact').on('click', 'button[data-button="btnxemcdpt"]', function(){
            
            var idbact=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idbact);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/chi_dinh_phau_thuat/lay_ds',
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
                    if(data.msg == 'cocd'){
                        var cdpt='\n\
                                <tr class="tr-shadow">\n\
                                    <td data-iddmcls="'+data.dscdpt.iddmcls+'">'+data.dscdpt.tenpt+'</td>\n\
                                    <td>'+data.dscdpt.phongth+'</td>\n\
                                    <td>'+data.dscdpt.nv+'</td>\n\
                                    <td>'+data.dscdpt.pp+'</td>\n\
                                    <td>'+data.dscdpt.ngayracd+'</td>\n\
                                </tr>\n\\n\
                                <tr class="spacer"></tr>';
                        
                        $('#tbl_cdpt').html(cdpt);
                        $('#tbl_cdpt button[data-button]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                    }
                    else if(data.msg == 'koco'){
                        $('#tbl_cdpt').html('');
                    }
                    else{
                        alert("Lấy danh sách các chỉ định phẫu thuật gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy danh sách các chỉ định phẫu thuật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy danh sách các chỉ định phẫu thuật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy danh sách các chỉ định phẫu thuật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
            
        });
        
        $('#btnxemctgd').click(function (){
            var id=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', id);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/lay_ds_ct',
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
                        $('#tblBACT').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#tblBACT").offset().top
                        }, 800);
                        
                        $('#tbl_bact').html(data.dsct);
                        $('#tbl_bact button').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                    }
                    else{
                        alert("Lấy danh sách chi tiết bệnh án gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy danh sách chi tiết bệnh án thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy danh sách chi tiết bệnh án thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy danh sách chi tiết bệnh án thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        $('#tbl_ba').on('click','button[data-button="btnxemctba"]',function(){
            $('#btndongdsbact').click();
            var formData = new FormData();
            var id=$(this).attr('data-id');
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            var loaiba=$(this).attr('data-loaiba').toString();
            var url='/qlkcb/kham_va_dieu_tri/benh_an_ngoai_tru/lay_tt_cap_nhat';
            if(loaiba== 'noi'){
                url='/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/lay_tt_cap_nhat';
            }
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: url,
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    if(data.msg == 'tc')
                    {
                        // Success
                        $('#hoten').val(data.hotenbn);$('#hoten').attr('data-id', data.mabn);$('#ngaysinh').val(data.ngaysinh);$('#gt').val(data.gt);$('#dantoc').val(data.dantoc);$('#scmnd').val(data.socmnd);$('#diachi').val(data.diachi);
                        $('#tinhtrangbn').val(data.ttbn);$('#ghichuba').val(data.ghichu);
                        if(data.anh != null && data.anh !='' && data.anh != 'null')
                        {
                            $('p[class*="anhbn"]').addClass('hidden');$('img[class*="anhbn"]').attr('src','public/upload/anhbn/'+data.anh);$('img[class*="anhbn"]').removeClass('hidden');
                        }
                        else
                        {
                            $('p[class*="anhbn"]').removeClass('hidden');$('img[class*="anhbn"]').addClass('hidden');
                        }   
                        if(data.mathe != 'koco')
                        {
                            $('#tuyen').val(data.tuyen);$('#chuyentu').val(data.chuyentu);$('#giaychuyen').val(data.giaychuyen);
                            $('#mathe').val(data.mathe);$('#ngaydk').val(data.ngaydk);$('#ngayhh').val(data.ngayhh);$('#noidkkcbbd').val(data.noidk);$('#doituong').val(data.doituong);$('#mh').val(data.mh);
                            $('[class*="thearea"]').removeClass('hidden');
                        }
                        else
                        {
                            $('[class*="thearea"]').addClass('hidden');
                        }
                        if(loaiba == 'noi'){
                            $('#lydonvarea').removeClass('hidden');$('#giuongarea').removeClass('hidden');
                            $('#ghichuarea').addClass('col-lg-4');
                            $('#ghichuarea').removeClass('col-lg-10');
                            $('#lydonv').val(data.lydonv);$('#giuong').val(data.giuongp);
                            $('#btnxemctgdarea').removeClass('hidden');$('#btnxemctgd').attr('data-id', id);
                            $('#songaydtarea').addClass('hidden');
                        }
                        else{
                            $('#lydonvarea').addClass('hidden');$('#giuongarea').addClass('hidden');
                            $('#ghichuarea').addClass('col-lg-10');
                            $('#btnxemctgdarea').addClass('hidden');
                            $('#songaydtarea').removeClass('hidden');$('#songaydt').val(data.songaydt);
                        }
                        
                        if($.isPlainObject(data.chuandoan[0])){
                            $('#dschuadoan').html('');
                            //convert object to array
                            var t = data.chuandoan;
                            var keys = Object.keys(t);
                            var values = keys.map(function(key) {
                              return t[key];
                            });
                            for (var i = 0; i < values.length; i++) {
                                $('#dschuadoan').prepend('<option value="'+values[i]['id']+'">'+values[i]['name']+'</option>');
                            }
                            
                        }
                        
                        $('#formba').slideDown(800);
                        
                        $('html, body').animate({
                            scrollTop: $("#formba").offset().top
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
        
        $('#btnlamlai').click(function (){
            $('#formtitledb').text('XEM BỆNH SỬ CỦA BỆNH NHÂN');
            $('#tbl_ba').html("");
            $('#kqtimliem').text("");
            $('#txttimkiem').val("");
        });
        
        //tìm kiếm
        $('#btntimkiem').click(function (){
            if($('#txttimkiem').val().toString().trim() == ''){
                alert('Vui lòng nhập họ tên bệnh nhân!');
                return false;
            }
            else if(flagbn == false){
                alert('Bệnh nhân hiện không tồn tại trong hệ thống, có thể chưa được thêm thông tin hoặc đã bị xóa thông tin!');
                return false;
            }
            $('#btndong').click();
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('keyWords', $('#bn_hide').val());
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/benh_su/xem_benh_su',
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
                        alert("Không thể xem bệnh sử! Lỗi: "+data.msg);
                    }else{
                        if(data.sl > 0){
                            soluongtk=data.sl;
                            $('#formtitledb').text('XEM BỆNH SỬ CỦA BỆNH NHÂN - '+data.bn.toString().toUpperCase());
                            var ttba='';
                            for(var i=0; i<data.benhan.length; ++i){
                                if(data.benhan[i].loaiba == 'noi'){
                                    ttba+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">'+data.benhan[i].dttn+'</td>\n\
                                        <td>'+data.benhan[i].khoadt+'</td>\n\
                                        <td>'+data.benhan[i].bsdt+'</td>\n\
                                        <td class="text-left">'+data.benhan[i].chuandoan+'</td>\n\
                                        <td>'+data.benhan[i].htdt+'</td>\n\
                                        <td>'+data.benhan[i].ngaytn+'</td>\n\
                                        <td>'+data.benhan[i].songaydt+'</td>\n\
                                        <td data-ttba="'+data.benhan[i].id+'">'+data.benhan[i].trangthaiba+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" data-toggle="tooltip" title="Xem chi tiết" data-button="btnxemctba" data-id="'+data.benhan[i].id+'" data-loaiba="noi">\n\
                                                    <i class="fa fa-list"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                                }
                                else{
                                    ttba+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">'+data.benhan[i].dttn+'</td>\n\
                                        <td>'+data.benhan[i].khoadt+'</td>\n\
                                        <td>'+data.benhan[i].bsdt+'</td>\n\
                                        <td class="text-left">'+data.benhan[i].chuandoan+'</td>\n\
                                        <td>'+data.benhan[i].htdt+'</td>\n\
                                        <td>'+data.benhan[i].ngaytn+'</td>\n\
                                        <td>'+data.benhan[i].songaydt+'</td>\n\
                                        <td data-ttba="'+data.benhan[i].id+'">'+data.benhan[i].trangthaiba+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" data-toggle="modal" data-target="#modalxemtt" data-button="btnxemtt" data-id="'+data.benhan[i].id+'" rel="tooltip" title="Xem chi tiết thuốc điều trị" data-loaiba="ngoai">\n\
                                                    <i class="fa fa-list-alt"></i>\n\
                                                </button>\n\
                                                <button type="button" class="item" data-toggle="modal" data-target="#modalcls" data-button="btnxemkqcls" data-id="'+data.benhan[i].id+'" data-loaiba="ngoai" rel="tooltip" title="Xem kết quả cận lâm sàng" data-loaiba="ngoai">\n\
                                                    <i class="fa fa-stethoscope"></i>\n\
                                                </button>\n\
                                                <button type="button" class="item" data-toggle="modal" data-target="#modalxemthuthuat" data-button="btnxemcdtt" data-id="'+data.benhan[i].id+'" data-loaiba="ngoai" rel="tooltip" title="Xem chỉ định thủ thuật" data-loaiba="ngoai">\n\
                                                    <i class="fa fa-magic"></i>\n\
                                                </button>\n\
                                                <button type="button" class="item" data-toggle="tooltip" title="Xem chi tiết" data-button="btnxemctba" data-id="'+data.benhan[i].id+'" data-loaiba="ngoai">\n\
                                                    <i class="fa fa-list"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                                }
                            }

                            $('#tbl_ba').html(ttba);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                            $('#kqtimliem').text("Có "+data.sl+" bệnh án được tìm thấy!");
                        }
                        else{
                            $('#formtitledb').text('XEM BỆNH SỬ CỦA BỆNH NHÂN');
                            $('#tbl_ba').html("");
                            $('#kqtimliem').text("Không có bệnh án nào được tìm thấy!");tk=false;
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Xem bệnh sử thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Xem bệnh sử thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Xem bệnh sử thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end tìm kiếm
        
        //nhấn enter tìm kiếm
        $("#ftimkiem").keypress(function(e) {
              var key = e.charCode || e.keyCode || 0;     
              if (key == 13) {
                e.preventDefault();
                $('#btntimkiem').click();
              }
        });
        //end
        
        $(document).on("keypress", function (evt) {
            if (evt.keyCode == 27)
            {
                $('button[class="close"]').click();
            }
        });
    });
</script>
@endsection