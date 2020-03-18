<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class danh_muc_benh_vs_thuoc extends Model
{
    //
    
    protected $table="danh_muc_benh_vs_thuoc";
    protected $primaryKey = ['IdBenh', 'IdThuoc'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function danhMucThuoc(){
        return $this->belongsTo('App\\Models\\HanhChinh\\danh_muc_thuoc', 'IdThuoc', 'IdThuoc');
    }
    
    public function danhMucBenh(){
        return $this->belongsTo('App\\Models\\HanhChinh\\danh_muc_benh', 'IdBenh', 'IdBenh');
    }
}
