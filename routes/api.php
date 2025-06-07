<?php

use App\Http\Controllers\API\ReportApiController;
use App\Http\Controllers\API\LostandFoundApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('reports', [ReportApiController::class, 'index']);
Route::get('lostandfound', [LostandFoundApiController::class, 'index']);
