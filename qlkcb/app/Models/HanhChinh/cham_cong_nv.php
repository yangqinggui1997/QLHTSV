<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class cham_cong_nv extends Model
{
    //
    
    protected $table="cham_cong_nv";
    protected $primaryKey = 'IdCC';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function nhanVien(){
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien","IdNV","IdNV");
    }
}
