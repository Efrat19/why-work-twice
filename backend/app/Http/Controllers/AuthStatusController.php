<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

class AuthStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $authStatus = [
            'isSigned' => auth()->check(),
            'id' => auth()->id(),
            'csrf' => csrf_token()
        ];
        return response()->json($authStatus);
    }
}
