<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class phieu_ke_khai_vp_noi_tru extends Model
{
    //
    protected $table="phieu_ke_khai_vp_noi_tru";
    protected $primaryKey = 'IdBANoiT';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phieuKKVPCT(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_noi_tru", "IdPKK", "IdPKK");
    }
    
    public function benhAnNoiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru", "IdBANoiT", "IdBANoiT");
    }
}
