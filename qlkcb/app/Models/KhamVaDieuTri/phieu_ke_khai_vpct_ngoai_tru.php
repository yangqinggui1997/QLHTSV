<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class phieu_ke_khai_vpct_ngoai_tru extends Model
{
    //
    protected $table="phieu_ke_khai_vpct_ngoai_tru";
    protected $primaryKey = 'IdPKKCT';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phieuKeKhaiVP(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vp_ngoai_tru", "IdPKK", "IdPKK");
    }

    public function danhMucCLS(){
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls", "IdDMCLS", "IdDMCLS");
    }
    
    public function danhMucThuoc(){
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc", "IdThuoc", "IdThuoc");
    }
}
