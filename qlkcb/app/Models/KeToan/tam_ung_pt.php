<?php

namespace App\Models\KeToan;

use Illuminate\Database\Eloquent\Model;

class tam_ung_pt extends Model
{
    //
    
    protected $table="tam_ung_pt";
    protected $primaryKey = 'IdTA';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function chiDinhPT() {
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\chi_dinh_pt", "IdPT", "IdPT");
    }
    
    public function nhanVien() {
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien", "IdNVLap", "IdNV");
    }
}
