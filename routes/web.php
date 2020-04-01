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

        Route::get('edit/{id}', 'ProdutoController@edit');

        Route::post('update', 'ProdutoController@update');
    });

    Route::prefix('fornecedor')->group(function () {
        Route::get('create', 'FornecedorController@create');

        Route::post('store', 'FornecedorController@store');

        Route::get('listagem', 'FornecedorController@index');

        Route::get('destroy/{id}', 'FornecedorController@destroy');

        Route::get('edit/{id}', 'FornecedorController@edit');

        Route::post('update', 'FornecedorController@update');
    });

    Route::prefix('funcionario')->group(function () {
        Route::get('create', 'UserController@create');

        Route::post('store', 'UserController@store');

        Route::get('listagem', 'UserController@index');

        Route::get('edit/{id}', 'UserController@edit');

        Route::post('update', 'UserController@update');

        Route::get('destroy/{id}', 'UserController@destroy');

        Route::get('verify', 'UserController@verifyPassword');

        Route::post('change', 'UserController@changePassword');
    });

    Route::prefix('venda')->group(function () {
        Route::get('nova/{id?}', 'VendaController@listarProdutos');

        Route::get('carrinho', 'VendaController@carrinho');

        Route::get('esvaziar', 'VendaController@esvaziarCarrinho');

        Route::post('store', 'VendaController@store');

        Route::get('factura', 'pdf\PdfVendaController@factura');

        Route::get('remover/{id}', 'VendaController@removerCarrinho');

        Route::get('listagem', 'VendaController@index');

        Route::get('destroy/{id}', 'VendaController@destroy');
    });

});
