<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [App\Http\Controllers\API\AuthenticationController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::group(['prefix' => 'orders'], function(){
        Route::get('/orders', [App\Http\Controllers\API\OrderController::class, 'orders']);
        Route::post('/addorder', [App\Http\Controllers\API\OrderController::class, 'addorder']);
        Route::delete('/deleteorder/{id?}', [App\Http\Controllers\API\OrderController::class, 'deleteorder']);
    });

    Route::group(['prefix' => 'inventory'], function(){
        Route::get('/get', [App\Http\Controllers\API\InventoryController::class, 'get']);
        Route::post('/addinventory', [App\Http\Controllers\API\InventoryController::class, 'addinventory']);
        Route::delete('/deleteinventory/{id?}', [App\Http\Controllers\API\InventoryController::class, 'deleteinventory']);
    });

    Route::group(['prefix' => 'category'], function(){
        Route::get('/get', [App\Http\Controllers\API\CategoryController::class, 'get']);
        Route::post('/addcategory', [App\Http\Controllers\API\CategoryController::class, 'addcategory']);
    });

    Route::group(['prefix' => 'reports'], function(){
        Route::get('sales', [App\Http\Controllers\API\ReportController::class, 'sales']);
    });

    Route::group(['prefix' => 'accounts'], function(){
        Route::post('/register', [App\Http\Controllers\API\AuthenticationController::class, 'register']);
        Route::patch('/updateuser/{id?}', [App\Http\Controllers\API\AuthenticationController::class, 'updateuser']);
    });

});