<?php

namespace App\Http\Middleware\Api\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthenticationException
     */
    public function store(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException();
        }

        $user = User::findOrFail(Auth::id());
        $token = $user->createToken('appToken')->accessToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
        ], 200);
    }
}
