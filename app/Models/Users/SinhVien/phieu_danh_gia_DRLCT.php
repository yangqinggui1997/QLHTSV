<?php

namespace App\Models\Users\SinhVien;

use Illuminate\Database\Eloquent\Model;

class phieu_danh_gia_DRLCT extends Model
{
    protected $table = "phieu_danh_gia_drlct";
    protected $primaryKey = ["idTCDG", "idUser", "idHKSV", "idTCDGCT"];
    protected $keyType = 'string';
    public $incrementing = false;

    public function tieuChiDanhGiaDiemRenLuyenChiTiet()
    {
        return $this->belongsTo("App\\Models\\Bases\\tcdgdrl_sinh_vien_chi_tiet", "idTCDGCT", "idTCDGCT");
    }

    public function phieuDanhGiaDiemRenLuyen()
    {
        return $this->belongsTo("App\\Models\\Users\\SinhVien\\phieu_danh_gia_diem_ren_luyen", ["idTCDG", "idUser", "idHKSV"], ["idTCDG", "idUser", "idHKSV"]);
    }
}
