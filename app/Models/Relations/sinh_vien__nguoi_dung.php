<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class sinh_vien__nguoi_dung extends Model
{
    protected $table = "sinh_vien__nguoi_dung";
    protected $primaryKey = "idUser";
    protected $keyType = "string";

    public function nguoiDung()
    {
    	return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }

    public function sinhVien()
    {
        return $this->belongsTo("App\\Models\\Bases\\sinh_vien", "idUser", "idSV");
    }
}
