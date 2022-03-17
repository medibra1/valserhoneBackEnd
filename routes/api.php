<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('sliders', 'App\Http\Controllers\ApiController@indexSliderApi');
Route::get('download-file/{file}', 'App\Http\Controllers\ApiController@downloadFile'); // download slider image by image name
Route::get('infos', 'App\Http\Controllers\ApiController@companyInfoApi'); // get company info: contact, mail...
Route::get('services', 'App\Http\Controllers\ApiController@indexServiceApi'); // get company services
Route::get('portofolio', 'App\Http\Controllers\ApiController@indexPortofolio'); // get company portofolio
Route::get('download-portofo/{file}', 'App\Http\Controllers\ApiController@downloadPortofoFile'); // Download portofolio image
Route::get('testimo', 'App\Http\Controllers\ApiController@indexTemoignageApi'); // get testimonials
Route::get('download-testimo/{file}', 'App\Http\Controllers\ApiController@downloadTestimoFile'); // download testimo image by image name

Route::post('/send_contact', 'App\Http\Controllers\ApiController@sendContactApi'); // send contact mail
Route::post('/send_devis', 'App\Http\Controllers\ApiController@sendDevisApi'); // send devis mail



