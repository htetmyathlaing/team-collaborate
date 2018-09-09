<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppNotification;
use App\User;
use App\Group;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            $role = DB::table('group_user')
                    ->select('id')
                    ->where('user_id', $user->id)
                    ->where('group_id', $request->input('group_id'))
                    ->get();
            if(!sizeof($role)){
                DB::insert('insert into group_user (user_id, group_id) values (?, ?)', [$user->id, $request->input('group_id')]);

                $users = Group::with('users')->find($request->input('group_id'))->users;
                $notification = [
                    'user' => Auth::user()->name,
                    'group'  => $request->input('group_id'),
                    'action' => "added $user->name to ".Group::find($request->input('group_id'))->name,
                ];

                Notification::send($users, new AppNotification($notification));
                return $user;
            }
            else
                return "exit";
        }
        else
            return "not found";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
