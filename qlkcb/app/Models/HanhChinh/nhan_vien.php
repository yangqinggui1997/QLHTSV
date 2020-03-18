<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class nhan_vien extends Model
{
    //
    
    protected $table="nhan_vien";
    protected $primaryKey = 'IdNV';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function phieuDkKham(){
        return $this->hasMany("App\\Models\\TiepDon\\phieu_dk_kham","IdNV","IdNV");
    }
    
    public function benhAnNoiTru(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\benh_an_noi_tru","IdNV","IdNV");
    }
    
    public function benhAnNV(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\ba_nv","IdNV","IdNV");
    }
    
    public function benhAnNgoaiTru(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru","IdNV","IdNV");
    }

    public function ketQuaCanLamSang(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\ket_qua_cls","IdNVTH","IdNV");
    }
    
    public function chiDinhPT(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\chi_dinh_pt","IdNVTH","IdNV");
    }
    
    public function chiDinhTT(){
        return $this->hasMany("App\\Models\\KhamVaDieuTri\\chi_dinh_tt","IdNVTH","IdNV");
    }
    
    public function tamUngCLS(){
        return $this->hasMany("App\\Models\\KeToan\\tam_ung_cls","IdNVLap","IdNV");
    }
    
    public function tamUngPT(){
        return $this->hasMany("App\\Models\\KeToan\\tam_ung_pt","IdNVLap","IdNV");
    }
    
    public function tamUngTT(){
        return $this->hasMany("App\\Models\\KeToan\\tam_ung_tt","IdNVLap","IdNV");
    }
    
    public function thongKe(){
        return $this->hasMany("App\\Models\\KeToan\\thong_ke","IdNV","IdNV");
    }

    public function phuongXa(){
        return $this->belongsTo("App\\Models\\HanhChinh\\phuong_xa", "IdXa", "IdXa");
    }
    
    public function phongBan(){
        return $this->belongsTo("App\\Models\\HanhChinh\\phong_ban", "IdPB", "IdPB");
    }
    
    public function chucVu(){
        return $this->hasMany("App\\Models\\HanhChinh\\chuc_vu_vs_nv", "IdNV", "IdNV");
    }
    
    public function chamCong(){
        return $this->hasMany("App\\Models\\HanhChinh\\cham_cong_nv", "IdNV", "IdNV");
    }
    
    public function nguoiDung(){
        return $this->hasOne("App\\Models\\Admin\\User", "IdNV", "IdNV");
    }

    public function duyetTK(){
        return $this->hasMany("App\\Models\\HanhChinh\\duyet_tk", "IdNV", "IdNV");
    }
}
