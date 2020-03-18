<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Events\KhamVaDieuTri\ChiDinhPT;
use App\Models\KhamVaDieuTri\chi_dinh_pt;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\HanhChinh\thong_ke;

class chiDinhPTController extends Controller
{
    //
    public function getDanhSach(){
        $dspt=array();
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        foreach($dsbanoi as $ba){
            foreach ($ba->benhAnNoiTruCT as $value) {
                if(is_object($value->phieuChiDinhPT)){
                    $dspt[]=$value->phieuChiDinhPT;
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
        
        return view("kham_vs_dieu_tri.phau_thuat", ['dspt'=>$dspt, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    
    public function postLayDSCDBA(Request $request){
        try{
            $ba= benh_an_noi_tru_ct::where('IdBACT', $request->idba)->get()->first();
            if(is_object($ba->phieuChiDinhPT)){//Đã ra các chỉ định
                $dscdpt = array(
                    'tenpt' => $ba->phieuChiDinhPT->danhMucCLS->TenCLS,
                    'phongth' => $ba->phieuChiDinhPT->phongBan->SoPhong.' - '.$ba->phieuChiDinhPT->phongBan->TenPhong,
                    'nv' => $ba->phieuChiDinhPT->nhanVien->TenNV,
                    'ngayracd' => \comm_functions::deDateFormat($ba->phieuChiDinhPT->created_at),
                    'iddmcls' => $ba->phieuChiDinhPT->danhMucCLS->IdDMCLS,
                    'pp'=>$ba->phieuChiDinhPT->PhuongPhapTH,
                    'idpt'=>$ba->phieuChiDinhPT->IdPT
                );
                $response = array(
                    'msg' => 'cocd',
                    'dscdpt'=>$dscdpt
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
    
    public function postKTPT(Request $request){
        try{
            $cdpt= chi_dinh_pt::where('IdBACT', $request->maba)->get()->first();
            $flag=FALSE;
            if(is_object($cdpt)){
                $flag=TRUE;
            }
            $response=array(
                'msg'=>$flag,
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
            $cdpt= new chi_dinh_pt;
            $cdpt->IdPT= chiDinhPTController::TaoMaNN();
            $cdpt->IdBACT=$request->maba;
            $cdpt->IdNVTH=$request->nv;
            $cdpt->IdPB=$request->mapb;
            $cdpt->IdDMCLS=$request->mapt;
            $cdpt->TinhTrangTT=0;
            $cdpt->GhiChu=$request->ghichu;
            $cdpt->LoaiCD=$request->loaicd;
            $cdpt->PhuongPhapTH=$request->pp;
            $cdpt->save();

            event(new ChiDinhPT($cdpt, 'them'));
            
            $response = array(
                'msg' => 'tc',
                'idpt'=>$cdpt->IdPT
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
        try{
            if(strpos($request->idpt, ',')){
                $arr= explode(',',$request->idpt);
                try{
                    foreach ($arr as $a){
                        $cdpt= chi_dinh_pt::where("IdPT", $a)->get()->first();
                        $cdpt->delete();
                    }

                    event(new ChiDinhPT($arr, 'xoa'));

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
                $cdpt= chi_dinh_pt::where("IdPT", $request->idpt)->get()->first();
                $cdpt->delete();

                event(new ChiDinhPT($request->idpt, 'xoa'));

                $response = array(
                    'msg' => 'tc'
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
    
    public function postLayTTCN (Request $request){
        try{
            $cdpt= chi_dinh_pt::where('IdPT', $request->idpt)->get()->first();
            
            $cd= array(
                'msg'=>'tc',
                'tenpt'=>$cdpt->danhMucCLS->TenCLS,
                'phongth'=>$cdpt->IdPB,
                'nv'=>$cdpt->nhanVien->TenNV,
                'ghichu'=>$cdpt->GhiChu,
                'loaicd'=>$cdpt->LoaiCD,
                'idpt'=>$cdpt->IdPT,
                'pp'=>$cdpt->PhuongPhapTH
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
            $cdpt= chi_dinh_pt::where('IdPT', $request->mapt)->get()->first();
            if($cdpt->benhAnNoiTruCT->benhAnNoiTru->TrangThaiBA == 0){
                $response = array(
                    'msg' => 'ktdt'
                );
                return response()->json($response); 
            }
            else{
                $ngayht = \DateTime::createFromFormat("d/m/Y", date('d/m/Y'));
                $ngaykt= \DateTime::createFromFormat("d/m/Y", date('d/m/Y', strtotime($cdpt->benhAnNoiTruCT->NgayKT)));
                if($ngayht > $ngaykt){
                    $response = array(
                        'msg' => 'dakt'
                    );
                    return response()->json($response); 
                }
            }
            $cdpt->IdNVTH= $request->nv;
            $cdpt->IdPB=$request->mapb;
            $cdpt->GhiChu=$request->ghichu;
            $cdpt->LoaiCD=$request->loaicd;
            $cdpt->PhuongPhapTH=$request->pp;
            $cdpt->save();
                  
            event(new ChiDinhPT($cdpt, 'sua'));
            
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
            $cdpt= chi_dinh_pt::where('IdPT', $request->idpt)->get()->first();
            
            $data="<tr style='font-weight: 600;'>
                <td class='text-center'>".$cdpt->danhMucCLS->TenCLS."</td>
                <td>".$cdpt->nhanVien->TenNV."</td>
                <td>".$cdpt->PhuongPhapTH."</td>
                <td class='text-right'>".$cdpt->GhiChu."</td>
                </tr>";
            $loaicd=FALSE;
            if($cdpt->LoaiCD == TRUE){
                $loaicd=TRUE;
            }
            $ba=$cdpt->benhAnNoiTruCT->benhAnNoiTru;
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
                'mapcd'=>$cdpt->IdPT,
                'pg'=>$ba->thietBiYT->phongBan->SoPhong.'/'.$ba->thietBiYT->SoTB
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
            $ds_pt= DB::select("SELECT DISTINCT cls.`IdPT` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pk_ba.`IdPhieuDKKB`=pdk.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON ba.`IdBANoiT`=pk_ba.`IdBANoiT` JOIN benh_an_noi_tru_ct AS bact ON bact.`IdBANoiT` = ba.`IdBANoiT` JOIN chi_dinh_pt AS cls ON cls.`IdBACT` = bact.`IdBACT` JOIN danh_muc_cls AS dmcls ON dmcls.`IdDMCLS` = cls.`IdDMCLS` JOIN chuan_doan_vs_benh_an_noi_tru AS cd_ba ON cd_ba.`IdBANoiT` = ba.`IdBANoiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_ba.`IdBenh` JOIN phong_ban AS pb ON pb.`IdPB` = cls.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` JOIN nhan_vien AS nvth ON nvth.`IdNV` = cls.`IdNVTH` WHERE ba.`IdNV` = N'".$idnv."' AND ((nvth.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmcls.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (cls.`PhuongPhapTH` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(cls.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('Phòng số ', pb.`SoPhong`, ' - ', pb.TenPhong) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmb.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'BHYT Bảo hiểm y tế' ELSE N'TP Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY cls.`IdPT` ORDER BY cls.created_at DESC");
            $dspt = array();
            $sl=0;
            if(!empty($ds_pt)){
                foreach ($ds_pt as $t){
                    $pt= chi_dinh_pt::where("IdPT", $t->IdPT)->get()->first();
                    $ba=$pt->benhAnNoiTruCT->benhAnNoiTru;
                    
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
                    $ttpt=array(
                        'id'=>$pt->IdPT,
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                        'dttn'=>$dttn,
                        'tencls'=>$pt->danhMucCLS->TenCLS,
                        'chuandoan'=>$chuandoan,
                        'ngayracd'=> \comm_functions::deDateFormat($pt->created_at),
                        'phongth'=>'Phòng số '.$pt->phongBan->SoPhong.' - '.$pt->phongBan->TenPhong,
                        'nvth'=>$pt->nhanVien->TenNV,
                        'ppth'=>$pt->PhuongPhapTH
                    );
                    $dspt[]=$ttpt;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dscd'=>$dspt,
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
            $dspt=array();
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;

            $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach($dsbanoi as $ba){
                foreach ($ba->benhAnNoiTruCT as $value) {
                    if(is_object($value->phieuChiDinhPT)){
                        $dspt[]=$value->phieuChiDinhPT;
                    }
                }
            }
            $ds_pt=array();
            
            foreach ($dspt as $pt) {
                $ba=$pt->benhAnNoiTruCT->benhAnNoiTru;
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
                $ttpt=array(
                    'id'=>$pt->IdPT,
                    'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                    'dttn'=>$dttn,
                    'tencls'=>$pt->danhMucCLS->TenCLS,
                    'chuandoan'=>$chuandoan,
                    'ngayracd'=> \comm_functions::deDateFormat($pt->created_at),
                    'phongth'=>'Phòng số '.$pt->phongBan->SoPhong.' - '.$pt->phongBan->TenPhong,
                    'nvth'=>$pt->nhanVien->TenNV,
                    'ppth'=>$pt->PhuongPhapTH
                );
                $ds_pt[]=$ttpt;
            }
            $response = array(
                'msg' => 'tc',
                'dscd'=>$ds_pt
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
        $ds= chi_dinh_pt::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $cdtt) {
                   if($cdtt->IdPT == $ran){
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
