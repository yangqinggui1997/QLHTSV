<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class tieu_chi_danh_gia_giang_day extends Model
{
    protected $table = "tieu_chi_danh_gia_giang_day";
    protected $primaryKey = "idTCDGGD";
    protected $keyType = 'string';

    public function phieuDanhGiaGiangDay()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_danh_gia_giang_day", "idTCDGGD", "idTCDGGD");
    }
}
