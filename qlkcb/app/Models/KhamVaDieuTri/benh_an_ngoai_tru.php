<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class benh_an_ngoai_tru extends Model
{
    //
    protected $table="benh_an_ngoai_tru";
    protected $primaryKey = 'IdBANgoaiT';
    public $incrementing = false;
    protected $primaryType = 'string';

    public function nhanVien(){
        return $this->belongsTo('App\\Models\\HanhChinh\\nhan_vien', 'IdNV', 'IdNV');
    }

    public function chiDinhTT(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\chi_dinh_tt_vs_benh_an_ngoai_tru', 'IdBANgoaiT', 'IdBANgoaiT');
    }
    
    public function CanLamSang(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru_vs_can_lam_sang', 'IdBANgoaiT', 'IdBANgoaiT');
    }
    
    public function toaThuoc(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\toa_thuoc_vs_benh_an_ngoai_tru', 'IdBANgoaiT', 'IdBANgoaiT');
    }
    
    public function phieuKKVPNgoaiTru(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vp_ngoai_tru', 'IdBANgoaiT', 'IdBANgoaiT');
    }
    
    public function chuanDoan(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\chuan_doan_vs_benh_an_ngoai_tru', 'IdBANgoaiT', 'IdBANgoaiT');
    }
    
    public function giayChuyenVien(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\giay_chuyen_vien_vs_benh_an_ngoai_tru', 'IdBANgoaiT', 'IdBANgoaiT');
    }
    
    public function phieuDKKham(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\phieu_dk_kham_vs_benh_an_ngoai_tru', 'IdBANgoaiT', 'IdBANgoaiT');
    }
    
    public function HDDV(){
        return $this->hasOne('App\\Models\\KeToan\\hoa_don_dv_ngoai_tru', 'IdBANgoaiT', 'IdBANgoaiT');
    }
}
