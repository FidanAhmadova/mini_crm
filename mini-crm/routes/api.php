<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\DealController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\NoteController;

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('companies', CompanyController::class)->parameters(['companies' => 'id']);
    Route::apiResource('customers', CustomerController::class)->parameters(['customers' => 'id']);
    Route::apiResource('deals', DealController::class)->parameters(['deals' => 'id']);
    Route::apiResource('tasks', TaskController::class)->parameters(['tasks' => 'id']);
    Route::apiResource('notes', NoteController::class)->parameters(['notes' => 'id']);
});
