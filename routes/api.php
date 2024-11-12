<?php

use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\Footage\AddFootageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/projects/all', ProjectsController::class)
    ->name('api.all-projects');
