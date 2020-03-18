<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class hoc_phan extends Model
{
    protected $table = "hoc_phan";
    protected $primaryKey = "idHP";
    protected $keyType = "string";

    public function hocPhanHocKy()
    {
    	return $this->hasMany("App\\Models\\Relations\\hoc_phan__hoc_ky", "idHP", "idHP");
    }

    public function phieuPhanCongGiangDay()
    {
    	return $this->hasMany("App\\Models\\Users\\CanBo\\phieu_phan_cong_giang_day", "idHP", "idHP");
    }

}
