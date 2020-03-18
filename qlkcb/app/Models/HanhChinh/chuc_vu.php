<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class chuc_vu extends Model
{
    //
    
    protected $table="chuc_vu";
    protected $primaryKey = 'IdCV';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function nhanVien(){
        return $this->hasMany("App\\Models\\HanhChinh\\nhan_vien","IdNV","IdNV");
    }
    
}
