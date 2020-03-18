<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class lop__nguoi_dung extends Model
{
    protected $table = "lop__nguoi_dung";
    protected $primaryKey = ["idLop", "idUser"];
    protected $keyType = "string";
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
