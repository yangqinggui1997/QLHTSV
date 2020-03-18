<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class toa_thuoc_ct extends Model
{
    //
    
    protected $table="toa_thuoc_ct";
    protected $primaryKey = ['IdThuoc', 'IdTT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function toaThuoc(){
        return $this->belongsTo('App\\Models\\KhamVaDieuTri\\toa_thuoc', 'IdTT', 'IdTT');
    }
    
    public function danhMucThuoc(){
        return $this->belongsTo('App\\Models\\HanhChinh\\danh_muc_thuoc', 'IdThuoc', 'IdThuoc');
    }
}
