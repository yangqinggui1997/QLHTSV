<?php

namespace App\Http\Controllers\TiepDon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\TiepDon\TheBHYT;
use App\Models\TiepDon\benh_nhan;
use App\Models\HanhChinh\co_so_kham_bhyt;
use App\Models\HanhChinh\tinh_tp;
use App\Models\TiepDon\the_bhyt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class theBHYTController extends Controller
{
    //
    
    public function getDanhSach(){
        $thebhyt= the_bhyt::orderBy('created_at', 'DESC')->get();
        $dsbn= benh_nhan::orderBy('created_at', 'DESC')->get();
        $dsdoituong= \comm_functions::setDTK();
        $dsndkkcbbd= co_so_kham_bhyt::all();
        $dstinh= tinh_tp::orderBy('TenTinh', 'ASC')->get();
        return view("tiep_don.thong_tin_the_bhyt", ["thebhyt" => $thebhyt, "dsndkkcbbd" => $dsndkkcbbd, 'dsbn'=>$dsbn, 'dsdoituong'=>$dsdoituong, 'dstinh'=>$dstinh]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            $thebhyt= the_bhyt::where('IdTheBHYT',$request->id)->get()->first();
            
            $response=array(
                'hoten' => $thebhyt->benhNhan->HoTen,
                'mathe' => $thebhyt->IdTheBHYT,
                'ndk' => $thebhyt->coSoKhamBHYT->TenCS,
                'ngaydk' => date( "d/m/Y", strtotime($thebhyt->NgayDK)),
                'ngayhh' => date( "d/m/Y", strtotime($thebhyt->NgayHH)),
                'ngayhhsd' => date( "d/m/Y", strtotime($thebhyt->NgayHHDT)),
                'dt' => $thebhyt->DoiTuongBHYT,
                'mh'=>$thebhyt->BHYTHoTro
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
            $thebhyt= the_bhyt::where('IdTheBHYT',$request->id)->get()->first();
            $thebhyt->NgayDK=\comm_functions::enDateFormatDateOnly($request->ngaydk);
            $thebhyt->NgayHH=\comm_functions::enDateFormatDateOnly($request->ngayhh);
            $thebhyt->NgayHHDT=\comm_functions::enDateFormatDateOnly($request->ngayhhsd);
            $thebhyt->save();
            $response = array(
                'msg' => 'tc',
            );
            
            event(new TheBHYT($thebhyt, 'sua'));

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
            $msg="";
            $thebhyt= the_bhyt::where('IdBN',$request->hoten)->get()->first();
            $mathe= the_bhyt::where('IdTheBHYT',$request->dt.$request->mmh.$request->mt.str_pad($request->mathe, 10, 0, STR_PAD_LEFT))->get()->first();
            if(empty($thebhyt) && empty($mathe)){
                $thebhyt= new the_bhyt;
                $thebhyt->IdTheBHYT=$request->dt.$request->mmh.$request->mt.str_pad($request->mathe, 10, 0, STR_PAD_LEFT);
                $thebhyt->IdCSKBHYT=$request->ndk;
                $thebhyt->IdBN=$request->hoten;
                $thebhyt->NgayDK= \comm_functions::enDateFormatDateOnly($request->ngaydk);
                $thebhyt->NgayHH= \comm_functions::enDateFormatDateOnly($request->ngayhh);
                $thebhyt->NgayHHDT= \comm_functions::enDateFormatDateOnly($request->ngayhhsd);
                $thebhyt->DoiTuongBHYT= $request->dt;

                $thebhyt->BHYTHoTro= \comm_functions::getMucHuongDTK($request->dt);
                $thebhyt->save();
                $msg='tc';
                event(new TheBHYT($thebhyt, 'them'));
            }
            else{
                $msg='tontai';
            }
            
            $response = array(
                'msg' => $msg
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
            $arr_idthe_idbn=array();
            try{
                foreach ($arr as $a){
                    $thebhyt= the_bhyt::where("IdTheBHYT", $a)->get()->first();
                    $arr_idthe_idbn[]=['idthe'=>$thebhyt->IdTheBHYT, 'idbn'=>$thebhyt->IdBN];
                    $thebhyt->delete();
                }
                $response = array(
                    'msg' => 'tc',
                );

                event(new TheBHYT($arr_idthe_idbn, 'xoa'));

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
                $thebhyt= the_bhyt::where("IdTheBHYT", $request->id)->get()->first();
                $arr=['idthe'=>$thebhyt->IdTheBHYT, 'idbn'=>$thebhyt->IdBN];
                $thebhyt->delete();
                $response = array(
                    'msg' => 'tc',
                );

                event(new TheBHYT($arr, 'xoa'));

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

    public function postLayDSTBHYT(){
        try{
            $ds_thebhyt= the_bhyt::orderBy('created_at', 'DESC')->get();
            $dsthe = array();
            if(!empty($ds_thebhyt)){
                foreach ($ds_thebhyt as $the){
                    $ngaydk=date( "d/m/Y", strtotime($the->NgayDK));
                    $ngayhh=date( "d/m/Y", strtotime($the->NgayHH));
                    $ngayhhsd=date( "d/m/Y", strtotime($the->NgayHHDT));
                    $ttthe= array(
                        'hoten' => $the->benhNhan->HoTen,
                        'ngaydk' => $ngaydk,
                        'ngayhh' => $ngayhh,
                        'ngayhhsd' => $ngayhhsd,
                        'ndk' => $the->coSoKhamBHYT->TenCS,
                        'doituong' => \comm_functions::getDTK($the->DoiTuongBHYT),
                        'muchuong' => $the->BHYTHoTro,
                        'id' => $the->IdTheBHYT,
                        'idbn' => $the->IdBN
                    );
                    $dsthe[]=$ttthe;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'thebhyt'=>$dsthe,
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
        $sql="";
        $arr=array();
        if($request->hoten == 'all'){
            $arr[]='all';
        }
        else{
            $arr[]='notall';
        }
        if($request->ndk == 'all'){
           $arr[]='all';
        }
        else{
            $arr[]='notall';
        }
        if($request->dt == 'all'){
           $arr[]='all';
        }
        else{
            $arr[]='notall';
        }
        switch($arr){
            //#exclude_1
            case ['all','notall','notall']: $sql="SELECT tbh.*, csk.`TenCS`, bn.`HoTen` FROM the_bhyt AS tbh JOIN benh_nhan AS bn ON tbh.`IdBN` = bn.`IdBN` JOIN co_so_kham_bhyt AS csk ON tbh.`IdCSKBHYT` = csk.`IdCSKBHYT` WHERE tbh.IdCSKBHYT = N'".$request->ndk."' COLLATE utf8_unicode_ci AND tbh.DoiTuongBHYT = N'".$request->dt."' COLLATE utf8_unicode_ci ORDER BY tbh.created_at DESC";break;

            case ['notall','all','notall']: $sql="SELECT tbh.*, csk.`TenCS`, bn.`HoTen` FROM the_bhyt AS tbh JOIN benh_nhan AS bn ON tbh.`IdBN` = bn.`IdBN` JOIN co_so_kham_bhyt AS csk ON tbh.`IdCSKBHYT` = csk.`IdCSKBHYT` WHERE tbh.IdBN = N'".$request->hoten."' COLLATE utf8_unicode_ci AND tbh.DoiTuongBHYT = N'".$request->dt."' COLLATE utf8_unicode_ci ORDER BY tbh.created_at DESC";break;

            case ['notall','notall','all']: $sql="SELECT tbh.*, csk.`TenCS`, bn.`HoTen` FROM the_bhyt AS tbh JOIN benh_nhan AS bn ON tbh.`IdBN` = bn.`IdBN` JOIN co_so_kham_bhyt AS csk ON tbh.`IdCSKBHYT` = csk.`IdCSKBHYT` WHERE tbh.IdBN = N'".$request->hoten."' COLLATE utf8_unicode_ci AND tbh.IdCSKBHYT = N'".$request->ndk."' COLLATE utf8_unicode_ci ORDER BY tbh.created_at DESC";break;

            //#explode 2
            case ['all','all','notall']: $sql="SELECT tbh.*, csk.`TenCS`, bn.`HoTen` FROM the_bhyt AS tbh JOIN benh_nhan AS bn ON tbh.`IdBN` = bn.`IdBN` JOIN co_so_kham_bhyt AS csk ON tbh.`IdCSKBHYT` = csk.`IdCSKBHYT` WHERE tbh.DoiTuongBHYT = N'".$request->dt."' COLLATE utf8_unicode_ci ORDER BY tbh.created_at DESC";break;

            case ['all','notall','all']: $sql="SELECT tbh.*, csk.`TenCS`, bn.`HoTen` FROM the_bhyt AS tbh JOIN benh_nhan AS bn ON tbh.`IdBN` = bn.`IdBN` JOIN co_so_kham_bhyt AS csk ON tbh.`IdCSKBHYT` = csk.`IdCSKBHYT` WHERE tbh.IdCSKBHYT = N'".$request->ndk."' COLLATE utf8_unicode_ci ORDER BY tbh.created_at DESC";break;

            case ['notall','all','all']: $sql="SELECT tbh.*, csk.`TenCS`, bn.`HoTen` FROM the_bhyt AS tbh JOIN benh_nhan AS bn ON tbh.`IdBN` = bn.`IdBN` JOIN co_so_kham_bhyt AS csk ON tbh.`IdCSKBHYT` = csk.`IdCSKBHYT` WHERE tbh.IdBN = N'".$request->hoten."' COLLATE utf8_unicode_ci ORDER BY tbh.created_at DESC";break;

            //#3
            case ['notall','notall','notall']: $sql="SELECT tbh.*, csk.`TenCS`, bn.`HoTen` FROM the_bhyt AS tbh JOIN benh_nhan AS bn ON tbh.`IdBN` = bn.`IdBN` JOIN co_so_kham_bhyt AS csk ON tbh.`IdCSKBHYT` = csk.`IdCSKBHYT` WHERE tbh.IdBN = N'".$request->hoten."' COLLATE utf8_unicode_ci AND tbh.IdCSKBHYT = N'".$request->ndk."' COLLATE utf8_unicode_ci AND tbh.DoiTuongBHYT = N'".$request->dt."' COLLATE utf8_unicode_ci ORDER BY tbh.created_at DESC";break;

            //explode 3
            default: $sql="SELECT tbh.*, csk.`TenCS`, bn.`HoTen` FROM the_bhyt AS tbh JOIN benh_nhan AS bn ON tbh.`IdBN` = bn.`IdBN` JOIN co_so_kham_bhyt AS csk ON tbh.`IdCSKBHYT` = csk.`IdCSKBHYT` ORDER BY tbh.created_at DESC";break;
        }
        
        try{
            $ds_thbhyt= DB::select($sql);
            $dsthe = array();
            $sl=0;
            if(!empty($ds_thbhyt)){
                foreach ($ds_thbhyt as $the){
                    $ngaydk=date( "d/m/Y", strtotime($the->NgayDK));
                    $ngayhh=date( "d/m/Y", strtotime($the->NgayHH));
                    $ngayhhsd=date( "d/m/Y", strtotime($the->NgayHHDT));
                    $ttthe= array(
                        'hoten' => $the->HoTen,
                        'ngaydk' => $ngaydk,
                        'ngayhh' => $ngayhh,
                        'ngayhhsd' => $ngayhhsd,
                        'ndk' => $the->TenCS,
                        'doituong' => \comm_functions::getDTK($the->DoiTuongBHYT),
                        'muchuong' => $the->BHYTHoTro,
                        'id' => $the->IdTheBHYT,
                        'idbn' => $the->IdBN
                    );
                    $dsthe[]=$ttthe;
                    $sl++;
                }
            }

            $response = array(
                'msg' => 'tc',
                'thebhyt'=>$dsthe,
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
}
