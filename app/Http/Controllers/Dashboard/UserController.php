<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
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
     * @return \Illuminate\Contracts\View\View
     */
    public function rolesPage(): View
    {
        return view(view: 'dashboard.dashboard.users.roles.roles');
    }

    /**
     * Display permissions page.
     * 
     * @param int $roleId
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function permissionsPage(int $roleId): View
    {
        return view(view: 'dashboard.dashboard.users.roles.permissions', data: ['role_id' => $roleId]);
    }

    /**
     * Display change password page.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function changePasswordPage(): View
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

    /**
     * Display account profile page.
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function accountProfilePage(Request $request): View
    {
        $user = User::find(id: $request->user()->id);
        return view(view: 'dashboard.dashboard.users.your-profile', data: ['user' => $user]);
    }

    /**
     * Display users page.
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function usersPage(Request $request): View
    {
        return view(view: 'dashboard.dashboard.users.users.users');
    }

    /**
     * Delete user data.
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request): \Illuminate\Http\RedirectResponse
    {
        $id = $request->input(key: 'id');
        User::find(id: $id)->delete();

        return redirect()->to(path: route(name: 'dashboard-users-page'))->withSuccess("Your data deleted.");
    }
}