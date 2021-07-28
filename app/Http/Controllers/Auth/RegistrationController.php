<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    private AuthorService $authSvc;

    /**
     * RegistrationController constructor.
     * @param AuthorService $authSvc
     */
    public function __construct(AuthorService $authSvc)
    {
        $this->authSvc = $authSvc;
    }

    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'string',
            'email'    => 'email|unique:authors',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $register = $this->authSvc->register($request->except('_token', 'password_confirmation'));

        if (! $register) {
            return back();
        }

        return redirect()->intended(route('index'));
    }
}
