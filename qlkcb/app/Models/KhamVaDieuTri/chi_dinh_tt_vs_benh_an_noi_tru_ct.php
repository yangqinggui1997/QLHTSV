<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class chi_dinh_tt_vs_benh_an_noi_tru_ct extends Model
{
    //
    protected $table="chi_dinh_tt_vs_benh_an_noi_tru_ct";
    protected $primaryKey = ['IdThuThuat', 'IdBACT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function chiDinhTT(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\chi_dinh_tt", "IdThuThuat", "IdThuThuat");
    }

    public function benhAnNoiTruCT(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru_ct", "IdBACT", "IdBACT");
    }
}
