<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class xa__phuong__thi_tran extends Model
{
    protected $table = "xa__phuong__thi_tran";
    protected $primaryKey = "idXa";
    protected $keyType = "string";

    public function quanHuyen()
    {
    	return $this->belongsTo("App\\Models\\Bases\\quan__huyen", "idHuyen", "idHuyen");
    }

    public function canBoGiangVien()
    {
        return $this->hasMany("App\\Models\\Bases\\can_bo_giang_vien", "idXa", "idXa");
    }

    public function sinhVien()
    {
        return $this->hasMany("App\\Models\\Bases\\sinh_vien", "idXa", "idXa");
    }
}
