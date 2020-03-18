<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class thong_bao__khoa extends Model
{
    protected $table = 'thong_bao__khoa';
    protected $primaryKey = ['idTB', 'idKhoa'];
    protected $keyType = ["int", "string"];
    public $incrementing = false;
    
    public function thongBao()
    {
    	return $this->belongsTo("App\\Models\\Bases\\thong_bao", "idTB", "idTB");
    }

    public function khoa()
    {
    	return $this->belongsTo("App\\Models\\Bases\\khoa", "idKhoa", "idKhoa");
    }
}
