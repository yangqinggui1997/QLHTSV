<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class tieu_chi_danh_gia_truong extends Model
{
    protected $table = "tieu_chi_danh_gia_truong";
    protected $primaryKey = "idTCDGT";
    protected $keyType = 'string';

    public function phieuDanhGiaTruong()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_danh_gia_truong", "idTCDGT", "idTCDGT");
    }
}
