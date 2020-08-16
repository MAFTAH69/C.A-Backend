<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as REQ;

class RoleController extends Controller
{
    public function getAllRoles()
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            $role->users;
        }
        return response()->json([
            'roles' => $roles
        ], 200);
    }

    public function getSingleRole($roleId)
    {
        $role = Role::find($roleId);
        if (!$roleId) {
            if (REQ::is('api/*'))
                return response()->json([
                    'error' => 'Role not found'
                ], 404);

            return redirect()->with('message', 'Role not found');
        }
        $role->users;
        if (REQ::is('api/*'))

            return response()->json([
                'role' => $role
            ], 200);

        return view('role', ['role' => $role]);
    }


    public function postRole(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);

        }

        $role = new Role();
        $role->name = $request->input('name');
        $role->description = $request->input('description');


        // Save course
        $role->save();
        return back()->with('message', 'Role added successfully');

    }

    public function putRole(Request $request, $roleId)
    {
        $role = Role::find($roleId);
        if (!$role) {
            return response()->json([
                'error' => 'Role not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $role->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        $role->save();
        return response()->json([
            'role' => $role
        ], 200);
    }

    public function deleteRole($roleId)
    {
        $role = Role::find($roleId);
        if (!$role) {
            return redirect()->with('error', 'Role not found');
        }

        $role->delete();

        return redirect('roles')->with('message', 'Role deleted successfully');
    }
    public function attachRoleToUser(Request $request, $status)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'role_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 404);
        }

        $role = Role::find($request->role_id);
        if (!$role) return response()->json(['error' => 'Role not found'], 404);

        $user = User::find($request->user_id);
        if (!$user) return response()->json(['error' => 'User not found'], 404);

        if ($status == 'attach') $user->roles()->attach($role);

        if ($status == 'detach') $user->roles()->detach($role);

        $user->roles;

        return back()->with('message', 'Successfully');
    }

    public function index()
    {
        // return view('home');
        $roles = Role::all();
        foreach ($roles as $role) {
            $role->users;
        }
        return view('roles', ['roles' => $roles]);
    }
}
