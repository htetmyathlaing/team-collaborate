<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use App\Group;
use App\Channel;

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
    public function index()
    {
        return view('home');
    }

    public function init()
    {
        return ['user' => User::find(Auth::id())->with('involvedGroups')->get(), 
                'group' => Group::with('channels')->with('users')->first(),
                'messages' => Message::with('user')->get()];
    }

    public function getMessages($channel='')
    {
        $channel_id = (int) filter_var($channel, FILTER_SANITIZE_NUMBER_INT);
    
        if($channel[0]=='c')
            return ['messages' => Message::where([
                        ['type', '=', 'channel'],
                        ['channel_id', '=', $channel_id]
                ])->with('user')->get()];
        else
            return ['messages' => Message::where([
                        ['type', '=', 'direct-message'],
                        ['to_user_id', '=', $channel_id]
                ])->with('user')->get()];
    }
}
