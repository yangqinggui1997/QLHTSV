<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class phong_ban extends Model
{
    protected $table = "phong_ban";
    protected $primaryKey = "idPhong";
    protected $keyType = "string";

    public function khoa()
    {
    	return $this->belongsTo("App\\Models\\Bases\\khoa", "idKhoa", "idKhoa");
    }

    public function chuongTrinhDaoTao()
    {
        return $this->hasMany("App\\Models\\Bases\\chuong_trinh_dao_tao", "idCTDT", "idCTDT");
    }

    public function phongBanNguoiDung()
    {
        return $this->hasMany("App\\Models\\Relations\\phong_ban__nguoi_dung", "idPhong", "idPhong");
    }

    public function canBoGiangVien()
    {
        return $this->hasMany("App\\Models\\Bases\\can_bo_giang_vien", "idPhong", "idPhong");
    }
}
