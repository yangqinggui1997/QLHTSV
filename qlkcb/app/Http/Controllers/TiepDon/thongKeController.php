<?php

namespace App\Http\Controllers\TiepDon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\tinh_tp;
use App\Models\HanhChinh\khoa;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class thongKeController extends Controller
{
    //
    
    public function getDanhSach(){
        $dskhoa= khoa::where('KhoaKham', 1)->orderBy('TenKhoa', 'ASC')->get();
        $tinh= tinh_tp::orderBy('TenTinh', 'ASC')->get();
        return view("tiep_don.thong_ke",['dstinh'=>$tinh, 'dskhoa' => $dskhoa]);
    }
    
    public static function getsql_tc_khoa($param){
        return "SELECT DISTINCT RS.* FROM
        (SELECT k.`IdKhoa`, k.`TenKhoa`, IFNULL(
                SUM( ".$param." ), 
                0) AS SLT, IFNULL(
                SUM( pdk.`KhamBHYT` = 0 AND ".$param." ), 
                0) AS SLBH, IFNULL(
                SUM( pdk.`KhamBHYT` = 1 AND ".$param." ), 
                0) AS SLTP, IFNULL(
                SUM( pdk.`DTTN` = 0 AND ".$param." ), 
                0) AS SLKT, IFNULL(
                SUM( pdk.`DTTN` = 1 AND ".$param." ), 
                0) AS SLCC, IFNULL(
                SUM( pdk.`TuyenKham` = 0 AND ".$param." ), 
                0) AS SLDT, IFNULL(
                SUM( (pdk.`TuyenKham` = 1 OR pdk.`TuyenKham` = 2) AND ".$param." ), 
                0) AS SLVT, IFNULL(
                SUM( pdk.`GiayChuyen` = 1 AND ".$param." ), 
                0) AS SLCGC, IFNULL(
                SUM( pdk.`GiayChuyen` = 0 AND ".$param." ), 
                0) AS SLKCGC FROM khoa AS k left join phong_ban as pb on k.`IdKhoa`=pb.`IdKhoa` left join phieu_dk_kham as pdk on pb.`IdPB` = pdk.`IdPK` left join benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` LEFT JOIN phuong_xa AS px ON px.`IdXa` = bn.`IdXa` LEFT JOIN quan_huyen AS qh ON qh.`IdHuyen` = px.`IdHuyen` LEFT JOIN tinh_tp AS tp ON tp.`IdTinh` = qh.`IdTinh` WHERE k.`KhoaKham` = 1 GROUP BY k.`IdKhoa`, k.`TenKhoa`
                UNION ALL
        SELECT  k.`IdKhoa`, k.`TenKhoa`, IFNULL(
                SUM( ".$param." ), 
                0) AS SLT, IFNULL(
                SUM( pdk.`KhamBHYT` = 0 AND ".$param." ), 
                0) AS SLBH, IFNULL(
                SUM( pdk.`KhamBHYT` = 1 AND ".$param." ), 
                0) AS SLTP, IFNULL(
                SUM( pdk.`DTTN` = 0 AND ".$param." ), 
                0) AS SLKT, IFNULL(
                SUM( pdk.`DTTN` = 1 AND ".$param." ), 
                0) AS SLCC, IFNULL(
                SUM( pdk.`TuyenKham` = 0 AND ".$param." ), 
                0) AS SLDT, IFNULL(
                SUM( (pdk.`TuyenKham` = 1 OR pdk.`TuyenKham` = 2) AND ".$param." ), 
                0) AS SLVT, IFNULL(
                SUM( pdk.`GiayChuyen` = 1 AND ".$param." ), 
                0) AS SLCGC, IFNULL(
                SUM( pdk.`GiayChuyen` = 0 AND ".$param." ), 
                0) AS SLKCGC FROM tinh_tp AS tp right JOIN quan_huyen AS qh ON tp.`IdTinh` = qh.`IdTinh` right JOIN phuong_xa AS px ON qh.`IdHuyen` = px.`IdHuyen` right JOIN benh_nhan AS bn ON px.`IdXa` = bn.`IdXa` right join phieu_dk_kham as pdk on pdk.`IdBN` = bn.`IdBN` right join phong_ban as pb on pb.`IdPB` = pdk.`IdPK` right join khoa AS k on k.`IdKhoa`=pb.`IdKhoa` WHERE k.`KhoaKham` = 1 GROUP BY k.`IdKhoa`, k.`TenKhoa`)
    AS RS ORDER BY RS.`TenKhoa` ASC";
    }
    
    public static function getsql_khoa($param, $khoa){
        return "SELECT DISTINCT RS.* FROM
        (SELECT k.`IdKhoa`, k.`TenKhoa`, IFNULL(
                SUM( ".$param." ), 
                0) AS SLT, IFNULL(
                SUM( pdk.`KhamBHYT` = 0 AND ".$param." ), 
                0) AS SLBH, IFNULL(
                SUM( pdk.`KhamBHYT` = 1 AND ".$param." ), 
                0) AS SLTP, IFNULL(
                SUM( pdk.`DTTN` = 0 AND ".$param." ), 
                0) AS SLKT, IFNULL(
                SUM( pdk.`DTTN` = 1 AND ".$param." ), 
                0) AS SLCC, IFNULL(
                SUM( pdk.`TuyenKham` = 0 AND ".$param." ), 
                0) AS SLDT, IFNULL(
                SUM( (pdk.`TuyenKham` = 1 OR pdk.`TuyenKham` = 2) AND ".$param." ), 
                0) AS SLVT, IFNULL(
                SUM( pdk.`GiayChuyen` = 1 AND ".$param." ), 
                0) AS SLCGC, IFNULL(
                SUM( pdk.`GiayChuyen` = 0 AND ".$param." ), 
                0) AS SLKCGC FROM khoa AS k left join phong_ban as pb on k.`IdKhoa`=pb.`IdKhoa` left join phieu_dk_kham as pdk on pb.`IdPB` = pdk.`IdPK` left join benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` LEFT JOIN phuong_xa AS px ON px.`IdXa` = bn.`IdXa` LEFT JOIN quan_huyen AS qh ON qh.`IdHuyen` = px.`IdHuyen` LEFT JOIN tinh_tp AS tp ON tp.`IdTinh` = qh.`IdTinh` WHERE k.`IdKhoa` = N'".$khoa."' GROUP BY k.`IdKhoa`, k.`TenKhoa`
                UNION ALL
        SELECT  k.`IdKhoa`, k.`TenKhoa`, IFNULL(
                SUM( ".$param." ), 
                0) AS SLT, IFNULL(
                SUM( pdk.`KhamBHYT` = 0 AND ".$param." ), 
                0) AS SLBH, IFNULL(
                SUM( pdk.`KhamBHYT` = 1 AND ".$param." ), 
                0) AS SLTP, IFNULL(
                SUM( pdk.`DTTN` = 0 AND ".$param." ), 
                0) AS SLKT, IFNULL(
                SUM( pdk.`DTTN` = 1 AND ".$param." ), 
                0) AS SLCC, IFNULL(
                SUM( pdk.`TuyenKham` = 0 AND ".$param." ), 
                0) AS SLDT, IFNULL(
                SUM( (pdk.`TuyenKham` = 1 OR pdk.`TuyenKham` = 2) AND ".$param." ), 
                0) AS SLVT, IFNULL(
                SUM( pdk.`GiayChuyen` = 1 AND ".$param." ), 
                0) AS SLCGC, IFNULL(
                SUM( pdk.`GiayChuyen` = 0 AND ".$param." ), 
                0) AS SLKCGC FROM tinh_tp AS tp right JOIN quan_huyen AS qh ON tp.`IdTinh` = qh.`IdTinh` right JOIN phuong_xa AS px ON qh.`IdHuyen` = px.`IdHuyen` right JOIN benh_nhan AS bn ON px.`IdXa` = bn.`IdXa` right join phieu_dk_kham as pdk on pdk.`IdBN` = bn.`IdBN` right join phong_ban as pb on pb.`IdPB` = pdk.`IdPK` right join khoa AS k on k.`IdKhoa`=pb.`IdKhoa` WHERE k.`IdKhoa` = N'".$khoa."' GROUP BY k.`IdKhoa`, k.`TenKhoa`)
    AS RS";
    }

    public function postLocDS(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $tennv=$user->nhanVien->TenNV;

            $sql="";
            $arr=array();
            $result_qr="";$result_arr="";$result_arr_print = array(); $slbg=0;
            $ngaybd="";$ngaykt="";$sql_af="";$slt=0;$slbh=0;$sltp=0;$slkt=0;$slcc=0;$sldt=0;$slvt=0;$slcgc=0;$slkcgc=0;
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
            if($request->tgt == 'tuyytg'){
                $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgbd);
                $ngaykt= \DateTime::createFromFormat("d/m/Y", $request->tgkt);
                $sql_af="
                ((DAYOFMONTH(pdk.created_at) >= ".$ngaybd->format('d')." AND MONTH(pdk.created_at) >= ".$ngaybd->format('m')." AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').")
                 AND 
                (DAYOFMONTH(pdk.created_at) <=  ".$ngaykt->format('d')." AND MONTH(pdk.created_at) <= ".$ngaykt->format('m')." AND YEAR(pdk.created_at)<= ".$ngaykt->format('Y').")
                ) ";
            }
            else if($request->tgt == 'ngay'){
                $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgty);
                $sql_af="
                (DAYOFMONTH(pdk.created_at) = ".$ngaybd->format('d')." AND MONTH(pdk.created_at) = ".$ngaybd->format('m')." AND YEAR(pdk.created_at) = ".$ngaybd->format('Y').") ";

            }
            else if($request->tgt == 'thang'){
                $ngaybd = \DateTime::createFromFormat("m/Y", $request->tgty);
                $sql_af="
                (MONTH(pdk.created_at) = ".$ngaybd->format('m')." AND YEAR(pdk.created_at) = ".$ngaybd->format('Y').") ";
            }
            else if($request->tgt == 'quy'){
                $ngaybd = \DateTime::createFromFormat("Y", $request->tgty);
                
                if($request->quy == 1){
                    $sql_af="
                ((MONTH(pdk.created_at) >= 01 AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(pdk.created_at) <= 03 AND YEAR(pdk.created_at)<= ".$ngaybd->format('Y')."))";
                }
                else if($request->quy == 2){
                    $sql_af="
                ((MONTH(pdk.created_at) >= 04 AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(pdk.created_at) <= 06 AND YEAR(pdk.created_at)<= ".$ngaybd->format('Y')."))";
                }
                else if($request->quy == 3){
                    $sql_af="
                ((MONTH(pdk.created_at) >= 07 AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(pdk.created_at) <= 09 AND YEAR(pdk.created_at)<= ".$ngaybd->format('Y')."))";
                }
                else{
                    $sql_af="
                ((MONTH(pdk.created_at) >= 10 AND YEAR(pdk.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(pdk.created_at) <= 12 AND YEAR(pdk.created_at)<= ".$ngaybd->format('Y')."))";
                }
            }
            else{
                $ngaybd = \DateTime::createFromFormat("Y", $request->tgty);
                $sql_af="
                (YEAR(pdk.created_at) = ".$ngaybd->format('Y').") ";
            }
            if($request->hanhdong == 'tk' || $request->hanhdong == 'tktk')
            {
                if($request->hanhdong == 'tk')
                {
                    switch($arr){
                        case ['notall', 'notall', 'notall']:
                            $sql= thongKeController::getsql_tc_khoa($sql_af." AND tp.`IdTinh` = N'".$request->tinh."' AND qh.`IdHuyen` = N'".$request->huyen."' AND px.`IdXa` = '".$request->xa."'");break;

                        case ['notall','notall', 'all']:
                            $sql= thongKeController::getsql_tc_khoa($sql_af." AND tp.`IdTinh` = N'".$request->tinh."' AND qh.`IdHuyen` = N'".$request->huyen."'");break;

                        case ['notall', 'all', 'all']:
                            $sql= thongKeController::getsql_tc_khoa($sql_af." AND tp.`IdTinh` = N'".$request->tinh."'");break;

                        default:
                            $sql= thongKeController::getsql_tc_khoa($sql_af);break;
                    }
                }
                else{
                    switch($arr){
                        case ['notall', 'notall', 'notall']:
                            $sql= thongKeController::getsql_khoa($sql_af." AND tp.`IdTinh` = N'".$request->tinh."' AND qh.`IdHuyen` = N'".$request->huyen."' AND px.`IdXa` = '".$request->xa."'", $request->idkhoa);break;

                        case ['notall','notall', 'all']:
                            $sql= thongKeController::getsql_khoa($sql_af." AND tp.`IdTinh` = N'".$request->tinh."' AND qh.`IdHuyen` = N'".$request->huyen."'", $request->idkhoa);break;

                        case ['notall', 'all', 'all']:
                            $sql= thongKeController::getsql_khoa($sql_af." AND tp.`IdTinh` = N'".$request->tinh."'", $request->idkhoa);break;

                        default:
                            $sql= thongKeController::getsql_khoa($sql_af, $request->idkhoa);break;
                    }
                }
                $result_qr= DB::select($sql);
                $flag=FALSE;
                if(!empty($result_qr)){
                    foreach ($result_qr as $re_qr){
                        $result_arr.="<tr class='tr-shadow' data-khoa='".$re_qr->IdKhoa."'>
                            <td style='vertical-align: middle' class='text-left'>".$re_qr->TenKhoa."</td>
                            <td>".$re_qr->SLT."</td>
                            <td>".$re_qr->SLBH."</td>
                            <td>".$re_qr->SLTP."</td>
                            <td>".$re_qr->SLCC."</td>
                            <td>".$re_qr->SLKT."</td>
                            <td>".$re_qr->SLDT."</td>
                            <td>".$re_qr->SLVT."</td>
                            <td>".$re_qr->SLCGC."</td>
                            <td>".$re_qr->SLKCGC."</td>
                            <td>
                                <div class='table-data-feature'>
                                    <button class='item' rel='tooltip' title='Xem chi tiết' data-toggle='modal' data-target='#mdxtq' data-placement='top' data-button='xemtq' data-id='".$re_qr->IdKhoa."' data-tenkhoa='".$re_qr->TenKhoa."'>
                                        <i class='fa fa-list-alt'></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class='spacer'></tr>";

                        $slbg=$slbg+1;
                        $result="<tr class='text-center'>
                        <td>".$slbg."</td>
                        <td class='text-left'>".$re_qr->TenKhoa."</td>
                        <td class='font-weight-bold'>".$re_qr->SLT."</td>
                        <td>".$re_qr->SLBH."</td>
                        <td>".$re_qr->SLTP."</td>
                        <td>".$re_qr->SLCC."</td>
                        <td>".$re_qr->SLKT."</td>
                        <td>".$re_qr->SLDT."</td>
                        <td>".$re_qr->SLVT."</td>
                        <td>".$re_qr->SLCGC."</td>
                        <td>".$re_qr->SLKCGC."</td>
                        </tr>";
                        $result_arr_print[]=$result;
                        
                        $slt+=$re_qr->SLT; $slbh+=$re_qr->SLBH; $sltp+=$re_qr->SLTP; $slcc+=$re_qr->SLCC; $slkt+=$re_qr->SLKT; $sldt+=$re_qr->SLDT; $slvt+=$re_qr->SLVT; $slcgc+=$re_qr->SLCGC; $slkcgc+=$re_qr->SLKCGC;
                    }
                }
            }
            else{
                switch($arr){
                    case ['notall', 'notall', 'notall']:
                        $sql= "SELECT pdk.*, bn.`HoTen`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham AS pdk JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` WHERE ".$sql_af." AND k.`IdKhoa` = ".$request->khoa." AND ".$sql_af." AND tp.`IdTinh` = N'".$request->tinh."' AND qh.`IdHuyen` = N'".$request->huyen."' AND px.`IdXa` =N'".$request->xa."' ORDER BY pdk.`created_at` DESC";break;

                    case ['notall','notall', 'all']:
                        $sql= "SELECT pdk.*, bn.`HoTen`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham AS pdk JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` WHERE ".$sql_af." AND k.`IdKhoa` = ".$request->khoa." AND ".$sql_af." AND tp.`IdTinh` = N'".$request->tinh."' AND qh.`IdHuyen` = N'".$request->huyen."' ORDER BY pdk.`created_at` DESC";break;

                    case ['notall', 'all', 'all']:
                        $sql= "SELECT pdk.*, bn.`HoTen`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham AS pdk JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` WHERE ".$sql_af." AND k.`IdKhoa` = ".$request->khoa." AND ".$sql_af." AND tp.`IdTinh` = N'".$request->tinh."' ORDER BY pdk.`created_at` DESC";break;

                    default:
                        $sql= "SELECT pdk.*, bn.`HoTen`, pb.`TenPhong`, pb.`SoPhong` FROM phieu_dk_kham AS pdk JOIN phong_ban AS pb ON pdk.`IdPK` = pb.`IdPB` JOIN khoa AS k ON pb.`IdKhoa` = k.`IdKhoa` JOIN benh_nhan AS bn ON pdk.`IdBN` = bn.`IdBN` JOIN phuong_xa AS px ON bn.`IdXa` = px.`IdXa` JOIN quan_huyen AS qh ON px.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON qh.`IdTinh` = tp.`IdTinh` WHERE ".$sql_af." AND k.`IdKhoa` = ".$request->khoa." AND ".$sql_af." ORDER BY pdk.`created_at` DESC";break;
                }
                $result_qr= DB::select($sql);
                if(!empty($result_qr)){
                    $i=1;
                    foreach ($result_qr as $re_qr){
                        $htk='BHYT';$tuyen='Đúng tuyến';$giaychuyen='Không có giấy chuyển';
                        if($re_qr->KhamBHYT == 1){
                            $htk='Thu phí';
                        }
                        if($re_qr->TuyenKham == 1 || $re_qr->TuyenKham == 2){
                            $tuyen='Vượt tuyến';
                        }
                        if($re_qr->GiayChuyen == 1){
                            $giaychuyen='Có giấy chuyển';
                        }
                        $ngaydk=date( "d/m/Y", strtotime($re_qr->created_at));
                        $result_arr.="<tr>
                            <td>".$i."</td>
                            <td>".$re_qr->HoTen."</td>
                            <td>".$re_qr->SoPhong." - ".$re_qr->TenPhong."</td>
                            <td>".$htk."</td>
                            <td>".$tuyen."</td>
                            <td>".$giaychuyen."</td>
                            <td>".$ngaydk."</td>
                        </tr>";
                        $i++;
                    }
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'result'=>$result_arr,
                'result_print'=>$result_arr_print,
                'slt'=>$slt,
                'slbh'=>$slbh,
                'sltp'=>$sltp,
                'slkt'=>$slkt,
                'slcc'=>$slcc,
                'sldt'=>$sldt,
                'slvt'=>$slvt,
                'slcgc'=>$slcgc,
                'slkcgc'=>$slkcgc,
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
