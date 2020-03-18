<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class phieu_ke_khai_vp_ngoai_tru extends Model
{
    //
    protected $table="phieu_ke_khai_vp_ngoai_tru";
    protected $primaryKey = 'IdPKK';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phieuKKVPCT(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\phieu_ke_khai_vpct_ngoai_tru", "IdPKK", "IdPKK");
    }
    
    public function benhAnNgoaiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru", "IdBANgoaiT", "IdBANgoaiT");
    }

}
