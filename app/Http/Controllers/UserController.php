<?php

namespace App\Http\Controllers;
use App\Http\Requests\RequestLogin;
use App\Http\Requests\ResquestRegister;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function login(RequestLogin $request)
    {

        if(Auth::attempt($request->only('email', 'password'))){

            $user = User::where('email', $request->email)->first();
            $token=$user->createToken('auth_token');

            return response()->json([
                'status'=>'ok',
                'token'=>$token->plainTextToken

            ],200);

        }else{
            return response()->json(['status'=>'ko'],404);
        }
    }

    public function register(ResquestRegister $request){

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $token=$user->createToken('auth_token');

        return response()->json([
            'status'=>'ok',
            'token'=>$token->plainTextToken
        ],201);

    } 
}
