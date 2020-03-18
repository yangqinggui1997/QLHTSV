<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\nhan_vien;
use App\Models\Admin\cap_them_quyen_user;
use Illuminate\Foundation\Auth\User;
use App\Events\Admin\UserEvent;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    
    public function getDanhSach(){
        $dsnhanvien= nhan_vien::where([['CV', '<>', 'lao_cong'], ['CV', '<>', 'ky_thuat_dien'], ['CV', '<>', 'ky_thuat_y_te'], ['CV', '<>', 'bao_ve']])->orderBy('created_at', 'DESC')->get();
        $dsnv=array();
        foreach ($dsnhanvien as $value) {
            if(!is_object($value->nguoiDung)){
                $dsnv[]=$value;
            }
        }
        $dsnguoidung= User::orderBy('created_at', 'DESC')->get();
        return view("admin.quan_ly_nguoi_dung",["dsnv"=>$dsnv, "dsnguoidung"=>$dsnguoidung]);
    }

    public function postThem(Request $request){
        $user= new User;
        $user->IdNV= $request->idnv;
        $nhanvien= nhan_vien::where('IdNV', $request->idnv)->get()->first();
        $quyen='admin';
        if($nhanvien->CV == 'bac_si_chuyen_khoa_kham_va_dieu_tri'){
            $quyen='bsk';
        }
        else if($nhanvien->CV == 'phat_thuoc'){
            $quyen='pt';
        }
        else if($nhanvien->CV == 'bac_si_ky_thuat_cls'){
            $quyen='bskt';
        }
        else if($nhanvien->CV == 'tiep_don_cc'){
            $quyen='tdcc';
        }
        else if($nhanvien->CV == 'tiep_don_kham_benh'){
            $quyen='tdkb';
        }
        else if($nhanvien->CV == 'hanh_chinh_tong_hop'){
            $quyen='hc';
        }
        else if($nhanvien->CV == 'quan_ly_benh_vien'){
            $quyen='qlbv';
        }
        else if($nhanvien->CV == 'bac_si_cap_cuu'){
            $quyen='bscc';
        }
        else if($nhanvien->CV == 'ke_toan'){ 
            $quyen='kt';
        }
        $user->name= \comm_functions::changeTitle($nhanvien->TenNV);
        $user->email=$nhanvien->Email;
        $user->email_verified_at= $nhanvien->created_at;
        $user->password= bcrypt($nhanvien->IdNV);
        $user->Quyen=$quyen;
        $user->TrangThai='dang_xuat';

        $user->save();

        if($request->quyenmoi != ''){
            if(strpos($request->quyenmoi, ',')){//gửi nhiều mã
                $arr= explode(',',$request->quyenmoi);
                foreach ($arr as $value) {
                    $cq=new cap_them_quyen_user;
                    $cq->IdCQ= UserController::TaoMaNN();
                    $cq->IdUser=$user->id;
                    $cq->Quyen=$value;
                    $cq->save();
                }
            }
            else{
                $cq=new cap_them_quyen_user;
                $cq->IdCQ= UserController::TaoMaNN();
                $cq->IdUser=$user->id;
                $cq->Quyen=$request->quyenmoi;
                $cq->save();
            }
        }
        event(new UserEvent($user, 'them'));

        $response = array(
            'msg' => 'tc',
        );

        return response()->json($response); 
    }

    public function postLayTTCN(Request $request){
        try{
            $nd= User::where('id',$request->id)->get()->first();
            
            $quyenmoi='';
            foreach ($nd->capQuyen as $cq) {
                $q='Quản lý bệnh viện';
                if($cq->Quyen == 'qlck'){
                    $q="Quản lý chuyên khoa";
                }
                else if($cq->Quyen == 'khth'){
                    $q="Quản lý phòng kế hoạch tổng hợp";
                }
                
                $quyenmoi.='<option value="'.$cq->Quyen.'">'.$q.'</option>';
            }
            $quyen='';$quyenc='';
            if($nd->nhanVien->CV == 'bac_si_chuyen_khoa_kham_va_dieu_tri'){
                $quyen="bsk";
                $quyenc="Bác sĩ khám và điều trị chuyên khoa";
            }
            else if($nd->nhanVien->CV == 'bac_si_ky_thuat_cls'){
                $quyen="bskt";
                $quyenc="Bác sĩ khoa cận lâm sàng";
            }
            else if($nd->nhanVien->CV == 'bac_si_cap_cuu'){
                $quyen="bscc";
                $quyenc="Bác sĩ trực cấp cứu";
            }
            else if($nd->nhanVien->CV == 'ke_toan'){
                $quyen="kt";
                $quyenc="Kết toán (thu ngân)";
            }
            else if($nd->nhanVien->CV == 'quan_ly_benh_vien'){
                $quyen="qlbv";
                $quyenc="Quản lý bệnh viện";
            }
            else if($nd->nhanVien->CV == 'hanh_chinh_tong_hop'){
                $quyen="hc";
                $quyenc="Hành chính tổng hợp";
            }
            else if($nd->nhanVien->CV == 'phat_thuoc'){
                $quyen="pt";
                $quyenc="Phát thuốc";
            }
            else if($nd->nhanVien->CV == 'tiep_don_cc'){
                $quyen="tdcc";
                $quyenc="Trực tiếp đón bệnh nhân cấp cứu";
            }
            else{
                $quyen="tdkb";
                $quyenc="Tiếp đón bệnh nhân đến khám bệnh";
            }
            
            $response=array(
                'nv' => $nd->nhanVien->TenNV,
                'quyenmoi' => $quyenmoi,
                'quyen' => $quyen,
                'quyenc' => $quyenc,
                'email' => $nd->email,
                'msg' => 'tc'
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
    
    public function postSua(Request $request){
        try{
            $user= User::where('id', $request->id)->get()->first();
            foreach($user->capQuyen  as $cq){
                $cq->delete();
            }
            if($request->quyenmoi != ''){
                
                if(strpos($request->quyenmoi, ',')){//gửi nhiều mã
                    $arr= explode(',',$request->quyenmoi);
                    foreach ($arr as $value) {
                        $cq=new cap_them_quyen_user;
                        $cq->IdCQ= UserController::TaoMaNN();
                        $cq->IdUser=$user->id;
                        $cq->Quyen=$value;
                        $cq->save();
                    }
                }
                else{
                    $cq=new cap_them_quyen_user;
                    $cq->IdCQ= UserController::TaoMaNN();
                    $cq->IdUser=$user->id;
                    $cq->Quyen=$request->quyenmoi;
                    $cq->save();
                } 
            }

            event(new UserEvent($user, 'sua'));

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
            $dskx=[];
            try{
                $flag=FALSE;$arr_nv=[];$arr_xoa=[];
                foreach ($arr as $value) {
                    $user=User::where('id', $value)->get()->first();
                    if($user->TrangThai == 'dang_xuat' && $user->Quyen != 'admin'){
                        $arr_xoa[]=$value;
                        $quyen='';$quyenc='';
                        if($user->nhanVien->CV == 'bac_si_chuyen_khoa_kham_va_dieu_tri'){
                            $quyen="bsk";
                            $quyenc="Bác sĩ khám và điều trị chuyên khoa";
                        }
                        else if($user->nhanVien->CV == 'bac_si_ky_thuat_cls'){
                            $quyen="bskt";
                            $quyenc="Bác sĩ khoa cận lâm sàng";
                        }
                        else if($user->nhanVien->CV == 'bac_si_cap_cuu'){
                            $quyen="bscc";
                            $quyenc="Bác sĩ trực cấp cứu";
                        }
                        else if($user->nhanVien->CV == 'ke_toan'){
                            $quyen="kt";
                            $quyenc="Kết toán (thu ngân)";
                        }
                        else if($user->nhanVien->CV == 'quan_ly_benh_vien'){
                            $quyen="qlbv";
                            $quyenc="Quản lý bệnh viện";
                        }
                        else if($user->nhanVien->CV == 'hanh_chinh_tong_hop'){
                            $quyen="hc";
                            $quyenc="Hành chính tổng hợp";
                        }
                        else if($user->nhanVien->CV == 'phat_thuoc'){
                            $quyen="pt";
                            $quyenc="Phát thuốc";
                        }
                        else if($user->nhanVien->CV == 'tiep_don_cc'){
                            $quyen="tdcc";
                            $quyenc="Trực tiếp đón bệnh nhân cấp cứu";
                        }
                        else{
                            $quyen="tdkb";
                            $quyenc="Tiếp đón bệnh nhân đến khám bệnh";
                        }
                        $arr_nv[]='<option data-quyencode="'.$quyen.'" data-quyen="'.$quyenc.'" value="'.$user->IdNV.'" data-value="'.$user->IdNV.'" data-email="'.$user->email.'">'.$user->nhanVien->TenNV.'</option>';
                        $user->delete();
                        $flag=TRUE;
                    }
                    else{
                        $dskx[]=$user->nhanVien->TenNV;
                    }
                }
                
                if($flag == TRUE){
                    event(new UserEvent($arr_xoa, 'xoa', $dskx));
                }
                
                $response = array(
                    'msg' => 'tc',
                    'dskx'=>$dskx,
                    'dsx'=>$arr_nv
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
                $dskx=[];$arr_nv=[];
                $user=User::where('id', $request->id)->get()->first();
                if($user->TrangThai == 'dang_xuat' && $user->Quyen != 'admin'){
                    $quyen='';$quyenc='';
                    if($user->nhanVien->CV == 'bac_si_chuyen_khoa_kham_va_dieu_tri'){
                        $quyen="bsk";
                        $quyenc="Bác sĩ khám và điều trị chuyên khoa";
                    }
                    else if($user->nhanVien->CV == 'bac_si_ky_thuat_cls'){
                        $quyen="bskt";
                        $quyenc="Bác sĩ khoa cận lâm sàng";
                    }
                    else if($user->nhanVien->CV == 'bac_si_cap_cuu'){
                        $quyen="bscc";
                        $quyenc="Bác sĩ trực cấp cứu";
                    }
                    else if($user->nhanVien->CV == 'ke_toan'){
                        $quyen="kt";
                        $quyenc="Kết toán (thu ngân)";
                    }
                    else if($user->nhanVien->CV == 'quan_ly_benh_vien'){
                        $quyen="qlbv";
                        $quyenc="Quản lý bệnh viện";
                    }
                    else if($user->nhanVien->CV == 'hanh_chinh_tong_hop'){
                        $quyen="hc";
                        $quyenc="Hành chính tổng hợp";
                    }
                    else if($user->nhanVien->CV == 'phat_thuoc'){
                        $quyen="pt";
                        $quyenc="Phát thuốc";
                    }
                    else if($user->nhanVien->CV == 'tiep_don_cc'){
                        $quyen="tdcc";
                        $quyenc="Trực tiếp đón bệnh nhân cấp cứu";
                    }
                    else{
                        $quyen="tdkb";
                        $quyenc="Tiếp đón bệnh nhân đến khám bệnh";
                    }
                    $arr_nv[]='<option data-quyencode="'.$quyen.'" data-quyen="'.$quyenc.'" value="'.$user->IdNV.'" data-value="'.$user->IdNV.'" data-email="'.$user->email.'">'.$user->nhanVien->TenNV.'</option>';
                    $user->delete();
                    event(new UserEvent($request->id, 'xoa'));
                }
                else{
                    $dskx[]=$user->nhanVien->TenNV;
                }
                
                $response = array(
                    'msg' => 'tc',
                    'dskx'=>$dskx,
                    'dsx'=>$arr_nv
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
            $ds_nd= DB::select("SELECT u.*, nv.`TenNV`, nv.`Anh` FROM users AS u JOIN nhan_vien AS nv ON u.`IdNV` = nv.`IdNV` WHERE (u.`name` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (u.`email` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(u.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (u.`Quyen` LIKE N'%".\comm_functions::changeTitle($key)."%' COLLATE utf8_unicode_ci) OR (u.`TrangThai` LIKE N'%".\comm_functions::changeTitle($key)."%' COLLATE utf8_unicode_ci) OR (nv.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY u.created_at DESC");
            $dsnd = array();
            $sl=0;
            if(!empty($ds_nd)){
                foreach ($ds_nd as $user){
                    $qh='Quản trị hệ thống';
                    if($user->Quyen == 'bsk'){
                        $qh='Bác sĩ khám và điều trị bệnh';
                    }
                    else if($user->Quyen == 'bskt'){
                        $qh='Bác sĩ thực hiện cận lâm sàng';
                    }
                    else if($user->Quyen == 'qlbv'){
                        $qh="Quản lý bệnh viện";
                    }
                    else if($user->Quyen == 'hc'){
                        $qh='Nhân viên hành chính';
                    }
                    else if($user->Quyen == 'pt'){
                        $qh='Nhân viên quầy phát thuốc';
                    }
                    else if($user->Quyen == 'kt'){
                        $qh='Nhân viên kế toán';
                    }
                    else if($user->Quyen == 'tdkb' || $user->Quyen == 'tdcc'){
                        $qh='Nhân viên tiếp đón';
                    }
                    else if($user->Quyen == 'bscc'){
                        $qh='Bác sĩ trực cấp cứu';
                    }
                    $tt='Đăng nhập';
                    if($user->TrangThai == 'dang_xuat'){
                        $tt='Đăng xuất';
                    }
                    $ttphong= array(
                        'tennd' => $user->TenNV,
                        'tk' => $user->email,
                        'qh' => $qh,
                        'tt' => $tt,
                        'ngaytao' => \comm_functions::deDateFormat($user->created_at),
                        'anh'=>$user->Anh,
                        'id'=>$user->id
                    );
                    
                    $dsnd[]=$ttphong;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'user'=>$dsnd,
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
    
    public function postLayDSND(){
        try{
            $dsnguoidung= User::orderBy('created_at', 'DESC')->get();
            $dsnd = array();
            foreach ($dsnguoidung as $user){
                $qh='Quản trị hệ thống';
                if($user->Quyen == 'bsk'){
                    $qh='Bác sĩ khám và điều trị bệnh';
                }
                else if($user->Quyen == 'bskt'){
                    $qh='Bác sĩ thực hiện cận lâm sàng';
                }
                else if($user->Quyen == 'qlbv'){
                    $qh="Quản lý bệnh viện";
                }
                else if($user->Quyen == 'hc'){
                    $qh='Nhân viên hành chính';
                }
                else if($user->Quyen == 'pt'){
                    $qh='Nhân viên quầy phát thuốc';
                }
                else if($user->Quyen == 'kt'){
                    $qh='Nhân viên kế toán';
                }
                else if($user->Quyen == 'tdkb' || $user->Quyen == 'tdcc'){
                    $qh='Nhân viên tiếp đón';
                }
                else if($user->Quyen == 'bscc'){
                    $qh='Bác sĩ trực cấp cứu';
                }
                $tt='Đăng nhập';
                if($user->TrangThai == 'dang_xuat'){
                    $tt='Đăng xuất';
                }
                $ttpb= array(
                    'tennd' => $user->nhanVien->TenNV,
                    'tk' => $user->email,
                    'qh' => $qh,
                    'tt' => $tt,
                    'ngaytao' => \comm_functions::deDateFormat($user->created_at),
                    'anh'=>$user->nhanVien->Anh,
                    'id'=>$user->id
                );

                $dsnd[]=$ttpb;
            }
            $response = array(
                'msg' => 'tc',
                'user'=>$dsnd
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
        $ds= cap_them_quyen_user::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $cq) {
                   if($cq->IdCQ == $ran){
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
