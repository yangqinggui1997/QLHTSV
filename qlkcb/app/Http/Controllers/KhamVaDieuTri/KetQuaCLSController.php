<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\KhamVaDieuTri\can_lam_sang;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\ket_qua_cls;
use App\Models\KhamVaDieuTri\ket_qua_cls_ct;
use App\Models\KhamVaDieuTri\anh_cls;
use App\Models\KhamVaDieuTri\ket_luan_cls;
use App\Events\KhamVaDieuTri\KetQuaCLS;
use Illuminate\Foundation\Auth\User;
use App\Models\HanhChinh\thong_ke;

class KetQuaCLSController extends Controller
{
    //
    
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $idpb=$user->nhanVien->phongBan->IdPB;
        
        $ds= can_lam_sang::where([['IdPB', $idpb], ['TamUng', 1]])->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('LoaiCD', 'DESC')->orderBy('created_at', 'DESC')->get();

        $dschotn=array();
        
        foreach ($ds as $value) {
            if(!is_object($value->ketQuaCLS)){
                $dschotn[]=$value;
            }
        }
        
        $dspkqcls= ket_qua_cls::where('IdNVTH', $idnv)->orderBy('created_at','DESC')->get();
        
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

        return view("kham_vs_dieu_tri.tra_ket_qua_cls", ['dschotn'=>$dschotn, 'dskqcls'=>$dspkqcls, 'dsbc'=>$sl]);
    }
    
    public function postThem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $cls= can_lam_sang::where('IdCLS',$request->macls)->get()->first();
            if(is_object($cls->ketQuaCLS)){
                $response = array(
                    'msg' => "trung"
                );
                return response()->json($response); 
            }
            else{
                $pkqcls= new ket_qua_cls;
                $pkqcls->IdCLS= $request->macls;
                $pkqcls->IdNVTH=$idnv;
                $pkqcls->IdKQCLS= KetQuaCLSController::TaoMaNN();

                $pkqcls->save();

                //thêm kết quả chi tiết
                if(strpos($request->kqclsct, ',')){//gửi nhiều kq
                    $kqct= explode(',', $request->kqclsct);
                    foreach ($kqct as $value) {
                        $kqclsct= new ket_qua_cls_ct;
                        $kqclsct->IdKQCLSCT= KetQuaCLSController::TaoMaNNCT();
                        $kqclsct->IdKQCLS=$pkqcls->IdKQCLS;
                        $kqclsct->KetQua=$value;
                        $kqclsct->save();
                    }
                }
                else{
                    $kqclsct= new ket_qua_cls_ct;
                    $kqclsct->IdKQCLSCT= KetQuaCLSController::TaoMaNNCT();
                    $kqclsct->IdKQCLS=$pkqcls->IdKQCLS;
                    $kqclsct->KetQua=$request->kqclsct;
                    $kqclsct->save();
                }

                //thêm luận cls
                if(strpos($request->klcls, ',')){//gửi nhiều kl
                    $klcls= explode(',', $request->klcls);
                    foreach ($klcls as $value) {
                        $klcls= new ket_luan_cls;
                        $klcls->IdKLCLS= KetQuaCLSController::TaoMaNNCT();
                        $klcls->IdKQCLS=$pkqcls->IdKQCLS;
                        $klcls->KetLuan=$value;
                        $klcls->save();
                    }
                }
                else{
                    $klcls= new ket_luan_cls;
                    $klcls->IdKLCLS= KetQuaCLSController::TaoMaNNCT();
                    $klcls->IdKQCLS=$pkqcls->IdKQCLS;
                    $klcls->KetLuan=$request->klcls;
                    $klcls->save();
                }
                if($request->hasFile('file')){
                    $files=$request->file('file');
                    foreach ($files as $file){
                        $duoi=$file->getClientOriginalExtension();
                        if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg'){
                            $response = array(
                                'msg' => "ko_ho_tro_kieu_file"
                            );
                            return response()->json($response); 
                        }
                        $anhcls =new anh_cls;
                        $anhcls->IdACLS= KetQuaCLSController::TaoMaNNAnhCLS();
                        $anhcls->IdKQCLS=$pkqcls->IdKQCLS;

                        $name=$file->getClientOriginalName();
                        $hinh=str_random(4)."_".$name;
                        while(file_exists('public/upload/anhcls/'.$hinh)){
                            $hinh=str_random(4)."_".$name;
                        }
                        $anhcls->Anh=$hinh;
                        $anhcls->save();

                        $file->move('public/upload/anhcls/',$hinh);       
                    }

                }

                event(new KetQuaCLS($pkqcls, 'them'));

                $response = array(
                    'msg' => 'tc',
                    'idkqcls'=>$pkqcls->IdKQCLS
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
    
    public function postLayTTCN(Request $request){
        try{
            $kqcls= ket_qua_cls::where('IdKQCLS', $request->id)->get()->first();
            $bn='';$pk='';$chuandoan='';$nvcd='';$yc=''; $ghichuyc='Không có';$ttbn='';$ktn='';
            if(is_object($kqcls->canLamSang->benhAnNgoaiTru)){
                $bn=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                $pk=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham;
                $ktn=$pk->phongKham->Khoa->TenKhoa;
                foreach ($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $kqct){
                    $chuandoan.='<option>'.$kqct->danhMucBenh->TenBenh.'</option>';
                }
                $nvcd=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                $yc=$kqcls->canLamSang->danhMucCLS->TenCLS;
                if($kqcls->canLamSang->GhiChu != ''){
                    $ghichuyc=$kqcls->canLamSang->GhiChu;
                }
                
                if($pk->DTTN=='tinh_tao'){
                    $ttbn='Tỉnh táo';
                }
                else if($pk->DTTN=='hon_me'){
                    $ttbn='Hôn mê';
                }
                else{
                    $ttbn='Hôn mê sâu';
                }
            }
            else if(is_object($kqcls->canLamSang->benhAnNoiTruCT)){
                $bn=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                $pk=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                $ktn=$pk->phongKham->Khoa->TenKhoa;
                foreach ($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan as $kqct){
                   $chuandoan.='<option>'.$kqct->danhMucBenh->TenBenh.'</option>';
                }
                $nvcd=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                $yc=$kqcls->canLamSang->danhMucCLS->TenCLS;
                if($kqcls->canLamSang->GhiChu != ''){
                    $ghichuyc=$kqcls->canLamSang->GhiChu;
                }
                if($pk->DTTN=='tinh_tao'){
                    $ttbn='Tỉnh táo';
                }
                else if($pk->DTTN=='hon_me'){
                    $ttbn='Hôn mê';
                }
                else{
                    $ttbn='Hôn mê sâu';
                }
            }
            
            $kq='';
            foreach ($kqcls->ketQuaCLSCT as $kqct){
                $kq.='<option value="'.$kqct->KetQua.'">'.$kqct->KetQua.'</option>';
            }
            $kl='';
            foreach ($kqcls->ketLuanCLS as $kqct){
                 $kl.='<option value="'.$kqct->KetLuan.'">'.$kqct->KetLuan.'</option>';
            }
            
            $ngaysinh=date( "d/m/Y", strtotime($bn->NgaySinh));
            
            $gt="Nam";
            if($bn->GioiTinh == 0){
                $gt="Nữ";
            }
            
            $diachi="";
            if($bn->DiaChi == ''){
                $diachi="Xã ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            else{
                $diachi=$bn->DiaChi.", xã, ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            $dantoc ="Chưa cập nhật!";
            if($bn->DanToc != ''){
                $dantoc = \comm_functions::decodeDanToc($bn->DanToc);
            }
            
            $scmnd="Chưa cập nhật!";
            if($bn->SoCMND != ''){
                $scmnd=$bn->SoCMND;
            }
            $loaicd='Thường';
            if($kqcls->canlamSang->LoaiCD == 1){
                $loaicd='Khẩn';
            }
            $mathe='koco';
            $ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';
            if(is_object($bn->theBHYT)){
                $mathe=$bn->theBHYT->IdTheBHYT;
                $ngaydk=date( "d/m/Y", strtotime($bn->theBHYT->NgayDK));
                $ngayhh=date( "d/m/Y", strtotime($bn->theBHYT->NgayHH));
                $doituong=\comm_functions::getDTK($bn->theBHYT->DoiTuongBHYT);
                $noidk=$bn->theBHYT->coSoKhamBHYT->TenCS;
                $mh= \comm_functions::getMucHuongDTK($bn->theBHYT->DoiTuongBHYT).'%';
            }
            
            $ttkqcls= array(
                'hoten' => $bn->HoTen,
                'ngaysinh'=>$ngaysinh,
                'gt'=>$gt,
                'mabn'=>$bn->IdBN,
                'diachi'=>$diachi,
                'ttbn'=>$ttbn,
                'nvcd'=>$kqcls->nhanVien->TenNV,
                'chuandoan'=>$chuandoan,
                'kq'=>$kq,
                'kl'=>$kl,
                'ktn'=>$ktn,
                'yc'=>$yc,
                'ghichu'=>$ghichuyc,
                'mathe' => $mathe,
                'idkqcls'=> $kqcls->IdKQCLS,
                'ngaydk'=>$ngaydk,
                'ngayhh'=>$ngayhh,
                'noidk'=>$noidk,
                'doituong'=>$doituong,
                'mh'=>$mh,
                'socmnd'=>$scmnd,
                'msg'=>'tc',
                'dantoc'=> $dantoc,
                'loaicd'=>$loaicd
            );

            return response()->json($ttkqcls);
        } catch (\Exception $e){
            $err=$e->getMessage();
            $response=array(
                'msg'=>$err
            );
            return response()->json($response);
        }
    }

    public function postSua(Request $request){
        try{
            $pkqcls= ket_qua_cls::where('IdKQCLS', $request->makqcls)->get()->first();
            
            if($pkqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->TrangThaiBA == 0){
                $response = array(
                    'msg' => 'ktdt'
                );
                return response()->json($response); 
            }
            
            if(count($pkqcls->ketQuaCLSCT) > 0){
                foreach ($pkqcls->ketQuaCLSCT as $value) {
                    $value->delete();
                }
            }
            if(count($pkqcls->ketLuanCLS) > 0){
                foreach ($pkqcls->ketLuanCLS as $value) {
                    $value->delete();
                }
            }
            $kq=[];
            //thêm kết quả chi tiết
            if(strpos($request->kqclsct, ',')){//gửi nhiều kq
                $kqct= explode(',', $request->kqclsct);
                foreach ($kqct as $value) {
                    $kq[]=$value;
                    $kqclsct= new ket_qua_cls_ct;
                    $kqclsct->IdKQCLSCT= KetQuaCLSController::TaoMaNNCT();
                    $kqclsct->IdKQCLS=$pkqcls->IdKQCLS;
                    $kqclsct->KetQua=$value;
                    $kqclsct->save();
                }
            }
            else{
                $kqclsct= new ket_qua_cls_ct;
                $kqclsct->IdKQCLSCT= KetQuaCLSController::TaoMaNNCT();
                $kqclsct->IdKQCLS=$pkqcls->IdKQCLS;
                $kqclsct->KetQua=$request->kqclsct;
                $kqclsct->save();
            }

            //thêm luận cls
            if(strpos($request->klcls, ',')){//gửi nhiều kl
                $klcls= explode(',', $request->klcls);
                foreach ($klcls as $value) {
                    $klcls= new ket_luan_cls;
                    $klcls->IdKLCLS= KetQuaCLSController::TaoMaNNCT();
                    $klcls->IdKQCLS=$pkqcls->IdKQCLS;
                    $klcls->KetLuan=$value;
                    $klcls->save();
                }
            }
            else{
                $klcls= new ket_luan_cls;
                $klcls->IdKLCLS= KetQuaCLSController::TaoMaNNCT();
                $klcls->IdKQCLS=$pkqcls->IdKQCLS;
                $klcls->KetLuan=$request->klcls;
                $klcls->save();
            }
            if($request->hasFile('file')){
                if($request->giuanh == ''){
                    if(count($pkqcls->anhCLS) > 0){
                        foreach ($pkqcls->anhCLS as $value) {
                            if(file_exists("public/upload/anhcls/".$value->Anh)){
                                unlink("public/upload/anhcls/".$value->Anh);
                            }
                            
                            $value->delete();
                        }
                    }
                }
                $files=$request->file('file');
                foreach ($files as $file){
                    $duoi=$file->getClientOriginalExtension();
                    if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg'){
                        $response = array(
                            'msg' => "ko_ho_tro_kieu_file"
                        );
                        return response()->json($response); 
                    }

                    $anhcls =new anh_cls;
                    $anhcls->IdACLS= KetQuaCLSController::TaoMaNNAnhCLS();
                    $anhcls->IdKQCLS=$pkqcls->IdKQCLS;

                    $name=$file->getClientOriginalName();
                    $hinh=str_random(4)."_".$name;
                    while(file_exists('public/upload/anhcls/'.$hinh)){
                        $hinh=str_random(4)."_".$name;
                    } 
                    $anhcls->Anh=$hinh;
                    $anhcls->save();

                    $file->move('public/upload/anhcls/',$hinh);   
                }
            }
            $p_kqcls= ket_qua_cls::where('IdKQCLS', $request->makqcls)->get()->first();
            event(new KetQuaCLS($p_kqcls, 'sua'));

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
    
    public function postKQ(Request $request){
        try{
            $kqcls='';
            if($request->idba != ''){
                $ds_kq=array();
                $banoi= benh_an_noi_tru_ct::where('IdBACT', $request->idba)->get()->first();
                $bangoai= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
                if(is_object($bangoai)){
                    if(is_object($bangoai->CanLamSang)){
                        foreach ($bangoai->CanLamSang as $cls){
                            if(is_object($cls->canLamSang->ketQuaCLS)){
                                $kqcls=$cls->canLamSang->ketQuaCLS;
                                $kq='';$i=1;
                                foreach ($kqcls->ketQuaCLSCT as $kqct){
                                    if($i == count($kqcls->ketQuaCLSCT)){
                                        $kq.='- '.$kqct->KetQua;
                                        break;
                                    }
                                    $kq.='- '.$kqct->KetQua.'<br>';
                                }
                                $kl='';$i=1;
                                foreach ($kqcls->ketLuanCLS as $kqct){
                                    if($i == count($kqcls->ketLuanCLS)){
                                        $kl.='- '.$kqct->KetLuan;
                                        break;
                                    }
                                    $kl.='- '.$kqct->KetLuan.'<br>';
                                }
                                $kqha='';$i=1;
                                if(count($kqcls->anhCLS) > 0){
                                    $kqha='<div class="row">';
                                    foreach ($kqcls->anhCLS as $kqct){
                                        if($i % 2 == 0 ){
                                            if($i < count($kqcls->anhCLS)){
                                                $kqha.='<div class="col-lg-6 m-b-15">
                                                    <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                                </div>
                                            </div>
                                            <div class="row">';
                                            }
                                            else{
                                                $kqha.='<div class="col-lg-6 m-b-15">
                                                    <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                                </div>
                                            </div>';
                                            }
                                        }
                                        else{
                                            if($i < count($kqcls->anhCLS)){
                                                $kqha.='<div class="col-lg-6 m-b-15">
                                                    <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                                    </div>';
                                            }
                                            else{
                                                $kqha.='<div class="col-lg-6 m-b-15">
                                                    <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                                </div>
                                            </div>';
                                            }
                                        }
                                        $i++;
                                    }
                                }
                                
                                $ttkqcls= array(
                                    'nvth'=>$kqcls->nhanVien->TenNV,
                                    'kq'=>$kq,
                                    'kl'=>$kl,
                                    'kqha'=>$kqha,
                                    'ngayth' => \comm_functions::deDateFormat($kqcls->created_at),
                                    'phong'=>$kqcls->canLamSang->phongBan->SoPhong.' - '.$kqcls->canLamSang->phongBan->TenPhong,
                                    'idkqcls'=> $kqcls->IdKQCLS,
                                    'msg'=>'cokq',
                                    'tencls'=>$kqcls->canLamSang->danhMucCLS->TenCLS
                                );
                                $ds_kq[]=$ttkqcls;      
                            }
                        }
                    }
                }
                else{
                    if(is_object($banoi)){
                        if(is_object($banoi->canLamSang)){
                            foreach ($banoi->canLamSang as $cls){
                                if(is_object($cls->canLamSang->ketQuaCLS)){
                                    $kqcls=$cls->canLamSang->ketQuaCLS;
                                    $kq='';$i=1;
                                    foreach ($kqcls->ketQuaCLSCT as $kqct){
                                        if($i == count($kqcls->ketQuaCLSCT)){
                                            $kq.='- '.$kqct->KetQua;
                                            break;
                                        }
                                        $kq.='- '.$kqct->KetQua.'<br>';
                                    }
                                    $kl='';$i=1;
                                    foreach ($kqcls->ketLuanCLS as $kqct){
                                        if($i == count($kqcls->ketLuanCLS)){
                                            $kl.='- '.$kqct->KetLuan;
                                            break;
                                        }
                                        $kl.='- '.$kqct->KetLuan.'<br>';
                                    }
                                    $kqha='<div class="row">';$i=1;
                                    foreach ($kqcls->anhCLS as $kqct){
                                        if($i % 2 == 0 ){
                                            if($i < count($kqcls->anhCLS)){
                                                $kqha.='<div class="col-lg-6 m-b-15">
                                                    <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                                </div>
                                            </div>
                                            <div class="row">';
                                            }
                                            else{
                                                $kqha.='<div class="col-lg-6 m-b-15">
                                                    <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                                </div>
                                            </div>';
                                            }
                                        }
                                        else{
                                            if($i < count($kqcls->anhCLS)){
                                                $kqha.='<div class="col-lg-6 m-b-15">
                                                    <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                                    </div>';
                                            }
                                            else{
                                                $kqha.='<div class="col-lg-6 m-b-15">
                                                    <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                                </div>
                                            </div>';
                                            }
                                        }
                                        $i++;
                                    }
                                    $ttkqcls= array(
                                        'nvth'=>$kqcls->nhanVien->TenNV,
                                        'kq'=>$kq,
                                        'kl'=>$kl,
                                        'kqha'=>$kqha,
                                        'ngayth' => \comm_functions::deDateFormat($kqcls->created_at),
                                        'phong'=>$kqcls->canLamSang->phongBan->SoPhong.' - '.$kqcls->canLamSang->phongBan->TenPhong,
                                        'idkqcls'=> $kqcls->IdKQCLS,
                                        'msg'=>'cokq',
                                        'tencls'=>$kqcls->canLamSang->danhMucCLS->TenCLS
                                    );
                                    $ds_kq[]=$ttkqcls;      
                                }
                            }
                        }
                    }
                }
                
                $response= array(
                    'kqcls' => $ds_kq,
                    'msg'=>'tc'
                );
                return response()->json($response); 
            }
            else if($request->idcls != ''){
                $cls= can_lam_sang::where('IdCLS', $request->idcls)->get()->first();
                $kq_cls=array();
                if(is_object($cls->ketQuaCLS)){
                    $kqcls=$cls->ketQuaCLS;
                    $kq='';$i=1;
                    foreach ($kqcls->ketQuaCLSCT as $kqct){
                        if($i == count($kqcls->ketQuaCLSCT)){
                            $kq.='- '.$kqct->KetQua;
                            break;
                        }
                        $kq.='- '.$kqct->KetQua.'<br>';
                    }
                    $kl='';$i=1;
                    foreach ($kqcls->ketLuanCLS as $kqct){
                        if($i == count($kqcls->ketLuanCLS)){
                            $kl.='- '.$kqct->KetLuan;
                            break;
                        }
                        $kl.='- '.$kqct->KetLuan.'<br>';
                    }
                    $kqha='';$i=1;
                    if(count($kqcls->anhCLS) > 0){
                        $kqha='<div class="row">';
                        foreach ($kqcls->anhCLS as $kqct){
                            if($i % 2 == 0 ){
                                if($i < count($kqcls->anhCLS)){
                                    $kqha.='<div class="col-lg-6 m-b-15">
                                        <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                    </div>
                                </div>
                                <div class="row">';
                                }
                                else{
                                    $kqha.='<div class="col-lg-6 m-b-15">
                                        <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                    </div>
                                </div>';
                                }
                            }
                            else{
                                if($i < count($kqcls->anhCLS)){
                                    $kqha.='<div class="col-lg-6 m-b-15">
                                        <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                        </div>';
                                }
                                else{
                                    $kqha.='<div class="col-lg-6 m-b-15">
                                        <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                    </div>
                                </div>';
                                }
                            }
                            $i++;
                        }
                    }

                    $ttkqcls= array(
                        'nvth'=>$kqcls->nhanVien->TenNV,
                        'kq'=>$kq,
                        'kl'=>$kl,
                        'kqha'=>$kqha,
                        'ngayth' => \comm_functions::deDateFormat($kqcls->created_at),
                        'phong'=>$cls->phongBan->SoPhong.' - '.$cls->phongBan->TenPhong,
                        'idkqcls'=> $kqcls->IdKQCLS,
                        'tencls'=>$cls->danhMucCLS->TenCLS
                    );  
                    $kq_cls[]=$ttkqcls;
                }
                $response= array(
                    'kqcls' => $kq_cls,
                    'msg'=>'tc'
                );
                return response()->json($response); 
            }
            else{
                $kqcls= ket_qua_cls::where('IdKQCLS', $request->id)->get()->first();
                if(is_object($kqcls)){
                    $kq=[];
                    foreach ($kqcls->ketQuaCLSCT as $kqct){
                        $kq[]=$kqct->KetQua;
                    }
                    $kl=[];
                    foreach ($kqcls->ketLuanCLS as $kqct){
                        $kl[]=$kqct->KetLuan;
                    }
                    $kqha=[];
                    foreach ($kqcls->anhCLS as $kqct){
                        $kqha[]=$kqct->Anh;
                    }
                    $ttkqcls= array(
                        'ketqua'=>$kq,
                        'ketluan'=>$kl,
                        'kqha'=>$kqha,
                        'ngayth' => \comm_functions::deDateFormat($kqcls->created_at),
                        'idkqcls'=> $kqcls->IdKQCLS,
                        'msg'=>'cokq',
                        'tencls'=>$kqcls->canLamSang->danhMucCLS->TenCLS
                    );
                    return response()->json($ttkqcls); 
                }
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
            $pcls=[];
            try{
                foreach ($arr as $a){
                    $kqcls= ket_qua_cls::where("IdKQCLS", $a)->get()->first();
                    if(date('d/m/Y', strtotime($kqcls->canLamSang->created_at)) == date('d/m/Y')){
                        $bn='';$pk='';$chuandoan='';$i=1;$nvcd='';$yc=''; $ghichuyc='Không có';$ttbn='';$ktn='';
                        if(is_object($kqcls->canLamSang->benhAnNgoaiTru)){
                            $bn=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                            $pk=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham;
                            $ktn=$pk->phongKham->Khoa->TenKhoa;
                            foreach ($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $kqct){
                                if($i == count($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan)){
                                    $chuandoan.=$kqct->danhMucBenh->TenBenh;
                                }
                                else{
                                    $chuandoan.=$kqct->danhMucBenh->TenBenh.'|';
                                }
                                $i++;
                            }
                            $nvcd=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                            $yc=$kqcls->canLamSang->danhMucCLS->TenCLS;
                            if($kqcls->canLamSang->GhiChu != ''){
                                $ghichuyc=$kqcls->canLamSang->GhiChu;
                            }
                            
                            if($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->DTTN=='tinh_tao'){
                                $ttbn='Tỉnh táo';
                            }
                            else if($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->DTTN=='hon_me'){
                                $ttbn='Hôn mê';
                            }
                            else{
                                $ttbn='Hôn mê sâu';
                            }
                        }
                        else if(is_object($kqcls->canLamSang->benhAnNoiTruCT)){
                            $bn=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                            $pk=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                            $ktn=$pk->phongKham->Khoa->TenKhoa;
                            foreach ($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan as $kqct){
                                if($i == count($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan)){
                                    $chuandoan.=$kqct->danhMucBenh->TenBenh;
                                }
                                else{
                                    $chuandoan.=$kqct->danhMucBenh->TenBenh.'|';
                                }
                                $i++;
                            }
                            $nvcd=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                            $yc=$kqcls->canLamSang->danhMucCLS->TenCLS;
                            if($kqcls->canLamSang->GhiChu != ''){
                                $ghichuyc=$kqcls->canLamSang->GhiChu;
                            }
                            if($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->DTTN=='tinh_tao'){
                                $ttbn='Tỉnh táo';
                            }
                            else if($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->DTTN=='hon_me'){
                                $ttbn='Hôn mê';
                            }
                            else{
                                $ttbn='Hôn mê sâu';
                            }
                        }

                        $kq='';$i=1;
                        foreach ($kqcls->ketQuaCLSCT as $kqct){
                            if($i == count($kqcls->ketQuaCLSCT)){
                                $kq.='- '.$kqct->KetQua;
                            }
                            else{
                                $kq.='- '.$kqct->KetQua.'<br>';
                            }
                            $i++;
                        }
                        $kl='';$i++;
                        foreach ($kqcls->ketLuanCLS as $kqct){
                            if($i == count($kqcls->ketLuanCLS)){
                                $kl.='- '.$kqct->KetLuan;
                            }
                            else{
                                $kl.='- '.$kqct->KetLuan.'<br>';
                            }
                            $i++;
                        }

                        $ngaysinh=date( "d/m/Y", strtotime($bn->NgaySinh));

                        $gt="Nam";
                        if($bn->GioiTinh == 0){
                            $gt="Nữ";
                        }
                        $scmnd="Chưa cập nhật!";
                        if($bn->SoCMND != ''){
                            $scmnd=$bn->SoCMND;
                        }
                        $loaicd='Thường';
                        if($kqcls->canlamSang->LoaiCD == 1){
                            $loaicd='Khẩn';
                        }
                        $diachi="";
                        if($bn->DiaChi == ''){
                            $diachi="Xã ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
                        }
                        else{
                            $diachi=$bn->DiaChi.", xã, ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
                        }
                        $dantoc ="Chưa cập nhật!";
                        if($bn->DanToc != ''){
                            $dantoc = \comm_functions::decodeDanToc($bn->DanToc);
                        }

                        $mathe='koco';
                        $ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';$bh='';
                        if(is_object($bn->theBHYT)){
                            $mathe=$bn->theBHYT->IdTheBHYT;
                            $ngaydk=date( "d/m/Y", strtotime($bn->theBHYT->NgayDK));
                            $ngayhh=date( "d/m/Y", strtotime($bn->theBHYT->NgayHH));
                            $doituong= \comm_functions::getDTK($bn->theBHYT->DoiTuongBHYT);
                            $noidk=$bn->theBHYT->coSoKhamBHYT->TenCS;
                            $mh= \comm_functions::getMucHuongDTK($bn->theBHYT->DoiTuongBHYT).'%';
                            $bh='data-mathe="'.$mathe.'" 
                            data-ngaydk="'.$ngaydk.'"
                            data-ngayhh="'.$ngayhh.'"
                            data-noidk="'.$noidk.'"
                            data-doituong="'.$doituong.'"
                            data-mh="'.$mh.'"';
                        }
                        else{
                            $bh='data-mathe="'.$mathe.'"';
                        }
                        $item='<option 
                            value="'.$kqcls->canLamSang->IdCLS.'" 
                            data-idbn="'.$bn->IdBN.'"
                            data-hotenbn="'.$bn->HoTen.'" 
                            data-ngaysinh="'.$ngaysinh.'" 
                            data-gt="'.$gt.'" 
                            data-dantoc="'.$dantoc.'"
                            data-socmnd="'.$scmnd.'"
                            data-diachi="'.$diachi.'"
                            data-chuandoan="'.$chuandoan.'"
                            data-nvcd="'.$nvcd.'"
                            data-yc="'.$yc.'"
                            data-ghichuyc="'.$ghichuyc.'"
                            data-loaicd="'.$loaicd.'"
                            data-loaicdcode="'.$kqcls->canLamSang->LoaiCD.'"
                            data-ttbn="'.$ttbn.'"
                            data-ktn="'.$ktn.'"'.$bh.'>'.$bn->HoTen.' - P.Khám '.$pk->phongKham->TenPhong.' ('.$loaicd.')</option>';
                        $pcls[]=$item;
                    }
                    
                    if(count($kqcls->ketQuaCLSCT) > 0){
                        foreach($kqcls->ketQuaCLSCT as $kq){
                            $kq->delete();
                        }
                    }
                    if(count($kqcls->ketLuanCLS) > 0){
                        foreach($kqcls->ketLuanCLS as $kl){
                            $kl->delete();
                        }
                    }
                    if(count($kqcls->anhCLS) > 0){
                        foreach($kqcls->anhCLS as $a){
                            if(file_exists("public/upload/anhcls/".$a->Anh)){
                                unlink("public/upload/anhcls/".$a->Anh);
                            }
                            
                            $a->delete();
                        }
                    }
                    
                    $kqcls->delete();
                }
                
                event(new KetQuaCLS($arr, 'xoa'));
                
                $response = array(
                    'msg' => 'tc',
                    'pcls'=>$pcls
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
                $pcls=[];
                $kqcls= ket_qua_cls::where("IdKQCLS", $request->id)->get()->first();
                if(date('d/m/Y', strtotime($kqcls->canLamSang->created_at)) == date('d/m/Y')){
                    $bn='';$pk='';$chuandoan='';$i=1;$nvcd='';$yc=''; $ghichuyc='Không có';$ttbn='';$ktn='';
                    if(is_object($kqcls->canLamSang->benhAnNgoaiTru)){
                        $bn=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                        $pk=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham;
                        $ktn=$pk->phongKham->Khoa->TenKhoa;
                        foreach ($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $kqct){
                            if($i == count($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan)){
                                $chuandoan.=$kqct->danhMucBenh->TenBenh;
                            }
                            else{
                                $chuandoan.=$kqct->danhMucBenh->TenBenh.'|';
                            }
                            $i++;
                        }
                        $nvcd=$kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                        $yc=$kqcls->canLamSang->danhMucCLS->TenCLS;
                        if($kqcls->canLamSang->GhiChu != ''){
                            $ghichuyc=$kqcls->canLamSang->GhiChu;
                        }
                        if($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->DTTN=='tinh_tao'){
                            $ttbn='Tỉnh táo';
                        }
                        else if($kqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->DTTN=='hon_me'){
                            $ttbn='Hôn mê';
                        }
                        else{
                            $ttbn='Hôn mê sâu';
                        }
                    }
                    else if(is_object($kqcls->canLamSang->benhAnNoiTruCT)){
                        $bn=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                        $pk=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                        $ktn=$pk->phongKham->Khoa->TenKhoa;
                        foreach ($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan as $kqct){
                            if($i == count($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->chuanDoan)){
                                $chuandoan.=$kqct->danhMucBenh->TenBenh;
                            }
                            else{
                                $chuandoan.=$kqct->danhMucBenh->TenBenh.'|';
                            }
                            $i++;
                        }
                        $nvcd=$kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                        $yc=$kqcls->canLamSang->danhMucCLS->TenCLS;
                        if($kqcls->canLamSang->GhiChu != ''){
                            $ghichuyc=$kqcls->canLamSang->GhiChu;
                        }
                        if($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->DTTN=='tinh_tao'){
                            $ttbn='Tỉnh táo';
                        }
                        else if($kqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->DTTN=='hon_me'){
                            $ttbn='Hôn mê';
                        }
                        else{
                            $ttbn='Hôn mê sâu';
                        }
                    }

                    $kq='';$i=1;
                    foreach ($kqcls->ketQuaCLSCT as $kqct){
                        if($i == count($kqcls->ketQuaCLSCT)){
                            $kq.='- '.$kqct->KetQua;
                        }
                        else{
                            $kq.='- '.$kqct->KetQua.'<br>';
                        }
                        $i++;
                    }
                    $kl='';$i++;
                    foreach ($kqcls->ketLuanCLS as $kqct){
                        if($i == count($kqcls->ketLuanCLS)){
                            $kl.='- '.$kqct->KetLuan;
                        }
                        else{
                            $kl.='- '.$kqct->KetLuan.'<br>';
                        }
                        $i++;
                    }

                    $ngaysinh=date( "d/m/Y", strtotime($bn->NgaySinh));

                    $gt="Nam";
                    if($bn->GioiTinh == 0){
                        $gt="Nữ";
                    }
                    $scmnd="Chưa cập nhật!";
                    if($bn->SoCMND != ''){
                        $scmnd=$bn->SoCMND;
                    }
                    $loaicd='Thường';
                    if($kqcls->canlamSang->LoaiCD == 1){
                        $loaicd='Khẩn';
                    }
                    $diachi="";
                    if($bn->DiaChi == ''){
                        $diachi="Xã ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $diachi=$bn->DiaChi.", xã, ".$bn->phuongXa->TenXa.", huyện ".$bn->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$bn->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    $dantoc ="Chưa cập nhật!";
                    if($bn->DanToc != ''){
                        $dantoc = \comm_functions::decodeDanToc($bn->DanToc);
                    }

                    $mathe='koco';
                    $ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';$bh='';
                    if(is_object($bn->theBHYT)){
                        $mathe=$bn->theBHYT->IdTheBHYT;
                        $ngaydk=date( "d/m/Y", strtotime($bn->theBHYT->NgayDK));
                        $ngayhh=date( "d/m/Y", strtotime($bn->theBHYT->NgayHH));
                        $doituong= \comm_functions::getDTK($bn->theBHYT->DoiTuongBHYT);
                        $noidk=$bn->theBHYT->coSoKhamBHYT->TenCS;
                        $mh= \comm_functions::getMucHuongDTK($bn->theBHYT->DoiTuongBHYT).'%';
                        $bh='data-mathe="'.$mathe.'" 
                        data-ngaydk="'.$ngaydk.'"
                        data-ngayhh="'.$ngayhh.'"
                        data-noidk="'.$noidk.'"
                        data-doituong="'.$doituong.'"
                        data-mh="'.$mh.'"';
                    }
                    else{
                        $bh='data-mathe="'.$mathe.'"';
                    }
                    $item='<option 
                        value="'.$kqcls->canLamSang->IdCLS.'" 
                        data-idbn="'.$bn->IdBN.'"
                        data-hotenbn="'.$bn->HoTen.'" 
                        data-ngaysinh="'.$ngaysinh.'" 
                        data-gt="'.$gt.'" 
                        data-dantoc="'.$dantoc.'"
                        data-socmnd="'.$bn->SoCMND.'"
                        data-diachi="'.$diachi.'"
                        data-chuandoan="'.$chuandoan.'"
                        data-nvcd="'.$nvcd.'"
                        data-yc="'.$yc.'"
                        data-ghichuyc="'.$ghichuyc.'"
                        data-loaicd="'.$loaicd.'"
                        data-loaicdcode="'.$kqcls->canLamSang->LoaiCD.'"
                        data-ttbn="'.$ttbn.'"
                        data-ktn="'.$ktn.'"'.$bh.'>'.$bn->HoTen.' - P.Khám '.$pk->phongKham->TenPhong.' ('.$loaicd.')</option>';
                    $pcls[]=$item;
                }  
                
                if(count($kqcls->ketQuaCLSCT) > 0){
                    foreach($kqcls->ketQuaCLSCT as $kq){
                        $kq->delete();
                    }
                }
                if(count($kqcls->ketLuanCLS) > 0){
                    foreach($kqcls->ketLuanCLS as $kl){
                        $kl->delete();
                    }
                }
                if(count($kqcls->anhCLS) > 0){
                    foreach($kqcls->anhCLS as $a){
                        if(file_exists("public/upload/anhcls/".$a->Anh)){
                            unlink("public/upload/anhcls/".$a->Anh);
                        }
                        
                        $a->delete();
                    }
                }

                $kqcls->delete();
                event(new KetQuaCLS($request->id, 'xoa'));
                
                $response = array(
                    'msg' => 'tc',
                    'pcls'=>$pcls
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
        try {
            $pkqcls= ket_qua_cls::where('IdKQCLS', $request->idkqcls)->get()->first();
            if(is_object($pkqcls)){
                $kq='';
                if(count($pkqcls->ketQuaCLSCT)>0){
                    foreach ($pkqcls->ketQuaCLSCT as $value) {
                        $kq.='<div class="row">
                            <div class="col-lg-12">
                                <label style="margin-bottom: 0;">- '. mb_convert_case($value->KetQua, MB_CASE_UPPER, 'utf-8').'</label>
                            </div>
                        </div>';
                    }
                }
                $kl='';
                if(count($pkqcls->ketLuanCLS)>0){
                    foreach ($pkqcls->ketLuanCLS as $value) {
                        $kl.='<div class="row">
                            <div class="col-lg-12">
                                <label style="margin-bottom: 0;">- '. mb_convert_case($value->KetLuan, MB_CASE_UPPER, 'utf-8').'</label>
                            </div>
                        </div>';
                    }
                }
                $kqha='';
                if(count($pkqcls->anhCLS)>0){
                    $i=1;
                    $kqha='<div class="row">';
                    foreach ($pkqcls->anhCLS as $value) {
                        if($i % 4 == 0){
                            if($i == count($pkqcls->anhCLS)){
                                $kqha.='<div class="col-lg-3 text-center  m-b-5"">
                                        <img class="height-100px" src="public/upload/anhcls/'.$value->Anh.'">
                                    </div>
                                </div>';
                            }
                            else{
                                $kqha.='<div class="col-lg-3 text-center  m-b-5"">
                                        <img class="height-100px" src="public/upload/anhcls/'.$value->Anh.'">
                                    </div>
                                </div>
                                <div class="row">';
                            }
                        }
                        else{
                            if($i <count($pkqcls->anhCLS)){
                                $kqha.='<div class="col-lg-3 text-center  m-b-5"">
                                        <img class="height-100px" src="public/upload/anhcls/'.$value->Anh.'">
                                    </div>';
                            }
                            else{
                                $kqha.='<div class="col-lg-3 text-center  m-b-5"">
                                        <img class="height-100px" src="public/upload/anhcls/'.$value->Anh.'">
                                    </div>
                                </div>';
                            }
                        }
                        $i++;
                    }
                }
                //lấy thông tin liên quan đến bệnh nhân
                $ba='';$benhnhan='';$phongkam='';$nv='';
                if(is_object($pkqcls->canLamSang->benhAnNgoaiTru)){
                    $ba=$pkqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru;
                    $benhnhan=$pkqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $phongkam=$pkqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->phongKham;
                    
                    $nv= $pkqcls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien;
                }
                else if(is_object($pkqcls->canLamSang->benhAnNoiTruCT)){
                    $ba=$pkqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru;
                    $benhnhan=$pkqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $phongkam=$pkqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham;
                    $nv= $pkqcls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien;
                }
                
                
                $tang='TRIỆT';
                if($tang != 0){
                    $tang='LẦU '.$nv->phongBan->Tang;
                }
                $pk='P.KHÁM '.mb_convert_case($nv->phongBan->Khoa->TenKhoa, MB_CASE_UPPER, 'utf-8').' ('.$nv->phongBan->SoPhong.')';
                $bare_code_mabn=\Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($benhnhan->IdBN, "C128", 1.3, 25);
                $dtk='THU PHÍ';
                if(is_object($benhnhan->theBHYT)){
                    if($pk->KhamBHYT == 0){
                        $dtk='BHYT ('.\comm_functions::getMucHuongDTK($benhnhan->theBHYT->DoiTuongBHYT).'%) - QL'.substr($benhnhan->theBHYT->IdTheBHYT, 2, 1);
                    }
                }

                $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
                $tuoi = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));
                $gt='Nam';
                if($benhnhan->GioiTinh == 0){
                    $gt='Nữ';
                }

                $diachi="";
                if($benhnhan->DiaChi == ''){
                    $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                }
                else{
                    $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                }
                $chuandoan='';$i=1;
                foreach ($ba->chuanDoan as $cd) {
                    if($i == count($ba->chuanDoan))
                    {
                        $chuandoan.=$cd->danhMucBenh->TenBenh.'('.$cd->danhMucBenh->IdBenh.')';
                    }
                    else{
                        $chuandoan.=$cd->danhMucBenh->TenBenh.'('.$cd->danhMucBenh->IdBenh.')'.';&nbsp';
                    }

                    $i++;
                }

                $bn= array(
                    'hoten'=>$benhnhan->HoTen,
                    'pk'=>$pk,
                    'barcode'=>$bare_code_mabn,
                    'mabn'=>$benhnhan->IdBN,
                    'dttn'=>$dtk,
                    'tuoi'=>$tuoi,
                    'gt'=>$gt,
                    'diachi'=>$diachi,
                    'chuandoan'=>$chuandoan,
                    'nvcd'=>$nv->TenNV,
                    'nvth'=>$pkqcls->nhanVien->TenNV,
                    'tenkhoa'=>$phongkam->Khoa->TenKhoa,
                    'namsinh'=>date('Y', strtotime($benhnhan->NgaySinh)),
                    'tencls'=>$pkqcls->canLamSang->danhMucCLS->TenCLS
                );

                $data= array(
                    'kqha'=>$kqha,
                    'kq'=>$kq,
                    'kl'=>$kl
                );
                $response=array(
                    'data'=>$data,
                    'bn'=>$bn,
                    'msg'=>'tc'
                );
                return response()->json($response);
            }
            else{
                $response=array(
                    'msg'=>'kott'
                );
                return response()->json($response);
            }
            
        } catch (\Exception $ex) {
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
            $ds_pkq= DB::select("SELECT DISTINCT a.* FROM ( 
(select kqcls.`IdKQCLS` FROM ket_qua_cls_ct AS kqct JOIN ket_qua_cls AS kqcls ON kqct.`IdKQCLS` = kqcls.`IdKQCLS` JOIN ket_luan_cls AS kl ON kl.`IdKQCLS` = kqcls.`IdKQCLS` JOIN can_lam_sang AS cls ON kqcls.`IdCLS` = cls.`IdCLS` JOIN benh_an_ngoai_tru_vs_can_lam_sang  AS bangoai_cls ON bangoai_cls.`IdCLS` = cls.`IdCLS` JOIN benh_an_ngoai_tru AS bangoai ON bangoai.`IdBANgoaiT` = bangoai_cls.`IdBANgoaiT` JOIN chuan_doan_vs_benh_an_ngoai_tru AS cd_bangoai ON cd_bangoai.`IdBANgoaiT` = bangoai.`IdBANgoaiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_bangoai.`IdBenh` JOIN nhan_vien AS nv ON nv.`IdNV` = bangoai.`IdNV` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pdk_bangoai ON pdk_bangoai.`IdBANgoaiT` = bangoai.`IdBANgoaiT` JOIN phieu_dk_kham AS pdk ON pdk.`IdPhieuDKKB` = pdk_bangoai.`IdPhieuDKKB` JOIN benh_nhan AS bn ON bn.`IdBN` = pdk.`IdBN` 

WHERE kqcls.`IdNVTH` = N'".$idnv."' AND ((nv.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(kqcls.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (kl.`KetLuan` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (kqct.`KetQua` LIKE N'%".$key."%' COLLATE utf8_unicode_ci)  OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmb.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'BHYT Bảo hiểm y tế' ELSE N'TP Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY kqcls.created_at DESC)

UNION ALL

(select kqcls.`IdKQCLS` FROM ket_qua_cls_ct AS kqct JOIN ket_qua_cls AS kqcls ON kqct.`IdKQCLS` = kqcls.`IdKQCLS` JOIN ket_luan_cls AS kl ON kl.`IdKQCLS` = kqcls.`IdKQCLS` JOIN can_lam_sang AS cls ON kqcls.`IdCLS` = cls.`IdCLS` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS banoi_cls ON banoi_cls.`IdCLS` = cls.`IdCLS` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBACT` = banoi_cls.`IdBACT` JOIN benh_an_noi_tru AS banoi ON banoi.`IdBANoiT` = bact.`IdBANoiT` JOIN chuan_doan_vs_benh_an_noi_tru AS cd_banoi ON cd_banoi.`IdBANoiT` = banoi.`IdBANoiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_banoi.`IdBenh` JOIN nhan_vien AS nv ON nv.`IdNV` = banoi.`IdNV` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pdk_banoi ON pdk_banoi.`IdBANoiT` = banoi.`IdBANoiT` JOIN phieu_dk_kham AS pdk ON pdk.`IdPhieuDKKB` = pdk_banoi.`IdPhieuDKKB` JOIN benh_nhan AS bn ON bn.`IdBN` = pdk.`IdBN` 
WHERE kqcls.`IdNVTH` = N'".$idnv."' AND ((nv.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(kqcls.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (kl.`KetLuan` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (kqct.`KetQua` LIKE N'%".$key."%' COLLATE utf8_unicode_ci)  OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmb.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'BHYT Bảo hiểm y tế' ELSE N'TP Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY kqcls.created_at DESC)
) AS a");
            $dspkq = array();
            $sl=0;
            if(!empty($ds_pkq)){
                foreach ($ds_pkq as $pkq){
                    $kqcls= ket_qua_cls::where('IdKQCLS', $pkq->IdKQCLS)->get()->first();
                    $bn='';$dttn='BHYT';$chuandoan='';$nvcd='';$i=1;
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
                        $i=1;
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
                    $kq=[];
                    foreach ($kqcls->ketQuaCLSCT as $kqct){
                        $kq[]=$kqct->KetQua;
                    }
                    $kl=[];
                    foreach ($kqcls->ketLuanCLS as $kqct){
                        $kl[]=$kqct->KetLuan;
                    }
                    $kqha=[];
                    foreach ($kqcls->anhCLS as $kqct){
                        $kqha[]=$kqct->Anh;
                    }
                    $ttkqcls= array(
                        'hoten' => $bn->HoTen,
                        'dttn'=>$dttn,
                        'nvcd'=>$nvcd,
                        'nvth'=>$kqcls->nhanVien->TenNV,
                        'phong'=>$kqcls->canLamSang->phongBan->SoPhong.' - '.$kqcls->canLamSang->phongBan->TenPhong,
                        'chuandoan'=>$chuandoan,
                        'kq'=>$kq,
                        'kl'=>$kl,
                        'ngayth' => \comm_functions::deDateFormat($kqcls->created_at),
                        'idkqcls'=> $kqcls->IdKQCLS,
                        'tencls'=>$kqcls->canLamSang->danhMucCLS->TenCLS,
                        'kqha'=>$kqha
                    );
                    
                    $dspkq[]=$ttkqcls;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'kqcls'=>$dspkq,
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
    
    public function postLayDSKQCLS(){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $dspkqcls= ket_qua_cls::where('IdNVTH', $idnv)->orderBy('created_at','DESC')->get();
            $dskq=array();
            foreach ($dspkqcls as $kqcls) {
                $bn='';$dttn='BHYT';$chuandoan='';$nvcd='';$i=1;
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
                    $i=1;
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
                $kq=[];
                foreach ($kqcls->ketQuaCLSCT as $kqct){
                    $kq[]=$kqct->KetQua;
                }
                $kl=[];
                foreach ($kqcls->ketLuanCLS as $kqct){
                    $kl[]=$kqct->KetLuan;
                }
                $kqha=[];
                foreach ($kqcls->anhCLS as $kqct){
                    $kqha[]=$kqct->Anh;
                }
                $ttkqcls= array(
                    'hoten' => $bn->HoTen,
                    'dttn'=>$dttn,
                    'nvcd'=>$nvcd,
                    'nvth'=>$kqcls->nhanVien->TenNV,
                    'phong'=>$kqcls->canLamSang->phongBan->SoPhong.' - '.$kqcls->canLamSang->phongBan->TenPhong,
                    'chuandoan'=>$chuandoan,
                    'kq'=>$kq,
                    'kl'=>$kl,
                    'ngayth' => \comm_functions::deDateFormat($kqcls->created_at),
                    'idkqcls'=> $kqcls->IdKQCLS,
                    'tencls'=>$kqcls->canLamSang->danhMucCLS->TenCLS,
                    'kqha'=>$kqha
                );
                $dskq[]=$ttkqcls;
            }
            
            $response = array(
                'msg' => 'tc',
                'kqcls'=>$dskq
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
    
    public static function TaoMaNN(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= ket_qua_cls::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $kq) {
                   if($kq->IdKQCLS == $ran){
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
        $ds= ket_qua_cls_ct::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $kqct) {
                   if($kqct->IdKQCLSCT == $ran){
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
    
    public static function TaoMaNNKLCLS(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= ket_qua_cls::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $kl) {
                   if($kl->IdKLCLS == $ran){
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
    
    public static function TaoMaNNAnhCLS(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= anh_cls::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $acls) {
                   if($acls->IdACLS == $ran){
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
