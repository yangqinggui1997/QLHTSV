<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class co_so_kham_bhyt extends Model
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
