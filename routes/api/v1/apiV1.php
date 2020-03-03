<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Transactions API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('transactions')
     ->namespace('Api\v1')
     ->group(base_path('routes/api/v1/transactions.php'));