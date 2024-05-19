<?php

namespace App\Http\Controllers;
use App\Http\Requests\RequestLogin;
use App\Http\Requests\ResquestRegister;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Tag(
 *     name="User Controller",
 *     description="Endpoints related to authentication"
 * )
 */

class UserController extends Controller
{
     /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Authenticate user and generate JWT token",
     *     tags={"User Controller"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="email", type="string", example="john@example.com"),
     *                 @OA\Property(property="password", type="string", example="123456789"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="accessToken", type="string"),
     *             @OA\Property(property="token_type", type="string", example="Bearer"),
     *             @OA\Property(property="expires_at", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Invalid credentials"
     *     )
     * )
     */
   
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

        /**
     * 
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *      tags={"User Controller"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string", example="test register"),
     *                 @OA\Property(property="email", type="string", example="register@example.com"),
     *                 @OA\Property(property="password", type="string", example="123456789"),
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(
     *         response="201",
     *         description="User registered successfully"
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation errors"
     *     )
     * )
     */
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
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout user and revoke all tokens",
     *     tags={"User Controller"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function logout(Request  $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'Successful logout.'
        ];
    }
}
