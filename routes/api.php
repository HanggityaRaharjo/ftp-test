<?php

use App\Http\Controllers\api\FTPController;
use App\Http\Controllers\api\CommandController;
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

// Route::get('/file-transfer',[FTPController::class,'index']);
Route::post('/file-transfer',[FTPController::class,'store']);

// Route::get('/get-all-folder',[FTPController::class,'index']);
// Route::post('/get-folder',[FTPController::class,'show']);

Route::get('/command/make-controller',[CommandController::class,'make_controller']);

Route::get('/ftp-root',[FTPController::class,'index']);
Route::post('/ftp-content',[FTPController::class,'show']);
