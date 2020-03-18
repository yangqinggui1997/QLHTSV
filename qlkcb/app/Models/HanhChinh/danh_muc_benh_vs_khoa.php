<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class danh_muc_benh_vs_khoa extends Model
{
    //
    
    protected $table="danh_muc_benh_vs_khoa";
    protected $primaryKey = ['IdBenh', 'IdKhoa'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function khoa(){
        return $this->belongsTo('App\\Models\\HanhChinh\\khoa', 'IdKhoa', 'IdKhoa');
    }
    
    public function danhMucBenh(){
        return $this->belongsTo('App\\Models\\HanhChinh\\danh_muc_benh', 'IdBenh', 'IdBenh');
    }
}
