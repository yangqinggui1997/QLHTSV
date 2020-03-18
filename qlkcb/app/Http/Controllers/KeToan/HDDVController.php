<?php

namespace App\Http\Controllers\KeToan;

use App\Http\Controllers\Controller;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KeToan\hoa_don_dv_ngoai_tru;
use App\Models\KeToan\hoa_don_dv_noi_tru;
use App\Models\TiepDon\benh_nhan;
use App\Models\TiepDon\phieu_dk_kham;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_ngoai_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vp_ngoai_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc;
use App\Models\KhamVaDieuTri\toa_thuoc_vs_benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru_vs_can_lam_sang;
use App\Models\KhamVaDieuTri\chi_dinh_tt_vs_benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_noi_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vp_noi_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_noi_vs_danh_muc_cls;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc;
use App\Models\KhamVaDieuTri\toa_thuoc_vs_benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct_vs_can_lam_sang;
use App\Models\KhamVaDieuTri\chi_dinh_tt_vs_benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\chi_dinh_pt;
use App\Models\HanhChinh\danh_muc_cls;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HDDVController extends Controller
{
    //
    
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $dshdngoai= hoa_don_dv_ngoai_tru::where('IdNVLap', $idnv)->orderBy('created_at', 'DESC')->get();
        
        $dshdnoi= hoa_don_dv_noi_tru::where('IdNVLap', $idnv)->orderBy('created_at', 'DESC')->get();
        
        $dsbn= benh_nhan::orderBy('HoTen', 'ASC')->get();
        
        return view("ke_toan.hoa_don_dv", ['dshdngoai'=>$dshdngoai, 'dshdnoi' =>$dshdnoi, 'dsbn' =>$dsbn]);
    } 
    
    public function postLayTT(Request $request){
        try{
            $bn= benh_nhan::where('IdBN', $request->id)->get()->first();
            if(is_object($bn)){
                if(count($bn->phieuDkKham) > 0){
                    $ba='';$flag='noi';
                    foreach ($bn->phieuDkKham as $value) {
                        if(is_object($value->benhAnNgoaiTru)){
                            if($value->benhAnNgoaiTru->benhAnNgoaiTru->TrangThaiBA == 1 && is_object($value->benhAnNgoaiTru->benhAnNgoaiTru->phieuKKVPNgoaiTru) && !is_object($value->benhAnNgoaiTru->benhAnNgoaiTru->HDDV)){
                                $ba=$value->benhAnNgoaiTru->benhAnNgoaiTru;
                                $flag='ngoai';
                                break;
                            }
                        }
                        else if(is_object($value->benhAnNoiTru)){
                            if($value->benhAnNoiTru->benhAnNoiTru->TrangThaiBA == 1 && is_object($value->benhAnNoiTru->benhAnNoiTru->phieuKeKhaiVP) && !is_object($value->benhAnNoiTru->benhAnNoiTru->HDDV)){
                                $ba=$value->benhAnNoiTru->benhAnNoiTru;
                                break;
                            }
                        }
                    }
                    if(is_object($ba)){
                        $benhnhan=$ba->phieuDKKham->phieuDKKham->benhNhan;
                        $ngaysinh=date( "d/m/Y", strtotime($benhnhan->NgaySinh));
                        $tuyen='Đúng tuyến';$chuyentu='Không chuyển'; $giaychuyen='Không có giấy chuyển';$htk='thuphi';
                        if($ba->phieuDKKham->phieuDKKham->Tuyen == 1){
                            $tuyen='Vượt tuyến';$chuyentu='Tuyến huyện';
                            if($ba->phieuDKKham->phieuDKKham->GiayChuyen == 1){
                                $giaychuyen='Có giấy chuyển';
                            }
                        }
                        else if($ba->phieuDKKham->phieuDKKham->Tuyen == 2){
                            $tuyen='Vượt tuyến';$chuyentu='Tuyến xã';
                            if($ba->phieuDKKham->phieuDKKham->GiayChuyen == 1){
                                $giaychuyen='Có giấy chuyển';
                            }
                        }
                        if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 0){
                            $htk='bhyt';
                        }

                        $gt="Nam";
                        if($benhnhan->GioiTinh == 0){
                            $gt="Nữ";
                        }
                        $scmnd="Chưa cập nhật!";
                        if($benhnhan->SoCMND != ''){
                            $scmnd=$benhnhan->SoCMND;
                        }
                        $diachi="";
                        if($benhnhan->DiaChi == ''){
                            $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                        }
                        else{
                            $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                        }
                        $dantoc ="Chưa cập nhật!";
                        if($benhnhan->DanToc != ''){
                            $dantoc = \comm_functions::decodeDanToc($benhnhan->DanToc);
                        }
                        
                        $mathe='koco';
                        $ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';
                        if(is_object($benhnhan->theBHYT)){
                            $mathe=$benhnhan->theBHYT->IdTheBHYT;
                            $ngaydk=date( "d/m/Y", strtotime($benhnhan->theBHYT->NgayDK));
                            $ngayhh=date( "d/m/Y", strtotime($benhnhan->theBHYT->NgayHH));
                            $doituong=$benhnhan->theBHYT->DoiTuongBHYT;
                            $noidk=$benhnhan->theBHYT->coSoKhamBHYT->TenCS;
                            $mh= \comm_functions::getMucHuongDTK($benhnhan->theBHYT->DoiTuongBHYT).'%';
                        }
                        $dttn='BHYT';
                        if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                            $dttn='Thu phí';
                        }
                        $id='';$htdt='Ngoại trú';$loaiba='noi';
                        if($flag == 'noi'){
                            $id=$ba->IdBANoiT;
                            $htdt='Nội trú';
                        }
                        else{
                            $id=$ba->IdBANgoaiT;
                            $loaiba='ngoai';
                        }
                        $response=array(
                            'msg'=>'tc',
                            'hotenbn' => $benhnhan->HoTen,//
                            'ngaysinh' => $ngaysinh,//
                            'gt' => $gt,//
                            'diachi' => $diachi,//
                            'dantoc'=>$dantoc,//
                            'socmnd' => $scmnd,//
                            'htdt'=>$htdt,//
                            'id' => $id,//
                            'mathe'=>$mathe,//
                            'ngaydk'=>$ngaydk,//
                            'ngayhh'=>$ngayhh,//
                            'noidk'=>$noidk,//
                            'doituong'=>$doituong,//
                            'mh'=>$mh,//
                            'tuyen'=>$tuyen,//
                            'chuyentu'=>$chuyentu,//
                            'giaychuyen'=>$giaychuyen,//
                            'anh'=>$benhnhan->Anh,//
                            'htk'=>$htk,//
                            'dttn'=>$dttn,//
                            'loaiba'=>$loaiba
                        );

                        return response()->json($response);
                    }
                    else{
                        $response=array(
                            'msg'=>'ktt',
                            
                        );
                        return response()->json($response);
                    }
                }
                else{
                    $response=array(
                        'msg'=>'ktt',
                    );
                    return response()->json($response);
                }
            }
            else{
                $response=array(
                    'msg'=>'ktt',
                    
                );
                return response()->json($response);
            }
        } catch (\Exception $e){
            $err=$e->getMessage();
            $response=array(
                'msg'=>$err
            );
            return response()->json($response);
        }
    }
    
    public function postThem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            if($request->loaiba == 'ngoai'){
                $hdngoai='';
                
                $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
                
                if(is_object($ba->HDDV)){
                    $hdngoai=$ba->HDDV;
                }
                else{
                    $hdngoai=new hoa_don_dv_ngoai_tru;
                    $hdngoai->IdHDDVNgoai= HDDVController::TaoMaNNNgoai();
                    $hdngoai->IdNVLap=$idnv;
                    $hdngoai->IdBANgoaiT=$request->idba;
                    $hdngoai->HinhThucTT=$request->httt;
                    $hdngoai->save();
                }
                $msg='tc';
                $tttbv_ts=0;$tttbhyt_ts=0;$tqbhyt_ts=0;$tnbcct_ts=0;$tnbtt_ts=0;$tbntu=0;$nd='Khám bệnh (';
                if(is_object($ba)){
                    $bn=$ba->phieuDKKham->phieuDKKham->benhNhan;
                    $pdk=$ba->phieuDKKham->phieuDKKham;

                    $dspdk= phieu_dk_kham::where('IdBN', $bn->IdBN)->whereDate('created_at', 'like', '%'.date('Y-m-d', strtotime($ba->created_at)).'%')->get();
                    
                    $flag_xn=FALSE;$flag_cdha=FALSE;$flag_tdcn=FALSE;$flag_thuoc=FALSE;$flag_tt=FALSE;
                    
                    $tttbv_kb=0;$tttbhyt_kb=0;$tqbhyt_kb=0;$tnbcct_kb=0;
                    $tttbv_xn=0;$tttbhyt_xn=0;$tqbhyt_xn=0;$tnbcct_xn=0;$tnbtt_xn=0;
                    $tttbv_cdha=0;$tttbhyt_cdha=0;$tqbhyt_cdha=0;$tnbcct_cdha=0;$tnbtt_cdha=0;
                    $tttbv_tdcn=0;$tttbhyt_tdcn=0;$tqbhyt_tdcn=0;$tnbcct_tdcn=0;$tnbtt_tdcn=0;
                    $tttbv_thuoc=0;$tttbhyt_thuoc=0;$tqbhyt_thuoc=0;$tnbcct_thuoc=0;$tnbtt_thuoc=0;
                    $tttbv_tt=0;$tttbhyt_tt=0;$tqbhyt_tt=0;$tnbcct_tt=0;$tnbtt_tt=0;
                    $tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;
                    
                    $dsba=[];$i_kb=1;$pkekhai='';
                    foreach ($dspdk as $pdkk){
                        if(is_object($pdkk->benhAnNgoaiTru)){
                            $ban=$pdkk->benhAnNgoaiTru->benhAnNgoaiTru;
                            $dsba[]=$ban->IdBANgoaiT;
                            if(is_object($ban->phieuKKVPNgoaiTru)){
                                $pkekhai=$ban->phieuKKVPNgoaiTru;
                                foreach ($pkekhai->phieuKKVPCT as $value) {
                                    $value->delete(); //đồng thời xóa trên bảng qua hệ vs danh mục
                                }
                                $flagpkk=TRUE;
                            }
                        }
                    }

                    if($flagpkk == FALSE){

                        //thêm phiếu kk
                        $pkkhai= new phieu_ke_khai_vp_ngoai_tru;
                        $pkkhai->IdPKK= phieuKeKhaiVPNgoaiTruController::TaoMaNN();
                        $pkkhai->IdBANgoaiT=$ba->IdBANgoaiT;
                        $pkkhai->save();

                        $pkekhai= phieu_ke_khai_vp_ngoai_tru::where('IdPKK', $pkkhai->IdPKK)->get()->first();
                    }
                    
                    foreach ($dsba as $value) {
                        $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $value)->get()->first();
                        if(is_object($ba)){
                            //thuốc
                            $toa_vs_ba= toa_thuoc_vs_benh_an_ngoai_tru::where('IdBANgoaiT', $ba->IdBANgoaiT)->get()->first();
                            if(is_object($toa_vs_ba)){
                                $toa=$toa_vs_ba->toaThuoc;
                                $flag_thuoc=TRUE;
                                foreach ($toa->toaThuocCT as $value) {
                                    //thêm chi tiết
                                    $pkkct= new phieu_ke_khai_vpct_ngoai_tru;
                                    $pkkct->IdPKKCT= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNgoaiTruController::TaoMaNNCT();
                                    $pkkct->IdPKK=$pkekhai->IdPKK;
                                    $pkkct->save();

                                    //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                                    $dmt_vs_pkk= new phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc;
                                    $dmt_vs_pkk->IdThuoc= $value->danhMucThuoc->IdThuoc;
                                    $dmt_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                                    $dmt_vs_pkk->SL=$value->TST;
                                    $dmt_vs_pkk->save();

                                    $dg_sl=$dmt_vs_pkk->danhMucThuoc->DonGiaBan * $value->TST;
                                    $tttbv_thuoc+=$dg_sl;

                                    if($pdk->KhamBHYT == 0){
                                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1) ){
                                            $tttbhyt=($dmt_vs_pkk->danhMucThuoc->BHYTTT / 100)*$dg_sl;
                                            $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                            $tnbcct= $tttbhyt - $ttqbhyt;
                                            
                                            $tnbtt=$dg_sl - $tttbhyt;
                                            
                                            $tqbhyt_thuoc+=$ttqbhyt; $tnbcct_thuoc+=$tnbcct; $tttbhyt_thuoc+=$tttbhyt; $tnbtt_thuoc+=$tnbtt;
                                        }
                                        else{
                                            $tnbcct_thuoc+=$dg_sl;
                                        }
                                    }
                                    else{
                                        $tnbcct_thuoc+=$dg_sl;
                                    }
                                }
                            }

                            //cls
                            $cls_vs_ba= benh_an_ngoai_tru_vs_can_lam_sang::where('IdBANgoaiT', $ba->IdBANgoaiT)->get();
                            if(is_object($cls_vs_ba)){
                                foreach ($cls_vs_ba as $value) {
                                    //thêm chi tiết
                                    $pkkct= new phieu_ke_khai_vpct_ngoai_tru;
                                    $pkkct->IdPKKCT= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNgoaiTruController::TaoMaNNCT();
                                    $pkkct->IdPKK=$pkekhai->IdPKK;
                                    $pkkct->save();

                                    //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                                    $dmcls_vs_pkk= new phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls;
                                    $dmcls_vs_pkk->IdDMCLS= $value->canLamSang->danhMucCLS->IdDMCLS;
                                    $dmcls_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                                    $dmcls_vs_pkk->SL=1;
                                    $dmcls_vs_pkk->save();


                                    if($dmcls_vs_pkk->danhMucCLS->TenKDau == 'xet_nghiem'){
                                        $tttbv_xn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                        $flag_xn=TRUE;
                                        
                                        if($pdk->KhamBHYT == 0){
                                            if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                                $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                                $tnbcct= $tttbhyt - $ttqbhyt;
                                                
                                                $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;
                                                
                                                $tqbhyt_xn+=$ttqbhyt; $tnbcct_xn+=$tnbcct; $tttbhyt_xn+=$tttbhyt; $tnbtt_xn+=$tnbtt;
                                                $tbntu+= ($tnbcct + $tnbtt) / 2;
                                            }
                                            else{
                                                
                                                $tnbcct_xn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                            }
                                        }
                                        else{
                                            $tnbcct_xn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                        }
                                    }
                                    else if($dmcls_vs_pkk->danhMucCLS->TenKDau == 'chuan_doan_hinh_anh'){
                                        $tttbv_cdha+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                        $flag_cdha=TRUE;
                                        
                                        if($pdk->KhamBHYT == 0){
                                            if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                                $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                                $tnbcct= $tttbhyt - $ttqbhyt;
                                                
                                                $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;
                                                
                                                $tqbhyt_cdha+=$ttqbhyt; $tnbcct_cdha+=$tnbcct; $tttbhyt_cdha+=$tttbhyt; $tnbtt_cdha+=$tnbtt;
                                                $tbntu+= ($tnbcct + $tnbtt) / 2;
                                            }
                                            else{
                                                $tnbcct_cdha+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                            }
                                        }
                                        else{
                                            $tnbcct_cdha+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                        }
                                    }
                                    else if($dmcls_vs_pkk->danhMucCLS->TenKDau == 'tham_do_chuc_nang'){
                                        $tttbv_tdcn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                        $flag_tdcn=TRUE;
                                        
                                        if($pdk->KhamBHYT == 0){
                                            if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                                $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                                $tnbcct= $tttbhyt - $ttqbhyt;
                                                
                                                $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;
                                                
                                                $tqbhyt_tdcn+=$ttqbhyt; $tnbcct_tdcn+=$tnbcct; $tttbhyt_tdcn+=$tttbhyt; $tnbtt_tdcn+=$tnbtt;
                                                $tbntu+= ($tnbcct + $tnbtt) / 2;
                                            }
                                            else{
                                                $tnbcct_tdcn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                            }
                                        }
                                        else{
                                            $tnbcct_tdcn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                        }
                                    }
                                }

                            }

                            //thủ thuật
                            $tt_vs_ba= chi_dinh_tt_vs_benh_an_ngoai_tru::where('IdBANgoaiT', $ba->IdBANgoaiT)->get();
                            if(is_object($tt_vs_ba)){
                                foreach ($tt_vs_ba as $value) {

                                    $flag_tt=TRUE;
                                    //thêm chi tiết
                                    $pkkct= new phieu_ke_khai_vpct_ngoai_tru;
                                    $pkkct->IdPKKCT= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNgoaiTruController::TaoMaNNCT();
                                    $pkkct->IdPKK=$pkekhai->IdPKK;
                                    $pkkct->save();

                                    //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                                    $dmcls_vs_pkk= new phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls;
                                    $dmcls_vs_pkk->IdDMCLS= $value->chiDinhTT->danhMucCLS->IdDMCLS;
                                    $dmcls_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                                    $dmcls_vs_pkk->SL=1;
                                    $dmcls_vs_pkk->save();

                                    $tttbv_tt+=$dmcls_vs_pkk->danhMucCLS->DonGia;

                                    
                                    if($pdk->KhamBHYT == 0){
                                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                            $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                            $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                            $tnbcct= $tttbhyt - $ttqbhyt;
                                            
                                            $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;
                                            $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                            $tbntu+= ($tnbcct + $tnbtt) / 2;
                                        }
                                        else{
                                            $tnbcct_tt+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                        }
                                    }
                                    else{
                                        $tnbcct_tt+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                        $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                    }
                                }
                            }

                            //khám bệnh
                            if($i_kb == 1){
                                $tttbv_kb=33000;
                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0){
                                        $ttqbhyt=33000*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct=33000 - $ttqbhyt;
                                        $tqbhyt_kb+=$ttqbhyt; $tnbcct_kb+=$tnbcct; $tttbhyt_kb=33000;
                                    }
                                    else{
                                        $tnbcct_kb+=33000;
                                    }
                                }
                                else{
                                    $tnbcct_kb+=33000;
                                }
                            }
                            else if($i_kb >=2 && $i_kb <= 4){
                                $tttbv_kb+=33000;
                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0){
                                        $tqbhyt=9900*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct=9900 - $tqbhyt;
                                        $tqbhyt_kb+=$tqbhyt;$tnbcct_kb+=$tnbcct;$tttbhyt_kb+=9900;
                                    }
                                    else{
                                        $tnbcct_kb+=9900;
                                    }
                                }
                                else{
                                    $tnbcct_kb+=9900;
                                }
                            }
                            else if($i_kb == 5){
                                $tttbv_kb+=33000;
                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0){
                                        $tqbhyt=3300*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct=3300 - $tqbhyt;
                                        $tqbhyt_kb+=$tqbhyt;$tnbcct_kb+=$tnbcct; $tttbhyt_kb+=3300;
                                    }
                                    else{
                                        $tnbcct_kb+=3300;
                                    }
                                }
                                else{
                                    $tnbcct_kb+=3300;
                                }
                            }
                        }
                        $i_kb++;
                    }
                    
                    $nd.= number_format($tttbv_kb).'); ';
                    if($flag_thuoc == TRUE){
                        $nd.='Thuốc, Dịch truyền ('. number_format($tttbv_thuoc).'); ';
                    }
                    if($flag_xn == TRUE){
                        $nd.='Xét nghiệm ('. number_format($tttbv_xn).'); ';
                    }
                    if($flag_cdha == TRUE){
                        $nd.='Chuẩn đoán hình ảnh ('. number_format($tttbv_cdha).'); ';
                    }
                    if($flag_tdcn == TRUE){
                        $nd.='Thăm dò chức năng ('. number_format($tttbv_tdcn).'); ';
                    }
                    if($tttbv_tt == TRUE){
                        $nd.='Thủ thuật - Phẫu thuật ('. number_format($tttbv_tt).');';
                    }
                    $tttbv_ts= $tttbv_kb + $tttbv_xn + $tttbv_cdha + $tttbv_tdcn + $tttbv_tt + $tttbv_thuoc;
                    $tttbhyt_ts=$tttbhyt_kb + $tttbhyt_xn +$tttbhyt_cdha + $tttbhyt_tdcn + $tttbhyt_thuoc + $tttbhyt_tt;
                    $tqbhyt_ts= $tqbhyt_kb + $tqbhyt_xn + $tqbhyt_cdha + $tqbhyt_tdcn + $tqbhyt_thuoc + $tqbhyt_tt;
                    $tnbcct_ts= $tnbcct_kb + $tnbcct_xn + $tnbcct_cdha + $tnbcct_tdcn + $tnbcct_thuoc + $tnbcct_tt;
                    $tnbtt_ts= $tnbtt_xn + $tnbtt_cdha + $tnbtt_tdcn + $tnbtt_thuoc + $tnbtt_tt;
                }
                else{
                    $msg='ktt';

                    $response=array(
                        'msg'=>$msg
                    );
                    return response()->json($response);
                }

                //lấy thông tin liên quan đến bệnh nhân
                $benhnhan=$ba->phieuDKKham->phieuDKKham->benhNhan;
                $nv= $ba->nhanVien;
                $dttn='BHYT';$bhyt='';
                if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                else{
                    $bhyt=$benhnhan->theBHYT->BHYTHoTro.'% '.number_format($tqbhyt_ts);
                }
                $diachi="";
                if($benhnhan->DiaChi == ''){
                    $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                }
                else{
                    $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                }
                $tang='TRIỆT';
                if($tang != 0){
                    $tang='LẦU '.$nv->phongBan->Tang;
                }
                $pk='  P.Khám '.$nv->phongBan->Khoa->TenKhoa.' ( '.$nv->phongBan->SoPhong.' - '.$tang.' )';
                $bn_k= mb_convert_case($benhnhan->HoTen, MB_CASE_UPPER, 'utf-8').'('.date('Y', strtotime($benhnhan->NgaySinh)).')'.'  '. $benhnhan->IdBN. $pk;
                $httt='Tiền mặt';
                if($hdngoai->HinhThucTT == 1){
                    $httt='Thanh toán bằng thẻ tín dụng';
                }
                $noidung='<td>2</td>
                        <td>'.$nd.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.number_format(($tnbcct_ts + $tnbtt_ts) - $tbntu).'</td>';
                $data= array(
                    'hoten'=>$benhnhan->HoTen,//
                    'dttn'=>$dttn,//
                    'nd'=>$noidung,//
                    'tt'=> number_format(($tnbcct_ts + $tnbtt_ts) - $tbntu),//
                    'bn'=>$bn_k,//
                    'bnct'=> number_format(($tnbcct_ts + $tnbtt_ts) - $tbntu),//
                    'bhyt'=>$bhyt,//
                    'tu'=> number_format($tbntu),//
                    'dc'=>$diachi,//,
                    'shd'=>$hdngoai->IdHDDVNgoai,
                    'nv'=>$user->nhanVien->TenNV,
                    'httt'=>$httt,
                    'htdt'=>'Ngoại trú',
                    'bsdt'=>$nv->TenNV,
                    'ngaylap'=> \comm_functions::deDateFormat($hdngoai->created_at),
                    'loaiba'=>'ngoai',
                    'idba'=>$ba->IdBANgoaiT
                );

                $response=array(
                    'hd'=>$data,
                    'msg'=>$msg
                );
                return response()->json($response);
            }
            else{
                $hdnoi='';
                
                $ba= benh_an_noi_tru::where('IdBANoiT', $request->idba)->get()->first();
                
                if(is_object($ba->HDDV)){
                    $hdnoi=$ba->HDDV;
                }
                else{
                    $hdnoi=new hoa_don_dv_noi_tru;
                    $hdnoi->IdHDDVNoi= HDDVController::TaoMaNNNoi();
                    $hdnoi->IdNVLap=$idnv;
                    $hdnoi->IdBANoiT=$request->idba;
                    $hdnoi->HinhThucTT=$request->httt;
                    $hdnoi->save();
                }
                $msg='tc';
                $tttbv_ts=0;$tttbhyt_ts=0;$tqbhyt_ts=0;$tnbcct_ts=0;$tnbtt_ts=0;$tbntu=0;$nd='Khám bệnh (';
                $sndt=1;
                if(is_object($ba)){
                    $bn=$ba->phieuDKKham->phieuDKKham->benhNhan;
                    $pdk=$ba->phieuDKKham->phieuDKKham;

                    $flag_xn=FALSE;$flag_cdha=FALSE;$flag_tdcn=FALSE;$flag_thuoc=FALSE;$flag_tt=FALSE;$flag_pt=FALSE;
                    
                    $tttbv_kb=0;$tttbhyt_kb=0;$tqbhyt_kb=0;$tnbcct_kb=0;
                    $tttbv_xn=0;$tttbhyt_xn=0;$tqbhyt_xn=0;$tnbcct_xn=0;$tnbtt_xn=0;
                    $tttbv_cdha=0;$tttbhyt_cdha=0;$tqbhyt_cdha=0;$tnbcct_cdha=0;$tnbtt_cdha=0;
                    $tttbv_tdcn=0;$tttbhyt_tdcn=0;$tqbhyt_tdcn=0;$tnbcct_tdcn=0;$tnbtt_tdcn=0;
                    $tttbv_thuoc=0;$tttbhyt_thuoc=0;$tqbhyt_thuoc=0;$tnbcct_thuoc=0;$tnbtt_thuoc=0;
                    $tttbv_tt=0;$tttbhyt_tt=0;$tqbhyt_tt=0;$tnbcct_tt=0;$tnbtt_tt=0;
                    $tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;

                    $i_kb=1;

                    $pkekhai='';
                    if(is_object($ba->phieuKeKhaiVP)){
                        $pkekhai=$ba->phieuKeKhaiVP;
                        foreach ($pkekhai->phieuKKVPCT as $value) {
                            $value->delete(); //đồng thời xóa trên bảng qua hệ vs danh mục
                        }
                    }
                    else{
                        //thêm phiếu kk
                        $pkkhai= new phieu_ke_khai_vp_noi_tru;
                        $pkkhai->IdPKK= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNoiTruController::TaoMaNN();
                        $pkkhai->IdBANoiT=$ba->IdBANoiT;
                        $pkkhai->save();

                        $pkekhai= phieu_ke_khai_vp_noi_tru::where('IdPKK', $pkkhai->IdPKK)->get()->first();
                    }
                    foreach ($ba->benhAnNoiTruCT as $b){
                        //thuốc
                        $toa_vs_ba= toa_thuoc_vs_benh_an_noi_tru_ct::where('IdBACT', $b->IdBACT)->get()->first();
                        if(is_object($toa_vs_ba)){
                            $flag_thuoc=TRUE;
                        }

                        //cls
                        $cls_vs_ba= benh_an_noi_tru_ct_vs_can_lam_sang::where('IdBACT', $b->IdBACT)->get();
                        if(count($cls_vs_ba) > 0){
                            foreach ($cls_vs_ba as $value) {
                                if($value->canLamSang->danhMucCLS->TenKDau == 'xet_nghiem'){
                                    $flag_xn=TRUE;
                                }
                                else if($value->canLamSang->danhMucCLS->TenKDau == 'chuan_doan_hinh_anh'){
                                    $flag_cdha=TRUE;
                                }
                                else if($value->canLamSang->danhMucCLS->TenKDau == 'tham_do_chuc_nang'){
                                    $flag_tdcn=TRUE;
                                }
                            }
                        }

                        //thủ thuật
                        $tt_vs_ba= chi_dinh_tt_vs_benh_an_noi_tru_ct::where('IdBACT', $b->IdBACT)->get();
                        if(count($tt_vs_ba) > 0){
                            foreach ($tt_vs_ba as $value) {
                                $flag_tt=TRUE;
                            }
                        }

                        //phẫu thuật
                        $pt_vs_ba= chi_dinh_pt::where('IdBACT', $b->IdBACT)->get()->first();
                        if(is_object($pt_vs_ba)){
                            $flag_pt=TRUE;
                        }
                        
                        //khám bệnh
                        if($i_kb == 1){
                            $tttbv_kb=33000;
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0){
                                    $ttqbhyt=33000*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct=33000 - $ttqbhyt;
                                    $tqbhyt_kb+=$ttqbhyt; $tnbcct_kb+=$tnbcct; $tttbhyt_kb=33000;
                                }
                                else{
                                    $tnbcct_kb+=33000;
                                }
                            }
                            else{
                                $tnbcct_kb+=33000;
                            }
                        }
                    }
                    if($flag_thuoc == TRUE){
                    $re_thuoc= DB::select("SELECT ttct.`IdThuoc`, SUM(ttct.`TST`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN toa_thuoc_vs_benh_an_noi_tru_ct AS tt_ba ON tt_ba.`IdBACT` = bact.`IdBACT` JOIN toa_thuoc AS tt ON tt.`IdTT` = tt_ba.`IdTT` JOIN toa_thuoc_ct AS ttct ON ttct.`IdTT` = tt.`IdTT` WHERE ba.`IdBANoiT` = N'".$ba->IdBANoiT."' GROUP BY ttct.`IdThuoc`");
                    foreach ($re_thuoc as $val) {
                        $ct_thuoc= danh_muc_thuoc::where('IdThuoc', $val->IdThuoc)->get()->first();
                        if(is_object($ct_thuoc)){
                            //thêm chi tiết
                            $pkkct= new phieu_ke_khai_vpct_noi_tru;
                            $pkkct->IdPKKCT= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNoiTruController::TaoMaNNCT();
                            $pkkct->IdPKK=$pkekhai->IdPKK;
                            $pkkct->save();

                            //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                            $dmt_vs_pkk= new phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc;
                            $dmt_vs_pkk->IdThuoc= $val->IdThuoc;
                            $dmt_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                            $dmt_vs_pkk->SL=$val->SL;
                            $dmt_vs_pkk->save();
                            
                            $dg=$ct_thuoc->DonGiaBan;
                            $dg_sl=$dg * $val->SL;
                            $tttbv_thuoc+=$dg_sl;
                            
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $tttbhyt=($ct_thuoc->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $tqbhyt_thuoc+=$ttqbhyt; $tnbcct_thuoc+=$tnbcct; $tttbhyt_thuoc+=$tttbhyt; $tnbtt_thuoc+=$tnbtt;
                                }
                                else{
                                    $tttbhyt=($ct_thuoc->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;

                                    $tqbhyt_thuoc+=$ttqbhyt; $tnbcct_thuoc+=$tnbcct; $tttbhyt_thuoc+=$tttbhyt; $tnbtt_thuoc+=$tnbtt;
                                }
                            }
                            else{
                                $tnbcct_thuoc+=$dg_sl;
                            }
                        }
                    }
                }

                    if($flag_xn == TRUE){
                        //có xét nghiệm
                        $re_xn= DB::select("SELECT cls.`IdDMCLS`, COUNT(cls.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ba->IdBANoiT."' AND dmcls.`TenKDau`= N'xet_nghiem' GROUP BY cls.`IdDMCLS`");
                        foreach ($re_xn as $val) {
                            $ct_xn= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                            if(is_object($ct_xn)){
                                //thêm chi tiết
                                $pkkct= new phieu_ke_khai_vpct_noi_tru;
                                $pkkct->IdPKKCT= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNoiTruController::TaoMaNNCT();
                                $pkkct->IdPKK=$pkekhai->IdPKK;
                                $pkkct->save();

                                //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                                $dmcls_vs_pkk= new phieu_ke_khai_vpct_noi_vs_danh_muc_cls;
                                $dmcls_vs_pkk->IdDMCLS= $ct_xn->IdDMCLS;
                                $dmcls_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                                $dmcls_vs_pkk->SL=$val->SL;
                                $dmcls_vs_pkk->save();

                                $dg=$ct_xn->DonGia;
                                $dg_sl=$dg * $val->SL;
                                $tttbv_xn+=$dg_sl;
                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                        $tttbhyt=($ct_xn->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$dg_sl - $tttbhyt;
                                        $tqbhyt_xn+=$ttqbhyt; $tnbcct_xn+=$tnbcct; $tttbhyt_xn+=$tttbhyt; $tnbtt_xn+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                    else{
                                        $tttbhyt=($ct_xn->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$dg_sl - $tttbhyt;
                                        $tqbhyt_xn+=$ttqbhyt; $tnbcct_xn+=$tnbcct; $tttbhyt_xn+=$tttbhyt; $tnbtt_xn+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                }
                                else{
                                    $tnbcct_xn+=$dg_sl;$tbntu+=$dg_sl / 2;
                                }
                            }

                        }

                    }

                    if($flag_cdha == TRUE){
                        //có chuẩn đoán hình ảnh
                        $re_cdha= DB::select("SELECT cls.`IdDMCLS`, COUNT(cls.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ba->IdBANoiT."' AND dmcls.`TenKDau`= N'chuan_doan_hinh_anh' GROUP BY cls.`IdDMCLS`");
                        foreach ($re_cdha as $val) {
                            $ct_cdha= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                            if(is_object($ct_cdha)){
                                //thêm chi tiết
                                $pkkct= new phieu_ke_khai_vpct_noi_tru;
                                $pkkct->IdPKKCT= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNoiTruController::TaoMaNNCT();
                                $pkkct->IdPKK=$pkekhai->IdPKK;
                                $pkkct->save();

                                //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                                $dmcls_vs_pkk= new phieu_ke_khai_vpct_noi_vs_danh_muc_cls;
                                $dmcls_vs_pkk->IdDMCLS= $ct_cdha->IdDMCLS;
                                $dmcls_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                                $dmcls_vs_pkk->SL=$val->SL;
                                $dmcls_vs_pkk->save();

                                $dg=$ct_cdha->DonGia;
                                $dg_sl=$dg * $val->SL;
                                $tttbv_cdha+=$dg_sl;
                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                        $tttbhyt=($ct_cdha->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$dg_sl - $tttbhyt;
                                        $tqbhyt_cdha+=$ttqbhyt; $tnbcct_cdha+=$tnbcct; $tttbhyt_cdha+=$tttbhyt; $tnbtt_cdha+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                    else{
                                        $tttbhyt=($ct_cdha->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$dg_sl - $tttbhyt;
                                        $tqbhyt_cdha+=$ttqbhyt; $tnbcct_cdha+=$tnbcct; $tttbhyt_cdha+=$tttbhyt; $tnbtt_cdha+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                }
                                else{
                                    $tnbcct_cdha+=$dg_sl;$tbntu+=$dg_sl / 2;
                                }
                            }
                        }
                    }

                    if($flag_tdcn == TRUE){
                        //có thăm dò chức năng
                        $re_tdcn= DB::select("SELECT cls.`IdDMCLS`, COUNT(cls.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ba->IdBANoiT."' AND dmcls.`TenKDau`= N'tham_do_chuc_nang' GROUP BY cls.`IdDMCLS`");
                        foreach ($re_tdcn as $val) {
                            $ct_tdcn= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                            if(is_object($ct_tdcn)){
                                //thêm chi tiết
                                $pkkct= new phieu_ke_khai_vpct_noi_tru;
                                $pkkct->IdPKKCT= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNoiTruController::TaoMaNNCT();
                                $pkkct->IdPKK=$pkekhai->IdPKK;
                                $pkkct->save();

                                //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                                $dmcls_vs_pkk= new phieu_ke_khai_vpct_noi_vs_danh_muc_cls;
                                $dmcls_vs_pkk->IdDMCLS= $ct_tdcn->IdDMCLS;
                                $dmcls_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                                $dmcls_vs_pkk->SL=$val->SL;
                                $dmcls_vs_pkk->save();

                                $dg=$ct_tdcn->DonGia;
                                $dg_sl=$dg * $val->SL;
                                $tttbv_tdcn+=$dg_sl;
                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                        $tttbhyt=($ct_tdcn->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$dg_sl - $tttbhyt;
                                        $tqbhyt_tdcn+=$ttqbhyt; $tnbcct_tdcn+=$tnbcct; $tttbhyt_tdcn+=$tttbhyt; $tnbtt_tdcn+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                    else{
                                        $tttbhyt=($ct_tdcn->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$dg_sl - $tttbhyt;
                                        $tqbhyt_tdcn+=$ttqbhyt; $tnbcct_tdcn+=$tnbcct; $tttbhyt_tdcn+=$tttbhyt; $tnbtt_tdcn+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                }
                                else{
                                    $tnbcct_tdcn+=$dg_sl;$tbntu+=$dg_sl / 2;
                                }
                            }
                        }

                    }

                    if($flag_tt == TRUE){
                        $re_tt= DB::select("SELECT cls.`IdDMCLS`, COUNT(cls.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN chi_dinh_tt_vs_benh_an_noi_tru_ct AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN chi_dinh_tt AS cls ON cls.`IdThuThuat` = cls_ba.`IdThuThuat` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ba->IdBANoiT."' GROUP BY cls.`IdDMCLS`");
                        foreach ($re_tt as $val) {
                            $ct_tt= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                            if(is_object($ct_tt)){
                                //thêm chi tiết
                                $pkkct= new phieu_ke_khai_vpct_noi_tru;
                                $pkkct->IdPKKCT= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNoiTruController::TaoMaNNCT();
                                $pkkct->IdPKK=$pkekhai->IdPKK;
                                $pkkct->save();

                                //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                                $dmcls_vs_pkk= new phieu_ke_khai_vpct_noi_vs_danh_muc_cls;
                                $dmcls_vs_pkk->IdDMCLS= $ct_tt->IdDMCLS;
                                $dmcls_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                                $dmcls_vs_pkk->SL=$val->SL;
                                $dmcls_vs_pkk->save();

                                $dg=$ct_tt->DonGia;
                                $dg_sl=$dg * $val->SL;
                                $tttbv_tt+=$dg_sl;

                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                        $tttbhyt=($ct_tt->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$dg_sl - $tttbhyt;
                                        $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                    else{
                                        $tttbhyt=($ct_tt->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$ct_tt - $tttbhyt;
                                        $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                }
                                else{
                                    $tnbcct_tt+=$dg_sl;$tbntu+=$dg_sl / 2;
                                }
                            }
                        } 
                    }

                    if($flag_pt == TRUE){
                        $re_pt= DB::select("SELECT cls_ba.`IdDMCLS`, COUNT(cls_ba.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN chi_dinh_pt AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls_ba.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ba->IdBANoiT."' GROUP BY cls_ba.`IdDMCLS`");
                        foreach ($re_pt as $val) {
                            $ct_pt= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                            if(is_object($ct_pt)){
                                //thêm chi tiết
                                $pkkct= new phieu_ke_khai_vpct_noi_tru;
                                $pkkct->IdPKKCT= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNoiTruController::TaoMaNNCT();
                                $pkkct->IdPKK=$pkekhai->IdPKK;
                                $pkkct->save();

                                //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                                $dmcls_vs_pkk= new phieu_ke_khai_vpct_noi_vs_danh_muc_cls;
                                $dmcls_vs_pkk->IdDMCLS= $ct_pt->IdDMCLS;
                                $dmcls_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                                $dmcls_vs_pkk->SL=$val->SL;
                                $dmcls_vs_pkk->save();

                                $dg=$ct_pt->DonGia;
                                $dg_sl=$dg * $val->SL;
                                $tttbv_tt+=$dg_sl;

                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                        $tttbhyt=($ct_pt->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$dg_sl - $tttbhyt;
                                        $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                    else{
                                        $tttbhyt=($ct_pt->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$ct_pt - $tttbhyt;
                                        $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                }
                                else{
                                    $tnbcct_tt+=$dg_sl;$tbntu+=$dg_sl / 2;
                                }
                            }
                        } 

                    }

                    $present= date_create(date('Y-m-d', strtotime($pkekhai->created_at)));
                    $timeba= date_create(date('Y-m-d', strtotime($ba->created_at)));
                    $t= date_diff($timeba, $present);
                    $sndt=$t->format('%a') + 1;

                    $tttbv_ng=195000*intval($sndt);

                    $tqbhyt_ng=0;$tnbcct_ng=0;$tttbhyt_ng=0;

                    if($pdk->KhamBHYT == 0){
                        if($pdk->Tuyen == 0){
                            $ttqbhyt=195000*(($bn->theBHYT->BHYTHoTro)/100)*$sndt;
                            $tnbcct=(195000*$sndt) - $ttqbhyt;

                            $tqbhyt_ng+=$ttqbhyt; $tnbcct_ng+=$tnbcct; $tttbhyt_ng=195000*$sndt;
                        }
                        else{
                            $tnbcct_ng+=195000*$sndt;
                        }
                    }
                    else{
                        $tnbcct_ng+=195000*$sndt;
                    }

                    $nd.= number_format($tttbv_kb).'); '.'Ngày giường nội trú ('. number_format($tttbv_ng).'); ';
                    if($flag_thuoc == TRUE){
                        $nd.='Thuốc, Dịch truyền ('. number_format($tttbv_thuoc).'); ';
                    }
                    if($flag_xn == TRUE){
                        $nd.='Xét nghiệm ('. number_format($tttbv_xn).'); ';
                    }
                    if($flag_cdha == TRUE){
                        $nd.='Chuẩn đoán hình ảnh ('. number_format($tttbv_cdha).'); ';
                    }
                    if($flag_tdcn == TRUE){
                        $nd.='Thăm dò chức năng ('. number_format($tttbv_tdcn).'); ';
                    }
                    if($flag_tt == TRUE || $flag_pt == TRUE){
                        $nd.='Thủ thuật - Phẫu thuật ('. number_format($tttbv_tt).');';
                    }
                    
                    $tttbv_ts= $tttbv_kb + $tttbv_xn + $tttbv_cdha + $tttbv_tdcn + $tttbv_tt + $tttbv_thuoc + $tttbv_ng;
                    $tttbhyt_ts=$tttbhyt_kb + $tttbhyt_xn +$tttbhyt_cdha + $tttbhyt_tdcn + $tttbhyt_thuoc + $tttbhyt_tt + $tttbhyt_ng;
                    $tqbhyt_ts= $tqbhyt_kb + $tqbhyt_xn + $tqbhyt_cdha + $tqbhyt_tdcn + $tqbhyt_thuoc + $tqbhyt_tt + $tqbhyt_ng;
                    $tnbcct_ts= $tnbcct_kb + $tnbcct_xn + $tnbcct_cdha + $tnbcct_tdcn + $tnbcct_thuoc + $tnbcct_tt + $tnbcct_ng;
                    $tnbtt_ts= $tnbtt_xn + $tnbtt_cdha + $tnbtt_tdcn + $tnbtt_thuoc + $tnbtt_tt;

                }
                else{
                    $msg='ktt';

                    $response=array(
                        'msg'=>$msg
                    );
                    return response()->json($response);
                }

                //lấy thông tin liên quan đến bệnh nhân
                $benhnhan=$ba->phieuDKKham->phieuDKKham->benhNhan;
                $nv= $ba->nhanVien;
                $dttn='BHYT';$bhyt='';
                if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                else{
                    $bhyt=$benhnhan->theBHYT->BHYTHoTro.'% '.number_format($tqbhyt_ts);
                }
                $diachi="";
                if($benhnhan->DiaChi == ''){
                    $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                }
                else{
                    $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                }
                $tang='TRIỆT';
                if($tang != 0){
                    $tang='LẦU '.$nv->phongBan->Tang;
                }
                $pk='  P.Khám '.$nv->phongBan->Khoa->TenKhoa.' ( '.$nv->phongBan->SoPhong.' - '.$tang.' )';
                $bn_k= mb_convert_case($benhnhan->HoTen, MB_CASE_UPPER, 'utf-8').'('.date('Y', strtotime($benhnhan->NgaySinh)).')'.'  '. $benhnhan->IdBN. $pk;
                $httt='Tiền mặt';
                if($hdnoi->HinhThucTT == 1){
                    $httt='Thanh toán bằng thẻ tín dụng';
                }
                $noidung='<td>2</td>
                        <td>'.$nd.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.number_format(($tnbcct_ts + $tnbtt_ts) - $tbntu).'</td>';
                $data= array(
                    'hoten'=>$benhnhan->HoTen,//
                    'dttn'=>$dttn,//
                    'nd'=>$noidung,//
                    'tt'=> number_format(($tnbcct_ts + $tnbtt_ts) - $tbntu),//
                    'bn'=>$bn_k,//
                    'bnct'=> number_format(($tnbcct_ts + $tnbtt_ts) - $tbntu),//
                    'bhyt'=>$bhyt,//
                    'tu'=> number_format($tbntu),//
                    'dc'=>$diachi,//,
                    'shd'=>$hdnoi->IdHDDVNoi,
                    'nv'=>$user->nhanVien->TenNV,
                    'httt'=>$httt,
                    'htdt'=>'Nội trú',
                    'bsdt'=>$nv->TenNV,
                    'ngaylap'=> \comm_functions::deDateFormat($hdnoi->created_at),
                    'loaiba'=>'noi',
                    'idba'=>$ba->IdBANoiT
                );

                $response=array(
                    'hd'=>$data,
                    'msg'=>$msg
                );
                return response()->json($response);
            }
        } catch (\Exception $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
   
    public function postXoa(Request $request){
        if(strpos($request->id, ',')){//gửi nhiều mã
            $arr= explode(',',$request->id);
            try{
                foreach ($arr as $a){
                    $hdngoai= hoa_don_dv_ngoai_tru::where("IdHDDVNgoai", $a)->get()->first();
                    $hdnoi= hoa_don_dv_noi_tru::where("IdHDDVNoi", $a)->get()->first();
                    if(is_object($hdngoai)){
                        $hdngoai->delete();
                    }
                    if(is_object($hdnoi)){
                        $hdnoi->delete();
                    }
                }
                $response = array(
                    'msg' => 'tc',
                );

                return response()->json($response); 
            } catch (\Exception $ex) {
                $err=$ex->getMessage();
                $response = array(
                    'msg' => $err
                );
                return response()->json($response); 
            }
        }
        else{
            try{
                $hdngoai= hoa_don_dv_ngoai_tru::where("IdHDDVNgoai", $request->id)->get()->first();
                $hdnoi= hoa_don_dv_noi_tru::where("IdHDDVNoi", $request->id)->get()->first();
                if(is_object($hdngoai)){
                    $hdngoai->delete();
                }
                if(is_object($hdnoi)){
                    $hdnoi->delete();
                }
                $response = array(
                    'msg' => 'tc',
                );
                return response()->json($response); 
            } catch (\Exception $ex) {
                $err=$ex->getMessage();
                $response = array(
                    'msg' => $err
                );
                return response()->json($response); 
            }
        } 
    }
    
    public static function TaoMaNNNgoai(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= hoa_don_dv_ngoai_tru::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $hd) {
                   if($hd->IdHDDVNgoai == $ran){
                        $ran= \comm_functions::BigRandomNumber(0000000001, 1000000000);
                        $flag=TRUE;
                        break;
                    }
                    else{
                        $flag=FALSE;
                    }  
                }
            }
        }

        return str_pad($ran, 10, 0, STR_PAD_LEFT); 
    }
    
    public static function TaoMaNNNoi(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= hoa_don_dv_noi_tru::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $hd) {
                   if($hd->IdHDDVNoi == $ran){
                        $ran= \comm_functions::BigRandomNumber(0000000001, 1000000000);
                        $flag=TRUE;
                        break;
                    }
                    else{
                        $flag=FALSE;
                    }  
                }
            }
        }

        return str_pad($ran, 10, 0, STR_PAD_LEFT); 
    }
    
    public function postTimKiem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $key=$request->keyWords;
            $ds_hd= DB::select("SELECT DISTINCT a.`Id`, a.`LoaiBA` FROM(
    (SELECT DISTINCT hd.`IdHDDVNgoai` AS Id, CASE WHEN 1 = 1 THEN 0 END AS LoaiBA, pdk.`KhamBHYT`, bsdt.`TenNV`, bn.`HoTen`, hd.`created_at`, kt.`IdNV` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN hoa_don_dv_ngoai_tru AS hd ON hd.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN nhan_vien AS bsdt ON bsdt.`IdNV` = ba.`IdNV` JOIN nhan_vien AS kt ON kt.`IdNV` = hd.`IdNVLap`)

    UNION ALL

    (SELECT DISTINCT hd.`IdHDDVNoi` AS Id, CASE WHEN 1 = 1 THEN 1 END AS LoaiBA, pdk.`KhamBHYT`, bsdt.`TenNV`, bn.`HoTen`, hd.`created_at`, kt.`IdNV` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN hoa_don_dv_noi_tru AS hd ON hd.`IdBANoiT` = ba.`IdBANoiT` JOIN nhan_vien AS bsdt ON bsdt.`IdNV` = ba.`IdNV` JOIN nhan_vien AS kt ON kt.`IdNV` = hd.`IdNVLap`)

) AS a WHERE a.`IdNV` = N'".$idnv."' AND ((a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Ngoại trú' ELSE N'Nội trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`KhamBHYT` = 0 THEN N'Bảo hiểm y tế bhyt' ELSE N'tp Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`Id`, a.`LoaiBA` ORDER BY a.created_at DESC");
            $dshd = array();
            $sl=0;
            if(!empty($ds_hd)){
                foreach ($ds_hd as $hd){
                    $hoadon= hoa_don_dv_noi_tru::where("IdHDDVNoi", $hd->Id)->get()->first();
                    $ba='';$idba='';$id='';$htdt='';$loaiba='';$bsdt='';$dttn='BHYT';
                    if(is_object($hoadon)){
                        $ba=$hoadon->benhAnNoiTru;$htdt='Nội trú';$loaiba='noi';
                        $idba=$hoadon->benhAnNoiTru->IdBANoiT;
                        $id=$hoadon->IdHDDVNoi;
                        $bsdt=$ba->nhanVien->TenNV;
                        if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                            $dttn='Thu phí';
                        }
                    }
                    
                    if($hd->LoaiBA == 0){
                        $hoadon= hoa_don_dv_ngoai_tru::where("IdHDDVNgoai", $hd->Id)->get()->first();
                        $ba=$hoadon->benhAnNgoaiTru;$htdt='Ngoại trú';$loaiba='ngoai';
                        $idba=$hoadon->benhAnNgoaiTru->IdBANgoaiT;
                        $id=$hoadon->IdHDDVNgoai;
                        $bsdt=$ba->nhanVien->TenNV;
                        if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                            $dttn='Thu phí';
                        }
                    }
                    
                    $tthd=array(
                        'shd'=>$id,//
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,//
                        'ngaylap'=> \comm_functions::deDateFormat($hoadon->created_at),
                        'idba'=>$idba,
                        'htdt'=>$htdt,
                        'loaiba'=>$loaiba,
                        'bsdt'=>$bsdt,
                        'dttn'=>$dttn
                    );
                    $dshd[]=$tthd;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dshd'=>$dshd,
                'sl' => $sl
            );

            return response()->json($response); 
        } catch (QueryException $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
    
    public function postLayDS(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $dshdngoai= hoa_don_dv_ngoai_tru::where('IdNVLap', $idnv)->orderBy('created_at', 'DESC')->get();
        
            $dshdnoi= hoa_don_dv_noi_tru::where('IdNVLap', $idnv)->orderBy('created_at', 'DESC')->get();
            
            $dshd=array();

            foreach ($dshdngoai as $value) {
                $dshd[]=$value;
            }

            foreach ($dshdnoi as $value) {
                $dshd[]=$value;
            }
            $re=[];
            foreach ($dshd as $val) {
                $ba='';$idba='';$id='';$htdt='';$loaiba='';$bsdt='';$dttn='BHYT';
                if(is_object($val->benhAnNoiTru)){
                    $ba=$val->benhAnNoiTru;$htdt='Nội trú';$loaiba='noi';
                    $idba=$val->benhAnNoiTru->IdBANoiT;
                    $id=$val->IdHDDVNoi;
                    $bsdt=$ba->nhanVien->TenNV;
                    if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                }

                else if(is_object($val->benhAnNgoaiTru)){
                    $ba=$val->benhAnNgoaiTru;$htdt='Ngoại trú';$loaiba='ngoai';
                    $idba=$val->benhAnNgoaiTru->IdBANgoaiT;
                    $id=$val->IdHDDVNgoai;
                    $bsdt=$ba->nhanVien->TenNV;
                    if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                }

                $tthd=array(
                    'shd'=>$id,//
                    'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,//
                    'ngaylap'=> \comm_functions::deDateFormat($val->created_at),
                    'idba'=>$idba,
                    'htdt'=>$htdt,
                    'loaiba'=>$loaiba,
                    'bsdt'=>$bsdt,
                    'dttn'=>$dttn
                );
                $re[]=$tthd;
            }
            $response = array(
                'msg' => 'tc',
                'dshd'=>$re
            );

            return response()->json($response); 
        } catch (\Exception $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
}
