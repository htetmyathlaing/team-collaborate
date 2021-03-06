<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use App\Events\MessagePosted;

class MessageController extends Controller
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
            'message'=>'required'
        ]);

        $message = new Message();
        $message->message = $request->input('message');
        $message->user_id = Auth::id();
        $message->group_id = $request->input('currentGroup');
        if($request->input('currentChannel')[0]=='c'){
            $message->type = "channel";
            $message->channel_id = (int)filter_var($request->input('currentChannel'), FILTER_SANITIZE_NUMBER_INT);
        }
        else{
            $message->type = "direct-message";
            $message->to_user_id = (int)filter_var($request->input('currentChannel'), FILTER_SANITIZE_NUMBER_INT);
        }
        $message->save();
        broadcast(new MessagePosted($message->id));
        return "Message Sent";
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

    /**
     * Return messages in the current channel
     *
     * @param  int $channel
     * @return \Illuminate\Http\Response
     */
    public function getMessages($group_id='',$channel_id='')
    {
        // return Message::where('type','channel')->where('channel_id',94)->with('user')->get();
        if($channel_id[0]=='c'){
            $channel_id = (int) filter_var($channel_id, FILTER_SANITIZE_NUMBER_INT);
            return ['messages' => Message::where([
                        ['type', '=', 'channel'],
                        ['channel_id', '=', $channel_id]
                ])->with('user')->get()];
        }
        else{    
            $channel_id = (int) filter_var($channel_id, FILTER_SANITIZE_NUMBER_INT);
            return ['messages' => Message::where('type','direct-message')
                                    ->where('group_id', $group_id)
                                    ->whereIn('user_id', [Auth::id(), $channel_id])
                                    ->whereIn('to_user_id', [Auth::id(), $channel_id])
                                    ->with('user')->get()];
        }

    }
}
