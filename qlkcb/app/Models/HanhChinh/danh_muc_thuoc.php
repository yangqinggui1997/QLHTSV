<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class danh_muc_thuoc extends Model
{
    //
    
    protected $table="danh_muc_thuoc";
    protected $primaryKey = 'IdThuoc';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phieuKeKhaiVPCTNoiTru(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc', 'IdThuoc', 'IdThuoc');
    }
    
    public function phieuKeKhaiVPCTNgoaiTru(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc', 'IdThuoc', 'IdThuoc');
    }
    
    public function toaThuocCT(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\toa_thuoc_ct', 'IdThuoc', 'IdThuoc');
    }
    
    public function benhVSThuoc(){
        return $this->hasMany('App\\Models\\HanhChinh\\danh_muc_benh_vs_thuoc', 'IdThuoc', 'IdThuoc');
    }
}
