<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class chuan_doan_vs_benh_an_ngoai_tru extends Model
{
    //
    protected $table="chuan_doan_vs_benh_an_ngoai_tru";
    protected $primaryKey = ['IdBenh','IdBANgoaiT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNgoaiTru(){
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru", "IdBANgoaiT", "IdBANgoaiT");
    }

    public function danhMucBenh(){
        return $this->belongsTo("App\\Models\\HanhChinh\\danh_muc_benh", "IdBenh", "IdBenh");
    }
}
