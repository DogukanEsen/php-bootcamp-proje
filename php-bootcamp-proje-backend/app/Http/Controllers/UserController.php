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

    public function register(Request $request)
    {
        $user = $this->userService->register($request);
        return response()->json($user, 200);
    }

    public function login(Request $request)
    {
        $user = $this->userService->login($request);
        return response()->json($user, 200);
    }



    public function changePassword($id, Request $request)
    {
        $user = $this->userService->changePassword($id, $request->new_password);
        return response()->json($user, 200);
    }
    public function uploadProfilePhotoPath($id, Request $request)
    {
        $user = $this->userService->uploadProfilePhotoPath($id, $request->profile_photo_path);
        return response()->json($user, 200);
    }
}
