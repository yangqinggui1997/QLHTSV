<?php

namespace App\Models\HanhChinh;

use Illuminate\Database\Eloquent\Model;

class file_tk extends Model
{
    //
    protected $table="file_tk";
    protected $primaryKey = 'IdFile';
    public $incrementing = false;
    protected $primaryType = 'string';

    public function thongKe(){
        return $this->belongsTo("App\\Models\\HanhChinh\\thong_ke", "IdTK", "IdTK");
    }
}
