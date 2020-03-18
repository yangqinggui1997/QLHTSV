<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class quan__huyen extends Model
{
    protected $table = "quan__huyen";
    protected $primaryKey = "idHuyen";
    protected $keyType = "string";

    public function tinhTP()
    {
    	return $this->belongsTo("App\\Models\\Bases\\tinh__thanh_pho", "idTinh", "idTinh");
    }

    public function xaPhuong()
    {
    	return $this->hasMany("App\\Models\\Bases\\xa__phuong__thi_tran", "idHuyen", "idHuyen");
    }
}
