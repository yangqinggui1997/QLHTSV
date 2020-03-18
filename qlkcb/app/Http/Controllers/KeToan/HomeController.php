<?php

namespace App\Http\Controllers\KeToan;

use App\Http\Controllers\Controller;
use App\Models\KhamVaDieuTri\benh_an_ngoai_tru;
use App\Models\KhamVaDieuTri\benh_an_noi_tru;
use Illuminate\Foundation\Auth\User;

class HomeController extends Controller
{
    //
    
    public function getIndex(){
        return view("ke_toan.index");
    }    
}
