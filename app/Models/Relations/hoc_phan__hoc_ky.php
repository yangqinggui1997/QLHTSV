<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class hoc_phan__hoc_ky extends Model
{
    protected $table = "hoc_phan__hoc_ky";
    protected $primaryKey = ["idHP", "idHKDT", "idCTDT"];
    protected $keyType = "string";
    public $incrementing = false;

    public function hocKyChuongTrinhDaoTao()
    {
        return $this->belongsTo("App\\Models\\Relations\\hoc_ky__chuong_trinh_dao_tao", ["idHKDT", "IdCTDT"], ["idHKDT", "IdCTDT"]);
    }

    public function hocPhan()
    {
        return $this->belongsTo("App\\Models\\Bases\\hoc_phan", "idHP", "idHP");
    }
}
