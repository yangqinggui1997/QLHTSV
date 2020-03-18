<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class ba_nv extends Model
{
    //
    protected $table="ba_nv";
    protected $primaryKey = ['IdBANoiT', 'IdNV'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function nhanVien(){
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien", "IdNV", "IdNV");
    }

    public function benhAnNoiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru", "IdBANoiT", "IdBANoiT");
    }
}
