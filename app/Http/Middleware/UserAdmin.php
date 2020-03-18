<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->ajax())
        {
            if(Auth::check())
            {
                $user = Auth::user();
                $tt = $user->trangThai;
                if($tt === 'bi_khoa' || $tt === 'dang_xuat')
                {
                    DB::transaction(function(){Auth::logout();}, 3);
                    return; 
                }
            }
            return $next($request);
        }
        else
        {
            if(Auth::check())
            {
                $user = Auth::user();
                $tt = $user->trangThai;
                $maQuyen = $user->idQuyen;
                if($tt === 'bi_khoa' || $tt === 'dang_xuat')
                {
                    DB::transaction(function(){Auth::logout();}, 3);
                    return redirect('/'); 
                }
                if($maQuyen === "admin" || $maQuyen === "master")
                    return $next($request);
                else
                    switch ($maQuyen) 
                    {
                        case 'can_bo_giang_vien':
                            return redirect("can_bo_giang_vien");
                        case 'sinh_vien':
                            return redirect("sinh_vien");
                    }
                DB::transaction(function(){Auth::logout();}, 3);
                return redirect('/');
            }
            return redirect('/');
        }
    }
}
