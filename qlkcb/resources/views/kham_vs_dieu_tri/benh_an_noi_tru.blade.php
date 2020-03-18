@extends('kham_vs_dieu_tri.layout')

@section('title')
    {{ "Bệnh án nội trú" }}
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
        <!-- LẬP BỆNH ÁN-->
        <section class="p-t-20 hidden" id="formba">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" m-b-35">
                            <h3 class="title-5 font-weight-bold text-green" id="formtitle">LẬP BỆNH ÁN NỘI TRÚ</h3>
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
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tình trạng lúc nhập viện</label>
                                                        <input type="text" class="form-control" readonly="" id="tinhtrangbn">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Đối tượng tiếp nhận</label>
                                                        <input type="text" readonly="" class="form-control" id="doituongtn">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">  
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Gợi ý chuẩn đoán</label>
                                                        <div class="row">
                                                            <div class="col-lg-9 m-b-15">
                                                                <input type="text" class="form-control" id="chuandoan" list="dsbenh">
                                                                <datalist id="dsbenh">
                                                                    @if(isset($dsbenh))
                                                                    @foreach($dsbenh as $benh)                                                                            <option value="{{$benh->danhMucBenh->IdBenh}}" data-value="{{$benh->danhMucBenh->IdBenh}}">{{$benh->danhMucBenh->TenBenh}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </datalist>
                                                                <input type="hidden" id="chuandoan_hide">
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class=" form-control-label"></label>
                                                                    <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Thêm chuẩn đoán" id="btnthemcd">
                                        <i class="fa fa-stethoscope"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">  
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Các bệnh đã chuẩn đoán (<span class="color-red">*</span>)</label>
                                                        <div class="row">
                                                            <div class="col-lg-9 m-b-15">
                                                                <select class="form-control" id="dschuadoan">

                                                                </select>
                                                            </div> 
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class=" form-control-label"></label>
                                                                    <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px"  data-toggle="tooltip" title="Xóa chuẩn đoán" id="btnxoacd">
                                        <i class="fa fa-minus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Lý do nhập viện (<span class="color-red">*</span>)</label>
                                                        <textarea rows="1" placeholder="Nhập lý do bệnh nhân nhập viện..." class="form-control" id="lydonv"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Giường bệnh số</label>
                                                        <select class="form-control" id="dsgiuong">
                                                            @if(isset($dsgiuong))
                                                                @foreach($dsgiuong as $g)
                                                                <?php $ttsd='Trống';
                                                                    if($g->TinhTrangSD == 1){
                                                                        $ttsd='Đang sử dụng';
                                                                    }
                                                                ?>
                                                            <option data-ttsd="{{$g->TinhTrangSD}}" value="{{$g->IdTB}}">{{'Giường bệnh số '.$g->SoTB.' - Phòng số '.$g->phongBan->SoPhong.' ('.$ttsd.')'}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ghi chú</label>
                                                        <textarea rows="1" placeholder="Nhập ghi chú về tình trạng bệnh nhân lúc nhập viện, vv..." class="form-control" id="ghichuba"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-15">
                                                <div class="col-lg-1" id="btnsuaarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Cập nhật" id="btncapnhat" data-id=""><span class="fa fa-edit"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--showdetail au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Chi tiết các giai đoạn điều trị" id="btnxemctgd"><span class="fa fa-list-alt"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--print au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="In bệnh án" id="btnprintba"><span class="zmdi zmdi-print"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--print au-btn--small au-btn-shadow height-43px" data-toggle="modal" data-target="#modalgrv" rel="tooltip" title="Lập giấy ra viện" id="btngiayrv"><span class="fa fa-sign-out"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btngcvarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--gcv au-btn--small au-btn-shadow height-43px" rel="tooltip" title="Lập glấy chuyển viện" data-toggle="modal" data-target="#modalgcv" id="btngcv"><i class="fa fa-plane"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--remove au-btn--small au-btn-shadow height-43px" rel="tooltip" title="Lập phiếu kê khai viện phí" data-toggle="modal" data-target="#modalkkvp" id="btnlapphieukk"><i class="fa fa-money"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnchuyenbaarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--chuyenba au-btn--small au-btn-shadow height-43px" data-toggle="modal" data-target="#modalchuyenba" rel="tooltip" title="Chuyển bệnh án chuyên khoa" id="btnchuyenba"><span class="fa fa-exchange"></span></button>
                                                    </div>
                                                </div>
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
        <!-- END LẬP BỆNH ÁN-->

        <!-- THÊM BỆNH ÁN CHI TIẾT-->
        <section class="p-t-20 hidden" id="formbact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="m-b-35">
                            <h3 class="title-5 font-weight-bold text-green" id="formcttitle">THÊM GIAI ĐOẠN ĐIỀU TRỊ</h3>
                            <hr class="line-seprate">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body card-block">
                                        <form >
                                            <div class="row m-b-15">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Phương pháp điều trị</label>
                                                        <select class="form-control" id="ppdt">
                                                            <option value="dung_thuoc">Dùng thuốc</option>
                                                            <option value="phau_thuat">Phẫu thuật</option>
                                                            <option value="tieu_phau">Tiểu phẫu</option>
                                                            <option value="tieu_phau_vs_dung_thuoc">Tiểu phẫu + dùng thuốc</option>
                                                            <option value="phau_thuat_vs_dung_thuoc">Phẫu thuật + dùng thuốc</option>
                                                            <option value="thuc_hien_cls_vs_dung_thuoc">Thực hiện CLS + dùng thuốc</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Ngày bắt đầu</label>
                                                        <div class="input-group date" id="datetimepickerfilter1" data-target-input="nearest">
                                                            <input type="text" readonly="" class="form-control datetimepicker-input" data-target="#datetimepickerfilter1" id="thoigiantungay" data-toggle="tooltip" data-placement="bottom" title="Từ ngày"/>
                                                            <div class="input-group-append" data-target="#datetimepickerfilter1" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Ngày kết thúc</label>
                                                        <div class="input-group date" id="datetimepickerfilter2" data-target-input="nearest">
                                                            <input type="text" onkeydown="return false" class="form-control datetimepicker-input" data-target="#datetimepickerfilter2" id="thoigiandenngay" data-toggle="tooltip" data-placement="bottom" title="Đến ngày"/>
                                                            <div class="input-group-append" data-target="#datetimepickerfilter2" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tình trạng bệnh nhân</label>
                                                        <select class="form-control" id='ttbngddt'>
                                                            <option value="khoi_benh_hoan_toan">Khỏi bệnh hoàn toàn</option>
                                                            <option value="do_nhieu">Đỡ nhiều</option>
                                                            <option value="do_mot_phan">Đỡ một phần</option>
                                                            <option value="khong_khuyen_giam">Không khuyên giảm</option>
                                                            <option value="benh_tien_trien_xau">Bệnh tiến triển xấu</option>
                                                            <option value="dang_theo_doi" selected="">Đang theo dõi</option>
                                                            <option value="tu_vong">Tử vong</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ghi chú</label>
                                                        <textarea rows="1" placeholder="Nhập ghi chú về tình trạng bệnh nhân sau mỗi đợt điều trị, phương pháp điều trị, vv..." class="form-control" id='ghichubact'></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1" id="btnthemctarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm giai đoạn điều trị mới" id="btnthemct"><span class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnsuactarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Cập nhật" id="btncapnhatct" data-id=""><span class="fa fa-edit"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnratoaarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Ra toa thuốc" data-toggle="modal" data-target="#modalratt" id="btnratoathuoc"><span class="fa fa-leaf"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnracdclsarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--darkgreen au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Ra chỉ định cận lâm sàng" data-toggle="modal" data-target="#modalcdcls" id="btnrachidinhcls"><i class="fa fa-stethoscope"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnxemkqclsarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--violet au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Xem kết quả cận lâm sàng" data-toggle="modal" data-target="#modalcls" id="btnxemkqcls"><i class="fa fa-eye"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnracdttarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn-orange au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Ra chỉ định thủ thuật" data-toggle="modal" data-target="#modalthuthuat" id="btnrachidinhtt"><i class="fa fa-magic"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnracdptarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn-cachua au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Ra chỉ định phẫu thuật" data-toggle="modal" data-target="#modalpt" id="btnrachidinhpt"><i class="fa fa-user-secret"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Đóng" id="btndongct"><span class="fa fa-remove"></span></button>
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
        <!-- END THÊM BỆNH ÁN CHI TIẾT-->

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
                                <button class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm giai đoạn điều trị" id="btnthemgddt"><i class="fa fa-tasks"></i></button>
                                <button class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Đóng danh sách" id="btndongdsbact"><i class="fa fa-close"></i></button>
                                <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatcct"><i class="zmdi zmdi-delete"></i></button>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2 fit_table_height_300 tableFixHead">
                            <table class="table table-data2 table-hover m-b-20 text-center">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="au-checkbox">
                                                <input type="checkbox" data-input="checksumCT">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </th>
                                        <th style="position: sticky; top: 0; z-index: 99;">Ngày bắt đầu</th>
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
        
        <!--MODAL CHUYỂN BỆNH ÁN-->
        <div class="modal fade" id="modalchuyenba" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Chuyển bệnh án về chuyên khoa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Chuyển đến khoa (<span class="color-red">*</span>)</label>
                                                        <select class="form-control" id="dsnv_k">
                                                            @if(isset($dsnv_k))
                                                            @foreach($dsnv_k as $nv_k)
                                                                <option value="{{$nv_k->IdNV}}">BS. {{$nv_k->TenNV}} - Khoa [{{$nv_k->phongBan->Khoa->TenKhoa}}]</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <label class=" form-control-label">Ghi chú</label>
                                                    <textarea rows="1"  placeholder="Nhập ghi chú về tình trạng bệnh nhân hiện tại, các kỹ thuật y tế đã thực hiện, vv..." class="form-control" id="ghichubachuyen"></textarea>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-lg-12">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Chuyển" id="btncba"><span class="fa fa-send"></span></button>
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
                                <div class="row hidden" id="dxlarea">
                                    <div class="col-lg-12">
                                        <label style="font-weight: normal" id="dxl">Đang xử lý!</label>
                                    </div>
                                </div>
                                <div class='row hidden' id="proccessdxl">
                                    <div class='col-lg-12'>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                <span>Hãy đợi<span class="dotdotdot"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL CHUYỂN BỆNH ÁN-->
        
        <!--DANH SÁCH BỆNH ÁN CHỜ TIẾP NHẬN-->
        
        <section class="p-t-20 hidden" id="dschotnba">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" m-b-35">
                            <h3 class="title-5 font-weight-bold text-green">DANH SÁCH BỆNH ÁN CHỜ TIẾP NHẬN</h3>
                            <hr class="line-seprate">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body card-block">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-10 m-b-15">
                                                            <select class="form-control" id="dsbachotn">
                                                                @if(isset($dsbachotn))
                                                                    @foreach($dsbachotn as $tnba)
                                                                        <option value="{{$tnba->IdBANoiT}}">BN. {{$tnba->phieuDKKham->phieuDKKham->benhNhan->HoTen}} - Khoa [{{$tnba->nhanVien->phongBan->Khoa->TenKhoa}}] - BSDT. {{$tnba->nhanVien->TenNV}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <button type="button" class="au-btn au-btn--green au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Tiếp nhận bệnh án này" id="btntiepnhan"><span class="fa fa-download"></span></button>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <button type="button" class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Không tiếp nhận bệnh án này" id="btnkotiepnhan"><span class="fa fa-minus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <button type="button" class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Xem thuốc bệnh nhân đã dùng" data-toggle="modal" data-target="#modalxemtoathuoc" id="btnxemtoathuoc"><span class="fa fa-leaf"></span></button>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <button type="button" class="au-btn au-btn--violet au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Xem kết quả cận lâm sàng" data-toggle="modal" data-target="#modalcls" id="btnxemketquacls"><i class="fa fa-eye"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <button type="button" class="au-btn au-btn-orange au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Xem các chỉ định thủ thuật" data-toggle="modal" data-target="#modalxemthuthuat" id="btnxemchidinhtt"><i class="fa fa-magic"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <button type="button" class="au-btn au-btn-cachua au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Xem các chỉ định phẫu thuật" data-toggle="modal" data-target="#modalxempt" id="btnxemchidinhpt"><i class="fa fa-user-secret"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <button class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Đóng danh sách" id="btndongdstn"><i class="fa fa-close"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="font-size: 10pt;">
                                            <div class="col-lg-12">
                                                <div class="row hidden" id="dtbiareaba">
                                                    <div class="col-lg-12">
                                                        <label style="font-weight: normal" id="dtbiba">Đang xử lý!</label>
                                                    </div>
                                                </div>
                                                <div class='row hidden' id="proccessba">
                                                    <div class='col-lg-12'>

                                                        <div class="progress">
                                                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                <span style="font-size: 8pt;">Vui lòng chờ<span class="dotdotdot"></span></span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- END DANH SÁCH BỆNH ÁN CHỜ TIẾP NHẬN-->
        
        <!--MODAL GIẤY CHUYỂN VIỆN-->
        <div class="modal fade" id="modalgcv" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Lập giấy chuyển viện</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row fit_table_height_500" style="font-family: Verdana; font-size: 8pt;">
                            <div style="width: 45px !important;"></div>
                            <div class="col-lg-10" id="print_content_gcv" >
                                <div class="card" style="font-weight: normal; height: 900px; width: 660px !important;">
                                    <div class="card-block card-body printcontent_gcv" style="height: 900px; width: 660px !important; font-weight: 800;">
                                        <div class="row" style="font-size: 7pt;">
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-4 text-center" style="margin: 0; padding: 0;">
                                                        <label><img src="public/images/logo3.png" style="height: 50px;"></label>
                                                    </div>
                                                    <div class="col-lg-8" style="margin: 0; padding: 0;">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                 <label style="margin-bottom: 0;">Sở Y tế An Giang</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                 <label style="margin-bottom: 0;">Bệnh Viện ĐKTT An Giang</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                 <label style="margin-bottom: 0;">Số: ....../20.../GCT</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 text-center">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                        <label style="margin-bottom: 0;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</label>
                                                     </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">Độc lập - Tự do - Hạnh phúc</label>
                                                        <hr class="line-seprate" style="margin-top: 10px; margin-left: 85px; background: black; width: 30%;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">MS: 06</label>
                                                     </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">Số Hồ sơ:</label> <label style="margin-bottom: 0;" id="shs">......................</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">Vào sổ chuyển tuyến số:</label> <label style="margin-bottom: 0;" id="sct">.....................................</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-size: 12pt">GIẤY CHUYỂN TUYẾN KHÁM BỆNH, CHỮA BỆNH BẢO HIỂM Y TẾ</label>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-15">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Kính gửi:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_ncd">....................................</label>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">Cơ sở khám bệnh, chữa bệnh: Bệnh viện Đa khoa TT An Giang trân trọng giới thiệu:</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0;">Họ và tên người bệnh:</label> <label style="margin-bottom: 0; font-size: 8pt; font-weight: normal" id="gcv_hoten"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0;">Nam/Nữ:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_gt"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0;">Tuổi:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_tuoi"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-5">
                                                <label style="margin-bottom: 0;">Dân tộc:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_dt"></label>
                                            </div>
                                            <div class="col-lg-7">
                                                <label style="margin-bottom: 0;">Quốc tịch:</label> <label style="margin-bottom: 0; font-weight: normal">.....................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-5">
                                                <label style="margin-bottom: 0;">Nghề nghiệp:</label> <label style="margin-bottom: 0; font-weight: normal">.......................................</label>
                                            </div>
                                            <div class="col-lg-7">
                                                <label style="margin-bottom: 0;">Nơi làm việc:</label> <label style="margin-bottom: 0; font-weight: normal">.................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Mã thẻ BHYT:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_mathe"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Địa chỉ:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_diachi"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Đã được khám bệnh/điều trị:</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12" id="gcv_tgdt">

                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">TÓM TẮT BỆNH ÁN</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Dấu hiệu lâm sàng:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_dauhieuls">.........................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Kết quả xét nghiệm, cận lâm sàng:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_kqls">.................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Chuẩn đoán:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_cd">...................................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Phương pháp, thủ thuật, kỹ thuật, thuốc đã sử dụng trong điều trị:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_thuoc">................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Tình trạng người bệnh lúc chuyển tuyến:</label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_ttbn">........................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Lí do chuyển tuyến: Khoanh tròn vào lý do chuyển tuyến phù hợp sau đây:</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">1. Đủ điều kiện chuyển tuyến.</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0; font-weight: normal">2. Theo yêu cầu của người bệnh hoặc người đại diện hợp pháp của người bệnh.</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Hướng điều trị: </label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_ppdt">....................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Chuyển tuyến hồi: </label> <label style="margin-bottom: 0; font-weight: normal" id="gcv_tgc"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Phương tiện vận chuyển: </label> <label style="margin-bottom: 0; font-weight: normal" >................................................................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-20">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">– Họ tên, chức danh, trình độ chuyên môn của người hộ tống: </label> <label style="margin-bottom: 0; font-weight: normal">...........................................................</label>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-lg-6">
                                                <br>
                                                <label style="margin-bottom: 0">Y, BÁC SĨ KHÁM, ĐIỀU TRỊ</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal; font-style: italic">(Ký và ghi rõ họ tên)</label><br>
                                                <label style="margin-bottom: 0; font-weight: 800" id="gcv_bs"></label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0; font-size: 8pt; font-weight: normal; font-style: italic">Ngày.......tháng.......năm........</label><br>
                                                <label style="margin-bottom: 0">NGƯỜI CÓ THẨM QUYỀN CHUYỂN TUYẾN</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal;font-style: italic">(Ký tên, đóng dấu)</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">...........................</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="font-size: 11pt;">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-4">  
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Nơi chuyển đến (<span class="color-red">*</span>)</label>
                                                        <input type="text" class="form-control" id="cskhambhyt" list="dscskhambhyt">
                                                        <datalist id="dscskhambhyt">
                                                            @if(isset($dscskhambhyt))
                                                                @foreach($dscskhambhyt as $csk)                                                                            <option data-value="{{$csk->IdCSKBHYT}}">{{$csk->TenCS}}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                        <input type="hidden" id="cskhambhyt_hide">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Dấu hiệu LS của bệnh nhân (<span class="color-red">*</span>)</label>
                                                        <textarea rows="1" class="form-control" id="dauhieuls"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Hướng điều trị (<span class="color-red">*</span>)</label>
                                                        <textarea rows="1" class="form-control" id="huongdieutri"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">  
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tình trạng bệnh nhân lúc chuyển (<span class="color-red">*</span>)</label>
                                                        <textarea row="1" class="form-control" id="ttbnlucchuyen"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 text-right">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--print au-btn--small au-btn-shadow height-40px" rel="tooltip" title="In giấy chuyển viện" id="btningcv"><span class="zmdi zmdi-print"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 text-left">
                                                    <div class="form-group hidden" id="btnhuygcvarea">
                                                        <button type="button" class="au-btn au-btn--close au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Hủy giấy chuyển viện" id="btnhuygcv"><span class="fa fa-remove"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="font-size: 8pt;">
                                                <div class="col-lg-12">
                                                    <div class="row hidden" id="dtbiareagcv">
                                                        <div class="col-lg-12">
                                                            <label style="font-weight: normal" id="dtbigcv">Đang tạo bản in!</label>
                                                        </div>
                                                    </div>
                                                    <div class='row hidden' id="proccessgcv">
                                                        <div class='col-lg-12'>

                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                    <span style="font-size: 8pt;">Vui lòng chờ<span class="dotdotdot"></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
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
        </div>
        <!--END MODAL GIẤY CHUYỂN VIỆN-->
        
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

        <!--MODAL RA CHỈ ĐỊNH CẬN LÂM SÀNG-->
        <div class="modal fade" id="modalcdcls" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Ra chỉ định cận lâm sàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tên cận lâm sàng (<span class="color-red">*</span>)</label>
                                                        <input type="text" list="dstencls" id="tencls" placeholder="Nhập tên cận lâm sàng..." class="form-control" />
                                                        <datalist id="dstencls">
                                                            @if(isset($dsdmcls))
                                                                @foreach($dsdmcls as $dmcls)
                                                            <option data-value="{{$dmcls->danhMucCLS->IdDMCLS}}">{{$dmcls->danhMucCLS->TenCLS}}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                        <input type="hidden" id="tencls_hide">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Phòng CLS số</label>
                                                        <select class="form-control" id="dsphongcls">
                                                            @if(isset($dsphongcls))
                                                                @foreach($dsphongcls as $phong)
                                                            <option value="{{$phong->IdPB}}">{{$phong->SoPhong.' - '.$phong->TenPhong}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ghi chú</label>
                                                        <textarea rows="1" id="ghichucls" placeholder="Nhập ghi chú về cận lâm sàng thực hiện, vv..." class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Loại chỉ định</label>
                                                        <select class="form-control" id="loaicdcls">
                                                            <option value="0">Thường</option>
                                                            <option value="1">Khẩn</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1" id="btnrachidinhclsarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Ra chỉ định CLS" id="btnracdcls"><span class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnsuacdclsarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Cập nhật" id="btnsuacdcls"><span class="fa fa-edit"></span></button>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 hidden" id="btnincdclsarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--green au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="In phiếu" id="btninphieucls"><span class="zmdi zmdi-print"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnlamlaiclsarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn-orange au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Hủy" id="btnlamlaicls"><span class="fa fa-eraser"></span></button>
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
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class=" m-b-35">
                                            <h5 class="title-5 font-weight-bold text-green font-size-11">DANH SÁCH CÁC CHỈ ĐỊNH</h5>
                                            <hr class="line-seprate">
                                        </div>

                                    </div>
                                    <div class="table-data__tool-right">

                                        <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatccdcls"><i class="zmdi zmdi-delete"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row hidden" id="dtbiareacls">
                                            <div class="col-lg-12">
                                                <label style="font-weight: normal" id="dtbicls">Đang tạo bản in!</label>
                                            </div>
                                        </div>
                                        <div class='row hidden' id="proccesscls">
                                            <div class='col-lg-12'>

                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                        <span>Vui lòng chờ<span class="dotdotdot"></span></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2 fit_table_height_300 tableFixHead">
                                <table class="table table-data2 table-hover m-b-20 text-center">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="au-checkbox">
                                                    <input type="checkbox" data-input="checksumCLS">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </th>
                                            <th style="position: sticky; top: 0; z-index: 99;">Tên cận lâm sàng</th>
                                            <th>Phòng thực hiện</th>
                                            <th>Ngày ra chỉ định</th>
                                            <th>thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_cdcls">

                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL RA CHỈ ĐỊNH CẬN LÂM SÀNG-->

        <!--MODAL RA CHỈ ĐỊNH THỦ THUẬT-->
        <div class="modal fade" id="modalthuthuat" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Ra chỉ định thủ thuật</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tên thủ thuật (<span class="color-red">*</span>)</label>
                                                        <input type="text" list="dsthuthuat" id="tenthuthuat" placeholder="Nhập tên thủ thuật..." class="form-control" />
                                                        <datalist id="dsthuthuat">
                                                            @if(isset($dsthuthuat))
                                                                @foreach($dsthuthuat as $tt)
                                                            <option data-value="{{$tt->danhMucCLS->IdDMCLS}}">{{$tt->danhMucCLS->TenCLS}}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                        <input type="hidden" id="tenthuthuat_hide">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Phòng thủ thuật số</label>
                                                        <select class="form-control" id="dsphongtt">
                                                            @if(isset($dsphongtt))
                                                                @foreach($dsphongtt as $phong)
                                                            <option value="{{$phong->IdPB}}">{{$phong->SoPhong.' - '.$phong->TenPhong}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ghi chú</label>
                                                        <textarea rows="1" id="ghichutt" placeholder="Nhập ghi chú về thủ thuật thực hiện, vv..." class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Nhân viên thực hiện (<span class="color-red">*</span>)</label>
                                                        <input type="text" list="dsnv" id="nhanvien" placeholder="Nhập họ tên nhân viên" class="form-control"/>
                                                        <datalist id="dsnv">
                                                            @if(isset($dsnv))
                                                                @foreach($dsnv as $nv)
                                                            <option data-value="{{$nv->IdNV}}">{{$nv->TenNV}}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                        <input type="hidden" id="nhanvien_hide">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Loại chỉ định</label>
                                                        <select class="form-control" id="loaicdtt">
                                                            <option value="0">Thường</option>

                                                        <option value="1">Khẩn</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1" id="btnracdthuthuatarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Ra chỉ định thủ thuật" id="btnracdtt"><span class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnsuacdthuthuatarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Cập nhật" id="btnsuacdtt"><span class="fa fa-edit"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnlamlaittarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn-orange au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Hủy" id="btnlamlaitt"><span class="fa fa-eraser"></span></button>
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
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class=" m-b-35">
                                            <h5 class="title-5 font-weight-bold text-green font-size-11">DANH SÁCH CÁC CHỈ ĐỊNH</h5>
                                            <hr class="line-seprate">
                                        </div>

                                    </div>
                                    <div class="table-data__tool-right">
                                        <button type="button" class="au-btn au-btn--green au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="In phiếu" id="btninphieutt"><span class="zmdi zmdi-print"></span></button>

                                        <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatccdtt"><i class="zmdi zmdi-delete"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row hidden" id="dtbiareathuthuat">
                                            <div class="col-lg-12">
                                                <label style="font-weight: normal" id="dtbitthuthuat">Đang tạo bản in!</label>
                                            </div>
                                        </div>
                                        <div class='row hidden' id="proccessthuthuat">
                                            <div class='col-lg-12'>

                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                        <span>Vui lòng chờ<span class="dotdotdot"></span></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2 fit_table_height_300 tableFixHead">
                                    <table class="table table-data2 table-hover m-b-20 text-center">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox" data-input="checksumThuThuat">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th style="position: sticky; top: 0; z-index: 99;">Tên thủ thuật</th>
                                                <th>Phòng thực hiện</th>
                                                <th>nhân viên thực hiện</th>
                                                <th>Ngày ra chỉ định</th>
                                                <th>thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_cdtt">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL RA CHỈ ĐỊNH THỦ THUẬT-->
        
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

        <!-- DỮ LIỆU IN TOA THUỐC-->
        <section class="p-t-20 hidden" id="printarea_toa">
            <div class="container">
                <div class="col-lg-6">
                    <div class="card" id="print_content" style="font-family: 'Noto Serif'; font-size: 10pt; font-weight: normal">

                    </div>
                </div>
            </div>
        </section>
        <!-- END DỮ LIỆU IN TOA THUỐC-->

        <!--DỮ LIỆU IN CHỈ DỊNH THỦ THUẬT-->
        <section class="p-t-20 hidden" id="printarea_tt">
            <div class="col-lg-6">
                <div class="card" id="print_content_tt" style="font-family: 'Noto Serif'; font-size: 8pt; font-weight: normal">

                </div>
            </div>
        </section>
        <!--END DỮ LIỆU IN CHỈ DỊNH THỦ THUẬT-->

        <!--DỮ LIỆU IN CHỈ DỊNH PHẪU THUẬT-->
        <section class="p-t-20 hidden" id="printarea_pt">
            <div class="col-lg-6">
                <div class="card" id="print_content_pt" style="font-family: 'Noto Serif'; font-size: 8pt; font-weight: normal">

                </div>
            </div>
        </section>
        <!--END DỮ LIỆU IN CHỈ DỊNH PHẪU THUẬT-->
        
        <!--DỮ LIỆU IN CHỈ DỊNH CLS-->
        <section class="p-t-20 hidden" id="printarea_cls">
            <div class="col-lg-6">
                <div class="card" id="print_content_cls" style="font-family: 'Noto Serif'; font-size: 8pt; font-weight: normal">

                </div>
            </div>
        </section>
        <!--END DỮ LIỆU IN CLS-->

        <!--MODAL RA TOA THUỐC ĐIỀU TRỊ-->
        <div class="modal fade" id="modalratt" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lgest" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Ra toa thuốc điều trị</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row hidden" id="formtoathuoc">
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
                                                        <textarea rows="1" id='ghichutoathuoc' placeholder="Nhập lời dặn của bác sĩ..." class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hidden" id="formtoathuocct">
                            <div class="col-lg-12">
                                <div class=" m-b-20">
                                    <h5 class="title-5 font-weight-bold text-green font-size-11">PHẦN CHI TIẾT TOA THUỐC</h5>
                                    <hr class="line-seprate">
                                </div>
                                <div class="card">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tên thuốc (<span class="color-red">*</span>)</label>
                                                        <input type="text" list="dstenthuoc" id="tenthuoc" placeholder="Nhập tên thuốc..." class="form-control"/>
                                                        <datalist id="dstenthuoc">
                                                            
                                                        </datalist>
                                                        <input type="hidden" id="tenthuoc_hide">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Đơn vị tính</label>
                                                        <input type="text" readonly="" class="form-control" id="dvt"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Số ngày dùng (<span class="color-red">*</span>)</label>
                                                        <input type="number" min="0" id="sl" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Liều dùng</label>
                                                        <div class="row">
                                                            <div class="col-lg-3 m-b-15">
                                                                <label class="au-checkbox" data-toggle="tooltip" title="Sáng" style="margin-top:8px;">
                                                                    <input type="checkbox" id="sang">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </div> 
                                                            <div class="col-lg-3 m-b-15">
                                                                <label class="au-checkbox" data-toggle="tooltip" title="Trưa" style="margin-top:8px;">
                                                                    <input type="checkbox" id="trua">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </div> 
                                                            <div class="col-lg-3 m-b-15">
                                                                <label class="au-checkbox" data-toggle="tooltip" title="Chiều" style="margin-top:8px;">
                                                                    <input type="checkbox" id="chieu">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </div> 
                                                            <div class="col-lg-3 m-b-15">
                                                                <label class="au-checkbox" data-toggle="tooltip" title="Tối" style="margin-top:8px;">
                                                                    <input type="checkbox" id="toi">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </div> 
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label" data-toggle="tooltip" title="Số thuốc dùng trong một buổi">LD/Buổi</label>
                                                        <input type="number" min="0" id="lieudung" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tồng số</label>
                                                        <input type="number" min="0" id="tongsothuoc" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ghi chú</label>
                                                        <textarea rows="1" id='ghichutoathuocct' placeholder="Nhập ghi chú về cách dùng, liều dùng, vv..." class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1" id="btnthemthuocarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm thuốc" id="btnthemthuoc"><span class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btncapnhatthuocarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Cập nhật thuốc" id="btncapnhatthuoc"><span class="fa fa-edit"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Đóng" id="btndongformtoathuoc"><span class="fa fa-close"></span></button>
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
                                        <button class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm thuốc" id="btnaddthuoc"><i class="fa fa-leaf"></i></button>
                                        <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatcthuoc"><i class="zmdi zmdi-delete"></i></button>
                                        <button class="au-btn au-btn--green au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="In toa thuốc" id="btnintoathuoc"><i class="zmdi zmdi-print"></i></button>
                                        <button class="au-btn au-btn-orange au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Hủy toa thuốc" id="btnhuytoathuoc"><i class="fa fa-dropbox"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row hidden" id="dtbiareatt">
                                            <div class="col-lg-12">
                                                <label style="font-weight: normal" id="dtbitt">Đang tạo bản in!</label>
                                            </div>
                                        </div>
                                        <div class='row hidden' id="proccesstt">
                                            <div class='col-lg-12'>

                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                        <span>Vui lòng chờ<span class="dotdotdot"></span></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2 fit_table_height_300 tableFixHead">
                            <table class="table table-data2 table-hover m-b-20 text-center">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="au-checkbox">
                                                <input type="checkbox" data-input="checksumTT">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </th>
                                        <th style="position: sticky; top: 0; z-index: 99;">Tên thuốc</th>
                                        <th>đơn vị tính</th>
                                        <th>Cách dùng</th>
                                        <th>Liều dùng</th>
                                        <th>tổng số lượng</th>
                                        <th>thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_toathuoc">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL RA TOA THUỐC ĐIỀU TRỊ-->
        
        <!--MODAL XEM TOA THUỐC ĐIỀU TRỊ-->
        <div class="modal fade" id="modalxemtoathuoc" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
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
                                        <th>Ngày cấp thuốc</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_xemtt">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL XEM TOA THUỐC ĐIỀU TRỊ-->
        
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

        <!--MODAL XEM CHI TIẾT VIỆN PHÍ-->
        <div class="modal fade" id="modalkkvp" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Chi tiết phiếu kê khai viện phí khám, chữa bệnh nội trú</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500" style="font-family: 'Noto Serif'; font-size: 7pt;">
                        <div class="row">
                            <div style="width: 45px !important;"></div>
                            <div class="col-lg-10" id="print_content_vp">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="font-size: 9pt;">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Tổng chi phí đợt điều trị</label>
                                                        <input type="text" class="form-control" readonly="" id="tongphi">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Số tiền BHYT thanh toán</label>
                                                        <input type="text" readonly="" class="form-control" id="tongbh">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Số tiền bệnh nhân trả</label>
                                                        <input type="text" readonly="" class="form-control" id="tongbn">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Nguồn khác</label>
                                                        <input type="text" readonly="" class="form-control" id="tongnk">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row hidden" id="btnprintpkkarea">
                                                <div class="col-lg-12 text-center">
                                                    <button type="button" class="au-btn au-btn--print au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="In phiếu" id="btnprintpkk"><span class="zmdi zmdi-print"></span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="font-size: 8pt;">
                            <div class="col-lg-12">
                                <div class="row hidden" id="dtbiareapkk">
                                    <div class="col-lg-12">
                                        <label style="font-weight: normal" id="dtbipkk">Đang tạo bản in!</label>
                                    </div>
                                </div>
                                <div class='row hidden' id="proccesspkk">
                                    <div class='col-lg-12'>

                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                <span style="font-size: 8pt;">Vui lòng chờ<span class="dotdotdot"></span></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL XEM CHI TIẾT VIỆN PHÍ-->
                
        <!--MODAL RA CHỈ ĐỊNH PHẪU THUẬT-->
        <div class="modal fade" id="modalpt" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Ra chỉ định phẫu thuật</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Tên phẫu thuật (<span class="color-red">*</span>)</label>
                                                        <input type="text" list="dspt" id="tenpt" placeholder="Nhập tên phẫu thuật..." class="form-control" />
                                                        <datalist id="dspt">
                                                            @if(isset($dspt))
                                                                @foreach($dspt as $tt)
                                                            <option data-value="{{$tt->danhMucCLS->IdDMCLS}}">{{$tt->danhMucCLS->TenCLS}}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                        <input type="hidden" id="tenpt_hide">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Phòng phẫu thuật số</label>
                                                        <select class="form-control" id="dsphongpt">
                                                            @if(isset($dsphongpt))
                                                                @foreach($dsphongpt as $phong)
                                                            <option value="{{$phong->IdPB}}">{{$phong->SoPhong.' - '.$phong->TenPhong}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Ghi chú</label>
                                                        <textarea rows="1" id="ghichupt" placeholder="Nhập ghi chú về phẫu thuật thực hiện, vv..." class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Nhân viên thực hiện (<span class="color-red">*</span>)</label>
                                                        <input type="text" list="dsnvpt" id="nhanvienpt" placeholder="Nhập họ tên nhân viên" class="form-control"/>
                                                        <datalist id="dsnvpt">
                                                            @if(isset($dsnv))
                                                                @foreach($dsnv as $nv)
                                                            <option data-value="{{$nv->IdNV}}">{{$nv->TenNV}}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                        <input type="hidden" id="nhanvienpt_hide">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Phương pháp thực hiện (<span class="color-red">*</span>)</label>
                                                        <textarea rows="1" id="ppth" placeholder="Phương pháp thực hiện ca phẫu thuật này, vv..." class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class=" form-control-label">Loại chỉ định</label>
                                                        <select class="form-control" id="loaicdpt">
                                                            <option value="0">Thường</option>
                                                            <option value="1">Khẩn</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1" id="btnrachidinhptarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Ra chỉ định phẫu thuật" id="btnracdpt"><span class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnsuacdptarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Cập nhật" id="btnsuacdpt"><span class="fa fa-edit"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnincdptsarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--green au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="In phiếu" id="btninphieupt"><span class="zmdi zmdi-print"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 hidden" id="btnlamlaiptarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn-orange au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Hủy" id="btnlamlaipt"><span class="fa fa-eraser"></span></button>
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
                                <div class="table-data__tool">
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row hidden" id="dtbiareapt">
                                            <div class="col-lg-12">
                                                <label style="font-weight: normal" id="dtbipt">Đang tạo bản in!</label>
                                            </div>
                                        </div>
                                        <div class='row hidden' id="proccesspt">
                                            <div class='col-lg-12'>

                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                        <span>Vui lòng chờ<span class="dotdotdot"></span></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2 fit_table_height_300 tableFixHead">
                                    <table class="table table-data2 table-hover m-b-20 text-center">
                                        <thead>
                                            <tr>
                                                <th>Tên phẫu thuật</th>
                                                <th>Phòng thực hiện</th>
                                                <th>nhân viên thực hiện chính</th>
                                                <th>Phương pháp thực hiện</th>
                                                <th>Ngày ra chỉ định</th>
                                                <th>thao tác</th>
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
        <!--END MODAL RA CHỈ ĐỊNH PHẪU THUẬT-->
        
        <!--MODAL XEM CHỈ ĐỊNH PHẪU THUẬT-->
        <div class="modal fade" id="modalxempt" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Xem chỉ định phẫu thuật</h5>
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
                                                <th>nhân viên thực hiện chính</th>
                                                <th>Phương pháp thực hiện</th>
                                                <th>Ngày ra chỉ định</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_xemcdpt">

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

        <!--MODAL GIẤY RA VIỆN-->
        <div class="modal fade" id="modalgrv" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel1">Lập giấy ra viện</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body fit_table_height_500">
                        <div class="row fit_table_height_500" style="font-family: Verdana; font-size: 8pt;">
                            <div style="width: 45px !important;"></div>
                            <div class="col-lg-10" id="print_content_grv" >
                                <div class="card" style="font-weight: normal; height: 700px; width: 660px !important;">
                                    <div class="card-block card-body printcontent_grv" style="height: 700px; width: 660px !important; font-weight: 800;">
                                        <div class="row" style="font-size: 7pt;">
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-4 text-center" style="margin: 0; padding: 0;">
                                                        <label><img src="public/images/logo3.png" style="height: 50px;"></label>
                                                    </div>
                                                    <div class="col-lg-8" style="margin: 0; padding: 0;">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                 <label style="margin-bottom: 0;">Sở Y tế An Giang</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                 <label style="margin-bottom: 0;">Bệnh Viện ĐKTT An Giang</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                 <label style="margin-bottom: 0;">Khoa:</label> <label style="margin-bottom: 0;" id="grv_khoa"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 text-center">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                        <label style="margin-bottom: 0;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</label>
                                                     </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">Độc lập - Tự do - Hạnh phúc</label>
                                                        <hr class="line-seprate" style="margin-top: 10px; margin-left: 85px; background: black; width: 30%;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">MS: 01/BV-01</label>
                                                     </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">Số lưu trữ:</label> <label style="margin-bottom: 0;" id="slt">...............</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                         <label style="margin-bottom: 0;">Mã Y tế:</label> <label style="margin-bottom: 0;" id="myt"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row text-center m-b-25">
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-11">
                                                <label style="margin-bottom: 0; font-size: 12pt">GIẤY RA VIỆN</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-6">
                                                <label style="margin-bottom: 0;">Họ tên bệnh nhân:</label> <label style="margin-bottom: 0; font-size: 8pt; font-weight: normal" id="grv_hoten"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0;">Tuổi:</label> <label style="margin-bottom: 0; font-weight: normal" id="grv_tuoi"></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label style="margin-bottom: 0;">Nam/Nữ:</label> <label style="margin-bottom: 0; font-weight: normal" id="grv_gt"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-5">
                                                <label style="margin-bottom: 0;">Dân tộc:</label> <label style="margin-bottom: 0; font-weight: normal" id="grv_dt"></label>
                                            </div>
                                            <div class="col-lg-7">
                                                <label style="margin-bottom: 0;">Nghề nghiệp:</label> <label style="margin-bottom: 0; font-weight: normal">................................................................</label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5 hidden" id="grv_mathe_area">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Mã thẻ BHYT:</label> <label style="margin-bottom: 0; font-weight: normal" id="grv_mathe"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Địa chỉ:</label> <label style="margin-bottom: 0; font-weight: normal" id="grv_diachi"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Vào viện lúc: </label> <label style="margin-bottom: 0; font-weight: normal" id="grv_vvl"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Ra viện lúc: </label> <label style="margin-bottom: 0; font-weight: normal" id="grv_rvl"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Chuẩn đoán: </label> <label style="margin-bottom: 0; font-weight: normal" id="grv_cd"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Phương pháp điều trị: </label> <label style="margin-bottom: 0; font-weight: normal" id="grv_ppdt"></label>
                                            </div>
                                        </div>
                                        <div class="row m-b-20">
                                            <div class="col-lg-12">
                                                <label style="margin-bottom: 0;">Ghi chú: </label> <label style="margin-bottom: 0; font-weight: normal" id="grv_ghichu"></label>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <label style="margin-bottom: 0; font-size: 8pt; font-weight: normal">Ngày.......tháng.......năm.........</label><br>
                                                <label style="margin-bottom: 0">Thủ trưởng đơn vị</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal">(Ký tên, đóng dấu)</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">...........................</label>
                                            </div>
                                            <div class="col-lg-4">
                                                <label style="margin-bottom: 0; font-size: 8pt; font-weight: normal">Ngày.......tháng.......năm........</label><br>
                                                <label style="margin-bottom: 0">Trưởng khoa</label><br>
                                                <label style="margin-bottom: 50px; font-weight: normal">(Ký tên và ghi rõ họ tên)</label><br>
                                                <label style="margin-bottom: 0; font-weight: normal">...........................</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="font-size: 9pt;">
                                    <div class="card-body card-block">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-12" id="ghichugrvarea">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Ghi chú thêm</label>
                                                        <textarea rows="1" class="form-control" id="ghichugrv"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 hidden" id="cdarea">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Chủ đề file</label>
                                                        <textarea rows="1" class="form-control" id="cd" placeholder="Nhập chủ đề file..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 hidden" id="filearea">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Chọn file</label>
                                                        <input multiple="" type="file" class="form-control" id="filebc">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 text-right" id="btngrvarea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--print au-btn--small au-btn-shadow height-40px" rel="tooltip" title="In giấy ra viện" id="btngrv"><span class="zmdi zmdi-print"></span></button>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-2 hidden text-center" id="bntfilearea">
                                                    <div class="form-group">
                                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Gửi giấy ra viện cho thủ trưởng duyệt" id="btnguifile"><span class="fa fa-upload"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 text-left hidden" id="btnhuygrvarea">
                                                    <div class="form-group" >
                                                        <button type="button" class="au-btn au-btn--close au-btn--small au-btn-shadow height-40px" rel="tooltip" title="Hủy giấy ra viện" id="btnhuygrv"><span class="fa fa-remove"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="font-size: 8pt;">
                                                <div class="col-lg-12">
                                                    <div class="row hidden" id="dtbiareagrv">
                                                        <div class="col-lg-12">
                                                            <label style="font-weight: normal" id="dtbigrv">Đang tạo bản in!</label>
                                                        </div>
                                                    </div>
                                                    <div class='row hidden' id="proccessgrv">
                                                        <div class='col-lg-12'>

                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                    <span style="font-size: 8pt;">Vui lòng chờ<span class="dotdotdot"></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
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
        </div>
        <!--END MODAL GIẤY RA VIỆN-->
        
        <!-- DATA TABLE-->
        <section class="p-t-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" m-b-35">
                            <h3 class="title-5 font-weight-bold text-green">DANH SÁCH BỆNH ÁN NỘI TRÚ - KHOA [{{$tenkhoa}}] - BS. {{$tennv}}</h3>
                            <hr class="line-seprate">
                        </div>

                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="au-breadcrumb-content">
                                    <form class="au-form-icon--sm" id="ftimkiem" >
                                        <input type="text" class="au-input--w300 au-input--style2" id="txttimkiem" placeholder="Nhập thông tin cần tìm...">
                                        <button type="button" class="au-btn--submit2" data-toggle="tooltip" title="Tìm kiếm" id="btntimkiem">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <button type="button" class="au-btn au-btn--green au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Tiếp nhận bệnh án chuyển đến" id="btnnhanba"><i class="fa fa-cloud-download"></i></button>
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
                                        <th style="position: sticky; top: 0; z-index: 99;">Họ tên bệnh nhân</th>
                                        <th>Đối tượng tiếp nhận</th>
                                        <th>Chuẩn đoán</th>
                                        <th>Ngày nhập viện</th>
                                        <th>Lý do nhập viện</th>
                                        <th>Tình trạng lúc nhập viện</th>
                                        <th>giường bệnh số</th>
                                        <th>Số ngày điều trị</th>
                                        <th>Trạng thái bệnh án</th>
                                        <th>thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_banoi">
                                    @if(isset($dsba))
                                    @foreach($dsba as $ba)
                                    <tr class="tr-shadow">
                                        <td style="vertical-align: middle;">
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                <input type="checkbox" data-input="check" data-id="{{ $ba->IdBANoiT }}" data-name="<?php echo $ba->phieuDKKham->phieuDKKham->benhNhan->HoTen; ?>">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>{{$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen}}</td>
                                        <td>
                                            @if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 0)
                                                BHYT
                                            @else
                                                Thu phí
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            @foreach($ba->chuanDoan as $cd)
                                                {{'- '.$cd->danhMucBenh->TenBenh}}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{\comm_functions::deDateFormat($ba->created_at)}}
                                        </td>
                                        <td>
                                            {{$ba->LyDoNV}}
                                        </td>
                                        <td>
                                            
                                            <?php 
                                            if($ba->GhiChu !=''){
                                                $ttlv='Tỉnh táo';
                                                if($ba->TTLucVao == 'hon_me'){
                                                    $ttlv='Hôn mê';
                                                }
                                                else if($ba->TTLucVao == 'hon_me_sau'){
                                                    $ttlv='Hôn mê sâu';
                                                }
                                                echo $ttlv.' - '.$ba->GhiChu;
                                            }
                                            else{
                                                $ttlv='Tỉnh táo';
                                                if($ba->TTLucVao == 'hon_me'){
                                                    $ttlv='Hôn mê';
                                                }
                                                else if($ba->TTLucVao == 'hon_me_sau'){
                                                    $ttlv='Hôn mê sâu';
                                                }
                                                echo $ttlv;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            Phòng {{$ba->thietBiYT->phongBan->SoPhong}} - Giường số {{$ba->thietBiYT->SoTB}}
                                        </td>
                                        <td>
                                            <?php
                                                if($ba->TrangThaiBA == 0){
                                                    if(count($ba->benhAnNoiTruCT) > 0){
                                                        foreach ($ba->benhAnNoiTruCT as $value) {
                                                            $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                                            $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                                                            $t= date_diff($timeba, $present);
                                                            echo $t->format('%a') + 1;
                                                            break;
                                                        }
                                                    }
                                                    else{
                                                        echo '1';
                                                    }
                                                }
                                                else{
                                                    if(count($ba->benhAnNoiTruCT) > 0){
                                                        foreach ($ba->benhAnNoiTruCT as $value) {
                                                            $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                                            $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                                                            $t= date_diff($timeba, $present);
                                                            echo $t->format('%a') + 1;
                                                            break;
                                                        }
                                                    }
                                                    else{
                                                        $present= date_create(date('Y-m-d H:m:s'));
                                                        $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                                                        $t= date_diff($timeba, $present);
                                                        echo $t->format('%a') + 1;
                                                    }
                                                }
                                                
                                            ?> 
                                        </td>
                                        <td data-ttba="{{$ba->IdBANoiT}}">
                                            @if($ba->TrangThaiBA==0)
                                                {{"Đã kết thúc điều trị"}}
                                            @else
                                                {{"Đang điều trị"}}
                                            @endif
                                        </td> 
                                        <td>
                                            <div class="table-data-feature">
                                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="btnsua" data-id="{{$ba->IdBANoiT}}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="{{$ba->IdBANoiT}}" data-name="{{$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen}}">
                                                    <i class="zmdi zmdi-delete"  ></i>
                                                </button>
<!--                                                <button class="item hidden" data-toggle="tooltip" title="In Bệnh Án">
                                                    <i class="zmdi zmdi-print"></i>
                                                </button>-->
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
<script src="public/js/jspdf.debug.js"></script>
<script src="public/js/html2canvas.js"></script>
<script>
    $(function () {
        //khởi tạo flag tìm kiếm
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false, htbn=false, bnddd=false, themba=false, flagcls=false, flagtt=false, flagpt=false, file_name_tt='', tstrangtt = 1, dskham='', giuongc='';
        //end
        
        //print functions
        var element_section,HTML_Width,HTML_Height,top_left_margin,PDF_Width,PDF_Height;
	
        function calculatePDF_height_width(selector,index){
		element_section = $(selector).eq(index);
		HTML_Width = element_section.width();
		HTML_Height= element_section.height();
		top_left_margin = 25;
		PDF_Width = HTML_Width + (top_left_margin * 2);
		PDF_Height = (PDF_Width * 1.2) + (top_left_margin * 2);
	}
        
        var dd=new Date();
        if($('#datetimepickerfilter1').length){
            $('#datetimepickerfilter1').datetimepicker({
                icons: {
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                defaultDate: dd,
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
                defaultDate: dd,
                format: "DD/MM/YYYY"
            });

        }
        $('#thoigiandenngay').on('input', function (){
            $('#datetimepickerfilter2').datetimepicker('minDate', new Date());
        });
        
        
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

            $('#dtbiareagrv').removeClass('hidden');$('#dtbigrv').text('Đang xử lý!');
            $('#proccessgrv').removeClass('hidden');
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('cd', cd);
            formData.append('pl', 'grv');
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
                        $('#dtbigrv').text('Đã xử lý xong!');
                        $('#proccessgrv').addClass('hidden');
                    }
                    else if(data.msg == 'ko_ho_tro_kieu_file'){
                        alert("Không hỗ trợ kiểu file upload! Kiểu hỗ trợ là file .pdf hoặc .docx");
                        $('#proccessgrv').addClass('hidden');
                        $('#dtbiareagrv').addClass('hidden');
                    }
                    else{
                        alert("Up file thất bại! Lỗi: "+data.msg);
                        $('#proccessgrv').addClass('hidden');
                        $('#dtbiareagrv').addClass('hidden');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#proccessgrv').addClass('hidden');
                    $('#dtbiareagrv').addClass('hidden');
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

        //chuyển bệnh án chuyên khoa
        $('#btncba').click(function (){
            var id=$('#btnchuyenba').attr('data-id'), ghichu=$('#ghichubachuyen').val(), nv=$('#dsnv_k').val();
           
            $('#dxlarea').removeClass('hidden');$('#dxl').text('Đang xử lý!');
            $('#proccessdxl').removeClass('hidden');
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('ghichu', ghichu);
            formData.append('nv', nv);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/cap_cuu/chuyen_ba',
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
                        $('#dxl').text('Đã chuyển thành công!');
                        $('#proccessdxl').addClass('hidden');
                    }
                    else if(data.msg =='da_chuyen_vien'){
                        $('#dxlarea').addClass('hidden');
                        $('#proccessdxl').addClass('hidden');
                        alert("Bệnh đã chuyển đi điều trị ở nơi khác!");
                    }
                    else if(data.msg =='da_chuyen'){
                        $('#dxlarea').addClass('hidden');
                        $('#proccessdxl').addClass('hidden');
                        alert("Bệnh án vừa được chuyển!");
                    }
                    else if(data.msg =='ktt'){
                        $('#dxlarea').addClass('hidden');
                        $('#proccessdxl').addClass('hidden');
                        alert("Bệnh án này không tồn tại có thể đã bị xóa!");
                    }
                    else{
                        $('#dxlarea').addClass('hidden');
                        $('#proccessdxl').addClass('hidden');
                        alert("Chuyển bệnh án thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dxlarea').addClass('hidden');
                    $('#proccessdxl').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Chuyển bệnh án thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Chuyển bệnh án thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Chuyển bệnh án thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end
        
        //xóa bệnh án chuyển đến
        $('#btnkotiepnhan').click(function(){
            if($('#dsbachotn').children().length > 0){
                $('#dtbiareaba').addClass('hidden');
                $('#proccessba').addClass('hidden');
                var cf=confirm('Bạn có chắc chắn không muốn tiếp nhận bệnh án này?');
                if(cf==false){
                    return false;
                }
                var id=$('#dsbachotn').val();
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/cap_cuu/xoa_ba_cn',
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
                            alert("Xóa bệnh án thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa bệnh án thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa bệnh án thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa bệnh án thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
            
        });
        //end
        
        //tiếp nhận bệnh án chuyển đến
        $('#btntiepnhan').click(function(){
            if($('#dsbachotn').children().length > 0){
                $('#dtbiareaba').removeClass('hidden');$('#dtbiba').text('Đang xử lý!');
                $('#proccessba').removeClass('hidden');
                var id=$('#dsbachotn').val();
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/nhan_ba',
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
                            alert("Tiếp nhận bệnh án thành công!");
                            $('#dtbiba').text('Đã xử lý xong!');
                            $('#proccessba').addClass('hidden');
                        }
                        else if(data.msg =='da_chuyen_vien'){
                            alert("Bệnh đã chuyển đi điều trị ở nơi khác!");
                            $('#dtbiareaba').addClass('hidden');
                            $('#proccessba').addClass('hidden');
                        }
                        else if(data.msg =='ktt'){
                            alert("Bệnh án này không tồn tại có thể đã bị xóa!");
                            $('#dtbiareaba').addClass('hidden');
                            $('#proccessba').addClass('hidden');
                        }
                        else{
                            alert("Tiếp nhận bệnh án thất bại! Lỗi: "+data.msg);
                            $('#dtbiareaba').addClass('hidden');
                            $('#proccessba').addClass('hidden');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Tiếp nhận bệnh án thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Tiếp nhận bệnh án thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Tiếp nhận bệnh án thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                        $('#dtbiareaba').addClass('hidden');
                            $('#proccessba').addClass('hidden');
                    }
                });
            }
            
        });
        //end
        
        //xem chi tiết thuốc điều trị của bệnh án chuyển đến
        $('#btnxemtoathuoc').click(function(){
            $('#tbl_xemtt').html('');
            if($('#dsbachotn').children().length > 0){
                var id=$('#dsbachotn').val();
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/xem_toa_thuoc',
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
                            if(data.dstoact.length > 0){
                                var toact='';
                                for(var i=0; i<data.dstoact.length; ++i){
                                    toact+='\n\
                                        <tr class="tr-shadow">\n\
                                        <td>'+data.dstoact[i].tenthuoc+'</td>\n\
                                        <td>'+data.dstoact[i].dvt+'</td>\n\
                                        <td>'+data.dstoact[i].cachdung+'</td>\n\
                                        <td>'+data.dstoact[i].lieudung+'</td>\n\
                                        <td>'+data.dstoact[i].sl+'</td>\n\
                                        <td>'+data.dstoact[i].ghichu+'</td>\n\
                                        <td>'+data.dstoact[i].ngaycap+'</td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                                }
                                $('#tbl_xemtt').html(toact);
                            }
                        }
                        else{
                            alert("Lấy thông tin toa thuốc thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Lấy thông tin toa thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Lấy thông tin toa thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Lấy thông tin toa thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
            
        });
        //end
        
        //xem các kết quả cận lâm sàng của bệnh án chuyển đến
        $('#btnxemketquacls').click(function(){
            $('#tbl_kqcls').html('');
            if($('#dsbachotn').children().length > 0){
                var id=$('#dsbachotn').val();
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/xem_ket_qua_cls',
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
                                        <td class="vertical-align-midle">'+data.kqcls[i].tencls+'</td>\n\
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
                            alert("Lấy thông tin kết quả cls thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Lấy thông tin kết quả cls thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Lấy thông tin kết quả cls thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Lấy thông tin kết quả cls thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
            
        });
        //end
        
        //xem các chỉ định thủ thuật của bệnh án chuyển đến
        $('#btnxemchidinhtt').click(function(){
            $('#tbl_xemcdtt').html('');
            if($('#dsbachotn').children().length > 0){
                var id=$('#dsbachotn').val();
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/xem_chi_dinh_tt',
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
                            if(data.dscdtt.length > 0){
                                var cdtt='';
                                for(var i=0; i<data.dscdtt.length; ++i){
                                    cdtt+='\n\
                                        <tr class="tr-shadow">\n\
                                        <td>'+data.dscdtt[i].tentt+'</td>\n\
                                        <td>'+data.dscdtt[i].phongth+'</td>\n\
                                        <td>'+data.dscdtt[i].nv+'</td>\n\
                                        <td>'+data.dscdtt[i].ngayracd+'</td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                                }
                                $('#tbl_xemcdtt').html(cdtt);
                            }
                        }
                        else{
                            alert("Lấy thông tin chỉ định thủ thuật thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Lấy thông tin chỉ định thủ thuật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Lấy thông tin chỉ định thủ thuật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Lấy thông tin chỉ định thủ thuật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
            
        });
        //end
        
        //xem các chỉ định phẫu thuật của bệnh án chuyển đến
        $('#btnxemchidinhpt').click(function(){
            $('#tbl_xemcdpt').html('');
            if($('#dsbachotn').children().length > 0){
                var id=$('#dsbachotn').val();
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/xem_chi_dinh_pt',
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
                            if(data.dscdpt.length > 0){
                                var cdpt='';
                                for(var i=0; i<data.dscdpt.length; ++i){
                                    cdpt+='\n\
                                        <tr class="tr-shadow">\n\
                                            <td>'+data.dscdpt[i].tenpt+'</td>\n\
                                            <td>'+data.dscdpt[i].phongth+'</td>\n\
                                            <td>'+data.dscdpt[i].nv+'</td>\n\
                                            <td>'+data.dscdpt[i].ppth+'</td>\n\
                                            <td>'+data.dscdpt[i].ngayracd+'</td>\n\
                                        </tr>\n\
                                     <tr class="spacer"></tr>';
                                }
                                $('#tbl_xemcdpt').html(cdpt);
                            }
                        }
                        else{
                            alert("Lấy thông tin chỉ định phẫu thuật thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Lấy thông tin chỉ định phẫu thuật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Lấy thông tin chỉ định phẫu thuật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Lấy thông tin chỉ định phẫu thuật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
            
        });
        //end
        
        $('#btnnhanba').click(function(e){
            $('#dschotnba').slideDown(800);
            $('html, body').animate({
                scrollTop: $("#dschotnba").offset().top
            }, 800);
            $('#dtbiareaba').addClass('hidden');
            $('#proccessba').addClass('hidden');

        });
        
        $('#btndongdstn').click(function(e){
            $('#dschotnba').slideUp(800);
        });

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
                    var ba='<option value="'+data.ba.idba+'">BN. '+data.ba.bn+' - Khoa ['+data.ba.khoa+'] - BSDT. '+data.ba.nv+'</option>';  
                    $('#dsbachotn').append(ba);
                    if($('a[class*="cba"]').find('span[class*="quantity"]').length > 0){
                        $('span[class*="quantity"]').text(data.slba);
                        $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');
                    }
                    else{
                        var ct='<span class="quantity">'+data.slba+'</span>';
                        $('a[class*="cba"]').append(ct);
                        $('a[class*="cba"]').attr('data-original-title', 'Có '+data.slba+' bệnh án chờ tiếp nhận!');
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
            else if(data.tt == 'nhanba'){
                if($('#id_nv').val() == data.idnvnhan){
                    $('#dsbachotn option[value="'+data.ba.id+'"]').remove();
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
                    
                    var chuandoan='';
                    if($.isArray(data.ba.chuandoan))
                    {
                        for (var i = 0; i < data.ba.chuandoan.length; i++) {
                            if(i==data.ba.chuandoan.length-1){
                                chuandoan+='- '+data.ba.chuandoan[i];
                                break;
                            }
                            chuandoan+='- '+data.ba.chuandoan[i]+'<br>';
                        }
                    }
                    var ba='\n\
                        <tr class="tr-shadow">\n\
                            <td style="vertical-align: middle;">\n\
                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.ba.id+'" data-name="'+data.ba.hoten+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td data-idbn="'+data.ba.idbn+'">'+data.ba.hoten+'</td>\n\
                            <td>'+data.ba.dttn+'</td>\n\
                            <td class="text-left">'+chuandoan+'</td>\n\
                            <td>'+data.ba.ngaybddt+'</td>\n\
                            <td>'+data.ba.lydonv+'</td>\n\
                            <td>'+data.ba.ttbn+'</td>\n\
                            <td>'+data.ba.gb+'</td>\n\
                            <td>'+data.ba.songaydt+'</td>\n\
                            <td data-ttba="'+data.ba.id+'">'+data.ba.trangthaiba+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="btnsua" data-id="'+data.ba.id+'">\n\
                                        <i class="zmdi zmdi-edit"></i>\n\
                                    </button>\n\
                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="'+data.ba.id+'" data-name="'+data.ba.hoten+'">\n\
                                        <i class="zmdi zmdi-delete"  ></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>\n\
                        <tr class="spacer"></tr>';
                    $('#tbl_banoi').prepend(ba);
                    $('#tbl_banoi button[data-id="'+data.ba.id+'"]').tooltip({
                        trigger: 'manual'

                    })
                    .focus(hideTooltip)
                    .blur(hideTooltip)
                    .hover(showTooltip, hideTooltip);
                }
                if($('#id_nv').val() == data.idnvchuyen){
                    $('#tbl_banoi tr').has('td div button[data-id="'+data.ba.id+'"]').next('tr.spacer').remove();
                    $('#tbl_banoi tr').has('td div button[data-id="'+data.ba.id+'"]').remove();
                    
                    if($('#formba').css('display') == 'block' && (data.ba.id == $('#btncapnhat').attr('data-id') || data.ba.id == $('#btnxemctgd').attr('data-id'))){//đóng form sửa khi click xóa
                       $('#btndong').click();
                    }
                }
                $('#dsgiuong option[value="'+data.idtbnhan+'"]').replaceWith(data.gnhan);
                $('#dsgiuong option[value="'+data.idtbchuyen+'"]').replaceWith(data.gchuyen);
            }
            else{
                if($('#id_nv').val() == data.idnvnhan){
                    $('#dsbachotn option[value="'+data.ba+'"]').remove();
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
        
        //Đăng ký với kênh BenhAnNoiTru đã tạo trong file BenhAnNoiTru.php
        var channel = pusher.subscribe('BenhAnNoiTru');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                if($('#id_nv').val() == data.benhan.id_nv){
                    var chuandoan='';
                    if($.isArray(data.benhan.chuandoan))
                    {
                        for (var i = 0; i < data.benhan.chuandoan.length; i++) {
                            if(i==data.benhan.chuandoan.length-1){
                                chuandoan+='- '+data.benhan.chuandoan[i];
                                break;
                            }
                            chuandoan+='- '+data.benhan.chuandoan[i]+'<br>';
                        }
                    }
                    var ba='\n\
                        <tr class="tr-shadow">\n\
                            <td style="vertical-align: middle;">\n\
                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.benhan.id+'" data-name="'+data.benhan.hoten+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td data-idbn="'+data.benhan.idbn+'">'+data.benhan.hoten+'</td>\n\
                            <td>'+data.benhan.dttn+'</td>\n\
                            <td class="text-left">'+chuandoan+'</td>\n\
                            <td>'+data.benhan.ngaybddt+'</td>\n\
                            <td>'+data.benhan.lydonv+'</td>\n\
                            <td>'+data.benhan.ttbn+'</td>\n\
                            <td>'+data.benhan.gb+'</td>\n\
                            <td>'+data.benhan.songaydt+'</td>\n\
                            <td data-ttba="'+data.benhan.id+'">'+data.benhan.trangthaiba+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="btnsua" data-id="'+data.benhan.id+'">\n\
                                        <i class="zmdi zmdi-edit"></i>\n\
                                    </button>\n\
                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="'+data.benhan.id+'" data-name="'+data.benhan.hoten+'">\n\
                                        <i class="zmdi zmdi-delete"  ></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>\n\
                        ';
                    if(data.thaotac == 'them'){
                        ba+='<tr class="spacer"></tr>';
                        $('#tbl_banoi').prepend(ba);
                        $('#dsgiuong option[value="'+data.benhan.idtb+'"]').replaceWith(data.benhan.giuong);
                    }
                    else{
                        $('#tbl_banoi tr').has('td div button[data-id="'+data.benhan.id+'"]').replaceWith(ba);
                        $('#dsgiuong option[value="'+data.benhan.idtbm+'"]').replaceWith(data.benhan.giuongm);
                        $('#dsgiuong option[value="'+data.benhan.idtbc+'"]').replaceWith(data.benhan.giuongc);
                    }

                    $('#tbl_banoi button[data-id="'+data.benhan.id+'"]').tooltip({
                        trigger: 'manual'

                    })
                    .focus(hideTooltip)
                    .blur(hideTooltip)
                    .hover(showTooltip, hideTooltip);
                }
            }
            else{
                if($.isArray(data.benhan)){
                    for (var i = 0; i < data.benhan.length; i++) {
                        $('#tbl_banoi tr').has('td div button[data-id="'+data.benhan[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_banoi tr').has('td div button[data-id="'+data.benhan[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_banoi tr').has('td div button[data-id="'+data.benhan+'"]').next('tr.spacer').remove();
                    $('#tbl_banoi tr').has('td div button[data-id="'+data.benhan+'"]').remove();
                    
                }
            }
        }
        
        //Bind một function laytt với sự kiện BenhAnNoiTru.php
        channel.bind('App\\Events\\KhamVaDieuTri\\BenhAnNoiTru', laytt);
        //end xử lý channel
        
//        Đăng ký kênh chỉ định cls 
        var channelcls = pusher.subscribe('CanLamSang');
        function layttcls(data){
            if(data.thaotac != 'xoa'){
                if(data.thaotac != 'chuyendv'){
                    if($('#modalcdcls').hasClass('show') && $('#btnrachidinhcls').attr('data-id') == data.cls.idba){
                        var cls='\n\
                            <tr class="tr-shadow">\n\
                            <td style="vertical-align: middle;">\n\
                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.cls.idcls+'" data-name="'+data.cls.tencls+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td data-iddmcls="'+data.cls.iddmcls+'">'+data.cls.tencls+'</td>\n\
                            <td>'+data.cls.phongth+'</td>\n\
                            <td>'+data.cls.ngayracd+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.cls.idcls+'">\n\
                                        <i class="zmdi zmdi-edit"></i>\n\
                                    </button>\n\
                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.cls.idcls+'" data-name="'+data.cls.tencls+'">\n\
                                        <i class="zmdi zmdi-delete"></i>\n\
                                    </button>\n\
                                    <button type="button" data-button="in" class="item" data-toggle="tooltip" data-placement="top" title="In phiếu" data-id="'+data.cls.idcls+'">\n\
                                        <i class="zmdi zmdi-print" ></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>';
                        if(data.thaotac == 'them'){
                            cls+='<tr class="spacer"></tr>';
                            $('#tbl_cdcls').prepend(cls);
                        }
                        else{
                            $('#tbl_cdcls tr').has('td div button[data-id="'+data.cls.idcls+'"]').replaceWith(cls);
                        }

                        $('#tbl_cdcls button[data-id="'+data.cls.idcls+'"]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                    }
                }
            }
            else{
                if($.isArray(data.cls)){
                    for (var i = 0; i < data.cls.length; i++) {
                        $('#tbl_cdcls tr').has('td div button[data-id="'+data.cls[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_cdcls tr').has('td div button[data-id="'+data.cls[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_cdcls tr').has('td div button[data-id="'+data.cls+'"]').next('tr.spacer').remove();
                    $('#tbl_cdcls tr').has('td div button[data-id="'+data.cls+'"]').remove();

                }  
            }
        }
        
        //Bind một function layttcls với sự kiện CanLamSang.php
        channelcls.bind('App\\Events\\KhamVaDieuTri\\CanLamSang', layttcls);
        //end xử lý channel
        
//        Đăng ký kênh kết quả chỉ định cls 
        var channelkqcls = pusher.subscribe('KetQuaCLS');
        function layttkqcls(data) {
            if(data.thaotac != 'xoa'){
                if($('#modalcls').hasClass('show') && $('#btnxemkqcls').attr('data-id') == data.kqcls.idba){
                    var ketqua='';
                    if($.isArray(data.kqcls.kq))
                    {
                        for (var i = 0; i < data.kqcls.kq.length; i++) {
                            if(i==data.kqcls.kq.length-1){
                                ketqua+='- '+data.kqcls.kq[i];
                                break;
                            }
                            ketqua+='- '+data.kqcls.kq[i]+'<br>';
                        }
                    }
                    var ketluan='';
                    if($.isArray(data.kqcls.kl))
                    {
                        for (var i = 0; i < data.kqcls.kl.length; i++) {
                            if(i==data.kqcls.kl.length-1){
                                ketluan+='- '+data.kqcls.kl[i];
                                break;
                            }
                            ketluan+='- '+data.kqcls.kl[i]+'<br>';
                        }
                    }

                    var kqha='<div class="row">';var n=1;
                    if($.isArray(data.kqcls.kqha))
                    {
                        for (var i = 0; i < data.kqcls.kqha.length; i++) {
                            if(n % 2 == 0 ){
                                if(i < data.kqcls.kqha.length-1){
                                    kqha+='<div class="col-lg-6 m-b-15">\n\
                                        <img class="height-100px" src="public/upload/anhcls/'+data.kqcls.kqha[i]+'">\n\
                                    </div>\n\
                                </div>\n\
                                <div class="row">';
                                }
                                else{
                                    kqha+='<div class="col-lg-6 m-b-15">\n\
                                        <img class="height-100px" src="public/upload/anhcls/'+data.kqcls.kqha[i]+'">\n\
                                    </div>\n\
                                </div>';
                                }
                            }
                            else{
                                if(i < data.kqcls.kqha.length-1){
                                    kqha+='<div class="col-lg-6 m-b-15">\n\
                                        <img class="height-100px" src="public/upload/anhcls/'+data.kqcls.kqha[i]+'">\n\
                                        </div>';
                                }
                                else{
                                    kqha+='<div class="col-lg-6 m-b-15">\n\
                                        <img class="height-100px" src="public/upload/anhcls/'+data.kqcls.kqha[i]+'">\n\
                                    </div>\n\
                                </div>';
                                }
                            }
                            n++;
                        }
                    }
                    var kqcls='<tr>\n\
                        <td class="vertical-align-midle" data-idpkq="'+data.kqcls.idkqcls+'">'+data.kqcls.tencls+'</td>\n\
                        <td>'+data.kqcls.nvth+'</td>\n\
                        <td>'+data.kqcls.phong+'</td>\n\
                        <td>'+data.kqcls.ngayth+'</td>\n\
                        <td class="text-left">'+ketqua+'</td>\n\
                        <td>'+kqha+'</td>\n\
                        <td class="text-left">'+ketluan+'</td>\n\
                    </tr>';

                    if(data.thaotac == 'them'){
                        kqcls+='<tr class="spacer"></tr>';
                        $('#tbl_kqcls').prepend(kqcls);

                    }
                    else{
                        $('#tbl_kqcls tr').has('td[data-idpkq="'+data.kqcls.idkqcls+'"]').replaceWith(kqcls);
                    }
                }
            }
            else{
                if($.isArray(data.kqcls)){
                    for (var i = 0; i < data.kqcls.length; i++) {
                        $('#tbl_kqcls tr').has('td[data-idpkq="'+data.kqcls[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_kqcls tr').has('td[data-idpkq="'+data.kqcls[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_kqcls tr').has('td[data-idpkq="'+data.kqcls+'"]').next('tr.spacer').remove();
                    $('#tbl_kqcls tr').has('td[data-idpkq="'+data.kqcls+'"]').remove();

                }  
            }
        }
        
        //Bind một function layttkqcls với sự kiện KetQuaCLS.php
        channelkqcls.bind('App\\Events\\KhamVaDieuTri\\KetQuaCLS', layttkqcls);
        //end xử lý channel
        
//         Đăng ký kênh kết quả chỉ định thủ thuật 
        var channelcdtt = pusher.subscribe('ChiDinhTT');
        function layttcdtt(data) {
            if(data.thaotac != 'xoa'){
                if($('#modalthuthuat').hasClass('show') && $('#btnrachidinhtt').attr('data-id') == data.cdtt.idba){
                    var cdtt='\n\
                        <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.cdtt.idtt+'" data-name="'+data.cdtt.tentt+'" data-hotenbn="'+data.cdtt.benhnhan+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td data-iddmcls="'+data.cdtt.iddmcls+'">'+data.cdtt.tentt+'</td>\n\
                        <td>'+data.cdtt.phongth+'</td>\n\
                        <td>'+data.cdtt.nv+'</td>\n\
                        <td>'+data.cdtt.ngayracd+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.cdtt.idtt+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.cdtt.idtt+'" data-name="'+data.cdtt.tentt+'" data-hotenbn="'+data.cdtt.benhnhan+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                    if(data.thaotac == 'them'){
                        cdtt+='<tr class="spacer"></tr>';
                        if($('#tbl_cdtt').children().length  == 0){
                            $('#btninphieutt').attr('data-id', $('#btnrachidinhtt').attr('data-id'));
                        }
                        $('#tbl_cdtt').prepend(cdtt);
                    }
                    else{
                        $('#tbl_cdtt tr').has('td div button[data-id="'+data.cdtt.idtt+'"]').replaceWith(cdtt);
                    }
                    $('#tbl_cdtt button[data-id="'+data.cdtt.idtt+'"]').tooltip({
                        trigger: 'manual'

                    })
                    .focus(hideTooltip)
                    .blur(hideTooltip)
                    .hover(showTooltip, hideTooltip);
                }
            }
            else{
                if($.isArray(data.cdtt)){
                    for (var i = 0; i < data.cdtt.length; i++) {
                        $('#tbl_cdtt tr').has('td div button[data-id="'+data.cdtt[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_cdtt tr').has('td div button[data-id="'+data.cdtt[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_cdtt tr').has('td div button[data-id="'+data.cdtt+'"]').next('tr.spacer').remove();
                    $('#tbl_cdtt tr').has('td div button[data-id="'+data.cdtt+'"]').remove();

                }  
            }
        }
        
        //Bind một function layttcdtt với sự kiện ChiDinhTT.php
        channelcdtt.bind('App\\Events\\KhamVaDieuTri\\ChiDinhTT', layttcdtt);
        //end xử lý channel
        
        //         Đăng ký kênh kết quả chỉ định phẫu thuật 
        var channelcdpt = pusher.subscribe('ChiDinhPT');
        function layttcdpt(data) {
            if(data.thaotac != 'xoa'){
                if($('#modalpt').hasClass('show') && $('#btnrachidinhpt').attr('data-id') == data.cdpt.idba){
                    var cdpt='\n\
                        <tr class="tr-shadow">\n\
                            <td data-iddmcls="'+data.cdpt.iddmcls+'">'+data.cdpt.tenpt+'</td>\n\
                            <td>'+data.cdpt.phongth+'</td>\n\
                            <td>'+data.cdpt.nv+'</td>\n\
                            <td>'+data.cdpt.ppth+'</td>\n\
                            <td>'+data.cdpt.ngayracd+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.cdpt.idpt+'">\n\
                                        <i class="zmdi zmdi-edit"></i>\n\
                                    </button>\n\
                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.cdpt.idpt+'" data-name="'+data.cdpt.tenpt+'" data-hotenbn="'+data.cdpt.benhnhan+'">\n\
                                        <i class="zmdi zmdi-delete"></i>\n\
                                    </button>\n\
                                    <button type="button" data-button="in" class="item" data-toggle="tooltip" data-placement="top" title="In phiếu" data-id="'+data.cdpt.idpt+'">\n\
                                        <i class="zmdi zmdi-print" ></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>';
                    if(data.thaotac == 'them'){
                        cdpt+='<tr class="spacer"></tr>';
                        
                        $('#tbl_cdpt').prepend(cdpt);
                    }
                    else{
                        $('#tbl_cdpt tr').has('td div button[data-id="'+data.cdpt.idpt+'"]').replaceWith(cdpt);
                    }
                    $('#tbl_cdpt button[data-id="'+data.cdpt.idpt+'"]').tooltip({
                        trigger: 'manual'

                    })
                    .focus(hideTooltip)
                    .blur(hideTooltip)
                    .hover(showTooltip, hideTooltip);
                }
            }
            else{
                if($.isArray(data.cdpt)){
                    for (var i = 0; i < data.cdpt.length; i++) {
                        $('#tbl_cdpt tr').has('td div button[data-id="'+data.cdpt[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_cdpt tr').has('td div button[data-id="'+data.cdpt[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_cdpt tr').has('td div button[data-id="'+data.cdpt+'"]').next('tr.spacer').remove();
                    $('#tbl_cdpt tr').has('td div button[data-id="'+data.cdpt+'"]').remove();

                }  
            }
        }
        
        //Bind một function layttcdpt với sự kiện ChiDinhPT.php
        channelcdpt.bind('App\\Events\\KhamVaDieuTri\\ChiDinhPT', layttcdpt);
        //end xử lý channel
        
        $('#btnthemcd').click(function (){
            var flag=false;
            $('#dschuadoan option').each(function(){
                if($(this).attr('value') == $('#chuandoan_hide').val()){
                    flag=true;
                    return false;
                }
            });
            
            $('input[list="dsbenh"]').trigger('input');
            
            if(flag==false && $('#chuandoan_hide').val() != '')
            {
                if(themba == true){
                    $('#dschuadoan').prepend('<option value="'+$('#chuandoan_hide').val()+'">'+$('#chuandoan').val()+'</option>');
                }
            }
            
        });
        
        $('#btnxoacd').click(function(){
            if(themba == true)
            {
                $('#dschuadoan option[value="'+$('#dschuadoan').val()+'"]').remove();
            }
            
        });
        
        $('input[list="dsbenh"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('chuandoan_hide'),
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

        //Submit cập nhật bệnh án
        $('#btncapnhat').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('#tbl_banoi input[data-input="check"]').prop("checked",false);
            
            var lydonv=$('#lydonv').val(), ghichu=$('#ghichuba').val(), giuong=$('#dsgiuong').val();
            
            if(lydonv.toString().trim() == ''){
                alert('Vui lòng nhập lý do bệnh nhân nhập viện!');
                return false;
            }
            var chuandoan=[];
            $('#dschuadoan option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        chuandoan.push(this.value);
                    }
                });
            });
            if(chuandoan.length == 0)
            {
                alert('Vui lòng chuẩn đoán bệnh cho bệnh nhân!');
                return false;
            }
            
            if($('#dsgiuong option[value="'+giuong+'"]').attr('data-ttsd') == 1 && giuong != giuongc){
                var cf=confirm('Giường bệnh hiện tại có bệnh nhân đang sử dụng, bạn có muốn tiếp tục?');
                if(cf==false){
                    return false;
                }
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            formData.append('lydonv', lydonv);
            formData.append('ghichu', ghichu);
            formData.append('chuandoan', chuandoan);
            formData.append('giuong', giuong);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/cap_nhat',
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
                        if(data.flag == true){
                            $('#dsgiuong option[value="'+data.idtbc+'"]').replaceWith(data.giuongc);
                            $('#dsgiuong option[value="'+data.idtbm+'"]').replaceWith(data.giuongm);
                            giuongc=data.giuongm;
                        }
                        alert("Cập nhật bệnh án thành công!");
                    }
                    else{
                        alert("Cập nhật bệnh án thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật bệnh án thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật bệnh án thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật bệnh án thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật bệnh án
        
        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formba').slideUp(800);
            if($('#tblBACT').css('display') == 'block'){
                $('#btndongdsbact').click();
            }
        });
        //end đóng form nhập liệu

        //xóa bệnh án
        $('#tbl_banoi').on('click', 'button[data-button="btnxoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin bệnh án của bệnh nhân "+name+"?");
            if(cf==true){
                if($('#formba').css('display') == 'block' && id == $('#btncapnhat').attr('data-id')){//đóng form sửa khi click xóa
                   $('#btndong').click();
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" bệnh án được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" bệnh án tìm thấy!");
                                    }
                                }
                            }
                            if($('#tbl_banoi').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            $('#dsgiuong option[value="'+data.idtb+'"]').replaceWith(data.giuong);
                            alert("Xóa thông tin bệnh án thành công!");
                        }
                        else{
                            alert("Xóa thông tin bệnh án thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin bệnh án thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin bệnh án thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin bệnh án thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa bệnh án
        
        //mở form để sửa
        $('#tbl_banoi').on('click','button[data-button="btnsua"]',function(){
            var formData = new FormData();
            var id=$(this).attr('data-id');
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            $('#btncapnhat').attr('data-id',id);
            $('#btnxemctgd').attr('data-id', id);
            $('#btngiayrv').attr('data-id', id);
            $('#btnlapphieukk').attr('data-id', id);
            $('#btndongdsbact').click();
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/lay_tt_cap_nhat',
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
                        themba=true;
                        // Success
                        $('#hoten').val(data.hotenbn);$('#hoten').attr('data-id', data.mabn);$('#ngaysinh').val(data.ngaysinh);$('#gt').val(data.gt);$('#dantoc').val(data.dantoc);$('#scmnd').val(data.socmnd);$('#diachi').val(data.diachi);
                        $('#tinhtrangbn').val(data.ttbn);$('#ghichuba').val(data.ghichu);
                        $('#lydonv').val(data.lydonv);$('#dsgiuong').val(data.giuong);
                        $('#doituongtn').val(data.dttn);
                        giuongc=data.giuong;
                        if(data.anh != null && data.anh !='' && data.anh != 'null')
                        {
                            $('p[class*="anhbn"]').addClass('hidden');$('img[class*="anhbn"]').attr('src','public/upload/anhbn/'+data.anh);$('img[class*="anhbn"]').removeClass('hidden');
                        }
                        else
                        {
                            $('p[class*="anhbn"]').removeClass('hidden');$('img[class*="anhbn"]').addClass('hidden');
                        }   
                        
                        if(data.htk == 'bhyt'){
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
                        if(data.chuyenvien == true){
                            $('#btngcvarea').fadeIn(800);
                            $('#btngcv').attr('data-id', id);
                        }
                        else{
                            $('#btngcvarea').fadeOut(800);
                            $('#btngcv').attr('data-id', '');
                        }
                        if(data.chuyenba == true){
                            $('#btnchuyenbaarea').fadeIn(800);
                            $('#btnchuyenba').attr('data-id', id);
                        }
                        else{
                            $('#btnchuyenbaarea').fadeOut(800);
                            $('#btnchuyenba').attr('data-id', '');
                        }

                        $('#formba').slideDown(800);
                        
                        $('html, body').animate({
                            scrollTop: $("#formba").offset().top
                        }, 800);
                    }
                    else{
                        giuongc='';
                        alert("Lấy dữ liệu thất bại. Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    giuongc='';
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
  
        $('#tbl_bact').on('click', 'button[data-button="btnxemtt"]', function(){
            var idba=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idba);
            $('#tbl_xemtoathuoc').html('');
            $('#ghichutoathuoc_xem').val('');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru_ct/lay_ds',
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
         
        $('#tbl_bact').on('click', 'button[data-button="btnxemcdtt"]', function(){
            var idba=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idba);
            $('#tbl_xemcdtt').html('');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/lay_ds_noi',
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
                        if(data.dscdtt.length > 0){
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
        
        $('#btnxemkqcls').click(function (e, maba){
            var idba=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if($.isEmptyObject(maba)){
                formData.append('idba', idba);
            }
            else{
                formData.append('idba', maba);
            }
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
        
        $('#tbl_bact').on('click','button[data-button="btnxemkqcls"]',function(){
            var idba=$(this).attr('data-id');
            $('#btnxemkqcls').attr('data-id', idba);
            $('#btnxemkqcls').trigger('click', idba);
        });
        
        //click check sum
        $('body').on('change', 'input[data-input="checksum"]', function(){
            if($(this).prop("checked")){
                $('#tbl_banoi input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_banoi input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_banoi').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksum"]').prop("checked",false);
            }
            else{
                if($('#tbl_banoi input[data-input="check"]:checked').length == $('#tbl_banoi input[data-input="check"]').length){
                    $('input[data-input="checksum"]').prop("checked",true);
                }   
            }
        });
        //end
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if(!$('#tbl_banoi input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn bệnh án để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[];
                $('#tbl_banoi input[data-input="check"]').each(function(){
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin bệnh án của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin bệnh án của bệnh nhân "+name+"?");
                }
                if(cf==true){
                    for (var i = 0; i < arr.length; i++) {
                        if($('#formba').css('display') == 'block' && arr[i] == $('#btncapnhat').attr('data-id')){//đóng form sửa khi click xóa
                           $('#btndong').click();
                        }
                    }
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" bệnh án được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" bệnh án được tìm thấy!");
                                            }
                                        }
                                    }
                                    if($('#tbl_banoi').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    if(data.idtb.length > 0){
                                        for (var i = 0; i < data.idtb.length; i++) {
                                            $('#dsgiuong option[value="'+data.idtb[i]['id']+'"]').replaceWith(data.idtb[i]['nd']);
                                        }
                                    }
                                    alert("Xóa thông tin các bệnh án thành công!");
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" bệnh án được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" bệnh án được tìm thấy!");
                                        }
                                    }
                                    if($('#tbl_banoi').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    $('#dsgiuong option[value="'+data.idtb+'"]').replaceWith(data.giuong);
                                    alert("Xóa thông tin bệnh án thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các bệnh án thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin bệnh án thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các bệnh án thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các bệnh án thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các bệnh án thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin bệnh án thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin bệnh án thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin bệnh án thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }
                
            }
        });
        //end
        
        //giấy chuyển viện
        $('#btnhuygcv').click(function (){
            $('#dtbiareagcv').addClass('hidden');
            $('#proccessgcv').addClass('hidden');
            var cf=confirm('Bạn có chắc chắn muốn hủy giấy chuyển viện này?');
            if(cf == false){
                return false;
            }
            var id=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/xoa_noi',
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
                        $('#sct').text('.....................................');
                        $('#btnhuygcvarea').addClass('hidden');
                        $('#dauhieuls').removeAttr('readonly','');$('#huongdieutri').removeAttr('readonly','');
                        $('#ttbnlucchuyen').removeAttr('readonly','');$('#cskhambhyt').removeAttr('readonly','');
                        $('#gcv_dauhieuls').text('.........................................................................................................................');
                        $('#gcv_ppdt').text('...............................................................................................................................');
                        $('#gcv_ncd').text('....................................');
                        
                        $('#btnhuygcv').attr('data-id', '');
                        $('#dauhieuls').val('');$('#huongdieutri').val('');$('#ttbnlucchuyen').val('');$('#cskhambhyt').val('');
                        
                        var d=new Date();
                        var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
                        var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
                        var nam=d.getFullYear();
                        var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
                        var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
                        var s=gio+' giờ '+phut+', ngày '+ngay+' tháng '+thang+' năm '+nam;
                        
                        $('#gcv_tgc').text(s);
                        
                        alert("Hủy giấy chuyển viện thành công!");
                    }
                    else{
                        alert("Xóa giấy chuyển viện gặp lỗi! Mô tả: "+data.msg);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Không thể xóa giấy chuyển viện! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể xóa giấy chuyển viện! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể xóa giấy chuyển viện! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        //
        $('#btngcv').click(function(){
            $('#dtbiareagcv').addClass('hidden');
            $('#proccessgcv').addClass('hidden');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btningcv').attr('data-id', $(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/them_moi_noi',
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
                        $('#shs').text(data.shs);
                        if(data.sct == 'koco'){
                            $('#sct').text('.....................................');
                            $('#btnhuygcvarea').addClass('hidden');
                            $('#dauhieuls').removeAttr('readonly','');$('#huongdieutri').removeAttr('readonly','');
                            $('#ttbnlucchuyen').removeAttr('readonly','');$('#cskhambhyt').removeAttr('readonly','');
                            $('#gcv_dauhieuls').text('.........................................................................................................................');
                            $('#gcv_ppdt').text('...............................................................................................................................');
                            $('#gcv_ncd').text('....................................');
                            $('#dauhieuls').val('');$('#huongdieutri').val('');
                            $('#cskhambhyt').val('');$('#ttbnlucchuyen').val('');
                            $('#gcv_ttbn').text(data.ttbn);
                            $('#dauhieuls').attr('data-dhls', 'koco');
                            
                            var d=new Date();
                            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
                            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
                            var nam=d.getFullYear();
                            var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
                            var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
                            var s=gio+' giờ '+phut+' phút'+', ngày '+ngay+' tháng '+thang+' năm '+nam;

                            $('#gcv_tgc').text(s);
                        }
                        else{
                            $('#sct').text(data.sct);
                            $('#btnhuygcvarea').removeClass('hidden');
                            $('#btnhuygcv').attr('data-id', data.sct);
                            $('#dauhieuls').attr('readonly','');$('#huongdieutri').attr('readonly','');
                            $('#ttbnlucchuyen').attr('readonly','');$('#cskhambhyt').attr('readonly','');
                            $('#dauhieuls').val(data.dhls);$('#huongdieutri').val(data.ppdt);
                            $('#dauhieuls').attr('data-dhls', 'co');
                            $('#gcv_ppdt').text(data.ppdt);
                            $('#gcv_dauhieuls').text(data.dhls);
                            $('#gcv_ncd').text(data.ncd);
                            $('#cskhambhyt').val(data.ncd);$('#ttbnlucchuyen').val(data.ttbn);
                            $('#gcv_tgc').text(data.tgct);
                            $('#gcv_ttbn').text(data.ttbn);
                        }
                        
                        $('#gcv_bs').text(data.bs);$('#gcv_cd').text(data.cd);
                        $('#gcv_diachi').text(data.diachi);$('#gcv_dt').text(data.dantoc);
                        $('#gcv_gt').text(data.gt);$('#gcv_hoten').text(data.hoten);
                        
                        $('#gcv_tuoi').text(data.tuoi);
                        if(data.flagkqcls == true){
                            $('#gcv_kqls').text(data.kqls);
                        }
                        else{
                            $('#gcv_kqls').text('.................................................................................................');
                        }
                        $('#gcv_mathe').text(data.mathe);
                        
                        $('#gcv_tgdt').html(data.tgdt);
                        
                        if(data.thuoc_cls_tt == 'koco'){
                            $('#gcv_thuoc').text('................................................');
                        }
                        else{
                            $('#gcv_thuoc').text(data.thuoc_cls_tt);
                        }
                    }
                    else if(data.msg == 'ktt'){
                        alert("Bệnh án này không tồn tại, có thể đã bị xóa!");
                    }
                    else{
                        alert("Lỗi khi tải dữ liệu cho giấy chuyển viện! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Tải dữ liệu thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Tải dữ liệu thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Tải dữ liệu thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end 
        
        function genPDFGCV(data) { 
            var deferreds = [];
            var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvasGCV(deferred, data);

            $.when.apply($, deferreds).then(function () { 
                $('#dtbigcv').text('Đã tạo xong!');
                $('#proccessgcv').addClass('hidden');
            });
        }

        function generateCanvasGCV(deferred, data){

            html2canvas($("div[class*='printcontent_gcv']:eq(0)")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent_gcv']",0);
                var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.autoPrint({variant: 'non-conform'});
                pdf.save(data+'.pdf');
                deferred.resolve();
             });
        }
        
        $('#btningcv').click(function (){
            var id=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('dhls', $('#dauhieuls').val());
            formData.append('hdt', $('#huongdieutri').val());
            formData.append('ncd', $('#cskhambhyt').val());
            formData.append('ttbn', $('#ttbnlucchuyen').val());
            var flag=false;
            if($('#cskhambhyt').val().toString().trim() == '' && $('#dauhieuls').attr('data-dhls') == 'koco'){
                alert('Bạn phải nhập nơi chuyển đến!');
                return false;
            }
            else{
                flag=true;
            }
            if(($('#dauhieuls').val().toString().trim() == '' || $('#huongdieutri').val().toString().trim() == '' || $('#ttbnlucchuyen').val().toString().trim() == '') && $('#dauhieuls').attr('data-dhls') == 'koco'){
                alert('Bạn phải ghi các dấu hiệu lâm sàng của bệnh nhân, tình trạng bệnh nhân và hướng điều trị để hỗ trợ cho các bác sĩ điều trị có thêm thông tin về tình hình điều trị bệnh của bệnh nhân!');
                return false;
            }
            else{
                if(flag==true){
                    if($('#dauhieuls').attr('data-dhls') == 'koco' && $('#cskhambhyt_hide').val() == ''){
                        var cf=confirm('Cơ sở khám BHYT này hiện không được quản lý tại bệnh viện, bạn chắc chắn muốn chuyển đến cơ sở này?');
                        if(cf==false){
                            return false;
                        }

                    }
                }
            }
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/giay_chuyen_vien/in_noi',
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
                        $('#sct').text(data.sct);
                        $('#gcv_ppdt').text($('#dauhieuls').val());
                        $('#gcv_dauhieuls').text($('#huongdieutri').val());
                        $('#gcv_ncd').text($('#cskhambhyt').val());
                        $('#gcv_ttbn').text($('#ttbnlucchuyen').val());
                        
                        $('#dtbigcv').text('Đang tạo bản in!');
                        $('#dtbiareagcv').removeClass('hidden');
                        $('#proccessgcv').removeClass('hidden');
                        
                        $('#btnhuygcvarea').removeClass('hidden');
                        $('#btnhuygcv').attr('data-id', data.sct);
                        
                        $('#dauhieuls').attr('readonly','');$('#huongdieutri').attr('readonly','');
                        $('#ttbnlucchuyen').attr('readonly','');$('#cskhambhyt').attr('readonly','');
                        
                        genPDFGCV(data.bn);
                    }
                    else if(data.msg == 'da_lap'){
                        $('#dtbigcv').text('Đang tạo bản in!');
                        $('#dtbiareagcv').removeClass('hidden');
                        $('#proccessgcv').removeClass('hidden');
                        
                        genPDFGCV(data.bn);
                    }
                    else if(data.msg == 'ktt'){
                        $('#dtbiareagcv').addClass('hidden');
                        $('#proccessgcv').addClass('hidden');
                        alert("Bệnh án này không tồn tại, có thể đã bị xóa!");
                    }
                    else{
                        $('#dtbiareagcv').addClass('hidden');
                        $('#proccessgcv').addClass('hidden');
                        alert("Lỗi khi in giấy chuyển viện! Mô tả: "+data.msg);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareagcv').addClass('hidden');
                    $('#proccessgcv').addClass('hidden');
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
        
        //
        $('input[list="dscskhambhyt"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('cskhambhyt_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    break;
                }
                else{
                    hiddenInput.value='';
                }  
            }
        });
        //end
        
        //giấy ra viện
        function genPDFGRV(data) { 
            var deferreds = [];
            var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvasGRV(deferred, data);

            $.when.apply($, deferreds).then(function () { 
                $('#dtbigrv').text('Đã tạo xong!');
                $('#proccessgrv').addClass('hidden');
                $('#ghichugrv').attr('readonly','');
                
                if($('#quyen_bs').val() == 'FALSE'){
                    $('#cdarea').fadeIn(800);$('#filearea').fadeIn(800);
                    $('#ghichugrvarea').removeClass('col-lg-12');
                    $('#btngrvarea').removeClass('col-lg-6');
                    $('#btnhuygrvarea').removeClass('col-lg-6');
                    $('#btngrvarea').addClass('col-lg-5');
                    $('#btnhuygrvarea').addClass('col-lg-5');
                    $('#bntfilearea').fadeIn(800);
                    $('#ghichugrvarea').addClass('col-lg-4');
                }
                
            });
        }

        function generateCanvasGRV(deferred, data){

            html2canvas($("div[class*='printcontent_grv']:eq(0)")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent_grv']",0);
                var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.save(data+'.pdf');
                deferred.resolve();
             });
        }

        $('#btnhuygrv').click(function (){
            $('#dtbiareagrv').addClass('hidden');
            $('#proccessgrv').addClass('hidden');
            var cf=confirm('Bạn có chắc chắn muốn hủy giấy ra viện này, nếu hủy giấy ra viện bệnh nhân sẽ ở trạng thái đang điều trị?');
            if(cf == false){
                return false;
            }
            var id=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/giay_ra_vien/xoa',
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
                        $('#slt').text('...............');
                        $('#btnhuygrvarea').addClass('hidden');
                        $('#ghichugrv').removeAttr('readonly','');
                        $('#ghichugrv').val('');
                        $('#tbl_banoi tr td[data-ttba="'+data.idba+'"]').text('Đang điều trị');
                        alert("Hủy giấy ra viện thành công!");
                    }
                    else{
                        alert("Xóa giấy ra viện gặp lỗi! Mô tả: "+data.msg);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Không thể xóa giấy ra viện! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể xóa giấy ra viện! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể xóa giấy ra viện! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        $('#btngrv').click(function (){
            var id=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('ghichu', $('#ghichugrv').val());
            if($('#ghichugrv').val().toString().trim() == '' && $('#ghichugrv').attr('data-grv') == 'koco'){
                var cf=confirm('Bạn không nhập ghi chú cho giấy ra viện này?');
                if(cf == false){
                    return false;
                }
            }
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/giay_ra_vien/in',
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
                        $('#grv_ghichu').text($('#ghichugrv').val());$('#slt').text(data.slt);
                        $('#dtbigrv').text('Đang tạo bản in!');
                        $('#dtbiareagrv').removeClass('hidden');
                        $('#proccessgrv').removeClass('hidden');
                        $('#btnhuygrvarea').removeClass('hidden');
                        $('#btnhuygrv').attr('data-id', data.slt);
                        $('#tbl_banoi tr td[data-ttba="'+data.idba+'"]').text('Đã kết thúc điều trị');
                        genPDFGRV(data.bn);
                    }
                    else if(data.msg == 'da_lap'){
                        $('#grv_ghichu').text(data.ghichu);$('#slt').text(data.slt);
                        $('#dtbigrv').text('Đang tạo bản in!');
                        $('#dtbiareagrv').removeClass('hidden');
                        $('#proccessgrv').removeClass('hidden');
                        genPDFGRV(data.bn);
                    }
                    else if(data.msg == 'ktt'){
                        $('#dtbiareagrv').addClass('hidden');
                        $('#proccessgrv').addClass('hidden');
                        alert("Bệnh án này không tồn tại, có thể đã bị xóa!");
                    }
                    else{
                        $('#dtbiareagrv').addClass('hidden');
                        $('#proccessgrv').addClass('hidden');
                        alert("Lỗi khi in giấy ra viện! Mô tả: "+data.msg);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareagrv').addClass('hidden');
                    $('#proccessgrv').addClass('hidden');
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
        
        $('#btngiayrv').click(function (){
            $('#dtbiareagrv').addClass('hidden');
            $('#proccessgrv').addClass('hidden');
            if($('#quyen_bs').val() == 'FALSE'){
                $('#bntfilearea').fadeOut();$('#cdarea').fadeOut();$('#filearea').fadeOut();
                $('#ghichugrvarea').removeClass('col-lg-4');
                $('#ghichugrvarea').addClass('col-lg-12');
                $('#btngrvarea').removeClass('col-lg-5');
                $('#btnhuygrvarea').removeClass('col-lg-5');
                $('#btngrvarea').addClass('col-lg-6');
                $('#btnhuygrvarea').addClass('col-lg-6');
            }
            var id=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            $('#btngrv').attr('data-id', id);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/giay_ra_vien/them_moi',
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
                        $('#myt').text(data.myt);
                        if(data.slt == 'koco'){
                            $('#slt').text('...............');
                            $('#btnhuygrvarea').addClass('hidden');
                            $('#ghichugrv').removeAttr('readonly','');
                            $('#ghichugrv').removeAttr('data-grv','koco');
                        }
                        else{
                            $('#slt').text(data.slt);
                            $('#btnhuygrvarea').removeClass('hidden');
                            $('#btnhuygrv').attr('data-id', data.slt);
                            $('#ghichugrv').attr('readonly','');
                            $('#ghichugrv').val(data.ghichu);
                            $('#ghichugrv').removeAttr('data-grv','co');
                        }
                        $('#grv_khoa').text(data.khoa);$('#grv_hoten').text(data.hoten);
                        $('#grv_tuoi').text(data.tuoi);$('#grv_gt').text(data.gt);
                        $('#grv_dt').text(data.dantoc);
                        if(data.mathe == 'koco'){
                            $('#grv_mathe_area').addClass('hidden');
                        }
                        else{
                            $('#grv_mathe').text(data.mathe);
                            $('#grv_mathe_area').removeClass('hidden');
                        }
                        
                        $('#grv_diachi').text(data.diachi);$('#grv_vvl').text(data.vvl);
                        $('#grv_rvl').text(data.rvl);$('#grv_cd').text(data.cd);
                        $('#grv_ppdt').text(data.ppdt);
                        
                    }
                    else if(data.msg == 'ktt'){
                        alert("Bệnh án này không tồn tại, có thể đã bị xóa!");
                    }
                    else{
                        alert("Lỗi khi tải dữ liệu cho giấy ra viện! Mô tả: "+data.msg);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Tải dữ liệu thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Tải dữ liệu thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Tải dữ liệu thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end
        
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
                url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/tim_kiem',
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
                            
                            var ttba='';
                            for(var i=0; i<data.benhan.length; ++i){
                                var chuandoan='';
                                if($.isArray(data.benhan[i].chuandoan))
                                {
                                    for (var k = 0; k < data.benhan[i].chuandoan.length; k++) {
                                        if(k==data.benhan[i].chuandoan.length-1){
                                            chuandoan+='- '+data.benhan[i].chuandoan[k];
                                            break;
                                        }
                                        chuandoan+='- '+data.benhan[i].chuandoan[k]+'<br>';
                                    }
                                }
                                ttba+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.benhan[i].id+'" data-name="'+data.benhan[i].hoten+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td data-idbn="'+data.benhan[i].idbn+'">'+data.benhan[i].hoten+'</td>\n\
                                        <td>'+data.benhan[i].dttn+'</td>\n\
                                        <td class="text-left">'+chuandoan+'</td>\n\
                                        <td>'+data.benhan[i].ngaybddt+'</td>\n\
                                        <td>'+data.benhan[i].lydonv+'</td>\n\
                                        <td>'+data.benhan[i].ttbn+'</td>\n\
                                        <td>'+data.benhan[i].gb+'</td>\n\
                                        <td>'+data.benhan[i].songaydt+'</td>\n\
                                        <td data-ttba="'+data.benhan[i].id+'">'+data.benhan[i].trangthaiba+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="btnsua" data-id="'+data.benhan[i].id+'">\n\
                                                    <i class="zmdi zmdi-edit"></i>\n\
                                                </button>\n\
                                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="'+data.benhan[i].id+'" data-name="'+data.benhan[i].hoten+'">\n\
                                                    <i class="zmdi zmdi-delete"  ></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                            }

                            $('#tbl_banoi').html(ttba);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                    
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" bệnh án được tìm thấy!");
//                            $('#btnlocds').tooltip('hide').attr('data-original-title', 'Lọc danh sách tìm kiếm').tooltip('fixTitle').tooltip('show');
                        }
                        else{
                            $('#tbl_banoi').html("");
                            $('#kqtimliem').text("Không có bệnh án nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/lay_ds_ba',
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
                        alert("Lỗi khi tải danh sách bệnh án! Mô tả: "+data.msg);
                    }else{
                        var ttba='';
                        for(var i=0; i<data.benhan.length; ++i){
                            var chuandoan='';
                            if($.isArray(data.benhan[i].chuandoan))
                            {
                                for (var k = 0; k < data.benhan[i].chuandoan.length; k++) {
                                    if(k==data.benhan[i].chuandoan.length-1){
                                        chuandoan+='- '+data.benhan[i].chuandoan[k];
                                        break;
                                    }
                                    chuandoan+='- '+data.benhan[i].chuandoan[k]+'<br>';
                                }
                            }
                            ttba+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.benhan[i].id+'" data-name="'+data.benhan[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td data-idbn="'+data.benhan[i].idbn+'">'+data.benhan[i].hoten+'</td>\n\
                                    <td>'+data.benhan[i].dttn+'</td>\n\
                                    <td class="text-left">'+chuandoan+'</td>\n\
                                    <td>'+data.benhan[i].ngaybddt+'</td>\n\
                                    <td>'+data.benhan[i].lydonv+'</td>\n\
                                    <td>'+data.benhan[i].ttbn+'</td>\n\
                                    <td>'+data.benhan[i].gb+'</td>\n\
                                    <td>'+data.benhan[i].songaydt+'</td>\n\
                                    <td data-ttba="'+data.benhan[i].id+'">'+data.benhan[i].trangthaiba+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="btnsua" data-id="'+data.benhan[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoa" data-id="'+data.benhan[i].id+'" data-name="'+data.benhan[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"  ></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                        }

                        $('#tbl_banoi').html(ttba);
                        $('button[data-button]').tooltip({
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
        
        //nhấn enter tìm kiếm
        $("#ftimkiem").keypress(function(e) {
              var key = e.charCode || e.keyCode || 0;     
              if (key == 13) {
                e.preventDefault();
                $('#btntimkiem').click();
              }
        });
        //end
        
        //---------------------------Bệnh án chi tiết
        $('#btnxemctgd').click(function (){
            var id=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
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
                        $('#btnthemgddt').attr('data-id', data.idba);
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
        
        $('#btnthemgddt').click(function (){
            $('#btnthemctarea').fadeIn(800);$('#btnsuactarea').fadeOut(800);
            $('#btnratoaarea').fadeOut(800);$('#btnracdclsarea').fadeOut(800);$('#btnxemkqclsarea').fadeOut(800);$('#btnracdttarea').fadeOut(800);$('#btnracdptarea').fadeOut(800);
            $('#formcttitle').text('THÊM GIAI ĐOẠN ĐIỀU TRỊ');
            $('#ghichubact').val('');$('#ppdt').val('dung_thuoc');$('#ttbngddt').val('khoi_benh_hoan_toan');
            var d=new Date();
            var s = (d.getDate() < 10 ? '0'+d.getDate() : d.getDate())+"/"+((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1))+"/"+d.getFullYear()+" ";
            $('#thoigiantungay').val(s);$('#thoigiandenngay').val(s);
            $('#formbact').slideDown(800);
            $('html, body').animate({
                scrollTop: $("#formbact").offset().top
            }, 800);
        });
        
        $('#btndongdsbact').click(function(){
            if($('#formbact').css('display')=='block'){
                $('#btndongct').click();
            }
            
            $('#tblBACT').slideUp(800);
            $('html, body').animate({
                scrollTop: $("#formba").offset().top
            }, 800);
        });
        
        $('#btndongct').click(function(){
            $('#formbact').slideUp(800);
        });
        
        $('#btnthemct').click(function (){
            var id= $('#btnthemgddt').attr('data-id');
            var ppdt=$('#ppdt').val(), ngaybd=$('#thoigiantungay').val(), ngaykt=$('#thoigiandenngay').val(), ttbn=$('#ttbngddt').val(), ghichu=$('#ghichubact').val();
            
            var time1=ngaybd.toString().split('/');
            var time2=ngaykt.toString().split('/');
            
            if(parseInt(time2[2]) < parseInt(time1[2])){
                
                alert('Thời gian kết thúc không thể nhỏ hơn thời gian bắt đầu!');
                return false;
            }
            else{
                if(parseInt(time2[1]) < parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                    alert('Thời gian kết thúc không thể nhỏ hơn thời gian bắt đầu!');
                    return false;
                }
                else{
                    if(parseInt(time2[0]) < parseInt(time1[0]) && parseInt(time2[1]) == parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                        alert('Thời gian kết thúc không thể nhỏ hơn thời gian bắt đầu!');
                        return false;
                    }
                }
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('ppdt', ppdt);
            formData.append('ngaybd', ngaybd);
            formData.append('ngaykt', ngaykt);
            formData.append('ttbn', ttbn);
            formData.append('ghichu', ghichu);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/them_moi_ct',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
        //                     Success
                    if(data.msg == 'tc'){
                        alert("Thêm giai đoạn điề trị mới thành công!");
                        $('input[data-input="checksumCT"]').prop("checked",false);
                        $('#tbl_bact input[data-input="check"]').prop("checked",false);

                        $('#btnratoaarea').fadeIn(800);$('#btnracdclsarea').fadeIn(800);$('#btnxemkqclsarea').fadeIn(800);$('#btnracdttarea').fadeIn(800);$('#btnracdptarea').fadeIn(800);

                        $('#btnratoathuoc').attr('data-id', data.idbact);
                        $('#btnratoathuoc').attr('data-snd', data.snd);
                        $('#btnrachidinhcls').attr('data-id', data.idbact);
                        $('#btnxemkqcls').attr('data-id', data.idbact);
                        $('#btnrachidinhtt').attr('data-id', data.idbact);
                        $('#btnrachidinhpt').attr('data-id', data.idbact);
                        
                        if(data.chuyenvien == true){
                            $('#btngcvarea').fadeIn(800);
                            $('#btngcv').attr('data-id', id);
                        }
                        if(data.chuyenba == true){
                            $('#btnchuyenbaarea').fadeIn(800);
                            $('#btnchuyenba').attr('data-id', id);
                        }

                        $('#tbl_bact').prepend(data.bact);
                        
                        $('#tbl_bact button').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                        
                    }
                    else if(data.msg == 'chuakt'){
                        alert("Giai đoạn điều trị trước vẫn chưa kết thúc!");
                    }
                    else if(data.msg == 'ktdt'){
                        alert("Bệnh nhân đã kết thúc đợt điều trị nội trú này!");
                    }
                    else{            
                        alert("Thêm giai đoạn điều trị thất bại! Lỗi: "+data.msg);
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
        
        $('#tbl_bact').on('click', 'button[data-button="btnsuact"]', function(){
            $('#btnthemctarea').fadeOut(800);$('#btnsuactarea').fadeIn(800);
            $('#btnratoaarea').fadeIn(800);$('#btnracdclsarea').fadeIn(800);$('#btnxemkqclsarea').fadeIn(800);$('#btnracdttarea').fadeIn(800);$('#btnracdptarea').fadeIn(800);
            $('#formcttitle').text('CẬP NHẬT THÔNG TIN GIAI ĐOẠN ĐIỀU TRỊ');
            var idbact=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idbact', idbact);
            $('#btncapnhatct').attr('data-id', idbact);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/lay_tt_cap_nhat_ct',
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
                        $('#ppdt').val(data.ppdt); $('#thoigiantungay').val(data.ngaybd); $('#thoigiandenngay').val(data.ngaykt);$('#ttbngddt').val(data.ttbn);
                        $('#ghichubact').val(data.ghichu);
                        $('#formbact').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formbact").offset().top
                        }, 800);
                        $('#btnratoathuoc').attr('data-id', idbact);
                        $('#btnratoathuoc').attr('data-snd', data.snd);
                        $('#btnrachidinhcls').attr('data-id', idbact);
                        $('#btnxemkqcls').attr('data-id', idbact);
                        $('#btnrachidinhtt').attr('data-id', idbact);
                        $('#btnrachidinhpt').attr('data-id', idbact);
                    }
                    else{
                        alert("Lấy thông tin cập nhật gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy thông tin cập nhật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy thông tin cập nhật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy thông tin cập nhật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        $('#btncapnhatct').click(function (){
            var id= $(this).attr('data-id');
            var ppdt=$('#ppdt').val(), ngaybd=$('#thoigiantungay').val(), ngaykt=$('#thoigiandenngay').val(), ttbn=$('#ttbngddt').val(), ghichu=$('#ghichubact').val();
            
            var time1=ngaybd.toString().split('/');
            var time2=ngaykt.toString().split('/');
            
            if(parseInt(time2[2]) < parseInt(time1[2])){
                
                alert('Thời gian kết thúc không thể nhỏ hơn thời gian bắt đầu!');
                return false;
            }
            else{
                if(parseInt(time2[1]) < parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                    alert('Thời gian kết thúc không thể nhỏ hơn thời gian bắt đầu!');
                    return false;
                }
                else{
                    if(parseInt(time2[0]) < parseInt(time1[0]) && parseInt(time2[1]) == parseInt(time1[1]) && parseInt(time2[2]) == parseInt(time1[2])){
                        alert('Thời gian kết thúc không thể nhỏ hơn thời gian bắt đầu!');
                        return false;
                    }
                }
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('ppdt', ppdt);
            formData.append('ngaybd', ngaybd);
            formData.append('ngaykt', ngaykt);
            formData.append('ttbn', ttbn);
            formData.append('ghichu', ghichu);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/cap_nhat_ct',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
        //                     Success
                    if(data.msg == 'tc'){
                        $('#btnratoathuoc').attr('data-snd', data.snd);
                        alert("Cập nhật thông tin gia đoạn điều trị thành công!");
                        
                        $('#tbl_bact tr').has('td div button[data-id="'+id+'"]').replaceWith(data.bact);
                        
                        $('#tbl_bact button').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                    }
                    else if(data.msg == 'ktdt'){
                        alert("Bệnh nhân đã kết thúc đợt điều trị nội trú này!");
                    }
                    else if(data.msg == 'dakt'){
                        alert("Gia đoạn điều trị này đã kết thúc!");
                    }
                    else{
                        alert("Cập nhật thông tin gia đoạn điều trị thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin gia đoạn điều trị thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin gia đoạn điều trị thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin gia đoạn điều trị thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        //click check sum
        $('body').on('change', 'input[data-input="checksumCT"]', function(){
            if($(this).prop("checked")){
                $('#tbl_bact input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_bact input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_bact').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksumCT"]').prop("checked",false);
            }
            else{
                if($('#tbl_bact input[data-input="check"]:checked').length == $('#tbl_bact input[data-input="check"]').length){
                    $('input[data-input="checksumCT"]').prop("checked",true);
                }   
            }
        });
        //end
        
        $('#tbl_bact').on('click', 'button[data-button="btnxoact"]', function(){
            var id=$(this).attr('data-id');
            var cf=confirm("Bạn có thực sự muốn xóa giai đoạn điều trị này?");
            if(cf==true){
                if($('#formbact').css('display') == 'block' && id == $('#btncapnhatct').attr('data-id')){//đóng form sửa khi click xóa
                   $('#btndongct').click();
                }

                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/xoa_ct',
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
                            if($('#tbl_bact').children().length == 0){
                                $('input[data-input="checksumCT"]').prop("checked",false);
                            }
                            $('#tbl_bact tr').has('td div button[data-id="'+id+'"]').next('tr.spacer').remove();
                            $('#tbl_bact tr').has('td div button[data-id="'+id+'"]').remove();
                            
                            if(data.chuyenvien == false){
                                $('#btngcvarea').fadeOut(800);
                            }
                            if(data.chuyenba == false){
                                $('#btnchuyenbaarea').fadeOut(800);
                            }
                            
                            alert("Xóa thông tin giai đoạn điều trị thành công!");
                        }
                        else{
                            alert("Xóa thông tin giai đoạn điều trị thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin giai đoạn điều trị thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin giai đoạn điều trị thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin giai đoạn điều trị thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatcct').click(function(){
            if(!$('#tbl_bact input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn giai đoạn điều trị để xóa!");
                return false;
            }
            else{
               var arr=[];
                $('#tbl_bact input[data-input="check"]').each(function(){
                    if($(this).is(":checked")){
                        $.each(this.attributes, function() {
                            if (this.name.indexOf('data-id') == 0) {
                                arr.push(this.value);
                            }
                        });
                    }
                });   

                var cf;
                if(arr.length > 1){
                    cf=confirm("Bạn có thực sự muốn xóa các thông tin giai đoạn điều trị?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin giai đoạn điều trị?");
                }
                if(cf==true){
                    for (var i = 0; i < arr.length; i++) {
                        if($('#formbact').css('display') == 'block' && arr[i] == $('#btncapnhatct').attr('data-id')){//đóng form sửa khi click xóa
                           $('#btndongct').click();
                        }

                    }
                    
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/benh_an_noi_tru/xoa_ct',
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
                                if($('#tbl_bact').children().length == 0){
                                    $('input[data-input="checksumCT"]').prop("checked",false);
                                }
                                for (var i = 0; i < arr.length; i++) {
                                    $('#tbl_bact tr').has('td div button[data-id="'+arr[i]+'"]').next('tr.spacer').remove();
                                    $('#tbl_bact tr').has('td div button[data-id="'+arr[i]+'"]').remove();
                                }
                                if(data.chuyenvien == false){
                                    $('#btngcvarea').fadeOut(800);
                                }
                                if(data.chuyenba == false){
                                    $('#btnchuyenbaarea').fadeOut(800);
                                }

                                if(arr.length > 1){
                                    alert("Xóa thông tin các giai đoạn điều trị thành công!");
                                }
                                else{
                                    alert("Xóa thông tin giai đoạn điều trị thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1){
                                    alert("Xóa thông tin các giai đoạn điều trị thất bại! Lỗi: "+data.msg);
                                }
                                else{
                                    alert("Xóa thông tin giai đoạn điều trị thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1){
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các giai đoạn điều trị thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các giai đoạn điều trị thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các giai đoạn điều trị thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else{
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin giai đoạn điều trị thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin giai đoạn điều trị thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin giai đoạn điều trị thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }
            }
        });
        //end
        
        //---------------------------Toa thuoc
        $('#btnratoathuoc').click(function(){
            if($('#formtoathuoc').css('display') == 'block'){
                $('#btndongformtoathuoc').click();
            }
            $('#dtbiareatt').addClass('hidden');$('#proccesstt').addClass('hidden');
            var idba=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idba);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru_ct/lay_ds',
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
                    if(data.msg == 'koco'){
                        $('#btnintoathuoc').attr('data-id','');
                        $('#btnhuytoathuoc').attr('data-id','');
                        $('#tbl_toathuoc').html('');$('#ghichutoathuoc').val('');
                        $('#dstenthuoc').html(data.dsthuoc);
                    }
                    else if(data.msg == 'cotoa'){
                        var toact='';
                        for(var i=0; i<data.dstoact.length; ++i){
                            toact+='\n\
                                <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dstoact[i].idthuoc+'" data-name="'+data.dstoact[i].tenthuoc+'" data-matt="'+data.dstoact[i].idtt+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td data-idthuoc="'+data.dstoact[i].idthuoc+'">'+data.dstoact[i].tenthuoc+'</td>\n\
                                <td>'+data.dstoact[i].dvt+'</td>\n\
                                <td>'+data.dstoact[i].cachdung+'</td>\n\
                                <td>'+data.dstoact[i].lieudung+'</td>\n\
                                <td>'+data.dstoact[i].sl+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dstoact[i].idthuoc+'" data-idtt="'+data.dstoact[i].idtt+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dstoact[i].idthuoc+'" data-idtt="'+data.dstoact[i].idtt+'" data-name="'+data.dstoact[i].tenthuoc+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#ghichutoathuoc').val(data.ghichu);
                        $('#btnintoathuoc').attr('data-id',data.idtt);
                        $('#btnhuytoathuoc').attr('data-id',data.idtt);
                        $('#tbl_toathuoc').html(toact);
                        $('#tbl_toathuoc button[data-button]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                        
                        $('#dstenthuoc').html(data.dsthuoc);
                    }
                    else{
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
        
        $('#btnaddthuoc').click(function() {
            $('#tenthuoc').val('');$('#dvt').val('');$('#sl').val('');
            $('#sang').prop("checked",false);$('#trua').prop("checked",false);$('#chieu').prop("checked",false);$('#toi').prop("checked",false);
            ;$('#ghichutoathuocct').val('');$('#tongsothuoc').val('');$('#lieudung').val('');
            $('#btnthemthuocarea').fadeIn(800);$('#btncapnhatthuocarea').fadeOut(800);
            $('#tenthuoc').removeAttr('readonly');
            $('#formtoathuoc').slideDown(800);$('#formtoathuocct').slideDown(800);
        });
        
        $('#btndongformtoathuoc').click(function() {
            $('#formtoathuoc').slideUp(800);$('#formtoathuocct').slideUp(1000);
        });
        
        $('#btnthemthuoc').click(function() {
            var mathuoc=$('#tenthuoc_hide').val(), sl=$('#sl').val(), ld=$('#lieudung').val(), ghichutoa=$('#ghichutoathuoc').val(), ghichuct=$('#ghichutoathuocct').val(), tongsothuoc=$('#tongsothuoc').val();
            if($('#tenthuoc').val().toString().trim() == '')
            {
                alert('Vui lòng nhập tên thuốc!');
                return false;
            }
            else if (mathuoc == ''){
                alert('Thuốc không có trong kho!');
                return false;
            }
            var ts=0;var sndt=parseInt($('#btnratoathuoc').attr('data-snd'));
            
            if(parseInt(sl) > sndt)
            {
                alert("Số ngày dùng thuốc không hợp lệ! Số ngày điều trị tối đa là "+sndt+' ngày.');
                return false;
            }
            else{
                if(parseInt(sl) == 0){
                    alert("Số ngày dùng thuốc phải lớn hơn 0!");
                    return false;
                }
            }
            var lieudung='';
            
            if(sl.toString().trim() == '' || (!$('#sang').is(":checked") && !$('#trua').is(":checked") && !$('#chieu').is(":checked") && !$('#toi').is(":checked")))
            {
                alert('Vui lòng nhập số ngày dùng thuốc và liều dùng!');
                return false;
            }
            var lieu=1;
            if(ld.toString().trim() == '' || parseInt(ld) == 0 || parseInt(ld) == 1){
                if($('#sang').prop("checked")){lieudung+='Sáng: 1'; ts++;};
                if($('#trua').prop("checked")){ts++;if(lieudung != ''){lieudung+=', trưa: 1';}else{lieudung+='Trưa: 1';}};
                if($('#chieu').prop("checked")){ts++;if(lieudung != ''){lieudung+=', chiều: 1';}else{lieudung+='Chiều: 1';}};
                if($('#toi').prop("checked")){ts++;if(lieudung != ''){lieudung+=', tối: 1';}else{lieudung+='Tối: 1';}};
                ts=ts*parseInt(sl);
            }
            else{
                lieu=ld;
                if($('#sang').prop("checked")){lieudung+='Sáng: '+ld; ts+=parseInt(ld);};
                if($('#trua').prop("checked")){ts+=parseInt(ld);if(lieudung != ''){lieudung+=', trưa: '+ld;}else{lieudung+='Trưa: '+ld;}};
                if($('#chieu').prop("checked")){ts+=parseInt(ld);if(lieudung != ''){lieudung+=', chiều: '+ld;}else{lieudung+='Chiều: '+ld;}};
                if($('#toi').prop("checked")){ts+=parseInt(ld);if(lieudung != ''){lieudung+=', tối: '+ld;}else{lieudung+='Tối: '+ld;}};
                ts=ts*parseInt(sl);
            }
            
            if(tongsothuoc.toString().trim() != '' && parseInt(tongsothuoc) != 0){
                if(ts != parseInt(tongsothuoc)){
                    var cf=confirm('Tổng số lượng thuốc dùng không hợp lệ (bạn có thể để trống ô tổng số, chúng tôi sẽ tính cho bạn)! Số ngày dùng thuốc là '+sl+' và liều dùng là '+lieudung+' nên tổng số thuốc phải là '+ts+' '+$('#dvt').val()+'. Bạn có thể tiếp tục nếu ổn?');
                    if(cf === false){
                        return false;
                    }
                    else{
                        ts=tongsothuoc;
                    }
                }
                else{
                    var cf=confirm('Tổng số lượng thuốc là '+ts+' '+$('#dvt').val()+' và liều dùng là '+lieudung+' trong '+sl+' ngày?');
                    if(cf === false){
                        return false;
                    }
                }
            }
            else{
                var cf=confirm('Tổng số lượng thuốc là '+ts+' '+$('#dvt').val()+' và liều dùng là '+lieudung+' trong '+sl+' ngày?');
                if(cf === false){
                    return false;
                }
            }
            
            var idba=$('#btnratoathuoc').attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('mathuoc', mathuoc);
            formData.append('sl', sl);
            if($('#sang').prop("checked")){formData.append('sang', lieu);};
            if($('#trua').prop("checked")){formData.append('trua', lieu);};
            if($('#chieu').prop("checked")){formData.append('chieu', lieu);};
            if($('#toi').prop("checked")){formData.append('toi', lieu);};
            formData.append('ghichutoa', ghichutoa);
            formData.append('ghichuct', ghichuct);
            formData.append('idba', idba);
            formData.append('tst', ts);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru/them_moi',
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
                    if(data.msg == 'trung')
                    {
                        alert("Thuốc đã được thêm!");
                    }
                    else if(data.msg == 't_v_ct_tc'){
                        $('#btnintoathuoc').attr('data-id', data.idtt);
                        var toact='\n\
                            <tr class="tr-shadow">\n\
                            <td>\n\
                                <label class="au-checkbox">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.idthuoc+'" data-name="'+data.tenthuoc+'" data-matt="'+data.idtt+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td data-idthuoc="'+data.idthuoc+'">'+data.tenthuoc+'</td>\n\
                            <td>'+data.dvt+'</td>\n\
                            <td>'+data.cachdung+'</td>\n\
                            <td>'+data.lieudung+'</td>\n\
                            <td>'+data.sl+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.idthuoc+'" data-idtt="'+data.idtt+'">\n\
                                        <i class="zmdi zmdi-edit"></i>\n\
                                    </button>\n\
                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.idthuoc+'" data-idtt="'+data.idtt+'" data-name="'+data.tenthuoc+'">\n\
                                        <i class="zmdi zmdi-delete"></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>\n\
                        <tr class="spacer"></tr>';
                            
                        $('#tbl_toathuoc').prepend(toact);
                        $('#btnhuytoathuoc').attr('data-id',data.idtt);
                        $('#tbl_toathuoc button[data-id="'+data.idthuoc+'"]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                        alert("Thêm toa thuốc và chi tiết thành công!");
                    }
                    else if(data.msg == 'ct_tc')
                    {
                        var toact='\n\
                            <tr class="tr-shadow">\n\
                            <td>\n\
                                <label class="au-checkbox">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.idthuoc+'" data-name="'+data.tenthuoc+'" data-matt="'+data.idtt+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td data-idthuoc="'+data.idthuoc+'">'+data.tenthuoc+'</td>\n\
                            <td>'+data.dvt+'</td>\n\
                            <td>'+data.cachdung+'</td>\n\
                            <td>'+data.lieudung+'</td>\n\
                            <td>'+data.sl+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.idthuoc+'" data-idtt="'+data.idtt+'">\n\
                                        <i class="zmdi zmdi-edit"></i>\n\
                                    </button>\n\
                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.idthuoc+'" data-idtt="'+data.idtt+'" data-name="'+data.tenthuoc+'">\n\
                                        <i class="zmdi zmdi-delete"></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>\n\
                        <tr class="spacer"></tr>';
                        $('#tbl_toathuoc').prepend(toact);
                        
                        $('#tbl_toathuoc button[data-id="'+data.idthuoc+'"]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                
                        alert("Thêm chi tiết thành công!");
                    }
                    else if(data.msg == 'slthuockodu'){
                        alert("Số lượng thuốc chỉ còn "+data.sl+" "+data.dvt+"!");
                    }
                    else if(data.msg == 'thuocktt'){
                        alert("Loại thuốc này hiện không tồn tại, có thể đã bị xóa thông tin!");
                    }
                    else if(data.msg == 'ktdt'){
                        alert("Bệnh nhân đã kết thúc đợt điều trị này!");
                    }
                    else if(data.msg == 'dakt'){
                        alert("Giai đoạn điều trị này đã kết thúc!");
                    }
                    else{
                        alert("Thêm thất bại! Lỗi: "+data.msg);
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
        
        //mở form để sửa
        $('#tbl_toathuoc').on('click','button[data-button="sua"]',function(){
            $('#btnthemthuocarea').fadeOut(800);$('#btncapnhatthuocarea').fadeIn(800);
            
            var formData = new FormData();
            var idthuoc=$(this).attr('data-id'), idtt = $(this).attr('data-idtt');
            formData.append('_token', CSRF_TOKEN);
            formData.append('idthuoc', idthuoc);
            formData.append('idtt', idtt);
            $('#btncapnhatthuoc').attr('data-idthuoc',idthuoc);
            $('#btncapnhatthuoc').attr('data-idtt',idtt);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru_ct/lay_tt_cap_nhat',
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
                        $('#tenthuoc').val(data.tenthuoc);
                        $('#tenthuoc_hide').val(data.idthuoc);
                        $('input[list="dstenthuoc"]').trigger('input');
                        $('#tenthuoc').attr('readonly', '');
                        $('#tenthuoc').attr('data-id', data.idthuoc);
                        $('#sl').val(data.snd);
                        if(data.sang == true){
                            $('#sang').prop("checked",true);
                        }
                        if(data.trua == true){
                            $('#trua').prop("checked",true);
                        }
                        if(data.chieu == true){
                            $('#chieu').prop("checked",true);
                        }
                        if(data.toi == true){
                            $('#toi').prop("checked",true);
                        }
                        $('#lieudung').val(data.ld);
                        $('#tongsothuoc').val(data.tst);
                        $('#toi').val(data.toi);$('#ghichutoathuoc').val(data.ghichutoa);$('#ghichutoathuocct').val(data.ghichuct);
                       
                        $('#formtoathuoc').slideDown(800);$('#formtoathuocct').slideDown(800);
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
        
        $('#btncapnhatthuoc').click(function() {
            var mathuoc=$('#tenthuoc_hide').val(), sl=$('#sl').val(), ld=$('#lieudung').val(), ghichutoa=$('#ghichutoathuoc').val(), ghichuct=$('#ghichutoathuocct').val(), tongsothuoc=$('#tongsothuoc').val();
            if($('#tenthuoc').val().toString().trim() == '')
            {
                alert('Vui lòng nhập tên thuốc!');
                return false;
            }
            else if (mathuoc == ''){
                alert('Thuốc không có trong kho!');
                return false;
            }
            var ts=0;var sndt=parseInt($('#btnratoathuoc').attr('data-snd'));
            
            if(parseInt(sl) > sndt)
            {
                alert("Số ngày dùng thuốc không hợp lệ! Số ngày điều trị tối đa là "+sndt+' ngày.');
                return false;
            }
            else{
                if(parseInt(sl) == 0){
                    alert("Số ngày dùng thuốc phải lớn hơn 0!");
                    return false;
                }
            }
            var lieudung='';
            
            if(sl.toString().trim() == '' || (!$('#sang').is(":checked") && !$('#trua').is(":checked") && !$('#chieu').is(":checked") && !$('#toi').is(":checked")))
            {
                alert('Vui lòng nhập số ngày dùng thuốc và liều dùng!');
                return false;
            }
            var lieu=1;
            if(ld.toString().trim() == '' || parseInt(ld) == 0 || parseInt(ld) == 1){
                if($('#sang').prop("checked")){lieudung+='Sáng: 1'; ts++;};
                if($('#trua').prop("checked")){ts++;if(lieudung != ''){lieudung+=', trưa: 1';}else{lieudung+='Trưa: 1';}};
                if($('#chieu').prop("checked")){ts++;if(lieudung != ''){lieudung+=', chiều: 1';}else{lieudung+='Chiều: 1';}};
                if($('#toi').prop("checked")){ts++;if(lieudung != ''){lieudung+=', tối: 1';}else{lieudung+='Tối: 1';}};
                ts=ts*parseInt(sl);
            }
            else{
                lieu=ld;
                if($('#sang').prop("checked")){lieudung+='Sáng: '+ld; ts+=parseInt(ld);};
                if($('#trua').prop("checked")){ts+=parseInt(ld);if(lieudung != ''){lieudung+=', trưa: '+ld;}else{lieudung+='Trưa: '+ld;}};
                if($('#chieu').prop("checked")){ts+=parseInt(ld);if(lieudung != ''){lieudung+=', chiều: '+ld;}else{lieudung+='Chiều: '+ld;}};
                if($('#toi').prop("checked")){ts+=parseInt(ld);if(lieudung != ''){lieudung+=', tối: '+ld;}else{lieudung+='Tối: '+ld;}};
                ts=ts*parseInt(sl);
            }
            
            if(tongsothuoc.toString().trim() != '' && parseInt(tongsothuoc) != 0){
                if(ts != parseInt(tongsothuoc)){
                    var cf=confirm('Tổng số lượng thuốc dùng không hợp lệ (bạn có thể để trống ô tổng số, chúng tôi sẽ tính cho bạn)! Số ngày dùng thuốc là '+sl+' và liều dùng là '+lieudung+' nên tổng số thuốc phải là '+ts+' '+$('#dvt').val()+'. Bạn có thể tiếp tục nếu ổn?');
                    if(cf === false){
                        return false;
                    }
                    else{
                        ts=tongsothuoc;
                    }
                }
                else{
                    var cf=confirm('Tổng số lượng thuốc là '+ts+' '+$('#dvt').val()+' và liều dùng là '+lieudung+' trong '+sl+' ngày?');
                    if(cf === false){
                        return false;
                    }
                }
            }
            else{
                var cf=confirm('Tổng số lượng thuốc là '+ts+' '+$('#dvt').val()+' và liều dùng là '+lieudung+' trong '+sl+' ngày?');
                if(cf === false){
                    return false;
                }
            }
            
            var matt=$(this).attr('data-idtt');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('mathuoc', mathuoc);
            formData.append('matt', matt);
            formData.append('sl', sl);
            if($('#sang').prop("checked")){formData.append('sang', lieu);};
            if($('#trua').prop("checked")){formData.append('trua', lieu);};
            if($('#chieu').prop("checked")){formData.append('chieu', lieu);};
            if($('#toi').prop("checked")){formData.append('toi', lieu);};
            formData.append('ghichutoa', ghichutoa);
            formData.append('ghichuct', ghichuct);
            formData.append('tst', ts);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru_ct/cap_nhat',
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
                        var toact='\n\
                            <tr class="tr-shadow">\n\
                            <td>\n\
                                <label class="au-checkbox">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.idthuoc+'" data-name="'+data.tenthuoc+'" data-matt="'+data.idtt+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td data-idthuoc="'+data.idthuoc+'">'+data.tenthuoc+'</td>\n\
                            <td>'+data.dvt+'</td>\n\
                            <td>'+data.cachdung+'</td>\n\
                            <td>'+data.lieudung+'</td>\n\
                            <td>'+data.sl+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.idthuoc+'" data-idtt="'+data.idtt+'">\n\
                                        <i class="zmdi zmdi-edit"></i>\n\
                                    </button>\n\
                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.idthuoc+'" data-idtt="'+data.idtt+'" data-name="'+data.tenthuoc+'">\n\
                                        <i class="zmdi zmdi-delete"></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>';
                                            
                        $('#tbl_toathuoc tr').has('td div button[data-id="'+data.idthuoc+'"]').replaceWith(toact);
                        
                        $('#tbl_toathuoc button[data-id="'+data.idthuoc+'"]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                        alert("Cập nhật chi tiết thành công!");
                    }
                    else if(data.msg == 'slthuockodu'){
                        alert("Số lượng thuốc chỉ còn "+data.sl+" "+data.dvt+"!");
                    }
                    else if(data.msg == 'thuocktt'){
                        alert("Loại thuốc này hiện không tồn tại, có thể đã bị xóa thông tin!");
                    }
                    else if(data.msg == 'ktdt'){
                        alert("Bệnh nhân đã kết thúc đợt điều trị này!");
                    }
                    else if(data.msg == 'dakt'){
                        alert("Giai đoạn điều trị này đã kết thúc!");
                    }
                    else{
                        alert("Cập nhật chi tiết thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Cập nhật chi tiết thất bại! Lỗi: "+jqXHR.msg+" | "+errorThrown);
                    if(jqXHR.status == 419){
                        alert("Cập nhật chi tiết thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật chi tiết thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật chi tiết thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        $('#tbl_toathuoc').on('click','button[data-button="xoa"]',function(){
            var idthuoc=$(this).attr('data-id'), idtt=$(this).attr('data-idtt');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thuốc "+name+"?");
            if(cf==true){
                if($('#btncapnhatthuocarea').css('display') == 'block' && idthuoc == $('#btncapnhatthuoc').attr('data-id')){//đóng form sửa khi click xóa
                   $('#btndongformtoathuoc').click();
                }
                
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('idthuoc', idthuoc);
                formData.append('idtt', idtt);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru_ct/xoa',
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
                            $('#tbl_toathuoc tr').has('td div button[data-id="'+data.idttct+'"]').next('tr.spacer').remove();
                            $('#tbl_toathuoc tr').has('td div button[data-id="'+data.idttct+'"]').remove();
                            
                            if($('#btncapnhatthuoc').attr('data-idthuoc') == idthuoc){
                                $('#tenthuoc').val('');$('#dvt').val('');$('#sl').val('');$('#sang').val('');$('#trua').val('');$('#chieu').val('');$('#toi').val('');$('#ghichutoathuocct').val('');
                                $('#btncapnhatthuocarea').fadeOut(800);
                                $('#formtoathuoc').slideUp(800);$('#formtoathuocct').slideUp(800);
                            }
                            if($('#tbl_toathuoc').children().length == 0){
                                $('input[data-input="checksumTT"]').prop("checked",false);
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
        
        //click check sum
        $('body').on('change', 'input[data-input="checksumTT"]', function(){
            if($(this).prop("checked")){
                $('#tbl_toathuoc input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_toathuoc input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_toathuoc').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksumTT"]').prop("checked",false);
            }
            else{
                if($('#tbl_toathuoc input[data-input="check"]:checked').length == $('#tbl_toathuoc input[data-input="check"]').length){
                    $('input[data-input="checksumTT"]').prop("checked",true);
                }   
            }
        });
        //end
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatcthuoc').click(function(){
            if(!$('#tbl_toathuoc input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn thuốc để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[], idtt='';
                $('#tbl_toathuoc input[data-input="check"]').each(function(){
                    if($(this).is(":checked")){
                        $.each(this.attributes, function() {
                            if (this.name.indexOf('data-id') == 0) {
                                arr.push(this.value);
                            }
                            if (this.name.indexOf('data-name') == 0) {
                                arr_name.push(this.value);
                            }
                            if (this.name.indexOf('data-matt') == 0) {
                                idtt=this.value;
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
                    cf=confirm("Bạn có thực sự muốn xóa các thông tin thuốc "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin thuốc "+name+"?");
                }
                if(cf==true){
                    for (var i = 0; i < arr.length; i++) {
                        if($('#btncapnhatthuocarea').css('display') == 'block' && arr[i] == $('#btncapnhatthuoc').attr('data-id')){//đóng form sửa khi click xóa
                           $('#btndongformtoathuoc').click();
                        }
                    }
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('idthuoc', arr);
                    formData.append('idtt', idtt);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru_ct/xoa',
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
                                if($.isArray(data.idttct)){
                                    for (var i = 0; i < data.idttct.length; i++) {
                                        $('#tbl_toathuoc tr').has('td div button[data-id="'+data.idttct[i]+'"]').next('tr.spacer').remove();
                                        $('#tbl_toathuoc tr').has('td div button[data-id="'+data.idttct[i]+'"]').remove();
                                    }
                                }
                                else{
                                    $('#tbl_toathuoc tr').has('td div button[data-id="'+data.idttct+'"]').next('tr.spacer').remove();
                                    $('#tbl_toathuoc tr').has('td div button[data-id="'+data.idttct+'"]').remove();
                                }
                                if(arr.length > 1){
                                    $('#tenthuoc').val('');$('#dvt').val('');$('#sl').val('');$('#sang').val('');$('#trua').val('');$('#chieu').val('');$('#toi').val('');$('#ghichutoathuocct').val('');
                                    $('#btncapnhatthuocarea').fadeOut(800);
                                    $('#formtoathuoc').slideUp(800);$('#formtoathuocct').slideUp(800);
                                    if($('#tbl_toathuoc').children().length == 0){
                                        $('input[data-input="checksumTT"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các loại thuốc thành công!");
                                    
                                }
                                else
                                {
                                    if($('#btncapnhatthuoc').attr('data-idthuoc') == arr[0]){
                                        $('#tenthuoc').val('');$('#dvt').val('');$('#sl').val('');$('#sang').val('');$('#trua').val('');$('#chieu').val('');$('#toi').val('');$('#ghichutoathuocct').val('');
                                        $('#btncapnhatthuocarea').fadeOut(800);
                                        $('#formtoathuoc').slideUp(800);$('#formtoathuocct').slideUp(800);
                                    }
                                    if($('#tbl_toathuoc').children().length == 0){
                                        $('input[data-input="checksumTT"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin thuốc thành công!");
                                    
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các loại thuốc thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin thuốc thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các loại thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các loại thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các loại thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin loại thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin loại thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin loại thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }
            }
        });
        //end
        
        //xử lý lấy phần text cho datalist tên thuốc
        $('input[list="dstenthuoc"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('tenthuoc_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue || option.getAttribute('value') == inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    input.value=option.getAttribute('value');
                    $('#dvt').val(option.getAttribute('data-dvt'));
                    break;
                }
                else{
                    hiddenInput.value='';
                    $('#dvt').val('');
                }  
            }
        });
        //end
        
        //dữ liệu in toa thuốc
        function prepare_content_to_print(data, bn){
            var d=new Date();
            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var nam=d.getFullYear();
            var flagthe=false;
            var content='<div class="card-body card-block printcontent_toa" style="height: 814px;">\n\
                            <div class="row">\n\
                                <div class="col-lg-12">\n\
                                    <div class="row" style="font-weight: 600;">\n\
                                        <div class="col-lg-8">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-3 text-center" style="margin: 0; padding: 0; padding-top: 3px;">\n\
                                                    <label><img src="public/images/logo3.png" style="height: 50px;"></label>\n\
                                                </div>\n\
                                                <div class="col-lg-9" style="margin: 0; font-size: 9pt; padding: 0">\n\
                                                    <label style="margin: 0;">SỞ Y TẾ TỈNH AN GIANG</label><br>\n\
                                                    <label style="margin: 0;">BỆNH VIỆN ĐKTT AN GIANG</label>\n\
                                                    <label style="margin: 0;">'+bn.pk+'</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-4 text-center">\n\
                                            <label style="margin-bottom: 2px">'+bn.barcode+'</label><br>\n\
                                            <label>'+bn.mabn+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-20 text-center" style="font-weight: 600;">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="font-size: 14pt; margin-bottom: 0">ĐƠN THUỐC</label><br>\n\
                                            <label style="font-style: italic;">'+bn.dtk+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0">Họ tên: <label style="font-weight: 600; margin-bottom: 0">'+bn.hoten+'</label></label>\n\
                                        </div>\n\
                                        <div class="col-lg-3 text-right">\n\
                                            <label style="margin-bottom: 0">Tuổi: <label style="font-weight: 600; margin-bottom: 0">'+bn.tuoi+'</label></label>\n\
                                        </div>\n\
                                        <div class="col-lg-3 text-right">\n\
                                            <label style="margin-bottom: 0">Nam/Nữ: <label style="font-weight: 600; margin-bottom: 0">'+bn.gt+'</label></label>\n\
                                        </div>\n\
                                    </div>';
                                    if(bn.mathe != 'koco')
                                    {
                                        flagthe=true;
                                        content+='<div class="row">\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0">Thẻ BHYT: <label style="font-weight: 600; margin-bottom: 0">'+bn.mathe+'</label></label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0">Từ ngày: <label style="font-weight: 600; margin-bottom: 0">'+bn.tungay+'</label> - đến ngày: <label style="font-weight: 600; margin-bottom: 0">'+bn.denngay+'</label></label>\n\
                                        </div>\n\
                                    </div>';
                                    }
                                    content+='<div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0">Địa chỉ liên hệ: <label style="font-weight: 600; margin-bottom: 0">'+bn.diachi+'</label></label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0">Xuất kho: <label style="font-weight: 600; margin-bottom: 0">'+bn.khothuoc+'</label></label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-15">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0">Chuẩn đoán: <label style="font-weight: 600; margin-bottom: 0">'+bn.chuandoan+'</label></label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0">Sinh hiệu: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-5">\n\
                                                    <label style="margin-bottom: 0">Mạch: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-7">\n\
                                                    <label style="margin-bottom: 0">lần/phút</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-7">\n\
                                                    <label style="margin-bottom: 0">Nhiệt độ: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-5">\n\
                                                    <label style="margin-bottom: 0"><sup>o</sup>C</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-7">\n\
                                                    <label style="margin-bottom: 0">Huyết áp: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-5">\n\
                                                    <label style="margin-bottom: 0">mmHg</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-10">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="font-weight: 600; text-decoration: underline; margin-bottom: 0">Thuốc điều trị:</label>\n\
                                        </div>\n\
                                    </div>';
            var newpage_bf='<div class="card-body card-block printcontent_toa" style="height: 814px;">\n\
                            <div class="row">\n\
                                <div class="col-lg-12">';
            if($.isArray(data))
            {
                var n=1; var trang=1;
                if(data.length > 2) //so trang > 1
                {
                    if((data.length - 2) % 9 == 0)
                    {
                        tstrangtt = parseInt(((data.length - 2)/9) + 1);
                    }
                    else{
                        tstrangtt = parseInt(((data.length - 2)/9) + 2);
                    }
                }
                for (var i = 0; i < data.length; i++) {
                    content+=data[i];
                    if(n < 2)
                    {
                        if(i == data.length - 1)//1 loại thuốc
                        {
                            var space_height=33+((2 - data.length)*81)+21;
                            if(flagthe == true){
                                space_height-=21;
                            }
                            content+='<div class="row m-b-15">\n\
                                        <div class="col-lg-12">\n\
                                            <label>Lời dặn của bác sĩ: '+bn.ghichutoa+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center m-b-15">\n\
                                        <div class="col-lg-6" style="vertical-align: middle">\n\
                                            <br>\n\
                                            <label style="font-weight: 600;margin-bottom: 0">Người bệnh</label><br>\n\
                                            <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="font-weight: 600">'+bn.hoten+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0">Toa cấp Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                            <label style="margin-bottom: 0;font-weight: 600;">Bác sĩ/ Y sĩ khám bệnh</label><br>\n\
                                            <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="font-weight: 600">Bs. '+bn.nv+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label>Người bệnh BHYT trái tuyến phải xin giấy chuyển viện</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div style="height: '+space_height+'px"></div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9">\n\
                                            <label>- Khám lại xin mang theo đơn này.</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3 text-right">\n\
                                            <label>Trang <label style="font-weight: 600;">1/1.</label></label>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>';
                        }
                    }
                    else if(n==2)
                    {
                        if(i == data.length - 1)
                        {
                            var space_height=33+((2 - data.length)*81)+21;
                            if(flagthe == true){
                                space_height-=21;
                            }
                            content+='<div class="row m-b-15">\n\
                                        <div class="col-lg-12">\n\
                                            <label>Lời dặn của bác sĩ: '+bn.ghichutoa+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center m-b-15">\n\
                                        <div class="col-lg-6" style="vertical-align: middle">\n\
                                            <br>\n\
                                            <label style="font-weight: 600;margin-bottom: 0">Người bệnh</label><br>\n\
                                            <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="font-weight: 600">'+bn.hoten+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0">Toa cấp Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                            <label style="margin-bottom: 0;font-weight: 600;">Bác sĩ/ Y sĩ khám bệnh</label><br>\n\
                                            <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="font-weight: 600">Bs. '+bn.nv+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label>Người bệnh BHYT trái tuyến phải xin giấy chuyển viện</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div style="height: '+space_height+'px"></div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9">\n\
                                            <label>- Khám lại xin mang theo đơn này.</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3 text-right">\n\
                                            <label>Trang <label style="font-weight: 600;">1/1.</label></label>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>';
                        }
                    }
                    else
                    {
                        if(n < 5)
                        {
                            if(i == data.length - 1)
                            {
                                var space_height=20+((5-parseInt(data.length))*81)+21;
                                var space_height1=20+(6*81);
                                if(flagthe == true){
                                    space_height-=21;
                                }
                                content+='<div style="height: '+space_height+'px"></div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-12 text-right">\n\
                                                <label>Trang <label style="font-weight: 600;">'+trang+'/'+tstrangtt+'.</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                                        '+newpage_bf+'\n\
                                        <div class="row m-b-15">\n\
                                            <div class="col-lg-12">\n\
                                                <label>Lời dặn của bác sĩ: '+bn.ghichutoa+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row text-center m-b-15">\n\
                                            <div class="col-lg-6" style="vertical-align: middle">\n\
                                                <br>\n\
                                                <label style="font-weight: 600;margin-bottom: 0">Người bệnh</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                <label style="font-weight: 600">'+bn.hoten+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 0">Toa cấp Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                                <label style="margin-bottom: 0;font-weight: 600;">Bác sĩ/ Y sĩ khám bệnh</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                <label style="font-weight: 600">Bs. '+bn.nv+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-12">\n\
                                                <label>Người bệnh BHYT trái tuyến phải xin giấy chuyển viện</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div style="height: '+space_height1+'px"></div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-9">\n\
                                                <label>- Khám lại xin mang theo đơn này.</label>\n\
                                            </div>\n\
                                            <div class="col-lg-3 text-right">\n\
                                                <label>Trang <label style="font-weight: 600;">'+(trang + 1)+'/'+tstrangtt+'.</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>';
                            }
                        }
                        else if(n == 5)
                        {
                            if(i == data.length - 1)
                            {
                                var space_height=20+21;
                                var space_height1=20+(6*81);
                                if(flagthe == true){
                                    space_height-=21;
                                }
                                content+='<div style="height: '+space_height+'px"></div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-12 text-right">\n\
                                                <label>Trang <label style="font-weight: 600;">'+trang+'/'+tstrangtt+'.</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        </div>\n\
                                </div>\n\
                            </div>\n\
                                        '+newpage_bf+'\n\
                                        <div class="row m-b-15">\n\
                                            <div class="col-lg-12">\n\
                                                <label>Lời dặn của bác sĩ: '+bn.ghichutoa+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row text-center m-b-15">\n\
                                            <div class="col-lg-6" style="vertical-align: middle">\n\
                                                <br>\n\
                                                <label style="font-weight: 600;margin-bottom: 0">Người bệnh</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                <label style="font-weight: 600">'+bn.hoten+'</label>\n\
                                            </div>\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 0">Toa cấp Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                                <label style="margin-bottom: 0;font-weight: 600;">Bác sĩ/ Y sĩ khám bệnh</label><br>\n\
                                                <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                <label style="font-weight: 600">Bs. '+bn.nv+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-12">\n\
                                                <label>Người bệnh BHYT trái tuyến phải xin giấy chuyển viện</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div style="height: '+space_height1+'px"></div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-9">\n\
                                                <label>- Khám lại xin mang theo đơn này.</label>\n\
                                            </div>\n\
                                            <div class="col-lg-3 text-right">\n\
                                                <label>Trang <label style="font-weight: 600;">'+(trang + 1)+'/'+tstrangtt+'.</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>';
                            }
                            else{
                                var space_height=20+21;
                                if(flagthe == true){
                                    space_height-=21;
                                }
                                content+='<div style="height: '+space_height+'px"></div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-12 text-right">\n\
                                                <label>Trang <label style="font-weight: 600;">'+trang+'/'+tstrangtt+'.</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>'+newpage_bf;
                            trang++;                           
                            }
                        }
                        else{
                            if((n-11) % 9 == 0) //chia hết cho 6
                            {
                                if(i == data.length - 1)
                                {
                                    var space_height1=20;
                                    content+='\n\
                                            <div class="row m-b-15">\n\
                                                <div class="col-lg-12">\n\
                                                    <label>Lời dặn của bác sĩ: '+bn.ghichutoa+'</label>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="row text-center m-b-15">\n\
                                                <div class="col-lg-6" style="vertical-align: middle">\n\
                                                    <br>\n\
                                                    <label style="font-weight: 600;margin-bottom: 0">Người bệnh</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                    <label style="font-weight: 600">'+bn.hoten+'</label>\n\
                                                </div>\n\
                                                <div class="col-lg-6">\n\
                                                    <label style="margin-bottom: 0">Toa cấp Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                                    <label style="margin-bottom: 0;font-weight: 600;">Bác sĩ/ Y sĩ khám bệnh</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                    <label style="font-weight: 600">Bs. '+bn.nv+'</label>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="row">\n\
                                                <div class="col-lg-12">\n\
                                                    <label>Người bệnh BHYT trái tuyến phải xin giấy chuyển viện</label>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div style="height: '+space_height1+'px"></div>\n\
                                            <div class="row">\n\
                                                <div class="col-lg-9">\n\
                                                    <label>- Khám lại xin mang theo đơn này.</label>\n\
                                                </div>\n\
                                                <div class="col-lg-3 text-right">\n\
                                                    <label>Trang <label style="font-weight: 600;">'+trang+'/'+tstrangtt+'.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>';

                                }
                            }
                            else if((n-5) % 9 == 0)
                            {
                                if(i == data.length - 1)
                                {
                                    var space_height=8;
                                    var space_height1=20+(6*81);
                                    content+='<div style="height: '+space_height+'px"></div>\n\
                                            <div class="row">\n\
                                                <div class="col-lg-12 text-right">\n\
                                                    <label>Trang <label style="font-weight: 600;">'+trang+'/'+tstrangtt+'.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                        '+newpage_bf+'\n\
                                            <div class="row m-b-15">\n\
                                                <div class="col-lg-12">\n\
                                                    <label>Lời dặn của bác sĩ: '+bn.ghichutoa+'</label>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="row text-center m-b-15">\n\
                                                <div class="col-lg-6" style="vertical-align: middle">\n\
                                                    <br>\n\
                                                    <label style="font-weight: 600;margin-bottom: 0">Người bệnh</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                    <label style="font-weight: 600">'+bn.hoten+'</label>\n\
                                                </div>\n\
                                                <div class="col-lg-6">\n\
                                                    <label style="margin-bottom: 0">Toa cấp Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                                    <label style="margin-bottom: 0;font-weight: 600;">Bác sĩ/ Y sĩ khám bệnh</label><br>\n\
                                                    <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                    <label style="font-weight: 600">Bs. '+bn.nv+'</label>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="row">\n\
                                                <div class="col-lg-12">\n\
                                                    <label>Người bệnh BHYT trái tuyến phải xin giấy chuyển viện</label>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div style="height: '+space_height1+'px"></div>\n\
                                            <div class="row">\n\
                                                <div class="col-lg-9">\n\
                                                    <label>- Khám lại xin mang theo đơn này.</label>\n\
                                                </div>\n\
                                                <div class="col-lg-3 text-right">\n\
                                                    <label>Trang <label style="font-weight: 600;">'+(trang + 1)+'/'+tstrangtt+'.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>';
                                }
                                else{
                                    var space_height=8;
                                    content+='<div style="height: '+space_height+'px"></div>\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-12 text-right">\n\
                                                        <label>Trang <label style="font-weight: 600;">'+trang+'/'+tstrangtt+'.</label></label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>'+newpage_bf;
                                    trang++;
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    if((n-5) % 9 > 6){//sl > 6
                                        var space_height=8+((9-((n-5) % 9))*81);
                                        var space_height1=20+(6*81);
                                        content+='<div style="height: '+space_height+'px"></div>\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-12 text-right">\n\
                                                            <label>Trang <label style="font-weight: 600;">'+trang+'/'+tstrangtt+'.</label></label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    </div>\n\
                                            </div>\n\
                                        </div>\n\
                                                    '+newpage_bf+'\n\
                                                    <div class="row m-b-15">\n\
                                                        <div class="col-lg-12">\n\
                                                            <label>Lời dặn của bác sĩ: '+bn.ghichutoa+'</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div class="row text-center m-b-15">\n\
                                                        <div class="col-lg-6" style="vertical-align: middle">\n\
                                                            <br>\n\
                                                            <label style="font-weight: 600;margin-bottom: 0">Người bệnh</label><br>\n\
                                                            <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                            <label style="font-weight: 600">'+bn.hoten+'</label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-6">\n\
                                                            <label style="margin-bottom: 0">Toa cấp Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                                            <label style="margin-bottom: 0;font-weight: 600;">Bác sĩ/ Y sĩ khám bệnh</label><br>\n\
                                                            <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                            <label style="font-weight: 600">Bs. '+bn.nv+'</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-12">\n\
                                                            <label>Người bệnh BHYT trái tuyến phải xin giấy chuyển viện</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div style="height: '+space_height1+'px"></div>\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-9">\n\
                                                            <label>- Khám lại xin mang theo đơn này.</label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-3 text-right">\n\
                                                            <label>Trang <label style="font-weight: 600;">'+(trang+1)+'/'+tstrangtt+'.</label></label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                    else{
                                        var space_height=20+((6-((n-5) % 9))*81);
                                        if(n<11){
                                            space_height=20+((11-n)*81);
                                        }
                                        content+='<div class="row m-b-15">\n\
                                                        <div class="col-lg-12">\n\
                                                            <label>Lời dặn của bác sĩ: '+bn.ghichutoa+'</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div class="row text-center m-b-15">\n\
                                                        <div class="col-lg-6" style="vertical-align: middle">\n\
                                                            <br>\n\
                                                            <label style="font-weight: 600;margin-bottom: 0">Người bệnh</label><br>\n\
                                                            <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                            <label style="font-weight: 600">'+bn.hoten+'</label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-6">\n\
                                                            <label style="margin-bottom: 0">Toa cấp Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                                            <label style="margin-bottom: 0;font-weight: 600;">Bác sĩ/ Y sĩ khám bệnh</label><br>\n\
                                                            <label style="margin-bottom: 50px;">(Ký, ghi rõ họ tên)</label><br>\n\
                                                            <label style="font-weight: 600">Bs. '+bn.nv+'</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-12">\n\
                                                            <label>Người bệnh BHYT trái tuyến phải xin giấy chuyển viện</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div style="height: '+space_height+'px"></div>\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-9">\n\
                                                            <label>- Khám lại xin mang theo đơn này.</label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-3 text-right">\n\
                                                            <label>Trang <label style="font-weight: 600;">'+trang+'/'+tstrangtt+'.</label></label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
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
            file_name_tt='TOA_THUOC_NOI_TRU_'+bn.hoten.toString().toUpperCase()+'_'+bn.tenkhoa.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam;
            $('#print_content').html(content);
        }

        function genPDF(len) { 
            var deferreds = [];
            var trang = 1;
            if(len == 1){
                var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvas(0, 'ko', deferred);
            }
            else{
                for (let i = 0; i < len; i++) {
                    var deferred = $.Deferred();
                    deferreds.push(deferred.promise());
                    generateCanvas(i, trang, deferred);
                    trang++;
                }
            }
            

            $.when.apply($, deferreds).then(function () { 
                $('#dtbitt').text('Đã tạo xong!');
                $('#proccesstt').addClass('hidden');
                $('#printarea_toa').addClass('hidden');
            });
        }

        function generateCanvas(i, trang,  deferred){

            html2canvas($("div[class*='printcontent_toa']:eq("+i+")")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent_toa']",i);
                var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.autoPrint({variant: 'non-conform'});
                if(trang == 'ko'){
                    pdf.save(file_name_tt+'.pdf');
                }
                else{
                    pdf.save(file_name_tt+'_TRANG_'+trang+'.pdf');
                }
                deferred.resolve();
             });
        }
        //end
        
        
        $('#btnintoathuoc').click(function(){
            var idtt=$(this).attr('data-id');
            if(idtt == ''){
                alert('Toa thuốc không tồn tại!');
                return false;
            }
            $('#dtbiareatt').removeClass('hidden');$('#dtbitt').text('Đang tạo bản in!');
            $('#proccesstt').removeClass('hidden');
            $('#printarea_toa').removeClass('hidden');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idtt', idtt);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru/in',
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
                        $.when(prepare_content_to_print(data.data, data.bn)).done(function(){
                            
                            if(tstrangtt > 1)
                            {
                                genPDF(tstrangtt);
                            }
                            else
                            {
                                genPDF(1);
                            }
                        });
                    }
                    else{
                        $('#dtbiareatt').addClass('hidden');$('#proccesstt').addClass('hidden');
                        alert("Không thể tạo dữ liệu in! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareatt').addClass('hidden');$('#proccesstt').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Không thể tạo dữ liệu in! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể tạo dữ liệu in! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể tạo dữ liệu in! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        $('#btnhuytoathuoc').click(function(){
            var idtt=$(this).attr('data-id');
            if(idtt == ''){
                alert('Toa thuốc không tồn tại!');
                return false;
            }
            var cf=confirm("Bạn có thực sự muốn hủy toa thuốc này?");
            
            if(cf==true){
                if($('#btncapnhatthuoc').css('display') == 'block'){//đóng form sửa khi click xóa
                   $('#btndongformtoathuoc').click();
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('idtt', idtt);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/toa_thuoc_noi_tru/xoa',
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
                            $('input[data-input="checksumTT"]').prop("checked",false);
                            $('#tenthuoc').val('');$('#dvt').val('');$('#sl').val('');$('#sang').val('');$('#trua').val('');$('#chieu').val('');$('#toi').val('');$('#ghichutoathuocct').val('');$('#ghichutoathuoc').val('');$('#tongsothuoc').val('');
                            $('#tenthuoc').removeAttr('readonly');
                            $('#btnintoathuoc').attr('data-id','');
                            $('#btnhuytoathuoc').attr('data-id','');
                            $('#tbl_toathuoc').html('');
                            alert("Xóa thông tin toa thuốc thành công!");
                        }
                        else{
                            alert("Xóa thông tin toa thuốc thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin toa thuốc thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin toa thuốc thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin toa thuốc thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        
        //------------------------Cận lâm sàng
        function genPDFCLS() { 
            var deferreds = [];
            var deferred = $.Deferred();
            deferreds.push(deferred.promise());
            generateCanvasCLS(deferred);
            
            $.when.apply($, deferreds).then(function () { 
                $('#dtbicls').text('Đã tạo xong!');
                $('#proccesscls').addClass('hidden');
                $('#printarea_cls').addClass('hidden');
            });
        }

        function generateCanvasCLS(deferred){

            html2canvas($("div[class*='printcontent_cls']:eq(0)")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent_cls']",0);
                var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.autoPrint({variant: 'non-conform'});
                pdf.save(file_name_tt+'.pdf');
                deferred.resolve();
             });
        }
        
        function prepare_content_to_print_cls(data, bn){
            var d=new Date();
            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var nam=d.getFullYear();
            var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
            var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
            var giay=((d.getSeconds()<10) ? '0' : '') + d.getSeconds();
            var content='<div class="card-body card-block printcontent_cls" style="height: 814px;">\n\
                                <div class="row">\n\
                                    <div class="col-lg-12">\n\
                                    <div style="height: 705px;">\n\
                                        <div class="row" style="font-weight: 600;">\n\
                                            <div class="col-lg-8">\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-3 text-center" style="margin: 0; padding: 0; padding-top: 3px;">\n\
                                                        <label><img src="public/images/logo3.png" style="height: 50px;"></label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-9" style="margin: 0; font-size: 9pt; padding: 0">\n\
                                                        <label style="margin: 0;">SỞ Y TẾ TỈNH AN GIANG</label><br>\n\
                                                        <label style="margin: 0;">BỆNH VIỆN ĐKTT AN GIANG</label><br>\n\
                                                        <label style="margin: 0;">'+bn.pk+'</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="col-lg-4 text-center">\n\
                                                <label style="margin-bottom: 2px">'+bn.barcode+'</label><br>\n\
                                                <label>MYT:&nbsp;'+bn.mabn+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-5 text-center" style="font-weight: 600;">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="font-size: 14pt; margin-bottom: 0">PHIẾU CHỈ ĐỊNH '+bn.tencls.toLocaleString().toUpperCase()+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-2"></div>\n\
                                            <div class="col-lg-3"><label>Loại chỉ định:</label></div>\n\
                                            <div class="col-lg-2">\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-6">\n\
                                                        <label>Khẩn</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-6">\n\
                                                        <label class="au-checkbox">';
                if(bn.loaicd == true){content+='<input type="checkbox" checked="">';}else{content+='<input type="checkbox">';}
                                                            content+='<span class="au-checkmark"></span>\n\
                                                        </label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="col-lg-3">\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-6">\n\
                                                        <label>Thường</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-6">\n\
                                                        <label class="au-checkbox">';
                if(bn.loaicd == false){content+='<input type="checkbox" checked="">';}else{content+='<input type="checkbox">';}
                                                            content+='<span class="au-checkmark"></span>\n\
                                                        </label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="col-lg-2"></div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-2"></div>\n\
                                            <div class=col-lg-8">\n\
                                                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loại bệnh Phẩm: ..........................................................................................</label>\n\
                                            </div>\n\
                                            <div class="col-lg-2"></div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Họ tên người bệnh: <label style="font-weight: 600; margin-bottom: 0">'+bn.hoten+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 0">Ngày sinh: <label style="font-weight: 600; margin-bottom: 0">'+bn.ngaysinh+'</label></label>\n\
                                            </div>\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 0">Giới tính: <label style="font-weight: 600; margin-bottom: 0">'+bn.gt+'</label></label>\n\
                                            </div>\n\
                                        </div>';
                                        if(bn.mathe != 'koco')
                                        {
                                            content+='<div class="row">\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 5px">Đối tượng: <label style="font-weight: 600; margin-bottom: 0">'+bn.dtk+'</label></label>\n\
                                                </div>\n\
                                                <div class="col-lg-8">\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-7">\n\
                                                            <label style="margin-bottom: 0;">Số thẻ: <label style="font-weight: 600; margin-bottom: 0">'+bn.mathe+'</label></label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-5">\n\
                                                            <label style="font-weight: 600; margin-bottom: 0">'+bn.ngaydk+'</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>';
                                        }

                                        content+='<div class="row">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Địa chỉ: <label style="font-weight: 600; margin-bottom: 0">'+bn.diachi+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 5px">Khoa/Phòng: <label style="font-weight: 600; margin-bottom: 0">'+bn.pk+'</label></label>\n\
                                            </div>\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 5px">Phòng/Giường: <label style="font-weight: 600; margin-bottom: 0">'+bn.pg+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-5">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Chuẩn đoán: <label style="font-weight: 600; margin-bottom: 0">'+bn.chuandoan+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-5">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Người lấy mẫu: ..............................................................................................................................Giờ lấy mẫu: ...............................................</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-15">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Người nhận mẫu: .........................................................................................................................Giờ nhận mẫu: ...........................................</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row" style="margin-top: 5px;">\n\
                                            <div class="col-lg-12">\n\
                                                <table class="table table-bordered" style="font-size: 10pt;">\n\
                                                    <thead style="font-size: 8pt; vertical-align: middle">\n\
                                                        <tr>\n\
                                                            <th><center>STT</center></th>\n\
                                                            <th><center>Yêu cầu thực hiện</center></th>\n\
                                                            <th><center>Ghi chú thêm</center></th>\n\
                                                        </tr>\n\
                                                    </thead>\n\
                                                    <tbody style="font-size: 9pt;">';

            
            var end_page_unclude_nv='\n\
                                    <div class="row text-center" style="margin-top: 5px">\n\
                                        <div class="col-lg-6" style="vertical-align: middle">\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0">Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                            <label style="margin-bottom: 50px;font-weight: 600;">Bác sĩ chỉ định</label><br>\n\
                                            <label style="font-weight: 600">Bác Sĩ. '+bn.nvcd+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    </div>\n\
                                    <div style="height: 45px"></div>\n\
                                    <div class="row text-right">\n\
                                        <div class="col-lg-12">\n\
                                            <label>'+gio+':'+phut+':'+giay+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9">\n\
                                            <label>*Số phiếu yêu cầu: '+bn.mapcd+'*</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3 text-right">\n\
                                            <label>Trang <label style="font-weight: 600;">1/1.</label></label>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>';
            
            var end_table='</tbody>\n\
                                    </table>\n\
                                </div>\n\
                            </div>';
            
            content+=data+end_table+end_page_unclude_nv;
            file_name_tt='CHI_DINH_CLS_NOI_TRU_'+bn.tencls.toString().toUpperCase()+'_'+bn.hoten.toString().toUpperCase()+'_'+bn.tenkhoa.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam;
            $('#print_content_cls').html(content);
        }
        
        
        function ktcls(maba, macls){
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('maba', maba);
            formData.append('macls', macls);
            return $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/can_lam_sang/kt_cls_noi_tru',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
//                     Success
                    if(data.msg == true){
                        flagcls=true;
                    }
                    else if(data.msg == false)
                    {
                        flagcls=false;
                    }
                    else{
                        flagcls=true;
                        alert("Không thể kiểm tra thông tin các chỉ định cận lâm sàng đã thực hiện! Lỗi: "+data.msg);
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    flagcls=true;
                    if(jqXHR.status == 419){
                        alert("Không thể kiểm tra thông tin các chỉ định cận lâm sàng đã thực hiện! Người dùng không được xác thực (có thể đã đăng xuất).");
                        return false;

                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể kiểm tra thông tin các chỉ định cận lâm sàng đã thực hiện! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        return false;
                    }
                    else{
                        alert("Không thể kiểm tra thông tin các chỉ định cận lâm sàng đã thực hiện! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        return false;
                    }
                    
                }
            });
        }
        
        $('#btnrachidinhcls').click(function(){
            $('#tencls_hide').val('');$('#ghichucls').val('');$('#loaicdcls').val(0);
            $('#tencls').removeAttr('readonly');$('#tencls').val('');
            $('#dtbiareacls').addClass('hidden');$('#proccesscls').addClass('hidden');
            $('#btnrachidinhclsarea').fadeIn(800);$('#btnsuacdclsarea').fadeOut(800);$('#btnlamlaiclsarea').fadeOut(800);$('#btnincdclsarea').fadeOut(800);
            var idba=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idba);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/can_lam_sang/lay_ds_noi',
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
                        for(var i=0; i<data.dscdcls.length; ++i){
                            cdtt+='\n\
                                <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\v\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dscdcls[i].idcls+'" data-name="'+data.dscdcls[i].tencls+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td data-iddmcls="'+data.dscdcls[i].iddmcls+'">'+data.dscdcls[i].tencls+'</td>\n\
                                <td>'+data.dscdcls[i].phongth+'</td>\n\
                                <td>'+data.dscdcls[i].ngayracd+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dscdcls[i].idcls+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dscdcls[i].idcls+'" data-name="'+data.dscdcls[i].tencls+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                        <button type="button" data-button="in" class="item" data-toggle="tooltip" data-placement="top" title="In phiếu" data-id="'+data.dscdcls[i].idcls+'">\n\
                                            <i class="zmdi zmdi-print" ></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#tbl_cdcls').html(cdtt);
                        $('#tbl_cdcls button[data-button]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                    }
                    else if(data.msg!='koco'){
                        $('#tbl_cdcls').html('');
                        alert('sdsd');
                    }
                    else{
                        alert("Lấy danh sách các chỉ định CLS gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy danh sách các chỉ định CLS thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");

                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy danh sách các chỉ định CLS thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy danh sách các chỉ định CLS thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
            
        });
        
        $('#btnracdcls').click(function(){
            var maba=$('#btnrachidinhcls').attr('data-id'), macls=$('#tencls_hide').val(), mapb=$('#dsphongcls').val(), loaicd=$('#loaicdcls').val();
            $.when(ktcls(maba, macls)).then(function (){
                if(flagcls == true){
                    alert("Chỉ định cận lâm sàng này đã được ra!");
                    return false;
                }
                else{
                    flagcls == false;
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('maba', maba);
                    formData.append('macls', macls);
                    formData.append('mapb', mapb);
                    formData.append('loaicd', loaicd);
                    
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/can_lam_sang/them_moi_noi',
                        xhr: function() {
                            var myXhr = $.ajaxSettings.xhr();
                            return myXhr;
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(data) {
        //                     Success
                            if(data.msg == 'tc'){
                                $('#btnincdclsarea').fadeIn(800);$('#btninphieucls').attr('data-id', data.idcls);
                                alert("Ra chỉ định thành công!");
                            }
                            else if(data.msg == 'ktdt'){
                                alert("Bệnh nhân đã kết thúc đợt điều trị này!");
                            }
                            else if(data.msg == 'dakt'){
                                alert("Giai đoạn điều trị này đã kết thúc!");
                            }
                            else{
                                $('#btnincdclsarea').fadeOut(800);$('#btninphieucls').attr('data-id', '');
                                alert("Ra chỉ định thất bại! Lỗi: "+data.msg);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#btnincdclsarea').fadeOut(800);$('#btninphieucls').attr('data-id', '');
                            if(jqXHR.status == 419){
                                alert("Ra chỉ định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                            }
                            else if(jqXHR.status == 500){
                                alert("Ra chỉ định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                            }
                            else{
                                alert("Ra chỉ định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                            }
                        }
                    });
                }
            });
        });
        
        $('#btnsuacdcls').click(function(){
            var macls=$(this).attr('data-id'), mapb=$('#dsphongcls').val(), ghichu=$('#ghichucls').val(), loaicd=$('#loaicdcls').val();
            var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('macls', macls);
                formData.append('mapb', mapb);
                formData.append('ghichu', ghichu);
                formData.append('loaicd', loaicd);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/can_lam_sang/cap_nhat_noi',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        return myXhr;
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
    //                     Success
                        if(data.msg == 'tc'){
                            alert("Cập nhật chỉ định thành công!");
                        }
                        else if(data.msg == 'ktdt'){
                            alert("Bệnh nhân đã kết thúc đợt điều trị này!");
                        }
                        else if(data.msg == 'dakt'){
                            alert("Giai đoạn điều trị này đã kết thúc!");
                        }
                        else{
                            alert("Cập nhật chỉ định thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Cập nhật định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Cập nhật định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Cập nhật định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
        });
        
        $('#btnlamlaicls').click(function (){
            $('#tencls').val('');$('#ghichucls').val('');$('#loaicdcls').val(0);
            $('#tencls').removeAttr('readonly');
            $('#btnrachidinhclsarea').fadeIn(800);$('#btnsuacdclsarea').fadeOut(800);$('#btnlamlaiclsarea').fadeOut(800);$('#btnincdclsarea').fadeOut(800);
        });
        
        $('#tbl_cdcls').on('click','button[data-button="xoa"]',function(){
            var idcls=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa chỉ định "+name+"?");
            if(cf==true){
                if($('#btnsuacdclsarea').css('display') == 'block' && idcls == $('#btnsuacdcls').attr('data-id')){
                    $('#btnlamlaicls').click();
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('idcls', idcls);

                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/can_lam_sang/xoa_noi',
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
                            if($('#tbl_cdcls').children().length == 0){
                                $('input[data-input="checksumCLS"]').prop("checked",false);
                            }
                            alert("Xóa chỉ định CLS thành công!");
                        }
                        else{
                            alert("Xóa chỉ định CLS thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa chỉ định CLS thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa chỉ định CLS thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa chỉ định CLS thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
       
        $('#tbl_cdcls').on('click','button[data-button="sua"]',function(){
            var idcls=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idcls', idcls);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/can_lam_sang/lay_tt_cap_nhat_noi',
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
                        $('#tencls').attr('readonly','');$('#tencls').val(data.tencls);$('input[list="dstencls"]').trigger('input');
                        $('#dsphongcls').val(data.phongth);$('#ghichucls').val(data.ghichu);
                        $('#loaicdcls').val(data.loaicd);
                        $('#btnrachidinhclsarea').fadeOut(800);$('#btnsuacdclsarea').fadeIn(800);$('#btnlamlaiclsarea').fadeIn(800);$('#btnincdclsarea').fadeIn(800);
                       
                        $('#btnsuacdcls').attr('data-id', data.idcls);
                    }
                    else{
                        alert("Lấy thông tin chỉ định CLS thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy thông tin chỉ định CLS thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy thông tin chỉ định CLS thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy thông tin chỉ định CLS thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        function inphieucls(idcls){
            $('#dtbiareacls').removeClass('hidden');$('#dtbicls').text('Đang tạo bản in!');
            $('#proccesscls').removeClass('hidden');
            $('#printarea_cls').removeClass('hidden');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idcls', idcls);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/can_lam_sang/in_noi',
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
                        $.when(prepare_content_to_print_cls(data.data, data.bn)).done(function(){
                            genPDFCLS();
                        });
                    }
                    else{
                        $('#dtbiareacls').addClass('hidden');$('#proccesscls').addClass('hidden');
                        alert("Không thể tạo dữ liệu in! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareacls').addClass('hidden');$('#proccesscls').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Không thể tạo dữ liệu in! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể tạo dữ liệu in! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể tạo dữ liệu in! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        }
        
        $('#tbl_cdcls').on('click','button[data-button="in"]',function(){
            var idcls=$(this).attr('data-id');
            inphieucls(idcls);
        });
        
        //click check sum
        $('body').on('change', 'input[data-input="checksumCLS"]', function(){
            if($(this).prop("checked")){
                $('#tbl_cdcls input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_cdcls input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_cdcls').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksumCLS"]').prop("checked",false);
            }
            else{
                if($('#tbl_cdcls input[data-input="check"]:checked').length == $('#tbl_cdcls input[data-input="check"]').length){
                    $('input[data-input="checksumCLS"]').prop("checked",true);
                }   
            }
        });
        //end
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatccdcls').click(function(){
            if(!$('#tbl_cdcls input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn chỉ định để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[];
                $('#tbl_cdcls input[data-input="check"]').each(function(){
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
                    cf=confirm("Bạn có thực sự muốn xóa các chỉ định "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa chỉ định "+name+"?");
                }
                if(cf==true){
                    for (var i = 0; i < arr.length; i++) {
                        if($('#btnsuacdclsarea').css('display') == 'block' && arr[i] == $('#btnsuacdcls').attr('data-id')){//đóng form sửa khi click xóa
                           $('#btnlamlaicls').click();
                        }
                    }
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('idcls', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/can_lam_sang/xoa_noi',
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
                                    if($('#tbl_cdcls').children().length == 0){
                                        $('input[data-input="checksumCLS"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các chỉ định thành công!");
                                }
                                else
                                {
                                    if($('#tbl_cdcls').children().length == 0){
                                        $('input[data-input="checksumCLS"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin chỉ định thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các chỉ định thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin chỉ định thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các chỉ định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các chỉ định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các chỉ định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin chỉ định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin chỉ định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin chỉ định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }
            }
        });
        //end

        $('#btninphieucls').click(function(){
            var idcls=$(this).attr('data-id');
            inphieucls(idcls);
        });
        
        //xử lý lấy phần text cho datalist tên cls
        $('input[list="dstencls"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('tencls_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    break;
                }
                else{
                    hiddenInput.value='';
                }  
            }
        });
        //end
        
        //---------------------Chỉ định thủ thuật
        
        function kttt(mabact, matt){
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('maba', mabact);
            formData.append('matt', matt);
            return $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/kt_tt_noi_tru',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
//                     Success
                    if(data.msg == true){
                        flagtt=true;
                    }
                    else if(data.msg == false)
                    {
                        flagtt=false;
                    }
                    else{                        
                        flagtt=true;
                        alert("Không thể kiểm tra thông tin các chỉ định thủ thuật đã thực hiện! Lỗi: "+data.msg);
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    flagtt=true;
                    
                    if(jqXHR.status == 419){
                        alert("Không thể kiểm tra thông tin các chỉ định thủ thuật đã thực hiện! Người dùng không được xác thực (có thể đã đăng xuất).");
                        return false;
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể kiểm tra thông tin các chỉ định thủ thuật đã thực hiện! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        return false;
                    }
                    else{
                        alert("Không thể kiểm tra thông tin các chỉ định thủ thuật đã thực hiện! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        return false;
                    }
                }
            });
        }
        
        $('#btnrachidinhtt').click(function(){
            $('#tenthuthuat').val('');$('#ghichutt').val('');$('#nhanvien').val('');$('#loaicdtt').val(0);
            $('#tenthuthuat').removeAttr('readonly');
            $('#dtbiareathuthuat').addClass('hidden');$('#proccessthuthuat').addClass('hidden');
            $('#btnracdthuthuatarea').fadeIn(800);$('#btnsuacdthuthuatarea').fadeOut(800);$('#btnlamlaittarea').fadeOut(800);
            var idba=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idba);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/lay_ds_noi',
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
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dscdtt[i].idtt+'" data-name="'+data.dscdtt[i].tentt+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td data-iddmcls="'+data.dscdtt[i].iddmcls+'">'+data.dscdtt[i].tentt+'</td>\n\
                                <td>'+data.dscdtt[i].phongth+'</td>\n\
                                <td>'+data.dscdtt[i].nv+'</td>\n\
                                <td>'+data.dscdtt[i].ngayracd+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dscdtt[i].idtt+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dscdtt[i].idtt+'" data-name="'+data.dscdtt[i].tentt+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\\n\
                            <tr class="spacer"></tr>';
                        }
                        $('#btninphieutt').attr('data-id', idba);
                        $('#tbl_cdtt').html(cdtt);
                        $('#tbl_cdtt button[data-button]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);
                    }
                    else if(data.msg == 'koco'){
                        $('#btninphieutt').attr('data-id', '');
                        $('#tbl_cdtt').html('');
                    }
                    else{
                        alert("Lấy danh sách các chỉ định thủ thuật gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#btninphieutt').attr('data-id', '');
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
        
        $('#btnracdtt').click(function(){
            var maba=$('#btnrachidinhtt').attr('data-id'), matt=$('#tenthuthuat_hide').val(), mapb=$('#dsphongtt').val(), nv=$('#nhanvien_hide').val(), ghichu=$('#ghichutt').val(), loaicd=$('#loaicdtt').val();
            if($('#tenthuthuat').val().toString().trim() == '' || $('#nhanvien').val().toString().trim() == ''){
                alert('Vui lòng nhập tên thủ thuật và tên nhân viên thực hiện thủ thuật!');
                return false;
            }
            else{
                if(matt == ''){
                    alert('Thủ thuật không có trong danh mục hiện hành của bệnh viện!');
                    return false;
                }
                if(nv == ''){
                    alert('Nhân viên không tồn tại!');
                    return false;
                }
            }
            $.when(kttt(maba, matt)).then(function (){
                if(flagtt == true){
                    alert("Chỉ định thủ thuật này đã được ra!");
                    return false;
                }
                else{
                    flagtt == false;
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('maba', maba);
                    formData.append('matt', matt);
                    formData.append('mapb', mapb);
                    formData.append('nv', nv);
                    formData.append('ghichu', ghichu);
                    formData.append('loaicd', loaicd);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/them_moi_noi',
                        xhr: function() {
                            var myXhr = $.ajaxSettings.xhr();
                            return myXhr;
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(data) {
        //                     Success
                            if(data.msg == 'tc'){
                                alert("Ra chỉ định thành công!");
                            }
                            else if(data.msg == 'ktdt'){
                                alert("Bệnh nhân đã kết thúc đợt điều trị này!");
                            }
                            else if(data.msg == 'dakt'){
                                alert("Giai đoạn điều trị này đã kết thúc!");
                            }
                            else{
                                alert("Ra chỉ định thất bại! Lỗi: "+data.msg);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(jqXHR.status == 419){
                                alert("Ra chỉ định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                            }
                            else if(jqXHR.status == 500){
                                alert("Ra chỉ định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                            }
                            else{
                                alert("Ra chỉ định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                            }
                        }
                    });
                }
            });
        });
        
        $('#btnsuacdtt').click(function(){
            var matt=$(this).attr('data-id'), mapb=$('#dsphongtt').val(), nv=$('#nhanvien_hide').val(), ghichu=$('#ghichutt').val(), loaicd=$('#loaicdtt').val();
            var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('matt', matt);
                formData.append('mapb', mapb);
                formData.append('nv', nv);
                formData.append('ghichu', ghichu);
                formData.append('loaicd', loaicd);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/cap_nhat_noi',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        return myXhr;
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
    //                     Success
                        if(data.msg == 'tc'){
                            alert("Cập nhật chỉ định thành công!");
                        }
                        else if(data.msg == 'ktdt'){
                            alert("Bệnh nhân đã kết thúc đợt điều trị này!");
                        }
                        else if(data.msg == 'dakt'){
                            alert("Giai đoạn điều trị này đã kết thúc!");
                        }
                        else{
                            alert("Cập nhật chỉ định thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Cập nhật định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Cập nhật định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Cập nhật định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
        });
        
        $('#btnlamlaitt').click(function (){
            $('#tenthuthuat').val('');$('#ghichutt').val('');$('#nhanvien').val('');$('#loaicdtt').val(0);
            $('#tenthuthuat').removeAttr('readonly');
            $('#btnracdthuthuatarea').fadeIn(800);$('#btnsuacdthuthuatarea').fadeOut(800);$('#btnlamlaittarea').fadeOut(800);
        });
        
        $('#tbl_cdtt').on('click','button[data-button="xoa"]',function(){
            var idtt=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa chỉ định "+name+"?");
            if(cf==true){
                if($('#btnsuacdthuthuatarea').css('display') == 'block' && idtt == $('#btnsuacdtt').attr('data-id')){
                    $('#btnlamlaitt').click();
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('idtt', idtt);

                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/xoa_noi',
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
                            if($('#tbl_cdtt').children().length  == 0){
                                $('#btninphieutt').attr('data-id', '');
                                $('input[data-input="checksumTT"]').prop("checked",false);
                            }
                            alert("Xóa chỉ định thủ thuật thành công!");
                        }
                        else{
                            alert("Xóa chỉ định thủ thuật thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa chỉ định thủ thuật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa chỉ định thủ thuật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa chỉ định thủ thuật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        
        $('#tbl_cdtt').on('click','button[data-button="sua"]',function(){
            var idtt=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idtt', idtt);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/lay_tt_cap_nhat_noi',
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
                        $('#tenthuthuat').attr('readonly','');$('#tenthuthuat').val(data.tentt);$('input[list="dsthuthuat"]').trigger('input');
                        $('#dsphongtt').val(data.phongth);$('#nhanvien').val(data.nv);$('input[list="dsnv"]').trigger('input');$('#ghichutt').val(data.ghichu);
                        $('#loaicdtt').val(data.loaicd);
                        $('#btnracdthuthuatarea').fadeOut(800);$('#btnsuacdthuthuatarea').fadeIn(800);$('#btnlamlaittarea').fadeIn(800);
                        
                        $('#btnsuacdtt').attr('data-id', data.idtt);
                    }
                    else{
                        alert("Lấy thông tin chỉ định thủ thuật thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy thông tin chỉ định thủ thuật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy thông tin chỉ định thủ thuật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy thông tin chỉ định thủ thuật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        //click check sum
        $('body').on('change', 'input[data-input="checksumThuThuat"]', function(){
            if($(this).prop("checked")){
                $('#tbl_cdtt input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_cdtt input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_cdtt').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksumThuThuat"]').prop("checked",false);
            }
            else{
                if($('tbl_cdtt input[data-input="check"]:checked').length == $('tbl_cdtt input[data-input="check"]').length){
                    $('input[data-input="checksumThuThuat"]').prop("checked",true);
                }   
            }
        });
        //end
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatccdtt').click(function(){
            if(!$('#tbl_cdtt input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn chỉ định để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[];
                $('#tbl_cdtt input[data-input="check"]').each(function(){
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
                    cf=confirm("Bạn có thực sự muốn xóa các chỉ định "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa chỉ định "+name+"?");
                }
                if(cf==true){
                    for (var i = 0; i < arr.length; i++) {
                        if($('#btnsuacdthuthuatarea').css('display') == 'block' && arr[i] == $('#btnsuacdtt').attr('data-id')){//đóng form sửa khi click xóa
                           $('#btnlamlaitt').click();
                        }
                    }
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('idtt', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/xoa_noi',
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
                                    if($('#tbl_cdtt').children().length  == 0){
                                        $('#btninphieutt').attr('data-id', '');
                                        $('input[data-input="checksumTT"]').prop("checked",false);
                                    }
                                    $('input[data-input="checksumThuThuat"]').prop("checked",false);
                                    
                                    alert("Xóa thông tin các chỉ định thành công!");
                                }
                                else
                                {
                                    if($('#tbl_cdtt').children().length  == 0){
                                        $('#btninphieutt').attr('data-id', '');
                                        $('input[data-input="checksumTT"]').prop("checked",false);
                                    }
                                    $('input[data-input="checksumThuThuat"]').prop("checked",false);
                                    
                                    alert("Xóa thông tin chỉ định thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các chỉ định thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin chỉ định thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các chỉ định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các chỉ định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các chỉ định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin chỉ định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin chỉ định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin chỉ định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }
            }
        });
        //end
        
        //xử lý lấy phần text cho datalist tên thủ thuật
        $('input[list="dsthuthuat"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('tenthuthuat_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    break;
                }
                else{
                    hiddenInput.value='';
                }  
            }
        });
        //end
        
        //xử lý lấy phần text cho datalist tên nhân viên
        $('input[list="dsnv"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('nhanvien_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    break;
                }
                else{
                    hiddenInput.value='';
                }  
            }
        });
        //end
        
        function genPDFTT(len) { 
            var deferreds = [];
            var trang = 1;
            if(len == 1){
                var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvasTT(0, 'ko', deferred);
            }
            else{
                for (let i = 0; i < len; i++) {
                    var deferred = $.Deferred();
                    deferreds.push(deferred.promise());
                    generateCanvasTT(i, trang, deferred);
                    trang++;
                }
            }
            

            $.when.apply($, deferreds).then(function () { 
                $('#dtbitthuthuat').text('Đã tạo xong!');
                $('#proccessthuthuat').addClass('hidden');
                $('#printarea_tt').addClass('hidden');
            });
        }

        function generateCanvasTT(i, trang,  deferred){

            html2canvas($("div[class*='printcontent_tt']:eq("+i+")")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent_tt']",i);
                var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.autoPrint({variant: 'non-conform'});
                if(trang == 'ko'){
                    pdf.save(file_name_tt+'.pdf');
                }
                else{
                    pdf.save(file_name_tt+'_TRANG_'+trang+'.pdf');
                }
                deferred.resolve();
             });
        }
        
        function prepare_content_to_print_tt(data, bn){
            var d=new Date();
            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var nam=d.getFullYear();
            var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
            var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
            var giay=((d.getSeconds()<10) ? '0' : '') + d.getSeconds();
            var tenkhoa=bn.tenkhoa;
            var content='<div class="card-body card-block printcontent_tt" style="height: 814px;">\n\
                                <div class="row">\n\
                                    <div class="col-lg-12">\n\
                                    <div style="height: 705px;">\n\
                                        <div class="row" style="font-weight: 600;">\n\
                                            <div class="col-lg-8">\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-3 text-center" style="margin: 0; padding: 0; padding-top: 3px;">\n\
                                                        <label><img src="public/images/logo3.png" style="height: 50px;"></label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-9" style="margin: 0; font-size: 9pt; padding: 0">\n\
                                                        <label style="margin: 0;">SỞ Y TẾ TỈNH AN GIANG</label><br>\n\
                                                        <label style="margin: 0;">BỆNH VIỆN ĐKTT AN GIANG</label><br>\n\
                                                        <label style="margin: 0;">'+bn.pk+'</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="col-lg-4 text-center">\n\
                                                <label style="margin-bottom: 2px">'+bn.barcode+'</label><br>\n\
                                                <label>MYT:&nbsp;'+bn.mabn+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-5 text-center" style="font-weight: 600;">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="font-size: 14pt; margin-bottom: 0">PHIẾU CHỈ ĐỊNH THỦ THUẬT '+tenkhoa.toString().toUpperCase()+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-2"></div>\n\
                                            <div class="col-lg-3"><label>Loại chỉ định:</label></div>\n\
                                            <div class="col-lg-2">\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-6">\n\
                                                        <label>Khẩn</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-6">\n\
                                                        <label class="au-checkbox">';
                if(bn.loaicd == true){content+='<input type="checkbox" checked="">';}else{content+='<input type="checkbox">';}
                                                            content+='<span class="au-checkmark"></span>\n\
                                                        </label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="col-lg-3">\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-6">\n\
                                                        <label>Thường</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-6">\n\
                                                        <label class="au-checkbox">';
                if(bn.loaicd == false){content+='<input type="checkbox" checked="">';}else{content+='<input type="checkbox">';}
                                                            content+='<span class="au-checkmark"></span>\n\
                                                        </label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="col-lg-2"></div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-2"></div>\n\
                                            <div class=col-lg-8">\n\
                                                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loại bệnh Phẩm: ..........................................................................................</label>\n\
                                            </div>\n\
                                            <div class="col-lg-2"></div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Họ tên người bệnh: <label style="font-weight: 600; margin-bottom: 0">'+bn.hoten+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 0">Ngày sinh: <label style="font-weight: 600; margin-bottom: 0">'+bn.ngaysinh+'</label></label>\n\
                                            </div>\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 0">Giới tính: <label style="font-weight: 600; margin-bottom: 0">'+bn.gt+'</label></label>\n\
                                            </div>\n\
                                        </div>';
                                        if(bn.mathe != 'koco')
                                        {
                                            content+='<div class="row">\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 5px">Đối tượng: <label style="font-weight: 600; margin-bottom: 0">'+bn.dtk+'</label></label>\n\
                                                </div>\n\
                                                <div class="col-lg-8">\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-7">\n\
                                                            <label style="margin-bottom: 0;">Số thẻ: <label style="font-weight: 600; margin-bottom: 0">'+bn.mathe+'</label></label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-5">\n\
                                                            <label style="font-weight: 600; margin-bottom: 0">'+bn.ngaydk+'</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>';
                                        }

                                        content+='<div class="row">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Địa chỉ: <label style="font-weight: 600; margin-bottom: 0">'+bn.diachi+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 5px">Khoa/Phòng: <label style="font-weight: 600; margin-bottom: 0">'+bn.pk+'</label></label>\n\
                                            </div>\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 5px">Phòng/Giường: <label style="font-weight: 600; margin-bottom: 0">'+bn.pg+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-5">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Chuẩn đoán: <label style="font-weight: 600; margin-bottom: 0">'+bn.chuandoan+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-5">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Người lấy mẫu: ..............................................................................................................................Giờ lấy mẫu: ...............................................</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-15">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Người nhận mẫu: .........................................................................................................................Giờ nhận mẫu: ...........................................</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row" style="margin-top: 5px;">\n\
                                            <div class="col-lg-12">\n\
                                                <table class="table table-bordered" style="font-size: 10pt;">\n\
                                                    <thead style="font-size: 8pt; vertical-align: middle">\n\
                                                        <tr>\n\
                                                            <th><center>STT</center></th>\n\
                                                            <th><center>Yêu cầu thực hiện</center></th>\n\
                                                            <th><center>Nhân viên thực hiện</center></th>\n\
                                                            <th><center>Ghi chú thêm</center></th>\n\
                                                        </tr>\n\
                                                    </thead>\n\
                                                    <tbody style="font-size: 9pt;">';

            var newpage_bf='<div class="card-body card-block printcontent_tt" style="height: 814px;">\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                        <div style="height: 705px;">';
            var end_page_unclude_nv='\n\
                                    <div class="row text-center" style="margin-top: 5px">\n\
                                        <div class="col-lg-6" style="vertical-align: middle">\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0">Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                            <label style="margin-bottom: 50px;font-weight: 600;">Bác sĩ chỉ định</label><br>\n\
                                            <label style="font-weight: 600">Bác Sĩ. '+bn.nvcd+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    </div>\n\
                                    <div style="height: 38px"></div>\n\
                                    <div class="row text-right">\n\
                                        <div class="col-lg-12">\n\
                                            <label>'+gio+':'+phut+':'+giay+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9">\n\
                                            <label>*Số phiếu yêu cầu: '+bn.mapcd+'*</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3 text-right">';
            var end_page='\n\
                            </div>\n\
                            <div style="height: 38px"></div>\n\
                            <div class="row text-right">\n\
                                <div class="col-lg-12">\n\
                                    <label>'+gio+':'+phut+':'+giay+'</label>\n\
                                </div>\n\
                            </div>\n\
                            <div class="row">\n\
                                <div class="col-lg-9">\n\
                                    <label>*Số phiếu yêu cầu: '+bn.mapcd+'*</label>\n\
                                </div>\n\
                                <div class="col-lg-3 text-right">';
            var end_table='</tbody>\n\
                                    </table>\n\
                                </div>\n\
                            </div>';
            var start_table='<div class="row" style="margin-top: 5px;">\n\
                                <div class="col-lg-12">\n\
                                    <table class="table table-bordered" style="font-size: 10pt;">\n\
                                        <thead style="font-size: 8pt; vertical-align: middle">\n\
                                            <tr>\n\
                                                <th><center>STT</center></th>\n\
                                                <th><center>Yêu cầu thực hiện</center></th>\n\
                                                <th><center>Nhân viên thực hiện</center></th>\n\
                                                <th><center>Ghi chú thêm</center></th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody style="font-size: 9pt;">';
            if($.isArray(data))
            {
                var n=1; var trang=1;
                if(data.length > 5) //so trang > 1
                {
                    if((data.length - 5) % 15 == 0)
                    {
                        tstrangtt = parseInt(((data.length - 5)/15) + 1);
                    }
                    else{
                        tstrangtt = parseInt(((data.length - 5)/15) + 2);
                    }
                }
                for (var i = 0; i < data.length; i++) {
                    content+=data[i];
                    if(n <= 5)
                    {
                        if(i == data.length - 1)//1 cd
                        {
                            content+=end_table+end_page_unclude_nv+'<label>Trang <label style="font-weight: 600;">1/1.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>';
                        }
                    }
                    else
                    {
                        if(n <= 7)
                        {
                            if(i == data.length - 1)
                            {
                                content+=end_table+end_page + '<label>Trang <label style="font-weight: 600;"> '+trang+'/'+tstrangtt+'.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>' + newpage_bf + end_page_unclude_nv + '<label>Trang <label style="font-weight: 600;"> '+(trang+1)+'/'+tstrangtt+'.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>';
                            }
                            else{
                                if(n==7){
                                    content+=end_table+ end_page + '<label>Trang <label style="font-weight: 600;"> '+trang+'/'+tstrangtt+'.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>' + newpage_bf +start_table;
                                    trang++;
                                }
                            }
                        }
                        else{
                            if((n-20) % 15 == 0) //chia hết cho 13
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_page_unclude_nv + '<label>Trang <label style="font-weight: 600;"> '+trang+'/'+tstrangtt+'.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>';

                                }
                            }
                            else if((n-7) % 15 == 0)
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_page + '<label>Trang <label style="font-weight: 600;"> '+trang+'/'+tstrangtt+'.</label></label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_page_unclude_nv + '<label>Trang <label style="font-weight: 600;"> '+(trang+1)+'/'+tstrangtt+'.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>';
                                }
                                else{
                                    content+=end_table + end_page + '<label>Trang <label style="font-weight: 600;"> '+trang+'/'+tstrangtt+'.</label></label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>' + newpage_bf + start_table;
                                    trang++;
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    if((n-7)%15 > 13){
                                        content+=end_table + end_page + '<label>Trang <label style="font-weight: 600;"> '+trang+'/'+tstrangtt+'.</label></label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_page_unclude_nv + '<label>Trang <label style="font-weight: 600;"> '+(trang+1)+'/'+tstrangtt+'.</label></label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                    else{
                                        content+= end_table + end_page_unclude_nv + '<label>Trang <label style="font-weight: 600;"> '+trang+'/'+tstrangtt+'.</label></label>\n\
                                                       </div>\n\
                                                    </div>\n\
                                                </div>\n\
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
            file_name_tt='CHI_DINH_TT_NOI_TRU_'+bn.hoten.toString().toUpperCase()+'_'+bn.tenkhoa.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam;
            $('#print_content_tt').html(content);
        }
        
        $('#btninphieutt').click(function(){
            var idba=$(this).attr('data-id');
            if(idba == ''){
                alert('Không có chỉ định nào để in!');
                return false;
            }
            $('#dtbiareathuthuat').removeClass('hidden');$('#dtbitthuthuat').text('Đang tạo bản in!');
            $('#proccessthuthuat').removeClass('hidden');
            $('#printarea_tt').removeClass('hidden');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', idba);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/chi_dinh_thu_thuat/in_noi',
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
                        $.when(prepare_content_to_print_tt(data.data, data.bn)).done(function(){
                            
                            if(tstrangtt > 1)
                            {
                                genPDFTT(tstrangtt);
                            }
                            else
                            {
                                genPDFTT(1);
                            }
                        });
                    }
                    else{
                        $('#dtbiareathuthuat').addClass('hidden');$('#proccessthuthuat').addClass('hidden');
                        alert("Không thể tạo dữ liệu in! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareathuthuat').addClass('hidden');$('#proccessthuthuat').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Không thể tạo dữ liệu in! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể tạo dữ liệu in! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể tạo dữ liệu in! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        //---------------------Chỉ định phẫu thuật
        
        function ktpt(mabact, mapt){
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('maba', mabact);
            formData.append('mapt', mapt);
            return $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/chi_dinh_phau_thuat/kt_pt',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
//                     Success
                    if(data.msg == true){
                        flagpt=true;
                    }
                    else if(data.msg == false)
                    {
                        flagpt=false;
                    }
                    else{                        
                        flagpt=true;
                        alert("Không thể kiểm tra thông tin các chỉ định phẫu thuật đã thực hiện! Lỗi: "+data.msg);
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    flagpt=true;
                    
                    if(jqXHR.status == 419){
                        alert("Không thể kiểm tra thông tin các chỉ định phẫu thuật đã thực hiện! Người dùng không được xác thực (có thể đã đăng xuất).");
                        return false;
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể kiểm tra thông tin các chỉ định phẫu thuật đã thực hiện! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        return false;
                    }
                    else{
                        alert("Không thể kiểm tra thông tin các chỉ định phẫu thuật đã thực hiện! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        return false;
                    }
                }
            });
        }
        
        $('#btnrachidinhpt').click(function(e, mabact){
            $('#tenpt').val('');$('#ghichupt').val('');$('#nhanvienpt').val('');$('#loaicdpt').val(0);$('#ppth').val('');
            $('#tenpt').removeAttr('readonly');
            $('#dtbiareapt').addClass('hidden');$('#proccesspt').addClass('hidden');
            $('#btnrachidinhptarea').fadeIn(800);$('#btnsuacdptarea').fadeOut(800);$('#btnlamlaiptarea').fadeOut(800);$('#btnincdptsarea').fadeOut(800);
            var idbact=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            if($.isEmptyObject(mabact)){
                formData.append('idba', idbact);
            }
            else{
                formData.append('idba', mabact);
            }
            
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
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.dscdpt.idpt+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dscdpt.idpt+'" data-name="'+data.dscdpt.tenpt+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                            <button type="button" data-button="in" class="item" data-toggle="tooltip" data-placement="top" title="In phiếu" data-id="'+data.dscdpt.idpt+'">\n\
                                        <i class="zmdi zmdi-print" ></i>\n\
                                    </button>\n\
                                        </div>\n\
                                    </td>\n\
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
        
        $('#btnracdpt').click(function(){
            var mabact=$('#btnrachidinhpt').attr('data-id'), mapt=$('#tenpt_hide').val(), mapb=$('#dsphongpt').val(), nv=$('#nhanvienpt_hide').val(), ghichu=$('#ghichupt').val(), loaicd=$('#loaicdpt').val(), pp=$('#ppth').val();
            if($('#tenpt').val().toString().trim() == '' || $('#nhanvienpt').val().toString().trim() == ''){
                alert('Vui lòng nhập tên phẫu thuật và tên nhân viên thực hiện phẫu thuật!');
                return false;
            }
            else if(pp.toString().trim() == ''){
                alert('Vui lòng nhập phương pháp thực hiện phẫu thuật!');
                return false;
            }
            else{
                if(mapt == ''){
                    alert('Phẫu thuật không có trong danh mục hiện hành của bệnh viện!');
                    return false;
                }
                if(nv == ''){
                    alert('Nhân viên không tồn tại!');
                    return false;
                }
            }
            $.when(ktpt(mabact, mapt)).then(function (){
                if(flagpt == true){
                    alert("Giai đoạn điều trị này đã ra chỉ định phẫu thuật, hãy ra chỉ định ở giai đoạn sau!");
                    return false;
                }
                else{
                    flagpt == false;
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('maba', mabact);
                    formData.append('mapt', mapt);
                    formData.append('mapb', mapb);
                    formData.append('nv', nv);
                    formData.append('pp', pp);
                    formData.append('ghichu', ghichu);
                    formData.append('loaicd', loaicd);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/kham_va_dieu_tri/chi_dinh_phau_thuat/them_moi',
                        xhr: function() {
                            var myXhr = $.ajaxSettings.xhr();
                            return myXhr;
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(data) {
        //                     Success
                            if(data.msg == 'tc'){
                                $('#btnincdptsarea').fadeIn(800);
                                $('#btninphieupt').attr('data-id', data.idpt);
                                alert("Ra chỉ định thành công!");
                            }
                            else if(data.msg == 'ktdt'){
                                alert("Bệnh nhân đã kết thúc đợt điều trị này!");
                            }
                            else if(data.msg == 'dakt'){
                                alert("Giai đoạn điều trị này đã kết thúc!");
                            }
                            else{
                                alert("Ra chỉ định thất bại! Lỗi: "+data.msg);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(jqXHR.status == 419){
                                alert("Ra chỉ định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                            }
                            else if(jqXHR.status == 500){
                                alert("Ra chỉ định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                            }
                            else{
                                alert("Ra chỉ định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                            }
                        }
                    });
                }
            });
        });
        
        $('#btninphieupt').click(function(){
            var idpt=$(this).attr('data-id');
            inphieupt(idpt);
        });
        
        $('#tbl_cdpt').on('click','button[data-button="in"]',function(){
            var idpt=$(this).attr('data-id');
            inphieupt(idpt);
        });
        
        function inphieupt(idpt){
            $('#dtbiareapt').removeClass('hidden');$('#dtbipt').text('Đang tạo bản in!');
            $('#proccesspt').removeClass('hidden');
            $('#printarea_pt').removeClass('hidden');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idpt', idpt);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/chi_dinh_phau_thuat/in',
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
                        $.when(prepare_content_to_print_pt(data.data, data.bn)).done(function(){
                            genPDFPT();
                        });
                    }
                    else{
                        $('#dtbiareapt').addClass('hidden');$('#proccesspt').addClass('hidden');
                        alert("Không thể tạo dữ liệu in! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareapt').addClass('hidden');$('#proccesspt').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Không thể tạo dữ liệu in! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể tạo dữ liệu in! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể tạo dữ liệu in! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        }
        
        $('#btnsuacdpt').click(function(){
            var mapt=$(this).attr('data-id'), mapb=$('#dsphongpt').val(), nv=$('#nhanvienpt_hide').val(), ghichu=$('#ghichupt').val(), loaicd=$('#loaicdpt').val(), pp=$('#ppth').val();
            
            if($('#tenpt').val().toString().trim() == '' || $('#nhanvienpt').val().toString().trim() == ''){
                alert('Vui lòng nhập tên phẫu thuật và tên nhân viên thực hiện phẫu thuật!');
                return false;
            }
            else if(pp.toString().trim() == ''){
                alert('Vui lòng nhập phương pháp thực hiện phẫu thuật!');
                return false;
            }
            else{
                if(mapt == ''){
                    alert('Phẫu thuật không có trong danh mục hiện hành của bệnh viện!');
                    return false;
                }
                if(nv == ''){
                    alert('Nhân viên không tồn tại!');
                    return false;
                }
            }
            var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('mapt', mapt);
                formData.append('mapb', mapb);
                formData.append('nv', nv);
                formData.append('pp', pp);
                formData.append('ghichu', ghichu);
                formData.append('loaicd', loaicd);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/chi_dinh_phau_thuat/cap_nhat',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        return myXhr;
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
    //                     Success
                        if(data.msg == 'tc'){
                            alert("Cập nhật chỉ định thành công!");
                        }
                        else if(data.msg == 'ktdt'){
                            alert("Bệnh nhân đã kết thúc đợt điều trị này!");
                        }
                        else if(data.msg == 'dakt'){
                            alert("Giai đoạn điều trị này đã kết thúc!");
                        }
                        else{
                            alert("Cập nhật chỉ định thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Cập nhật định thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Cập nhật định thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Cập nhật định thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
        });
        
        $('#btnlamlaipt').click(function (){
            $('#tenpt').val('');$('#ghichupt').val('');$('#nhanvienpt').val('');$('#loaicdpt').val(0);$('#ppth').val('');
            $('#tenpt').removeAttr('readonly');
            $('#btnrachidinhptarea').fadeIn(800);$('#btnsuacdptarea').fadeOut(800);$('#btnlamlaiptarea').fadeOut(800);$('#btnincdptsarea').fadeOut(800);
        });
        
        $('#tbl_cdpt').on('click','button[data-button="xoa"]',function(){
            var idpt=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa chỉ định "+name+"?");
            if(cf==true){
                $('#btnlamlaipt').click();
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('idpt', idpt);

                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/chi_dinh_phau_thuat/xoa',
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
                            if($('#tbl_cdpt').children().length  == 0){
                                $('input[data-input="checksumPT"]').prop("checked",false);
                            }
                            alert("Xóa chỉ định phẫu thuật thành công!");
                        }
                        else{
                            alert("Xóa chỉ định phẫu thuật thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa chỉ định phẫu thuật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa chỉ định phẫu thuật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa chỉ định phẫu thuật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        
        $('#tbl_cdpt').on('click','button[data-button="sua"]',function(){
            var idpt=$(this).attr('data-id');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idpt', idpt);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/chi_dinh_phau_thuat/lay_tt_cap_nhat',
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
                        $('#tenpt').attr('readonly','');$('#tenpt').val(data.tenpt);$('input[list="dspt"]').trigger('input');
                        $('#dsphongpt').val(data.phongth);$('#nhanvienpt').val(data.nv);$('input[list="dsnvpt"]').trigger('input');$('#ghichupt').val(data.ghichu);$('#ppth').val(data.pp);
                        $('#loaicdpt').val(data.loaicd);
                        $('#btnrachidinhptarea').fadeOut(800);$('#btnsuacdptarea').fadeIn(800);$('#btnlamlaiptarea').fadeIn(800);$('#btnincdptsarea').fadeOut(800);
                        
                        $('#btnsuacdpt').attr('data-id', data.idpt);
                    }
                    else{
                        alert("Lấy thông tin chỉ định phẫu thuật thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy thông tin chỉ định phẫu thuật thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy thông tin chỉ định phẫu thuật thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy thông tin chỉ định phẫu thuật thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });

        //xử lý lấy phần text cho datalist tên phẫu thuật
        $('input[list="dspt"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('tenpt_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    break;
                }
                else{
                    hiddenInput.value='';
                }  
            }
        });
        //end
        
        //xử lý lấy phần text cho datalist tên nhân viên
        $('input[list="dsnvpt"]').on('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById('nhanvienpt_hide'),
                inputValue = input.value;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];
                if(option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    break;
                }
                else{
                    hiddenInput.value='';
                }  
            }
        });
        //end
        
        function genPDFPT() { 
            var deferreds = [];
            var deferred = $.Deferred();
            deferreds.push(deferred.promise());
            generateCanvasPT(deferred);
            
            $.when.apply($, deferreds).then(function () { 
                $('#dtbipt').text('Đã tạo xong!');
                $('#proccesspt').addClass('hidden');
                $('#printarea_pt').addClass('hidden');
            });
        }

        function generateCanvasPT(deferred){

            html2canvas($("div[class*='printcontent_pt']:eq(0)")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent_pt']",0);
                var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.autoPrint({variant: 'non-conform'});
                pdf.save(file_name_tt+'.pdf');
                deferred.resolve();
             });
        }
        
        function prepare_content_to_print_pt(data, bn){
            var d=new Date();
            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var nam=d.getFullYear();
            var gio= ((d.getHours()<10) ? '0' : '') + d.getHours();
            var phut=((d.getMinutes()<10) ? '0' : '') + d.getMinutes();
            var giay=((d.getSeconds()<10) ? '0' : '') + d.getSeconds();
            var tenkhoa=bn.tenkhoa;
            var content='<div class="card-body card-block printcontent_pt" style="height: 814px;">\n\
                                <div class="row">\n\
                                    <div class="col-lg-12">\n\
                                    <div style="height: 705px;">\n\
                                        <div class="row" style="font-weight: 600;">\n\
                                            <div class="col-lg-8">\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-3 text-center" style="margin: 0; padding: 0; padding-top: 3px;">\n\
                                                        <label><img src="public/images/logo3.png" style="height: 50px;"></label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-9" style="margin: 0; font-size: 9pt; padding: 0">\n\
                                                        <label style="margin: 0;">SỞ Y TẾ TỈNH AN GIANG</label><br>\n\
                                                        <label style="margin: 0;">BỆNH VIỆN ĐKTT AN GIANG</label><br>\n\
                                                        <label style="margin: 0;">'+bn.pk+'</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="col-lg-4 text-center">\n\
                                                <label style="margin-bottom: 2px">'+bn.barcode+'</label><br>\n\
                                                <label>MYT:&nbsp;'+bn.mabn+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-5 text-center" style="font-weight: 600;">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="font-size: 14pt; margin-bottom: 0">PHIẾU CHỈ ĐỊNH PHẪU THUẬT '+tenkhoa.toString().toUpperCase()+'</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-2"></div>\n\
                                            <div class="col-lg-3"><label>Loại chỉ định:</label></div>\n\
                                            <div class="col-lg-2">\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-6">\n\
                                                        <label>Khẩn</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-6">\n\
                                                        <label class="au-checkbox">';
                if(bn.loaicd == true){content+='<input type="checkbox" checked="">';}else{content+='<input type="checkbox">';}
                                                            content+='<span class="au-checkmark"></span>\n\
                                                        </label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="col-lg-3">\n\
                                                <div class="row">\n\
                                                    <div class="col-lg-6">\n\
                                                        <label>Thường</label>\n\
                                                    </div>\n\
                                                    <div class="col-lg-6">\n\
                                                        <label class="au-checkbox">';
                if(bn.loaicd == false){content+='<input type="checkbox" checked="">';}else{content+='<input type="checkbox">';}
                                                            content+='<span class="au-checkmark"></span>\n\
                                                        </label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="col-lg-2"></div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-2"></div>\n\
                                            <div class=col-lg-8">\n\
                                                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loại bệnh Phẩm: ..........................................................................................</label>\n\
                                            </div>\n\
                                            <div class="col-lg-2"></div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Họ tên người bệnh: <label style="font-weight: 600; margin-bottom: 0">'+bn.hoten+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 0">Ngày sinh: <label style="font-weight: 600; margin-bottom: 0">'+bn.ngaysinh+'</label></label>\n\
                                            </div>\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 0">Giới tính: <label style="font-weight: 600; margin-bottom: 0">'+bn.gt+'</label></label>\n\
                                            </div>\n\
                                        </div>';
                                        if(bn.mathe != 'koco')
                                        {
                                            content+='<div class="row">\n\
                                                <div class="col-lg-4">\n\
                                                    <label style="margin-bottom: 5px">Đối tượng: <label style="font-weight: 600; margin-bottom: 0">'+bn.dtk+'</label></label>\n\
                                                </div>\n\
                                                <div class="col-lg-8">\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-7">\n\
                                                            <label style="margin-bottom: 0;">Số thẻ: <label style="font-weight: 600; margin-bottom: 0">'+bn.mathe+'</label></label>\n\
                                                        </div>\n\
                                                        <div class="col-lg-5">\n\
                                                            <label style="font-weight: 600; margin-bottom: 0">'+bn.ngaydk+'</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>';
                                        }

                                        content+='<div class="row">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Địa chỉ: <label style="font-weight: 600; margin-bottom: 0">'+bn.diachi+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row">\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 5px">Khoa/Phòng: <label style="font-weight: 600; margin-bottom: 0">'+bn.pk+'</label></label>\n\
                                            </div>\n\
                                            <div class="col-lg-6">\n\
                                                <label style="margin-bottom: 5px">Phòng/Giường: <label style="font-weight: 600; margin-bottom: 0">'+bn.pg+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-5">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Chuẩn đoán: <label style="font-weight: 600; margin-bottom: 0">'+bn.chuandoan+'</label></label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-5">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Người lấy mẫu: ..............................................................................................................................Giờ lấy mẫu: ...............................................</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row m-b-15">\n\
                                            <div class="col-lg-12">\n\
                                                <label style="margin-bottom: 0">Người nhận mẫu: .........................................................................................................................Giờ nhận mẫu: ...........................................</label>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="row" style="margin-top: 5px;">\n\
                                            <div class="col-lg-12">\n\
                                                <table class="table table-bordered" style="font-size: 10pt;">\n\
                                                    <thead style="font-size: 8pt; vertical-align: middle">\n\
                                                        <tr>\n\
                                                            <th><center>Nội dụng chỉ định</center></th>\n\
                                                            <th><center>Nhân viên thực hiện chính</center></th>\n\
                                                            <th><center>Phương pháp phẫu thuật</center></th>\n\
                                                            <th><center>Ghi chú thêm</center></th>\n\
                                                        </tr>\n\
                                                    </thead>\n\
                                                    <tbody style="font-size: 9pt;">';
            var end_page_unclude_nv='\n\
                                    <div class="row text-center" style="margin-top: 5px">\n\
                                        <div class="col-lg-6" style="vertical-align: middle">\n\
                                            <br>\n\
                                            <label style="margin-bottom: 50px;font-weight: 600;">Bệnh nhân</label><br>\n\
                                            <label style="font-weight: 600">'+bn.hoten+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0">Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                            <label style="margin-bottom: 50px;font-weight: 600;">Bác sĩ chỉ định</label><br>\n\
                                            <label style="font-weight: 600">Bác Sĩ. '+bn.nvcd+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    </div>\n\
                                    <div style="height: 38px"></div>\n\
                                    <div class="row text-right">\n\
                                        <div class="col-lg-12">\n\
                                            <label>'+gio+':'+phut+':'+giay+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9">\n\
                                            <label>*Số phiếu yêu cầu: '+bn.mapcd+'*</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3 text-right">';
            
            var end_table='</tbody>\n\
                                    </table>\n\
                                </div>\n\
                            </div>';
            
            content+=data+end_table+end_page_unclude_nv+'<label>Trang <label style="font-weight: 600;">1/1.</label></label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>';
            file_name_tt='CHI_DINH_PT_'+bn.hoten.toString().toUpperCase()+'_'+bn.tenkhoa.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam;
            $('#print_content_pt').html(content);
        }
        
        //-------------------Phiếu kê khai VP
        
        function genPDFPKK(len) { 
            var deferreds = [];
            var trang = 1;
            for (let i = 0; i < len; i++) {
                var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvasPKK(i, trang, deferred);
                trang++;
            }
            
            $.when.apply($, deferreds).then(function () { 
                $('#dtbipkk').text('Đã xử lý xong!');
                $('#proccesspkk').addClass('hidden');
            });
        }

        function generateCanvasPKK(i, trang,  deferred){

            html2canvas($("div[class*='printcontent_vp']:eq("+i+")")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent_vp']",i);
                var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.autoPrint({variant: 'non-conform'});
                pdf.save(file_name_tt+'_TRANG_'+trang+'.pdf');
                deferred.resolve();
             });
        }
        
        function prepare_content_to_print_pkk(data, bn){
            var d=new Date();
            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var nam=d.getFullYear();
            var flagthe=false;
            var content='<div class="card" style="font-weight: normal; height: 814px; width: 660px !important;">\n\
                            <div class="card-block card-body printcontent_vp" style="height: 814px; width: 660px !important;">\n\
                                <div style="height: 715px">\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Bộ Y tế/ Sở Y tế/ Y tế ngành: SỞ Y TẾ TỈNH AN GIANG</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Mẫu số: 01/KBCB</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Cơ sỡ khám, chữa bệnh: BỆNH VIỆN ĐKTT AN GIANG</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Mã số người bệnh: '+bn.mabn+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">Khoa: '+bn.pk+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Số khám bệnh: '+bn.skb+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-10">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">Mã khoa: '+bn.makhoa+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0;">'+bn.barcode+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center m-b-10">\n\
                                        <div class="col-lg-11">\n\
                                            <label style="margin-bottom: 0; font-weight: 600; font-size: 10pt">BẢNG KÊ KHAI CHI PHÍ KHÁM, CHỮA BỆNH NỘI TRÚ</label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="2" cellpadding="2" style="font-size: 10pt; width: 20px; float: right">\n\
                                                <thead>\n\
                                                    <tr>';
                    if(bn.ttbn == true){
                        content+='<th class="text-center">1</th>';
                    }
                    else{
                        content+='<th class="text-center">2</th>';
                    }
                                                        content+='\n\
                                                    </tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0; font-weight: 600;">I. Hành chính:</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-5">\n\
                                            <label style="margin-bottom: 0;">(1) Họ tên: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.hoten+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <label style="margin-bottom: 0;">Ngày sinh: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.ngaysinh+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <label style="margin-bottom: 0;">Giới tính: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.gt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9">\n\
                                            <label style="margin-bottom: 0;">(2) Địa chỉ hiện tại: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.diachi+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <label style="margin-bottom: 0;">(3) Mã khu vực: </label>\n\
                                        </div>\n\
                                    </div>';
            if(bn.mathe != 'koco'){
                flagthe=true;
                                    content+='<div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-4" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(4) Mã thẻ BHYT: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-8">\n\
                                                    <table border="2" style="font-size: 8pt; width: 20px;">\n\
                                                        <thead class="text-center">\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(0,2)+'</th><th style="border: 2px solid; padding: 2px">4</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(2,4)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(4,6)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(6,9)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(9,14)+'</th><th style="border: 2px solid; padding: 2px">'+bn.macsk+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-5 text-right">\n\
                                            <label style="margin-bottom: 0;">Giá trị từ:</label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tungay+'</label> <label>đến</label> <label style="margin-bottom: 0; font-weight: 600">'+bn.denngay+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-9" style="padding-right: 0">\n\
                                            <label style="margin-bottom: 0;">(5) Cơ sở đăng ký KCB BHYT ban đầu: </label> <label style="margin-bottom: 0; font-weight: 600;">'+bn.tencsk+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-6 text-right" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(6) Mã: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-6">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 50px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th class="text-center" style="border: 2px solid; padding: 2px">'+bn.macsk+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
            }
                                    content+='<div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">(7) Đến khám: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.ngaydt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">(8) Điều trị ngoại trú/nội trú từ: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.ngaydt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">(9) Kết thúc khám/điều trị: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.ngaykt+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-5">\n\
                                                    <label style="margin-bottom: 0;">Tổng số ngày điều trị: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.sndt+'</label>\n\
                                                </div>\n\
                                                <div class="col-lg-5 text-right">\n\
                                                    <label style="margin-bottom: 0;">(10) Tình trạng ra viện: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-2">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 20px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>';
                                if(bn.ttbn == true){
                                    content+='<th class="text-center" style="border: 2px solid; padding: 2px">1</th>';
                                }
                                else{
                                    content+='<th class="text-center" style="border: 2px solid; padding: 2px">2</th>';
                                }
                                                                content+='\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5">\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(11) Cấp cứu: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>\n\
                                                        <th style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(12) Đúng tuyến: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>';
                if(bn.tuyen == true){
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px">X</th>';}
                else{
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>';
                }
                                                    content+='</tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">Nơi chuyển đến từ: '+bn.giaychuyenden+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(13) Thông tuyến: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>\n\
                                                        <th style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-2">\n\
                                            <label style="margin-bottom: 0;">(14) Trái tuyến: </label>\n\
                                        </div>\n\
                                        <div class="col-lg-1">\n\
                                            <table border="1" style="font-size: 8pt; width: 20px; height: 20px">\n\
                                                <thead>\n\
                                                    <tr>';
            if(bn.tuyen == false){
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px">X</th>';}
                else{
                                                        content+='<th class="text-center" style="border: 2px solid; padding: 2px;width: 20px; height: 20px"></th>';
                }
                                                       
                                                    content+='</tr>\n\
                                                </thead>\n\
                                            </table>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">Nơi chuyển đi: '+bn.giaychuyendi+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5">\n\
                                        <div class="col-lg-8">\n\
                                            <label style="margin-bottom: 0;">(15) Chuẩn đoán xác định: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.chuandoan+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-5 text-right" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(16) Mã bệnh: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-7">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 100px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mabenh+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">(17) Bệnh kèm theo: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.chuandoan+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-5">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-6 text-right" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">(18) Mã bệnh kèm theo: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-6">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 100px; float: right">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mabenh+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5">\n\
                                        <div class="col-lg-7">\n\
                                            <label style="margin-bottom: 0;">(19) Thời gian đủ 5 năm liêm tục từ ngày: </label> <label style="margin-bottom: 0; font-weight: 600"></label>\n\
                                        </div>\n\
                                        <div class="col-lg-5">\n\
                                            <label style="margin-bottom: 0;">(20) Miễn cùng chi trả trong năm từ ngày: </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">II. Chi phí khám, chữa bệnh: </label>\n\
                                        </div>\n\
                                    </div>';
            if(bn.mathe !='koco'){
                            content+='<div class="row">\n\
                                        <div class="col-lg-5">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-4" style="padding-right: 0">\n\
                                                    <label style="margin-bottom: 0;">Mã thẻ BHYT: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-8">\n\
                                                    <table border="2" style="font-size: 8pt; width: 20px;">\n\
                                                        <thead class="text-center">\n\
                                                            <tr>\n\
                                                                <th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(0,2)+'</th><th style="border: 2px solid; padding: 2px">4</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(2,4)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(4,6)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(6,9)+'</th><th style="border: 2px solid; padding: 2px">'+bn.mathe.toString().substring(9,14)+'</th><th style="border: 2px solid; padding: 2px">'+bn.macsk+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-4">\n\
                                            <label style="margin-bottom: 0;">Giá trị từ: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tungay+'</label> <label> đến </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.denngay+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-7 text-right">\n\
                                                    <label>Mức hưởng: </label>\n\
                                                </div>\n\
                                                <div class="col-lg-5 text-center" style="padding-left: 12px">\n\
                                                    <table border="1" cellpadding="2" style="font-size: 8pt; width: 40px">\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th class="text-center" style="border: 2px solid; padding: 2px">'+bn.mh+'</th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                }
                            content+='<div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">(Chi phí KBCB từ ngày '+bn.ngaybd+' đến ngày '+bn.ngayketthuc+')</label>\n\
                                        </div>\n\
                                    </div>';
                    var start_table='<div class="row" style="margin-top: 5px;">\n\
                                        <div class="col-lg-12">\n\
                                            <table class="table table-bordered" style="font-size: 6pt;">\n\
                                                <thead style="vertical-align: middle;">\n\
                                                    <tr>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px; width: 180px"><center>Nội dung</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Đơn vị tính</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Số lượng</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Đơn giá <br>(đồng)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Đơn giá BH <br>(đồng)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Tỷ lệ TT theo dich vụ <br>(%)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Thành tiền BV<br>(đồng)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Tỷ lệ TT BH YT<br>(%)</center></th>\n\
                                                        <th rowspan="2" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Thành tiền BHYT<br>(đồng)</center></th>\n\
                                                        <th colspan="4" style="padding: 5px; padding-top: 2px; padding-bottom: 2px;"><center>Nguồn thanh toán (đồng)</center></th>\n\
                                                    </tr>\n\
                                                    <tr>\n\
                                                        <th class="padding_adjust"><center>Qũy BHYT</center></th>\n\
                                                        <th class="padding_adjust"><center>Người bệnh cùng chi trả</center></th>\n\
                                                        <th class="padding_adjust"><center>Khác</center></th>\n\
                                                        <th class="padding_adjust"><center>Người bệnh tự trả</center></th>\n\
                                                    </tr>\n\
                                                </thead>\n\
                                                <tbody class="padding_adjust_td text-right">\n\
                                                    <tr class="vertical-align-midle">\n\
                                                        <td class="vertical-align-midle text-center">(1)</td>\n\
                                                        <td class="text-center">(2)</td>\n\
                                                        <td class="text-center">(3)</td>\n\
                                                        <td class="text-center">(4)</td>\n\
                                                        <td class="text-center">(5)</td>\n\
                                                        <td class="text-center">(6)</td>\n\
                                                        <td class="text-center">(7)</td>\n\
                                                        <td class="text-center">(8)</td>\n\
                                                        <td class="text-center">(9)</td>\n\
                                                        <td class="text-center">(10)</td>\n\
                                                        <td class="text-center">(11)</td>\n\
                                                        <td class="text-center">(12)</td>\n\
                                                        <td class="text-center">(13)</td>\n\
                                                    </tr>';
                    var newpage_bf='<div class="card" style="font-weight: normal; height: 814px; width: 660px !important;">\n\
                            <div class="card-block card-body printcontent_vp" style="height: 814px; width: 660px !important;">\n\
                                <div style="height: 715px">';
                    var end_table='\n\
                                                </tbody>\n\
                                            </table>\n\
                                        </div>\n\
                                    </div>';
                    var end_pk_nv='    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0">Tổng chi phí lần khám bệnh/ ca đợt điều trị: </label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tongcp+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0; font-weight: 600">Trong đó,</label> <label style="margin-bottom: 0;">số tiền do: </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">- Số tiền Qũy BHYT thanh toán:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.tongbh+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">- Người bệnh trả, trong đó:</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">&nbsp;&nbsp;&nbsp;+ Cùng trả trong phạm vi BHYT:</label> <label style="margin-bottom: 0; font-weight: 600">'+bn.tongbncungtra+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">&nbsp;&nbsp;&nbsp;+ Các khoản phải trả khác:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.tongbntutra+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">Nguồn khác:</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">BN đã tạm ứng:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.bntamung+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">Bệnh nhân phải nộp thêm:</label> <label style="margin-bottom: 0;font-weight: 600">'+bn.tongtien+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center">\n\
                                        <div class="col-lg-6 ">\n\
                                            <br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">NGƯỜI LẬP BẢNG KÊ KHAI</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="margin-bottom: 0; font-weight: 600; font-size: 9pt">BS. '+bn.nv+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0; font-size: 8pt">Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">KẾ TOÁN VIỆN PHÍ</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row text-center">\n\
                                        <div class="col-lg-6 ">\n\
                                            <br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">XÁC NHẬN CỦA NGƯỜI BỆNH</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label><br>\n\
                                            <label style="margin-bottom: 0; font-weight: 600; font-size: 9pt">'+bn.hoten+'</label><br>\n\
                                            <label style="margin-bottom: 0">(Tôi đã nhận......phim......Xquang......CT.....MR)</label>\n\
                                        </div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0; font-size: 8pt">Ngày...... tháng...... năm......</label><br>\n\
                                            <label style="margin-bottom: 0; font-size: 9pt">GIÁM ĐỊNH BHYT</label><br>\n\
                                            <label style="margin-bottom: 50px">(Ký, ghi rõ họ tên)</label>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="row" style="margin-top: 20px">\n\
                                    <div class="col-lg-10">\n\
                                        <label style="margin-bottom: 0;">Họ tên người bệnh: '+bn.hoten+' - Mã Y Tế: '+bn.mabn+' - Năm Sinh: '+bn.namsinh+'</label>\n\
                                    </div>\n\
                                    <div class="col-lg-2 text-right">';
                var end_pk='</div>\n\
                                <div class="row" style="margin-top: 20px">\n\
                                    <div class="col-lg-10">\n\
                                        <label style="margin-bottom: 0;">Họ tên người bệnh: '+bn.hoten+' - Mã Y Tế: '+bn.mabn+' - Năm Sinh: '+bn.namsinh+'</label>\n\
                                    </div>\n\
                                    <div class="col-lg-2 text-right">';
            content+=start_table;
            if($.isArray(data))
            {
                var n=1; var trang=1;
                if(flagthe == true){
                    if(data.length <= 24){
                        tstrangtt = 2;
                    }
                    else{
                        if(parseInt((data.length - 10) % 37) > 14){
                            tstrangtt = parseInt(((data.length - 10)/37) + 3);
                        }
                        else{
                            if((data.length - 10)/37 < 0){
                                tstrangtt = parseInt(-((data.length - 10)/37) + 2);
                            }
                            else{
                                tstrangtt = parseInt(((data.length - 10)/37) + 2);
                            }
                        }
                    }
                    for (var i = 0; i < data.length; i++) {
                        content+=data[i];
                        if(n <= 24)
                        {
                            if(n <= 10){
                                if(n == 10){
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'<label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>'+newpage_bf+end_pk_nv+'<label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>';
                                    }
                                    else{
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+start_table;
                                        trang++;
                                    }
                                }
                                else{
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+end_pk_nv+'\n\
                                                        <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    content+=end_table+end_pk_nv+'\n\
                                                    <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                                }
                            }
                        }
                        else
                        {
                            if((n-24) % 37 == 0) //chia hết cho 14
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';

                                }
                            }
                            else if((n-10) % 37 == 0)
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                }
                                else{
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf  + start_table;
                                    trang++;
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    if((n-10)%37 > 14){
                                        content+=end_table + end_pk + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                    else{
                                        content+= end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }

                                }
                            }
                        }
                        n++;
                    }
                }
                else{
                    if(data.length <= 28){
                        tstrangtt = 2;
                    }
                    else{
                        if(parseInt((data.length - 14) % 37) > 14){
                            tstrangtt = parseInt(((data.length - 14)/37) + 3);
                        }
                        else{
                            if((data.length - 14)/37 < 0){
                                tstrangtt = parseInt(-((data.length - 14)/37) + 2);
                            }
                            else{
                                tstrangtt = parseInt(((data.length - 14)/37) + 2);
                            }
                        }
                    }
                    for (var i = 0; i < data.length; i++) {
                        content+=data[i];
                        if(n <= 28)
                        {
                            if(n <= 14){
                                if(n == 14){
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'<label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>'+newpage_bf+end_pk_nv+'<label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>\n\
                                                    </div>';
                                    }
                                    else{
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+start_table;
                                        trang++;
                                    }
                                }
                                else{
                                    if(i == data.length - 1)
                                    {
                                        content+=end_table+end_pk+'\n\
                                                        <label style="margin-bottom: 0;">Trang 1/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>'+newpage_bf+end_pk_nv+'\n\
                                                        <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    content+=end_table+end_pk_nv+'\n\
                                                    <label style="margin-bottom: 0;">Trang 2/2.</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                                }
                            }
                        }
                        else
                        {
                            if((n-28) % 37 == 0) //chia hết cho 14
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';

                                }
                            }
                            else if((n-14) % 37 == 0)
                            {
                                if(i == data.length - 1)
                                {
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                }
                                else{
                                    content+=end_table + end_pk+ '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf  + start_table;
                                    trang++;
                                }
                            }
                            else{
                                if(i == data.length - 1)
                                {
                                    if((n-14)%37 > 14){
                                        content+=end_table + end_pk + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>' + newpage_bf + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+(trang+1)+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }
                                    else{
                                        content+= end_table + end_pk_nv + '\n\
                                                        <label style="margin-bottom: 0;">Trang '+trang+'/'+tstrangtt+'.</label>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>';
                                    }

                                }
                            }
                        }
                        n++;
                    }
                }
            }
            else
            {
                content='';//
            }            
            
            file_name_tt='PHIEU_KK_VP_'+bn.hoten.toString().toUpperCase()+'_'+bn.tenkhoa.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam;
            $('#print_content_vp').html(content);
            
            $('#tongnk').val(0);$('#tongphi').val(addCommas(bn.tongcp));$('#tongbh').val(addCommas(bn.tongbh));$('#tongbn').val(addCommas(bn.tongtien));
        }
        
        function InPKK(maba){
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idba', maba);
            formData.append('loaipkk', 'noitru');
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/phieu_ke_khai_vp/in_noi',
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
                        $.when(prepare_content_to_print_pkk(data.data, data.bn)).done(function(){
                            $('#dtbipkk').text('Đã tạo xong!');
                            $('#proccesspkk').addClass('hidden');
                            $('#btnprintpkkarea').removeClass('hidden');
                        });
                    }
                    else if(data.msg == 'ktt'){
                        alert("Bệnh án không tồn tại, có thể đã bị xóa!");
                    }
                    else{
                        $('#dtbiareapkk').addClass('hidden');$('#proccesspkk').addClass('hidden');
                        alert("Không thể tạo dữ liệu in! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareapkk').addClass('hidden');$('#proccesspkk').addClass('hidden');
                    if(jqXHR.status == 419){
                        alert("Không thể tạo dữ liệu in! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Không thể tạo dữ liệu in! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Không thể tạo dữ liệu in! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        }
        
        $('#btnlapphieukk').click(function (){
            $('#dtbiareapkk').removeClass('hidden');$('#dtbipkk').text('Đang tạo bản in!');
            $('#proccesspkk').removeClass('hidden');
            $('#print_content_vp').html('');
            $('#tongphi').val('');$('#tongbh').val('');$('#tongnk').val('');$('#tongbn').val('');$('#btnprintpkkarea').addClass('hidden');
            var maba=$(this).attr('data-id');
            
            InPKK(maba);
        });
        
        $('#btnprintpkk').click(function(){
            $('#dtbiareapkk').removeClass('hidden');$('#dtbipkk').text('Đang xử lý!');
            $('#proccesspkk').removeClass('hidden');
            genPDFPKK(tstrangtt);
        });
        
        $("input[type='number']").on("keypress", function (evt) {
            if (evt.which < 48 || evt.which > 57)
            {
                evt.preventDefault();
            }
        });
        
        function addCommas(numberString) {
          var resultString = numberString + '',
              x = resultString.split('.'),
              x1 = x[0],
              x2 = x.length > 1 ? '.' + x[1] : '',
              rgxp = /(\d+)(\d{3})/;

          while (rgxp.test(x1)) {
            x1 = x1.replace(rgxp, '$1' + ',' + '$2');
          }

          return x1 + x2;
        }
    });
</script>
@endsection