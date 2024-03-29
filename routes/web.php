<?php

declare(strict_types=1);

use App\Http\Controllers\Healthz\HealthzController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HealthzController::class, 'index'])
    ->name('healthz');

Route::get('reset-password', function () {
    return \response()->noContent();
})->name('password.reset');
