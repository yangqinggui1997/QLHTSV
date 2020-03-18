<?php

namespace App\Http\Controllers\KhamVaDieuTri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HanhChinh\tinh_tp;
use App\Models\HanhChinh\quan_huyen;
use App\Models\HanhChinh\phuong_xa;
use App\Models\HanhChinh\khoa;
use App\Models\HanhChinh\danh_muc_benh_vs_khoa;
use App\Models\HanhChinh\danh_muc_benh;
use App\Models\HanhChinh\danh_muc_cls;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\QueryException;
use App\Models\KhamVaDieuTri\ba_nv;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use App\Models\HanhChinh\thong_ke;

class thongKeController extends Controller
{
    //
    
    public function getDanhSach(){
        
        $user= User::where('id', auth()->user()->id)->get()->first();
        $idkhoa=$user->nhanVien->phongBan->Khoa->IdKhoa;
        $idnv=$user->nhanVien->IdNV;
        
        $dsbenh_k= danh_muc_benh_vs_khoa::where('IdKhoa', $idkhoa)->get();
        
        $dsbenh=array();
        
        foreach ($dsbenh_k as $value){
            $dsbenh[]=$value->danhMucBenh;
        }
        
        $tinh= tinh_tp::orderBy('TenTinh', 'ASC')->get();
        
        $dscho= ba_nv::where('IdNV',$idnv)->orderBy('created_at', 'DESC')->get();
        
        $dsbachotn=array();
        foreach($dscho as $tn){
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
        return view("kham_vs_dieu_tri.thong_ke_dieu_tri",['dstinh'=>$tinh, 'dsbenh' => $dsbenh, 'dsbachotn'=>$dsbachotn, 'dsbc'=>$sl]);
    }
    
    public function getDanhSachCLS(){
        $dscls= danh_muc_cls::where('PhanLoai', 'can_lam_sang')->orderBy('TenCLS', 'ASC')->get();
        
        $dskhoa= khoa::where('KhoaKham', 1)->orderBy('TenKhoa', 'ASC')->get();
        
        return view("kham_vs_dieu_tri.thong_ke_cls",['dskhoa'=>$dskhoa, 'dscls' => $dscls]);
    }
    
    public static function getsql_benh($param, $benh, $dp, $loaitk){
        $cod='';$pa='';$pa_s='';$rs_g='';
        if($loaitk == 'tkb'){
            $cod=" (dmb.`IdBenh` = N'".$benh."' COLLATE utf8_unicode_ci) AND ";
            if($dp == 'xa'){
                $pa=' RS.IdXa, count(RS.IdBN) as SLT, ';$pa_s=' bn.`IdBN`,';$rs_g=' RS.IdXa';
            }
            else if($dp == 'huyen'){
                $pa=' RS.IdHuyen, count(RS.IdBN) as SLT, ';$pa_s=' qh.`IdHuyen`, bn.`IdBN`,';$rs_g=' RS.IdHuyen';
            }
            else{
                $pa=' RS.IdTinh, count(RS.IdBN) as SLT,';$pa_s=' tp.`IdTinh`, bn.`IdBN`,';$rs_g=' RS.IdTinh';
            }
        }
        else{
            $pa='  RS.IdBenh, count(RS.IdBN) as SLT, ';
            $pa_s=' dmb.`IdBenh`, bn.`IdBN`,';
            $rs_g=' RS.IdBenh';
        }
        if($dp == 'xa'){
            return "select ".$pa." sum(RS.KhamBHYT = 0) as SLBH, sum(RS.KhamBHYT = 1) as SLTP, sum(RS.ba = 0) as SLNGOAI, sum(RS.ba=1) as SLNOI from (
        (
        select distinct BANGOAI.* from
        (
        select  ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 0 end as ba from khoa as k right join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdKhoa` = k.`IdKhoa` right join danh_muc_benh as dmb on dmb.`IdBenh` = dmb_k.`IdBenh` right join chuan_doan_vs_benh_an_ngoai_tru as cd_ba on cd_ba.`IdBenh` = dmb.`IdBenh` right join benh_an_ngoai_tru as ba on ba.`IdBANgoaiT` = cd_ba.`IdBANgoaiT` right join phieu_dk_kham_vs_benh_an_ngoai_tru as pk_ba on pk_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` right join phieu_dk_kham as pdk on pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB` right join benh_nhan as bn on pdk.`IdBN` = bn.`IdBN` right join phuong_xa as px on px.`IdXa` = bn.`IdXa` right join quan_huyen as qh on qh.`IdHuyen` = px.`IdHuyen` right join tinh_tp as tp on tp.`IdTinh` = qh.`IdTinh` where ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba

        union all

        select  ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 0 end as ba from tinh_tp as tp left join quan_huyen as qh on qh.`IdTinh` = tp.`IdTinh` left join phuong_xa as px on px.`IdHuyen` = qh.`IdHuyen` left join benh_nhan as bn on bn.`IdXa` = px.`IdXa` left join phieu_dk_kham as pdk on pdk.`IdBN` = bn.`IdBN` left join phieu_dk_kham_vs_benh_an_ngoai_tru as pk_ba on pk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` left join benh_an_ngoai_tru as ba on ba.`IdBANgoaiT` = pk_ba.`IdBANgoaiT` left join chuan_doan_vs_benh_an_ngoai_tru as cd_ba on cd_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` left join danh_muc_benh as dmb on dmb.`IdBenh` = cd_ba.`IdBenh` left join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdBenh` = dmb.`IdBenh` left join khoa as k on k.`IdKhoa` = dmb_k.`IdKhoa` where  ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba 
        ) as  BANGOAI
        )

        union all

        (
        select distinct  BANOI.* from
        (
        select ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 1 end as ba from khoa as k right join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdKhoa` = k.`IdKhoa` right join danh_muc_benh as dmb on dmb.`IdBenh` = dmb_k.`IdBenh` right join chuan_doan_vs_benh_an_noi_tru as cd_ba on cd_ba.`IdBenh` = dmb.`IdBenh` right join benh_an_noi_tru as ba on ba.`IdBANoiT` = cd_ba.`IdBANoiT` right join phieu_dk_kham_vs_benh_an_noi_tru as pk_ba on pk_ba.`IdBANoiT` = ba.`IdBANoiT` right join phieu_dk_kham as pdk on pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB` right join benh_nhan as bn on pdk.`IdBN` = bn.`IdBN` right join phuong_xa as px on px.`IdXa` = bn.`IdXa` right join quan_huyen as qh on qh.`IdHuyen` = px.`IdHuyen` right join tinh_tp as tp on tp.`IdTinh` = qh.`IdTinh` where  ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba

        union all

        select ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 1 end as ba from tinh_tp as tp left join quan_huyen as qh on qh.`IdTinh` = tp.`IdTinh` left join phuong_xa as px on px.`IdHuyen` = qh.`IdHuyen` left join benh_nhan as bn on bn.`IdXa` = px.`IdXa` left join phieu_dk_kham as pdk on pdk.`IdBN` = bn.`IdBN` left join phieu_dk_kham_vs_benh_an_noi_tru as pk_ba on pk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` left join benh_an_noi_tru as ba on ba.`IdBANoiT` = pk_ba.`IdBANoiT` left join chuan_doan_vs_benh_an_noi_tru as cd_ba on cd_ba.`IdBANoiT` = ba.`IdBANoiT` left join danh_muc_benh as dmb on dmb.`IdBenh` = cd_ba.`IdBenh` left join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdBenh` = dmb.`IdBenh` left join khoa as k on k.`IdKhoa` = dmb_k.`IdKhoa` where  ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba 
        ) as  BANOI
        )
        ) as RS GROUP BY ".$rs_g;
        }
        else if($dp == 'huyen'){

            return "select ".$pa." sum(RS.KhamBHYT = 0) as SLBH, sum(RS.KhamBHYT = 1) as SLTP, sum(RS.ba = 0) as SLNGOAI, sum(RS.ba=1) as SLNOI from (
        (
        select distinct BANGOAI.* from
        (
        select  ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 0 end as ba from khoa as k right join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdKhoa` = k.`IdKhoa` right join danh_muc_benh as dmb on dmb.`IdBenh` = dmb_k.`IdBenh` right join chuan_doan_vs_benh_an_ngoai_tru as cd_ba on cd_ba.`IdBenh` = dmb.`IdBenh` right join benh_an_ngoai_tru as ba on ba.`IdBANgoaiT` = cd_ba.`IdBANgoaiT` right join phieu_dk_kham_vs_benh_an_ngoai_tru as pk_ba on pk_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` right join phieu_dk_kham as pdk on pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB` right join benh_nhan as bn on pdk.`IdBN` = bn.`IdBN` right join phuong_xa as px on px.`IdXa` = bn.`IdXa` right join quan_huyen as qh on qh.`IdHuyen` = px.`IdHuyen` right join tinh_tp as tp on tp.`IdTinh` = qh.`IdTinh` where ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba

        union all

        select  ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 0 end as ba from tinh_tp as tp left join quan_huyen as qh on qh.`IdTinh` = tp.`IdTinh` left join phuong_xa as px on px.`IdHuyen` = qh.`IdHuyen` left join benh_nhan as bn on bn.`IdXa` = px.`IdXa` left join phieu_dk_kham as pdk on pdk.`IdBN` = bn.`IdBN` left join phieu_dk_kham_vs_benh_an_ngoai_tru as pk_ba on pk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` left join benh_an_ngoai_tru as ba on ba.`IdBANgoaiT` = pk_ba.`IdBANgoaiT` left join chuan_doan_vs_benh_an_ngoai_tru as cd_ba on cd_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` left join danh_muc_benh as dmb on dmb.`IdBenh` = cd_ba.`IdBenh` left join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdBenh` = dmb.`IdBenh` left join khoa as k on k.`IdKhoa` = dmb_k.`IdKhoa` where ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba 
        ) as  BANGOAI
        )

        union all

        (
        select distinct  BANOI.* from
        (
        select ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 1 end as ba from khoa as k right join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdKhoa` = k.`IdKhoa` right join danh_muc_benh as dmb on dmb.`IdBenh` = dmb_k.`IdBenh` right join chuan_doan_vs_benh_an_noi_tru as cd_ba on cd_ba.`IdBenh` = dmb.`IdBenh` right join benh_an_noi_tru as ba on ba.`IdBANoiT` = cd_ba.`IdBANoiT` right join phieu_dk_kham_vs_benh_an_noi_tru as pk_ba on pk_ba.`IdBANoiT` = ba.`IdBANoiT` right join phieu_dk_kham as pdk on pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB` right join benh_nhan as bn on pdk.`IdBN` = bn.`IdBN` right join phuong_xa as px on px.`IdXa` = bn.`IdXa` right join quan_huyen as qh on qh.`IdHuyen` = px.`IdHuyen` right join tinh_tp as tp on tp.`IdTinh` = qh.`IdTinh` where ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba

        union all

        select ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 1 end as ba from tinh_tp as tp left join quan_huyen as qh on qh.`IdTinh` = tp.`IdTinh` left join phuong_xa as px on px.`IdHuyen` = qh.`IdHuyen` left join benh_nhan as bn on bn.`IdXa` = px.`IdXa` left join phieu_dk_kham as pdk on pdk.`IdBN` = bn.`IdBN` left join phieu_dk_kham_vs_benh_an_noi_tru as pk_ba on pk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` left join benh_an_noi_tru as ba on ba.`IdBANoiT` = pk_ba.`IdBANoiT` left join chuan_doan_vs_benh_an_noi_tru as cd_ba on cd_ba.`IdBANoiT` = ba.`IdBANoiT` left join danh_muc_benh as dmb on dmb.`IdBenh` = cd_ba.`IdBenh` left join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdBenh` = dmb.`IdBenh` left join khoa as k on k.`IdKhoa` = dmb_k.`IdKhoa` where ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba 
        ) as  BANOI
        )
        ) as RS GROUP BY ".$rs_g;
        }
        else{
            return "select ".$pa." sum(RS.KhamBHYT = 0) as SLBH, sum(RS.KhamBHYT = 1) as SLTP, sum(RS.ba = 0) as SLNGOAI, sum(RS.ba=1) as SLNOI from (
        (
        select distinct BANGOAI.* from
        (
        select  ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 0 end as ba from khoa as k right join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdKhoa` = k.`IdKhoa` right join danh_muc_benh as dmb on dmb.`IdBenh` = dmb_k.`IdBenh` right join chuan_doan_vs_benh_an_ngoai_tru as cd_ba on cd_ba.`IdBenh` = dmb.`IdBenh` right join benh_an_ngoai_tru as ba on ba.`IdBANgoaiT` = cd_ba.`IdBANgoaiT` right join phieu_dk_kham_vs_benh_an_ngoai_tru as pk_ba on pk_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` right join phieu_dk_kham as pdk on pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB` right join benh_nhan as bn on pdk.`IdBN` = bn.`IdBN` right join phuong_xa as px on px.`IdXa` = bn.`IdXa` right join quan_huyen as qh on qh.`IdHuyen` = px.`IdHuyen` right join tinh_tp as tp on tp.`IdTinh` = qh.`IdTinh` where ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba

        union all

        select  ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 0 end as ba from tinh_tp as tp left join quan_huyen as qh on qh.`IdTinh` = tp.`IdTinh` left join phuong_xa as px on px.`IdHuyen` = qh.`IdHuyen` left join benh_nhan as bn on bn.`IdXa` = px.`IdXa` left join phieu_dk_kham as pdk on pdk.`IdBN` = bn.`IdBN` left join phieu_dk_kham_vs_benh_an_ngoai_tru as pk_ba on pk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` left join benh_an_ngoai_tru as ba on ba.`IdBANgoaiT` = pk_ba.`IdBANgoaiT` left join chuan_doan_vs_benh_an_ngoai_tru as cd_ba on cd_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` left join danh_muc_benh as dmb on dmb.`IdBenh` = cd_ba.`IdBenh` left join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdBenh` = dmb.`IdBenh` left join khoa as k on k.`IdKhoa` = dmb_k.`IdKhoa` where ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba 
        ) as  BANGOAI
        )

        union all

        (
        select distinct  BANOI.* from
        (
        select ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 1 end as ba from khoa as k right join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdKhoa` = k.`IdKhoa` right join danh_muc_benh as dmb on dmb.`IdBenh` = dmb_k.`IdBenh` right join chuan_doan_vs_benh_an_noi_tru as cd_ba on cd_ba.`IdBenh` = dmb.`IdBenh` right join benh_an_noi_tru as ba on ba.`IdBANoiT` = cd_ba.`IdBANoiT` right join phieu_dk_kham_vs_benh_an_noi_tru as pk_ba on pk_ba.`IdBANoiT` = ba.`IdBANoiT` right join phieu_dk_kham as pdk on pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB` right join benh_nhan as bn on pdk.`IdBN` = bn.`IdBN` right join phuong_xa as px on px.`IdXa` = bn.`IdXa` right join quan_huyen as qh on qh.`IdHuyen` = px.`IdHuyen` right join tinh_tp as tp on tp.`IdTinh` = qh.`IdTinh` where ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba

        union all

        select ".$pa_s." pdk.`KhamBHYT`, case when 1=1 then 1 end as ba from tinh_tp as tp left join quan_huyen as qh on qh.`IdTinh` = tp.`IdTinh` left join phuong_xa as px on px.`IdHuyen` = qh.`IdHuyen` left join benh_nhan as bn on bn.`IdXa` = px.`IdXa` left join phieu_dk_kham as pdk on pdk.`IdBN` = bn.`IdBN` left join phieu_dk_kham_vs_benh_an_noi_tru as pk_ba on pk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB` left join benh_an_noi_tru as ba on ba.`IdBANoiT` = pk_ba.`IdBANoiT` left join chuan_doan_vs_benh_an_noi_tru as cd_ba on cd_ba.`IdBANoiT` = ba.`IdBANoiT` left join danh_muc_benh as dmb on dmb.`IdBenh` = cd_ba.`IdBenh` left join danh_muc_benh_vs_khoa as dmb_k on dmb_k.`IdBenh` = dmb.`IdBenh` left join khoa as k on k.`IdKhoa` = dmb_k.`IdKhoa` where ".$cod." ".$param." group by ".$pa_s." pdk.`KhamBHYT`, ba 
        ) as  BANOI
        )
        ) as RS GROUP BY ".$rs_g;
        }
    }
    
    public static function getsql_cls($param, $cls){
        return "select RS.IdKhoa, count(RS.IdKhoa) as SLT, sum(RS.KhamBHYT = 0) as SLBH, sum(RS.KhamBHYT = 1) as SLTP, sum(RS.ba = 0) as SLNGOAI, sum(RS.ba=1) as SLNOI from (
select distinct  BA.* from
        (
        select  pb.`IdKhoa`, cd_cls.`IdCLS`, cls.`IdDMCLS`, pdk.`KhamBHYT`, case when 1=1 then 0 end as ba, cd_cls.`created_at` from 
khoa as k 
right join danh_muc_cls_vs_khoa as cls_k on cls_k.`IdKhoa` = k.`IdKhoa` 
right join danh_muc_cls as cls on cls.`IdDMCLS` = cls_k.`IdDMCLS` 
right join can_lam_sang as cd_cls on cd_cls.`IdDMCLS` = cls.`IdDMCLS` 
right join benh_an_ngoai_tru_vs_can_lam_sang as ba_cls on ba_cls.`IdCLS` = cd_cls.`IdCLS` 
right join benh_an_ngoai_tru as ba on ba.`IdBANgoaiT` = ba_cls.`IdBANgoaiT` 
right join phieu_dk_kham_vs_benh_an_ngoai_tru as pk_ba on pk_ba.`IdBANgoaiT` = ba.`IdBANgoaiT` 
right join phieu_dk_kham as pdk on pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB`
right join phong_ban as pb on pb.`IdPB` = pdk.`IdPK` 

        union all

        select  pb.`IdKhoa`, cd_cls.`IdCLS`, cls.`IdDMCLS`, pdk.`KhamBHYT`, case when 1=1 then 0 end as ba, cd_cls.`created_at` from 
phong_ban as pb
left join phieu_dk_kham as pdk on pdk.`IdPK` = pb.`IdPB`
left join phieu_dk_kham_vs_benh_an_ngoai_tru as pk_ba on pk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB`
left join benh_an_ngoai_tru as ba on ba.`IdBANgoaiT` = pk_ba.`IdBANgoaiT` 
left join benh_an_ngoai_tru_vs_can_lam_sang as ba_cls on ba_cls.`IdBANgoaiT` = ba.`IdBANgoaiT` 
left join can_lam_sang as cd_cls on cd_cls.`IdCLS` = ba_cls.`IdCLS` 
left join danh_muc_cls as cls on cls.`IdDMCLS` = cd_cls.`IdDMCLS`
left join danh_muc_cls_vs_khoa as cls_k on cls_k.`IdDMCLS` = cls.`IdDMCLS` 
left join khoa as k on k.`IdKhoa` = cls_k.`IdKhoa` ) as  BA
where (BA.`IdDMCLS` = N'".$cls."' COLLATE utf8_unicode_ci) AND ".$param." group by  BA.`IdKhoa`, BA.`IdCLS`, BA.`IdDMCLS`, BA.`KhamBHYT`, BA.`ba`, BA.`created_at`

union all

select distinct  BA.* from
        (
        select  pb.`IdKhoa`, cd_cls.`IdCLS`, cls.`IdDMCLS`, pdk.`KhamBHYT`, case when 1=1 then 1 end as ba, cd_cls.`created_at` from 
khoa as k 
right join danh_muc_cls_vs_khoa as cls_k on cls_k.`IdKhoa` = k.`IdKhoa` 
right join danh_muc_cls as cls on cls.`IdDMCLS` = cls_k.`IdDMCLS` 
right join can_lam_sang as cd_cls on cd_cls.`IdDMCLS` = cls.`IdDMCLS` 
right join benh_an_noi_tru_ct_vs_can_lam_sang as ba_cls on ba_cls.`IdCLS` = cd_cls.`IdCLS` 
right join benh_an_noi_tru_ct as bact on bact.`IdBACT` = ba_cls.`IdBACT`
right join benh_an_noi_tru as ba on ba.`IdBANoiT` = bact.`IdBANoiT` 
right join phieu_dk_kham_vs_benh_an_noi_tru as pk_ba on pk_ba.`IdBANoiT` = ba.`IdBANoiT` 
right join phieu_dk_kham as pdk on pdk.`IdPhieuDKKB` = pk_ba.`IdPhieuDKKB`
right join phong_ban as pb on pb.`IdPB` = pdk.`IdPK` 

        union all

        select  pb.`IdKhoa`, cd_cls.`IdCLS`, cls.`IdDMCLS`, pdk.`KhamBHYT`, case when 1=1 then 1 end as ba, cd_cls.`created_at` from 
phong_ban as pb
left join phieu_dk_kham as pdk on pdk.`IdPK` = pb.`IdPB`
left join phieu_dk_kham_vs_benh_an_noi_tru as pk_ba on pk_ba.`IdPhieuDKKB` = pdk.`IdPhieuDKKB`
left join benh_an_noi_tru as ba on ba.`IdBANoiT` = pk_ba.`IdBANoiT` 
left join benh_an_noi_tru_ct as bact on bact.`IdBANoiT` = ba.`IdBANoiT`
left join benh_an_noi_tru_ct_vs_can_lam_sang as ba_cls on ba_cls.`IdBACT` = bact.`IdBACT` 
left join can_lam_sang as cd_cls on cd_cls.`IdCLS` = ba_cls.`IdCLS` 
left join danh_muc_cls as cls on cls.`IdDMCLS` = cd_cls.`IdDMCLS`
left join danh_muc_cls_vs_khoa as cls_k on cls_k.`IdDMCLS` = cls.`IdDMCLS` 
left join khoa as k on k.`IdKhoa` = cls_k.`IdKhoa` ) as  BA
where (BA.`IdDMCLS` = N'".$cls."' COLLATE utf8_unicode_ci) AND ".$param." group by  BA.`IdKhoa`, BA.`IdCLS`, BA.`IdDMCLS`, BA.`KhamBHYT`, BA.`ba`, BA.`created_at`
) AS RS GROUP BY RS.`IdKhoa`";
    }

    public function postThemTKDT(Request $request){
        
        $user= User::where('id', auth()->user()->id)->get()->first();
        $tennv=$user->nhanVien->TenNV;
        try{
            $sql="";
            $arr=array();$result_arr="";$result_arr_print = array(); $slbg=0;
            $ngaybd="";$ngaykt="";$sql_af="";$slt=0;$slbh=0; $sltp=0; $slnoi=0; $slngoai=0; 
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
                ((DAYOFMONTH(ba.created_at) >= ".$ngaybd->format('d')." AND MONTH(ba.created_at) >= ".$ngaybd->format('m')." AND YEAR(ba.created_at) >= ".$ngaybd->format('Y').")
                 AND 
                (DAYOFMONTH(ba.created_at) <=  ".$ngaykt->format('d')." AND MONTH(ba.created_at) <= ".$ngaykt->format('m')." AND YEAR(ba.created_at)<= ".$ngaykt->format('Y')."))";
            }
            else if($request->tgt == 'ngay'){
                $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgty);
                $sql_af="
                (DAYOFMONTH(ba.created_at) = ".$ngaybd->format('d')." AND MONTH(ba.created_at) = ".$ngaybd->format('m')." AND YEAR(ba.created_at) = ".$ngaybd->format('Y').")";

            }
            else if($request->tgt == 'thang'){
                $ngaybd = \DateTime::createFromFormat("m/Y", $request->tgty);
                $sql_af="
                (MONTH(ba.created_at) = ".$ngaybd->format('m')." AND YEAR(ba.created_at) = ".$ngaybd->format('Y').")";
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
                (YEAR(ba.created_at) = ".$ngaybd->format('Y').")";
            }
            $flag_tkdp='tinh';
            if($request->pl =='tkdp'){
                switch($arr){
                    case ['notall', 'notall', 'notall']:
                        $flag_tkdp='xa';
                        $sql= thongKeController::getsql_benh($sql_af." AND px.`IdXa` = '".$request->xa."'", NULL, 'xa', 'tkdp');
                        break;

                    case ['notall','notall', 'all']:
                        $flag_tkdp='xa';
                        $sql= thongKeController::getsql_benh($sql_af." AND qh.`IdHuyen` = N'".$request->huyen."'", NULL, 'xa', 'tkdp');
                        break;

                    default:
                        $flag_tkdp='huyen';
                        $sql= thongKeController::getsql_benh($sql_af." AND tp.`IdTinh` = N'".$request->tinh."'", NULL, 'huyen', 'tkdp');
                        break;
                }
            }
            else{
                switch($arr){
                    case ['notall', 'notall', 'notall']:
                        $flag_tkdp='xa';
                        $sql= thongKeController::getsql_benh($sql_af." AND px.`IdXa` = '".$request->xa."'", $request->benh, 'xa', 'tkb');
                        break;

                    case ['notall','notall', 'all']:
                        $flag_tkdp='xa';
                        $sql= thongKeController::getsql_benh($sql_af." AND qh.`IdHuyen` = N'".$request->huyen."'", $request->benh, 'xa', 'tkb');
                        break;

                    case ['notall', 'all', 'all']:
                        $flag_tkdp='huyen';
                        $sql= thongKeController::getsql_benh($sql_af." AND tp.`IdTinh` = N'".$request->tinh."'", $request->benh, 'huyen', 'tkb');
                        break;

                    default:
                        $sql= thongKeController::getsql_benh($sql_af, $request->benh, 'tinh', 'tkb');
                        break;
                }
            }
            $result_qr= DB::select($sql);
            if(!empty($result_qr)){
                foreach ($result_qr as $re_qr){
                    $result_arr.="<tr class='tr-shadow'>";
                    if($request->pl == 'tkb'){
                        if($flag_tkdp == 'xa'){
                            $px= phuong_xa::where('IdXa', $re_qr->IdXa)->get()->first();
                            $result_arr.="<td style='vertical-align: middle' class='text-left'>".$px->TenXa." - ".$px->quanHuyen->TenHuyen." - ".$px->quanHuyen->tinhTP->TenTinh."</td>";
                        }
                        else if($flag_tkdp == 'huyen'){
                            $qh= quan_huyen::where('IdHuyen', $re_qr->IdHuyen)->get()->first();
                            $result_arr.="<td style='vertical-align: middle' class='text-left'>".$qh->TenHuyen." - ".$qh->tinhTP->TenTinh."</td>";
                        }
                        else{
                            $tp= tinh_tp::where('IdTinh', $re_qr->IdTinh)->get()->first();
                            $result_arr.="<td style='vertical-align: middle' class='text-left'>".$tp->TenTinh."</td>";
                        }
                    }
                    else{
                        $dmb= danh_muc_benh::where('IdBenh', $re_qr->IdBenh)->get()->first();
                        $result_arr.="<td style='vertical-align: middle' class='text-left'>".$dmb->TenBenh." (".$dmb->IdBenh.")</td>";
                    }    
                        $result_arr.="<td>".$re_qr->SLT."</td>
                        <td>".$re_qr->SLBH."</td>
                        <td>".$re_qr->SLTP."</td>
                        <td>".$re_qr->SLNOI."</td>
                        <td>".$re_qr->SLNGOAI."</td>
                    </tr>
                    <tr class='spacer'></tr>";

                    $slbg=$slbg+1;
                    $result="<tr class='text-center'>
                    <td>".$slbg."</td>";
                    if($request->pl == 'tkb'){
                        if($flag_tkdp == 'xa'){
                            $px= phuong_xa::where('IdXa', $re_qr->IdXa)->get()->first();
                            $result.="<td style='vertical-align: middle' class='text-left'>".$px->TenXa." - ".$px->quanHuyen->TenHuyen." - ".$px->quanHuyen->tinhTP->TenTinh."</td>";
                        }
                        else if($flag_tkdp == 'huyen'){
                            $qh= quan_huyen::where('IdHuyen', $re_qr->IdHuyen)->get()->first();
                            $result.="<td style='vertical-align: middle' class='text-left'>".$qh->TenHuyen." - ".$qh->tinhTP->TenTinh."</td>";
                        }
                        else{
                            $tp= tinh_tp::where('IdTinh', $re_qr->IdTinh)->get()->first();
                            $result.="<td style='vertical-align: middle' class='text-left'>".$tp->TenTinh."</td>";
                        }
                    }
                    else{
                        $dmb= danh_muc_benh::where('IdBenh', $re_qr->IdBenh)->get()->first();
                        
                        $result.="<td style='vertical-align: middle' class='text-left'>".$dmb->TenBenh." (".$dmb->IdBenh.")</td>";
                    }
                    $result.="<td>".$re_qr->SLT."</td>
                    <td>".$re_qr->SLBH."</td>
                    <td>".$re_qr->SLTP."</td>
                    <td>".$re_qr->SLNOI."</td>
                    <td>".$re_qr->SLNGOAI."</td>
                    </tr>";
                    $result_arr_print[]=$result;

                    $slt+=$re_qr->SLT; $slbh+=$re_qr->SLBH; $sltp+=$re_qr->SLTP; $slnoi+=$re_qr->SLNOI; $slngoai+=$re_qr->SLNGOAI;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'result'=>$result_arr,
                'result_print'=>$result_arr_print,
                'slt'=>$slt,
                'slbh'=>$slbh,
                'sltp'=>$sltp,
                'slngoai'=>$slngoai,
                'slnoi'=>$slnoi,
                'slbg'=>$slbg,
                'tennv'=>$tennv
            );

            return response()->json($response); 
        }
        catch (QueryException $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
    
    public function postThemTKCLS(Request $request){
        try{
            $user= User::where('id', auth()->user()->id)->get()->first();
            $tennv=$user->nhanVien->TenNV;
            $result_qr="";$result_arr="";$result_arr_print = array(); $slbg=0;
            $ngaybd="";$ngaykt="";$sql_af="";$slt=0;$slbh=0; $sltp=0; $slnoi=0; $slngoai=0; 
            
            if($request->tgt == 'tuyytg'){
                $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgbd);
                $ngaykt= \DateTime::createFromFormat("d/m/Y", $request->tgkt);
                $sql_af="
                ((DAYOFMONTH(BA.created_at) >= ".$ngaybd->format('d')." AND MONTH(BA.created_at) >= ".$ngaybd->format('m')." AND YEAR(ba.created_at) >= ".$ngaybd->format('Y').")
                 AND 
                (DAYOFMONTH(BA.created_at) <=  ".$ngaykt->format('d')." AND MONTH(BA.created_at) <= ".$ngaykt->format('m')." AND YEAR(BA.created_at)<= ".$ngaykt->format('Y')."))";
            }
            else if($request->tgt == 'ngay'){
                $ngaybd = \DateTime::createFromFormat("d/m/Y", $request->tgty);
                $sql_af="
                (DAYOFMONTH(BA.created_at) = ".$ngaybd->format('d')." AND MONTH(BA.created_at) = ".$ngaybd->format('m')." AND YEAR(BA.created_at) = ".$ngaybd->format('Y').")";

            }
            else if($request->tgt == 'thang'){
                $ngaybd = \DateTime::createFromFormat("m/Y", $request->tgty);
                $sql_af="
                (MONTH(BA.created_at) = ".$ngaybd->format('m')." AND YEAR(BA.created_at) = ".$ngaybd->format('Y').")";
            }
            else if($request->tgt == 'quy'){
                $ngaybd = \DateTime::createFromFormat("Y", $request->tgty);
                
                if($request->quy == 1){
                    $sql_af="
                ((MONTH(BA.created_at) >= 01 AND YEAR(BA.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(BA.created_at) <= 03 AND YEAR(BA.created_at)<= ".$ngaybd->format('Y')."))";
                }
                else if($request->quy == 2){
                    $sql_af="
                ((MONTH(BA.created_at) >= 04 AND YEAR(BA.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(BA.created_at) <= 06 AND YEAR(BA.created_at)<= ".$ngaybd->format('Y')."))";
                }
                else if($request->quy == 3){
                    $sql_af="
                ((MONTH(BA.created_at) >= 07 AND YEAR(BA.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(BA.created_at) <= 09 AND YEAR(BA.created_at)<= ".$ngaybd->format('Y')."))";
                }
                else{
                    $sql_af="
                ((MONTH(BA.created_at) >= 10 AND YEAR(BA.created_at) >= ".$ngaybd->format('Y').") 
                    AND 
                (MONTH(BA.created_at) <= 12 AND YEAR(BA.created_at)<= ".$ngaybd->format('Y')."))";
                }
            }
            else{
                $ngaybd = \DateTime::createFromFormat("Y", $request->tgty);
                $sql_af="
                (YEAR(BA.created_at) = ".$ngaybd->format('Y').")";
            }
            if($request->khoa !='all'){
                $sql_af.=" AND (BA.`IdKhoa` = N'".$request->khoa."' COLLATE utf8_unicode_ci) ";
            }
            
            $sql= thongKeController::getsql_cls($sql_af, $request->cls);
            $result_qr= DB::select($sql);
            $slbg=0;
            if(!empty($result_qr)){
                foreach ($result_qr as $re_qr){
                    $khoa=khoa::where('IdKhoa', $re_qr->IdKhoa)->get()->first();
                    $tenkhoa='NULL';
                    if(is_object($khoa)){
                        $tenkhoa=$khoa->TenKhoa;
                    }
                    $result_arr.="<tr class='tr-shadow'>";
                    $result_arr.="<td style='vertical-align: middle' class='text-left'>".$tenkhoa."</td>";
                    $result_arr.="<td>".$re_qr->SLT."</td>
                    <td>".$re_qr->SLBH."</td>
                    <td>".$re_qr->SLTP."</td>
                    <td>".$re_qr->SLNOI."</td>
                    <td>".$re_qr->SLNGOAI."</td>
                    </tr>
                    <tr class='spacer'></tr>";

                    $slbg=$slbg+1;
                    $result="<tr class='text-center'>
                            <td>".$slbg."</td>";
                    $result.="<td style='vertical-align: middle' class='text-left'>".$tenkhoa."</td>";
                    $result.="<td>".$re_qr->SLT."</td>
                    <td>".$re_qr->SLBH."</td>
                    <td>".$re_qr->SLTP."</td>
                    <td>".$re_qr->SLNOI."</td>
                    <td>".$re_qr->SLNGOAI."</td>
                    </tr>";
                    $result_arr_print[]=$result;

                    $slt+=$re_qr->SLT; $slbh+=$re_qr->SLBH; $sltp+=$re_qr->SLTP; $slnoi+=$re_qr->SLNOI; $slngoai+=$re_qr->SLNGOAI;
                }
            }
            
            $response = array(
                'msg' => 'tc',
                'result'=>$result_arr,
                'result_print'=>$result_arr_print,
                'slt'=>$slt,
                'slbh'=>$slbh,
                'sltp'=>$sltp,
                'slngoai'=>$slngoai,
                'slnoi'=>$slnoi,
                'slbg'=>$slbg,
                'tennv'=>$tennv
            );

            return response()->json($response); 
        }
        catch (QueryException $ex) {
            $err=$ex->getMessage();
            $response = array(
                'msg' => $err
            );
            return response()->json($response); 
        }
    }
}
