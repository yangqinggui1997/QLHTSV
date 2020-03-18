<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class giay_ra_vien extends Model
{
    //
    
    protected $table="giay_ra_vien";
    protected $primaryKey = 'IdGRV';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTru(){
        return $this->belongsTo('App\\Models\\KhamVaDieuTri\\benh_an_noi_tru', 'IdBANoiT', 'IdBANoiT');
    }
}
