<?php

use App\Http\Controllers\ParametroController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users/all',[UserController::class, 'all']);
Route::put('users/restore/{id}',[UserController::class, 'restore']);
Route::apiResource('users', UserController::class);

Route::get('perfiles/all',[PerfilController::class, 'all']);
Route::put('perfiles/restore/{id}',[PerfilController::class, 'restore']);
Route::apiResource('perfiles', PerfilController::class);

Route::get('parametros/getList/{codigo}',[ParametroController::class , 'getList']);

Route::get('productos/all',[ProductoController::class, 'all']);
Route::get('productos/search', [ ProductoController::class, 'search']);
Route::put('productos/restore/{id}', [ ProductoController::class, 'restore']);
Route::apiResource('productos', ProductoController::class);
