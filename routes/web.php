<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

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
// Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('users', 'ChatController@users');
Route::get('public_messages', 'MessageController@publicMessages');
Route::get('messages/{user_id}', 'MessageController@messages');
Route::post('messages', 'MessageController@addMessage');


Route::get('{any}', function(){

    return view('home');

})->where('any', '.*');
