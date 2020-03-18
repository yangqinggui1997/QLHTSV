<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class danh_muc_cls_vs_khoa extends Model
{
    //
    
    protected $table="danh_muc_cls_vs_khoa";
    protected $primaryKey = ['IdDMCLS', 'IdKhoa'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function danhMucCLS(){
        return $this->belongsTo('App\\Models\\HanhChinh\\danh_muc_cls', 'IdDMCLS', 'IdDMCLS');
    }
    
    public function khoa(){
        return $this->belongsTo('App\\Models\\HanhChinh\\khoa', 'IdKhoa', 'IdKhoa');
    }
}
