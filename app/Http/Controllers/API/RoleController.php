<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Control all role requests.
     */
    public function __construct() {
        // 
    }

    /**
     * Get roles data.
     * 
     * @param Request $request
     * 
     * @return RoleCollection
     */
    public function roles(Request $request): RoleCollection
    {
        $roles = Role::get();
        return new RoleCollection(resource: $roles);
    }

    /**
     * Create role data.
     * 
     * @param Request $request
     * 
     * @return RoleCollection
     */
    public function create(Request $request): RoleCollection
    {
        Role::create(attributes: [
            'name' =>  $request->input(key: 'name'),
            'guard_name' => $request->input(key: 'guard_name')
        ]);

        return new RoleCollection(resource: Role::all());
    }

    /**
     * Update role data.
     * 
     * @param Request $request
     * 
     * @return RoleCollection
     */
    public function update(Request $request, int $id): RoleCollection
    {
        Role::find(id: $id)->update([
            'name' =>  $request->input(key: 'name'),
            'guard_name' => $request->input(key: 'guard_name')
        ]);

        return new RoleCollection(resource: Role::all());
    }

    /**
     * Get role data.
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return RoleCollection
     */
    public function get(Request $request, int $id): RoleResource
    {
        return new RoleResource(Role::find(id: $id));
    }

    /**
     * Delete role data.
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return RoleCollection
     */
    public function delete(Request $request, int $id): RoleCollection
    {
        Role::find(id: $id)->delete();

        return new RoleCollection(resource: Role::all());
    }
}
