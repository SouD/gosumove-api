<?php
declare(strict_types=1);

use App\Http\Controllers\Local\LocalController;
use Illuminate\Support\Facades\Route;

Route::get('csrf-token', [LocalController::class, 'csrfToken'])
    ->name('csrf-token');
