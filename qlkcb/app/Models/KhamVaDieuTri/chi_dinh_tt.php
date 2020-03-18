<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class chi_dinh_tt extends Model
{
    //
    
    protected $table="chi_dinh_tt";
    protected $primaryKey = 'IdThuThuat';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTruCT(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\chi_dinh_tt_vs_benh_an_noi_tru_ct', 'IdThuThuat', 'IdThuThuat');
    }
    
    public function nhanVien(){
        return $this->belongsTo('App\\Models\\HanhChinh\\nhan_vien', 'IdNVTH', 'IdNV');
    }
    
    public function phongBan(){
        return $this->belongsTo('App\\Models\\HanhChinh\\phong_ban', 'IdPB', 'IdPB');
    }
    
    public function danhMucCLS(){
        return $this->belongsTo('App\\Models\\HanhChinh\\danh_muc_cls', 'IdDMCLS', 'IdDMCLS');
    }
    
    public function benhAnNgoaiTru(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\chi_dinh_tt_vs_benh_an_ngoai_tru', 'IdThuThuat', 'IdThuThuat');
    }
    
    public function tamUng(){
        return $this->hasOne('App\\Models\\KeToan\\tam_ung_tt', 'IdThuThuat', 'IdThuThuat');
    }
}
