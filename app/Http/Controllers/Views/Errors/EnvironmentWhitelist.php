<?php

namespace App\Http\Controllers\Views\Errors;

use App\Http\Controllers\Utils\IpAddresses\ClientRemoteIpAddress;
use App\Http\Controllers\Controller;

class EnvironmentWhitelist extends Controller {

    public function errorPage()
    {
        return view('errors.environment-whitelist', [
            'remoteIp' => ClientRemoteIpAddress::getIp(),
        ]);
    }

}