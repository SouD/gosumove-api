<?php

declare(strict_types=1);

namespace App\Http\Controllers\Healthz;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class HealthzController extends Controller
{
    public function index(ResponseFactory $responseFactory): Response
    {
        return $responseFactory->noContent();
    }
}
