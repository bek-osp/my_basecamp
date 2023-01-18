<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AuthExeption;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(RegisterRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);

        $user = User::create($request->only('name', 'email', 'password'));

        if (!$user) {
            throw new AuthExeption('Error in registration');
        }

        $token = $user->createToken($user->name . "-Access")->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }
}
