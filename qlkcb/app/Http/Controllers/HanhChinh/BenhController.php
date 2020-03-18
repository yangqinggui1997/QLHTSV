<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\khoa;
use App\Models\HanhChinh\thong_ke;
use App\Models\HanhChinh\danh_muc_benh;
use App\Models\HanhChinh\danh_muc_benh_vs_khoa;
use App\Events\HanhChinh\Benh;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class BenhController extends Controller
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
        $dsbenh= danh_muc_benh::orderBy('TenBenh', 'ASC')->get();
        return view("hanh_chinh.quan_ly_danh_muc_benh",["dskhoa"=>$dskhoa, 'dsbenh'=>$dsbenh, 'dsbc'=>$sl]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            $benh= danh_muc_benh::where('IdBenh',$request->id)->get()->first();
            
            $khoa=array();
            foreach ($benh->khoa as $k) {
                $khoa[]=['id'=>$k->khoa->IdKhoa, 'name'=>$k->khoa->TenKhoa];
            }
//            
            $response=array(
                'id' => $benh->IdBenh,
                'tenbenh' => $benh->TenBenh,
                'ngayph' => date('d/m/Y', strtotime($benh->NgayPH)),
                'chungvsgb' => $benh->ChungVSGayBenh,
                'chungvskb' => $benh->ChungKhang,
                'trieuchung' => $benh->TrieuChungLS,
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
            $dsbenh= danh_muc_benh::where('IdBenh', $request->mabenh)->get()->first();
            $benh= danh_muc_benh::where('IdBenh', $request->id)->get()->first();
            
            if($request->id != $request->mabenh){
                if(is_object($dsbenh)){
                    $response = array(
                        'msg' => 'trungma',
                    );
                    return response()->json($response); 
                }
                else{
                    $b=danh_muc_benh::where('TenKDau', \comm_functions::changeTitle($request->tenbenh))->get()->first();
                    if(is_object($b)){
                        if($request->id != $b->IdBenh){
                            $response = array(
                                'msg' => 'trungten',
                            );
                            return response()->json($response); 
                        }
                    }
                }
                $benh->delete();
                
                $b=new danh_muc_benh;
                $b->IdBenh=$request->mabenh;
                $b->TenKDau=\comm_functions::changeTitle($request->tenbenh);
                $b->TenBenh=$request->tenbenh;
                $b->NgayPH= \comm_functions::enDateFormatDateOnly($request->ngayph);
                $b->ChungVSGayBenh=$request->chungvsgb;
                $b->TrieuChungLS=$request->trieuchung;
                $b->ChungKhang=$request->chungvskb;

                $b->save();
                
                if(strpos($request->khoa, ',')){
                    $arr= explode(',',$request->khoa);

                    foreach($arr as $value) {
                        $khoa= new danh_muc_benh_vs_khoa;
                        $khoa->IdKhoa=$value;
                        $khoa->IdBenh=$request->mabenh;
                        $khoa->save();
                    }
                }
                else{
                    $khoa= new danh_muc_benh_vs_khoa;
                    $khoa->IdKhoa=$request->khoa;
                    $khoa->IdBenh=$request->mabenh;
                    $khoa->save();
                }
                
                event(new Benh($b, 'sua', $request->id));

                $response = array(
                    'msg' => 'tc',
                );
                return response()->json($response); 
            }
            else{
                $b=danh_muc_benh::where('TenKDau', \comm_functions::changeTitle($request->tenbenh))->get()->first();
                if(is_object($b)){
                    if($request->id != $b->IdBenh){
                        $response = array(
                            'msg' => 'trungten',
                        );
                        return response()->json($response); 
                    }
                }
            }
            
            
            $benh->TenKDau=\comm_functions::changeTitle($request->tenbenh);
            $benh->TenBenh=$request->tenbenh;
            $benh->NgayPH= \comm_functions::enDateFormatDateOnly($request->ngayph);
            $benh->ChungVSGayBenh=$request->chungvsgb;
            $benh->TrieuChungLS=$request->trieuchung;
            $benh->ChungKhang=$request->chungvskb;
            
            $benh->save();
            
            $dskhoa= danh_muc_benh_vs_khoa::where('IdBenh', $request->id)->get();
            foreach ($dskhoa as $value) {
                $value->delete();
            }
            
            if(strpos($request->khoa, ',')){
                $arr= explode(',',$request->khoa);
                
                foreach($arr as $value) {
                    $khoa= new danh_muc_benh_vs_khoa;
                    $khoa->IdKhoa=$value;
                    $khoa->IdBenh=$request->id;
                    $khoa->save();
                }
            }
            else{
                $khoa= new danh_muc_benh_vs_khoa;
                $khoa->IdKhoa=$request->khoa;
                $khoa->IdBenh=$request->id;
                $khoa->save();
            }
            
            event(new Benh($benh, 'sua'));

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
            $dsbenh= danh_muc_benh::where('IdBenh', $request->mabenh)->get()->first();
            if(is_object($dsbenh)){
                $response = array(
                    'msg' => 'trungma',
                );
                return response()->json($response); 
            }
            else{
                $b=danh_muc_benh::where('TenKDau', \comm_functions::changeTitle($request->tenbenh))->get()->first();
                if(is_object($b)){
                    $response = array(
                        'msg' => 'trungten',
                    );
                    return response()->json($response); 
                }
            
            }
            
            $benh=new danh_muc_benh;
            $benh->IdBenh=$request->mabenh;
            $benh->TenKDau=\comm_functions::changeTitle($request->tenbenh);
            $benh->TenBenh=$request->tenbenh;
            $benh->NgayPH= \comm_functions::enDateFormatDateOnly($request->ngayph);
            $benh->ChungVSGayBenh=$request->chungvsgb;
            $benh->TrieuChungLS=$request->trieuchung;
            $benh->ChungKhang=$request->chungvskb;
            $benh->save();
            
            if(strpos($request->khoa, ',')){
                $arr= explode(',',$request->khoa);
                
                foreach($arr as $value) {
                    $khoa= new danh_muc_benh_vs_khoa;
                    $khoa->IdKhoa=$value;
                    $khoa->IdBenh=$benh->IdBenh;
                    $khoa->save();
                }
            }
            else{
                $khoa= new danh_muc_benh_vs_khoa;
                $khoa->IdKhoa=$request->khoa;
                $khoa->IdBenh=$benh->IdBenh;
                $khoa->save();
            }
            
            event(new Benh($benh, 'them'));

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
                    $benh= danh_muc_benh::where("IdBenh", $a)->get()->first();
                    $benh->delete();
                }
               
                event(new Benh($arr, 'xoa'));
                
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
                $benh= danh_muc_benh::where("IdBenh", $request->id)->get()->first();
                
                $benh->delete();
                
                event(new Benh($request->id, 'xoa'));
                
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
            $ds_benh= DB::select("SELECT dmb.* FROM danh_muc_benh AS dmb WHERE (dmb.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmb.`ChungVSGayBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmb.`TrieuChungLS` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmb.`ChungKhang` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(dmb.`NgayPH`, '%d/%m/%Y') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY dmb.`TenBenh` ASC");
            $dsbenh = array();
            $sl=0;
            if(!empty($ds_benh)){
                foreach ($ds_benh as $benh){
                    $ttb= array(
                        'id' => $benh->IdBenh,
                        'tenbenh' => $benh->TenBenh,
                        'ngayph' => date('d/m/Y', strtotime($benh->NgayPH)),
                        'chungvsgb' => $benh->ChungVSGayBenh,
                        'trieuchung' => $benh->TrieuChungLS,
                        'chungvskb' => $benh->ChungKhang,
                    );
                    
                    $dsbenh[]=$ttb;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'benh'=>$dsbenh,
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
            $ds_benh= danh_muc_benh::orderBy('TenBenh', 'ASC')->get();
            $dsbenh=array();
            foreach ($ds_benh as $benh){
                $ttb= array(
                    'id' => $benh->IdBenh,
                    'tenbenh' => $benh->TenBenh,
                    'ngayph' => date('d/m/Y', strtotime($benh->NgayPH)),
                    'chungvsgb' => $benh->ChungVSGayBenh,
                    'trieuchung' => $benh->TrieuChungLS,
                    'chungvskb' => $benh->ChungKhang,
                );
                    
                $dsbenh[]=$ttb;
            }
            $response = array(
                'msg' => 'tc',
                'benh'=>$dsbenh
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
