<?php

namespace App\Livewire\Auth;

use App\Traits\SweatAlert;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    use AuthorizesRequests, SweatAlert;

    public $email;

    public $password;

    public bool $rememberMe = false;

    public $isAdmin = false;

    protected $rules = [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
    ];

    public function login(Request $request)
    {

        $this->validate();
        try {
            $this->authenticate($request);
        } catch (\Throwable $th) {
            throw $th;
        }

        $this->isAdmin = auth()->user()->IsAdmin();
        session()->regenerate();
        if (! $this->isAdmin) {

            return redirect()->route('welcome');
        }
        $this->SweatAlert('Login With Success', 'success');
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(request $request): void
    {

        $this->ensureIsNotRateLimited($request);

        if (! Auth::attempt($this->validate(), $this->rememberMe)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(Request $request): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this->request));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }

    public function render()
    {
        return view('livewire.Auth.login')->layout('layouts.core');
    }
}
