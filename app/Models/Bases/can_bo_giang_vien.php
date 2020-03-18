<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class can_bo_giang_vien extends Model
{
    protected $table = "can_bo_giang_vien";
    protected $primaryKey = "idCB";
    protected $keyType = "string";

    public function phongBan()
    {
    	return $this->belongsTo("App\\Models\\Bases\\phong_ban", "idPhong", "idPhong");
    }

    public function xaPhuong()
    {
        return $this->belongsTo("App\\Models\\Bases\\xa__phuong__thi_tran", "idXa", "idXa");
    }
    
    public function canBoGiangVienNguoiDung()
    {
    	return $this->hasOne("App\\Models\\Relations\\can_bo_giang_vien__nguoi_dung", "idUser", "idCB");
    }
}
