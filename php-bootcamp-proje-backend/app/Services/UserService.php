<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register($data)
    {

        $data = $data->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'profile_photo_path' => 'nullable|string',
        ]);

        return User::create([
            "username" => $data["username"],
            'password' => Hash::make($data['password']),
            "email" => $data["email"],
            "profile_photo_path" => $data["profile_photo_path"] ?? null,
            "is_admin" => false,
        ]);
    }

    public function login($data)
    {
        $data = $data->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|max:255',
        ]);

        $user = User::where('email', $data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            return $user;
        }

        return null;
    }

    public function changePassword($userId, $newPassword)
    {
        $user = User::find($userId);
        $user->password = Hash::make($newPassword);
        $user->save();

        return $user;
    }

    public function uploadProfilePhotoPath($userId, $profilePhotoPath)
    {
        $user = User::find($userId);
        $user->profile_photo_path = $profilePhotoPath;
        $user->save();
        return $user;
    }
}

