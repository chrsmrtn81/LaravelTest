<?php

namespace App\Http\Controllers\Apis\OpenWeather;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Apis\OpenWeather\Fetch;

class Cache extends Controller {

    public function __invoke()
    {
        Redis::pipeline(function ($pipe) {
            $fetch = new Fetch;
            $pipe->set("locations", json_encode($fetch->multipleLocations()));
        });
    }

}