<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class lop extends Model
{
    protected $table = "lop";
    protected $primaryKey = "idLop";
    protected $keyType = "string";

    public function chuongTrinhDaoTao()
    {
    	return $this->belongsTo("App\\Models\\Bases\\chuong_trinh_dao_tao", "idCTDT", "idCTDT");
    }

    public function lopNguoiDung()
    {
    	return $this->hasMany("App\\Models\\Relations\\lop__nguoi_dung", "idLop", "idLop");
    }

    public function phieuPhanCongCoVanHocTap()
    {
        return $this->hasMany("App\\Models\\Users\\CanBo\\phieu_phan_cong_co_van_hoc_tap", "idLop", "idLop");
    }

    public function phieuDangKyHocPhan()
    {
        return $this->hasMany("App\\Models\\Users\\SinhVien\\phieu_dang_ky_hoc_phan", "idLop", "idLop");
    }

    public function thongBaoLop()
    {
        return $this->hasMany("App\\Models\\Relations\\thong_bao__lop", "idLop", "idLop");
    }
}
