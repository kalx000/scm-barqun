<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => 'index', 'store']);
        $this->middleware('permission:role-create', ['only' => ['store']]);
        $this->middleware('permission:role-edit', ['only' => ['update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $role = Role::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $role
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
        $role->syncPermissions($request->input('permission'));

        return response()->json([
            'message' => 'Data Created',
            'data' => $role
        ], 201);
    }

    public function show($id)
    {
        $role = Role::find($id);
        // $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
        //     ->where("role_has_permissions.role_id", $id)
        //     ->get();

        return response()->json([
            'message' => 'Data Retreived',
            'data' => array_merge(
                $role->toArray(),
                [
                    'permissions' => $role->first()->permissions->pluck('name')
                ]
            ),
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return response()->json([
            'message' => 'Data Updated',
            'data' => $role
        ], 200);
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();

        return response()->json(
            [
                'message' => 'Data Deleted'
            ],
            200
        );
    }
}
