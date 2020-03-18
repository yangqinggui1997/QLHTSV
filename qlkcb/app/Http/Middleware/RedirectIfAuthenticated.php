<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            switch (auth()->user()->Quyen){
                case 'bsk':case 'bskt':case 'bscc':case 'pt':return redirect("kham_va_dieu_tri");
                case 'tdcc':case 'tdkb':return redirect("tiep_don");
                case 'admin':return redirect("admin");
                case 'hc':case 'qlbv':return redirect("hanh_chinh");
                case 'kt':return redirect("ke_toan");
                default :   
                    Auth::logout();
                    return redirect('/');
            }
        }
        return $next($request);
    }
}
