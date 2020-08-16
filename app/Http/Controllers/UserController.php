<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function index()
    {
        $roles = Role::all();

        $users = User::all();
        foreach ($users as $user) {
            $user->roles;
            $user->courses;
            $user->postponements;
        }
        return view('users', ['users' => $users, 'roles' => $roles]);
    }


    public function getAllUsers()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->roles;
            $user->courses;
            $user->postponements;
        }
        return response()->json(['users' => $users], 200);
    }
    public function getSingleUserApi($userId)
    {
        $user = User::find($userId);
        if (!$userId) return redirect()->with('message', 'User not found');

        $user->roles;
        $user->courses;
        $user->postponements;
        $user->scores;

        return response()->json(['user' => $user], 200);

    }
    public function getSingleUser($userId)
    {
        $allRoles=Role::all();

        $user = User::find($userId);
        if (!$userId) return redirect()->with('message', 'User not found');

        $user->roles;
        $user->courses;
        $user->postponements;

        return view('user', ['user' => $user,'allRoles'=>$allRoles]);
    }


    // *************** Function for Registering New User *************************
    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'surname' => 'required',
            'reg_number' => 'required | unique:users',
            'role' => 'required'
        ]);

        if ($validator->fails()) {

            return back()->withInput()->withErrors($validator);
        }


        $role = Role::find($request->input('role'));
        if (!$role) return back()->with('message', 'Role not found');

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->surname = $request->input('surname');
        $user->reg_number = $request->input('reg_number');
        $user->department = $request->input('department');
        $user->program = $request->input('program');
        $user->year = $request->input('year');
        $user->password = bcrypt('@Coict2020');

        $user->save();

        $user->roles()->attach($role);
        return back()->with('message', 'User registered successfully');
    }


    // *************** Function for Deleting User *************************
    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return redirect()->with('message', 'User not found');
        }
        $user->delete();
        return back()->with('message', 'User deleted successfully');
    }


    public function allStudents()
    {
        $role = Role::whereName('Student')->first();

        $students = $role->users;

        return view('students', ['students' => $students]);
    }
    public function allInstructors()
    {
        $role = Role::whereName('Instructor')->first();

        $instructors = $role->users;

        return view('instructors', ['instructors' => $instructors]);
    }

    public function getSingleStudent($userId)
    {
        $allCourses = Course::all();

        $user = User::find($userId);
        if (!$userId) return redirect()->with('message', 'Student not found');

        $user->roles;
        $user->courses;
        $user->postponements;

        return view('student', ['user' => $user, 'allCourses' => $allCourses]);
    }
    public function getSingleInstructor($userId)
    {
        $allCourses = Course::all();

        $user = User::find($userId);
        if (!$userId) return redirect()->with('message', 'Instructor not found');

        $user->roles;
        $user->courses;

        return view('instructor', ['user' => $user, 'allCourses' => $allCourses]);
    }
}
