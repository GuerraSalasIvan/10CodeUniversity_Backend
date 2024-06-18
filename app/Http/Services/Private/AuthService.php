<?php

namespace App\Http\Services\Private;

use Illuminate\Support\ValidatedInput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Ubication;
use App\Models\Event;
use App\Models\User;
use Validator;
use \stdClass;


class AuthService
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::Create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['data'=>$user, 'access_token' => $token, 'token_type'=>'Bearer']);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Hola ' . $user->name,
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function getUser(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return ['message'=>'Logout!'];
    }
}
