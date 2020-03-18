<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class quan_huyen extends Model
{
    //
    
    protected $table="quan_huyen";
    protected $primaryKey = 'IdHuyen';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phuongXa() {
        return $this->hasMany("App\\Models\\HanhChinh\\phuong_xa", "IdHuyen", "IdHuyen");
    }
    
    public function tinhTP(){
        return $this->belongsTo("App\\Models\\HanhChinh\\tinh_tp", "IdTinh", "IdTinh");
    }
    
    public function benhNhan() {
        return $this->hasManyThrough("App\\Models\\TiepDon\\benh_nhan", "App\\Models\\HanhChinh\\phuong_xa", "IdHuyen", "IdXa", "IdHuyen", "IdXa");
    }
    
    public function nhanVien(){
        return $this->hasManyThrough("App\\Models\\HanhChinh\\nhan_vien", "App\\Models\\HanhChinh\\phuong_xa", "IdHuyen", "IdXa", "IdHuyen", "IdXa");
    }
}
