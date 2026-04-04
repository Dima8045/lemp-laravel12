<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthServiceInterface $auth
    ) {}

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->auth->register($request->validated());

        if (!$this->auth->attemptLogin($request->email, $request->password)) {
            return back()->withInput($request->only('name', 'email'));
        }

        $request->session()->regenerate();

        return redirect()->route('admin.posts.index');
    }


    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (! $this->auth->attemptLogin($request->email, $request->password, $request->remember)) {
            return back()->withErrors([
                'email' => 'Надані облікові дані не відповідають нашим записам.',
            ])->withInput($request->only('email', 'remember'));
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('admin.posts.index'))
            ->with('status', 'З поверненням ' . $request->user()->name . '!');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->auth->logout();

        return redirect()->route('login')->with('status', 'Ви вийшли з системи!');
    }
}
