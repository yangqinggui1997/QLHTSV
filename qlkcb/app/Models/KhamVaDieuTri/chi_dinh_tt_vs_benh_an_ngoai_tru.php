<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class chi_dinh_tt_vs_benh_an_ngoai_tru extends Model
{
    //
    protected $table="chi_dinh_tt_vs_benh_an_ngoai_tru";
    protected $primaryKey = ['IdThuThuat', 'IdBANgoaiT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function chiDinhTT(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\chi_dinh_tt", "IdThuThuat", "IdThuThuat");
    }

    public function benhAnNgoaiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru", "IdBANgoaiT", "IdBANgoaiT");
    }
}
