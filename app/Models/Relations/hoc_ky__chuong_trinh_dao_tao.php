<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class hoc_ky__chuong_trinh_dao_tao extends Model
{
    protected $table = "hoc_ky__chuong_trinh_dao_tao";
    protected $primaryKey = ["idHKDT", "idCTDT"];
    protected $keyType = 'string';
    public $incrementing = false;

    public function chuongTrinhDaoTao()
    {
        return $this->belongsTo("App\\Models\\Bases\\chuong_trinh_dao_tao", "idCTDT", "idCTDT");
    }

    public function hocPhanHocKy()
    {
        return $this->hasMany("App\\Models\\Relations\\hoc_phan__hoc_ky", ["idHKDT", "idCTDT"], ["idHKDT", "idCTDT"]);
    }
}
