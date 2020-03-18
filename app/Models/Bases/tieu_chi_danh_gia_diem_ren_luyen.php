<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class tieu_chi_danh_gia_diem_ren_luyen extends Model
{
    protected $table = "tieu_chi_danh_gia_diem_ren_luyen";
    protected $primaryKey = "idTCDG";
    protected $keyType = "string";

    public function phieuDanhGiaDiemRenLuyen()
    {
    	return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_danh_gia_diem_ren_luyen", "idTCDG", "idTCDG");
    }

    public function tieuChiDanhGiaDiemRenLuyenSinhVienChiTiet()
    {
    	return $this->hasMany("App\\Models\\Bases\\tcdgdrl_sinh_vien_chi_tiet", "idTCDG", "idTCDG");
    }
}
