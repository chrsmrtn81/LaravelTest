<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Utils\IpAddresses\ClientRemoteIpAddress;
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
        $remoteIp = ClientRemoteIpAddress::getIp();

        if(!$this->checkExistsInWhitelist($remoteIp)){
            return redirect('environment-whitelist');
        }
        
        return $next($request);
    }

    private function checkExistsInWhitelist($remoteIp)
    {
        $ips = explode(',', env('ENVIRONMENT_IP_WHITELIST'));

        if(in_array($remoteIp, $ips) || $ips[0] === 'all'){
            return true;
        }

        return false;
    }
}
