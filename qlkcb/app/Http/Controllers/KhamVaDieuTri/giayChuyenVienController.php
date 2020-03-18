<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\giay_chuyen_vien_vs_benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\giay_chuyen_vien_vs_benh_an_noi_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\TiepDon\phieu_dk_kham;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;

class giayChuyenVienController extends Controller
{
    //
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $banoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        $bangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        $dsgcv=array();
        
        foreach ($bangoai as $value) {
            if(is_object($value->giayChuyenVien)){
                $dsgcv[]=$value->giayChuyenVien;
            }
        }
        
        foreach ($banoi as $value) {
            if(is_object($value->giayChuyenVien)){
                $dsgcv[]=$value->giayChuyenVien;
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
        
        return view("kham_vs_dieu_tri.giay_chuyen_vien", ['dsgcv'=>$dsgcv, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    public function postThem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idkhoa=$user->nhanVien->phongBan->Khoa->IdKhoa;
            
            $bangoai= benh_an_ngoai_tru::where('IdBANgoaiT', $request->id)->get()->first();
            if(is_object($bangoai)){
                if(is_object($bangoai->giayChuyenVien)){
                    $pk=$bangoai->phieuDKKham->phieuDKKham;
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
                    
                    $chuandoan='';$i=1;
                    foreach ($bangoai->chuanDoan as $cd) {
                        if($i == count($bangoai->chuanDoan))
                        {
                            $chuandoan.=$cd->danhMucBenh->TenBenh.'('.$cd->danhMucBenh->IdBenh.')';
                        }
                        else{
                            $chuandoan.=$cd->danhMucBenh->TenBenh.'('.$cd->danhMucBenh->IdBenh.'); ';
                        }

                        $i++;
                    }
                    
                    $dspk= phieu_dk_kham::where('IdBN', $bn->IdBN)->orderBy('created_at', 'DESC')->limit(2)->get();
                    $dsba=array();
                    foreach ($dspk as $value) {
                        if(is_object($value->benhAnNgoaiTru) && $value->phongKham->Khoa->IdKhoa == $idkhoa){
                            $dsba[]=$value->benhAnNgoaiTru->benhAnNgoaiTru;
                        }
                    }
                    
                    $flag_thuoc='koco';$flag_cls='koco';$flag_tt='koco';$thuoc='';$cls='';$tt='';
                    $tgdt='';$flagkqcls=false;$chuandoancls='';$arr_thuoc=[];$arr_cls=[];$arr_tt=[];
                    
                    $ds= array_reverse($dsba);
                    foreach ($ds as $ba) {
                        $tgdt.='<div class="row">
                            <div class="col-lg-12">
                                <label style="margin-bottom: 0;">+ Tại: <label style="margin-bottom: 0; font-weight: normal">Khoa '.$pk->phongKham->Khoa->TenKhoa.', Bệnh viên ĐKTT An Giang (Tuyến Tỉnh)</label> <label style="margin-bottom: 0;font-weight: normal">Từ ngày '.date('d', strtotime($ba->created_at)).'/'.date('m', strtotime($ba->created_at)).'/'.date('Y', strtotime($ba->created_at)).' đến ngày '.date('d', strtotime($ba->created_at)).'/'.date('m', strtotime($ba->created_at)).'/'.date('Y', strtotime($ba->created_at)).'</label>
                            </div>
                        </div>';
                        
                        if(is_object($ba->toaThuoc)){
                            foreach ($ba->toaThuoc->toaThuoc->toaThuocCT as $value) {
                                $flag_thuoc='co';
                                $flag=FALSE;
                                foreach ($arr_thuoc as $t){
                                    if($t==$value->danhMucThuoc->IdThuoc){
                                        $flag=TRUE;break;
                                    }
                                }
                                if($flag == FALSE){
                                    $thuoc.=$value->danhMucThuoc->TenThuoc.'; ';
                                    $arr_thuoc[]=$value->danhMucThuoc->IdThuoc;
                                }
                            }
                        }

                        if(count($ba->CanLamSang) > 0){
                            foreach ($ba->CanLamSang as $value) {
                                if(is_object($value->canLamSang)){
                                    $flag_cls='co';
                                    $flag=FALSE;
                                    foreach ($arr_cls as $c){
                                        if($c==$value->canLamSang->danhMucCLS->IdDMCLS){
                                            $flag=TRUE;break;
                                        }
                                    }
                                    if($flag == FALSE){
                                        $cls.=$value->canLamSang->danhMucCLS->TenCLS.'; ';
                                        $arr_cls[]=$value->canLamSang->danhMucCLS->IdDMCLS;
                                    }
                                    
                                    if(is_object($value->canLamSang->ketQuaCLS)){
                                        $flagkqcls=true;
                                        if(count($value->canLamSang->ketQuaCLS->ketLuanCLS) > 0){
                                            foreach ($value->canLamSang->ketQuaCLS->ketLuanCLS as $v) {
                                                $chuandoancls.=$v->KetLuan.'; ';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if(count($ba->chiDinhTT) > 0){
                            foreach ($ba->chiDinhTT as $value) {
                                if(is_object($value->chiDinhTT)){
                                    $flag_tt='co';
                                    $flag=FALSE;
                                    foreach ($arr_tt as $tthuat){
                                        if($tthuat==$value->chiDinhTT->danhMucCLS->IdDMCLS){
                                            $flag=TRUE;break;
                                        }
                                    }
                                    if($flag == FALSE){
                                        $tt.=$value->chiDinhTT->danhMucCLS->TenCLS.'; ';
                                        $arr_tt[]=$value->chiDinhTT->danhMucCLS->IdDMCLS;
                                    }
                                }
                            }
                        }
                    }
                    if($flagkqcls == true){
                        $chuandoan.=' - '.$chuandoancls;
                    }
                    
                    $thuoc_cls_tt='koco';
                    
                    if($flag_thuoc != 'koco' || $flag_cls != 'koco' || $flag_tt != 'koco'){
                        $thuoc_cls_tt=$thuoc.$cls.$tt;
                    }
                    
                    $tgct=date('H', strtotime($bangoai->giayChuyenVien->created_at)).' giờ '.date('i', strtotime($bangoai->giayChuyenVien->created_at)).' phút, ngày '.date('d/m/Y', strtotime($bangoai->giayChuyenVien->created_at));
                    $response = array(
                        'msg' => 'tc',
                        'hoten'=>$bn->HoTen,
                        'tuoi'=>$tuoi,
                        'gt'=>$gt,
                        'dantoc'=>$dantoc,
                        'mathe'=>$mathe,
                        'diachi'=>$diachi,
                        'cd'=>$chuandoan,
                        'ppdt'=>$bangoai->giayChuyenVien->HDT,
                        'shs'=>$bangoai->IdBANgoaiT,
                        'sct'=>$bangoai->giayChuyenVien->IdGCVNgoai,
                        'dhls'=>$bangoai->giayChuyenVien->DHLS,
                        'bs'=>'BS. '.$bangoai->nhanVien->TenNV,
                        'kqls'=>$chuandoancls,
                        'ncd'=>$bangoai->giayChuyenVien->NoiChuyen,
                        'tgdt'=>$tgdt,
                        'flagkqcls'=>$flagkqcls,
                        'ttbn'=>$bangoai->giayChuyenVien->TTLucChuyen,
                        'thuoc_cls_tt'=>$thuoc_cls_tt,
                        'tgct'=>$tgct
                    );
                    return response()->json($response); 
                }
                else{
                    $pk=$bangoai->phieuDKKham->phieuDKKham;
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
                    
                    $chuandoan='';$i=1;
                    foreach ($bangoai->chuanDoan as $cd) {
                        if($i == count($bangoai->chuanDoan))
                        {
                            $chuandoan.=$cd->danhMucBenh->TenBenh;
                        }
                        else{
                            $chuandoan.=$cd->danhMucBenh->TenBenh.'; ';
                        }

                        $i++;
                    }
                    
                    $dspk= phieu_dk_kham::where('IdBN', $bn->IdBN)->orderBy('created_at', 'DESC')->limit(2)->get();
                    $dsba=array();
                    foreach ($dspk as $value) {
                        if(is_object($value->benhAnNgoaiTru) && $value->phongKham->Khoa->IdKhoa == $idkhoa){
                            $dsba[]=$value->benhAnNgoaiTru->benhAnNgoaiTru;
                        }
                    }
                    
                    $flag_thuoc='koco';$flag_cls='koco';$flag_tt='koco';$thuoc='';$cls='';$tt='';
                    $tgdt='';$flagkqcls=false;$chuandoancls='';$arr_thuoc=[];$arr_cls=[];$arr_tt=[];
                    
                    $ds= array_reverse($dsba);
                    foreach ($ds as $ba) {
                        $tgdt.='<div class="row">
                            <div class="col-lg-12">
                                <label style="margin-bottom: 0;">+ Tại: <label style="margin-bottom: 0; font-weight: normal">Khoa '.$pk->phongKham->Khoa->TenKhoa.', Bệnh viên ĐKTT An Giang (Tuyến Tỉnh)</label> <label style="margin-bottom: 0;font-weight: normal">Từ ngày '.date('d', strtotime($ba->created_at)).'/'.date('m', strtotime($ba->created_at)).'/'.date('Y', strtotime($ba->created_at)).' đến ngày '.date('d', strtotime($ba->created_at)).'/'.date('m', strtotime($ba->created_at)).'/'.date('Y', strtotime($ba->created_at)).'</label>
                            </div>
                        </div>';
                        
                        if(is_object($ba->toaThuoc)){
                            foreach ($ba->toaThuoc->toaThuoc->toaThuocCT as $value) {
                                $flag_thuoc='co';
                                $flag=FALSE;
                                foreach ($arr_thuoc as $t){
                                    if($t==$value->danhMucThuoc->IdThuoc){
                                        $flag=TRUE;break;
                                    }
                                }
                                if($flag == FALSE){
                                    $thuoc.=$value->danhMucThuoc->TenThuoc.'; ';
                                    $arr_thuoc[]=$value->danhMucThuoc->IdThuoc;
                                }
                            }
                        }

                        if(count($ba->CanLamSang) > 0){
                            foreach ($ba->CanLamSang as $value) {
                                if(is_object($value->canLamSang)){
                                    $flag_cls='co';
                                    $flag=FALSE;
                                    foreach ($arr_cls as $c){
                                        if($c==$value->canLamSang->danhMucCLS->IdDMCLS){
                                            $flag=TRUE;break;
                                        }
                                    }
                                    if($flag == FALSE){
                                        $cls.=$value->canLamSang->danhMucCLS->TenCLS.'; ';
                                        $arr_cls[]=$value->canLamSang->danhMucCLS->IdDMCLS;
                                    }
                                    
                                    if(is_object($value->canLamSang->ketQuaCLS)){
                                        $flagkqcls=true;
                                        if(count($value->canLamSang->ketQuaCLS->ketLuanCLS) > 0){
                                            foreach ($value->canLamSang->ketQuaCLS->ketLuanCLS as $v) {
                                                $chuandoancls.=$v->KetLuan.'; ';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if(count($ba->chiDinhTT) > 0){
                            foreach ($ba->chiDinhTT as $value) {
                                if(is_object($value->chiDinhTT)){
                                    $flag_tt='co';
                                    $flag=FALSE;
                                    foreach ($arr_tt as $tthuat){
                                        if($tthuat==$value->chiDinhTT->danhMucCLS->IdDMCLS){
                                            $flag=TRUE;break;
                                        }
                                    }
                                    if($flag == FALSE){
                                        $tt.=$value->chiDinhTT->danhMucCLS->TenCLS.'; ';
                                        $arr_tt[]=$value->chiDinhTT->danhMucCLS->IdDMCLS;
                                    }
                                }
                            }
                        }
                    }
                    if($flagkqcls == true){
                        $chuandoan.=' - '.$chuandoancls;
                    }
                    
                    $thuoc_cls_tt='koco';
                    
                    if($flag_thuoc != 'koco' || $flag_cls != 'koco' || $flag_tt != 'koco'){
                        $thuoc_cls_tt=$thuoc.$cls.$tt;
                    }
                    
                    $ttbn='Tỉnh táo';
                    if($bangoai->TTBN == 'hon_me'){
                        $ttbn='Hôn mê';
                    }
                    else if($bangoai->TTBN == 'hon_me_sau'){
                        $ttbn='Hôn mê sâu';
                    }
                    $response = array(
                        'msg' => 'tc',
                        'hoten'=>$bn->HoTen,
                        'tuoi'=>$tuoi,
                        'gt'=>$gt,
                        'dantoc'=>$dantoc,
                        'mathe'=>$mathe,
                        'diachi'=>$diachi,
                        'cd'=>$chuandoan,
                        'ppdt'=>'koco',
                        'shs'=>$bangoai->IdBANgoaiT,
                        'sct'=>'koco',
                        'dhls'=>'koco',
                        'bs'=>'BS. '.$bangoai->nhanVien->TenNV,
                        'kqls'=>$chuandoancls,
                        'ncd'=>'koco',
                        'tgdt'=>$tgdt,
                        'flagkqcls'=>$flagkqcls,
                        'ttbn'=>$ttbn,
                        'thuoc_cls_tt'=>$thuoc_cls_tt
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
        try{
            $gcv= giay_chuyen_vien_vs_benh_an_ngoai_tru::where("IdGCVNgoai", $request->id)->get()->first();
            $gcv->delete();
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
    
    public function postIn(Request $request){
        try{
            $bangoai= benh_an_ngoai_tru::where('IdBANgoaiT', $request->id)->get()->first();
            if(is_object($bangoai)){
                if(!is_object($bangoai->giayChuyenVien)){
                    $gcv=new giay_chuyen_vien_vs_benh_an_ngoai_tru;
                    $gcv->IdGCVNgoai=giayChuyenVienController::TaoMaNN();
                    $gcv->IdBANgoaiT=$bangoai->IdBANgoaiT;
                    $gcv->NoiChuyen=$request->ncd;
                    $gcv->DHLS=$request->dhls;
                    $gcv->HDT=$request->hdt;
                    $gcv->TTLucChuyen=$request->ttbn;
                    $gcv->save();
                    
                    $response = array(
                        'msg' => 'tc',
                        'bn'=>'GIAY_CHUYEN_VIEN_'.mb_convert_case($bangoai->phieuDKKham->phieuDKKham->benhNhan->HoTen, MB_CASE_UPPER, 'UTF-8').'_KHOA_'.mb_convert_case($bangoai->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8').'_'.date('d/m/Y'),
                        'sct'=>$gcv->IdGCVNgoai
                    );
                    return response()->json($response);
                }
                else{
                    $response = array(
                        'msg' => 'da_lap',
                        'bn'=>'GIAY_CHUYEN_VIEN'.mb_convert_case($bangoai->phieuDKKham->phieuDKKham->benhNhan->HoTen, MB_CASE_UPPER, 'UTF-8').'_KHOA_'. mb_convert_case($bangoai->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8').'_'.date('d/m/Y')
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
    
    public static function TaoMaNN(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= giay_chuyen_vien_vs_benh_an_ngoai_tru::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $grv) {
                   if($grv->IdGCVNgoaiT == $ran){
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
        $ds= giay_chuyen_vien_vs_benh_an_noi_tru::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $grv) {
                   if($grv->IdGCVNoiT == $ran){
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
    
    public function postThemNoi(Request $request){
        try{
            $banoi= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            if(is_object($banoi)){
                if(is_object($banoi->giayChuyenVien)){
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
                    
                    $chuandoan='';$i=1;
                    foreach ($banoi->chuanDoan as $cd) {
                        if($i == count($banoi->chuanDoan))
                        {
                            $chuandoan.=$cd->danhMucBenh->TenBenh;
                        }
                        else{
                            $chuandoan.=$cd->danhMucBenh->TenBenh.'; ';
                        }

                        $i++;
                    }
                    
                    
                    $flag_thuoc='koco';$flag_cls='koco';$flag_tt='koco';$flag_pt='koco';$thuoc='';$cls='';$tt='';$pt='';
                    $tgdt='';$flagkqcls=false;$chuandoancls='';$arr_thuoc=[];$arr_cls=[];$arr_tt=[];$arr_pt=[];
                    $dsba= benh_an_noi_tru_ct::where('IdBANoiT', $banoi->IdBANoiT)->orderBy('created_at', 'ASC')->limit(2)->get();
                    $ttbn='';
                    if(count($dsba) > 0){
                        $k=1;
                        foreach ($dsba as $ba) {
                            if($k == count($dsba)){
                                $ttbn= \comm_functions::decodeTTBN($ba->TinhTrangBN);
                            }
                            $tgdt.='<div class="row">
                                <div class="col-lg-12">
                                    <label style="margin-bottom: 0;">+ Tại: <label style="margin-bottom: 0; font-weight: normal">Khoa '.$pk->phongKham->Khoa->TenKhoa.', Bệnh viên ĐKTT An Giang (Tuyến Tỉnh)</label> <label style="margin-bottom: 0;font-weight: normal">Từ ngày '.date('d', strtotime($ba->NgayBD)).'/'.date('m', strtotime($ba->NgayBD)).'/'.date('Y', strtotime($ba->NgayBD)).' đến ngày '.date('d', strtotime($ba->NgayKT)).'/'.date('m', strtotime($ba->NgayKT)).'/'.date('Y', strtotime($ba->NgayKT)).'</label>
                                </div>
                            </div>';

                            if(is_object($ba->toaThuoc)){
                                foreach ($ba->toaThuoc->toaThuoc->toaThuocCT as $value) {
                                    $flag_thuoc='co';
                                    $flag=FALSE;
                                    foreach ($arr_thuoc as $t){
                                        if($t==$value->danhMucThuoc->IdThuoc){
                                            $flag=TRUE;break;
                                        }
                                    }
                                    if($flag == FALSE){
                                        $thuoc.=$value->danhMucThuoc->TenThuoc.'; ';
                                        $arr_thuoc[]=$value->danhMucThuoc->IdThuoc;
                                    }
                                }
                            }

                            if(count($ba->canLamSang) > 0){
                                foreach ($ba->canLamSang as $value) {
                                    if(is_object($value->canLamSang)){
                                        $flag_cls='co';
                                        $flag=FALSE;
                                        foreach ($arr_cls as $c){
                                            if($c==$value->canLamSang->danhMucCLS->IdDMCLS){
                                                $flag=TRUE;break;
                                            }
                                        }
                                        if($flag == FALSE){
                                            $cls.=$value->canLamSang->danhMucCLS->TenCLS.'; ';
                                            $arr_cls[]=$value->canLamSang->danhMucCLS->IdDMCLS;
                                        }

                                        if(is_object($value->canLamSang->ketQuaCLS)){
                                            $flagkqcls=true;
                                            if(count($value->canLamSang->ketQuaCLS->ketLuanCLS) > 0){
                                                foreach ($value->canLamSang->ketQuaCLS->ketLuanCLS as $v) {
                                                    $chuandoancls.=$v->KetLuan.'; ';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            if(count($ba->phieuChiDinhTT) > 0){
                                foreach ($ba->phieuChiDinhTT as $value) {
                                    if(is_object($value->chiDinhTT)){
                                        $flag_tt='co';
                                        $flag=FALSE;
                                        foreach ($arr_tt as $tthuat){
                                            if($tthuat==$value->chiDinhTT->danhMucCLS->IdDMCLS){
                                                $flag=TRUE;break;
                                            }
                                        }
                                        if($flag == FALSE){
                                            $tt.=$value->chiDinhTT->danhMucCLS->TenCLS.'; ';
                                            $arr_tt[]=$value->chiDinhTT->danhMucCLS->IdDMCLS;
                                        }
                                    }
                                }
                            }
                            if(is_object($ba->phieuChiDinhPT)){
                                $flag_pt='co';
                                $flag=FALSE;
                                foreach ($arr_pt as $pthuat){
                                    if($pthuat==$ba->phieuChiDinhPT->danhMucCLS->IdDMCLS){
                                        $flag=TRUE;break;
                                    }
                                }
                                if($flag == FALSE){
                                    $pt.=$ba->phieuChiDinhPT->danhMucCLS->TenCLS.'; ';
                                    $arr_pt[]=$ba->phieuChiDinhPT->danhMucCLS->IdDMCLS;
                                }
                            }
                            $k++;
                        }
                    }
                    if($flagkqcls == true){
                        $chuandoan.=' - '.$chuandoancls;
                    }
                    
                    $thuoc_cls_tt='koco';
                    
                    if($flag_thuoc != 'koco' || $flag_cls != 'koco' || $flag_tt != 'koco' || $flag_pt != 'koco'){
                        $thuoc_cls_tt=$thuoc.$cls.$tt.$pt;
                    }
                    $tgct=date('H', strtotime($banoi->giayChuyenVien->created_at)).' giờ '.date('i', strtotime($banoi->giayChuyenVien->created_at)).' phút, ngày '.date('d/m/Y', strtotime($banoi->giayChuyenVien->created_at));
                    $response = array(
                        'msg' => 'tc',
                        'hoten'=>$bn->HoTen,
                        'tuoi'=>$tuoi,
                        'gt'=>$gt,
                        'dantoc'=>$dantoc,
                        'mathe'=>$mathe,
                        'diachi'=>$diachi,
                        'cd'=>$chuandoan,
                        'ppdt'=>$banoi->giayChuyenVien->HDT,
                        'shs'=>$banoi->IdBANoiT,
                        'sct'=>$banoi->giayChuyenVien->IdGCVNoi,
                        'dhls'=>$banoi->giayChuyenVien->DHLS,
                        'bs'=>'BS. '.$banoi->nhanVien->TenNV,
                        'kqls'=>$chuandoancls,
                        'ncd'=>$banoi->giayChuyenVien->NoiChuyen,
                        'tgdt'=>$tgdt,
                        'flagkqcls'=>$flagkqcls,
                        'ttbn'=>$banoi->giayChuyenVien->TTLucChuyen,
                        'thuoc_cls_tt'=>$thuoc_cls_tt,
                        'tgct'=>$tgct
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
                    
                    $chuandoan='';$i=1;
                    foreach ($banoi->chuanDoan as $cd) {
                        if($i == count($banoi->chuanDoan))
                        {
                            $chuandoan.=$cd->danhMucBenh->TenBenh;
                        }
                        else{
                            $chuandoan.=$cd->danhMucBenh->TenBenh.'; ';
                        }

                        $i++;
                    }
                    
                    $flag_thuoc='koco';$flag_cls='koco';$flag_tt='koco';$flag_pt='koco';$thuoc='';$cls='';$tt='';$pt='';
                    $tgdt='';$flagkqcls=false;$chuandoancls='';$arr_thuoc=[];$arr_cls=[];$arr_tt=[];$arr_pt=[];
                    $dsba= benh_an_noi_tru_ct::where('IdBANoiT', $banoi->IdBANoiT)->orderBy('created_at', 'ASC')->limit(2)->get();
                    $ttbn='';
                    if(count($dsba) > 0){
                        $k=1;
                        foreach ($dsba as $ba) {
                            if($k == count($dsba)){
                                $ttbn= \comm_functions::decodeTTBN($ba->TinhTrangBN);
                            }
                            $tgdt.='<div class="row">
                                <div class="col-lg-12">
                                    <label style="margin-bottom: 0;">+ Tại: <label style="margin-bottom: 0; font-weight: normal">Khoa '.$pk->phongKham->Khoa->TenKhoa.', Bệnh viên ĐKTT An Giang (Tuyến Tỉnh)</label> <label style="margin-bottom: 0;font-weight: normal">Từ ngày '.date('d', strtotime($ba->NgayBD)).'/'.date('m', strtotime($ba->NgayBD)).'/'.date('Y', strtotime($ba->NgayBD)).' đến ngày '.date('d', strtotime($ba->NgayKT)).'/'.date('m', strtotime($ba->NgayKT)).'/'.date('Y', strtotime($ba->NgayKT)).'</label>
                                </div>
                            </div>';

                            if(is_object($ba->toaThuoc)){
                                foreach ($ba->toaThuoc->toaThuoc->toaThuocCT as $value) {
                                    $flag_thuoc='co';
                                    $flag=FALSE;
                                    foreach ($arr_thuoc as $t){
                                        if($t==$value->danhMucThuoc->IdThuoc){
                                            $flag=TRUE;break;
                                        }
                                    }
                                    if($flag == FALSE){
                                        $thuoc.=$value->danhMucThuoc->TenThuoc.'; ';
                                        $arr_thuoc[]=$value->danhMucThuoc->IdThuoc;
                                    }
                                }
                            }

                            if(count($ba->canLamSang) > 0){
                                foreach ($ba->canLamSang as $value) {
                                    if(is_object($value->canLamSang)){
                                        $flag_cls='co';
                                        $flag=FALSE;
                                        foreach ($arr_cls as $c){
                                            if($c==$value->canLamSang->danhMucCLS->IdDMCLS){
                                                $flag=TRUE;break;
                                            }
                                        }
                                        if($flag == FALSE){
                                            $cls.=$value->canLamSang->danhMucCLS->TenCLS.'; ';
                                            $arr_cls[]=$value->canLamSang->danhMucCLS->IdDMCLS;
                                        }

                                        if(is_object($value->canLamSang->ketQuaCLS)){
                                            $flagkqcls=true;
                                            if(count($value->canLamSang->ketQuaCLS->ketLuanCLS) > 0){
                                                foreach ($value->canLamSang->ketQuaCLS->ketLuanCLS as $v) {
                                                    $chuandoancls.=$v->KetLuan.'; ';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            if(count($ba->phieuChiDinhTT) > 0){
                                foreach ($ba->phieuChiDinhTT as $value) {
                                    if(is_object($value->chiDinhTT)){
                                        $flag_tt='co';
                                        $flag=FALSE;
                                        foreach ($arr_tt as $tthuat){
                                            if($tthuat==$value->chiDinhTT->danhMucCLS->IdDMCLS){
                                                $flag=TRUE;break;
                                            }
                                        }
                                        if($flag == FALSE){
                                            $tt.=$value->chiDinhTT->danhMucCLS->TenCLS.'; ';
                                            $arr_tt[]=$value->chiDinhTT->danhMucCLS->IdDMCLS;
                                        }
                                    }
                                }
                            }
                            if(is_object($ba->phieuChiDinhPT)){
                                $flag_pt='co';
                                $flag=FALSE;
                                foreach ($arr_pt as $pthuat){
                                    if($pthuat==$ba->phieuChiDinhPT->danhMucCLS->IdDMCLS){
                                        $flag=TRUE;break;
                                    }
                                }
                                if($flag == FALSE){
                                    $pt.=$ba->phieuChiDinhPT->danhMucCLS->TenCLS.'; ';
                                    $arr_pt[]=$ba->phieuChiDinhPT->danhMucCLS->IdDMCLS;
                                }
                            }
                            $k++;
                        }
                    }
                    if($flagkqcls == true){
                        $chuandoan.=' - '.$chuandoancls;
                    }
                    
                    $thuoc_cls_tt='koco';
                    
                    if($flag_thuoc != 'koco' || $flag_cls != 'koco' || $flag_tt != 'koco' || $flag_pt != 'koco'){
                        $thuoc_cls_tt=$thuoc.$cls.$tt.$pt;
                    }
                    
                    $response = array(
                        'msg' => 'tc',
                        'hoten'=>$bn->HoTen,
                        'tuoi'=>$tuoi,
                        'gt'=>$gt,
                        'dantoc'=>$dantoc,
                        'mathe'=>$mathe,
                        'diachi'=>$diachi,
                        'cd'=>$chuandoan,
                        'ppdt'=>'koco',
                        'shs'=>$banoi->IdBANoiT,
                        'sct'=>'koco',
                        'dhls'=>'koco',
                        'bs'=>'BS. '.$banoi->nhanVien->TenNV,
                        'kqls'=>$chuandoancls,
                        'ncd'=>'koco',
                        'tgdt'=>$tgdt,
                        'flagkqcls'=>$flagkqcls,
                        'ttbn'=>$ttbn,
                        'thuoc_cls_tt'=>$thuoc_cls_tt
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
    
    public function postXoaALL(Request $request){
        if(strpos($request->id, ',')){//gửi nhiều mã
            $arr= explode(',',$request->id);
            try{
                foreach ($arr as $a){
                    $gcvnoi= giay_chuyen_vien_vs_benh_an_noi_tru::where("IdGCVNoi", $a)->get()->first();
                    $gcvngoai= giay_chuyen_vien_vs_benh_an_ngoai_tru::where("IdGCVNgoai", $a)->get()->first();
                    if(is_object($gcvnoi)){
                        $gcvnoi->delete();
                    }
                    
                    if(is_object($gcvngoai)){
                        $gcvngoai->delete();
                    }
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
                $gcvnoi= giay_chuyen_vien_vs_benh_an_noi_tru::where("IdGCVNoi", $request->id)->get()->first();
                $gcvngoai= giay_chuyen_vien_vs_benh_an_ngoai_tru::where("IdGCVNgoai", $request->id)->get()->first();
                if(is_object($gcvnoi)){
                    $gcvnoi->delete();
                }

                if(is_object($gcvngoai)){
                    $gcvngoai->delete();
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
    
    public function postXoaNoi(Request $request){
        try{
            $gcv= giay_chuyen_vien_vs_benh_an_noi_tru::where("IdGCVNoi", $request->id)->get()->first();
            $gcv->delete();
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
    
    public function postInNoi(Request $request){
        try{
            $banoi= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            if(is_object($banoi)){
                if(!is_object($banoi->giayChuyenVien)){
                    $gcv=new giay_chuyen_vien_vs_benh_an_noi_tru;
                    $gcv->IdGCVNoi=giayChuyenVienController::TaoMaNNNoi();
                    $gcv->IdBANoiT=$banoi->IdBANoiT;
                    $gcv->NoiChuyen=$request->ncd;
                    $gcv->DHLS=$request->dhls;
                    $gcv->HDT=$request->hdt;
                    $gcv->TTLucChuyen=$request->ttbn;
                    $gcv->save();
                    
                    $response = array(
                        'msg' => 'tc',
                        'bn'=>'GIAY_CHUYEN_VIEN_NOI_TRU_'.mb_convert_case($banoi->phieuDKKham->phieuDKKham->benhNhan->HoTen, MB_CASE_UPPER, 'UTF-8').'_KHOA_'.mb_convert_case($banoi->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8').'_'.date('d/m/Y'),
                        'sct'=>$gcv->IdGCVNoi
                    );
                    return response()->json($response);
                }
                else{
                    $response = array(
                        'msg' => 'da_lap',
                        'bn'=>'GIAY_CHUYEN_VIEN_NOI_TRU_'.mb_convert_case($banoi->phieuDKKham->phieuDKKham->benhNhan->HoTen, MB_CASE_UPPER, 'UTF-8').'_KHOA_'. mb_convert_case($banoi->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8').'_'.date('d/m/Y')
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
            $ds_gcv= DB::select("SELECT DISTINCT a.`Id`, a.`LoaiBA` FROM(
    (SELECT DISTINCT gcv.`IdGCVNgoai` AS Id, CASE WHEN 1 = 1 THEN 0 END AS LoaiBA, ba.`IdNV`, bn.`HoTen`, gcv.`created_at`, dmb.`TenBenh` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN giay_chuyen_vien_vs_benh_an_ngoai_tru AS gcv ON gcv.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN chuan_doan_vs_benh_an_ngoai_tru AS cd_ba ON cd_ba.`IdBANgoaiT`=ba.`IdBANgoaiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh`)

    UNION ALL

    (SELECT DISTINCT gcv.`IdGCVNoi` AS Id, CASE WHEN 1 = 1 THEN 1 END AS LoaiBA, ba.`IdNV`, bn.`HoTen`, gcv.`created_at`, dmb.`TenBenh` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN giay_chuyen_vien_vs_benh_an_noi_tru AS gcv ON gcv.`IdBANoiT` = ba.`IdBANoiT` JOIN chuan_doan_vs_benh_an_noi_tru AS cd_ba ON cd_ba.`IdBANoiT`=ba.`IdBANoiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh`
    )
) AS a WHERE a.`IdNV` = N'".$idnv."' AND ((a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Ngoại trú' ELSE N'Nội trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`Id`, a.`LoaiBA` ORDER BY a.created_at DESC");
            $dsgcv = array();
            $sl=0;
            if(!empty($ds_gcv)){
                foreach ($ds_gcv as $gcv){
                    $giaycv= giay_chuyen_vien_vs_benh_an_noi_tru::where("IdGCVNoi", $gcv->Id)->get()->first();
                    $ba='';$idba='';$id='';$htdt='';$loaiba='';
                    if(is_object($giaycv)){
                        $ba=$giaycv->benhAnNoiTru;$htdt='Nội trú';$loaiba='noi';
                        $idba=$giaycv->benhAnNoiTru->IdBANoiT;
                        $id=$giaycv->IdGCVNoi;
                    }
                    
                    if($gcv->LoaiBA == 0){
                        $giaycv= giay_chuyen_vien_vs_benh_an_ngoai_tru::where("IdGCVNgoai", $gcv->Id)->get()->first();
                        $ba=$giaycv->benhAnNgoaiTru;$htdt='Ngoại trú';$loaiba='ngoai';
                        $idba=$giaycv->benhAnNgoaiTru->IdBANgoaiT;
                        $id=$giaycv->IdGCVNgoai;
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
                    
                    $ttgcv=array(
                        'id'=>$id,
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                        'chuandoan'=>$chuandoan,
                        'ngaylap'=> \comm_functions::deDateFormat($giaycv->created_at),
                        'idba'=>$idba,
                        'htdt'=>$htdt,
                        'loaiba'=>$loaiba
                    );
                    $dsgcv[]=$ttgcv;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dsgcv'=>$dsgcv,
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

            $banoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            $bangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            $dsgcv=array();

            foreach ($bangoai as $value) {
                if(is_object($value->giayChuyenVien)){
                    $dsgcv[]=$value->giayChuyenVien;
                }
            }

            foreach ($banoi as $value) {
                if(is_object($value->giayChuyenVien)){
                    $dsgcv[]=$value->giayChuyenVien;
                }
            }
            $re=[];
            foreach ($dsgcv as $val) {
                $ba='';$idba='';$id='';$htdt='';$loaiba='';
                if(is_object($val->benhAnNoiTru)){
                    $ba=$val->benhAnNoiTru;$htdt='Nội trú';$loaiba='noi';
                    $idba=$val->benhAnNoiTru->IdBANoiT;
                    $id=$val->IdGCVNoi;
                }
                else if(is_object($val->benhAnNgoaiTru)){
                    $ba=$val->benhAnNgoaiTru;$htdt='Ngoại trú';$loaiba='ngoai';
                    $idba=$val->benhAnNgoaiTru->IdBANgoaiT;
                    $id=$val->IdGCVNgoai;
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

                $ttgcv=array(
                    'id'=>$id,
                    'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                    'chuandoan'=>$chuandoan,
                    'ngaylap'=> \comm_functions::deDateFormat($val->created_at),
                    'idba'=>$idba,
                    'htdt'=>$htdt,
                    'loaiba'=>$loaiba
                );
                $re[]=$ttgcv;
            }
            $response = array(
                'msg' => 'tc',
                'dsgcv'=>$re
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
