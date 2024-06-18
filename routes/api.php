<?php


use App\Http\Controllers\Private\DashboardController;
use App\Http\Controllers\Public\UbicationController;
use App\Http\Controllers\Private\AuthController;
use App\Http\Controllers\Public\EventController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/event/home', [EventController::class, 'home']);
Route::get('/event/list', [EventController::class, 'eventList']);

Route::resource('event', EventController::class)->except(['create', 'edit']);
Route::get('event/{event}/edit', [EventController::class, 'edit']);

Route::resource('ubications', UbicationController::class)->except(['create', 'edit']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'getUser']);
});
