<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class benh_an_noi_tru_ct extends Model
{
    //
    
    protected $table="benh_an_noi_tru_ct";
    protected $primaryKey = 'IdBACT';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTru(){
        return $this->belongsTo('App\\Models\\KhamVaDieuTri\\benh_an_noi_tru', 'IdBANoiT', 'IdBANoiT');
    }
    
    public function phieuChiDinhPT(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\chi_dinh_pt', 'IdBACT', 'IdBACT');
    }
    
    public function phieuChiDinhTT(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\chi_dinh_tt_vs_benh_an_noi_tru_ct', 'IdBACT', 'IdBACT');
    }
    
    public function toaThuoc(){
        return $this->hasOne('App\\Models\\KhamVaDieuTri\\toa_thuoc_vs_benh_an_noi_tru_ct', 'IdBACT', 'IdBACT');
    }
    
    public function canLamSang(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\benh_an_noi_tru_ct_vs_can_lam_sang', 'IdBACT', 'IdBACT');
    }
}
