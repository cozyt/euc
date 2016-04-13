<?php

namespace Euc\Middleware;

use Euc\EUC;

class InitEuc
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
        EUC::init();

        return $next($request);
    }
}
