<?php

namespace App\Http\Controllers\KhamVaDieuTri;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\phong_ban;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\chuan_doan_vs_benh_an_noi_tru;
use App\Models\HanhChinh\khoa;
use App\Models\HanhChinh\nhan_vien;
use App\Models\HanhChinh\danh_muc_benh;
use App\Events\KhamVaDieuTri\BenhAnNoiTru;
use App\Events\KhamVaDieuTri\CapCuu;
use App\Models\TiepDon\phieu_dk_kham;
use App\Models\HanhChinh\co_so_kham_bhyt;
use App\Models\KhamVaDieuTri\phieu_dk_kham_vs_benh_an_noi_tru;
use App\Models\HanhChinh\thiet_bi_yt;
use Illuminate\Foundation\Auth\User;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;

class capCuuController extends Controller
{
    //
    
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $idkhoa=$user->nhanVien->phongBan->Khoa->IdKhoa;
        $idpb=$user->nhanVien->phongBan->IdPB;
        
        $dsnv_k= nhan_vien::where('CV', 'bac_si_chuyen_khoa_kham_va_dieu_tri')->orderBy('TenNV', 'ASC')->get();
        
        $ds= phieu_dk_kham::where('IdPK',$idpb)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('STT', 'ASC')->get();
        $dschotn=array();
        foreach($ds as $tn){
            if(!is_object($tn->benhAnNoiTru) && $tn->phongKham->Khoa->IdKhoa == $idkhoa){
                $dschotn[]=$tn;
            }
        }
        $dsdmcls= khoa::where('TenKDau', 'can_lam_sang')->get()->first();
        $dsdmcls=$dsdmcls->danhMucCLS;
        
        $dsphongcls= phong_ban::where('PhanLoai', 'can_lam_sang')->orderBy('SoPhong', 'ASC')->get();
        
        $dsphongtt=phong_ban::where('PhanLoai', 'thu_thuat')->orderBy('SoPhong', 'ASC')->get();
        
        $dsphongpt=phong_ban::where('PhanLoai', 'phau_thuat')->orderBy('SoPhong', 'ASC')->get();
        
        $khoak= khoa::where('IdKhoa', $idkhoa)->get()->first();
        $dsthuthuat=[];$dspt=[];
        foreach ($khoak->danhMucCLS as $value) {
            if($value->danhMucCLS->PhanLoai == 'thu_thuat'){
                $dsthuthuat[]=$value;
            }
        }
        foreach ($khoak->danhMucCLS as $value) {
            if($value->danhMucCLS->PhanLoai == 'phau_thuat'){
                $dspt[]=$value;
            }
        }

        $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at','DESC')->get();
        
        $khoa= khoa::where('IdKhoa', $idkhoa)->get()->first();
        $dsnv=$khoa->nhanVien;
        
        $dsthuoc=$khoa->danhMucThuoc;
        
        $dsbenh= danh_muc_benh::orderBy('TenBenh','ASC')->get();
        
        $dsgiuong=[];
        foreach ($khoa->phongBan as $value) {
            foreach ($value->thietBiYT as $v) {
                if($v->TTTB=='hoat_dong_tot'){
                    $dsgiuong[]=$v;
                }
            }
        }
        
        $tenkhoa= mb_convert_case($khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8');
        $tennv= mb_convert_case($user->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8');
        $dscsk= co_so_kham_bhyt::where('Tuyen', '>=', 2)->orderBy('TenCS', 'ASC')->get();
        
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
        return view("kham_vs_dieu_tri.cap_cuu", ['dsdmcls'=>$dsdmcls, 'dsphongcls'=>$dsphongcls, 'dsphongtt'=>$dsphongtt, 'dsthuthuat'=>$dsthuthuat, 'dsba'=>$dsbanoi, 'dsnv'=>$dsnv, 'dsthuoc'=>$dsthuoc, 'dsbenh'=>$dsbenh, 'tenkhoa' => $tenkhoa, 'tennv'=>$tennv, 'dspt'=>$dspt, 'dsphongpt'=>$dsphongpt, 'dsgiuong'=>$dsgiuong, 'dscskhambhyt'=>$dscsk, 'dschotn'=>$dschotn, 'dsnv_k'=>$dsnv_k, 'dsbc'=>$sl]);
    }
    
    public function postThem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $pdk= phieu_dk_kham::where('IdPhieuDKKB', $request->mapdk)->get()->first();
            
            if(is_object($pdk->benhAnNoiTru)){
                if(is_object($pdk->benhAnNoiTru->giayChuyenVien)){
                    $response = array(
                        'msg' => 'da_chuyen_vien'
                    );
                    return response()->json($response); 
                }
                $response = array(
                    'msg' => 'dang_dieu_tri'
                );
                return response()->json($response); 
            }
            else{
                $banoi= new benh_an_noi_tru;
                $banoi->IdBANoiT= benhAnNoiTruController::TaoMaNN();
                $banoi->IdNV= $idnv;
                $banoi->IdGiuong=$request->giuong;
                $banoi->CapCuu= 1;
                $banoi->TTLucVao=$request->trangthaibn;
                $banoi->LyDoNV=$request->lydonv;
                $banoi->GhiChu=$request->ghichu;
                $banoi->TrangThaiBA=1;
                $banoi->TinhTrangTT=0;

                $banoi->save();

                //cập nhật lại tình trạng sử dụng của thiết bị
                $tb= thiet_bi_yt::where('IdTB', $request->giuong)->get()->first();
                if(count($tb->benhAnNoiTru) == 1){
                    $tb->TinhTrangSD=1;
                    $tb->save();
                }

                //thêm trên bảng quan hệ phiếu đăng ký khám với bệnh án
                $phieudk= new phieu_dk_kham_vs_benh_an_noi_tru;
                $phieudk->IdPhieuDKKB=$request->mapdk;
                $phieudk->IdBANoiT=$banoi->IdBANoiT;
                $phieudk->save();

                if(strpos($request->chuandoan, ',')){//nhiều hơn một bệnh
                    $arr= explode(',',$request->chuandoan);
                    foreach($arr as $value) {
                        $chuandoan=new chuan_doan_vs_benh_an_noi_tru;
                        $chuandoan->IdBANoiT=$banoi->IdBANoiT;
                        $chuandoan->IdBenh=$value;
                        $chuandoan->save();
                    }
                }
                else{
                    $chuandoan=new chuan_doan_vs_benh_an_noi_tru;
                    $chuandoan->IdBANoiT=$banoi->IdBANoiT;
                    $chuandoan->IdBenh=$request->chuandoan;
                    $chuandoan->save();
                }
                
                event(new BenhAnNoiTru($banoi, 'them'));

                $response = array(
                    'msg' => 'tc',
                    'idba'=>$banoi->IdBANoiT
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
    
    public function postCBA(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;

            $ba= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            
            if(is_object($ba)){
                if(is_object($ba->giayChuyenVien)){
                    $response = array(
                        'msg' => 'da_chuyen_vien'
                    );
                    return response()->json($response); 
                }
                if(is_object($ba->benhAnNV)){
                    $response = array(
                        'msg' => 'da_chuyen'
                    );
                    return response()->json($response); 
                }
                $ba_nv = new ba_nv;
                $ba_nv->IdNV=$request->nv;
                $ba_nv->IdBANoiT=$request->id;
                $ba_nv->GhiChu=$request->ghichu;
                $ba_nv->save();
                
                $nv= nhan_vien::where('IdNV', $request->nv)->get()->first();
                
                $slba=count($nv->benhAnNV);
                
                event(new CapCuu($ba, $idnv, $request->nv, $slba, 'them'));

                $response = array(
                    'msg' => 'tc'
                );
                return response()->json($response); 
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
    
    public function postXoaBA(Request $request){
        try{
            $ba= ba_nv::where('IdBANoiT', $request->id)->get()->first();
            $nv=$ba->nhanVien;
            
            $ba->delete();
            $slba=count($nv->benhAnNV);

            $banoi=benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            $idnvchuyen=$banoi->nhanVien->IdNV;

            event(new CapCuu($request->id, $idnvchuyen, $nv->IdNV, $slba, 'xoa'));

            $response = array(
                'msg' => 'tc'
            );
            return response()->json($response); 
        }
        catch (\Exception $ex){
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err,
            );
            return response()->json($response); 
        }
    } 
    
}
