<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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
     * @return JsonResource
     */
    public function update(UpdateAccountRequest $request): JsonResource
    {
        $data = $request->validated();

        $this->userService->updateAccount(userId: $request->user()->id, account: $data);

        $user = User::find(id: $request->user()->id);
        Log::info(message: $user);
        Log::info(message: $data);

        return new UserResource(resource: $user);
    }
}
