<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class chuan_doan_vs_benh_an_noi_tru extends Model
{
    //
    protected $table="chuan_doan_vs_benh_an_noi_tru";
    protected $primaryKey = ['IdBenh', 'IdBANoiT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function danhMucBenh(){
        return $this->belongsTo("App\\Models\\HanhChinh\\danh_muc_benh", "IdBenh", "IdBenh");
    }

    public function benhAnNoiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru", "IdBANoiT", "IdBANoiT");
    }
}
