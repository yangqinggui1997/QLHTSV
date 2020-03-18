<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class chuong_trinh_dao_tao extends Model
{
    protected $table = "chuong_trinh_dao_tao";
    protected $primaryKey = "idCTDT";
    protected $keyType = "string";

    public function phongBan()
    {
    	return $this->belongsTo("App\\Models\\Bases\\phong_ban", "idPhong", "idPhong");
    }

    public function lop()
    {
    	return $this->hasMany("App\\Models\\Bases\\lop", "idCTDT", "idCTDT");
    }

    public function hocKyChuongTrinhDaoTao()
    {
    	return $this->hasOne("App\\Models\\Relations\\hoc_ky__chuong_trinh_dao_tao", "idCTDT", "idCTDT");
    }
}
