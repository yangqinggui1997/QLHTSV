<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class ket_qua_cls extends Model
{
    //
    
    protected $table="ket_qua_cls";
    protected $primaryKey = 'IdKQCLS';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function ketQuaCLSCT(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\ket_qua_cls_ct', 'IdKQCLS', 'IdKQCLS');
    }
    
    public function ketLuanCLS(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\ket_luan_cls', 'IdKQCLS', 'IdKQCLS');
    }
    
    public function anhCLS(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\anh_cls', 'IdKQCLS', 'IdKQCLS');
    }
    
    public function canLamSang(){
        return $this->belongsTo('App\\Models\\KhamVaDieuTri\\can_lam_sang', 'IdCLS', 'IdCLS');
    }
    
    public function nhanVien(){
        return $this->belongsTo('App\\Models\\HanhChinh\\nhan_vien', 'IdNVTH', 'IdNV');
    }
}
