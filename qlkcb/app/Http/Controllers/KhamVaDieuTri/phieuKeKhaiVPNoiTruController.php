<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_noi_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vp_noi_tru;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_noi_vs_danh_muc_cls;
use App\Models\KhamVaDieuTri\phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc;
use App\Models\KhamVaDieuTri\toa_thuoc_vs_benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct_vs_can_lam_sang;
use App\Models\KhamVaDieuTri\chi_dinh_tt_vs_benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\chi_dinh_pt;
use App\Models\HanhChinh\danh_muc_thuoc;
use App\Models\HanhChinh\danh_muc_cls;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct;
use Illuminate\Support\Facades\DB;

class phieuKeKhaiVPNoiTruController extends Controller
{
    //
    public function postIn(Request $request){
        try {
            $ban= benh_an_noi_tru::where('IdBANoiT', $request->idba)->get()->first();
            $msg='tc';$arr_kb=[];$arr_xn=[];$arr_cdha=[];$arr_tdcn=[];$arr_thuoc=[];$arr_tt=[];$data_to_print='';
            $tttbv_ts=0;$tttbhyt_ts=0;$tqbhyt_ts=0;$tnbcct_ts=0;$tnbtt_ts=0;$tbntu=0;
            $sndt=1;$pkekhai='';
            if(is_object($ban)){
                $bn=$ban->phieuDKKham->phieuDKKham->benhNhan;
                $pdk=$ban->phieuDKKham->phieuDKKham;
                
                $kb='';$tt='';$xn='';$cdha='';$tdcn='';$thuoc='';
                $flag_xn=FALSE;$flag_cdha=FALSE;$flag_tdcn=FALSE;$flag_thuoc=FALSE;$flag_tt=FALSE;$flag_pt=FALSE;
                $tttbv_kb=0;$tttbhyt_kb=0;$tqbhyt_kb=0;$tnbcct_kb=0;
                $tttbv_xn=0;$tttbhyt_xn=0;$tqbhyt_xn=0;$tnbcct_xn=0;$tnbtt_xn=0;
                $tttbv_cdha=0;$tttbhyt_cdha=0;$tqbhyt_cdha=0;$tnbcct_cdha=0;$tnbtt_cdha=0;
                $tttbv_tdcn=0;$tttbhyt_tdcn=0;$tqbhyt_tdcn=0;$tnbcct_tdcn=0;$tnbtt_tdcn=0;
                $tttbv_thuoc=0;$tttbhyt_thuoc=0;$tqbhyt_thuoc=0;$tnbcct_thuoc=0;$tnbtt_thuoc=0;
                $tttbv_tt=0;$tttbhyt_tt=0;$tqbhyt_tt=0;$tnbcct_tt=0;$tnbtt_tt=0;
                $tttbv=0;$tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;

                $i_kb=1;$i_thuoc=1;$i_xn=1;$i_cdha=1;$i_tdcn=1;$i_tt=1;
                
                if(is_object($ban->phieuKeKhaiVP)){
                    $pkekhai=$ban->phieuKeKhaiVP;
                    foreach ($pkekhai->phieuKKVPCT as $value) {
                        $value->delete(); //đồng thời xóa trên bảng qua hệ vs danh mục
                    }
                }
                else{
                    //thêm phiếu kk
                    $pkkhai= new phieu_ke_khai_vp_noi_tru;
                    $pkkhai->IdPKK= phieuKeKhaiVPNoiTruController::TaoMaNN();
                    $pkkhai->IdBANoiT=$ban->IdBANoiT;
                    $pkkhai->save();
                    
                    $pkekhai= phieu_ke_khai_vp_noi_tru::where('IdPKK', $pkkhai->IdPKK)->get()->first();
                }
                
                foreach ($ban->benhAnNoiTruCT as $ba){
                    //thuốc
                    $toa_vs_ba= toa_thuoc_vs_benh_an_noi_tru_ct::where('IdBACT', $ba->IdBACT)->get()->first();
                    if(is_object($toa_vs_ba)){
                        $flag_thuoc=TRUE;
                    }

                    //cls
                    $cls_vs_ba= benh_an_noi_tru_ct_vs_can_lam_sang::where('IdBACT', $ba->IdBACT)->get();
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
                    $tt_vs_ba= chi_dinh_tt_vs_benh_an_noi_tru_ct::where('IdBACT', $ba->IdBACT)->get();
                    if(count($tt_vs_ba) > 0){
                        foreach ($tt_vs_ba as $value) {
                            $flag_tt=TRUE;
                        }
                    }

                    //phẫu thuật
                    $pt_vs_ba= chi_dinh_pt::where('IdBACT', $ba->IdBACT)->get()->first();
                    if(is_object($pt_vs_ba)){
                        $flag_pt=TRUE;
                    }
                    
                    //khám bệnh
                    if($i_kb == 1){
                        $tttbv_kb=33000;
                        $kb='<tr><td class="text-left"> 1. Khám '.$ba->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.'</td>
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
                        $arr_kb[]=$kb;
                    }
                    $i_kb++;
                }
                
                if($flag_thuoc == TRUE){
                    $re_thuoc= DB::select("SELECT ttct.`IdThuoc`, SUM(ttct.`TST`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN toa_thuoc_vs_benh_an_noi_tru_ct AS tt_ba ON tt_ba.`IdBACT` = bact.`IdBACT` JOIN toa_thuoc AS tt ON tt.`IdTT` = tt_ba.`IdTT` JOIN toa_thuoc_ct AS ttct ON ttct.`IdTT` = tt.`IdTT` WHERE ba.`IdBANoiT` = N'".$ban->IdBANoiT."' GROUP BY ttct.`IdThuoc`");
                    foreach ($re_thuoc as $val) {
                        $ct_thuoc= danh_muc_thuoc::where('IdThuoc', $val->IdThuoc)->get()->first();
                        if(is_object($ct_thuoc)){
                            //thêm chi tiết
                            $pkkct= new phieu_ke_khai_vpct_noi_tru;
                            $pkkct->IdPKKCT= phieuKeKhaiVPNoiTruController::TaoMaNNCT();
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
                            
                            $thuoc='<tr><td class="text-left">'.$i_thuoc.'. '.$ct_thuoc->TenThuoc.'</td>
                            <td class="text-left">'.$ct_thuoc->DonViTinh.'</td>
                            <td class="text-center">'.number_format($val->SL).'</td>
                            <td>'.number_format($ct_thuoc->DonGiaBan).'</td>
                            <td>'.number_format($ct_thuoc->DonGiaBan).'</td>
                            <td>100</td>
                            <td>'.number_format($dg_sl).'</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $tttbhyt=($ct_thuoc->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $thuoc.='<td>'.$ct_thuoc->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_thuoc+=$ttqbhyt; $tnbcct_thuoc+=$tnbcct; $tttbhyt_thuoc+=$tttbhyt; $tnbtt_thuoc+=$tnbtt;
                                }
                                else{
                                    $tttbhyt=($ct_thuoc->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;

                                    $thuoc.='<td>'.$ct_thuoc->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                       <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_thuoc+=$ttqbhyt; $tnbcct_thuoc+=$tnbcct; $tttbhyt_thuoc+=$tttbhyt; $tnbtt_thuoc+=$tnbtt;
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
                    
                    $tttbv=0;$tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;
                    if(is_numeric($tttbv_thuoc )){
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
                    $re_xn= DB::select("SELECT cls.`IdDMCLS`, COUNT(cls.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ban->IdBANoiT."' AND dmcls.`TenKDau`= N'xet_nghiem' GROUP BY cls.`IdDMCLS`");
                    foreach ($re_xn as $val) {
                        $ct_xn= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                        if(is_object($ct_xn)){
                            //thêm chi tiết
                            $pkkct= new phieu_ke_khai_vpct_noi_tru;
                            $pkkct->IdPKKCT= phieuKeKhaiVPNoiTruController::TaoMaNNCT();
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
                            $xn='<tr><td class="text-left">'.$i_xn.'. '.$ct_xn->TenCLS.'</td>
                                <td class="text-left">'.$ct_xn->DonViTinh.'</td>
                                <td class="text-center">1</td>
                                <td>'.number_format($ct_xn->DonGia).'</td>
                                <td>'.number_format($ct_xn->DonGia).'</td>
                                <td>100</td>
                                <td>'.number_format($dg_sl).'</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $tttbhyt=($ct_xn->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $xn.='<td>'.$ct_xn->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_xn+=$ttqbhyt; $tnbcct_xn+=$tnbcct; $tttbhyt_xn+=$tttbhyt; $tnbtt_xn+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                                else{
                                    $tttbhyt=($ct_xn->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $xn.='<td>'.$ct_xn->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_xn+=$ttqbhyt; $tnbcct_xn+=$tnbcct; $tttbhyt_xn+=$tttbhyt; $tnbtt_xn+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                            }
                            else{
                                $xn.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>'.number_format($dg_sl).'</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tnbcct_xn+=$dg_sl;$tbntu+=$dg_sl / 2;
                            }
                            $arr_xn[]=$xn;
                            $i_xn++;
                        }
                        
                    }
                    
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
                    $re_cdha= DB::select("SELECT cls.`IdDMCLS`, COUNT(cls.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ban->IdBANoiT."' AND dmcls.`TenKDau`= N'chuan_doan_hinh_anh' GROUP BY cls.`IdDMCLS`");
                    foreach ($re_cdha as $val) {
                        $ct_cdha= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                        if(is_object($ct_cdha)){
                            //thêm chi tiết
                            $pkkct= new phieu_ke_khai_vpct_noi_tru;
                            $pkkct->IdPKKCT= phieuKeKhaiVPNoiTruController::TaoMaNNCT();
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
                            $cdha='<tr><td class="text-left">'.$i_cdha.'. '.$ct_cdha->TenCLS.'</td>
                                <td class="text-left">'.$ct_cdha->DonViTinh.'</td>
                                <td class="text-center">1</td>
                                <td>'.number_format($ct_cdha->DonGia).'</td>
                                <td>'.number_format($ct_cdha->DonGia).'</td>
                                <td>100</td>
                                <td>'.number_format($dg_sl).'</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $tttbhyt=($ct_cdha->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $cdha.='<td>'.$ct_cdha->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_cdha+=$ttqbhyt; $tnbcct_cdha+=$tnbcct; $tttbhyt_cdha+=$tttbhyt; $tnbtt_cdha+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                                else{
                                    $tttbhyt=($ct_cdha->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $cdha.='<td>'.$ct_cdha->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_cdha+=$ttqbhyt; $tnbcct_cdha+=$tnbcct; $tttbhyt_cdha+=$tttbhyt; $tnbtt_cdha+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                            }
                            else{
                                $cdha.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>'.number_format($dg_sl).'</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tnbcct_cdha+=$dg_sl;$tbntu+=$dg_sl / 2;
                            }
                            $arr_cdha[]=$cdha;
                            $i_cdha++;
                        }
                    }
                    
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
                    $re_tdcn= DB::select("SELECT cls.`IdDMCLS`, COUNT(cls.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ban->IdBANoiT."' AND dmcls.`TenKDau`= N'tham_do_chuc_nang' GROUP BY cls.`IdDMCLS`");
                    foreach ($re_tdcn as $val) {
                        $ct_tdcn= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                        if(is_object($ct_tdcn)){
                            //thêm chi tiết
                            $pkkct= new phieu_ke_khai_vpct_noi_tru;
                            $pkkct->IdPKKCT= phieuKeKhaiVPNoiTruController::TaoMaNNCT();
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
                            $tdcn='<tr><td class="text-left">'.$i_tdcn.'. '.$ct_tdcn->TenCLS.'</td>
                                <td class="text-left">'.$ct_tdcn->DonViTinh.'</td>
                                <td class="text-center">1</td>
                                <td>'.number_format($ct_tdcn->DonGia).'</td>
                                <td>'.number_format($ct_tdcn->DonGia).'</td>
                                <td>100</td>
                                <td>'.number_format($dg_sl).'</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $tttbhyt=($ct_tdcn->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $tdcn.='<td>'.$ct_tdcn->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_tdcn+=$ttqbhyt; $tnbcct_tdcn+=$tnbcct; $tttbhyt_tdcn+=$tttbhyt; $tnbtt_tdcn+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                                else{
                                    $tttbhyt=($ct_tdcn->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $tdcn.='<td>'.$ct_tdcn->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_tdcn+=$ttqbhyt; $tnbcct_tdcn+=$tnbcct; $tttbhyt_tdcn+=$tttbhyt; $tnbtt_tdcn+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                            }
                            else{
                                $tdcn.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>'.number_format($dg_sl).'</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tnbcct_tdcn+=$dg_sl;$tbntu+=$dg_sl / 2;
                            }
                            $arr_tdcn[]=$tdcn;
                            $i_tdcn++;
                        }
                    }
                    
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
                    $re_tt= DB::select("SELECT cls.`IdDMCLS`, COUNT(cls.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN chi_dinh_tt_vs_benh_an_noi_tru_ct AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN chi_dinh_tt AS cls ON cls.`IdThuThuat` = cls_ba.`IdThuThuat` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ban->IdBANoiT."' GROUP BY cls.`IdDMCLS`");
                    foreach ($re_tt as $val) {
                        $ct_tt= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                        if(is_object($ct_tt)){
                            //thêm chi tiết
                            $pkkct= new phieu_ke_khai_vpct_noi_tru;
                            $pkkct->IdPKKCT= phieuKeKhaiVPNoiTruController::TaoMaNNCT();
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

                            $tt='<tr><td class="text-left">'.$i_tt.'. '.$ct_tt->TenCLS.'</td>
                                <td class="text-left">'.$ct_tt->DonViTinh.'</td>
                                <td class="text-center">1</td>
                                <td>'.number_format($ct_tt->DonGia).'</td>
                                <td>'.number_format($ct_tt->DonGia).'</td>
                                <td>100</td>
                                <td>'.number_format($dg_sl).'</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $tttbhyt=($ct_tt->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $tt.='<td>'.$ct_tt->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                                else{
                                    $tttbhyt=($ct_tt->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $tt.='<td>'.$ct_tt->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                            }
                            else{
                                $tt.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>'.number_format($dg_sl).'</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tnbcct_tt+=$dg_sl;$tbntu+=$dg_sl / 2;
                            }
                            $arr_tt[]=$tt;
                            $i_tt++;
                        }
                    } 
                    
                    if($flag_pt == FALSE){
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
                }
                
                if($flag_pt == TRUE){
                    $re_pt= DB::select("SELECT cls_ba.`IdDMCLS`, COUNT(cls_ba.`IdDMCLS`) AS SL FROM benh_an_noi_tru AS ba JOIN benh_an_noi_tru_ct AS bact ON ba.`IdBANoiT`=bact.`IdBANoiT` JOIN chi_dinh_pt AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls_ba.`IdDMCLS` WHERE ba.`IdBANoiT` = N'".$ban->IdBANoiT."' GROUP BY cls_ba.`IdDMCLS`");
                    foreach ($re_pt as $val) {
                        $ct_pt= danh_muc_cls::where('IdDMCLS', $val->IdDMCLS)->get()->first();
                        if(is_object($ct_pt)){
                            //thêm chi tiết
                            $pkkct= new phieu_ke_khai_vpct_noi_tru;
                            $pkkct->IdPKKCT= phieuKeKhaiVPNoiTruController::TaoMaNNCT();
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

                            $tt='<tr><td class="text-left">'.$i_tt.'. '.$ct_pt->TenCLS.'</td>
                                <td class="text-left">'.$ct_pt->DonViTinh.'</td>
                                <td class="text-center">1</td>
                                <td>'.number_format($ct_pt->DonGia).'</td>
                                <td>'.number_format($ct_pt->DonGia).'</td>
                                <td>100</td>
                                <td>'.number_format($dg_sl).'</td>';
                            if($pdk->KhamBHYT == 0){
                                if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                    $tttbhyt=($ct_pt->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= $tttbhyt*(($bn->theBHYT->BHYTHoTro)/100);
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $tt.='<td>'.$ct_pt->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                                else{
                                    $tttbhyt=($ct_pt->BHYTTT / 100)*$dg_sl;
                                    $ttqbhyt= ($tttbhyt*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                    $tnbcct= $tttbhyt - $ttqbhyt;
                                    
                                    $tnbtt=$dg_sl - $tttbhyt;
                                    $tt.='<td>'.$ct_pt->BHYTTT.'</td>
                                      <td>'.number_format($tttbhyt).'</td>
                                      <td>'.number_format($ttqbhyt).'</td>
                                      <td>'.number_format($tnbcct).'</td>
                                      <td></td>
                                      <td>'.number_format($tnbtt).'</td></tr>';
                                    $tqbhyt_tt+=$ttqbhyt; $tnbcct_tt+=$tnbcct; $tttbhyt_tt+=$tttbhyt; $tnbtt_tt+=$tnbtt;
                                    $tbntu+= ($tnbcct + $tnbtt) / 2;
                                }
                            }
                            else{
                                $tt.='<td>0</td>
                                      <td></td>
                                      <td></td>
                                      <td>'.number_format($dg_sl).'</td>
                                      <td></td>
                                      <td></td></tr>';
                                    $tnbcct_tt+=$dg_sl;$tbntu+=$dg_sl / 2;
                            }
                            $arr_tt[]=$tt;
                            $i_tt++;
                        }
                    } 
                    
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
                
                $present= date_create(date('Y-m-d', strtotime($pkekhai->created_at)));
                $timeba= date_create(date('Y-m-d', strtotime($ban->created_at)));
                $t= date_diff($timeba, $present);
                $sndt=$t->format('%a') + 1;
                
                $tttbv_ng=195000*intval($sndt);
                
                $tqbhyt_ng=0;$tnbcct_ng=0;$tttbhyt_ng=0;
                
                $ng='<tr><td class="text-left"> 2.2. Ngày giường điều trị nội trú</td>
                <td class="text-left">Ngày</td>
                <td class="text-center">'.$sndt.'</td>
                <td>195,000</td>
                <td>195,000</td>
                <td>100</td>
                <td>'.number_format(195000*$sndt).'</td>';
                if($pdk->KhamBHYT == 0){
                    if($pdk->Tuyen == 0){
                        $ttqbhyt=195000*(($bn->theBHYT->BHYTHoTro)/100)*$sndt;
                        $tnbcct=(195000*$sndt) - $ttqbhyt;
                        $ng.='<td>100</td>
                          <td>'.number_format(195000*$sndt).'</td>
                          <td>'.number_format($ttqbhyt).'</td>
                          <td>'.number_format($tnbcct).'</td>
                          <td></td>
                          <td></td></tr>';
                        $tqbhyt_ng+=$ttqbhyt; $tnbcct_ng+=$tnbcct; $tttbhyt_ng=195000*$sndt;
                    }
                    else{
                        $ng.='<td>0</td>
                          <td></td>
                          <td></td>
                          <td>'.number_format(195000*$sndt).'</td>
                          <td></td>
                          <td></td></tr>';
                        $tnbcct_ng+=195000*$sndt;
                    }
                }
                else{
                    $ng.='<td>0</td>
                          <td></td>
                          <td></td>
                          <td>'.number_format(195000*$sndt).'</td>
                          <td></td>
                          <td></td></tr>';
                    $tnbcct_ng+=195000*$sndt;
                }
                
                $ngaygiuong='<tr><td colspan="6" class="text-left font-weight-bold2">02. NGÀY GIƯỜNG</td>
                    <td class="font-weight-bold2">'.number_format($tttbv_ng).'</td>
                    <td></td>
                    <td class="font-weight-bold2">'.number_format($tttbhyt_ng).'</td>
                    <td class="font-weight-bold2">'.number_format($tqbhyt_ng).'</td>
                    <td class="font-weight-bold2">'.number_format($tnbcct_ng).'</td>
                    <td></td>
                    <td class="font-weight-bold2">0</td></tr>';
                
                $arr_n=[$ng];
                $arr_ngiuong=[$ngaygiuong];
                $arr_ng= array_merge($arr_ngiuong, $arr_n);
                
                $tttbv_ts= $tttbv_kb + $tttbv_xn + $tttbv_cdha + $tttbv_tdcn + $tttbv_tt + $tttbv_thuoc + $tttbv_ng;
                $tttbhyt_ts=$tttbhyt_kb + $tttbhyt_xn +$tttbhyt_cdha + $tttbhyt_tdcn + $tttbhyt_thuoc + $tttbhyt_tt + $tttbhyt_ng;
                $tqbhyt_ts= $tqbhyt_kb + $tqbhyt_xn + $tqbhyt_cdha + $tqbhyt_tdcn + $tqbhyt_thuoc + $tqbhyt_tt + $tqbhyt_ng;
                $tnbcct_ts= $tnbcct_kb + $tnbcct_xn + $tnbcct_cdha + $tnbcct_tdcn + $tnbcct_thuoc + $tnbcct_tt + $tnbcct_ng;
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
                
                $data_to_print= array_merge($arr_kb, $arr_ng);
                $data_to_print= array_merge($data_to_print, $arr_xn);
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
            $benhan= benh_an_noi_tru::where('IdBANoiT', $request->idba)->get()->first();
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
                $ngaybd=date('d/m/Y', strtotime($benhan->created_at));
                
                $ngaydt=date('H', strtotime($benhan->created_at)).' giờ '.date('i', strtotime($benhan->created_at)).' phút, ngày '.date('d/m/Y', strtotime($benhan->created_at));
                iF($pkekhai != ''){
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
            
            $ttbn=TRUE;
            $dsct= benh_an_noi_tru_ct::where('IdBANoiT', $benhan->IdBANoiT)->orderBy('created_at', 'DESC')->get()->first();
            if(is_object($dsct)){
                if($dsct->TinhTrangBN != 'khoi_benh_hoan_toan' && $dsct->TinhTrangBN != 'do_nhieu' && $dsct->TinhTrangBN != 'do_mot_phan'){
                    $ttbn=FALSE;
                }
            }
            
            $bnhan= array(
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
                'mh'=>$mh,
                'ttbn'=>$ttbn,
                'sndt'=>$sndt
            );
            
            $response=array(
                'data'=>$data_to_print,
                'bn'=>$bnhan,
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
        $ds= phieu_ke_khai_vp_noi_tru::all();
        
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
        $ds= phieu_ke_khai_vpct_noi_tru::all();
        
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
}
