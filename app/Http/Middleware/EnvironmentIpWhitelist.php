<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnvironmentIpWhitelist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$this->checkExistsInWhitelist($request)){
            return redirect('environment-whitelist');
        }
        
        return $next($request);
    }

    private function checkExistsInWhitelist(Request $request)
    {
        $ips = explode(',', env('ENVIRONMENT_IP_WHITELIST'));

        if(in_array($request->ip(), $ips) || $ips[0] === 'all'){
            return true;
        }

        return false;
    }
}
