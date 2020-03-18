<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class TCDGDRL_sinh_vien_CTCCT extends Model
{
    protected $table = "tcdgdrl_sinh_vien_ctcct";
    protected $primaryKey = "idTCDGCTCCT";
    protected $keyType = 'string';

    public function tieuChiDanhGiaDiemRenLuyenChiTiet()
    {
        return $this->belongsTo("App\\Models\\Bases\\tcdgdrl_sinh_vien_chi_tiet", "idTCDGCT", "idTCDGCT");
    }

    public function phieuDanhGiaDiemRenLuyenChiTietCuaChiTiet()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_danh_gia_drlctcct", "idTCDGCTCCT", "idTCDGCTCCT");
    }
}
