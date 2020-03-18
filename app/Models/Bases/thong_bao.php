<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class thong_bao extends Model
{
    protected $table = "thong_bao";
    protected $primaryKey = "idTB";

    public function nguoiDung()
    {
        return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }

    public function thongBaoBieuMauDangFile()
    {
        return $this->hasMany("App\\Models\\Relations\\thong_bao__bieu_mau_dang_file", "idTB", "idTB");
    }

    public function thongBaoBieuMauDangXML()
    {
        return $this->hasMany("App\\Models\\Relations\\thong_bao__bieu_mau_dang_xml", "idTB", "idTB");
    }

    public function thongBaoVanBan()
    {
        return $this->hasMany("App\\Models\\Relations\\thong_bao__van_ban", "idTB", "idTB");
    }

    public function thongBaoKhoa()
    {
        return $this->hasMany("App\\Models\\Relations\\thong_bao__khoa", "idTB", "idTB");
    }

    public function thongBaoLop()
    {
        return $this->hasMany("App\\Models\\Relations\\thong_bao__lop", "idTB", "idTB");
    }
}
