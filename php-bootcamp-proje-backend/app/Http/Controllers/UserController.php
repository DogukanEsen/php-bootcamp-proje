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
        $result = $this->userService->register($request);
        if ($result['success']) {
            return redirect()->route('login')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }
    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        $result = $this->userService->login($request);

        if ($result['success']) {
            return redirect()->route('books.index')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }


    public function logout(Request $request)
    {
        $result = $this->userService->logout($request);
        if ($result['success']) {
            return redirect()->route('books.index')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function showAccountSettings()
    {
        return view('users.account-settings');
    }

    public function update(Request $request)
    {
        $result = $this->userService->update($request);
        if ($result['success']) {
            return redirect()->route('account.settings')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }
}
