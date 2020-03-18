<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;
use Illuminate\Foundation\Auth\User;

class HomeController extends Controller
{
    //
    
    public function getIndex(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $dsbangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at','DESC')->get();

//        cập nhật lại trạng thái bệnh án
        foreach ($dsbangoai as $value) {
            $present= date_create(date('Y-m-d'));
            $timeba= date_create(date('Y-m-d', strtotime($value->created_at)));
            $t= date_diff($timeba, $present);
            if(intval($t->format('%a')) > $value->SoNgayDT){
                if($value->TrangThaiBA != 0){
                    $value->TrangThaiBA=0;
                    $value->save();
                }
            }

            if(is_object($value->toaThuoc)){
                if(date('d/m/Y', strtotime($value->toaThuoc->toaThuoc->created_at)) != date('d/m/Y') && $value->toaThuoc->toaThuoc->TTLanhThuoc == 0){
                    $value->toaThuoc->toaThuoc->delete();//xóa những toa thuốc không lãnh thuốc trong ngày.
                }
            }
        }

        $banoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at','DESC')->get();
        foreach ($banoi as $value) {
            if(count($value->benhAnNoiTruCT) > 0){
                foreach ($value->benhAnNoiTruCT as $v) {
                    if(is_object($v->toaThuoc)){
                        if(date('d/m/Y', strtotime($v->toaThuoc->toaThuoc->created_at)) != date('d/m/Y') && $v->toaThuoc->toaThuoc->TTLanhThuoc == 0){
                            $v->toaThuoc->toaThuoc->delete();//xóa những toa thuốc không lãnh thuốc trong ngày.
                        }
                    }
                }
            }
        }
        
        $ds= ba_nv::where('IdNV',$idnv)->orderBy('created_at', 'DESC')->get();
        
        $dsbachotn=array();
        foreach($ds as $tn){
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
        return view("kham_vs_dieu_tri.index", ['dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }    
}
