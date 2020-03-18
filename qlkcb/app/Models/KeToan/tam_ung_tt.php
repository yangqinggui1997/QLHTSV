<?php

namespace App\Models\KeToan;

use Illuminate\Database\Eloquent\Model;

class tam_ung_tt extends Model
{
    //
    
    protected $table="tam_ung_tt";
    protected $primaryKey = 'IdTA';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function chiDinhTT() {
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\chi_dinh_tt", "IdThuThuat", "IdThuThuat");
    }
    
    public function nhanVien() {
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien", "IdNVLap", "IdNV");
    }
}
