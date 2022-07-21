<?php

use Aqamarine\AlphaNews\Http\Controllers\AdminPanelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminPanelController::class, 'home']);
