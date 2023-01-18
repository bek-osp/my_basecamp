<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AuthExeption;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(LoginRequest $request)
    {
        $user = User::firstWhere('email', $request->email);

        if (!$user) {
            throw new AuthExeption('User not found');
        }

        if (!Hash::check($request->password, $user->password)) {
            throw new AuthExeption('Password is wrong');
        }

        $token = $user->createToken($user->name . "-Access")->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);

    }
}
