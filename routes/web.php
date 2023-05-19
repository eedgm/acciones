<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatuController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\PrioridadController;
use App\Http\Controllers\AgrupacionController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect(route('login'));
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('app.actions.dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('actions', ActionController::class);
        Route::resource('agrupacions', AgrupacionController::class);
        Route::resource('prioridads', PrioridadController::class);
        Route::resource('status', StatuController::class);
        Route::resource('users', UserController::class);
    });
