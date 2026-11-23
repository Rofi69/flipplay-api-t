<?php

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCollectionController;

Route::get('/users/{user}/collection', [UserCollectionController::class, 'index']);
Route::post('/users/{user}/collection', [UserCollectionController::class, 'store']);
Route::delete('/users/{user}/collection/{media}', [UserCollectionController::class, 'destroy']);
Route::apiResource('media', MediaController::class)->parameters([
    'media' => 'media',]);