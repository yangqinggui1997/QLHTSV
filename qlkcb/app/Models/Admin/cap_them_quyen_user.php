<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class cap_them_quyen_user extends Model
{
    //
    
    protected $table="cap_them_quyen_user";
    protected $primaryKey = 'IdCQ';
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function nguoiDung(){
        return $this->belongsTo("App\\Models\\Admin\\User","IdUser","id");
    }
    
}
