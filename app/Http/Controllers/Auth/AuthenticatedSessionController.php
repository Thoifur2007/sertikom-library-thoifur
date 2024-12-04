<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Pastikan tidak melebihi batas percobaan login
    $this->ensureIsNotRateLimited($request);

    $request->authenticate();

    $request->session()->regenerate();

    // Hapus hit rate limiting setelah login berhasil
    RateLimiter::clear($this->throttleKey($request));

    return redirect()->intended(route('dashboard', absolute: false));
}

protected function ensureIsNotRateLimited(Request $request): void
{
    if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 3)) {
        RateLimiter::hit($this->throttleKey($request), 30); // Pemblokiran selama 60 detik
        return;
    
    }

    $seconds = RateLimiter::availableIn($this->throttleKey($request));

    throw ValidationException::withMessages([
        'email' => trans('Akun dibekukan. Coba lagi dalam :seconds detik.', [
            'seconds' => $seconds,
        ]),
    ]);
}

protected function throttleKey(Request $request): string
{
    return Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
