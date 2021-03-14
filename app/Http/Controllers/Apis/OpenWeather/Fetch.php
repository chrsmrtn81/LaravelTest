<?php

namespace App\Http\Controllers\Apis\OpenWeather;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class Fetch extends Controller {

    public $url;
    public $appid;
    public $unit = 'metric';

    public function __construct()
    {
        $this->appid = env('OPENWEATHER_API_KEY');
        $this->url = env('OPENWEATHER_API_URL');
    }

    public function singleLocation()
    {
        $response = Http::get($this->url . 'weather?', [
            'q'=> 'middlesbrough',
            'units' => $this->unit,
            'appid' => $this->appid,
        ]);

        return $response->json();
    }

    public function multipleLocations()
    {
        $response = Http::get($this->url . 'group?', [
            'id'=> '1609350,2636389,2642607,1607551,2639577',
            'units' => 'metric',
            'appid' => env('OPENWEATHER_API_KEY'),
        ]);

        return $response->json();
    }

}