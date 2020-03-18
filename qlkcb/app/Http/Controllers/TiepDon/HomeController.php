<?php

namespace App\Http\Controllers\TiepDon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    
    public function getIndex(){
        return view("tiep_don.index");
    }    
}
