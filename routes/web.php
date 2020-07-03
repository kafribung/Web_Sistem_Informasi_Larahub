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

Route::get('/', function () {
    return redirect('/pertanyaan');
});

// FIle Manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['middleware' => 'auth'], function () {
    // Pertanyaan
    Route::resource('pertanyaan', 'PertanyaanController')->except(['index', 'show']);

    // Jawaban
    Route::get('/jawaban/{id}', 'JawabanController@create');
    Route::post('jawaban/{id}', 'JawabanController@store');
});

// Pertanyaan
Route::resource('pertanyaan', 'PertanyaanController')->only(['index', 'show']);

Auth::routes();