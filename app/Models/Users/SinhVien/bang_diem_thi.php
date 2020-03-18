<?php

namespace App\Models\Users\SinhVien;

use Illuminate\Database\Eloquent\Model;

class bang_diem_thi extends Model
{
    protected $table = "bang_diem_thi";
    protected $primaryKey = "idDT";
    protected $keyType = 'string';

    public function phieuDangKyHocPhan()
    {
        return $this->belongsTo("App\\Models\\Users\\SinhVien\\phieu_dang_ky_hoc_phan", ["idHP", "idUser", "idHKSV"], ["idHP", "idUser", "idHKSV"]);
    }
}
