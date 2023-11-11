<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required']
        ]);


        if ($validator->fails()) {
            return $this->responseFailedValidation('User data are not valid', null);
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $token = $user->createToken('user-token')->plainTextToken;

        return $this->responseCreated('User registered!', ['token' => $token]);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->responseFailedValidation('User data are not valid', null);
        }

        if (Auth::attempt($request->all())) {
            $user = $request->user();
            $token = $user->createToken('user-token')->plainTextToken;
            return $this->responseOk('User logged in!', ['token' => $token]);
        }

        return $this->responseUnauthenticated('User does not exist!', null);
    }

    
}
