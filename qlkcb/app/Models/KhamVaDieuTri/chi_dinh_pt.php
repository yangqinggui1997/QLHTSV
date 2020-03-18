<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class chi_dinh_pt extends Model
{
    //
    
    protected $table="chi_dinh_pt";
    protected $primaryKey = 'IdPT';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTruCT(){
        return $this->belongsTo('App\\Models\\KhamVaDieuTri\\benh_an_noi_tru_ct', 'IdBACT', 'IdBACT');
    }
    
    public function phongBan(){
        return $this->belongsTo('App\\Models\\HanhChinh\\phong_ban', 'IdPB', 'IdPB');
    }
    
    public function nhanVien(){
        return $this->belongsTo('App\\Models\\HanhChinh\\nhan_vien', 'IdNVTH', 'IdNV');
    }
    
    public function danhMucCLS(){
        return $this->belongsTo('App\\Models\\HanhChinh\\danh_muc_cls', 'IdDMCLS', 'IdDMCLS');
    }
    
    public function tamUng(){
        return $this->hasOne('App\\Models\\KeToan\\tam_ung_pt', 'IdPT', 'IdPT');
    }
}
