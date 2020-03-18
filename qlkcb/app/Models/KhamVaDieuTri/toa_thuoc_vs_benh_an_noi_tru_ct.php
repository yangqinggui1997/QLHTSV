<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class toa_thuoc_vs_benh_an_noi_tru_ct extends Model
{
    //
    protected $table="toa_thuoc_vs_benh_an_noi_tru_ct";
    protected $primaryKey = ['IdTT', 'IdBACT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function toaThuoc(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\toa_thuoc", "IdTT", "IdTT");
    }

    public function benhAnNoiTruCT(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru_ct", "IdBACT", "IdBACT");
    }
}
