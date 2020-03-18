<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class phieu_dk_kham_vs_benh_an_ngoai_tru extends Model
{
    //
    protected $table="phieu_dk_kham_vs_benh_an_ngoai_tru";
    protected $primaryKey = ['IdPhieuDKKB','IdBANgoaiT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNgoaiTru(){
            return $this->belongsTo('App\\Models\\KhamVaDieuTri\\benh_an_ngoai_tru', 'IdBANgoaiT', 'IdBANgoaiT');
    }
    
    public function phieuDKKham(){
        return $this->belongsTo('App\\Models\\TiepDon\\phieu_dk_kham', 'IdPhieuDKKB', 'IdPhieuDKKB');
    }
}
