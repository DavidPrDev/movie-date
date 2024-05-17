<?php

namespace App\Http\Controllers;
use App\Http\Requests\RequestLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   
    public function login(RequestLogin $request)
    {

        if(Auth::attempt($request->only('email', 'password'))){

            $user = User::where('email', $request->email)->first();
            $token=$user->createToken('auth_token');

            return response()->json([
                'satus'=>'ok',
                'token'=>$token->plainTextToken

            ],200);

        }else{
            return response()->json(['status'=>'ko'],404);
        }
    }

    
}
