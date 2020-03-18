<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class tinh__thanh_pho extends Model
{
    protected $table = "tinh__thanh_pho";
    protected $primaryKey = "idTinh";
    protected $keyType = "string";

    public function quanHuyen()
    {
    	return $this->hasMany("App\\Models\\Bases\\quan__huyen", "idTinh", "idTinh");
    }
}
