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
use App\Events\HanhChinh\PhongBan;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class phongBanController extends Controller
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
        $dspb= phong_ban::orderBy('created_at', 'DESC')->get();
        $dskhoa= khoa::orderBy('NgayTL', 'DESC')->get();
        return view("hanh_chinh.quan_ly_phong_ban",["dspb"=>$dspb, "dskhoa"=>$dskhoa, 'dsbc'=>$sl]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            $phong= phong_ban::where('IdPB',$request->id)->get()->first();
            $response=array(
                'tenphong' => $phong->TenPhong,
                'khoa' => $phong->Khoa->IdKhoa,
                'pl' => $phong->PhanLoai,
                'cn' => $phong->ChucNang,
                'sophong' => $phong->SoPhong,
                'tang' => $phong->Tang,
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
            $phong= phong_ban::where([['SoPhong', $request->sp], ['IdKhoa', $request->khoa]])->get()->first();
            if(is_object($phong)){
                if($phong->IdPB != $request->id){
                    $khoa= khoa::where('IdKhoa', $request->khoa)->get()->first();
                    $ds= $khoa->phongBan;
                    $dsgy=[];
                    if($ds->isNotEmpty()){
                        for($i=0; $i<4; $i++){
                            $ran = \comm_functions::BigRandomNumber(001, 999);
                            $flag=TRUE;
                            while($flag){
                                foreach ($ds as $p) {
                                   if($p->SoPhong == $ran && $phong->IdPB != $p->IdPB){
                                        $ran= \comm_functions::BigRandomNumber(001, 999);
                                        $flag=TRUE;
                                        break;
                                    }
                                    else{
                                        $flag=FALSE;
                                    }  
                                }
                                if($flag == FALSE){
                                    $dsgy[]=str_pad($ran, 3, 0, STR_PAD_LEFT);
                                }
                            }
                        }
                    }

                    $response = array(
                        'msg' => 'trungsp',
                        'gysp'=>$dsgy
                    );
                    return response()->json($response); 
                }
                else {
                    $p= phong_ban::where('IdPB', $request->id)->get()->first();
                    $p->TenKDau= \comm_functions::changeTitle($request->tenphong);
                    $p->TenPhong=$request->tenphong;
                    $p->IdKhoa= $request->khoa;
                    $p->PhanLoai=$request->pl;
                    $p->SoPhong=$request->sp;
                    $p->Tang=$request->tang; 
                    $p->ChucNang=$request->cn;

                    $p->save();

                    event(new PhongBan($p, 'sua'));

                    $response = array(
                        'msg' => 'tc',
                    );
                    return response()->json($response); 
                }
            }
            else{
                $p= phong_ban::where('IdPB', $request->id)->get()->first();
                $p->TenKDau= \comm_functions::changeTitle($request->tenphong);
                $p->TenPhong=$request->tenphong;
                $p->IdKhoa= $request->khoa;
                $p->PhanLoai=$request->pl;
                $p->SoPhong=$request->sp;
                $p->Tang=$request->tang; 
                $p->ChucNang=$request->cn;

                $p->save();

                event(new PhongBan($p, 'sua'));

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

    public function postThem(Request $request){
        try{
            $phong= phong_ban::where([['SoPhong', $request->sp], ['IdKhoa', $request->khoa]])->get()->first();
            if(is_object($phong)){
                $khoa= khoa::where('IdKhoa', $request->khoa)->get()->first();
                $ds= $khoa->phongBan;
                $dsgy=[];
                if($ds->isNotEmpty()){
                    for($i=0; $i<4; $i++){
                        $ran = \comm_functions::BigRandomNumber(001, 999);
                        $flag=TRUE;
                        while($flag){
                            foreach ($ds as $p) {
                               if($p->SoPhong == $ran && $phong->IdPB != $p->IdPB){
                                    $ran= \comm_functions::BigRandomNumber(001, 999);
                                    $flag=TRUE;
                                    break;
                                }
                                else{
                                    $flag=FALSE;
                                }  
                            }
                            if($flag == FALSE){
                                $dsgy[]=str_pad($ran, 3, 0, STR_PAD_LEFT);
                            }
                        }
                    }
                }

                $response = array(
                    'msg' => 'trungsp',
                    'gysp'=>$dsgy
                );
                return response()->json($response); 
            }
            else{
                $p= new phong_ban;
                $p->IdPB= phongBanController::TaoMaNN();
                $p->TenKDau= \comm_functions::changeTitle($request->tenphong);
                $p->TenPhong=$request->tenphong;
                $p->IdKhoa= $request->khoa;
                $p->PhanLoai=$request->pl;
                $p->SoPhong=$request->sp;
                $p->Tang=$request->tang; 
                $p->ChucNang=$request->cn;
                
                $p->save();

                event(new PhongBan($p, 'them'));

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
                    $pb= phong_ban::where("IdPB", $a)->get()->first();
                    if(is_object($pb)){
                        foreach($pb->nhanVien as $nv){
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

                    $pb->delete();
                }
                
                event(new PhongBan($arr, 'xoa'));
                
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
                $pb= phong_ban::where("IdPB", $request->id)->get()->first();
                if(is_object($pb)){
                    foreach($pb->nhanVien as $nv){
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

                $pb->delete();
                
                event(new PhongBan($request->id, 'xoa'));
                
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
        $ds= phong_ban::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $p) {
                   if($p->IdPB == $ran){
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
            $ds_phong= DB::select("SELECT p.*, k.`TenKhoa` FROM phong_ban AS p JOIN khoa AS k ON p.`IdKhoa` = k.`IdKhoa` WHERE (p.`IdPB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (p.`TenPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (p.`PhanLoai` LIKE N'%".\comm_functions::changeTitle($key)."%' COLLATE utf8_unicode_ci) OR (CASE WHEN p.`Tang` = 0 THEN N'Triệt' ELSE CONCAT(N'Lầu ', p.`Tang`) END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (p.`SoPhong` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (p.`ChucNang` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (k.`TenKhoa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY p.created_at DESC");
            $dsphong = array();
            $sl=0;
            if(!empty($ds_phong)){
                foreach ($ds_phong as $phong){
                    $ttphong= array(
                        'tenphong' => $phong->TenPhong,
                        'tenkhoa' => $phong->TenKhoa,
                        'cn' => $phong->ChucNang,
                        'sophong' => $phong->SoPhong,
                        'tang' => $phong->Tang,
                        'id' => $phong->IdPB
                    );
                    
                    $dsphong[]=$ttphong;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'phongban'=>$dsphong,
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
    
    public function postLayDSPB(){
        try{
            $dspb= phong_ban::orderBy('created_at', 'DESC')->get();
            $dsp=array();
            foreach ($dspb as $phong){
                $ttpb= array(
                    'tenphong' => $phong->TenPhong,
                    'tenkhoa' => $phong->Khoa->TenKhoa,
                    'cn' => $phong->ChucNang,
                    'sophong' => $phong->SoPhong,
                    'tang' => $phong->Tang,
                    'id' => $phong->IdPB
                );

                $dsp[]=$ttpb;
            }
            $response = array(
                'msg' => 'tc',
                'phongban'=>$dsp
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
