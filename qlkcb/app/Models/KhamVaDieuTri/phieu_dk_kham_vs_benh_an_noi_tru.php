<?php

namespace App\Models\KhamVaDieuTri;

use Illuminate\Database\Eloquent\Model;

class phieu_dk_kham_vs_benh_an_noi_tru extends Model
{
    //
    protected $table="phieu_dk_kham_vs_benh_an_noi_tru";
    protected $primaryKey = ['IdPhieuDKKB','IdBANoiT'];
    public $incrementing = false;
    protected $primaryType = 'string';
    
    public function benhAnNoiTru(){
            return $this->belongsTo('App\\Models\\KhamVaDieuTri\\benh_an_noi_tru', 'IdBANoiT', 'IdBANoiT');
    }
    
    public function phieuDKKham(){
        return $this->belongsTo('App\\Models\\TiepDon\\phieu_dk_kham', 'IdPhieuDKKB', 'IdPhieuDKKB');
    }
}
