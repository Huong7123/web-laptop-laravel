<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
Route::get('/api/users', [UserController::class, 'index']);