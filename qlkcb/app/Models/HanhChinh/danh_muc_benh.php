<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class danh_muc_benh extends Model
{
    //
    
    protected $table="danh_muc_benh";
    protected $primaryKey = 'IdBenh';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function ketQuaCLS(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\chuan_doan_vs_ket_qua_cls', 'IdBenh', 'IdBenh');
    }
    
    public function benhAnNoiTru(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\chuan_doan_vs_benh_an_noi_tru', 'IdBenh', 'IdBenh');
    }
    
    public function khoa(){
        return $this->hasMany('App\\Models\\HanhChinh\\danh_muc_benh_vs_khoa', 'IdBenh', 'IdBenh');
    }
    
    public function benhAnNgoaiTru(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\chuan_doan_vs_benh_an_ngoai_tru', 'IdBenh', 'IdBenh');
    }
    
    public function benhVSThuoc(){
        return $this->hasMany('App\\Models\\HanhChinh\\danh_muc_benh_vs_thuoc', 'IdBenh', 'IdBenh');
    }
}
