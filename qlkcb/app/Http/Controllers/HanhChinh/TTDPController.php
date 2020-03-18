<?php

namespace App\Http\Controllers\HanhChinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\tinh_tp;
use App\Models\HanhChinh\quan_huyen;
use App\Models\HanhChinh\phuong_xa;
use App\Models\HanhChinh\nhan_vien;
use App\Models\HanhChinh\thong_ke;
use App\Models\TiepDon\benh_nhan;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Events\HanhChinh\DP;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class TTDPController extends Controller
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
        $dstinh= tinh_tp::orderBy('TenTinh', 'ASC')->orderBy('IdTinh', 'ASC')->get();
        return view("hanh_chinh.quan_ly_thong_tin_dia_phuong",["dstinh"=>$dstinh, 'dsbc'=>$sl]);
    }
    
    public function postLayTTCN(Request $request){
        try{
            if($request->tinh != ''){
                $tinh= tinh_tp::where('IdTinh', $request->id)->get()->first();
                $ttdp= array(
                    'id' => $tinh->IdTinh,
                    'tendp' => $tinh->TenTinh,
                    'msg'=>'tc'
                );
                return response()->json($ttdp);
            }
            else if($request->huyen != ''){
                if($request->flag != ''){
                    $huyen= quan_huyen::where('IdHuyen', $request->id)->get()->first();
                    $tinh= tinh_tp::orderBy('TenTinh', 'ASC')->get();
                    $kq='';
                    foreach ($tinh as $t) {
                        $kq.='<option value="'.$t->IdTinh.'">'.$t->TenTinh.'</option>';
                    }
                    $ttdp= array(
                        'id' => $huyen->IdHuyen,
                        'tendp' => $huyen->TenHuyen,
                        'idtinh'=>$huyen->tinhTP->IdTinh,
                        'dstinh'=>$kq,
                        'msg'=>'tc'
                    );
                    return response()->json($ttdp);
                }
                else{
                    $huyen= quan_huyen::where('IdHuyen', $request->id)->get()->first();
                    $ttdp= array(
                        'id' => $huyen->IdHuyen,
                        'tendp' => $huyen->TenHuyen,
                        'msg'=>'tc'
                    );
                    return response()->json($ttdp);
                }
            }
            else if($request->xa != ''){
                if($request->flag != ''){
                    $xa= phuong_xa::where('IdXa', $request->id)->get()->first();
                    $kq='';
                    $huyen= quan_huyen::orderBy('TenHuyen', 'ASC')->get();
                    foreach ($huyen as $t) {
                        $kq.='<option value="'.$t->IdHuyen.'">'.$t->TenHuyen.'</option>';
                    }
                    $ttdp= array(
                        'id' => $xa->IdXa,
                        'tendp' => $xa->TenXa,
                        'idhuyen'=>$xa->quanHuyen->IdHuyen,
                        'dshuyen'=>$kq,
                        'msg'=>'tc'
                    );
                    return response()->json($ttdp);
                }
                else{
                    $xa= phuong_xa::where('IdXa', $request->id)->get()->first();
                    $ttdp= array(
                        'id' => $xa->IdXa,
                        'tendp' => $xa->TenXa,
                        'msg'=>'tc'
                    );
                    return response()->json($ttdp);
                }
            }
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
            if($request->tinh != ''){
                $tp=tinh_tp::where('IdTinh', $request->id)->get()->first();
                $tinh= tinh_tp::where('IdTinh', $request->ma)->get()->first();
                $t=tinh_tp::where('TenKDau', \comm_functions::changeTitle($request->ten))->get()->first();
                if($request->id != $request->ma){
                    if(is_object($t)){
                        if($t->IdTinh != $tp->IdTinh){
                            $response = array(
                                'msg' => 'trungten',
                            );
                            return response()->json($response); 
                        }
                    }
                    else if(is_object($tinh)){
                        $response = array(
                            'msg' => 'trungma',
                        );
                        return response()->json($response); 
                    }
                    $tp->delete();

                    $tinh_tp=new tinh_tp;
                    $tinh_tp->IdTinh=$request->ma;
                    $tinh_tp->TenKDau= \comm_functions::changeTitle($request->ten);
                    $tinh_tp->TenTinh=$request->ten;
                    $tinh_tp->save();
                    
                    event(new DP($tinh_tp, 'sua', 'tinh', $request->id, $request->ma));
                    
                    $response = array(
                        'msg' => 'tc'
                    );
                    return response()->json($response); 
                }
                else{
                    if(is_object($t)){
                        if($t->IdTinh != $tp->IdTinh){
                            $response = array(
                                'msg' => 'trungten',
                            );
                            return response()->json($response); 
                        }
                    }
                }

                $tp->TenKDau= \comm_functions::changeTitle($request->ten);
                $tp->TenTinh=$request->ten;
                $tp->save();
                
                event(new DP($tp, 'sua', 'tinh', $request->id, $request->ma));
                
                $response = array(
                    'msg' => 'tc',
                );
                return response()->json($response); 
                
            }
            if($request->huyen != ''){
                $q= quan_huyen::where('IdHuyen', $request->id)->get()->first();
                $huyen= quan_huyen::where('IdHuyen', $request->ma)->get()->first();
                $h= quan_huyen::where([['IdTinh', $request->huyen], ['TenKDau', \comm_functions::changeTitle($request->ten)]])->get()->first();
                if($request->id != $request->ma){
                    if(is_object($h)){
                        if($q->IdHuyen != $h->IdHuyen){
                            $response = array(
                                'msg' => 'trungten',
                            );
                            return response()->json($response); 
                        }
                    }
                    else if(is_object($huyen)){
                        $response = array(
                            'msg' => 'trungma',
                        );
                        return response()->json($response); 
                    }
                    $q->delete();

                    $quan=new quan_huyen;
                    $quan->IdHuyen=$request->ma;
                    $quan->IdTinh=$request->huyen;
                    $quan->TenKDau= \comm_functions::changeTitle($request->ten);
                    $quan->TenHuyen=$request->ten;
                    $quan->save();
                    
                    event(new DP($quan, 'sua', 'huyen', $request->id, $request->ma));
                    $response = array(
                        'msg' => 'tc'
                    );
                    return response()->json($response); 

                }
                else{
                    if(is_object($h)){
                        if($q->IdHuyen != $h->IdHuyen){
                            $response = array(
                                'msg' => 'trungten',
                            );
                            return response()->json($response); 
                        }
                    }
                }
                
                $q->TenKDau= \comm_functions::changeTitle($request->ten);
                $q->TenHuyen=$request->ten;
                $q->save();
                
                event(new DP($q, 'sua', 'huyen', $request->id, $request->ma));
                $response = array(
                    'msg' => 'tc',
                );
                return response()->json($response); 
            }
            if($request->xa != ''){
                $p=phuong_xa::where('IdXa', $request->id)->get()->first();
                $xa= phuong_xa::where('IdXa', $request->ma)->get()->first();
                $x= phuong_xa::where([['IdHuyen', $request->xa], ['IdXa', \comm_functions::changeTitle($request->ten)]])->get()->first();
                if($request->id != $request->ma){
                    if(is_object($x)){
                        if($p->IdXa != $x->IdXa){
                            $response = array(
                                'msg' => 'trungten',
                            );
                            return response()->json($response); 
                        }
                    }
                    else if(is_object($xa)){
                        $response = array(
                            'msg' => 'trungma',
                        );
                        return response()->json($response); 
                    }
                    $p->delete();

                    $phuong=new phuong_xa;
                    $phuong->IdXa=$request->ma;
                    $phuong->IdHuyen= $request->xa;
                    $phuong->TenKDau= \comm_functions::changeTitle($request->ten);
                    $phuong->TenXa=$request->ten;
                    $phuong->save();
                    
                    event(new DP($phuong, 'sua', 'xa', $request->id, $request->ma));

                    $response = array(
                        'msg' => 'tc',
                    );
                    return response()->json($response); 
                }
                else{
                    if(is_object($x)){
                        if($p->IdXa != $x->IdXa){
                            $response = array(
                                'msg' => 'trungten',
                            );
                            return response()->json($response); 
                        }
                    }
                }

                $p->TenKDau= \comm_functions::changeTitle($request->ten);
                $p->TenXa=$request->ten;
                $p->save();
                
                event(new DP($p, 'sua', 'xa', $request->id, $request->ma));
                $response = array(
                    'msg' => 'tc',
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
            if($request->tinh != ''){
                $tinh= tinh_tp::where('IdTinh', $request->ma)->get()->first();
                $t=tinh_tp::where('TenKDau', \comm_functions::changeTitle($request->ten))->get()->first();
                if(is_object($t)){
                    $response = array(
                        'msg' => 'trungten',
                    );
                    return response()->json($response); 
                }
                else if(is_object($tinh)){
                    $response = array(
                        'msg' => 'trungma',
                    );
                    return response()->json($response); 
                }
                
                $tp= new tinh_tp;
                $tp->IdTinh=$request->ma;
                $tp->TenKDau= \comm_functions::changeTitle($request->ten);
                $tp->TenTinh=$request->ten;
                $tp->save();
                
                event(new DP($tp, 'them', 'tinh'));
                $response = array(
                    'msg' => 'tc',
                );
                return response()->json($response); 
                
            }
            if($request->huyen != ''){
                $huyen= quan_huyen::where('IdHuyen', $request->ma)->get()->first();
                $h= quan_huyen::where([['IdTinh', $request->huyen], ['TenKDau', \comm_functions::changeTitle($request->ten)]])->get()->first();
                if(is_object($h)){
                    $response = array(
                        'msg' => 'trungten',
                    );
                    return response()->json($response); 
                }
                else if(is_object($huyen)){
                    $response = array(
                        'msg' => 'trungma',
                    );
                    return response()->json($response); 
                }
                
                $q= new quan_huyen;
                $q->IdHuyen=$request->ma;
                $q->IdTinh=$request->huyen;
                $q->TenKDau= \comm_functions::changeTitle($request->ten);
                $q->TenHuyen=$request->ten;
                $q->save();
                
                event(new DP($q, 'them', 'huyen'));
                $response = array(
                    'msg' => 'tc',
                );
                return response()->json($response); 
            }
            if($request->xa != ''){
                $xa= phuong_xa::where('IdXa', $request->ma)->get()->first();
                $x= phuong_xa::where([['IdHuyen', $request->xa], ['IdXa', \comm_functions::changeTitle($request->ten)]])->get()->first();
                if(is_object($x)){
                    $response = array(
                        'msg' => 'trungten',
                    );
                    return response()->json($response); 
                }
                else if(is_object($xa)){
                    $response = array(
                        'msg' => 'trungma',
                    );
                    return response()->json($response); 
                }
                
                $p= new phuong_xa;
                $p->IdXa=$request->ma;
                $p->IdHuyen=$request->xa;
                $p->TenKDau= \comm_functions::changeTitle($request->ten);
                $p->TenXa=$request->ten;
                $p->save();
                
                event(new DP($p, 'them', 'xa'));
                $response = array(
                    'msg' => 'tc',
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
                $loaidp='tinh';
                if($request->tinh != ''){
                    foreach ($arr as $a){
                        $tinh= tinh_tp::where("IdTinh", $a)->get()->first();
                        foreach ($tinh->phuongXa as $value) {
                            foreach ($value->nhanVien as $v) {
                                $nhanvien= nhan_vien::where("IdNV", $v->IdNV)->get()->first();
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
                            
                            foreach ($value->benhNhan as $v){
                                $benhnhan= benh_nhan::where("IdBN", $v->IdBN)->get()->first();
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
                            }
                        }
                        $tinh->delete();
                    }
                }
                else if($request->huyen != ''){
                    foreach ($arr as $a){
                        $huyen= quan_huyen::where("IdHuyen", $a)->get()->first();
                        foreach ($huyen->phuongXa as $value) {
                            foreach ($value->nhanVien as $v) {
                                $nhanvien= nhan_vien::where("IdNV", $v->IdNV)->get()->first();
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
                            
                            foreach ($value->benhNhan as $v){
                                $benhnhan= benh_nhan::where("IdBN", $v->IdBN)->get()->first();
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
                            }
                        }
                        $huyen->delete();
                    }
                    $loaidp='huyen';
                }
                else if($request->xa != ''){
                    foreach ($arr as $a){
                        $xa= phuong_xa::where("IdXa", $a)->get()->first();
                        foreach ($xa->nhanVien as $v) {
                            $nhanvien= nhan_vien::where("IdNV", $v->IdNV)->get()->first();
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
                        
                        foreach ($xa->benhNhan as $v){
                            $benhnhan= benh_nhan::where("IdBN", $v->IdBN)->get()->first();
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
                        }

                        $xa->delete();
                    }
                    $loaidp='xa';
                }
                
                event(new DP($arr, 'xoa', $loaidp));

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
                $loaidp='tinh';
                if($request->tinh != ''){
                    $tinh= tinh_tp::where("IdTinh", $request->id)->get()->first();
                    foreach ($tinh->phuongXa as $value) {
                        foreach ($value->nhanVien as $v) {
                            $nhanvien= nhan_vien::where("IdNV", $v->IdNV)->get()->first();
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

                        foreach ($value->benhNhan as $v){
                            $benhnhan= benh_nhan::where("IdBN", $v->IdBN)->get()->first();
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
                        }
                    }
                    $tinh->delete();
                }
                else if($request->huyen != ''){
                    $huyen= quan_huyen::where("IdHuyen", $request->id)->get()->first();
                    foreach ($huyen->phuongXa as $value) {
                        foreach ($value->nhanVien as $v) {
                            $nhanvien= nhan_vien::where("IdNV", $v->IdNV)->get()->first();
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

                        foreach ($value->benhNhan as $v){
                            $benhnhan= benh_nhan::where("IdBN", $v->IdBN)->get()->first();
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
                        }
                    }
                    $loaidp='huyen';
                    $huyen->delete();
                }
                else if($request->xa != ''){
                    $xa= phuong_xa::where("IdXa", $request->id)->get()->first();
                    foreach ($xa->nhanVien as $v) {
                        $nhanvien= nhan_vien::where("IdNV", $v->IdNV)->get()->first();
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

                    foreach ($xa->benhNhan as $v){
                        $benhnhan= benh_nhan::where("IdBN", $v->IdBN)->get()->first();
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
                    }
                    $loaidp='xa';
                    $xa->delete();
                }
                
                event(new DP($request->id, 'xoa', $loaidp));
                
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
            $sql='';
            if($request->laydssp == 'all-tinh'){
                $sql="SELECT dp.* FROM tinh_tp AS dp WHERE (dp.`IdTinh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dp.`TenTinh` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY dp.`TenTinh` ASC, dp.`IdTinh` ASC";
            }
            else if($request->laydssp  == 'sp-tinh'){
                $sql="SELECT dp.* FROM quan_huyen AS dp WHERE dp.`IdTinh` = N'".$request->tinh."' AND ((dp.`IdHuyen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dp.`TenHuyen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY dp.`TenHuyen` ASC, dp.`IdHuyen` ASC";
            }
            else if($request->laydssp  == 'all-huyen'){
                $sql="SELECT dp.* FROM quan_huyen AS dp WHERE (dp.`IdHuyen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dp.`TenHuyen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY dp.`TenHuyen` ASC, dp.`IdHuyen` ASC";
            }
            else if($request->laydssp  == 'sp-huyen'){
                $sql="SELECT dp.* FROM phuong_xa AS dp WHERE dp.`IdHuyen` = N'".$request->huyen."' AND ((dp.`IdXa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dp.`TenXa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY dp.`TenXa` ASC, dp.`IdXa` ASC";
            }
            else if($request->laydssp  == 'all-xa'){
                $sql="SELECT dp.* FROM phuong_xa AS dp WHERE (dp.`IdXa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dp.`TenXa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) ORDER BY dp.`TenXa` ASC, dp.`IdXa` ASC";
            }
            else{
                $sql="SELECT dp.* FROM phuong_xa  AS dp JOIN quan_huyen AS qh ON dp.`IdHuyen` = qh.`IdHuyen` JOIN tinh_tp AS tp ON tp.`IdTinh` = qh.`IdTinh` WHERE tp.`IdTinh` = N'".$request->tinh."' AND ((dp.`IdXa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (dp.`TenXa` LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY dp.`TenXa` ASC, dp.`IdXa` ASC";
            }
            $ds_dp=DB::select($sql);
            $dsdp = array();
            $sl=0;
            if(!empty($ds_dp)){
                if($request->laydssp == 'all-tinh'){
                    foreach ($ds_dp as $dp){
                        $ttdp= array(
                            'id' => $dp->IdTinh,
                            'tendp' => $dp->TenTinh
                        );

                        $dsdp[]=$ttdp;
                        $sl++;
                    }
                }
                else if($request->laydssp  == 'sp-tinh' || $request->laydssp  == 'all-huyen'){
                    foreach ($ds_dp as $dp){
                        $ttdp= array(
                            'id' => $dp->IdHuyen,
                            'tendp' => $dp->TenHuyen
                        );

                        $dsdp[]=$ttdp;
                        $sl++;
                    }
                }
                else if($request->laydssp  == 'sp-huyen' || $request->laydssp  == 'all-xa' || $request->laydssp  == 'sp-xa'){
                    foreach ($ds_dp as $dp){
                        $ttdp= array(
                            'id' => $dp->IdXa,
                            'tendp' => $dp->TenXa
                        );

                        $dsdp[]=$ttdp;
                        $sl++;
                    }
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dp'=>$dsdp,
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
            $ds_dp='';
            $kq="";
            if($request->laydssp  == 'all-tinh'){
                $ds_dp= tinh_tp::orderBy('TenTinh', 'ASC')->orderBy('IdTinh', 'ASC')->get();
                $dsdp=array();
                foreach ($ds_dp as $dp){
                    $ttdp= array(
                        'id' => $dp->IdTinh,
                        'tendp' => $dp->TenTinh
                    );

                    $dsdp[]=$ttdp;
                }
            }
            else if($request->laydssp  == 'sp-tinh'){
                $ds_dp= quan_huyen::where('IdTinh', $request->tinh)->orderBy('TenHuyen', 'ASC')->orderBy('IdHuyen', 'ASC')->get();
                $dsdp=array();
                foreach ($ds_dp as $dp){
                    $ttdp= array(
                        'id' => $dp->IdHuyen,
                        'tendp' => $dp->TenHuyen
                    );

                    $dsdp[]=$ttdp;
                }
                if($request->flag != ''){
                    $huyen= quan_huyen::where('IdTinh',$request->tinh)->get();
                    
                    foreach ($huyen as $t) {
                        $kq.='<option value="'.$t->IdHuyen.'">'.$t->TenHuyen.'</option>';
                    }
                }
            }
            else if($request->laydssp  == 'all-huyen'){
                $ds_dp= quan_huyen::orderBy('TenHuyen', 'ASC')->orderBy('IdHuyen', 'ASC')->get();
                $dsdp=array();
                foreach ($ds_dp as $dp){
                    $ttdp= array(
                        'id' => $dp->IdHuyen,
                        'tendp' => $dp->TenHuyen
                    );

                    $dsdp[]=$ttdp;
                }
                if($request->flag != ''){
                    foreach ($ds_dp as $t) {
                        $kq.='<option value="'.$t->IdHuyen.'">'.$t->TenHuyen.'</option>';
                    }
                }
            }
            else if($request->laydssp  == 'sp-huyen'){
                $ds_dp= phuong_xa::where('IdHuyen', $request->huyen)->orderBy('TenXa', 'ASC')->orderBy('IdXa', 'ASC')->get();
                $dsdp=array();
                foreach ($ds_dp as $dp){
                    $ttdp= array(
                        'id' => $dp->IdXa,
                        'tendp' => $dp->TenXa
                    );

                    $dsdp[]=$ttdp;
                }
            }
            else if($request->laydssp  == 'sp-xa'){
                $ds_dp= tinh_tp::where('IdTinh', $request->tinh)->get()->first();
                $dsdp=array();
                foreach ($ds_dp->phuongXa as $dp){
                    $ttdp= array(
                        'id' => $dp->IdXa,
                        'tendp' => $dp->TenXa
                    );

                    $dsdp[]=$ttdp;
                }
                if($request->flag != ''){
                    $huyen= quan_huyen::where('IdTinh',$request->tinh)->get();
                    
                    foreach ($huyen as $t) {
                        $kq.='<option value="'.$t->IdHuyen.'">'.$t->TenHuyen.'</option>';
                    }
                }
            }
            else if($request->laydssp  == 'all-xa'){
                $ds_dp= phuong_xa::orderBy('TenXa', 'ASC')->orderBy('IdXa', 'ASC')->get();
                $dsdp=array();
                foreach ($ds_dp as $dp){
                    $ttdp= array(
                        'id' => $dp->IdXa,
                        'tendp' => $dp->TenXa
                    );

                    $dsdp[]=$ttdp;
                }
                
                if($request->flag != ''){
                    $dshuyen=quan_huyen::orderBy('TenHuyen', 'ASC')->get();
                    foreach ($dshuyen as $t) {
                        $kq.='<option value="'.$t->IdHuyen.'">'.$t->TenHuyen.'</option>';
                    }
                }
            }
            else if($request->laydssp  == 'laydstinh'){
                $ds='';
                $dstinh=tinh_tp::orderBy('TenTinh', 'ASC')->get();
                foreach ($dstinh as $t) {
                    $ds.='<option value="'.$t->IdTinh.'">'.$t->TenTinh.'</option>';
                }
                $response = array(
                    'msg' => 'tc',
                    'dstinh'=>$ds
                );
                
                return response()->json($response); 
            }
            else if($request->laydssp  == 'laydshuyen'){
                $ds='';

                $dshuyen=quan_huyen::orderBy('TenHuyen', 'ASC')->get();
                foreach ($dshuyen as $t) {
                    $ds.='<option value="'.$t->IdHuyen.'">'.$t->TenHuyen.'</option>';
                }

                $response = array(
                    'msg' => 'tc',
                    'dshuyen'=>$ds
                );
                
                return response()->json($response); 
            }
            else if($request->laydssp  == 'laydshuyen_t'){
                $ds='';

                $dshuyen=quan_huyen::where('IdTinh', $request->tinh)->orderBy('TenHuyen', 'ASC')->get();
                foreach ($dshuyen as $t) {
                    $ds.='<option value="'.$t->IdHuyen.'">'.$t->TenHuyen.'</option>';
                }

                $response = array(
                    'msg' => 'tc',
                    'dshuyen'=>$ds
                );
                
                return response()->json($response); 
            }

            $response = array(
                'msg' => 'tc',
                'dp'=>$dsdp
            );
            
            if($request->flag != ''){
                $response = array(
                    'msg' => 'tc',
                    'dp'=>$dsdp,
                    'dshuyen'=>$kq
                );
            }
            

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
