<?php

namespace App\Models\Bases;

use Illuminate\Database\Eloquent\Model;

class van_ban extends Model
{
    protected $table = "van_ban";
    protected $primaryKey = "idVB";

    public function nguoiDung()
    {
        return $this->belongsTo("App\\Models\\Users\\User", "idUser", "idUser");
    }

    public function thongBaoVanBan()
    {
        return $this->hasMany("App\\Models\\Relations\\thong_bao__van_ban", "idVB", "idVB");
    }
}
