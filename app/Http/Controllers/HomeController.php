<?php

namespace App\Http\Controllers;

use App\Course;
use App\Postponement;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users=User::all();
        $roles=Role::all();
        $courses=Course::all();
        $postponements=Postponement::all();

        return view('home')->with(['users'=>$users, 'roles'=>$roles, 'courses'=>$courses,'postponements'=>$postponements]);
    }
}
