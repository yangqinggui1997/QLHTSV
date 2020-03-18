<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\TiepDon\phieu_dk_kham;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_ngoai_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vp_ngoai_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vp_noi_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc;
use App\Models\KhamVaDieuTri\toa_thuoc_vs_benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru_vs_can_lam_sang;
use App\Models\KhamVaDieuTri\chi_dinh_tt_vs_benh_an_ngoai_tru;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;

class phieuKeKhaiVPNgoaiTruController extends Controller
{
    //
    
    public function getDanhSach(){
        $dspkk=array();
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $dsbangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        foreach ($dsbangoai as $value){
            if(is_object($value->phieuKKVPNgoaiTru)){
                $dspkk[]=$value->phieuKKVPNgoaiTru;
            }
        }
        $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        foreach ($dsbanoi as $value){
            if(is_object($value->phieuKeKhaiVP)){
                $dspkk[]=$value->phieuKeKhaiVP;
            }
        }
        $dscho= ba_nv::where('IdNV',$idnv)->orderBy('created_at', 'DESC')->get();
        
        $dsbachotn=array();
        foreach($dscho as $tn){
            $banoi= benh_an_noi_tru::where('IdBANoiT', $tn->IdBANoiT)->get()->first();
            
            if(is_object($banoi)){
                $dsbachotn[]=$banoi;
            }
        }

        $dsbc= thong_ke::where([['PhanLoai','grv'], ['IdNV', '<>', $idnv]])->get();
        $sl=[];
        foreach ($dsbc as $value) {
            # code...
            $f=FALSE;
            foreach($value->duyetTK as $d){
                if($d->IdNV == $idnv){
                    $f=TRUE;
                    break;
                }
            }
            if($f==FALSE){
                $sl[]=$value;
            }
        }
        
        return view("kham_vs_dieu_tri.phieu_ke_khai_vp", ['dspkk'=>$dspkk, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    
    public function postKTLapPhieuNgoai(Request $request){
        try{
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
            $flag=FALSE;$dspk=array();
            if(is_object($ba)){
                if(is_object($ba->phieuDKKham)){
                    $bn=$ba->phieuDKKham->phieuDKKham->benhNhan;
                    $phieudk= phieu_dk_kham::where('IdBN', $bn->IdBN)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->get();
                    if(count($phieudk) > 1 && date('Y-m-d', strtotime($ba->created_at)) == date('Y-m-d')){
                        foreach ($phieudk as $pdk){
                            if(!is_object($pdk->benhAnNgoaiTru)){
                                $flag=TRUE;
                                $dspk[]=$pdk->phongKham->Khoa->TenKhoa;
                            }
                        }
                    }
                }
            }
            $response=array(
                'msg'=>$flag,
                'dspk'=>$dspk
            );
            return response()->json($response);
        }
        catch(\Exception $ex){
            $err=$ex->getMessage();
            $response=array(
                'msg'=>$err
            );

            return response()->json($response);
        }
    }
    
    public function postIn(Request $request){
        try {
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
            $msg='tc';$arr_kb=[];$arr_xn=[];$arr_cdha=[];$arr_tdcn=[];$arr_thuoc=[];$arr_tt=[];$data_to_print='';
            $tttbv_ts=0;$tttbhyt_ts=0;$tqbhyt_ts=0;$tnbcct_ts=0;$tnbtt_ts=0;$tbntu=0;
            
            $pkekhai='';
            if(is_object($ba)){
                $bn=$ba->phieuDKKham->phieuDKKham->benhNhan;
                $pdk=$ba->phieuDKKham->phieuDKKham;

                $kb='';$tt='';$xn='';$cdha='';$tdcn='';$thuoc='';
                $flag_xn=FALSE;$flag_cdha=FALSE;$flag_tdcn=FALSE;$flag_thuoc=FALSE;$flag_tt=FALSE;
                $tttbv_kb=0;$tttbhyt_kb=0;$tqbhyt_kb=0;$tnbcct_kb=0;
                $tttbv_xn=0;$tttbhyt_xn=0;$tqbhyt_xn=0;$tnbcct_xn=0;$tnbtt_xn=0;
                $tttbv_cdha=0;$tttbhyt_cdha=0;$tqbhyt_cdha=0;$tnbcct_cdha=0;$tnbtt_cdha=0;
                $tttbv_tdcn=0;$tttbhyt_tdcn=0;$tqbhyt_tdcn=0;$tnbcct_tdcn=0;$tnbtt_tdcn=0;
                $tttbv_thuoc=0;$tttbhyt_thuoc=0;$tqbhyt_thuoc=0;$tnbcct_thuoc=0;$tnbtt_thuoc=0;
                $tttbv_tt=0;$tttbhyt_tt=0;$tqbhyt_tt=0;$tnbcct_tt=0;$tnbtt_tt=0;
                $tttbv=0;$tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;
                
                $dsba=[];$i_kb=1;$i_thuoc=1;$i_xn=1;$i_cdha=1;$i_tdcn=1;$i_tt=1;
                
                $dspdk= phieu_dk_kham::where('IdBN', $bn->IdBN)->whereDate('created_at', 'like', '%'.date('Y-m-d', strtotime($ba->created_at)).'%')->get();
                $flagpkk=FALSE;
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
                                $pkkct->IdPKKCT= phieuKeKhaiVPNgoaiTruController::TaoMaNNCT();
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
                                
                                $thuoc='<tr><td class="text-left">'.$i_thuoc.'. '.$dmt_vs_pkk->danhMucThuoc->TenThuoc.'</td>
                                    <td class="text-left">'.$dmt_vs_pkk->danhMucThuoc->DonViTinh.'</td>
                                    <td class="text-center">'.number_format($dmt_vs_pkk->SL).'</td>
                                    <td>'.number_format($dmt_vs_pkk->danhMucThuoc->DonGiaBan).'</td>
                                    <td>'.number_format($dmt_vs_pkk->danhMucThuoc->DonGiaBan).'</td>
                                    <td>100</td>
                                    <td>'.number_format($dg_sl).'</td>';
                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1) ){
                                        $tttbhyt=($dmt_vs_pkk->danhMucThuoc->BHYTTT / 100)*$dg_sl;
                                        $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        $tnbtt=$dg_sl - $tttbhyt;
                                        $thuoc.='<td>'.$dmt_vs_pkk->danhMucThuoc->BHYTTT.'</td>
                                          <td>'.number_format($tttbhyt).'</td>
                                          <td>'.number_format($ttqbhyt).'</td>
                                          <td>'.number_format($tnbcct).'</td>
                                          <td></td>
                                          <td>'.number_format($tnbtt).'</td></tr>';
                                        $tqbhyt_thuoc+=$ttqbhyt; $tnbcct_thuoc+=$tnbcct; $tttbhyt_thuoc+=$tttbhyt; $tnbtt_thuoc+=$tnbtt;
                                    }
                                    else{
                                        $thuoc.='<td>0</td>
                                          <td></td>
                                          <td></td>
                                          <td>'.number_format($dg_sl).'</td>
                                          <td></td>
                                          <td></td></tr>';
                                        $tnbcct_thuoc+=$dg_sl;
                                    }
                                }
                                else{
                                    $thuoc.='<td>0</td>
                                          <td></td>
                                          <td></td>
                                          <td>'.number_format($dg_sl).'</td>
                                          <td></td>
                                          <td></td></tr>';
                                        $tnbcct_thuoc+=$dg_sl;
                                }
                                $arr_thuoc[]=$thuoc;
                                $i_thuoc++;
                            }
                        }
                        
                        //cls
                        $cls_vs_ba= benh_an_ngoai_tru_vs_can_lam_sang::where('IdBANgoaiT', $ba->IdBANgoaiT)->get();
                        if(is_object($cls_vs_ba)){
                            foreach ($cls_vs_ba as $value) {
                                //thêm chi tiết
                                $pkkct= new phieu_ke_khai_vpct_ngoai_tru;
                                $pkkct->IdPKKCT= phieuKeKhaiVPNgoaiTruController::TaoMaNNCT();
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
                                    $xn='<tr><td class="text-left">'.$i_xn.'. '.$dmcls_vs_pkk->danhMucCLS->TenCLS.'</td>
                                        <td class="text-left">'.$dmcls_vs_pkk->danhMucCLS->DonViTinh.'</td>
                                        <td class="text-center">1</td>
                                        <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                        <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                        <td>100</td>
                                        <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>';
                                    if($pdk->KhamBHYT == 0){
                                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                            $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                            $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                            $tnbcct= $tttbhyt - $ttqbhyt;
                                            
                                            $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;
                                            $xn.='<td>'.$dmcls_vs_pkk->danhMucCLS->BHYTTT.'</td>
                                              <td>'.number_format($tttbhyt).'</td>
                                              <td>'.number_format($ttqbhyt).'</td>
                                              <td>'.number_format($tnbcct).'</td>
                                              <td></td>
                                              <td>'.number_format($tnbtt).'</td></tr>';
                                            $tqbhyt_xn+=$ttqbhyt; $tnbcct_xn+=$tnbcct; $tttbhyt_xn+=$tttbhyt; $tnbtt_xn+=$tnbtt;
                                            $tbntu+= ($tnbcct + $tnbtt) / 2;
                                        }
                                        else{
                                            $xn.='<td>0</td>
                                              <td></td>
                                              <td></td>
                                              <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                              <td></td>
                                              <td></td></tr>';
                                            $tnbcct_xn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                        }
                                    }
                                    else{
                                        $xn.='<td>0</td>
                                              <td></td>
                                              <td></td>
                                              <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                              <td></td>
                                              <td></td></tr>';
                                            $tnbcct_xn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                    }
                                    $arr_xn[]=$xn;
                                    $i_xn++;
                                }
                                else if($dmcls_vs_pkk->danhMucCLS->TenKDau == 'chuan_doan_hinh_anh'){
                                    $tttbv_cdha+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                    $flag_cdha=TRUE;
                                    $cdha='<tr><td class="text-left">'.$i_cdha.'. '.$dmcls_vs_pkk->danhMucCLS->TenCLS.'</td>
                                        <td class="text-left">'.$dmcls_vs_pkk->danhMucCLS->DonViTinh.'</td>
                                        <td class="text-center">1</td>
                                        <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                        <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                        <td>100</td>
                                        <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>';
                                    if($pdk->KhamBHYT == 0){
                                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                            
                                            $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                            $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                            $tnbcct= $tttbhyt - $ttqbhyt;
                                            
                                            $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;
                                            $cdha.='<td>'.$dmcls_vs_pkk->danhMucCLS->BHYTTT.'</td>
                                              <td>'.number_format($tttbhyt).'</td>
                                              <td>'.number_format($ttqbhyt).'</td>
                                              <td>'.number_format($tnbcct).'</td>
                                              <td></td>
                                              <td>'.number_format($tnbtt).'</td></tr>';
                                            $tqbhyt_cdha+=$ttqbhyt; $tnbcct_cdha+=$tnbcct; $tttbhyt_cdha+=$tttbhyt; $tnbtt_cdha+=$tnbtt;
                                            $tbntu+= ($tnbcct + $tnbtt) / 2;
                                        }
                                        else{
                                            $cdha.='<td>0</td>
                                              <td></td>
                                              <td></td>
                                              <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                              <td></td>
                                              <td></td></tr>';
                                            $tnbcct_cdha+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                        }
                                    }
                                    else{
                                        $cdha.='<td>0</td>
                                              <td></td>
                                              <td></td>
                                              <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                              <td></td>
                                              <td></td></tr>';
                                            $tnbcct_cdha+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                    }
                                    $arr_cdha[]=$cdha;
                                    $i_cdha++;
                                }
                                else if($dmcls_vs_pkk->danhMucCLS->TenKDau == 'tham_do_chuc_nang'){
                                    $tttbv_tdcn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                    $flag_tdcn=TRUE;
                                    $tdcn='<tr><td class="text-left">'.$i_tdcn.'. '.$dmcls_vs_pkk->danhMucCLS->TenCLS.'</td>
                                        <td class="text-left">'.$dmcls_vs_pkk->danhMucCLS->DonViTinh.'</td>
                                        <td class="text-center">1</td>
                                        <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                        <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                        <td>100</td>
                                        <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>';
                                    if($pdk->KhamBHYT == 0){
                                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                            $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                            $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                            $tnbcct= $tttbhyt - $ttqbhyt;
                                            
                                            $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;
                                            $tdcn.='<td>'.$dmcls_vs_pkk->danhMucCLS->BHYTTT.'</td>
                                              <td>'.number_format($tttbhyt).'</td>
                                              <td>'.number_format($ttqbhyt).'</td>
                                              <td>'.number_format($tnbcct).'</td>
                                              <td></td>
                                              <td>'.number_format($tnbtt).'</td></tr>';
                                            $tqbhyt_tdcn+=$ttqbhyt; $tnbcct_tdcn+=$tnbcct; $tttbhyt_tdcn+=$tttbhyt; $tnbtt_tdcn+=$tnbtt;
                                            $tbntu+= ($tnbcct + $tnbtt) / 2;
                                        }
                                        else{
                                            $tdcn.='<td>0</td>
                                              <td></td>
                                              <td></td>
                                              <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                              <td></td>
                                              <td></td></tr>';
                                            $tnbcct_tdcn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                        }
                                    }
                                    else{
                                        $tdcn.='<td>0</td>
                                              <td></td>
                                              <td></td>
                                              <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                              <td></td>
                                              <td></td></tr>';
                                            $tnbcct_tdcn+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                            $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                    }
                                    $arr_tdcn[]=$tdcn;
                                    $i_tdcn++;
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
                                $pkkct->IdPKKCT= phieuKeKhaiVPNgoaiTruController::TaoMaNNCT();
                                $pkkct->IdPKK=$pkekhai->IdPKK;
                                $pkkct->save();
                                
                                //thêm trên bảng quan hệ phiếu chi tiết với các danh mục
                                $dmcls_vs_pkk= new phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls;
                                $dmcls_vs_pkk->IdDMCLS= $value->chiDinhTT->danhMucCLS->IdDMCLS;
                                $dmcls_vs_pkk->IdPKKCT=$pkkct->IdPKKCT;
                                $dmcls_vs_pkk->SL=1;
                                $dmcls_vs_pkk->save();

                                $tttbv_tt+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                
                                $tt='<tr><td class="text-left">'.$i_tt.'. '.$dmcls_vs_pkk->danhMucCLS->TenCLS.'</td>
                                    <td class="text-left">'.$dmcls_vs_pkk->danhMucCLS->DonViTinh.'</td>
                                    <td class="text-center">1</td>
                                    <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                    <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                    <td>100</td>
                                    <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>';
                                if($pdk->KhamBHYT == 0){
                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                        $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                        $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                        $tnbcct= $tttbhyt - $ttqbhyt;
                                        
                                        $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;
                                        $tt.='<td>'.$dmcls_vs_pkk->danhMucCLS->BHYTTT.'</td>
                                          <td>'.number_format($tttbhyt).'</td>
                                          <td>'.number_format($ttqbhyt).'</td>
                                          <td>'.number_format($tnbcct).'</td>
                                          <td></td>
                                          <td>'.number_format($tnbtt).'</td></tr>';
                                        $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                        $tbntu+= ($tnbcct + $tnbtt) / 2;
                                    }
                                    else{
                                        $tt.='<td>0</td>
                                          <td></td>
                                          <td></td>
                                          <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                          <td></td>
                                          <td></td></tr>';
                                        $tnbcct_tt+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                        $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                    }
                                }
                                else{
                                    $tt.='<td>0</td>
                                          <td></td>
                                          <td></td>
                                          <td>'.number_format($dmcls_vs_pkk->danhMucCLS->DonGia).'</td>
                                          <td></td>
                                          <td></td></tr>';
                                        $tnbcct_tt+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                        $tbntu+=$dmcls_vs_pkk->danhMucCLS->DonGia / 2;
                                }
                                $arr_tt[]=$tt;
                                $i_tt++;
                            }
                        }
                        
                        //khám bệnh
                        if($i_kb == 1){
                            $tttbv_kb=33000;
                            $kb='<tr><td class="text-left"> 1. Khám '.$ba->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.'</td>
                                <td class="text-left">Lần</td>
                                <td class="text-center">1</td>
                                <td>33,000</td>
                                <td>33,000</td>
                                <td>100</td>
                                <td>33,000</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $ttqbhyt=33000*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct=33000 - $ttqbhyt;
                                    $kb.='<td>100</td>
                                      <td>33,000</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tqbhyt_kb+=$ttqbhyt; $tnbcct_kb+=$tnbcct; $tttbhyt_kb=33000;
                                }
                                else{
                                    $kb.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>33,000</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tnbcct_kb+=33000;
                                }
                            }
                            else{
                                $kb.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>33,000</td>
                                      <td></td>
                                      <td></td></tr>';
                                $tnbcct_kb+=33000;
                            }
                        }
                        else if($i_kb >=2 && $i_kb <= 4){
                            $tttbv_kb+=33000;
                            $kb='<tr><td class="text-left">'.$i_kb.'. Khám '.$ba->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.'</td>
                                <td class="text-left">Lần</td>
                                <td class="text-center">1</td>
                                <td>33,000</td>
                                <td>33,000</td>
                                <td>30</td>
                                <td>33,000</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $tqbhyt=9900*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct=9900 - $tqbhyt;
                                    $kb.='<td>100</td>
                                      <td>9,900</td>
                                      <td>'.number_format($tqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tqbhyt_kb+=$tqbhyt;$tnbcct_kb+=$tnbcct;$tttbhyt_kb+=9900;
                                }
                                else{
                                    $kb.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>9,900</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tnbcct_kb+=9900;
                                }
                            }
                            else{
                                $kb.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>9,900</td>
                                      <td></td>
                                      <td></td></tr>';
                                $tnbcct_kb+=9900;
                            }
                        }
                        else if($i_kb == 5){
                            $tttbv_kb+=33000;
                            $kb='<tr><td class="text-left">'.$i_kb.'. Khám '.$ba->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.'</td>
                                <td class="text-left">Lần</td>
                                <td class="text-center">1</td>
                                <td>33,000</td>
                                <td>33,000</td>
                                <td>10</td>
                                <td>33,000</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $tqbhyt=3300*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct=3300 - $tqbhyt;
                                    $kb.='<td>100</td>
                                      <td>3,300</td>
                                      <td>'.number_format($tqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tqbhyt_kb+=$tqbhyt;$tnbcct_kb+=$tnbcct; $tttbhyt_kb+=3300;
                                }
                                else{
                                    $kb.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>3,300</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tnbcct_kb+=3300;
                                }
                            }
                            else{
                                $kb.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>3,300</td>
                                      <td></td>
                                      <td></td></tr>';
                                $tnbcct_kb+=3300;
                            }
                        }
                        else{
                            $kb='<tr><td class="text-left">'.$i_kb.'. Khám '.$ba->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.'</td>
                                <td class="text-left">Lần</td>
                                <td class="text-center">1</td>
                                <td>33,000</td>
                                <td>33,000</td>
                                <td>0</td>
                                <td>33,000</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $kb.='<td>100</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td></tr>';
                                }
                                else{
                                    $kb.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td></tr>';
                                }
                            }
                            else{
                                $kb.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td></tr>';
                            }
                        }
                        $arr_kb[]=$kb;
                        $i_kb++;
                    }
                }
                
                if($flag_thuoc == TRUE){
                    $tttbv=0;$tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;
                    if(is_numeric($tttbv_thuoc)){
                        $tttbv=number_format($tttbv_thuoc);
                    }
                    if(is_numeric($tttbhyt_thuoc)){
                        $tttbhyt=number_format($tttbhyt_thuoc);
                    }
                    if(is_numeric($tqbhyt_thuoc)){
                        $tqbhyt=number_format($tqbhyt_thuoc);
                    }
                    if(is_numeric($tnbcct_thuoc)){
                        $tnbcct=number_format($tnbcct_thuoc);
                    }
                    if(is_numeric($tnbtt_thuoc)){
                        $tnbtt=number_format($tnbtt_thuoc);
                    }
                    $thuoc='<tr><td colspan="6" class="text-left font-weight-bold2">08. THUỐC, DỊCH TRUYỀN</td>
                    <td class="font-weight-bold2">'.$tttbv.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tttbhyt.'</td>
                    <td class="font-weight-bold2">'.$tqbhyt.'</td>
                    <td class="font-weight-bold2">'.$tnbcct.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tnbtt.'</td></tr>';
                    $arr_t=[$thuoc];
                    $arr_thuoc= array_merge($arr_t, $arr_thuoc);
                }
                
                if($flag_xn == TRUE){
                    //có xét nghiệm
                    $tttbv=0;$tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;
                    if(is_numeric($tttbv_xn)){
                        $tttbv=number_format($tttbv_xn);
                    }
                    if(is_numeric($tttbhyt_xn)){
                        $tttbhyt=number_format($tttbhyt_xn);
                    }
                    if(is_numeric($tqbhyt_xn)){
                        $tqbhyt=number_format($tqbhyt_xn);
                    }
                    if(is_numeric($tnbcct_xn)){
                        $tnbcct=number_format($tnbcct_xn);
                    }
                    if(is_numeric($tnbtt_xn)){
                        $tnbtt=number_format($tnbtt_xn);
                    }
                    $xn='<tr><td colspan="6" class="text-left font-weight-bold2">03. XÉT NGHIỆM</td>
                    <td class="font-weight-bold2">'.$tttbv.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tttbhyt.'</td>
                    <td class="font-weight-bold2">'.$tqbhyt.'</td>
                    <td class="font-weight-bold2">'.$tnbcct.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tnbtt.'</td></tr>';
                    $arr_x=[$xn];
                    $arr_xn= array_merge($arr_x, $arr_xn);
                }
                
                if($flag_cdha == TRUE){
                    //có chuẩn đoán hình ảnh
                    $tttbv=0;$tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;
                    if(is_numeric($tttbv_cdha)){
                        $tttbv=number_format($tttbv_cdha);
                    }
                    if(is_numeric($tttbhyt_cdha)){
                        $tttbhyt=number_format($tttbhyt_cdha);
                    }
                    if(is_numeric($tqbhyt_cdha)){
                        $tqbhyt=number_format($tqbhyt_cdha);
                    }
                    if(is_numeric($tnbcct_cdha)){
                        $tnbcct=number_format($tnbcct_cdha);
                    }
                    if(is_numeric($tnbtt_cdha)){
                        $tnbtt=number_format($tnbtt_cdha);
                    }
                    $cdha='<tr><td colspan="6" class="text-left font-weight-bold2">04. CHUẨN ĐOÁN HÌNH ẢNH</td>
                    <td class="font-weight-bold2">'.$tttbv.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tttbhyt.'</td>
                    <td class="font-weight-bold2">'.$tqbhyt.'</td>
                    <td class="font-weight-bold2">'.$tnbcct.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tnbtt.'</td></tr>';
                    
                    $arr_c=[$cdha];
                    $arr_cdha= array_merge($arr_c, $arr_cdha);
                }
                
                if($flag_tdcn == TRUE){
                    //có thăm dò chức năng
                    $tttbv=0;$tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;
                    if(is_numeric($tttbv_tdcn)){
                        $tttbv=number_format($tttbv_tdcn);
                    }
                    if(is_numeric($tttbhyt_tdcn)){
                        $tttbhyt=number_format($tttbhyt_tdcn);
                    }
                    if(is_numeric($tqbhyt_tdcn)){
                        $tqbhyt=number_format($tqbhyt_tdcn);
                    }
                    if(is_numeric($tnbcct_tdcn)){
                        $tnbcct=number_format($tnbcct_tdcn);
                    }
                    if(is_numeric($tnbtt_tdcn)){
                        $tnbtt=number_format($tnbtt_tdcn);
                    }
                    $tdcn='<tr><td colspan="6" class="text-left font-weight-bold2">05. THĂM DÒ CHỨC NĂNG</td>
                    <td class="font-weight-bold2">'.$tttbv.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tttbhyt.'</td>
                    <td class="font-weight-bold2">'.$tqbhyt.'</td>
                    <td class="font-weight-bold2">'.$tnbcct.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tnbtt.'</td></tr>';
                    
                    $arr_td=[$tdcn];
                    $arr_tdcn= array_merge($arr_td, $arr_tdcn);
                }
                
                if($flag_tt == TRUE){
                    $tttbv=0;$tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;
                    if(is_numeric($tttbv_tt)){
                        $tttbv=number_format($tttbv_tt);
                    }
                    if(is_numeric($tttbhyt_tt)){
                        $tttbhyt=number_format($tttbhyt_tt);
                    }
                    if(is_numeric($tqbhyt_tt)){
                        $tqbhyt=number_format($tqbhyt_tt);
                    }
                    if(is_numeric($tnbcct_tt)){
                        $tnbcct=number_format($tnbcct_tt);
                    }
                    if(is_numeric($tnbtt_tt)){
                        $tnbtt=number_format($tnbtt_tt);
                    }
                    $tt='<tr><td colspan="6" class="text-left font-weight-bold2">06. THỦ THUẬT, PHẪU THUẬT</td>
                    <td class="font-weight-bold2">'.$tttbv.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tttbhyt.'</td>
                    <td class="font-weight-bold2">'.$tqbhyt.'</td>
                    <td class="font-weight-bold2">'.$tnbcct.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tnbtt.'</td></tr>';

                    $arr_thuthuat=[$tt];
                    $arr_tt= array_merge($arr_thuthuat, $arr_tt);
                }

                $tttbv=0;$tttbhyt=0;$tqbhyt=0;$tnbcct=0;
                
                if(is_numeric($tttbv_kb)){
                    $tttbv=number_format($tttbv_kb);
                }
                if(is_numeric($tttbhyt_kb)){
                    $tttbhyt=number_format($tttbhyt_kb);
                }
                if(is_numeric($tqbhyt_kb)){
                    $tqbhyt=number_format($tqbhyt_kb);
                }
                if(is_numeric($tnbcct_kb)){
                    $tnbcct=number_format($tnbcct_kb);
                }
                $kb='<tr><td colspan="6" class="text-left font-weight-bold2">01. KHÁM BỆNH</td>
                    <td class="font-weight-bold2">'.$tttbv.'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.$tttbhyt.'</td>
                    <td class="font-weight-bold2">'.$tqbhyt.'</td>
                    <td class="font-weight-bold2">'.$tnbcct.'</td>
                    <td></td>
                    <td class="font-weight-bold2">0</td></tr>';
                $arr_k=[$kb];
                $arr_kb= array_merge($arr_k, $arr_kb);

                $tttbv_ts= $tttbv_kb + $tttbv_xn + $tttbv_cdha + $tttbv_tdcn + $tttbv_tt + $tttbv_thuoc;
                $tttbhyt_ts=$tttbhyt_kb + $tttbhyt_xn +$tttbhyt_cdha + $tttbhyt_tdcn + $tttbhyt_thuoc + $tttbhyt_tt;
                $tqbhyt_ts= $tqbhyt_kb + $tqbhyt_xn + $tqbhyt_cdha + $tqbhyt_tdcn + $tqbhyt_thuoc + $tqbhyt_tt;
                $tnbcct_ts= $tnbcct_kb + $tnbcct_xn + $tnbcct_cdha + $tnbcct_tdcn + $tnbcct_thuoc + $tnbcct_tt;
                $tnbtt_ts= $tnbtt_xn + $tnbtt_cdha + $tnbtt_tdcn + $tnbtt_thuoc + $tnbtt_tt;
                
                $ts='<tr><td colspan="6" class="text-center font-weight-bold2">Tổng cộng</td>
                    <td class="font-weight-bold2">'.number_format($tttbv_ts).'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.number_format($tttbhyt_ts).'</td>
                    <td class="font-weight-bold2">'.number_format($tqbhyt_ts).'</td>
                    <td class="font-weight-bold2">'.number_format($tnbcct_ts).'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.number_format($tnbtt_ts).'</td></tr>';
                $arr_tc=[$ts];
                
                $data_to_print= array_merge($arr_kb, $arr_xn);
                $data_to_print=array_merge($data_to_print, $arr_cdha);
                $data_to_print=array_merge($data_to_print, $arr_tdcn);
                $data_to_print=array_merge($data_to_print, $arr_tt);
                $data_to_print=array_merge($data_to_print, $arr_thuoc);
                $data_to_print=array_merge($data_to_print, $arr_tc);
            }
            else{
                $msg='ktt';
                
                $response=array(
                    'msg'=>$msg
                );
                return response()->json($response);
            }
            
            //lấy thông tin liên quan đến bệnh nhân
            $benhan= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
            $benhnhan=$benhan->phieuDKKham->phieuDKKham->benhNhan;
            $nv= $benhan->nhanVien;
            $ngaydt= $benhan->phieuDKKham->phieuDKKham;

            $tuyen=TRUE;$noichuyenden='';
            $ngaybd='';$ngayketthuc='';$ngaykt='';
            if(is_object($ngaydt)){
                if($ngaydt->TuyenKham != 0){
                    $tuyen=FALSE;
                }
                else{
                    if($ngaydt->KhamBHYT == 0 && $ngaydt->GiayChuyen == 1){
                        $noichuyenden=$benhnhan->theBHYT->coSoKhamBHYT->TenCS;
                    }
                }
                $ngaybd=date('d/m/Y', strtotime($ngaydt->created_at));
                
                $ngaydt=date('H', strtotime($ngaydt->created_at)).' giờ '.date('i', strtotime($ngaydt->created_at)).' phút, ngày '.date('d/m/Y', strtotime($ngaydt->created_at));
                if($pkekhai != ''){
                    $ngayketthuc=date('d/m/Y', strtotime($pkekhai->created_at));
                    $ngaykt=date('H', strtotime($pkekhai->created_at)).' giờ '.date('i', strtotime($pkekhai->created_at)).' phút, ngày '.date('d/m/Y', strtotime($pkekhai->created_at));
                }
                else{
                    $ngayketthuc=$ngaybd;
                    $ngaykt=$ngaydt;
                }
            }
            else{
                $ngaydt=date('H').' giờ '.date('i').' phút, ngày '.date('d/m/Y');
                $ngaybd=date('d/m/Y');
                $ngayketthuc=date('d/m/Y');
                $ngaykt=$ngaydt;
            }
            
            
            $noichuyendi='';
            if(is_object($benhan->GiayChuyen)){
                $noichuyendi=$benhan->GiayChuyen->NoiChuyen;
            }
            $tang='TRIỆT';
            if($tang != 0){
                $tang='LẦU '.$nv->phongBan->Tang;
            }
            $pk='P.KHÁM '.mb_convert_case($nv->phongBan->Khoa->TenKhoa, MB_CASE_UPPER, 'utf-8').' ( '.$nv->phongBan->SoPhong.' - '.$tang.' )';
            $bare_code_mabn=\Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($benhnhan->IdBN, "C128", 1.3, 25);
            
            
            $ngaysinh=date( "m/d/Y", strtotime( $benhnhan->NgaySinh ));
            $gt='Nam';
            if($benhnhan->GioiTinh == 0){
                $gt='Nữ';
            }
            $mathe='koco';$ngaydk='';$ngayhh='';$tencsk='';$macsk=''; $mh='';
            if(is_object($benhnhan->theBHYT)){
                $mathe=$benhnhan->theBHYT->IdTheBHYT.' - '. substr($benhnhan->theBHYT->IdTheBHYT, 3, 2).$benhnhan->theBHYT->coSoKhamBHYT->IdCSKBHYT;
                $ngaydk=date( "m/d/Y", strtotime( $benhnhan->theBHYT->NgayDK ));
                $ngayhh=date( "m/d/Y", strtotime( $benhnhan->theBHYT->NgayHH ));
                $tencsk=$benhnhan->theBHYT->coSoKhamBHYT->TenCS;
                $macsk=$benhnhan->theBHYT->coSoKhamBHYT->IdCSKBHYT;
                $mh=$benhnhan->theBHYT->BHYTHoTro.'%';
            }
            $diachi="";
            if($benhnhan->DiaChi == ''){
                $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            else{
                $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            $chuandoan='';$i=1;$mabenh='';
            foreach ($benhan->chuanDoan as $cd) {
                if($i == count($benhan->chuanDoan))
                {
                    $chuandoan.=$cd->danhMucBenh->TenBenh;
                    $mabenh.=$cd->danhMucBenh->IdBenh;
                }
                else{
                    $chuandoan.=$cd->danhMucBenh->TenBenh.';&nbsp';
                    $mabenh.=$cd->danhMucBenh->IdBenh.';&nbsp';
                }

                $i++;
            }
            $ghichutoa='';
            if($benhan->GhiChu != ''){
                $ghichutoa=$benhan->GhiChu;
            }
            $bn= array(
                'hoten'=>$benhnhan->HoTen,
                'pk'=>$pk,
                'barcode'=>$bare_code_mabn,
                'mabn'=>$benhnhan->IdBN,
                'ngaysinh'=>$ngaysinh,
                'gt'=>$gt,
                'mathe'=>$mathe,
                'tungay'=>$ngaydk,
                'denngay'=>$ngayhh,
                'diachi'=>$diachi,
                'chuandoan'=>$chuandoan,
                'ghichutoa'=>$ghichutoa,
                'nv'=>$nv->TenNV,
                'tenkhoa'=>$nv->phongBan->Khoa->TenKhoa,
                'skb'=> 'TN.'.substr($benhnhan->IdBN, 0, 4).'.'.substr($benhan->phieuDKKham->phieuDKKham->IdPhieuDKKB, 3, 7),
                'makhoa'=>$nv->phongBan->Khoa->IdKhoa,
                'tencsk'=>$tencsk,
                'macsk'=>$macsk,
                'ngaydt'=>$ngaydt,
                'ngaykt'=>$ngaykt,
                'tuyen'=>$tuyen,
                'giaychuyenden'=>$noichuyenden,
                'giaychuyendi'=>$noichuyendi,
                'mabenh'=>$mabenh,
                'tongcp'=>number_format($tttbv_ts),
                'tongbh'=>number_format($tqbhyt_ts),
                'tongbncungtra'=>number_format($tnbcct_ts),
                'tongbntutra'=>number_format($tnbtt_ts),
                'bntamung'=>number_format($tbntu),
                'tongtien'=>number_format(($tnbcct_ts + $tnbtt_ts) - $tbntu),
                'namsinh'=>date('Y', strtotime($benhnhan->NgaySinh)),
                'ngaybd'=>$ngaybd,
                'ngayketthuc'=>$ngayketthuc,
                'mh'=>$mh
            );
            
            $response=array(
                'data'=>$data_to_print,
                'bn'=>$bn,
                'msg'=>$msg
            );
            return response()->json($response);
        } catch (\Exception $ex) {
            $err=$ex->getMessage();
            
            $response=array(
                'msg'=>$err
            );
            
            return response()->json($response);
        }
    }

    public static function TaoMaNN(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= phieu_ke_khai_vp_ngoai_tru::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $pkk ){
                   if($pkk->IdPKK == $ran){
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
    
    public static function TaoMaNNCT(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= phieu_ke_khai_vpct_ngoai_tru::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $pkk ){
                   if($pkk->IdPKKCT == $ran){
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

    public function postXoa(Request $request){
        if(strpos($request->id, ',')){//gửi nhiều mã
            $arr= explode(',',$request->id);
            try{
                foreach ($arr as $a){
                    $pkkngoai= phieu_ke_khai_vp_ngoai_tru::where("IdPKK", $a)->get()->first();
                    $pkknoi= phieu_ke_khai_vp_noi_tru::where("IdPKK", $a)->get()->first();
                    if(is_object($pkknoi)){
                        $pkknoi->delete();
                    }
                    if(is_object($pkkngoai)){
                        $pkkngoai->delete();
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
                $pkkngoai= phieu_ke_khai_vp_ngoai_tru::where("IdPKK", $request->id)->get()->first();
                $pkknoi= phieu_ke_khai_vp_noi_tru::where("IdPKK", $request->id)->get()->first();
                if(is_object($pkknoi)){
                    $pkknoi->delete();
                }
                if(is_object($pkkngoai)){
                    $pkkngoai->delete();
                }
                
                $response = array(
                    'msg' => 'tc'
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
    
    public function postLayDS(Request $request){
        try{
            $dspkk=array();
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;

            $dsbangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach ($dsbangoai as $value){
                if(is_object($value->phieuKKVPNgoaiTru)){
                    $dspkk[]=$value->phieuKKVPNgoaiTru;
                }
            }
            $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach ($dsbanoi as $value){
                if(is_object($value->phieuKeKhaiVP)){
                    $dspkk[]=$value->phieuKeKhaiVP;
                }
            }
            
            $ds_pkk=[];
            foreach ($dspkk as $pkk){
                $ba='';
                $htdt='';$songaydt='';$idba='';$loaiba='noi';
                if(is_object($pkk->benhAnNoiTru)){
                    $ba=$pkk->benhAnNoiTru;
                    $htdt='Nội trú';
                    $present= date_create(date('Y-m-d', strtotime($pkk->created_at)));
                    $timeba= date_create(date('Y-m-d', strtotime($ba->created_at)));
                    $t= date_diff($timeba, $present);
                    $songaydt=$t->format('%a') + 1;
                    $idba=$ba->IdBANoiT;
                }
                else if(is_object($pkk->benhAnNgoaiTru)){
                    $ba=$pkk->benhAnNgoaiTru;
                    $htdt='Ngoại trú';
                    $songaydt=1;
                    $idba=$ba->IdBANgoaiT;
                    $loaiba='ngoai';
                }
                $dttn='BHYT';
                if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                $chuandoan='';
                $i=1;
                foreach ($ba->chuanDoan as $cd){
                    if($i == count($ba->chuanDoan)){
                        $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                    }
                    else{
                        $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                    }
                    $i++;
                }
                $ttpkk=array(
                    'id'=>$pkk->IdPKK,
                    'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                    'dttn'=>$dttn,
                    'htdt'=>$htdt,
                    'chuandoan'=>$chuandoan,
                    'ngaylap'=> \comm_functions::deDateFormat($pkk->created_at),
                    'songaydt'=>$songaydt,
                    'idba'=>$idba,
                    'loaiba'=>$loaiba
                );
                $ds_pkk[]=$ttpkk;
            }
            $response = array(
                'msg' => 'tc',
                'pkk'=>$ds_pkk
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
    
    public function postTimKiem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $key=$request->keyWords;
            $ds_pkk= DB::select("SELECT DISTINCT a.`IdPKK` FROM(
(select nv.`IdNV`, pkk.`IdPKK`, bn.`HoTen`, pdk.`KhamBHYT`, dmb.`TenBenh`, CASE WHEN 1=1 THEN 0 END AS LoaiBA, pkk.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN phieu_ke_khai_vp_ngoai_tru AS pkk ON pkk.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN chuan_doan_vs_benh_an_ngoai_tru AS cd_ba ON cd_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV`)

UNION ALL

(select nv.`IdNV`, pkk.`IdPKK`, bn.`HoTen`, pdk.`KhamBHYT`, dmb.`TenBenh`, CASE WHEN 1=1 THEN 1 END AS LoaiBA, pkk.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN phieu_ke_khai_vp_noi_tru AS pkk ON pkk.`IdBANoiT` = ba.`IdBANoiT` JOIN chuan_doan_vs_benh_an_noi_tru AS cd_ba ON cd_ba.`IdBANoiT` = ba.`IdBANoiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV`)

) AS a WHERE a.`IdNV` = N'".$idnv."' AND ((a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 1 THEN N'Nội trú' ELSE N'Ngoại trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`KhamBHYT` IS FALSE THEN N'BHYT Bảo hiểm y tế' ELSE N'TP Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`IdPKK` ORDER BY a.created_at DESC");
            $dspkk = array();
            $sl=0;
            if(!empty($ds_pkk)){
                foreach ($ds_pkk as $p){
                    $pkk='';
                    $pkkngoai= phieu_ke_khai_vp_ngoai_tru::where('IdPKK', $p->IdPKK)->get()->first();
                    $pkknoi= phieu_ke_khai_vp_noi_tru::where('IdPKK', $p->IdPKK)->get()->first();
                    $ba='';
                    $htdt='';$songaydt='';$idba='';$loaiba='noi';
                    if(is_object($pkknoi)){
                        $pkk=$pkknoi;
                        $ba=$pkk->benhAnNoiTru;
                        $htdt='Nội trú';
                        $present= date_create(date('Y-m-d', strtotime($pkk->created_at)));
                        $timeba= date_create(date('Y-m-d', strtotime($ba->created_at)));
                        $t= date_diff($timeba, $present);
                        $songaydt=$t->format('%a') + 1;
                        $idba=$ba->IdBANoiT;
                    }
                    else if(is_object($pkkngoai)){
                        $pkk=$pkkngoai;
                        $ba=$pkk->benhAnNgoaiTru;
                        $htdt='Ngoại trú';
                        $songaydt=1;
                        $idba=$ba->IdBANgoaiT;
                        $loaiba='ngoai';
                    }
                    $dttn='BHYT';
                    if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                    $chuandoan='';
                    $i=1;
                    foreach ($ba->chuanDoan as $cd){
                        if($i == count($ba->chuanDoan)){
                            $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                        }
                        else{
                            $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                        }
                        $i++;
                    }
                    $ttpkk=array(
                        'id'=>$pkk->IdPKK,
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                        'dttn'=>$dttn,
                        'htdt'=>$htdt,
                        'chuandoan'=>$chuandoan,
                        'ngaylap'=> \comm_functions::deDateFormat($pkk->created_at),
                        'songaydt'=>$songaydt,
                        'idba'=>$idba,
                        'loaiba'=>$loaiba
                    );
                    $dspkk[]=$ttpkk;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'pkk'=>$dspkk,
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
}
