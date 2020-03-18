<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru_vs_can_lam_sang;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct_vs_can_lam_sang;
use App\Models\KhamVaDieuTri\can_lam_sang;
use App\Events\KhamVaDieuTri\CanLamSang;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;

class canLamSangController extends Controller
{
    //
    public function getDanhSach(){
        $dscls=array();
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $dsbangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        foreach ($dsbangoai as $value){
            if(count($value->CanLamSang)>0){
                foreach ($value->CanLamSang as $v) {
                    $dscls[]=$v->canLamSang;
                }
            }
        }
        $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        foreach($dsbanoi as $ba){
            foreach ($ba->benhAnNoiTruCT as $value) {
                if(count($value->canLamSang)>0){
                    foreach ($value->canLamSang as $v) {
                        $dscls[]=$v->canLamSang;
                    }
                }
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

        return view("kham_vs_dieu_tri.can_lam_sang", ['dscls'=>$dscls, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    
    public function postDanhSachCDCLSNgoai(Request $request){
        try{
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
            if(is_object($ba->CanLamSang)){//Đã ra các chỉ định
                $dscdcls = array();
                foreach ($ba->CanLamSang as $cd){
                    $cd=$cd->canLamSang;
                    $cdcls= array(
                        'tencls' => $cd->danhMucCLS->TenCLS,
                        'phongth' => $cd->phongBan->SoPhong.' - '.$cd->phongBan->TenPhong,
                        'ngayracd' => date('d/m/Y', strtotime($cd->created_at)),
                        'iddmcls' => $cd->danhMucCLS->IdDMCLS,
                        'idcls'=>$cd->IdCLS
                        
                    );
                    $dscdcls[]=$cdcls;
                }
                $response = array(
                    'msg' => 'cocd',
                    'dscdcls'=>$dscdcls
                );
                return response()->json($response); 
            }
            else{
                $response = array(
                    'msg' => 'koco'
                );

                return response()->json($response); 
            }
        } catch (\Exception $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
    
    public function postKTCLSNgoaiTru(Request $request){
        try{
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->maba)->get()->first();
            $flag=FALSE;
            if(is_object($ba->CanLamSang))
            {
                foreach ($ba->CanLamSang as $cls){
                    if($cls->canLamSang->IdDMCLS == $request->macls)
                    {
                        $flag=TRUE;
                        break;
                    }
                }
            }
            
            $response=array(
                'msg'=>$flag
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
    
    public function postThem(Request $request){
        try{
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->maba)->get()->first();
            if($ba->TrangThaiBA == 0){
                $response = array(
                    'msg' => 'ktdt'
                );
                return response()->json($response); 
            }
            
            //thêm trên bảng cls
            $cls= new can_lam_sang;
            $cls->IdCLS= canLamSangController::TaoMaNN();
            $cls->IdDMCLS=$request->macls;
            $cls->IdPB=$request->mapb;
            $cls->TinhTrangTT=0;
            
            $cls->GhiChu=$request->ghichu;
            $cls->LoaiCD=$request->loaicd;
            $cls->save();

            //thêm trên bảng quan hệ cls với bệnh án
            $cls_vs_ba=new benh_an_ngoai_tru_vs_can_lam_sang;
            $cls_vs_ba->IdBANgoaiT=$request->maba;
            $cls_vs_ba->IdCLS=$cls->IdCLS;

            $cls_vs_ba->save();
            
            
            event(new CanLamSang($cls, 'them'));

            $response = array(
                'msg' => 'tc',
                'idcls'=>$cls->IdCLS
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
        if(strpos($request->idcls, ',')){//gửi nhiều mã
            $arr= explode(',',$request->idcls);
            try{
                foreach ($arr as $a){
                    $cdcls= can_lam_sang::where("IdCLS", $a)->get()->first();
                    $cdcls->delete();
                }
                
                event(new CanLamSang($arr, 'xoa'));
                
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
                $cdcls= can_lam_sang::where("IdCLS", $request->idcls)->get()->first();
                $cdcls->delete();
                
                event(new CanLamSang($request->idcls, 'xoa'));
                
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
    
    public function postSua(Request $request)
    {
        try{
            $cdcls= can_lam_sang::where('IdCLS', $request->macls)->get()->first();
            if(is_object($cdcls->benhAnNgoaiTru)){
                if($cdcls->benhAnNgoaiTru->benhAnNgoaiTru->TrangThaiBA == 0){
                    $response = array(
                        'msg' => 'ktdt'
                    );
                    return response()->json($response); 
                }
            }
            else if(is_object($cdcls->benhAnNoiTruCT)){
                if($cdcls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->TrangThaiBA == 0){
                    $response = array(
                        'msg' => 'ktdt'
                    );
                    return response()->json($response); 
                }
                else{
                    $ngayht = \DateTime::createFromFormat("d/m/Y", date('d/m/Y'));
                    $ngaykt= \DateTime::createFromFormat("d/m/Y", date('d/m/Y', strtotime($cdcls->benhAnNoiTruCT->benhAnNoiTruCT->NgayKT)));
                    if($ngayht > $ngaykt){
                        $response = array(
                            'msg' => 'dakt'
                        );
                        return response()->json($response); 
                    }
                }
            }
            $cdcls->IdPB=$request->mapb;
            $cdcls->GhiChu=$request->ghichu;
            $cdcls->LoaiCD=$request->loaicd;
            $cdcls->save();
                  
            event(new CanLamSang($cdcls, 'sua'));
            
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
    
    public function postLayTTCN (Request $request){
        try{
            $cdcls= can_lam_sang::where('IdCLS', $request->idcls)->get()->first();
            
            $cd= array(
                'msg'=>'tc',
                'tencls'=>$cdcls->danhMucCLS->TenCLS,
                'phongth'=>$cdcls->IdPB,
                'ghichu'=>$cdcls->GhiChu,
                'loaicd'=>$cdcls->LoaiCD,
                'idcls'=>$cdcls->IdCLS
            );

            return response()->json($cd);
        }
        catch(\Exception $ex){
            $err=$ex->getMessage();
            $response=array(
                'msg'=>$err
            );

            return response()->json($response);
        }
    }
    
    public function postIn(Request $request){
        try {
            $cls= can_lam_sang::where('IdCLS', $request->idcls)->get()->first();
            $loaicd=FALSE;
            $result='';$bn='';
            if(is_object($cls)){
                $result="<tr style='font-weight: 600;'>
                <td class='text-center'>1</td>
                <td>".$cls->danhMucCLS->TenCLS."</td>
                <td class='text-right'>".$cls->GhiChu."</td>
                </tr>";
                if($cls->LoaiCD == TRUE){
                    $loaicd=TRUE;
                }
                //lấy thông tin liên quan đến bệnh nhân
                $ba=$cls->benhAnNgoaiTru->benhAnNgoaiTru;
                $benhnhan=$ba->phieuDKKham->phieuDKKham->benhNhan;
                $nvcd=$ba->nhanVien;
                $tang='TRIỆT';
                if($tang != 0){
                    $tang='LẦU '.$nvcd->phongBan->Tang;
                }
                $pk='P.KHÁM '.mb_convert_case($nvcd->phongBan->Khoa->TenKhoa, MB_CASE_UPPER, 'utf-8').' ( '.$nvcd->phongBan->SoPhong.' - '.$tang.' )';
                $bare_code_mabn=\Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($benhnhan->IdBN, "C128", 1.3, 25);
                $dtk='THU PHÍ';
                if(is_object($benhnhan->theBHYT)){
                    if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 0){
                        $dtk='BHYT ('.\comm_functions::getMucHuongDTK($benhnhan->theBHYT->DoiTuongBHYT).'%) - QL'.substr($benhnhan->theBHYT->IdTheBHYT, 2, 1);
                    }
                }

                $ngaysinh=date( "m/d/Y", strtotime( $benhnhan->NgaySinh ));
                $gt='Nam';
                if($benhnhan->GioiTinh == 0){
                    $gt='Nữ';
                }
                $mathe='koco';$ngaydk='';
                if(is_object($benhnhan->theBHYT)){
                    $mathe=$benhnhan->theBHYT->IdTheBHYT.' - '. substr($benhnhan->theBHYT->IdTheBHYT, 3, 2).$benhnhan->theBHYT->coSoKhamBHYT->IdCSKBHYT;
                    $ngaydk='['.date( "m/d/Y", strtotime( $benhnhan->theBHYT->NgayDK )).' - '.date( "m/d/Y", strtotime( $benhnhan->theBHYT->NgayHH )).']';
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
                    'dtk'=>$dtk,
                    'ngaysinh'=>$ngaysinh,
                    'gt'=>$gt,
                    'mathe'=>$mathe,
                    'ngaydk'=>$ngaydk,
                    'diachi'=>$diachi,
                    'chuandoan'=>$chuandoan,
                    'nvcd'=>$nvcd->TenNV,
                    'loaicd'=>$loaicd,
                    'tenkhoa'=>$nvcd->phongBan->Khoa->TenKhoa,
                    'mapcd'=>$cls->IdCLS,
                    'tencls'=>$cls->danhMucCLS->TenCLS
                );
            }
            
            $response=array(
                'data'=>$result,
                'bn'=>$bn,
                'msg'=>'tc'
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
    
    public function postTimKiem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $key=$request->keyWords;
            $ds_cls= DB::select("SELECT DISTINCT a.`IdCLS` FROM(
(select nv.`IdNV`, cls.`IdCLS`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, dmb.`TenBenh`, CASE WHEN 1=1 THEN 0 END AS LoaiBA, pb.`SoPhong`, pb.`TenPhong`, cls.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN benh_an_ngoai_tru_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN chuan_doan_vs_benh_an_ngoai_tru AS cd_ba ON cd_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV`)

UNION ALL

(select nv.`IdNV`, cls.`IdCLS`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, dmb.`TenBenh`, CASE WHEN 1=1 THEN 1 END AS LoaiBA, pb.`SoPhong`, pb.`TenPhong`, cls.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN benh_an_noi_tru_ct_vs_can_lam_sang AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN can_lam_sang AS cls ON cls.`IdCLS` = cls_ba.`IdCLS` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN chuan_doan_vs_benh_an_noi_tru AS cd_ba ON cd_ba.`IdBANoiT` = ba.`IdBANoiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV`)

) AS a WHERE a.`IdNV` = N'".$idnv."' AND ((a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('Phòng số ', a.`SoPhong`, ' - ', a.TenPhong) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Nội trú' ELSE N'Ngoại trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`KhamBHYT` IS FALSE THEN N'BHYT Bảo hiểm y tế' ELSE N'TP Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`IdCLS` ORDER BY a.created_at DESC");
            $dscls = array();
            $sl=0;
            if(!empty($ds_cls)){
                foreach ($ds_cls as $c){
                    $cls= can_lam_sang::where("IdCLS", $c->IdCLS)->get()->first();
                    $ba='';$htdt='Nội trú';
                    if(is_object($cls->benhAnNoiTruCT)){
                        $ba=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru;
                    }
                    if(is_object($cls->benhAnNgoaiTru)){
                        $htdt='Ngoại trú';
                        $ba=$cls->benhAnNgoaiTru->benhAnNgoaiTru;
                    }
                    
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
                    $ttcls=array(
                        'id'=>$cls->IdCLS,
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                        'dttn'=>$dttn,
                        'htdt'=>$htdt,
                        'tencls'=>$cls->danhMucCLS->TenCLS,
                        'chuandoan'=>$chuandoan,
                        'ngayracd'=> \comm_functions::deDateFormat($cls->created_at),
                        'phongth'=>'Phòng số '.$cls->phongBan->SoPhong.' - '.$cls->phongBan->TenPhong
                    );
                    $dscls[]=$ttcls;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dscd'=>$dscls,
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
            $dscls=array();
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;

            $dsbangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach ($dsbangoai as $value){
                if(count($value->CanLamSang)>0){
                    foreach ($value->CanLamSang as $v) {
                        $dscls[]=$v->canLamSang;
                    }
                }
            }
            $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach($dsbanoi as $ba){
                foreach ($ba->benhAnNoiTruCT as $value) {
                    if(count($value->canLamSang)>0){
                        foreach ($value->canLamSang as $v) {
                            $dscls[]=$v->canLamSang;
                        }
                    }
                }
            }
            $ds_cls=array();
            
            foreach ($dscls as $cls) {
                $ba='';$htdt='Nội trú';
                if(is_object($cls->benhAnNoiTruCT)){
                    $ba=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru;
                }
                if(is_object($cls->benhAnNgoaiTru)){
                    $htdt='Ngoại trú';
                    $ba=$cls->benhAnNgoaiTru->benhAnNgoaiTru;
                }

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
                $ttcls=array(
                    'id'=>$cls->IdCLS,
                    'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                    'dttn'=>$dttn,
                    'htdt'=>$htdt,
                    'tencls'=>$cls->danhMucCLS->TenCLS,
                    'chuandoan'=>$chuandoan,
                    'ngayracd'=> \comm_functions::deDateFormat($cls->created_at),
                    'phongth'=>'Phòng số '.$cls->phongBan->SoPhong.' - '.$cls->phongBan->TenPhong
                );
                $ds_cls[]=$ttcls;
            }
            $response = array(
                'msg' => 'tc',
                'dscd'=>$ds_cls
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
        $ds= can_lam_sang::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $cls ){
                   if($cls->IdCLS == $ran){
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
    
    public function postDanhSachCDCLSNoi(Request $request){
        try{
            $ba= benh_an_noi_tru_ct::where('IdBACT', $request->idba)->get()->first();
            if(is_object($ba->canLamSang)){//Đã ra các chỉ định
                $dscdcls = array();
                foreach ($ba->canLamSang as $cd){
                    $cd=$cd->canLamSang;
                    $cdcls= array(
                        'tencls' => $cd->danhMucCLS->TenCLS,
                        'phongth' => $cd->phongBan->SoPhong.' - '.$cd->phongBan->TenPhong,
                        'ngayracd' => date('d/m/Y', strtotime($cd->created_at)),
                        'iddmcls' => $cd->danhMucCLS->IdDMCLS,
                        'idcls'=>$cd->IdCLS
                        
                    );
                    $dscdcls[]=$cdcls;
                }
                $response = array(
                    'msg' => 'cocd',
                    'dscdcls'=>$dscdcls
                );
                return response()->json($response); 
            }
            else{
                $response = array(
                    'msg' => 'koco'
                );

                return response()->json($response); 
            }
        } catch (\Exception $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
    
    public function postKTCLSNoiTru(Request $request){
        try{
            $ba= benh_an_noi_tru_ct::where('IdBACT', $request->maba)->get()->first();
            $flag=FALSE;
            if(is_object($ba->canLamSang))
            {
                foreach ($ba->canLamSang as $cls){
                    if($cls->canLamSang->IdDMCLS == $request->macls)
                    {
                        $flag=TRUE;
                        break;
                    }
                }
            }
            
            $response=array(
                'msg'=>$flag
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
    
    public function postThemNoi(Request $request){
        try{
            $ba= benh_an_noi_tru_ct::where('IdBACT', $request->maba)->get()->first();
            if($ba->benhAnNoiTru->TrangThaiBA == 0){
                $response = array(
                    'msg' => 'ktdt'
                );
                return response()->json($response); 
            }
            else{
                $ngayht = \DateTime::createFromFormat("d/m/Y", date('d/m/Y'));
                $ngaykt= \DateTime::createFromFormat("d/m/Y", date('d/m/Y', strtotime($ba->NgayKT)));
                if($ngayht > $ngaykt){
                    $response = array(
                        'msg' => 'dakt'
                    );
                    return response()->json($response); 
                }
            }
            //thêm trên bảng cls
            $cls= new can_lam_sang;
            $cls->IdCLS= canLamSangController::TaoMaNN();
            $cls->IdDMCLS=$request->macls;
            $cls->IdPB=$request->mapb;
            $cls->TinhTrangTT=0;
            
            $cls->GhiChu=$request->ghichu;
            $cls->LoaiCD=$request->loaicd;
            $cls->save();

            //thêm trên bảng quan hệ cls với bệnh án
            $cls_vs_ba=new benh_an_noi_tru_ct_vs_can_lam_sang;
            $cls_vs_ba->IdBACT=$request->maba;
            $cls_vs_ba->IdCLS=$cls->IdCLS;

            $cls_vs_ba->save();

            event(new CanLamSang($cls, 'them'));

            $response = array(
                'msg' => 'tc',
                'idcls'=>$cls->IdCLS
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
    
    public function postInNoi(Request $request){
        try {
            $cls= can_lam_sang::where('IdCLS', $request->idcls)->get()->first();
            $loaicd=FALSE;
            $result='';$bn='';
            if(is_object($cls)){
                $result="<tr style='font-weight: 600;'>
                <td class='text-center'>1</td>
                <td>".$cls->danhMucCLS->TenCLS."</td>
                <td class='text-right'>".$cls->GhiChu."</td>
                </tr>";
                if($cls->LoaiCD == TRUE){
                    $loaicd=TRUE;
                }
                //lấy thông tin liên quan đến bệnh nhân
                $ba=$cls->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru;
                $benhnhan=$ba->phieuDKKham->phieuDKKham->benhNhan;
                $nvcd=$ba->nhanVien;
                $tang='TRIỆT';
                if($tang != 0){
                    $tang='LẦU '.$nvcd->phongBan->Tang;
                }
                $pk='P.KHÁM '.mb_convert_case($nvcd->phongBan->Khoa->TenKhoa, MB_CASE_UPPER, 'utf-8').' ( '.$nvcd->phongBan->SoPhong.' - '.$tang.' )';
                $bare_code_mabn=\Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($benhnhan->IdBN, "C128", 1.3, 25);
                $dtk='THU PHÍ';
                if(is_object($benhnhan->theBHYT)){
                    if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 0){
                        $dtk='BHYT ('.\comm_functions::getMucHuongDTK($benhnhan->theBHYT->DoiTuongBHYT).'%) - QL'.substr($benhnhan->theBHYT->IdTheBHYT, 2, 1);
                    }
                }

                $ngaysinh=date( "m/d/Y", strtotime( $benhnhan->NgaySinh ));
                $gt='Nam';
                if($benhnhan->GioiTinh == 0){
                    $gt='Nữ';
                }
                $mathe='koco';$ngaydk='';
                if(is_object($benhnhan->theBHYT)){
                    $mathe=$benhnhan->theBHYT->IdTheBHYT.' - '. substr($benhnhan->theBHYT->IdTheBHYT, 3, 2).$benhnhan->theBHYT->coSoKhamBHYT->IdCSKBHYT;
                    $ngaydk='['.date( "m/d/Y", strtotime( $benhnhan->theBHYT->NgayDK )).' - '.date( "m/d/Y", strtotime( $benhnhan->theBHYT->NgayHH )).']';
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
                    'dtk'=>$dtk,
                    'ngaysinh'=>$ngaysinh,
                    'gt'=>$gt,
                    'mathe'=>$mathe,
                    'ngaydk'=>$ngaydk,
                    'diachi'=>$diachi,
                    'chuandoan'=>$chuandoan,
                    'nvcd'=>$nvcd->TenNV,
                    'loaicd'=>$loaicd,
                    'tenkhoa'=>$nvcd->phongBan->Khoa->TenKhoa,
                    'mapcd'=>$cls->IdCLS,
                    'tencls'=>$cls->danhMucCLS->TenCLS,
                    'pg'=>$ba->thietBiYT->phongBan->SoPhong.'/'.$ba->thietBiYT->SoTB
                );
            }
            
            $response=array(
                'data'=>$result,
                'bn'=>$bn,
                'msg'=>'tc'
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
    
}
