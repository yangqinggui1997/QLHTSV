<?php

namespace App\Models\KeToan;

use Illuminate\Database\Eloquent\Model;

class hoa_don_dv_ngoai_tru extends Model
{
    //
    protected $table="hoa_don_dv_ngoai_tru";
    protected $primaryKey = 'IdHDDVNgoai';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNgoaiTru() {
        return $this->belongsTo("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru", "IdBANgoaiT", "IdBANgoaiT");
    }
    
    public function nhanVien() {
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien", "IdNVLap", "IdNV");
    }
}
