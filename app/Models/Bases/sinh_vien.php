<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class sinh_vien extends Model
{
    protected $table = "sinh_vien";
    protected $primaryKey = "idSV";
    protected $keyType = "string";

    public function xaPhuong()
    {
        return $this->belongsTo("App\\Models\\Bases\\xa__phuong__thi_tran", "idXa", "idXa");
    }
    
    public function sinhVienNguoiDung()
    {
    	return $this->hasOne("App\\Models\\Relations\\sinh_vien__nguoi_dung", "idUser", "idSV");
    }
}
