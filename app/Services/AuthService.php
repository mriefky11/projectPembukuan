<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class AuthService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(array $credentials)
    {
        $user = $this->userRepo->findByEmail($credentials['email']);
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return $user;
        }
        return null;
    }

    public function logout()
    {
        Auth::logout();
    }
}
