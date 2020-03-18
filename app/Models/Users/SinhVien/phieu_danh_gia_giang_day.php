<?php

namespace App\Models\Users\SinhVien;

use Illuminate\Database\Eloquent\Model;

class phieu_danh_gia_giang_day extends Model
{
    protected $table = "phieu_danh_gia_giang_day";
    protected $primaryKey = ["idHP", "idUser", "idHKSV", "idTCDGGD"];
    protected $keyType = 'string';
    public $incrementing = false;

    public function tieuChiDanhGiaGiangDay()
    {
        return $this->belongsTo("App\\Models\\Bases\\tieu_chi_danh_gia_giang_day", "idTCDGGD", "idTCDGGD");
    }

    public function phieuDangKyHocPhan()
    {
        return $this->belongsTo("App\\Models\\Users\\SinhVien\\phieu_dang_ky_hoc_phan", ["idHP", "idUser", "idHKSV"], ["idHP", "idUser", "idHKSV"]);
    }
}
