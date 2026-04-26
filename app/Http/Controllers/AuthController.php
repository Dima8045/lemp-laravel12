<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
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

        return redirect()->route('verification.notice');
    }

    public function showEmailVerificationNotice(): View
    {
        return view('auth.verify-email');
    }   

    public function verifyEmail(EmailVerificationRequest $request, string $id, string $hash): RedirectResponse
    {
        $request->fulfill();
    
        return redirect('/')->with('status', 'Ваш email був успішно підтверджений!');
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

    public function showForgotPassword(): View
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request): RedirectResponse
    {
        $request->validated();

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status !== Password::RESET_LINK_SENT) {
            return back()->withErrors(['email' => __($status)]);
        }   

        return back()->with('status', 'Посилання для скидання пароля було надіслано на вашу електронну адресу.');
    }

    public function showResetPassword(string $token): View
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => request()->query('email'),
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $request->validated();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = $password;
                $user->save();

                Auth::login($user);
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return back()->withErrors(['email' => [__($status)]]);
        }

        return redirect()->route('login')->with('status', 'Ваш пароль був успішно скинутий!');
    }
}
