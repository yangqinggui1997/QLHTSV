<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\HanhChinh\danh_muc_benh;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\KhamVaDieuTri\toa_thuoc_vs_benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\toa_thuoc;
use App\Models\HanhChinh\danh_muc_thuoc;
use App\Models\HanhChinh\danh_muc_benh_vs_thuoc;
use App\Models\KhamVaDieuTri\toa_thuoc_ct;
use App\Models\TiepDon\phieu_dk_kham;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\HanhChinh\thong_ke;

class ToaThuocNgoaiTruController extends Controller
{
    //
    
    public function getDanhSach(){
        $dstoa=array();
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $dsba='';
        if($user->Quyen == 'bsk'){
            $dsba= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach ($dsba as $value){
                if(is_object($value->toaThuoc)){
                    $dstoa[]=$value->toaThuoc->toaThuoc;
                }
            }
        }
        else{
            $dsba= benh_an_ngoai_tru::orderBy('created_at', 'DESC')->get();
            foreach ($dsba as $value){
                if(is_object($value->toaThuoc)){
                    if($value->toaThuoc->toaThuoc->TTLanhThuoc == 0 && date('d/m/Y') == date('d/m/Y', strtotime($value->toaThuoc->toaThuoc->created_at))){
                        $dstoa[]=$value->toaThuoc->toaThuoc;
                    }
                }
            }
        }
        
        $ds= ba_nv::where('IdNV',$idnv)->orderBy('created_at', 'DESC')->get();
        
        $dsbachotn=array();
        foreach($ds as $tn){
            $banoi= benh_an_noi_tru::where('IdBANoiT', $tn->IdBANoiT)->get()->first();
            
            if(is_object($banoi)){
                $dsbachotn[]=$banoi;
            }
        }
        
        $dsbc= thong_ke::where([['PhanLoai','grv'], ['IdNV', '<>', $idnv]])->get();
        $sl=[];
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

        return view("kham_vs_dieu_tri.toa_thuoc_ngoai_tru", ['dstoa'=>$dstoa, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    
    public function postDanhSachCT(Request $request){
        try{
            if($request->idtt == ''){
                $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
                if(is_object($ba->toaThuoc)){//Đã lập toa
                    $dstoact = array();
                    foreach ($ba->toaThuoc->toaThuoc->toaThuocCT as $toact){
                        $lieudung= explode('|', $toact->LieuDung);
                        $sang='';$trua='';$chieu='';$toi='';
                        if(is_array($lieudung)){
                            foreach ($lieudung as $value) {
                                $tg= explode(':', $value);
                                if(is_array($tg)){
                                    if($tg[0] == 'sang')
                                    {
                                        $sang=$tg[1];
                                    }
                                    else if($tg[0] == 'trua'){
                                        $trua=$tg[1];
                                    }
                                    else if($tg[0] == 'chieu'){
                                        $chieu=$tg[1];
                                    }
                                    else{
                                        $toi=$tg[1];
                                    }
                                }
                            }
                        }
                        else{
                            $tg= explode(':', $toact->LieuDung);
                            if(is_array($tg)){
                                if($tg[0] == 'sang')
                                {
                                    $sang=$tg[1];
                                }
                                else if($tg[0] == 'trua'){
                                    $trua=$tg[1];
                                }
                                else if($tg[0] == 'chieu'){
                                    $chieu=$tg[1];
                                }
                                else{
                                    $toi=$tg[1];
                                }
                            }
                        }
                        
                        $lieudung='';
                        if($sang != ''){
                            $lieudung='Sáng';
                        }
                        if($trua != ''){
                            if($sang != ''){
                                $lieudung.=', trưa';
                            }
                            else{
                                $lieudung.='Trưa';
                            }

                        }
                        if($chieu != ''){
                            if($sang != ''){
                                 $lieudung.=', chiều';
                            }
                            else{
                                if($trua != ''){
                                    $lieudung.=', chiều';
                                }
                                else{
                                    $lieudung.='Chiều';
                                }
                            }
                        }
                        if($toi != ''){
                            if($sang != ''){
                                $lieudung.=', tối';
                            }
                            else{
                                if($trua != ''){
                                    $lieudung.=', tối';
                                }
                                else{
                                    if($chieu != ''){
                                        $lieudung.=', tối';
                                    }
                                    else{
                                        $lieudung.='Tối';
                                    }
                                }
                            }
                        }
                        $ghichuct = $toact->GhiChu;
                        if($toact->GhiChu == ''){
                            $ghichuct = 'Không có';
                        }
                        $tttoathuoc= array(
                            'tenthuoc' => $toact->danhMucThuoc->TenThuoc,
                            'dvt' => $toact->danhMucThuoc->DonViTinh,
                            'cachdung' => \comm_functions::getCachDungThuoc($toact->danhMucThuoc->PhanLoai),
                            'lieudung' => $lieudung,
                            'sl' => $toact->TST,
                            'idthuoc' => $toact->danhMucThuoc->IdThuoc,
                            'idtt'=>$toact->IdTT,
                            'ghichu'=>$ghichuct

                        );
                        $dstoact[]=$tttoathuoc;
                    }
                    $ghichu = $ba->toaThuoc->toaThuoc->GhiChu;
                    
                    $dsthuoc='';
                    $thuoc=[];
                    foreach ($ba->chuanDoan as $cd) {
                        $dsbenh= danh_muc_benh::where("IdBenh", $cd->danhMucBenh->IdBenh)->get()->first();
                        foreach ($dsbenh->benhVSThuoc as $bt){
                            $flag=FALSE;
                            foreach ($thuoc as $value) {
                                if($value == $bt->danhMucThuoc->IdThuoc){
                                    $flag=TRUE;
                                    break;
                                }
                            }
                            if($flag == FALSE){
                                $thuoc[]=$bt->danhMucThuoc->IdThuoc;
                            }
                        }
                    }
                    $arr_t=[];
                    foreach ($thuoc as $val) {
                        $t= danh_muc_thuoc::where('IdThuoc', $val)->get()->first();
                        $b_vs_t='';$i=1;$m_t_b=[];
                        foreach ($ba->chuanDoan as $cd) {
                            foreach ($t->benhVSThuoc as $v) {
                                if($cd->danhMucBenh->IdBenh == $v->danhMucBenh->IdBenh){
                                    $m_t_b[]=$v->danhMucBenh->TenBenh;
                                    break;
                                }
                            }
                        }

                        foreach ($m_t_b as $t_b){
                            if($i == count($m_t_b)){
                                $b_vs_t.=$t_b;
                            }
                            else{
                                $b_vs_t.=$t_b.'; ';
                            }
                            $i++;
                        }

                        $arr_t[]=['dvt'=>$t->DonViTinh, 'id'=>$val, 'tenthuoc'=>$t->TenThuoc, 'tenbenh'=>$b_vs_t, 'tp'=>$t->ThanhPhan];
                    }
                    if(count($ba->chuanDoan)>1){
                        foreach ($arr_t as $at) {
                            $dsthuoc.='<option data-dvt="'.$at['dvt'].'" data-value="'.$at['id'].'" value="'.$at['tenthuoc'].' - Điều trị '.$at['tenbenh'].'">'.$at['tp'].'</option>';
                        }
                    }
                    else{
                        foreach ($arr_t as $at) {
                            $dsthuoc.='<option data-dvt="'.$at['dvt'].'" data-value="'.$at['id'].'" value="'.$at['tenthuoc'].'">'.$at['tp'].'</option>';
                        }
                    }
                    
                    $response = array(
                        'msg' => 'cotoa',
                        'dstoact'=>$dstoact,
                        'ghichu'=>$ghichu,
                        'idtt'=>$ba->toaThuoc->toaThuoc->IdTT,
                        'dsthuoc'=>$dsthuoc
                    );

                    return response()->json($response); 
                }
                else{
                    $dsthuoc='';
                    $thuoc=[];
                    foreach ($ba->chuanDoan as $cd) {
                        $dsbenh= danh_muc_benh::where("IdBenh", $cd->danhMucBenh->IdBenh)->get()->first();
                        foreach ($dsbenh->benhVSThuoc as $bt){
                            $flag=FALSE;
                            foreach ($thuoc as $value) {
                                if($value == $bt->danhMucThuoc->IdThuoc){
                                    $flag=TRUE;
                                    break;
                                }
                            }
                            if($flag == FALSE){
                                $thuoc[]=$bt->danhMucThuoc->IdThuoc;
                            }
                        }
                    }
                    $arr_t=[];
                    foreach ($thuoc as $val) {
                        $t= danh_muc_thuoc::where('IdThuoc', $val)->get()->first();
                        $b_vs_t='';$i=1;$m_t_b=[];
                        foreach ($ba->chuanDoan as $cd) {
                            foreach ($t->benhVSThuoc as $v) {
                                if($cd->danhMucBenh->IdBenh == $v->danhMucBenh->IdBenh){
                                    $m_t_b[]=$v->danhMucBenh->TenBenh;
                                    break;
                                }
                            }
                        }

                        foreach ($m_t_b as $t_b){
                            if($i == count($m_t_b)){
                                $b_vs_t.=$t_b;
                            }
                            else{
                                $b_vs_t.=$t_b.'; ';
                            }
                            $i++;
                        }

                        $arr_t[]=['dvt'=>$t->DonViTinh, 'id'=>$val, 'tenthuoc'=>$t->TenThuoc, 'tenbenh'=>$b_vs_t, 'tp'=>$t->ThanhPhan];
                    }
                    if(count($ba->chuanDoan)>1){
                        foreach ($arr_t as $at) {
                            $dsthuoc.='<option data-dvt="'.$at['dvt'].'" data-value="'.$at['id'].'" value="'.$at['tenthuoc'].' - Điều trị '.$at['tenbenh'].'">'.$at['tp'].'</option>';
                        }
                    }
                    else{
                        foreach ($arr_t as $at) {
                            $dsthuoc.='<option data-dvt="'.$at['dvt'].'" data-value="'.$at['id'].'" value="'.$at['tenthuoc'].'">'.$at['tp'].'</option>';
                        }
                    }
                    
                    $response = array(
                        'msg' => 'koco',
                        'dsthuoc'=>$dsthuoc
                    );

                    return response()->json($response); 
                }
            }
            else{
                $toa= toa_thuoc::where('IdTT', $request->idtt)->get()->first();
                $dstoact = array();
                if(is_object($toa)){
                    foreach ($toa->toaThuocCT as $toact){
                        $lieudung= explode('|', $toact->LieuDung);
                        $sang='';$trua='';$chieu='';$toi='';
                        if(is_array($lieudung)){
                            foreach ($lieudung as $value) {
                                $tg= explode(':', $value);
                                if(is_array($tg)){
                                    if($tg[0] == 'sang')
                                    {
                                        $sang=$tg[1];
                                    }
                                    else if($tg[0] == 'trua'){
                                        $trua=$tg[1];
                                    }
                                    else if($tg[0] == 'chieu'){
                                        $chieu=$tg[1];
                                    }
                                    else{
                                        $toi=$tg[1];
                                    }
                                }
                            }
                        }
                        else{
                            $tg= explode(':', $toact->LieuDung);
                            if(is_array($tg)){
                                if($tg[0] == 'sang')
                                {
                                    $sang=$tg[1];
                                }
                                else if($tg[0] == 'trua'){
                                    $trua=$tg[1];
                                }
                                else if($tg[0] == 'chieu'){
                                    $chieu=$tg[1];
                                }
                                else{
                                    $toi=$tg[1];
                                }
                            }
                        }
                        $lieudung='';
                        if($sang != ''){
                            $lieudung='Sáng';
                        }
                        if($trua != ''){
                            if($sang != ''){
                                $lieudung.=', trưa';
                            }
                            else{
                                $lieudung.='Trưa';
                            }

                        }
                        if($chieu != ''){
                            if($sang != ''){
                                 $lieudung.=', chiều';
                            }
                            else{
                                if($trua != ''){
                                    $lieudung.=', chiều';
                                }
                                else{
                                    $lieudung.='Chiều';
                                }
                            }
                        }
                        if($toi != ''){
                            if($sang != ''){
                                $lieudung.=', tối';
                            }
                            else{
                                if($trua != ''){
                                    $lieudung.=', tối';
                                }
                                else{
                                    if($chieu != ''){
                                        $lieudung.=', tối';
                                    }
                                    else{
                                        $lieudung.='Tối';
                                    }
                                }
                            }
                        }
                        $ghichuct = $toact->GhiChu;
                        if($toact->GhiChu == ''){
                            $ghichuct = 'Không có';
                        }
                        $tttoathuoc= array(
                            'tenthuoc' => $toact->danhMucThuoc->TenThuoc,
                            'dvt' => $toact->danhMucThuoc->DonViTinh,
                            'cachdung' => \comm_functions::getCachDungThuoc($toact->danhMucThuoc->PhanLoai),
                            'lieudung' => $lieudung,
                            'sl' => $toact->TST,
                            'idthuoc' => $toact->danhMucThuoc->IdThuoc,
                            'snd'=>$toact->SoNgayDung,
                            'ghichu'=>$ghichuct

                        );
                        $dstoact[]=$tttoathuoc;
                    }
                    $response = array(
                        'msg' => 'cotoa',
                        'dstoact'=>$dstoact,
                        'ghichu'=>$toa->GhiChu
                    );

                    return response()->json($response); 
                }
                else{
                    $response = array(
                        'msg' => 'koco'
                    );

                    return response()->json($response); 
                }
            }
        } catch (\Exception $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
    
    public function postKTCT(Request $request){
        try{
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
            if($ba->TrangThaiBA == 0){
                $response = array(
                    'msg' => 'ktdt'
                );
                return response()->json($response); 
            }
            if(is_object($ba)){
                $bn=$ba->phieuDKKham->phieuDKKham->benhNhan;

                $dspk= phieu_dk_kham::where('IdBN', $bn->IdBN)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('created_at', 'DESC')->get();
                
                $flag=FALSE;//tạo flag kiểm tra thuốc được thêm chưa
                if(is_object($ba->toaThuoc)){
                    foreach ($ba->toaThuoc->toaThuoc->toaThuocCT as $value) {
                        if($value->IdThuoc == $request->mathuoc)
                        {
                            $flag=TRUE;
                            break;
                        }
                    }
                    if($flag == TRUE){
                        $response = array(
                            'msg' => 'trung'
                        );

                        return response()->json($response); 
                    }
                }
                $flag=FALSE;$dskhoa='';$dsk=[];
                foreach ($dspk as $pk){
                    if(is_object($pk->benhAnNgoaiTru)){
                        if(is_object($pk->benhAnNgoaiTru->benhAnNgoaiTru->toaThuoc)){//Đã lập toa
                            if($pk->phongKham->Khoa->IdKhoa != $ba->phieuDKKham->phieuDKKham->phongKham->Khoa->IdKhoa){
                                $toathuoc=$pk->benhAnNgoaiTru->benhAnNgoaiTru->toaThuoc->toaThuoc;
                                foreach ($toathuoc->toaThuocCT as $ct){
                                    if($ct->IdThuoc == $request->mathuoc)
                                    {
                                        $flag=TRUE;
                                        $dsk[]=$pk->phongKham->Khoa->TenKhoa;
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
                if($flag == TRUE){
                    $i=1;
                    foreach ($dsk as $d) {
                        if($i==count($dsk)){
                            $dskhoa.='Khoa '.$d;
                        }
                        else{
                            if($i == count($dsk) - 1){
                                $dskhoa.='Khoa '.$d.' và ';
                            }
                            else{
                                $dskhoa.='Khoa '.$d.'; ';
                            }
                        }
                        $i++;
                    }
                    $response = array(
                        'msg' => 'ddk',
                        'khoa'=>$dskhoa
                    );
                }
                

                return response()->json($response); 
                $dstoa= toa_thuoc_ct::where('IdThuoc', $request->mathuoc)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->get();
                
                $slthuoc=0;
                if(count($dstoa) > 0){
                    foreach ($dstoa as $value){
                        if($value->toaThuoc->TTLanhThuoc == 0){
                            $slthuoc+=$value->TST;
                        }
                    }
                }
                $thuoc= danh_muc_thuoc::where('IdThuoc', $request->mathuoc)->get()->first();
                if(is_object($thuoc)){
                    if($slthuoc > 0){
                        if($request->tst > ($thuoc->SL - $slthuoc)){
                            $response = array(
                                'msg' => 'slthuockodu',
                                'sl'=>$thuoc->SL - $slthuoc,
                                'dvt'=> $thuoc->DonViTinh
                            );

                            return response()->json($response); 
                        }
                    }
                    else{
                        if($request->tst > $thuoc->SL){
                            $response = array(
                                'msg' => 'slthuockodu',
                                'sl'=>$thuoc->SL,
                                'dvt'=> $thuoc->DonViTinh
                            );

                            return response()->json($response); 
                        }
                    }
                }
                else{
                    $response = array(
                        'msg' => 'thuocktt'
                    );

                    return response()->json($response); 
                }
                
                $response = array(
                    'msg' => 'tc'
                );

                return response()->json($response); 
            }
            else{
                $tttoact= array(
                    'msg'=>'ktt'
                );

                return response()->json($tttoact);
            }
            
        }
        catch(\Exception $ex){
            $err=$ex->getMessage();
            $response=array(
                'msg'=>$err
            );

            return response()->json($response);
        }
    }
    
    public function postDanhSachCTCK(Request $request){
        try{
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
            $bn=$ba->phieuDKKham->phieuDKKham->benhNhan;
            $dsthuoc='';
            $dspk= phieu_dk_kham::where('IdBN', $bn->IdBN)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->orderBy('created_at', 'DESC')->get();
            foreach ($dspk as $pk){
                if($pk->phongKham->Khoa->IdKhoa != $ba->phieuDKKham->phieuDKKham->phongKham->Khoa->IdKhoa){
                    if(is_object($pk->benhAnNgoaiTru)){
                        if(is_object($pk->benhAnNgoaiTru->benhAnNgoaiTru->toaThuoc)){//Đã lập toa
                            $dstoact = array(); $toa=''; $toa_ft_af='<tr>';$toa_ft_cn='';$i=1;
                            foreach ($pk->benhAnNgoaiTru->benhAnNgoaiTru->toaThuoc->toaThuoc->toaThuocCT as $toact){
                                $lieudung= explode('|', $toact->LieuDung);
                                $sang='';$trua='';$chieu='';$toi='';
                                if(is_array($lieudung)){
                                    foreach ($lieudung as $value) {
                                        $tg= explode(':', $value);
                                        if(is_array($tg)){
                                            if($tg[0] == 'sang')
                                            {
                                                $sang=$tg[1];
                                            }
                                            else if($tg[0] == 'trua'){
                                                $trua=$tg[1];
                                            }
                                            else if($tg[0] == 'chieu'){
                                                $chieu=$tg[1];
                                            }
                                            else{
                                                $toi=$tg[1];
                                            }
                                        }
                                    }
                                }
                                else{
                                    $tg= explode(':', $toact->LieuDung);
                                    if(is_array($tg)){
                                        if($tg[0] == 'sang')
                                        {
                                            $sang=$tg[1];
                                        }
                                        else if($tg[0] == 'trua'){
                                            $trua=$tg[1];
                                        }
                                        else if($tg[0] == 'chieu'){
                                            $chieu=$tg[1];
                                        }
                                        else{
                                            $toi=$tg[1];
                                        }
                                    }
                                }
                                
                                $lieudung='';
                                if($sang != ''){
                                    $lieudung='Sáng';
                                }
                                if($trua != ''){
                                    if($sang != ''){
                                        $lieudung.=', trưa';
                                    }
                                    else{
                                        $lieudung.='Trưa';
                                    }

                                }
                                if($chieu != ''){
                                    if($sang != ''){
                                         $lieudung.=', chiều';
                                    }
                                    else{
                                        if($trua != ''){
                                            $lieudung.=', chiều';
                                        }
                                        else{
                                            $lieudung.='Chiều';
                                        }
                                    }
                                }
                                if($toi != ''){
                                    if($sang != ''){
                                        $lieudung.=', tối';
                                    }
                                    else{
                                        if($trua != ''){
                                            $lieudung.=', tối';
                                        }
                                        else{
                                            if($chieu != ''){
                                                $lieudung.=', tối';
                                            }
                                            else{
                                                $lieudung.='Tối';
                                            }
                                        }
                                    }
                                }

                                if($i == 1){
                                    if(count($pk->benhAnNgoaiTru->benhAnNgoaiTru->toaThuoc->toaThuoc->toaThuocCT) == 1){
                                        $toa_ft_af='<tr class="tr-shadow">';
                                    }
                                    
                                    $toa_ft_cn.='<td>'.$toact->danhMucThuoc->TenThuoc.'</td>
                                    <td>'.$toact->danhMucThuoc->DonViTinh.'</td>
                                    <td>'.\comm_functions::getCachDungThuoc($toact->danhMucThuoc->PhanLoai).'</td>
                                    <td>'.$lieudung.'</td>
                                    <td>'.$toact->SoNgayDung.'</td>
                                    <td>'.$toact->TST.'</td>';
                                }
                                else{
                                    if($i == count($pk->benhAnNgoaiTru->benhAnNgoaiTru->toaThuoc->toaThuoc->toaThuocCT)){
                                        $toa.='<tr class="tr-shadow"><td>'.$toact->danhMucThuoc->TenThuoc.'</td>
                                        <td>'.$toact->danhMucThuoc->DonViTinh.'</td>
                                        <td>'.\comm_functions::getCachDungThuoc($toact->danhMucThuoc->PhanLoai).'</td>
                                        <td>'.$lieudung.'</td>
                                        <td>'.$toact->SoNgayDung.'</td>
                                        <td>'.$toact->TST.'</td></tr>';
                                    }
                                    else{
                                        $toa.='<tr><td>'.$toact->danhMucThuoc->TenThuoc.'</td>
                                        <td>'.$toact->danhMucThuoc->DonViTinh.'</td>
                                        <td>'.\comm_functions::getCachDungThuoc($toact->danhMucThuoc->PhanLoai).'</td>
                                        <td>'.$lieudung.'</td>
                                        <td>'.$toact->SoNgayDung.'</td>
                                        <td>'.$toact->TST.'</td></tr>';
                                    }
                                }

                                $i++;
                            }
                            if($toa_ft_cn != ''){
                                $toa_ft_af.=$toa_ft_af.'<td rowspan="'.$i.'" style="vertical-align: middle">'.$pk->phongKham->Khoa->TenKhoa.'</td>'.$toa_ft_cn.'</tr>';
                            }
                            else{
                                $toa_ft_af.='';
                            }

                            if($toa != ''){
                                $toa=$toa_ft_af.$toa;
                            }
                            else{
                                if($toa_ft_cn == ''){
                                    $toa.='';
                                }
                                else{
                                    $toa.=$toa_ft_af;
                                }
                            }

                            $dsthuoc.=$toa;
                        }
                    }
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dsthuoc'=>$dsthuoc
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
    
    public function postThem(Request $request){
        try{
            $ba= benh_an_ngoai_tru::where('IdBANgoaiT', $request->idba)->get()->first();
            
            if(is_object($ba->toaThuoc)){//Đã lập toa
                $dstoa= toa_thuoc_ct::where('IdThuoc', $request->mathuoc)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->get();
                $slthuoc=0;
                if(count($dstoa) > 0){
                    foreach ($dstoa as $value){
                        if($value->toaThuoc->TTLanhThuoc == 0){
                            $slthuoc+=$value->TST;
                        }
                    }
                }
                $thuoc= danh_muc_thuoc::where('IdThuoc', $request->mathuoc)->get()->first();
                if(is_object($thuoc)){
                    if($slthuoc > 0){
                        if($request->tst > ($thuoc->SL - $slthuoc)){
                            $response = array(
                                'msg' => 'slthuockodu',
                                'sl'=>$thuoc->SL - $slthuoc,
                                'dvt'=> $thuoc->DonViTinh
                            );

                            return response()->json($response); 
                        }
                    }
                    else{
                        if($request->tst > $thuoc->SL){
                            $response = array(
                                'msg' => 'slthuockodu',
                                'sl'=>$thuoc->SL,
                                'dvt'=> $thuoc->DonViTinh
                            );

                            return response()->json($response); 
                        }
                    }
                }
                else{
                    $response = array(
                        'msg' => 'thuocktt'
                    );

                    return response()->json($response); 
                }
                
                $toact= new toa_thuoc_ct;
                $toact->IdTT=$ba->toaThuoc->toaThuoc->IdTT;
                $toact->IdThuoc=$request->mathuoc;
                $toact->SoNgayDung=$request->sl;
                $toact->TST=$request->tst;
                
                $lieudung='';
                
                if($request->sang != '')
                {
                    $lieudung='sang:'.$request->sang;
                }
                if($request->trua != ''){
                    if($request->sang != ''){
                        $lieudung.='|trua:'.$request->trua;
                    }
                    else{
                        $lieudung.='trua:'.$request->trua;
                    }

                }
                if($request->chieu != ''){
                    if($request->sang != ''){
                        $lieudung.='|chieu:'.$request->chieu;
                    }
                    else{
                        if($request->trua != '')
                        {
                            $lieudung.='|chieu:'.$request->chieu;
                        }
                        else{
                            $lieudung.='chieu:'.$request->chieu;
                        }
                        
                    }
                }
                if($request->toi != ''){
                    if($request->sang != ''){
                        $lieudung.='|toi:'.$request->toi;
                    }
                    else{
                        if($request->trua != '')
                        {
                            $lieudung.='|toi:'.$request->toi;
                        }
                        else{
                            if($request->chieu != '')
                            {
                                $lieudung.='|toi:'.$request->toi;
                            }
                            else{
                                $lieudung.='toi:'.$request->toi;
                            }
                        }
                    }
                }
                
                $toact->LieuDung=$lieudung;
                $toact->GhiChu=$request->ghichuct;
                
                $toact->save();
                
                //cập nhật lại ghi chú trên toa thuốc sau mỗi lần thêm chi tiết
                $ba->toaThuoc->toaThuoc->GhiChu=$request->ghichutoa;
                $ba->toaThuoc->toaThuoc->save();
                
                //trả dữ liệu về
                $ld= explode('|', $lieudung);
                $sang='';$trua='';$chieu='';$toi='';
                if(is_array($ld)){
                    foreach ($ld as $value) {
                        $tg= explode(':', $value);
                        if(is_array($tg)){
                            if($tg[0] == 'sang')
                            {
                                $sang=$tg[1];
                            }
                            else if($tg[0] == 'trua'){
                                $trua=$tg[1];
                            }
                            else if($tg[0] == 'chieu'){
                                $chieu=$tg[1];
                            }
                            else{
                                $toi=$tg[1];
                            }
                        }
                    }
                }
                else{
                    $tg= explode(':', $lieudung);
                    if(is_array($tg)){
                        if($tg[0] == 'sang')
                        {
                            $sang=$tg[1];
                        }
                        else if($tg[0] == 'trua'){
                            $trua=$tg[1];
                        }
                        else if($tg[0] == 'chieu'){
                            $chieu=$tg[1];
                        }
                        else{
                            $toi=$tg[1];
                        }
                    }
                }
                
                $lieudung='';
                if($sang != ''){
                    $lieudung='Sáng';
                }
                if($trua != ''){
                    if($sang != ''){
                        $lieudung.=', trưa';
                    }
                    else{
                        $lieudung.='Trưa';
                    }

                }
                if($chieu != ''){
                    if($sang != ''){
                         $lieudung.=', chiều';
                    }
                    else{
                        if($trua != ''){
                            $lieudung.=', chiều';
                        }
                        else{
                            $lieudung.='Chiều';
                        }
                    }
                }
                if($toi != ''){
                    if($sang != ''){
                        $lieudung.=', tối';
                    }
                    else{
                        if($trua != ''){
                            $lieudung.=', tối';
                        }
                        else{
                            if($chieu != ''){
                                $lieudung.=', tối';
                            }
                            else{
                                $lieudung.='Tối';
                            }
                        }
                    }
                }

                $response = array(
                    'msg' => 'ct_tc',
                    'tenthuoc' => $toact->danhMucThuoc->TenThuoc,
                    'dvt' => $toact->danhMucThuoc->DonViTinh,
                    'cachdung' => \comm_functions::getCachDungThuoc($toact->danhMucThuoc->PhanLoai),
                    'lieudung' => $lieudung,
                    'sl' => $toact->TST,
                    'idthuoc' => $toact->danhMucThuoc->IdThuoc,
                    'idtt'=> $toact->IdTT
                );

                return response()->json($response); 
            }
            else{
                $dstoa= toa_thuoc_ct::where('IdThuoc', $request->mathuoc)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->get();
                $slthuoc=0;
                if(count($dstoa) > 0){
                    foreach ($dstoa as $value){
                        if($value->toaThuoc->TTLanhThuoc == 0){
                            $slthuoc+=$value->TST;
                        }
                    }
                }
                $thuoc= danh_muc_thuoc::where('IdThuoc', $request->mathuoc)->get()->first();
                if(is_object($thuoc)){
                    if($slthuoc > 0){
                        if($request->tst > ($thuoc->SL - $slthuoc)){
                            $response = array(
                                'msg' => 'slthuockodu',
                                'sl'=>$thuoc->SL - $slthuoc,
                                'dvt'=> $thuoc->DonViTinh
                            );

                            return response()->json($response); 
                        }
                    }
                    else{
                        if($request->tst > $thuoc->SL){
                            $response = array(
                                'msg' => 'slthuockodu',
                                'sl'=>$thuoc->SL,
                                'dvt'=> $thuoc->DonViTinh
                            );

                            return response()->json($response); 
                        }
                    }
                }
                else{
                    $response = array(
                        'msg' => 'thuocktt'
                    );

                    return response()->json($response); 
                }
                //thêm trên bảng toa thuốc
                $toa= new toa_thuoc;
                $toa->IdTT= ToaThuocNgoaiTruController::TaoMaNN();
                $toa->TTLanhThuoc=0;
                $toa->GhiChu=$request->ghichutoa;
                
                $toa->save();
                
                //thêm trên bảng quan hệ toa với bệnh án
                $toa_vs_ba=new toa_thuoc_vs_benh_an_ngoai_tru;
                $toa_vs_ba->IdBANgoaiT=$request->idba;
                $toa_vs_ba->IdTT=$toa->IdTT;
                
                $toa_vs_ba->save();
                
                //thêm chi tiết trên toa thuốc
                $toact= new toa_thuoc_ct;
                $toact->IdTT=$toa->IdTT;
                $toact->IdThuoc=$request->mathuoc;
                $toact->SoNgayDung=$request->sl;
                $toact->TST=$request->tst;
                
                $lieudung='';
                
                if($request->sang != '')
                {
                    $lieudung='sang:'.$request->sang;
                }
                if($request->trua != ''){
                    if($request->sang != ''){
                        $lieudung.='|trua:'.$request->trua;
                    }
                    else{
                        $lieudung.='trua:'.$request->trua;
                    }

                }
                if($request->chieu != ''){
                    if($request->sang != ''){
                        $lieudung.='|chieu:'.$request->chieu;
                    }
                    else{
                        if($request->trua != '')
                        {
                            $lieudung.='|chieu:'.$request->chieu;
                        }
                        else{
                            $lieudung.='chieu:'.$request->chieu;
                        }
                        
                    }
                }
                if($request->toi != ''){
                    if($request->sang != ''){
                        $lieudung.='|toi:'.$request->toi;
                    }
                    else{
                        if($request->trua != '')
                        {
                            $lieudung.='|toi:'.$request->toi;
                        }
                        else{
                            if($request->chieu != '')
                            {
                                $lieudung.='|toi:'.$request->toi;
                            }
                            else{
                                $lieudung.='toi:'.$request->toi;
                            }
                        }
                    }
                }
                
                $toact->LieuDung=$lieudung;
                $toact->GhiChu=$request->ghichuct;
                
                $toact->save();
                
                $ld= explode('|', $lieudung);
                $sang='';$trua='';$chieu='';$toi='';
                if(is_array($ld)){
                    foreach ($ld as $value) {
                        $tg= explode(':', $value);
                        if(is_array($tg)){
                            if($tg[0] == 'sang')
                            {
                                $sang=$tg[1];
                            }
                            else if($tg[0] == 'trua'){
                                $trua=$tg[1];
                            }
                            else if($tg[0] == 'chieu'){
                                $chieu=$tg[1];
                            }
                            else{
                                $toi=$tg[1];
                            }
                        }
                    }
                }
                else{
                    $tg= explode(':', $lieudung);
                    if(is_array($tg)){
                        if($tg[0] == 'sang')
                        {
                            $sang=$tg[1];
                        }
                        else if($tg[0] == 'trua'){
                            $trua=$tg[1];
                        }
                        else if($tg[0] == 'chieu'){
                            $chieu=$tg[1];
                        }
                        else{
                            $toi=$tg[1];
                        }
                    }
                }
                
                $lieudung='';
                if($sang != ''){
                    $lieudung='Sáng';
                }
                if($trua != ''){
                    if($sang != ''){
                        $lieudung.=', trưa';
                    }
                    else{
                        $lieudung.='Trưa';
                    }

                }
                if($chieu != ''){
                    if($sang != ''){
                         $lieudung.=', chiều';
                    }
                    else{
                        if($trua != ''){
                            $lieudung.=', chiều';
                        }
                        else{
                            $lieudung.='Chiều';
                        }
                    }
                }
                if($toi != ''){
                    if($sang != ''){
                        $lieudung.=', tối';
                    }
                    else{
                        if($trua != ''){
                            $lieudung.=', tối';
                        }
                        else{
                            if($chieu != ''){
                                $lieudung.=', tối';
                            }
                            else{
                                $lieudung.='Tối';
                            }
                        }
                    }
                }
                
                $response = array(
                    'msg' => 't_v_ct_tc',
                    'tenthuoc' => $toact->danhMucThuoc->TenThuoc,
                    'dvt' => $toact->danhMucThuoc->DonViTinh,
                    'cachdung' => \comm_functions::getCachDungThuoc($toact->danhMucThuoc->PhanLoai),
                    'lieudung' => $lieudung,
                    'sl' => $toact->TST,
                    'idthuoc' => $toact->danhMucThuoc->IdThuoc,
                    'idtt'=> $toact->IdTT
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
    
    public function postSuaCT(Request $request){
        try{
            $taongoaitru= toa_thuoc::where('IdTT', $request->matt)->get()->first();
            if($taongoaitru->benhAnNgoaiTru->benhAnNgoaiTru->TrangThaiBA == 0){
                $response = array(
                    'msg' => 'ktdt'
                );
                return response()->json($response); 
            }
            
            $dstoa= toa_thuoc_ct::where('IdThuoc', $request->mathuoc)->whereDate('created_at', 'like', '%'.date('Y-m-d').'%')->get();
            $slthuoc=0;
            if(count($dstoa) > 0){
                foreach ($dstoa as $value){
                    if($value->toaThuoc->TTLanhThuoc == 0 && $value->toaThuoc->IdTT != $request->matt){
                        $slthuoc+=$value->TST;
                    }
                }
            }
            $thuoc= danh_muc_thuoc::where('IdThuoc', $request->mathuoc)->get()->first();
            if(is_object($thuoc)){
                if($slthuoc > 0){
                    if($request->tst > ($thuoc->SL - $slthuoc)){
                        $response = array(
                            'msg' => 'slthuockodu',
                            'sl'=>$thuoc->SL - $slthuoc,
                            'dvt'=> $thuoc->DonViTinh
                        );

                        return response()->json($response); 
                    }
                }
                else{
                    if($request->tst > $thuoc->SL){
                        $response = array(
                            'msg' => 'slthuockodu',
                            'sl'=>$thuoc->SL,
                            'dvt'=> $thuoc->DonViTinh
                        );

                        return response()->json($response); 
                    }
                }
            }
            else{
                $response = array(
                    'msg' => 'thuocktt'
                );

                return response()->json($response); 
            }
            
            $toact= toa_thuoc_ct::where([['IdTT', $request->matt], ['IdThuoc', $request->mathuoc]])->get()->first();
            $toact->SoNgayDung=$request->sl;
            $toact->TST=$request->tst;
            $lieudung='';
            
            if($request->sang != '')
            {
                $lieudung='sang:'.$request->sang;
            }
            if($request->trua != ''){
                if($request->sang != ''){
                    $lieudung.='|trua:'.$request->trua;
                }
                else{
                    $lieudung.='trua:'.$request->trua;
                }

            }
            if($request->chieu != ''){
                if($request->sang != ''){
                    $lieudung.='|chieu:'.$request->chieu;
                }
                else{
                    if($request->trua != '')
                    {
                        $lieudung.='|chieu:'.$request->chieu;
                    }
                    else{
                        $lieudung.='chieu:'.$request->chieu;
                    }

                }
            }
            if($request->toi != ''){
                if($request->sang != ''){
                    $lieudung.='|toi:'.$request->toi;
                }
                else{
                    if($request->trua != '')
                    {
                        $lieudung.='|toi:'.$request->toi;
                    }
                    else{
                        if($request->chieu != '')
                        {
                            $lieudung.='|toi:'.$request->toi;
                        }
                        else{
                            $lieudung.='toi:'.$request->toi;
                        }
                    }
                }
            }
            
            $toact->LieuDung=$lieudung;
            $toact->GhiChu=$request->ghichuct;

            $toact->save();

            //cập nhật lại ghi chú trên toa thuốc sau mỗi lần thêm chi tiết
            $toact->toaThuoc->GhiChu=$request->ghichutoa;
            $toact->toaThuoc->save();

            $ld= explode('|', $lieudung);
            $sang='';$trua='';$chieu='';$toi='';
            if(is_array($ld)){
                foreach ($ld as $value) {
                    $tg= explode(':', $value);
                    if(is_array($tg)){
                        if($tg[0] == 'sang')
                        {
                            $sang=$tg[1];
                        }
                        else if($tg[0] == 'trua'){
                            $trua=$tg[1];
                        }
                        else if($tg[0] == 'chieu'){
                            $chieu=$tg[1];
                        }
                        else{
                            $toi=$tg[1];
                        }
                    }
                }
            }
            else{
                $tg= explode(':', $lieudung);
                if(is_array($tg)){
                    if($tg[0] == 'sang')
                    {
                        $sang=$tg[1];
                    }
                    else if($tg[0] == 'trua'){
                        $trua=$tg[1];
                    }
                    else if($tg[0] == 'chieu'){
                        $chieu=$tg[1];
                    }
                    else{
                        $toi=$tg[1];
                    }
                }
            }
            
            $lieudung='';
            if($sang != ''){
                $lieudung='Sáng';
            }
            if($trua != ''){
                if($sang != ''){
                    $lieudung.=', trưa';
                }
                else{
                    $lieudung.='Trưa';
                }

            }
            if($chieu != ''){
                if($sang != ''){
                     $lieudung.=', chiều';
                }
                else{
                    if($trua != ''){
                        $lieudung.=', chiều';
                    }
                    else{
                        $lieudung.='Chiều';
                    }
                }
            }
            if($toi != ''){
                if($sang != ''){
                    $lieudung.=', tối';
                }
                else{
                    if($trua != ''){
                        $lieudung.=', tối';
                    }
                    else{
                        if($chieu != ''){
                            $lieudung.=', tối';
                        }
                        else{
                            $lieudung.='Tối';
                        }
                    }
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'tenthuoc' => $toact->danhMucThuoc->TenThuoc,
                'dvt' => $toact->danhMucThuoc->DonViTinh,
                'cachdung' => \comm_functions::getCachDungThuoc($toact->danhMucThuoc->PhanLoai),
                'lieudung' => $lieudung,
                'sl' => $toact->TST,
                'idthuoc' => $toact->danhMucThuoc->IdThuoc,
                'idtt'=> $toact->IdTT
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
    
    public function postLayTTTTCT(Request $request){
        try{
            $toact= toa_thuoc_ct::where([['IdTT', $request->idtt], ['IdThuoc', $request->idthuoc]])->get()->first();
            $lieudung= explode('|', $toact->LieuDung);
            $sang=FALSE;$trua=FALSE;$chieu=FALSE;$toi=FALSE;$ld=1;
            if(is_array($lieudung)){
                foreach ($lieudung as $value) {
                    $tg= explode(':', $value);
                    if(is_array($tg)){
                        if($tg[0] == 'sang')
                        {
                            $sang=TRUE;
                        }
                        else if($tg[0] == 'trua'){
                            $trua=TRUE;
                        }
                        else if($tg[0] == 'chieu'){
                            $chieu=TRUE;
                        }
                        else{
                            $toi=TRUE;
                        }
                        if(intval($tg[1]) != 1){
                            $ld=$tg[1];
                        }
                    }
                }
            }
            else{
                $lieudung= explode(':', $toact->LieuDung);
                if(is_array($lieudung)){
                    if($lieudung[0] == 'sang')
                    {
                        $sang=TRUE;
                    }
                    else if($lieudung[0] == 'trua'){
                        $trua=TRUE;
                    }
                    else if($lieudung[0] == 'chieu'){
                        $chieu=TRUE;
                    }
                    else{
                        $toi=TRUE;
                    }
                    if(intval($lieudung[1]) != 1){
                        $ld=$lieudung[1];
                    }
                }
            }
            
            $tttoact= array(
                'msg'=>'tc',
                'snd' =>$toact->SoNgayDung,
                'tenthuoc'=>$toact->danhMucThuoc->TenThuoc,
                'idthuoc' => $toact->danhMucThuoc->IdThuoc,
                'sang'=>$sang,
                'trua'=>$trua,
                'chieu'=>$chieu,
                'toi'=>$toi,
                'ghichuct'=>$toact->GhiChu,
                'ghichutoa'=>$toact->toaThuoc->GhiChu,
                'tst'=>$toact->TST,
                'ld'=>$ld
            );

            return response()->json($tttoact);
        }
        catch(\Exception $ex){
            $err=$ex->getMessage();
            $response=array(
                'msg'=>$err
            );

            return response()->json($response);
        }
    }

    public function postXoaCT(Request $request){
        if(strpos($request->idthuoc, ',')){//gửi nhiều mã
            $arr= explode(',',$request->idthuoc);
            try{
                foreach ($arr as $a){
                    $toact= toa_thuoc_ct::where([["IdThuoc", $a], ['IdTT', $request->idtt]])->get()->first();
                    $toact->delete();
                }
                $response = array(
                    'msg' => 'tc',
                    'idttct'=>$arr
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
                $toact= toa_thuoc_ct::where([["IdThuoc", $request->idthuoc], ['IdTT', $request->idtt]])->get()->first();
                $toact->delete();
                $response = array(
                    'msg' => 'tc',
                    'idttct'=>$request->idthuoc
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
    
    public function postXoa(Request $request){
        if(strpos($request->idtt, ',')){//gửi nhiều mã
            $arr= explode(',',$request->idtt);
            try{
                foreach ($arr as $a){
                    $toa= toa_thuoc::where("IdTT", $a)->get()->first();
                    $toa->delete();
                }

                $response = array(
                    'msg' => 'tc'
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
                $toa= toa_thuoc::where("IdTT", $request->idtt)->get()->first();
                $toa->delete();

                $response = array(
                    'msg' => 'tc'
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
    
    public function postXNLT(Request $request){
        try{
            $toa= toa_thuoc::where("IdTT", $request->idtt)->get()->first();
            if(!is_object($toa)){
                $response = array(
                    'msg' => 'ktt'
                );
                return response()->json($response); 
            }
            $toa->TTLanhThuoc=1;
            $toa->save();
            
            //Cập nhật lại số lượng thuốc
            foreach ($toa->toaThuocCT as $value) {
                if($value->danhMucThuoc->SL > 0){
                    $value->danhMucThuoc->SL=$value->danhMucThuoc->SL - $value->TST;
                    $value->danhMucThuoc->save();
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'id'=>$toa->IdTT
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
    
    public function postLayDS(Request $request){
        try{
            $dst=array();
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;

            $dsba= benh_an_ngoai_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            foreach ($dsba as $value){
                if($value->toaThuoc){
                    $dst[]=$value->toaThuoc->toaThuoc;
                }
            }
            $dstoa=[];
            foreach ($dst as $toa){
                $ba=$toa->benhAnNgoaiTru->benhAnNgoaiTru;
                $dttn='BHYT';
                if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                $chuandoan='';
                $i=1;
                foreach ($ba->chuanDoan as $cd){
                    if($i == count($ba->chuanDoan)){
                        $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                    }
                    else{
                        $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                    }
                    $i++;
                }
                $ttt=array(
                    'id'=>$toa->IdTT,
                    'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                    'dttn'=>$dttn,
                    'chuandoan'=>$chuandoan,
                    'ngayratoa'=> \comm_functions::deDateFormat($toa->created_at),
                    'sndt'=>$ba->SoNgayDT
                );
                $dstoa[]=$ttt;
            }
            $response = array(
                'msg' => 'tc',
                'dstoa'=>$dstoa
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

    public function postLayDSNVPT(Request $request){
        try{
            $dst=array();
            
            $dsba= benh_an_ngoai_tru::orderBy('created_at', 'DESC')->get();
            foreach ($dsba as $value){
                if(is_object($value->toaThuoc)){
                    if($value->toaThuoc->toaThuoc->TTLanhThuoc == 0 && date('d/m/Y') == date('d/m/Y', strtotime($value->toaThuoc->toaThuoc->created_at))){
                        $dst[]=$value->toaThuoc->toaThuoc;
                    }
                }
            }
            $dstoa=[];
            foreach ($dst as $toa){
                $ba=$toa->benhAnNgoaiTru->benhAnNgoaiTru;
                $dttn='BHYT';
                if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                    $dttn='Thu phí';
                }
                $chuandoan='';
                $i=1;
                foreach ($ba->chuanDoan as $cd){
                    if($i == count($ba->chuanDoan)){
                        $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                    }
                    else{
                        $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                    }
                    $i++;
                }
                $ttt=array(
                    'id'=>$toa->IdTT,
                    'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                    'dttn'=>$dttn,
                    'bsdt'=>$ba->nhanVien->TenNV,
                    'chuandoan'=>$chuandoan,
                    'ngayratoa'=> \comm_functions::deDateFormat($toa->created_at),
                    'sndt'=>$ba->SoNgayDT
                );
                $dstoa[]=$ttt;
            }
            $response = array(
                'msg' => 'tc',
                'dstoa'=>$dstoa
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
    
    public function postIn(Request $request){
        try {
            $toathuoc= toa_thuoc::where('IdTT', $request->idtt)->get()->first();
            $data=array();
            $k=1;
            foreach ($toathuoc->toaThuocCT as $tt){
                $item='<div class="row">
                    <div class="col-lg-10">
                        <label style="font-weight: 600">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$k.'. </label>
                        <label style="font-style: italic">'.$tt->danhMucThuoc->ThanhPhan.'</label>
                        <label style="font-weight: 600">('. mb_convert_case($tt->danhMucThuoc->TenThuoc, MB_CASE_UPPER,'utf-8').')</label>
                    </div>
                    <div class="col-lg-2 text-right">
                        <label style="font-weight: 600">'.$tt->TST.' '.$tt->danhMucThuoc->DonViTinh.'</label>
                    </div>
                </div>
                <div class="row text-right">';
                $lieudung= explode('|', $tt->LieuDung);
                $sang='';$trua='';$chieu='';$toi='';
                if(is_array($lieudung)){
                    foreach ($lieudung as $value) {
                        $tg= explode(':', $value);
                        if(is_array($tg)){
                            if($tg[0] == 'sang')
                            {
                                $sang=$tg[1];
                            }
                            else if($tg[0] == 'trua'){
                                $trua=$tg[1];
                            }
                            else if($tg[0] == 'chieu'){
                                $chieu=$tg[1];
                            }
                            else{
                                $toi=$tg[1];
                            }
                        }
                    }
                }
                else{
                    $lieudung= explode(':', $tt->LieuDung);
                    if(is_array($lieudung)){
                        if($lieudung[0] == 'sang')
                        {
                            $sang=$lieudung[1];
                        }
                        else if($lieudung[0] == 'trua'){
                            $trua=$lieudung[1];
                        }
                        else if($lieudung[0] == 'chieu'){
                            $chieu=$lieudung[1];
                        }
                        else{
                            $toi=$lieudung[1];
                        }
                    }
                }
                if($sang !=''){
                    $item.='<div class="col-lg-3">
                        <label style="font-style: italic; margin-bottom: 0">Sáng: </label>
                        <label style="margin-bottom: 0">&nbsp;'.$sang.'</label>
                    </div>';
                }
                else{
                    $item.='<div class="col-lg-3"></div>';
                }
                if($trua !=''){
                    $item.='<div class="col-lg-3">
                        <label style="font-style: italic; margin-bottom: 0">Trưa: </label>
                        <label style="margin-bottom: 0">'.$trua.'</label>
                    </div>';
                }
                else{
                    $item.='<div class="col-lg-3"></div>';
                }
                if($chieu != ''){
                    $item.='<div class="col-lg-3">
                        <label style="font-style: italic; margin-bottom: 0">Chiều: </label>
                        <label style="margin-bottom: 0">'.$chieu.'</label>
                    </div>';
                } 
                else{
                    $item.='<div class="col-lg-3"></div>';
                }
                if($toi != ''){
                    $item.='<div class="col-lg-3">
                        <label style="font-style: italic; margin-bottom: 0">Tối: </label>
                        <label style="margin-bottom: 0">'.$toi.'</label>
                    </div>';
                }
                $item.='</div>
                <div class="row m-b-10" style="font-style: italic">
                    <div class="col-lg-12">
                        <label style="margin-bottom: 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cách dùng: '.\comm_functions::getCachDungThuoc($tt->danhMucThuoc->PhanLoai).'; '.$tt->GhiChu.'</label>
                    </div>
                </div>';
                $data[]=$item;
                $k++;
            }
            //lấy thông tin liên quan đến bệnh nhân

            $benhnhan=$toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->benhNhan;
            $nv= $toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->nhanVien;
            $tang='TRIỆT';
            if($tang != 0){
                $tang='LẦU '.$nv->phongBan->Tang;
            }
            $pk='P.KHÁM '.mb_convert_case($nv->phongBan->Khoa->TenKhoa, MB_CASE_UPPER, 'utf-8').' ( '.$nv->phongBan->SoPhong.' - '.$tang.' )';
            $bare_code_mabn=\Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($benhnhan->IdBN, "C128", 1.3, 25);
            $dtk='THU PHÍ';$khothuoc='KHO THU PHÍ';
            if(is_object($benhnhan->theBHYT)){
                if($toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->phieuDKKham->phieuDKKham->KhamBHYT == 0){
                    $dtk='BHYT ('.\comm_functions::getMucHuongDTK($benhnhan->theBHYT->DoiTuongBHYT).'%) - QL'.substr($benhnhan->theBHYT->IdTheBHYT, 2, 1);
                    $khothuoc='KHO BHYT NGOẠI TRÚ';
                }
            }
            
            $birthDate = explode("/", date( "m/d/Y", strtotime( $benhnhan->NgaySinh )));
            $tuoi = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
            $gt='Nam';
            if($benhnhan->GioiTinh == 0){
                $gt='Nữ';
            }
            $mathe='koco';$ngaydk='';$ngayhh='';
            if(is_object($benhnhan->theBHYT)){
                $mathe=$benhnhan->theBHYT->IdTheBHYT.' - '. substr($benhnhan->theBHYT->IdTheBHYT, 3, 2).$benhnhan->theBHYT->coSoKhamBHYT->IdCSKBHYT;
                $ngaydk=date( "m/d/Y", strtotime( $benhnhan->theBHYT->NgayDK ));
                $ngayhh=date( "m/d/Y", strtotime( $benhnhan->theBHYT->NgayHH ));
            }
            $diachi="";
            if($benhnhan->DiaChi == ''){
                $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            else{
                $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            $chuandoan='';$i=1;
            foreach ($toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan as $cd) {
                if($i == count($toathuoc->benhAnNgoaiTru->benhAnNgoaiTru->chuanDoan))
                {
                    $chuandoan.=$cd->danhMucBenh->TenBenh.'('.$cd->danhMucBenh->IdBenh.')';
                }
                else{
                    $chuandoan.=$cd->danhMucBenh->TenBenh.'('.$cd->danhMucBenh->IdBenh.')'.';&nbsp';
                }

                $i++;
            }
            $ghichutoa='';
            if($toathuoc->GhiChu != ''){
                $ghichutoa=$toathuoc->GhiChu;
            }
            $bn= array(
                'hoten'=>$benhnhan->HoTen,
                'pk'=>$pk,
                'barcode'=>$bare_code_mabn,
                'mabn'=>$benhnhan->IdBN,
                'dtk'=>$dtk,
                'tuoi'=>$tuoi,
                'gt'=>$gt,
                'mathe'=>$mathe,
                'tungay'=>$ngaydk,
                'denngay'=>$ngayhh,
                'diachi'=>$diachi,
                'khothuoc'=>$khothuoc,
                'chuandoan'=>$chuandoan,
                'ghichutoa'=>$ghichutoa,
                'nv'=>$nv->TenNV,
                'tenkhoa'=>$nv->phongBan->Khoa->TenKhoa
            );
            
            $response=array(
                'data'=>$data,
                'bn'=>$bn,
                'msg'=>'tc'
            );
            return response()->json($response);
        } catch (\Exception $ex) {
            $err=$ex->getMessage();
            
            $response=array(
                'msg'=>$err
            );
            
            return response()->json($response);
        }
    }
    
    public function postTimKiem(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $key=$request->keyWords;
            $ds_tt= DB::select("SELECT DISTINCT tt.`IdTT` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON pdk.`IdBN` = bn.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pdk_bangoai ON pdk_bangoai.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS bangoai ON bangoai.`IdBANgoaiT` = pdk_bangoai.`IdBANgoaiT` JOIN chuan_doan_vs_benh_an_ngoai_tru AS cd_bangoai ON cd_bangoai.`IdBANgoaiT` = bangoai.`IdBANgoaiT` JOIN toa_thuoc_vs_benh_an_ngoai_tru AS tt ON bangoai.`IdBANgoaiT` = tt.`IdBANgoaiT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_bangoai.`IdBenh` JOIN nhan_vien AS nv ON nv.`IdNV` = bangoai.`IdNV`

WHERE nv.`IdNV` = N'".$idnv."' AND ((bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmb.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'BHYT Bảo hiểm y tế' ELSE N'TP Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY tt.created_at DESC");
            $dstt = array();
            $sl=0;
            if(!empty($ds_tt)){
                foreach ($ds_tt as $t){
                    $toa= toa_thuoc::where("IdTT", $t->IdTT)->get()->first();
                    $ba=$toa->benhAnNgoaiTru->benhAnNgoaiTru;
                    $dttn='BHYT';
                    if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                    $chuandoan='';
                    $i=1;
                    foreach ($ba->chuanDoan as $cd){
                        if($i == count($ba->chuanDoan)){
                            $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                        }
                        else{
                            $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                        }
                        $i++;
                    }
                    $ttt=array(
                        'id'=>$toa->IdTT,
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                        'dttn'=>$dttn,
                        'chuandoan'=>$chuandoan,
                        'ngayratoa'=> \comm_functions::deDateFormat($toa->created_at),
                        'sndt'=>$ba->SoNgayDT
                    );
                    $dstt[]=$ttt;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dstoa'=>$dstt,
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
    
    public function postTimKiemNVPT(Request $request){
        try{
            $key=$request->keyWords;
            $ds_tt= DB::select("SELECT DISTINCT toa.`IdTT` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON pdk.`IdBN` = bn.`IdBN` JOIN phieu_dk_kham_vs_benh_an_ngoai_tru AS pdk_bangoai ON pdk_bangoai.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` JOIN benh_an_ngoai_tru AS bangoai ON bangoai.`IdBANgoaiT` = pdk_bangoai.`IdBANgoaiT` JOIN chuan_doan_vs_benh_an_ngoai_tru AS cd_bangoai ON cd_bangoai.`IdBANgoaiT` = bangoai.`IdBANgoaiT` JOIN toa_thuoc_vs_benh_an_ngoai_tru AS tt ON bangoai.`IdBANgoaiT` = tt.`IdBANgoaiT` JOIN toa_thuoc AS toa ON toa.`IdTT` = tt.`IdTT` JOIN danh_muc_benh AS dmb ON dmb.`IdBenh` = cd_bangoai.`IdBenh` JOIN nhan_vien AS nv ON nv.`IdNV` = bangoai.`IdNV`

WHERE toa.`TTLanhThuoc` = 0 AND (DATE_FORMAT(toa.`created_at`, '%d/%m/%Y') LIKE N'%".date('d/m/Y')."%' COLLATE utf8_unicode_ci) AND ((nv.`TenNV` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dmb.`TenBenh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN pdk.`KhamBHYT` IS FALSE THEN N'BHYT Bảo hiểm y tế' ELSE N'TP Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY toa.created_at DESC");
            $dstt = array();
            $sl=0;
            if(!empty($ds_tt)){
                foreach ($ds_tt as $t){
                    $toa= toa_thuoc::where("IdTT", $t->IdTT)->get()->first();
                    $ba=$toa->benhAnNgoaiTru->benhAnNgoaiTru;
                    $dttn='BHYT';
                    if($ba->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                    $chuandoan='';
                    $i=1;
                    foreach ($ba->chuanDoan as $cd){
                        if($i == count($ba->chuanDoan)){
                            $chuandoan.='- '.$cd->danhMucBenh->TenBenh;
                        }
                        else{
                            $chuandoan.=' - '.$cd->danhMucBenh->TenBenh.'<br>';
                        }
                        $i++;
                    }
                    $ttt=array(
                        'id'=>$toa->IdTT,
                        'hoten'=>$ba->phieuDKKham->phieuDKKham->benhNhan->HoTen,
                        'bsdt'=>$ba->nhanVien->TenNV,
                        'dttn'=>$dttn,
                        'chuandoan'=>$chuandoan,
                        'ngayratoa'=> \comm_functions::deDateFormat($toa->created_at),
                        'sndt'=>$ba->SoNgayDT
                    );
                    $dstt[]=$ttt;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dstoa'=>$dstt,
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
    
    public static function TaoMaNN(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= toa_thuoc::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $tt ){
                   if($tt->IdTT == $ran){
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
