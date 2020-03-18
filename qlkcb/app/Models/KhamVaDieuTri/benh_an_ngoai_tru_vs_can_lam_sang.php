<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class benh_an_ngoai_tru_vs_can_lam_sang extends Model
{
    //
    protected $table="benh_an_ngoai_tru_vs_can_lam_sang";
    protected $primaryKey = ['IdCLS', 'IdBANgoaiT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNgoaiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru", "IdBANgoaiT", "IdBANgoaiT");
    }

    public function canLamSang(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\can_lam_sang", "IdCLS", "IdCLS");
    }
}
