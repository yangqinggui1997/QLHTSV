<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class file_cua_tin_nhan extends Model
{
    protected $table = "file_cua_tin_nhan";
    protected $primaryKey = "idTN";

    public function tinNhan()
    {
        return $this->belongsTo("App\\Models\\Bases\\tin_nhan", "idTN", "idTN");
    }
}
