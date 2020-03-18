<?php

namespace App\Models\TiepDon;

use Illuminate\Database\Eloquent\Model;

class benh_nhan extends Model
{
    //
    
    protected $table="benh_nhan";
    protected $primaryKey = 'IdBN';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phieuDkKham(){
        return $this->hasMany("App\\Models\\TiepDon\\phieu_dk_kham","IdBN","IdBN");
    }
    
    public function theBHYT(){
        return $this->hasOne("App\\Models\\TiepDon\\the_bhyt", "IdBN", "IdBN");
    }
    
    public function phuongXa(){
        return $this->belongsTo("App\\Models\\HanhChinh\\phuong_xa", "IdXa", "IdXa");
    }
    
    public function benhAnNgoaiTru(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru", "IdBN", "IdBN");
    }
    
    public function benhAnNoiTru(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru", "IdBN", "IdBN");
    }
}
