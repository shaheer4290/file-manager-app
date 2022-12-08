<?php

use App\Http\Controllers\Api\FileController;
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

Route::controller(FileController::class)->group(function () {
    // CRUD operation for quizzes
    Route::get('/files', 'getAll');

    Route::post('/files', 'create');

    Route::get('/files/{file}', 'get')->where(['file' => '[0-9]+']);

    Route::get('/files/{file}/show', 'getFile')->name('file.show');
});
