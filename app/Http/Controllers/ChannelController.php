<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppNotification;
use App\Channel;
use App\Group;
use App\Message;
use App\User;

class ChannelController extends Controller
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
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'group_id'=>'required'
        ]);
        
        $channel = new Channel();
        $channel->name = '#'.strtolower($request->input('name'));
        $channel->description = $request->input('description');
        $channel->group_id = $request->input('group_id');
        $channel->save();

        $users = Group::with('users')->find($channel->group_id)->users;
        $notification = [
            'user' => Auth::user()->name,
            'group'  => $channel->group_id,
            'action' => "created the $channel->name channel",
        ];

        Notification::send($users, new AppNotification($notification));

        return $channel;
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
    public function destroy($group_id, $id)
    {
        if(Group::find($group_id)->user->id == Auth::user()->id ){
            if($id[0]=='c'){
                $id = (int)filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                $type = 'channel';
                if(sizeof(Channel::where('group_id', $group_id)->get()) == 1){
                    $notification = [
                        'user' => Auth::user()->name,
                        'group'  => $group_id,
                        'action' => ",you cannot delete the last channel",
                    ];
                    Auth::user()->notify(new AppNotification($notification));
                    return 'false';
                }
                else {
                    $users = Group::with('users')->find($group_id)->users;
                    $notification = [
                        'user' => Auth::user()->name,
                        'group'  => $group_id,
                        'action' => "deleted the ".Channel::find($id)->name." channel",
                    ];
                    Channel::destroy($id);
                    Message::where('channel_id', $id)->delete();
                    
                    Notification::send($users, new AppNotification($notification));
                }
            }
            else{
                $id = (int)filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                $type= 'user';
                DB::delete('delete from group_user where group_id = ? and user_id  = ?', [$group_id, $id]);
                Message::where('user_id', $id)->orWhere('to_user_id', $id)->delete();

                Channel::destroy($id);
                Message::where('channel_id', $id)->delete();

                $users = Group::with('users')->find($group_id)->users;
                $notification = [
                    'user' => Auth::user()->name,
                    'group'  => $group_id,
                    'action' => "remove ".User::find($id)->name." from the group",
                ];
                Notification::send($users, new AppNotification($notification));

            }
            return json_encode(['type' => $type, 'id' => $id]);
        }
        $notification = [
            'user' => Auth::user()->name,
            'group'  => $group_id,
            'action' => $id[0]=='c' ? ",you are to authorized to delete the channel" : ",you are to authorized to remove the user",
        ];
        Auth::user()->notify(new AppNotification($notification));
        return 'false';
    }
}
