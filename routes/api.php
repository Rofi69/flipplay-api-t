<?php

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::apiResource('media', MediaController::class)->parameters([
    'media' => 'media',
]);