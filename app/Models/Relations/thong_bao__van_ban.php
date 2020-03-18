<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Model;

class thong_bao__van_ban extends Model
{
    protected $table = 'thong_bao__van_ban';
    protected $primaryKey = ['idTB', 'idVB'];
    public $incrementing = false;

    public function thongBao()
    {
    	return $this->belongsTo("App\\Models\\Bases\\thong_bao", "idTB", "idTB");
    }

    public function vanBan()
    {
    	return $this->belongsTo("App\\Models\\Bases\\van_ban", "idVB", "idVB");
    }
}
