<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class can_lam_sang extends Model
{
    //
    
    protected $table="can_lam_sang";
    protected $primaryKey = 'IdCLS';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNgoaiTru(){
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru_vs_can_lam_sang", "IdCLS", "IdCLS");
    }
    
    public function benhAnNoiTruCT(){
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru_ct_vs_can_lam_sang", "IdCLS", "IdCLS");
    }
    
    public function danhMucCLS(){
        return $this->belongsTo("App\\Models\\HanhChinh\\danh_muc_cls", "IdDMCLS", "IdDMCLS");
    }
    
    public function phongBan(){
        return $this->belongsTo("App\\Models\\HanhChinh\\phong_ban", "IdPB", "IdPB");
    }
    
    public function tamUng(){
        return $this->hasOne("App\\Models\\KeToan\\tam_ung_cls", "IdCLS", "IdCLS");
    }
    
    public function ketQuaCLS(){
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\ket_qua_cls", "IdCLS", "IdCLS");
    }
}
