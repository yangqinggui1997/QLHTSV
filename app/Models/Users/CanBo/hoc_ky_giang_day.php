<?php

namespace App\Models\Users\CanBo;

use Illuminate\Database\Eloquent\Model;

class hoc_ky_giang_day extends Model
{
    protected $table = "hoc_ky_giang_day";
    protected $primaryKey = "idUser";
    protected $keyType = "string";

    public function canBoGiangVien()
    {
    	return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }
}
