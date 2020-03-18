<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class thong_bao__lop extends Model
{
    protected $table = 'thong_bao__lop';
    protected $primaryKey = ['idTB', 'idLop'];
    protected $keyType = ["int", "string"];
    public $incrementing = false;
    
    public function thongBao()
    {
    	return $this->belongsTo("App\\Models\\Bases\\thong_bao", "idTB", "idTB");
    }

    public function lop()
    {
    	return $this->belongsTo("App\\Models\\Bases\\lop", "idLop", "idLop");
    }
}
