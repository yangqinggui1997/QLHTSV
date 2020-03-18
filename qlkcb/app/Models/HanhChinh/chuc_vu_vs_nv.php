<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class chuc_vu_vs_nv extends Model
{
    //
    
    protected $table="chuc_vu_vs_nv";
    protected $primaryKey = ['IdCV','IdNV'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function chucVu(){
        return $this->belongsTo("App\\Models\\HanhChinh\\chuc_vu","IdCV","IdCV");
    }
    
    public function nhanVien(){
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien","IdNV","IdNV");
    }
    
}
