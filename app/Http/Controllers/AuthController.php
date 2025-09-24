<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
     protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authService->login($request->validated());

        if (!$user) {
            return back()->withErrors(['email' => 'Email atau Password salah']);
        }

        return match($user->role) {
            'bendahara' => redirect()->route('dashboard.bendahara'),
            'kepala_sekolah' => redirect()->route('dashboard.kepala'),
            'yayasan' => redirect()->route('dashboard.yayasan'),
            'operator' => redirect()->route('dashboard.operator'),
            default => redirect()->route('login'),
        };
    }

    public function logout(Request $request)
    {
        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
