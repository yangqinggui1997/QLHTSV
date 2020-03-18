<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class phuong_xa extends Model
{
    //
    
    protected $table="phuong_xa";
    protected $primaryKey = 'IdXa';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function quanHuyen() {
        return $this->belongsTo("App\\Models\\HanhChinh\\quan_huyen", "IdHuyen", "IdHuyen");
    }
    
    public function benhNhan(){
        return $this->hasMany("App\\Models\\TiepDon\\benh_nhan", "IdXa", "IdXa");
    }
    
    public function nhanVien(){
        return $this->hasMany("App\\Models\\HanhChinh\\nhan_vien", "IdXa", "IdXa");
    }
    
    public function phieuDkKham(){
        return $this->hasManyThrough("App\\Models\\TiepDon\\phieu_dk_kham", "App\\Models\\HanhChinh\\benh_nhan", "IdXa", "IdBN", "IdXa", "IdBN");
    }
    
    public function theBHYT(){
        return $this->hasManyThrough("App\\Models\\TiepDon\\the_bhyt", "App\Models\\HanhChinh\\benh_nhan", "IdXa", "IdBN", "IdXa", "IdBN");
    }
}
