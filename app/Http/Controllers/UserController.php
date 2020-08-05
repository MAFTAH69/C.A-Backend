<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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

    public function getSingleUser($userId)
    {
        $user = User::find($userId);
        if (!$userId) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }
        $user->roles;
        $user->courses;
        return response()->json([
            'user' => $user
        ], 200);
    }


    // *************** Function for Registering New User *************************
    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'second_name'=>'required',
            'surname'=>'required',
            'reg_number' => 'required | unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => $validator->errors()->first(),
            ], 404);
        }

        $user = new User();
        $user->first_name=$request->input('first_name');
        $user->second_name=$request->input('second_name');
        $user->surname=$request->input('surname');
        $user->reg_number=$request->input('reg_number');
        $user->password=bcrypt($request->input('password'));

        $user->save();

        return response()->json([
            'user' => $user
        ], 200);
        // $token = auth()->login($user);
        // return $this->respondWithToken($token);

    }


    // *************** Function for Login *************************
    public function login()
    {
        $credentials = request(['reg_number', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
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
