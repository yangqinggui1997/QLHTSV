<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class UserHCAccessMiddleware
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
                if(Auth::user()->Quyen == 'admin' || Auth::user()->Quyen == 'hc'){
                    return $next($request);
                }
                else{
                if(Auth::user()->Quyen == 'qlbv'){
                        return redirect("hanh_chinh/duyet_van_ban");
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
