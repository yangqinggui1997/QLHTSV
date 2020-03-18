<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct;
use App\Events\KhamVaDieuTri\ChiDinhTT;
use App\Models\KhamVaDieuTri\chi_dinh_tt;
use App\Models\KhamVaDieuTri\chi_dinh_tt_vs_benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\chi_dinh_tt_vs_benh_an_ngoai_tru;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;

class chiDinhTTController extends Controller
{
    //
    public function getDanhSach(){
        $dstt=array();
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $dsbangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        foreach ($dsbangoai as $value){
            if(count($value->chiDinhTT)>0){
                foreach ($value->chiDinhTT as $v) {
                    $dstt[]=$v->chiDinhTT;
                }
            }
        }
        $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        foreach($dsbanoi as $ba){
            foreach ($ba->benhAnNoiTruCT as $value) {
                if(count($value->phieuChiDinhTT)>0){
                    foreach ($value->phieuChiDinhTT as $v) {
                        $dstt[]=$v->chiDinhTT;
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
        
        return view("kham_vs_dieu_tri.thu_thuat", ['dstt'=>$dstt, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    
    public function postLayDSCDBA(Request $request){
        try{
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
            if(is_object($ba->chiDinhTT)){//Đã ra các chỉ định
                $dscdtt = array();
                foreach ($ba->chiDinhTT as $cd){
                    $cd=$cd->chiDinhTT;
                    $ghichu='Không có';
                    if($cd->GhiChu != ''){
                        $ghichu=$cd->GhiChu;
                    }
                    $cdtt= array(
                        'tentt' => $cd->danhMucCLS->TenCLS,
                        'phongth' => $cd->phongBan->SoPhong.' - '.$cd->phongBan->TenPhong,
                        'nv' => $cd->nhanVien->TenNV,
                        'ngayracd' => date('d/m/Y', strtotime($cd->created_at)),
                        'iddmcls' => $cd->danhMucCLS->IdDMCLS,
                        'idtt'=>$cd->IdThuThuat,
                        'ghichu'=>$ghichu
                        
                    );
                    $dscdtt[]=$cdtt;
                }
                $response = array(
                    'msg' => 'cocd',
                    'dscdtt'=>$dscdtt
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
    
    public function postKTTTNgoaiTru(Request $request){
        try{
            $cdtt_vs_ba= chi_dinh_tt_vs_benh_an_ngoai_tru::where('IdBANgoaiT', $request->maba)->get();
            $flag=FALSE;
            if(is_object($cdtt_vs_ba)){
                foreach($cdtt_vs_ba as $cdtt){
                    if($cdtt->chiDinhTT->IdDMCLS == $request->matt)
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
            
            //thêm trên bảng chỉ định
            $cdtt= new chi_dinh_tt;
            $cdtt->IdThuThuat= chiDinhTTController::TaoMaNN();
            $cdtt->IdNVTH=$request->nv;
            $cdtt->IdPB=$request->mapb;
            $cdtt->IdDMCLS=$request->matt;
            $cdtt->TinhTrangTT=0;
            $cdtt->GhiChu=$request->ghichu;
            $cdtt->LoaiCD=$request->loaicd;
            $cdtt->save();

            //thêm trên bảng quan hệ cd với bệnh án
            $cd_vs_ba=new chi_dinh_tt_vs_benh_an_ngoai_tru;
            $cd_vs_ba->IdBANgoaiT=$request->maba;
            $cd_vs_ba->IdThuThuat=$cdtt->IdThuThuat;

            $cd_vs_ba->save();

            event(new ChiDinhTT($cdtt, 'them'));
            
            $response = array(
                'msg' => 'tc',
                'idtt'=> $cdtt->IdThuThuat
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
        if(strpos($request->idtt, ',')){//gửi nhiều mã
            $arr= explode(',',$request->idtt);
            try{
                foreach ($arr as $a){
                    $cdtt= chi_dinh_tt::where("IdThuThuat", $a)->get()->first();
                    $cdtt->delete();
                }
                
                event(new ChiDinhTT($arr, 'xoa'));
                
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
                $cdtt= chi_dinh_tt::where("IdThuThuat", $request->idtt)->get()->first();
                $cdtt->delete();
                
                event(new ChiDinhTT($request->idtt, 'xoa'));
                
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
    
    public function postLayTTCN (Request $request){
        try{
            $cdtt= chi_dinh_tt::where('IdThuThuat', $request->idtt)->get()->first();
            
            $cd= array(
                'msg'=>'tc',
                'tentt'=>$cdtt->danhMucCLS->TenCLS,
                'phongth'=>$cdtt->IdPB,
                'nv'=>$cdtt->nhanVien->TenNV,
                'ghichu'=>$cdtt->GhiChu,
                'loaicd'=>$cdtt->LoaiCD,
                'idtt'=>$cdtt->IdThuThuat
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
    
    public function postSua(Request $request)
    {
        try{
            $cdtt= chi_dinh_tt::where('IdThuThuat', $request->matt)->get()->first();
            if(is_object($cdtt->benhAnNgoaiTru)){
                if($cdtt->benhAnNgoaiTru->benhAnNgoaiTru->TrangThaiBA == 0){
                    $response = array(
                        'msg' => 'ktdt'
                    );
                    return response()->json($response); 
                }
            }
            else if(is_object($cdtt->benhAnNoiTruCT)){
                if($cdtt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru->TrangThaiBA == 0){
                    $response = array(
                        'msg' => 'ktdt'
                    );
                    return response()->json($response); 
                }
                else{
                    $ngayht = \DateTime::createFromFormat("d/m/Y", date('d/m/Y'));
                    $ngaykt= \DateTime::createFromFormat("d/m/Y", date('d/m/Y', strtotime($cdtt->benhAnNoiTruCT->benhAnNoiTruCT->NgayKT)));
                    if($ngayht > $ngaykt){
                        $response = array(
                            'msg' => 'dakt'
                        );
                        return response()->json($response); 
                    }
                }
            }
            
            $cdtt->IdNVTH= $request->nv;
            $cdtt->IdPB=$request->mapb;
            $cdtt->GhiChu=$request->ghichu;
            $cdtt->LoaiCD=$request->loaicd;
            $cdtt->save();
                  
            event(new ChiDinhTT($cdtt, 'sua'));
            
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
    
    public function postIn(Request $request){
        try {
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
            $data=array();
            $k=1;
            $loaicd=FALSE;
            foreach ($ba->chiDinhTT as $tt){
                $tt=$tt->chiDinhTT;
                $result="<tr style='font-weight: 600;'>
                <td class='text-center'>".$k."</td>
                <td>".$tt->danhMucCLS->TenCLS."</td>
                <td>".$tt->nhanVien->TenNV."</td>
                <td class='text-right'>".$tt->GhiChu."</td>
                </tr>";
                
                $data[]=$result;
                if($tt->LoaiCD == TRUE){
                    $loaicd=TRUE;
                }
                $k++;
            }
            //lấy thông tin liên quan đến bệnh nhân
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
                'mapcd'=>$ba->IdBANgoaiT
            );
            
            $response=array(
                'data'=>$data,
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
            $ds_tt= DB::select("SELECT DISTINCT a.`IdThuThuat` FROM(
(select nv.`IdNV`, nvth.`TenNV`, cls.`IdThuThuat`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, dmb.`TenBenh`, CASE WHEN 1=1 THEN 0 END AS LoaiBA, pb.`SoPhong`, pb.`TenPhong`, cls.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS ba ON ba.`IdBANgoaiT`=pk_ba.`IdBANgoaiT` JOIN chi_dinh_tt_vs_benh_an_ngoai_tru AS cls_ba ON cls_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN chi_dinh_tt AS cls ON cls.`IdThuThuat` = cls_ba.`IdThuThuat` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN chuan_doan_vs_benh_an_ngoai_tru AS cd_ba ON cd_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` JOIN nhan_vien AS nvth ON nvth.`IdNV` = cls.`IdNVTH`)

UNION ALL

(select nv.`IdNV`, nvth.`TenNV`, cls.`IdThuThuat`, dmcls.`TenCLS`, bn.`HoTen`, pdk.`KhamBHYT`, dmb.`TenBenh`, CASE WHEN 1=1 THEN 1 END AS LoaiBA, pb.`SoPhong`, pb.`TenPhong`, cls.created_at FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN chi_dinh_tt_vs_benh_an_noi_tru_ct AS cls_ba ON cls_ba.`IdBACT` = bact.`IdBACT` JOIN chi_dinh_tt AS cls ON cls.`IdThuThuat` = cls_ba.`IdThuThuat` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN chuan_doan_vs_benh_an_noi_tru AS cd_ba ON cd_ba.`IdBANoiT` = ba.`IdBANoiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` JOIN nhan_vien AS nvth ON nvth.`IdNV` = cls.`IdNVTH`) 

) AS a 

WHERE a.`IdNV` = N'".$idnv."' AND ((a.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('Phòng số ', a.`SoPhong`, ' - ', a.TenPhong) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`LoaiBA` = 0 THEN N'Nội trú' ELSE N'Ngoại trú' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (a.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`KhamBHYT` IS FALSE THEN N'BHYT Bảo hiểm y tế' ELSE N'TP Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY a.`IdThuThuat` ORDER BY a.created_at DESC");
            $dstt = array();
            $sl=0;
            if(!empty($ds_tt)){
                foreach ($ds_tt as $t){
                    $tt= chi_dinh_tt::where("IdThuThuat", $t->IdThuThuat)->get()->first();
                    $ba='';$htdt='Nội trú';
                    if(is_object($tt->benhAnNoiTruCT)){
                        $ba=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru;
                    }
                    if(is_object($tt->benhAnNgoaiTru)){
                        $htdt='Ngoại trú';
                        $ba=$tt->benhAnNgoaiTru->benhAnNgoaiTru;
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
                    $tttt=array(
                        'id'=>$tt->IdThuThuat,
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                        'dttn'=>$dttn,
                        'htdt'=>$htdt,
                        'tencls'=>$tt->danhMucCLS->TenCLS,
                        'chuandoan'=>$chuandoan,
                        'ngayracd'=> \comm_functions::deDateFormat($tt->created_at),
                        'phongth'=>'Phòng số '.$tt->phongBan->SoPhong.' - '.$tt->phongBan->TenPhong,
                        'nvth'=>$tt->nhanVien->TenNV
                    );
                    $dstt[]=$tttt;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dscd'=>$dstt,
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
            $dstt=array();
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;

            $dsbangoai= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach ($dsbangoai as $value){
                if(count($value->chiDinhTT)>0){
                    foreach ($value->chiDinhTT as $v) {
                        $dstt[]=$v->chiDinhTT;
                    }
                }
            }
            $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach($dsbanoi as $ba){
                foreach ($ba->benhAnNoiTruCT as $value) {
                    if(count($value->phieuChiDinhTT)>0){
                        foreach ($value->phieuChiDinhTT as $v) {
                            $dstt[]=$v->chiDinhTT;
                        }
                    }
                }
            }
            $ds_tt=array();
            
            foreach ($dstt as $tt) {
                $ba='';$htdt='Nội trú';
                if(is_object($tt->benhAnNoiTruCT)){
                    $ba=$tt->benhAnNoiTruCT->benhAnNoiTruCT->benhAnNoiTru;
                }
                if(is_object($tt->benhAnNgoaiTru)){
                    $htdt='Ngoại trú';
                    $ba=$tt->benhAnNgoaiTru->benhAnNgoaiTru;
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
                $tttt=array(
                    'id'=>$tt->IdThuThuat,
                    'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                    'dttn'=>$dttn,
                    'htdt'=>$htdt,
                    'tencls'=>$tt->danhMucCLS->TenCLS,
                    'chuandoan'=>$chuandoan,
                    'ngayracd'=> \comm_functions::deDateFormat($tt->created_at),
                    'phongth'=>'Phòng số '.$tt->phongBan->SoPhong.' - '.$tt->phongBan->TenPhong,
                    'nvth'=>$tt->nhanVien->TenNV
                );
                $ds_tt[]=$tttt;
            }
            $response = array(
                'msg' => 'tc',
                'dscd'=>$ds_tt
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
        $ds= chi_dinh_tt::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $cdtt) {
                   if($cdtt->IdThuThuat == $ran){
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
    
    public function postLayDSCDBANOI(Request $request){
        try{
            $ba= benh_an_noi_tru_ct::where('IdBACT', $request->idba)->get()->first();
            if(is_object($ba->phieuChiDinhTT)){//Đã ra các chỉ định
                $dscdtt = array();
                foreach ($ba->phieuChiDinhTT as $cd){
                    $cd=$cd->chiDinhTT;
                    $ghichu='Không có';
                    if($cd->GhiChu != ''){
                        $ghichu=$cd->GhiChu;
                    }
                    $cdtt= array(
                        'tentt' => $cd->danhMucCLS->TenCLS,
                        'phongth' => $cd->phongBan->SoPhong.' - '.$cd->phongBan->TenPhong,
                        'nv' => $cd->nhanVien->TenNV,
                        'ngayracd' => date('d/m/Y', strtotime($cd->created_at)),
                        'iddmcls' => $cd->danhMucCLS->IdDMCLS,
                        'idtt'=>$cd->IdThuThuat,
                        'ghichu'=>$ghichu
                    );
                    $dscdtt[]=$cdtt;
                }
                $response = array(
                    'msg' => 'cocd',
                    'dscdtt'=>$dscdtt
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
    
    public function postKTTTNoiTru(Request $request){
        try{
            $cdtt_vs_ba= chi_dinh_tt_vs_benh_an_noi_tru_ct::where('IdBACT', $request->maba)->get();
            $flag=FALSE;
            if(is_object($cdtt_vs_ba)){
                foreach($cdtt_vs_ba as $cdtt){
                    if($cdtt->chiDinhTT->IdDMCLS == $request->matt)
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
            //thêm trên bảng chỉ định
            $cdtt= new chi_dinh_tt;
            $cdtt->IdThuThuat= chiDinhTTController::TaoMaNN();
            $cdtt->IdNVTH=$request->nv;
            $cdtt->IdPB=$request->mapb;
            $cdtt->IdDMCLS=$request->matt;
            $cdtt->TinhTrangTT=0;
            $cdtt->GhiChu=$request->ghichu;
            $cdtt->LoaiCD=$request->loaicd;
            $cdtt->save();

            //thêm trên bảng quan hệ cd với bệnh án
            $cd_vs_ba=new chi_dinh_tt_vs_benh_an_noi_tru_ct;
            $cd_vs_ba->IdBACT=$request->maba;
            $cd_vs_ba->IdThuThuat=$cdtt->IdThuThuat;

            $cd_vs_ba->save();

            event(new ChiDinhTT($cdtt, 'them'));
            
            $response = array(
                'msg' => 'tc',
                'idtt'=> $cdtt->IdThuThuat
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
            $ba= benh_an_noi_tru_ct::where('IdBACT', $request->idba)->get()->first();
            $data=array();
            $k=1;
            $loaicd=FALSE;
            foreach ($ba->phieuChiDinhTT as $tt){
                $tt=$tt->chiDinhTT;
                $result="<tr style='font-weight: 600;'>
                <td class='text-center'>".$k."</td>
                <td>".$tt->danhMucCLS->TenCLS."</td>
                <td>".$tt->nhanVien->TenNV."</td>
                <td class='text-right'>".$tt->GhiChu."</td>
                </tr>";
                
                $data[]=$result;
                if($tt->LoaiCD == TRUE){
                    $loaicd=TRUE;
                }
                $k++;
            }
            //lấy thông tin liên quan đến bệnh nhân
            $benhnhan=$ba->benhAnNoiTru->phieuDKKham->phieuDKKham->benhNhan;
            $nvcd=$ba->benhAnNoiTru->nhanVien;
            $tang='TRIỆT';
            if($tang != 0){
                $tang='LẦU '.$nvcd->phongBan->Tang;
            }
            $pk='P.KHÁM '.mb_convert_case($nvcd->phongBan->Khoa->TenKhoa, MB_CASE_UPPER, 'utf-8').' ( '.$nvcd->phongBan->SoPhong.' - '.$tang.' )';
            $bare_code_mabn=\Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($benhnhan->IdBN, "C128", 1.3, 25);
            $dtk='THU PHÍ';
            if(is_object($benhnhan->theBHYT)){
                if($ba->benhAnNoiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0){
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
            foreach ($ba->benhAnNoiTru->chuanDoan as $cd) {
                if($i == count($ba->benhAnNoiTru->chuanDoan))
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
                'mapcd'=>$ba->IdBACT,
                'pg'=>$ba->BenhAnNoiTru->thietBiYT->phongBan->SoPhong.'/'.$ba->BenhAnNoiTru->thietBiYT->SoTB
            );
            
            $response=array(
                'data'=>$data,
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
