<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Display roles page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function rolesPage()
    {
        return view(view: 'dashboard.dashboard.users.roles.roles');
    }

    /**
     * Display permissions page.
     * 
     * @param int $roleId
     * 
     * @return \Illuminate\Http\Response
     */
    public function permissionsPage(int $roleId)
    {
        return view(view: 'dashboard.dashboard.users.roles.permissions', data: ['role_id' => $roleId]);
    }

    /**
     * Display change password page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function changePasswordPage()
    {
        return view(view: 'dashboard.dashboard.users.change-password');
    }

    /**
     * Update new password.
     * 
     * @param ChangePasswordRequest $request
     * 
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $result = redirect()->to(path: route(name: 'dashboard-change-password-page'));
        
        if (Hash::check(value: $data['password_old'], hashedValue: $request->user()->password)) {
            $updatePassword = $this->userService->updatePassword(email: $request->user()->email, newPassword: $data['password'], retypePassword: $data['password_confirmation']);

            if (str_contains(haystack: $updatePassword, needle: "Success")) { $result = $result->withSuccess($updatePassword); }
            else { $result = $result->withErrors($updatePassword); }
        } else {
            $result = $result->withErrors(provider: [
                'errors' => [
                    'error' => "Your old and new password must be same."
                ]
                ]);
        }

        return $result;
    }
}
