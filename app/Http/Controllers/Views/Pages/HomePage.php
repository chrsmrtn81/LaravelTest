<?php

namespace App\Http\Controllers\Views\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class HomePage extends Controller {

    public function view()
    {
        $locations = json_decode(Redis::get('locations'));
        $random_location = array_rand($locations->list);

        $location_data = $locations->list[$random_location];
        $location_image = Redis::get('location:' . $location_data->id);
        
        return view('pages.home-page', [
            'location_data' => $location_data,
            'location_image' => $location_image,
        ]);
    }

}