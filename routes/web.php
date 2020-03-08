<?php

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('produto')->group(function () {
        Route::get('novo', 'ProdutoController@create');

        Route::post('cadastrar', 'ProdutoController@store');

        Route::get('listagem', 'ProdutoController@index');

        Route::get('destroy/{id}', 'ProdutoController@destroy');
    });

});
