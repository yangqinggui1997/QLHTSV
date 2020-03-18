<?php

namespace App\Models\SinhVien;

use Illuminate\Database\Eloquent\Model;

class phieu_danh_gia_truong extends Model
{
    protected $table = "phieu_danh_gia_truong";
    protected $primaryKey = ["idUser", "idHKSV", "idTCDGT"];
    protected $keyType = 'string';
    public $incrementing = false;

    public function tieuChiDanhGiaTruong()
    {
        return $this->belongsTo("App\\Models\\Bases\\tieu_chi_danh_gia_truong", "idTCDGT", "idTCDGT");
    }

    public function hockyHocTapSV()
    {
        return $this->belongsTo("App\\Models\\Users\\SinhVien\\hoc_ky_hoc_tap_sinh_vien", ["idUser", "idHKSV"], ["idUser", "idHKSV"]);
    }
}
