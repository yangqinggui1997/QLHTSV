<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\giay_ra_vien;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;

class giayRaVienController extends Controller
{
    //
    
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $dsba= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();

        $dsgrv=array();
        
        foreach ($dsba as $value) {
            if(is_object($value->giayRaVien)){
                $dsgrv[]=$value->giayRaVien;
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
        
        return view("kham_vs_dieu_tri.giay_ra_vien", ['dsgrv'=>$dsgrv, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    
    public function postThem(Request $request){
        try{
            $banoi= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            if(is_object($banoi)){
                if(is_object($banoi->giayRaVien)){
                    $pk=$banoi->phieuDKKham->phieuDKKham;
                    $bn=$pk->benhNhan;
                    
                    $gt ="Nam";
                    if($bn->GioiTinh == 0){
                        $gt ="Nữ";
                    }
                    $dantoc = \comm_functions::decodeDanToc($bn->DanToc);
                    $diachi="";
                    if($bn->DiaChi == ''){
                        $diachi="Xã ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $diachi=$bn->DiaChi.", xã, ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    
                    $birthDate = explode("/", date( "m/d/Y", strtotime( $bn->NgaySinh )));

                    $tuoi =(date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));
                    $mathe='koco';
                    if(is_object($bn->theBHYT)){
                        $mathe=$bn->theBHYT->DoiTuongBHYT.' - '. substr($bn->theBHYT->IdTheBHYT, 3, 13).' ['.date( "m/d/Y", strtotime( $bn->theBHYT->NgayDK )).' - '.date( "m/d/Y", strtotime( $bn->theBHYT->NgayHH )).']';
                    }
                    
                    $vvl=date('H', strtotime($banoi->created_at)).' giờ '.date('i', strtotime($banoi->created_at)).' phút, ngày '.date('d/m/Y', strtotime($banoi->created_at));
                    $rvl=date('H', strtotime($banoi->giayRaVien->created_at)).' giờ '.date('i', strtotime($banoi->giayRaVien->created_at)).' phút, ngày '.date('d/m/Y', strtotime($banoi->giayRaVien->created_at));
                    
                    $chuandoan='';$i=1;
                    foreach ($banoi->chuanDoan as $cd) {
                        if($i == count($banoi->chuanDoan))
                        {
                            $chuandoan.=$cd->danhMucBenh->TenBenh.'('.$cd->danhMucBenh->IdBenh.')';
                        }
                        else{
                            $chuandoan.=$cd->danhMucBenh->TenBenh.'('.$cd->danhMucBenh->IdBenh.'); ';
                        }

                        $i++;
                    }
                    
                    $ppdt='';$flag_dt=FALSE;$flag_pt=FALSE;
                    foreach ($banoi->benhAnNoiTruCT as $value) {
                        if($value->PPDieuTri == 'dung_thuoc' || $value->PPDieuTri == 'tieu_phau_vs_dung_thuoc' || $value->PPDieuTri == 'phau_thuat_vs_dung_thuoc' || $value->PPDieuTri == 'thuc_hien_cls_vs_dung_thuoc'){
                            if($flag_dt == FALSE){
                                
                                if($flag_pt==TRUE){
                                    $ppdt.=' và điều trị thuốc kết hợp các chuẩn đoán và xét nghiệm y khoa';
                                }
                                else{
                                    $ppdt.='Điều trị thuốc kết hợp các chuẩn đoán và xét nghiệm y khoa';
                                }
                                $flag_dt=TRUE;
                            }
                        }
                        else if($value->PPDieuTri == 'phau_thuat' || $value->PPDieuTri == 'tieu_phau'){
                            if($flag_pt == FALSE){
                                if($flag_dt==TRUE){
                                    $ppdt.=' và làm tiểu phẫu - phẫu thuật chuyên khoa';
                                }
                                else{
                                    $ppdt.='Thực hiện tiểu phẫu - phẫu thuật chuyên khoa';
                                }
                                $flag_pt=TRUE;
                            }
                        }
                    }
                    $response = array(
                        'msg' => 'tc',
                        'hoten'=>$bn->HoTen,
                        'tuoi'=>$tuoi,
                        'gt'=>$gt,
                        'dantoc'=>$dantoc,
                        'khoa'=>$pk->phongKham->Khoa->TenKhoa,
                        'mathe'=>$mathe,
                        'vvl'=>$vvl,
                        'rvl'=>$rvl,
                        'diachi'=>$diachi,
                        'cd'=>$chuandoan,
                        'ppdt'=>$ppdt,
                        'myt'=>$bn->IdBN,
                        'slt'=>$banoi->giayRaVien->IdGRV,
                        'ghichu'=>$banoi->giayRaVien->GhiChu
                    );
                    return response()->json($response); 
                }
                else{
                    $pk=$banoi->phieuDKKham->phieuDKKham;
                    $bn=$pk->benhNhan;
                    
                    $gt ="Nam";
                    if($bn->GioiTinh == 0){
                        $gt ="Nữ";
                    }
                    $dantoc = \comm_functions::decodeDanToc($bn->DanToc);
                    $diachi="";
                    if($bn->DiaChi == ''){
                        $diachi="Xã ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $diachi=$bn->DiaChi.", xã, ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    
                    $birthDate = explode("/", date( "m/d/Y", strtotime( $bn->NgaySinh )));

                    $tuoi =(date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));
                    $mathe='koco';
                    if(is_object($bn->theBHYT)){
                        $mathe=$bn->theBHYT->DoiTuongBHYT.' - '. substr($bn->theBHYT->IdTheBHYT, 3, 13).' ['.date( "m/d/Y", strtotime( $bn->theBHYT->NgayDK )).' - '.date( "m/d/Y", strtotime( $bn->theBHYT->NgayHH )).']';
                    }
                    
                    $vvl=date('H', strtotime($banoi->created_at)).' giờ '.date('i', strtotime($banoi->created_at)).' phút, ngày '.date('d/m/Y', strtotime($banoi->created_at));
                    $rvl=date('H').' giờ '.date('i').' phút, ngày '.date('d/m/Y');
                    
                    $chuandoan='';$i=1;
                    foreach ($banoi->chuanDoan as $cd) {
                        if($i == count($banoi->chuanDoan))
                        {
                            $chuandoan.=$cd->danhMucBenh->TenBenh.'(.'.$cd->danhMucBenh->IdBenh.')';
                        }
                        else{
                            $chuandoan.=$cd->danhMucBenh->TenBenh.'(.'.$cd->danhMucBenh->IdBenh.'); ';
                        }

                        $i++;
                    }
                    
                    $ppdt='';$flag_dt=FALSE;$flag_pt=FALSE;
                    foreach ($banoi->benhAnNoiTruCT as $value) {
                        if($value->PPDieuTri == 'dung_thuoc' || $value->PPDieuTri == 'tieu_phau_vs_dung_thuoc' || $value->PPDieuTri == 'phau_thuat_vs_dung_thuoc' || $value->PPDieuTri == 'thuc_hien_cls_vs_dung_thuoc'){
                            if($flag_dt == FALSE){
                                
                                if($flag_pt==TRUE){
                                    $ppdt.=' và điều trị thuốc kết hợp các chuẩn đoán và xét nghiệm y khoa';
                                }
                                else{
                                    $ppdt.='Điều trị thuốc kết hợp các chuẩn đoán và xét nghiệm y khoa';
                                }
                                $flag_dt=TRUE;
                            }
                        }
                        else if($value->PPDieuTri == 'phau_thuat' || $value->PPDieuTri == 'tieu_phau'){
                            if($flag_pt == FALSE){
                                if($flag_dt==TRUE){
                                    $ppdt.=' và làm tiểu phẫu - phẫu thuật chuyên khoa';
                                }
                                else{
                                    $ppdt.='Thực hiện tiểu phẫu - phẫu thuật chuyên khoa';
                                }
                                $flag_pt=TRUE;
                            }
                        }
                    }
                    $response = array(
                        'msg' => 'tc',
                        'hoten'=>$bn->HoTen,
                        'tuoi'=>$tuoi,
                        'gt'=>$gt,
                        'dantoc'=>$dantoc,
                        'khoa'=>$pk->phongKham->Khoa->TenKhoa,
                        'mathe'=>$mathe,
                        'vvl'=>$vvl,
                        'rvl'=>$rvl,
                        'diachi'=>$diachi,
                        'cd'=>$chuandoan,
                        'ppdt'=>$ppdt,
                        'myt'=>$bn->IdBN,
                        'slt'=>'koco'
                    );
                    return response()->json($response);
                }
            }
            else{
                $response = array(
                    'msg' => 'ktt'
                );
                return response()->json($response); 
            }
        }
        catch (\Exception $ex){
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err,
            );
            return response()->json($response); 
        }
    } 
    
    public function postXoa(Request $request){
        if(strpos($request->id, ',')){//gửi nhiều mã
            $arr= explode(',',$request->id);
            try{
                foreach ($arr as $a){
                    $grv= giay_ra_vien::where("IdGRV", $a)->get()->first();
                    $grv->benhAnNoiTru->TrangThaiBA=1;
                    $grv->benhAnNoiTru->save();
                    $grv->delete();
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
        else{
            try{
                $grv= giay_ra_vien::where("IdGRV", $request->id)->get()->first();
                $grv->benhAnNoiTru->TrangThaiBA=1;
                $grv->benhAnNoiTru->save();
                $grv->delete();
                $response = array(
                    'msg' => 'tc',
                    'idba'=>$grv->benhAnNoiTru->IdBANoiT//gửi mã cập nhật lại tình trạng điều trị
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
    
    public function postIn(Request $request){
        try{
            $banoi= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            if(is_object($banoi)){
                if(!is_object($banoi->giayRaVien)){
                    $grv=new giay_ra_vien;
                    $grv->IdGRV= giayRaVienController::TaoMaNN();
                    $grv->IdBANoiT=$banoi->IdBANoiT;
                    $grv->GhiChu=$request->ghichu;
                    $grv->save();
                    
                    //cập nhật lại trạng thái bệnh án
                    $banoi->TrangThaiBA=0;
                    $banoi->save();
                    
                    $response = array(
                        'msg' => 'tc',
                        'bn'=>'GIAY_RA_VIEN_'.mb_convert_case($banoi->phieuDKKham->phieuDKKham->benhNhan->HoTen, MB_CASE_UPPER, 'UTF-8').'_KHOA_'.mb_convert_case($banoi->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8').'_'.date('d/m/Y'),
                        'slt'=>$grv->IdGRV,
                        'idba'=>$banoi->IdBANoiT
                    );
                    return response()->json($response);
                }
                else{
                    $response = array(
                        'msg' => 'da_lap',
                        'bn'=>'GIAY_RA_VIEN_'.mb_convert_case($banoi->phieuDKKham->phieuDKKham->benhNhan->HoTen, MB_CASE_UPPER, 'UTF-8').'_KHOA_'. mb_convert_case($banoi->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8').'_'.date('d/m/Y'),
                        'ghichu'=>$banoi->giayRaVien->GhiChu,
                        'slt'=>$banoi->giayRaVien->IdGRV
                    );
                    return response()->json($response);
                }
            }
            else{
                $response = array(
                    'msg' => 'ktt'
                );
                return response()->json($response); 
            }
        }
        catch (\Exception $ex){
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err,
            );
            return response()->json($response); 
        }
    } 
    
    public function postTimKiem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $key=$request->keyWords;
            $ds_grv= DB::select("SELECT DISTINCT grv.`IdGRV` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN giay_ra_vien AS grv ON grv.`IdBANoiT` = ba.`IdBANoiT` JOIN chuan_doan_vs_benh_an_noi_tru AS cd_ba ON cd_ba.`IdBANoiT` = ba.`IdBANoiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` WHERE ba.`IdNV` = N'".$idnv."' AND ((bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(grv.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmb.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'BHYT Bảo hiểm y tế' ELSE N'TP Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY grv.`IdGRV` ORDER BY grv.created_at DESC");
            $dsgrv = array();
            $sl=0;
            if(!empty($ds_grv)){
                foreach ($ds_grv as $grv){
                    $giayrv= giay_ra_vien::where("IdGRV", $grv->IdGRV)->get()->first();
                    $ba=$giayrv->benhAnNoiTru;
                    
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
                    $sndt=1;
                    if($ba->TrangThaiBA == 0){
                        if(count($ba->benhAnNoiTruCT) > 0){
                            foreach ($ba->benhAnNoiTruCT as $value) {
                                $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                                $t= date_diff($timeba, $present);
                                $sndt = $t->format('%a') + 1;
                                break;
                            }
                        }
                    }
                    else{
                        if(count($ba->benhAnNoiTruCT) > 0){
                            foreach ($ba->benhAnNoiTruCT as $value) {
                                $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                                $t= date_diff($timeba, $present);
                                $sndt = $t->format('%a') + 1;
                                break;
                            }
                        }
                        else{
                            $present= date_create(date('Y-m-d H:m:s'));
                            $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                            $t= date_diff($timeba, $present);
                            $sndt = $t->format('%a') + 1;
                        }
                    }
                    $ttgrv=array(
                        'id'=>$giayrv->IdGRV,
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                        'dttn'=>$dttn,
                        'chuandoan'=>$chuandoan,
                        'ngaylap'=> \comm_functions::deDateFormat($giayrv->created_at),
                        'idba'=>$ba->IdBANoiT,
                        'sndt'=>$sndt
                    );
                    $dsgrv[]=$ttgrv;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dsgrv'=>$dsgrv,
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

            $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach ($dsbanoi as $ba){
                if(is_object($ba->giayRaVien)){
                    $grv=$ba->giayRaVien;
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
                    $sndt=1;
                    if($ba->TrangThaiBA == 0){
                        if(count($ba->benhAnNoiTruCT) > 0){
                            foreach ($ba->benhAnNoiTruCT as $value) {
                                $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                                $t= date_diff($timeba, $present);
                                $sndt = $t->format('%a') + 1;
                                break;
                            }
                        }
                    }
                    else{
                        if(count($ba->benhAnNoiTruCT) > 0){
                            foreach ($ba->benhAnNoiTruCT as $value) {
                                $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                                $t= date_diff($timeba, $present);
                                $sndt = $t->format('%a') + 1;
                                break;
                            }
                        }
                        else{
                            $present= date_create(date('Y-m-d H:m:s'));
                            $timeba= date_create(date('Y-m-d H:m:s', strtotime($ba->created_at)));
                            $t= date_diff($timeba, $present);
                            $sndt = $t->format('%a') + 1;
                        }
                    }
                    $ttgrv=array(
                        'id'=>$grv->IdGRV,
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                        'dttn'=>$dttn,
                        'chuandoan'=>$chuandoan,
                        'ngaylap'=> \comm_functions::deDateFormat($grv->created_at),
                        'idba'=>$ba->IdBANoiT,
                        'sndt'=>$sndt
                    );
                    $dsgrv[]=$ttgrv;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dsgrv'=>$dsgrv
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
    
    public static function TaoMaNN(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= giay_ra_vien::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $grv) {
                   if($grv->IdGRV == $ran){
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
