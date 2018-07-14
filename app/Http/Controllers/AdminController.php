<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\User;
use Illuminate\Foundation\Auth\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function users($userId = null)
    {
        $users = User::all();
        $user = ($userId) ? User::find($userId) : null;

        return view('admin/users', compact('users', 'user'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function usersEdit($userId)
    {
        $users = User::all();
        $users = User::all();

        return view('admin/users', compact('users'));
    }
}
