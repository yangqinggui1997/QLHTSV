<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\khoa;
use App\Models\HanhChinh\thong_ke;
use App\Models\HanhChinh\danh_muc_cls_vs_khoa;
use App\Models\HanhChinh\danh_muc_cls;
use App\Events\HanhChinh\DMKT;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class DMKTController extends Controller
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
        $dskhoa= khoa::where('KhoaKham', 1)->orderBy('TenKhoa', 'ASC')->get();
        $dsdmkt= danh_muc_cls::orderBy('PhanLoai', 'ASC')->orderBy('TenCLS', 'ASC')->get();
        return view("hanh_chinh.quan_ly_danh_muc_ky_thuat",["dskhoa"=>$dskhoa, 'dsdmkt'=>$dsdmkt, 'dsbc'=>$sl]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            $dmkt= danh_muc_cls::where('IdDMCLS',$request->id)->get()->first();
            
            $khoa=array();
            foreach ($dmkt->khoa as $k) {
                $khoa[]=['id'=>$k->khoa->IdKhoa, 'name'=>$k->khoa->TenKhoa];
            }
            
            $response=array(
                'tendmkt' => $dmkt->TenCLS,
                'dg' => $dmkt->DonGia,
                'pldm' => $dmkt->PhanLoai,
                'pldv' => $dmkt->TenKDau,
                'dmbhyt' => $dmkt->DanhMucBHYT,
                'ptbhyt' => $dmkt->BHYTTT,
                'khoa'=>$khoa,
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
            $dmkt= danh_muc_cls::where('IdDMCLS', $request->id)->get()->first();
            $t= danh_muc_cls::where('TenCLS', $request->tendmkt)->get()->first();
            if(is_object($t)){
                if($dmkt->IdDMCLS != $t->IdDMCLS){
                    $response = array(
                        'msg' => 'trungten',
                    );
                    return response()->json($response); 
                }
            }

            $dmkt->TenCLS=$request->tendmkt;
            
            $dmkt->DonGia=$request->dg;
            $dmkt->PhanLoai=$request->pl;
            $dmkt->DanhMucBHYT=$request->dmbhyt;
            
            if($request->pl=='can_lam_sang'){
                $dmkt->TenKDau=$request->pldv;
            }
            else{
                $dmkt->TenKDau=\comm_functions::changeTitle($request->tendmkt);
            }

            if($request->ptbhyt != ''){
                $dmkt->BHYTTT=$request->ptbhyt;
            }
            else{
                $dmkt->BHYTTT=0;
            }

            $dmkt->save();
            
            $dskhoa= danh_muc_cls_vs_khoa::where('IdDMCLS', $request->id)->get();
            foreach ($dskhoa as $value) {
                $value->delete();
            }
            
            if(strpos($request->khoa, ',')){
                $arr= explode(',',$request->khoa);
                
                foreach($arr as $value) {
                    $khoa= new danh_muc_cls_vs_khoa;
                    $khoa->IdKhoa=$value;
                    $khoa->IdDMCLS=$request->id;
                    $khoa->save();
                }
            }
            else{
                $khoa= new danh_muc_cls_vs_khoa;
                $khoa->IdKhoa=$request->khoa;
                $khoa->IdDMCLS=$request->id;
                $khoa->save();
            }
            
            event(new DMKT($dmkt, 'sua'));

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
            $t= danh_muc_cls::where('TenCLS', $request->tendmkt)->get()->first();
            if(is_object($t)){
                $response = array(
                    'msg' => 'trungten',
                );
                return response()->json($response); 
            }
            $dmkt=new danh_muc_cls;
            $dmkt->IdDMCLS= DMKTController::TaoMaNN();
            
            if($request->pl=='can_lam_sang'){
                $dmkt->TenKDau=$request->pldv;
            }
            else{
                $dmkt->TenKDau=\comm_functions::changeTitle($request->tendmkt);
            }
            
            if($request->ptbhyt != ''){
                $dmkt->BHYTTT=$request->ptbhyt;
            }
            else{
                $dmkt->BHYTTT=0;
            }

            $dmkt->TenCLS=$request->tendmkt;
            $dmkt->DonGia=$request->dg;
            $dmkt->PhanLoai=$request->pl;
            $dmkt->DanhMucBHYT=$request->dmbhyt;
            
            $dmkt->save();
            
            if(strpos($request->khoa, ',')){
                $arr= explode(',',$request->khoa);
                
                foreach($arr as $value) {
                    $khoa= new danh_muc_cls_vs_khoa;
                    $khoa->IdKhoa=$value;
                    $khoa->IdDMCLS=$dmkt->IdDMCLS;
                    $khoa->save();
                }
            }
            else{
                $khoa= new danh_muc_cls_vs_khoa;
                $khoa->IdKhoa=$request->khoa;
                $khoa->IdDMCLS=$dmkt->IdDMCLS;
                $khoa->save();
            }
            
            event(new DMKT($dmkt, 'them'));

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
                    $dmkt= danh_muc_cls::where("IdDMCLS", $a)->get()->first();
                    $dmkt->delete();
                }
                
                event(new DMKT($arr, 'xoa'));
                
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
                $dmkt= danh_muc_cls::where("IdDMCLS", $request->id)->get()->first();
                
                $dmkt->delete();
                
                event(new DMKT($request->id, 'xoa'));
                
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
        $ds= danh_muc_cls::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $t) {
                   if($t->IdDMCLS == $ran){
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
            $ds_dmkt= DB::select("SELECT dmkt.* FROM danh_muc_cls AS dmkt WHERE (dmkt.`TenCLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN dmkt.`PhanLoai` = N'can_lam_sang' THEN N'Cận lâm sàng cls' WHEN dmkt.`PhanLoai` = N'thu_thuat' THEN N'Thủ thuật (tiểu phẩu) tt-tp' ELSE N'Phẫu thuật pt' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN dmkt.`DanhMucBHYT` = 0 THEN N'Không' ELSE N'BHYT danh mục bào hiểm y tế dmbhyt' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY dmkt.`PhanLoai` ASC, dmkt.`TenCLS` ASC");
            $dsdmkt = array();
            $sl=0;
            if(!empty($ds_dmkt)){
                foreach ($ds_dmkt as $dmkt){
                    $pl='Cận lâm sàng';
                    if($dmkt->PhanLoai == 'thu_thuat'){
                        $pl='Thủ thuật';
                    }
                    else if($dmkt->PhanLoai == 'phau_thuat'){
                        $pl='Phẫu thuật';
                    }
                    $dm='Có';
                    if($dmkt->DanhMucBHYT == 0){
                        $dm='Không';
                    }
                    $ttt= array(
                        'id' => $dmkt->IdDMCLS,
                        'tendm' => $dmkt->TenCLS,
                        'dg' => number_format($dmkt->DonGia).' VNĐ' ,
                        'pl' => $pl,
                        'dmbhyt' => $dm,
                        'ptbhyt' => $dmkt->BHYTTT.'%'
                    );
                    
                    $dsdmkt[]=$ttt;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dmkt'=>$dsdmkt,
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
            $ds_dmkt= danh_muc_cls::orderBy('PhanLoai', 'ASC')->orderBy('TenCLS', 'ASC')->get();
            $dsdmkt=array();
            foreach ($ds_dmkt as $dmkt){
                $pl='Cận lâm sàng';
                if($dmkt->PhanLoai == 'thu_thuat'){
                    $pl='Thủ thuật';
                }
                else if($dmkt->PhanLoai == 'phau_thuat'){
                    $pl='Phẫu thuật';
                }
                $dm='Có';
                if($dmkt->DanhMucBHYT == 0){
                    $dm='Không';
                }
                $ttt= array(
                    'id' => $dmkt->IdDMCLS,
                    'tendm' => $dmkt->TenCLS,
                    'dg' => number_format($dmkt->DonGia).' VNĐ',
                    'pl' => $pl,
                    'dmbhyt' => $dm,
                    'ptbhyt' => $dmkt->BHYTTT.'%'
                );

                $dsdmkt[]=$ttt;
            }
            $response = array(
                'msg' => 'tc',
                'dmkt'=>$dsdmkt
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
