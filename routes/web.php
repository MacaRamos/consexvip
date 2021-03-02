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

Route::get('/', 'HomeController@index')->name('inicio');

Auth::routes();

Route::namespace('Anuncio')->middleware(['auth'])->group(function () {
    Route::resource('/anuncios', 'AnuncioController', ['only' => ['index', 'create', 'show', 'edit', 'store', 'update', 'destroy']]);
    Route::post('subirFotos', 'AnuncioController@subirFotos')->name('subirFotos');
    Route::post('eliminarFoto/{anuncio?}', 'AnuncioController@eliminarFoto')->name('eliminarFoto');
    
});