<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class khoa extends Model
{
    //
    protected $table="khoa";
    protected $primaryKey = 'IdKhoa';
    public $incrementing = false;
    protected $primaryType = 'string';

    public function phongBan(){
        return $this->hasMany("App\\Models\\HanhChinh\\phong_ban","IdKhoa","IdKhoa");
    }
    
    public function nhanVien(){
        return $this->hasManyThrough("App\\Models\\HanhChinh\\nhan_vien", "App\Models\HanhChinh\phong_ban", "IdKhoa", "IdPB", "IdKhoa", "IdPB");
    }
    
    public function danhMucBenh(){
        return $this->hasMany("App\\Models\\HanhChinh\\danh_muc_benh_vs_khoa","IdKhoa","IdKhoa");
    }
    
    public function danhMucCLS(){
        return $this->hasMany("App\\Models\\HanhChinh\\danh_muc_cls_vs_khoa","IdKhoa","IdKhoa");
    }
    
}
