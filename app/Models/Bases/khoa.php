<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class khoa extends Model
{
    protected $table = "khoa";
    protected $primaryKey = "idKhoa";
    protected $keyType = "string";

    public function phongBan()
    {
    	return $this->hasMany("App\\Models\\Bases\\phong_ban", "idKhoa", "idKhoa");
    }

    public function thongBaoKhoa()
    {
    	return $this->hasMany("App\\Models\\Relations\\thong_bao__khoa", "idKhoa", "idKhoa");
    }
}
