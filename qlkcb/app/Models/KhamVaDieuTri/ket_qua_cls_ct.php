<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class ket_qua_cls_ct extends Model
{
    //
    
    protected $table="ket_qua_cls_ct";
    protected $primaryKey = 'IdKQCLSCT';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function ketQuaCLS(){
        return $this->belongsTo('App\\Models\\KhamVaDieuTri\\ket_qua_cls', 'IdKQCLS', 'IdKQCLS');
    }
}
