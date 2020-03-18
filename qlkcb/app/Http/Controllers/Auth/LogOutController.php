<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;

class LogOutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function getDX(Request $request){
        $tentk='';$pass='';$flag=FALSE;
        if(session()->get('tentk') && session()->get('pass')){
            $flag=TRUE;
            $tentk=Session::get('tentk');
            $pass=Session::get('pass');
        }
        
        $user= User::where('id', auth()->user()->id)->get()->first();
        $user->TrangThai='dang_xuat';
        $user->save();
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        
        if($flag==TRUE){
            Session::put('tentk', $tentk);
            Session::put('pass', $pass);
        }
        
        return redirect('/');
    }

}
