<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponsableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!session('Role')){
            return redirect()->route('index.index');
        }

        if(session('Role') != 'Responsable' && session('Role') != 'Administrateur'){
            return redirect()->route('index.index');
        }

        return $next($request);
    }
}
