<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class anh_cls extends Model
{
    //
    protected $table="anh_cls";
    protected $primaryKey = 'IdACLS';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function ketQuaCanLamSang(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\ket_qua_cls", "IdKQCLS", "IdKQCLS");
    }

}
