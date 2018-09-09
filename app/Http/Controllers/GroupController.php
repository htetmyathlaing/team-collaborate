<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Message;
use App\Group;
use App\Channel;
use App\Note;
use App\File;

class GroupController extends Controller
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
    public function index($group_id=null)
    {
        if(is_null($group_id))
            return view('welcome');

        if(Group::find($group_id))
            return view('group')->with('group_id', $group_id);
        else
           return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = new Group();
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->user_id = Auth::id();
        $group->save();

        $channel = new Channel();
        $channel->name = '#general';
        $channel->description = 'Discussing about general things';
        $channel->group_id = $group->id;
        $channel->save();

        DB::insert('insert into group_user (user_id, group_id) values (?, ?)', [Auth::id(), $group->id]);

        return $group;
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
        $group = Group::find($id);
        if($group){
            Group::destroy($id);
            Channel::where('group_id', $id)->delete();
            Message::where('group_id', $id)->delete();
            Note::where('group_id', $id)->delete();
            DB::table('group_user')->where('group_id', $id)->delete();

            $files = File::where('group_id', $id)->get();
            foreach ($files as $file) {
                Storage::delete('public\/files\/'.$file->file_name);
                File::find($file->id)->delete();  
            }
        }
        return "true";
    }

    /**
     * Initiate the current requested group
     *
     * @param  int $group_id
     * @return \Illuminate\Http\Response
     */
    public function init($group_id)
    {
        return ['user' => User::with('involvedGroups')->find(Auth::id()), 
                'group' => Group::with('channels')->with('users')->find($group_id),
                'notifications' => User::find(Auth::id())->notifications,
                'messages' => Message::where('group_id', $group_id)
                                     ->where('channel_id', Group::with('channels')->find($group_id)->channels[0]->id)
                                     ->with('user')
                                     ->get()];
    }
}
