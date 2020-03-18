<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class UserTDCCAccessMiddleware
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
                if(Auth::user()->Quyen == 'tdcc' || Auth::user()->Quyen == 'admin'){
                    return $next($request);
                }
                else{
                    if(Auth::user()->Quyen == 'tdkb' ){
                        return redirect("tiep_don/dang_ky_kham");
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
