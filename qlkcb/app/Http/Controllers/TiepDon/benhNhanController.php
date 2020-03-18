<?php

namespace App\Http\Controllers\TiepDon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TiepDon\benh_nhan;
use App\Models\HanhChinh\tinh_tp;
use App\Models\HanhChinh\quan_huyen;
use App\Models\HanhChinh\phuong_xa;
use App\Events\TiepDon\BenhNhan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class benhNhanController extends Controller
{
    //
    
    public function getDanhSach(){
        $benhnhan= benh_nhan::orderBy('created_at', 'DESC')->get();
        $tinh= tinh_tp::orderBy('TenTinh', 'ASC')->get();
        $dsdantoc= \comm_functions::setDanToc();
        return view("tiep_don.thong_tin_benh_nhan",["benhnhan"=>$benhnhan, "dsdantoc"=>$dsdantoc, "dstinh" => $tinh]);
    }
    
    public function postHuyen(Request $request){
        $huyen= quan_huyen::where('IdTinh',$request->idtinh)->get();
        $kq="";
        foreach ($huyen as $t) {
            $kq.='<option value="'.$t->IdHuyen.'">'.$t->TenHuyen.'</option>';
        }
        
        $response = array(
            'msg' => $kq,
        );
        return response()->json($response); 

    }
    
    public function postXa(Request $request){
        $xa= phuong_xa::where('IdHuyen',$request->idhuyen)->get();
        $kq="";
        foreach ($xa as $t) {
            $kq.='<option value="'.$t->IdXa.'">'.$t->TenXa.'</option>';
        }
        
        $response = array(
            'msg' => $kq,
        );
        return response()->json($response); 

    }
    
    public function postLayTTCN(Request $request){
        try{
            $benhnhan= benh_nhan::where('IdBN',$request->id)->get()->first();
            $xa= phuong_xa::where('IdXa', $benhnhan->IdXa)->get()->first();
            $huyen= quan_huyen::where('IdHuyen',$xa->IdHuyen)->get()->first();
            $all_tinh= tinh_tp::all();
            $h="";$t="";$x="";
            $all_xa=phuong_xa::all();
            $all_huyen= quan_huyen::all();
            foreach ($all_xa as $value) {
                if($benhnhan->IdXa == $value->IdXa){
                    $x.='<option selected="" value="'.$value->IdXa.'">'.$value->TenXa.'</option>';
                }else{
                    $x.='<option value="'.$value->IdXa.'">'.$value->TenXa.'</option>';
                }
            }
            foreach ($all_huyen as $value) {
                if($xa->IdHuyen == $value->IdHuyen){
                    $h.='<option selected="" value="'.$value->IdHuyen.'">'.$value->TenHuyen.'</option>';
                }else{
                    $h.='<option value="'.$value->IdHuyen.'">'.$value->TenHuyen.'</option>';
                }
            }
            foreach ($all_tinh as $value) {
                if($huyen->IdTinh == $value->IdTinh){
                    $t.='<option selected="" value="'.$value->IdTinh.'">'.$value->TenTinh.'</option>';
                }else{
                    $t.='<option value="'.$value->IdTinh.'">'.$value->TenTinh.'</option>';
                }
            }
            $response=array(
                'hoten' => $benhnhan->HoTen,
                'ngaysinh' => \comm_functions::deDateFormatForUpdate($benhnhan->NgaySinh),
                'gt' => $benhnhan->GioiTinh,
                'scmnd' => $benhnhan->SoCMND,
                'sdt' => $benhnhan->SDT,
                'diachi' => $benhnhan->DiaChi,
                'dantoc' => $benhnhan->DanToc,
                'x' => $x,
                'h' => $h,
                't' => $t           
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
            $benhnhan= benh_nhan::where('IdBN',$request->id)->get()->first();
            $benhnhan->HoTen=$request->hoten;
            $benhnhan->IdXa=$request->xa;
            $benhnhan->NgaySinh= \comm_functions::enDateFormat($request->ngaysinh);
            $benhnhan->GioiTinh=$request->gt;
            $benhnhan->SoCMND=$request->scmnd;
            $benhnhan->SDT=$request->sdt;
            $benhnhan->DiaChi=$request->diachi;
            $benhnhan->DanToc= $request->dantoc;
            $msg="";
            if($request->hasFile('file')){
                $file=$request->file('file');
                $duoi=$file->getClientOriginalExtension();
                if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg'){
                    $benhnhan->save();
                    $msg="ko_ho_tro_kieu_file";
                }
                else{
                    $name=$file->getClientOriginalName();
                    $hinh=str_random(4)."_".$name;
                    while(file_exists('public/upload/anhbn/'.$hinh)){
                        $hinh=str_random(4)."_".$name;
                    }
                    if($benhnhan->Anh != '' && file_exists("public/upload/anhbn/".$benhnhan->Anh)){
                        unlink("public/upload/anhbn/".$benhnhan->Anh);
                    }
                    
                    $file->move('public/upload/anhbn/',$hinh);
                    $benhnhan->Anh=$hinh;//cập nhật file mới
                    $benhnhan->save();
                    $msg='tc';
                }
            }
            else{
                $benhnhan->save();
                $msg="tc";
            }

            $response = array(
                'msg' => $msg,
            );
            
            event(new BenhNhan($benhnhan, 'sua'));

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
            $benhnhan= new benh_nhan;
            $benhnhan->IdBN= benhNhanController::TaoMaNN();
            $benhnhan->HoTen=$request->hoten;
            $benhnhan->IdXa=$request->xa;
            $benhnhan->NgaySinh= \comm_functions::enDateFormat($request->ngaysinh);
            $benhnhan->GioiTinh=$request->gt;
            $benhnhan->SoCMND=$request->scmnd;
            $benhnhan->SDT=$request->sdt;
            $benhnhan->DiaChi=$request->diachi;
            $benhnhan->DanToc= $request->dantoc;
            $msg="";
            if($request->hasFile('file')){
                $file=$request->file('file');
                $duoi=$file->getClientOriginalExtension();
                if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg'){
                    $benhnhan->save();
                    $msg="ko_ho_tro_kieu_file";
                }
                else{
                    $name=$file->getClientOriginalName();
                    $hinh=str_random(4)."_".$name;
                    while(file_exists('public/upload/anhbn/'.$hinh)){
                        $hinh=str_random(4)."_".$name;
                    }
                    $file->move('public/upload/anhbn/',$hinh);
                    $benhnhan->Anh=$hinh;//cập nhật file mới
                    $benhnhan->save();
                    $msg='tc';
                }
            }
            else{
                $benhnhan->save();
                $msg="tc";
            }

            $response = array(
                'msg' => $msg
            );
            
            event(new BenhNhan($benhnhan, 'them'));

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
                    $benhnhan= benh_nhan::where("IdBN", $a)->get()->first();
                    foreach ($benhnhan->phieuDkKham as $b){
                        if(is_object($b->benhAnNgoaiTru)){
                            if(is_object($b->benhAnNgoaiTru->benhAnNgoaiTru->CanLamSang)){
                                foreach($b->benhAnNgoaiTru->benhAnNgoaiTru->CanLamSang as $cls){
                                    $cls->canLamSang->delete();
                                }
                            }
                            //thu thuat, ...
                            if(is_object($b->benhAnNgoaiTru->benhAnNgoaiTru->chiDinhTT)){
                                foreach($b->benhAnNgoaiTru->benhAnNgoaiTru->chiDinhTT as $cls){
                                    $cls->chiDinhTT->delete();
                                }
                            }
                            $b->benhAnNgoaiTru->benhAnNgoaiTru->delete();
                        }
                        if(is_object($b->benhAnNoiTru)){
                            if(is_object($b->benhAnNoiTru->benhAnNoiTru->benhAnNoiTruCT)){
                                foreach($b->benhAnNoiTru->benhAnNoiTru->benhAnNoiTruCT as $bact){
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
                            $b->benhAnNoiTru->benhAnNoiTru->delete();
                        }
                        //...
                    }
                    if($benhnhan->Anh != '' && file_exists("public/upload/anhbn/".$benhnhan->Anh)){
                        unlink("public/upload/anhbn/".$benhnhan->Anh);
                    }
                    $benhnhan->delete();
                    
                    //xóa
                }
                $response = array(
                    'msg' => 'tc',
                );

                event(new BenhNhan($arr, 'xoa'));

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
                $benhnhan= benh_nhan::where("IdBN", $request->id)->get()->first();
                foreach ($benhnhan->phieuDkKham as $b){
                    if(is_object($b->benhAnNgoaiTru)){
                        if(is_object($b->benhAnNgoaiTru->benhAnNgoaiTru->CanLamSang)){
                            foreach($b->benhAnNgoaiTru->benhAnNgoaiTru->CanLamSang as $cls){
                                $cls->canLamSang->delete();
                            }
                        }
                        //thu thuat, ...
                        if(is_object($b->benhAnNgoaiTru->benhAnNgoaiTru->chiDinhTT)){
                                foreach($b->benhAnNgoaiTru->benhAnNgoaiTru->chiDinhTT as $cls){
                                    $cls->chiDinhTT->delete();
                                }
                            }
                        $b->benhAnNgoaiTru->benhAnNgoaiTru->delete();
                    }
                    if(is_object($b->benhAnNoiTru)){
                        if(is_object($b->benhAnNoiTru->benhAnNoiTru->benhAnNoiTruCT)){
                            foreach($b->benhAnNoiTru->benhAnNoiTru->benhAnNoiTruCT as $bact){
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
                        $b->benhAnNoiTru->benhAnNoiTru->delete();
                    }

                    //...
                }
                if($benhnhan->Anh != '' && file_exists("public/upload/anhbn/".$benhnhan->Anh)){
                    unlink("public/upload/anhbn/".$benhnhan->Anh);
                }
                $benhnhan->delete();
                $response = array(
                    'msg' => 'tc',
                );

                event(new BenhNhan($request->id, 'xoa'));

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
            $ds_benhnhan= DB::select("SELECT bn.*, px.`TenXa`,qh.`TenHuyen`, tp.`TenTinh` FROM benh_nhan bn JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` WHERE (bn.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(bn.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN bn.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`SoCMND` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`SDT` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`DiaChi` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`DanToc` LIKE N'%".\comm_functions::changeTitle($key)."%' COLLATE utf8_unicode_ci) OR (px.`TenXa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (qh.`TenHuyen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (tp.TenTinh LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY bn.created_at DESC");
            $dsbn = array();
            $sl=0;
            if(!empty($ds_benhnhan)){
                foreach ($ds_benhnhan as $benhnhan){
                    $timeStamp = date( "d/m/Y", strtotime($benhnhan->NgaySinh));
                    $ngaysinh=$timeStamp;
                    $gt="Nam";
                    if($benhnhan->GioiTinh == 0){
                        $gt="Nữ";
                    }
                    //date in mm/dd/yyyy format; or it can be in other formats as well
                    //explode the date to get month, day and year
                    $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
                    //get age from date or birthdate
                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));
                    $dantoc = \comm_functions::decodeDanToc($benhnhan->DanToc);
                    $anh=$benhnhan->Anh;
                    $diachi="";
                    if($benhnhan->DiaChi != ''){
                        $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->TenXa.", huyện ".$benhnhan->TenHuyen.", tỉnh ".$benhnhan->TenTinh;
                    }
                    else{
                        $diachi="Xã, ".$benhnhan->TenXa.", huyện ".$benhnhan->TenHuyen.", tỉnh ".$benhnhan->TenTinh;
                    }

                    $ttbn= array(
                        'hoten' => $benhnhan->HoTen,
                        'ngaysinh' => $ngaysinh,
                        'gt' => $gt,
                        'scmnd' => $benhnhan->SoCMND,
                        'sdt' => $benhnhan->SDT,
                        'diachi' => $diachi,
                        'dantoc' => $dantoc,
                        'anh' => $anh, 
                        'tuoi' => $age,
                        'id' => $benhnhan->IdBN
                    );
                    $dsbn[]=$ttbn;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'benhnhan'=>$dsbn,
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
    
    public function postLayDSBN(){
        try{
            $ds_benhnhan= benh_nhan::orderBy('created_at', 'DESC')->get();
            $dsbn = array();
            if(!empty($ds_benhnhan)){
                foreach ($ds_benhnhan as $benhnhan){
                    $timeStamp = date( "d/m/Y", strtotime($benhnhan->NgaySinh));
                    $ngaysinh=$timeStamp;
                    $gt="Nam";
                    if($benhnhan->GioiTinh == 0){
                        $gt="Nữ";
                    }
                    //date in mm/dd/yyyy format; or it can be in other formats as well
                    //explode the date to get month, day and year
                    $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
                    //get age from date or birthdate
                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));
                    $dantoc = \comm_functions::decodeDanToc($benhnhan->DanToc);
                    $anh=$benhnhan->Anh;
                    $diachi="";
                    if($benhnhan->DiaChi == ''){
                        $diachi="Xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }

                    $ttbn= array(
                        'hoten' => $benhnhan->HoTen,
                        'ngaysinh' => $ngaysinh,
                        'gt' => $gt,
                        'scmnd' => $benhnhan->SoCMND,
                        'sdt' => $benhnhan->SDT,
                        'diachi' => $diachi,
                        'dantoc' => $dantoc,
                        'anh' => $anh, 
                        'tuoi' => $age,
                        'id' => $benhnhan->IdBN
                    );
                    $dsbn[]=$ttbn;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'benhnhan'=>$dsbn,
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
        if($request->keySearch == ''){
            $sql="";
            $arr=array();
            if($request->dtk == 'all'){
                $arr[]='all';
            }
            else{
                $arr[]='notall';
            }
            if($request->dantoc == 'all'){
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
            switch($arr){
                //#exclude_1
                case ['all','notall','notall','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','all','notall','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','notall','all','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','notall','notall','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_2_left_to_right_shift_1
                case ['all','notall','notall','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['all','notall','all','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['all','all','notall','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_2_left_to_right_shift_1_indent_1
                case ['notall','all','notall','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','all','all','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_2_left_to_right_shift_1_indent_2
                case ['notall','notall','all','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_2_left_to_right_shift_1_indent_4
                case ['notall','notall','notall','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;
                
                //#exclude_3_left_to_right_shift_1
                case ['all','all','notall','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['all','all','all','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_3_left_to_right_shift_1_indent_1
                case ['notall','all','all','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_3_left_to_right_shift_1_indent_3
                case ['notall','notall','notall','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." ORDER BY a.created_at DESC"; break;

                //#exclude_3_right_to_left_shift_1
                case ['all','notall','notall','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','all','notall','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','notall','all','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_3_left_to_right_shift_1_except_1
                case ['all','notall','all','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;
               
                //#exclude_4_left_to_right_shift_1
                case ['all','all','all','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE  a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;  

                //#exclude_4_left_to_right_shift_1_indent_2
                case ['notall','notall','all','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_4_right_to_left_shift_1
                case ['all','notall','notall','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." ORDER BY a.created_at DESC"; break;

                case ['notall','all','notall','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." ORDER BY a.created_at DESC"; break;

                //#exclude_4_left_to_right_shift_1_except_1
                case ['all','all','notall','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_4_right_to_left_shift_1_except_1
                case ['notall','all','all','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_4_right_to_left_shift_1_except_2
                case ['all','notall','all','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_5
                case ['notall','all','all','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." ORDER BY a.created_at DESC"; break;

                case ['all','notall','all','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['all','all','notall','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." ORDER BY a.created_at DESC"; break;

                case ['all','all','all','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#6
                case ['notall','notall','notall','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //explode 6
                default: $sql="SELECT DISTINCT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a ORDER BY a.created_at DESC"; break;

            }
            
            try{
                $ds_benhnhan= DB::select($sql);
                $dsbn = array();
                $sl=0;
                if(!empty($ds_benhnhan)){
                    foreach ($ds_benhnhan as $benhnhan){
                        $timeStamp = date( "d/m/Y", strtotime($benhnhan->NgaySinh));
                        $ngaysinh=$timeStamp;
                        $gt="Nam";
                        if($benhnhan->GioiTinh == 0){
                            $gt="Nữ";
                        }
                        //date in mm/dd/yyyy format; or it can be in other formats as well
                        //explode the date to get month, day and year
                        $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
                        //get age from date or birthdate
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                        ? ((date("Y") - $birthDate[2]) - 1)
                        : (date("Y") - $birthDate[2]));
                        $dantoc = \comm_functions::decodeDanToc($benhnhan->DanToc);
                        $anh=$benhnhan->Anh;
                        $diachi="";
                        if($benhnhan->DiaChi != ''){
                            $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->TenXa.", huyện ".$benhnhan->TenHuyen.", tỉnh ".$benhnhan->TenTinh;
                        }
                        else{
                            $diachi="Xã, ".$benhnhan->TenXa.", huyện ".$benhnhan->TenHuyen.", tỉnh ".$benhnhan->TenTinh;
                        }

                        $ttbn= array(
                            'hoten' => $benhnhan->HoTen,
                            'ngaysinh' => $ngaysinh,
                            'gt' => $gt,
                            'scmnd' => $benhnhan->SoCMND,
                            'sdt' => $benhnhan->SDT,
                            'diachi' => $diachi,
                            'dantoc' => $dantoc,
                            'anh' => $anh, 
                            'tuoi' => $age,
                            'id' => $benhnhan->IdBN
                        );
                        $dsbn[]=$ttbn;
                        $sl++;
                    }
                }

                $response = array(
                    'msg' => 'tc',
                    'benhnhan'=>$dsbn,
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
        else{
            $sql="";
            
            $arr=array();
            if($request->dtk == 'all'){
                $arr[]='all';
            }
            else{
                $arr[]='notall';
            }
            if($request->dantoc == 'all'){
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
            switch($arr){
                //#exclude_1
                case ['all','notall','notall','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','all','notall','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','notall','all','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','notall','notall','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_2_left_to_right_shift_1
                case ['all','notall','notall','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['all','notall','all','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['all','all','notall','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_2_left_to_right_shift_1_indent_1
                case ['notall','all','notall','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','all','all','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_2_left_to_right_shift_1_indent_2
                case ['notall','notall','all','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_2_left_to_right_shift_1_indent_4
                case ['notall','notall','notall','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;
                
                //#exclude_3_left_to_right_shift_1
                case ['all','all','notall','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['all','all','all','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_3_left_to_right_shift_1_indent_1
                case ['notall','all','all','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_3_left_to_right_shift_1_indent_3
                case ['notall','notall','notall','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." ORDER BY a.created_at DESC"; break;

                //#exclude_3_right_to_left_shift_1
                case ['all','notall','notall','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','all','notall','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['notall','notall','all','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_3_left_to_right_shift_1_except_1
                case ['all','notall','all','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;
                
                //#exclude_4_left_to_right_shift_1
                case ['all','all','all','notall','notall','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE  a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;  

                //#exclude_4_left_to_right_shift_1_indent_2
                case ['notall','notall','all','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_4_right_to_left_shift_1
                case ['all','notall','notall','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." ORDER BY a.created_at DESC"; break;

                case ['notall','all','notall','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." ORDER BY a.created_at DESC"; break;

                //#exclude_4_left_to_right_shift_1_except_1
                case ['all','all','notall','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_4_right_to_left_shift_1_except_1
                case ['notall','all','all','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_4_right_to_left_shift_1_except_2
                case ['all','notall','all','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#exclude_5
                case ['notall','all','all','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." ORDER BY a.created_at DESC"; break;

                case ['all','notall','all','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                case ['all','all','notall','all','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." ORDER BY a.created_at DESC"; break;

                case ['all','all','all','notall','all','all']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //#6
                case ['notall','notall','notall','notall','notall','notall']: $sql="SELECT DISTINCT a.* FROM (SELECT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci)) AS a
    WHERE CASE WHEN a.idbn_bhyt IS NULL THEN 0 ELSE 1 END = ".$request->dtk." AND a.DanToc = N'".$request->dantoc."' COLLATE utf8_unicode_ci AND CASE WHEN a.`GioiTinh` IS FALSE THEN 0 ELSE 1 END = ".$request->gt." AND a.xakd = N'".$request->xa."' COLLATE utf8_unicode_ci AND a.hkd = N'".$request->huyen."' COLLATE utf8_unicode_ci AND a.tkd = N'".$request->tinh."' COLLATE utf8_unicode_ci ORDER BY a.created_at DESC"; break;

                //explode 6
                default: $sql="SELECT DISTINCT a.* FROM (
    SELECT bn.*, px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn LEFT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` LEFT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` LEFT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` LEFT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` 
   UNION ALL
    SELECT bn.*,  px.`TenXa`, px.`IdXa` AS xakd, qh.`TenHuyen`, qh.`IdHuyen` AS hkd, tp.`TenTinh`, tp.`IdTinh` AS tkd, tbh.`IdBN` AS idbn_bhyt FROM benh_nhan AS bn RIGHT JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` RIGHT JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` RIGHT JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` RIGHT JOIN the_bhyt AS tbh ON tbh.`IdBN` = bn.`IdBN` ) AS a WHERE (a.`IdBN` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`HoTen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(a.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (CASE WHEN a.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SoCMND` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`SDT` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DiaChi` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`DanToc` LIKE N'%".\comm_functions::changeTitle($request->keySearch)."%' COLLATE utf8_unicode_ci) OR (a.`TenXa` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenHuyen` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) OR (a.`TenTinh` LIKE N'%".$request->keySearch."%' COLLATE utf8_unicode_ci) ORDER BY a.created_at DESC"; break;
            }
            
            try{
                $ds_benhnhan= DB::select($sql);
                $dsbn = array();
                $sl=0;
                if(!empty($ds_benhnhan)){
                    foreach ($ds_benhnhan as $benhnhan){
                        $timeStamp = date( "d/m/Y", strtotime($benhnhan->NgaySinh));
                        $ngaysinh=$timeStamp;
                        $gt="Nam";
                        if($benhnhan->GioiTinh == 0){
                            $gt="Nữ";
                        }
                        //date in mm/dd/yyyy format; or it can be in other formats as well
                        //explode the date to get month, day and year
                        $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
                        //get age from date or birthdate
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                        ? ((date("Y") - $birthDate[2]) - 1)
                        : (date("Y") - $birthDate[2]));
                        $dantoc = \comm_functions::decodeDanToc($benhnhan->DanToc);
                        $anh=$benhnhan->Anh;
                        $diachi="";
                        if($benhnhan->DiaChi != ''){
                            $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->TenXa.", huyện ".$benhnhan->TenHuyen.", tỉnh ".$benhnhan->TenTinh;
                        }
                        else{
                            $diachi="Xã, ".$benhnhan->TenXa.", huyện ".$benhnhan->TenHuyen.", tỉnh ".$benhnhan->TenTinh;
                        }

                        $ttbn= array(
                            'hoten' => $benhnhan->HoTen,
                            'ngaysinh' => $ngaysinh,
                            'gt' => $gt,
                            'scmnd' => $benhnhan->SoCMND,
                            'sdt' => $benhnhan->SDT,
                            'diachi' => $diachi,
                            'dantoc' => $dantoc,
                            'anh' => $anh, 
                            'tuoi' => $age,
                            'id' => $benhnhan->IdBN
                        );
                        $dsbn[]=$ttbn;
                        $sl++;
                    }
                }

                $response = array(
                    'msg' => 'tc',
                    'benhnhan'=>$dsbn,
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
    
    public static function TaoMaNN(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= benh_nhan::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $bn) {
                   if($bn->IdBN == $ran){
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
