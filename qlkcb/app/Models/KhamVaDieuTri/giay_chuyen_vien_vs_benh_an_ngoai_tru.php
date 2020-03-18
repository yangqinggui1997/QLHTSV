<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class giay_chuyen_vien_vs_benh_an_ngoai_tru extends Model
{
    //
    protected $table="giay_chuyen_vien_vs_benh_an_ngoai_tru";
    protected $primaryKey = 'IdGCVNgoai';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNgoaiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru", "IdBANgoaiT", "IdBANgoaiT");
    }

}
