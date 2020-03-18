<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class UserAdminLoginMiddleware
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
        if($request->ajax()){
            return $next($request);
        }
        else{
            if(Auth::check()){
                if(Auth::user()->Quyen == 'admin'){
                    return $next($request);
                }
                else{
                    if(Auth::user()->Quyen == 'bsk' || Auth::user()->Quyen == 'bskt' || Auth::user()->Quyen == 'bscc' || Auth::user()->Quyen == 'pt'){
                        return redirect("kham_va_dieu_tri");
                    }
                    else if(Auth::user()->Quyen == 'tdcc' || Auth::user()->Quyen == 'tdkb'){
                        return redirect("tiep_don");
                    }
                    else if(Auth::user()->Quyen == 'hc' || Auth::user()->Quyen == 'qlbv'){
                        return redirect("hanh_chinh");
                    }
                    else if(Auth::user()->Quyen == 'kt'){
                        return redirect("ke_toan");
                    }
                    else{
                        Auth::logout();
                        return redirect("/");
                    }
                }
            }
            else{
                return redirect("/");
            }
        }
    }
}
