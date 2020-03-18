<?php

namespace App\Models\Users\SinhVien;

use Illuminate\Database\Eloquent\Model;

class phieu_danh_gia_diem_ren_luyen extends Model
{
    protected $table = "phieu_danh_gia_diem_ren_luyen";
    protected $primaryKey = ["idTCDG", "idUser", "idHKSV"];
    protected $keyType = 'string';
    public $incrementing = false;

    public function tieuChiDanhGiaDiemRenLuyen()
    {
        return $this->belongsTo("App\\Models\\Bases\\tieu_chi_danh_gia_diem_ren_luyen", "idTCDG", "idTCDG");
    }

    public function hocKyHocTapSinhVien()
    {
        return $this->belongsTo("App\\Models\\Users\\SinhVien\\hoc_ky_hoc_tap_sinh_vien", ["idUser", "idHKSV"], ["idUser", "idHKSV"]);
    }

    public function phieuDanhGiaDiemRenLuyenChiTiet()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_danh_gia_drlct", ["idTCDG", "idUser", "idHKSV"], ["idTCDG", "idUser", "idHKSV"]);
    }
}
