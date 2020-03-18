<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Models\HanhChinh\thong_ke;

class thongKeController extends Controller
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
        return view("hanh_chinh.thong_ke_thuoc_ton_kho", ['dsbc'=>$sl]);
    }

    public function postLocDS(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $tennv=$user->nhanVien->TenNV;

            $sql="";
            $result_arr="";$result_arr_print = array();
            
            if($request->pl == 'all'){
                $sql="SELECT * FROM danh_muc_thuoc ORDER BY `SL` ASC, `TenThuoc` ASC";
            }
            else if($request->pl == '0'){
                $sql="SELECT * FROM danh_muc_thuoc WHERE `DanhMucBHYT` = 0 ORDER BY `SL` ASC, `TenThuoc` ASC";
            }
            else{
                $sql="SELECT * FROM danh_muc_thuoc WHERE `DanhMucBHYT` = 1 ORDER BY `SL` ASC, `TenThuoc` ASC";
            }
            $result_qr= DB::select($sql);
            $slbg=0;
            if(!empty($result_qr)){
                foreach ($result_qr as $re_qr){
                    $result_arr.="<tr class='tr-shadow'>
                        <td style='vertical-align: middle' class='text-left'>".$re_qr->TenThuoc."</td>
                        <td>".$re_qr->NSX."</td>
                        <td>".$re_qr->NCU."</td>
                        <td>".date('d/m/Y', strtotime($re_qr->NgaySX))."</td>
                        <td>".date('d/m/Y', strtotime($re_qr->NgayHH))."</td>
                        <td>".number_format($re_qr->DonGiaNhap)."</td>
                        <td>".$re_qr->DonViTinh."</td>
                        <td>".number_format($re_qr->SL)."</td>
                    <tr class='spacer'></tr>";

                    $slbg=$slbg+1;
                    $result="<tr class='text-center'>
                    <td>".$slbg."</td>
                    <td class='text-left'>".$re_qr->TenThuoc."</td>
                    <td>".$re_qr->NSX."</td>
                    <td>".$re_qr->NCU."</td>
                    <td>".date('d/m/Y', strtotime($re_qr->NgaySX))."</td>
                    <td>".date('d/m/Y', strtotime($re_qr->NgayHH))."</td>
                    <td>".number_format($re_qr->DonGiaNhap)."</td>
                    <td>".$re_qr->DonViTinh."</td>
                    <td class='font-weight-bold'>".number_format($re_qr->SL)."</td>
                    </tr>";
                    $result_arr_print[]=$result;
                }
            }
            $response = array(
                'msg' => 'tc',
                'result'=>$result_arr,
                'result_print'=>$result_arr_print,
                'slbg'=>$slbg,
                'nv'=>mb_convert_case($tennv,MB_CASE_UPPER,'UTF-8')
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
