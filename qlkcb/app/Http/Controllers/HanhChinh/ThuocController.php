<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\khoa;
use App\Models\HanhChinh\danh_muc_benh;
use App\Models\HanhChinh\danh_muc_thuoc;
use App\Models\HanhChinh\danh_muc_benh_vs_thuoc;
use App\Events\HanhChinh\Thuoc;
use App\Models\HanhChinh\thong_ke;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class ThuocController extends Controller
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
        $dsbenh= danh_muc_benh::orderBy('TenBenh', 'ASC')->get();
        $dsthuoc= danh_muc_thuoc::orderBy('TenThuoc', 'ASC')->get();
        return view("hanh_chinh.quan_ly_duoc",["dsbenh"=>$dsbenh, 'dsthuoc'=>$dsthuoc, 'dsbc'=>$sl]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            $thuoc= danh_muc_thuoc::where('IdThuoc',$request->id)->get()->first();
            
            $benh=array();
            foreach ($thuoc->benhVSThuoc as $b) {
                $benh[]=['id'=>$b->danhMucBenh->IdBenh, 'name'=>$b->danhMucBenh->TenBenh];
            }
            
            $response=array(
                'tenthuoc' => $thuoc->TenThuoc,
                'nsx' => $thuoc->NSX,
                'ncu' => $thuoc->NCU,
                'ngaysx' => date('d/m/Y', strtotime($thuoc->NgaySX)),
                'ngayhh' => date('d/m/Y', strtotime($thuoc->NgayHH)),
                'pl' => $thuoc->PhanLoai,
                'sl' => $thuoc->SL,
                'dvt' => $thuoc->DonViTinh,
                'dgn' => $thuoc->DonGiaNhap,
                'dgb' => $thuoc->DonGiaBan,
                'ccd' => $thuoc->ChongChiDinh,
                'tphc' => $thuoc->ThanhPhan,
                'dmbhyt' => $thuoc->DanhMucBHYT,
                'ptbhyt' => $thuoc->BHYTTT,
                'benh'=>$benh,
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
            $thuoc= danh_muc_thuoc::where('IdThuoc', $request->id)->get()->first();
            $t= danh_muc_thuoc::where('TenKDau', \comm_functions::changeTitle($request->tenthuoc))->get()->first();
            if(is_object($t)){
                if($thuoc->IdThuoc != $t->IdThuoc){
                    $response = array(
                        'msg' => 'trungten',
                    );
                    return response()->json($response); 
                }
            }

            $thuoc->TenKDau=\comm_functions::changeTitle($request->tenthuoc);
            $thuoc->TenThuoc=$request->tenthuoc;
            $thuoc->NSX=$request->nsx;
            $thuoc->NCU=$request->ncu;
            $thuoc->NgaySX= \comm_functions::enDateFormatDateOnly($request->ngaysx);
            $thuoc->NgayHH= \comm_functions::enDateFormatDateOnly($request->ngayhh);
            $thuoc->SL=$request->sl;
            $thuoc->DonViTinh=$request->dvt;
            $thuoc->DonGiaNhap=$request->dgn;
            $thuoc->DonGiaBan=$request->dgb;
            $thuoc->ChongChiDinh=$request->ccd;
            $thuoc->ThanhPhan=$request->tphc;
            $thuoc->PhanLoai=$request->pl;
            $thuoc->DanhMucBHYT=$request->dmbhyt;
            if($request->ptbhyt != ''){
                $thuoc->BHYTTT=$request->ptbhyt;
            }
            
            $thuoc->save();
            
            $dsbenh= danh_muc_benh_vs_thuoc::where('IdThuoc', $request->id)->get();
            foreach ($dsbenh as $value) {
                $value->delete();
            }
            
            if(strpos($request->benh, ',')){
                $arr= explode(',',$request->benh);
                
                foreach($arr as $value) {
                    $benh= new danh_muc_benh_vs_thuoc;
                    $benh->IdBenh=$value;
                    $benh->IdThuoc=$request->id;
                    $benh->save();
                }
            }
            else{
                $benh= new danh_muc_benh_vs_thuoc;
                $benh->IdBenh=$request->benh;
                $benh->IdThuoc=$request->id;
                $benh->save();
            }
            
            event(new Thuoc($thuoc, 'sua'));

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
            $t= danh_muc_thuoc::where('TenKDau', \comm_functions::changeTitle($request->tenthuoc))->get()->first();
            if(is_object($t)){
                $response = array(
                    'msg' => 'trungten',
                );
                return response()->json($response); 
            }
            $thuoc=new danh_muc_thuoc;
            $thuoc->IdThuoc= ThuocController::TaoMaNN();
            $thuoc->TenKDau=\comm_functions::changeTitle($request->tenthuoc);
            $thuoc->TenThuoc=$request->tenthuoc;
            $thuoc->NSX=$request->nsx;
            $thuoc->NCU=$request->ncu;
            $thuoc->NgaySX= \comm_functions::enDateFormatDateOnly($request->ngaysx);
            $thuoc->NgayHH= \comm_functions::enDateFormatDateOnly($request->ngayhh);
            $thuoc->SL=$request->sl;
            $thuoc->DonViTinh=$request->dvt;
            $thuoc->DonGiaNhap=$request->dgn;
            $thuoc->DonGiaBan=$request->dgb;
            $thuoc->ChongChiDinh=$request->ccd;
            $thuoc->ThanhPhan=$request->tphc;
            $thuoc->PhanLoai=$request->pl;
            $thuoc->DanhMucBHYT=$request->dmbhyt;
            $thuoc->BHYTTT=0;
            if($request->ptbhyt != ''){
                $thuoc->BHYTTT=$request->ptbhyt;
            }
            $thuoc->save();

            if(strpos($request->benh, ',')){
                $arr= explode(',',$request->benh);
                
                foreach($arr as $value) {
                    $benh= new danh_muc_benh_vs_thuoc;
                    $benh->IdBenh=$value;
                    $benh->IdThuoc=$thuoc->IdThuoc;
                    $benh->save();
                }
            }
            else{
                $benh= new danh_muc_benh_vs_thuoc;
                $benh->IdBenh=$request->benh;
                $benh->IdThuoc=$thuoc->IdThuoc;
                $benh->save();
            }
            event(new Thuoc($thuoc, 'them'));

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
                    $thuoc= danh_muc_thuoc::where("IdThuoc", $a)->get()->first();
                    $thuoc->delete();
                }
                
                event(new Thuoc($arr, 'xoa'));
                
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
                $thuoc= danh_muc_thuoc::where("IdThuoc", $request->id)->get()->first();
                
                $thuoc->delete();
                
                event(new Thuoc($request->id, 'xoa'));
                
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
        $ds= danh_muc_thuoc::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $t) {
                   if($t->IdThuoc == $ran){
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
            $ds_thuoc= DB::select("SELECT dmt.* FROM danh_muc_thuoc AS dmt WHERE (dmt.`TenThuoc` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmt.`NSX` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmt.`NCU` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(dmt.`NgaySX`, '%d/%m/%Y') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(dmt.`NgayHH`, '%d/%m/%Y') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmt.`ChongChiDinh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmt.`ThanhPhan` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmt.`PhanLoai` LIKE N'%".\comm_functions::changeTitle($key)."%' COLLATE utf8_unicode_ci) OR (dmt.`DonViTinh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN dmt.`DanhMucBHYT` = 0 THEN N'Không' ELSE N'BHYT danh mục bào hiểm y tế dmbhyt' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY dmt.`TenThuoc` ASC");
            $dsthuoc = array();
            $sl=0;
            if(!empty($ds_thuoc)){
                foreach ($ds_thuoc as $thuoc){
                    $dmbh='Có';
                    if($thuoc->DanhMucBHYT == 0){
                        $dmbh='Không';
                    }

                    $ttt= array(
                        'id' => $thuoc->IdThuoc,
                        'tenthuoc' => $thuoc->TenThuoc,
                        'nsx' => $thuoc->NSX,
                        'ncu' => $thuoc->NCU,
                        'ngaysx' => date('d/m/Y', strtotime($thuoc->NgaySX)),
                        'ngayhh' =>date('d/m/Y', strtotime( $thuoc->NgayHH)),
                        'sl' => number_format($thuoc->SL),
                        'dvt' => $thuoc->DonViTinh,
                        'dgn' => number_format($thuoc->DonGiaNhap).' VNĐ',
                        'dgb' => number_format($thuoc->DonGiaBan).' VNĐ',
                        'dmbhyt' => $dmbh,
                        'ptbhyt' => $thuoc->BHYTTT.'%',
                    );
                    
                    $dsthuoc[]=$ttt;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'thuoc'=>$dsthuoc,
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
            $ds_thuoc= danh_muc_thuoc::orderBy('TenThuoc', 'ASC')->get();
            $dsthuoc=array();
            foreach ($ds_thuoc as $thuoc){
                $dmbh='Có';
                if($thuoc->DanhMucBHYT == 0){
                    $dmbh='Không';
                }
                $ttt= array(
                    'id' => $thuoc->IdThuoc,
                    'tenthuoc' => $thuoc->TenThuoc,
                    'nsx' => $thuoc->NSX,
                    'ncu' => $thuoc->NCU,
                    'ngaysx' => date('d/m/Y', strtotime($thuoc->NgaySX)),
                    'ngayhh' =>date('d/m/Y', strtotime( $thuoc->NgayHH)),
                    'sl' => number_format($thuoc->SL),
                    'dvt' => $thuoc->DonViTinh,
                    'dgn' => number_format($thuoc->DonGiaNhap).' VNĐ',
                    'dgb' => number_format($thuoc->DonGiaBan).' VNĐ',
                    'dmbhyt' => $dmbh,
                    'ptbhyt' => $thuoc->BHYTTT.'%',
                );

                $dsthuoc[]=$ttt;
            }
            $response = array(
                'msg' => 'tc',
                'thuoc'=>$dsthuoc
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
