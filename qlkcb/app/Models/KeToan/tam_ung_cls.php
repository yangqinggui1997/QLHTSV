<?php

namespace App\Models\KeToan;

use Illuminate\Database\Eloquent\Model;

class tam_ung_cls extends Model
{
    //
    
    protected $table="tam_ung_cls";
    protected $primaryKey = 'IdTA';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function canLamSang() {
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\can_lam_sang", "IdCLS", "IdCLS");
    }
    
    public function nhanVien() {
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien", "IdNVLap", "IdNV");
    }
}
