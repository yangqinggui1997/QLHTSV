<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class phong_ban extends Model
{
    //
    protected $table="phong_ban";
    protected $primaryKey = 'IdPB';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phieuDkKham(){
        return $this->hasMany("App\\Models\\TiepDon\\phieu_dk_kham","IdPK","IdPB");
    }
    
    public function nhanVien(){
        return $this->hasMany("App\\Models\\HanhChinh\\nhan_vien", "IdPB", "IdPB");
    }
    
    public function Khoa(){
        return $this->belongsTo("App\\Models\\HanhChinh\\khoa", "IdKhoa", "IdKhoa");
    }
    
    public function canLamSang(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\can_lam_sang", "IdPB", "IdPB");
    }
    
    public function thietBiYT(){
        return $this->hasMany("App\\Models\\HanhChinh\\thiet_bi_yt","IdPB","IdPB");
    }
}
