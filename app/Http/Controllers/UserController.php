<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Course;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->roles;
            $user->courses;
        }
        return response()->json([
            'users' => $users
        ], 200);
    }


    // *************** Function for Registering New User *************************
    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'reg_number' => 'required | unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => $validator->errors()->first(),
                'status' => false
            ], 404);
        }

        $user = User::create(
            [
                'name' => $request->input('name'),
                'reg_number' => $request->input('reg_number'),
                'password' => bcrypt($request->input('password')),
            ]
        );

        $role = Role::where('name', 'Listerner')->first();
        $user->roles()->attach($role);
        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }


    // *************** Function for Login *************************
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    // *************** Function for Changing User Role *************************
    public function changeUserRole(Request $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }
        $oldRole = Role::where('name', $request->input('old_role'))->first();
        $newRole = Role::where('name', $request->input('new_role'))->first();

        if (!$oldRole) {
            return response()->json([
                'error' => 'Invalid old role'
            ], 404);
        }
        if (!$newRole) {
            return response()->json([
                'error' => 'Invalid new role'
            ], 404);
        }

        if ($user->roles()->detach($oldRole)) {
            if ($user->roles()->attach($newRole));
                if ($request->input('new_role') == 'Artist') {
                    Storage::copy('images/default_album_cover.png', 'albums/' . $user->name . '_' . $user->id . '_albums/default_album/cover/default_album_cover.png');
                    $album = new Album();
                    $album->name = $user->name . '_default';
                    $album->cover = 'albums/' . $user->name . '_' . $user->id . '_albums/default_album/cover/default_album_cover.png';
                    $album->path_to_storage = 'albums/' . $user->name . '_' . $user->id . '_albums/default_album/';

                    $user->albums()->save($album);
                }


            $user->roles;
            $user->albums;
            return response()->json([
                'user' => $user
            ], 200);
        }

        return response()->json([
            'error' => 'Old role does\'t exist'
        ], 404);
    }


    // *************** Function for Logout *************************
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    // *************** Function for User Token *************************
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }


    // *************** Function for Editing User *************************
    public function putUser(Request $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'error' => 'Selected user not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => $validator->errors()->first(),
                'status' => false
            ], 404);
        }

        $user->update([
            'name' => $request->input('name')
        ]);

        return response()->json([
            'user' => $user
        ], 200);
    }



    // *************** Function for Deleting User *************************
    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }

}
