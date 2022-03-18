<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/', function () {
    return redirect('accueil');
}); */
Route::get('/', function () {
    return redirect('admin');
});
Route::get('/home', function () {
    return redirect('admin');
});

Route::group(['middleware' => 'auth'], function(){ // Satart Middleware

Route::resource('/admin', 'App\Http\Controllers\AdminController');

Route::resource('/sliders', 'App\Http\Controllers\SliderController');
Route::get('change_slider_status/{id}', 'App\Http\Controllers\SliderController@change_slider_status');
Route::get('delete-slider/{id}', 'App\Http\Controllers\SliderController@delete');


Route::resource('/services', 'App\Http\Controllers\ServiceController');

Route::resource('/works', 'App\Http\Controllers\WorkController');
Route::delete('/delete_one_work/{id}', 'App\Http\Controllers\WorkController@delete_one_work');
Route::post('/del-checked-work', 'App\Http\Controllers\WorkController@delwork');

Route::resource('/teams', 'App\Http\Controllers\TeamController');
Route::get('change_team_status/{id}', 'App\Http\Controllers\TeamController@change_team_status');

Route::resource('/partners', 'App\Http\Controllers\PartnerController');

Route::resource('/temoignages', 'App\Http\Controllers\TemoignageController');
Route::get('/change_tem_status/{id}', 'App\Http\Controllers\TemoignageController@change_tem_status');

Route::resource('/nouvelles', 'App\Http\Controllers\NouvelleController');
Route::get('/change_new_status/{id}', 'App\Http\Controllers\NouvelleController@change_new_status');

}); // end middleware

Route::get('/accueil', 'App\Http\Controllers\ClientController@index');
Route::get('/devis', 'App\Http\Controllers\ClientController@devis');
Route::post('/store_devis', 'App\Http\Controllers\ClientController@storeDevis');
Route::post('/send_contact', 'App\Http\Controllers\ClientController@sendContact');
Route::get('/send_contact', 'App\Http\Controllers\ClientController@sendContact');

Auth::routes();

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');