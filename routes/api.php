<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StatuController;
use App\Http\Controllers\Api\ActionController;
use App\Http\Controllers\Api\PrioridadController;
use App\Http\Controllers\Api\AgrupacionController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ActionUsersController;
use App\Http\Controllers\Api\action_userController;
use App\Http\Controllers\Api\UserActionsController;
use App\Http\Controllers\Api\StatuActionsController;
use App\Http\Controllers\Api\PrioridadActionsController;
use App\Http\Controllers\Api\ActionAgrupacionsController;
use App\Http\Controllers\Api\action_agrupacionController;
use App\Http\Controllers\Api\AgrupacionActionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('actions', ActionController::class);

        // Action Users
        Route::get('/actions/{action}/users', [
            ActionUsersController::class,
            'index',
        ])->name('actions.users.index');
        Route::post('/actions/{action}/users/{user}', [
            ActionUsersController::class,
            'store',
        ])->name('actions.users.store');
        Route::delete('/actions/{action}/users/{user}', [
            ActionUsersController::class,
            'destroy',
        ])->name('actions.users.destroy');

        // Action Agrupacions
        Route::get('/actions/{action}/agrupacions', [
            ActionAgrupacionsController::class,
            'index',
        ])->name('actions.agrupacions.index');
        Route::post('/actions/{action}/agrupacions/{agrupacion}', [
            ActionAgrupacionsController::class,
            'store',
        ])->name('actions.agrupacions.store');
        Route::delete('/actions/{action}/agrupacions/{agrupacion}', [
            ActionAgrupacionsController::class,
            'destroy',
        ])->name('actions.agrupacions.destroy');

        Route::apiResource('agrupacions', AgrupacionController::class);

        // Agrupacion Actions
        Route::get('/agrupacions/{agrupacion}/actions', [
            AgrupacionActionsController::class,
            'index',
        ])->name('agrupacions.actions.index');
        Route::post('/agrupacions/{agrupacion}/actions/{action}', [
            AgrupacionActionsController::class,
            'store',
        ])->name('agrupacions.actions.store');
        Route::delete('/agrupacions/{agrupacion}/actions/{action}', [
            AgrupacionActionsController::class,
            'destroy',
        ])->name('agrupacions.actions.destroy');

        Route::apiResource('prioridads', PrioridadController::class);

        // Prioridad Actions
        Route::get('/prioridads/{prioridad}/actions', [
            PrioridadActionsController::class,
            'index',
        ])->name('prioridads.actions.index');
        Route::post('/prioridads/{prioridad}/actions', [
            PrioridadActionsController::class,
            'store',
        ])->name('prioridads.actions.store');

        Route::apiResource('status', StatuController::class);

        // Statu Actions
        Route::get('/status/{statu}/actions', [
            StatuActionsController::class,
            'index',
        ])->name('status.actions.index');
        Route::post('/status/{statu}/actions', [
            StatuActionsController::class,
            'store',
        ])->name('status.actions.store');

        Route::apiResource('users', UserController::class);

        // User Actions
        Route::get('/users/{user}/actions', [
            UserActionsController::class,
            'index',
        ])->name('users.actions.index');
        Route::post('/users/{user}/actions/{action}', [
            UserActionsController::class,
            'store',
        ])->name('users.actions.store');
        Route::delete('/users/{user}/actions/{action}', [
            UserActionsController::class,
            'destroy',
        ])->name('users.actions.destroy');
    });
