<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class thiet_bi_yt extends Model
{
    //
    
    protected $table="thiet_bi_yt";
    protected $primaryKey = 'IdTB';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTru(){
        return $this->hasMany('App\\Models\\KhamVaDieuTri\\benh_an_noi_tru', 'IdGiuong', 'IdTB');
    }
    
    public function phongBan(){
        return $this->belongsTo('App\\Models\\HanhChinh\\phong_ban', 'IdPB', 'IdPB');
    }
}
