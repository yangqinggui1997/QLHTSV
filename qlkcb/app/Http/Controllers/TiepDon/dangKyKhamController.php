<?php

namespace App\Http\Controllers\TiepDon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\TiepDon\DangKyKham;
use App\Models\TiepDon\benh_nhan;
use App\Models\TiepDon\the_bhyt;
use App\Events\TiepDon\CapCuu;
use App\Models\HanhChinh\khoa;
use App\Models\HanhChinh\phong_ban;
use App\Models\TiepDon\phieu_dk_kham;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\HanhChinh\tinh_tp;
use Illuminate\Foundation\Auth\User;

class dangKyKhamController extends Controller
{
    //

    public function getDanhSach(){
        $dsbn= benh_nhan::orderBy('HoTen', 'ASC')->get();
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        
        $dskhoa= khoa::where([['KhoaKham', 1],['TenKDau', 'not like', '%cap%']])->orWhere([['KhoaKham', 1],['TenKDau', 'not like', '%cuu%']])->orderBy('TenKhoa', 'ASC')->get();
        $phieudk= phieu_dk_kham::where([['IdNV', $idnv],['DTTN',0]])->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('created_at', 'DESC')->get();
        return view("tiep_don.dang_ky_kham",['dsbn'=>$dsbn, 'dskhoa'=>$dskhoa, 'phieudk'=>$phieudk]);
    }
    
    public function getDanhSachCC(){
        $dsbn= benh_nhan::orderBy('HoTen', 'ASC')->get();
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $khoacc= khoa::where([['KhoaKham', 1],['TenKDau', 'like', '%cap%']])->orWhere('TenKDau', 'like', '%cuu%')->get()->first();
        $phieudk= phieu_dk_kham::where([['IdNV', $idnv],['DTTN',1]])->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('created_at', 'DESC')->get();
        
        return view("tiep_don.cap_cuu",['phieudk'=>$phieudk, 'dsphong'=>$khoacc->phongBan, 'dsbn'=>$dsbn]);
    }
    
    public function getDanhSachLS(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $dskhoa= khoa::where('KhoaKham', 1)->orderBy('TenKhoa', 'ASC')->get();
        $phieudk= phieu_dk_kham::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
        $dstinh= tinh_tp::orderBy('TenTinh', 'ASC')->get();
        return view("tiep_don.lich_su_dang_ky_kham",['dskhoa'=>$dskhoa, 'phieudk'=>$phieudk, 'dstinh' => $dstinh]);
    }
    
    public function postLayDSP(Request $request){
        $phong= phong_ban::where([['IdKhoa', $request->idkhoa], ['PhanLoai', 'phong_kham']])->orderBy('SoPhong', 'ASC')->get();
        $kq="";
        foreach ($phong as $p) {
            $kq.='<option value="'.$p->IdPB.'">'.'Số '.$p->SoPhong.' - '.$p->TenPhong.'</option>';
        }
 
        $response = array(
            'msg' => $kq,
        );
        return response()->json($response); 
    }
    
    public function postLayTTCN(Request $request){
        try{
            $pdkk= phieu_dk_kham::where('IdPhieuDKKB',$request->id)->get()->first();
            $response=array(
                'hoten' => $pdkk->IdBN,
                'htk' => $pdkk->KhamBHYT,
                'tuyen' => $pdkk->TuyenKham,
                'giaychuyen' => $pdkk->GiayChuyen,
                'khoa' => $pdkk->phongKham->IdKhoa,
                'phong' => $pdkk->IdPK,
                'ht'=>$pdkk->benhNhan->HoTen,
                'tenkhoa'=>$pdkk->phongKham->Khoa->TenKhoa,
                'tenphong'=>$pdkk->phongKham->SoPhong.' - '.$pdkk->phongKham->TenPhong
                
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
    
    public function postLayTTBN(Request $request){
        try{
            $benhnhan= benh_nhan::where('IdBN',$request->idbn)->get()->first();
            $gt='Nam';
            if($benhnhan->GioiTinh == 0){
                $gt='Nữ';
            }
            $dantoc ="Chưa cập nhật!";
            if($benhnhan->DanToc != ''){
                $dantoc = \comm_functions::decodeDanToc($benhnhan->DanToc);
            }
            $sdt ="Chưa cập nhật!";
            if($benhnhan->SDT != ''){
                $sdt = $benhnhan->SDT;
            }
            $scmnd="Chưa cập nhật!";
            if($benhnhan->SoCMND != ''){
                $scmnd=$benhnhan->SoCMND;
            }
            $diachi='';
            if($benhnhan->DiaChi != ''){
                $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            else{
                $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            //date in mm/dd/yyyy format; or it can be in other formats as well
            //explode the date to get month, day and year
            $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
            $response=array(
                'ngaysinh' => \comm_functions::deDateFormatForUpdate($benhnhan->NgaySinh),
                'gt' => $gt,
                'scmnd' => $scmnd,
                'sdt' => $sdt,
                'diachi' => $diachi,
                'dantoc' => $dantoc,  
                'idthe' => 'null',
                'anh'=>$benhnhan->Anh,
                'tuoi'=>$age,
            );
            
            if(is_object($benhnhan->theBHYT)){//bệnh nhân có thẻ bhyt
                $tuyen='Đúng tuyến';
                $chuyentu='Không chuyển';
                if($benhnhan->theBHYT->coSoKhamBHYT->Tuyen == 3){
                    $tuyen='Vượt tuyến';
                    $chuyentu='Tuyến huyện';
                }
                else if($benhnhan->theBHYT->coSoKhamBHYT->Tuyen == 4){
                    $tuyen='Vượt tuyến';
                    $chuyentu='Tuyến xã';
                }
                $response=array(
                    'ngaysinh' => \comm_functions::deDateFormatForUpdate($benhnhan->NgaySinh),
                    'gt' => $gt,
                    'scmnd' => $scmnd,
                    'sdt' => $sdt,
                    'diachi' => $diachi,
                    'dantoc' => $dantoc,  
                    'idthe' => substr($benhnhan->theBHYT->IdTheBHYT, 0, 2)." ".substr($benhnhan->theBHYT->IdTheBHYT, 2, 1)." ".substr($benhnhan->theBHYT->IdTheBHYT, 3, 2)." ".substr($benhnhan->theBHYT->IdTheBHYT, 5, 10),
                    'ngaydk'=> \comm_functions::deDateFormatForUpdate($benhnhan->theBHYT->NgayDK),
                    'ngayhh'=> \comm_functions::deDateFormatForUpdate($benhnhan->theBHYT->NgayHH),
                    'ndk'=> $benhnhan->theBHYT->coSoKhamBHYT->TenCS,
                    'doituong'=> \comm_functions::getDTK($benhnhan->theBHYT->DoiTuongBHYT),
                    'mh'=> $benhnhan->theBHYT->BHYTHoTro.'%',
                    'tuyen'=> $tuyen,
                    'chuyentu'=> $chuyentu,
                    'chuyentucode'=> \comm_functions::changeTitle($chuyentu),
                    'tuyencode'=> \comm_functions::changeTitle($tuyen),
                    'anh'=>$benhnhan->Anh,
                    'tuoi'=>$age,
                );
            }
            return response()->json($response);
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
            $pdkk= phieu_dk_kham::where('IdPhieuDKKB',$request->id)->get()->first();
            if(is_object($pdkk->benhAnNoiTru) || is_object($pdkk->benhAnNgoaiTru)){
                $response = array(
                    'msg' => 'da_lap_ba'
                );
                
                return response()->json($response); 
            }
            else{
                $pdkk->IdBN=$request->hoten;
            
                $pdkk->KhamBHYT=$request->htk;
                $pdkk->TuyenKham=$request->tuyen;
                $pdkk->GiayChuyen=$request->giaychuyen;

                if($pdkk->IdPK != $request->phong){
                    $sttdk= phieu_dk_kham::where([['IdPK', $request->phong]])->whereDate('created_at','like', '%'.date('Y-m-d').'%')->orderBy('STT','DESC')->get()->first();
                    if(is_object($sttdk)){
                        $pdkk->STT=$sttdk->STT + 1;
                    }
                    else{
                        $pdkk->STT=1;
                    }
                }
                $pdkk->IdPK = $request->phong;
                $pdkk->save();
                $response = array(
                    'msg' => 'tc'
                );

                if($request->cc == ''){
                    event(new DangKyKham($pdkk, 'sua'));
                }
                else{
                    event(new CapCuu($pdkk, 'sua'));
                }

                return response()->json($response); 
            }
        }
        catch (QueryException $ex){
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err,
            );
            return response()->json($response); 
        }
    }

    public function postThem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $bn= benh_nhan::where('IdBN', $request->hoten)->get()->first();
            $flag=FALSE;$flagba=FALSE;
            if(is_object($bn)){
                $phieu= phieu_dk_kham::where('IdBN', $bn->IdBN)->whereDate('created_at','like', '%'.date('Y-m-d').'%')->get();
                foreach ($phieu as $pdk){
                    $p= phong_ban::where('IdPB', $request->phong)->get()->first();
                    if(is_object($p)){
                        if($pdk->phongKham->Khoa->IdKhoa == $p->Khoa->IdKhoa){
                            $flag=TRUE;
                            break;
                        }
                    }
                }
                $phieudk= phieu_dk_kham::where('IdBN', $bn->IdBN)->get();
                foreach ($phieudk as $pdk){
                    $bangoai=$pdk->benhAnNgoaiTru;
                    if(is_object($bangoai)){
                        if($bangoai->benhAnNgoaiTru->TrangThaiBA == 1){
                            $flagba=TRUE;
                            break;
                        }
                    }
                    $banoi=$pdk->benhAnNoiTru;
                    if(is_object($banoi)){
                        if($banoi->benhAnNoiTru->TrangThaiBA == 1){
                            $flagba=TRUE;
                            break;
                        }
                    }
                }
            }

            if($flag == FALSE && $flagba == FALSE){
                if($request->htk == 0){
                    $the= the_bhyt::where('IdBN', $request->hoten)->get()->first();
                    if(!is_object($the)){
                        $response = array(
                            'msg' => 'thektt'
                        );
                        return response()->json($response); 
                    }
                    else{
                        $ngaykt = \DateTime::createFromFormat("d/m/Y", date('d/m/Y'));
                        $ngayhh= \DateTime::createFromFormat("d/m/Y", date('d/m/Y', strtotime($the->NgayHHDT)));
                        if($ngaykt > $ngayhh){
                            $response = array(
                                'msg' => 'thehh'
                            );
                            return response()->json($response); 
                        }
                    }
                }
                $pdkk= new phieu_dk_kham;
                $pdkk->IdPhieuDKKB= dangKyKhamController::TaoMaNN();
                $pdkk->IdNV=$idnv;
                $pdkk->IdBN=$request->hoten;
                $pdkk->IdPK= $request->phong;
                $pdkk->KhamBHYT=$request->htk;
                $pdkk->TuyenKham=$request->tuyen;
                $pdkk->GiayChuyen=$request->giaychuyen;
                $pdkk->DTTN=0;
                $pdkk->STT=1;
                $sttdk= phieu_dk_kham::where([['IdPK', $request->phong],['DTTN',0]])->whereDate('created_at','like', '%'.date('Y-m-d').'%')->orderBy('STT','DESC')->get()->first();
                if(is_object($sttdk)){
                    $pdkk->STT=$sttdk->STT+1;
                }
                if($request->cc != ''){
                    $pdkk->IdNV=$idnv;
                    $pdkk->DTTN=1;
                    $sttdk= phieu_dk_kham::where([['IdPK', $request->phong],['DTTN',1]])->whereDate('created_at','like', '%'.date('Y-m-d').'%')->orderBy('STT','DESC')->get()->first();
                    if(is_object($sttdk)){
                        $pdkk->STT=$sttdk->STT+1;

                    }
                }

                $pdkk->TrangThai= 0;

                $pdkk->save();
                $response = array(
                    'msg' => 'tc',
                    'id'=>$pdkk->IdPhieuDKKB
                );

                if($request->cc != ''){
                    event(new CapCuu($pdkk, 'them'));
                }
                else{
                    event(new DangKyKham($pdkk, 'them'));
                }

                return response()->json($response); 
            }
            else{
                if($flagba == TRUE){
                    $response = array(
                        'msg' => 'dangdt'
                    );
                    return response()->json($response); 
                }
                else{
                    $response = array(
                        'msg' => 'trung'
                    );
                    return response()->json($response); 
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
            $arr= explode(',',$request->id); $flag=FALSE; $list=[];
            try{
                foreach ($arr as $a){
                    $pdkk= phieu_dk_kham::where("IdPhieuDKKB", $a)->get()->first();
                    
                    if(!is_object($pdkk->benhAnNoiTru) && !is_object($pdkk->benhAnNgoaiTru)){
                        $list[]=$pdkk->IdPhieuDKKB;
                        $pdkk->delete();
                    }
                    else{
                        $flag=TRUE;
                    }
                }
                
                if($request->cc == ''){
                    event(new DangKyKham($list, 'xoa'));
                }
                else{
                    event(new CapCuu($list, 'xoa'));
                }
                
                $response = array(
                    'msg' => 'tc',
                    'flag'=>$flag
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
                $flag=FALSE;
                $pdkk= phieu_dk_kham::where("IdPhieuDKKB", $request->id)->get()->first();
                if(!is_object($pdkk->benhAnNoiTru) && !is_object($pdkk->benhAnNgoaiTru)){
                    $pdkk->delete();
                    
                    if($request->cc == ''){
                        event(new DangKyKham($request->id, 'xoa'));
                    }
                    else{
                        event(new CapCuu($request->id, 'xoa'));
                    }
                }
                else{
                    $flag=TRUE;
                }
                
                $response = array(
                    'msg' => 'tc',
                    'flag'=>$flag
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
    
    public function postTimKiem(Request $request){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $sql="";
        $key=$request->keyWords;
        if($request->ls != ''){
            $sql="SELECT pdk.*, bn.`HoTen`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa`
WHERE pdk.`IdNV` = N'".$idnv."' AND(
(pdk.`IdPhieuDKKB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (pdk.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (k.`TenKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (k.`IdKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (pb.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (pb.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'Khám bảo hiểm y tế BHYT KBHYT' ELSE N'Khám thu phí KTP' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN pdk.`TuyenKham` = 0 THEN N'Đúng tuyến DT' WHEN pdk.`TuyenKham` = 1 THEN N'Vượt tuyến vượt tuyến(huyện) vượt tuyến (huyện) vượt tuyến (h) vượt tuyến(h) vth vt(h) vt (h) tuyến huyện' ELSE N'Vượt tuyến vượt tuyến(xã) vượt tuyến (xã) vượt tuyến (x) vượt tuyến(x) vtx vt(x) vt (x) tuyến xã' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN pdk.`GiayChuyen` = 0 THEN N'Không có giấy chuyển viện kcgcv kgcv kc giấy chuyền viện kc gcv kocgcv koco gcv kocogcv kcogcv' ELSE N'Có giấy chuyển viện cgcv cogcv cgcv co gcv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (DATE_FORMAT(pdk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)
) ORDER BY pdk.created_at DESC";
        }
        else{//lich su
            $sql="SELECT pdk.*, bn.`HoTen`,  k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa`
WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`created_at` like N'%".date('Y-m-d')."%'  AND (
(pdk.`IdPhieuDKKB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (pdk.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (k.`TenKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (k.`IdKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (pb.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (pb.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'Khám bảo hiểm y tế BHYT KBHYT' ELSE N'Khám thu phí KTP' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN pdk.`TuyenKham` = 0 THEN N'Đúng tuyến DT' WHEN pdk.`TuyenKham` = 1 THEN N'Vượt tuyến vượt tuyến(huyện) vượt tuyến (huyện) vượt tuyến (h) vượt tuyến(h) vth vt(h) vt (h) tuyến huyện' ELSE N'Vượt tuyến vượt tuyến(xã) vượt tuyến (xã) vượt tuyến (x) vượt tuyến(x) vtx vt(x) vt (x) tuyến xã' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN pdk.`GiayChuyen` = 0 THEN N'Không có giấy chuyển viện kcgcv kgcv kc giấy chuyền viện kc gcv kocgcv koco gcv kocogcv kcogcv' ELSE N'Có giấy chuyển viện cgcv cogcv cgcv co gcv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY pdk.created_at DESC";
            if($request->cc !=''){
                $sql="SELECT pdk.*, bn.`HoTen`, bn.`NgaySinh`, bn.`GioiTinh`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa`
WHERE pdk.`IdNV` = N'".$idnv."'  AND pdk.`created_at` like N'%".date('Y-m-d')."%' AND (
(pdk.`IdPhieuDKKB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (pdk.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci)
OR (pb.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (pb.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'Khám bảo hiểm y tế BHYT KBHYT' ELSE N'Khám thu phí KTP' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN pdk.`TuyenKham` = 0 THEN N'Đúng tuyến DT' WHEN pdk.`TuyenKham` = 1 THEN N'Vượt tuyến vượt tuyến(huyện) vượt tuyến (huyện) vượt tuyến (h) vượt tuyến(h) vth vt(h) vt (h) tuyến huyện' ELSE N'Vượt tuyến vượt tuyến(xã) vượt tuyến (xã) vượt tuyến (x) vượt tuyến(x) vtx vt(x) vt (x) tuyến xã' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN pdk.`GiayChuyen` = 0 THEN N'Không có giấy chuyển viện kcgcv kgcv kc giấy chuyền viện kc gcv kocgcv koco gcv kocogcv kcogcv' ELSE N'Có giấy chuyển viện cgcv cogcv cgcv co gcv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY pdk.created_at DESC";
            }
            
        }
        try{
            $ds_pdkk= DB::select($sql);
            $dspk = array();
            $sl=0;
            if(!empty($ds_pdkk)){
                foreach ($ds_pdkk as $pdkk){
                    $ngaydk= \comm_functions::deDateFormat($pdkk->created_at);
                    $gt='Nam';$ngaysinh='';
                    if($request->cc != ''){
                        if($pdkk->GioiTinh == 0){
                            $gt='Nữ';
                        }
                        $ngaysinh=date( "d/m/Y", strtotime($pdkk->NgaySinh));
                    }

                    $htk="BHYT";
                    if($pdkk->KhamBHYT == 1){
                        $htk="Thu phí";
                    }
                    $khoa=$pdkk->TenKhoa;
                    $phong=$pdkk->SoPhong.' - '.$pdkk->TenPhong;
                    $tuyen='Đúng tuyến';
                    $giaychuyen='Không có giấy chuyển';
                    if($pdkk->TuyenKham == 1){
                        $tuyen='Vượt tuyến (huyện)';
                    }
                    else if($pdkk->TuyenKham == 2){
                        $tuyen='Vượt tuyến (xã)';
                    }
                    if($pdkk->GiayChuyen == 1){
                        $giaychuyen='Có giấy chuyển';
                    }

                    $ttpk= array(
                        'hoten' => $pdkk->HoTen,
                        'khoa' => $khoa,
                        'phong' => $phong,
                        'htk' => $htk,
                        'tuyen' => $tuyen,
                        'giaychuyen'=>$giaychuyen,
                        'ngaydk' => $ngaydk,
                        'id' => $pdkk->IdPhieuDKKB,
                        'idbn' => $pdkk->IdBN,
                        'gt'=>$gt,
                        'ngaysinh'=>$ngaysinh
                    );
                    $dspk[]=$ttpk;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dkkham'=>$dspk,
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
    
    public function postLayDSPDK(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            $ds_pdkk="";
            if($request->ls == ''){
                $ds_pdkk= phieu_dk_kham::where([['IdNV', $idnv],['DTTN',0]])->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('created_at', 'DESC')->orderBy('created_at', 'DESC')->get();
                if($request->cc != ''){
                    $ds_pdkk= phieu_dk_kham::where([['IdNV', $idnv],['DTTN',1]])->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('created_at', 'DESC')->orderBy('created_at', 'DESC')->get();
                }
            }
            else{
                $ds_pdkk= phieu_dk_kham::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            }
            
            $dspk = array();
            $sl=0;
            if(!empty($ds_pdkk)){
                foreach ($ds_pdkk as $pdkk){
                    $ngaydk= \comm_functions::deDateFormat($pdkk->created_at);
                    $gt='Nam';
                    if($pdkk->benhNhan->GioiTinh == 0){
                        $gt='Nữ';
                    }
                    $ngaysinh=date( "d/m/Y", strtotime($pdkk->benhNhan->NgaySinh));
                    $htk="BHYT";
                    if($pdkk->KhamBHYT == 1){
                        $htk="Thu phí";
                    }
                    $khoa=$pdkk->phongKham->Khoa->TenKhoa;
                    $phong=$pdkk->phongKham->SoPhong.' - '.$pdkk->phongKham->TenPhong;
                    $tuyen='Đúng tuyến';
                    $giaychuyen='Không có giấy chuyển';
                    if($pdkk->TuyenKham == 1){
                        $tuyen='Vượt tuyến (huyện)';
                    }
                    else if($pdkk->TuyenKham == 2){
                        $tuyen='Vượt tuyến (xã)';
                    }
                    if($pdkk->GiayChuyen == 1){
                        $giaychuyen='Có giấy chuyển';
                    }

                    $ttpk= array(
                        'hoten' => $pdkk->benhNhan->HoTen,
                        'khoa' => $khoa,
                        'phong' => $phong,
                        'htk' => $htk,
                        'tuyen' => $tuyen,
                        'giaychuyen'=>$giaychuyen,
                        'ngaydk' => $ngaydk,
                        'id' => $pdkk->IdPhieuDKKB,
                        'idbn' => $pdkk->IdBN,
                        'ngaysinh' =>$ngaysinh,
                        'gt'=>$gt
                    );
                    $dspk[]=$ttpk;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dkkham'=>$dspk,
                'sl' => $sl
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
    
    public function postLocDS(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            $sql="";
            if($request->ls == ''){
                if($request->cc == ''){//ko cap cuu
                    if($request->keySearch == ''){
                        $sql="SELECT pdk.*, bn.`HoTen`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`created_at` like N'%".date('Y-m-d')."%' AND k.`IdKhoa` = N'".$request->khoa."' ORDER BY pdk.created_at DESC";
                        if($request->khoa == 'all'){
                            $sql="SELECT pdk.*, bn.`HoTen`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa`  WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`created_at` like N'%".date('Y-m-d')."%' ORDER BY pdk.created_at DESC";
                        }
                    }
                    else{
                        $key=$request->keySearch;
                        $sql="SELECT a.* FROM( SELECT pdk.*, bn.`HoTen`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa`
            WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`created_at` like N'%".date('Y-m-d')."%' AND (
            (pdk.`IdPhieuDKKB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pdk.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (k.`TenKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (k.`IdKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pb.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pb.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'Khám bảo hiểm y tế BHYT KBHYT' ELSE N'Khám thu phí KTP' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`TuyenKham` = 0 THEN N'Đúng tuyến DT' WHEN pdk.`TuyenKham` = 1 THEN N'Vượt tuyến vượt tuyến(huyện) vượt tuyến (huyện) vượt tuyến (h) vượt tuyến(h) vth vt(h) vt (h) tuyến huyện' ELSE N'Vượt tuyến vượt tuyến(xã) vượt tuyến (xã) vượt tuyến (x) vượt tuyến(x) vtx vt(x) vt (x) tuyến xã' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`GiayChuyen` = 0 THEN N'Không có giấy chuyển viện kcgcv kgcv kc giấy chuyền viện kc gcv kocgcv koco gcv kocogcv kcogcv' ELSE N'Có giấy chuyển viện cgcv cogcv cgcv co gcv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (DATE_FORMAT(pdk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci))) AS a WHERE a.`IdKhoa` = N'".$request->khoa."' ORDER BY a.created_at DESC";

                        if($request->khoa =='all'){
                            $sql="SELECT pdk.*, bn.`HoTen`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa`
            WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`created_at` like N'%".date('Y-m-d')."%' AND (
            (pdk.`IdPhieuDKKB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pdk.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (k.`TenKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (k.`IdKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pb.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pb.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'Khám bảo hiểm y tế BHYT KBHYT' ELSE N'Khám thu phí KTP' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`TuyenKham` = 0 THEN N'Đúng tuyến DT' WHEN pdk.`TuyenKham` = 1 THEN N'Vượt tuyến vượt tuyến(huyện) vượt tuyến (huyện) vượt tuyến (h) vượt tuyến(h) vth vt(h) vt (h) tuyến huyện' ELSE N'Vượt tuyến vượt tuyến(xã) vượt tuyến (xã) vượt tuyến (x) vượt tuyến(x) vtx vt(x) vt (x) tuyến xã' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`GiayChuyen` = 0 THEN N'Không có giấy chuyển viện kcgcv kgcv kc giấy chuyền viện kc gcv kocgcv koco gcv kocogcv kcogcv' ELSE N'Có giấy chuyển viện cgcv cogcv cgcv co gcv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (DATE_FORMAT(pdk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY pdk.created_at DESC";
                        }
                    }
                }
                else{
                    if($request->keySearch == ''){
                        $sql="SELECT pdk.*, bn.`HoTen`, bn.`NgaySinh`, bn.`GioiTinh`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`created_at` like N'%".date('Y-m-d')."%' ORDER BY pdk.created_at DESC";
                        if($request->dtk != 'all')
                        {
                            $sql="SELECT pdk.*, bn.`HoTen`, bn.`NgaySinh`, bn.`GioiTinh`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`created_at` like N'%".date('Y-m-d')."%' AND pdk.`KhamBHYT` = ".$request->dtk." ORDER BY pdk.created_at DESC";
                        }
                    }
                    else{
                        $key=$request->keySearch;
                        $sql="SELECT a.* FROM( SELECT pdk.*, bn.`HoTen`, bn.`NgaySinh`, bn.`GioiTinh`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB`
            WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`created_at` like N'%".date('Y-m-d')."%' AND (
            (pdk.`IdPhieuDKKB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pdk.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci)
            OR (pb.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pb.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'Khám bảo hiểm y tế BHYT KBHYT' ELSE N'Khám thu phí KTP' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`TuyenKham` = 0 THEN N'Đúng tuyến DT' WHEN pdk.`TuyenKham` = 1 THEN N'Vượt tuyến vượt tuyến(huyện) vượt tuyến (huyện) vượt tuyến (h) vượt tuyến(h) vth vt(h) vt (h) tuyến huyện' ELSE N'Vượt tuyến vượt tuyến(xã) vượt tuyến (xã) vượt tuyến (x) vượt tuyến(x) vtx vt(x) vt (x) tuyến xã' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`GiayChuyen` = 0 THEN N'Không có giấy chuyển viện kcgcv kgcv kc giấy chuyền viện kc gcv kocgcv koco gcv kocogcv kcogcv' ELSE N'Có giấy chuyển viện cgcv cogcv cgcv co gcv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (DATE_FORMAT(pdk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci))) AS a WHERE a.`KhamBHYT` = ".$request->dtk." ORDER BY a.created_at DESC";

                        if($request->dtk =='all'){
                            $sql="SELECT pdk.*, bn.`HoTen`, bn.`NgaySinh`, bn.`GioiTinh`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB`
            WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`created_at` like N'%".date('Y-m-d')."%' AND (
            (pdk.`IdPhieuDKKB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pdk.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pb.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (pb.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'Khám bảo hiểm y tế BHYT KBHYT' ELSE N'Khám thu phí KTP' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`TuyenKham` = 0 THEN N'Đúng tuyến DT' WHEN pdk.`TuyenKham` = 1 THEN N'Vượt tuyến vượt tuyến(huyện) vượt tuyến (huyện) vượt tuyến (h) vượt tuyến(h) vth vt(h) vt (h) tuyến huyện' ELSE N'Vượt tuyến vượt tuyến(xã) vượt tuyến (xã) vượt tuyến (x) vượt tuyến(x) vtx vt(x) vt (x) tuyến xã' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (CASE WHEN pdk.`GiayChuyen` = 0 THEN N'Không có giấy chuyển viện kcgcv kgcv kc giấy chuyền viện kc gcv kocgcv koco gcv kocogcv kcogcv' ELSE N'Có giấy chuyển viện cgcv cogcv cgcv co gcv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
            OR (DATE_FORMAT(pdk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY pdk.created_at DESC";
                        }
                    }
                }

            }
            else{//lich su
                if($request->keySearch == ''){
                    $arr=array();
                    if($request->khoa == 'all'){
                        $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->dtk == 'all'){
                        $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->gt == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->tgt == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->tinh == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->huyen == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->xa == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgbd);
                    $ngaykt= \DateTime::createFromFormat("d/m/Y", $request->tgkt);
                    $sql_pr="SELECT pdk.*, bn.`HoTen`,bn.`GioiTinh`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong`, px.`IdXa`, qh.`IdHuyen`, tp.`IdTinh` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` ";
                    switch($arr){
                        
                        //#explode_1
                        case ['all', 'notall', 'notall', 'notall', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'all', 'notall', 'notall', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'notall', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'all', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'notall', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        
                        //#explode_2
                        //l-r
                        case ['all', 'notall', 'notall', 'notall', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        case ['all', 'notall', 'notall', 'all', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        case ['all', 'notall', 'all', 'notall', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        case ['all', 'all', 'notall', 'notall', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        
                        //r-l
                        case ['notall', 'all', 'notall', 'notall', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'notall', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'all', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'notall', 'notall', 'all', 'all']:$sql="SELECT pdk.*, bn.`HoTen`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." ))' AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        
                        //l-r-1
                        case ['notall', 'all', 'notall', 'all', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'all', 'all', 'notall', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        
                        //l-r-2
                        case ['notall', 'notall', 'all', 'all', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        
                        //explode_3
                        //#1
                        case ['all', 'notall', 'notall', 'notall', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        case ['all', 'notall', 'all', 'all', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        case ['all', 'all', 'all', 'notall', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        
                        case ['notall', 'all', 'notall', 'notall', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'notall', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'all', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'notall', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY pdk.created_at DESC";break;
                        
                        //#2
                        case ['all', 'all', 'notall', 'notall', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        case ['all', 'all', 'notall', 'all', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` = '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        
                        case ['notall', 'all', 'all', 'notall', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'all', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        
                        //#3
                        case ['notall', 'all', 'all', 'all', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        
                        //#4
                        case ['all', 'notall', 'all', 'notall', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        case ['all', 'notall', 'notall', 'all', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'all', 'notall', 'all', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        
                        //explode_4
                        //#1
                        case ['all', 'notall', 'notall', 'notall', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY pdk.created_at DESC";break;  
                        case ['all', 'all', 'all', 'all', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
    
                        case ['notall', 'all', 'notall', 'notall', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'notall', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'all', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." ORDER BY pdk.created_at DESC";break;
                        
                        //#2
                        case ['all', 'all', 'notall', 'notall', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        
                        case ['notall', 'all', 'all', 'notall', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'all', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        
                        //#3
                        case ['all', 'all', 'all', 'notall', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` = '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        
                        case ['notall', 'all', 'all', 'all', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        
                        //#4
                        case ['notall', 'all', 'all', 'all', 'all', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        
                        //#5
                        case ['all', 'all', 'notall', 'all', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."'ORDER BY pdk.created_at DESC";break;
                        case ['all', 'notall', 'all', 'all', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
    
                        //explode_5
                        //#1
                        case ['all', 'notall', 'notall', 'all', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." ORDER BY pdk.created_at DESC";break;
                        case ['all', 'all', 'all', 'all', 'all', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        
                        case ['notall', 'all', 'notall', 'all', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND bn.`GioiTinh` = ".$request->gt." ORDER BY pdk.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'all', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." ORDER BY pdk.created_at DESC";break;
                        
                         //#2
                        case ['all', 'all', 'notall', 'notall', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY pdk.created_at DESC";break;
                        
                        case ['notall', 'all', 'all', 'notall', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY pdk.created_at DESC";break;
                        
                        //#3
                        case ['all', 'all', 'all', 'notall', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        
                        case ['notall', 'all', 'all', 'all', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND tp.`IdTinh` =  '".$request->tinh."'ORDER BY pdk.created_at DESC";break;
                        
                        //#4
                        case ['all', 'all', 'all', 'all', 'notall', 'notall', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' ORDER BY pdk.created_at DESC";break;
                        
                        //#5
                        case ['all', 'all', 'notall', 'all', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND bn.`GioiTinh` = ".$request->gt." AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        
                        case ['all', 'notall', 'all', 'all', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        
                        case ['all', 'notall', 'all', 'notall', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY pdk.created_at DESC";break;
                        
                        //explode_6
                        case ['notall', 'all', 'all', 'all', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' ORDER BY pdk.created_at DESC";break;
                        
                        case ['all', 'notall', 'all', 'all', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND pdk.`KhamBHYT` = ".$request->dtk." ORDER BY pdk.created_at DESC";break;
                        
                        case ['all', 'all', 'notall', 'all', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND bn.`GioiTinh` = ".$request->gt." ORDER BY pdk.created_at DESC";break;
                        
                        case ['all', 'all', 'all', 'notall', 'all', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY pdk.created_at DESC";break;
                        
                        case ['all', 'all', 'all', 'all', 'notall', 'all', 'all']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND tp.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;
                        //all
                        case ['notall', 'notall', 'notall', 'notall', 'notall', 'notall', 'notall']:$sql=$sql_pr." WHERE pdk.`IdNV` = N'".$idnv."' AND k.`IdKhoa` = N'".$request->khoa."' AND pdk.`KhamBHYT` = ".$request->dtk." AND bn.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(pdk.created_at) <= ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y')." )) AND tp.`IdTinh` =  '".$request->tinh."' AND qh.`IdHuyen` = '".$request->huyen."' AND px.`IdXa` = '".$request->xa."' ORDER BY pdk.created_at DESC";break;
                        
                        //#explode_7
                        default:
                            $sql="SELECT pdk.*, bn.`HoTen`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` WHERE pdk.`IdNV` = N'".$idnv."' ORDER BY pdk.created_at DESC";break;
                    }
                    
                }
                else{
                    $key=$request->keySearch;
                    $arr=array();
                    if($request->khoa == 'all'){
                        $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->dtk == 'all'){
                        $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->gt == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->tgt == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->tinh == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->huyen == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    if($request->xa == 'all'){
                       $arr[]='all';
                    }
                    else{
                        $arr[]='notall';
                    }
                    $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgbd);
                    $ngaykt= \DateTime::createFromFormat("d/m/Y", $request->tgkt);
                    $sqlsearch="SELECT a.* FROM( SELECT pdk.*, bn.`HoTen`, bn.`GioiTinh`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong`, px.`IdXa`, qh.`IdHuyen`, tp.`IdTinh` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` WHERE pdk.`IdNV` = N'".$idnv."' AND (
        (pdk.`IdPhieuDKKB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (pdk.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (k.`TenKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (k.`IdKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (pb.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (pb.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'Khám bảo hiểm y tế BHYT KBHYT' ELSE N'Khám thu phí KTP' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (CASE WHEN pdk.`TuyenKham` = 0 THEN N'Đúng tuyến DT' WHEN pdk.`TuyenKham` = 1 THEN N'Vượt tuyến vượt tuyến(huyện) vượt tuyến (huyện) vượt tuyến (h) vượt tuyến(h) vth vt(h) vt (h) tuyến huyện' ELSE N'Vượt tuyến vượt tuyến(xã) vượt tuyến (xã) vượt tuyến (x) vượt tuyến(x) vtx vt(x) vt (x) tuyến xã' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (CASE WHEN pdk.`GiayChuyen` = 0 THEN N'Không có giấy chuyển viện kcgcv kgcv kc giấy chuyền viện kc gcv kocgcv koco gcv kocogcv kcogcv' ELSE N'Có giấy chuyển viện cgcv cogcv cgcv co gcv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (DATE_FORMAT(pdk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci))) AS a ";
                    switch($arr){
                        //#explode_1
                        case ['all', 'notall', 'notall', 'notall', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'all', 'notall', 'notall', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'notall', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'all', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'notall', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;

                        //#explode_2
                        //l-r
                        case ['all', 'notall', 'notall', 'notall', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;
                        case ['all', 'notall', 'notall', 'all', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;
                        case ['all', 'notall', 'all', 'notall', 'notall', 'notall', 'notall']:$sql=" WHERE a.`KhamBHYT` = ".$request->dtk." AND DATE_FORMAT(a.`created_at`, '%d/%m/%Y') BETWEEN '".$request->tgbd."' AND '".$request->tgkt."' AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;
                        case ['all', 'all', 'notall', 'notall', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;

                        //r-l
                        case ['notall', 'all', 'notall', 'notall', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'notall', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'all', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'notall', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;

                        //l-r-1
                        case ['notall', 'all', 'notall', 'all', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'all', 'all', 'notall', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;

                        //l-r-2
                        case ['notall', 'notall', 'all', 'all', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;

                        //explode_3
                        //#1
                        case ['all', 'notall', 'notall', 'notall', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;
                        case ['all', 'notall', 'all', 'all', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;
                        case ['all', 'all', 'all', 'notall', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;

                        case ['notall', 'all', 'notall', 'notall', 'notall', 'all', 'all']:$sql=$sqlsearch." a WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'notall', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'all', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'notall', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY a.created_at DESC";break;

                        //#2
                        case ['all', 'all', 'notall', 'notall', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;
                        case ['all', 'all', 'notall', 'all', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` = '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;

                        case ['notall', 'all', 'all', 'notall', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'all', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;

                        //#3
                        case ['notall', 'all', 'all', 'all', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;

                        //#4
                        case ['all', 'notall', 'all', 'notall', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;
                        case ['all', 'notall', 'notall', 'all', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'all', 'notall', 'all', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;

                        //explode_4
                        //#1
                        case ['all', 'notall', 'notall', 'notall', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY a.created_at DESC";break;  
                        case ['all', 'all', 'all', 'all', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;

                        case ['notall', 'all', 'notall', 'notall', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'notall', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'notall', 'all', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." ORDER BY a.created_at DESC";break;

                        //#2
                        case ['all', 'all', 'notall', 'notall', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;

                        case ['notall', 'all', 'all', 'notall', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'all', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;

                        //#3
                        case ['all', 'all', 'all', 'notall', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` = '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;

                        case ['notall', 'all', 'all', 'all', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;

                        //#5
                        case ['all', 'all', 'notall', 'all', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."'ORDER BY a.created_at DESC";break;

                        case ['all', 'notall', 'all', 'all', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;

                        //explode_5
                        //#1
                        case ['all', 'notall', 'notall', 'all', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." ORDER BY a.created_at DESC";break;
                        case ['all', 'all', 'all', 'all', 'all', 'notall', 'notall']:$sql=$sqlsearch." WHERE a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;

                        case ['notall', 'all', 'notall', 'all', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`GioiTinh` = ".$request->gt." ORDER BY a.created_at DESC";break;
                        case ['notall', 'notall', 'all', 'all', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." ORDER BY a.created_at DESC";break;

                         //#2
                        case ['all', 'all', 'notall', 'notall', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY a.created_at DESC";break;

                        case ['notall', 'all', 'all', 'notall', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY a.created_at DESC";break;

                        //#3
                        case ['all', 'all', 'all', 'notall', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE  ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;

                        case ['notall', 'all', 'all', 'all', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE  a.`IdKhoa` = N'".$request->khoa."' AND a.`IdTinh` =  '".$request->tinh."'ORDER BY a.created_at DESC";break;

                        //#4
                        case ['all', 'all', 'all', 'all', 'notall', 'notall', 'all']:$sql=$sqlsearch." WHERE  a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' ORDER BY a.created_at DESC";break;

                        //#5
                        case ['all', 'all', 'notall', 'all', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE  a.`GioiTinh` = ".$request->gt." AND a.`IdTinh` = '".$request->tinh."' ORDER BY a.created_at DESC";break;

                        case ['all', 'notall', 'all', 'all', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." AND a.`IdTinh` =  '".$request->tinh."' ORDER BY pdk.created_at DESC";break;

                        case ['all', 'notall', 'all', 'notall', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE  a.`KhamBHYT` = ".$request->dtk." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY a.created_at DESC";break;

                        //explode_6
                        case ['notall', 'all', 'all', 'all', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdKhoa` = N'".$request->khoa."' ORDER BY a.created_at DESC";break;
                        
                        case ['all', 'notall', 'all', 'all', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`KhamBHYT` = ".$request->dtk." ORDER BY a.created_at DESC";break;
                        
                        case ['all', 'all', 'notall', 'all', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE a.`GioiTinh` = ".$request->gt." ORDER BY a.created_at DESC";break;
                        
                        case ['all', 'all', 'all', 'notall', 'all', 'all', 'all']:$sql=$sqlsearch." WHERE ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) ORDER BY a.created_at DESC";break;
                        
                        case ['all', 'all', 'all', 'all', 'notall', 'all', 'all']:$sql=$sqlsearch." WHERE a.`IdTinh` =  '".$request->tinh."' ORDER BY a.created_at DESC";break;
                        
                        //all
                        case ['notall', 'notall', 'notall', 'notall', 'notall', 'notall', 'notall']:$sql=$sqlsearch." WHERE  a.`IdKhoa` = N'".$request->khoa."' AND a.`KhamBHYT` = ".$request->dtk." AND a.`GioiTinh` = ".$request->gt." AND ((DAYOFMONTH(a.created_at) >= ".$ngaybd->format('d')." AND MONTH(a.created_at) >= ".$ngaybd->format('m')." AND YEAR(a.created_at) >= ".$ngaybd->format('Y').") AND (DAYOFMONTH(a.created_at) <= ".$ngaykt->format('d')." AND MONTH(a.created_at) <= ".$ngaykt->format('m')." AND YEAR(a.created_at)<= ".$ngaykt->format('Y')." )) AND a.`IdTinh` =  '".$request->tinh."' AND a.`IdHuyen` = '".$request->huyen."' AND a.`IdXa` = '".$request->xa."' ORDER BY a.created_at DESC";break;

                        //#explode_7
                        default:
                            $sql="SELECT pdk.*, bn.`HoTen`, k.`IdKhoa`, k.`TenKhoa`, pb.`IdPB`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham pdk JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` WHERE pdk.`IdNV` = N'1' AND (
        (pdk.`IdPhieuDKKB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (pdk.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (k.`TenKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (k.`IdKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (pb.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (pb.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'Khám bảo hiểm y tế BHYT KBHYT' ELSE N'Khám thu phí KTP' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (CASE WHEN pdk.`TuyenKham` = 0 THEN N'Đúng tuyến DT' WHEN pdk.`TuyenKham` = 1 THEN N'Vượt tuyến vượt tuyến(huyện) vượt tuyến (huyện) vượt tuyến (h) vượt tuyến(h) vth vt(h) vt (h) tuyến huyện' ELSE N'Vượt tuyến vượt tuyến(xã) vượt tuyến (xã) vượt tuyến (x) vượt tuyến(x) vtx vt(x) vt (x) tuyến xã' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (CASE WHEN pdk.`GiayChuyen` = 0 THEN N'Không có giấy chuyển viện kcgcv kgcv kc giấy chuyền viện kc gcv kocgcv koco gcv kocogcv kcogcv' ELSE N'Có giấy chuyển viện cgcv cogcv cgcv co gcv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
        OR (DATE_FORMAT(pdk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY pdk.created_at DESC";break;
                    }
                }
            }
            $ds_pdkk= DB::select($sql);
            $dspdkk = array();
            $sl=0;
            if(!empty($ds_pdkk)){
                foreach ($ds_pdkk as $pdkk){
                    $ngaydk= \comm_functions::deDateFormat($pdkk->created_at);
                    $gt='Nam';$ngaysinh='';$khoa='';
                    if($request->cc != ''){
                        if($pdkk->GioiTinh == 0){
                            $gt='Nữ';
                        }
                        $ngaysinh=date( "d/m/Y", strtotime($pdkk->NgaySinh));
                    }
                    else{
                        $khoa=$pdkk->TenKhoa;
                    }

                    $htk="BHYT";
                    if($pdkk->KhamBHYT == 1){
                        $htk="Thu phí";
                    }

                    $phong=$pdkk->SoPhong.' - '.$pdkk->TenPhong;
                    $tuyen='Đúng tuyến';
                    $giaychuyen='Không có giấy chuyển';
                    if($pdkk->TuyenKham == 1){
                        $tuyen='Vượt tuyến (huyện)';
                    }
                    else if($pdkk->TuyenKham == 2){
                        $tuyen='Vượt tuyến (xã)';
                    }
                    if($pdkk->GiayChuyen == 1){
                        $giaychuyen='Có giấy chuyển';
                    }

                    $ttpk= array(
                        'hoten' => $pdkk->HoTen,
                        'khoa' => $khoa,
                        'phong' => $phong,
                        'htk' => $htk,
                        'tuyen' => $tuyen,
                        'giaychuyen'=>$giaychuyen,
                        'ngaydk' => $ngaydk,
                        'id' => $pdkk->IdPhieuDKKB,
                        'idbn' => $pdkk->IdBN,
                        'ngaysinh' =>$ngaysinh,
                        'gt'=>$gt
                    );
                    $dspdkk[]=$ttpk;
                    $sl++;
                }
            }

            $response = array(
                'msg' => 'tc',
                'dkkham'=>$dspdkk,
                'sl' => $sl,
                
            );

            return response()->json($response); 
        }
        catch (\Exception $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
    
    public static function postIn(Request $request){
        try{
        $pdk= phieu_dk_kham::where('IdPhieuDKKB',$request->id)->get()->first();
        $pk=mb_convert_case('p.'.$pdk->phongKham->TenPhong.' ( '.$pdk->phongKham->SoPhong.' - '.'lầu '.$pdk->phongKham->Tang.' )', MB_CASE_UPPER, 'utf-8');
        if($pdk->phongKham->Tang == 0){
            $pk=mb_convert_case('p.'.$pdk->phongKham->TenPhong.' ( '.$pdk->phongKham->SoPhong.' - trệt )', MB_CASE_UPPER, 'utf-8');
        }
        $bar_code= \Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($pdk->IdBN, "C128", 1.3, 25);
        $stt=$pdk->STT;
        if($pdk->STT < 10){
            $stt="0".$pdk->STT;
        }
        $response=array(
            'msg'=>'tc',
            'pk'=> $pk,
            'bar_code'=>$bar_code,
            'sophong'=>$pdk->phongKham->SoPhong,
            'sttkham'=>$stt,
            'hoten'=>mb_convert_case($pdk->benhNhan->HoTen, MB_CASE_UPPER,'utf-8'),
            'mabn'=>$pdk->IdBN,
            'ngaydk'=>date( "d/m/Y", strtotime($pdk->created_at)),
            'nvlap'=>$pdk->nhanVien->TenNV
        );
        
        return response()->json($response);
        }catch(\Exception $e){
            $err=$e->getMessage();
            $response=array(
                'msg'=> $err
            );
            return response()->json($response); 
        }
    }

    public static function TaoMaNN(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= phieu_dk_kham::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $pdk) {
                   if($pdk->IdPhieuDKKB == $ran){
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
