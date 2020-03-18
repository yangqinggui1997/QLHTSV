<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class tin_nhan extends Model
{
    protected $table = "tin_nhan";
    protected $primaryKey = "idTN";

    public function nguoiDung()
    {
        return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }

    public function fileCuaTinNhan()
    {
        return $this->hasMany("App\\Models\\Bases\\file_cua_tin_nhan", "idTN", "idTN");
    }
}
