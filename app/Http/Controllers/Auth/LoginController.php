<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    private AuthorService $authSvc;

    /**
     * LoginController constructor.
     * @param AuthorService $authSvc
     */
    public function __construct(AuthorService $authSvc)
    {
        $this->authSvc = $authSvc;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => 'email|exists:authors',
            'password' => Password::min(8)
        ]);

        $this->authSvc->login($request->except('_token'));

        return redirect()->intended(route('index'));
    }

    public function logout(): RedirectResponse
    {
        $this->authSvc->logout();

        return back();
    }
}
