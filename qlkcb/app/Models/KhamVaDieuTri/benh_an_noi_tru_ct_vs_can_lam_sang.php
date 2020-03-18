<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class benh_an_noi_tru_ct_vs_can_lam_sang extends Model
{
    //
    protected $table="benh_an_noi_tru_ct_vs_can_lam_sang";
    protected $primaryKey = ['IdCLS', 'IdBACT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTruCT(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru_ct", "IdBACT", "IdBACT");
    }

    public function canLamSang(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\can_lam_sang", "IdCLS", "IdCLS");
    }
}
