<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\phong_ban;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\chuan_doan_vs_benh_an_ngoai_tru;
use App\Models\HanhChinh\khoa;
use App\Models\HanhChinh\co_so_kham_bhyt;
use App\Events\KhamVaDieuTri\BenhAnNgoaiTru;
use App\Models\TiepDon\phieu_dk_kham;
use App\Models\KhamVaDieuTri\phieu_dk_kham_vs_benh_an_ngoai_tru;
use App\Models\TiepDon\benh_nhan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;

class benhAnNgoaiTruController extends Controller
{
    //
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $idkhoa=$user->nhanVien->phongBan->Khoa->IdKhoa;
        $idpb=$user->nhanVien->phongBan->IdPB;
        
        $ds= phieu_dk_kham::where('IdPK',$idpb)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('STT', 'ASC')->get();
        $dschotn=array();
        foreach($ds as $tn){
            if(!is_object($tn->benhAnNgoaiTru) && !is_object($tn->benhAnNoiTru) && $tn->phongKham->Khoa->IdKhoa == $idkhoa){
                $dschotn[]=$tn;
            }
        }
        
        
        $dsdmcls= khoa::where('TenKDau', 'can_lam_sang')->get()->first();
        $dsdmcls=$dsdmcls->danhMucCLS;
        
        $dsphongcls= phong_ban::where('PhanLoai', 'can_lam_sang')->orderBy('SoPhong', 'ASC')->get();
        
        $dsphongtt=phong_ban::where('PhanLoai', 'thu_thuat')->orderBy('SoPhong', 'ASC')->get();
        
        $dsthuthuat= khoa::where('IdKhoa', $idkhoa)->get()->first();
        $dsthuthuat=$dsthuthuat->danhMucCLS;
        
        $dsbangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at','DESC')->get();
        
        $khoa= khoa::where('IdKhoa', $idkhoa)->get()->first();
        $dsnv=$khoa->nhanVien;
        
        $dsbenh=$khoa->danhMucBenh;
        
        $tenkhoa= mb_convert_case($khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8');
        $tennv= mb_convert_case($user->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8');
        
        $dsgiuong=[];
        foreach ($khoa->phongBan as $value) {
            foreach ($value->thietBiYT as $v) {
                if($v->TTTB=='hoat_dong_tot'){
                    $dsgiuong[]=$v;
                }
            }
        }
        $dscsk= co_so_kham_bhyt::where('Tuyen', '>=', 2)->orderBy('TenCS', 'ASC')->get();
        
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
        
        return view("kham_vs_dieu_tri.benh_an_ngoai_tru", ['dschotn'=>$dschotn, 'dsdmcls'=>$dsdmcls, 'dsphongcls'=>$dsphongcls, 'dsphongtt'=>$dsphongtt, 'dsthuthuat'=>$dsthuthuat, 'dsbangoai'=>$dsbangoai, 'dsnv'=>$dsnv, 'dsbenh'=>$dsbenh, 'tenkhoa' => $tenkhoa, 'tennv'=>$tennv, 'dsgiuong'=>$dsgiuong, 'dscskhambhyt'=>$dscsk, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    
    public function postThem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $bangoai= new benh_an_ngoai_tru;
            $bangoai->IdBANgoaiT= benhAnNgoaiTruController::TaoMaNN();
            $bangoai->IdNV=$idnv;
            $bangoai->SoNgayDT= $request->songaydt;
            $bangoai->TrangThaiBA=1;
            $bangoai->TinhTrangTT=0;
            $bangoai->TTBN=$request->trangthaibn;
            $bangoai->GhiChu=$request->ghichu;

            $bangoai->save();
            
            //thêm trên bảng quan hệ phiếu đăng ký khám với bệnh án
            $phieudk= new phieu_dk_kham_vs_benh_an_ngoai_tru;
            $phieudk->IdPhieuDKKB=$request->mapdk;
            $phieudk->IdBANgoaiT=$bangoai->IdBANgoaiT;
            
            $phieudk->save();
            
            if(strpos($request->chuandoan, ',')){//nhiều hơn một bệnh
                $arr= explode(',',$request->chuandoan);
                foreach($arr as $value) {
                    $chuandoan= new chuan_doan_vs_benh_an_ngoai_tru;
                    $chuandoan->IdBenh=$value;
                    $chuandoan->IdBANgoaiT=$bangoai->IdBANgoaiT;
                    $chuandoan->save();
                }
            }
            else{
                $chuandoan= new chuan_doan_vs_benh_an_ngoai_tru;
                $chuandoan->IdBenh=$request->chuandoan;
                $chuandoan->IdBANgoaiT=$bangoai->IdBANgoaiT;
                $chuandoan->save();
            }
                        
            event(new BenhAnNgoaiTru($bangoai, 'them', 'NULL'));
            
            $response = array(
                'msg' => 'tc',
                'idba'=>$bangoai->IdBANgoaiT,
                'snd'=>$bangoai->SoNgayDT
                    
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
    
    public function postLayTTCN(Request $request){
        try{
            $benhan= benh_an_ngoai_tru::where('IdBANgoaiT',$request->id)->get()->first();
            $benhnhan=$benhan->phieuDKKham->phieuDKKham->benhNhan;
            $ngaysinh=date( "d/m/Y", strtotime($benhnhan->NgaySinh));
            $ttba=FALSE;
            if($benhan->TrangThaiBA==1 && date( "d/m/Y", strtotime($benhan->created_at)) == date('d/m/Y') && !is_object($benhan->phieuDKKham->phieuDKKham->benhAnNoiTru)){
                $ttba=TRUE;
            }
            $gt="Nam";
            if($benhnhan->GioiTinh == 0){
                $gt="Nữ";
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
            $scmnd ="Chưa cập nhật!";
            if($benhnhan->SoCMND != ''){
                $scmnd = $benhnhan->SoCMND;
            }
            
            $chuandoan=array();
            foreach ($benhan->chuanDoan as $cd) {
                $chuandoan[]=['id'=>$cd->danhMucBenh->IdBenh, 'name'=>$cd->danhMucBenh->TenBenh];
            }
            $tuyen='Đúng tuyến';$chuyentu='Không chuyển'; $giaychuyen='Không có giấy chuyển';
            if($benhan->phieuDKKham->phieuDKKham->Tuyen == 1){
                $tuyen='Vượt tuyến';$chuyentu='Tuyến huyện';
                if($benhan->phieuDKKham->phieuDKKham->GiayChuyen == 1){
                    $giaychuyen='Có giấy chuyển';
                }
            }
            else if($benhan->phieuDKKham->phieuDKKham->Tuyen == 2){
                $tuyen='Vượt tuyến';$chuyentu='Tuyến xã';
                if($benhan->phieuDKKham->phieuDKKham->GiayChuyen == 1){
                    $giaychuyen='Có giấy chuyển';
                }
            }
            $mathe='koco';
            $ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';
            if(is_object($benhnhan->theBHYT)){
                $mathe=$benhnhan->theBHYT->IdTheBHYT;
                $ngaydk=date( "d/m/Y", strtotime($benhnhan->theBHYT->NgayDK));
                $ngayhh=date( "d/m/Y", strtotime($benhnhan->theBHYT->NgayHH));
                $doituong= \comm_functions::getDTK($benhnhan->theBHYT->DoiTuongBHYT);
                $noidk=$benhnhan->theBHYT->coSoKhamBHYT->TenCS;
                $mh= \comm_functions::getMucHuongDTK($benhnhan->theBHYT->DoiTuongBHYT).'%';
            }
            $chuyenvien=FALSE;
            if(date( "d/m/Y", strtotime($benhan->created_at)) == date('d/m/Y') && !is_object($benhan->phieuDKKham->phieuDKKham->benhAnNoiTru) && $benhan->phieuDKKham->phieuDKKham->KhamBHYT == 0){
                $chuyenvien=TRUE;
            }
            $dttn='BHYT';
            if($benhan->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                $dttn='Thu phí';
            }
            $response=array(
                'msg'=>'tc',
                'hotenbn' => $benhnhan->HoTen,
                'ngaysinh' => $ngaysinh,
                'gt' => $gt,
                'diachi' => $diachi,
                'dantoc'=>$dantoc,
                'socmnd' => $scmnd,
                'chuandoan'=>$chuandoan,
                'songaydt'=>$benhan->SoNgayDT,
                'ghichu'=>$benhan->GhiChu,
                'id' => $benhan->IdBANgoaiT,
                'mabn' => $benhnhan->IdBN,
                'mathe'=>$mathe,
                'ngaydk'=>$ngaydk,
                'ngayhh'=>$ngayhh,
                'noidk'=>$noidk,
                'tuyen'=>$tuyen,
                'chuyentu'=>$chuyentu,
                'giaychuyen'=>$giaychuyen,
                'doituong'=>$doituong,
                'mh'=>$mh,
                'snd'=>$benhan->SoNgayDT,
                'ttbn'=>$benhan->TTBN,
                'anh'=>$benhnhan->Anh,
                'ttba'=>$ttba,
                'chuyenvien'=>$chuyenvien,
                'dttn'=>$dttn
            );

            return response()->json($response);
        } catch (\Exception $e){
            $err=$e->getMessage();
            $response=array(
                'msg'=>$err
            );
            return response()->json($response);
        }
    }

    public function postSua(Request $request)
    {
        try{
            $bangoai= benh_an_ngoai_tru::where('IdBANgoaiT', $request->id)->get()->first();
            $bangoai->SoNgayDT= $request->songaydt;
            $bangoai->TTBN=$request->trangthaibn;
            $bangoai->GhiChu=$request->ghichu;

            $bangoai->save();
            
            if(strpos($request->chuandoan, ',')){//nhiều hơn một bệnh
                $arr= explode(',',$request->chuandoan);
                $chuandoan= chuan_doan_vs_benh_an_ngoai_tru::where('IdBANgoaiT',$request->id)->get();
                foreach ($chuandoan as $value) {
                    $value->delete();
                }
                foreach($arr as $value) {
                    $chuandoan= new chuan_doan_vs_benh_an_ngoai_tru;
                    $chuandoan->IdBenh=$value;
                    $chuandoan->IdBANgoaiT=$request->id;
                    $chuandoan->save();
                }
            }
            else{
                $chuandoan= chuan_doan_vs_benh_an_ngoai_tru::where('IdBANgoaiT',$request->id)->get();
                foreach ($chuandoan as $value) {
                    $value->delete();
                }
                $chuandoan= new chuan_doan_vs_benh_an_ngoai_tru;
                $chuandoan->IdBenh=$request->chuandoan;
                $chuandoan->IdBANgoaiT=$request->id;
                $chuandoan->save();
            }
                        
            event(new BenhAnNgoaiTru($bangoai, 'sua', 'NULL'));
            
            $response = array(
                'msg' => 'tc',
                'sndt'=>$bangoai->SoNgayDT
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

    public function postXoa(Request $request){
        if(strpos($request->id, ',')){//gửi nhiều mã
            $arr= explode(',',$request->id);
            $pk=[];
            try{
                foreach ($arr as $a){
                    $benhan= benh_an_ngoai_tru::where("IdBANgoaiT", $a)->get()->first();
                    $p=$benhan->phieuDKKham->phieuDKKham;
                    $pk[]=$p->IdPhieuDKKB;
                    
                    if(is_object($benhan->CanLamSang)){
                        foreach($benhan->CanLamSang as $cls){
                            $cls->canLamSang->delete();
                        }
                    }
                    if(is_object($benhan->chiDinhTT)){
                        foreach($benhan->chiDinhTT as $cdtt){
                            $cdtt->chiDinhTT->delete();
                        }
                    }
                    if(is_object($benhan->toaThuoc)){
                        $benhan->toaThuoc->toaThuoc->delete();
                    }
                    
                    $benhan->delete();
                }
                
                event(new BenhAnNgoaiTru($arr, 'xoa', $pk));
                
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
                $benhan= benh_an_ngoai_tru::where("IdBANgoaiT", $request->id)->get()->first();
                $p=$benhan->phieuDKKham->phieuDKKham;
                $pk=$p->IdPhieuDKKB;
                if(is_object($benhan->CanLamSang)){
                    foreach($benhan->CanLamSang as $cls){
                        $cls->canLamSang->delete();
                    }
                }
                if(is_object($benhan->chiDinhTT)){
                    foreach($benhan->chiDinhTT as $cdtt){
                        $cdtt->chiDinhTT->delete();
                    }
                }
                if(is_object($benhan->toaThuoc)){
                    $benhan->toaThuoc->toaThuoc->delete();
                }
                $benhan->delete();
                
                event(new BenhAnNgoaiTru($request->id, 'xoa', $pk));
                
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

    public function postLayDSPhieuKham(Request $request){
        $pk=[];
        if(strpos($request->idpk, ',')){//gửi nhiều mã
            $arr= explode(',',$request->idpk);
            try{
                
                foreach ($arr as $a){
                    $pdk= phieu_dk_kham::where('IdPhieuDKKB', $a)->get()->first();
                    if(date('d/m/Y', strtotime($pdk->created_at)) == date('d/m/Y')){
                        $pdk->TrangThai=0;//trả về trạng thái chưa tiếp nhận
                        $pdk->save();
                        
                        $idpk=$pdk->IdPhieuDKKB;
                        $idbn=$pdk->IdBN;
                        $hoten=$pdk->benhNhan->HoTen;
                        $ngaysinh=date( "d/m/Y", strtotime($pdk->benhNhan->NgaySinh));
                        $gt='Nam';
                        if($pdk->benhNhan->GioiTinh == 0){
                            $gt='Nam';
                        }
                        $dantoc= \comm_functions::decodeDanToc($pdk->benhNhan->DanToc);
                        $socmnd=$pdk->benhNhan->SoCMND;
                        $diachi="";
                        if($pdk->benhNhan->DiaChi == ''){
                            $diachi="Xã ".$pdk->benhNhan->phuongXa->TenXa.", huyện ".$pdk->benhNhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$pdk->benhNhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                        }
                        else{
                            $diachi=$pdk->benhNhan->DiaChi.", xã, ".$pdk->benhNhan->phuongXa->TenXa.", huyện ".$pdk->benhNhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$pdk->benhNhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                        }
                        $mathe='koco';$ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';
                        if(is_object($pdk->benhNhan->theBHYT)){
                            $mathe=$pdk->benhNhan->theBHYT->IdTheBHYT;
                            $ngaydk=date( "d/m/Y", strtotime($pdk->benhNhan->theBHYT->NgayDK));
                            $ngayhh=date( "d/m/Y", strtotime($pdk->benhNhan->theBHYT->NgayHH));
                            $noidk=$pdk->benhNhan->theBHYT->coSoKhamBHYT->TenCS;
                            $mh= \comm_functions::getMucHuongDTK($pdk->benhNhan->theBHYT->DoiTuongBHYT).'%';
                            $doituong= \comm_functions::getDTK($pdk->benhNhan->theBHYT->DoiTuongBHYT);
                        }
                        $pk[]=['stt'=>$pdk->STT, 'idpk'=>$idpk, 'idbn'=>$idbn, 'hoten'=>$hoten, 'ngaysinh'=>$ngaysinh, 'gt'=>$gt, 'dantoc'=>$dantoc, 'socmnd'=>$socmnd, 'diachi'=>$diachi, 'mathe'=>$mathe, 'ngaydk'=>$ngaydk, 'ngayhh'=>$ngayhh, 'noidk'=>$noidk, 'mh'=>$mh, 'doituong'=>$doituong, 'anh'=>$pdk->benhNhan->Anh, 'dtk'=>$pdk->KhamBHYT];
                    }
                    
                }
                $response = array(
                    'msg' => 'tc',
                    'pk'=> $pk
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
                $p=$request->idpk;
                $pdk= phieu_dk_kham::where('IdPhieuDKKB', $p)->get()->first();
                if(date('d/m/Y', strtotime($pdk->created_at)) == date('d/m/Y')){
                    $pdk->TrangThai=0;//trả về trạng thái chưa tiếp nhận
                    $pdk->save();
                    
                    $idpk=$pdk->IdPhieuDKKB;
                    $idbn=$pdk->IdBN;
                    $hoten=$pdk->benhNhan->HoTen;
                    $ngaysinh=date( "d/m/Y", strtotime($pdk->benhNhan->NgaySinh));
                    $gt='Nam';
                    if($pdk->benhNhan->GioiTinh == 0){
                        $gt='Nam';
                    }
                    $dantoc= \comm_functions::decodeDanToc($pdk->benhNhan->DanToc);
                    $socmnd=$pdk->benhNhan->SoCMND;
                    $diachi="";
                    if($pdk->benhNhan->DiaChi == ''){
                        $diachi="Xã ".$pdk->benhNhan->phuongXa->TenXa.", huyện ".$pdk->benhNhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$pdk->benhNhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $diachi=$pdk->benhNhan->DiaChi.", xã, ".$pdk->benhNhan->phuongXa->TenXa.", huyện ".$pdk->benhNhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$pdk->benhNhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    $mathe='koco';$ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';
                    if(is_object($pdk->benhNhan->theBHYT)){
                        $mathe=$pdk->benhNhan->theBHYT->IdTheBHYT;
                        $ngaydk=date( "d/m/Y", strtotime($pdk->benhNhan->theBHYT->NgayDK));
                        $ngayhh=date( "d/m/Y", strtotime($pdk->benhNhan->theBHYT->NgayHH));
                        $noidk=$pdk->benhNhan->theBHYT->coSoKhamBHYT->TenCS;
                        $mh= \comm_functions::getMucHuongDTK($pdk->benhNhan->theBHYT->DoiTuongBHYT).'%';
                        $doituong= \comm_functions::getDTK($pdk->benhNhan->theBHYT->DoiTuongBHYT);
                    }
                    $pk[]=['idpk'=>$idpk, 'idbn'=>$idbn, 'hoten'=>$hoten, 'ngaysinh'=>$ngaysinh, 'gt'=>$gt, 'dantoc'=>$dantoc, 'socmnd'=>$socmnd, 'diachi'=>$diachi, 'mathe'=>$mathe, 'ngaydk'=>$ngaydk, 'ngayhh'=>$ngayhh, 'noidk'=>$noidk, 'mh'=>$mh, 'stt'=>$pdk->STT, 'doituong'=>$doituong, 'anh'=>$pdk->benhNhan->Anh, 'dtk'=>$pdk->KhamBHYT];
                }
                $response = array(
                    'msg' => 'tc',
                    'pk'=>$pk
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
    
    public function postKTBA(Request $request){
        try{
            $bn= benh_nhan::where('IdBN', $request->mabn)->get()->first();
            $phieudk= phieu_dk_kham::where('IdPhieuDKKB', $request->mapdk)->get()->first();
            $msg='';$flag=FALSE;
            if($request->cc != ''){
                foreach($bn->phieuDkKham as $pdk){
                    if(!is_object($pdk->benhAnNoiTru) && $pdk->phongKham->Khoa->IdKhoa == $phieudk->phongKham->Khoa->IdKhoa)
                    {
                        $flag=TRUE;
                        break;
                    }
                }
            }
            else{
                foreach($bn->phieuDkKham as $pdk){
                    if(!is_object($pdk->benhAnNgoaiTru) && $pdk->phongKham->Khoa->IdKhoa == $phieudk->phongKham->Khoa->IdKhoa)
                    {
                        $flag=TRUE;
                        break;
                    }
                }
            }
            if($flag == FALSE){
                $msg='dang_dieu_tri';
            }
            else{
                $msg='kt_dieu_tri';
            }
            
            $response=array(
                'msg'=>$msg
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
    
    public function postTimKiem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            $key=$request->keyWords;
            $ds_benhan= DB::select("SELECT DISTINCT ba.`IdBANgoaiT` FROM tinh_tp AS tp JOIN quan_huyen AS qh ON tp.`IdTinh` = qh.`IdTinh` JOIN phuong_xa AS px ON qh.`IdHuyen` = px.`IdHuyen` JOIN benh_nhan AS bn ON px.`IdXa` =bn.`IdXa` JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON pk_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN chuan_doan_vs_benh_an_ngoai_tru AS cd ON ba.`IdBANgoaiT` = cd.`IdBANgoaiT` JOIN danh_muc_benh AS b ON cd.`IdBenh` = b.`IdBenh` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` WHERE nv.`IdNV` = N'".$idnv."' AND ((bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (tp.`TenTinh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (qh.`TenHuyen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (px.`TenXa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(bn.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN bn.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`SoCMND` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`SDT` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`DiaChi` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`DanToc` LIKE N'%".\comm_functions::changeTitle($key)."%' COLLATE utf8_unicode_ci) OR (b.`TenBenh` LIKE  N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN ba.`TTBN` = N'tinh_tao' THEN N'Tỉnh táo' WHEN ba.`TTBN` = N'hon_me' THEN N'Hôn mê' ELSE N'Hôn mê sâu' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN pdk.`KhamBHYT` = 0 THEN N'bhyt Bảo hiểm y tế' WHEN pdk.`KhamBHYT` = 1 THEN N'tp Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(ba.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY ba.created_at DESC");
            $dsba = array();
            $sl=0;
            if(!empty($ds_benhan)){
                foreach ($ds_benhan as $ba){
                    $benhan= benh_an_ngoai_tru::where('IdBANgoaiT', $ba->IdBANgoaiT)->get()->first();
                    if(!is_object($benhan->phieuDKKham->phieuDKKham->benhAnNoiTru)){
                        $benhnhan=$benhan->phieuDKKham->phieuDKKham->benhNhan;
                        $ngaysinh=date( "d/m/Y", strtotime($benhnhan->NgaySinh));

                        $gt="Nam";
                        if($benhnhan->GioiTinh == 0){
                            $gt="Nữ";
                        }

                        $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                        ? ((date("Y") - $birthDate[2]) - 1)
                        : (date("Y") - $birthDate[2]));

                        
                        $chuandoan=array();
                        foreach ($benhan->chuanDoan as $cd) {
                            $chuandoan[]=$cd->danhMucBenh->TenBenh;
                        }
                        $ngaybddt=\comm_functions::deDateFormat($benhan->created_at); 
                        $trangthaiba='Đang điều trị';
                        if($benhan->TrangThaiBA == 0){
                            $trangthaiba='Đã kết thúc điều trị';
                        }
                        $dttn='BHYT';
                        if($benhan->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                            $dttn='Thu phí';
                        }
                        $ttbn= array(
                            'hoten' => $benhnhan->HoTen,
                            'ngaysinh' => $ngaysinh,
                            'gt' => $gt,
                            'tuoi' => $age,
                            'chuandoan'=>$chuandoan,
                            'ngaybddt'=>$ngaybddt,
                            'songaydt'=>$benhan->SoNgayDT,
                            'trangthaiba'=>$trangthaiba,
                            'id' => $benhan->IdBANgoaiT,
                            'idbn' => $benhnhan->IdBN,
                            'idpdk'=>$benhan->phieuDKKham->phieuDKKham->IdPhieuDKKB,
                            'dttn'=>$dttn
                        );
                        
                        $dsba[]=$ttbn;
                        $sl++;
                    }
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'benhan'=>$dsba,
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
    
    public function postLayDSBA(){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $ds_benhan= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at','DESC')->get();
            $dsba = array();
            if(!empty($ds_benhan)){
                foreach ($ds_benhan as $benhan){
                    if(!is_object($benhan->phieuDKKham->phieuDKKham->benhAnNoiTru)){
                        $benhnhan=$benhan->phieuDKKham->phieuDKKham->benhNhan;
                        $ngaysinh=date( "d/m/Y", strtotime($benhnhan->NgaySinh));

                        $gt="Nam";
                        if($benhnhan->GioiTinh == 0){
                            $gt="Nữ";
                        }

                        $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                        ? ((date("Y") - $birthDate[2]) - 1)
                        : (date("Y") - $birthDate[2]));

                        
                        $chuandoan=array();
                        foreach ($benhan->chuanDoan as $cd) {
                            $chuandoan[]=$cd->danhMucBenh->TenBenh;
                        }
                        $ngaybddt= \comm_functions::deDateFormat($benhan->created_at); 
                        $trangthaiba='Đang điều trị';
                        if($benhan->TrangThaiBA == 0){
                            $trangthaiba='Đã kết thúc điều trị';
                        }
                        $dttn='BHYT';
                        if($benhan->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                            $dttn='Thu phí';
                        }
                        $ttba= array(
                            'hoten' => $benhnhan->HoTen,
                            'ngaysinh' => $ngaysinh,
                            'gt' => $gt,
                            'tuoi' => $age,
                            'chuandoan'=>$chuandoan,
                            'ngaybddt'=>$ngaybddt,
                            'songaydt'=>$benhan->SoNgayDT,
                            'trangthaiba'=>$trangthaiba,
                            'id' => $benhan->IdBANgoaiT,
                            'idbn' => $benhnhan->IdBN,
                            'idpdk'=>$benhan->phieuDKKham->phieuDKKham->IdPhieuDKKB,
                            'dttn'=>$dttn
                        );
                        $dsba[]=$ttba;
                    }
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'benhan'=>$dsba,
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
        $ds= benh_an_ngoai_tru::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $ba) {
                   if($ba->IdBANgoaiT == $ran){
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
