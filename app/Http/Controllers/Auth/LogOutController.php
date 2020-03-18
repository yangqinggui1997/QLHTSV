<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LogOutController extends Controller
{
	use AuthenticatesUsers;

    public function getDangXuat()
    {
    	try
    	{
    		if(Auth::check())
	    	{
	    		$tenTaiKhoan = ''; $matKhau = ''; $flag = FALSE;
	    		$tenTaiKhoan = Session::get("tenTaiKhoan");
	            $matKhau = Session::get("matKhau");
		    	if($tenTaiKhoan && $matKhau)
		    	{
		    		$tenTaiKhoan = $tenTaiKhoan;
		    		$matKhau = $matKhau;
		    		$flag = TRUE;
		    	}
		    	$user = User::where("idUser", Auth::User()->idUser)->get()->first();
		    	$user->trangThai = 'dang_xuat';
		    	DB::transaction(function()use($user){
		    		$user->save();
			    	Auth::logout();
		    	}, 3);
		    	Session::flush();
		    	Session::regenerate();
		    	if($flag)
		    	{
		    		Session::put('tenTaiKhoan', $tenTaiKhoan);
		    		Session::put('matKhau', $matKhau);
		    	}
	    	}
	    	return redirect('/');
    	}
    	catch(\Exception $ex)
    	{
    		$err = $ex->getMessage();
    		return redirect('/')->with('loi', $err);
    	}
    }
}
