<?php
/**
 * User service is user management functions.
 * 
 * @author  Annas Pratama
 * @since   2024
 * @version 1.0.0
 */

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\SignInRequest;

interface UserService
{
    /**
     * Register new user account and return the user id.
     * 
     * @param array $credentials
     * 
     * @return int
     */
    public function registerAccount (array $credentials): int;

    /**
     * Update an existing user account then return bool
     * 
     * @param int $userId
     * @param array $account
     * 
     * @return bool
     */
    public function updateAccount (int $userId, array $account): bool;

    /**
     * Verify new user account using email.
     * 
     * @param string $email
     * 
     * @return void
     */
    public function verifyAccount (string $email): void;

    /**
     * Sign in for authorized account.
     * 
     * @param Illuminate\Http\Request $request
     * @param array $credentials
     * @param bool $rememberToken
     * 
     * @return bool
     */
    public function signIn (SignInRequest $request, array $credentials, bool $rememberToken): bool;

    /**
     * Sign out for authorized user.
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return bool
     */
    public function signOut (Request $request): bool;

    /**
     * Recover password for forgotten password.
     * 
     * @param string $email
     * 
     * @return void
     */
    public function forgotPassword (string $email): void;

    /**
     * Update user password.
     * 
     * @param string $email
     * @param string $newPassword
     * @param string $retypePassword
     * 
     * @return string
     */
    public function updatePassword(string $email, string $newPassword, string $retypePassword): string;

    /**
     * Delete registered account.
     * 
     * @param string $email
     * 
     * @return bool
     */
    public function deleteAccount (string $email): bool;
}