<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\thong_ke;
use App\Models\HanhChinh\file_tk;
use App\Models\HanhChinh\duyet_tk;
use Illuminate\Foundation\Auth\User;
use App\Events\HanhChinh\DVB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;

class DVBController extends Controller
{
    //
    
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;

        if($user->Quyen == 'hc' && count($user->capQuyen) == 0){
            $dsdaduyet=array();
            $dsbc= thong_ke::where([['PhanLoai','thong_ke'], ['IdNV', $idnv]])->orderBy('created_at', 'DESC')->get();
            foreach ($dsbc as $value) {
                # code...
                if(count($value->duyetTK) > 0){
                    $dsdaduyet[]=$value;
                }
            }
            return view("hanh_chinh.duyet_van_ban",['dsdd'=>$dsdaduyet]);
        }

        $flag=FALSE;$dschoduyet=array();$dsdaduyet=array();$sl=[];
        foreach ($user->capQuyen as $value) {
            if($value->Quyen == 'khth'){
                $flag=TRUE;
                break;
            }
        }
        if($flag == FALSE){
            $dsbc= thong_ke::where([['PhanLoai','thong_ke'], ['IdNV', '<>', $idnv]])->orderBy('created_at', 'DESC')->get();
            foreach ($dsbc as $value) {
                # code...
                $f=FALSE;
                foreach($value->duyetTK as $d){
                    if($d->IdNV == $idnv){
                        $f=TRUE;
                        $dsdaduyet[]=$value;
                        break;
                    }
                }
                if($f==FALSE){
                    $sl[]=$value;
                    $dschoduyet[]=$value;
                }
            }
        }
        else{
            $dsbc= thong_ke::where('IdNV', '<>', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach ($dsbc as $value) {
                # code...
                $f=FALSE;
                foreach($value->duyetTK as $d){
                    if($d->IdNV == $idnv){
                        $f=TRUE;
                        $dsdaduyet[]=$value;
                        break;
                    }
                }
                if($f==FALSE){
                    $sl[]=$value;
                    $dschoduyet[]=$value;
                }
            }
        }

        return view("hanh_chinh.duyet_van_ban",["dscd"=>$dschoduyet, 'dsdd'=>$dsdaduyet, 'dsbc'=>$sl]);
    }

    public function getDanhSachKVDT(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;

        if(count($user->capQuyen) == 0){
            $dsdaduyet=array();
            $dsbc= thong_ke::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach ($dsbc as $value) {
                # code...
                if(count($value->duyetTK) >0){
                    $dsdaduyet[]=$value;
                }
            }

            $dscho= ba_nv::where('IdNV',$idnv)->orderBy('created_at', 'DESC')->get();
        
            $dsbachotn=array();
            foreach($dscho as $tn){
                $banoi= benh_an_noi_tru::where('IdBANoiT', $tn->IdBANoiT)->get()->first();
                
                if(is_object($banoi)){
                    $dsbachotn[]=$banoi;
                }
            }

            return view("kham_vs_dieu_tri.duyet_van_ban",['dsdd'=>$dsdaduyet, 'dsbachotn'=>$dsbachotn]);
        }

        $flag=FALSE;$dschoduyet=array();$dsdaduyet=array();$sl=[];
        foreach ($user->capQuyen as $value) {
            if($value->Quyen == 'qlck'){
                $flag=TRUE;
                break;
            }
        }
        if($flag == TRUE){
            $dsbc= thong_ke::where([['PhanLoai','grv'], ['IdNV', '<>', $idnv]])->orderBy('created_at', 'DESC')->get();
            foreach ($dsbc as $value) {
                # code...
                $f=FALSE;
                foreach($value->duyetTK as $d){
                    if($d->IdNV == $idnv){
                        $f=TRUE;
                        $dsdaduyet[]=$value;
                        break;
                    }
                }
                if($f==FALSE){
                    $sl[]=$value;
                    $dschoduyet[]=$value;
                }
            }
        }

        $dscho= ba_nv::where('IdNV',$idnv)->orderBy('created_at', 'DESC')->get();
        
        $dsbachotn=array();
        foreach($dscho as $tn){
            $banoi= benh_an_noi_tru::where('IdBANoiT', $tn->IdBANoiT)->get()->first();
            
            if(is_object($banoi)){
                $dsbachotn[]=$banoi;
            }
        }

        return view("kham_vs_dieu_tri.duyet_van_ban",["dscd"=>$dschoduyet, 'dsdd'=>$dsdaduyet, 'dsbc'=>$sl, 'dsbachotn'=>$dsbachotn]);
    }
    
    public function getDanhSachKT(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;

        $dsdaduyet=array();
        $dsbc= thong_ke::where([['PhanLoai','thong_ke'], ['IdNV', $idnv]])->orderBy('created_at', 'DESC')->get();
        foreach ($dsbc as $value) {
            # code...
            if(count($value->duyetTK) > 0){
                $dsdaduyet[]=$value;
            }
        }
        return view("ke_toan.duyet_van_ban",['dsdd'=>$dsdaduyet]);
    }

    public function getDanhSachTD(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;

        $dsdaduyet=array();
        $dsbc= thong_ke::where([['PhanLoai','thong_ke'], ['IdNV', $idnv]])->orderBy('created_at', 'DESC')->get();
        foreach ($dsbc as $value) {
            # code...
            if(count($value->duyetTK) > 0){
                $dsdaduyet[]=$value;
            }
        }
        return view("tiep_don.duyet_van_ban",['dsdd'=>$dsdaduyet]);
    }

    public function postThem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $nv=$user->nhanVien;
            
            $tk= thong_ke::where('IdTK', $request->id)->get()->first();
            if(!is_object($tk)){
                $response = array(
                    'msg' => 'ktt',
                );
                return response()->json($response); 
            }
            else{
                $duyet= new duyet_tk;
                $duyet->IdNV=$nv->IdNV;
                $duyet->IdTK=$tk->IdTK;
                $duyet->save();

                $response = array(
                    'msg' => 'tc',
                );
                
                event(new DVB($tk, 'duyet', $duyet->created_at, $nv));
                
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
                $dshuy=array();
                $user= User::where('id', auth()->user()->id)->get()->first();
                $nv=$user->nhanVien;
                
                $pl='cd';
                $chucvu='';$cb='';$i=1;
                foreach ($nv->chucVu as $nvd) {
                    if(count($nv->chucVu) == 1){
                        $chucvu=$nvd->chucVu->TenCV;
                    }
                    else{
                        if($i == 1){
                            $cb=$nvd->chucVu->CB;
                            $chucvu=$nvd->chucVu->TenCV;
                        }
                        else{
                            if($nvd->chucVu->CB > $cb){
                                $cb=$nvd->chucVu->CB;
                                $chucvu=$nvd->chucVu->TenCV;
                            }
                        }
                        $i++;
                    }
                }
                foreach ($arr as $a){
                    $tk= thong_ke::where("IdTK", $a)->get()->first();
                    $dshuy[]=['id'=>$tk->IdTK, 'idnv'=>$tk->IdNV, 'nd'=>$nv->TenNV.' - '.$chucvu.' [Phòng '.$nv->phongBan->TenPhong.'('.$nv->phongBan->SoPhong.')]', 'cd'=>$tk->CD, 'pl'=>$tk->PhanLoai];
                    if(count($tk->duyetTK) > 0){
                        $pl='dd';
                    }
                    foreach($tk->File as $file){
                        if($file->TenFile != '' && file_exists("public/upload/baocao/".$file->TenFile)){
                            unlink("public/upload/baocao/".$file->TenFile);
                        }
                    }
                    
                    $tk->delete();
                }
               
                event(new DVB($arr, 'xoa', $pl, $nv, $dshuy));
                
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
                $dshuy=array();
                $user= User::where('id', auth()->user()->id)->get()->first();
                $nv=$user->nhanVien;
                
                $pl='cd';
                $chucvu='';$cb='';$i=1;
                foreach ($nv->chucVu as $nvd) {
                    if(count($nv->chucVu) == 1){
                        $chucvu=$nvd->chucVu->TenCV;
                    }
                    else{
                        if($i == 1){
                            $cb=$nvd->chucVu->CB;
                            $chucvu=$nvd->chucVu->TenCV;
                        }
                        else{
                            if($nvd->chucVu->CB > $cb){
                                $cb=$nvd->chucVu->CB;
                                $chucvu=$nvd->chucVu->TenCV;
                            }
                        }
                        $i++;
                    }
                }
                $tk= thong_ke::where("IdTK", $request->id)->get()->first();
                $dshuy[]=['id'=>$tk->IdTK, 'idnv'=>$tk->IdNV, 'nd'=>$nv->TenNV.' - '.$chucvu.' [Phòng '.$nv->phongBan->TenPhong.'('.$nv->phongBan->SoPhong.')]', 'cd'=>$tk->CD, 'pl'=>$tk->PhanLoai];
                if(count($tk->duyetTK) > 0){
                    $pl='dd';
                }
                foreach($tk->File as $file){
                    if($file->TenFile != '' && file_exists("public/upload/baocao/".$file->TenFile)){
                        unlink("public/upload/baocao/".$file->TenFile);
                    }
                }
                $tk->delete();
                
                event(new DVB($request->id, 'xoa', $pl, $nv, $dshuy));
                
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
            $sql='';$flag=FALSE;$flagf=FALSE;
            if($request->loaiform == 'hc'){
                if($request->loaibc == 'hh'){
                    if($request->ttd == 'cd'){
                        $sql="SELECT DISTINCT tk.`IdTK` FROM thong_ke AS tk JOIN nhan_vien AS nv ON nv.`IdNV` = tk.`IdNV` JOIN phong_ban AS pb ON pb.`IdPB` = nv.`IdPB` WHERE tk.`IdTK` NOT IN
(SELECT d.`IdTK` FROM duyet_tk as d WHERE d.`IdNV` = N'".$request->idnv."') AND ((CASE WHEN tk.`PhanLoai` = N'thong_ke' THEN N'Thống kê, báo báo tkbc tk-bc bảng thống kê bảng báo cáo btk bbc' ELSE  N'Giấy ra viện grv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (tk.`CD` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(tk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT(nv.`TenNV`, ' - Phòng ', pb.TenPhong,' (',pb.SoPhong,')') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY tk.`IdTK` ORDER BY tk.created_at DESC";
                        $flag=TRUE;
                    }
                    else{
                        $sql="SELECT DISTINCT tk.`IdTK` FROM thong_ke AS tk JOIN duyet_tk AS d ON d.`IdTK` = tk.`IdTK` JOIN nhan_vien AS nvg ON nvg.`IdNV` = tk.`IdNV` JOIN phong_ban AS pb ON pb.`IdPB` = nvg.`IdPB` JOIN nhan_vien AS nvn ON nvn.`IdNV` = d.`IdNV` JOIN phong_ban AS pbn ON pbn.`IdPB` = nvn.`IdPB` WHERE d.`IdNV` = N'".$request->idnv."' AND ((CASE WHEN tk.`PhanLoai` = N'thong_ke' THEN N'Thống kê, báo báo tkbc tk-bc bảng thống kê bảng báo cáo btk bbc' ELSE  N'Giấy ra viện grv' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (tk.`CD` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(tk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(d.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT(nvg.`TenNV`, ' - Phòng ', pb.TenPhong,' (',pb.SoPhong,')') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('+ ', nvn.`TenNV`, ' - [Phòng ', pbn.TenPhong,' (',pbn.SoPhong,')]') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY tk.`IdTK` ORDER BY tk.created_at DESC";
                    }
                }
                else{
                    if($request->ttd == 'cd'){
                        $sql="SELECT DISTINCT tk.`IdTK` FROM thong_ke AS tk JOIN nhan_vien AS nv ON nv.`IdNV` = tk.`IdNV` JOIN phong_ban AS pb ON pb.`IdPB` = nv.`IdPB` WHERE tk.`IdTK` NOT IN
(SELECT d.`IdTK` FROM duyet_tk as d WHERE d.`IdNV` = N'".$request->idnv."') AND tk.`PhanLoai` = N'thong_ke' AND ((tk.`CD` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(tk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT(nv.`TenNV`, ' - Phòng ', pb.TenPhong,' (',pb.SoPhong,')') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY tk.`IdTK` ORDER BY tk.created_at DESC;";
                        $flag=TRUE;
                    }
                    else{
                        $sql="SELECT DISTINCT tk.`IdTK` FROM thong_ke AS tk JOIN duyet_tk AS d ON d.`IdTK` = tk.`IdTK` JOIN nhan_vien AS nvg ON nvg.`IdNV` = tk.`IdNV` JOIN phong_ban AS pb ON pb.`IdPB` = nvg.`IdPB` JOIN nhan_vien AS nvn ON nvn.`IdNV` = d.`IdNV` JOIN phong_ban AS pbn ON pbn.`IdPB` = nvn.`IdPB` WHERE d.`IdNV` = N'".$request->idnv."' AND tk.`PhanLoai` = N'thong_ke' AND ((tk.`CD` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(tk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(d.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT(nvg.`TenNV`, ' - Phòng ', pb.TenPhong,' (',pb.SoPhong,')') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('+ ', nvn.`TenNV`, ' - [Phòng ', pbn.TenPhong,' (',pbn.SoPhong,')]') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY tk.`IdTK` ORDER BY tk.created_at DESC;";
                    }
                }
            }
            else if($request->loaiform == 'hct' || $request->loaiform == 'kvdtt' ||  $request->loaiform == 'kt' || $request->loaiform == 'td'){
                $sql="SELECT DISTINCT tk.`IdTK` FROM thong_ke AS tk JOIN duyet_tk AS d ON d.`IdTK` = tk.`IdTK` JOIN nhan_vien AS nvg ON nvg.`IdNV` = tk.`IdNV` JOIN phong_ban AS pb ON pb.`IdPB` = nvg.`IdPB` JOIN nhan_vien AS nvn ON nvn.`IdNV` = d.`IdNV` JOIN phong_ban AS pbn ON pbn.`IdPB` = nvn.`IdPB` WHERE tk.`IdNV` = N'".$request->idnv."' AND tk.`PhanLoai` = N'thong_ke' AND ((tk.`CD` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(tk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(d.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT(nvg.`TenNV`, ' - Phòng ', pb.TenPhong,' (',pb.SoPhong,')') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('+ ', nvn.`TenNV`, ' - [Phòng ', pbn.TenPhong,' (',pbn.SoPhong,')]') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY tk.`IdTK` ORDER BY tk.created_at DESC;";
                if($request->loaiform == 'kvdtt'){
                    $sql="SELECT DISTINCT tk.`IdTK` FROM thong_ke AS tk JOIN duyet_tk AS d ON d.`IdTK` = tk.`IdTK` JOIN nhan_vien AS nvg ON nvg.`IdNV` = tk.`IdNV` JOIN phong_ban AS pb ON pb.`IdPB` = nvg.`IdPB` JOIN nhan_vien AS nvn ON nvn.`IdNV` = d.`IdNV` JOIN phong_ban AS pbn ON pbn.`IdPB` = nvn.`IdPB` WHERE tk.`IdNV` = N'".$request->idnv."' AND tk.`PhanLoai` = N'grv' AND ((tk.`CD` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(tk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(d.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT(nvg.`TenNV`, ' - Phòng ', pb.TenPhong,' (',pb.SoPhong,')') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('+ ', nvn.`TenNV`, ' - [Phòng ', pbn.TenPhong,' (',pbn.SoPhong,')]') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY tk.`IdTK` ORDER BY tk.created_at DESC;";
                }
                $flagf=TRUE;
            }
            else if($request->loaiform == 'kvdt'){
                if($request->ttd == 'cd'){
                    $sql="SELECT DISTINCT tk.`IdTK` FROM thong_ke AS tk JOIN nhan_vien AS nv ON nv.`IdNV` = tk.`IdNV` JOIN phong_ban AS pb ON pb.`IdPB` = nv.`IdPB` WHERE tk.`IdTK` NOT IN
(SELECT d.`IdTK` FROM duyet_tk as d WHERE d.`IdNV` = N'".$request->idnv."') AND tk.`PhanLoai` = N'grv' AND ((tk.`CD` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(tk.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT(nv.`TenNV`, ' - Phòng ', pb.TenPhong,' (',pb.SoPhong,')') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY tk.`IdTK` ORDER BY tk.created_at DESC;";
                    $flag=TRUE;
                }
                else{
                    $sql="SELECT DISTINCT tk.`IdTK` FROM thong_ke AS tk JOIN duyet_tk AS d ON d.`IdTK` = tk.`IdTK` JOIN nhan_vien AS nvg ON nvg.`IdNV` = tk.`IdNV` JOIN phong_ban AS pb ON pb.`IdPB` = nvg.`IdPB` JOIN nhan_vien AS nvn ON nvn.`IdNV` = d.`IdNV` JOIN phong_ban AS pbn ON pbn.`IdPB` = nvn.`IdPB` WHERE d.`IdNV` = N'".$request->idnv."' AND tk.`PhanLoai` = N'grv' AND ((tk.`CD` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(tk.`created_at`, '%d/%m/%Y %h:%i:%s') OR (DATE_FORMAT(d.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT(nvg.`TenNV`, ' - Phòng ', pb.TenPhong,' (',pb.SoPhong,')') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT('+ ', nvn.`TenNV`, ' - [Phòng ', pbn.TenPhong,' (',pbn.SoPhong,')]') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) GROUP BY tk.`IdTK` ORDER BY tk.created_at DESC;";
                }
            }
            
            $ds_tk= DB::select($sql);
            $dsbc = array();
            $sl=0;
            if(!empty($ds_tk)){
                if($flag == TRUE){
                    foreach ($ds_tk as $ds){
                        $bc= thong_ke::where('IdTK', $ds->IdTK)->get()->first();
                        $src='';$i=1;
                        foreach ($bc->File as $file){
                            if($i==count($bc->File)){
                                $src.=$file->TenFile;
                            }
                            else{
                                $src.=$file->TenFile.'|';
                            }  
                            $i++;   
                        }
                        $ttbc= array(
                            'id' => $bc->IdTK,//
                            'cd' => $bc->CD,//
                            'src'=>$src,
                            'nguoigui'=>$bc->nhanVien->TenNV.' - Phòng '.$bc->nhanVien->phongBan->TenPhong.' ('.$bc->nhanVien->phongBan->SoPhong.')',//
                            'ngaygui' => \comm_functions::deDateFormat($bc->created_at),//
                            'sofile' => count($bc->File)//
                        );

                        $dsbc[]=$ttbc;
                        $sl++;
                    }
                }
                else{
                    foreach ($ds_tk as $ds){
                        $bc= thong_ke::where('IdTK', $ds->IdTK)->get()->first();
                        $src='';$i=1;
                        foreach ($bc->File as $file){
                            if($i==count($bc->File)){
                                $src.=$file->TenFile;
                            }
                            else{
                                $src.=$file->TenFile.'|';
                            }  
                            $i++;   
                        }
                        $nguoiduyet='';$n=1;$ngayduyet=date('Y-m-d H:i:s');
                        foreach ($bc->duyetTK as $value) {
                            $cv='';$capbac='';$k=1;
                            foreach ($value->nhanVien->chucVu as $nvd) {
                                if(count($value->nhanVien->chucVu) == 1){
                                    $cv=$nvd->chucVu->TenCV;
                                }
                                else{
                                    if($k == 1){
                                        $capbac=$nvd->chucVu->CB;
                                        $cv=$nvd->chucVu->TenCV;
                                    }
                                    else{
                                        if($nvd->chucVu->CB > $capbac){
                                            $capbac=$nvd->chucVu->CB;
                                            $cv=$nvd->chucVu->TenCV;
                                        }
                                    }
                                    $k++;
                                }
                            }

                            if($n == count($bc->duyetTK)){
                                $nguoiduyet.='+ '.$value->nhanVien->TenNV.' - '.$cv.' [Phòng '.$value->nhanVien->phongBan->TenPhong.' ('.$value->nhanVien->phongBan->SoPhong.')]';
                            }
                            else{
                                $nguoiduyet.='+ '.$value->nhanVien->TenNV.' - '.$cv.' [Phòng '.$value->nhanVien->phongBan->TenPhong.' ('.$value->nhanVien->phongBan->SoPhong.')]<br>'; 
                            }
                            $ngayduyet=$value->created_at;
                        }
                        
                        $ttbc= array(
                            'id' => $bc->IdTK,//
                            'cd' => $bc->CD,//
                            'src'=>$src,
                            'nguoiduyet'=>$nguoiduyet,
                            'nguoigui'=>$bc->nhanVien->TenNV.' - Phòng '.$bc->nhanVien->phongBan->TenPhong.' ('.$bc->nhanVien->phongBan->SoPhong.')',//
                            'ngaygui' => \comm_functions::deDateFormat($bc->created_at),//
                            'ngayduyet' => \comm_functions::deDateFormat($ngayduyet),//
                            'sofile' => count($bc->File)//
                        );

                        $dsbc[]=$ttbc;
                        $sl++;
                    }
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'bc'=>$dsbc,
                'loaibc'=>$flag,
                'loaif'=>$flagf,
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
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $flag=FALSE;$flagf=FALSE;$dstk = array();$ds_bc=[];
            if($request->loaiform == 'hc'){
                if($request->loaibc == 'hh'){
                    if($request->ttd == 'cd'){
                        $dsbc= thong_ke::where('IdNV', '<>', $idnv)->orderBy('created_at', 'DESC')->get();
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
                                $dstk[]=$value;
                            }
                        }
                        $flag=TRUE;
                    }
                    else{
                        $dsbc= thong_ke::where('IdNV', '<>', $idnv)->orderBy('created_at', 'DESC')->get();
                        foreach ($dsbc as $value) {
                            foreach($value->duyetTK as $d){
                                if($d->IdNV == $idnv){
                                    $dstk[]=$value;
                                    break;
                                }
                            }
                        }
                    }
                }
                else{
                    if($request->ttd == 'cd'){
                        
                        $dsbc= thong_ke::where([['PhanLoai','thong_ke'], ['IdNV', '<>', $idnv]])->orderBy('created_at', 'DESC')->get();
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
                                $dstk[]=$value;
                            }
                        }
                        $flag=TRUE;
                    }
                    else{
                        $dsbc= thong_ke::where([['PhanLoai','thong_ke'], ['IdNV', '<>', $idnv]])->orderBy('created_at', 'DESC')->get();
                        foreach ($dsbc as $value) {
                            foreach($value->duyetTK as $d){
                                if($d->IdNV == $idnv){
                                    $dstk[]=$value;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            else if($request->loaiform == 'hct' || $request->loaiform == 'kvdtt' || $request->loaiform == 'kt' || $request->loaiform == 'td'){
                if($request->loaiform == 'kvdtt'){
                    $dsbc= thong_ke::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
                    foreach ($dsbc as $value) {
                        # code...
                        if(count($value->duyetTK) >0){
                            $dstk[]=$value;
                        }
                    }
                }
                else{
                    $dsbc= thong_ke::where([['PhanLoai','thong_ke'], ['IdNV', $idnv]])->orderBy('created_at', 'DESC')->get();
                    foreach ($dsbc as $value) {
                        # code...
                        if(count($value->duyetTK) > 0){
                            $dstk[]=$value;
                        }
                    }
                }
                $flagf=TRUE;
            }
            else if($request->loaiform == 'kvdt'){
                if($request->ttd == 'cd'){
                    $dsbc= thong_ke::where([['PhanLoai','grv'], ['IdNV', '<>', $idnv]])->orderBy('created_at', 'DESC')->get();
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
                            $dstk[]=$value;
                        }
                    }
                    $flag=TRUE;
                }
                else{
                    $dsbc= thong_ke::where([['PhanLoai','grv'], ['IdNV', '<>', $idnv]])->orderBy('created_at', 'DESC')->get();
                    foreach ($dsbc as $value) {
                        foreach($value->duyetTK as $d){
                            if($d->IdNV == $idnv){
                                $dstk[]=$value;
                                break;
                            }
                        }
                    }
                }
            }
            
            if($flag == TRUE){
                foreach ($dstk as $bc){
                    $src='';$i=1;
                    foreach ($bc->File as $file){
                        if($i==count($bc->File)){
                            $src.=$file->TenFile;
                        }
                        else{
                            $src.=$file->TenFile.'|';
                        }  
                        $i++;   
                    }
                    $ttbc= array(
                        'id' => $bc->IdTK,//
                        'cd' => $bc->CD,//
                        'src'=>$src,
                        'nguoigui'=>$bc->nhanVien->TenNV.' - Phòng '.$bc->nhanVien->phongBan->TenPhong.' ('.$bc->nhanVien->phongBan->SoPhong.')',//
                        'ngaygui' => \comm_functions::deDateFormat($bc->created_at),//
                        'sofile' => count($bc->File)//
                    );

                    $ds_bc[]=$ttbc;
                }
            }
            else{
                foreach ($dstk as $bc){
                    $src='';$i=1;
                    foreach ($bc->File as $file){
                        if($i==count($bc->File)){
                            $src.=$file->TenFile;
                        }
                        else{
                            $src.=$file->TenFile.'|';
                        }  
                        $i++;   
                    }
                    $nguoiduyet='';$n=1;$ngayduyet=date('Y-m-d H:i:s');
                    foreach ($bc->duyetTK as $value) {
                        $cv='';$capbac='';$k=1;
                        foreach ($value->nhanVien->chucVu as $nvd) {
                            if(count($value->nhanVien->chucVu) == 1){
                                $cv=$nvd->chucVu->TenCV;
                            }
                            else{
                                if($k == 1){
                                    $capbac=$nvd->chucVu->CB;
                                    $cv=$nvd->chucVu->TenCV;
                                }
                                else{
                                    if($nvd->chucVu->CB > $capbac){
                                        $capbac=$nvd->chucVu->CB;
                                        $cv=$nvd->chucVu->TenCV;
                                    }
                                }
                                $k++;
                            }
                        }

                        if($n == count($bc->duyetTK)){
                            $nguoiduyet.='+ '.$value->nhanVien->TenNV.' - '.$cv.' [Phòng '.$value->nhanVien->phongBan->TenPhong.' ('.$value->nhanVien->phongBan->SoPhong.')]';
                        }
                        else{
                            $nguoiduyet.='+ '.$value->nhanVien->TenNV.' - '.$cv.' [Phòng '.$value->nhanVien->phongBan->TenPhong.' ('.$value->nhanVien->phongBan->SoPhong.')]<br>'; 
                        }
                        $ngayduyet=$value->created_at;
                    }

                    $ttbc= array(
                        'id' => $bc->IdTK,//
                        'cd' => $bc->CD,//
                        'src'=>$src,
                        'nguoiduyet'=>$nguoiduyet,
                        'nguoigui'=>$bc->nhanVien->TenNV.' - Phòng '.$bc->nhanVien->phongBan->TenPhong.' ('.$bc->nhanVien->phongBan->SoPhong.')',//
                        'ngaygui' => \comm_functions::deDateFormat($bc->created_at),//
                        'ngayduyet' => \comm_functions::deDateFormat($ngayduyet),//
                        'sofile' => count($bc->File)//
                    );

                    $ds_bc[]=$ttbc;
                }
            }
            $response = array(
                'msg' => 'tc',
                'bc'=>$ds_bc,
                'loaibc'=>$flag,
                'loaif'=>$flagf
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
