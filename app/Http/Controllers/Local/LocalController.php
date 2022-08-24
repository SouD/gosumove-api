<?php
declare(strict_types=1);

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    public function csrfToken(Request $request): Response
    {
        return \response($request->session()->token()); // Not JSON becase we need value unqouted in Postman/Insomnia
    }
}
