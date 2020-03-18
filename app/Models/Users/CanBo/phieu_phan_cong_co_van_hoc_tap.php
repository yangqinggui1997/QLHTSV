<?php

namespace App\Models\Users\CanBo;

use Illuminate\Database\Eloquent\Model;

class phieu_phan_cong_co_van_hoc_tap extends Model
{
    protected $table = 'phieu_phan_cong_co_van_hoc_tap';
    protected $primaryKey = ['idLop', 'idUser'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function nguoiDung()
    {
    	return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }

    public function lop()
    {
    	return $this->belongsTo("App\\Models\\Bases\\lop", "idLop", "idLop");
    }
}
