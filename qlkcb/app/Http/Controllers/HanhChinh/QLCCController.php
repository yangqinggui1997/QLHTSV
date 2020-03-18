<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\thong_ke;
use App\Models\HanhChinh\cham_cong_nv;
use App\Events\HanhChinh\QLCC;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class QLCCController extends Controller
{
    //
    
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $flag=FALSE;$sl=[];
        foreach ($user->capQuyen as $value) {
            if($value->Quyen == 'khth'){
                $flag=TRUE;
                break;
            }
        }
        if($flag == FALSE){
            $dsbc= thong_ke::where([['PhanLoai','thong_ke'], ['IdNV', '<>', $idnv]])->get();
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
        }
        else{
            $dsbc= thong_ke::where('IdNV', '<>', $idnv)->get();
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
        }

        $dscc=cham_cong_nv::where('TrangThai', 0)->orderBy('SoNgayCong', 'DESC')->get();

        $dslscc=cham_cong_nv::where('TrangThai', 1)->orderBy('updated_at', 'DESC')->orderBy('SoNgayCong', 'DESC')->get();

        return view("hanh_chinh.quan_ly_cham_cong",["dscc"=>$dscc, "dslscc"=>$dslscc, 'dsbc'=>$sl]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            $cc= cham_cong_nv::where('IdCC',$request->id)->get()->first();
            if(!is_object($cc)){
                $response=array(
                    'msg'=>'ktt'
                );

                return response()->json($response);
            }
            $chucvu='';
            foreach ($cc->nhanVien->chucVu as $value) {
                $chucvu.='<option value="'.$value->chucVu->IdCV.'">'.$value->chucVu->TenCV.' - HSPCCV: '.$value->chucVu->HSPCCV.'</option>';
            }
            $gt='Nam';
            if($cc->nhanVien->GioiTinh == 0){
                $gt='Nữ';
            }
            $loainv='Biên chế';
            if($cc->nhanVien->LoaiNV == 0){
                $loainv='Hợp đồng';
            }
            $tl=0;
            if($request->xemct != ''){
                $lcb=\comm_functions::getLCB(\comm_functions::getHSL($cc->nhanVien->CV, $cc->nhanVien->BL));
                $hspc=0;
                foreach($cc->nhanVien->chucVu as $cv){
                    $hspc+=$cv->chucVu->HSPCCV;
                }
                $lpc=\comm_functions::getLPC($hspc);
                $luongngay=($lcb+$lpc)/26;
                $tl=($luongngay*$cc->SoNgayCong)+$cc->Thuong-$cc->TienPhat;
            }

            $flag=TRUE;
            if(date('d/m/Y', strtotime($cc->updated_at)) == date('d/m/Y') && $cc->TTCN == 1){
                $flag=FALSE;
            }
            else{
                $cc->TTCN = 0;
                $cc->save();
            }
            
            $response=array(
                'hoten' => $cc->nhanVien->TenNV,
                'hdtn' => date('d/m/Y', strtotime($cc->nhanVien->HopDongTuNgay)),
                'hddn' => date('d/m/Y', strtotime($cc->nhanVien->HopDongDenNgay)),
                'gt' => $gt,
                'chuyenmon' => $cc->nhanVien->ChuyenMon,
                'cv' => $chucvu,
                'congviec'=>\comm_functions::decodeCongViec($cc->nhanVien->CV),
                'hsl'=>\comm_functions::getHSL($cc->nhanVien->CV, $cc->nhanVien->BL),
                'lcb'=>number_format(\comm_functions::getLCB(\comm_functions::getHSL($cc->nhanVien->CV, $cc->nhanVien->BL))),
                'snc'=>$cc->SoNgayCong,
                'tt'=>$cc->Thuong,
                'tp'=>$cc->TienPhat,
                'loainv'=>$loainv,
                'tl'=>number_format($tl),
                'flag'=>$flag,
                'msg'=>'tc'
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
    
    public function postKTSNC(Request $request){
        try{
            $cc= cham_cong_nv::where('IdCC',$request->id)->get()->first();
            if(!is_object($cc)){
                $response=array(
                    'msg'=>'ktt'
                );

                return response()->json($response);
            }
            $flag=TRUE;
            if($cc->SoNgayCong < 26){
                $flag=FALSE;
            }

            $response=array(
                'flag'=>$flag,
                'msg'=>'tc'
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

    public function postTinhLuong(Request $request){
        try{
            $ccc= cham_cong_nv::where('IdCC', $request->id)->get()->first();
            $ccc->TrangThai=1;
            $ccc->save();

            $cc= new cham_cong_nv;
            $cc->IdCC=QLCCController::TaoMaNNCC();
            $cc->IdNV=$ccc->nhanVien->IdNV;
            $cc->TrangThai=0;
            $cc->SoNgayCong=1;
            $cc->Thuong=0;
            $cc->TienPhat=0;
            $cc->TTCN=1;
            $cc->save();

            $lcb=\comm_functions::getLCB(\comm_functions::getHSL($ccc->nhanVien->CV, $ccc->nhanVien->BL));
            $hspc=0;
            foreach($ccc->nhanVien->chucVu as $cv){
                $hspc+=$cv->chucVu->HSPCCV;
            }
            $lpc=\comm_functions::getLPC($hspc);
            $luongngay=($lcb+$lpc)/26;
            $tl=($luongngay*$ccc->SoNgayCong)+$ccc->Thuong-$ccc->TienPhat;

            event(new QLCC($cc, 'tl', $ccc));

            $response = array(
                'msg' => 'tc',
                'tl'=>number_format($tl)
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

    public function postSua(Request $request){

        try{
            $cc= cham_cong_nv::where('IdCC', $request->id)->get()->first();
            if(!is_object($cc)){
                $response=array(
                    'msg'=>'ktt'
                );

                return response()->json($response);
            }
            $flag=FALSE;
            if($cc->TTCN == 0){
                if($cc->SoNgayCong != $request->snc){
                    $cc->SoNgayCong=$request->snc;
                    $cc->TTCN = 1;
                    $flag=TRUE;
                }
            }
            
            $cc->Thuong=$request->tt;
            $cc->TienPhat=$request->tp;
            $cc->save();

            event(new QLCC($cc, 'sua', $request->snc, $flag));

            $response = array(
                'msg' => 'tc',
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
            try{
                foreach ($arr as $a){
                    $cc= cham_cong_nv::where("IdCC", $a)->get()->first();
                    if(is_object($cc)){
                        $cc->delete();
                    }
                }

                event(new QLCC($arr, 'xoa'));

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
                $cc= cham_cong_nv::where("IdCC", $request->id)->get()->first();
                if(is_object($cc)){
                    $cc->delete();
                }

                event(new QLCC($request->id, 'xoa'));

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
    
    public function postTimKiem(Request $request){
        try{
            $key=$request->keyWords;
            $param=0;
            $sql="SELECT DISTINCT a.* FROM (
SELECT cc.`IdCC`, cc.`SoNgayCong`, cc.`updated_at` FROM nhan_vien AS nv LEFT JOIN chuc_vu_vs_nv AS cv_nv ON cv_nv.`IdNV` = nv.`IdNV` LEFT JOIN chuc_vu AS cv ON cv.`IdCV` = cv_nv.`IdCV` LEFT JOIN cham_cong_nv AS cc ON cc.`IdNV`= nv.`IdNV` WHERE cc.`TrangThai` = ".$param." AND ((nv.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(nv.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(cc.`created_at`, '%d/%m/%Y') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(cc.`updated_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN cc.`TTCN` = 0 THEN N'Màu đỏ Chưa cập nhật chấm công ccncc mđ md chua cap nhat cham cong' ELSE N'Màu đen Đã cập nhật chấm công da cap nhat cham cong đcncc dcncc ' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)
OR (CASE WHEN nv.`CV` = N'quan_tri_he_thong' THEN N'Quản trị hệ thống' WHEN nv.`CV` = N'quan_ly_benh_vien' THEN N'Quản lý bệnh viện' WHEN nv.`CV` = N'hanh_chinh_tong_hop' THEN N'Hành chính tổng hợp' WHEN nv.`CV` = N'bac_si_chuyen_khoa_kham_va_dieu_tri' THEN N'Bác sĩ chuyên khoa khám và điều trị' WHEN nv.`CV` = N'bac_si_ky_thuat_cls' THEN N'Bác sĩ kỹ thuật cận lâm sàng' WHEN nv.`CV` = N'bac_si_cap_cuu' THEN N'Bác sĩ trực cấp cứu' WHEN nv.`CV` = N'ke_toan' THEN N'Kế toán' WHEN nv.`CV` = N'tiep_don' THEN N'Tiếp đón bệnh nhân' WHEN nv.`CV` = N'phat_thuoc' THEN N'Phát thuốc' WHEN nv.`CV` = N'ky_thuat_dien' THEN N'Kỹ thuật điện' WHEN nv.`CV` = N'ky_thuat_y_te' THEN N'Kỹ thuật y tế' WHEN nv.`CV` = N'lao_cong' THEN N'Lao công' ELSE N'Bảo vệ' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN cv.`IdCV` = N'giam_doc' THEN N'Giám đốc' WHEN cv.`IdCV` = N'truong_khoa' THEN N'Trưởng khoa' WHEN cv.`IdCV` = N'pho_truong_khoa' THEN N'Phó trưởng khoa' WHEN cv.`IdCV` = N'truong_phong' THEN N'Trưởng phòng' WHEN cv.`IdCV` = N'pho_truong_phong' THEN N'Phó trưởng phòng' WHEN cv.`IdCV` = N'nhan_vien' THEN N'Nhân viên' ELSE N'Chuyên viên' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci))
UNION ALL
SELECT cc.`IdCC`, cc.`SoNgayCong`, cc.updated_at FROM nhan_vien AS nv RIGHT JOIN chuc_vu_vs_nv AS cv_nv ON cv_nv.`IdNV` = nv.`IdNV` RIGHT JOIN chuc_vu AS cv ON cv.`IdCV` = cv_nv.`IdCV` RIGHT JOIN cham_cong_nv AS cc ON cc.`IdNV`= nv.`IdNV` WHERE cc.`TrangThai` = ".$param." AND ((nv.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(nv.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(cc.`created_at`, '%d/%m/%Y') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(cc.`updated_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN cc.`TTCN` = 0 THEN N'Màu đỏ Chưa cập nhật chấm công ccncc mđ md chua cap nhat cham cong' ELSE N'Màu đen Đã cập nhật chấm công da cap nhat cham cong đcncc dcncc ' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)
OR (CASE WHEN nv.`CV` = N'quan_tri_he_thong' THEN N'Quản trị hệ thống' WHEN nv.`CV` = N'quan_ly_benh_vien' THEN N'Quản lý bệnh viện' WHEN nv.`CV` = N'hanh_chinh_tong_hop' THEN N'Hành chính tổng hợp' WHEN nv.`CV` = N'bac_si_chuyen_khoa_kham_va_dieu_tri' THEN N'Bác sĩ chuyên khoa khám và điều trị' WHEN nv.`CV` = N'bac_si_ky_thuat_cls' THEN N'Bác sĩ kỹ thuật cận lâm sàng' WHEN nv.`CV` = N'bac_si_cap_cuu' THEN N'Bác sĩ trực cấp cứu' WHEN nv.`CV` = N'ke_toan' THEN N'Kế toán' WHEN nv.`CV` = N'tiep_don' THEN N'Tiếp đón bệnh nhân' WHEN nv.`CV` = N'phat_thuoc' THEN N'Phát thuốc' WHEN nv.`CV` = N'ky_thuat_dien' THEN N'Kỹ thuật điện' WHEN nv.`CV` = N'ky_thuat_y_te' THEN N'Kỹ thuật y tế' WHEN nv.`CV` = N'lao_cong' THEN N'Lao công' ELSE N'Bảo vệ' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN cv.`IdCV` = N'giam_doc' THEN N'Giám đốc' WHEN cv.`IdCV` = N'truong_khoa' THEN N'Trưởng khoa' WHEN cv.`IdCV` = N'pho_truong_khoa' THEN N'Phó trưởng khoa' WHEN cv.`IdCV` = N'truong_phong' THEN N'Trưởng phòng' WHEN cv.`IdCV` = N'pho_truong_phong' THEN N'Phó trưởng phòng' WHEN cv.`IdCV` = N'nhan_vien' THEN N'Nhân viên' ELSE N'Chuyên viên' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)
OR (CASE WHEN nv.`TrinhDo` = N'giao_su' THEN N'Giáo sư' WHEN nv.`TrinhDo` = N'pho_giao_su' THEN N'Phó giáo sư' WHEN nv.`TrinhDo` = N'pho_giao_su_ts' THEN N'Phó giáo sư - Tiến sĩ' WHEN nv.`TrinhDo` = N'tien_si' THEN N'Tiến sĩ' WHEN nv.`TrinhDo` = N'thac_si' THEN N'Thạc sĩ' WHEN nv.`TrinhDo` = N'cu_nhan' THEN N'Cử nhân' WHEN nv.`TrinhDo` = N'cao_dang' THEN N'Cao đẳng' WHEN nv.`TrinhDo` = N'trung_cap' THEN N'Trung cấp'  ELSE N'Dưới trung cấp' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci))
)AS a ORDER BY a.`SoNgayCong` DESC, a.updated_at DESC";
            if($request->loaicc != ''){
                $param=1;
                $sql="SELECT DISTINCT a.* FROM (
SELECT cc.`IdCC`, cc.`SoNgayCong`, cc.`updated_at` FROM nhan_vien AS nv LEFT JOIN chuc_vu_vs_nv AS cv_nv ON cv_nv.`IdNV` = nv.`IdNV` LEFT JOIN chuc_vu AS cv ON cv.`IdCV` = cv_nv.`IdCV` LEFT JOIN cham_cong_nv AS cc ON cc.`IdNV`= nv.`IdNV` WHERE cc.`TrangThai` = ".$param." AND ((nv.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(nv.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(cc.`created_at`, '%d/%m/%Y') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(cc.`updated_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)
OR (CASE WHEN nv.`CV` = N'quan_tri_he_thong' THEN N'Quản trị hệ thống' WHEN nv.`CV` = N'quan_ly_benh_vien' THEN N'Quản lý bệnh viện' WHEN nv.`CV` = N'hanh_chinh_tong_hop' THEN N'Hành chính tổng hợp' WHEN nv.`CV` = N'bac_si_chuyen_khoa_kham_va_dieu_tri' THEN N'Bác sĩ chuyên khoa khám và điều trị' WHEN nv.`CV` = N'bac_si_ky_thuat_cls' THEN N'Bác sĩ kỹ thuật cận lâm sàng' WHEN nv.`CV` = N'bac_si_cap_cuu' THEN N'Bác sĩ trực cấp cứu' WHEN nv.`CV` = N'ke_toan' THEN N'Kế toán' WHEN nv.`CV` = N'tiep_don' THEN N'Tiếp đón bệnh nhân' WHEN nv.`CV` = N'phat_thuoc' THEN N'Phát thuốc' WHEN nv.`CV` = N'ky_thuat_dien' THEN N'Kỹ thuật điện' WHEN nv.`CV` = N'ky_thuat_y_te' THEN N'Kỹ thuật y tế' WHEN nv.`CV` = N'lao_cong' THEN N'Lao công' ELSE N'Bảo vệ' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN cv.`IdCV` = N'giam_doc' THEN N'Giám đốc' WHEN cv.`IdCV` = N'truong_khoa' THEN N'Trưởng khoa' WHEN cv.`IdCV` = N'pho_truong_khoa' THEN N'Phó trưởng khoa' WHEN cv.`IdCV` = N'truong_phong' THEN N'Trưởng phòng' WHEN cv.`IdCV` = N'pho_truong_phong' THEN N'Phó trưởng phòng' WHEN cv.`IdCV` = N'nhan_vien' THEN N'Nhân viên' ELSE N'Chuyên viên' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci))
UNION ALL
SELECT cc.`IdCC`, cc.`SoNgayCong`, cc.updated_at FROM nhan_vien AS nv RIGHT JOIN chuc_vu_vs_nv AS cv_nv ON cv_nv.`IdNV` = nv.`IdNV` RIGHT JOIN chuc_vu AS cv ON cv.`IdCV` = cv_nv.`IdCV` RIGHT JOIN cham_cong_nv AS cc ON cc.`IdNV`= nv.`IdNV` WHERE cc.`TrangThai` = ".$param." AND ((nv.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(nv.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(cc.`created_at`, '%d/%m/%Y') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(cc.`updated_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)
OR (CASE WHEN nv.`CV` = N'quan_tri_he_thong' THEN N'Quản trị hệ thống' WHEN nv.`CV` = N'quan_ly_benh_vien' THEN N'Quản lý bệnh viện' WHEN nv.`CV` = N'hanh_chinh_tong_hop' THEN N'Hành chính tổng hợp' WHEN nv.`CV` = N'bac_si_chuyen_khoa_kham_va_dieu_tri' THEN N'Bác sĩ chuyên khoa khám và điều trị' WHEN nv.`CV` = N'bac_si_ky_thuat_cls' THEN N'Bác sĩ kỹ thuật cận lâm sàng' WHEN nv.`CV` = N'bac_si_cap_cuu' THEN N'Bác sĩ trực cấp cứu' WHEN nv.`CV` = N'ke_toan' THEN N'Kế toán' WHEN nv.`CV` = N'tiep_don' THEN N'Tiếp đón bệnh nhân' WHEN nv.`CV` = N'phat_thuoc' THEN N'Phát thuốc' WHEN nv.`CV` = N'ky_thuat_dien' THEN N'Kỹ thuật điện' WHEN nv.`CV` = N'ky_thuat_y_te' THEN N'Kỹ thuật y tế' WHEN nv.`CV` = N'lao_cong' THEN N'Lao công' ELSE N'Bảo vệ' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN cv.`IdCV` = N'giam_doc' THEN N'Giám đốc' WHEN cv.`IdCV` = N'truong_khoa' THEN N'Trưởng khoa' WHEN cv.`IdCV` = N'pho_truong_khoa' THEN N'Phó trưởng khoa' WHEN cv.`IdCV` = N'truong_phong' THEN N'Trưởng phòng' WHEN cv.`IdCV` = N'pho_truong_phong' THEN N'Phó trưởng phòng' WHEN cv.`IdCV` = N'nhan_vien' THEN N'Nhân viên' ELSE N'Chuyên viên' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)
OR (CASE WHEN nv.`TrinhDo` = N'giao_su' THEN N'Giáo sư' WHEN nv.`TrinhDo` = N'pho_giao_su' THEN N'Phó giáo sư' WHEN nv.`TrinhDo` = N'pho_giao_su_ts' THEN N'Phó giáo sư - Tiến sĩ' WHEN nv.`TrinhDo` = N'tien_si' THEN N'Tiến sĩ' WHEN nv.`TrinhDo` = N'thac_si' THEN N'Thạc sĩ' WHEN nv.`TrinhDo` = N'cu_nhan' THEN N'Cử nhân' WHEN nv.`TrinhDo` = N'cao_dang' THEN N'Cao đẳng' WHEN nv.`TrinhDo` = N'trung_cap' THEN N'Trung cấp'  ELSE N'Dưới trung cấp' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci))
)AS a ORDER BY a.`SoNgayCong` DESC, a.updated_at DESC";
            }
            
            $ds_cc= DB::select($sql);
            $dscc = array();
            $sl=0;
            if(!empty($ds_cc)){
                foreach ($ds_cc as $cc){
                    $chamcong= cham_cong_nv::where('IdCC', $cc->IdCC)->get()->first();
                    $cv='';$i=1;
                    if(count($chamcong->nhanVien->chucVu) == 0){
                        $cv='Nhân viên';
                    }
                    else{
                        foreach ($chamcong->nhanVien->chucVu as $value) {
                            if($i==count($chamcong->nhanVien->chucVu)){
                                $cv.='- '.$value->chucVu->TenCV;
                            }
                            else{
                                $cv.='- '.$value->chucVu->TenCV.'<br>';
                            }
                            $i++;
                        }
                    }
                    $flag=TRUE;
                    if(date('d/m/Y', strtotime($chamcong->updated_at)) == date('d/m/Y') && $chamcong->TTCN == 1){
                        $flag=FALSE;
                    }
                    
                    $ttcc= array(
                        'id' => $chamcong->IdCC,
                        'hoten' => $chamcong->nhanVien->TenNV,
                        'nvl' => date('d/m/Y', strtotime($chamcong->nhanVien->created_at)),
                        'ntcc' => \comm_functions::dedateFormat($chamcong->created_at),
                        'ncn' => \comm_functions::dedateFormat($chamcong->updated_at),
                        'cv' => $cv,
                        'congviec'=>\comm_functions::decodeCongViec($chamcong->nhanVien->CV),
                        'snc'=>$chamcong->SoNgayCong,
                        'flag'=>$flag
                    );
                    
                    $dscc[]=$ttcc;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'cc'=>$dscc,
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
            $ds_cc=cham_cong_nv::where('TrangThai', 0)->orderBy('SoNgayCong', 'DESC')->get();
            if($request->loaicc != ''){
                $ds_cc=cham_cong_nv::where('TrangThai', 1)->orderBy('updated_at', 'DESC')->orderBy('SoNgayCong', 'DESC')->get();
            }
            $dscc=array();
            foreach ($ds_cc as $chamcong){
                $cv='';$i=1;
                if(count($chamcong->nhanVien->chucVu) == 0){
                    $cv='Nhân viên';
                }
                else{
                    foreach ($chamcong->nhanVien->chucVu as $value) {
                        if($i==count($chamcong->nhanVien->chucVu)){
                            $cv.='- '.$value->chucVu->TenCV;
                        }
                        else{
                            $cv.='- '.$value->chucVu->TenCV.'<br>';
                        }
                        $i++;
                    }
                }
                $flag=TRUE;
                if(date('d/m/Y', strtotime($chamcong->updated_at)) == date('d/m/Y') && $chamcong->TTCN == 1){
                    $flag=FALSE;
                }

                $ttcc= array(
                    'id' => $chamcong->IdCC,
                    'hoten' => $chamcong->nhanVien->TenNV,
                    'nvl' => date('d/m/Y', strtotime($chamcong->nhanVien->created_at)),
                    'ntcc' => \comm_functions::dedateFormat($chamcong->created_at),
                    'ncn' => \comm_functions::dedateFormat($chamcong->updated_at),
                    'cv' => $cv,
                    'congviec'=>\comm_functions::decodeCongViec($chamcong->nhanVien->CV),
                    'snc'=>$chamcong->SoNgayCong,
                    'flag'=>$flag
                );
                
                $dscc[]=$ttcc;
            }
            $response = array(
                'msg' => 'tc',
                'cc'=>$dscc
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
    
    public static function TaoMaNNCC(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= cham_cong_nv::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $cc) {
                   if($cc->IdCC == $ran){
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
