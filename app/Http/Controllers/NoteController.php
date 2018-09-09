<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppNotification;

class NoteController extends Controller
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
        $note = new Note();
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->group_id = $request->input('group_id');
        $note->user_id = Auth::id();
        $note->save();

        $users = Group::with('users')->find($note->group_id)->users;
        $notification = [
            'user' => Auth::user()->name,
            'group'  => $note->group_id,
            'action' => "posted a note on title $note->title",
        ];

        Notification::send($users, new AppNotification($notification));
        
        return ['id' => $note->id, 'title' => $note->title];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return $note;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return $note;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $note->content = $request->input('content');
        $note->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
         $users = Group::with('users')->find($note->group_id)->users;

        $notification = [
            'user' => Auth::user()->name,
            'group'  => $note->group_id,
            'action' => "delete $note->title from the notes",
        ];

        $note->delete();

        Notification::send($users, new AppNotification($notification));
    }

    /**
     * Get all note in a specified group
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function getNotes($group_id=null){
        return Note::where('group_id',$group_id)->pluck('title', 'id');
    }
}
