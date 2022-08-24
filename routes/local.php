<?php
declare(strict_types=1);

use App\Http\Controllers\Local\LocalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('csrf-token', [LocalController::class, 'csrfToken'])
    ->name('csrf-token');
