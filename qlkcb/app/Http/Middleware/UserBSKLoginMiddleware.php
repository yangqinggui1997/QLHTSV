<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;


class UserBSKLoginMiddleware
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
                if(Auth::user()->Quyen == 'bsk' || Auth::user()->Quyen == 'admin' || Auth::user()->Quyen == 'bskt' || Auth::user()->Quyen == 'pt' || Auth::user()->Quyen == 'bscc'){
                    return $next($request);
                }
                else{
                    if(Auth::user()->Quyen == 'tdcc' || Auth::user()->Quyen == 'tdkb'){
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
