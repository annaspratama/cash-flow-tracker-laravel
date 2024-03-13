<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserTableCollection;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public UserService $userService;

    /**
     * Control all API user requests.
     */
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Update account profile.
     * 
     * @param UpdateAccountRequest $request
     * 
     * @return UserResource
     */
    public function update(UpdateAccountRequest $request): UserResource
    {
        $data = $request->validated();

        $this->userService->updateAccount(userId: $request->user()->id, account: $data);

        $user = User::find(id: $request->user()->id);

        return new UserResource(resource: $user);
    }

    /**
     * The table of users.
     * 
     * @param Request $request
     * 
     * @return UserCollection
     */
    public function usersTable(Request $request): UserTableCollection
    {
        $search = $request->input(key: 'search', default: "");
        $offset = $request->input(key: 'offset', default: 0);
        $limit = $request->input(key: 'limit', default: 0);

        $users = User::all();
        $totalUsers = $users->count();

        if ($search) {
            $users = User::where(column: 'id', operator: 'LIKE', value: "%{$search}%")
                ->orWhere(column: 'first_name', operator: 'LIKE', value: "%{$search}%")
                ->orWhere(column: 'last_name', operator: 'LIKE', value: "%{$search}%")
                ->orWhere(column: 'email', operator: 'LIKE', value: "%{$search}%")
                ->orWhere(column: 'phone', operator: 'LIKE', value: "%{$search}%");
        }

        $users = $users->skip($offset)->take($limit);
        $users = $search ? $users->get() : $users;

        return new UserTableCollection(resource: $users, totalRows: $totalUsers);
    }
}
