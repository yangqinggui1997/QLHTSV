<?php

namespace App\Models\Users\SinhVien;

use Illuminate\Database\Eloquent\Model;

class phieu_dang_ky_hoc_phan extends Model
{
    protected $table = "phieu_dang_ky_hoc_phan";
    protected $primaryKey = ["idHP", "idUser", "idHKSV"];
    protected $keyType = 'string';
    public $incrementing = false;

    public function phieuPhanCongGiangDay()
    {
        return $this->belongsTo("App\\Models\\Users\\CanBo\\phieu_phan_cong_giang_day", ["idHP", "idUser"], ["idHP", "idUser"]);
    }

    public function lop()
    {
        return $this->belongsTo("App\\Models\\Bases\\lop", "idLop", "idLop");
    }

    public function hocKyHocTapSinhVien\\SinhVien()
    {
        return $this->belongsTo("App\\Models\\Users\\SinhVien\\hoc_ky_hoc_tap_sinh_vien", ["idUser", "idHKSV"], ["idUser", "idHKSV"]);
    }

    public function bangDiemDuoi1Tiet()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\bang_diem_duoi_1_tiet", ["idHP", "idUser", "idHKSV"], ["idHP", "idUser", "idHKSV"]);
    }

    public function bangDiemTren1Tiet()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\bang_diem_tu_1_tiet_tro_len", ["idHP", "idUser", "idHKSV"], ["idHP", "idUser", "idHKSV"]);
    }

    public function bangDiemThi()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\bang_diem_thi", ["idHP", "idUser", "idHKSV"], ["idHP", "idUser", "idHKSV"]);
    }

    public function phieuDanhGiaGiangDay()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_danh_gia_giang_day", ["idHP", "idUser", "idHKSV"], ["idHP", "idUser", "idHKSV"]);
    }
}
