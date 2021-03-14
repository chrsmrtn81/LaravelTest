<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\OpenWeather\Cache;
use App\Http\Controllers\Apis\OpenWeather\Fetch;
use App\Http\Controllers\Views\Errors\EnvironmentWhitelist;
use App\Http\Controllers\Views\Pages\HomePage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/environment-whitelist', [EnvironmentWhitelist::class, 'view'])->name('environment-whitelist');


Route::group(['middleware' => 'whitelist'], function () {
    
    Route::get('/', [HomePage::class, 'view']);

    Route::get('/redis', [Cache::class, 'redis']);

});