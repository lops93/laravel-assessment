<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToursController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tours', [ToursController::class, 'index']);
Route::get('/tours/{id}', [ToursController::class, 'getTour']);
Route::post('/tours', [ToursController::class, 'create']);
Route::put('/tours/{id}', [ToursController::class, 'update']);
Route::delete('/tours/{id}', [ToursController::class, 'delete']);
