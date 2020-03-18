<?php

namespace App\Models\TiepDon;

use Illuminate\Database\Eloquent\Model;

class the_bhyt extends Model
{
    //
    
    protected $table="the_bhyt";
    protected $primaryKey = 'IdTheBHYT';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhNhan(){
        return $this->belongsTo("App\\Models\\TiepDon\\benh_nhan","IdBN","IdBN");
    }
    
    public function coSoKhamBHYT(){
        return $this->belongsTo("App\\Models\\HanhChinh\\co_so_kham_bhyt","IdCSKBHYT","IdCSKBHYT");
    }
}
