<?php

namespace App\Http\Controllers\KeToan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\khoa;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KeToan\hoa_don_dv_ngoai_tru;
use App\Models\KeToan\hoa_don_dv_noi_tru;
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
use Illuminate\Support\Facades\DB;

class thongKeController extends Controller
{
    //
    
    public function getDanhSach(){
        $dskhoa= khoa::where('KhoaKham', 1)->orderBy('TenKhoa', 'ASC')->get();
        return view("ke_toan.thong_ke",['dskhoa' => $dskhoa]);
    }
    
    public static function getsql($param){
        return "SELECT DISTINCT a.`Id`, a.`LoaiBA`, a.`IdKhoa`, a.`KhamBHYT` FROM(
    (SELECT DISTINCT hd.`IdHDDVNgoai` AS Id, CASE WHEN 1 = 1 THEN 0 END AS LoaiBA, pdk.`KhamBHYT`, bsdt.`TenNV`, bn.`HoTen`, hd.`created_at`, kt.`IdNV`, k.`IdKhoa` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN hoa_don_dv_ngoai_tru AS hd ON hd.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN nhan_vien AS bsdt ON bsdt.`IdNV` = ba.`IdNV` JOIN nhan_vien AS kt ON kt.`IdNV` = hd.`IdNVLap` JOIN phong_ban AS pb ON pb.`IdPB` = pdk.`IdPK` JOIN khoa AS k ON k.`IdKhoa` = pb.`IdKhoa`)

    UNION ALL

    (SELECT DISTINCT hd.`IdHDDVNoi` AS Id, CASE WHEN 1 = 1 THEN 1 END AS LoaiBA, pdk.`KhamBHYT`, bsdt.`TenNV`, bn.`HoTen`, hd.`created_at`, kt.`IdNV`, k.`IdKhoa` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN hoa_don_dv_noi_tru AS hd ON hd.`IdBANoiT` = ba.`IdBANoiT` JOIN nhan_vien AS bsdt ON bsdt.`IdNV` = ba.`IdNV` JOIN nhan_vien AS kt ON kt.`IdNV` = hd.`IdNVLap` JOIN phong_ban AS pb ON pb.`IdPB` = pdk.`IdPK` JOIN khoa AS k ON k.`IdKhoa` = pb.`IdKhoa`)

) AS a WHERE ".$param." GROUP BY a.`Id`, a.`LoaiBA`, a.`IdKhoa`, a.`KhamBHYT` ORDER BY a.created_at DESC";
    }

    public function postLocDS(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $tennv=$user->nhanVien->TenNV;
            $sql="";
            $result_qr="";$result_arr="";$result_arr_print = array(); $slbg=0;
            $ngaybd="";$ngaykt="";$sql_af="";
            $arr_k_y=[];$tt=0;$tt_bh=0;$tt_tp=0;$tt_noi=0;$tt_ngoai=0;
            if($request->tgt == 'tuyytg'){
                $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgbd);
                $ngaykt= \DateTime::createFromFormat("d/m/Y", $request->tgkt);
                $sql_af="
                ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').")
                 AND 
                (DAYOFMONTH(a.created_at) <=  ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y').")
                ) ";
            }
            else if($request->tgt == 'ngay'){
                $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgty);
                $sql_af="
                (DAYOFMONTH(a.created_at) = ".$ngaybd->format('d')." AND MONTH(a.created_at) = ".$ngaybd->format('m')." AND YEAR(a.created_at) = ".$ngaybd->format('Y').") ";

            }
            else if($request->tgt == 'thang'){
                $ngaybd = \DateTime::createFromFormat("m/Y", $request->tgty);
                $sql_af="
                (MONTH(a.created_at) = ".$ngaybd->format('m')." AND YEAR(a.created_at) = ".$ngaybd->format('Y').") ";
            }
            else if($request->tgt == 'quy'){
                $ngaybd = \DateTime::createFromFormat("Y", $request->tgty);
                
                if($request->quy == 1){
                    $sql_af="
                ((MONTH(a.created_at) >= 01 AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(a.created_at) <= 03 AND YEAR(a.created_at)<= ".$ngaybd->format('Y')."))";
                }
                else if($request->quy == 2){
                    $sql_af="
                ((MONTH(a.created_at) >= 04 AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(a.created_at) <= 06 AND YEAR(a.created_at)<= ".$ngaybd->format('Y')."))";
                }
                else if($request->quy == 3){
                    $sql_af="
                ((MONTH(a.created_at) >= 07 AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(a.created_at) <= 09 AND YEAR(a.created_at)<= ".$ngaybd->format('Y')."))";
                }
                else{
                    $sql_af="
                ((MONTH(a.created_at) >= 10 AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(a.created_at) <= 12 AND YEAR(a.created_at)<= ".$ngaybd->format('Y')."))";
                }
            }
            else{
                $ngaybd = \DateTime::createFromFormat("Y", $request->tgty);
                $sql_af="
                (YEAR(a.created_at) = ".$ngaybd->format('Y').") ";
            }
            if($request->hanhdong == 'tk' || $request->hanhdong == 'tktk')
            {
                if($request->hanhdong == 'tk')
                {
                    $sql= thongKeController::getsql($sql_af);
                }
                else{
                    $sql= thongKeController::getsql("a.`IdKhoa` = N'".$request->idkhoa."' AND ".$sql_af);
                }
                $result_qr= DB::select($sql);
                if(!empty($result_qr)){
                    foreach ($result_qr as $re_qr){
                        $flag_k=FALSE;
                        foreach ($arr_k_y as $k_y){
                            if($k_y == $re_qr->IdKhoa){
                                $flag_k=TRUE;
                                break;
                            }
                        }
                        if($flag_k == FALSE){
                            $arr_k_y[]=$re_qr->IdKhoa;
                        }
                    }
                    
                    foreach ($arr_k_y as $v) {
                        $dt_tbh=0;$dt_ttp=0;$dt_noi=0;$dt_ngoai=0;
                        foreach ($result_qr as $re_qr) {
                            if($v == $re_qr->IdKhoa){
                                if($re_qr->LoaiBA == 0){
                                    $dt_bh=0;$dt_tp=0;
                                    $hdngoai= hoa_don_dv_ngoai_tru::where('IdHDDVNgoai', $re_qr->Id)->get()->first();
                                    $ba=$hdngoai->benhAnNgoaiTru;
                                    $bn=$ba->phieuDKKham->phieuDKKham->benhNhan;
                                    $pdk=$ba->phieuDKKham->phieuDKKham;

                                    $dspdk= phieu_dk_kham::where('IdBN', $bn->IdBN)->whereDate('created_at', 'like', '%'.date('Y-m-d', strtotime($ba->created_at)).'%')->get();

                                    $flag_xn=FALSE;$flag_cdha=FALSE;$flag_tdcn=FALSE;$flag_thuoc=FALSE;$flag_tt=FALSE;

                                    $tttbv_kb=0;
                                    $tttbv_xn=0;
                                    $tttbv_cdha=0;
                                    $tttbv_tdcn=0;
                                    $tttbv_thuoc=0;
                                    $tttbv_tt=0;
                                    $tttbhyt=0;$tqbhyt=0;$tnbcct=0;$tnbtt=0;

                                    $dsba=[];$i_kb=1;
                                    foreach ($dspdk as $pdkk){
                                        if(is_object($pdkk->benhAnNgoaiTru)){
                                            $ba=$pdkk->benhAnNgoaiTru->benhAnNgoaiTru;
                                            $dsba[]=$ba->IdBANgoaiT;
                                        }
                                    }
                                    $pkekhai='';
                                    foreach ($dsba as $value) {
                                        $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $value)->get()->first();
                                        if(is_object($ba)){
                                            if(is_object($ba->phieuKKVPNgoaiTru)){
                                                $pkekhai=$ba->phieuKKVPNgoaiTru;
                                                foreach ($pkekhai->phieuKKVPCT as $value) {
                                                    $value->delete(); //đồng thời xóa trên bảng qua hệ vs danh mục
                                                }
                                            }
                                            else{
                                                //thêm phiếu kk
                                                $pkkhai= new phieu_ke_khai_vp_ngoai_tru;
                                                $pkkhai->IdPKK= \App\Http\Controllers\KhamVaDieuTri\phieuKeKhaiVPNgoaiTruController::TaoMaNN();
                                                $pkkhai->IdBANgoaiT=$ba->IdBANgoaiT;
                                                $pkkhai->save();

                                                $pkekhai= phieu_ke_khai_vp_ngoai_tru::where('IdPKK', $pkkhai->IdPKK)->get()->first();
                                            }

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

                                                    if($pdk->KhamBHYT == 0){
                                                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1) ){
                                                            $ttqbhyt= $dg_sl*(($bn->theBHYT->BHYTHoTro)/100);
                                                            $tnbcct= $dg_sl - $ttqbhyt;
                                                            $tttbhyt=($dmt_vs_pkk->danhMucThuoc->BHYTTT / 100)*$dg_sl;
                                                            $tnbtt=$dg_sl - $tttbhyt;

                                                            $dt_bh+=$ttqbhyt;$dt_tp+=$tnbcct+$tnbtt;
                                                        }
                                                        else{
                                                            $dt_tp+=$dg_sl;
                                                        }
                                                    }
                                                    else{
                                                        $dt_tp+=$dg_sl;
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
                                                        $flag_xn=TRUE;

                                                        if($pdk->KhamBHYT == 0){
                                                            if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){

                                                                $ttqbhyt= ($dmcls_vs_pkk->danhMucCLS->DonGia)*(($bn->theBHYT->BHYTHoTro)/100);
                                                                $tnbcct= ($dmcls_vs_pkk->danhMucCLS->DonGia) - $ttqbhyt;
                                                                $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                                                $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;

                                                                $dt_bh+=$ttqbhyt;$dt_tp+=$tnbcct+$tnbtt;
                                                            }
                                                            else{
                                                                $dt_tp+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                            }
                                                        }
                                                        else{
                                                            $dt_tp+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                        }
                                                    }
                                                    else if($dmcls_vs_pkk->danhMucCLS->TenKDau == 'chuan_doan_hinh_anh'){
                                                        $flag_cdha=TRUE;

                                                        if($pdk->KhamBHYT == 0){
                                                            if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                                $ttqbhyt= ($dmcls_vs_pkk->danhMucCLS->DonGia)*(($bn->theBHYT->BHYTHoTro)/100);
                                                                $tnbcct= ($dmcls_vs_pkk->danhMucCLS->DonGia) - $ttqbhyt;
                                                                $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                                                $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;

                                                                $dt_bh+=$ttqbhyt;$dt_tp+=$tnbcct+$tnbtt;
                                                            }
                                                            else{
                                                                $dt_tp+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                            }
                                                        }
                                                        else{
                                                            $dt_tp+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                        }
                                                    }
                                                    else if($dmcls_vs_pkk->danhMucCLS->TenKDau == 'tham_do_chuc_nang'){
                                                        $flag_tdcn=TRUE;

                                                        if($pdk->KhamBHYT == 0){
                                                            if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                                $ttqbhyt= ($dmcls_vs_pkk->danhMucCLS->DonGia)*(($bn->theBHYT->BHYTHoTro)/100);
                                                                $tnbcct= ($dmcls_vs_pkk->danhMucCLS->DonGia) - $ttqbhyt;
                                                                $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                                                $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;

                                                                $dt_bh+=$ttqbhyt;$dt_tp+=$tnbcct+$tnbtt;
                                                            }
                                                            else{
                                                                $dt_tp+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                            }
                                                        }
                                                        else{
                                                            $dt_tp+=$dmcls_vs_pkk->danhMucCLS->DonGia;
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

                                                    if($pdk->KhamBHYT == 0){
                                                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                            $ttqbhyt= ($dmcls_vs_pkk->danhMucCLS->DonGia)*(($bn->theBHYT->BHYTHoTro)/100);
                                                            $tnbcct= ($dmcls_vs_pkk->danhMucCLS->DonGia) - $ttqbhyt;
                                                            $tttbhyt=($dmcls_vs_pkk->danhMucCLS->BHYTTT / 100)*($dmcls_vs_pkk->danhMucCLS->DonGia);
                                                            $tnbtt=$dmcls_vs_pkk->danhMucCLS->DonGia - $tttbhyt;
                                                            $dt_bh+=$ttqbhyt;$dt_tp+=$tnbcct+$tnbtt;
                                                        }
                                                        else{
                                                            $dt_tp+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                        }
                                                    }
                                                    else{
                                                        $dt_tp+=$dmcls_vs_pkk->danhMucCLS->DonGia;
                                                    }
                                                }
                                            }

                                            //khám bệnh
                                            if($i_kb == 1){
                                                $tttbv_kb=33000;
                                                if($pdk->KhamBHYT == 0){
                                                    if($pdk->Tuyen == 0){
                                                        $ttqbhyt=33000*(($bn->theBHYT->BHYTHoTro)/100);
                                                        $tnbcct=33000 - (33000*(($bn->theBHYT->BHYTHoTro)/100));
                                                        $dt_bh+=$ttqbhyt;$dt_tp+=$tnbcct;
                                                    }
                                                    else{
                                                        $dt_tp+=33000;
                                                    }
                                                }
                                                else{
                                                    $dt_tp+=33000;
                                                }
                                            }
                                            else if($i_kb >=2 && $i_kb <= 4){
                                                $tttbv_kb+=33000;
                                                if($pdk->KhamBHYT == 0){
                                                    if($pdk->Tuyen == 0){
                                                        $tqbhyt=9900*(($bn->theBHYT->BHYTHoTro)/100);
                                                        $tnbcct=9900 - (9900*(($bn->theBHYT->BHYTHoTro)/100));
                                                        $dt_bh+=$ttqbhyt;$dt_tp+=$tnbcct;
                                                    }
                                                    else{
                                                        $dt_tp+=9900;
                                                    }
                                                }
                                                else{
                                                    $dt_tp+=9900;
                                                }
                                            }
                                            else if($i_kb == 5){
                                                $tttbv_kb+=33000;
                                                if($pdk->KhamBHYT == 0){
                                                    if($pdk->Tuyen == 0){
                                                        $tqbhyt=3300*(($bn->theBHYT->BHYTHoTro)/100);
                                                        $tnbcct=3300 - (3300*(($bn->theBHYT->BHYTHoTro)/100));
                                                        $dt_bh+=$ttqbhyt;$dt_tp+=$tnbcct;
                                                    }
                                                    else{
                                                        $dt_tp+=3300;
                                                    }
                                                }
                                                else{
                                                    $dt_tp+=3300;
                                                }
                                            }
                                        }
                                        $i_kb++;
                                    }

                                    $dt_tbh+=$dt_bh;$dt_ttp+=$dt_tp;
                                    $dt_ngoai+=$dt_bh+$dt_tp;
                                }
                                else{
                                    $dt_bh=0;$dt_tp=0;
                                    $hdnoi= hoa_don_dv_noi_tru::where('IdHDDVNoi', $re_qr->Id)->get()->first();
                                    $ba=$hdnoi->benhAnNoiTru;
                                    $bn=$ba->phieuDKKham->phieuDKKham->benhNhan;
                                    $pdk=$ba->phieuDKKham->phieuDKKham;

                                    $flag_xn=FALSE;$flag_cdha=FALSE;$flag_tdcn=FALSE;$flag_thuoc=FALSE;$flag_tt=FALSE;$flag_pt=FALSE;

                                    $tttbv_kb=0;
                                    $tttbv_xn=0;
                                    $tttbv_cdha=0;
                                    $tttbv_tdcn=0;
                                    $tttbv_thuoc=0;
                                    $tttbv_tt=0;
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
                                                    $tnbcct=33000 - (33000*(($bn->theBHYT->BHYTHoTro)/100));
                                                    $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct;
                                                }
                                                else{
                                                    $dt_tp+=33000;
                                                }
                                            }
                                            else{
                                                $dt_tp+=33000;
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

                                                if($pdk->KhamBHYT == 0){
                                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                        $ttqbhyt= $dg_sl*(($bn->theBHYT->BHYTHoTro)/100);
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_thuoc->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                    else{
                                                        $ttqbhyt= ($dg_sl*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_thuoc->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;

                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                }
                                                else{
                                                    $dt_tp+=$dg_sl;
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
                                                if($pdk->KhamBHYT == 0){
                                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                        $ttqbhyt= $dg_sl*(($bn->theBHYT->BHYTHoTro)/100);
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_xn->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                    else{
                                                        $ttqbhyt= ($dg_sl*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_xn->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                }
                                                else{
                                                    $dt_tp+=$dg_sl;
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
                                                if($pdk->KhamBHYT == 0){
                                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                        $ttqbhyt= $dg_sl*(($bn->theBHYT->BHYTHoTro)/100);
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_cdha->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                    else{
                                                        $ttqbhyt= ($dg_sl*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_cdha->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                }
                                                else{
                                                    $dt_tp+=$dg_sl;
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
                                                if($pdk->KhamBHYT == 0){
                                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                        $ttqbhyt= $dg_sl*(($bn->theBHYT->BHYTHoTro)/100);
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_tdcn->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                    else{
                                                        $ttqbhyt= ($dg_sl*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_tdcn->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                }
                                                else{
                                                    $dt_tp+=$dg_sl;
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

                                                if($pdk->KhamBHYT == 0){
                                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                        $ttqbhyt= $dg_sl*(($bn->theBHYT->BHYTHoTro)/100);
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_tt->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                    else{
                                                        $ttqbhyt= ($dg_sl*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_tt->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$ct_tt - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                }
                                                else{
                                                    $dt_tp+=$dg_sl;
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

                                                if($pdk->KhamBHYT == 0){
                                                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                                                        $ttqbhyt= $dg_sl*(($bn->theBHYT->BHYTHoTro)/100);
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_pt->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$dg_sl - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                    else{
                                                        $ttqbhyt= ($dg_sl*(($bn->theBHYT->BHYTHoTro)/100))*0.6;
                                                        $tnbcct= $dg_sl - $ttqbhyt;
                                                        $tttbhyt=($ct_pt->BHYTTT / 100)*$dg_sl;
                                                        $tnbtt=$ct_pt - $tttbhyt;
                                                        $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct+$tnbtt;
                                                    }
                                                }
                                                else{
                                                    $dt_tp+=$dg_sl;
                                                }
                                            }
                                        } 

                                    }

                                    $present= date_create(date('Y-m-d', strtotime($pkekhai->created_at)));
                                    $timeba= date_create(date('Y-m-d', strtotime($ba->created_at)));
                                    $t= date_diff($timeba, $present);
                                    $sndt=$t->format('%a') + 1;

                                    if($pdk->KhamBHYT == 0){
                                        if($pdk->Tuyen == 0){
                                            $ttqbhyt=195000*(($bn->theBHYT->BHYTHoTro)/100)*$sndt;
                                            $tnbcct=(195000*$sndt) - (195000*(($bn->theBHYT->BHYTHoTro)/100)*$sndt);

                                            $dt_bh+=$ttqbhyt; $dt_tp+=$tnbcct;
                                        }
                                        else{
                                            $dt_tp+=195000*$sndt;
                                        }
                                    }
                                    else{
                                        $dt_tp+=195000*$sndt;
                                    }
                                    $dt_tbh+=$dt_bh;$dt_ttp+=$dt_tp;
                                    $dt_noi+=$dt_bh+$dt_tp;
                                }
                            }
                        }
                        $dt_k=$dt_noi+$dt_ngoai;
                        $tt_bh+=$dt_tbh;$tt_tp+=$dt_ttp;
                        $tt_noi+=$dt_noi;$tt_ngoai+=$dt_ngoai;
                        $tt+=$dt_noi+$dt_ngoai;
                        
                        $khoa= khoa::where('IdKhoa', $v)->get()->first();
                        $result_arr.="<tr class='tr-shadow'>
                            <td style='vertical-align: middle' class='text-left'>".$khoa->TenKhoa."</td>
                            <td>". number_format($dt_k)."</td>
                            <td>". number_format($dt_tbh)."</td>
                            <td>". number_format($dt_ttp)."</td>
                            <td>". number_format($dt_noi)."</td>
                            <td>". number_format($dt_ngoai)."</td>
                        <tr class='spacer'></tr>";

                        $slbg=$slbg+1;
                        $result="<tr class='text-center'>
                        <td>".$slbg."</td>
                        <td class='text-left'>".$khoa->TenKhoa."</td>
                        <td class='font-weight-bold'>".number_format($dt_k)."</td>
                        <td>". number_format($dt_tbh)."</td>
                        <td>". number_format($dt_ttp)."</td>
                        <td>". number_format($dt_noi)."</td>
                        <td>". number_format($dt_ngoai)."</td>
                        </tr>";
                        $result_arr_print[]=$result;
                    }
                    if($request->hanhdong == 'tk'){
                        $dskhoa= khoa::where('KhoaKham', 1)->orderBy('TenKhoa', 'ASC')->get();
                        foreach ($dskhoa as $val) {
                            $flag_k_n=FALSE;
                            foreach ($arr_k_y as $k_y) {
                                if($k_y == $val->IdKhoa){
                                    $flag_k_n=TRUE;
                                    break;
                                }
                            }
                            if($flag_k_n == FALSE){
                                $result_arr.="<tr class='tr-shadow'>
                                    <td style='vertical-align: middle' class='text-left'>".$val->TenKhoa."</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                <tr class='spacer'></tr>";

                                $slbg=$slbg+1;
                                $result="<tr class='text-center'>
                                <td>".$slbg."</td>
                                <td class='text-left'>".$val->TenKhoa."</td>
                                <td class='font-weight-bold'>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                </tr>";
                                $result_arr_print[]=$result;
                            }
                        }
                    }
                    
                }
                else{
                    if($request->hanhdong == 'tktk'){
                        $dskhoa= khoa::where('KhoaKham', 1)->orderBy('TenKhoa', 'ASC')->get();
                        foreach ($dskhoa as $val) {
                            if($val->IdKhoa == $request->idkhoa){
                                $result_arr.="<tr class='tr-shadow'>
                                    <td style='vertical-align: middle' class='text-left'>".$val->TenKhoa."</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                <tr class='spacer'></tr>";

                                $slbg=$slbg+1;
                                $result="<tr class='text-center'>
                                <td>".$slbg."</td>
                                <td class='text-left'>".$val->TenKhoa."</td>
                                <td class='font-weight-bold'>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                </tr>";
                                $result_arr_print[]=$result;
                                break;
                            }
                        }
                    }
                    else{
                        $dskhoa= khoa::where('KhoaKham', 1)->orderBy('TenKhoa', 'ASC')->get();
                        foreach ($dskhoa as $val) {
                            $result_arr.="<tr class='tr-shadow'>
                                <td style='vertical-align: middle' class='text-left'>".$val->TenKhoa."</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            <tr class='spacer'></tr>";

                            $slbg=$slbg+1;
                            $result="<tr class='text-center'>
                            <td>".$slbg."</td>
                            <td class='text-left'>".$val->TenKhoa."</td>
                            <td class='font-weight-bold'>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            </tr>";
                            $result_arr_print[]=$result;
                        }
                    }
                    
                }
            }
            
            
            $response = array(
                'msg' => 'tc',
                'result'=>$result_arr,
                'result_print'=>$result_arr_print,
                'tt'=> number_format($tt),
                'ttbh'=> number_format($tt_bh),
                'tttp'=> number_format($tt_tp),
                'ttnoi'=> number_format($tt_noi),
                'ttngoai'=> number_format($tt_ngoai),
                'slbg'=>$slbg,
                'nv'=>$tennv
            );

            return response()->json($response); 
        }
        catch (\Exception $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
}
