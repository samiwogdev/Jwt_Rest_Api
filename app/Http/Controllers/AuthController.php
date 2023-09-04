<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'auth:api',
            [ 'except' => ['login', 'register'] ]
        );
    }

    public function register(Request $request)
    {
        return 'welcome';
    }
}
