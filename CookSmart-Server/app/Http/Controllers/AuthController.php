<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);

        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $result = $this->authService->login($credentials);

        if (! $result) {
            return $this->responseJSON(null, "Unauthorized", 401);
        }

        return $this->responseJSON($result);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $result = $this->authService->register($request->all());

        return $this->responseJSON($result);
    }

    public function logout()
    {
        $result = $this->authService->logout();
        return $this->responseJSON($result);
    }

    public function refresh()
    {
        $result = $this->authService->refresh();
        return $this->responseJSON($result);
    }
}
