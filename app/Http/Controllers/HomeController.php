<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Group;


class HomeController extends Controller
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
    public function index(){
        $involvedGroups =  User::with('involvedGroups')->find(Auth::id())->involvedGroups;
        $groups = [];
        foreach ($involvedGroups as $group) {
            array_push($groups, Group::with('users')->find($group->id));
        }
        return view('home', compact('groups'));
    }
    
}
