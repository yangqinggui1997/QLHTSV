<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class can_bo_giang_vien__nguoi_dung extends Model
{
    protected $table = "can_bo_giang_vien__nguoi_dung";
    protected $primaryKey = "idUser";
    protected $keyType = "string";

    public function canBoGiangVien()
    {
    	return $this->belongsTo("App\\Models\\Bases\\can_bo_giang_vien", "idUser", "IdCB");
    }

    public function nguoiDung()
    {
    	return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }
}
