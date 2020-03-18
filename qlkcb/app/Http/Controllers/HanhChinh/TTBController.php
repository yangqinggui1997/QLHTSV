<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\khoa;
use App\Models\HanhChinh\thong_ke;
use App\Models\HanhChinh\thiet_bi_yt;
use App\Models\HanhChinh\danh_muc_thuoc;
use App\Models\HanhChinh\danh_muc_thuoc_vs_khoa;
use App\Models\HanhChinh\danh_muc_benh_vs_thuoc;
use App\Events\HanhChinh\TTB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class TTBController extends Controller
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
        $dskhoa= khoa::orderBy('TenKhoa', 'ASC')->get();
        $dstb= thiet_bi_yt::orderBy('TenTB', 'ASC')->get();
        return view("hanh_chinh.quan_ly_trang_thiet_bi_yt",["dskhoa"=>$dskhoa, 'dstb'=>$dstb, 'dsbc'=>$sl]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            $tb= thiet_bi_yt::where('IdTB', $request->id)->get()->first();

            $response=array(
                'tentb' => $tb->TenTB,
                'nsx' => $tb->NSX,
                'ncu' => $tb->NCU,
                'ngaynhap' => date('d/m/Y', strtotime($tb->NgayNhap)),
                'pl' => $tb->PhanLoai,
                'dgn' => $tb->DonGiaNhap,
                'cn' => $tb->ChucNang,
                'khoa' => $tb->phongBan->Khoa->IdKhoa,
                'phong' => $tb->phongBan->IdPB,
                'tttb'=>$tb->TTTB,
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
            $tb= thiet_bi_yt::where('IdTB', $request->id)->get()->first();
            
            $tb->TenKDau=\comm_functions::changeTitle($request->tentb);
            $tb->TenTB=$request->tentb;
            $tb->NSX=$request->nsx;
            $tb->NCU=$request->ncu;
            $tb->NgayNhap= \comm_functions::enDateFormatDateOnly($request->ngaynhap);
            $tb->ChucNang=$request->cn;
            $tb->TTTB=$request->tttb;
            $tb->DonGiaNhap=$request->dgn;
            $tb->IdPB=$request->pb;
            $tb->PhanLoai=$request->pl;
            
            $tb->save();

            event(new TTB($tb, 'sua'));

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

    public function postThem(Request $request){
        try{
            
            $tb=new thiet_bi_yt;
            $tb->IdTB= TTBController::TaoMaNN();
            $tb->TenKDau=\comm_functions::changeTitle($request->tentb);
            $tb->TenTB=$request->tentb;
            $tb->SoTB= TTBController::TaoSoTB();
            $tb->TinhTrangSD=0;
            $tb->NSX=$request->nsx;
            $tb->NCU=$request->ncu;
            $tb->NgayNhap= \comm_functions::enDateFormatDateOnly($request->ngaynhap);
            $tb->ChucNang=$request->cn;
            $tb->TTTB=$request->tttb;
            $tb->DonGiaNhap=$request->dgn;
            $tb->IdPB=$request->pb;
            $tb->PhanLoai=$request->pl;
            
            $tb->save();
            
            event(new TTB($tb, 'them'));

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
                    $tb= thiet_bi_yt::where("IdTB", $a)->get()->first();
                    $tb->delete();
                }
                
                event(new TTB($arr, 'xoa'));
                
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
                $tb= thiet_bi_yt::where("IdTB", $request->id)->get()->first();
                
                $tb->delete();
                
                event(new TTB($request->id, 'xoa'));
                
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
        $ds= thiet_bi_yt::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $t) {
                   if($t->IdTB == $ran){
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
    
    public static function TaoSoTB(){
        $ran = \comm_functions::BigRandomNumber(0001, 1000);
        $flag=TRUE;
        $ds= thiet_bi_yt::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $t) {
                   if($t->SoTB == $ran){
                        $ran= \comm_functions::BigRandomNumber(0001, 1000);
                        $flag=TRUE;
                        break;
                    }
                    else{
                        $flag=FALSE;
                    }  
                }
            }
        }

        return str_pad($ran, 4, 0, STR_PAD_LEFT); 
    }
    
    public function postTimKiem(Request $request){
        try{
            $key=$request->keyWords;
            $ds_ttb= DB::select("SELECT ttb.* FROM thiet_bi_yt AS ttb WHERE (ttb.`TenTB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (ttb.`NSX` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (ttb.`NCU` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(ttb.`NgayNhap`, '%d/%m/%Y') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (ttb.`ChucNang` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (ttb.`SoTB` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (ttb.`PhanLoai` LIKE N'%".\comm_functions::changeTitle($key)."%' COLLATE utf8_unicode_ci) OR (CASE WHEN ttb.`TTTB` = N'hoat_dong_tot' THEN N'Hoạt động tốt hdt' WHEN ttb.`TTTB` = N'hong_mot_phan' THEN N'Hỏng một phần hmp' ELSE N'Hỏng hoàn toàn' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY ttb.`TenTB` ASC");
            $dsttb = array();
            $sl=0;
            if(!empty($ds_ttb)){
                foreach ($ds_ttb as $ttb){
                    $tttb='Hoạt động tốt';
                    if($ttb->TTTB == 'hong_mot_phan'){
                        $tttb='Hỏng một phần';
                    }
                    else if($ttb->TTTB == 'hong_hoan_toan'){
                        $tttb='Hỏng hoàn toàn';
                    }
                    $ttt= array(
                        'id' => $ttb->IdTB,
                        'tentb' => $ttb->TenTB,
                        'nsx' => $ttb->NSX,
                        'ncu' => $ttb->NCU,
                        'ngaynhap' => date('d/m/Y', strtotime($ttb->NgayNhap)),
                        'pl' => \comm_functions::decodeLoaiTB($ttb->PhanLoai),
                        'dgn' => number_format($ttb->DonGiaNhap).' VNĐ',
                        'cn' => $ttb->ChucNang,
                        'sotb' => $ttb->SoTB,
                        'tttb' => $tttb,
                    );
                    
                    $dsttb[]=$ttt;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'tb'=>$dsttb,
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
    
    public function postLayDS(){
        try{
            $ds_tb= thiet_bi_yt::orderBy('TenTB', 'ASC')->get();
            $dsttb=array();
            foreach ($ds_tb as $ttb){
                $tttb='Hoạt động tốt';
                if($ttb->TTTB == 'hong_mot_phan'){
                    $tttb='Hỏng một phần';
                }
                else if($ttb->TTTB == 'hong_hoan_toan'){
                    $tttb='Hỏng hoàn toàn';
                }
                $ttt= array(
                    'id' => $ttb->IdTB,
                    'tentb' => $ttb->TenTB,
                    'nsx' => $ttb->NSX,
                    'ncu' => $ttb->NCU,
                    'ngaynhap' => date('d/m/Y', strtotime($ttb->NgayNhap)),
                    'pl' => \comm_functions::decodeLoaiTB($ttb->PhanLoai),
                    'dgn' => number_format($ttb->DonGiaNhap).' VNĐ',
                    'cn' => $ttb->ChucNang,
                    'sotb' => $ttb->SoTB,
                    'tttb' => $tttb,
                );

                $dsttb[]=$ttt;
            }
            $response = array(
                'msg' => 'tc',
                'tb'=>$dsttb
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

    public function postLayDSPB(Request $request){
        try{
            $khoa= khoa::where('IdKhoa', $request->id)->get()->first();
            $dsp='';
            foreach ($khoa->phongBan as $p){
                $dsp.='<option value="'.$p->IdPB.'">'.$p->TenPhong.'</option>';
            }
            $response = array(
                'msg' => 'tc',
                'ds'=>$dsp
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
