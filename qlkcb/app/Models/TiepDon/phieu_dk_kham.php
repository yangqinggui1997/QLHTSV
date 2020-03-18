<?php

namespace App\Models\TiepDon;

use Illuminate\Database\Eloquent\Model;

class phieu_dk_kham extends Model
{
    //
    
    protected $table="phieu_dk_kham";
    protected $primaryKey = 'IdPhieuDKKB';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhNhan(){
        return $this->belongsTo("App\\Models\\TiepDon\\benh_nhan","IdBN","IdBN");
    }
    
    public function nhanVien(){
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien","IdNV","IdNV");
    }
    
    public function phongKham(){
        return $this->belongsTo("App\\Models\\HanhChinh\\phong_ban","IdPK","IdPB");
    }
    
    public function benhAnNgoaiTru(){
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\phieu_dk_kham_vs_benh_an_ngoai_tru","IdPhieuDKKB","IdPhieuDKKB");
    }
    
    public function benhAnNoiTru(){
        return $this->hasOne("App\\Models\\KhamVaDieuTri\\phieu_dk_kham_vs_benh_an_noi_tru","IdPhieuDKKB","IdPhieuDKKB");
    }
}
