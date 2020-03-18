<?php

namespace App\Models\Users\SinhVien;

use Illuminate\Database\Eloquent\Model;

class phieu_danh_gia_DRLCTCCT extends Model
{
    protected $table = "phieu_danh_gia_drlctcct";
    protected $primaryKey = ["idTCDG", "idUser", "idHKSV", "idTCDGCT", "idTCDGCTCCT"];
    protected $keyType = 'string';
    public $incrementing = false;

    public function tieuChiDanhGiaDiemRenLuyenChiTietCuaChiTiet()
    {
        return $this->belongsTo("App\\Models\\Bases\\tcdgdrl_sinh_vien_ctcct", "idTCDGCTCCT", "idTCDGCTCCT");
    }

    public function phieuDanhGiaDiemRenLuyenChiTiet()
    {
        return $this->belongsTo("App\\Models\\Users\\SinhVien\\phieu_danh_gia_drlct", ["idTCDG", "idUser", "idHKSV", "idTCDGCT"], ["idTCDG", "idUser", "idHKSV", "idTCDGCT"]);
    }
}
