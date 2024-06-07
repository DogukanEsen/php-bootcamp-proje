<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        User::create([
            "username" => $data["username"],
            'password' => Hash::make($data['password']),
            "email" => $data["email"],
            "profile_photo_path" => $data["profile_photo_path"] ?? null,
            "is_admin" => false,
        ]);
        return ['success' => true, 'message' => 'User successfully created.'];
    }

    public function login($request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return ['success' => true, 'message' => 'User successfully logged in.'];
        }

        return ['success' => false, 'message' => 'Email or password is incorrect.'];
    }

    public function logout($request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return ['success' => true, 'message' => 'Logged out successfully.'];
    }

    public function update($request)
    {
        $data = $request->validate([
            'username' => 'sometimes|string|max:255',
            'password' => 'nullable|string|max:255',
            'email' => 'sometimes|string|email',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        if ($user) {

            if ($request->hasFile('profile_photo')) {
                if ($user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }

                $file = $request->file('profile_photo');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('user_img', $filename, 'public');
                $data["profile_photo_path"] = $path;
            }

            if (!empty($data['password'])) {
                $data["password"] = Hash::make($data['password']);
            } else
                $data['password'] = $user->password;


            $user->update($data);
            return ['success' => true, 'message' => 'User successfully updated.'];
        }
        return ['success' => false, 'message' => 'User not found.'];
    }
}

