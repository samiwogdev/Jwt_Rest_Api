<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Psy\Readline\Userland;
use Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'auth:api',
            ['except' => ['login', 'register']]
        );
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|unique:users',
            'passsword' => 'required|string|confirmed|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(
            array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            )
        );
        return response()->json([
            'message' => 'User Successfully Registered',
            'User' => $user
        ], 201);
    }
}
