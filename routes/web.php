<?php

use App\Http\Controllers\Views\Home;
use App\Http\Controllers\Views\Test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RssFeeds\ProcessRssFeeds;
use App\Http\Controllers\Views\Errors\IpWhitelist;

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

Route::post('/ajax', [Home::class, 'sources']);

Route::get('/ip-whitelist', [IpWhitelist::class, 'view'])->name('ip-whitelist');

Route::group(['middleware' => ['web', 'whitelist']], function () {
    Route::get('/', [Home::class, 'index']);
    Route::post('/updateCookies', [Home::class, 'updateCookies']);
    Route::post('/addArticleView', [Home::class, 'addArticleView']);
});



Route::get('/xml', [ProcessRssFeeds::class, 'fetchRssFeeds']);
