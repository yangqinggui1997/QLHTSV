<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class toa_thuoc_vs_benh_an_ngoai_tru extends Model
{
    //
    protected $table="toa_thuoc_vs_benh_an_ngoai_tru";
    protected $primaryKey = ['IdTT', 'IdBANgoaiT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function toaThuoc(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\toa_thuoc", "IdTT", "IdTT");
    }

    public function benhAnNgoaiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru", "IdBANgoaiT", "IdBANgoaiT");
    }
}
