<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class UserBSK_BSCC_Ad_AccessMiddleware
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
            if(Auth::check()){
                return $next($request);
            }
            else{
                return redirect("/");
            }
        }
        else{
            if(Auth::check()){
                if(Auth::user()->Quyen == 'bsk' || Auth::user()->Quyen == 'admin' || Auth::user()->Quyen == 'bscc'){
                    return $next($request);
                }
                else{
                    if(Auth::user()->Quyen == 'bskt' || Auth::user()->Quyen == 'pt'){
                        return redirect("kham_va_dieu_tri");
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
