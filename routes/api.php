<?php

use App\Http\Controllers\API\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('/v1')->group(callback: function () {
    Route::controller(RoleController::class)->group(callback: function () {
        Route::get(uri: '/roles', action: 'roles')->name(name: 'api-get-roles');
        Route::prefix('')->group(callback: function () {
            Route::post(uri: '/role', action: 'create')->name(name: 'api-create-roles');
            Route::get(uri: '/{id}/role', action: 'get')->name(name: 'api-get-role')->where(name: 'id', expression: '[0-9]+');
            Route::put(uri: '/{id}/role', action: 'update')->name(name: 'api-update-role')->where(name: 'id', expression: '[0-9]+');
            Route::delete(uri: '/{id}/role', action: 'delete')->name(name: 'api-delete-role')->where(name: 'id', expression: '[0-9]+');
        });
    });
});
