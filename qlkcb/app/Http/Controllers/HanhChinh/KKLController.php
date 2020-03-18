<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Models\HanhChinh\thong_ke;
use App\Models\HanhChinh\cham_cong_nv;

class KKLController extends Controller
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

        return view("hanh_chinh.ke_khai_tien_luong", ['dsbc'=>$sl]);
    }
    
    public function postKKL(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $tennv=$user->nhanVien->TenNV;
            
            $result_arr="";$result_arr_print = array(); $slbg=0;
            $ngaybd="";$ngaykt="";$sql_af="";
            $slphat=0;$slpc=0;$slt=0;$slbh=0;$slthuong=0;
            if($request->tgt == 'tuyytg'){
                $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgbd);
                $ngaykt= \DateTime::createFromFormat("d/m/Y", $request->tgkt);
                $sql_af="
                ((DAYOFMONTH(a.updated_at) >= ".$ngaybd->format('d')." AND MONTH(a.updated_at) >= ".$ngaybd->format('m')." AND YEAR(a.updated_at) >= ".$ngaybd->format('Y').")
                 AND 
                (DAYOFMONTH(a.updated_at) <=  ".$ngaykt->format('d')." AND MONTH(a.updated_at) <= ".$ngaykt->format('m')." AND YEAR(a.updated_at)<= ".$ngaykt->format('Y').")
                ) ";
            }
            else if($request->tgt == 'ngay'){
                $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgty);
                $sql_af="
                (DAYOFMONTH(a.updated_at) = ".$ngaybd->format('d')." AND MONTH(a.updated_at) = ".$ngaybd->format('m')." AND YEAR(a.updated_at) = ".$ngaybd->format('Y').") ";

            }
            else if($request->tgt == 'thang'){
                $ngaybd = \DateTime::createFromFormat("m/Y", $request->tgty);
                $sql_af="
                (MONTH(a.updated_at) = ".$ngaybd->format('m')." AND YEAR(a.updated_at) = ".$ngaybd->format('Y').") ";
            }
            else if($request->tgt == 'quy'){
                $ngaybd = \DateTime::createFromFormat("Y", $request->tgty);
                
                if($request->quy == 1){
                    $sql_af="
                ((MONTH(a.updated_at) >= 01 AND YEAR(a.updated_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(a.updated_at) <= 03 AND YEAR(a.updated_at)<= ".$ngaybd->format('Y')."))";
                }
                else if($request->quy == 2){
                    $sql_af="
                ((MONTH(a.updated_at) >= 04 AND YEAR(a.updated_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(a.updated_at) <= 06 AND YEAR(a.updated_at)<= ".$ngaybd->format('Y')."))";
                }
                else if($request->quy == 3){
                    $sql_af="
                ((MONTH(a.updated_at) >= 07 AND YEAR(a.updated_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(a.updated_at) <= 09 AND YEAR(a.updated_at)<= ".$ngaybd->format('Y')."))";
                }
                else{
                    $sql_af="
                ((MONTH(a.updated_at) >= 10 AND YEAR(a.updated_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(a.updated_at) <= 12 AND YEAR(a.updated_at)<= ".$ngaybd->format('Y')."))";
                }
            }
            else{
                $ngaybd = \DateTime::createFromFormat("Y", $request->tgty);
                $sql_af="
                (YEAR(a.updated_at) = ".$ngaybd->format('Y').") ";
            }
            $sql="SELECT a.`IdCC`  FROM cham_cong_nv AS a WHERE a.`TrangThai` = 1  AND ".$sql_af." ORDER BY a.`updated_at` DESC";
            $result_qr= DB::select($sql);
            if(!empty($result_qr)){
                foreach ($result_qr as $re_qr){
                    $cc= cham_cong_nv::where('IdCC', $re_qr->IdCC)->get()->first();
                    $loainv='Hợp đồng';
                    if($cc->nhanVien->LoaiNV == 1){
                        $loainv='Biên chế';
                    }
                    $cv='';$chuc_vu='';$i=1;
                    if(count($cc->nhanVien->chucVu) == 0){
                        $cv='Nhân viên';$chuc_vu='Nhân viên';
                    }
                    else{
                        foreach ($cc->nhanVien->chucVu as $value) {
                            if($i==count($cc->nhanVien->chucVu)){
                                $cv.='- '.$value->chucVu->TenCV;
                                $chuc_vu.=$value->chucVu->TenCV;
                            }
                            else{
                                $cv.='- '.$value->chucVu->TenCV.'<br>';
                                $chuc_vu.=$value->chucVu->TenCV.'; ';
                            }
                            $i++;
                        }
                    }
                    $hspc=0;
                    $lcb=\comm_functions::getLCB(\comm_functions::getHSL($cc->nhanVien->CV, $cc->nhanVien->BL));
                    foreach($cc->nhanVien->chucVu as $c_v){
                        $hspc+=$c_v->chucVu->HSPCCV;
                    }
                    $lpc=\comm_functions::getLPC($hspc);
                    $luongngay=($lcb+$lpc)/26;
                    $tl=($luongngay*$cc->SoNgayCong)+$cc->Thuong-$cc->TienPhat;
                    $result_arr.="<tr class='tr-shadow'>
                        <td style='vertical-align: middle' class='text-left'>".$cc->nhanVien->TenNV."</td>
                        <td>".$loainv."</td>
                        <td class='text-left'>".\comm_functions::decodeCongViec($cc->nhanVien->CV)."</td>
                        <td class='text-left'>".$cv."</td>
                        <td class='text-right'>".$cc->SoNgayCong."</td>
                        <td class='text-right'>".\comm_functions::getHSL($cc->nhanVien->CV, $cc->nhanVien->BL)."</td>
                        <td class='text-right'>".number_format(\comm_functions::getLCB(\comm_functions::getHSL($cc->nhanVien->CV, $cc->nhanVien->BL)))."</td>
                        <td class='text-right'>".number_format(\comm_functions::getLPC($hspc))."</td>
                        <td class='text-right'>".number_format($cc->Thuong)."</td>
                        <td class='text-right'>".number_format($cc->TienPhat)."</td>
                        <td class='text-right'>".number_format($tl*(10.5/100))."</td>
                        <td class='text-right'>".number_format($tl - ($tl*(10.5/100)))."</td>
                    <tr class='spacer'></tr>";

                    $slbg=$slbg+1;
                    $result="<tr class='text-center'>
                    <td>".$slbg."</td>
                    <td style='vertical-align: middle' class='text-left'>".$cc->nhanVien->TenNV."</td>
                        <td class='text-left'>".$chuc_vu."</td>
                        <td class='text-right'>".$cc->SoNgayCong."</td>
                        <td class='text-right'>".\comm_functions::getHSL($cc->nhanVien->CV, $cc->nhanVien->BL)."</td>
                        <td class='text-right'>".number_format(\comm_functions::getLCB(\comm_functions::getHSL($cc->nhanVien->CV, $cc->nhanVien->BL)))."</td>
                        <td class='text-right'>".number_format(\comm_functions::getLPC($hspc))."</td>
                        <td class='text-right'>".number_format($cc->Thuong)."</td>
                        <td class='text-right'>".number_format($cc->TienPhat)."</td>
                        <td class='text-right'>".number_format($tl*(10.5/100))."</td>
                        <td class='text-right'>".number_format($tl - ($tl*(10.5/100)))."</td>
                    </tr>";
                    $result_arr_print[]=$result;
                    $slt+=$tl - ($tl*(10.5/100));$slbh+=$tl*(10.5/100);$slthuong+=$cc->Thuong;$slphat+=$cc->TienPhat;$slpc+=\comm_functions::getLPC($hspc);
                }
            }
            $response = array(
                'msg' => 'tc',
                'result'=>$result_arr,
                'result_print'=>$result_arr_print,
                'slphat'=> number_format($slphat),
                'slpc'=> number_format($slpc),
                'slt'=> number_format($slt),
                'slbh'=> number_format($slbh),
                'slthuong'=> number_format($slthuong),
                'slbg'=>$slbg,
                'tennv'=>$tennv
            );

            return response()->json($response); 
        }
        catch (\Exception $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
}
