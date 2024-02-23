<?php

namespace App\Services\Implements;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SignInRequest;

class UserServiceImplement implements UserService
{
    public function registerAccount(array $credentials): bool
    {
        $user = new User(attributes: $credentials);
        $user->password = Hash::make(value: $credentials['password']);
        $data = $user->save();

        return $data;
    }

    public function verifyAccount(string $email): void
    {
        $user = User::where(column: 'email', operator: '=', value: $email)->first();

        if ($user) $user->sendEmailVerificationNotification();
    }

    public function signIn(SignInRequest $request, array $credentials, bool $rememberToken): bool
    {
        $session = false;
        $auth = Auth::attempt(credentials: $credentials, remember: $rememberToken);

        if ($auth) $session = $request->session()->regenerate();

        return $session;
    }

    public function signOut(Request $request): bool
    {
        Auth::logout();
        $request->session()->regenerateToken();

        return $request->session()->invalidate();
    }

    public function forgotPassword(string $email): void
    {
        $user = User::where(column: 'email', operator: '=', value: $email)->first();

        if ($user) $user->sendPasswordResetNotification(token: "1234567890");
    }

    public function updatePassword(string $email, string $newPassword, string $retypePassword): string
    {
        $user = User::query()->where(column: 'email', operator: '=', value: $email)->first();

        if ($user) {
            if ($newPassword == $retypePassword) {
                $user->password = Hash::make(value: $newPassword);
                return "Success: Password has been changed.";
            } else {
                return "Fail: New password and retype password are not same.";
            }
        } else {
            return "Fail: User not found.";
        }
    }

    public function deleteAccount(string $email): bool
    {
        $user = User::where(column: 'email', value: $email)->first();
        return $user->delete();
    }
}