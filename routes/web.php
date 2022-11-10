<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('/device/{device}', DeviceController::class);

Route::group(['prefix' => 'device/{device}'], function () {
    Route::get('/', [DeviceController::class, 'show']);

    Route::get('/{device}/interface', 'InterfaceController@index');
    Route::get('/members', 'RestaurantController@members');

    // and there is some other Route with the same structure...

});
