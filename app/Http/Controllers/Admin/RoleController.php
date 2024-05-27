<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        //
    }


    public function store(RoleRequest $request)
    {
        if (Gate::denies('create-role')){
            return $this->errorResponse('not permission user by gates', 403);
        }
        $role = Role::query()->create([
            'title' => $request->title,
        ]);

        $role->permissions()->attach($request->permissions);
        return $this->successResponse($role->title);
    }


    public function show(Role $role)
    {
        //
    }


    public function update(Request $request, Role $role)
    {
        $role->update([
            'title' => $request->title,
        ]);

        $role->permissions()->sync($request->permissions);
        return $this->successResponse($role->title);
    }


    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
        return $this->successResponse($role->title. ' '.'deleted successfully');
    }
}
