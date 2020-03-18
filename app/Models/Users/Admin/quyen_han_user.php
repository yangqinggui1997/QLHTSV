<?php

namespace App\Models\Users\Admin;

use Illuminate\Database\Eloquent\Model;

class quyen_han_user extends Model
{
    protected $table = 'quyen_han_user';
    protected $primaryKey = 'idQuyen';
    protected $keyType = 'string';

    public function nguoiDung()
    {
    	return $this->hasMany("App\\Models\\Users\\User", "idQuyen", "idQuyen");
    }
}
