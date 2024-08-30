<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $data): array
    {
        $user = $this->getUserByEmail($data['email']);
        $checkPassword = $this->checkPassword($user, $data['password']);
        if (is_null($user) || !$checkPassword) return [
            'status' => 'error',
            'message' => 'Incorrect Credentials',
        ];

        $token = $this->generate_token($user);
        return [
            'status' => 'success',
            'message' => 'Successfully logged in',
            'token' => $token,
        ];
    }

    public function register(array $data): array
    {
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return [
            'status' => 'success',
            'message' => 'Successfully registered',
        ];
    }

    public function logout()
    {
        request()->user()->token()->revoke();
        return [
            'status' => 'success',
            'message' => 'Successfully logged out',
        ];
    }

    // custom functions
    private function getUserByEmail(string $email): User
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    private function checkPassword(User $user, string $password): bool
    {
        $checkPassword = Hash::check($password, $user->password);
        return $checkPassword;
    }

    private function generate_token(User $user)
    {
        $token = $user->createToken('token')->plainTextToken;
        return $token;
    }
}
