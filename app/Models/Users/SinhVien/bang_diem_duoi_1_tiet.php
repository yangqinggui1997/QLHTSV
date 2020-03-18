<?php

namespace App\Models\Users\SinhVien;

use Illuminate\Database\Eloquent\Model;

class bang_diem_duoi_1_tiet extends Model
{
    protected $table = "bang_diem_duoi_1_tiet";
    protected $primaryKey = "idDD1T";
    protected $keyType = 'string';

    public function phieuDangKyHocPhan()
    {
        return $this->belongsTo("App\\Models\\Users\\SinhVien\\phieu_dang_ky_hoc_phan", ["idHP", "idUser", "idHKSV"], ["idHP", "idUser", "idHKSV"]);
    }
}
