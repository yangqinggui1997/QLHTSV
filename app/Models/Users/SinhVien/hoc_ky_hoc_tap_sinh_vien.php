<?php

namespace App\Models\Users\SinhVien;

use Illuminate\Database\Eloquent\Model;

class hoc_ky_hoc_tap_sinh_vien extends Model
{
    protected $table = "hoc_ky_hoc_tap_sinh_vien";
    protected $primaryKey = ["idHKSV", "idUser"];
    protected $keyType = 'string';
    public $incrementing = false;

    public function nguoiDung()
    {
        return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }

    public function phieuDanhGiaDiemRenLuyen()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_danh_gia_diem_ren_luyen", ["idHKSV", "idUser"], ["idHKSV", "idUser"]);
    }

    public function phieuDangKyHocPhan()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_dang_ky_hoc_phan", ["idHKSV", "idUser"], ["idHKSV", "idUser"]);
    }

    public function phieuDanhGiaTruong()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_danh_gia_truong", ["idHKSV", "idUser"], ["idHKSV", "idUser"]);
    }
}
