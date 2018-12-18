<?php

namespace App\Http\Controllers;

use App\File;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppNotification;

class FileController extends Controller
{
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
        if($request->file('file')->getClientSize() > 104857600)
            return 'false';
        
        $file_title = $request->file('file')->getClientOriginalName();
        $file_type = $request->file('file')->getClientMimeType();
        $file_extension = $request->file('file')->getClientOriginalExtension(); 
        $file_name = $file_title.'_'.uniqid() . '_' . time() . '.' . $file_extension;
        $path = $request->file('file')->storeAs('public/files', $file_name);

        $file = new File();
        $file->file_title = $file_title;
        $file->file_name = $file_name;
        $file->file_type = $file_type;
        $file->group_id = $request->input('group_id');
        $file->user_id = Auth::id();
        $file->save();

        $users = Group::with('users')->find($file->group_id)->users;
        $notification = [
            'user' => Auth::user()->name,
            'group'  => $file->group_id,
            'action' => "uploaded $file->file_title",
        ];

        Notification::send($users, new AppNotification($notification));

        return ['id' => $file->id, 'file_title' => $file->file_title, 'user' =>  Auth::user()];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return asset('storage/files/'.$file->file_name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        if($file->user_id == Auth::id() || Group::find($file->group_id)->user->id == Auth::id()){
            $users = Group::with('users')->find($file->group_id)->users;

            $notification = [
                'user' => Auth::user()->name,
                'group'  => $file->group_id,
                'action' => "remove $file->file_title from the group",
            ];

            Storage::delete('public\/files\/'.$file->file_name);
            $file->delete();

            Notification::send($users, new AppNotification($notification));
        }
        else{
            $notification = [
                'user' => Auth::user()->name,
                'group'  => $file->group_id,
                'action' => ",you are to authorized to delete the file",
            ];
            Auth::user()->notify(new AppNotification($notification));
        }
    }

    /**
     * Get all files in a specified group
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function getFiles($group_id=null, $type){
        return File::where('group_id',$group_id)
                    ->where('file_type', 'like', $type.'%')
                    ->with('user')->latest()->get();
    }
}
