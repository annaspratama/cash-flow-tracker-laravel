<?php

namespace App\Services\Implements;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SignInRequest;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Models\Role;

class UserServiceImplement implements UserService
{
    public function registerAccount(array $credentials): int
    {
        $user = new User(attributes: $credentials);
        $user->password = Hash::make(value: $credentials['password']);
        $data = $user->save();

        // assign user with user role
        if ($data) {
            $roleUser = Role::query()->where(column: 'name', operator: '=', value: "User")
                ->where(column: 'guard_name', operator: '=', value: "web")->first();

            $user->assignRole(roles: $roleUser->id);
        }

        return $data;
    }

    public function updateAccount(int $userId, array $account): bool
    {
        $existAccount = User::find(id: $userId);
        $result = false;

        if ($existAccount) { $result = $existAccount->update(attributes: $account); }

        return $result;
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

        if ($auth) {
            $session = $request->session()->regenerate();

            // create sanctum token
            $token = $request->user()->createToken($request->user()->email)->plainTextToken;
            $user = $request->user();
            $user->web_api_token = $token;
            $user->save();
        }

        return $session;
    }

    public function signOut(Request $request): bool
    {
        $email = $request->user()->email;

        Auth::logout();
        $request->session()->regenerateToken();

        // delete sanctum token
        $user = User::query()->where(column: 'email', operator: '=', value: $email)->first();
        $user->web_api_token = null;
        $user->save();
        PersonalAccessToken::query()->where(column: 'name', operator: '=', value: $email)->delete();

        return $request->session()->invalidate();
    }

    public function forgotPassword(string $email): void
    {
        $user = User::where(column: 'email', operator: '=', value: $email)->first();

        if ($user) { $user->sendPasswordResetNotification(token: "1234567890"); }
    }

    public function updatePassword(string $email, string $newPassword, string $retypePassword): string
    {
        $user = User::where(column: 'email', operator: '=', value: $email)->first();

        if ($user) {
            if ($newPassword == $retypePassword) {
                $user->password = Hash::make(value: $newPassword);
                $user->save();
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