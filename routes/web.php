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

Route::get('/', ['uses' => 'HomeController@show', 'as' => 'home']);

Route::group(['prefix' => '/game', 'as' => 'game.'], function() {
    Route::get('/', ['uses' => 'GameController@showForm', 'as' => 'main']);
    Route::put('/create', ['uses' => 'GameController@startGame', 'as' => 'create']);

    Route::get('/play', ['uses' => 'GameController@playGame', 'as' => 'play']);
    Route::post('/guess', ['uses' => 'GameController@guessNumber', 'as' => 'guess']);

    Route::get('/results', ['uses' => 'GameController@results', 'as' => 'results']);
});
