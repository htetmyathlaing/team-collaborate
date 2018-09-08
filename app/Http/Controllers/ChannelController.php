<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Channel;
use App\Group;
use App\Message;


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

        return Group::with('channels')->with('users')->find($channel->group_id);
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
        if($id[0]=='c'){
            $id = (int)filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $type = 'channel';
            Channel::destroy($id);
            Message::where('channel_id', $id)->delete();
        }
        else{
            $id = (int)filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $type= 'user';
            DB::delete('delete from group_user where group_id = ? and user_id  = ?', [$group_id, $id]);
            Message::where('to_user_id', $id)->delete();
        }
        return json_encode(['type' => $type, 'id' => $id]);
    }
}
