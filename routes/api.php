<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/todos', [TodoController::class, 'index']); // (R)
Route::post('/todos', [TodoController::class, 'store']); // (C)
Route::put('/todos/{id}', [TodoController::class, 'update']); // (U)
Route::delete('/todos/{id}', [TodoController::class, 'destroy']); // (D)
Route::get('/todos/trashed', [TodoController::class, 'trashed']);
Route::patch('/todos/{id}/restore', [TodoController::class, 'restore']);
Route::delete('/todos/{id}/force-delete', [TodoController::class, 'forceDelete']);


