<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class ql_thao_tac extends Model
{
    //
    
    protected $table="co_so_kham_bhyt";
    protected $primaryKey = 'IdCSKBHYT';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function theBHYT(){
        return $this->hasMany("App\\Models\\TiepDon\\the_bhyt","IdCSKBHYT","IdCSKBHYT");
    }
    
}
