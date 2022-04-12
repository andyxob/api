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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'worker'] ,function (){
    Route::get('/', [\App\Http\Controllers\WorkerController::class , 'workers']);
    Route::get('/{id}', [\App\Http\Controllers\WorkerController::class , 'workerById']);

    Route::post('/add', [\App\Http\Controllers\WorkerController::class, 'workerAdd']);
    Route::put('/{id}', [\App\Http\Controllers\WorkerController::class, 'workerEdit']);

    Route:: delete('/worker/{id}', [\App\Http\Controllers\WorkerController::class, 'workerDelete']);

} );

Route::group(['prefix'=>'shop'] ,function (){

    Route::get('/',[\App\Http\Controllers\ShopController::class, 'shops']);
    Route::get('/{id}', [\App\Http\Controllers\ShopController::class, 'shopById']);

    Route::post('/add',[\App\Http\Controllers\ShopController::class, 'shopAdd'] );
    Route::put('/{id}', [\App\Http\Controllers\ShopController::class, 'shopEdit']);

    Route::delete('/{id}',[\App\Http\Controllers\ShopController::class, 'shopDelete']);
} );

Route::group(['prefix'=>'dep'], function (){
    Route::get('/', [\App\Http\Controllers\DepartmentController::class, 'departments']);
    Route::get('/{id}', [\App\Http\Controllers\DepartmentController::class, 'depById']);

    Route::post('/add',[\App\Http\Controllers\DepartmentController::class, 'depAdd'] );
    Route::put('/{id}', [\App\Http\Controllers\DepartmentController::class, 'depEdit']);

    Route::delete('/{id}',[\App\Http\Controllers\DepartmentController::class, 'depDelete']);
});

Route::group(['prefix'=>'journal'], function (){
    Route::get('/', [\App\Http\Controllers\JournalController::class, 'journals']);
    Route::get('/{id}', [\App\Http\Controllers\JournalController::class, 'journalById']);

    Route::post('/add',[\App\Http\Controllers\JournalController::class, 'journalAdd'] );
    Route::put('/{id}', [\App\Http\Controllers\JournalController::class, 'journalEdit']);

    Route::delete('/{id}',[\App\Http\Controllers\JournalController::class, 'journalDelete']);
});
