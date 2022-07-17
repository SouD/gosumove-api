<?php
declare(strict_types=1);

namespace App\Http\Controllers\Healthz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class HealthzController extends Controller
{
    public function index(): Response
    {
        return \response()->noContent();
    }
}
