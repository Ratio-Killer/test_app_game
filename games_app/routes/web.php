<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;


Route::resource('games', GameController::class);
