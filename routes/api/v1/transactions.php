<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Transactions API Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'TransactionsController@index');

Route::get('/{transaction}', 'TransactionsController@show');

Route::post('/', 'TransactionsController@store');

Route::delete('/{id}', 'TransactionsController@destroy');