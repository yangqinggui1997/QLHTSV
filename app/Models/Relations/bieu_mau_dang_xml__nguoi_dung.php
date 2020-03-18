<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class bieu_mau_dang_xml__nguoi_dung extends Model
{
    protected $table = "bieu_mau_dang_xml__nguoi_dung";
    protected $primaryKey = "idBM";
    public $incrementing = false;

    public function bieuMauDangXML()
    {
        return $this->belongsTo("App\\Models\\Bases\\bieu_mau_dang_xml", "idBM", "idBM");
    }

    public function nguoiDung()
    {
        return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }
}
