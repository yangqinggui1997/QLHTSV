@extends('kham_vs_dieu_tri.layout')

@section('title')
    {{ "Trả kết quả cận lâm sàng" }}
@endsection

@section('css')

@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="idphong" value="{{$nd->nhanVien->phongBan->IdPB}}">
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
                <!--DANH SÁCH CHỜ TIẾP NHẬN THỰC HIỆN CẬN LÂM SÀNG-->
                <section class="p-t-20" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class=" m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">TIẾP NHẬN THỰC HIỆN CẬN LÂM SÀNG</h3>
                                    <hr class="line-seprate">
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body card-block">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class=" form-control-label">Danh sách chờ tiếp nhận</label>
                                                            <div class="row">
                                                                <div class="col-lg-8 m-b-15">
                                                                    <select class="form-control" id="dschotn">
                                                                        @if(isset($dschotn))
                                                                            @foreach($dschotn as $tn)
                                                                            @if($tn->IdPB == $nd->nhanVien->phongBan->IdPB)
                                                                            <?php $bn='';$pk='';$chuandoan='';$i=1;$nvcd='';$yc=''; $ghichuyc='Không có';$ttbn='';$loaicd='Thường';
                                                                                if(is_object($tn->benhAnNgoaiTru)){
                                                                                    $bn=$tn->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                                                                                    $pk=$tn->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->phongKham;
                                                                                    foreach ($tn->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $cd){
                                                                                        if($i == count($tn->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan)){
                                                                                            $chuandoan.=$cd->danhMucBenh->TenBenh;
                                                                                        }
                                                                                        else{
                                                                                            $chuandoan.=$cd->danhMucBenh->TenBenh.'|';
                                                                                        }
                                                                                        $i++;
                                                                                    }
                                                                                    $nvcd=$tn->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                                                                                    $yc=$tn->danhMucCLS->TenCLS;
                                                                                    if($tn->GhiChu != ''){
                                                                                        $ghichuyc=$tn->GhiChu;
                                                                                    }
                                                                                    if($tn->LoaiCD == 1){
                                                                                        $loaicd='Khẩn';
                                                                                    }
                                                                                    if($tn->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->DTTN=='tinh_tao'){
                                                                                        $ttbn='Tỉnh táo';
                                                                                    }
                                                                                    else if($tn->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->DTTN=='hon_me'){
                                                                                        $ttbn='Hôn mê';
                                                                                    }
                                                                                    else{
                                                                                        $ttbn='Hôn mê sâu';
                                                                                    }
                                                                                }
                                                                                else if(is_object($tn->benhAnNoiTruCT)){
                                                                                    $bn=$tn->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                                                                                    $pk=$tn->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham;
                                                                                    foreach ($tn->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan as $cd){
                                                                                        if($i == count($tn->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan)){
                                                                                            $chuandoan.=$cd->danhMucBenh->TenBenh;
                                                                                        }
                                                                                        else{
                                                                                            $chuandoan.=$cd->danhMucBenh->TenBenh.'|';
                                                                                        }
                                                                                        $i++;
                                                                                    }
                                                                                    $nvcd=$tn->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                                                                                    $yc=$tn->danhMucCLS->TenCLS;
                                                                                    if($tn->GhiChu != ''){
                                                                                        $ghichuyc=$tn->GhiChu;
                                                                                    }
                                                                                    if($tn->LoaiCD == 1){
                                                                                        $loaicd='Khẩn';
                                                                                    }
                                                                                    if($tn->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->DTTN=='tinh_tao'){
                                                                                        $ttbn='Tỉnh táo';
                                                                                    }
                                                                                    else if($tn->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->DTTN=='hon_me'){
                                                                                        $ttbn='Hôn mê';
                                                                                    }
                                                                                    else{
                                                                                        $ttbn='Hôn mê sâu';
                                                                                    }
                                                                                }?>
                                                                                <option 
                                                                                    value="{{$tn->IdCLS}}" 
                                                                                    data-idbn="{{$bn->IdBN}}"
                                                                                    data-hotenbn="{{$bn->HoTen}}" 
                                                                                    data-ngaysinh="<?php echo date('d/m/Y', strtotime($bn->NgaySinh)); ?>" 
                                                                                    data-gt="<?php if($bn->GioiTinh == '0'){ echo 'Nữ';} else{ echo 'Nam';} ?>" 
                                                                                    data-dantoc="<?php if($bn->DanToc == ''){echo 'Chưa cập nhật!';}else{ echo \comm_functions::decodeDanToc($bn->DanToc);} ?>"
                                                                                    @if($bn->SoCMND != '')
                                                                                    data-socmnd="{{$bn->SoCMND}}"
                                                                                    @else
                                                                                    data-socmnd="Chưa cập nhật!"
                                                                                    @endif
                                                                                    data-diachi="<?php if($bn->DiaChi == ''){echo 'Xã '.$bn->phuongXa->TenXa.', huyện '.$bn->phuongXa->quanHuyen->TenHuyen.', tỉnh '.$bn->phuongXa->quanHuyen->tinhTP->TenTinh;}else{echo $bn->DiaChi.', xã '.$bn->phuongXa->TenXa.', huyện '.$bn->phuongXa->quanHuyen->TenHuyen.', tỉnh '.$bn->phuongXa->quanHuyen->tinhTP->TenTinh;} ?>"
                                                                                    data-chuandoan='{{$chuandoan}}'
                                                                                    data-nvcd='{{$nvcd}}'
                                                                                    data-yc='{{$yc}}'
                                                                                    data-ghichuyc='{{$ghichuyc}}'
                                                                                    data-ttbn='{{$ttbn}}'
                                                                                    data-ktn='{{$pk->Khoa->TenKhoa}}'
                                                                                    @if($tn->LoaiCD == 0)
                                                                                        data-loaicd="{{'Thường'}}"
                                                                                    @else
                                                                                        data-loaicd="{{'Khẩn'}}"
                                                                                    @endif
                                                                                    
                                                                                    data-loaicdcode="{{$tn->LoaiCD}}"
                                                                                    
                                                                                    @if(is_object($bn->theBHYT)) 
                                                                                    data-mathe="{{$bn->theBHYT->IdTheBHYT}}" 
                                                                                    data-ngaydk="{{date('d/m/Y', strtotime($bn->theBHYT->NgayDK))}}"
                                                                                    data-ngayhh="{{date('d/m/Y', strtotime($bn->theBHYT->NgayHH))}}"
                                                                                    data-noidk="{{$bn->theBHYT->coSoKhamBHYT->TenCS}}"
                                                                                    data-doituong="{{\comm_functions::getDTK($bn->theBHYT->DoiTuongBHYT)}}"
                                                                                    data-mh="<?php echo \comm_functions::getMucHuongDTK($bn->theBHYT->DoiTuongBHYT).'%'; ?>"
                                                                                    @else

                                                                                    data-mathe="koco"

                                                                                    @endif
                                                                                    >{{$bn->HoTen.' - P. Khám '.$pk->TenPhong.' ('.$loaicd.')'}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Tiếp nhận bệnh nhân" id="btntiepnhan"><span class="fa fa-plus"></span></button>
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
                <!-- END DANH SÁCH CHỜ TIẾP NHẬN THỰC HIỆN CẬN LÂM SÀNG-->
                
                <!-- LẬP PHIẾU KẾT QUẢ CẬN LÂM SÀNG-->
                <section class="p-t-20 hidden" id="formkqcls">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="formtitle">LẬP PHIẾU KẾT QUẢ CLS</h3>
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
                                                        <div class="col-lg-2">
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
                                                    </div>
                                                    <div class="row m-b-15 thearea">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Mã thẻ BHYT</label>
                                                                <input type="text" readonly="" class="form-control" id="mathe">
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
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Nơi đăng ký KCBBĐ</label>
                                                                <input type="text" readonly="" class="form-control" id="noidkkcbbd">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Đối tượng BHYT</label>
                                                                <input type="text" readonly="" class="form-control" id="doituong">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">M.hưởng</label>
                                                                <input type="text" readonly="" class="form-control" id="mh">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-3">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Khoa tiếp nhận</label>
                                                                <input type="text" readonly="" class="form-control" id='khoatn'> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Bác sĩ chỉ định CLS</label>
                                                                <input type="text" readonly="" class="form-control" id="nvcd"> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Loại chỉ định</label>
                                                                <input type="text" readonly="" class="form-control" id="loaicd"> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Các chuẩn đoán ban đầu</label>
                                                                <select class="form-control" id="chuandoan">
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">  
                                                            <div class="form-group">
                                                               <label class=" form-control-label">Các yêu cầu</label>
                                                                <input type="text" readonly="" class="form-control" id="yeucau"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-2">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Ghi chú yêu cầu</label>
                                                                <textarea readonly="" rows="1" class="form-control" id="ghichuyc"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tình trạng BN</label>
                                                                <input type="text" class="form-control" readonly="" id="tinhtrangbn">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Mô tả kết quả CLS</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <input type="text" class="form-control" id="kqclsct">
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class=" form-control-label"></label>
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm kết quả CLS" id="btnthemketquacls">
                                                <i class="fa fa-bullhorn" ></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>    
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Các kết quả CLS thu được (<span class="color-red">*</span>)</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <select class="form-control" id="ds_kqclsct">

                                                                        </select>  
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class=" form-control-label"></label>
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa kết quả CLS" id="btnxoaketquacls">
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
                                                                <label class=" form-control-label">Các kết luận CLS</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <input type="text" class="form-control" id="klcls">
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class=" form-control-label"></label>
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm kết luận CLS" id="btnthemklcls">
                                                <i class="fa fa-gavel"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>    
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Các kết luận CLS đã thu được (<span class="color-red">*</span>)</label>
                                                                <div class="row">
                                                                    <div class="col-lg-9 m-b-15">
                                                                        <select class="form-control" id="ds_klcls">

                                                                        </select>
                                                                    </div> 
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class=" form-control-label"></label>
                                                                            <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa kết luận CLS" id="btnxoaklcls">
                                                <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>    
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Kết quả hình ảnh</label>
                                                                <input type="file" multiple="" class="form-control" id="anhkq">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-1" id="btnthemarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Lập phiếu kết quả CLS" id="btnthem"><span class="fa fa-plus"></span></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btnsuaarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Cập nhật" id="btncapnhat" data-id=""><span class="fa fa-edit"></span></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btnxemkqarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--showdetail au-btn--small au-btn-shadow height-43px" rel="tooltip" title="Xem kết quả" data-toggle="modal" data-target="#modalcls" id="btnxemkq"><span class="fa fa-image"></span></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btninarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--print au-btn--small au-btn-shadow height-43px" rel="tooltip" title="In phiếu" data-toggle="modal" data-target="#modalin" id="btnprint" data-id=""><span class="zmdi zmdi-print"></span></button>
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
                <!-- END LẬP PHIẾU KẾT QUẢ CẬN LÂM SÀNG-->
                
                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class=" m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH PHIẾU KẾT QUẢ CLS</h3>
                                    <hr class="line-seprate">
                                </div>
                                
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light width-220px hidden">
                                            <select class="js-select2" id="dtk_f">
                                                <option value="all">Tất cả đối tượng tiếp nhận</option>
                                                <option value="0">BHYT</option>
                                                <option value="1">Thu phí</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light width-240px m-b-15 hidden">
                                            <select class="js-select2" id="tg_f">
                                                <option value="all">K.lọc theo thời gian tiếp nhận</option>
                                                <option value="0">Lọc theo thời gian tiếp nhận</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md m-b-15 hidden" id="loctungay">
                                            <div class="input-group date" id="datetimepickerfilter1" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerfilter1" id="thoigiantungay" data-toggle="tooltip" data-placement="bottom" title="Từ ngày"/>
                                                <div class="input-group-append" data-target="#datetimepickerfilter1" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md m-b-15 hidden" id="locdenngay">
                                            <div class="input-group date" id="datetimepickerfilter2" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerfilter2" id="thoigiandenngay" data-toggle="tooltip" data-placement="bottom" title="Đến ngày"/>
                                                <div class="input-group-append" data-target="#datetimepickerfilter2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px hidden" data-toggle="tooltip" title="Lọc danh sách">
                                            <i class="fa fa-filter"></i></button>
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
                                        <button type="button" class="au-btn au-btn--teal au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Nạp lại danh sách" id="btnnapds"><i class="zmdi zmdi-refresh"></i></button>
                                        <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id='btnxoatc'><i class="zmdi zmdi-delete"></i></button>
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
                                                        <input type="checkbox" data-input="checksumKQCLS">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th style="position: sticky; top: 0; z-index: 99;">bệnh nhân</th>
                                                <th>Đối tượng tiếp nhận</th>
                                                <th>Bác sĩ chỉ định</th>
                                                <th>chuẩn đoán ban đầu</th>
                                                <th>Kết quả CLS</th>
                                                <th>Kết luận CLS</th>
                                                <th>Ngày thực hiện</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_kqcls">
                                            @if(isset($dskqcls))
                                                @foreach($dskqcls as $kqcls)
                                                <?php $bn='';$dttn='BHYT';$chuandoan='';$i=1;$nvcd='';
                                                    if(is_object($kqcls->canLamSang->benhAnNgoaiTru)){
                                                        $bn=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                                                        
                                                        foreach ($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $cd){
                                                            if($i == count($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan)){
                                                                $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                                                            }
                                                            else{
                                                                $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                                                            }
                                                            $i++;
                                                        }
                                                        $nvcd=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                                                        if($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                                            $dttn='Thu phí';
                                                        }
                                                    }
                                                    else if(is_object($kqcls->canLamSang->benhAnNoiTruCT)){
                                                        $bn=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                                                        foreach ($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan as $cd){
                                                            if($i == count($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan)){
                                                                 $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                                                            }
                                                            else{
                                                                $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                                                            }
                                                            $i++;
                                                        }
                                                        $nvcd=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                                                        if($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                                            $dttn='Thu phí';
                                                        }
                                                    }
                                                    $kq='';$i=1;
                                                    foreach ($kqcls->ketQuaCLSCT as $kqct){
                                                        if($i == count($kqcls->ketQuaCLSCT)){
                                                             $kq.='- '.$kqct->KetQua;
                                                        }
                                                        else{
                                                            $kq.=' - '.$kqct->KetQua.'<br>';
                                                        }
                                                    }
                                                    $kl='';$i=1;
                                                    foreach ($kqcls->ketLuanCLS as $kqct){
                                                        if($i == count($kqcls->ketLuanCLS)){
                                                             $kl.='- '.$kqct->KetLuan;
                                                        }
                                                        else{
                                                            $kl.=' - '.$kqct->KetLuan.'<br>';
                                                        }
                                                    }
                                                    ?>
                                            <tr class="tr-shadow text-left">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $kqcls->IdKQCLS }}" data-name="{{$bn->HoTen}}">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$bn->HoTen}}</td>
                                                <td>{{$dttn}}</td>
                                                <td>{{$nvcd}}
                                                </td>
                                                <td class="text-left">
                                                    {!!$chuandoan!!}
                                                </td>
                                                <td class="text-left">{!!$kq!!}</td>
                                                <td class="text-left">{!!$kl!!}</td>
                                                <td><?php echo \comm_functions::deDateFormat($kqcls->created_at); ?></td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button type="button" class="item" data-toggle="modal" data-target="#modalcls" rel="tooltip" data-placement="top" title="Xem kết quả" data-button='xemct' data-id="{{$kqcls->IdKQCLS}}">
                                                            <i class="fa fa-list"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{$kqcls->IdKQCLS}}">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button='xoa' data-id="{{ $kqcls->IdKQCLS }}" data-name="{{$bn->HoTen}}">
                                                            <i class="zmdi zmdi-delete"  ></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" title="In phiếu kết quả" data-button='in' data-id="{{$kqcls->IdKQCLS}}">
                                                            <i class="zmdi zmdi-print"></i>
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
                                <div class="table-responsive table-responsive-data2 fit_table_height_500">
                                    <table class="table table-data2 table-hover m-b-20 text-center">
                                        <thead>
                                            <tr>
                                                <th>Tên cận lâm sàng</th>
                                                <th>Ngày thực hiện</th>
                                                <th>Kết quả</th>
                                                <th>Kết quả hình ảnh</th>
                                                <th>Kết luận</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_xemkqcls">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END MODAL XEM KẾT QUẢ CẬN LÂM SÀNG-->
                
                <!--MODAL XEM LẠI BẢN IN-->
                <div class="modal fade" id="modalin" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel1">Xem lại bản in</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body fit_table_height_500" style="font-family: Verdana; font-size: 7pt;">
                                <div class="row">
                                    <div style="width: 45px !important;"></div>
                                    <div class="col-lg-10" id="print_content">
                                        
                                    </div>
                                </div>
                                <div class="row hidden" id="btnprintpkqarea">
                                    <div class="col-lg-12">
                                        <div class="card" style="font-size: 9pt;">
                                            <div class="card-body card-block">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-12 text-center">
                                                            <button type="button" class="au-btn au-btn--print au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="In phiếu" id="btnprintpkq"><span class="zmdi zmdi-print"></span></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="font-size: 8pt;">
                                    <div class="col-lg-12">
                                        <div class="row hidden" id="dtbiareapkq">
                                            <div class="col-lg-12 text-center">
                                                <label style="font-weight: normal" id="dtbipkq">Đang tạo bản in!</label>
                                            </div>
                                        </div>
                                        <div class='row hidden' id="proccesspkq">
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
                <!--END MODAL XEM LẠI BẢN IN-->
            </div>
@endsection

@section('js')
<script src="public/js/pusher.js"></script>
<script src="public/js/jspdf.debug.js"></script>
<script src="public/js/html2canvas.js"></script>
<script>
    $(function () {
        //khởi tạo flag tìm kiếm
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false, htbn=false, bnddd=false, themkqcls=false, flagcls=false, flagtt=false, file_name_tt='', tstrangtt = 1, dskham='';
        //end
        
        $('#thoigiantungay').on('input', function (){
           $('#datetimepickerfilter1').datetimepicker('minDate', '01/01/1900 00:00'); 
           $('#datetimepickerfilter1').datetimepicker('maxDate', new Date()); 
        });
        
        $('#thoigiandenngay').on('input', function (){
           $('#datetimepickerfilter2').datetimepicker('minDate', '01/01/1900 00:00'); 
           $('#datetimepickerfilter2').datetimepicker('maxDate', new Date()); 
           
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
                if(data.dvb.pl ==  'thong_ke' && $('#quyen_bs').val() == 'TRUE' && $('#khoa_nv').val() == data.dvb.khoa){
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
        //        Đăng ký kênh chỉ định cls 
        var channelcls = pusher.subscribe('CanLamSang');
        function layttcls(data) {
            if(data.thaotac != 'xoa'){
                if(data.thaotac == 'chuyendv'){
                    if($('#idphong').val() == data.cls.idphong){
                        var cls='<option\n\
                                value="'+data.cls.idcls+'" \n\
                                data-idbn="'+data.cls.idbn+'"\n\
                                data-hotenbn="'+data.cls.hoten+'" \n\
                                data-ngaysinh="'+data.cls.ngaysinh+'" \n\
                                data-gt="'+data.cls.gt+'" \n\
                                data-dantoc="'+data.cls.dantoc+'"\n\
                                data-socmnd="'+data.cls.scmnd+'"\n\
                                data-diachi="'+data.cls.diachi+'"\n\
                                data-chuandoan="'+data.cls.chuandoan+'"\n\
                                data-nvcd="'+data.cls.nvcd+'"\n\
                                data-yc="'+data.cls.yc+'"\n\
                                data-ghichuyc="'+data.cls.ghichuyc+'"\n\
                                data-ttbn="'+data.cls.ttbn+'"\n\
                                data-ktn="'+data.cls.ktn+'"';
                        var loaicd='';
                        if(data.cls.loaicd == 0){
                            loaicd="Thường";
                        }
                        else{
                            loaicd="Khẩn";
                        }
                        cls+='data-loaicdcode="'+data.cls.loaicd+'"\n\
                        data-loaicd="'+loaicd+'"';
                        if(data.cls.mathe !='koco'){
                            cls+='data-mathe="'+data.cls.mathe+'" \n\
                                data-ngaydk="'+data.cls.ngaydk+'"\n\
                                data-ngayhh="'+data.cls.ngayhh+'"\n\
                                data-noidk="'+data.cls.noidk+'"\n\
                                data-doituong="'+data.cls.doituong+'"\n\
                                data-mh="'+data.cls.mh+'"';
                        }
                        else{
                            cls+='data-mathe="koco"';
                        }
                        cls+='>'+data.cls.hoten+' - P. Khám '+data.cls.phong+' ('+loaicd+')</option>';
                        if($('#dschotn').children().length > 0){
                            var id='';var flag=false;
                            $('#dschotn option').each(function(){
                                if($(this).attr('data-loaicdcode') == 1){
                                    id=$(this).attr('value');
                                    flag=true;
                                    return false;
                                }
                            });
                            if(flag==true){
                                if(data.cls.loaicd == 0){
                                    $('#dschotn').append(cls);
                                }
                                else{
                                    $(cls).insertAfter('#dschotn option[value="'+id+'"]');
                                }
                            }
                            else{
                                if(data.cls.loaicd == 0){
                                    $('#dschotn').append(cls);
                                }
                                else{
                                    $('#dschotn').prepend(cls);
                                }
                            }
                        }
                        else{
                            $('#dschotn').append(cls);
                        }
                    }
                }
                else if(data.thaotac == 'sua'){
                    if($('#idphong').val() == data.cls.idphong){
                        var cls='<option\n\
                                value="'+data.cls.idcls+'" \n\
                                data-idbn="'+data.cls.idbn+'"\n\
                                data-hotenbn="'+data.cls.hoten+'" \n\
                                data-ngaysinh="'+data.cls.ngaysinh+'" \n\
                                data-gt="'+data.cls.gt+'" \n\
                                data-dantoc="'+data.cls.dantoc+'"\n\
                                data-socmnd="'+data.cls.scmnd+'"\n\
                                data-diachi="'+data.cls.diachi+'"\n\
                                data-chuandoan="'+data.cls.chuandoan+'"\n\
                                data-nvcd="'+data.cls.nvcd+'"\n\
                                data-yc="'+data.cls.yc+'"\n\
                                data-ghichuyc="'+data.cls.ghichuyc+'"\n\
                                data-ttbn="'+data.cls.ttbn+'"\n\
                                data-ktn="'+data.cls.ktn+'"';
                        var loaicd='';
                        if(data.cls.loaicd == 0){
                            loaicd="Thường";
                        }
                        else{
                            loaicd="Khẩn";
                        }
                        cls+='data-loaicdcode="'+data.cls.loaicd+'"\n\
                        data-loaicd="'+loaicd+'"';
                        if(data.cls.mathe !='koco'){
                            cls+='data-mathe="'+data.cls.mathe+'" \n\
                                data-ngaydk="'+data.cls.ngaydk+'"\n\
                                data-ngayhh="'+data.cls.ngayhh+'"\n\
                                data-noidk="'+data.cls.noidk+'"\n\
                                data-doituong="'+data.cls.doituong+'"\n\
                                data-mh="'+data.cls.mh+'"';
                        }
                        else{
                            cls+='data-mathe="koco"';
                        }
                        cls+='>'+data.cls.hoten+' - P. Khám '+data.cls.phong+' ('+loaicd+')</option>';
                        
                        $('#dschotn option[value="'+data.cls.idcls+'"]').replaceWith(cls);
                    }
                }
            }
            else{
                if($.isArray(data.cls)){
                    for (var i = 0; i < data.cls.length; i++) {
                        $('#dschotn option[value="'+data.cls[i]+'"]').remove();
                    }
                }
                else{
                    $('#dschotn option[value="'+data.cls+'"]').remove();
                }  
            }
        }
        
        //Bind một function layttcls với sự kiện CanLamSang.php
        channelcls.bind('App\\Events\\KhamVaDieuTri\\CanLamSang', layttcls);
        //end xử lý channel
        
        //Đăng ký với kênh KetQuaCLS đã tạo trong file KetQuaCLS.php
        var channel = pusher.subscribe('KetQuaCLS');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                if($('#id_nv').val() == data.kqcls.idnv){
                    var kq='';
                    if($.isArray(data.kqcls.kq))
                    {
                        for (var i = 0; i < data.kqcls.kq.length; i++) {
                            if(i==data.kqcls.kq.length-1){
                                kq+='- '+data.kqcls.kq[i];
                                break;
                            }
                            kq+='- '+data.kqcls.kq[i]+'<br>';
                        }
                    }
                    var kl='';
                    if($.isArray(data.kqcls.kl))
                    {
                        for (var i = 0; i < data.kqcls.kl.length; i++) {
                            if(i==data.kqcls.kl.length-1){
                                kl+='- '+data.kqcls.kl[i];
                                break;
                            }
                            kl+='- '+data.kqcls.kl[i]+'<br>';
                        }
                    }

                    var kqcls='\n\
                        <tr class="tr-shadow text-left">\n\
                            <td style="vertical-align: middle;">\n\
                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.kqcls.idkqcls+'" data-name="'+data.kqcls.hoten+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td>'+data.kqcls.hoten+'</td>\n\
                            <td>'+data.kqcls.dttn+'</td>\n\
                            <td>'+data.kqcls.nvcd+'</td>\n\
                            <td class="text-left">'+data.kqcls.chuandoan+'</td>\n\
                            <td>'+kq+'</td>\n\
                            <td>'+kl+'</td>\n\
                            <td>'+data.kqcls.ngayth+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button type="button" class="item" data-toggle="modal" data-target="#modalcls" rel="tooltip" data-placement="top" title="Xem kết quả" data-button="xemct" data-id="'+data.kqcls.idkqcls+'">\n\
                                        <i class="fa fa-list"></i>\n\
                                    </button>\n\
                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="'+data.kqcls.idkqcls+'">\n\
                                        <i class="zmdi zmdi-edit"></i>\n\
                                    </button>\n\
                                    <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="'+data.kqcls.idkqcls+'" data-name="'+data.kqcls.hoten+'">\n\
                                        <i class="zmdi zmdi-delete"  ></i>\n\
                                    </button>\n\
                                    <button class="item" data-toggle="tooltip" title="In phiếu kết quả" data-button="in" data-id="'+data.kqcls.idkqcls+'">\n\
                                        <i class="zmdi zmdi-print"></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>';

                    if(data.thaotac == 'them'){
                        kqcls+='<tr class="spacer"></tr>';
                        $('#tbl_kqcls').prepend(kqcls);
                    }
                    else{
                        $('#tbl_kqcls tr').has('td div button[data-id="'+data.kqcls.idkqcls+'"]').replaceWith(kqcls);
                    } 

                    $('#tbl_kqcls button[data-id="'+data.kqcls.idkqcls+'"]').tooltip({
                        trigger: 'manual'

                    })
                    .focus(hideTooltip)
                    .blur(hideTooltip)
                    .hover(showTooltip, hideTooltip);
                }
            }
            else{
                if($.isArray(data.kqcls)){
                    for (var i = 0; i < data.kqcls.length; i++) {
                        $('#tbl_kqcls tr').has('td div button[data-id="'+data.kqcls[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_kqcls tr').has('td div button[data-id="'+data.kqcls[i]+'"]').remove();
                    }
                }
                else{
                    $('#tbl_kqcls tr').has('td div button[data-id="'+data.kqcls+'"]').next('tr.spacer').remove();
                    $('#tbl_kqcls tr').has('td div button[data-id="'+data.kqcls+'"]').remove();

                }  
            }
        }
        
        //Bind một function laytt với sự kiện KetQuaCLS.php
        channel.bind('App\\Events\\KhamVaDieuTri\\KetQuaCLS', laytt);
        //end xử lý channel
        
        $('#btntiepnhan').click(function (){
            $('#kqclsct').val('');$('#klcls').val('');$('#ds_kqclsct').html('');$('#ds_klcls').html('');
            var macls=$('#dschotn').val();
            var mabn=$('#dschotn option[value="'+macls+'"').attr('data-idbn'),
            hotenbn=$('#dschotn option[value="'+macls+'"').attr('data-hotenbn'),
            ngaysinh=$('#dschotn option[value="'+macls+'"').attr('data-ngaysinh'),
            gt=$('#dschotn option[value="'+macls+'"').attr('data-gt'),
            dantoc=$('#dschotn option[value="'+macls+'"').attr('data-dantoc'),
            socmnd=$('#dschotn option[value="'+macls+'"').attr('data-socmnd'),
            diachi=$('#dschotn option[value="'+macls+'"').attr('data-diachi');
            var mathe=$('#dschotn option[value="'+macls+'"').attr('data-mathe'),
            ngaydk=$('#dschotn option[value="'+macls+'"').attr('data-ngaydk'),
            ngayhh=$('#dschotn option[value="'+macls+'"').attr('data-ngayhh'),
            noidk=$('#dschotn option[value="'+macls+'"').attr('data-noidk'),
            doituong=$('#dschotn option[value="'+macls+'"').attr('data-doituong'),
            mh=$('#dschotn option[value="'+macls+'"').attr('data-mh');
            var chuandoan=$('#dschotn option[value="'+macls+'"').attr('data-chuandoan'),
            nvcd=$('#dschotn option[value="'+macls+'"').attr('data-nvcd'),
            yc=$('#dschotn option[value="'+macls+'"').attr('data-yc'),
            ghichuyc=$('#dschotn option[value="'+macls+'"').attr('data-ghichuyc'),
            ttbn=$('#dschotn option[value="'+macls+'"').attr('data-ttbn'),
            ktn=$('#dschotn option[value="'+macls+'"').attr('data-ktn'),
            loaicd=$('#dschotn option[value="'+macls+'"').attr('data-loaicd');
            
            $('#formtitle').text('LẬP PHIẾU KẾT QUẢ CLS');
            $('#hoten').val(hotenbn);$('#hoten').attr('data-id', mabn);$('#ngaysinh').val(ngaysinh);$('#gt').val(gt);$('#dantoc').val(dantoc);$('#scmnd').val(socmnd);$('#diachi').val(diachi);
            $('#khoatn').val(ktn);$('#nvcd').val(nvcd);$('#yeucau').val(yc);$('#ghichuyc').val(ghichuyc);$('#tinhtrangbn').val(ttbn);$('#loaicd').val(loaicd);
            var arr_cd=chuandoan.toString().split('|');
            if(arr_cd.length > 1){
                var item='';
                for (var i = 0; i < arr_cd.length; i++) {
                    if(arr_cd[i] != ''){
                        item+='<option>'+arr_cd[i]+'</option>';
                    }
                }
                $('#chuandoan').html(item);
            }
            else{
                var item='<option>'+chuandoan+'</option>';
                $('#chuandoan').html(item);
            }
            $('#btnthem').attr('data-idcls', macls);
            if(mathe != 'koco')
            {
                $('#mathe').val(mathe);$('#ngaydk').val(ngaydk);$('#ngayhh').val(ngayhh);$('#noidkkcbbd').val(noidk);$('#doituong').val(doituong);$('#mh').val(mh);
                    $('[class*="thearea"]').removeClass('hidden');
            }
            else
            {
                    $('[class*="thearea"]').addClass('hidden');
            }
            $('#btnthemarea').fadeIn(800);$('#btnxemkqarea').fadeOut(800);$('#btnsuaarea').fadeOut(800);$('#btninarea').fadeOut(800);
            $('#formkqcls').slideDown(800);
            themkqcls=true;
        });

        $('#btnthemketquacls').click(function (){
            var flag=false;
            $('#ds_kqclsct option').each(function(){
                if($(this).attr('value') == $('#kqclsct').val()){
                    flag=true;
                    return false;
                }
            });
            
            if(flag==false && $('#kqclsct').val() != '')
            {
                if(themkqcls == true){
                    $('#ds_kqclsct').prepend('<option value="'+$('#kqclsct').val()+'">'+$('#kqclsct').val()+'</option>');
                }
            }
        });
        
        $('#btnxoaketquacls').click(function(){
            if(themkqcls == true)
            {
                $('#ds_kqclsct option[value="'+$('#ds_kqclsct').val()+'"]').remove();
            }
        });
        
        $('#btnthemklcls').click(function (){
            var flag=false;
            $('#ds_klcls option').each(function(){
                if($(this).attr('value') == $('#klcls').val()){
                    flag=true;
                    return false;
                }
            });
            
            if(flag==false && $('#klcls').val() != '')
            {
                if(themkqcls == true){
                    $('#ds_klcls').prepend('<option value="'+$('#klcls').val()+'">'+$('#klcls').val()+'</option>');
                }
            }
        });
        
        $('#btnxoaklcls').click(function(){
            if(themkqcls == true)
            {
                $('#ds_klcls option[value="'+$('#ds_klcls').val()+'"]').remove();
            }
        });
        
        //Submit thêm mới kết qua cls
        $('#btnthem').click(function(){
            $('input[data-input="checksumKQCLS"]').prop("checked",false);
            $('#tbl_kqcls input[data-input="check"]').prop("checked",false);
            
            var kqclsct=[], klcls=[];
            var idcls=$(this).attr('data-idcls');
            $('#ds_kqclsct option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        kqclsct.push(this.value);
                    }
                });
            });   

            $('#ds_klcls option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        klcls.push(this.value);
                    }
                });
            });   

            if(kqclsct.length == 0)
            {
                alert('Vui lòng thêm các kết quả thu được!');
                return false;
            }
            
            if(klcls.length == 0)
            {
                alert('Vui lòng thêm các kết luận thu được!');
                return false;
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('macls', idcls);
            formData.append('kqclsct', kqclsct);
            formData.append('klcls', klcls);
            
            if ($('#anhkq')[0].files.length > 0) {
                for (var i = 0; i < $('#anhkq')[0].files.length; i++){
                    formData.append('file[]', $('#anhkq')[0].files[i]);
                } 
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/tra_ket_qua_cls/them_moi',
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
                        alert("Thêm phiếu kết quả thành công!");
                        $('input[data-input="checksumKQCLS"]').prop("checked",false);
                        $('#tbl_kqcls input[data-input="check"]').prop("checked",false);
                        $('#kqtimliem').text("");
                        tk=false;locds=false;keySearch='';
                        $('#dschotn option[value="'+idcls+'"]').remove();
                        $('#btnxemkqarea').fadeIn(800);$('#btninarea').fadeIn(800);
                        $('#btnxemkq').attr('data-id', data.idkqcls);$('#btnprint').attr('data-id', data.idkqcls);
                        themkqcls=false;
                    }
                    else if(data.msg == 'trung'){
                        themkqcls=false;
                        alert("Bệnh nhân này đã lập phiếu kết quả cận lâm sàng!");
                    }
                    else if(data.msg == 'ko_ho_tro_kieu_file'){
                        themkqcls=true;
                        alert("Không hỗ trợ kiểu file ảnh!");
                    }
                    else{
                        $('#btnxemkqarea').fadeOut(800);$('#btninarea').fadeOut(800);
                        $('#btnxemkq').attr('data-id', '');$('#btnprint').attr('data-id', '');
                        themkqcls=true;
                        alert("Thêm phiếu kết quả thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    themkqcls=true;
                    $('#btnxemkqarea').fadeOut(800);$('#btninarea').fadeOut(800);
                    $('#btnxemkq').attr('data-id', '');$('#btnprint').attr('data-id', '');
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
        // end Submit thêm mới kết qua cls
        
        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formkqcls').slideUp(800);
        });
        //end đóng form nhập liệu

        //Submit cập nhật phiếu kết quả cls
        $('#btncapnhat').click(function(){
            $('input[data-input="checksumKQCLS"]').prop("checked",false);
            $('#tbl_kqcls input[data-input="check"]').prop("checked",false);
            
            var kqclsct=[], klcls=[];
            var idkqcls=$(this).attr('data-id');
            $('#ds_kqclsct option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        kqclsct.push(this.value);
                    }
                });
            });   

            $('#ds_klcls option').each(function(){
                $.each(this.attributes, function() {
                    if (this.name.indexOf('value') == 0) {
                        klcls.push(this.value);
                    }
                });
            });   

            if(kqclsct.length == 0)
            {
                alert('Vui lòng thêm các kết quả thu được!');
                return false;
            }
            
            if(klcls.length == 0)
            {
                alert('Vui lòng thêm các kết luận thu được!');
                return false;
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('makqcls', idkqcls);
            formData.append('kqclsct', kqclsct);
            formData.append('klcls', klcls);
            
            var flagha=false;
            if ($('#anhkq')[0].files.length > 0) {
                for (var i = 0; i < $('#anhkq')[0].files.length; i++){
                    formData.append('file[]', $('#anhkq')[0].files[i]);
                } 
                flagha=true;
            }
            if(flagha == true){
                var cf = confirm('Bạn có muốn giữ lại kết quả ảnh cũ?');
                if(cf == true){
                    formData.append('giuanh', 'co');
                }
            }

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/tra_ket_qua_cls/cap_nhat',
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
                        alert("Cập nhật phiếu kết quả cận lâm sàng thành công!");
                    }
                    else if(data.msg == 'ktdt'){
                        alert("Bệnh nhân đã kết thúc điều trị !");
                    }
                    else{
                        alert("Cập nhật phiếu kết quả cận lâm sàng thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật phiếu kết quả cận lâm sàng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật phiếu kết quả cận lâm sàng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật phiếu kết quả cận lâm sàng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật phiếu kết quả cận lâm sàng
        
        //xóa phiếu kết quả cận lâm sàng
        $('#tbl_kqcls').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin phiếu kết quả cận lâm sàng của bệnh nhân "+name+"?");
            if(cf==true){
                if($('#btnxemkqarea').css('display') == 'block' && id == $('#btnxemkq').attr('data-id')){//đóng form sửa khi click xóa
                   $('#btndong').click();
                }

                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/kham_va_dieu_tri/tra_ket_qua_cls/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" phiếu kết quả cận lâm sàng được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" phiếu kết quả cận lâm sàng tìm thấy!");
                                    }
                                }
                            }
                            if($.isArray(data.pcls)){
                                for (var i = 0; i < data.pcls.length; i++) {
                                    $('#dschotn').append(data.pcls[i]);
                                }
                            }
                            if($('#tbl_kqcls').children().length == 0){
                                $('input[data-input="checksumKQCLS"]').prop("checked",false);
                            }
                            alert("Xóa thông tin phiếu kết quả cận lâm sàng thành công!");
                        }
                        else{
                            alert("Xóa thông tin phiếu kết quả cận lâm sàng thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin phiếu kết quả cận lâm sàng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin phiếu kết quả cận lâm sàng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin phiếu kết quả cận lâm sàng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa phiếu kết quả cận lâm sàng
        
        //mở form để sửa
        $('#tbl_kqcls').on('click','button[data-button="sua"]',function(){
            var id=$(this).attr('data-id');
            $('#btnthemarea').fadeOut(800);$('#btnxemkqarea').fadeIn(800);$('#btnsuaarea').fadeIn(800);$('#btninarea').fadeIn(800);
            $('#btncapnhat').attr('data-id', id);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN PHIẾU KẾT QUẢ CLS');
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/tra_ket_qua_cls/lay_tt_cap_nhat',
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
                        $('#hoten').val(data.hoten);$('#hoten').attr('data-id', data.mabn);$('#ngaysinh').val(data.ngaysinh);$('#gt').val(data.gt);$('#dantoc').val(data.dantoc);$('#scmnd').val(data.socmnd);$('#diachi').val(data.diachi);
                        
                        $('#chuandoan').html(data.chuandoan);$('#nvcd').val(data.nvcd);$('#yeucau').val(data.yc);$('#ghichuyc').val(data.ghichu); $('#loaicd').val(data.loaicd);
                        $('#tinhtrangbn').val(data.ttbn);$('#khoatn').val(data.ktn);
                        $('#ds_kqclsct').html(data.kq);$('#ds_klcls').html(data.kl);
                        $('#btnxemkq').attr('data-id', data.idkqcls);$('#btncapnhat').attr('data-id', data.idkqcls);$('#btnprint').attr('data-id', data.idkqcls);
                        if(data.mathe != 'koco')
                        {
                            $('#mathe').val(data.mathe);$('#ngaydk').val(data.ngaydk);$('#ngayhh').val(data.ngayhh);$('#noidkkcbbd').val(data.noidk);$('#doituong').val(data.doituong);$('#mh').val(data.mh);
                                $('[class*="thearea"]').removeClass('hidden');
                        }
                        else
                        {
                                $('[class*="thearea"]').addClass('hidden');
                        }
                        
                        $('#formkqcls').slideDown(800);
                        
                        $('html, body').animate({
                            scrollTop: $("#formkqcls").offset().top
                        }, 800);
                        themkqcls = true;
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

        //click check sum
        $('body').on('change', 'input[data-input="checksumKQCLS"]', function(){
            if($(this).prop("checked")){
                $('#tbl_kqcls input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_kqcls input[data-input="check"]').prop("checked",false);
            }
        });
        //end
        
        //click check
        $('#tbl_kqcls').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksumKQCLS"]').prop("checked",false);
            }
            else{
                if($('#tbl_kqcls input[data-input="check"]:checked').length == $('#tbl_kqcls input[data-input="check"]').length){
                    $('input[data-input="checksumKQCLS"]').prop("checked",true);
                }   
            }
        });
        //end
        
        //Xem chi tiết
        $('#btnxemkq').on('click', function(e, ma){
            var id='';
            if($.isEmptyObject(ma)){
                id=$(this).attr('data-id');
            }
            else{
                id=ma;
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
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
                    if(data.msg == 'cokq'){
                        $('#tbl_xemkqcls').html('');
                        var ketqua='';
                        if($.isArray(data.ketqua))
                        {
                            for (var i = 0; i < data.ketqua.length; i++) {
                                if(i==data.ketqua.length-1){
                                    ketqua+='- '+data.ketqua[i];
                                    break;
                                }
                                ketqua+='- '+data.ketqua[i]+'<br>';
                            }
                        }
                        var ketluan='';
                        if($.isArray(data.ketluan))
                        {
                            for (var i = 0; i < data.ketluan.length; i++) {
                                if(i==data.ketluan.length-1){
                                    ketluan+='- '+data.ketluan[i];
                                    break;
                                }
                                ketluan+='- '+data.ketluan[i]+'<br>';
                            }
                        }

                        var kqha='<div class="row">';var n=1;
                        if($.isArray(data.kqha))
                        {
                            for (var i = 0; i < data.kqha.length; i++) {
                                if(n % 2 == 0 ){
                                    if(i < data.kqha.length-1){
                                        kqha+='<div class="col-lg-6 m-b-15">\n\
                                            <img class="height-100px" src="public/upload/anhcls/'+data.kqha[i]+'">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">';
                                    }
                                    else{
                                        kqha+='<div class="col-lg-6 m-b-15">\n\
                                            <img class="height-100px" src="public/upload/anhcls/'+data.kqha[i]+'">\n\
                                        </div>\n\
                                    </div>';
                                    }
                                }
                                else{
                                    if(i < data.kqha.length-1){
                                        kqha+='<div class="col-lg-6 m-b-15">\n\
                                            <img class="height-100px" src="public/upload/anhcls/'+data.kqha[i]+'">\n\
                                            </div>';
                                    }
                                    else{
                                        kqha+='<div class="col-lg-6 m-b-15">\n\
                                            <img class="height-100px" src="public/upload/anhcls/'+data.kqha[i]+'">\n\
                                        </div>\n\
                                    </div>';
                                    }
                                }
                                n++;
                            }
                        }
                        var kqcls='<tr>\n\
                            <td class="vertical-align-midle" data-id="'+data.idkqcls+'">'+data.tencls+'</td>\n\
                            <td>'+data.ngayth+'</td>\n\
                            <td class="text-left">'+ketqua+'</td>\n\
                            <td>'+kqha+'</td>\n\
                            <td class="text-left">'+ketluan+'</td>\n\
                        </tr>';
                        $('#tbl_xemkqcls').html(kqcls);
                    }
                    else if(data.msg == 'kott'){
                        alert("Phiếu kết quả không tồn tại! Có thể đã bị xóa.");
                    }
                    else if(data.msg!='koco'){
                        alert("Lấy thông tin kết quả CLS gặp phải lỗi! Mô tả: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy thông tin kết quả CLS thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy thông tin kết quả CLS thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy thông tin kết quả CLS thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        $('#tbl_kqcls').on('click','button[data-button="xemct"]',function(){
            var id=$(this).attr('data-id');
            $('#btnxemkq').trigger('click', id);
        });
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if(!$('#tbl_kqcls input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn phiếu kết quả nào để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[];
                $('#tbl_kqcls input[data-input="check"]').each(function(){
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin phiếu kết quả cận lâm sàng của các bệnh nhân "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin phiếu kết quả cận lâm sàng của bệnh nhân "+name+"?");
                }
                if(cf==true){
                    for (var i = 0; i < arr.length; i++) {
                        if($('#btnxemkqarea').css('display') == 'block' && arr[i] == $('#btnxemkq').attr('data-id')){//đóng form sửa khi click xóa
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
                        url: '/qlkcb/kham_va_dieu_tri/tra_ket_qua_cls/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" phiếu kết quả cận lâm sàng được tìm thấy!");
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
                                                $('#kqtimliem').text("Có "+soluongtk+" phiếu kết quả cận lâm sàng được tìm thấy!");
                                            }
                                        }
                                    }
                                    if($.isArray(data.pcls)){
                                        for (var i = 0; i < data.pcls.length; i++) {
                                            $('#dschotn').append(data.pcls[i]);
                                        }
                                    }
                                    if($('#tbl_kqcls').children().length == 0){
                                        $('input[data-input="checksumKQCLS"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các phiếu kết quả cận lâm sàng thành công!");
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" phiếu kết quả cận lâm sàng được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" phiếu kết quả cận lâm sàng được tìm thấy!");
                                        }
                                    }
                                    if($('#tbl_kqcls').children().length == 0){
                                        $('input[data-input="checksumKQCLS"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin phiếu kết quả cận lâm sàng thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các phiếu kết quả cận lâm sàng thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin phiếu kết quả cận lâm sàng thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các phiếu kết quả cận lâm sàng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các phiếu kết quả cận lâm sàng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các phiếu kết quả cận lâm sàng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin phiếu kết quả cận lâm sàng thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin phiếu kết quả cận lâm sàng thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin phiếu kết quả cận lâm sàng thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }
                
            }
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
                url: '/qlkcb/kham_va_dieu_tri/tra_ket_qua_cls/tim_kiem',
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
                            var kqcls='';
                            for (var i = 0; i < data.kqcls.length; i++) {
                                var kq='';
                                if($.isArray(data.kqcls[i].kq))
                                {
                                    for (var k = 0; k < data.kqcls[i].kq.length; k++) {
                                        if(k==data.kqcls[i].kq.length-1){
                                            kq+='- '+data.kqcls[i].kq[k];
                                            break;
                                        }
                                        kq+='- '+data.kqcls[i].kq[k]+'<br>';
                                    }
                                }
                                var kl='';
                                if($.isArray(data.kqcls[i].kl))
                                {
                                    for (var k = 0; k < data.kqcls[i].kl.length; k++) {
                                        if(k==data.kqcls[i].kl.length-1){
                                            kl+='- '+data.kqcls[i].kl[k];
                                            break;
                                        }
                                        kl+='- '+data.kqcls[i].kl[k]+'<br>';
                                    }
                                }

                                kqcls+='\n\
                                    <tr class="tr-shadow text-left">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.kqcls[i].idkqcls+'" data-name="'+data.kqcls[i].hoten+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td>'+data.kqcls[i].hoten+'</td>\n\
                                        <td>'+data.kqcls[i].dttn+'</td>\n\
                                        <td>'+data.kqcls[i].nvcd+'</td>\n\
                                        <td class="text-left">'+data.kqcls[i].chuandoan+'</td>\n\
                                        <td class="text-left">'+kq+'</td>\n\
                                        <td class="text-left">'+kl+'</td>\n\
                                        <td>'+data.kqcls[i].ngayth+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" data-toggle="modal" data-target="#modalcls" rel="tooltip" data-placement="top" title="Xem kết quả" data-button="xemct" data-id="'+data.kqcls[i].idkqcls+'">\n\
                                                    <i class="fa fa-list"></i>\n\
                                                </button>\n\
                                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="'+data.kqcls[i].idkqcls+'">\n\
                                                    <i class="zmdi zmdi-edit"></i>\n\
                                                </button>\n\
                                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="'+data.kqcls[i].idkqcls+'" data-name="'+data.kqcls[i].hoten+'">\n\
                                                    <i class="zmdi zmdi-delete"  ></i>\n\
                                                </button>\n\
                                                <button class="item" data-toggle="tooltip" title="In phiếu kết quả" data-button="in" data-id="'+data.kqcls[i].idkqcls+'">\n\
                                                    <i class="zmdi zmdi-print"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                            }

                            $('#tbl_kqcls').html(kqcls);
                            $('#tbl_kqcls button[data-id]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);

                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" phiếu kết quả được tìm thấy!");
//                            $('#btnlocds').tooltip('hide').attr('data-original-title', 'Lọc danh sách tìm kiếm').tooltip('fixTitle').tooltip('show');
                        }
                        else{
                            $('#tbl_kqcls').html("");
                            $('#kqtimliem').text("Không có phiếu kết quả nào được tìm thấy!");tk=false;
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
                url: '/qlkcb/kham_va_dieu_tri/tra_ket_qua_cls/lay_ds_kq',
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
                        alert("Lỗi khi tải danh sách kết quả cận lâm sàng! Mô tả: "+data.msg);
                    }else{
                        var kqcls='';
                        for (var i = 0; i < data.kqcls.length; i++) {
                            var kq='';
                            if($.isArray(data.kqcls[i].kq))
                            {
                                for (var k = 0; k < data.kqcls[i].kq.length; k++) {
                                    if(k==data.kqcls[i].kq.length-1){
                                        kq+='- '+data.kqcls[i].kq[k];
                                        break;
                                    }
                                    kq+='- '+data.kqcls[i].kq[k]+'<br>';
                                }
                            }
                            var kl='';
                            if($.isArray(data.kqcls[i].kl))
                            {
                                for (var k = 0; k < data.kqcls[i].kl.length; k++) {
                                    if(k==data.kqcls[i].kl.length-1){
                                        kl+='- '+data.kqcls[i].kl[k];
                                        break;
                                    }
                                    kl+='- '+data.kqcls[i].kl[k]+'<br>';
                                }
                            }

                            kqcls+='\n\
                                <tr class="tr-shadow text-left">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.kqcls[i].idkqcls+'" data-name="'+data.kqcls[i].hoten+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.kqcls[i].hoten+'</td>\n\
                                    <td>'+data.kqcls[i].dttn+'</td>\n\
                                    <td>'+data.kqcls[i].nvcd+'</td>\n\
                                    <td class="text-left">'+data.kqcls[i].chuandoan+'</td>\n\
                                    <td class="text-left">'+kq+'</td>\n\
                                    <td class="text-left">'+kl+'</td>\n\
                                    <td>'+data.kqcls[i].ngayth+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" data-toggle="modal" data-target="#modalcls" rel="tooltip" data-placement="top" title="Xem kết quả" data-button="xemct" data-id="'+data.kqcls[i].idkqcls+'">\n\
                                                <i class="fa fa-list"></i>\n\
                                            </button>\n\
                                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="'+data.kqcls[i].idkqcls+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="'+data.kqcls[i].idkqcls+'" data-name="'+data.kqcls[i].hoten+'">\n\
                                                <i class="zmdi zmdi-delete"  ></i>\n\
                                            </button>\n\
                                            <button class="item" data-toggle="tooltip" title="In phiếu kết quả" data-button="in" data-id="'+data.kqcls[i].idkqcls+'">\n\
                                                <i class="zmdi zmdi-print"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                        }

                        $('#tbl_kqcls').html(kqcls);
                        $('#tbl_kqcls button[data-id]').tooltip({
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
        
        function genPDF() { 
            var deferreds = [];
            var deferred = $.Deferred();
                deferreds.push(deferred.promise());
                generateCanvas(deferred);
            
            $.when.apply($, deferreds).then(function () { 
                $('#dtbipkq').text('Đã xử lý xong!');
                $('#proccesspkq').addClass('hidden');
            });
        }

        function generateCanvas(deferred){

            html2canvas($("div[class*='printcontent']:eq(0)")[0], {useCORS: true, scale: 3, allowTaint: true}).then(function (canvas) {
                var imgData = canvas.toDataURL(
                       'image/png');
                calculatePDF_height_width("div[class*='printcontent']",0);
                var pdf = new jsPDF('p','mm', [PDF_Width,  PDF_Height]);
                pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, HTML_Width, HTML_Height);
                pdf.autoPrint({variant: 'non-conform'});
                pdf.save(file_name_tt+'.pdf');
                deferred.resolve();
             });
        }
        
        function prepare_content_to_print(data, bn){
            var d=new Date();
            var ngay= ((d.getDate()<10) ? '0' : '') + d.getDate();
            var thang=((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1));
            var nam=d.getFullYear();
            $('#print_content').html('');
            var content='<div class="card" style="font-weight: normal;width: 660px !important;">\n\
                            <div class="card-block card-body printcontent" style="height: 814px; width: 660px !important; font-weight: 800;">\n\
                                <div style="height: 755px">\n\
                                    <div class="row m-b-10">\n\
                                        <div class="col-lg-9">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-2 text-center" style="margin: 0; padding: 0; padding-top: 3px; width: 55px">\n\
                                                    <label><img src="public/images/logo3.png" style="height: 50px;"></label>\n\
                                                </div>\n\
                                                <div class="col-lg-10" style="margin: 0; padding: 0;">\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-12">\n\
                                                             <label style="margin-bottom: 0;">Sở Y tế An Giang</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-12">\n\
                                                             <label style="margin-bottom: 0;">Bệnh Viện ĐKTT An Giang</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-12">\n\
                                                             <label style="margin-bottom: 0;">Địa chỉ: 60 Ung Văn Khiêm - Mỹ Phước - Long Xuyên - An Giang</label>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <div class="row">\n\
                                                        <div class="col-lg-12">\n\
\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="col-lg-3 text-center">\n\
                                            <div class="row">\n\
                                                 <div class="col-lg-12">\n\
                                                     <label style="margin-bottom: 0;">'+bn.barcode+'</label>\n\
\n\
                                                 </div>\n\
                                            </div>\n\
                                            <div class="row">\n\
                                                <div class="col-lg-12">\n\
                                                     <label style="margin-bottom: 0;">'+bn.mabn+'</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 0;">Họ tên: </label> <label style="margin-bottom: 0; font-size: 8pt">'+bn.hoten+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <label style="margin-bottom: 0;">Tuổi: '+bn.tuoi+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-3">\n\
                                            <label style="margin-bottom: 0;">Giới tính: '+bn.gt+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 0;">Địa chỉ: '+bn.diachi+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-5">\n\
                                            <label style="margin-bottom: 0;">Khoa phòng: '+bn.pk+'</label>\n\
                                        </div>\n\
                                        <div class="col-lg-7">\n\
                                            <div class="row">\n\
                                                <div class="col-lg-6">\n\
                                                    <label style="margin-bottom: 0;">Bác sỹ CĐ: '+bn.nvcd+'</label>\n\
                                                </div>\n\
                                                <div class="col-lg-6">\n\
                                                    <label style="margin-bottom: 0;">Đối tượng: '+bn.dttn+'</label>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 10px;">Chuẩn đoán: '+bn.chuandoan+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12 text-center">\n\
                                            <label style="margin-bottom: 0; font-size: 12pt">KẾT QUẢ '+bn.tencls.toString().toUpperCase()+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 10px; text-decoration: underline">Mô tả hình ảnh: </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">'
                                            +data.kqha+
                                        '</div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 10px; text-decoration: underline">Mô tả các kết quả: </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-10" style="font-size: 10pt">\n\
                                        <div class="col-lg-12">'
                                        +data.kq+
                                        '</div>\n\
                                    </div>\n\
                                    <div class="row">\n\
                                        <div class="col-lg-12">\n\
                                            <label style="margin-bottom: 10px; text-decoration: underline">Kết luận: </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row m-b-5" style="font-size: 10pt">\n\
                                        <div class="col-lg-12">'
                                        +data.kl+
                                        '</div>\n\
                                    </div>\n\
                                    <div class="row text-center">\n\
                                        <div class="col-lg-6 "></div>\n\
                                        <div class="col-lg-6">\n\
                                            <label style="margin-bottom: 50px; font-size: 8pt">Ngày '+ngay+' tháng '+thang+' năm '+nam+'</label><br>\n\
                                            <label style="margin-bottom: 0">BS '+bn.nvth+'</label>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="row" style="height: 20px"></div>\n\
                                <div class="row">\n\
                                    <div class="col-lg-10">\n\
                                        <label style="margin-bottom: 0;">Họ tên người bệnh: '+bn.hoten+' - Mã Y Tế: '+bn.mabn+' - Năm Sinh: '+bn.namsinh+'</label>\n\
                                    </div>\n\
                                    <div class="col-lg-2 text-right">\n\
                                        <label style="margin-bottom: 0;">Trang 1/1.</label>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>';

            file_name_tt='PHIEU_KQ_CLS_'+bn.hoten.toString().toUpperCase()+'_'+bn.tenkhoa.toString().toUpperCase()+'_'+ngay+'_'+thang+'_'+nam;
            $('#print_content').html(content);
        }
        
        function inphieu(idpkq){
            $('#btnprintpkqarea').addClass('hidden');
            $('#dtbiareapkq').removeClass('hidden');$('#dtbipkq').text('Đang tạo bản in!');
            $('#proccesspkq').removeClass('hidden');
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('idkqcls', idpkq);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/kham_va_dieu_tri/tra_ket_qua_cls/in',
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
                            $('#btnprintpkqarea').removeClass('hidden');
                            $('#dtbipkq').text('Đã tạo xong!');
                            $('#proccesspkq').addClass('hidden');
                        });
                    }
                    else if(data.msg == 'kott'){
                        $('#dtbiareapkq').addClass('hidden');
                        $('#proccesspkq').addClass('hidden');
                        alert("Phiếu kết quả này không tồn tại! Có thể đã bị xóa.");
                    }
                    else{
                        $('#dtbiareapkq').addClass('hidden');$('#proccesspkq').addClass('hidden');
                        alert("Không thể tạo dữ liệu in! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#dtbiareapkq').addClass('hidden');$('#proccesspkq').addClass('hidden');
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
        
        $('#tbl_kqcls').on('click','button[data-button="in"]',function(){
            var idkqcls=$(this).attr('data-id');
            $('#btnprint').trigger('click', idkqcls);
        });
        
        $('#btnprint').on('click', function(e, id){
            var idkqcls='';
            if($.isEmptyObject(id)){
                idkqcls=$(this).attr('data-id');
            }
            else{
                idkqcls=id;
            }
            inphieu(idkqcls);
        });
        
        $('#btnprintpkq').click(function(){
            $('#dtbiareapkq').removeClass('hidden');$('#dtbipkq').text('Đang xử lý!');
            $('#proccesspkq').removeClass('hidden');
            genPDF();
        });
        
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