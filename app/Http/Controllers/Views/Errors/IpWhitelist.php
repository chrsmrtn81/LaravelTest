<?php

namespace App\Http\Controllers\Views\Errors;

use App\Http\Controllers\Utils\IpAddresses\ClientRemoteIpAddress;
use App\Http\Controllers\Controller;

class IpWhitelist extends Controller {

    public function view()
    {
        return view('errors.ip_whitelist', [
            'remoteIp' => ClientRemoteIpAddress::getIp(),
        ]);
    }

}