<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/group/{group_id}', 'GroupController@index')->name('home');

Route::resource('/messages', 'MessageController');

Route::resource('/channels', 'ChannelController');

Route::delete('/channel/{group_id}/{id}', 'ChannelController@destroy');

Route::get('/getmessages/{group_id}/{channel_id}', 'MessageController@getMessages');

Route::get('/init/{group_id}', 'GroupController@init');

Route::resource('/groups', 'GroupController');

Route::resource('/users', 'UserController');

Route::resource('/notes', 'NoteController');

Route::get('/getnotes/{group_id}', 'NoteController@getNotes');

Route::resource('/files', 'FileController');

Route::get('/getfiles/{group_id}/{type}', 'FileController@getFiles');

Route::put('/notifications', function(){
	Auth::user()->unreadNotifications->markAsRead();
	return Auth::user()->notifications;

});



// Route::get('/test', function(){
// 	return asset('/css/app.css');
// });

// Route::get('/mail', function(){
// 	$data = array('name'=>"Htet Myat", "body" => "Testing Email");

// 	Mail::send('testmail', $data, function($message) {
//     	$message->to('htetmyathlaing.htd@gmail.com', 'Htet Myat')
//                 ->subject('Web Testing Mail with app pw')
//     	        ->from('htetmyathlaing.htd@gmail.com','Htet Myat Hlaing');
// 	});

// });

// Route::get('/test', function(){
// 	$message = new App\Message();
//     $message->message = 'message';
//     $message->user_id = Auth::id();
// 	broadcast(new App\Events\MessagePosted($message));
// 	broadcast(new App\Events\TestEvent());
// });



