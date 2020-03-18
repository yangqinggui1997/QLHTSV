<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class benh_an_noi_tru extends Model
{
    
    protected $table="benh_an_noi_tru";
    protected $primaryKey = 'IdBANoiT';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    //belong
    
    public function nhanVien() {
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien", "IdNV", "IdNV");
    }
    
    public function thietBiYT() {
        return $this->belongsTo("App\\Models\\HanhChinh\\thiet_bi_yt", "IdGiuong", "IdTB");
    }
    
    //has
    public function benhAnNoiTruCT() {
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru_ct", "IdBANoiT", "IdBANoiT")->orderBy('created_at', 'DESC');
    }
    
    public function chuanDoan() {
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\chuan_doan_vs_benh_an_noi_tru", "IdBANoiT", "IdBANoiT");
    }
    
    public function benhAnNV(){
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\ba_nv","IdBANoiT","IdBANoiT");
    }
    
    public function giayChuyenVien() {
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\giay_chuyen_vien_vs_benh_an_noi_tru", "IdBANoiT", "IdBANoiT");
    }
    
    public function giayRaVien() {
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\giay_ra_vien", "IdBANoiT", "IdBANoiT");
    }
    
    public function phieuKeKhaiVP() {
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vp_noi_tru", "IdBANoiT", "IdBANoiT");
    }
    
    public function phieuDKKham(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\phieu_dk_kham_vs_benh_an_noi_tru', 'IdBANoiT', 'IdBANoiT');
    }
    
    public function HDDV(){
        return $this->hasOne('App\\Models\\KeToan\\hoa_don_dv_noi_tru', 'IdBANoiT', 'IdBANoiT');
    }
}
