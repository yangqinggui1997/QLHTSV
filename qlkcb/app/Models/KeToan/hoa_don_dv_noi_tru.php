<?php

namespace App\Models\KeToan;

use Illuminate\Database\Eloquent\Model;

class hoa_don_dv_noi_tru extends Model
{
    //
    protected $table="hoa_don_dv_noi_tru";
    protected $primaryKey = 'IdHDDVNoi';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTru() {
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru", "IdBANoiT", "IdBANoiT");
    }
    
    public function nhanVien() {
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien", "IdNVLap", "IdNV");
    }
}
