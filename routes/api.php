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

Route::get('sliders', 'App\Http\Controllers\SliderController@indexSliderApi');
Route::get('download-file/{file}', 'App\Http\Controllers\SliderController@downloadFile'); // download slider image by image name
Route::get('infos', 'App\Http\Controllers\adminController@companyInfoApi'); // get company info: contact, mail...
Route::get('services', 'App\Http\Controllers\serviceController@indexServiceApi'); // get company services
Route::get('testimo', 'App\Http\Controllers\temoignageController@indexTemoignageApi'); // get testimonials
Route::get('download-testimo/{file}', 'App\Http\Controllers\temoignageController@downloadFile'); // download testimo image by image name

Route::post('/send_contact', 'App\Http\Controllers\ClientController@sendContactApi'); // send contact mail
Route::post('/send_devis', 'App\Http\Controllers\ClientController@sendDevisApi'); // send devis mail
Route::get('/get_devis', function() {
    return view('client.devis_mail');
}); // Test

