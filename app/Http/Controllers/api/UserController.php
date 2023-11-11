<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function read() : JsonResponse
    {
        $users = User::all();
        
        return $this->responseOk('User data found!',['users' => $users]);
    }
}
