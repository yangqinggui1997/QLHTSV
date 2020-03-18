<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\TiepDon\benh_nhan;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\ket_qua_cls;
use App\Models\KhamVaDieuTri\ket_qua_cls_ct;
use App\Models\KhamVaDieuTri\anh_cls;
use App\Models\KhamVaDieuTri\ket_luan_cls;
use App\Events\KhamVaDieuTri\KetQuaCLS;
use Illuminate\Foundation\Auth\User;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;

class benhSuController extends Controller
{
    //
    
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $dsbn= benh_nhan::orderBy('HoTen','ASC')->get();
        
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
        return view("kham_vs_dieu_tri.benh_su", ['dsbn'=>$dsbn, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    
    public function postXBS(Request $request){
        try{
            $key=$request->keyWords;
            $ds_ba= DB::select("SELECT DISTINCT a.* FROM(
(select bn.`IdBN`, ba.`IdBANgoaiT` AS IdBA, CASE WHEN 1=1 THEN 0 END AS LoaiBA, ba.created_at FROM khoa AS k JOIN phong_ban AS pb ON pb.`IdKhoa` = k.`IdKhoa` JOIN phieu_dk_kham AS pdk ON pdk.`IdPK` = pb.`IdPB` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pdk_ba ON pdk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON pdk_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN chuan_doan_vs_benh_an_ngoai_tru AS cd_ba ON cd_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` JOIN benh_nhan AS bn ON bn.`IdBN` = pdk.`IdBN` JOIN nhan_vien AS nv ON ba.`IdNV` = nv.`IdNV`)

UNION ALL

(select bn.`IdBN`, ba.`IdBANoiT` AS IdBA, CASE WHEN 1=1 THEN 1 END AS LoaiBA, ba.created_at FROM khoa AS k JOIN phong_ban AS pb ON pb.`IdKhoa` = k.`IdKhoa` JOIN phieu_dk_kham AS pdk ON pdk.`IdPK` = pb.`IdPB` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pdk_ba ON pdk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON pdk_ba.`IdBANoiT` = ba.`IdBANoiT` JOIN chuan_doan_vs_benh_an_noi_tru AS cd_ba ON cd_ba.`IdBANoiT` = ba.`IdBANoiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` JOIN benh_nhan AS bn ON bn.`IdBN` = pdk.`IdBN` JOIN nhan_vien AS nv ON ba.`IdNV` = nv.`IdNV`)

) AS a WHERE a.`IdBN` = N'".$key."' GROUP BY a.`IdBA`, a.`IdBN`, a.`LoaiBA`, a.`created_at` ORDER BY a.created_at DESC");
            $dsba = array();
            $sl=0;$hoten='NULL';
            if(!empty($ds_ba)>0){
                foreach ($ds_ba as $ba){
                    $bn= benh_nhan::where('IdBN', $ba->IdBN)->get()->first();$hoten=$bn->HoTen;
                    $dttn='BHYT';$chuandoan='';$bsdt='';$i=1;$khoadt='';$htdt='Nội trú';$ngaytn='';$id='';$trangthaiba='';$songaydt=1;$loaiba='noi';
                    if($ba->LoaiBA == 0){
                        $bangoai= benh_an_ngoai_tru::where('IdBANgoaiT', $ba->IdBA)->get()->first();
                        foreach ($bangoai->chuanDoan as $cd){
                            if($i == count($bangoai->chuanDoan)){
                                $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                            }
                            else{
                                $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                            }
                            $i++;
                        }
                        $id=$bangoai->IdBANgoaiT;
                        $trangthaiba='Đang điều trị';
                        if($bangoai->TrangThaiBA == 0){
                            $trangthaiba='Đã kết thúc điều trị';
                        }
                        $songaydt=$bangoai->SoNgayDT;
                        $loaiba='ngoai';
                        $htdt='Ngoại trú';
                        $ngaytn= \comm_functions::deDateFormat($bangoai->created_at);
                        $bsdt=$bangoai->nhanVien->TenNV;
                        $khoadt=$bangoai->nhanVien->phongBan->Khoa->TenKhoa;
                        if($bangoai->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                            $dttn='Thu phí';
                        }
                    }
                    else{
                        $i=1;
                        $banoi= benh_an_noi_tru::where('IdBANoiT', $ba->IdBA)->get()->first();
                        foreach ($banoi->chuanDoan as $cd){
                            if($i == count($banoi->chuanDoan)){
                                $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                            }
                            else{
                                $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                            }
                            $i++;
                        }
                        $id=$banoi->IdBANoiT;
                        $trangthaiba='Đang điều trị';
                        if($banoi->TrangThaiBA == 0){
                            $trangthaiba='Đã kết thúc điều trị';
                            if(is_object($banoi->giayRaVien)){
                                $present= date_create(date('Y-m-d', strtotime($banoi->giayRaVien->created_at)));
                                $timeba= date_create(date('Y-m-d', strtotime($banoi->created_at)));
                                $t= date_diff($timeba, $present);
                                $songaydt=$t->format('%a')+1;
                            }
                            else{
                                $present= date_create(date('Y-m-d'));
                                $timeba= date_create(date('Y-m-d', strtotime($banoi->created_at)));
                                $t= date_diff($timeba, $present);
                                $songaydt=$t->format('%a')+1;
                            }
                        }
                        else{
                            $present= date_create(date('Y-m-d'));
                            $timeba= date_create(date('Y-m-d', strtotime($banoi->created_at)));
                            $t= date_diff($timeba, $present);
                            $songaydt=$t->format('%a')+1;
                        }
                        
                        $bsdt=$banoi->nhanVien->TenNV;
                        $ngaytn= \comm_functions::deDateFormat($banoi->created_at);
                        $khoadt=$banoi->nhanVien->phongBan->Khoa->TenKhoa;
                        if($banoi->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                            $dttn='Thu phí';
                        }
                    }
                    
                    $ttba= array(
                        'hoten' => $bn->HoTen,
                        'dttn'=>$dttn,
                        'bsdt'=>$bsdt,
                        'songaydt'=>$songaydt,
                        'chuandoan'=>$chuandoan,
                        'trangthaiba'=>$trangthaiba,
                        'id'=>$id,
                        'ngaytn' => $ngaytn,
                        'htdt'=> $htdt,
                        'khoadt'=>$khoadt,
                        'idbn'=>$bn->IdBN,
                        'loaiba'=>$loaiba
                    );
                    
                    $dsba[]=$ttba;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'benhan'=>$dsba,
                'sl' => $sl,
                'bn'=>$hoten
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
