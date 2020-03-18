<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getDN(){
        if(session()->get('tentk') && session()->get('pass')){
            return view("dangnhap", ['tentk'=> Session::get('tentk'), 'pass'=>Session::get('pass')]);
        }
        return view("dangnhap");
    }

    public function postDN(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user= User::where('id', auth()->user()->id)->get()->first();
            $user->TrangThai='dang_nhap';
            $user->save();
            if($request->ghinhodn == 'on'){
                Session::put('tentk', $request->email);
                Session::put('pass', $request->password);
            }
            else{
                if(session()->get('tentk') && session()->get('pass')){
                    session()->pull('tentk');
                    session()->pull('pass');
                }
            }
            return redirect("/");
        }
        else{
            return redirect("/")->with("loi","Đăng nhập thất bại! Vui lòng kiểm tra thông tin đăng nhập.");
        }
    }
}
