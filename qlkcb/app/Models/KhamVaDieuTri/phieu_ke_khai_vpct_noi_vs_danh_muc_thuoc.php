<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc extends Model
{
    //
    protected $table="phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc";
    protected $primaryKey = ['IdPKKCT', 'IdThuoc'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phieuKeKhaiVPNoiTruCT(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_noi_tru", "IdPKKCT", "IdPKKCT");
    }

    public function danhMucThuoc(){
        return $this->belongsTo("App\\Models\\HanhChinh\\danh_muc_thuoc", "IdThuoc", "IdThuoc");
    }
}
