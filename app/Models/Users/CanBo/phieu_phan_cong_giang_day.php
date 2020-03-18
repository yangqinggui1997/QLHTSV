<?php

namespace App\Models\Users\CanBo;

use Illuminate\Database\Eloquent\Model;

class phieu_phan_cong_giang_day extends Model
{
    protected $table = "phieu_danh_gia_diem_ren_luyen";
    protected $primaryKey = ["idHP", "idUser"];
    protected $keyType = 'string';
    public $incrementing = false;

    public function nguoiDung()
    {
        return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }

    public function hocPhan()
    {
        return $this->belongsTo("App\\Models\\Bases\\hoc_phan", "idHP", "idHP");
    }

    public function phieuDangKyHocPhan()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_dang_ky_hoc_phan", "idHP", "idHP");
    }
}
