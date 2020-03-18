<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class duyet_tk extends Model
{
    //
    protected $table="duyet_tk";
    protected $primaryKey = ['IdTK', 'IdNV'];
    public $incrementing = false;
    protected $primaryType = 'string';

    public function nhanVien(){
        return $this->belongsTo("App\\Models\\HanhChinh\\nhan_vien", "IdNV", "IdNV");
    }
    
    public function thongKe(){
        return $this->belongsTo("App\\Models\\HanhChinh\\thong_ke","IdTK","IdTK");
    }
}
