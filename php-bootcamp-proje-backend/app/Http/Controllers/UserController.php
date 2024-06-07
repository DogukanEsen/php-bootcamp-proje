<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showRegisterForm()
    {
        return view('users.register');
    }

    public function register(Request $request)
    {
        $user = $this->userService->register($request);
        return redirect()->route('login');
    }
    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        if ($this->userService->login($request)) {
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout(Request $request)
    {
        $this->userService->logout($request);
        return redirect('/');
    }

    public function showAccountSettings()
    {
        return view('users.account-settings');
    }

    public function update(Request $request)
    {
        $book = $this->userService->update($request);

        return view('users.account-settings');
    }
}
