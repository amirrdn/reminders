<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\UserService;

use Validator;
use JWTFactory;
use JWTAuth;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request, UserService $usr)
    {
        // \Config::set('jwt.user', 'App\Models\Musers');
        // \Config::set('auth.providers.users.model', App\Models\Musers::class);
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                // return response()->json(['error' => 'invalid_credentials'], 401);
                return response()->json([
                    'oke'   => false,
                    'err'   => 'ERR_INVALID_CREDS',
                    'msg'  => 'incorrect username or password'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $getusers                   = $usr->userRelations()
                                    ->where('id', \Auth::user()->id)
                                    ->select('*')
                                    ->first();
        return response()->json([
            'oke' => true,
            'data' => [
                "users" => $getusers
            ],
            'access_token' => $token
        ], 200);
    }
    public function Unauthenticated()
    {
        return response()->json([
            'message'   => 'Unauthenticated',
            'code'  => 401
        ]);
    }
    public function refresh()
    {
        if(\Auth::check()){
            return response()->json([
                'oke' => true,
                'access_token' => \Auth::refresh(),
            ]);
        }else{
            return response()->json([
                'oke' => false,
                'err' => 'ERR_INVALID_REFRESH_TOKEN',
                'msg'   => 'invalid refresh token'
            ], 401);
        }
    }
}
