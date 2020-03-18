<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class tinh_tp extends Model
{
    //
    
    protected $table="tinh_tp";
    protected $primaryKey = 'IdTinh';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function quanHuyen() {
        return $this->hasMany("App\\Models\\HanhChinh\\quan_huyen", "IdTinh", "IdTinh");
    }
    
    public function phuongXa(){
        return $this->hasManyThrough("App\\Models\\HanhChinh\\phuong_xa", "App\\Models\\HanhChinh\\quan_huyen", "IdTinh", "IdHuyen", "IdTinh", "IdHuyen")->orderBy('TenXa', 'ASC')->orderBy('IdXa', 'ASC');
    }
}