<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\khoa;
use App\Models\HanhChinh\thong_ke;
use App\Models\HanhChinh\phong_ban;
use App\Models\HanhChinh\nhan_vien;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Events\HanhChinh\KhoaEvent;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class khoaController extends Controller
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
        $dskhoa= khoa::orderBy('NgayTL', 'DESC')->get();
        return view("hanh_chinh.quan_ly_khoa",["dskhoa"=>$dskhoa, 'dsbc'=>$sl]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            $khoa= khoa::where('IdKhoa',$request->id)->get()->first();
            $response=array(
                'tenkhoa' => $khoa->TenKhoa,
                'ngaytl' => \comm_functions::deDateFormatForUpdate($khoa->NgayTL),
                'pl' => $khoa->TenKDau,
                'cn' => $khoa->ChucNang,
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
            $k=khoa::where('IdKhoa', $request->id)->get()->first();
            if(is_object($k)){
                $kh=khoa::where('TenKhoa', 'like', "%".$request->tenkhoa."%")->get()->first();
                if(is_object($kh)){
                    if($kh->IdKhoa != $request->id){
                        $response = array(
                            'msg' => 'trung',
                        );
                        return response()->json($response); 
                    }
                    else{
                        $k->TenKDau=$request->pl;
                        $k->TenKhoa=$request->tenkhoa;
                        $k->NgayTL= \comm_functions::enDateFormat($request->ngaytl);
                        $k->ChucNang=$request->cn;
                        if($request->pl == 'khoa_kham'){
                            $k->KhoaKham=1;
                        }
                        else{
                            $k->KhoaKham=0;
                        }
                        $k->save();

                        event(new KhoaEvent($k, 'sua'));

                        $response = array(
                            'msg' => 'tc',
                        );
                        return response()->json($response); 
                    }  
                }
                else{
                    $k->TenKDau=$request->pl;
                    $k->TenKhoa=$request->tenkhoa;
                    $k->NgayTL= \comm_functions::enDateFormat($request->ngaytl);
                    $k->ChucNang=$request->cn;
                    if($request->pl == 'khoa_kham'){
                        $k->KhoaKham=1;
                    }
                    else{
                        $k->KhoaKham=0;
                    }
                    $k->save();

                    event(new KhoaEvent($k, 'sua'));

                    $response = array(
                        'msg' => 'tc',
                    );
                    return response()->json($response); 
                } 
            }
            else{
                $response = array(
                    'msg' => 'ktt',
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

    public function postThem(Request $request){
        try{
            $khoa=khoa::where('TenKhoa', 'like', "%".$request->tenkhoa."%")->get()->first();
            if(is_object($khoa)){
                $response = array(
                    'msg' => 'trung',
                );
                return response()->json($response); 
            }
            else{
                $k= new khoa;
                $k->IdKhoa= khoaController::TaoMaNN();
                $k->TenKhoa=$request->tenkhoa;
                $k->TenKDau=$request->pl;
                $k->ChucNang=$request->cn;
                $k->NgayTL= \comm_functions::enDateFormat($request->ngaytl);

                if($request->pl == 'khoa_kham'){
                    $k->KhoaKham=1;
                }
                else{
                    $k->KhoaKham=0;
                }
                $k->save();

                event(new KhoaEvent($k, 'them'));

                $response = array(
                    'msg' => 'tc',
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

    public function postXoa(Request $request){
        if(strpos($request->id, ',')){//gửi nhiều mã
            $arr= explode(',',$request->id);
            try{
                foreach ($arr as $a){
                    $khoa= khoa::where("IdKhoa", $a)->get()->first();
                    $phong= phong_ban::where('IdKhoa', $khoa->IdKhoa)->get();
                    if(is_object($phong)){
                        foreach($phong as $p){
                            foreach($p->nhanVien as $nv){
                                $nhanvien= nhan_vien::where("IdNV", $nv->IdNV)->get()->first();
                                $benhanngoai= benh_an_ngoai_tru::where('IdNV', $nhanvien->IdNV)->get()->first();
                                if(is_object($benhanngoai)){
                                    if(is_object($benhanngoai->CanLamSang)){
                                        foreach($benhanngoai->CanLamSang as $cls){
                                            $cls->canLamSang->delete();
                                        }
                                    }
                                    if(is_object($benhanngoai->chiDinhTT)){
                                        foreach($benhanngoai->chiDinhTT as $cls){
                                            $cls->chiDinhTT->delete();
                                        }
                                    }
                                    //thu thuat, ...
                                    $benhanngoai->delete();
                                }

                                $benhannoi= benh_an_noi_tru::where('IdNV', $nhanvien->IdNV)->get()->first();
                                if(is_object($benhannoi)){
                                    if(is_object($benhannoi->benhAnNoiTruCT)){
                                        foreach($benhannoi->benhAnNoiTruCT as $bact){
                                            if(is_object($bact->canLamSang)){
                                                foreach($bact->canLamSang as $cls){
                                                    $cls->canLamSang->delete();
                                                }
                                            }
                                            //thu thuat, ...
                                            if(is_object($bact->phieuChiDinhTT)){
                                                foreach($bact->phieuChiDinhTT as $cls){
                                                    $cls->chiDinhTT->delete();
                                                }
                                            }
                                        }
                                    }
                                    $benhannoi->delete();
                                } 
                                if($nhanvien->Anh != '' && file_exists("public/upload/anhnv/".$nhanvien->Anh)){
                                    unlink("public/upload/anhnv/".$nhanvien->Anh);
                                }
                                $nhanvien->delete();
                            }
                        }
                    }

                    $khoa->delete();
                }
                
                event(new KhoaEvent($arr, 'xoa'));
                
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
                $khoa= khoa::where("IdKhoa", $request->id)->get()->first();
                $phong= phong_ban::where('IdKhoa', $khoa->IdKhoa)->get();
                if(is_object($phong)){
                    foreach($phong as $p){
                        foreach($p->nhanVien as $nv){
                            $nhanvien= nhan_vien::where("IdNV", $nv->IdNV)->get()->first();
                            $benhanngoai= benh_an_ngoai_tru::where('IdNV', $nhanvien->IdNV)->get()->first();
                            if(is_object($benhanngoai)){
                                if(is_object($benhanngoai->CanLamSang)){
                                    foreach($benhanngoai->CanLamSang as $cls){
                                        $cls->canLamSang->delete();
                                    }
                                }
                                if(is_object($benhanngoai->chiDinhTT)){
                                    foreach($benhanngoai->chiDinhTT as $cls){
                                        $cls->chiDinhTT->delete();
                                    }
                                }
                                //thu thuat, ...
                                $benhanngoai->delete();
                            }

                            $benhannoi= benh_an_noi_tru::where('IdNV', $nhanvien->IdNV)->get()->first();
                            if(is_object($benhannoi)){
                                if(is_object($benhannoi->benhAnNoiTruCT)){
                                    foreach($benhannoi->benhAnNoiTruCT as $bact){
                                        if(is_object($bact->canLamSang)){
                                            foreach($bact->canLamSang as $cls){
                                                $cls->canLamSang->delete();
                                            }
                                        }
                                        //thu thuat, ...
                                        if(is_object($bact->phieuChiDinhTT)){
                                            foreach($bact->phieuChiDinhTT as $cls){
                                                $cls->chiDinhTT->delete();
                                            }
                                        }
                                    }
                                }
                                $benhannoi->delete();
                            } 
                            if($nhanvien->Anh != '' && file_exists("public/upload/anhnv/".$nhanvien->Anh)){
                                unlink("public/upload/anhnv/".$nhanvien->Anh);
                            }
                            $nhanvien->delete();
                        }
                    }
                }

                $khoa->delete();
                
                event(new KhoaEvent($request->id, 'xoa'));
                
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

    public static function TaoMaNN(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= khoa::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $k) {
                   if($k->IdKhoa == $ran){
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
    
    public function postTimKiem(Request $request){
        try{
            $key=$request->keyWords;
            $ds_khoa= DB::select("SELECT k.* FROM khoa AS k WHERE (k.`IdKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (k.`TenKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(k.`NgayTL`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN k.`TenKDau` = N'khoa_kham' THEN N'Khoa khám và điều trị' WHEN k.`TenKDau` = N'hoi_suc_cap_cuu' THEN N'Khoa chức năng cấp cứu' WHEN k.`TenKDau` = N'can_lam_sang' THEN N'Khoa chức năng chuẩn đoán cận lâm sàng' WHEN k.`TenKDau` = N'phau_thuat' THEN N'Khoa chức năng phẫu thuật' WHEN k.`TenKDau` = N'hanh_chinh_tong_hop' THEN N'Khoa chức năng hành chính' WHEN k.`TenKDau` = N'ke_toan' THEN N'Khoa chức năng kế toán' WHEN k.`TenKDau` = N'quan_tri' THEN N'Khoa chức năng quản trị hệ thống' WHEN k.`TenKDau` = N'tiep_don_cap_cuu' THEN N'Khoa chức tiếp đón cấp cứu' WHEN k.`TenKDau` = N'tiep_don_kham_benh' THEN N'Khoa chức năng tiếp đón khám bệnh' ELSE N'Khoa chức năng cấp phát thuốc' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (k.`ChucNang` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY k.NgayTL DESC");
            $dskhoa = array();
            $sl=0;
            if(!empty($ds_khoa)){
                foreach ($ds_khoa as $khoa){
                    $ttkhoa= array(
                        'tenkhoa' => $khoa->TenKhoa,
                        'ngaytl' => date('d/m/Y', strtotime($khoa->NgayTL)),
                        'cn' => $khoa->ChucNang,
                        'id' => $khoa->IdKhoa
                    );
                    
                    $dskhoa[]=$ttkhoa;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'khoa'=>$dskhoa,
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
    
    public function postLayDSK(){
        try{
            $ds_khoa=khoa::orderBy('NgayTL', 'DESC')->get();
            foreach ($ds_khoa as $khoa){
                $ttkhoa= array(
                    'tenkhoa' => $khoa->TenKhoa,
                    'ngaytl' => date('d/m/Y', strtotime($khoa->NgayTL)),
                    'cn' => $khoa->ChucNang,
                    'id' => $khoa->IdKhoa
                );

                $dskhoa[]=$ttkhoa;
            }
            $response = array(
                'msg' => 'tc',
                'khoa'=>$dskhoa
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
