<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class toa_thuoc extends Model
{
    //
    
    protected $table="toa_thuoc";
    protected $primaryKey = 'IdTT';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTruCT(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\toa_thuoc_vs_benh_an_noi_tru_ct', 'IdTT', 'IdTT');
    }
    
    public function benhAnNgoaiTru(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\toa_thuoc_vs_benh_an_ngoai_tru', 'IdTT', 'IdTT');
    }
    
    public function toaThuocCT(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\toa_thuoc_ct', 'IdTT', 'IdTT');
    }
}
