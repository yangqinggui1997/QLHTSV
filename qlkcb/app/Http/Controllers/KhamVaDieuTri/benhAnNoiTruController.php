<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\phong_ban;
use App\Models\HanhChinh\nhan_vien;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\KhamVaDieuTri\chuan_doan_vs_benh_an_noi_tru;
use App\Models\HanhChinh\khoa;
use App\Events\KhamVaDieuTri\CapCuu;
use App\Events\KhamVaDieuTri\BenhAnNoiTru;
use App\Events\KhamVaDieuTri\BenhAnNgoaiTru;
use App\Models\TiepDon\phieu_dk_kham;
use App\Models\HanhChinh\co_so_kham_bhyt;
use App\Models\KhamVaDieuTri\phieu_dk_kham_vs_benh_an_noi_tru;
use App\Models\TiepDon\benh_nhan;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\HanhChinh\thiet_bi_yt;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\benh_an_noi_tru_ct_vs_can_lam_sang;
use App\Models\KhamVaDieuTri\chi_dinh_tt_vs_benh_an_noi_tru_ct;
use App\Models\KhamVaDieuTri\toa_thuoc_vs_benh_an_noi_tru_ct;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Models\HanhChinh\thong_ke;

class benhAnNoiTruController extends Controller
{
    //
    public function getDanhSach(){
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idnv=$user->nhanVien->IdNV;
        $idkhoa=$user->nhanVien->phongBan->Khoa->IdKhoa;
        
        $dsdmcls= khoa::where('TenKDau', 'can_lam_sang')->get()->first();
        $dsdmcls=$dsdmcls->danhMucCLS;
        
        $dsphongcls= phong_ban::where('PhanLoai', 'can_lam_sang')->orderBy('SoPhong', 'ASC')->get();
        
        $dsphongtt=phong_ban::where('PhanLoai', 'thu_thuat')->orderBy('SoPhong', 'ASC')->get();
        
        $dsphongpt=phong_ban::where('PhanLoai', 'phau_thuat')->orderBy('SoPhong', 'ASC')->get();
        
        $khoak= khoa::where('IdKhoa', $idkhoa)->get()->first();
        $dsthuthuat=[];$dspt=[];
        foreach ($khoak->danhMucCLS as $value) {
            if($value->danhMucCLS->PhanLoai == 'thu_thuat'){
                $dsthuthuat[]=$value;
            }
        }
        foreach ($khoak->danhMucCLS as $value) {
            if($value->danhMucCLS->PhanLoai == 'phau_thuat'){
                $dspt[]=$value;
            }
        }

        $dsbanoi= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at','DESC')->get();
        
        $khoa= khoa::where('IdKhoa', $idkhoa)->get()->first();
        $dsnv=$khoa->nhanVien;
        
        $dsbenh=$khoa->danhMucBenh;
        
        $dsgiuong=[];
        foreach ($khoa->phongBan as $value) {
            foreach ($value->thietBiYT as $v) {
                if($v->TTTB=='hoat_dong_tot'){
                    $dsgiuong[]=$v;
                }
                
            }
        }
        
        $tenkhoa= mb_convert_case($khoa->TenKhoa, MB_CASE_UPPER, 'UTF-8');
        $tennv= mb_convert_case($user->nhanVien->TenNV, MB_CASE_UPPER, 'UTF-8');
        $dscsk= co_so_kham_bhyt::where('Tuyen', '>=', 2)->orderBy('TenCS', 'ASC')->get();
        
        $ds= ba_nv::where('IdNV',$idnv)->orderBy('created_at', 'DESC')->get();
        
        $dsbachotn=array();
        foreach($ds as $tn){
            $banoi= benh_an_noi_tru::where('IdBANoiT', $tn->IdBANoiT)->get()->first();
            
            if(is_object($banoi)){
                $dsbachotn[]=$banoi;
            }
        }
        
        $dsnv_k= nhan_vien::where([['CV', 'bac_si_chuyen_khoa_kham_va_dieu_tri'], ['IdNV','<>' ,$idnv]])->orderBy('TenNV', 'ASC')->get();
        
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
        
        return view("kham_vs_dieu_tri.benh_an_noi_tru", ['dsdmcls'=>$dsdmcls, 'dsphongcls'=>$dsphongcls, 'dsphongtt'=>$dsphongtt, 'dsthuthuat'=>$dsthuthuat, 'dsba'=>$dsbanoi, 'dsnv'=>$dsnv, 'dsbenh'=>$dsbenh, 'khoa' => $idkhoa, 'tenkhoa' => $tenkhoa, 'tennv'=>$tennv, 'dspt'=>$dspt, 'dsphongpt'=>$dsphongpt, 'dsgiuong'=>$dsgiuong, 'dscskhambhyt'=>$dscsk, 'dsbachotn'=>$dsbachotn, 'dsnv_k'=>$dsnv_k, 'dsbc'=>$sl]);
    }
    
    public function getDanhSachCT(Request $request){
        try{
            if($request->id != ''){
                $ba= benh_an_noi_tru::where('IdBANoiT', $request->id)->orderBy('created_at', 'DESC')->get()->first();
                $bact='';
                foreach ($ba->benhAnNoiTruCT as $value) {
                    $bact.='<tr>
                        <td style="vertical-align: middle;">
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                <input type="checkbox" data-input="check" data-id="'.$value->IdBACT.'">
                                <span class="au-checkmark"></span>
                            </label>
                        </td>
                        <td> 
                            '.date('d/m/Y', strtotime($value->NgayBD)).'
                        </td>
                        <td>
                            '.date('d/m/Y', strtotime($value->NgayKT)).'
                        </td>
                        <td>
                            '.\comm_functions::decodePPDT($value->PPDieuTri).'
                        </td>
                        <td>'.\comm_functions::decodeTTBN($value->TinhTrangBN).'</td>
                        <td>
                            <div class="table-data-feature">
                                <button type="button" class="item" data-toggle="modal" data-target="#modalxemtt" data-button="btnxemtt" data-id="'.$value->IdBACT.'" rel="tooltip" title="Xem chi tiết thuốc điều trị">
                                    <i class="fa fa-list-alt"></i>
                                </button>
                                <button type="button" class="item" data-toggle="modal" data-target="#modalcls" data-button="btnxemkqcls" data-id="'.$value->IdBACT.'" rel="tooltip" title="Xem kết quả cận lâm sàng">
                                    <i class="fa fa-stethoscope"></i>
                                </button>
                                <button type="button" class="item" data-toggle="modal" data-target="#modalxemthuthuat" data-button="btnxemcdtt" data-id="'.$value->IdBACT.'" rel="tooltip" title="Xem chỉ định thủ thuật">
                                    <i class="fa fa-magic"></i>
                                </button>
                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="btnsuact" data-id="'.$value->IdBACT.'">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoact" data-id="'.$value->IdBACT.'">
                                    <i class="zmdi zmdi-delete"  ></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>';
                }
                $response = array(
                    'msg' => 'tc',
                    'dsct'=>$bact,
                    'idba'=>$ba->IdBANoiT
                );
                return response()->json($response);
            }
            else if($request->idba != ''){
                $ba= benh_an_noi_tru::where('IdBANoiT', $request->idba)->orderBy('created_at', 'DESC')->get()->first();
                $bact='';
                foreach ($ba->benhAnNoiTruCT as $value) {
                    $bact.='<tr>
                        <td style="vertical-align: middle;">
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                <input type="checkbox" data-input="check" data-id="'.$value->IdBACT.'">
                                <span class="au-checkmark"></span>
                            </label>
                        </td>
                        <td> 
                            '.date('d/m/Y', strtotime($value->NgayBD)).'
                        </td>
                        <td>
                            '.date('d/m/Y', strtotime($value->NgayKT)).'
                        </td>
                        <td>
                            '.\comm_functions::decodePPDT($value->PPDieuTri).'
                        </td>
                        <td>'.\comm_functions::decodeTTBN($value->TinhTrangBN).'</td>
                        <td>
                            <div class="table-data-feature">
                                <button type="button" class="item" data-toggle="modal" data-target="#modalxemtt" data-button="btnxemtt" data-id="'.$value->IdBACT.'" rel="tooltip" title="Xem chi tiết thuốc điều trị" data-loaiba="noi">
                                    <i class="fa fa-list-alt"></i>
                                </button>
                                <button type="button" class="item" data-toggle="modal" data-target="#modalcls" data-button="btnxemkqcls" data-id="'.$value->IdBACT.'" rel="tooltip" title="Xem kết quả cận lâm sàng" data-loaiba="noi">
                                    <i class="fa fa-stethoscope"></i>
                                </button>
                                <button type="button" class="item" data-toggle="modal" data-target="#modalxemthuthuat" data-button="btnxemcdtt" data-id="'.$value->IdBACT.'" rel="tooltip" title="Xem chỉ định thủ thuật" data-loaiba="noi">
                                    <i class="fa fa-magic"></i>
                                </button>
                                <button type="button" class="item" data-toggle="modal" data-target="#modalxemphauthuat" data-button="btnxemcdpt" data-id="'.$value->IdBACT.'" rel="tooltip" title="Xem chỉ định phẫu thuật">
                                    <i class="fa fa-user-secret"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>';
                }
                $response = array(
                    'msg' => 'tc',
                    'dsct'=>$bact
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
    
    public function postXTT(Request $request){
        try{
            $ba= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            $dstoact = array();
            if(is_object($ba)){
                foreach ($ba->benhAnNoiTruCT as $bact) {
                    if(is_object($bact->toaThuoc)){//Đã lập toa
                        foreach ($bact->toaThuoc->toaThuoc->toaThuocCT as $toact){
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
                                $lieudung='Sáng: '.$sang;
                            }
                            if($trua != ''){
                                if($sang != ''){
                                    $lieudung.='| Trưa: '.$trua;
                                }
                                else{
                                    $lieudung.='Trưa: '.$trua;
                                }

                            }
                            if($chieu != ''){
                                if($sang != ''){
                                     $lieudung.='| Chiều: '.$chieu;
                                }
                                else{
                                    if($trua != ''){
                                        $lieudung.='| Chiều: '.$chieu;
                                    }
                                    else{
                                        $lieudung.='Chiều: '.$chieu;
                                    }
                                }
                            }
                            if($toi != ''){
                                if($sang != ''){
                                    $lieudung.='| Tối: '.$toi;
                                }
                                else{
                                    if($trua != ''){
                                        $lieudung.='| Tối: '.$toi;
                                    }
                                    else{
                                        if($chieu != ''){
                                            $lieudung.='| Tối: '.$toi;
                                        }
                                        else{
                                            $lieudung.='Tối: '.$toi;
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
                                'ghichu'=>$ghichuct,
                                'ngaycap'=> \comm_functions::deDateFormat($toact->toaThuoc->created_at)

                            );
                            $dstoact[]=$tttoathuoc;
                        }
                    }
                }
            }
            $response = array(
                'msg' => 'tc',
                'dstoact'=>$dstoact,
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
    
    public function postXKQCLS(Request $request){
        try{
            $ds_kq=array();
            $ba= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            if(is_object($ba)){
                foreach ($ba->benhAnNoiTruCT as $banoi) {
                    if(is_object($banoi->canLamSang)){
                        foreach ($banoi->canLamSang as $cls){
                            if(is_object($cls->canLamSang->ketQuaCLS)){
                                $kqcls=$cls->canLamSang->ketQuaCLS;
                                $kq='';$i=1;
                                foreach ($kqcls->ketQuaCLSCT as $kqct){
                                    if($i == count($kqcls->ketQuaCLSCT)){
                                        $kq.='- '.$kqct->KetQua;
                                        break;
                                    }
                                    $kq.='- '.$kqct->KetQua.'<br>';
                                }
                                $kl='';$i=1;
                                foreach ($kqcls->ketLuanCLS as $kqct){
                                    if($i == count($kqcls->ketLuanCLS)){
                                        $kl.='- '.$kqct->KetLuan;
                                        break;
                                    }
                                    $kl.='- '.$kqct->KetLuan.'<br>';
                                }
                                $kqha='<div class="row">';$i=1;
                                foreach ($kqcls->anhCLS as $kqct){
                                    if($i % 2 == 0 ){
                                        if($i < count($kqcls->anhCLS)){
                                            $kqha.='<div class="col-lg-6 m-b-15">
                                                <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                            </div>
                                        </div>
                                        <div class="row">';
                                        }
                                        else{
                                            $kqha.='<div class="col-lg-6 m-b-15">
                                                <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                            </div>
                                        </div>';
                                        }
                                    }
                                    else{
                                        if($i < count($kqcls->anhCLS)){
                                            $kqha.='<div class="col-lg-6 m-b-15">
                                                <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                                </div>';
                                        }
                                        else{
                                            $kqha.='<div class="col-lg-6 m-b-15">
                                                <img class="height-100px" src="public/upload/anhcls/'.$kqct->Anh.'">
                                            </div>
                                        </div>';
                                        }
                                    }
                                    $i++;
                                }
                                $ttkqcls= array(
                                    'nvth'=>$kqcls->nhanVien->TenNV,
                                    'kq'=>$kq,
                                    'kl'=>$kl,
                                    'kqha'=>$kqha,
                                    'ngayth' => \comm_functions::deDateFormat($kqcls->created_at),
                                    'phong'=>$kqcls->canLamSang->phongBan->SoPhong.' - '.$kqcls->canLamSang->phongBan->TenPhong,
                                    'tencls'=>$kqcls->canLamSang->danhMucCLS->TenCLS
                                );
                                $ds_kq[]=$ttkqcls;      
                            }
                        }
                    }
                }
            }
            $response= array(
                'kqcls' => $ds_kq,
                'msg'=>'tc'
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
    
    public function postXCDTT(Request $request){
        try{
            $dscdtt = array();
            $banoi= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            if(is_object($banoi)){
                foreach ($banoi->benhAnNoiTruCT as $ba) {
                    if(is_object($ba->phieuChiDinhTT)){//Đã ra các chỉ định
                        foreach ($ba->phieuChiDinhTT as $cd){
                            $cd=$cd->chiDinhTT;
                            $ghichu='Không có';
                            if($cd->GhiChu != ''){
                                $ghichu=$cd->GhiChu;
                            }
                            $cdtt= array(
                                'tentt' => $cd->danhMucCLS->TenCLS,
                                'phongth' => $cd->phongBan->SoPhong.' - '.$cd->phongBan->TenPhong,
                                'nv' => $cd->nhanVien->TenNV,
                                'ngayracd' => date('d/m/Y', strtotime($cd->created_at)),
                                'iddmcls' => $cd->danhMucCLS->IdDMCLS,
                                'ghichu'=>$ghichu
                            );
                            $dscdtt[]=$cdtt;
                        }
                    }
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dscdtt'=>$dscdtt
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
    
    public function postXCDPT(Request $request){
        try{
            $dscdpt = array();
            $banoi= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            if(is_object($banoi)){
                foreach ($banoi->benhAnNoiTruCT as $ba) {
                    if(is_object($ba->phieuChiDinhPT)){//Đã ra các chỉ định
                        $ttpt =array(
                            'tenpt' => $ba->phieuChiDinhPT->danhMucCLS->TenCLS,//
                            'ngayracd' => \comm_functions::deDateFormat($ba->phieuChiDinhPT->created_at),//
                            'nv' => $ba->phieuChiDinhPT->nhanVien->TenNV,//
                            'ppth'=>$ba->phieuChiDinhPT->PhuongPhapTH,//
                            'phongth'=>$ba->phieuChiDinhPT->phongBan->SoPhong.' - '.$ba->phieuChiDinhPT->phongBan->TenPhong,
                        );
                        $dscdpt[]=$ttpt;
                    }
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'dscdpt'=>$dscdpt
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
            $bangoai= benh_an_ngoai_tru::where('IdBANgoaiT', $request->id)->get()->first();
            
            if(is_object($bangoai)){
                $pk=$bangoai->phieuDKKham->phieuDKKham;
                if(is_object($pk->benhAnNoiTru)){
                    $response = array(
                        'msg' => 'da_chuyen'
                    );
                    return response()->json($response); 
                }
                else if(is_object($bangoai->giayChuyenVien)){
                    $response = array(
                        'msg' => 'da_chuyen_vien'
                    );
                    return response()->json($response); 
                }
                else{
                    $banoi= new benh_an_noi_tru;
                    $banoi->IdBANoiT= benhAnNoiTruController::TaoMaNN();
                    $banoi->IdNV= $bangoai->IdNV;
                    $banoi->IdGiuong=$request->giuong;
                    $banoi->CapCuu= 0;
                    $banoi->TTLucVao=$bangoai->TTBN;
                    $banoi->LyDoNV=$request->lydonv;
                    $banoi->GhiChu=$request->ghichu;
                    $banoi->TrangThaiBA=1;
                    $banoi->TinhTrangTT=0;

                    $banoi->save();

                    //cập nhật lại tình trạng sử dụng của thiết bị
                    $tb= thiet_bi_yt::where('IdTB', $request->giuong)->get()->first();
                    if(count($tb->benhAnNoiTru) == 1){
                        $tb->TinhTrangSD=1;
                        $tb->save();
                    }

                    //thêm trên bảng quan hệ phiếu đăng ký khám với bệnh án
                    $phieudk= new phieu_dk_kham_vs_benh_an_noi_tru;
                    $phieudk->IdPhieuDKKB=$bangoai->phieuDKKham->IdPhieuDKKB;
                    $phieudk->IdBANoiT=$banoi->IdBANoiT;
                    $phieudk->save();

                    foreach ($bangoai->chuanDoan as $value) {
                        $chuandoan=new chuan_doan_vs_benh_an_noi_tru;
                        $chuandoan->IdBANoiT=$banoi->IdBANoiT;
                        $chuandoan->IdBenh=$value->danhMucBenh->IdBenh;
                        $chuandoan->save();
                    }

                    event(new BenhAnNoiTru($banoi, 'them'));

                    event(new BenhAnNgoaiTru($bangoai->IdBANgoaiT, 'xoa'));

                    $response = array(
                        'msg' => 'tc'
                    );
                    return response()->json($response); 
                }
            }
            else{
                $response = array(
                    'msg' => 'ktt'
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
    
    public function postNhanBA(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            
            $ba= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            $idnvchuyen=$ba->nhanVien->IdNV;

            if(is_object($ba)){
                if(is_object($ba->giayChuyenVien)){
                    $response = array(
                        'msg' => 'da_chuyen_vien'
                    );
                    return response()->json($response); 
                }
                else{
                    $ba_nv=ba_nv::where('IdBANoiT', $request->id)->get()->first();
                    
                    $ba->IdNV= $idnv;
                    if($ba_nv->GhiChu != ''){
                        if($ba->GhiChu != ''){
                            $ba->GhiChu=$ba->GhiChu.'; '.$ba_nv->GhiChu;
                        }
                        else{
                            $ba->GhiChu=$ba_nv->GhiChu;
                        }
                    }

                    //cập nhật lại tình trạng sử dụng của thiết bị
                    
                    $tbc= thiet_bi_yt::where('IdTB', $ba->IdGiuong)->get()->first();
                    $giuongc='';$idtbc=$tbc->IdTB;
                    if(count($tbc->benhAnNoiTru)  == 1){
                        $tbc->TinhTrangSD = 0;
                        $tbc->save();
                        $giuongc='<option data-ttsd="0" value="'.$tbc->IdTB.'">Giường bệnh số '.$tbc->SoTB.' - Phòng số '.$tbc->phongBan->SoPhong.' (Trống)</option>';
                    }
                    else{
                        $giuongc='<option data-ttsd="1" value="'.$tbc->IdTB.'">Giường bệnh số '.$tbc->SoTB.' - Phòng số '.$tbc->phongBan->SoPhong.' (Đang sử dụng)</option>';
                    }
                    
                    $khoa=$user->nhanVien->phongBan->Khoa;
                    $dsgiuong=[];
                    $giuong='';
                    foreach ($khoa->phongBan as $value) {
                        $flag_g=FALSE;
                        foreach ($value->thietBiYT as $v) {
                            if($v->TinhTrangSD == 0){
                                $flag_g = TRUE;
                                $giuong=$v->IdTB;
                                break;
                            }
                            else{
                                $giuong=$v->IdTB;
                            }
                        }
                        if($flag_g == TRUE){
                            break;
                        }
                    }
                    $giuongm='';$idtbm='';
                    if($giuong != ''){
                        $ba->IdGiuong= $giuong;
                        $tbm= thiet_bi_yt::where('IdTB', $giuong)->get()->first();
                        $idtbm=$tbm->IdTB;
                        if(count($tbm->benhAnNoiTru)  == 0){
                            $tbm->TinhTrangSD = 1;
                            $tbm->save();
                            
                        }
                        $giuongm='<option data-ttsd="1" value="'.$tbm->IdTB.'">Giường bệnh số '.$tbm->SoTB.' - Phòng số '.$tbm->phongBan->SoPhong.' (Đang sử dụng)</option>';
                    }
                    $ba->save();

                    $ba_nv->delete();

                    $nv= ba_nv::where('IdNV', $idnv)->get();
                    $slba=count($nv);

                    event(new CapCuu($ba, $idnvchuyen, $idnv, $slba, 'nhanba', $idtbc, $giuongc, $idtbm, $giuongm));

                    $response = array(
                        'msg' => 'tc'
                    );
                    return response()->json($response); 
                }
            }
            else{
                $response = array(
                    'msg' => 'ktt'
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
    
    public function postThemCT(Request $request){
        try{
            $banct=benh_an_noi_tru_ct::where('IdBANoiT', $request->id)->get()->first();
            if(is_object($banct)){
                $ngayht = \DateTime::createFromFormat("d/m/Y", date('d/m/Y'));
                $ngaykt= \DateTime::createFromFormat("d/m/Y", date('d/m/Y', strtotime($banct->NgayKT)));
                if($ngayht <= $ngaykt){
                    $response = array(
                        'msg' => 'chuakt'
                    );
                    return response()->json($response); 
                }
            }
            $banoi= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            if($banoi->TrangThaiBA == 0){
                $response = array(
                    'msg' => 'ktdt'
                );
                return response()->json($response); 
            }
            
            $ba_ct=new benh_an_noi_tru_ct;
            $ba_ct->IdBACT= benhAnNoiTruController::TaoMaNNCT();
            $ba_ct->IdBANoiT=$request->id;
            $ba_ct->PPDieuTri=$request->ppdt;
            $ba_ct->NgayBD= \comm_functions::enDateFormatDateOnly($request->ngaybd);
            $ba_ct->NgayKT= \comm_functions::enDateFormatDateOnly($request->ngaykt);
            $ba_ct->TinhTrangBN=$request->ttbn;
            $ba_ct->GhiChu=$request->ghichu;
            $ba_ct->save();
            
            //sao chép các chỉ định thủ thuật, cls từ bệnh án ngoại sang bệnh án nội ct

            if(is_object($banoi->phieuDKKham->phieuDKKham->benhAnNgoaiTru)){
                $bangoai=$banoi->phieuDKKham->phieuDKKham->benhAnNgoaiTru->benhAnNgoaiTru;
                foreach ($bangoai->chiDinhTT as $value) {
                    $cdtt_banoi=new chi_dinh_tt_vs_benh_an_noi_tru_ct;
                    $cdtt_banoi->IdBACT= $ba_ct->IdBACT;
                    $cdtt_banoi->IdThuThuat=$value->IdThuThuat;
                    $cdtt_banoi->save();
                }

                foreach ($bangoai->CanLamSang as $value) {
                    $cdcls_banoi=new benh_an_noi_tru_ct_vs_can_lam_sang;
                    $cdcls_banoi->IdBACT= $ba_ct->IdBACT;
                    $cdcls_banoi->IdCLS=$value->IdCLS;
                    $cdcls_banoi->save();
                }

                if(is_object($bangoai->toaThuoc)){
                    $cdcls_banoi=new toa_thuoc_vs_benh_an_noi_tru_ct;
                    $cdcls_banoi->IdBACT= $ba_ct->IdBACT;
                    $cdcls_banoi->IdTT=$bangoai->toaThuoc->toaThuoc->IdTT;
                    $cdcls_banoi->save();
                }

                if(is_object($bangoai->CanLamSang)){
                    foreach($bangoai->CanLamSang as $cls){
                        $cls->delete();
                    }
                }
                if(is_object($bangoai->chiDinhTT)){
                    foreach($bangoai->chiDinhTT as $cdtt){
                        $cdtt->delete();
                    }
                }
                if(is_object($bangoai->toaThuoc)){
                    $bangoai->toaThuoc->delete();
                }
                $bangoai->delete();
            }

            $bact=benh_an_noi_tru_ct::where('IdBACT', $ba_ct->IdBACT)->get()->first();
            $present= date_create(date('Y-m-d', strtotime($bact->NgayKT)));
            $timeba= date_create(date('Y-m-d', strtotime($bact->NgayBD)));
            $sndt= date_diff($timeba, $present);
            
            $ba_n_ct='<tr>
                    <td style="vertical-align: middle;">
                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                            <input type="checkbox" data-input="check" data-id="'.$bact->IdBACT.'">
                            <span class="au-checkmark"></span>
                        </label>
                    </td>
                    <td> 
                        '.date('d/m/Y', strtotime($bact->NgayBD)).'
                    </td>
                    <td>
                        '.date('d/m/Y', strtotime($bact->NgayKT)).'
                    </td>
                    <td>
                        '.\comm_functions::decodePPDT($bact->PPDieuTri).'
                    </td>
                    <td>'.\comm_functions::decodeTTBN($bact->TinhTrangBN).'</td>
                    <td>
                        <div class="table-data-feature">
                            <button type="button" class="item" data-toggle="modal" data-target="#modalxemtt" data-button="btnxemtt" data-id="'.$bact->IdBACT.'" rel="tooltip" title="Xem chi tiết thuốc điều trị">
                                <i class="fa fa-list-alt"></i>
                            </button>
                            <button type="button" class="item" data-toggle="modal" data-target="#modalcls" data-button="btnxemkqcls" data-id="'.$bact->IdBACT.'" rel="tooltip" title="Xem kết quả cận lâm sàng">
                                <i class="fa fa-stethoscope"></i>
                            </button>
                            <button type="button" class="item" data-toggle="modal" data-target="#modalxemthuthuat" data-button="btnxemcdtt" data-id="'.$bact->IdBACT.'" rel="tooltip" title="Xem chỉ định thủ thuật">
                                <i class="fa fa-magic"></i>
                            </button>
                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="btnsuact" data-id="'.$bact->IdBACT.'">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoact" data-id="'.$bact->IdBACT.'">
                                <i class="zmdi zmdi-delete"  ></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="spacer"></tr>';
            $flag_cv=FALSE;
            if(count($banoi->benhAnNoiTruCT) == 1 && $banoi->phieuDKKham->phieuDKKham->KhamBHYT == 0 && $banoi->TrangThaiBA == 1){
                $flag_cv=TRUE;
            }
            $flag_cba=FALSE;
            if(count($banoi->benhAnNoiTruCT) > 0 && $banoi->TrangThaiBA == 1){
                $flag_cba=TRUE;
            }
            $response = array(
                'msg' => 'tc',
                'bact'=>$ba_n_ct,
                'snd'=>$sndt->format('%a')+1,
                'idbact'=>$bact->IdBACT,
                'chuyenvien'=>$flag_cv,
                'chuyenba'=>$flag_cba
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
    
    public function postLayTTCN(Request $request){
        try{
            $benhan= benh_an_noi_tru::where('IdBANoiT',$request->id)->get()->first();
            $benhnhan=$benhan->phieuDKKham->phieuDKKham->benhNhan;
            $ngaysinh=date( "d/m/Y", strtotime($benhnhan->NgaySinh));
            $tuyen='Đúng tuyến';$chuyentu='Không chuyển'; $giaychuyen='Không có giấy chuyển';$htk='thuphi';
            if($benhan->phieuDKKham->phieuDKKham->Tuyen == 1){
                $tuyen='Vượt tuyến';$chuyentu='Tuyến huyện';
                if($benhan->phieuDKKham->phieuDKKham->GiayChuyen == 1){
                    $giaychuyen='Có giấy chuyển';
                }
            }
            else if($benhan->phieuDKKham->phieuDKKham->Tuyen == 2){
                $tuyen='Vượt tuyến';$chuyentu='Tuyến xã';
                if($benhan->phieuDKKham->phieuDKKham->GiayChuyen == 1){
                    $giaychuyen='Có giấy chuyển';
                }
            }
            if($benhan->phieuDKKham->phieuDKKham->KhamBHYT == 0){
                $htk='bhyt';
            }
            
            $gt="Nam";
            if($benhnhan->GioiTinh == 0){
                $gt="Nữ";
            }
            $scmnd="Chưa cập nhật!";
            if($benhnhan->SoCMND != ''){
                $scmnd=$benhnhan->SoCMND;
            }
            $diachi="";
            if($benhnhan->DiaChi == ''){
                $diachi="Xã ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            else{
                $diachi=$benhnhan->DiaChi.", xã, ".$benhnhan->phuongXa->TenXa.", huyện ".$benhnhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$benhnhan->phuongXa->quanHuyen->tinhTP->TenTinh;
            }
            $dantoc ="Chưa cập nhật!";
            if($benhnhan->DanToc != ''){
                $dantoc = \comm_functions::decodeDanToc($benhnhan->DanToc);
            }
            $chuandoan=array();
            foreach ($benhan->chuanDoan as $cd) {
                $chuandoan[]=['id'=>$cd->danhMucBenh->IdBenh, 'name'=>$cd->danhMucBenh->TenBenh];
            }
            
            $mathe='koco';
            $ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';
            if(is_object($benhnhan->theBHYT)){
                $mathe=$benhnhan->theBHYT->IdTheBHYT;
                $ngaydk=date( "d/m/Y", strtotime($benhnhan->theBHYT->NgayDK));
                $ngayhh=date( "d/m/Y", strtotime($benhnhan->theBHYT->NgayHH));
                $doituong= \comm_functions::getDTK($benhnhan->theBHYT->DoiTuongBHYT);
                $noidk=$benhnhan->theBHYT->coSoKhamBHYT->TenCS;
                $mh= \comm_functions::getMucHuongDTK($benhnhan->theBHYT->DoiTuongBHYT).'%';
            }
            $flag_cv=FALSE;
            if(count($benhan->benhAnNoiTruCT) > 0 && $benhan->phieuDKKham->phieuDKKham->KhamBHYT == 0 && $benhan->TrangThaiBA == 1){
                $flag_cv=TRUE;
            }
            $dttn='BHYT';
            if($benhan->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                $dttn='Thu phí';
            }
            $ttbn='Tỉnh táo';
            if($benhan->TTLucVao == 'hon_me'){
                $ttbn='Hôn mê';
            }
            else if($benhan->TTLucVao == 'hon_me_sau'){
                $ttbn='Hôn mê sâu';
            }
            $flag_cba=FALSE;
            if(count($benhan->benhAnNoiTruCT) > 0 && $benhan->TrangThaiBA == 1){
                $flag_cba=TRUE;
            }

            $response=array(
                'msg'=>'tc',
                'hotenbn' => $benhnhan->HoTen,
                'ngaysinh' => $ngaysinh,
                'gt' => $gt,
                'diachi' => $diachi,
                'dantoc'=>$dantoc,
                'socmnd' => $scmnd,
                'chuandoan'=>$chuandoan,
                'ghichu'=>$benhan->GhiChu,
                'id' => $benhan->IdBANoiT,
                'mabn' => $benhnhan->IdBN,
                'mathe'=>$mathe,
                'ngaydk'=>$ngaydk,
                'ngayhh'=>$ngayhh,
                'noidk'=>$noidk,
                'doituong'=>$doituong,
                'mh'=>$mh,
                'ttbn'=>$ttbn,
                'tuyen'=>$tuyen,
                'chuyentu'=>$chuyentu,
                'giaychuyen'=>$giaychuyen,
                'lydonv'=>$benhan->LyDoNV,
                'giuong'=>$benhan->IdGiuong,
                'anh'=>$benhnhan->Anh,
                'htk'=>$htk,
                'chuyenvien'=>$flag_cv,
                'chuyenba'=>$flag_cba,
                'dttn'=>$dttn,
                'tinhtrangbn'=>$benhan->TTLucVao,
                'giuongp'=>'Phòng '.$benhan->thietBiYT->phongBan->SoPhong.' - Giường số '.$benhan->thietBiYT->SoTB
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

    public function postLayTTCNCT(Request $request){
        try{
            $bact= benh_an_noi_tru_ct::where('IdBACT',$request->idbact)->get()->first();
            $present= date_create(date('Y-m-d', strtotime($bact->NgayKT)));
            $timeba= date_create(date('Y-m-d', strtotime($bact->NgayBD)));
            $sndt= date_diff($timeba, $present);
            $response=array(
                'msg'=>'tc',
                'ppdt' => $bact->PPDieuTri,
                'ngaybd' => date('d/m/Y', strtotime($bact->NgayBD)),
                'ngaykt' => date('d/m/Y', strtotime($bact->NgayKT)),
                'ttbn' => $bact->TinhTrangBN,
                'ghichu'=>$bact->GhiChu,
                'snd'=>$sndt->format('%a')+1
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
    
    public function postSua(Request $request)
    {
        try{
            $bannoi= benh_an_noi_tru::where('IdBANoiT', $request->id)->get()->first();
            
            $idtbc='';$idtbm=''; $flag=FALSE;
            if($bannoi->IdGiuong != $request->giuong){
                $flag=TRUE;
                
                $tbc= thiet_bi_yt::where('IdTB', $bannoi->IdGiuong)->get()->first();
                $idtbc=$tbc->IdTB;
                
                $tbm= thiet_bi_yt::where('IdTB', $request->giuong)->get()->first();
                $idtbm=$tbm->IdTB;
            }

            $bannoi->IdGiuong= $request->giuong;
            $bannoi->LyDoNV=$request->lydonv;
            $bannoi->GhiChu=$request->ghichu;

            $bannoi->save();
            
            if(strpos($request->chuandoan, ',')){//nhiều hơn một bệnh
                $arr= explode(',',$request->chuandoan);
                $chuandoan= chuan_doan_vs_benh_an_noi_tru::where('IdBANoiT',$request->id)->get();
                foreach ($chuandoan as $value) {
                    $value->delete();
                }
                foreach($arr as $value){
                    $chuandoan= new chuan_doan_vs_benh_an_noi_tru;
                    $chuandoan->IdBenh=$value;
                    $chuandoan->IdBANoiT=$request->id;
                    $chuandoan->save();
                }
            }
            else{
                $chuandoan= chuan_doan_vs_benh_an_noi_tru::where('IdBANoiT',$request->id)->get();
                foreach ($chuandoan as $value) {
                    $value->delete();
                }
                $chuandoan= new chuan_doan_vs_benh_an_noi_tru;
                $chuandoan->IdBenh=$request->chuandoan;
                $chuandoan->IdBANoiT=$request->id;
                $chuandoan->save();
            }
            if($flag == TRUE){
                event(new BenhAnNoiTru($bannoi, 'sua', $idtbc, $idtbm));
            }            
            else{
                event(new BenhAnNoiTru($bannoi, 'sua'));
            }
            $response = array(
                'msg' => 'tc'
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

    public function postSuaCT(Request $request){
        try{
            $bact= benh_an_noi_tru_ct::where('IdBACT',$request->id)->get()->first();
            if($bact->benhAnNoiTru->TrangThaiBA == 0){
                $response = array(
                    'msg' => 'ktdt'
                );
                return response()->json($response); 
            }
            else{
                $ngayht = \DateTime::createFromFormat("d/m/Y", date('d/m/Y'));
                $ngaykt= \DateTime::createFromFormat("d/m/Y", date('d/m/Y', strtotime($bact->NgayKT)));
                if($ngayht > $ngaykt){
                    $response = array(
                        'msg' => 'dakt'
                    );
                    return response()->json($response); 
                }
            }
            $bact->PPDieuTri=$request->ppdt;
            $bact->NgayBD= \comm_functions::enDateFormatDateOnly($request->ngaybd);
            $bact->NgayKT= \comm_functions::enDateFormatDateOnly($request->ngaykt);
            $bact->TinhTrangBN=$request->ttbn;
            $bact->GhiChu=$request->ghichu;
            $bact->save();
            
            $banct=benh_an_noi_tru_ct::where('IdBACT', $request->id)->get()->first();
            $ba_ct='<tr>
                    <td style="vertical-align: middle;">
                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                            <input type="checkbox" data-input="check" data-id="'.$banct->IdBACT.'">
                            <span class="au-checkmark"></span>
                        </label>
                    </td>
                    <td> 
                        '.date('d/m/Y', strtotime($banct->NgayBD)).'
                    </td>
                    <td>
                        '.date('d/m/Y', strtotime($banct->NgayKT)).'
                    </td>
                    <td>
                        '.\comm_functions::decodePPDT($banct->PPDieuTri).'
                    </td>
                    <td>'.\comm_functions::decodeTTBN($banct->TinhTrangBN).'</td>
                    <td>
                        <div class="table-data-feature">
                            <button type="button" class="item" data-toggle="modal" data-target="#modalxemtt" data-button="btnxemtt" data-id="'.$banct->IdBACT.'" rel="tooltip" title="Xem chi tiết thuốc điều trị">
                                <i class="fa fa-list-alt"></i>
                            </button>
                            <button type="button" class="item" data-toggle="modal" data-target="#modalcls" data-button="btnxemkqcls" data-id="'.$banct->IdBACT.'" rel="tooltip" title="Xem kết quả cận lâm sàng">
                                <i class="fa fa-stethoscope"></i>
                            </button>
                            <button type="button" class="item" data-toggle="modal" data-target="#modalxemthuthuat" data-button="btnxemcdtt" data-id="'.$banct->IdBACT.'" rel="tooltip" title="Xem chỉ định thủ thuật">
                                <i class="fa fa-magic"></i>
                            </button>
                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="btnsuact" data-id="'.$banct->IdBACT.'">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button type="button" class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="btnxoact" data-id="'.$banct->IdBACT.'">
                                <i class="zmdi zmdi-delete"  ></i>
                            </button>
                        </div>
                    </td>
                </tr>';
            $present= date_create(date('Y-m-d', strtotime($banct->NgayKT)));
            $timeba= date_create(date('Y-m-d', strtotime($banct->NgayBD)));
            $sndt= date_diff($timeba, $present);
            
            $response = array(
                'msg' => 'tc',
                'bact'=>$ba_ct,
                'snd'=>$sndt->format('%a')+1
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
            $pk=[];$dstb=[];
            try{
                foreach ($arr as $a){
                    $benhan= benh_an_noi_tru::where("IdBANoiT", $a)->get()->first();
                    $p=$benhan->phieuDKKham->phieuDKKham;
                    $pk[]=$p->IdPhieuDKKB;
                    foreach ($benhan->benhAnNoiTruCT as $value){
                        if(is_object($value->canLamSang)){
                            foreach($value->canLamSang as $cls){
                                $cls->canLamSang->delete();
                            }
                        }
                        if(is_object($value->phieuChiDinhTT)){
                            foreach($value->phieuChiDinhTT as $cdtt){
                                $cdtt->chiDinhTT->delete();
                            }
                        }
                        
                        if(is_object($value->phieuChiDinhPT)){
                            $value->phieuChiDinhPT->delete();
                        }
                        
                        if(is_object($value->toaThuoc)){
                            $value->toaThuoc->toaThuoc->delete();
                        }
                    }
                    //cập nhật lại tình trạng sử dụng của thiết bị
                    $tb= thiet_bi_yt::where('IdTB', $benhan->IdGiuong)->get()->first();
                    $giuong='';
                    if(count($tb->benhAnNoiTru) == 1){
                        $tb->TinhTrangSD=0;
                        $tb->save();
                        $giuong='<option data-ttsd="0" value="'.$tb->IdTB.'">Giường bệnh số '.$tb->SoTB.' - Phòng số '.$tb->phongBan->SoPhong.' (Trống)</option>';
                    }
                    else{
                        $giuong='<option data-ttsd="1" value="'.$tb->IdTB.'">Giường bệnh số '.$tb->SoTB.' - Phòng số '.$tb->phongBan->SoPhong.' (Đang sử dụng)</option>';
                    }
                    $dstb[]=['id'=>$tb->IdTB,'nd'=>$giuong];
                    $benhan->delete();
                }
                
                event(new BenhAnNoiTru($arr, 'xoa',NULL,NULL,$pk));
                
                $response = array(
                    'msg' => 'tc',
                    'idtb'=>$dstb
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
                $benhan= benh_an_noi_tru::where("IdBANoiT", $request->id)->get()->first();
                $p=$benhan->phieuDKKham->phieuDKKham;
                $pk[]=$p->IdPhieuDKKB;
                foreach ($benhan->benhAnNoiTruCT as $value){
                    if(is_object($value->canLamSang)){
                        foreach($value->canLamSang as $cls){
                            $cls->canLamSang->delete();
                        }
                    }
                    if(is_object($value->phieuChiDinhTT)){
                        foreach($value->phieuChiDinhTT as $cdtt){
                            $cdtt->chiDinhTT->delete();
                        }
                    }

                    if(is_object($value->phieuChiDinhPT)){
                        $value->phieuChiDinhPT->delete();
                    }

                    if(is_object($value->toaThuoc)){
                        $value->toaThuoc->toaThuoc->delete();
                    }
                }
                
                //cập nhật lại tình trạng sử dụng của thiết bị
                $tb= thiet_bi_yt::where('IdTB', $benhan->IdGiuong)->get()->first();
                $giuong='';
                if(count($tb->benhAnNoiTru) == 1){
                    $tb->TinhTrangSD=0;
                    $tb->save();
                    $giuong='<option data-ttsd="0" value="'.$tb->IdTB.'">Giường bệnh số '.$tb->SoTB.' - Phòng số '.$tb->phongBan->SoPhong.' (Trống)</option>';
                }
                else{
                    $giuong='<option data-ttsd="1" value="'.$tb->IdTB.'">Giường bệnh số '.$tb->SoTB.' - Phòng số '.$tb->phongBan->SoPhong.' (Đang sử dụng)</option>';
                }
                $benhan->delete();
                
                event(new BenhAnNoiTru($request->id, 'xoa',NULL,NULL,$pk));
                
                $response = array(
                    'msg' => 'tc',
                    'idtb'=>$tb->IdTB,
                    'giuong'=>$giuong
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
    
    public function postXoaCT(Request $request){
        if(strpos($request->id, ',')){//gửi nhiều mã
            $arr= explode(',',$request->id);
            try{
                $ba='';
                foreach ($arr as $a){
                    $benhan= benh_an_noi_tru_ct::where("IdBACT", $a)->get()->first();
                    $ba=$benhan->benhAnNoiTru;
                    if(is_object($benhan->canLamSang)){
                        foreach($benhan->canLamSang as $cls){
                            $cls->canLamSang->delete();
                        }
                    }
                    if(is_object($benhan->phieuChiDinhTT)){
                        foreach($benhan->phieuChiDinhTT as $cdtt){
                            $cdtt->chiDinhTT->delete();
                        }
                    }

                    if(is_object($benhan->phieuChiDinhPT)){
                        $benhan->phieuChiDinhPT->delete();
                    }

                    if(is_object($benhan->toaThuoc)){
                        $benhan->toaThuoc->toaThuoc->delete();
                    }
                    
                    $benhan->delete();
                }
                $flag_cv=TRUE;
                if(count($ba->benhAnNoiTruCT) == 0 && $ba->phieuDKKham->phieuDKKham->KhamBHYT == 0 && $ba->TrangThaiBA == 1){
                    $flag_cv=FALSE;
                }
                $flag_cba=TRUE;
                if(count($ba->benhAnNoiTruCT) == 0 && $ba->TrangThaiBA == 1){
                    $flag_cba=FALSE;
                }
                $response = array(
                    'msg' => 'tc',
                    'chuyenvien'=>$flag_cv
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
                
                $benhan= benh_an_noi_tru_ct::where("IdBACT", $request->id)->get()->first();
                $ba=$benhan->benhAnNoiTru;
                if(is_object($benhan->canLamSang)){
                    foreach($benhan->canLamSang as $cls){
                        $cls->canLamSang->delete();
                    }
                }
                if(is_object($benhan->phieuChiDinhTT)){
                    foreach($benhan->phieuChiDinhTT as $cdtt){
                        $cdtt->chiDinhTT->delete();
                    }
                }

                if(is_object($benhan->phieuChiDinhPT)){
                    $benhan->phieuChiDinhPT->delete();
                }

                if(is_object($benhan->toaThuoc)){
                    $benhan->toaThuoc->toaThuoc->delete();
                }

                $benhan->delete();
                
                $flag_cv=TRUE;
                if(count($ba->benhAnNoiTruCT) == 0 && $ba->phieuDKKham->phieuDKKham->KhamBHYT == 0 && $ba->TrangThaiBA == 1){
                    $flag_cv=FALSE;
                }
                $flag_cba=TRUE;
                if(count($ba->benhAnNoiTruCT) == 0 && $ba->TrangThaiBA == 1){
                    $flag_cba=FALSE;
                }
                $response = array(
                    'msg' => 'tc',
                    'chuyenvien'=>$flag_cv
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

    public function postLayDSPhieuKham(Request $request){
        $pk=[];
        if(strpos($request->idpk, ',')){//gửi nhiều mã
            $arr= explode(',',$request->idpk);
            try{
                
                foreach ($arr as $a){
                    $pdk= phieu_dk_kham::where('IdPhieuDKKB', $a)->get()->first();
                    if(date('d/m/Y', strtotime($pdk->created_at)) == date('d/m/Y')){
                        $pdk->TrangThai=0;//trả về trạng thái chưa tiếp nhận
                        $pdk->save();
                        
                        $idpk=$pdk->IdPhieuDKKB;
                        $idbn=$pdk->IdBN;
                        $hoten=$pdk->benhNhan->HoTen;
                        $ngaysinh=date( "d/m/Y", strtotime($pdk->benhNhan->NgaySinh));
                        $khambhyt=TRUE;
                        if($pdk->KhamBHYT == 1){
                            $khambhyt=FALSE;
                        }
                        $t='Đúng tuyến';$chuyentu='Không chuyển';
                        $giaychuyen='Không có giấy chuyển';
                        if($pdk->TuyenKham == 1){
                            $chuyentu='Tuyến huyện';$t='Vượt tuyến';
                        }
                        else if($pdk->TuyenKham == 2){
                            $chuyentu='Tuyến xã';$t='Vượt tuyến';
                        }
                        if($pdk->GiayChuyen == 1){
                            $giaychuyen='Có giấy chuyển';
                        }
                        $gt='Nam';
                        if($pdk->benhNhan->GioiTinh == 0){
                            $gt='Nam';
                        }
                        $dantoc= \comm_functions::decodeDanToc($pdk->benhNhan->DanToc);
                        $socmnd=$pdk->benhNhan->SoCMND;
                        $diachi="";
                        if($pdk->benhNhan->DiaChi == ''){
                            $diachi="Xã ".$pdk->benhNhan->phuongXa->TenXa.", huyện ".$pdk->benhNhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$pdk->benhNhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                        }
                        else{
                            $diachi=$pdk->benhNhan->DiaChi.", xã, ".$pdk->benhNhan->phuongXa->TenXa.", huyện ".$pdk->benhNhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$pdk->benhNhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                        }
                        $mathe='koco';$ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';
                        if(is_object($pdk->benhNhan->theBHYT)){
                            $mathe=$pdk->benhNhan->theBHYT->IdTheBHYT;
                            $ngaydk=date( "d/m/Y", strtotime($pdk->benhNhan->theBHYT->NgayDK));
                            $ngayhh=date( "d/m/Y", strtotime($pdk->benhNhan->theBHYT->NgayHH));
                            $noidk=$pdk->benhNhan->theBHYT->coSoKhamBHYT->TenCS;
                            $mh= \comm_functions::getMucHuongDTK($pdk->benhNhan->theBHYT->DoiTuongBHYT).'%';
                            $doituong= \comm_functions::getDTK($pdk->benhNhan->theBHYT->DoiTuongBHYT);
                        }
                        $pk[]=['stt'=>$pdk->STT, 'idpk'=>$idpk, 'idbn'=>$idbn, 'hoten'=>$hoten, 'ngaysinh'=>$ngaysinh, 'gt'=>$gt, 'dantoc'=>$dantoc, 'socmnd'=>$socmnd, 'diachi'=>$diachi, 'mathe'=>$mathe, 'ngaydk'=>$ngaydk, 'ngayhh'=>$ngayhh, 'noidk'=>$noidk, 'mh'=>$mh, 'doituong'=>$doituong, 'anh'=>$pdk->benhNhan->Anh, 'dtk'=>$pdk->KhamBHYT, 'khambhyt' => $khambhyt, 't'=>$t, 'giaychuyen'=>$giaychuyen, 'chuyentu'=>$chuyentu];
                    }
                    
                }
                $response = array(
                    'msg' => 'tc',
                    'pk'=> $pk
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
                $p=$request->idpk;
                $pdk= phieu_dk_kham::where('IdPhieuDKKB', $p)->get()->first();
                if(date('d/m/Y', strtotime($pdk->created_at)) == date('d/m/Y')){
                    $pdk->TrangThai=0;//trả về trạng thái chưa tiếp nhận
                    $pdk->save();
                    
                    $idpk=$pdk->IdPhieuDKKB;
                    $idbn=$pdk->IdBN;
                    $hoten=$pdk->benhNhan->HoTen;
                    $ngaysinh=date( "d/m/Y", strtotime($pdk->benhNhan->NgaySinh));
                    $gt='Nam';
                    if($pdk->benhNhan->GioiTinh == 0){
                        $gt='Nam';
                    }
                    $khambhyt=TRUE;
                    if($pdk->KhamBHYT == 1){
                        $khambhyt=FALSE;
                    }
                    $t='Đúng tuyến';$chuyentu='Không chuyển';
                    $giaychuyen='Không có giấy chuyển';
                    if($pdk->TuyenKham == 1){
                        $chuyentu='Tuyến huyện';$t='Vượt tuyến';
                    }
                    else if($pdk->TuyenKham == 2){
                        $chuyentu='Tuyến xã';$t='Vượt tuyến';
                    }
                    if($pdk->GiayChuyen == 1){
                        $giaychuyen='Có giấy chuyển';
                    }
                    $dantoc= \comm_functions::decodeDanToc($pdk->benhNhan->DanToc);
                    $socmnd=$pdk->benhNhan->SoCMND;
                    $diachi="";
                    if($pdk->benhNhan->DiaChi == ''){
                        $diachi="Xã ".$pdk->benhNhan->phuongXa->TenXa.", huyện ".$pdk->benhNhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$pdk->benhNhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    else{
                        $diachi=$pdk->benhNhan->DiaChi.", xã, ".$pdk->benhNhan->phuongXa->TenXa.", huyện ".$pdk->benhNhan->phuongXa->quanHuyen->TenHuyen.", tỉnh ".$pdk->benhNhan->phuongXa->quanHuyen->tinhTP->TenTinh;
                    }
                    $mathe='koco';$ngaydk='';$ngayhh='';$noidk='';$doituong='';$mh='';
                    if(is_object($pdk->benhNhan->theBHYT)){
                        $mathe=$pdk->benhNhan->theBHYT->IdTheBHYT;
                        $ngaydk=date( "d/m/Y", strtotime($pdk->benhNhan->theBHYT->NgayDK));
                        $ngayhh=date( "d/m/Y", strtotime($pdk->benhNhan->theBHYT->NgayHH));
                        $noidk=$pdk->benhNhan->theBHYT->coSoKhamBHYT->TenCS;
                        $mh= \comm_functions::getMucHuongDTK($pdk->benhNhan->theBHYT->DoiTuongBHYT).'%';
                        $doituong= \comm_functions::getDTK($pdk->benhNhan->theBHYT->DoiTuongBHYT);
                    }
                    $pk[]=['idpk'=>$idpk, 'idbn'=>$idbn, 'hoten'=>$hoten, 'ngaysinh'=>$ngaysinh, 'gt'=>$gt, 'dantoc'=>$dantoc, 'socmnd'=>$socmnd, 'diachi'=>$diachi, 'mathe'=>$mathe, 'ngaydk'=>$ngaydk, 'ngayhh'=>$ngayhh, 'noidk'=>$noidk, 'mh'=>$mh, 'stt'=>$pdk->STT, 'doituong'=>$doituong, 'anh'=>$pdk->benhNhan->Anh, 'dtk'=>$pdk->KhamBHYT, 'khambhyt' => $khambhyt, 't'=>$t, 'giaychuyen'=>$giaychuyen, 'chuyentu'=>$chuyentu];
                }
                $response = array(
                    'msg' => 'tc',
                    'pk'=>$pk
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
    
    public function postKTBA(Request $request){
        try{
            $bn= benh_nhan::where('IdBN', $request->mabn)->get()->first();
            $phieudk= phieu_dk_kham::where('IdPhieuDKKB', $request->mapdk)->get()->first();
            $msg='';$flag=FALSE;
            foreach($bn->phieuDkKham as $pdk){
                if(!is_object($pdk->benhAnNgoaiTru) && $pdk->phongKham->Khoa->IdKhoa == $phieudk->phongKham->Khoa->IdKhoa)
                {
                    $flag=TRUE;
                    break;
                }
            }
            if($flag == FALSE){
                $msg='dang_dieu_tri';
            }
            else{
                $msg='kt_dieu_tri';
            }
            
            $response=array(
                'msg'=>$msg
            );

            return response()->json($response);
        }
        catch(\Exception $ex){
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
            $ds_benhan= DB::select("SELECT DISTINCT ba.`IdBANoiT` FROM benh_nhan AS bn JOIN phieu_dk_kham AS pdk ON bn.`IdBN` = pdk.`IdBN` JOIN phieu_dk_kham_vs_benh_an_noi_tru AS pk_ba ON pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB` JOIN benh_an_noi_tru AS ba ON pk_ba.`IdBANoiT` = ba.`IdBANoiT` JOIN thiet_bi_yt AS tb ON ba.`IdGiuong` = tb.`IdTB` JOIN chuan_doan_vs_benh_an_noi_tru AS cd ON ba.`IdBANoiT` = cd.`IdBANoiT` JOIN danh_muc_benh AS b ON cd.`IdBenh` = b.`IdBenh` JOIN phong_ban AS pb ON pb.`IdPB` = tb.`IdPB` JOIN nhan_vien AS nv ON nv.`IdNV` = ba.`IdNV` WHERE nv.`IdNV` = N'".$idnv."' AND ((bn.`IdBN` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (bn.`HoTen` LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (b.`TenBenh` LIKE  N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN ba.`TTLucVao` = N'tinh_tao' THEN N'Tỉnh táo' WHEN ba.`TTLucVao` = N'hon_me' THEN N'Hôn mê' ELSE N'Hôn mê sâu' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN pdk.`KhamBHYT` = 0 THEN N'bhyt Bảo hiểm y tế' WHEN pdk.`KhamBHYT` = 1 THEN N'tp Thu phí' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CASE WHEN ba.`TrangThaiBA` IS FALSE THEN N'Kết thúc điều trị ket thuc dieu tri' ELSE N'Đang điều trị dang dieu tri' END LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (CONCAT(N'Phòng ', pb.`SoPhong`,' - ', N'Giường số ', tb.`SoTB`) LIKE N'%".$key."%' COLLATE utf8_unicode_ci) OR (DATE_FORMAT(ba.`created_at`, '%d/%m/%Y %h:%i:%s') LIKE N'%".$key."%' COLLATE utf8_unicode_ci)) ORDER BY ba.created_at DESC");
            $dsba = array();
            $sl=0;
            if(!empty($ds_benhan)){
                foreach ($ds_benhan as $benhan){
                    $benhan= benh_an_noi_tru::where('IdBANoiT', $benhan->IdBANoiT)->get()->first();
                    $benhnhan=$benhan->phieuDKKham->phieuDKKham->benhNhan;

                    $chuandoan=array();
                    foreach ($benhan->chuanDoan as $cd) {
                        $chuandoan[]=$cd->danhMucBenh->TenBenh;
                    }
                    $ngaybddt= \comm_functions::deDateFormat($benhan->created_at); 
                    $tinhtrangbn='';
                    if($benhan->TTLucVao == 'tinh_tao'){
                        if($benhan->GhiChu != ''){
                            $tinhtrangbn='Tỉnh táo - '.$benhan->GhiChu;
                        }
                        else{
                            $tinhtrangbn='Tỉnh táo';
                        }
                    }
                    else if($benhan->TTLucVao == 'hon_me'){
                        if($benhan->GhiChu != ''){
                            $tinhtrangbn='Hôn mê- '.$benhan->GhiChu;
                        }
                        else{
                            $tinhtrangbn='Hôn mê';
                        }
                    }
                    else{
                        if($benhan->GhiChu != ''){
                            $tinhtrangbn='Hôn mê sâu - '.$benhan->GhiChu;
                        }
                        else{
                            $tinhtrangbn='Hôn mê sâu';
                        }
                    }
                    $tb=$benhan->thietBiYT;
                    
                    $songaydt=1;
                    if($benhan->TrangThaiBA == 0){
                        if(count($benhan->benhAnNoiTruCT) > 0){
                            foreach ($benhan->benhAnNoiTruCT as $value) {
                                $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                $timeba= date_create(date('Y-m-d H:m:s', strtotime($benhan->created_at)));
                                $t= date_diff($timeba, $present);
                                $songaydt= $t->format('%a') + 1;
                                break;
                            }
                        }
                        else{
                            $songaydt=1;
                        }
                    }
                    else{
                        if(count($benhan->benhAnNoiTruCT) > 0){
                            foreach ($benhan->benhAnNoiTruCT as $value) {
                                $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                $timeba= date_create(date('Y-m-d H:m:s', strtotime($benhan->created_at)));
                                $t= date_diff($timeba, $present);
                                $songaydt=$t->format('%a') + 1;
                                break;
                            }
                        }
                        else{
                            $present= date_create(date('Y-m-d H:m:s'));
                            $timeba= date_create(date('Y-m-d H:m:s', strtotime($benhan->created_at)));
                            $t= date_diff($timeba, $present);
                            $songaydt=$t->format('%a') + 1;
                        }
                    }
                    $trangthaiba='Đang điều trị';
                    if($benhan->TrangThaiBA == 0){
                        $trangthaiba='Đã kết thúc điều trị';
                    }
                    $dttn='BHYT';
                    if($benhan->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                    $ttba= array(
                        'hoten' => $benhnhan->HoTen,
                        'chuandoan'=>$chuandoan,
                        'ngaybddt'=>$ngaybddt,
                        'songaydt'=>$songaydt,
                        'trangthaiba'=>$trangthaiba,
                        'id' => $benhan->IdBANoiT,
                        'idbn' => $benhnhan->IdBN,
                        'lydonv'=>$benhan->LyDoNV,
                        'ttbn'=>$tinhtrangbn,
                        'gb'=>'Phòng '.$tb->phongBan->SoPhong.' - Giường số '.$tb->SoTB,
                        'dttn'=>$dttn
                    );
                    
                    $dsba[]=$ttba;
                    $sl++;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'benhan'=>$dsba,
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
    
    public function postLayDSBA(){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $idnv=$user->nhanVien->IdNV;
            $ds_benhan= benh_an_noi_tru::where('IdNV', $idnv)->orderBy('created_at', 'DESC')->get();
            $dsba = array();
            if(!empty($ds_benhan)){
                foreach ($ds_benhan as $benhan){
                    $benhnhan=$benhan->phieuDKKham->phieuDKKham->benhNhan;

                    $chuandoan=[];
                    foreach ($benhan->chuanDoan as $cd) {
                        $chuandoan[]=$cd->danhMucBenh->TenBenh;
                    }
                    $ngaybddt= \comm_functions::deDateFormat($benhan->created_at); 
                    $tinhtrangbn='';
                    if($benhan->TTLucVao == 'tinh_tao'){
                        if($benhan->GhiChu != ''){
                            $tinhtrangbn='Tỉnh táo - '.$benhan->GhiChu;
                        }
                        else{
                            $tinhtrangbn='Tỉnh táo';
                        }
                    }
                    else if($benhan->TTLucVao == 'hon_me'){
                        if($benhan->GhiChu != ''){
                            $tinhtrangbn='Hôn mê- '.$benhan->GhiChu;
                        }
                        else{
                            $tinhtrangbn='Hôn mê';
                        }
                    }
                    else{
                        if($benhan->GhiChu != ''){
                            $tinhtrangbn='Hôn mê sâu - '.$benhan->GhiChu;
                        }
                        else{
                            $tinhtrangbn='Hôn mê sâu';
                        }
                    }
                    $tb=$benhan->thietBiYT;
                    
                    $songaydt=1;
                    if($benhan->TrangThaiBA == 0){
                        if(count($benhan->benhAnNoiTruCT) > 0){
                            foreach ($benhan->benhAnNoiTruCT as $value) {
                                $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                $timeba= date_create(date('Y-m-d H:m:s', strtotime($benhan->created_at)));
                                $t= date_diff($timeba, $present);
                                $songaydt= $t->format('%a') + 1;
                                break;
                            }
                        }
                        else{
                            $songaydt=1;
                        }
                    }
                    else{
                        if(count($benhan->benhAnNoiTruCT) > 0){
                            foreach ($benhan->benhAnNoiTruCT as $value) {
                                $present= date_create(date('Y-m-d H:m:s', strtotime($value->NgayKT)));
                                $timeba= date_create(date('Y-m-d H:m:s', strtotime($benhan->created_at)));
                                $t= date_diff($timeba, $present);
                                $songaydt=$t->format('%a') + 1;
                                break;
                            }
                        }
                        else{
                            $present= date_create(date('Y-m-d H:m:s'));
                            $timeba= date_create(date('Y-m-d H:m:s', strtotime($benhan->created_at)));
                            $t= date_diff($timeba, $present);
                            $songaydt=$t->format('%a') + 1;
                        }
                    }
                    $trangthaiba='Đang điều trị';
                    if($benhan->TrangThaiBA == 0){
                        $trangthaiba='Đã kết thúc điều trị';
                    }
                    $dttn='BHYT';
                    if($benhan->phieuDKKham->phieuDKKham->KhamBHYT == 1){
                        $dttn='Thu phí';
                    }
                    $ttba= array(
                        'hoten' => $benhnhan->HoTen,
                        'chuandoan'=>$chuandoan,
                        'ngaybddt'=>$ngaybddt,
                        'songaydt'=>$songaydt,
                        'trangthaiba'=>$trangthaiba,
                        'id' => $benhan->IdBANoiT,
                        'idbn' => $benhnhan->IdBN,
                        'lydonv'=>$benhan->LyDoNV,
                        'ttbn'=>$tinhtrangbn,
                        'gb'=>'Phòng '.$tb->phongBan->SoPhong.' - Giường số '.$tb->SoTB,
                        'dttn'=>$dttn
                    );
                    $dsba[]=$ttba;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'benhan'=>$dsba,
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
        $ds= benh_an_noi_tru::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $ba) {
                   if($ba->IdBANoiT == $ran){
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
    
    public static function TaoMaNNCT(){
        $ran = \comm_functions::BigRandomNumber(0000000001, 1000000000);
        $flag=TRUE;
        $ds= benh_an_noi_tru_ct::all();
        
        if($ds->isNotEmpty()){
            while($flag){
                foreach ($ds as $ba) {
                   if($ba->IdBACT == $ran){
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
