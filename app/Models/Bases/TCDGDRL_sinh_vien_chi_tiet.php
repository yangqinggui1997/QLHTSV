<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class TCDGDRL_sinh_vien_chi_tiet extends Model
{
    protected $table = "tcdgdrl_sinh_vien_chi_tiet";
    protected $primaryKey = "idTCDGCT";
    protected $keyType = 'string';

    public function tieuChiDanhGiaDiemRenLuyen()
    {
        return $this->belongsTo("App\\Models\\Bases\\tieu_chi_danh_gia_diem_ren_luyen", "idTCDG", "idTCDG");
    }

    public function phieuDanhGiaDiemRenLuyenChiTiet()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_danh_gia_drlct", "idTCDGCT", "idTCDGCT");
    }
}
