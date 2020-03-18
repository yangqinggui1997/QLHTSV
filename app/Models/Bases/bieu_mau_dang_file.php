<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class bieu_mau_dang_file extends Model
{
    protected $table = "bieu_mau_dang_file";
    protected $primaryKey = "idBM";

    public function nguoiDung()
    {
        return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }

    public function thongBaoBieuMauDangFile()
    {
        return $this->hasMany("App\\Models\\Relations\\thong_bao__bieu_mau_dang_file", "idBM", "idBM");
    }
}
