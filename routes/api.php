<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::name('auth.')
            ->prefix('auth')
            ->group(function () {
                Route::get('me', static function (Request $request) {
                    return \response()->json($request->user());
                })->name('me');
            });
    });
