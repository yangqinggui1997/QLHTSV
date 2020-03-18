<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class danh_muc_cls extends Model
{
    //
    
    protected $table="danh_muc_cls";
    protected $primaryKey = 'IdDMCLS';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function canLamSang(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\can_lam_sang', 'IdDMCLS', 'IdDMCLS');
    }
    
    public function khoa(){
        return $this->hasMany('App\\Models\\HanhChinh\\danh_muc_cls_vs_khoa', 'IdDMCLS', 'IdDMCLS');
    }
    
    public function phieuKKVPCTNoiTru(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_noi_vs_danh_muc_cls', 'IdDMCLS', 'IdDMCLS');
    }
    
    public function phieuKKVPCTNgoaiTru(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls', 'IdDMCLS', 'IdDMCLS');
    }
    
    public function phieuChiDinhTT(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\chi_dinh_tt', 'IdDMCLS', 'IdDMCLS');
    }
    
    public function phieuChiDinhPT(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\chi_dinh_pt', 'IdDMCLS', 'IdDMCLS');
    }
}
