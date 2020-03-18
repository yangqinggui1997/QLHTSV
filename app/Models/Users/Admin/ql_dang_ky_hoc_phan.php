<?php

namespace App\Models\Users\Admin;

use Illuminate\Database\Eloquent\Model;

class ql_dang_ky_hoc_phan extends Model
{
    protected $table = 'ql_dang_ky_hoc_phan';
    protected $primaryKey = ['namHoc','hocKy','khoaDaoTao']];
    protected $keyType = 'string';
    public $incrementing = false;		
}
