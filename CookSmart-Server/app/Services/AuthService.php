<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
    public function login(array $credentials) {
        $token = Auth::attempt($credentials);

        if (! $token) {
            return null;
        }

        return [
            "user"  => Auth::user(),
            "token" => $token,
            "type"  => "bearer"
        ];
    }

    public function register(array $data) {
        $user = User::create([
            "name"     => $data["name"],
            "email"    => $data["email"],
            "password" => Hash::make($data["password"]),
        ]);

        $token = Auth::login($user);

        return [
            "user"  => $user,
            "token" => $token,
            "type"  => "bearer"
        ];
    }

    public function logout(){
        Auth::logout();

        return [
            "message" => "Successfully logged out"
        ];
    }

    public function refresh() {
        return [
            "user"  => Auth::user(),
            "token" => Auth::refresh(),
            "type"  => "bearer"
        ];
    }

    public function me(){
    return Auth::user();
   }

}
