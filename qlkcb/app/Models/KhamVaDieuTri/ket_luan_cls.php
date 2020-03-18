<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class ket_luan_cls extends Model
{
    //
    
    protected $table="ket_luan_cls";
    protected $primaryKey = 'IdKLCLS';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function ketQuaCLS(){
        return $this->belongsTo('App\\Models\\KhamVaDieuTri\\ket_qua_cls', 'IdKQCLS', 'IdKQCLS');
    }
}
