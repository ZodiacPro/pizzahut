<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DB_checker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            \DB::connection()->getPDO();
                return $next($request);
            } catch (\Exception $e) {
                return response()->view('errors.nodb');
        }
        
    }
}
