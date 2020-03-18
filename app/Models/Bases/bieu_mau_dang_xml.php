<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class bieu_mau_dang_xml extends Model
{
    protected $table = "bieu_mau_dang_xml";
    protected $primaryKey = "idBM";

    public function nguoiDung()
    {
        return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }

    public function bieuMauDangXmlNguoiDung()
    {
        return $this->hasMany("App\\Models\\Relations\\bieu_mau_dang_xml__nguoi_dung", "idBM", "idBM");
    }

    public function thongBaoBieuMauDangXML()
    {
        return $this->hasMany("App\\Models\\Relations\\thong_bao__bieu_mau_dang_xml", "idBM", "idBM");
    }
}
