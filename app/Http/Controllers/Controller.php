<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
		$this->middleware(function($request, $next){
			if(Auth::check())
	    	{
	    		$nd = User::where('idUser', Auth::User()->idUser)->get()->first();
				view()->share('nd', $nd);
			}
			return $next($request);
		});
	}
}
