<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class thong_bao__bieu_mau_dang_file extends Model
{
    protected $table = 'thong_bao__bieu_mau_dang_file';
    protected $primaryKey = ['idTB', 'idBM'];
    public $incrementing = false;

    public function thongBao()
    {
    	return $this->belongsTo("App\\Models\\Bases\\thong_bao", "idTB", "idTB");
    }

    public function bieuMauDangFile()
    {
    	return $this->belongsTo("App\\Models\\Bases\\bieu_mau_dang_file", "idBM", "idBM");
    }
}
