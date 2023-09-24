<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
class twoFAVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $verified=User::where('twoFA_verified','=',1)->first();
        $disabled_twoFA=User::where('twoFA_enabled','=',0)->first();
        
         if($verified OR $disabled_twoFA ){
          return redirect('dashboard');
         }
        //  else if(!$verified){
        //     return redirect('verify2FA')->with('Error','You must verify 2FA');
        //  }
        return $next($request);
    }
}
