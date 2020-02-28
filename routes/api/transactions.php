<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Transactions API Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'TransactionsController@index');

Route::post('/', 'TransactionsController@store');

Route::delete('/', 'TransactionsController@index');
