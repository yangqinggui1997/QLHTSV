<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class giay_chuyen_vien_vs_benh_an_noi_tru extends Model
{
    //
    protected $table="giay_chuyen_vien_vs_benh_an_noi_tru";
    protected $primaryKey = 'IdGCVNoi';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru", "IdBANoiT", "IdBANoiT");
    }

}
