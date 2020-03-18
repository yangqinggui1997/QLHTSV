<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class chuan_doan_vs_ket_qua_cls extends Model
{
    //
    protected $table="chuan_doan_vs_ket_qua_cls";
    protected $primaryKey = ['IdCLS', 'IdKQCLS'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function ketQuaCLS(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\ket_qua_cls", "IdKQCLS", "IdKQCLS");
    }

    public function danhMucBenh(){
        return $this->belongsTo("App\\Models\\HanhChinh\\danh_muc_benh", "IdBenh", "IdBenh");
    }

}
