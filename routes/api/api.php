<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')
     ->group(base_path('routes/api/v1/apiV1.php'));

Route::fallback(function() {
    return response()->json([
        'success' => false,
        'error' => "Page not found: If this problem persists, please contact an administrator."
    ]);
});