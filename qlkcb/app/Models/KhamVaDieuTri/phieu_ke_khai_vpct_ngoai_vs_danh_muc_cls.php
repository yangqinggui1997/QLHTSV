<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls extends Model
{
    //
    protected $table="phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls";
    protected $primaryKey = ['IdPKKCT', 'IdDMCLS'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phieuKeKhaiVPNgoaiTruCT(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_ngoai_tru", "IdPKKCT", "IdPKKCT");
    }

    public function danhMucCLS(){
        return $this->belongsTo("App\\Models\\HanhChinh\\danh_muc_cls", "IdDMCLS", "IdDMCLS");
    }
}
