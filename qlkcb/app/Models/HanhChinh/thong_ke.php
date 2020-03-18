<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class thong_ke extends Model
{
    //
    protected $table="thong_ke";
    protected $primaryKey = 'IdTK';
    public $incrementing = false;
    protected $primaryType = 'string';

    public function nhanVien(){
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien", "IdNV", "IdNV");
    }
    
    public function File(){
        return $this->hasMany("App\\Models\\HanhChinh\\file_tk","IdTK","IdTK");
    }

    public function duyetTK(){
        return $this->hasMany("App\\Models\\HanhChinh\\duyet_tk","IdTK","IdTK");
    }
}
