<?php

namespace App\Http\Controllers\KeToan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhamVaDieuTri\can_lam_sang;
use App\Models\KhamVaDieuTri\chi_dinh_tt;
use App\Models\KhamVaDieuTri\chi_dinh_pt;
use App\Models\KeToan\tam_ung_cls;
use App\Models\KeToan\tam_ung_tt;
use App\Models\KeToan\tam_ung_pt;
use App\Events\KhamVaDieuTri\CanLamSang;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class tamUngController extends Controller
{
    //
    
    public function getDanhSach(){
        $arr=array();
        $dscls= can_lam_sang::where('TamUng', 0)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('LoaiCD', 'DESC')->orderBy('created_at', 'DESC')->get();
        $arr[]=['loaidv'=>'cls', 'dsdv'=>$dscls];
        $dstt= chi_dinh_tt::where('TamUng', 0)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('LoaiCD', 'DESC')->orderBy('created_at', 'DESC')->get();
        $arr[]=['loaidv'=>'tt', 'dsdv'=>$dstt];
        $dspt= chi_dinh_pt::where('TamUng', 0)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('LoaiCD', 'DESC')->orderBy('created_at', 'DESC')->get();
        $arr[]=['loaidv'=>'pt', 'dsdv'=>$dspt];
        return view("ke_toan.tam_ung", ['dsdv'=>$arr]);
    } 
    
    public function getDanhSachLS(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $arr=array();
        $dscls= tam_ung_cls::where('IdNVLap', $idnv)->orderBy('created_at', 'DESC')->get();
        $arr[]=['loaidv'=>'cls', 'dsptu'=>$dscls];
        $dstt= tam_ung_tt::where('IdNVLap', $idnv)->orderBy('created_at', 'DESC')->get();
        $arr[]=['loaidv'=>'tt', 'dsptu'=>$dstt];
        $dspt= tam_ung_pt::where('IdNVLap', $idnv)->orderBy('created_at', 'DESC')->get();
        $arr[]=['loaidv'=>'pt', 'dsptu'=>$dspt];
        return view("ke_toan.lich_su_dong_tam_ung", ['dsptu'=>$arr]);
    } 
    
    public function postXoa(Request $request){
        if(strpos($request->id, ',')){//gửi nhiều mã
            $arr= explode(',',$request->id);
            try{
                foreach ($arr as $a){
                    $ta_cls= tam_ung_cls::where("IdTA", $a)->get()->first();
                    $ta_tt= tam_ung_tt::where("IdTA", $a)->get()->first();
                    $ta_pt= tam_ung_pt::where("IdTA", $a)->get()->first();
                    if(is_object($ta_cls)){
                        $ta_cls->canLamSang->TamUng=0;
                        $ta_cls->canLamSang->save();
                        
                        $ta_cls->delete();
                    }
                    if(is_object($ta_tt)){
                        $ta_tt->chiDinhTT->TamUng=0;
                        $ta_tt->chiDinhTT->save();
                        
                        $ta_tt->delete();
                    }
                    if(is_object($ta_pt)){
                        $ta_pt->chiDinhPT->TamUng=0;
                        $ta_pt->chiDinhPT->save();
                        
                        $ta_pt->delete();
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
                $ta_cls= tam_ung_cls::where("IdTA", $request->id)->get()->first();
                $ta_tt= tam_ung_tt::where("IdTA", $request->id)->get()->first();
                $ta_pt= tam_ung_pt::where("IdTA", $request->id)->get()->first();
                if(is_object($ta_cls)){
                    $ta_cls->canLamSang->TamUng=0;
                    $ta_cls->canLamSang->save();
                    
                    $ta_cls->delete();
                }
                if(is_object($ta_tt)){
                    $ta_tt->chiDinhTT->TamUng=0;
                    $ta_tt->chiDinhTT->save();
                    
                    $ta_tt->delete();
                }
                if(is_object($ta_pt)){
                    $ta_pt->chiDinhPT->TamUng=0;
                    $ta_pt->chiDinhPT->save();
                    
                    $ta_pt->delete();
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
    
    public function postXNTU(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $hoten='';$khoa='';$dv='';$stu='';
            if($request->loaidv == 'cls'){
                $cls= can_lam_sang::where('IdCLS', $request->id)->get()->first();
                if(!is_object($cls)){
                    $response = array(
                        'msg' => 'ktt'
                    );
                    return response()->json($response); 
                }
                $dv=$cls->danhMucCLS->TenCLS;
                $st=0;
                if(is_object($cls->benhAnNgoaiTru)){
                    $benhnhan=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $hoten=$benhnhan->HoTen;
                    $khoa=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa;
                    $pdk=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham;
                    if($pdk->KhamBHYT == 0){
                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                            $tttbhyt=($cls->danhMucCLS->BHYTTT / 100)*($cls->danhMucCLS->DonGia);
                            $ttqbhyt= $tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100);
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$cls->danhMucCLS->DonGia - $tttbhyt;
                            
                            $st= ($tnbcct + $tnbtt) / 2;
                        }
                        else{
                            $st=$cls->danhMucCLS->DonGia / 2;
                        }
                    }
                    else{
                        $st=$cls->danhMucCLS->DonGia / 2;
                    }
                }
                else if(is_object($cls->benhAnNoiTruCT)){
                    $benhnhan=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $hoten=$benhnhan->HoTen;
                    $khoa=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa;
                    $pdk=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                    if($pdk->KhamBHYT == 0){
                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                            $tttbhyt=($cls->danhMucCLS->BHYTTT / 100)* $cls->danhMucCLS->DonGia;
                            $ttqbhyt= $tttbhyt * (($benhnhan->theBHYT->BHYTHoTro)/100);
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$cls->danhMucCLS->DonGia - $tttbhyt;
                            
                            $st= ($tnbcct + $tnbtt) / 2;
                        }
                        else{
                            $tttbhyt=($cls->danhMucCLS->BHYTTT / 100)*$cls->danhMucCLS->DonGia;
                            $ttqbhyt= ($tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100))*0.6;
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$cls->danhMucCLS->DonGia - $tttbhyt;
                            
                            $st= ($tnbcct + $tnbtt) / 2;
                        }
                    }
                    else{
                        $st=$cls->danhMucCLS->DonGia / 2;
                    }
                }
                
                $cls->TamUng=1;
                $cls->save();
                
                $ta_cls=new tam_ung_cls;
                $ta_cls->IdTA= tamUngController::TaoMaNNTACLS();
                $ta_cls->IdNVLap=$idnv;
                $ta_cls->IdCLS=$cls->IdCLS;
                $ta_cls->TamUng=$st;
                
                $ta_cls->save();
                $stu=$ta_cls->IdTA;
                
                event(new CanLamSang($cls, 'chuyendv'));
                
                
            }
            else if($request->loaidv == 'tt'){
                $tt= chi_dinh_tt::where('IdThuThuat', $request->id)->get()->first();
                if(!is_object($tt)){
                    $response = array(
                        'msg' => 'ktt'
                    );
                    return response()->json($response); 
                }
                $dv=$tt->danhMucCLS->TenCLS;
                $st=0;
                if(is_object($tt->benhAnNgoaiTru)){
                    $benhnhan=$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $hoten=$benhnhan->HoTen;
                    $khoa=$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa;
                    $pdk=$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham;
                    if($pdk->KhamBHYT == 0){
                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                            $tttbhyt=($tt->danhMucCLS->BHYTTT / 100)*($tt->danhMucCLS->DonGia);
                            $ttqbhyt= $tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100);
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$tt->danhMucCLS->DonGia - $tttbhyt;
                            
                            $st= ($tnbcct + $tnbtt) / 2;
                        }
                        else{
                            $st=$tt->danhMucCLS->DonGia / 2;
                        }
                    }
                    else{
                        $st=$tt->danhMucCLS->DonGia / 2;
                    }
                }
                else if(is_object($tt->benhAnNoiTruCT)){
                    $benhnhan=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $hoten=$benhnhan->HoTen;
                    $khoa=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa;
                    $pdk=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                    if($pdk->KhamBHYT == 0){
                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                            $tttbhyt=($tt->danhMucCLS->BHYTTT / 100)* $tt->danhMucCLS->DonGia;
                            $ttqbhyt= $tttbhyt * (($benhnhan->theBHYT->BHYTHoTro)/100);
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$tt->danhMucCLS->DonGia - $tttbhyt;
                            
                            $st= ($tnbcct + $tnbtt) / 2;
                        }
                        else{
                            $tttbhyt=($tt->danhMucCLS->BHYTTT / 100)*$tt->danhMucCLS->DonGia;
                            $ttqbhyt= ($tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100))*0.6;
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$tt->danhMucCLS->DonGia - $tttbhyt;
                            
                            $st= ($tnbcct + $tnbtt) / 2;
                        }
                    }
                    else{
                        $st=$tt->danhMucCLS->DonGia / 2;
                    }
                }
                
                $tt->TamUng=1;
                $tt->save();
                
                $ta_tt=new tam_ung_tt;
                $ta_tt->IdTA= tamUngController::TaoMaNNTATT();
                $ta_tt->IdNVLap=$idnv;
                $ta_tt->IdThuThuat=$tt->IdThuThuat;
                $ta_tt->TamUng=$st;
                $ta_tt->save();
                $stu=$ta_tt->IdTA;
            }
            else{
                $pt= chi_dinh_pt::where('IdPT', $request->id)->get()->first();
                if(!is_object($pt)){
                    $response = array(
                        'msg' => 'ktt'
                    );
                    return response()->json($response); 
                }
                $dv=$pt->danhMucCLS->TenCLS;
                $benhnhan=$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                $hoten=$benhnhan->HoTen;
                $khoa=$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa;
                $st=0;
                $pdk=$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                if($pdk->KhamBHYT == 0){
                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                        $tttbhyt=($pt->danhMucCLS->BHYTTT / 100)* $pt->danhMucCLS->DonGia;
                        $ttqbhyt= $tttbhyt * (($benhnhan->theBHYT->BHYTHoTro)/100);
                        $tnbcct= $tttbhyt - $ttqbhyt;
                        
                        $tnbtt=$pt->danhMucCLS->DonGia - $tttbhyt;

                        $st= ($tnbcct + $tnbtt) / 2;
                    }
                    else{
                        $tttbhyt=($pt->danhMucCLS->BHYTTT / 100)*$pt->danhMucCLS->DonGia;
                        $ttqbhyt= ($tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100))*0.6;
                        $tnbcct= $tttbhyt - $ttqbhyt;
                        
                        $tnbtt=$pt->danhMucCLS->DonGia - $tttbhyt;

                        $st= ($tnbcct + $tnbtt) / 2;
                    }
                }
                else{
                    $st=$pt->danhMucCLS->DonGia / 2;
                }
                
                $pt->TamUng=1;
                $pt->save(); 
                
                $ta_pt=new tam_ung_pt;
                $ta_pt->IdTA= tamUngController::TaoMaNNTAPT();
                $ta_pt->IdNVLap=$idnv;
                $ta_pt->IdPT=$pt->IdPT;
                $ta_pt->TamUng=$st;
                $ta_pt->save();
                $stu=$ta_pt->IdTA;
            }
            
            $response = array(
                'msg' => 'tc',
                'hoten'=>$hoten,
                'khoa'=>$khoa,
                'dv'=>$dv,
                'stu'=>$stu
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
    
    public function postLayTT(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $nv=$user->nhanVien->TenNV;
            $hoten='';$mabn='';$dc='';$k='';$st='';$ns='';$stu='';$ngaythu='';
            if($request->loaidv == 'cls'){
                $cls= can_lam_sang::where('IdCLS', $request->id)->get()->first();
                if(!is_object($cls)){
                    $response = array(
                        'msg' => 'ktt'
                    );
                    return response()->json($response); 
                }
                if(is_object($cls->benhAnNgoaiTru)){
                    $benhnhan=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $hoten=$benhnhan->HoTen;
                    $mabn=$benhnhan->IdBN;
                    if($benhnhan->DiaChi == ''){
                        $dc="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $dc=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    $k=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.' (Ngoại trú)';
                    
                    $pdk=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham;
                    if($pdk->KhamBHYT == 0){
                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                            $tttbhyt=($cls->danhMucCLS->BHYTTT / 100)*($cls->danhMucCLS->DonGia);
                            $ttqbhyt= $tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100);
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$cls->danhMucCLS->DonGia - $tttbhyt;
                            
                            $tbntu= ($tnbcct + $tnbtt) / 2;
                            $st= number_format($tbntu).' VNĐ';
                        }
                        else{
                            $tbntu=$cls->danhMucCLS->DonGia / 2;
                            $st= number_format($tbntu).' VNĐ';
                        }
                    }
                    else{
                        $tbntu=$cls->danhMucCLS->DonGia / 2;
                        $st= number_format($tbntu).' VNĐ';
                    }
                    $ns=date('Y', strtotime($benhnhan->NgaySinh));
                }
                else if(is_object($cls->benhAnNoiTruCT)){
                    $benhnhan=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $hoten=$benhnhan->HoTen;
                    $mabn=$benhnhan->IdBN;
                    if($benhnhan->DiaChi == ''){
                        $dc="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $dc=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    $k=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.' (Nội trú)';
                    $pdk=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                    if($pdk->KhamBHYT == 0){
                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                            $tttbhyt=($cls->danhMucCLS->BHYTTT / 100)* $cls->danhMucCLS->DonGia;
                            $ttqbhyt= $tttbhyt * (($benhnhan->theBHYT->BHYTHoTro)/100);
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$cls->danhMucCLS->DonGia - $tttbhyt;
                            
                            $tbntu= ($tnbcct + $tnbtt) / 2;
                            $st= number_format($tbntu).' VNĐ';
                        }
                        else{
                            $tttbhyt=($cls->danhMucCLS->BHYTTT / 100)*$cls->danhMucCLS->DonGia;
                            $ttqbhyt= ($tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100))*0.6;
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$cls->danhMucCLS->DonGia - $tttbhyt;
                            
                            $tbntu= ($tnbcct + $tnbtt) / 2;
                            $st= number_format($tbntu).' VNĐ';
                        }
                    }
                    else{
                        $tbntu=$cls->danhMucCLS->DonGia / 2;
                        $st= number_format($tbntu).' VNĐ';
                    }
                    $ns=date('Y', strtotime($benhnhan->NgaySinh));
                }
                if(is_object($cls->tamUng)){
                    $stu=$cls->tamUng->IdTA;
                    $ngaythu='Ngày '.date('d', strtotime($cls->tamUng->created_at)).' tháng '.date('m', strtotime($cls->tamUng->created_at)).' năm '.date('Y', strtotime($cls->tamUng->created_at));
                }
            }
            else if($request->loaidv == 'tt'){
                $tt= chi_dinh_tt::where('IdThuThuat', $request->id)->get()->first();
                if(!is_object($tt)){
                    $response = array(
                        'msg' => 'ktt'
                    );
                    return response()->json($response); 
                }
                if(is_object($tt->benhAnNgoaiTru)){
                    $benhnhan=$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $hoten=$benhnhan->HoTen;
                    $mabn=$benhnhan->IdBN;
                    if($benhnhan->DiaChi == ''){
                        $dc="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $dc=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    $k=$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.' (Ngoại trú)';
                    $pdk=$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham;
                    if($pdk->KhamBHYT == 0){
                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                            $tttbhyt=($tt->danhMucCLS->BHYTTT / 100)*($tt->danhMucCLS->DonGia);
                            $ttqbhyt= $tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100);
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$tt->danhMucCLS->DonGia - $tttbhyt;
                            
                            $tbntu= ($tnbcct + $tnbtt) / 2;
                            $st= number_format($tbntu).' VNĐ';
                        }
                        else{
                            $tbntu=$tt->danhMucCLS->DonGia / 2;
                            $st= number_format($tbntu).' VNĐ';
                        }
                    }
                    else{
                        $tbntu=$tt->danhMucCLS->DonGia / 2;
                        $st= number_format($tbntu).' VNĐ';
                    }
                    $ns=date('Y', strtotime($benhnhan->NgaySinh));
                }
                else if(is_object($tt->benhAnNoiTruCT)){
                    $benhnhan=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                    $hoten=$benhnhan->HoTen;
                    $mabn=$benhnhan->IdBN;
                    if($benhnhan->DiaChi == ''){
                        $dc="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $dc=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    $k=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.' (Nội trú)';
                    $pdk=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                    if($pdk->KhamBHYT == 0){
                        if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                            $tttbhyt=($tt->danhMucCLS->BHYTTT / 100)* $tt->danhMucCLS->DonGia;
                            $ttqbhyt= $tttbhyt * (($benhnhan->theBHYT->BHYTHoTro)/100);
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$tt->danhMucCLS->DonGia - $tttbhyt;
                            
                            $tbntu= ($tnbcct + $tnbtt) / 2;
                            $st= number_format($tbntu).' VNĐ';
                        }
                        else{
                            $tttbhyt=($tt->danhMucCLS->BHYTTT / 100)*$tt->danhMucCLS->DonGia;
                            $ttqbhyt= ($tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100))*0.6;
                            $tnbcct= $tttbhyt - $ttqbhyt;
                            
                            $tnbtt=$tt->danhMucCLS->DonGia - $tttbhyt;
                            
                            $tbntu= ($tnbcct + $tnbtt) / 2;
                            $st= number_format($tbntu).' VNĐ';
                        }
                    }
                    else{
                        $tbntu=$tt->danhMucCLS->DonGia / 2;
                        $st= number_format($tbntu).' VNĐ';
                    }
                    $ns=date('Y', strtotime($benhnhan->NgaySinh));
                }
                if(is_object($tt->tamUng)){
                    $stu=$tt->tamUng->IdTA;
                    $ngaythu='Ngày '.date('d', strtotime($tt->tamUng->created_at)).' tháng '.date('m', strtotime($tt->tamUng->created_at)).' năm '.date('Y', strtotime($tt->tamUng->created_at));
                }
            }
            else{
                $pt= chi_dinh_pt::where('IdPT', $request->id)->get()->first();
                if(!is_object($pt)){
                    $response = array(
                        'msg' => 'ktt'
                    );
                    return response()->json($response); 
                }
                $benhnhan=$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
                $hoten=$benhnhan->HoTen;
                $mabn=$benhnhan->IdBN;
                if($benhnhan->DiaChi == ''){
                    $dc="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                }
                else{
                    $dc=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                }
                $k=$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->phongKham->Khoa->TenKhoa.' (Nội trú)';
                $pdk=$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham;
                if($pdk->KhamBHYT == 0){
                    if($pdk->Tuyen == 0 || ($pdk->Tuyen != 0 && $pdk->GiayChuyen == 1)){
                        $tttbhyt=($pt->danhMucCLS->BHYTTT / 100)* $pt->danhMucCLS->DonGia;
                        $ttqbhyt= $tttbhyt * (($benhnhan->theBHYT->BHYTHoTro)/100);
                        $tnbcct= $tttbhyt - $ttqbhyt;
                        
                        $tnbtt=$pt->danhMucCLS->DonGia - $tttbhyt;

                        $tbntu= ($tnbcct + $tnbtt) / 2;
                        $st= number_format($tbntu).' VNĐ';
                    }
                    else{
                        $tttbhyt=($pt->danhMucCLS->BHYTTT / 100)*$pt->danhMucCLS->DonGia;
                        $ttqbhyt= ($tttbhyt*(($benhnhan->theBHYT->BHYTHoTro)/100))*0.6;
                        $tnbcct= $tttbhyt - $ttqbhyt;
                        
                        $tnbtt=$pt->danhMucCLS->DonGia - $tttbhyt;

                        $tbntu= ($tnbcct + $tnbtt) / 2;
                        $st= number_format($tbntu).' VNĐ';
                    }
                }
                else{
                    $tbntu=$pt->danhMucCLS->DonGia / 2;
                    $st= number_format($tbntu).' VNĐ';
                }
                $ns=date('Y', strtotime($benhnhan->NgaySinh));
                if(is_object($pt->tamUng)){
                    $stu=$pt->tamUng->IdTA;
                    $ngaythu='Ngày '.date('d', strtotime($pt->tamUng->created_at)).' tháng '.date('m', strtotime($pt->tamUng->created_at)).' năm '.date('Y', strtotime($pt->tamUng->created_at));
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'hoten'=>$hoten,
                'mabn'=>$mabn,
                'ns'=>$ns,
                'dc'=>$dc,
                'k'=>$k,
                'st'=>$st,
                'nv'=>$nv,
                'stu'=>$stu,
                'ngaythu'=>$ngaythu
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
            $key=$request->keyWords;
            $ds_dv= DB::select("SELECT a.* FROM(
            SELECT a.* FROM(
                SELECT DISTINCT a.`IdCLS` AS Id, CASE WHEN 1=1 THEN N'CLS' END AS LoaiDV, a.`LoaiBA` FROM(
                (select nv.`TenNV`, cls.`IdCLS`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 0 END AS LoaiBA, pb.`SoPhong`, pb.`TenPhong`, pbcd.`SoPhong` AS SoPhongCD, pbcd.`TenPhong` AS TenPhongCD, cls.`TamUng`, cls.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN benh_an_ngoai_tru_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` JOIN phong_ban AS pbcd ON pdk.`IdPK` = pbcd.`IdPB`)

                UNION ALL

                (select nv.`TenNV`, cls.`IdCLS`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 1 END AS LoaiBA, pb.`SoPhong`, pb.`TenPhong`, pbcd.`SoPhong` AS SoPhongCD, pbcd.`TenPhong` AS TenPhongCD, cls.`TamUng`, cls.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` JOIN phong_ban AS pbcd ON pdk.`IdPK` = pbcd.`IdPB`)

                ) AS a WHERE (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".date('d/m/Y')."%' COLLATE utf8_unicode_ci) AND a.`TamUng` = 0 AND ((a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('Phòng số ', a.`SoPhong`, ' - ', a.TenPhong) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('Phòng số ', a.`SoPhongCD`, ' - ', a.TenPhongCD) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Nội trú' ELSE N'Ngoại trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`IdCLS`, a.`LoaiBA` ORDER BY a.created_at DESC
                ) AS a

                UNION ALL

            SELECT a.* FROM(
            SELECT DISTINCT a.`IdThuThuat` AS Id, CASE WHEN 1=1 THEN N'TT' END AS LoaiDV, a.`LoaiBA` FROM(
            (select nv.`TenNV`, cls.`IdThuThuat`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 0 END AS LoaiBA, pb.`SoPhong`, pb.`TenPhong`, pbcd.`SoPhong` AS SoPhongCD, pbcd.`TenPhong` AS TenPhongCD, cls.`TamUng`, cls.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN chi_dinh_tt_vs_benh_an_ngoai_tru AS cls_ba ON cls_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN chi_dinh_tt AS cls ON cls.`IdThuThuat` = cls_ba.`IdThuThuat` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` JOIN phong_ban AS pbcd ON pdk.`IdPK` = pbcd.`IdPB`)

            UNION ALL

            (select nv.`TenNV`, cls.`IdThuThuat`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 1 END AS LoaiBA, pb.`SoPhong`, pb.`TenPhong`, pbcd.`SoPhong` AS SoPhongCD, pbcd.`TenPhong` AS TenPhongCD, cls.`TamUng`, cls.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN chi_dinh_tt_vs_benh_an_noi_tru_ct AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN chi_dinh_tt AS cls ON cls.`IdThuThuat` = cls_ba.`IdThuThuat` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` JOIN phong_ban AS pbcd ON pdk.`IdPK` = pbcd.`IdPB`) 

            ) AS a WHERE (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".date('d/m/Y')."%' COLLATE utf8_unicode_ci) AND a.`TamUng` = 0 AND ((a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('Phòng số ', a.`SoPhong`, ' - ', a.TenPhong) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('Phòng số ', a.`SoPhongCD`, ' - ', a.TenPhongCD) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Nội trú' ELSE N'Ngoại trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`IdThuThuat`, a.`LoaiBA` ORDER BY a.created_at DESC
             ) AS a

                UNION ALL

            SELECT a.* FROM(
            SELECT DISTINCT a.`IdPT` AS Id, CASE WHEN 1=1 THEN N'PT' END AS LoaiDV, a.`LoaiBA` FROM(
            select nv.`TenNV`, cls.`IdPT`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 1 END AS LoaiBA, pb.`SoPhong`, pb.`TenPhong`, pbcd.`SoPhong` AS SoPhongCD, pbcd.`TenPhong` AS TenPhongCD, cls.`TamUng`, cls.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN chi_dinh_pt AS cls ON cls.`IdBACT` = bact.`IdBACT` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` JOIN phong_ban AS pbcd ON pdk.`IdPK` = pbcd.`IdPB`
            ) AS a WHERE (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".date('d/m/Y')."%' COLLATE utf8_unicode_ci) AND a.`TamUng` = 0 AND ((a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('Phòng số ', a.`SoPhong`, ' - ', a.TenPhong) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('Phòng số ', a.`SoPhongCD`, ' - ', a.TenPhongCD) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Nội trú' ELSE N'Ngoại trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`IdPT`, a.`LoaiBA` ORDER BY a.created_at DESC
            ) AS a
            ) AS a
            ");
            $dsdv = array();
            $sl=0;
            if(!empty($ds_dv)){
                foreach ($ds_dv as $dv){
                    $id='';$hoten='';$dttn='BHYT';$htdt='Nội trú';$tendv='';$nvcd='';$phongcd='';$pth='';$ngayracd='';$loaidv='';
                    if($dv->LoaiDV == 'CLS'){
                        $cls= can_lam_sang::where('IdCLS', $dv->Id)->get()->first();
                        $id=$cls->IdCLS;$tendv=$cls->danhMucCLS->TenCLS;$pth='Phòng số '.$cls->phongBan->SoPhong.' - '.$cls->phongBan->TenPhong;
                        $ngayracd= \comm_functions::deDateFormat($cls->created_at);
                        $loaidv='cls';
                        if($dv->LoaiBA == 0){
                            $hoten=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                            if($cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                $dttn='Thu phí';
                            }
                            $htdt='Ngoại trú';
                            $nvcd=$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                            $phongcd='Phòng số '.$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->SoPhong.' - '.$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->TenPhong;
                        }
                        else{
                            $hoten=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                            if($cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                $dttn='Thu phí';
                            }
                            $nvcd=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                            $phongcd='Phòng số '.$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->SoPhong.' - '.$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->TenPhong;
                        }
                    }
                    else if($dv->LoaiDV == 'TT'){
                        $tt= chi_dinh_tt::where('IdThuThuat', $dv->Id)->get()->first();
                        $id=$tt->IdThuThuat;$tendv=$tt->danhMucCLS->TenCLS;$pth='Phòng số '.$tt->phongBan->SoPhong.' - '.$tt->phongBan->TenPhong;
                        $ngayracd= \comm_functions::deDateFormat($tt->created_at);
                        $loaidv='tt';
                        if($dv->LoaiBA == 0){
                            $hoten=$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                            if($tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                $dttn='Thu phí';
                            }
                            $htdt='Ngoại trú';
                            $nvcd=$tt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                            $phongcd='Phòng số '.$tt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->SoPhong.' - '.$tt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->TenPhong;
                        }
                        else{
                            $hoten=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                            if($tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                $dttn='Thu phí';
                            }
                            $nvcd=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                            $phongcd='Phòng số '.$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->SoPhong.' - '.$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->TenPhong;
                        }
                    }
                    else{
                        $pt= chi_dinh_pt::where('IdPT', $dv->Id)->get()->first();
                        $id=$pt->IdPT;$tendv=$pt->danhMucCLS->TenCLS;$pth='Phòng số '.$pt->phongBan->SoPhong.' - '.$pt->phongBan->TenPhong;
                        $ngayracd= \comm_functions::deDateFormat($pt->created_at);
                        $loaidv='pt';
                        $hoten=$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                        if($pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                            $dttn='Thu phí';
                        }
                        $nvcd=$pt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                        $phongcd='Phòng số '.$pt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->SoPhong.' - '.$pt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->TenPhong;
                    }
                    $ttdv=array(
                        'id'=>$id,
                        'hoten'=>$hoten,
                        'dttn'=>$dttn,
                        'htdt'=>$htdt,
                        'tendv'=>$tendv,
                        'nvcd'=>$nvcd,
                        'phongcd'=>$phongcd,
                        'ngayracd'=> $ngayracd,
                        'pth'=>$pth,
                        'loaidv'=>$loaidv
                    );
                    $dsdv[]=$ttdv;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dsdv'=>$dsdv,
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
    
    public function postLayDSTU(Request $request){
        try{
            $dsdv=array();
            $dscls= can_lam_sang::where('TamUng', 0)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('LoaiCD', 'DESC')->orderBy('created_at', 'DESC')->get();
            foreach ($dscls as $cls) {
                $hoten='';$dttn='BHYT';$htdt='Nội trú';$nvcd='';$phongcd='';$pth='';
                $id=$cls->IdCLS;$tendv=$cls->danhMucCLS->TenCLS;$pth='Phòng số '.$cls->phongBan->SoPhong.' - '.$cls->phongBan->TenPhong;
                $ngayracd= \comm_functions::deDateFormat($cls->created_at);
                $loaidv='cls';
                $flagtp=FALSE;
                if(is_object($cls->benhAnNgoaiTru)){
                    if($cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                        $flagtp=TRUE;
                        $hoten=$cls->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                        $htdt='Ngoại trú';
                        $nvcd=$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                        $phongcd='Phòng số '.$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->SoPhong.' - '.$cls->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->TenPhong;
                    }
                }
                else if(is_object($cls->benhAnNoiTruCT)){
                    if($cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                        $flagtp=TRUE;
                        $hoten=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                        $nvcd=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                        $phongcd='Phòng số '.$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->SoPhong.' - '.$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->TenPhong;
                    }
                }
                if($flagtp == TRUE){
                    $ttdv=array(
                        'id'=>$id,
                        'hoten'=>$hoten,
                        'dttn'=>$dttn,
                        'htdt'=>$htdt,
                        'tendv'=>$tendv,
                        'nvcd'=>$nvcd,
                        'phongcd'=>$phongcd,
                        'ngayracd'=> $ngayracd,
                        'pth'=>$pth,
                        'loaidv'=>$loaidv
                    );
                    $dsdv[]=$ttdv;
                }
            }
            $dstt= chi_dinh_tt::where('TamUng', 0)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('LoaiCD', 'DESC')->orderBy('created_at', 'DESC')->get();
            foreach ($dstt as $tt) {
                $hoten='';$dttn='BHYT';$htdt='Nội trú';$nvcd='';$phongcd='';$pth='';
                $id=$tt->IdThuThuat;$tendv=$tt->danhMucCLS->TenCLS;$pth='Phòng số '.$tt->phongBan->SoPhong.' - '.$tt->phongBan->TenPhong;
                $ngayracd= \comm_functions::deDateFormat($tt->created_at);
                $loaidv='tt';
                $flagtp=FALSE;
                if(is_object($tt->benhAnNgoaiTru)){
                    if($tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                        $flagtp = TRUE;
                        $hoten=$tt->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                        $htdt='Ngoại trú';
                        $nvcd=$tt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                        $phongcd='Phòng số '.$tt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->SoPhong.' - '.$tt->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->phongBan->TenPhong;
                    }
                }
                else if(is_object($tt->benhAnNoiTruCT)){
                    if($tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                        $flagtp = TRUE;
                        $hoten=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                        $nvcd=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                        $phongcd='Phòng số '.$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->SoPhong.' - '.$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->TenPhong;
                    } 
                }
                if($flagtp == TRUE){
                    $ttdv=array(
                        'id'=>$id,
                        'hoten'=>$hoten,
                        'dttn'=>$dttn,
                        'htdt'=>$htdt,
                        'tendv'=>$tendv,
                        'nvcd'=>$nvcd,
                        'phongcd'=>$phongcd,
                        'ngayracd'=> $ngayracd,
                        'pth'=>$pth,
                        'loaidv'=>$loaidv
                    );
                    $dsdv[]=$ttdv;
                }
                
            }
            $dspt= chi_dinh_pt::where('TamUng', 0)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('LoaiCD', 'DESC')->orderBy('created_at', 'DESC')->get();
            foreach ($dspt as $pt) {
                $dttn='BHYT';$htdt='Nội trú';$phongcd='';$pth='';$flagtp=FALSE;
                $id=$pt->IdPT;$tendv=$pt->danhMucCLS->TenCLS;$pth='Phòng số '.$pt->phongBan->SoPhong.' - '.$pt->phongBan->TenPhong;
                $ngayracd= \comm_functions::deDateFormat($pt->created_at);
                $loaidv='pt';
                if(is_object($pt->benhAnNoiTruCT)){
                    $hoten=$pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                    if($pt->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                        $flagtp= TRUE;
                        $nvcd=$pt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                        $phongcd='Phòng số '.$pt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->SoPhong.' - '.$pt->benhAnNoiTruCT->benhAnNoiTru->nhanVien->phongBan->TenPhong;
                    }
                    
                }
                if($flagtp==TRUE){
                    $ttdv=array(
                        'id'=>$id,
                        'hoten'=>$hoten,
                        'dttn'=>$dttn,
                        'htdt'=>$htdt,
                        'tendv'=>$tendv,
                        'nvcd'=>$nvcd,
                        'phongcd'=>$phongcd,
                        'ngayracd'=> $ngayracd,
                        'pth'=>$pth,
                        'loaidv'=>$loaidv
                    );
                    $dsdv[]=$ttdv;
                }
                
            }
            
            $response = array(
                'msg' => 'tc',
                'dsdv'=>$dsdv
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
    
    public function postTimKiemLS(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $key=$request->keyWords;
            $ds_ptu= DB::select("SELECT a.* FROM(
            SELECT a.* FROM(
                SELECT DISTINCT a.`IdTA` AS Id, CASE WHEN 1=1 THEN N'CLS' END AS LoaiDV, a.`LoaiBA` FROM(
                (select ta.`IdNVLap`, nv.`TenNV`, ta.`IdTA`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 0 END AS LoaiBA, ta.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN benh_an_ngoai_tru_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN tam_ung_cls AS ta ON ta.`IdCLS`=cls.`IdCLS` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV`)

                UNION ALL

                (select ta.`IdNVLap`, nv.`TenNV`, ta.`IdTA`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 1 END AS LoaiBA, ta.created_at  FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN tam_ung_cls AS ta ON ta.`IdCLS`=cls.`IdCLS` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV`)

                ) AS a WHERE a.`IdNVLap` = N'".$idnv."' AND ((a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`KhamBHYT` = 0 THEN N'Bảo hiểm y tế bhyt' ELSE N'tp Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Nội trú' ELSE N'Ngoại trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`IdTA`, a.`LoaiBA` ORDER BY a.created_at DESC
                ) AS a

                UNION ALL

            SELECT a.* FROM(
            SELECT DISTINCT a.`IdTA` AS Id, CASE WHEN 1=1 THEN N'TT' END AS LoaiDV, a.`LoaiBA` FROM(
            (select ta.`IdNVLap`, nv.`TenNV`, ta.`IdTA`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 0 END AS LoaiBA, ta.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN chi_dinh_tt_vs_benh_an_ngoai_tru AS cls_ba ON cls_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN chi_dinh_tt AS cls ON cls.`IdThuThuat` = cls_ba.`IdThuThuat` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN tam_ung_tt AS ta ON ta.`IdThuThuat`=cls.`IdThuThuat` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV`)

            UNION ALL

            (select ta.`IdNVLap`, nv.`TenNV`, ta.`IdTA`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 1 END AS LoaiBA, ta.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN chi_dinh_tt_vs_benh_an_noi_tru_ct AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN chi_dinh_tt AS cls ON cls.`IdThuThuat` = cls_ba.`IdThuThuat` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN tam_ung_tt AS ta ON ta.`IdThuThuat`=cls.`IdThuThuat` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV`) 

            ) AS a WHERE a.`IdNVLap` = N'".$idnv."' AND ((a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`KhamBHYT` = 0 THEN N'Bảo hiểm y tế bhyt' ELSE N'tp Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Nội trú' ELSE N'Ngoại trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`IdTA`, a.`LoaiBA` ORDER BY a.created_at DESC
             ) AS a

                UNION ALL

            SELECT a.* FROM(
            SELECT DISTINCT a.`IdTA` AS Id, CASE WHEN 1=1 THEN N'PT' END AS LoaiDV, a.`LoaiBA` FROM(
            select ta.`IdNVLap`, nv.`TenNV`, ta.`IdTA`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, CASE WHEN 1=1 THEN 1 END AS LoaiBA, ta.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN chi_dinh_pt AS cls ON cls.`IdBACT` = bact.`IdBACT` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN tam_ung_pt AS ta ON ta.`IdPT`=cls.`IdPT` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV`
            ) AS a WHERE a.`IdNVLap` = N'".$idnv."' AND ((a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`KhamBHYT` = 0 THEN N'Bảo hiểm y tế bhyt' ELSE N'tp Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Nội trú' ELSE N'Ngoại trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`IdTA`, a.`LoaiBA` ORDER BY a.created_at DESC
            ) AS a
            ) AS a");
            $dsptu = array();
            $sl=0;
            if(!empty($ds_ptu)){
                foreach ($ds_ptu as $dv){
                    $id='';$hoten='';$dttn='BHYT';$htdt='Nội trú';$tendv='';$bsdt='';$idcls='';$ngaylap='';$loaidv='';
                    if($dv->LoaiDV == 'CLS'){
                        $ta_cls= tam_ung_cls::where('IdTA', $dv->Id)->get()->first();
                        $id=$ta_cls->IdTA;
                        $tendv=$ta_cls->canLamSang->danhMucCLS->TenCLS;
                        $ngaylap= \comm_functions::deDateFormat($ta_cls->created_at);
                        $loaidv='cls';
                        $idcls=$ta_cls->canLamSang->IdCLS;
                        if($dv->LoaiBA == 0){
                            $hoten=$ta_cls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                            if($ta_cls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                $dttn='Thu phí';
                            }
                            $htdt='Ngoại trú';
                            $bsdt=$ta_cls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                            
                        }
                        else{
                            $hoten=$ta_cls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                            if($ta_cls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                $dttn='Thu phí';
                            }
                            $bsdt=$ta_cls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                        }
                    }
                    else if($dv->LoaiDV == 'TT'){
                        $ta_tt= tam_ung_tt::where('IdTA', $dv->Id)->get()->first();
                        $id=$ta_tt->IdTA;
                        $tendv=$ta_tt->chiDinhTT->danhMucCLS->TenCLS;
                        $ngaylap= \comm_functions::deDateFormat($ta_tt->created_at);
                        $loaidv='tt';
                        $idcls=$ta_tt->chiDinhTT->IdThuThuat;
                        if($dv->LoaiBA == 0){
                            $hoten=$ta_tt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                            if($ta_tt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                $dttn='Thu phí';
                            }
                            $htdt='Ngoại trú';
                            $bsdt=$ta_tt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;
                            
                        }
                        else{
                            $hoten=$ta_tt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                            if($ta_tt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                                $dttn='Thu phí';
                            }
                            $bsdt=$ta_tt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                        }
                    }
                    else{
                        $ta_pt= tam_ung_pt::where('IdTA', $dv->Id)->get()->first();
                        $id=$ta_pt->IdTA;
                        $tendv=$ta_pt->chiDinhPT->danhMucCLS->TenCLS;
                        $ngaylap= \comm_functions::deDateFormat($ta_pt->created_at);
                        $loaidv='pt';
                        $idcls=$ta_pt->chiDinhPT->IdPT;
                        $hoten=$ta_pt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                        if($ta_pt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                            $dttn='Thu phí';
                        }
                        $bsdt=$ta_pt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                    }
                    $ttdv=array(
                        'id'=>$id,//
                        'hoten'=>$hoten,//
                        'dttn'=>$dttn,//
                        'htdt'=>$htdt,//
                        'tendv'=>$tendv,//
                        'bsdt'=>$bsdt,//
                        'idcls'=>$idcls,//
                        'ngaylap'=> $ngaylap,//
                        'loaidv'=>$loaidv//
                    );
                    $dsptu[]=$ttdv;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dsptu'=>$dsptu,
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
    
    public function postLayDSTULS(Request $request){
        try{
            $dsptu=array();
            
            $tu_cls=tam_ung_cls::orderBy('created_at', 'DESC')->get();
            foreach ($tu_cls as $ta_cls){
                $hoten='';$dttn='BHYT';$htdt='Nội trú';$bsdt='';
                $id=$ta_cls->IdTA;
                $tendv=$ta_cls->canLamSang->danhMucCLS->TenCLS;
                $ngaylap= \comm_functions::deDateFormat($ta_cls->created_at);
                $loaidv='cls';
                $idcls=$ta_cls->canLamSang->IdCLS;
                if(is_object($ta_cls->canLamSang->benhAnNgoaiTru)){
                    $hoten=$ta_cls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                    if($ta_cls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                    $htdt='Ngoại trú';
                    $bsdt=$ta_cls->canLamSang->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;

                }
                else if(is_object($ta_cls->canLamSang->benhAnNoiTruCT)){
                    $hoten=$ta_cls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                    if($ta_cls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                    $bsdt=$ta_cls->canLamSang->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                }
                $ttdv=array(
                    'id'=>$id,//
                    'hoten'=>$hoten,//
                    'dttn'=>$dttn,//
                    'htdt'=>$htdt,//
                    'tendv'=>$tendv,//
                    'bsdt'=>$bsdt,//
                    'idcls'=>$idcls,//
                    'ngaylap'=> $ngaylap,//
                    'loaidv'=>$loaidv//
                );
                $dsptu[]=$ttdv;
            }
            $tu_tt= tam_ung_tt::orderBy('created_at', 'DESC')->get();
            foreach ($tu_tt as $ta_tt){
                $hoten='';$dttn='BHYT';$htdt='Nội trú';$bsdt='';
                $id=$ta_tt->IdTA;
                $tendv=$ta_tt->chiDinhTT->danhMucCLS->TenCLS;
                $ngaylap= \comm_functions::deDateFormat($ta_tt->created_at);
                $loaidv='tt';
                $idcls=$ta_tt->chiDinhTT->IdThuThuat;
                if(is_object($ta_tt->chiDinhTT->benhAnNgoaiTru)){
                    $hoten=$ta_tt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                    if($ta_tt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                    $htdt='Ngoại trú';
                    $bsdt=$ta_tt->chiDinhTT->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien->TenNV;

                }
                else if(is_object($ta_tt->chiDinhTT->benhAnNoiTruCT)){
                    $hoten=$ta_tt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                    if($ta_tt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                    $bsdt=$ta_tt->chiDinhTT->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                }
                $ttdv=array(
                    'id'=>$id,//
                    'hoten'=>$hoten,//
                    'dttn'=>$dttn,//
                    'htdt'=>$htdt,//
                    'tendv'=>$tendv,//
                    'bsdt'=>$bsdt,//
                    'idcls'=>$idcls,//
                    'ngaylap'=> $ngaylap,//
                    'loaidv'=>$loaidv//
                );
                $dsptu[]=$ttdv;
            }
            $tu_pt= tam_ung_pt::orderBy('created_at', 'DESC')->get();
            foreach ($tu_pt as $ta_pt){
                $dttn='BHYT';$htdt='Nội trú';
                $id=$ta_pt->IdTA;
                $tendv=$ta_pt->chiDinhPT->danhMucCLS->TenCLS;
                $ngaylap= \comm_functions::deDateFormat($ta_pt->created_at);
                $loaidv='pt';
                $idcls=$ta_pt->chiDinhPT->IdPT;
                $hoten=$ta_pt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan->HoTen;
                if($ta_pt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                $bsdt=$ta_pt->chiDinhPT->benhAnNoiTruCT->benhAnNoiTru->nhanVien->TenNV;
                $ttdv=array(
                    'id'=>$id,//
                    'hoten'=>$hoten,//
                    'dttn'=>$dttn,//
                    'htdt'=>$htdt,//
                    'tendv'=>$tendv,//
                    'bsdt'=>$bsdt,//
                    'idcls'=>$idcls,//
                    'ngaylap'=> $ngaylap,//
                    'loaidv'=>$loaidv//
                );
                $dsptu[]=$ttdv;
            }
            
            $response = array(
                'msg' => 'tc',
                'dsptu'=>$dsptu
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
    
    public static function TaoMaNNTACLS(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= tam_ung_cls::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $tacls) {
                   if($tacls->IdTA == $ran){
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
    
    public static function TaoMaNNTATT(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= tam_ung_tt::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $tatt) {
                   if($tatt->IdTA == $ran){
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
    
    public static function TaoMaNNTAPT(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= tam_ung_pt::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $tapt) {
                   if($tapt->IdTA == $ran){
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
