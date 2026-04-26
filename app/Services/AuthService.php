<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $user
    )
    {
    }

    public function register(array $data): User
    {
        $user =$this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $user->sendEmailVerificationNotification();

        return $user;
    }

    public function attemptLogin(string $email, string $password, bool $remember = false): bool
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password,
        ], $remember);
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
