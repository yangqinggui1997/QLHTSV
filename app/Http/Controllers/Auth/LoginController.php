<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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

    public function getDangNhap()
    {
        try
        {
            $tenTaiKhoan = Session::get("tenTaiKhoan");
            $matKhau = Session::get("matKhau");
            if($tenTaiKhoan && $matKhau)
                return view("dang_nhap", ["tenTaiKhoan" => $tenTaiKhoan, "matKhau" => $matKhau]);
            return view("dang_nhap");
        }
        catch(\Exception $ex)
        {
            $err = $ex->getMessage();
            return redirect("/")->with('loi', $err);
        }
    }

    public function postDangNhap(Request $request)
    {
        try
        {
            if(Auth::attempt(["email" => $request->tenTaiKhoan, "password" => $request->matKhau], TRUE))
            {
                $soLanDangNhap = 0;
                $user = User::where('email', auth()->user()->email)->get()->first();
                $user->trangThai = 'dang_nhap';
                $soLanDangNhap = $user->soLanDangNhap;
                $user->soLanDangNhap = ++$soLanDangNhap;
                $user->dangNhapLC = date('Y-m-d H:i:s');
                DB::transaction(function()use($user){$user->save();});
                if($request->ghiNhoDangNhap === 'on')
                {
                    Session::put("tenTaiKhoan", $request->tenTaiKhoan);
                    Session::put("matKhau", $request->matKhau);
                }
                else
                {
                    if(Session::get("tenTaiKhoan") && Session::get("matKhau"))
                    {
                        Session::forget("tenTaiKhoan");
                        Session::forget("matKhau");
                    }
                }
                return redirect('/');
            }
            return redirect('/')->with("loi", "Đăng nhập thất bại! Vui lòng kiểm tra thông tin đăng nhập hoặc tình trạng kết nối mạng.");
        }
        catch(\Exception $ex)
        {
            $err = $ex->getMessage();
            return redirect("/")->with('loi', $err);
        }
    }
}
