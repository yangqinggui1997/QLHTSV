<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\nhan_vien;
use App\Models\HanhChinh\tinh_tp;
use App\Models\HanhChinh\thong_ke;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\HanhChinh\chuc_vu_vs_nv;
use App\Models\HanhChinh\quan_huyen;
use App\Models\HanhChinh\phuong_xa;
use App\Models\HanhChinh\phong_ban;
use App\Models\HanhChinh\cham_cong_nv;
use App\Models\HanhChinh\cham_cong_nv_ct;
use App\Events\HanhChinh\NhanVien;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class nhanVienController extends Controller
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
        $nhanvien= nhan_vien::orderBy('created_at', 'DESC')->get();
        $tinh= tinh_tp::orderBy('TenTinh', 'ASC')->get();
        $dsphong= phong_ban::all();
        $dsdantoc= \comm_functions::setDanToc();
        return view("hanh_chinh.quan_ly_nhan_su",["nhanvien"=>$nhanvien, "dsdantoc"=>$dsdantoc, "dstinh" => $tinh, 'dsphong' => $dsphong, 'dsbc'=>$sl]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            $nhanvien= nhan_vien::where('IdNV',$request->id)->get()->first();
            $xa= phuong_xa::where('IdHuyen', $nhanvien->phuongXa->quanHuyen->IdHuyen)->orderBy('TenXa', 'ASC')->get();
            $huyen= quan_huyen::where('IdTinh',$nhanvien->phuongXa->quanHuyen->tinhTP->IdTinh)->orderBy('TenHuyen', 'ASC')->get();
            $h="";$x="";
            foreach ($xa as $value) {
                $x.='<option selected="" value="'.$value->IdXa.'">'.$value->TenXa.'</option>';
            }
            foreach ($huyen as $value) {
                $h.='<option selected="" value="'.$value->IdHuyen.'">'.$value->TenHuyen.'</option>';
            }

            $cv='';
            foreach ($nhanvien->chucVu as $value) {
                $cv.='<option value="'.$value->chucVu->IdCV.'">'.$value->chucVu->TenCV.'</option>';
            }
            
            $response=array(
                'hoten' => $nhanvien->TenNV,
                'ngaysinh' => date('d/m/Y', strtotime($nhanvien->NgaySinh)),
                'gt' => $nhanvien->GioiTinh,
                'scmnd' => $nhanvien->SoCMND,
                'sdt' => $nhanvien->SDT,
                'diachi' => $nhanvien->DiaChi,
                'dantoc' => $nhanvien->DanToc,
                'x' => $x,
                'h' => $h,
                'idxa' => $nhanvien->phuongXa->IdXa,
                'idhuyen' => $nhanvien->phuongXa->quanHuyen->IdHuyen,
                'idtinh' => $nhanvien->phuongXa->quanHuyen->tinhTP->IdTinh,
                'email'=>$nhanvien->Email,
                'trinhdo'=>$nhanvien->TrinhDo,
                'chuyenmon'=>$nhanvien->ChuyenMon,
                'hdtn'=>date('d/m/Y', strtotime($nhanvien->HopDongTuNgay)),
                'hddn'=>date('d/m/Y', strtotime($nhanvien->HopDongDenNgay)),
                'congviec'=>$nhanvien->CV,
                'phonglv'=>$nhanvien->IdPB,
                'stk'=>$nhanvien->STK,
                'cv'=>$cv,
                'bl'=>$nhanvien->BL,
                'loainv'=>$nhanvien->LoaiNV,
                'msg'=>'tc'
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
            $nv= nhan_vien::where('Email', $request->email)->get()->first();
            if(is_object($nv) && $nv->IdNV != $request->id){
                $response = array(
                    'msg' => 'Email',
                );

                return response()->json($response);  
            }else{
                if(($request->congviec == 'quan_ly_benh_vien' || $request->congviec == 'hanh_chinh_tong_hop' || $request->congviec == 'bac_si_chuyen_khoa_kham_va_dieu_tri' || $request->congviec == 'bac_si_ky_thuat_cls' || $request->congviec == 'bac_si_cap_cuu') && $request->bl > 6){
                    $response = array(
                        'msg' => 'bl',
                        'bl' => 6
                    );

                    return response()->json($response);  
                }else if(($request->congviec == 'tiep_don_cc' || $request->congviec == 'tiep_don_kham_benh' || $request->congviec == 'phat_thuoc' || $request->congviec == 'ky_thuat_y_te' || $request->congviec == 'ke_toan' || $request->congviec == 'ky_thuat_dien') && $request->bl > 8){
                    $response = array(
                        'msg' => 'bl',
                        'bl' => 8
                    );

                    return response()->json($response);  
                }
                $nhanvien= nhan_vien::where('IdNV',$request->id)->get()->first();
                $nhanvien->TenNV=$request->hoten;
                $nhanvien->IdXa=$request->xa;
                $nhanvien->NgaySinh= \comm_functions::enDateFormatDateOnly($request->ngaysinh);
                $nhanvien->GioiTinh=$request->gt;
                $nhanvien->SoCMND=$request->scmnd;
                $nhanvien->SDT=$request->sdt;
                $nhanvien->DiaChi=$request->diachi;
                $nhanvien->DanToc= $request->dantoc;
                $nhanvien->IdPB=$request->phong;
                $nhanvien->STK=$request->stk;
                $nhanvien->Email=$request->email;
                $nhanvien->ChuyenMon=$request->chuyenmon;
                $nhanvien->TrinhDo=$request->trinhdo;
                $nhanvien->HopDongTuNgay=\comm_functions::enDateFormatDateOnly($request->hdtn);
                $nhanvien->HopDongDenNgay=\comm_functions::enDateFormatDateOnly($request->hddn);
                $nhanvien->BL=$request->bl;
                $nhanvien->LoaiNV=$request->loainv;
                $nhanvien->CV=$request->congviec;

                $chucvu= chuc_vu_vs_nv::where('IdNV', $request->id)->get();
                foreach ($chucvu as $value) {
                    $value->delete();
                }

                if($request->chucvu != ''){
                    if(strpos($request->chucvu, ',')){//gửi nhiều mã
                        $arr= explode(',',$request->chucvu);
                        foreach ($arr as $value) {
                            $cv=new chuc_vu_vs_nv;
                            $cv->IdNV=$nhanvien->IdNV;
                            $cv->IdCV=$value;
                            $cv->save();
                        }
                    }
                    else{
                        $cv=new chuc_vu_vs_nv;
                        $cv->IdNV=$nhanvien->IdNV;
                        $cv->IdCV=$request->chucvu;
                        $cv->save();
                    } 
                }

                $msg="";
                if($request->hasFile('file')){
                    $file=$request->file('file');
                    $duoi=$file->getClientOriginalExtension();
                    if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg'){
                        $nhanvien->save();
                        $msg="ko_ho_tro_kieu_file";
                    }
                    else{
                        $name=$file->getClientOriginalName();
                        $hinh=str_random(4)."_".$name;
                        while(file_exists('public/upload/anhnv/'.$hinh)){
                            $hinh=str_random(4)."_".$name;
                        }
                        if($nhanvien->Anh != '' && file_exists("public/upload/anhnv/".$nhanvien->Anh)){
                            unlink("public/upload/anhnv/".$nhanvien->Anh);
                        }
                        
                        $file->move('public/upload/anhnv/',$hinh);
                        $nhanvien->Anh=$hinh;//cập nhật file mới
                        $nhanvien->save();
                        $msg='tc';
                    }
                }
                else{
                    $nhanvien->save();
                    $msg="tc";
                }

                event(new NhanVien($nhanvien, 'sua'));

                $response = array(
                    'msg' => $msg,
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
            $nv= nhan_vien::where('Email', $request->email)->get()->first();
            if(is_object($nv)){
                    $response = array(
                    'msg' => 'Email',
                );

                return response()->json($response);  
            }else{
                $nhanvien= new nhan_vien;
                $nhanvien->IdNV= nhanVienController::TaoMaNN();
                $nhanvien->TenNV=$request->hoten;
                $nhanvien->IdXa=$request->xa;
                $nhanvien->NgaySinh= \comm_functions::enDateFormatDateOnly($request->ngaysinh);
                $nhanvien->GioiTinh=$request->gt;
                $nhanvien->SoCMND=$request->scmnd;
                $nhanvien->SDT=$request->sdt;
                $nhanvien->DiaChi=$request->diachi;
                $nhanvien->DanToc= $request->dantoc;
                $nhanvien->IdPB=$request->phong;
                $nhanvien->STK=$request->stk;
                $nhanvien->Email=$request->email;
                $nhanvien->ChuyenMon=$request->chuyenmon;
                $nhanvien->TrinhDo=$request->trinhdo;
                $nhanvien->HopDongTuNgay=\comm_functions::enDateFormatDateOnly($request->hdtn);
                $nhanvien->HopDongDenNgay=\comm_functions::enDateFormatDateOnly($request->hddn);
                $nhanvien->BL=1;
                $nhanvien->LoaiNV=$request->loainv;
                $nhanvien->CV=$request->congviec;
                
                $msg="";
                if($request->hasFile('file')){
                    $file=$request->file('file');
                    $duoi=$file->getClientOriginalExtension();
                    if($duoi!='jpeg' && $duoi != 'jpg' && $duoi != 'png' && $duoi != 'svg'){
                        $nhanvien->save();
                        $msg="ko_ho_tro_kieu_file";
                    }
                    else{
                        $name=$file->getClientOriginalName();
                        $hinh=str_random(4)."_".$name;
                        while(file_exists('public/upload/anhnv/'.$hinh)){
                            $hinh=str_random(4)."_".$name;
                        }
                        $file->move('public/upload/anhnv/',$hinh);
                        $nhanvien->Anh=$hinh;//cập nhật file mới
                        $nhanvien->save();
                        if($request->chucvu != ''){
                            if(strpos($request->chucvu, ',')){//gửi nhiều mã
                                $arr= explode(',',$request->chucvu);
                                foreach ($arr as $value) {
                                    $cv=new chuc_vu_vs_nv;
                                    $cv->IdNV=$nhanvien->IdNV;
                                    $cv->IdCV=$value;
                                    $cv->save();
                                }
                            }
                            else{
                                $cv=new chuc_vu_vs_nv;
                                $cv->IdNV=$nhanvien->IdNV;
                                $cv->IdCV=$request->chucvu;
                                $cv->save();
                            } 
                        }
                        
                        $msg='tc';
                    }
                }
                else{
                    $nhanvien->save();
                    if($request->chucvu != ''){
                        if(strpos($request->chucvu, ',')){//gửi nhiều mã
                            $arr= explode(',',$request->chucvu);
                            foreach ($arr as $value) {
                                $cv=new chuc_vu_vs_nv;
                                $cv->IdNV=$nhanvien->IdNV;
                                $cv->IdCV=$value;
                                $cv->save();
                            }
                        }
                        else{
                            $cv=new chuc_vu_vs_nv;
                            $cv->IdNV=$nhanvien->IdNV;
                            $cv->IdCV=$request->chucvu;
                            $cv->save();
                        } 
                    }
                    
                    $msg="tc";
                }

                $cc=new cham_cong_nv;
                $cc->IdCC=nhanVienController::TaoMaNNCC();
                $cc->IdNV=$nhanvien->IdNV;
                $cc->TrangThai=0;
               
                $cc->SoNgayCong=1;
                $cc->Thuong=0;
                $cc->TienPhat=0;
                $cc->TTCN=1;
                $cc->save();
                
                event(new NhanVien($nhanvien, 'them'));

                $response = array(
                    'msg' => $msg,
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
                    $nhanvien= nhan_vien::where("IdNV", $a)->get()->first();
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

                event(new NhanVien($arr, 'xoa'));

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
                $nhanvien= nhan_vien::where("IdNV", $request->id)->get()->first();
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

                event(new NhanVien($request->id, 'xoa'));
                
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
            $ds_nv= DB::select("SELECT DISTINCT nv.* FROM (
SELECT b.* FROM (
SELECT nv.*, cv.`TenCV` AS TCV FROM tinh_tp AS tp JOIN quan_huyen AS qh ON tp.`IdTinh` = qh.`IdTinh` JOIN phuong_xa AS px ON qh.`IdHuyen` = px.`IdHuyen` JOIN nhan_vien AS nv ON px.`IdXa` =nv.`IdXa` JOIN phong_ban AS pb ON nv.`IdPB` = pb.`IdPB` JOIN khoa AS k ON k.`IdKhoa` = pb.`IdKhoa` JOIN chuc_vu_vs_nv AS cv_nv ON cv_nv.`IdNV` = nv.`IdNV` JOIN chuc_vu AS cv ON cv.`IdCV` = cv_nv.`IdCV`
    
UNION ALL

SELECT nv.*, CASE WHEN 1=1 THEN N'Nhân viên' END AS TCV FROM tinh_tp AS tp JOIN quan_huyen AS qh ON tp.`IdTinh` = qh.`IdTinh` JOIN phuong_xa AS px ON qh.`IdHuyen` = px.`IdHuyen` JOIN nhan_vien AS nv ON px.`IdXa` =nv.`IdXa` JOIN phong_ban AS pb ON nv.`IdPB` = pb.`IdPB` JOIN khoa AS k ON k.`IdKhoa` = pb.`IdKhoa` WHERE nv.`IdNV` NOT IN
(
SELECT nv.`IdNV` FROM tinh_tp AS tp JOIN quan_huyen AS qh ON tp.`IdTinh` = qh.`IdTinh` JOIN phuong_xa AS px ON qh.`IdHuyen` = px.`IdHuyen` JOIN nhan_vien AS nv ON px.`IdXa` =nv.`IdXa` JOIN phong_ban AS pb ON nv.`IdPB` = pb.`IdPB` JOIN khoa AS k ON k.`IdKhoa` = pb.`IdKhoa` JOIN chuc_vu_vs_nv AS cv_nv ON cv_nv.`IdNV` = nv.`IdNV` JOIN chuc_vu AS cv ON cv.`IdCV` = cv_nv.`IdCV`
)
) AS b
) AS nv WHERE (nv.`IdNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (nv.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(nv.`NgaySinh`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN nv.`GioiTinh` IS FALSE THEN 'Nữ' ELSE 'Nam' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (nv.`SoCMND` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (nv.`SDT` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (nv.`DiaChi` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (nv.`STK` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (nv.`Email` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (nv.`ChuyenMon` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN nv.`LoaiNV` IS FALSE THEN N'Hợp đồng' ELSE N'Biên chế' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (nv.`DanToc` LIKE N'%".\comm_functions::changeTitle($key)."%' COLLATE utf8_unicode_ci) 
OR (CASE WHEN nv.`CV` = N'quan_tri_he_thong' THEN N'Quản trị hệ thống' WHEN nv.`CV` = N'quan_ly_benh_vien' THEN N'Quản lý bệnh viện' WHEN nv.`CV` = N'hanh_chinh_tong_hop' THEN N'Hành chính tổng hợp' WHEN nv.`CV` = N'bac_si_chuyen_khoa_kham_va_dieu_tri' THEN N'Bác sĩ chuyên khoa khám và điều trị' WHEN nv.`CV` = N'bac_si_ky_thuat_cls' THEN N'Bác sĩ kỹ thuật cận lâm sàng' WHEN nv.`CV` = N'bac_si_cap_cuu' THEN N'Bác sĩ trực cấp cứu' WHEN nv.`CV` = N'ke_toan' THEN N'Kế toán' WHEN nv.`CV` = N'tiep_don' THEN N'Tiếp đón bệnh nhân' WHEN nv.`CV` = N'phat_thuoc' THEN N'Phát thuốc' WHEN nv.`CV` = N'ky_thuat_dien' THEN N'Kỹ thuật điện' WHEN nv.`CV` = N'ky_thuat_y_te' THEN N'Kỹ thuật y tế' WHEN nv.`CV` = N'lao_cong' THEN N'Lao công' ELSE N'Bảo vệ' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) 
OR (nv.`TCV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY nv.`created_at` DESC");
            $dsnv = array();
            $sl=0;
            if(!empty($ds_nv)){
                foreach ($ds_nv as $nv){
                    $nhanvien= nhan_vien::where('IdNV', $nv->IdNV)->get()->first();
                    
                    $ngaysinh=date("d/m/Y", strtotime($nhanvien->NgaySinh));
                    $gt="Nam";
                    if($nhanvien->GioiTinh == 0){
                        $gt="Nữ";
                    }

                    $dantoc ="Chưa cập nhật!";
                    if($nhanvien->DanToc != ''){
                        $dantoc = \comm_functions::decodeDanToc($nhanvien->DanToc);
                    }
                    $sdt ="Chưa cập nhật!";
                    if($nhanvien->SDT != ''){
                        $sdt = $nhanvien->SDT;
                    }
                    $scmnd="Chưa cập nhật!";
                    if($nhanvien->SoCMND != ''){
                        $scmnd=$nhanvien->SoCMND;
                    }
                    $anh=$nhanvien->Anh;
                    $diachi="";
                    if($nhanvien->DiaChi == ''){
                        $diachi="Xã ".$nhanvien->phuongXa->TenXa.", huyện ".$nhanvien->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$nhanvien->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $diachi=$nhanvien->DiaChi.", xã, ".$nhanvien->phuongXa->TenXa.", huyện ".$nhanvien->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$nhanvien->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }

                    $loainv='Hợp đồng';
                    if($nhanvien->LoaiNV == 1){
                        $loainv='Biên chế';
                    }
                    $ttnv= array(
                        'hoten' => $nhanvien->TenNV,
                        'ngaysinh' => $ngaysinh,
                        'gt' => $gt,
                        'scmnd' => $scmnd,
                        'sdt' => $sdt,
                        'diachi' => $diachi,
                        'dantoc' => $dantoc,
                        'anh' => $anh,
                        'id' => $nhanvien->IdNV,
                        'sdt'=>$nhanvien->SDT,
                        'email'=>$nhanvien->Email,
                        'trinhdo'=> \comm_functions::decodeTrinhDo($nhanvien->TrinhDo),
                        'chuyenmon'=>$nhanvien->ChuyenMon,
                        'loainv'=>$loainv,
                        'ngayvaolam'=>date('d/m/Y', strtotime($nhanvien->HopDongTuNgay)),
                        'phong'=>$nhanvien->phongBan->SoPhong.' - '.$nhanvien->phongBan->TenPhong
                    );
                    
                    $dsnv[]=$ttnv;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'nhanvien'=>$dsnv,
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

    public function postLayDSNV(){
        try{
            $ds_nv= nhan_vien::orderBy('created_at', 'DESC')->get();
            $dsnv=array();
            foreach ($ds_nv as $nhanvien){
                $ngaysinh=date( "d/m/Y", strtotime($nhanvien->NgaySinh));
                $gt="Nam";
                if($nhanvien->GioiTinh == 0){
                    $gt="Nữ";
                }

                $dantoc ="Chưa cập nhật!";
                if($nhanvien->DanToc != ''){
                    $dantoc = \comm_functions::decodeDanToc($nhanvien->DanToc);
                }
                $sdt ="Chưa cập nhật!";
                if($nhanvien->SDT != ''){
                    $sdt = $nhanvien->SDT;
                }
                $scmnd="Chưa cập nhật!";
                if($nhanvien->SoCMND != ''){
                    $scmnd=$nhanvien->SoCMND;
                }
                $anh=$nhanvien->Anh;
                $diachi="";
                if($nhanvien->DiaChi == ''){
                    $diachi="Xã ".$nhanvien->phuongXa->TenXa.", huyện ".$nhanvien->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$nhanvien->phuongXa->quanHuyen->tinhTP->TenTinh;
                }
                else{
                    $diachi=$nhanvien->DiaChi.", xã, ".$nhanvien->phuongXa->TenXa.", huyện ".$nhanvien->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$nhanvien->phuongXa->quanHuyen->tinhTP->TenTinh;
                }

                $loainv='Hợp đồng';
                if($nhanvien->LoaiNV == 1){
                    $loainv='Biên chế';
                }
                $ttnv= array(
                    'hoten' => $nhanvien->TenNV,
                    'ngaysinh' => $ngaysinh,
                    'gt' => $gt,
                    'scmnd' => $scmnd,
                    'sdt' => $sdt,
                    'diachi' => $diachi,
                    'dantoc' => $dantoc,
                    'anh' => $anh,
                    'id' => $nhanvien->IdNV,
                    'sdt'=>$nhanvien->SDT,
                    'email'=>$nhanvien->Email,
                    'trinhdo'=> \comm_functions::decodeTrinhDo($nhanvien->TrinhDo),
                    'chuyenmon'=>$nhanvien->ChuyenMon,
                    'loainv'=>$loainv,
                    'ngayvaolam'=>date('d/m/Y', strtotime($nhanvien->HopDongTuNgay)),
                    'phong'=>$nhanvien->phongBan->SoPhong.' - '.$nhanvien->phongBan->TenPhong
                );

                $dsnv[]=$ttnv;
            }
            $response = array(
                'msg' => 'tc',
                'nhanvien'=>$dsnv
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
    
    public static function TaoMaNN(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= nhan_vien::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $nv) {
                   if($nv->IdNV == $ran){
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

    public static function TaoMaNNCC(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= cham_cong_nv::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $cc) {
                   if($cc->IdCC == $ran){
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
